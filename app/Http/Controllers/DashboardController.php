<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\App;
use App\Models\Contact;
use App\Models\Template;
use App\Models\Setting;
use App\Models\Tickets;
use App\Models\Tracking;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index(Request $request){
        $pageTitle = 'Dashboard';
        if(!isset($request->range)){
            return redirect()->route('admin.dashboard.index',['range'=> date('m/d/Y', strtotime('-6 days')).' - '.date('m/d/Y')]);
        }
        $affiliateOptions = User::where('status',1)->where('role','affiliate')->get();
    
        // Filters
        $requestedParams = [];
        $completeDate = $request->input('range');
        $separateDate = explode('-', $completeDate);
        $requestedParams['strd'] = trim($separateDate[0]);
        $requestedParams['endd'] = trim($separateDate[1]);
        $startDate = date('Y-m-d 00:00:00', strtotime(trim($separateDate[0])));
        $endDate = date('Y-m-d 23::59:59', strtotime(trim($separateDate[1])));
        $affiliateId = $request->input('affiliate_id');
    
        // App Statistics
        $activeApps = Tracking::where('status',1);
        if ($startDate) {
            //$activeApps->whereDate('click_time', '>=', $startDate);
        }
        if ($endDate) {
            //$activeApps->whereDate('click_time', '<=', $endDate);
        }
        if ($affiliateId) {
            //$activeApps->where('user_id', $affiliateId);
        }
        $activeApps = $activeApps->distinct('user_id')->count();
    
        // Affiliate Statistics
        $allAffiliatesCount = Tracking::where('status',1);
        if ($startDate) {
            //$allAffiliatesCount->whereDate('click_time', '>=', $startDate);
        }
        if ($endDate) {
            //$allAffiliatesCount->whereDate('click_time', '<=', $endDate);
        }
        if ($affiliateId) {
            //$allAffiliatesCount->where('user_id', $affiliateId);
        }
        $allAffiliatesCount = $allAffiliatesCount->distinct('app_id')->count();
    
        // Revenue Statistics
        $totalRevenue = Tracking::where('status',1);
        if ($startDate) {
            $totalRevenue->whereDate('click_time', '>=', $startDate);
        }
        if ($endDate) {
            $totalRevenue->whereDate('click_time', '<=', $endDate);
        }
        if ($affiliateId) {
            $totalRevenue->where('user_id', $affiliateId);
        }
        $totalRevenue = $totalRevenue->sum('revenue');
    
        // Payout Statistics
        $totalPayouts = Tracking::where('status',1);
        if ($startDate) {
            $totalPayouts->whereDate('click_time', '>=', $startDate);
        }
        if ($endDate) {
            $totalPayouts->whereDate('click_time', '<=', $endDate);
        }
        if ($affiliateId) {
            $totalPayouts->where('user_id', $affiliateId);
        }
        $totalPayouts = $totalPayouts->sum('payout');
    
        // Conversion Leaderboard
        $affiliateByRevenue = User::where('status', '1')
            ->where('role', 'affiliate')
            ->whereHas('trackings', function ($query) use ($startDate, $endDate, $affiliateId) {
                $query->whereNotNull('conversion_id')->where('status', 1);
                if ($startDate) {
                    $query->whereDate('click_time', '>=', $startDate);
                }
                if ($endDate) {
                    $query->whereDate('click_time', '<=', $endDate);
                }
                if ($affiliateId) {
                    $query->where('user_id', $affiliateId);
                }
            })
            ->withSum(['trackings as trackings_sum_payout' => function ($query) use ($startDate, $endDate, $affiliateId) {
                $query->whereNotNull('conversion_id')->where('status', 1);
                if ($startDate) {
                    $query->whereDate('click_time', '>=', $startDate);
                }
                if ($endDate) {
                    $query->whereDate('click_time', '<=', $endDate);
                }
                if ($affiliateId) {
                    $query->where('user_id', $affiliateId);
                }
            }], 'payout')
            ->withSum(['trackings as trackings_sum_revenue' => function ($query) use ($startDate, $endDate, $affiliateId) {
                $query->whereNotNull('conversion_id')->where('status', 1);
                if ($startDate) {
                    $query->whereDate('click_time', '>=', $startDate);
                }
                if ($endDate) {
                    $query->whereDate('click_time', '<=', $endDate);
                }
                if ($affiliateId) {
                    $query->where('user_id', $affiliateId);
                }
            }], 'revenue')
            ->orderByDesc('trackings_sum_revenue')
            ->get()
            ->map(function ($user) {
                $user->trackings_sum_profit = $user->trackings_sum_revenue - $user->trackings_sum_payout;
                return $user;
            });
        return view('dashboard.index', compact(
            'activeApps',
            'allAffiliatesCount',
            'affiliateOptions',
            'pageTitle',
            'totalRevenue',
            'totalPayouts',
            'affiliateByRevenue',
            'requestedParams'
        ));
    }

    public function template(Request $request){
        $settingsData = Setting::find(1);
        $pageTitle = 'Offerwall Template';
        $templateColor = Template::find(1);
        if($request->isMethod('post')){
            $templateColor->headerBg = $request->headerBg;
            $templateColor->headerMenuBg = $request->headerMenuBg;
            $templateColor->headerActiveBg = $request->headerActiveBg;
            $templateColor->headerActiveTextColor = $request->headerActiveTextColor;
            $templateColor->headerNonActiveTextColor = $request->headerNonActiveTextColor;
            $templateColor->bodyBg = $request->bodyBg;
            $templateColor->offerBg = $request->offerBg;
            $templateColor->offerText = $request->offerText;
            $templateColor->offerButtonBg = $request->offerButtonBg;
            $templateColor->offerButtonText = $request->offerButtonText;
            $templateColor->offerBadgeBg = $request->offerBadgeBg;
            $templateColor->offerBadgeText = $request->offerBadgeText;
            $templateColor->footerBg = $request->footerBg;
            $templateColor->footerText = $request->footerText;
            $templateColor->save();
            return redirect()->back()->with('success','Template updated successfully');
        }
        
        return view('dashboard.template',compact('pageTitle','templateColor','settingsData'));
    }

    public function profile(Request $request){
        $pageTitle = 'Profile';
        $user = User::find(Auth::user()->id);
        if($request->isMethod('post')){
            $validatedData = $request->validate([
                'name'             => 'required|string|max:255',
                'last_name'        => 'required|string|max:255',
                'email'            => 'required|email|max:255|unique:users,email,' . Auth::id(),
                'oldpassword'      => 'nullable|required_with:newpassword|current_password', // Validate old password
                'newpassword'      => 'nullable|min:8|confirmed', // Ensures newpassword matches confirmpassword
            ]);
           
            // Update basic details
            $user->name = $validatedData['name'];
            $user->last_name = $validatedData['last_name'];
            $user->email = $validatedData['email'];

            // Update the password if provided
            if (!empty($validatedData['newpassword'])) {
                $user->password = Hash::make($validatedData['newpassword']);
            }
            $user->save();
            return redirect()->back()->with('success', 'Profile updated successfully!');

        }
        return view('dashboard.profile',compact('user','pageTitle'));
    }

    public function settings(Request $request){
        $pageTitle = 'Settings';
        $settingsData = Setting::find(1);
        if($request->isMethod('post')){
            $settingsData->meta_title = $request->meta_title;
            $settingsData->meta_description = $request->meta_description;
            $settingsData->offer_alias = $request->offer_alias;
            $settingsData->default_description = $request->default_description;
            $settingsData->default_info = $request->default_info;
            $settingsData->support_email = $request->support_email;
            $settingsData->twitter = $request->twitter ?? NULL;
            $settingsData->linkedin = $request->linkedin ?? NULL;
            //$settingsData->facebook = $request->facebook;
            $settingsData->conversion_report = ($request->conversion=='on') ? 1 : 0;
            $settingsData->postback_report = ($request->postback=='on') ? 1 : 0;
            $settingsData->privacy_policy = ($request->privacy_policy=='on') ? 1 : 0;
            $settingsData->blocked_categories = $request->blocked_categories ?? NULL;
            if ($request->hasFile('default_image')) {
                $file = $request->file('default_image');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads'), $filename);
                $settingsData->default_image = env('APP_URL').'/uploads/'.$filename;
            }
            //$settingsData->content = $request->content;
            $settingsData->save();

            return redirect()->back()->with('success','Setting Updated Successfully');
        }
        return view('dashboard.setting',compact('settingsData','pageTitle'));
    }

    public function inquiry(){
        $pageTitle = 'Inquries';
        $allInquries = Contact::orderByDesc('id')->get();
        return view('dashboard.inquiry',compact('allInquries','pageTitle'));
    }

    public function contactstatus($id){
        $details = Contact::find($id);
        if($details->status==0){
            $details->status = 1;
        }else{
            $details->status = 0;
        }
        $details->save();
        return redirect()->back()->with('success', 'Status Updated Successfully!!');
    }

    public function deleteContact($id){
        Contact::find($id)->delete();
        return redirect()->back()->with('success', 'Record Deleted Successfully!!');
    }

    public function tickets(){
        $pageTitle = 'Tickets';

        $tickets = Tickets::with(['tracking:id,offer_name','lastchat:id,ticket_id,created_at,updated_at','user:id,name'])->orderByRaw('CASE WHEN status = 2 THEN 1 ELSE 0 END ASC')
        ->orderBy('updated_at', 'DESC')
        ->get();


        return view('dashboard/tickets',compact('pageTitle','tickets'));
    }
}
