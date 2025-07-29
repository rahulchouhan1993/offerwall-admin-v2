<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Country;
use App\Models\AppBlocker;
use App\Models\Setting;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewAccountMail;
use Illuminate\Support\Str;

class UsersController extends Controller
{
    public function login(Request $request)
    {
        if($request->isMethod('POST')){
            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);

            $user = User::where('email', $credentials['email'])->first();
            if ($user && $user->status == 0) {
                return redirect()->back()->with('error', 'Your account is inactive. Please contact support.');
            }
     
            if (Auth::attempt($credentials)) {
                if(Auth::user()->role=='admin'){
                    $request->session()->regenerate();
                    return redirect()->route('admin.dashboard.index');
                }
            }
            return redirect()->back()->with('error', 'The provided credentials do not match our records.');
        }
       
        return view('users.login');
    }

    public function affiliates(Request $request){
        
        $advertiserDetails = Setting::find(1);
        $pageTitle = 'Affiliates';
        $userType = $request->status ?? ''; 
        $page = $request->page ?? '1'; 
        $perPage = 25;
        $url = $advertiserDetails->affise_endpoint . "admin/partners?limit={$perPage}&page={$page}&status={$userType}";
        $response = HTTP::withHeaders([
            'API-Key' => $advertiserDetails->affise_api_key,
        ])->get($url);

        if ($response->successful()) {
            $allAffiliates = $response->json();
            $pagination = $allAffiliates['pagination'] ?? []; // Extract pagination data
            $currentPage = $pagination['page'] ?? 1; 
            $totalCount = $pagination['total_count'] ?? 0;
            $prevPage = $pagination['prev_page'] ?? null;
            $nextPage = $pagination['next_page'] ?? null;
        }
        return view('users.affiliate',compact('allAffiliates','userType','pagination','currentPage','totalCount','perPage','prevPage','nextPage','pageTitle'));
    }

    public function addAffiliates(Request $request){
        
        if($request->isMethod('post')){
            if($request->id>0){
                $validateUser = User::where('affiseId',$request->id)->exists();
                if($validateUser){
                    return redirect()->back()->with('error', 'A user with this Affise ID already exists.');
                }else{
                    $validator = Validator::make($request->all(), [
                        'name' => 'required|string|max:255',
                        'email' => 'required|email|unique:users,email',
                    ]);
            
                    if ($validator->fails()) {
                        return redirect()->back()->with('error', $validator->errors());
                    }
                    $fullname = explode(' ',$request->name);
                    $randomPassword = $this->generatePassword();
                    User::create([
                        'unique_id' => rand(),
                        'affiseId' => $request->id,
                        'affise_api_key' => $request->api_key,
                        'name' => $fullname[0] ?? '',
                        'last_name' => $fullname[1] ?? '',
                        'address_1' => $request->address_1 ?? '',
                        'address_2' => $request->address_2 ?? '',
                        'city' => $request->city ?? '',
                        'country' => $request->country ?? '',
                        'zip_code' => $request->zip_code ?? '',
                        'role' => 'affiliate',
                        'email' => $request->email,
                        'api_key' => substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 16),
                        'postback_key' => substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 16),
                        //'password' => Hash::make(rand())
                        'password' =>  Hash::make($randomPassword)
                    ]);
                    $details = [
                        'name' => $request->name,
                        'email' => $request->email,
                        'password' => $randomPassword,
                    ];
                    Mail::to($request->email)->send(new NewAccountMail($details));
                    return redirect()->back()->with('success', 'User added successfully!');
                }
            }else{
                return redirect()->back()->with('error', 'Invalid request');
            }
        }
        return redirect()->back()->with('error', 'Invalid request');
    }

    public function advertisers(Request $request){
        $pageTitle = 'Advertiser';
        $advertiserDetails = Setting::find(1);
        if($request->isMethod('post')){
            $advertiserDetails->advertiser_name = $request->advertiser_name;
            $advertiserDetails->affise_api_key = $request->affise_api_key;
            $advertiserDetails->affise_endpoint = $request->affise_endpoint;
            $advertiserDetails->save();

            return redirect()->back()->with('success','Details updated sucessfully');
        }
        return view('users.advertiser',compact('pageTitle','advertiserDetails'));
    }

    public function updateStatus($id){
        $userDetails = User::find($id);
        if($userDetails->status==0){
            $userDetails->status = 1;
        }else{
            $userDetails->status = 0;
        }
        $userDetails->save();
        return redirect()->back()->with('success', 'Status Updated Successfully!!');
    }

    public function addAdvertisers(){
        
    } 

    public function appBlocker(Request $request){
        $pageTitle = 'Fraud Tools';
        $allCountries = Country::get();
        $blockerDetails = AppBlocker::get()->toArray();
        if($request->isMethod('post')){
            $updateBlocker1 = AppBlocker::find(1);
            $updateBlocker2 = AppBlocker::find(2);
            $updateBlocker3 = AppBlocker::find(3);
            $updateBlocker4 = AppBlocker::find(4);
            $updateBlocker5 = AppBlocker::find(5);

            if(isset($request->vpn) && $request->vpn=='on'){
                $updateBlocker1->enabled = 1;
            }else{
                $updateBlocker1->enabled = 0;
            }
            $updateBlocker1->save();

            if(isset($request->rootdevice) && $request->rootdevice=='on'){
                $updateBlocker2->enabled = 1;
            }else{
                $updateBlocker2->enabled = 0;
            }
            $updateBlocker2->save();

            if(isset($request->developermode) && $request->developermode=='on'){
                $updateBlocker3->enabled = 1;
            }else{
                $updateBlocker3->enabled = 0;
            }
            $updateBlocker3->save();

            if(isset($request->emulator) && $request->emulator=='on'){
                $updateBlocker4->enabled = 1;
            }else{
                $updateBlocker4->enabled = 0;
            }
            $updateBlocker4->save();

            if(isset($request->country) && $request->country=='on' && !empty($request->countryselected)){
                $updateBlocker5->countries = json_encode($request->countryselected);
                $updateBlocker5->enabled = 1;
            }else{
                $updateBlocker5->countries = NULL;
                $updateBlocker5->enabled = 0;
            }
            $updateBlocker5->save();
            
            return redirect()->back()->with('success', 'Record updated successfully.');
        }
        return view('users.blocker',compact('allCountries','blockerDetails','pageTitle'));
    }

    public function logout(Request $request){
        Auth::logout();
 
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/');
    }

    public function testPostback(Request $request){
        $secret = "3cc95b67e3f36332023ac1d4519f9975"; 
        $user_id = isset($_GET['user_id']) ? $_GET['user_id'] : null;
        $click_id = isset($_GET['click_id']) ? $_GET['click_id'] : null;
        $tracking_id = isset($_GET['tracking_id']) ? $_GET['tracking_id'] : null;
        $app_id = isset($_GET['app_id']) ? $_GET['app_id'] : null;
        $signature = isset($_GET['signature']) ? $_GET['signature'] : null;
        $cont = md5($user_id.$click_id.$tracking_id.$app_id.$secret);
        $cont1 = $signature;
        $details = [
            'name' => json_encode($request->all()).'<br>'.$cont.'----'.$cont1 ,
            'email' => 'r.chouhan64@gmail.com',
            'password' => 1111,
        ];
        Mail::to('r.chouhan64@gmail.com')->send(new NewAccountMail($details));
    }

    function generatePassword($length = 12) {
        $upper = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $lower = 'abcdefghijklmnopqrstuvwxyz';
        $numbers = '0123456789';
        $symbols = '!@#$%^&*()-_=+<>?';
        
        $allCharacters = $upper . $lower . $numbers . $symbols;
        
        // Ensure at least one character from each category
        $password = $upper[rand(0, strlen($upper) - 1)] .
                    $lower[rand(0, strlen($lower) - 1)] .
                    $numbers[rand(0, strlen($numbers) - 1)] .
                    $symbols[rand(0, strlen($symbols) - 1)];
        
        // Fill the remaining length with random characters
        for ($i = 4; $i < $length; $i++) {
            $password .= $allCharacters[rand(0, strlen($allCharacters) - 1)];
        }
        
        return str_shuffle($password); // Shuffle to make it random
    }

    public function resync(){
        $advertiserDetails = Setting::find(1);
        $allAffiliates = User::where('role','affiliate')->get();
        if($allAffiliates->isNotEmpty()){
            foreach($allAffiliates as $affiliate){
                $url = $advertiserDetails->affise_endpoint . "admin/partner/{$affiliate->affiseId}";
                $response = HTTP::withHeaders([
                    'API-Key' => $advertiserDetails->affise_api_key,
                ])->get($url);

                if ($response->successful()) {
                    $affilliateDetails = $response->json();
                    if(!empty($affilliateDetails['partner']['name'])){
                        $expname = explode(' ',$affilliateDetails['partner']['name']);
                        if($expname[0]!=''){
                            $affiliate->name = $expname[0];
                        }
                        if($expname[1]!=''){
                            $affiliate->last_name = $expname[1];
                        }
                        if(!empty($expname[2])){
                            $affiliate->last_name.=' '.$expname[2];
                        }
                        if(!empty($expname[3])){
                            $affiliate->last_name.=' '.$expname[3];
                        }
                        
                    }
                    if(!empty($affilliateDetails['partner']['address_1'])){
                        $affiliate->address_1 = $affilliateDetails['partner']['address_1'];
                    }
                    if(!empty($affilliateDetails['partner']['address_2'])){
                        $affiliate->address_2 = $affilliateDetails['partner']['address_2'];
                    }
                    if(!empty($affilliateDetails['partner']['city'])){
                        $affiliate->city = $affilliateDetails['partner']['city'];
                    }
                    if(!empty($affilliateDetails['partner']['country'])){
                        $affiliate->country = $affilliateDetails['partner']['country'];
                    }
                    if(!empty($affilliateDetails['partner']['zip_code'])){
                        $affiliate->zip_code = $affilliateDetails['partner']['zip_code'];
                    }
                    if(!empty($affilliateDetails['partner']['affise_api_key'])){
                        $affiliate->affise_api_key = $affilliateDetails['partner']['affise_api_key'];
                    }
                    $affiliate->save();
                }
            }
            return redirect()->back()->with('success','All affiliates has been re-synced.');
        }
        
        return redirect()->back()->with('error','Something went wrong, please try again.');
    }
}
