<?php

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
    return view('welcome');
});


Route::get('/kyc', 'Kyc\IndexController@kycTest');
//Route::get('/profile1', 'Profile\ProfileController@index');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

/*
Route::get('/help', function () {
    return human_file_size(1024*1024);
});
*/
    
Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', 'RoleController');
    Route::resource('users', 'UserController');
    Route::resource('products', 'ProductController');
    Route::get('step1', 'Profile\ProfileController@step1')->name('step1');
    Route::post('profile_create', 'Profile\ProfileController@profile_create')->name('profile_create');
    Route::get('family_information', 'Profile\ProfileController@family_information')->name('family_information');
    Route::post('family_information_create', 'Profile\ProfileController@family_information_create')->name('family_information_create');

    Route::get('step3', 'Profile\ProfileController@step3')->name('step3');


    Route::post('getpincode', 'Profile\ProfileController@getpincode')->name('getpincode');
});
