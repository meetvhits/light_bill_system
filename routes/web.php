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
        // Route::get('editbillcharge', [BillChargeController::class, 'edit'])->name('editbillcharge');
        // Route::post('updatebillcharge/{id}', [BillChargeController::class, 'update'])->name('updatebillcharge');
    });
    // Route::get('billcharge', [BillChargeController::class, 'index'])->name('billcharge');
    // Route::get('addbillcharge', [BillChargeController::class, 'create'])->name('addbillcharge');
    // Route::post('storebillcharge', [BillChargeController::class, 'store'])->name('storebillcharge');
    // Route::get('editbillcharge', [BillChargeController::class, 'edit'])->name('editbillcharge');
    // Route::post('updatebillcharge/{id}', [BillChargeController::class, 'update'])->name('updatebillcharge');
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
