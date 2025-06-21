<?php

namespace App\Http\Controllers\Customer;

use App\Models\Genre;
use App\Models\Book;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\BookReview;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function showIndex()
    {

        //For showing the reviews from the users
    $reviews = DB::table('book_reviews')
    ->join('users', 'book_reviews.user_id', '=', 'users.id')
    ->join('books', 'book_reviews.book_id', '=', 'books.id')
    ->select(
        'book_reviews.rating',
        'book_reviews.review',
        'users.name as user_name',
        'books.id as book_id',
        'books.title as book_title',
        'books.author',
        'books.cover_image', // optional column if you have it
        'books.price'        // optional column if you have it
    )
    ->latest('book_reviews.created_at')
    ->take(6)
    ->get();

    $homepageGenres = Genre::whereIn('name', [
    'Fiction', 'Children', 'Self Help', 'Crime', 'Romance', 'Non-Fiction', 'Cooking'
])->get();

 $genreImages = [
    'Fiction' => 'public.png',
    'Children' => 'children.png',
    'Self Help' => 'self care.png',
    'Crime' => 'thriller.png',
    'Romance' => 'romance.png',
    'Non-Fiction' => 'fiction.png',
    'Cooking' => 'cooking.png',
  ];


        return view('index', compact('reviews', 'homepageGenres','genreImages'));
    }

    public function showBook()
    {
        return view('single-product');
    }

    public function showShop()
    {

        $genres = Genre::orderBy('name', 'asc')->get();

        return view('shop', compact('genres'));
    }

    public function showIndexAlt()
    {
        return view('index-2');
    }

    public function showContact()
    {

        //For showing the reviews from the users
    $reviews = DB::table('book_reviews')
    ->join('users', 'book_reviews.user_id', '=', 'users.id')
    ->join('books', 'book_reviews.book_id', '=', 'books.id')
    ->select(
        'book_reviews.rating',
        'book_reviews.review',
        'users.name as user_name',
        'books.id as book_id',
        'books.title as book_title',
        'books.author',
        'books.cover_image', // optional column if you have it
        'books.price'        // optional column if you have it
    )
    ->latest('book_reviews.created_at')
    ->take(6)
    ->get();
        return view('contact', compact('reviews'));
    }


    public function showCart()
    {
        return view('cart');
    }

    public function showBlog()
    {
        return view('blog');
    }

    public function showAbout()
    {
        return view('about');
    }

    public function test()
    {
        $cart = Auth::user()->cart()->with('items.book')->first();

        $cartItems = $cart ? $cart->items : collect();

        $total = $cartItems->sum(fn($item) => $item->book->price);



        return response()->json([
            'html' => view('components.cart-dropdown-content', [
                'cartItems' => $cartItems,
                'total' => $total
            ])->render()
        ]);
    }
}
