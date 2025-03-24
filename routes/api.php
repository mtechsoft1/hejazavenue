<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Auth Routes
Route::post('/signup', 'Api\AuthController@register');
Route::post('/login', 'Api\AuthController@login');
Route::post('/update_profile_image', 'Api\AuthController@update_profile_image');
Route::post('/update_profile', 'Api\AuthController@update_profile');
Route::post('/forgot_password', 'Api\AuthController@forgot_password');
Route::post('/verify_code', 'Api\AuthController@verify_code');
Route::post('/reset_password', 'Api\AuthController@reset_password');
Route::post('/logout', 'Api\AuthController@logout');
Route::post('/change_password', 'Api\AuthController@change_password');
Route::post('/user_profile', 'Api\MainController@user_profile');
Route::get('/home_screen', 'Api\MainController@home_screen');
Route::post('/search_tours', 'Api\MainController@search_tours');
Route::post('/book_tour', 'Api\MainController@book_tour');
Route::post('/update_profile', 'Api\AuthController@update_profile');
Route::post('/login_with_facebook', 'Api\AuthController@login_with_facebook');
Route::post('/login_with_google', 'Api\AuthController@login_with_google');
Route::post('/login_with_apple', 'Api\AuthController@login_with_apple');
Route::post('/my_tours', 'Api\MainController@my_tours');
Route::post('/notification_list', 'Api\MainController@notification_list');
Route::post('/create_tour', 'Api\MainController@create_tour');
Route::post('/edit_tour', 'Api\MainController@edit_tour');
Route::get('/delete_tour/{id}', 'Api\MainController@delete_tour');
Route::get('/get_destinations', 'Api\MainController@get_destinations');
Route::post('/agent_tours', 'Api\MainController@agent_tours');
Route::post('/provider_profile', 'Api\MainController@provider_profile');
Route::post('cancel_booking', 'Api\MainController@cancel_booking');
Route::post('/upload_in_gallary', 'Api\MainController@upload_in_gallary');
Route::post('/submit_review', 'Api\MainController@submit_review');

// Bookings APIs
Route::get('/my_bookings/{user_id}', 'Api\MainController@my_bookings');
Route::get('/tour_bookings/{id}', 'Api\MainController@tour_bookings');
Route::get('/delete_booking/{id}', 'Api\MainController@delete_booking');
Route::get('/update_booking_status/{booking_id}/{booking_status}', 'Api\MainController@update_booking_status');


