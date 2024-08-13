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
    Route::get('customer', [CustomerController::class, 'index'])->name('customer');
    Route::get('addcustomer', [CustomerController::class, 'create'])->name('addcustomer');
    Route::post('storecustomer', [CustomerController::class, 'store'])->name('storecustomer');
    Route::get('editcustomer/{id}', [CustomerController::class, 'edit'])->name('editcustomer');
    Route::post('updatecustomer/{id}', [CustomerController::class, 'update'])->name('updatecustomer');
    Route::get('deletecustomer/{id}', [CustomerController::class, 'destroy'])->name('deletecustomer');

    // UnitRange
    Route::get('unitrange', [UnitRangeController::class, 'index'])->name('unitrange');
    Route::post('storeOrUpdate', [UnitRangeController::class, 'storeOrUpdate'])->name('storeOrUpdate');
    Route::get('addunitrange', [UnitRangeController::class, 'create'])->name('addunitrange');
    Route::post('storeunitrange', [UnitRangeController::class, 'store'])->name('storeunitrange');
    Route::get('editunitrange/{id}', [UnitRangeController::class, 'edit'])->name('editunitrange');
    Route::post('updateunitrange/{id}', [UnitRangeController::class, 'update'])->name('updateunitrange');
    Route::get('deleteunitrange/{id}', [UnitRangeController::class, 'destroy'])->name('deleteunitrange');

    // BillCharge
    // Route::get('billcharge', [BillChargeController::class, 'index'])->name('billcharge');
    // Route::get('addbillcharge', [BillChargeController::class, 'create'])->name('addbillcharge');
    // Route::post('storebillcharge', [BillChargeController::class, 'store'])->name('storebillcharge');
    Route::get('editbillcharge', [BillChargeController::class, 'edit'])->name('editbillcharge');
    Route::post('updatebillcharge/{id}', [BillChargeController::class, 'update'])->name('updatebillcharge');
    // Route::get('deletebillcharge/{id}', [BillChargeController::class, 'destroy'])->name('deletebillcharge');

    // LightBill
     Route::get('lightbill', [LightBillController::class, 'index'])->name('lightbill');
     Route::get('showlightbill/{id}', [LightBillController::class, 'show'])->name('showlightbill');
     Route::get('addlightbill', [LightBillController::class, 'create'])->name('addlightbill');
     Route::post('storelightbill', [LightBillController::class, 'store'])->name('storelightbill');
     Route::get('editlightbill/{id}', [LightBillController::class, 'edit'])->name('editlightbill');
     Route::post('updatelightbill/{id}', [LightBillController::class, 'update'])->name('updatelightbill');
     Route::get('deletelightbill/{id}', [LightBillController::class, 'destroy'])->name('deletelightbill');
});
// portal.dashborad
