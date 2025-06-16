<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SupportTicket;
use App\Models\Book;
use App\Models\Genre;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\BookReview;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class SupportTicketController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index(Request $request)
{
    $query = SupportTicket::with('user');

    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    if ($request->filled('start_date')) {
        $query->whereDate('created_at', '>=', $request->start_date);
    }

    if ($request->filled('end_date')) {
        $query->whereDate('created_at', '<=', $request->end_date);
    }

    $tickets = $query->latest()->get();

    return view('admin.support_tickets', compact('tickets'));
}

public function showSupportTickets($id)
{
    $ticket = SupportTicket::with('user')->findOrFail($id);
    return view('admin.support_tickets_show', compact('ticket'));
}

public function update(Request $request, $id)
{
    $ticket = SupportTicket::findOrFail($id);
    $ticket->status = $request->status;
    $ticket->save();

    return redirect()->back()->with('success', 'Ticket status updated successfully.');
}


}
