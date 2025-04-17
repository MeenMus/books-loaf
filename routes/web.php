<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\URL;

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

Route::get('/', [Controller::class, 'showIndex']);
Route::get('/index-2', [Controller::class, 'showIndexAlt']);
Route::get('/single-product', [Controller::class, 'showBook']);
Route::get('/single-post', [Controller::class, 'showPost']);
Route::get('/shop', [Controller::class, 'showShop']);
Route::get('/contact', [Controller::class, 'showContact']);
Route::get('/checkout', [Controller::class, 'showCheckout']);
Route::get('/cart', [Controller::class, 'showCart']);
Route::get('/blog', [Controller::class, 'showBlog']);
Route::get('/about', [Controller::class, 'showAbout']);


/* AUTH (GUEST)*/
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Show Forgot Password Form
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('forgot.password');


//Password reset
Route::get('/reset-password/{token}', function ($token, Request $request) {
    return view('auth.reset-password', [
        'token' => $token,
        'email' => $request->email, // pulled from the query string
    ]);
})->name('password.reset');

Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');



// Handle form submission
Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);

/* AUTH (SANCTUM)*/

Route::post('/email/verification-notification', [AuthController::class, 'resendVerificationEmail'])->middleware(['auth:sanctum', 'throttle:6,1'])->name('verification.send');
Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verifyEmail'])->middleware('signed')->name('verification.verify');
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout'])->name('logout');


