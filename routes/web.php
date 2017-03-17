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



Auth::routes();

Route::get('/home', 'HomeController@index');

Route::group(['middleware' => ['auth']], function (){
    Route::get('/auth_user_data', function (){
        return Auth::User();
    });
    Route::get('/get_unread',function(){
       return Auth::user()->unreadNotifications;
    });
    Route::get('/check_friendship_status/{id}', 'FriendshipController@statusCheck');
    Route::post('/friend_request/{id}', 'FriendshipController@create');
    Route::post('/friend_response/{id}', 'FriendshipController@update');
    Route::post('/cancel_request/{id}', 'FriendshipController@cancel');
    Route::post('/delete_friend/{id}', 'FriendshipController@fight');
    Route::post('/create/post', 'PostController@create');
    Route::post('/create/wall/post', 'PostController@wallPost');
    Route::get('/wall/posted/notify', 'PostController@forwardToFriend');
    Route::get('/get/friend/post', 'FeedController@index');
    Route::get('/get/wall/post/{id}', 'FeedController@feedOnWall');
    Route::post('/like/{id}', 'LikeController@like');
    Route::post('/unlike/{id}', 'LikeController@unlike');
    Route::get('/', 'HomeController@index');
    Route::get('/{profileId}', 'ProfileController@profile')->name('profile');
});


Auth::routes();

