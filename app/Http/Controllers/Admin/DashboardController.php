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


class DashboardController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function admintemplate() {

        return view('admin.admin-template');
    }
    public function showDashboard()
    {
        $totalBooks = Book::count();
        $totalGenres = Genre::count();
        $totalOrders = Order::count();
        $totalUsers = User::count();
        $totalUnitsSold = OrderItem::count();
        $totalRevenue = OrderItem::sum('price');
        $totalOrdersPrice = Order::sum('total_price');



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


        return view('admin.dashboard', compact(
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
            'totalOrdersPrice'
        ));
    }
}
