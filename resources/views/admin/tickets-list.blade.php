@extends('admin.layouts.main')

@section('content')

<div class="row">
    <div class="col-md-12 mb-2">
        <div class="row">
            <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                <h3 class="font-weight-bold">Support Tickets</h3>
            </div>
        </div>
    </div>
</div>

<div class="admin-card bg-white p-4 rounded shadow">
    <form method="GET" class="row align-items-end mb-4">
        <div class="col-md-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-select form-select-sm text-dark">
                <option value="">All</option>
                <option value="open" {{ request('status') === 'open' ? 'selected' : '' }}>Open</option>
                <option value="resolved" {{ request('status') === 'resolved' ? 'selected' : '' }}>Resolved</option>
                <option value="closed" {{ request('status') === 'closed' ? 'selected' : '' }}>Closed</option>
            </select>
        </div>
        <div class="col-md-3">
            <label class="form-label">Date From</label>
            <input type="date" name="start_date" class="form-control form-control-sm" value="{{ request('start_date') }}">
        </div>
        <div class="col-md-3">
            <label class="form-label">Date To</label>
            <input type="date" name="end_date" class="form-control form-control-sm" value="{{ request('end_date') }}">
        </div>
        <div class="col-md-3 d-flex gap-1">
            <button type="submit" class="btn btn-primary btn-sm px-3">Filter</button>
            <a href="{{ route('tickets-list') }}" class="btn btn-dark btn-sm">Reset</a>
        </div>
    </form>

    <div class="table-responsive">
        <table id="ticketsTable" class="table table-striped table-bordered">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>View</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tickets as $ticket)
                <tr>
                    <td>{{ $ticket->id }}</td>
                    <td>
                        <strong>{{ $ticket->user->name }}</strong><br>
                        <small>{{ $ticket->user->email }}</small>
                    </td>
                    <td>{{ ucfirst($ticket->subject) }}</td>
                    <td style="white-space: pre-line;">{{ Str::limit($ticket->message, 100) }}</td>
                    <td>
                        <span class="badge p-2 fw-semibold bg-{{ $ticket->status === 'resolved' ? 'warning' : ($ticket->status === 'closed' ? 'success' : 'info') }}">
                            {{ ucfirst($ticket->status) }}
                        </span>
                    </td>
                    <td>{{ $ticket->created_at->format('Y-m-d H:i') }}</td>
                    <td>
                        <a href="{{ route('tickets-page', $ticket->id) }}" style="text-decoration: none;">

                            View <i class="bi bi-arrow-right-circle"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#ticketsTable').DataTable({
            pageLength: 10,
            order: [
                [5, 'desc']
            ] // Sort by Created At descending
        });
    });
</script>
@endpush