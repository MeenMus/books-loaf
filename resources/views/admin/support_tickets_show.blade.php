@extends('admin.layouts.main')

@section('content')

<div class="row mb-3">
  <div class="col-12">
    <h3 class="font-weight-bold">Support Ticket #{{ $ticket->id }}</h3>
  </div>
</div>

<div class="d-flex justify-content-between align-items-center mb-3">
  <div class="d-flex gap-2">
    @if ($ticket->status !== 'open')
    <form method="POST" action="{{ route('supportTickets.update', $ticket->id) }}">
      @csrf
      <input type="hidden" name="status" value="open">
      <button type="submit" class="btn btn-info text-light btn-sm fw-semibold">Mark as Open</button>
    </form>
    @endif
    
    @if ($ticket->status !== 'resolved')
    <form method="POST" action="{{ route('supportTickets.update', $ticket->id) }}">
      @csrf
      <input type="hidden" name="status" value="resolved">
      <button type="submit" class="btn btn-success text-light btn-sm fw-semibold">Mark as Resolved</button>
    </form>
    @endif

    @if ($ticket->status !== 'closed')
    <form method="POST" action="{{ route('supportTickets.update', $ticket->id) }}">
      @csrf
      <input type="hidden" name="status" value="closed">
      <button type="submit" class="btn btn-danger text-light btn-sm fw-semibold">Close Ticket</button>
    </form>
    @endif  
  </div>
</div>

<div class="row g-4">
  <div class="col-lg-5">
    <div class="admin-card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="fw-semibold">User Details</h5>
        <span class="badge p-2 fw-semibold bg-{{ $ticket->status === 'resolved' ? 'success' : ($ticket->status === 'closed' ? 'danger' : 'info') }}">
          {{ ucfirst($ticket->status) }}
        </span>
      </div>
      <hr>
      <div class="card-body">
        <div class="mb-3">
          <label class="form-label small fw-semibold mb-1">Name :</label>
          <p><span class="field-text">{{ $ticket->user->name }}</span></p>
        </div>
        <div class="mb-3">
          <label class="form-label small fw-semibold mb-1">Email :</label>
          <p><span class="field-text">{{ $ticket->user->email }}</span></p>
        </div>
        <div class="mb-3">
          <label class="form-label small fw-semibold mb-1">Phone :</label>
          <p><span class="field-text">{{ $ticket->user->phone ?? '-' }}</span></p>
        </div>
        <div class="mb-3">
          <label class="form-label small fw-semibold mb-1">Submitted At :</label>
          <p><span class="field-text">{{ $ticket->created_at->format('Y-m-d H:i') }}</span></p>
        </div>
      </div>
    </div>
  </div>

  <div class="col-lg-7">
    <div class="admin-card p-4">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="fw-semibold">Ticket Content</h5>
      </div>
      <hr>
      <div class="card-body">
        <div class="mb-3">
          <label class="form-label fw-semibold">Subject</label>
          <p>{{ $ticket->subject }}</p>
        </div>
        <div class="mb-3">
          <label class="form-label fw-semibold">Message</label>
          <p>{{ $ticket->message }}</p>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
