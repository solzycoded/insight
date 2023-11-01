<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Account\SignupController;
use App\Http\Controllers\Account\LoginController;
use App\Http\Controllers\Account\SessionController;

use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\Profile\UserOrganizationController;
use App\Http\Controllers\Profile\UserJournalController;
use App\Http\Controllers\Profile\ManuscriptController;
use App\Http\Controllers\Profile\ManuscriptAuthorController;

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
    // SIGNUP (USE CASE controller)
    Route::get('/signup', [SignupController::class, 'create']); // display the signup page
    Route::post('/signup', [SignupController::class, 'store'])->name('signup'); // send the user's details to the signup controller, to add the user to the system

    // LOGIN (USE CASE controller)
    Route::get('/login', [LoginController::class, 'create']); // display the signup page
    Route::post('/login', [LoginController::class, 'store'])->name('login'); // send the user's details to the signup controller, to add the user to the system

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
    Route::post('/publish-your-work/personal-details', [ProfileController::class, 'store'])->name('personal-details');
    Route::patch('/publish-your-work/personal-details/{profile}', [ProfileController::class, 'update']);
    // Route::delete('/admin/tags/{tag}', [AdminTagController::class, 'destroy']);

    // PUBLISH YOUR WORK (organization)
    Route::get('/publish-your-work/organization', [UserOrganizationController::class, 'create']);
    Route::post('/publish-your-work/organization', [UserOrganizationController::class, 'store'])->name('organization');
    Route::patch('/publish-your-work/organization/{userOrganization}', [UserOrganizationController::class, 'update']);

    // PUBLISH YOUR WORK (journal)
    Route::get('/publish-your-work/journal', [UserJournalController::class, 'create']);
    Route::post('/publish-your-work/journal', [UserJournalController::class, 'store']);
    Route::patch('/publish-your-work/journal/{journal}', [UserJournalController::class, 'update']);


    // PUBLISH YOUR WORK (manuscript)
    Route::get('/publish-your-work/manuscript', [ManuscriptController::class, 'create']);
    Route::post('/publish-your-work/manuscript', [ManuscriptController::class, 'store']);
    Route::patch('/publish-your-work/manuscript/{manuscript}', [ManuscriptController::class, 'update']);

    // PUBLISH YOUR WORK (authors)
    Route::get('/publish-your-work/authors', [ManuscriptAuthorController::class, 'create']);
    Route::post('/publish-your-work/authors', [ManuscriptAuthorController::class, 'store']);

    // MY PUBLICATIONS
    Route::get('/my-publications', function () {
        return view('profile.mypublications.index');
    });
 
    // LOGOUT
    Route::post('/log-out', [SessionController::class, 'destroy'])->middleware('auth');
});