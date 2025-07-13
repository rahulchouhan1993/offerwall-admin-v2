<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\App;
use App\Models\PaymentMethod;
use App\Models\User;
use App\Models\Template;
use App\Models\Tracking;
use App\Models\Invoice;
use App\Models\Country;
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
        $appData = App::find($id);
        if($request->isMethod('POST')){
            $appData->appName = $request->appname;
            $appData->appUrl = $request->appurl;
            $appData->currencyName = $request->currencyname;
            $appData->currencyNameP = $request->currencynamep;
            $appData->currencyValue = $request->currencyvalue;
            $appData->rounding = $request->rounding;
            $appData->postback = $request->postback;
            if($appData->save()){
                return redirect()->route('apps.index')->with('success', 'App updated successfully!!');
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

    public function invoices(Request $request){
        $pageTitle = 'Invoices';
        $requestedParams = $request->all();
        $allAffiliates = User::where('role', 'affiliate')
        ->where('status', 1)
        ->whereHas('trackings', function ($query) {
            $query->where('revenue', '>', 0);
        })
        ->with(['trackings' => function ($query) {
            $query->where('revenue', '>', 0);
        }])
        ->get();
        
        $statusArray = [
            'draft' => 0,
            'pending' => 1,
            'paid' => 2
        ];

        $allInvoices = Invoice::query();
        if (!empty($requestedParams['affiliate_id']) && $requestedParams['affiliate_id'] > 0) {
            $allInvoices->where('user_id', $requestedParams['affiliate_id']);
        }

        if (!empty($requestedParams['status'])) {
            $allInvoices->where('status', $statusArray[$requestedParams['status']] ?? null);
        }

        $allInvoices = $allInvoices
            ->where('status', '!=', 4)
            ->with('invoicedetails')
            ->orderBy('id', 'DESC')
            ->get(); // NOW you assign the result

        $allInvoices = $allInvoices->map(function ($invoice) {
            $total = 0; $totalConv = 0;
            foreach ($invoice->invoicedetails as $detail) {
                $priceWithVat = $detail->payout + ($detail->payout * $detail->vat / 100);
                $total += $priceWithVat;
                $totalConv+=$detail->conversion;
            }
            $invoice->total_price = round($total, 2);
            $invoice->total_conversion = $totalConv;
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
        $paymentMethods = PaymentMethod::where('user_id',$id)->first();
        if(empty($paymentMethods)){
            $paymentMethods = new PaymentMethod();
        }
        
        $allCountries = Country::get();
        return view('apps.payment-details',compact('pageTitle','paymentMethods','allCountries','id'));
    }

    public function updateMethod(Request $request, $id=null){
        if($id>0){
            $paymentMethods = PaymentMethod::where('user_id',$id)->first();
            if(empty($paymentMethods)){
                $paymentMethods = new PaymentMethod();
            }
        }else{
            $paymentMethods = new PaymentMethod();
        }
        if($request->isMethod('post')){
            $paymentMethods->user_id = $id; 
            $paymentMethods->payment_method = $request->method;
            
            $paymentMethods->iban = $request->account_number ?? NULL;
            $paymentMethods->routing_number = $request->routing_number ?? NULL;
            $paymentMethods->account_type = $request->account_type ?? NULL;
            if($request->method==1){
                 $paymentMethods->account_name = $request->org_name ?? NULL;
                $paymentMethods->country = $request->country ?? NULL;
                $paymentMethods->city = $request->city ?? NULL;
                $paymentMethods->address = $request->address ?? NULL;
                $paymentMethods->post_code = $request->post_code ?? NULL;
            }elseif($request->method==2){
                $paymentMethods->account_name = $request->org_name_wallet ?? NULL;
                $paymentMethods->country = $request->country_wallet ?? NULL;
                $paymentMethods->city = $request->city_wallet ?? NULL;
                $paymentMethods->address = $request->address_wallet ?? NULL;
                $paymentMethods->post_code = $request->post_code_wallet ?? NULL;
            }elseif($request->method==3){
                $paymentMethods->account_name = $request->org_name_paypal ?? NULL;
                $paymentMethods->country = $request->country_paypal ?? NULL;
                $paymentMethods->city = $request->city_paypal ?? NULL;
                $paymentMethods->address = $request->address_paypal ?? NULL;
                $paymentMethods->post_code = $request->post_code_paypal ?? NULL;
            }
            
            $paymentMethods->wallet_address = $request->wallet_address ?? NULL;
            $paymentMethods->paypal_email = $request->paypal_email ?? NULL;
            $paymentMethods->save();
            return redirect()->route('admin.users.affiliates')->with('success','Payment Method Updated Successfully.');
        }
        die('Okay');
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

        if (!empty($requestedParams['range'])) {
            $trackingStats = Tracking::query();

            // Parse date range
            $separateDate = explode('-', $requestedParams['range']);
            $startDate = date('Y-m-d 00:00:00', strtotime(trim($separateDate[0])));
            $endDate = date('Y-m-d 23:59:59', strtotime(trim($separateDate[1])));
            $trackingStats->whereBetween('click_time', [$startDate, $endDate]);

            // Check if specific affiliate is selected
            if (!empty($requestedParams['affiliate_id']) && $requestedParams['affiliate_id'] > 0) {
                // Filter by selected affiliate
                $trackingStats->where('user_id', $requestedParams['affiliate_id']);

                // Get stats for single affiliate
                $allStatistics = $trackingStats->selectRaw("
                    user_id,
                    COUNT(*) as total_click,
                    COUNT(CASE WHEN conversion_id IS NOT NULL AND status = 1 THEN 1 END) as total_conversions,
                    SUM(revenue) as total_revenue,
                    SUM(payout) as total_payout
                ")->groupBy('user_id')->get();

            } else {
                // Get stats for all affiliates separately
                $allStatistics = $trackingStats->selectRaw("
                    user_id,
                    COUNT(*) as total_click,
                    COUNT(CASE WHEN conversion_id IS NOT NULL AND status = 1 THEN 1 END) as total_conversions,
                    SUM(revenue) as total_revenue,
                    SUM(payout) as total_payout
                ")->groupBy('user_id')->get();
            }

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

        $mpdf = new Mpdf([
            'default_font' => 'dejavusans',
            'tempDir' => storage_path('app/mpdf-temp')
        ]);
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
            $startDate = Carbon::parse(trim($separateDate[0]));
            $endDate = Carbon::parse(trim($separateDate[1]));

            //check if invoice is created
            $missingMonths = [];

            $current = $startDate->copy()->startOfMonth();

            while ($current <= $endDate) {
                $monthStart = $current->copy()->startOfMonth();
                $monthEnd = $current->copy()->endOfMonth();

                // Adjust overlap range
                $rangeStart = $monthStart->greaterThan($startDate) ? $monthStart : $startDate;
                $rangeEnd = $monthEnd->lessThan($endDate) ? $monthEnd : $endDate;
                
                // Now check for invoices in this overlapping range
                $invoiceExists = Invoice::where('user_id', $request->userid)
                ->where(function($query) use ($rangeStart, $rangeEnd) {
                    $query->whereBetween('start_date', [$rangeStart, $rangeEnd])
                        ->orWhereBetween('end_date', [$rangeStart, $rangeEnd]);
                })
                ->exists();

                if ($invoiceExists) {
                    die("Can't create invoice due to overlapping dates");
                }

                $current->addMonth();
            }

            //Last invoice number
            //$lasInvoice = Invoice::whereYear('invoice_date', Carbon::now()->year)->whereMonth('invoice_date', Carbon::now()->month)->orderBy('id', 'DESC')->first();
            $lasInvoice = Invoice::orderBy('id', 'DESC')->first();
            if(empty($lasInvoice)){
                $invoiceNumber = 1000;
            }else{
                $invoiceNumber = $lasInvoice->invoice_number+1;
            }
            $paymentDetails = PaymentMethod::where('user_id',$request->userid)->first();
            if(empty($paymentDetails)){
                die("Affiliate has not added any payment method.");
            }
            $newInvoice = new Invoice();
            $newInvoice->user_id = $request->userid;
            $newInvoice->start_date = $startDate->format('Y-m-d');
            $newInvoice->end_date = $endDate->format('Y-m-d');
            $newInvoice->invoice_number = $invoiceNumber;
            $newInvoice->invoice_date = Carbon::now()->format('Y-m-d');
            $newInvoice->due_date = Carbon::now()->addDays(10);
            $newInvoice->status = 0;
            $newInvoice->payment_method = json_encode($paymentDetails->toArray());
            $newInvoice->save();
            
            if($newInvoice->id>0){
                $newInvoiceDetail = new InvoiceDetail();
                $newInvoiceDetail->invoice_id = $newInvoice->id;
                $newInvoiceDetail->description = "Advertising Services from {$startDate->format('Y-m-d')} to {$endDate->format('Y-m-d')}";
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

    public function invoieeMethod($id){
        $pageTitle = 'Invoice Method Details';
        $invoiceDetails = Invoice::where('id',$id)->first();
        $allCountries = Country::get();
        return view('apps.invoice-method',compact('pageTitle','invoiceDetails','allCountries'));
    }
}
