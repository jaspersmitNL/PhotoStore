<?php

use App\Http\Controllers\Admin\AdminBookingController;
use App\Http\Controllers\Admin\AdminBookingPhotoController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\Order\AdminOrderController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\Booking\BookingController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\Payment\CheckoutController;
use App\Http\Controllers\Payment\MollieController;
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


Route::prefix('admin')
    ->name('admin.')
    ->group(function () {

        //Auth
        Route::get('/login', [AuthController::class, 'login'])->name('login');
        Route::post('/login/validate', [AuthController::class, 'validateLogin'])->name('validate');
        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

        //End-Auth

        Route::middleware('isLoggedIn')->group(function () {
            Route::view('/', 'admin.dashboard')->name('dashboard');

            Route::prefix('bookings')
                ->name('booking.')
                ->group(function () {
                    // Index
                    Route::get('/', [AdminBookingController::class, 'index'])->name('index');
                    // Create
                    Route::get('/create', [AdminBookingController::class, 'create'])->name('create');
                    Route::post('/create', [AdminBookingController::class, 'store'])->name('store');

                    Route::prefix('/{id}')->group(function () {

                        // Edit
                        Route::get('/edit', [AdminBookingController::class, 'edit'])->name('edit');
                        Route::post('/edit', [AdminBookingController::class, 'update'])->name('update');
                        // Delete
                        Route::get('/delete', [AdminBookingController::class, 'delete'])->name('delete');

                        // Photos
                        Route::prefix('/photos')->name('photo.')->group(function () {
                            // Index
                            Route::get('/', [AdminBookingPhotoController::class, 'index'])->name('index');
                            // Upload
                            Route::post('/upload', [AdminBookingPhotoController::class, 'upload'])->name('upload');
                            Route::get('/delete', [AdminBookingPhotoController::class, 'delete'])->name('delete');
                        });
                    });
                });

            Route::prefix('orders')
                ->name('order.')
                ->group(function () {
                    Route::view('/', 'admin.order.index')
                        ->name('index');
                });
        });
    });

Route::prefix('/booking/{id}')->name('booking.')->group(function () {
    Route::get('/', [BookingController::class, 'index'])->name('index');
    Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
    Route::post('/checkout/confirm', [CheckoutController::class, 'submitForm'])->name('checkout.confirm');
});


Route::prefix('basket')->name('basket.')->group(function () {
    Route::post('/add', [BasketController::class, 'add'])->name('add');
    Route::post('/remove', [BasketController::class, 'remove'])->name('remove');
    Route::get('/{booking}', [BasketController::class, 'index'])->name('index');
});

Route::get('/booking/{id}/checkout/processing', [MollieController::class, 'redirect'])->name('mollie.redirect');
Route::post('/mollie/webhook', [MollieController::class, 'webhook'])->name('mollie.webhook');


Route::get('/download/{id}', [DownloadController::class, 'download'])->name('download');


Route::get('/test', [\App\Http\Controllers\TestController::class, 'index']);
Route::post('/test/upload', [\App\Http\Controllers\TestController::class, 'upload']);

Route::get('/', function () {
   return redirect(env("WEBSITE_URL") ? : '/404');
});

Route::get("/clearthedamncache", function (){
    \Artisan::call("cache:clear");
    \Artisan::call("config:clear");
    \Artisan::call("view:clear");
    \Artisan::call("route:clear");
    return "OK, cache cleared.";
});
