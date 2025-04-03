<?php

use App\Http\Controllers\PermissionController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\FilmMakerController;
use App\Http\Controllers\FilmBuyerController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AllowedBuyerController;

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'guest'], function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('login',     'index')->name('login');
        Route::post('login',    'login')->name('login'); //->middleware('throttle:2,1')
    });
});

Route::get('resetPassword',       [AuthController::class, 'resetPwdView'])->name('resetPassword');
Route::post('resetPassword',      [AuthController::class, 'resetPassword'])->name('resetPassword');
Route::get('sendOtp',             [AuthController::class, 'sendOtpView'])->name('sendOtp');
Route::post('sendOtp',            [AuthController::class, 'sendOtp'])->name('sendOtp');
Route::get('verifyOtp',           [AuthController::class, 'verifyOtpView'])->name('verifyOtp');
Route::post('verifyOtp',          [AuthController::class, 'verifyOtp'])->name('verifyOtp');
Route::get('changePassword',      [AuthController::class, 'changePasswordView'])->name('changePassword');
Route::post('changePassword',     [AuthController::class, 'changePassword'])->name('changePassword');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('allowedbuyers', AllowedBuyerController::class);

    Route::prefix('film-makers')->name('film_makers.')->group(function () {
        Route::get('/', [FilmMakerController::class, 'index'])->name('index');  // Listing Page
        Route::get('/{id}', [FilmMakerController::class, 'show'])->name('show');  // Details Page
        Route::post('/update-status', [FilmMakerController::class, 'updateStatus'])->name('update.status');
    });
    Route::prefix('film')->name('film.')->group(function () {
        Route::get('/', [FilmController::class, 'index'])->name('fimindex');  // Listing Page
        Route::get('/{id}', [FilmController::class, 'show'])->name('filmshow');  // Details Page
        Route::post('/update-status', [FilmController::class, 'updateStatus'])->name('update.status');
    });
    Route::prefix('film-buyer')->name('film_buyer.')->group(function () {
        Route::get('/', [FilmBuyerController::class, 'index'])->name('index');  // Listing Page
        Route::get('/{id}', [FilmBuyerController::class, 'show'])->name('show');  // Details Page
        Route::post('/update-status', [FilmBuyerController::class, 'updateStatus'])->name('update.status');
    });

    Route::get('/',                 [WelcomeController::class, 'index'])->name('dashboard');
    Route::get('home',              [AuthController::class, 'home'])->name('home');
    Route::get('logout',            [AuthController::class, 'logout'])->name('logout');

    Route::resources([
        'roles'             =>  RoleController::class,
        'users'             =>  UserController::class,
        'permissions'       =>  PermissionController::class,
    ]);

    Route::controller(UserController::class)->group(function () {
        Route::get('user-search',       'search')->name('user.search');
    });
    Route::get('permission_search',     [PermissionController::class, 'search'])->name('permissions.search');
});

Route::fallback(function () {
    return abort(401, "User can't perform this action.");
});
