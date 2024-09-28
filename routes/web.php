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
Route::get('/member-profile/{memberId}/{memberName}', [App\Http\Controllers\PublicController::class, 'memberProfile'])->name('member-profile');
Route::get('/route-cache', function() {
    Artisan::call('route:clear');
    return 'Routes cache has been cleared';
});
Route::get('/migrate', function() {
    Artisan::call('migrate');
    return 'Migrated Done';
});

Route::get('/storage-link', function () {
    Artisan::call('storage:link');
});
Route::get('/seed', function () {
    Artisan::call('db:seed');
});




Route::middleware(['auth','role:admin'])->group(function () {
    Route::get('/admin-dashboard', [App\Http\Controllers\AdminController::class, 'adminDashboard'])->name('adminDashboard');
    Route::post('/category-store', [App\Http\Controllers\AdminController::class, 'categoryStore'])->name('category-store');
    Route::get('/category-show/{id}', [App\Http\Controllers\AdminController::class, 'categoryShow']);
    Route::put('/category-update/{id}', [App\Http\Controllers\AdminController::class, 'categoryUpdate'])->name('category-update');
    Route::post('/organizer-store', [App\Http\Controllers\AdminController::class, 'organizerStore'])->name('organizer-store');
    Route::get('/organizer-show/{id}', [App\Http\Controllers\AdminController::class, 'organizerShow']);
    Route::put('/organizer-update/{id}', [App\Http\Controllers\AdminController::class, 'organizerUpdate'])->name('organizer-update');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/event-member-form', [App\Http\Controllers\HomeController::class, 'eventMemberFormRegistration'])->name('eventMemberFormRegistration');
Route::post('/member-registration-store', [App\Http\Controllers\HomeController::class, 'eventMemberFormRegistrationStore'])->name('member-registration-store');
Route::post('/short-url-store', [App\Http\Controllers\HomeController::class, 'shortUrlStore'])->name('short-url-store');
Route::get('/{shortUrl}', [App\Http\Controllers\HomeController::class, 'redirectToUrl']);


