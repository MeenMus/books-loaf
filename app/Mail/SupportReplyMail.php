<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\SupportTicket;
use App\Models\SupportTicketReply;

class SupportReplyMail extends Mailable
{
    use Queueable, SerializesModels;

    public $ticket;
    public $reply;

    /**
     * Create a new message instance.
     */
    public function __construct(SupportTicket $ticket, SupportTicketReply $reply)
    {
        $this->ticket = $ticket;
        $this->reply = $reply;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Support Reply: ' . $this->ticket->subject)
            ->view('emails.support.reply')
            ->with([
                'ticket' => $this->ticket,
                'reply' => $this->reply,
            ]);
    }
}
