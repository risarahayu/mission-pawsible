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
  Route::get('/dogs/my_dog', 'DogController@my_dog')->name('dog.my_dog');
  Route::get('/dogs/my_dog/list', 'DogController@dog_list')->name('dog.my_dog.list');
  Route::get('/dogs/view_contact/{dog}', 'DogController@view_contact')->name('dogs.view_contact');
  Route::get('/dogs/my_dog/adoption_request', 'DogController@adoption_request')->name('dog.my_dog.adoption_request');
  // Route::get('dog/my_dog_list', 'DogController@DogList')->name('dog_List');
  Route::put('/dogs/{user}/update_contact/{dog}', 'DogController@update_contact')->name('dogs.update_contact');
  Route::resource('dogs', 'DogController');
  Route::get('/dogs/additional_contact/{dog}', 'DogController@additional_contact')->name('dogs.additional_contact');

  //request rescue
  Route::get('/requests/my_dog/list', 'RescueRequestController@dog_list')->name('requests.my_dog.list');
  Route::get('/requests/additional_contact/{request}', 'RescueRequestController@additional_contact')->name('requests.additional_contact');
  Route::get('/requests/view_contact/{request}', 'RescueRequestController@view_contact')->name('requests.view_contact'); // paramater yang ada controller harus sama dengan parameter di route
  Route::resource('requests', 'RescueRequestController');
  Route::put('/requests/{user}/update_contact/{request}', 'RescueRequestController@update_contact')->name('requests.update_contact');
  Route::put('/requests/{request}/rescue', 'RescueRequestController@rescue')->name('requests.rescue');

  //adoption
  Route::get('/adoptions/additional_contact/{adoption}', 'AdoptionController@additional_contact')->name('adoptions.additional_contact');
  Route::get('/adoptions/view_contact/{adoption}', 'AdoptionController@view_contact')->name('adoptions.view_contact');
  Route::resource('adoptions', 'AdoptionController')->except(['create']); // except create mengecualikan route create didalam resource
  Route::put('/adoptions/{user}/update_contact/{adoption}', 'AdoptionController@update_contact')->name('adoptions.update_contact');
  Route::get('/adoptions/create/{dog}', 'AdoptionController@create')->name('adoptions.create'); // menggunakan custom karena memerlukan params dog dialam routenya

  Route::resource('users', 'UserController');

  //Admin
  Route::resource('admins', 'AdminController');
  Route::get('admins/rescuer/{rescuer_id}', 'AdminController@rescuer_detail')->name('admins.rescuer.detail');

});

