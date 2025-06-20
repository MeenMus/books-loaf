@extends('admin.layouts.main')

@section('content')

<div class="row mb-3">
  <div class="col-12">
    <div class="d-flex justify-content-between align-items-center">
      <h3 class="fw-bold mb-0">Manage Order #{{ $order->id }}</h3>
      <span class="badge p-2 fs-6 fw-semibold bg-{{ $order->status === 'completed' ? 'success' : ($order->status === 'cancelled' ? 'danger' : ($order->status === 'shipped' ? 'warning' : 'info')) }}">
        {{ ucfirst($order->status) }}
      </span>
    </div>
  </div>
</div>

<div class="d-flex justify-content-between align-items-center mb-3">
  <div class="d-flex gap-2">
    @if ($order->status !== 'pending')
    <form method="POST" action="{{ route('orders-update', $order->id) }}">
      @csrf
      @method('PATCH')
      <input type="hidden" name="status" value="pending">
      <button type="submit" class="btn btn-info text-light btn-sm fw-semibold">Pending</button>
    </form>
    @endif

    @if ($order->status !== 'completed')
    <form method="POST" action="{{ route('orders-update', $order->id) }}">
      @csrf
      @method('PATCH')
      <input type="hidden" name="status" value="completed">
      <button type="submit" class="btn btn-success text-light btn-sm fw-semibold">Completed</button>
    </form>
    @endif

    @if ($order->status !== 'cancelled')
    <form method="POST" action="{{ route('orders-update', $order->id) }}">
      @csrf
      @method('PATCH')
      <input type="hidden" name="status" value="cancelled">
      <button type="submit" class="btn btn-danger text-light btn-sm fw-semibold">Cancel</button>
    </form>
    @endif
  </div>
</div>

<div class="row g-4">
  <div class="col-lg-5">
    <div class="admin-card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="fw-semibold">Customer Details</h5>
      </div>
      <hr>
      <div class="card-body">
        <div class="mb-3">
          <label class="form-label small fw-semibold mb-1">Name :</label>
          <p>
            <span class="field-text">{{ $order->name }}</span>
          </p>
        </div>
        <div class="mb-3">
          <label class="form-label small fw-semibold mb-1">Email :</label>
          <p>
            <span class="field-text">{{ $order->email }}</span>
          </p>
        </div>
        <div class="mb-3">
          <label class="form-label  small fw-semibold mb-1">Phone :</label>
          <p>
            <span class="field-text">{{ $order->phone }}</span>
          </p>
        </div>


        <div class="mb-3">
          <label class="form-label small fw-semibold mb-1">Address Line 1 :</label>
          <p>
            <span class="field-text">{{ $order->address_line_1  }}</span>
          </p>
        </div>

        <div class="mb-3">
          <label class="form-label small fw-semibold mb-1">Address Line 2 :</label>
          <p>
            <span class="field-text">{{ $order->address_line_2  }}</span>
          </p>
        </div>

        <div class="mb-3">
          <label class="form-label small fw-semibold mb-1">City :</label>
          <p>
            <span class="field-text">{{ $order->city  }}</span>
          </p>
        </div>

        <div class="mb-3">
          <label class="form-label small fw-semibold mb-1">Country :</label>
          <p>
            <span class="field-text">{{ $order->country  }}</span>
          </p>
        </div>
      </div>
    </div>
  </div>

  <div class="col-lg-7">
    <div class="admin-card p-4">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="fw-semibold">Ordered Books</h5>
        <span>
          Total : <span class="text-primary fw-semibold">RM{{ $order->total_price }}</span>
        </span>
      </div>
      <hr>
      <div class="card-body">
        <form method="POST" action="{{ route('orders-update', $order->id) }}">
          @csrf
          @method('PATCH')

          <div class="mb-3">
            @foreach ($order->orderItems as $item)
            <div class="d-flex align-items-center justify-content-between mb-2">
              <div class="d-flex align-items-center">
                <input type="checkbox" class="form-check-input me-3 book-check" name="book_check[]" value="{{ $item->id }}">
                <img src="{{ url($item->book->cover_image) }}" alt="{{ $item->book->title }}" style="width: 60px;" class="me-3 rounded">
                <div>
                  <div class="fw-semibold my-1"><a href="{{ url('books-page/' . $item->book->id) }}" class="text-primary text-decoration-none"> {{ $item->book->title }}</a></div>
                  <div class="small my-1">ISBN: {{ $item->book->isbn }}</div>
                  <div class="small my-1">Quantity: {{ $item->quantity }}</div>
                </div>
              </div>
              <div class="text-primary fw-semibold">RM{{ number_format($item->price, 2) }}</div>
            </div>
            @endforeach
          </div>

          <div class="mb-3">
            <label for="tracking_id" class="form-label">Tracking ID</label>
            <input type="text" name="tracking_id" id="tracking_id" value="{{ $order->tracking_id }}" class="form-control">
          </div>

          <input type="hidden" name="status" value="shipped">
          <button type="submit" class="btn btn-primary w-100" id="mark-complete" disabled>Mark as Shipped</button>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection

@push('scripts')

<script>
  const checkboxes = document.querySelectorAll('.book-check');
  const trackingInput = document.getElementById('tracking_id');
  const submitButton = document.getElementById('mark-complete');

  function updateButtonState() {
    const allChecked = Array.from(checkboxes).every(cb => cb.checked);
    const hasTracking = trackingInput.value.trim() !== '';
    submitButton.disabled = !(allChecked && hasTracking);
  }

  checkboxes.forEach(cb => cb.addEventListener('change', updateButtonState));
  trackingInput.addEventListener('input', updateButtonState);
</script>

@endpush