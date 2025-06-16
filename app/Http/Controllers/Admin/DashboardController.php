<?php

namespace App\Http\Controllers\Admin;

use App\Models\Book;
use App\Models\Genre;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\BookReview;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Payment;
use App\Models\SupportTicket;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;


class DashboardController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function admintemplate() {
        

        return view('admin.admin-template');
    }

    public function showDashboard()
    {
        $adminName = Auth::user()->name;

        $totalBooks = Book::count();
        $totalGenres = Genre::count();
        $totalOrders = Order::count();
        $totalUsers = User::count();
        $totalReviews = BookReview::count();
        $totalUnitsSold = OrderItem::count();
        $totalRevenue = OrderItem::sum('price');
        $totalOrdersPrice = Order::sum('total_price');
        $unreadAlerts = SupportTicket::where('status', 'open')->count();
           
        
         // Johor Bahru coordinates
            $latitude = 1.4927;
            $longitude = 103.7414;
        
        // Fetch weather data from Open-Meteo
        $weatherResponse = Http::get('https://api.open-meteo.com/v1/forecast', [
            'latitude' => $latitude,
            'longitude' => $longitude,
            'current_weather' => true,
        ]);

        $weatherData = null;
        if ($weatherResponse->successful()) {
            $weatherData = $weatherResponse->json();
        }
    
        // Optional future counts

        // Total units sold (assume each order represents 1 unit unless you have a quantity column elsewhere)
        $totalUnitsSold = OrderItem::count(); // Adjust if you store quantity elsewhere

        // Total revenue
        $totalRevenueByOrderItem = OrderItem::sum('price');

        // Sales by date (grouped daily)
        $dailySales = OrderItem::selectRaw('DATE(created_at) as date, SUM(price) as total')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        // 📊 Orders by status
        $ordersByStatus = Order::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status');

        // Daily order status count (e.g., completed/pending per day)
        $ordersByStatusLine = Order::select(
            DB::raw("DATE(created_at) as date"),
            'status',
            DB::raw("COUNT(*) as count")
        )
            ->groupBy('date', 'status')
            ->orderBy('date')
            ->get()
            ->groupBy('status');

        // Total order value per user (bar chart)
        $orderValuePerUser = DB::table('orders')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->select('users.name', DB::raw('SUM(orders.total_price) as total'))
            ->groupBy('users.name')
            ->orderByDesc('total')
            ->get();

        // Monthly order revenue
        $monthlyRevenue = Order::select(
            DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month"),
            DB::raw("SUM(total_price) as revenue")
        )
            ->groupBy('month')
            ->orderBy('month')
            ->get();

       // Fetch total sales per day grouped by status 'completed' and 'pending'
        $salesData = Order::select(
            DB::raw('DATE(created_at) as date'),
            'status',
            DB::raw('SUM(total_price) as total')
        )
        ->groupBy('date', 'status')
        ->orderBy('date')
        ->get();

        // Extract unique dates sorted
        $dates = $salesData->pluck('date')->unique()->values()->all();
            
        // Prepare online and offline sales arrays aligned with dates
        $onlineSales = [];
        $offlineSales = [];

        foreach ($dates as $date) {
            $online = $salesData->firstWhere(fn($row) => $row->date == $date && $row->status == 'completed');
            $offline = $salesData->firstWhere(fn($row) => $row->date == $date && $row->status == 'pending');

            $onlineSales[] = $online ? (float) $online->total : 0;
            $offlineSales[] = $offline ? (float) $offline->total : 0;
        }

        $monthlyLabels = [];
        $monthlyOnlineSales = [];
        $monthlyOfflineSales = [];

        $monthlyData = Order::selectRaw("
            DATE_FORMAT(created_at, '%Y-%m') as month,
            status,
            SUM(total_price) as total
        ")
        ->groupBy('month', 'status')
        ->orderBy('month')
        ->get()
        ->groupBy('month');

        foreach ($monthlyData as $month => $records) {
            $monthlyLabels[] = \Carbon\Carbon::parse($month . '-01')->format('M');
            $online = $records->where('status', 'completed')->sum('total');
            $offline = $records->where('status', 'pending')->sum('total');

            $monthlyOnlineSales[] = $online;
            $monthlyOfflineSales[] = $offline;
        }

        $booksSoldByGenre = DB::table('order_items')
            ->join('books', 'order_items.book_id', '=', 'books.id')
            ->join('book_genre', 'books.id', '=', 'book_genre.book_id')
            ->join('genres', 'book_genre.genre_id', '=', 'genres.id')
            ->select('genres.name as genre', DB::raw('SUM(order_items.quantity) as total_sold'))
            ->groupBy('genres.name')
            ->orderByDesc('total_sold')
            ->get();

        $newCustomersThisMonth = User::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        $totalCarts = DB::table('carts')->count();

        // Assume users with a cart and an order have converted (not 100% accurate, but practical)
        $convertedCarts = DB::table('carts')
            ->join('orders', 'carts.user_id', '=', 'orders.user_id')
            ->distinct('carts.id')
            ->count();

        $cartAbandonmentRate = $totalCarts > 0
            ? round((($totalCarts - $convertedCarts) / $totalCarts) * 100, 2)
            : 0;

        $newCustomers = User::where('created_at', '>=', Carbon::now()->subDays(30))->count();

        $completedOrders = Order::where('status', 'completed')->count();

        $cartConversionRate = $totalCarts > 0 ? ($completedOrders / $totalCarts) * 100 : 0;

        $topOrders = DB::table('order_items')
        ->join('orders', 'order_items.order_id', '=', 'orders.id')
        ->join('books', 'order_items.book_id', '=', 'books.id')
        ->select(
            'books.title as product',
            DB::raw('order_items.price * order_items.quantity as total_price'),
            'orders.created_at as date',
            'orders.status as order_status'
        )
        ->orderBy('orders.created_at', 'desc')
        ->limit(10)
        ->get();

         // or top-rated books
        Book::withAvg('reviews', 'rating')->take(5)->get();    

        //Rating Books
        $averageRating = BookReview::avg('rating');
            
        // Get top 5 rated books
        $booksWithRatings = Book::withAvg('reviews', 'rating')
            ->orderByDesc('reviews_avg_rating')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'adminName',
            'totalBooks',
            'totalGenres',
            'totalOrders',
            'totalUsers',
            'totalUnitsSold',
            'totalRevenueByOrderItem',
            'dailySales',
            'ordersByStatus',
            'totalUnitsSold',
            'totalRevenue',
            'totalRevenueByOrderItem',
            'ordersByStatusLine',
            'orderValuePerUser',
            'monthlyRevenue',
            'totalOrdersPrice',
            'unreadAlerts',
            'weatherData',
          
            'dates',
            'onlineSales',
            'offlineSales',
            'monthlyLabels',
            'monthlyOnlineSales',
            'monthlyOfflineSales',

            'booksSoldByGenre',
            'cartAbandonmentRate',
            'newCustomersThisMonth',
            'totalCarts',
            'convertedCarts',
            'newCustomers',
            'cartConversionRate',
            'completedOrders',

            'topOrders',

            'totalReviews',
            'averageRating',
            'booksWithRatings'    
        ));
    }
}
