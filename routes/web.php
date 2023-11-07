<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Laravel did this after run 'composer require laravel/ui:^1.0 --dev'
// This will automatically create session method like login/register
Auth::routes();

// Route for root
Route::get('/', function () {
  if (Auth::check()) {
    return view('dashboards.index'); // if login session created will render dashboard/index view
  } else {
    return view('auth.login'); // if not logged in will render auth/login view
  }
});

Route::namespace('App\Http\Controllers')->group(function () {
  Route::get('lang/change', 'LanguageController@change')->name('lang.change');
  Route::get('dashboard', 'HomeController@index')->name('home');
});
