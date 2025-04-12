<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;

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


//Route::get('/', [AuthController::class, 'showLogin'])->name('login');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);