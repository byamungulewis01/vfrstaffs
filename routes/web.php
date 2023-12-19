<?php

use App\Http\Controllers\LoanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SavingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IncomeExpenceController;
use App\Http\Controllers\MemberController;

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
        Route::get('/vsa-account', 'vsa_account')->name('vsa_account');
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
        Route::get('/system-history', 'systemHistory')->name('systemHistory');
    });
    Route::controller(UserController::class)->prefix('members')->name('user.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/all', 'all')->name('all');
        Route::get('/inactive', 'inactive')->name('inactive');
        Route::post('/', 'store')->name('store');
        Route::put('/{id}', 'update')->name('update');
        Route::put('/activate/{id}', 'activate')->name('activate');
        Route::put('/disactivate/{id}', 'disactivate')->name('disactivate');
    });

    Route::controller(SavingController::class)->prefix('savings')->name('saving.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/show/{id}', 'show')->name('show');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/members', 'members')->name('members');
        Route::get('/members/{id}', 'showMember')->name('showMember');
        Route::post('/member/saving/{id}', 'memberSaving')->name('memberSaving');
    });

    Route::controller(LoanController::class)->prefix('loans')->name('loan.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::get('/history', 'history')->name('history');
        Route::get('/payment', 'payment')->name('payment');
        Route::post('/payment/store', 'store_payment')->name('store_payment');
        Route::get('/closed', 'loan_closed')->name('loan_closed');
        Route::post('/', 'store')->name('store');
        Route::post('/import', 'import')->name('import');
        Route::get('/show/{id}', 'show')->name('show');

        Route::post('/quick-cover-loan/{id}', 'storeQCL')->name('storeQCL');
        Route::post('/pay-off/{id}', 'storePayOff')->name('storePayOff');
        Route::post('/topup/{id}', 'topup')->name('topup');
        Route::post('/restructure/{id}', 'restructure')->name('restructure');
    });

    Route::controller(IncomeExpenceController::class)->prefix('income-expences')->name('income_expences.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::get('/monthly', 'monthly')->name('monthly');

    });

    Route::controller(ApprovalController::class)->group(function () {
        Route::get('/savings/requests', 'requests')->name('saving.requests');
        Route::put('/savings/approve/{id}', 'approve')->name('saving.approve');
        Route::put('/savings/approve-all', 'approve_all')->name('saving.approve_all');
        Route::put('/savings/reject/{id}', 'reject')->name('saving.reject');
        Route::get('/savings/requests/{id}', 'requestShow')->name('saving.requestShow');

        Route::get('/loans/requests', 'loans')->name('loan.requests');
        Route::put('/loans/approve/{id}', 'loan_approve')->name('loan.approve');
        Route::put('/loans/approve-all', 'loan_approve_all')->name('loan.approve_all');
        Route::put('/loans/reject/{id}', 'loan_reject')->name('loan.reject');

        Route::get('/loans/monthly-requests', 'monthly_request_loans')->name('loan.monthly_request_loans');
        Route::put('/loans/monthly-approve/{id}', 'monthly_loan_approve')->name('loan.monthly_loan_approve');
        Route::put('/loans/monthly-approve-all', 'monthly_loan_approve_all')->name('loan.monthly_loan_approve_all');
        Route::put('/loans/monthly-reject/{id}', 'monthly_loan_reject')->name('loan.monthly_loan_reject');

        Route::get('/loans/restructure', 'restructure')->name('loan.restructure');
        Route::put('/loans/restructure-approve/{id}', 'restructure_approve')->name('loan.restructure_approve');
        Route::put('/loans/restructure-approve-all', 'restructure_approve_all')->name('loan.restructure_approve_all');
        Route::put('/loans/restructure-reject/{id}', 'restructure_reject')->name('loan.restructure_reject');


        Route::get('/income-expense', 'income_expenses')->name('income_expenses');
        Route::put('/income-expense/approve/{id}', 'income_expenses_approve')->name('income_expenses.approve');
        Route::put('/income-expense/approve-all', 'income_expenses_approve_all')->name('income_expenses.approve_all');
        Route::put('/income-expense/reject/{id}', 'income_expenses_reject')->name('income_expenses.reject');
    });

    Route::controller(MemberController::class)->prefix('member')->name('member.')->group(function () {

        Route::get('/savings', 'savings')->name('savings');
        Route::get('/loans', 'loans')->name('loans');
        Route::post('/loans', 'store_loan')->name('store_loan');
        Route::get('/loans/show/{id}', 'show_loan')->name('show_loan');

    });

    Route::get('/logout', function () {
        auth()->logout();
        return redirect()->route('login');
    })->name('logout');
});
