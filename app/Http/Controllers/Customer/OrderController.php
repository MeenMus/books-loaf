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


    public function placeOrder(Request $request)
    {
        try {

            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|regex:/^\+?[1-9]\d{1,14}$/',
                'address_line_1' => 'required|string|max:255',
                'address_line_2' => 'nullable|string|max:255',
                'city' => 'nullable|string|max:255',
                'state' => 'nullable|string|max:255',
                'postal_code' => 'nullable|string|max:20',
                'country' => 'required|string|max:255',
            ]);

            $user = auth()->user();
            $cart = $user->cart()->with('items.book')->first();

            if (!$cart || $cart->items->isEmpty()) {
                return back()->with('error', 'Your cart is empty.');
            }

            DB::transaction(function () use ($user, $cart) {
                $total = $cart->items->sum(fn($item) => $item->book->price * $item->quantity + 10);

                $order = $user->orders()->create([
                    'total_price' => $total,
                    'status' => 'pending',
                    'name' => request('name'),
                    'email' => request('email'),
                    'phone' => request('phone'),
                    'country' => request('country'),
                    'state' => request('state'),
                    'city' => request('city'),
                    'postal_code' => request('postal_code'),
                    'address_line_1' => request('address_line_1'),
                    'address_line_2' => request('address_line_2')
                ]);

                foreach ($cart->items as $item) {
                    $order->orderItems()->create([
                        'book_id' => $item->book_id,
                        'quantity' => $item->quantity,
                        'price' => $item->book->price,
                    ]);
                }

                $cart->items()->delete();
            });

            Alert::success('Order Placed!', 'Order details has been emailed to you.');
            return redirect('cart');
        } catch (ValidationException $e) {
            Alert::error('Submission Error', $e->validator->errors()->first());
            return redirect()->back();
        } catch (\Exception $e) {
            Alert::error('Error', 'Something went wrong. Please try again.');
            return redirect()->back();
        }
    }


    public function printReceipt(Order $order)
    {
        $order->load('orderItems.book');
        return view('components.orders-receipt', compact('order'));
    }
}
