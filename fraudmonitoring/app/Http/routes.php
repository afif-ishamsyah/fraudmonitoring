<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('loginform','HomeController@loginform');
Route::post('login','HomeController@login');
Route::get('logout','HomeController@logout');

	//fungsi admin
Route::get('admin','HomeController@admin');
Route::get('userform','HomeController@userform');
Route::get('paramform','HomeController@paramform');
Route::get('edituserform','HomeController@edituserform');
Route::post('register','HomeController@register');
Route::post('edituser','HomeController@edituser');
Route::post('addcaseparam','HomeController@addcaseparam');
Route::post('addactparam','HomeController@addactparam');
Route::get('/','HomeController@home');
//fungsi user
Route::get('user','HomeController@user');
Route::get('search','HomeController@search');
Route::get('searchnumber','HomeController@searchnumber');
Route::get('searchdate','HomeController@searchdate');
Route::get('searcham','HomeController@searcham');
Route::get('searchcustomer','HomeController@searchcustomer');
Route::post('insert','HomeController@insertcase');
Route::get('caseform','HomeController@caseform');
Route::get('listprofile','HomeController@editprofile');
Route::get('editingprofile/{id1}','HomeController@editingprofile');
Route::post('editingprofileprocess','HomeController@editingprofileprocess');
	//Route::get('case/{id1}','HomeController@case');
Route::post('addactivity','HomeController@addactivity');
Route::get('cases/{id1}',[
   'as' => 'closed',
   'uses' => 'HomeController@cases'
]);
Route::get('getact/{filename}','HomeController@getact');
Route::get('getcase/{filename}','HomeController@getcase');

