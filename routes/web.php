<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\AppsController;

//Users Routes
Route::match(['post','get'],'/',[UsersController::class,'login'])->name('login');
Route::get('/test-postback', [UsersController::class, 'testPostback'])->name('test.pb');
Route::get('/refresh-csrf', function () {
    return response()->json(['token' => csrf_token()]);
});
// Routes with Auth Middleware
Route::middleware('auth')->group(function () {
    Route::get('/logout',[UsersController::class,'logout'])->name('users.logout');
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard.index');

    // Settings
    Route::match(['post','get'],'/profile', [DashboardController::class, 'profile'])->name('profile');
    Route::match(['post','get'],'/template', [DashboardController::class, 'template'])->name('template');
    Route::get('/contact-inquiry', [DashboardController::class, 'inquiry'])->name('inquiry');
    Route::get('/contact-status/{id}', [DashboardController::class, 'contactstatus'])->name('contactstatus');
    Route::get('/delete-contact/{id}', [DashboardController::class, 'deleteContact'])->name('delete-contact');

    // User Management
    Route::get('/affiliates', [UsersController::class, 'affiliates'])->name('admin.users.affiliates');
    Route::post('/add-affiliate', [UsersController::class, 'addAffiliates'])->name('admin.users.addaffiliates');
    Route::get('/update-affiliate-status/{id}', [UsersController::class, 'updateStatus'])->name('admin.affiliate.status');
    Route::match(['post','get'],'/advertiser', [UsersController::class, 'advertisers'])->name('admin.users.advertisers');

    // Reports
    Route::get('/statistics', [ReportsController::class, 'statistics'])->name('admin.report.statistics');
    Route::get('/report-permission', [ReportsController::class, 'permission'])->name('admin.report.permission');
    Route::match(['post','get'],'/featured-offer', [ReportsController::class, 'featuredOffer'])->name('featured.offer');
    Route::match(['post','get'],'/settings', [DashboardController::class, 'settings'])->name('settings');
    Route::post('/export-report', [ReportsController::class, 'exportReport'])->name('report.export');
    Route::get('/getOfferAffiliate', [ReportsController::class, 'getOfferAffiliate'])->name('getOfferAffiliate');

    // Apps
    Route::match(['post','get'],'/app-blocker', [UsersController::class, 'appBlocker'])->name('admin.users.appblocker');
    Route::get('/getAffiliaetApp/{id?}', [ReportsController::class, 'getAffiliaetApp'])->name('getAffiliaetApp');
    Route::get('/apps', [AppsController::class, 'index'])->name('apps.index');
    Route::match(['get','post'],'/add-app/{id}', [AppsController::class, 'add'])->name('apps.add');
    Route::get('/integration/{id}', [AppsController::class, 'integration'])->name('apps.integration');
    Route::get('/update-status/{id}', [AppsController::class, 'updateStatus'])->name('apps.status');
    Route::match(['get','post'],'/template/{id}', [AppsController::class, 'template'])->name('apps.template');
    
    // Chart Data
    Route::get('/chart-data', [ChartController::class, 'chartData'])->name('chart.data');
    Route::get('/chart-profit', [ChartController::class, 'chartDataProfit'])->name('chart.profit');
    Route::get('/filterGroup/{type?}', [ReportsController::class, 'filterGroup'])->name('filterGroup');
});
