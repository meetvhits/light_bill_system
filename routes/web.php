<?php

use App\Http\Controllers\BillChargeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LightBillController;
use App\Http\Controllers\UnitRangeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('login');
});
Route::post('loginstore', [UserController::class, 'loginstore'])->name('loginstore')->middleware('loginAlready');
Route::get('logout', [UserController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'weblogin'], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Customer
    Route::controller(CustomerController::class)->group(function () {
        Route::resource('customer', CustomerController::class);
        Route::get('deletecustomer/{id}', 'destroy')->name('deletecustomer');
    });

    // UnitRange
    Route::controller(UnitRangeController::class)->group(function () {
        Route::resource('unitrange', UnitRangeController::class);
        Route::post('storeOrUpdate', 'storeOrUpdate')->name('storeOrUpdate');
        Route::get('deleteunitrange/{id}', 'destroy')->name('deleteunitrange');
    });

    // BillCharge
    Route::controller(BillChargeController::class)->group(function () {
        Route::resource('billcharge', BillChargeController::class);
    });

    // LightBill
    Route::controller(LightBillController::class)->group(function () {
        Route::resource('lightbill', LightBillController::class);
        Route::get('deletelightbill/{id}', [LightBillController::class, 'destroy'])->name('deletelightbill');
    });
});
