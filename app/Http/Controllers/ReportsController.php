<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\App;
use App\Models\User;
use App\Models\Tracking;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ReportsController extends Controller
{
    public function statistics(Request $request){
        $pageTitle = 'Statistics';
        $allAffiliatesApp = [];
        $settingDetails = Setting::find(1);
        $allRegisteredAffiliates = User::where('status',1)->where('role','affiliate')->get();
        $trackingStats = Tracking::query();
        $requestedParams = $request->all();
        
        $requestedParams['groupBy'] = $requestedParams['groupBy'] ?? 'hour';
        $requestedParams['range'] = $requestedParams['range'] ?? date('m/d/Y', strtotime('-6 days')).' - '.date('m/d/Y');
        // Apply date range filter
        if (!empty($requestedParams['range'])) {
            $separateDate = explode('-', $requestedParams['range']);
            $requestedParams['strd'] = trim($separateDate[0]);
            $requestedParams['endd'] = trim($separateDate[1]);
            $startDate = date('Y-m-d 00:00:00', strtotime(trim($separateDate[0])));
            $endDate = date('Y-m-d 23::59:59', strtotime(trim($separateDate[1])));
            $trackingStats->whereBetween('click_time', [$startDate, $endDate]); 
        }

        // Apply affiliate filter
        if (!empty($requestedParams['affiliate']) && $requestedParams['affiliate'] > 0) {
            $trackingStats->where('user_id', $requestedParams['affiliate']);
        }

        // Apply app filter
        if (!empty($requestedParams['appid']) && $requestedParams['appid'] > 0) {
            $trackingStats->where('app_id', $requestedParams['appid']);
        }

        // Apply specific filter conditions
        if (!empty($requestedParams['filterBy']) && !empty($requestedParams['filterIn'])) {
            $filterColumnMap = [
                'os' => 'device_os',
                'country' => 'country_code',
                'offer' => 'offer_id',
                'devices' => 'device_type'
            ];
            
            foreach($requestedParams['filterIn'] as $filyKey => $filterAsIn){
                if (isset($filterColumnMap[$filyKey])) {
                    $trackingStats->where($filterColumnMap[$filyKey], $filterAsIn[0]);
                }
            }
        }

        $trackingStats->selectRaw("
            COUNT(*) as total_click,
            COUNT(CASE WHEN conversion_id IS NOT NULL AND status=1 THEN 1 END) as total_conversions,
            SUM(revenue) as total_revenue,
            SUM(payout) as total_payout
        ");

        // Apply conditional GROUP BY
        if (!empty($requestedParams['groupBy'])) {
            switch ($requestedParams['groupBy']) {
                case 'hour':
                    $trackingStats->selectRaw("HOUR(click_time) as element")->groupByRaw("HOUR(click_time)");
                    break;
                case 'day':
                    $trackingStats->selectRaw("DATE(click_time) as element")->groupByRaw("DATE(click_time)");
                    break;
                case 'month':
                    $trackingStats->selectRaw("DATE_FORMAT(click_time, '%Y-%m') as element")->groupByRaw("DATE_FORMAT(click_time, '%Y-%m')");
                    break;
                case 'country':
                    $trackingStats->selectRaw("country_code as element")->groupBy("country_code");
                    break;
                case 'browser':
                    $trackingStats->selectRaw("browser as element")->groupBy("browser");
                    break;
                case 'device':
                    $trackingStats->selectRaw("device_brand as element")->groupBy("device_brand");
                    break;
                case 'device_model':
                    $trackingStats->selectRaw("device_model as element")->groupBy("device_model");
                    break;
                case 'os':
                    $trackingStats->selectRaw("device_os as element")->groupBy("device_os");
                    break;
                case 'offer':
                    $trackingStats->selectRaw("offer_id as element")->groupBy("offer_id");
                    break;
                default:
                    // Do nothing if groupBy is invalid
                    break;
            }
        }
        $allStatistics = $trackingStats->get();
        $graphData = [];
        if($allStatistics->isNotEmpty()){
            foreach($allStatistics as $k => $v){
                //special condition for offer grouped by
                if($requestedParams['groupBy']=='offer'){
                    $url = $settingDetails->affise_endpoint.'offer/'.$v->element;
                    $response = HTTP::withHeaders([
                        'API-Key' => $settingDetails->affise_api_key,
                    ])->get($url);
                    
                    if ($response->successful()) {
                        $offerDetails = $response->json();
                        $v->element = ucfirst($offerDetails['offer']['title']);
                    }
                }
                $graphData[$v->element]['conversion'] = $v->total_conversions;
                $graphData[$v->element]['clicks'] = $v->total_click;
            }
        }
        
        if(isset($requestedParams['affiliate']) && $requestedParams['affiliate']>0){
            $allAffiliatesApp = App::where('affiliateId',$requestedParams['affiliate'])->get();
        } 
        
        return view('reports.statistics',compact('pageTitle','allStatistics','allAffiliatesApp','allRegisteredAffiliates','requestedParams','graphData'));
    }

    public function getAffiliaetApp($affiliateId){
        $allApps = App::where('affiliateId',$affiliateId)->get();
        $option = '<option value="">Select All</option>';
        if($allApps && $allApps->isNotEmpty()){
            foreach($allApps as $app){
                $option.= '<option value="'.$app->id.'">'.$app->appName.'</option>';
            }
        }
        echo $option;die;
    }

    public function permission(){
        return view('reports.permission');
    }

    public function filterGroup($filterBy = null){
        $settingDetails = Setting::find(1);
        $returnOptions = '<option value="">Select</option>';
        if($filterBy=='country'){
            $allTrackings = Tracking::select('country_code', 'country_name')
            ->groupBy('country_code', 'country_name')
            ->pluck('country_name', 'country_code');
            foreach($allTrackings as $isoCode =>$countryName){
                $returnOptions.='<option value="'.$isoCode.'">'.$countryName.'</option>';
            }
        }elseif($filterBy=='devices'){
            $allTrackings = Tracking::groupBy('device_type')->pluck('device_type');
            if(!empty($allTrackings)){
                foreach($allTrackings as $tracking){
                    $returnOptions.='<option value="'.$tracking.'">'.ucfirst($tracking).'</option>';
                }
            }
        }elseif($filterBy=='os'){
            $allTrackings = Tracking::groupBy('device_os')->pluck('device_os');
            if(!empty($allTrackings)){
                foreach($allTrackings as $tracking){
                    $returnOptions.='<option value="'.$tracking.'">'.ucfirst($tracking).'</option>';
                }
            }
        }elseif($filterBy=='offer'){
            $allTrackings = Tracking::groupBy('offer_id')->pluck('offer_id');
            if(!empty($allTrackings)){
                foreach($allTrackings as $tracking){
                    $url = $settingDetails->affise_endpoint.'offer/'.$tracking;
                    $response = HTTP::withHeaders([
                        'API-Key' => $settingDetails->affise_api_key,
                    ])->get($url);
                    
                    if ($response->successful()) {
                        $offerDetails = $response->json();
                        $returnOptions.='<option value="'.$tracking.'">'.ucfirst($offerDetails['offer']['title']).'</option>';
                    }
                }
            }
        }
        
        echo $returnOptions;die;
    }
    
    public function reportStatus(Request $request){
        $pageTitle = 'Report Status';
        $adminDetails = User::find(1);
        if($request->isMethod('post')){
            $adminDetails->conversion_report = ($request->conversion=='on') ? 1 : 0;
            $adminDetails->postback_report = ($request->postback=='on') ? 1 : 0;
            $adminDetails->contet = $request->content;
            $adminDetails->save();

            redirect()->back()->with('success', 'Details Updated!!');
        }
        return view('reports.status',compact('pageTitle','adminDetails'));
    }

    public function exportReport(Request $request){
        $data = $request->input('exportData');
        
        $filename = date('d M Y').' - '.rand()."-report.csv";
        $headers = [
            "Content-Type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
        ];

        $callback = function () use ($data) {
            $file = fopen('php://output', 'w');

            // Add CSV Heading
            fputcsv($file, $data['heading']);

            // Add Data Rows
            foreach ($data['data'] as $row) {
                fputcsv($file, [
                    $row['element'], 
                    $row['clicks'], 
                    $row['conversions'], 
                    $row['cvr'], 
                    $row['epc'], 
                    $row['earnings']
                ]);
            }

            fclose($file);
        };
       

        return response()->stream($callback, 200, $headers);
    }
}
