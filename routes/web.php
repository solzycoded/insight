<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Account\SignupController;
use App\Http\Controllers\Account\LoginController;
use App\Http\Controllers\Account\SessionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group.
|
*/

Route::get('/', function () {
    return view('index');
});

// ACCOUNT
Route::get('/signup', [SignupController::class, 'create']); // display the signup page
Route::post('/signup', [SignupController::class, 'store'])->name('signup'); // send the user's details to the signup controller, to add the user to the system

Route::get('/login', [LoginController::class, 'create']); // display the signup page
Route::post('/login', [SessionController::class, 'store'])->name('login'); // send the user's details to the signup controller, to add the user to the system

Route::get('/profile', function () {
    return view('account.profile.index');
});

Route::get('/publish-your-work', function () {
    return view('account.signup.index');
});