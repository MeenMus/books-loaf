<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\GenreController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Customer\HomeController;
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

/* CUSTOMER STUFF */

Route::get('/', [HomeController::class, 'showIndex']);
Route::get('/index-2', [HomeController::class, 'showIndexAlt']);
Route::get('/single-product', [HomeController::class, 'showBook']);
Route::get('/single-post', [HomeController::class, 'showPost']);
Route::get('/shop', [HomeController::class, 'showShop']);
Route::get('/contact', [HomeController::class, 'showContact']);
Route::get('/checkout', [HomeController::class, 'showCheckout']);
Route::get('/cart', [HomeController::class, 'showCart']);
Route::get('/blog', [HomeController::class, 'showBlog']);
Route::get('/about', [HomeController::class, 'showAbout']);

/* ---- */




/* ADMIN STUFF */
Route::middleware(['admin'])->group(function () {

    /* DASHBOARD */
    Route::get('/dashboard', [DashboardController::class, 'showDashboard'])->name('dashboard');

    /* MANAGE BOOKS */
    Route::get('/books-create', [BookController::class, 'create'])->name('books-create');
    Route::post('/books-store', [BookController::class, 'store'])->name('books-store');

    Route::get('/books-list', [BookController::class, 'bookList'])->name('books-list');
    Route::get('/books-page/{id}', [BookController::class, 'bookPage'])->name('books-page');
    Route::post('/books-update/{id}', [BookController::class, 'bookUpdate'])->name('books-update');
    Route::post('/books-update-cover/{id}', [BookController::class, 'bookUpdateCover'])->name('books-update-cover');
    Route::delete('/books/{id}', [BookController::class, 'delete'])->name('books-delete');


    /* MANAGE GENRE */
    Route::get('/genres-list', [GenreController::class, 'genreList'])->name('genres-list');
    Route::post('/genres-store', [GenreController::class, 'store'])->name('genres-store');
    Route::post('/genres-delete', [GenreController::class, 'delete'])->name('genres-delete');
});

/* ---- */







/* AUTH STUFF */

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
        'email' => $request->email,
    ]);
})->name('password.reset');

Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

// Handle form submission
Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);

Route::post('/email/verification-notification', [AuthController::class, 'resendVerificationEmail'])->middleware(['auth:sanctum', 'throttle:6,1'])->name('verification.send');
Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verifyEmail'])->middleware('signed')->name('verification.verify');
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout'])->name('logout');

/* ---- */





/* STORAGE ROUTES */


Route::get('/covers/{filename}', function ($filename) {
    // Build the full path to the image file in storage
    $path = storage_path('app/public/covers/' . $filename);

    // If the file doesn't exist, show a 404 error
    if (!file_exists($path)) {
        abort(404);
    }

    // Return the image as a response
    return response()->file($path);
})->where('filename', '.*');  // This allows for subdirectories like "cover/asdasd.jpg"




//Books Controller
Route::get('/books/malay', [BookController::class, 'malay'])->name('books.malay');
Route::get('/books/english', [BookController::class, 'english'])->name('books.english');
Route::get('/books/chinese', [BookController::class, 'chinese'])->name('books.chinese');
Route::get('/books/revision', [BookController::class, 'revision'])->name('books.revision');
Route::get('/books/stationery', [BookController::class, 'stationery'])->name('books.stationery');
