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
    return view('welcome');
});

Route::get('/works',[WorkController::class,'form'])->middleware('auth');
Route::post('/works',[WorkController::class,'saveWork'])->middleware('auth');
Route::get('/promotions',[PromotionController::class,'form'])->middleware('auth');
Route::post('/promotions',[PromotionController::class,'savePromotion'])->middleware('auth');
Route::get('/pending15',[Pending15Controller::class,'index'])->middleware('auth');
Route::post('/pending15',[Pending15Controller::class,'add'])->middleware('auth');
Route::delete('/pending15/{id}',[Pending15Controller::class,'delete'])->middleware('auth');
Route::get('/dashboard',[DashboardController::class,'get'])->middleware('auth');
Route::post('/dashboard',[DashboardController::class,'find'])->middleware('auth');
Route::get('/ifa-dashboard',[IFADashboardController::class,'get'])->middleware('auth');
Route::post('/ifa-dashboard',[IFADashboardController::class,'find'])->middleware('auth');
Route::post('/report',[ReportController::class,'save'])->middleware('auth');
Route::get('/report/{year}/{month}/{section_id?}',[ReportController::class,'getReport'])->name('section_report')->middleware('auth');
Route::get('/bills',[BillController::class,'form'])->middleware('auth');
Route::post('/bills',[BillController::class,'saveBill'])->middleware('auth');
Route::delete('/bills/{id}',[BillController::class,'delete'])->middleware('auth');
Route::get('/uniforms',[UniformController::class,'form'])->middleware('auth');
Route::post('/uniforms',[UniformController::class,'save'])->middleware('auth');
Route::delete('/uniforms/{id}',[UniformController::class,'delete'])->middleware('auth');

Route::get('/references',[ReferenceController::class,'form'])->middleware('auth');
Route::post('/references',[ReferenceController::class,'saveReference'])->middleware('auth');

Route::view('/login', 'login')->name('login');
Route::post('/login', [UserController::class,'authenticate']);
Route::get('/logout', [UserController::class,'logout']);


