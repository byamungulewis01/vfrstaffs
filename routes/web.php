<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SavingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\DashboardController;

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

Route::group(['middleware' => 'guest'], function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('/', 'index')->name('login');
        Route::post('/', 'login')->name('login.post');
        Route::get('/forgot-password', 'forgotPassword')->name('forgotPassword');
        Route::get('/success', 'success')->name('success');
        Route::post('/forgot-password', 'sendResetLinkEmail')->name('sendResetLinkEmail');
    });
});

Route::group(['middleware' => 'auth'], function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('home');
    });
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'profile')->name('profile');
        Route::put('/change-password', 'changePassword')->name('changePassword');
        Route::put('/change-personal-details', 'changePersonalDetails')->name('changePersonalDetails');
    });
    Route::controller(SettingsController::class)->prefix('settings')->name('setting.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/department', 'storeDepartment')->name('storeDepartment');
        Route::put('/department/{id}', 'updateDepartment')->name('updateDepartment');
        Route::delete('/department/{id}', 'destroyDepartment')->name('destroyDepartment');
        // Loan Settings
        Route::post('/loan-setting', 'storeLoanSetting')->name('storeLoanSetting');
        Route::put('/loan-setting/{id}', 'updateLoanSetting')->name('updateLoanSetting');
        // login history
        Route::get('/login-history', 'loginHistory')->name('loginHistory');
        // system history
        Route::get('/system-history','systemHistory')->name('systemHistory');

    });
    Route::controller(UserController::class)->prefix('members')->name('user.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/active', 'active')->name('active');
        Route::get('/inactive', 'inactive')->name('inactive');
        Route::post('/', 'store')->name('store');
        Route::put('/{id}', 'update')->name('update');
    });

    Route::controller(SavingController::class)->prefix('savings')->name('saving.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/show/{id}', 'show')->name('show');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/members', 'members')->name('members');
        Route::get('/members/{id}', 'showMember')->name('showMember');
    });
    Route::get('/logout', function () {
        auth()->logout();
        return redirect()->route('login');
    })->name('logout');
});
