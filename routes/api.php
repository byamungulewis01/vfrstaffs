<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::controller(UserController::class)->name('api.')->group(function () {
    Route::get('/', 'usersApi')->name('users');
});

Route::controller(ApiController::class)->name('api.')->group(function () {
    Route::get('/incomeExpence', 'incomeExpence')->name('incomeExpence');
    Route::get('/monthly-incomeExpence', 'monthlyIncomeExpence')->name('monthlyIncomeExpence');
    Route::get('/savings', 'savings')->name('savings');
    Route::get('/savingsMember', 'savingsMember')->name('savingsMember');
    Route::get('/loanMembers', 'loanMembers')->name('loanMembers');
});
