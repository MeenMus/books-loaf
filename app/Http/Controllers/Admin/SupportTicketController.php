<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\SupportReplyMail;
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
use App\Models\SupportTicketReply;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class SupportTicketController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function ticketList(Request $request)
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

        return view('admin.tickets-list', compact('tickets'));
    }

    public function ticketPage($id)
    {
        $ticket = SupportTicket::with('user')->findOrFail($id);
        return view('admin.tickets-page', compact('ticket'));
    }

    public function ticketUpdate(Request $request, $id)
    {
        $ticket = SupportTicket::findOrFail($id);
        $ticket->status = $request->status;
        $ticket->save();

        Alert::success('Success!', 'Support ticket status updated!');

        return redirect()->back()->with('success', 'Ticket status updated successfully.');
    }

    public function ticketReply(Request $request, $id)
    {
        $ticket = SupportTicket::findOrFail($id);

        $reply = SupportTicketReply::create([
            'support_ticket_id' => $ticket->id,
            'user_id' => null,
            'message' => $request->message,
        ]);

        // Send email to user
        Mail::to($ticket->user->email)->send(new SupportReplyMail($ticket, $reply));

        Alert::success('Success!', 'Reply has been sent!');

        return back()->with('success', 'Reply sent.');
    }
}
