<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\App;
use App\Models\PaymentMethod;
use App\Models\User;
use App\Models\Template;
use App\Models\Tracking;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use Illuminate\Http\Request;
use Mpdf\Mpdf;
use Carbon\Carbon;
use stdClass;
use Illuminate\Support\Facades\DB;

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

        $allInvoices = Invoice::where('status','!=',4)->with('invoicedetails')->orderBy('id','DESC')->get();

        $allInvoices = $allInvoices->map(function ($invoice) {
            $total = 0;
            foreach ($invoice->invoicedetails as $detail) {
                $priceWithVat = $detail->payout + ($detail->payout * $detail->vat / 100);
                $total += $priceWithVat;
            }
            $invoice->total_price = round($total, 2); // add a dynamic property
            return $invoice;
        });

        $cardData = DB::table('invoices')
        ->join('invoice_details', 'invoices.id', '=', 'invoice_details.invoice_id')
        ->select(
            'invoices.status',
            DB::raw('COUNT(DISTINCT invoices.id) as total_invoices'),
            DB::raw('SUM(CASE WHEN invoice_details.vat > 0 THEN invoice_details.payout + (invoice_details.payout * invoice_details.vat / 100) ELSE invoice_details.payout END) as total_payout_with_vat')
        )
        ->whereIn('invoices.status', [1, 2])
        ->groupBy('invoices.status')
        ->get();
        return view('apps.invoices',compact('pageTitle','allAffiliates','allInvoices','cardData'));
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

    public function invoicePreview($invoiceId){
        $pageTitle = 'Invoice preview';
        $invoiceDetails = Invoice::where('id',$invoiceId)->with('invoicedetails','user')->first();
        return view('apps.add-invoice',compact('pageTitle','invoiceDetails'));
    }

     public function preview()
    {
        return view('invoices.show');
    }

    // Download invoice as PDF using mPDF
    public function download($id)
    {   
        $invoiceDetails = Invoice::where('id',$id)->with('invoicedetails','user')->first();
        $html = view('invoices.show',compact('invoiceDetails'))->render();

        $mpdf = new Mpdf(['default_font' => 'dejavusans']);
        $mpdf->WriteHTML($html);

        return response($mpdf->Output("Invoice_{$id}.pdf", 'I'), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="Invoice_.pdf"');
    }

    public function invoiceCreate(Request $request){
        if($request->isMethod('post')){
            //serialize date
            $requestedParams = [];
            $separateDate = explode('-', $request->daterange);
            $requestedParams['strd'] = trim($separateDate[0]);
            $requestedParams['endd'] = trim($separateDate[1]);
            $startDate = date('Y-m-d', strtotime(trim($separateDate[0])));
            $endDate = date('Y-m-d', strtotime(trim($separateDate[1])));

            //Last invoice number
            $lasInvoice = Invoice::orderBy('id','DESC')->first();
            if(empty($lasInvoice)){
                $invoiceNumber = 1000;
            }else{
                $invoiceNumber = $lasInvoice->invoice_number+1;
            }
            $newInvoice = new Invoice();
            $newInvoice->user_id = $request->userid;
            $newInvoice->start_date = $startDate;
            $newInvoice->end_date = $endDate;
            $newInvoice->invoice_number = $invoiceNumber;
            $newInvoice->invoice_date = Carbon::now()->format('Y-m-d');
            $newInvoice->due_date = Carbon::now()->addDays(7);
            $newInvoice->status = 0;
            $newInvoice->save();
            
            if($newInvoice->id>0){
                $newInvoiceDetail = new InvoiceDetail();
                $newInvoiceDetail->invoice_id = $newInvoice->id;
                $newInvoiceDetail->description = "Advertising Services for {$startDate} to {$endDate}";
                $newInvoiceDetail->conversion = $request->conversion;
                $newInvoiceDetail->payout = $request->payout;
                $newInvoiceDetail->vat = 0;
                $newInvoiceDetail->item_type = 0;
                $newInvoiceDetail->save();
            }

            echo $newInvoice->id;die;
        }
       echo 0; die;
    }

    public function updateInvoice(Request $request){
        if($request->isMethod('POST')){
            foreach($request['items'] as $k => $v){
                if($v['rec_id']>0){
                    $newInvoiceDetail = InvoiceDetail::find($v['rec_id']);
                }else{
                    $newInvoiceDetail = new InvoiceDetail();
                }
                
                $newInvoiceDetail->invoice_id = $request['invoice_id'];
                $newInvoiceDetail->description = $v['description'];
                $newInvoiceDetail->conversion = $v['conversion'];
                $newInvoiceDetail->payout = $v['payout'];
                $newInvoiceDetail->vat = ($v['vat']=='' || $v['vat']=='no') ? 0 : $v['vat'];
                $newInvoiceDetail->item_type = 0;
                $newInvoiceDetail->save();
            }
            return redirect()->route('apps.invoices')->with('success','Invoice Updated Successfully.');
        }

    }

    public function deleteInvoice($id){
        $invoice = Invoice::findOrFail($id);
        if($invoice->status==0){
            $invoice = Invoice::with('invoicedetails')->findOrFail($id);
            $invoice->invoicedetails()->delete();
            $invoice->delete();
        }else{
            $invoice->status = 4;
            $invoice->save();
        }
        
        return redirect()->back()->with('success','Invoice Deleted Successfully');
    }

    public function status(Request $request){
        $invoice = Invoice::findOrFail($request->rec_id);
        $invoice->status = $request->status;
        $invoice->save();
        return redirect()->back()->with('success','Invoice Status Updated Successfully');
    }
}
