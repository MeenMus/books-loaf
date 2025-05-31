<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\GenreController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Customer\PaymentController;
use App\Http\Controllers\Customer\HomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\Customer\ShopController;
use App\Http\Controllers\Customer\BuyBookController;
use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\LikeController;
use App\Http\Controllers\Customer\OrderController;
use App\Http\Controllers\Customer\BookReviewController;
use App\Http\Controllers\Customer\ProfileController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\URL;
use Laravel\Socialite\Facades\Socialite;


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


Route::get('/shop/{id}', [ShopController::class, 'index']);

Route::get('/book/{id}', [BuyBookController::class, 'index']);

Route::post('/cart-add/{id}', [CartController::class, 'addCart'])->name('cart-add')->middleware('auth');
Route::post('/like/{book}', [LikeController::class, 'toggleLike'])->name('like')->middleware('auth');
Route::post('/cart-add-all-liked', [CartController::class, 'addAllLiked'])->name('cart-add-all-liked')->middleware('auth');
Route::get('/user-likes', [LikeController::class, 'fetchLikes'])->name('user-likes')->middleware('auth');
Route::get('/user-cart', [CartController::class, 'fetchCart'])->name('user-cart')->middleware('auth');
Route::get('/cart', [CartController::class, 'index'])->middleware('auth');
Route::delete('/cart-remove/{id}', [CartController::class, 'removeCart'])->name('cart-remove')->middleware('auth');
Route::post('/cart-update', [CartController::class, 'updateCart'])->name('cart-update')->middleware('auth');

Route::get('/checkout', [CartController::class, 'showCheckout'])->name('checkout')->middleware('auth');
Route::post('/order-now/{id}', [CartController::class, 'orderNow'])->name('order-now')->middleware('auth');

Route::get('/profile', [ProfileController::class, 'create'])->name('profile')->middleware('auth');
Route::post('/profile-update', [ProfileController::class, 'store'])->name('profile-update')->middleware('auth');

Route::get('/orders', [OrderController::class, 'index'])->name('orders')->middleware('auth');
Route::get('/orders-receipt/{order}', [OrderController::class, 'printReceipt'])->name('orders-receipt')->middleware('auth');

Route::post('/orders/review/submit', [BookReviewController::class, 'submitReview'])->name('review-update')->middleware('auth');

Route::post('/checkout-stripe', [PaymentController::class, 'redirectToStripeCheckout'])->name('checkout-stripe')->middleware('auth');
Route::get('/checkout-success', [PaymentController::class, 'stripeSuccess'])->name('checkout-success')->middleware('auth');
Route::get('/checkout-cancel', [PaymentController::class, 'stripeCancel'])->name('checkout-cancel')->middleware('auth');


Route::get('/contact', [HomeController::class, 'showContact']);
Route::get('/blog', [HomeController::class, 'showBlog']);
Route::get('/about', [HomeController::class, 'showAbout']);

Route::post('/chat', [ChatController::class, 'chat'])->name('chat')->middleware('auth');





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
    Route::delete('/genres-delete', [GenreController::class, 'delete'])->name('genres-delete');

    /* MANAGE ORDERS */
    Route::get('/orders-list', [AdminOrderController::class, 'orderList'])->name('orders-list');
    Route::get('/orders-page/{id}', [AdminOrderController::class, 'orderPage'])->name('orders-page');
    Route::patch('/orders-update/{order}', [AdminOrderController::class, 'orderUpdate'])->name('orders-update');
    Route::get('/orders-receipt/{order}', [AdminOrderController::class, 'printReceipt'])->name('orders-receipt');



    /* MANAGE USERS */

    Route::get('/users-list', [UserController::class, 'userList'])->name('users-list');
    Route::get('/users-page/{id}', [UserController::class, 'userPage'])->name('users-page');
    Route::post('/users-profile-update/{id}', [UserController::class, 'userProfileUpdate'])->name('users-profile-update');
    Route::post('/users-role-update/{id}', [UserController::class, 'userRoleUpdate'])->name('users-role-update');
    Route::post('/users-update/{id}', [UserController::class, 'userUpdate'])->name('users-update');
    Route::delete('/users-delete', [GenreController::class, 'delete'])->name('users-delete');
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


Route::get('/login/google', [AuthController::class, 'redirectToGoogle'])->name('login.google');
Route::get('/login/google/callback', [AuthController::class, 'handleGoogleCallback']);

Route::get('/login/facebook', [AuthController::class, 'redirectToFacebook'])->name('login.facebook');
Route::get('/login/facebook/callback', [AuthController::class, 'handleFacebookCallback']);

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
