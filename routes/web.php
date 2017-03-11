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

Route::get('/home', 'HomeController@index');

Route::group(['middleware' => ['auth']], function (){
    Route::get('/get_unread',function(){
       return Auth::user()->unreadNotifications;
    });
    Route::get('/check_friendship_status/{id}', 'FriendshipController@statusCheck');
    Route::post('/friend_request/{id}', 'FriendshipController@create');
    Route::post('/friend_response/{id}', 'FriendshipController@update');
    Route::post('/cancel_request/{id}', 'FriendshipController@cancel');
    Route::post('/delete_friend/{id}', 'FriendshipController@fight');
    Route::get('/{profileId}', 'ProfileController@profile')->name('profile');
});


Auth::routes();

Route::get('/home', 'HomeController@index');
