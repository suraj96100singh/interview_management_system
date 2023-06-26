<?php

use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Category;
use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\InterviewsController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
// */
// Route::resource('/categories', 'CategoryController')->middleware('auth');
// Route::resource('/users', 'UserController')->middleware('auth');
// Route::resource('/questions', 'QuestionsController');
// Route::resource('/questions', 'QuestionsController');
// Route::resource('/interviewers', 'InterviewsController');
// Route::resource('/quiz', 'QuizController');
// Route::post('/interview/validate', 'InterviewsController@interviewValidate')->name('interview.validate');

// Route::put('/interview/examcalculation/{parameter}', 'InterviewsController@examCalculation')->name('interview.examcalculation');
// $val= session()->previousUrl();

// Route::get('/interview/{id}', 'InterviewsController@examConduct');
// Route::get('/interview/{id}', function(){
//     $InterviewsController=new InterviewsController;
//     $InterviewsController->examConduct(Request $request,$id);

// });




// Route::get('/','InterviewsController@create');

// Route::get('/login','LoginController@login')->middleware('loginCheck');

// Auth::routes();
// Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
Route::get('/','InterviewsController@create');
Route::group(['middleware' => 'pcCheck','after-login-click-back-button'],function(){
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::get('/interview/{id}', 'InterviewsController@examConduct');
Route::put('/interview/examcalculation/{parameter}', 'InterviewsController@examCalculation')->name('interview.examcalculation');
Route::post('/interview/validate', 'InterviewsController@interviewValidate')->name('interview.validate');
Route::resource('/questions', 'QuestionsController');
Route::resource('/interviewers', 'InterviewsController');
Route::resource('/categories', 'CategoryController')->middleware('auth');
Route::resource('/users', 'UserController')->middleware('auth');
});





// Route::get('/emails',function(){
// Mail::to('maheshinfotech01@gmail.com')->send(new WelcomeMail('hiihii'));
// });
// Route::get('/categories', 'CategoryController@changestatus')->name('changestatus');

