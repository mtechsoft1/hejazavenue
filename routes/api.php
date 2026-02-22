<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MainController;

/*
|--------------------------------------------------------------------------
| API Routes (Laravel 11 style – class-based)
|--------------------------------------------------------------------------
*/

// Auth
Route::post('/signup', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/update_profile_image', [AuthController::class, 'update_profile_image']);
Route::post('/update_profile', [AuthController::class, 'update_profile']);
Route::post('/forgot_password', [AuthController::class, 'forgot_password']);
Route::post('/verify_code', [AuthController::class, 'verify_code']);
Route::post('/reset_password', [AuthController::class, 'reset_password']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::post('/change_password', [AuthController::class, 'change_password']);
Route::post('/login_with_facebook', [AuthController::class, 'login_with_facebook']);
Route::post('/login_with_google', [AuthController::class, 'login_with_google']);
Route::post('/login_with_apple', [AuthController::class, 'login_with_apple']);

// Main / app
Route::post('/user_profile', [MainController::class, 'user_profile']);
Route::get('/home_screen', [MainController::class, 'home_screen']);
Route::post('/search_tours', [MainController::class, 'search_tours']);
Route::post('/book_tour', [MainController::class, 'book_tour']);
Route::post('/my_tours', [MainController::class, 'my_tours']);
Route::post('/notification_list', [MainController::class, 'notification_list']);
Route::post('/create_tour', [MainController::class, 'create_tour']);
Route::post('/edit_tour', [MainController::class, 'edit_tour']);
Route::get('/delete_tour/{id}', [MainController::class, 'delete_tour']);
Route::get('/get_destinations', [MainController::class, 'get_destinations']);
Route::post('/agent_tours', [MainController::class, 'agent_tours']);
Route::post('/provider_profile', [MainController::class, 'provider_profile']);
Route::post('/cancel_booking', [MainController::class, 'cancel_booking']);
Route::post('/upload_in_gallary', [MainController::class, 'upload_in_gallary']);
Route::post('/submit_review', [MainController::class, 'submit_review']);

// Bookings
Route::get('/my_bookings/{user_id}', [MainController::class, 'my_bookings']);
Route::get('/tour_bookings/{id}', [MainController::class, 'tour_bookings']);
Route::get('/delete_booking/{id}', [MainController::class, 'delete_booking']);
Route::get('/update_booking_status/{booking_id}/{booking_status}', [MainController::class, 'update_booking_status']);
