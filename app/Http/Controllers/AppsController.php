<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\App;
use App\Models\PaymentMethod;
use App\Models\User;
use App\Models\Template;
use App\Models\Tracking;
use Illuminate\Http\Request;
use stdClass;
use Mpdf\Mpdf;

class AppsController extends Controller
{
    public function index(Request $request){
        $pageTitle = 'Apps';
        $allAffiliatesApp = [];
        $requestedParams = $request->all();
        $allApps = App::with('users');

        if (!empty($requestedParams['affiliate']) && $requestedParams['affiliate'] > 0) {
            $allApps->where('affiliateId', $requestedParams['affiliate']);
        }

        if (!empty($requestedParams['appid']) && $requestedParams['appid'] > 0) {
            $allApps->where('id', $requestedParams['appid']);
        }

        if (isset($requestedParams['admin_status']) && $requestedParams['admin_status'] == 'approved') {
            $allApps->where('status', 1);
        }elseif (isset($requestedParams['admin_status']) && $requestedParams['admin_status'] == 'not_approved') {
            $allApps->where('status', 0);
        }

        if (isset($requestedParams['affiliate_status']) && $requestedParams['affiliate_status'] == 'active') {
            $allApps->where('affiliate_status', 1);
        }elseif (isset($requestedParams['affiliate_status']) && $requestedParams['affiliate_status'] == 'archived') {
            $allApps->where('affiliate_status', 0);
        }

        $allApps = $allApps->get();

        $allAffiliates = App::with('users') 
        ->select('affiliateId')
        ->groupBy('affiliateId')
        ->get()
        ->map(function ($app) {
            return [
                'id' => optional($app->users)->id,
                'name' => optional($app->users)->name.' '.optional($app->users)->last_name,
            ];
        });
        
        if(isset($requestedParams['affiliate']) && $requestedParams['affiliate']>0){
            $allAffiliatesApp = App::where('affiliateId',$requestedParams['affiliate'])->get();
        }
        return view('apps.index',compact('pageTitle','allApps','allAffiliates','requestedParams','allAffiliatesApp'));
    }

    public function add(Request $request, $id =null){
        $pageTitle = 'Apps';
        if($id>0){
            $appData = App::find($id);
        }else{
            $appData = new App();
        }
        
        if($request->isMethod('POST')){
            if($id==null){
                $appData->appId = md5(rand());
                $appData->secrect_key = md5(rand());
                $appData->affiliateId = auth()->user()->id;
                $appData->status = 0;
            }
            $appData->appName = $request->appname;
            $appData->appUrl = $request->appurl;
            $appData->currencyName = $request->currencyname;
            $appData->currencyNameP = $request->currencynamep;
            $appData->currencyValue = $request->currencyvalue;
            $appData->rounding = $request->rounding;
            $appData->postback = $request->postback;
            if($appData->save()){
                if($id>0){
                    return redirect()->route('apps.index')->with('success', 'App updated successfully!!');
                }else{
                    $defaultTemplate = Template::find(1);
                    $templateColor = new Template();
                    $templateColor->user_id = auth()->user()->id;
                    $templateColor->app_id = $appData->id;
                    $templateColor->bodyBg = $defaultTemplate->bodyBg;
                    $templateColor->headerTextColor = $defaultTemplate->headerTextColor;
                    $templateColor->headerButtonBg = $defaultTemplate->headerButtonBg;
                    $templateColor->headerButtonColor = $defaultTemplate->headerButtonColor;
                    $templateColor->NotificationBg = $defaultTemplate->NotificationBg;
                    $templateColor->notificationText = $defaultTemplate->notificationText;
                    $templateColor->offerBg = $defaultTemplate->offerBg;
                    $templateColor->offerBgInner = $defaultTemplate->offerBgInner;
                    $templateColor->offerText = $defaultTemplate->offerText;
                    $templateColor->offerInfoBg = $defaultTemplate->offerInfoBg;
                    $templateColor->offerInfoText = $defaultTemplate->offerInfoText;
                    $templateColor->offerInfoBorder = $defaultTemplate->offerInfoBorder;
                    $templateColor->offerButtonBg = $defaultTemplate->offerButtonBg;
                    $templateColor->offerButtonText = $defaultTemplate->offerButtonText;
                    $templateColor->footerText = $defaultTemplate->footerText;
                    $templateColor->save();
                    return redirect()->route('apps.index')->with('success', 'App added successfully!!');
                }
            }else{
                return redirect()->route('apps.index')->with('error', 'Sonething went wrong, please try again.');
            }
        }
        return view('apps.add',compact('pageTitle','appData','id'));
    }

    public function integration($id){
        $pageTitle = 'Integration';
        $appDetail = App::find($id);
        $affiliateDetails = User::find($appDetail->affiliateId);
        return view('apps.integration',compact('pageTitle','appDetail','affiliateDetails'));
    }

    public function updateStatus($id){
        $appDetail = App::find($id);
        $appDetail->status = ($appDetail->status==1) ? '0' : '1';
        $appDetail->save();

        return redirect()->back()->with('success','Status updated');
    }

    public function template(Request $request, $id){
        $appDetail = App::where('id',$id)->first();
        if(empty($appDetail)){
            return redirect()->route('dashboard.index')->with('error','Not valid request');
        }
        $pageTitle = $appDetail->appName.' Template';
        $templateColor = Template::where('app_id',$id)->first();
        if($request->isMethod('post')){
            $templateColor->bodyBg = $request->bodyBg;
            $templateColor->headerTextColor = $request->headerTextColor;
            $templateColor->headerButtonBg = $request->headerButtonBg;
            $templateColor->headerButtonColor = $request->headerButtonColor;
            $templateColor->NotificationBg = $request->NotificationBg;
            $templateColor->notificationText = $request->notificationText;
            $templateColor->offerBg = $request->offerBg;
            $templateColor->offerBgInner = $request->offerBgInner;
            $templateColor->offerText = $request->offerText;
            $templateColor->offerInfoBg = $request->offerInfoBg;
            $templateColor->offerInfoText = $request->offerInfoText;
            $templateColor->offerInfoBorder = $request->offerInfoBorder;
            $templateColor->offerButtonBg = $request->offerButtonBg;
            $templateColor->offerButtonText = $request->offerButtonText;
            $templateColor->footerText = $request->footerText;
            $templateColor->save();
            return redirect()->back()->with('success','Template updated successfully');
        }
        return view('apps.template',compact('pageTitle','templateColor','appDetail'));
    }

    public function documentations(){
        $pageTitle = 'Documentations';
        return view('apps.documentations',compact('pageTitle'));
    }

    public function testPostback(){
        $pageTitle = 'Test-Postback';
        return view('apps.test-postback',compact('pageTitle'));
    }

    public function invoices(){
        $pageTitle = 'Invoices';
        $allAffiliates = User::where('role', 'affiliate')
        ->where('status', 1)
        ->whereHas('trackings', function ($query) {
            $query->where('revenue', '>', 0);
        })
        ->with(['trackings' => function ($query) {
            $query->where('revenue', '>', 0);
        }])
        ->get();
        return view('apps.invoices',compact('pageTitle','allAffiliates'));
    }

    public function paymentDetails($id){
        $pageTitle = 'Payment Details';
        $paymentDetails = PaymentMethod::where('user_id',$id)->get();
        $userDetails = User::find($id);
        return view('apps.payment-details',compact('pageTitle','paymentDetails','userDetails'));
    }

    public function createInvoice(Request $request){
        $pageTitle = 'Create Invoice';
        $allAffiliates = User::where('role', 'affiliate')
        ->where('status', 1)
        ->whereHas('trackings', function ($query) {
            $query->where('revenue', '>', 0);
        })
        ->with(['trackings' => function ($query) {
            $query->where('revenue', '>', 0);
        }])
        ->get();

        $requestedParams = $request->all();
        $allStatistics = collect();
        if(!empty($requestedParams['range']) && !empty($requestedParams['affiliate_id'])){
            $trackingStats = Tracking::query();

            //Adding Date Query
            $separateDate = explode('-', $requestedParams['range']);
            $requestedParams['strd'] = trim($separateDate[0]);
            $requestedParams['endd'] = trim($separateDate[1]);
            $startDate = date('Y-m-d 00:00:00', strtotime(trim($separateDate[0])));
            $endDate = date('Y-m-d 23::59:59', strtotime(trim($separateDate[1])));
            $trackingStats->whereBetween('click_time', [$startDate, $endDate]); 

            //Adding Affiiate condition
            $trackingStats->where('user_id', $requestedParams['affiliate_id']);

            //Merging all stats together
            $matchCount = $trackingStats->count();
            if ($matchCount > 0) {
                $allStatistics = $trackingStats->selectRaw("
                    COUNT(*) as total_click,
                    COUNT(CASE WHEN conversion_id IS NOT NULL AND status=1 THEN 1 END) as total_conversions,
                    SUM(revenue) as total_revenue,
                    SUM(payout) as total_payout
                ")->get();
            } else {
                $allStatistics = collect(); // or set it to null or default values
            }
            $allStatistics = $trackingStats->get();
            
        }

        return view('apps.create-invoice',compact('pageTitle','allAffiliates','allStatistics','requestedParams'));
    }

    public function invoicePreview(){
        $pageTitle = 'Invoice preview';
       
        return view('apps.add-invoice',compact('pageTitle'));
    }

     public function preview()
    {
        return view('invoices.show');
    }

    // Download invoice as PDF using mPDF
    public function download()
    {
        $html = view('invoices.show')->render();

        $mpdf = new Mpdf(['default_font' => 'dejavusans']);
        $mpdf->WriteHTML($html);

        return response($mpdf->Output("Invoice_.pdf", 'S'), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="Invoice_.pdf"');
    }
}
