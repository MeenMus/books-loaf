<?php

namespace App\Http\Controllers\Admin;

use App\Mail\OrderStatusUpdatedMail;
use App\Models\Order;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;

class OrderController extends BaseController
{

    public function orderList(Request $request)
    {
        $query = Order::with('orderItems.book');

        // Default to pending if no filters
        if (!$request->hasAny(['status', 'start_date', 'end_date'])) {
            $query->where('status', 'pending');
        }

        // Filter by status if provided
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by date range if provided
        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $orders = $query->latest()->get();

        return view('admin.orders-list', compact('orders'));
    }

    public function orderPage($id)
    {
        $order = Order::with('orderItems.book')->findOrFail($id);

        return view('admin.orders-page', compact('order'));
    }

    public function orderUpdate(Request $request, Order $order)
    {
        try {
            $validated = $request->validate([
                'status' => 'required|in:pending,completed,cancelled,shipped',
                'tracking_id' => 'nullable|string|max:255',
            ]);

            $order->update([
                'status' => $validated['status'],
                'tracking_id' => $validated['tracking_id'] ?? $order->tracking_id,
            ]);

            // Email user about status change
            Mail::to($order->email)->send(new OrderStatusUpdatedMail($order));

            Alert::success('Status Updated!', 'Order #' . $order->id . ' status has been changed to ' . $validated['status']);
            return redirect()->back();
        } catch (ValidationException $e) {
            Alert::error('Submission Error', $e->validator->errors()->first());
            return redirect()->back();
        }
    }


    public function printReceipt(Order $order)
    {
        $order->load('orderItems.book');
        return view('components.orders-receipt', compact('order'));
    }
}
