<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\App;
use App\Models\Template;
use App\Models\Setting;
use App\Models\Tracking;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index(){
        $pageTitle = 'Dashboard';
        $activeApps = App::where('status',1)->count();
        $allAffiliatesCount = User::where('role','affiliate')->count();
        $totalRevenue = Tracking::where('status',1)->sum('revenue');
        $totalPayouts = Tracking::where('status',1)->sum('payout');

        // affiliate leaderboard
        $affiliateByApp = User::where('status', '1')
            ->where('role', 'affiliate')
            ->whereHas('apps', function ($query) {
                $query->where('status', '1');
            })
            ->withCount(['apps' => function ($query) {
                $query->where('status', '1');
            }])
        ->get();
       
        //conversion leaderboard
        $affiliateByRevenue = User::where('status', '1') // Active users
            ->where('role', 'affiliate') // Only affiliates
            ->whereHas('trackings', function ($query) {
                $query->whereNotNull('conversion_id')->where('status', 1); // Ensure there is a valid conversion
            })
            ->withCount(['trackings' => function ($query) {
                $query->whereNotNull('conversion_id')->where('status', 1); // Count only valid conversions
            }])
            ->withSum(['trackings' => function ($query) {
                $query->whereNotNull('conversion_id')->where('status', 1); // Sum only for valid conversions
            }], 'revenue') // Sum the revenue column
            ->orderByDesc('trackings_sum_revenue') // Sort by highest revenue
        ->get();
    
        $affiliateOptions = User::where('status',1)->where('role','affiliate')->get();
       
        return view('dashboard.index',compact('activeApps','allAffiliatesCount','affiliateOptions','pageTitle','totalRevenue','totalPayouts','affiliateByApp','affiliateByRevenue'));
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
}
