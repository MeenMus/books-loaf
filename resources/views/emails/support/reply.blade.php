<p>Hi {{ $ticket->user->name }},</p>

<p>{!! nl2br(e($reply->message)) !!}</p>

<p>You can reply to this message by clicking the button below:</p>

<a href="{{ url('/support-reply/' . $ticket->id) }}" style="
  display: inline-block;
  padding: 10px 20px;
  background-color: #4f46e5;
  color: #fff;
  text-decoration: none;
  border-radius: 6px;
  font-weight: bold;
">
    Reply to this Ticket
</a>

<p style="margin-top: 30px;">Thanks,<br>The BooksLoaf Team</p>