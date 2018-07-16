<?php

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/profile','UserController@showProfile');
Route::post('/setting',function (){
    return view('setting',['user'=>Auth::user()]);
});
Route::post('/confirmSetting','UserController@setting');
Route::post('/notification',function (){
    return 'notification';
});
Route::post('/showFriends','UserController@showFriends');
Route::post('/addFriend','UserController@addFriend');
Route::post('/replay','UserController@replay');
Route::post('/google',function (){
    return view('google');
});


Route::get('/error',function () {
    return view('error');
});
Route::get('/{username}','UserController@showProfile');
Route::post('/AskQ','UserController@AskQuestion');
Route::post('/addFriends','UserController@showProfile');