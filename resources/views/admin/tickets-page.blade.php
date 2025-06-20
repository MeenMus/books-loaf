@extends('admin.layouts.main')

@section('content')

<div class="row mb-3">
  <div class="col-12">
    <div class="d-flex justify-content-between align-items-center">
      <h3 class="fw-bold mb-0">Support Ticket #{{ $ticket->id }} — {{ $ticket->subject }}</h3>
      <span class="badge p-2 fs-6 fw-semibold bg-{{ $ticket->status === 'resolved' ? 'success' : ($ticket->status === 'closed' ? 'danger' : 'info') }}">
        {{ ucfirst($ticket->status) }}
      </span>
    </div>
  </div>
</div>

<div class="d-flex justify-content-between align-items-center mb-3">
  <div class="d-flex gap-2">
    @if ($ticket->status !== 'open')
    <form method="POST" action="{{ route('tickets-update', $ticket->id) }}">
      @csrf
      <input type="hidden" name="status" value="open">
      <button type="submit" class="btn btn-info text-light btn-sm fw-semibold">Mark as Open</button>
    </form>
    @endif

    @if ($ticket->status !== 'resolved')
    <form method="POST" action="{{ route('tickets-update', $ticket->id) }}">
      @csrf
      <input type="hidden" name="status" value="resolved">
      <button type="submit" class="btn btn-success text-light btn-sm fw-semibold">Mark as Resolved</button>
    </form>
    @endif

    @if ($ticket->status !== 'closed')
    <form method="POST" action="{{ route('tickets-update', $ticket->id) }}">
      @csrf
      <input type="hidden" name="status" value="closed">
      <button type="submit" class="btn btn-danger text-light btn-sm fw-semibold">Close Ticket</button>
    </form>
    @endif
  </div>
</div>

<div class="row g-4">
  <div class="col-lg-5">
    {{-- User Details Card --}}
    <div class="admin-card mb-3">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="fw-semibold mb-0">User Details</h5>
      </div>
      <hr>
      <div class="card-body">
        <div class="mb-3">
          <label class="form-label small fw-semibold mb-1">Name:</label>
          <p class="mb-0">{{ $ticket->user->name }}</p>
        </div>
        <div class="mb-3">
          <label class="form-label small fw-semibold mb-1">Email:</label>
          <p class="mb-0">{{ $ticket->user->email }}</p>
        </div>
        <div class="mb-3">
          <label class="form-label small fw-semibold mb-1">Phone:</label>
          <p class="mb-0">{{ $ticket->user->phone ?? '-' }}</p>
        </div>
        <div class="mb-0">
          <label class="form-label small fw-semibold mb-1">Submitted At:</label>
          <p class="mb-0">{{ $ticket->created_at->format('Y-m-d H:i') }}</p>
        </div>
      </div>
    </div>

    {{-- Original Ticket Message --}}
    <div class="admin-card p-3">
      <h6 class="fw-semibold mb-2">Ticket Message</h6>
      <hr>
      <p class="mb-0" style="white-space: pre-line;">{{ $ticket->message }}</p>
    </div>
  </div>

  {{-- Ticket Conversation --}}
  <div class="col-lg-7">
    <div class="admin-card p-4">
      <div class="card-header d-flex flex-column">
        <h5 class="fw-semibold mb-0">Ticket History</h5>
      </div>
      <hr>
      <div class="card-body">
        @foreach ($ticket->replies as $reply)
        <div class="mb-4 p-3 rounded {{ $reply->user_id ? 'bg-light' : 'bg-primary text-white' }}">
          <div class="d-flex justify-content-between align-items-center mb-2">
            <strong>{{ $reply->user_id ? $reply->user->name : 'Admin' }}</strong>
            <small>{{ $reply->created_at->format('Y-m-d H:i') }}</small>
          </div>
          <div>{!! nl2br(e($reply->message)) !!}</div>
        </div>
        @endforeach
      </div>
    </div>

    {{-- Reply Form --}}
    <div class="admin-card p-4 mt-4">
      <form method="POST" action="{{ route('ticket-reply', $ticket->id) }}">
        @csrf
        <div class="mb-5">
          <label class="form-label fw-semibold mb-3">Your Reply</label>
          <textarea name="message" class="form-control" rows="8" placeholder="Type your reply..." @if($ticket->status === 'closed') disabled @endif></textarea>
          <button type="submit" class="btn btn-primary float-end text-light fw-semibold mt-3" @if($ticket->status === 'closed') disabled title="This ticket is closed and cannot be replied to." @endif>
            Send Reply
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection