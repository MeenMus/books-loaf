<?php

namespace App\Http\Controllers\Customer;

use App\Models\Book;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;

class OrderController extends BaseController
{

    public function index(Request $request)
    {
        $query = auth()->user()->orders()->with('orderItems.book');

        // Search by order ID
        if ($request->filled('search')) {
            $query->where('id', $request->search);
        }

        // Filter between dates
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [
                $request->start_date . ' 00:00:00',
                $request->end_date . ' 23:59:59'
            ]);
        }

        // Sorting
        $sort = $request->input('sort', 'latest'); // Default to latest
        if ($sort === 'oldest') {
            $query->orderBy('created_at', 'asc');
        } else {
            $query->orderBy('created_at', 'desc'); // Default: latest
        }

        $orders = $query->paginate(5)->withQueryString();

        return view('orders', compact('orders'));
    }

    public function printReceipt(Order $order)
    {
        $order->load('orderItems.book');
        return view('components.orders-receipt', compact('order'));
    }
}
