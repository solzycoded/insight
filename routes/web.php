<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Account\SignupController;
use App\Http\Controllers\Account\LoginController;
use App\Http\Controllers\Account\SessionController;

use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\Profile\UserOrganizationController;

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

// GUEST USERS
Route::middleware('guest')->group(function(){ 
    // SIGNUP
    Route::get('/signup', [SignupController::class, 'create']); // display the signup page
    Route::post('/signup', [SignupController::class, 'store'])->name('signup'); // send the user's details to the signup controller, to add the user to the system

    // LOGIN
    Route::get('/login', [LoginController::class, 'create']); // display the signup page
    Route::post('/login', [SessionController::class, 'store'])->name('login'); // send the user's details to the signup controller, to add the user to the system

    // PUBLISH YOUR WORK (GUEST)
    Route::get('/publish-your-work', [SignupController::class, 'create']);
});

// AUTH USERS
Route::middleware('auth')->group(function(){
    Route::get('/profile', function () {
        return view('profile.index');
    });

    // PUBLISH YOUR WORK
    Route::get('/publish-your-work', function () {
        return view('profile.publishyourwork.index');
    });

    // PUBLISH YOUR WORK (personal details)
    Route::get('/publish-your-work/personal-details', [ProfileController::class, 'create']);
    Route::post('/personal-details', [ProfileController::class, 'store'])->name('personal-details');

    // PUBLISH YOUR WORK (organization)
    Route::get('/publish-your-work/organization', [UserOrganizationController::class, 'create']);
    Route::post('/organization', [UserOrganizationController::class, 'store'])->name('organization');

    // PUBLISH YOUR WORK (address)
});