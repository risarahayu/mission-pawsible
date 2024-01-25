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
    return redirect()->route('home'); // if login session created will render dashboard/index view
  } else {
    return view('auth.login'); // if not logged in will render auth/login view
  }
});

Route::namespace('App\Http\Controllers')->group(function () {
  Route::get('lang/change', 'LanguageController@change')->name('lang.change');
  Route::get('dashboard', 'HomeController@index')->name('home');

  //Choose Role
  Route::get('/role/{role}', 'RoleController@set_role')->name('role.set');
  Route::get('/role', 'RoleController@index')->name('role.index');

  //dog
  Route::get('dogs/my_dog', 'DogController@my_dog')->name('dog.my_dog');
  Route::get('dogs/my_dog/list', 'DogController@dog_list')->name('dog.my_dog.list');
  Route::get('dogs/my_dog/adoption_request', 'DogController@adoption_request')->name('dog.my_dog.adoption_request');
  // Route::get('dog/my_dog_list', 'DogController@DogList')->name('dog_List');
  Route::resource('dogs', 'DogController');

  //request rescue
  Route::resource('requests', 'RescueRequestController');
  Route::put('/requests/{request}/rescue', 'RescueRequestController@rescue')->name('requests.rescue');

  //adoption
  Route::resource('adoptions', 'AdoptionController')->except(['create']); // except create mengecualikan route create didalam resource
  Route::get('/adoptions/create/{dog}', 'AdoptionController@create')->name('adoptions.create'); // menggunakan custom karena memerlukan params dog dialam routenya

  Route::get('/users/view_contact', 'UserController@view_contact')->name('users.view_contact');
  Route::resource('users', 'UserController');

});

