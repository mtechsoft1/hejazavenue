<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TourController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\User\NavigationController as UserNavigationController;
use App\Http\Controllers\User\AllinOneController;
use App\Http\Controllers\Admin\NavigationController as AdminNavigationController;
use App\Http\Controllers\Admin\AllUsersController;
use App\Http\Controllers\Admin\DestinationController;
use App\Http\Controllers\Admin\ToursController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\ChauffeurServiceController;
use App\Http\Controllers\Admin\AccommodationController;
use App\Http\Controllers\Admin\MaidController;
use App\Http\Controllers\Admin\DriverController;
use App\Http\Controllers\Agency\NavigationController as AgencyNavigationController;
use App\Http\Controllers\Agency\TourController as AgencyTourController;

/*
|--------------------------------------------------------------------------
| Web Routes (Laravel 11 style – class-based)
|--------------------------------------------------------------------------
*/

// Unauthorized
Route::get('/unauthorized', fn () => view('unauthorized'))->name('unauthorized');

// Email verification
Route::get('email/verify', [VerificationController::class, 'show'])->name('verification.notice');
Route::get('email/verify/{id}', [VerificationController::class, 'verify'])->name('verification.verify');
Route::get('email/resend', [VerificationController::class, 'resend'])->name('verification.resend');

// Public
Route::get('/register_company', fn () => view('agency.register_agency'))->name('register_company');

Route::get('/', [UserNavigationController::class, 'index'])->name('index');
Route::get('/contact', [AllinOneController::class, 'contact'])->name('contact');
Route::post('/contactus_message', [AllinOneController::class, 'contactus_message'])->name('contactus_message');
Route::get('/tours', [AllinOneController::class, 'tours'])->name('tours');
Route::get('/load-more-popular-packages', [AllinOneController::class, 'loadMoreTours'])->name('load-more-popular-packages');
Route::get('/load-more-features-tours', [AllinOneController::class, 'LoadMoreFeaturesTours'])->name('load-more-features-tours');
Route::get('/tour_details/{id}', [AllinOneController::class, 'tourdetails'])->name('tour_details');
Route::get('/accommodation/{slug}', [AllinOneController::class, 'accommodationDetail'])->name('accommodation.detail');
Route::get('/destination_tour/{id}', [UserNavigationController::class, 'destination_tour'])->name('destination_tour');
Route::post('/search_tours', [AllinOneController::class, 'search_tours'])->name('search_tours');
Route::post('/book_tour', [AllinOneController::class, 'book_tour'])->name('book_tour');
Route::post('/getCalculation', [AllinOneController::class, 'getCalculation'])->name('getCalculation');

Route::get('/privacy-policy', fn () => view('policy'))->name('policy');
Route::get('/terms-conditions', fn () => view('terms'))->name('terms');
Route::get('/refund-policy', fn () => view('refund'))->name('refund');
Route::get('/about_us', fn () => view('about_us'))->name('about_us');
Route::get('/submit_review', fn () => view('user.submit_review'))->name('submit_review');

Auth::routes(['verify' => true]);

Route::get('/logout', function () {
    auth()->logout();
    return redirect()->route('index');
})->name('logout');

Route::get('/home', [HomeController::class, 'index'])->name('home');

// Booking (protected)
Route::middleware(['unauthorized'])->group(function () {
    Route::get('/tour_details/{id}/booking_details', [TourController::class, 'tourBookingsDetails'])->name('booking_details');
    Route::get('/tour_details/{id}/booking_details/make-payment', [TourController::class, 'makePayment'])->name('make-payment');
    Route::get('/tour_details/{id}/booking_details/make-payment/payment', [TourController::class, 'bookNowPayment'])->name('payment');
    Route::post('/tour_details/{id}/booking_details/make-payment/payment', [TourController::class, 'processTourBooking'])->name('payments');
});

// Admin
Route::prefix('admin')->as('admin.')->middleware(['auth', 'CheckUserRole'])->group(function () {
    Route::get('/', [AdminNavigationController::class, 'dashboard'])->name('dashboard');
    Route::get('/provider', [AllUsersController::class, 'indexprovider'])->name('provider');
    Route::resource('/users', AllUsersController::class);
    Route::resource('/destination', DestinationController::class);
    Route::resource('/tours', ToursController::class);
    Route::resource('/bookings', BookingController::class);
    Route::get('/update_booking_status/{booking_id}/{booking_status}', [BookingController::class, 'update_booking_status'])->name('update_booking_status');
    Route::get('/pickuppoint/{id}', [AllUsersController::class, 'pickuppoint'])->name('pickuppoint');
    Route::get('/pickup_point_show/{id}', [AllUsersController::class, 'pickupshow'])->name('pickup_point_show');
    Route::delete('/pickupdelete/{id}', [AllUsersController::class, 'pickupdelete'])->name('pickupdelete');
    Route::resource('/locations', LocationController::class);
    Route::resource('/chauffeur_service', ChauffeurServiceController::class)->names('chauffeur_service');
    Route::resource('/accommodation', AccommodationController::class)->names('accommodation');
    Route::resource('/maids', MaidController::class)->names('maid');
    Route::resource('/drivers', DriverController::class)->names('driver');
    Route::get('/movable_cameras', [LocationController::class, 'movable_cameras'])->name('movable_cameras');
    Route::get('/contactus_messages', [AdminNavigationController::class, 'contactus_message'])->name('contactus_message');
    Route::get('/delete_message/{id}', [AdminNavigationController::class, 'delete_message'])->name('delete_message');
    Route::get('/user_reviews', [AdminNavigationController::class, 'user_reviews'])->name('user_reviews');
    Route::get('/delete_review/{id}', [AdminNavigationController::class, 'delete_review'])->name('delete_review');
    Route::get('/delete_contact_us_message/{id}', [AdminNavigationController::class, 'delete_contact_us_message'])->name('delete_contact_us_message');
    Route::get('approve_provider/{id}', [AllUsersController::class, 'approve_provider'])->name('approve_provider');
});

// User (authenticated)
Route::prefix('user')->as('user.')->middleware(['auth', 'CheckUserRole'])->group(function () {
    Route::get('/', [UserNavigationController::class, 'dashboard'])->name('dashboard');
    Route::get('/change_password', [UserNavigationController::class, 'change_password'])->name('change_password');
    Route::post('/update_password', [UserNavigationController::class, 'update_password'])->name('update_password');
    Route::post('/update_profile', [UserNavigationController::class, 'update_profile'])->name('update_profile');
    Route::get('/my_bookings', [AllinOneController::class, 'my_bookings'])->name('my_bookings');
    Route::get('/cancel_booking/{id}', [AllinOneController::class, 'cancel_booking'])->name('cancel_booking');
    Route::post('/addfavourite', [AllinOneController::class, 'addfavourite'])->name('addfavourite');
    Route::get('/submit_review/{id}', [AllinOneController::class, 'submit_review'])->name('submit_review');
    Route::post('/add_review', [AllinOneController::class, 'add_review'])->name('add_review');
});

// Agency (authenticated)
Route::prefix('agency')->as('agency.')->middleware(['auth', 'CheckUserRole'])->group(function () {
    Route::get('/', [AgencyNavigationController::class, 'dashboard'])->name('dashboard');
    Route::post('/update_profile', [AgencyNavigationController::class, 'update_profile'])->name('update_profile');
    Route::post('/pickup_point', [AgencyTourController::class, 'pickup_point'])->name('pickup_point');
    Route::get('/edit_pickup_point/{id}', [AgencyTourController::class, 'edit_pickup_point'])->name('edit_pickup_point');
    Route::post('/update_pickup_point', [AgencyTourController::class, 'update_pickup_point'])->name('update_pickup_point');
    Route::get('/delete_pickup_point/{id}', [AgencyTourController::class, 'delete_pickup_point'])->name('delete_pickup_point');
    Route::get('/createtour', [AgencyTourController::class, 'index'])->name('createtour');
    Route::post('/storetour', [AgencyTourController::class, 'store'])->name('storetour');
    Route::get('/edit_tour/{id}', [AgencyTourController::class, 'edit_tour'])->name('edit_tour');
    Route::post('/update_tour', [AgencyTourController::class, 'update_tour'])->name('update_tour');
    Route::get('/mytour', [AgencyTourController::class, 'mytour'])->name('mytour');
    Route::get('/delete_tour/{id}', [AgencyTourController::class, 'delete_tour'])->name('delete_tour');
    Route::get('/change_password', [AgencyNavigationController::class, 'change_password'])->name('change_password');
    Route::post('/update_password', [AgencyNavigationController::class, 'update_password'])->name('update_password');
    Route::get('/my_bookings', [AgencyTourController::class, 'my_bookings'])->name('my_bookings');
    Route::get('/tour_bookings/{id}', [AgencyTourController::class, 'tour_bookings'])->name('tour_bookings');
    Route::get('/delete_booking/{id}', [AgencyTourController::class, 'delete_booking'])->name('delete_booking');
    Route::get('/update_booking_status/{booking_id}/{booking_status}', [AgencyTourController::class, 'update_booking_status'])->name('update_booking_status');
});

Route::get('agency-tours-list/{agency_id}', [UserNavigationController::class, 'agency_tours'])->name('agency-tours-list');

// Dev helpers
Route::prefix('dev')->group(function () {
    Route::get('config-clear', function () { \Artisan::call('config:clear'); return 'Configuration cache cleared!'; });
    Route::get('route-clear', function () { \Artisan::call('route:clear'); return 'Route cache cleared!'; });
    Route::get('view-clear', function () { \Artisan::call('view:clear'); return 'View cache cleared!'; });
    Route::get('config-cache', function () { \Artisan::call('config:cache'); return 'Configuration cached!'; });
    Route::get('route-cache', function () { \Artisan::call('route:cache'); return 'Route cached!'; });
    Route::get('view-cache', function () { \Artisan::call('view:cache'); return 'View cached!'; });
});
