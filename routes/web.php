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

Route::get('/work-report/works',[WorkController::class,'form'])->middleware('auth')->name('works');;
Route::post('/work-report/works',[WorkController::class,'saveWork'])->middleware('auth')->name('work.save');
Route::delete('/work-report/works/{id}',[WorkController::class,'delete'])->middleware('auth')->name('work.dlt');
Route::get('/work-report/promotions',[PromotionController::class,'form'])->middleware('auth')->name('promotions');;
Route::post('/work-report/promotions',[PromotionController::class,'savePromotion'])->middleware('auth')->name('promotion.save');
Route::delete('/work-report/promotions/{id}',[PromotionController::class,'delete'])->middleware('auth')->name('promotion.dlt');
Route::get('/work-report/pending15',[Pending15Controller::class,'index'])->middleware('auth')->name('pending15');;
Route::post('/work-report/pending15',[Pending15Controller::class,'add'])->middleware('auth')->name('pending15.save');
Route::delete('/work-report/pending15/{id}',[Pending15Controller::class,'delete'])->middleware('auth')->name('pending15.dlt');
Route::get('/dashboard',[DashboardController::class,'get'])->middleware('auth');
Route::post('/work-report/dashboard',[DashboardController::class,'find'])->middleware('auth')->name('dashboard.find');
Route::get('/work-report/ifa-dashboard',[IFADashboardController::class,'get'])->middleware('auth')->name('ifa-dashboard');;
Route::post('/work-report/ifa-dashboard',[IFADashboardController::class,'find'])->middleware('auth')->name('ifaDashboard.find');
Route::post('/work-report/report',[ReportController::class,'save'])->middleware('auth')->name('report.save');;
Route::get('/work-report/report/{year}/{month}/{section_id?}',[ReportController::class,'getReport'])->name('section_report')->middleware('auth');
Route::get('/work-report/bills',[BillController::class,'form'])->middleware('auth')->name('bills');;
Route::post('/work-report/bills',[BillController::class,'saveBill'])->middleware('auth')->name('bill.save');
Route::delete('/work-report/bills/{id}',[BillController::class,'delete'])->middleware('auth')->name('bill.dlt');
Route::get('/work-report/uniforms',[UniformController::class,'form'])->middleware('auth')->name('uniforms');;
Route::post('/work-report/uniforms',[UniformController::class,'save'])->middleware('auth')->name('uniform.save');
Route::delete('/work-report/uniforms/{id}',[UniformController::class,'delete'])->middleware('auth')->name('uniform.dlt');
Route::get('/work-report/references',[ReferenceController::class,'form'])->middleware('auth')->name('references');;
Route::post('/work-report/references',[ReferenceController::class,'saveReference'])->middleware('auth')->name('references.save');
Route::delete('/work-report/references/{id}',[ReferenceController::class,'delete'])->middleware('auth')->name('references.dlt');

Route::view('/login', 'login')->name('login');
Route::post('/login', [UserController::class,'authenticate']);
Route::get('/work-report/logout', [UserController::class,'logout'])->name('logout');


