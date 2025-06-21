@component('mail::message')

# Support Ticket #{{ $ticket->id }}

**Subject:** {{ $ticket->subject }}  
**Last Updated:** {{ $reply->created_at->format('Y-m-d H:i') }}

---

Hi {{ $ticket->user->name }},

{!! nl2br(e($reply->message)) !!}

---

@component('mail::button', ['url' => url('/support-reply/' . $ticket->id)])
Reply to this Ticket
@endcomponent

Thanks,  
BooksLoaf Team  
@endcomponent
