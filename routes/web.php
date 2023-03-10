<?php

use App\Http\Controllers\Employee\EmployeeController;
use App\Http\Controllers\Home\HomePageController;
use Illuminate\Support\Facades\Route;
use \App\Http\Middleware\CompanyAdmin;
use \App\Http\Controllers\CompanyAdmin\CompanyAdminController;
use \App\Http\Middleware\InstitAdmin;
use \App\Http\Controllers\InstitAdmin\InstitAdminController;
use \App\Http\Controllers\InstitAdmin\InstitAuthController;
use \App\Http\Controllers\Employee\EmployeeAuthController;
use \App\Http\Controllers\AuthorizationController;



////new
use \App\Http\Controllers\CompanyAdmin\ResultController;
use \App\Http\Controllers\InstitAdmin\QuestionController;
use \App\Http\Controllers\InstitAdmin\OptionController;
use \App\Http\Controllers\InstitAdmin\TestController;
///new

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
Route::get('/test', [App\Http\Controllers\testController::class, 'test']);
Auth::routes();

//Route::get('/', [HomePageController::class, 'index'])->name('homepage');
Route::get('/gate', [AuthorizationController::class, 'index'])->name('gate')->middleware('can:isCompanyAdmin');

Route::get('/CompanyEmployees', [CompanyAdminController::class, 'all_employees'])->name('all_employees');
Route::get('/CompanyAdminDashboard', [CompanyAdminController::class, 'index'])->name('index');
Route::get('/CompanyAdminEmployee/{id?}', [CompanyAdminController::class, 'employee_progress'])->name('employee_progress');
Route::get('/NewTraining/{id?}', [CompanyAdminController::class, 'give_training'])->name('give_training');
Route::get('/CategoryItems/{cat?}', [CompanyAdminController::class, 'give_items'])->name('give_items');
Route::get('/ItemPrice/{item?}', [CompanyAdminController::class, 'give_price'])->name('give_price');
Route::post('/sendTraining/{id?}', [CompanyAdminController::class, 'new_training_req'])->name('new_training_req');
Route::get('/CourseBrief/{item?}', [CompanyAdminController::class, 'give_brief'])->name('give_brief');
Route::get('/requestSpecialCourse/{e_id?}/{c_id?}', [CompanyAdminController::class, 'request_special_course'])->name('request_special_course');
Route::post('/requestNewCourse/{id?}', [CompanyAdminController::class, 'request_sending'])->name('request_sending');
Route::get('/display_requests/{id?}', [CompanyAdminController::class, 'display_requests'])->name('display_requests');
Route::get('/code/{id?}', [CompanyAdminController::class, 'code'])->name('code');
Route::get('/profile', [CompanyAdminController::class, 'profile'])->name('profile');
Route::get('/changePassword', [CompanyAdminController::class, 'changePassword'])->name('changePassword');
Route::post('/changePasswordSending', [CompanyAdminController::class, 'changePasswordSending'])->name('changePasswordSending');
Route::post('/searchEngine', [CompanyAdminController::class, 'searchEngine'])->name('searchEngine');


Route::get('/createCourse', [InstitAdminController::class , 'create'])->name('Instit.createCourse');
Route::post('/Instit/storeCourse', [InstitAdminController::class , 'store'])->name('Instit.storeCourse');
Route::get('/allCorses', [InstitAdminController::class , 'allCourses'])->name('Instit.allCourses');
Route::get('/Instit/editCorse/{id}' , [InstitAdminController::class , 'edit'])->name('Instit.edit');
Route::PUT('/Instit/updateCourse/{id}' , [InstitAdminController::class , 'update'])->name('Instit.update');
Route::get('/Instit/showCourse/{id}', [InstitAdminController::class , 'show'])->name('Instit.show');
Route::delete('delete/course/{id}' ,  [InstitAdminController::class , 'destroy'])->name('course.destroy');
Route::delete('delete/lesson/{id}' ,  [InstitAdminController::class , 'destroyLesson'])->name('lesson.destroy');
Route::get('/courses_requests', [InstitAdminController::class, 'courses_requests'])->name('courses_requests');
Route::post('/accepting_course', [InstitAdminController::class, 'accepting_course'])->name('accepting_course');
Route::post('/rejecting_course', [InstitAdminController::class, 'rejecting_course'])->name('rejecting_course');
Route::post('/searchEngineCourse', [InstitAdminController::class, 'searchEngine'])->name('searchEngineCourse');
Route::get('/Institprofile', [InstitAdminController::class, 'Institprofile'])->name('Institprofile');
Route::get('/changePasswordInstit', [InstitAdminController::class, 'changePassword'])->name('changePasswordInstit');
Route::post('/changePasswordSendingInstit', [InstitAdminController::class, 'changePasswordSending'])->name('changePasswordSendingInstit');



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


Route::get('calendar/index/{id?}', [EmployeeController::class, 'calendarIndex'])->name('calendar.index');
//Route::get('setCalendar', [CompanyAdminController::class, 'setCalenderIndex'])->name('setCalenderIndex');
//Route::post('calendar', [CompanyAdminController::class, 'store'])->name('calendar.store');
Route::patch('calendar/update/{id}', [EmployeeController::class, 'update'])->name('calendar.update');
Route::delete('calendar/destroy/{id}', [EmployeeController::class, 'destroy'])->name('calendar.destroy');


Route::post('/searchEngineCourseEmployee', [EmployeeController::class, 'searchEngineEE'])->name('searchEngineCourseEmployee');
Route::get('/Employeeprofile', [EmployeeController::class, 'Employeeprofile'])->name('Employeeprofile');
Route::get('/changePasswordEmployee', [EmployeeController::class, 'changePassword'])->name('changePasswordEmployee');
Route::post('/changePasswordSendingEmployee', [EmployeeController::class, 'changePasswordSending'])->name('changePasswordSendingEmployee');



///new
// questions
Route::get('/allQuestion', [QuestionController::class , 'index'])->name('course.question');
Route::get('/createQuestion', [QuestionController::class , 'create'])->name('create.question');
Route::post('/storeQuestion', [QuestionController::class , 'store'])->name('store.question');
Route::post('/editQuestion', [QuestionController::class , 'edit'])->name('edit.question');
Route::PUT('/updateQuestion/{id}' , [QuestionController::class , 'update'])->name('update.question');
Route::delete('/deleteQuestion/{id}' ,  [QuestionController::class , 'destroy'])->name('delete.question');



// results
Route::get('/allResult', [ResultController::class , 'index'])->name('course.result');
Route::delete('/deleteResultn/{id}' ,  [ResultController::class , 'destroy'])->name('delete.Result');
Route::get('/showResult/{id}', [ResultController::class , 'show'])->name('show.Result');

//Employee results
Route::get('/employeeResult', [EmployeeController::class , 'employeeResult'])->name('employee.result');
Route::get('/showEmployeeResult/{id}', [EmployeeController::class , 'showResult'])->name('showEmployee.Result');


Route::get('/test2/{id}',[TestController::class, 'index'])->name('client.test');
Route::post('test',[TestController::class, 'store'])->name('client.test.store');


///new

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [HomePageController::class, 'home'])->name('home.index');
Route::get('/Home/Courses', [HomePageController::class, 'courses'])->name('home.courses');
Route::get('/Home/InstitCompany', [HomePageController::class, 'InstitCompany'])->name('home.InstitCompany');
Route::get('/Home/Company', [HomePageController::class, 'company'])->name('home.company');

Route::get('/employeeAllCourses/{id?}', [EmployeeController::class , 'allCourses'])->name('employee.allCourses');
Route::get('/employeeCourseDetails/{id}', [EmployeeController::class , 'courseDetails'])->name('employee.courseDetails');
//Employee results
Route::get('/employeeResult', [EmployeeController::class , 'employeeResult'])->name('employee.result');
Route::get('/showEmployeeResult/{id}', [EmployeeController::class , 'showResult'])->name('showEmployee.Result');


Route::post('/progress', [EmployeeController::class, 'progressStore'])->name('progress.store');


Route::get('/forgotpasswordEmployees', [EmployeeController::class, 'forgot_passwords'])->name('forgotpasswordEmployees');
Route::get('/forgotpasswordInstits', [InstitAdminController::class, 'forgot_passwords'])->name('forgotpasswordInstits');
Route::get('/forgotpasswordCompanys', [CompanyAdminController::class, 'forgot_passwords'])->name('forgotpasswordCompanys');

Route::post('/forgotpasswordEmployee', [EmployeeController::class, 'forgot_password'])->name('forgotpasswordEmployee');
Route::post('/forgotpasswordInstit', [InstitAdminController::class, 'forgot_password'])->name('forgotpasswordInstit');
Route::post('/forgotpasswordCompany', [CompanyAdminController::class, 'forgot_password'])->name('forgotpasswordCompany');

