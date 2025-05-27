@extends('admin.layouts.main')

@section('content')

<div class="row">
  <div class="col-md-12 mb-2">
    <div class="row">
      <div class="col-12 col-xl-8 mb-4 mb-xl-0">
        <h3 class="font-weight-bold">Manage Orders</h3>
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
        <option value="pending" {{ request('status', 'pending') === 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
        <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
        <option value="shipped" {{ request('status') === 'shipped' ? 'selected' : '' }}>Shipped</option>
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
      <a href="{{ url('admin/orders') }}" class="btn btn-dark btn-sm">Reset</a>
    </div>
  </form>

  <div class="table-responsive">
    <table id="ordersTable" class="table table-striped table-bordered">
      <thead class="table-light">
        <tr>
          <th>ID</th>
          <th>Details</th>
          <th>Phone</th>
          <th>Created At</th>
          <th>Updated At</th>
          <th>Total Price (RM)</th>
          <th>Status</th>
          <th>View</th>
          <th>Receipt</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($orders as $order)
        <tr>
          <td>{{ $order->id }}</td>
          <td>
            <strong>{{ $order->name }}</strong><br>
            <small>{{ $order->email }}</small>
          </td>
          <td>{{ $order->phone }}</td>
          <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
          <td>{{ $order->updated_at->format('Y-m-d H:i') }}</td>
          <td>{{ number_format($order->total_price, 2) }}</td>
          <td>
            <span class="badge p-2 fw-semibold bg-{{ $order->status === 'completed' ? 'success' : ($order->status === 'cancelled' ? 'danger' : ($order->status === 'shipped' ? 'warning' : 'info')) }}">
              {{ ucfirst($order->status) }}
            </span>
          </td>
          <td>
            <a href="{{ url('orders-page/' . $order->id) }}" style="text-decoration: none;">
              View <i class="bi bi-arrow-right-circle"></i>
            </a>
          </td>
          <td>
            <a href="{{ route('orders-receipt', $order->id) }}" target="_blank" class="btn btn-outline-dark btn-sm">
              <i class="bi bi-printer"></i> Print
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
    $('#ordersTable').DataTable({
      pageLength: 10,
      order: [
        [4, 'desc']
      ], // sort by Created At descending
    });
  });
</script>
@endpush