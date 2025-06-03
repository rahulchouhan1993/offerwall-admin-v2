<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\App;
use App\Models\Country;
use App\Models\User;
use App\Models\Tracking;
use App\Models\FeaturedOffer;
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
        if(!isset($requestedParams['sort']) || !isset($requestedParams['order'])){
            return redirect()->route('admin.report.statistics',['sort'=>'element','order'=>'asc']);
        }
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
                    $trackingStats->selectRaw("offer_name as element")->groupBy("offer_name");
                    break;
                default:
                    // Do nothing if groupBy is invalid
                    break;
            }
        }
        $allStatistics = $trackingStats->get();
        $sortBy = $request->get('sort', 'element');
        $order = $request->get('order', 'asc');

        $allStatistics = $allStatistics->sortBy(function ($item) use ($sortBy) {
            switch ($sortBy) {
                case 'cvr':
                    return ($item->total_click > 0) ? ($item->total_conversions / $item->total_click) * 100 : 0;
                case 'epc':
                    return ($item->total_click > 0) ? ($item->total_payout / $item->total_click) : 0;
                default:
                    return $item->$sortBy ?? null;
            }
        }, SORT_REGULAR, $order === 'desc');
        $graphData = [];
        if($allStatistics->isNotEmpty()){
            foreach($allStatistics as $k => $v){
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
            $allTrackings = Tracking::select('offer_id', 'offer_name')->distinct()->pluck('offer_name', 'offer_id');
            if (!empty($allTrackings)) {
                foreach ($allTrackings as $offerId => $offerName) {
                    $returnOptions .= '<option value="' . $offerId . '">' . ucfirst($offerName) . '</option>';
                }
            }
        }
        
        echo $returnOptions;die; 
    }
    
    public function featuredOffer(Request $request){
        $pageTitle = 'Featured Offer';

        //Manage Post
        if($request->isMethod('post')){
            $postData = $request['group-a'];
            $updatedIds = [];
            if(!empty($postData)){
                foreach($postData as $k =>$v){
                    if($v['offer_id']>0 && !empty($v['webmasters'])){
                        if($v['rec_id']>0){
                            $newEntity = FeaturedOffer::find($v['rec_id']);
                        }else{
                            $newEntity = new FeaturedOffer();
                        }
                        $newEntity->offer_id = $v['offer_id'];
                        $newEntity->affiliates = implode(',',$v['webmasters']);
                        $newEntity->countries = implode(',',$v['countries']);
                        $newEntity->devices = implode(',',$v['devices']);
                        $newEntity->operating_system = implode(',',$v['operating_system']);
                        $newEntity->save();
                        $updatedIds[] = $newEntity->id;
                    }
                }
            }
            if(!empty($updatedIds)){
                FeaturedOffer::whereNotIn('id',$updatedIds)->delete();
            }
            return redirect()->back()->with('success','Featured Offers Updated');
        }
        //End
        $allCountries = Country::get();
        $offerSettings = Setting::find(1);
        $allFeatOffer = FeaturedOffer::get();
        $allAffiliates = User::select('id', 'name', 'last_name', 'affise_api_key')
            ->where('role', 'affiliate')
            ->where('status', 1)
            ->groupBy('id', 'name', 'last_name', 'affise_api_key')
            ->get()
        ->mapWithKeys(function ($user) {
            return [$user->id => $user->name . ' ' . $user->last_name];
        });

        $allOffers = [];
        $url = $offerSettings->affise_endpoint . "offers?sort[epc]=desc&limit=5000";
        $response = HTTP::withHeaders([
            'API-Key' => $offerSettings->affise_api_key,
        ])->get($url);
        if ($response->successful()) {
            $allOffers = $response->json();
        }else{
            die('No offer found');
        }

        return view('dashboard.featured',compact('allCountries','pageTitle','allAffiliates','allOffers','allFeatOffer'));
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
                    $row['revenue'],
                    $row['payout'],
                    $row['earnings']
                ]);
            }

            fclose($file);
        };
       

        return response()->stream($callback, 200, $headers);
    }

    public function getOfferAffiliate(Request $request){
        $offerSettings = Setting::find(1);
        $offerId = $request->offer;
        $url = "https://api-makamobile.affise.com/3.1/offers/{$offerId}/privacy";
        $response = HTTP::withHeaders([
            'API-Key' => $offerSettings->affise_api_key,
        ])->get($url);
        $enabledUsers = [];
        $disabledUsers = [];
        $updatedEnabledUsers = [];
        if ($response->successful()) {
            $assignedAffiliates = $response->json();
            if(isset($assignedAffiliates['affiliates_enabled']) && !empty($assignedAffiliates['affiliates_enabled'])){
                $enabledUsers = $assignedAffiliates['affiliates_enabled'];
            }
            if(isset($assignedAffiliates['affiliates_disabled']) && !empty($assignedAffiliates['affiliates_disabled'])){
                $disabledUsers = $assignedAffiliates['affiliates_disabled'];
            }
            $updatedEnabledUsers = array_values(array_diff($enabledUsers, $disabledUsers));
            $allAffiliates = User::select('id', 'name', 'last_name', 'affise_api_key')
            ->where('role', 'affiliate')
            ->where('status', 1)
            ->whereIn('affiseId', $updatedEnabledUsers)
            ->groupBy('id', 'name', 'last_name', 'affise_api_key')
            ->get()
            ->mapWithKeys(function ($user) {
                return [$user->id => $user->name . ' ' . $user->last_name];
            });
            $responseData = [
                'data' => $allAffiliates
            ];
        }else{
            $responseData = [
                'data' => []
            ];
        }
        

        return response()->json($responseData);
    }
}
