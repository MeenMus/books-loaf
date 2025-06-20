<?php

namespace App\Http\Controllers\Customer;

use App\Models\SupportTicket;
use App\Models\SupportTicketReply;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class SupportTicketController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function store(Request $request)
    {
        $request->validate([
            'phone' => 'required|string|max:20',
            'subject' => 'required|string',
            'message' => 'required|string',
        ]);

        SupportTicket::create([
            'user_id' => auth()->id(),
            'subject' => $request->subject,
            'message' => $request->message,
            'status' => 'open', // default status
        ]);
        Alert::success('Success!', 'Your support ticket has been received. We’ll get back to you shortly!');
        return redirect()->back()->with('ticket_submitted', true);
    }


    public function showReplyForm($id)
    {
        $ticket = SupportTicket::with('replies')->findOrFail($id);

        // Optionally check if the logged-in user owns the ticket
        return view('support-reply', compact('ticket'));
    }

    public function submitReply(Request $request, $id)
    {
        $ticket = SupportTicket::findOrFail($id);

        // Optionally validate that user owns this ticket
        SupportTicketReply::create([
            'support_ticket_id' => $ticket->id,
            'user_id' => auth()->id(), // Or null if guest
            'message' => $request->message,
        ]);

        $ticket->update(['status' => 'open']);

        Alert::success('Success!', 'Your reply has been sent!');
        return redirect()->route('support-reply-form', $ticket->id);
    }

    public function index(Request $request)
    {
        $query = SupportTicket::where('user_id', auth()->id());

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('subject', 'like', "%$search%")
                    ->orWhere('id', $search);
            });
        }

        if ($request->start_date) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->end_date) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        if ($request->sort === 'oldest') {
            $query->orderBy('created_at', 'asc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $tickets = $query->paginate(5);

        return view('support', compact('tickets'));
    }
}
