<?php

use App\Http\Controllers\Dashboard\Customer\PurchaseHistoryController;
use App\Http\Controllers\Dashboard\Customer\VirtualCardController;
use App\Http\Controllers\Dashboard\DashController;
use App\Http\Controllers\Dashboard\Membership\MembersController;
use App\Http\Controllers\Dashboard\Membership\PlanController;
use App\Http\Controllers\Dashboard\Membership\QrCodeController;
use App\Http\Controllers\Dashboard\Settings\AccountController;
use App\Http\Controllers\Dashboard\Settings\SystemController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\Vendor\DetailsController;
use App\Http\Controllers\Dashboard\Vendor\ListController;
use App\Http\Controllers\Dashboard\Vendor\SettingController;
use App\Http\Controllers\SlugController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('landing.index');
});

Route::prefix('vCard')->controller(SlugController::class)->group(function () {
    Route::get('/{slug?}', 'index')->name('slug');
});

Route::post('/share', 'SlugController@share')->name('share');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified', 'userstatus'])->group(function () {

    Route::prefix('account')->controller(AccountController::class)->group(function() {
        Route::get('/', 'index')->name('account');
        Route::post('update', 'update')->name('account-update');
        Route::post('reset_password', 'reset_password')->name('account-reset_password');
        Route::post('upload', 'upload')->name('account-upload');
    });

    Route::prefix('dashboard')->group(function() {

        Route::get('/', [DashController::class, 'index'])->name('dashboard');

        Route::prefix('system')->controller(SystemController::class)->group(function() {
            Route::get('/', 'index')->name('system');
            Route::post('logo', 'logo')->name('logo');
            Route::post('favicon', 'favicon')->name('favicon');
            Route::post('brand', 'brand')->name('system-brand');
            Route::post('mailsetup', 'mailsetup')->name('system-mail');
        });

        Route::prefix('users')->controller(UserController::class)->group(function() {
            Route::get('/', 'index')->name('users');
            Route::post('create', 'store')->name('create-user');
            Route::post('update', 'update')->name('user_update');
            Route::post('user_status', 'user_status')->name('user_status');
            Route::post('user_ban', 'user_ban')->name('user_ban');
            Route::post('destroy', 'destroy')->name('user_delete');
        });
        
        Route::prefix('plan')->controller(PlanController::class)->group(function() {
            Route::get('/', 'index')->name('plans');
            Route::post('create', 'store')->name('create-plan');
            Route::post('update', 'update')->name('update-plan');
            Route::post('status', 'status')->name('status-plan');
            Route::post('delete', 'destroy')->name('delete-plan');
        });
        
        Route::prefix('customer')->controller(MembersController::class)->group(function() {
            Route::get('/', 'index')->name('customer');
            Route::post('create', 'store')->name('create-customer');
            Route::post('update', 'update')->name('update-customer');
            // Route::post('status', 'status')->name('status-plan');
            Route::post('delete', 'destroy')->name('delete-customer');
            
            Route::prefix('virtualcard')->controller(VirtualCardController::class)->group(function() {
                Route::get('/', 'index')->name('virtual-card');
                Route::post('create', 'store')->name('create-card');
                Route::post('update', 'update')->name('update-card');
                Route::post('status', 'status')->name('status-card');
                Route::post('plan', 'plan')->name('plan-card');
                Route::post('delete', 'destroy')->name('delete-card');
            });
                            
            Route::prefix('purchase')->controller(PurchaseHistoryController::class)->group(function() {
                Route::get('/', 'index')->name('purchase-history');
                Route::post('vendordetails', 'vendordetails')->name('vendordetails-purchase');
                Route::post('create', 'store')->name('create-purchase');
                Route::post('update', 'update')->name('update-purchase');
                Route::post('delete', 'destroy')->name('delete-purchase');
            });
            
        });
        
        Route::prefix('qr-code')->controller(QrCodeController::class)->group(function() {
            Route::get('/', 'index')->name('qr-code');
            Route::post('contact', 'update_contact')->name('qr-contact');
            Route::post('social', 'social_link')->name('qr-social');
            Route::post('qrsize', 'qr_size')->name('qr-size');
            Route::post('theme', 'theme')->name('qr-theme');
            Route::post('email', 'sendEmail')->name('qr-email');
        });

        /** Vendor */
        Route::prefix('vendor')->group(function() {
            Route::prefix('list')->controller(ListController::class)->group(function() {
                Route::get('/', 'index')->name('vendor-list');
                Route::post('create', 'store')->name('vendor-store');
                Route::post('update', 'update')->name('vendor-update');
                Route::post('delete', 'destroy')->name('vendor-delete');
            });
            Route::prefix('details')->controller(DetailsController::class)->group(function() {
                Route::get('/', 'index')->name('vendor-details');
                Route::post('create', 'store')->name('vendor-details-store');
                Route::post('update', 'update')->name('vendor-details-update');
                Route::post('delete', 'destroy')->name('vendor-details-delete');
            });
            Route::prefix('settings')->controller(SettingController::class)->group(function() {
                Route::get('/', 'index')->name('vendor-settings');
                Route::post('store', 'store')->name('vendor-settings-store');
                Route::post('update', 'update')->name('vendor-settings-update');
                Route::post('delete', 'destroy')->name('vendor-settings-delete');
            });
        });
        
    });

});

require __DIR__.'/auth.php';
