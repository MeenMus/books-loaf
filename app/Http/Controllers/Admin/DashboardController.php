<?php

namespace App\Http\Controllers\Admin;

use App\Models\Book;
use App\Models\Genre;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
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
            'offlineSales'
        ));
    }
}
