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
use Carbon\Carbon;


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

    $currentYear = Carbon::now()->year;

    // Trending Now: Books with most reviews in current month
    $startOfMonth = Carbon::now()->startOfMonth();
    $endOfMonth = Carbon::now()->endOfMonth();

    $trendingBooks = Book::whereHas('reviews', function ($query) use ($startOfMonth, $endOfMonth) {
            $query->where('rating', 5)
                ->whereBetween('created_at', [$startOfMonth, $endOfMonth]);
        })
        ->withCount(['reviews as five_star_reviews_count' => function ($query) use ($startOfMonth, $endOfMonth) {
            $query->where('rating', 5)
                ->whereBetween('created_at', [$startOfMonth, $endOfMonth]);
        }])
        ->orderByDesc('five_star_reviews_count')
        ->take(3)
        ->get();

    // Get IDs of trending books already shown
    $trendingBookIds = $trendingBooks->pluck('id')->toArray();

    // Top 3 most reviewed books this year, excluding trending ones
    $topBooks = DB::table('book_reviews')
        ->select('book_id', DB::raw('COUNT(*) as review_count'))
        ->whereYear('created_at', $currentYear)
        ->whereNotIn('book_id', $trendingBookIds) // 👈 exclude trending books
        ->groupBy('book_id')
        ->orderByDesc('review_count')
        ->take(3)
        ->pluck('book_id');

    $topBookDetails = Book::whereIn('id', $topBooks)->get();

    // Retrieve full book details with average rating
    $booksOfTheYear = \App\Models\Book::withAvg('reviews', 'rating')
        ->whereIn('id', $topBooks)
        ->get();

        $excludedBookIds = array_merge(
        $trendingBooks->pluck('id')->toArray(),
        $topBookDetails->pluck('id')->toArray()
        );

    $gottaHaveIt = Book::withAvg('reviews', 'rating')
    ->withCount('reviews')
    ->whereHas('reviews', function ($query) {
        $query->where('rating', '>=', 4);
    })
    // 🔴 Removed: ->whereNotIn('id', $excludedBookIds)
    ->having('reviews_avg_rating', '>=', 4.5)
    ->having('reviews_avg_rating', '<=', 5)
    ->having('reviews_count', '>=', 10)
    ->orderByDesc('reviews_avg_rating')
    ->take(3)
    ->get();

    $newArrivals = Book::orderByDesc('created_at')
    ->take(3)
    ->get();

   $bestSellingBooks = DB::table('order_items')
    ->join('orders', 'order_items.order_id', '=', 'orders.id')
    ->join('books', 'order_items.book_id', '=', 'books.id')
    ->select('books.id', 'books.title', 'books.author', 'books.cover_image', 'books.price', DB::raw('SUM(order_items.quantity) as total_sold'))
    ->where('orders.status', 'completed') // adjust to your actual status
    ->groupBy('books.id', 'books.title', 'books.author', 'books.cover_image', 'books.price')
    ->orderByDesc('total_sold')
    ->take(6) // or however many best-sellers you want
    ->get();
    

        return view('index', compact('reviews', 
        'homepageGenres',
        'genreImages',
        'currentYear',
        'topBooks',
        'booksOfTheYear',
        'startOfMonth',
        'endOfMonth',
        'trendingBooks',
        'trendingBookIds',
        'excludedBookIds',
        'trendingBooks',
        'topBookDetails',
        'gottaHaveIt',
        'newArrivals',
        'bestSellingBooks'
    ));
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
