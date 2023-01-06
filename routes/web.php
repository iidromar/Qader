<?php

use App\Http\Controllers\Home\HomePageController;
use Illuminate\Support\Facades\Route;
use \App\Http\Middleware\CompanyAdmin;
use \App\Http\Controllers\CompanyAdmin\CompanyAdminController;
use \App\Http\Middleware\InstitAdmin;
use \App\Http\Controllers\CompanyAdmin\InstitAdminController;
use \App\Http\Controllers\InstitAdmin\InstitAuthController;
use \App\Http\Controllers\Employee\EmployeeAuthController;
use \App\Http\Controllers\AuthorizationController;

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


Route::get('/', [HomePageController::class, 'index'])->name('homepage');
Route::get('/gate', [AuthorizationController::class, 'index'])->name('gate')->middleware('can:isCompanyAdmin');

Auth::routes();

Route::group(['middleware'=>'guest'],function(){
Route::get('Institlogin',[InstitAuthController::class,'index'])->name('Institlogin');
Route::post('Institlogin',[InstitAuthController::class,'login'])->name('Institlogin')->middleware('throttle:2,1');

Route::get('Institregister',[InstitAuthController::class,'register_view'])->name('Institregister');
Route::post('Institregister',[InstitAuthController::class,'register'])->name('Institregister')->middleware('throttle:2,1');

Route::get('Employeelogin',[EmployeeAuthController::class,'index'])->name('Employeelogin');
Route::post('Employeelogin',[EmployeeAuthController::class,'login'])->name('Employeelogin')->middleware('throttle:2,1');

Route::get('Employeeregister',[EmployeeAuthController::class,'register_view'])->name('Employeeregister');
Route::post('Employeeregister',[EmployeeAuthController::class,'register'])->name('Employeeregister')->middleware('throttle:2,1');

});

//Route::middleware(['auth', 'CompanyAdmin'])->name('CompanyAdmin.')->prefix('CompanyAdmin')->group(function(){
//    Route::get('/', [CompanyAdminController::class, 'index'])->name('index');
//
//});
//Route::middleware(['auth', 'InstitAdmin'])->name('InstitAdmin.')->prefix('InstitAdmin')->group(function(){
//    Route::get('/', [InstitAdminController::class, 'index'])->name('index');
//});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
