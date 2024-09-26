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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/event-member-form', [App\Http\Controllers\HomeController::class, 'eventMemberFormRegistration'])->name('eventMemberFormRegistration');
Route::post('/member-registration-store', [App\Http\Controllers\HomeController::class, 'eventMemberFormRegistrationStore'])->name('member-registration-store');

Route::middleware(['auth','role:admin'])->group(function () {
    Route::get('/admin-dashboard', [App\Http\Controllers\AdminController::class, 'adminDashboard'])->name('admin-dashboard');
});


