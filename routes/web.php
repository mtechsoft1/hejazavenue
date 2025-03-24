<?php

use Illuminate\Support\Facades\Route;
use App\Mail\SignupMail;
use App\Http\Controllers\TourController;
use Illuminate\Support\Facades\Log;

Route::middleware(['unauthorized'])->group(function () {
	// Protected routes

	// 
	// Tariq Mehmood Dev

	Route::get('/tour_details/{id}/booking_details', [TourController::class, 'tourBookingsDetails'])->name('booking_details');
	Route::get('/tour_details/{id}/booking_details/make-payment', [TourController::class, 'makePayment'])->name('make-payment');
	Route::get('/tour_details/{id}/booking_details/make-payment/payment', [TourController::class, 'bookNowPayment'])->name('payment');
	Route::post('/tour_details/{id}/booking_details/make-payment/payment', [TourController::class, 'processTourBooking'])->name('payment');

});

// Unauthorized route
Route::get('/unauthorized', function () {
	return view('unauthorized'); // unauthorized.blade.php
})->name('unauthorized');



// Route::get('/', function () {
//     return view('welcome');
// });


// Route::get('/email/verify', function () {return view('auth.verify-email');})->middleware('auth')->name('verification.notice');

Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');
Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');


Route::get('/register_company', function () { return view('agency.register_agency'); })->name('register_company');

Route::get('/', 'User\NavigationController@index')->name('index');
Route::get('/contact', 'User\AllinOneController@contact')->name('contact');
Route::post('/contactus_message', 'User\AllinOneController@contactus_message')->name('contactus_message');
Route::get('/tours', 'User\AllinOneController@tours')->name('tours');
Route::get('/load-more-popular-packages', 'User\AllinOneController@loadMoreTours')->name('load-more-popular-packages');
Route::get('/load-more-features-tours', 'User\AllinOneController@LoadMoreFeaturesTours')->name('load-more-features-tours');
Route::get('/tour_details/{id}', 'User\AllinOneController@tourdetails')->name('tour_details');
Route::get('/destination_tour/{id}', 'User\NavigationController@destination_tour')->name('destination_tour');
Route::post('/search_tours', 'User\AllinOneController@search_tours')->name('search_tours');
Route::post('/book_tour', 'User\AllinOneController@book_tour')->name('book_tour');
Route::post('/getCalculation', 'User\AllinOneController@getCalculation')->name('getCalculation');

Route::get('/privacy-policy', function () { return view('policy'); })->name('policy');
Route::get('/terms-conditions', function () { return view('terms'); })->name('terms');
Route::get('/refund-policy', function () { return view('refund'); })->name('refund');

Route::get('/about_us', function () { return view('about_us'); })->name('about_us');

Route::get('/submit_review', function () { return view('user.submit_review'); })->name('submit_review');


Auth::routes();
Auth::routes(['verify' => true]);

Route::get('/logout', function () {
	\Auth::logout();
	return redirect()->route('index');
})->name('logout');

Route::get('/home', 'HomeController@index')->name('home');


// Routing For Admin Panel

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'CheckUserRole']], function () {
	Route::get('/', 'Admin\NavigationController@dashboard')->name('dashboard');
	Route::get('/provider', 'Admin\AllUsersController@indexprovider')->name('provider');
	Route::resource('/users', 'Admin\AllUsersController');
	// Route::get('/destination/index', 'Admin\DestinationController@index')->name('destination.index');
	// Route::get('/destination/create', 'Admin\DestinationController@create')->name('destination.create');
	// Route::post('/destination/store', 'Admin\DestinationController@store')->name('destination.store');
	Route::resource('/destination', 'Admin\DestinationController');
	Route::resource('/tours', 'Admin\ToursController');
	Route::resource('/bookings', 'Admin\BookingController');
	Route::get('/update_booking_status/{booking_id}/{booking_status}', 'Admin\BookingController@update_booking_status')->name('update_booking_status');
	Route::get('/pickuppoint/{id}', 'Admin\AllUsersController@pickuppoint')->name('pickuppoint');
	Route::get('/pickup_point_show/{id}', 'Admin\AllUsersController@pickupshow')->name('pickup_point_show');
	Route::delete('/pickupdelete/{id}', 'Admin\AllUsersController@pickupdelete')->name('pickupdelete');
	Route::resource('/locations', 'Admin\LocationController');
	Route::get('/movable_cameras', 'Admin\LocationController@movable_cameras')->name('movable_cameras');
	Route::get('/contactus_messages', 'Admin\NavigationController@contactus_message')->name('contactus_message');
	Route::get('/delete_message/{id}', 'Admin\NavigationController@delete_message')->name('delete_message');
	Route::get('/user_reviews', 'Admin\NavigationController@user_reviews')->name('user_reviews');
	Route::get('/delete_review/{id}', 'Admin\NavigationController@delete_review')->name('delete_review');
	Route::get('/delete_contact_us_message/{id}', 'Admin\NavigationController@delete_contact_us_message')->name('delete_contact_us_message');
	Route::get('approve_provider/{id}', [App\Http\Controllers\Admin\AllUsersController::class, 'approve_provider'])->name('approve_provider');

});


Route::group(['prefix' => 'user', 'as' => 'user.', 'middleware' => ['auth', 'CheckUserRole']], function () {
	Route::get('/', 'User\NavigationController@dashboard')->name('dashboard');
	Route::get('/change_password', 'User\NavigationController@change_password')->name('change_password');
	Route::post('/update_password', 'User\NavigationController@update_password')->name('update_password');
	Route::post('/update_profile', 'User\NavigationController@update_profile')->name('update_profile');
	Route::get('/my_bookings', 'User\AllinOneController@my_bookings')->name('my_bookings');
	Route::get('/cancel_booking/{id}', 'User\AllinOneController@cancel_booking')->name('cancel_booking');
	
	Route::post('/addfavourite', 'User\AllinOneController@addfavourite')->name('addfavourite');

	Route::get('/submit_review/{id}', 'User\AllinOneController@submit_review')->name('submit_review');
	Route::post('/add_review', 'User\AllinOneController@add_review')->name('add_review');
});


Route::group(['prefix' => 'agency', 'as' => 'agency.', 'middleware' => ['auth', 'CheckUserRole']], function () {
	Route::get('/', 'Agency\NavigationController@dashboard')->name('dashboard');
	Route::post('/update_profile', 'Agency\NavigationController@update_profile')->name('update_profile');
	Route::post('/pickup_point', 'Agency\TourController@pickup_point')->name('pickup_point');
	Route::get('/edit_pickup_point/{id}', 'Agency\TourController@edit_pickup_point')->name('edit_pickup_point');
	Route::post('/update_pickup_point', 'Agency\TourController@update_pickup_point')->name('update_pickup_point');
	Route::get('/delete_pickup_point/{id}', 'Agency\TourController@delete_pickup_point')->name('delete_pickup_point');

	Route::get('/createtour', 'Agency\TourController@index')->name('createtour');
	Route::post('/storetour', 'Agency\TourController@store')->name('storetour');
	Route::get('/edit_tour/{id}', 'Agency\TourController@edit_tour')->name('edit_tour');
	Route::post('/update_tour', 'Agency\TourController@update_tour')->name('update_tour');
	Route::get('/mytour', 'Agency\TourController@mytour')->name('mytour');
	Route::get('/delete_tour/{id}', 'Agency\TourController@delete_tour')->name('delete_tour');
	Route::get('/change_password', 'Agency\NavigationController@change_password')->name('change_password');
	Route::post('/update_password', 'Agency\NavigationController@update_password')->name('update_password');

	Route::get('/my_bookings', 'Agency\TourController@my_bookings')->name('my_bookings');
	Route::get('/tour_bookings/{id}', 'Agency\TourController@tour_bookings')->name('tour_bookings');
	Route::get('/delete_booking/{id}', 'Agency\TourController@delete_booking')->name('delete_booking');
	Route::get('/update_booking_status/{booking_id}/{booking_status}', 'Agency\TourController@update_booking_status')->name('update_booking_status');

});
Route::get('agency-tours-list/{agency_id}', [App\Http\Controllers\User\NavigationController::class, 'agency_tours'])->name('agency-tours-list');

// Route::get('stripe', 'StripePaymentController@stripe');
// Route::post('stripe', 'StripePaymentController@stripePost')->name('stripe.post');

// Route::prefix('dev')->group(function(){
// 	Route::get('config-cache', function(){
// 		try{
// 			\Artisan::call('config:cache');
// 			echo "Media Storage Linked Successfully";
// 		} catch( \Exception $e) {
// 			dd($e->getMessage());
// 		}
// 	});
// });
// php artisan vendor:publish --tag=laravel-mail
// Route::prefix('dev')->group(function(){
// 	Route::get('vendor', function(){
// 		try{
// 			\Artisan::call('vendor:publish --tag=laravel-mail');
// 			echo "Vendor folder Created Successfully!";
// 		} catch( \Exception $e) {
// 			dd($e->getMessage());
// 		}
// 	});
// });

Route::prefix('dev')->group(function () {
	Route::get('config-clear', function () {
		try {
			\Artisan::call('config:clear');
			echo "Configuration cache cleared!";
		} catch (\Exception $e) {
			dd($e->getMessage());
		}
	});
});

// Route::prefix('dev')->group(function(){
// 	Route::get('controller', function(){
// 		try{
// 			\Artisan::call('make:controller LoadMoreController');
// 			echo "LoadMoreController Created successfully!";
// 		} catch( \Exception $e) {
// 			dd($e->getMessage());
// 		}
// 	});
// });

Route::prefix('dev')->group(function () {
	Route::get('route-clear', function () {
		try {
			\Artisan::call('route:clear');
			echo "Route cache cleared!";
		} catch (\Exception $e) {
			dd($e->getMessage());
		}
	});
});

Route::prefix('dev')->group(function () {
	Route::get('view-clear', function () {
		try {
			\Artisan::call('view:clear');
			echo "View cache cleared!";
		} catch (\Exception $e) {
			dd($e->getMessage());
		}
	});
});

Route::prefix('dev')->group(function () {
	Route::get('config-cache', function () {
		try {
			\Artisan::call('config:cache');
			echo "Configuration cache cleared!";
			echo "Configuration cached successfully!";
		} catch (\Exception $e) {
			dd($e->getMessage());
		}
	});
});

Route::prefix('dev')->group(function () {
	Route::get('route-cache', function () {
		try {
			\Artisan::call('route:cache');
			echo "Route cache cleared!";
			echo "Route cached successfully!";
		} catch (\Exception $e) {
			dd($e->getMessage());
		}
	});
});

Route::prefix('dev')->group(function () {
	Route::get('view-cache', function () {
		try {
			\Artisan::call('view:cache');
			echo "View cache cleared!";
			echo "View cached successfully!";
		} catch (\Exception $e) {
			dd($e->getMessage());
		}
	});
});
