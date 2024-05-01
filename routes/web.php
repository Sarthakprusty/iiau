<?php

use App\Http\Controllers\BillController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IFADashboardController;
use App\Http\Controllers\Pending15Controller;
use App\Http\Controllers\ReferenceController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UniformController;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

Route::get('/works',[WorkController::class,'form'])->middleware('auth')->name('works');;
Route::post('/works',[WorkController::class,'saveWork'])->middleware('auth')->name('work.save');
Route::delete('/works/{id}',[WorkController::class,'delete'])->middleware('auth')->name('work.dlt');
Route::get('/promotions',[PromotionController::class,'form'])->middleware('auth')->name('promotions');;
Route::post('/promotions',[PromotionController::class,'savePromotion'])->middleware('auth')->name('promotion.save');
Route::delete('/promotions/{id}',[PromotionController::class,'delete'])->middleware('auth')->name('promotion.dlt');
Route::get('/pending15',[Pending15Controller::class,'index'])->middleware('auth')->name('pending15');;
Route::post('/pending15',[Pending15Controller::class,'add'])->middleware('auth')->name('pending15.save');
Route::delete('/pending15/{id}',[Pending15Controller::class,'delete'])->middleware('auth')->name('pending15.dlt');
Route::get('/dashboard',[DashboardController::class,'get'])->middleware('auth');
Route::post('/dashboard',[DashboardController::class,'find'])->middleware('auth')->name('dashboard.find');
Route::get('/ifa-dashboard',[IFADashboardController::class,'get'])->middleware('auth')->name('ifa-dashboard');;
Route::post('/ifa-dashboard',[IFADashboardController::class,'find'])->middleware('auth')->name('ifaDashboard.find');
Route::post('/report',[ReportController::class,'save'])->middleware('auth')->name('report.save');;
Route::get('/report/{year}/{month}/{section_id?}',[ReportController::class,'getReport'])->name('section_report')->middleware('auth');
Route::get('/bills',[BillController::class,'form'])->middleware('auth')->name('bills');;
Route::post('/bills',[BillController::class,'saveBill'])->middleware('auth')->name('bill.save');
Route::delete('/bills/{id}',[BillController::class,'delete'])->middleware('auth')->name('bill.dlt');
Route::get('/uniforms',[UniformController::class,'form'])->middleware('auth')->name('uniforms');;
Route::post('/uniforms',[UniformController::class,'save'])->middleware('auth')->name('uniform.save');
Route::delete('/uniforms/{id}',[UniformController::class,'delete'])->middleware('auth')->name('uniform.dlt');
Route::get('/references',[ReferenceController::class,'form'])->middleware('auth')->name('references');;
Route::post('/references',[ReferenceController::class,'saveReference'])->middleware('auth')->name('references.save');
Route::delete('/references/{id}',[ReferenceController::class,'delete'])->middleware('auth')->name('references.dlt');

Route::view('/login', 'login')->name('login');
Route::post('/login', [UserController::class,'authenticate']);
Route::get('/logout', [UserController::class,'logout'])->name('logout');


