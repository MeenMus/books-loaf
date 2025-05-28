@extends('admin.layouts.main')

@section('content')

<div class="row">
  <div class="col-md-12 mb-2">
    <div class="row">
      <div class="col-12 col-xl-8 mb-4 mb-xl-0">
        <h3 class="font-weight-bold">User Page</h3>
      </div>
    </div>
  </div>
</div>


<div class="row g-4 align-items-stretch">

  <!-- Profile Section -->
  <div class="col-md-4 d-flex">
   <div class="card p-4 fs-6 w-100 h-200">
      <h4 class="fw-bold">Profile</h4>
      <hr>
      <div class="mb-3">
        <label class="form-label small fw-semibold mb-1">Name :</label>
        <p class="editable-field" data-label="name" data-value="{{ $user->name }}">
          <span class="field-text">{{ $user->name }}</span>
          <span class="edit-overlay"><i class="bi bi-pencil-fill"></i> Edit</span>
        </p>
      </div>
      <div class="mb-3">
        <label class="form-label small fw-semibold mb-1">Email :</label>
        <p class="editable-field" data-label="email" data-value="{{ $user->email }}">
          <span class="field-text">{{ $user->email }}</span>
          <span class="edit-overlay"><i class="bi bi-pencil-fill"></i> Edit</span>
        </p>
      </div>
      <form id="role-form" action="{{ route('users-role-update', ['id' => $user->id]) }}" method="POST">
        @csrf
        <div class="mb-4">
          <label class="form-label small fw-semibold mb-1">Role :</label>
          <select name="role" id="role-dropdown" class="form-select text-dark">
            <option value="customer" {{ $user->role === 'customer' ? 'selected' : '' }}>Customer</option>
            <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
          </select>
        </div>
        <input type="hidden" name="user_id" value="{{ $user->id }}">
      </form>
      <div class="mb-1">
        <label class="form-label small fw-semibold mb-1">Joined At :</label>
        <p>{{ $user->email_verified_at ?? '-' }}</p>
      </div>
      <div class="d-flex gap-2 mt-3">
        <button type="button" class="btn btn-warning btn-sm fw-semibold text-dark" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
          <i class="bi bi-shield-lock-fill"></i> Change Password
        </button>
        <form action="{{ route('users-delete', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?')" class="d-inline">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger btn-sm text-dark fw-semibold">
            <i class="bi bi-trash-fill"></i> Delete User
          </button>
        </form>
      </div>
    </div>
  </div>

  <!-- Orders Section -->
  <div class="col-md-8 d-flex flex-column">
    @foreach ($orders as $order)
   <div class="card mb-4 shadow-sm h-100">
      <div class="row g-0">
        <!-- Left: Order Info -->
        <div class="col-md-3 bg-light p-3 d-flex flex-column justify-content-between">
          <div>
            <h5 class="mb-1">Order #{{ $order->id }}</h5>
            <small>{{ $order->created_at->format('F j, Y') }}</small>
            <hr>
            @php
              $trackingId = $order->tracking_id;
              $trackingUrl = null;
              if (str_starts_with($trackingId, 'MY')) {
                $trackingUrl = "https://gdexpress.com/tracking/?consignmentno=$trackingId";
              } elseif (str_starts_with($trackingId, '65')) {
                $trackingUrl = "https://www.jtexpress.my/tracking/$trackingId";
              } elseif (str_starts_with($trackingId, 'E')) {
                $trackingUrl = "https://tracking.pos.com.my/tracking/$trackingId";
              } elseif (str_starts_with($trackingId, 'NV')) {
                $trackingUrl = "https://www.ninjavan.co/en-my/tracking?id=$trackingId";
              }
            @endphp
            <a href="{{ $trackingUrl ?? '#' }}" class="btn btn-outline-dark px-2 py-2 w-100 mt-1 {{ $trackingUrl ? '' : 'disabled' }}" {{ $trackingUrl ? 'target=_blank' : 'aria-disabled=true' }}>
              Track Shipment
            </a>
          </div>
          <div class="mt-3">
            <div class="fw-bold text-primary mb-1">Total: RM{{ number_format($order->total_price, 2) }}</div>
            <span class="badge bg-{{ $order->status === 'completed' ? 'success' : ($order->status === 'canceled' ? 'danger' : 'warning') }}">
              {{ ucfirst($order->status) }}
            </span>
          </div>
        </div>

        <!-- Right: Shipping and Items -->
        <div class="col-md-9 p-3">
          <div class="mb-3">
            <div class="d-flex justify-content-between align-items-start">
              <strong class="fw-semibold">Shipping to:</strong>
              <a href="{{ route('orders-receipt', $order->id) }}" target="_blank" class="btn btn-outline-dark px-2 py-2" style="font-size: 0.85rem;">
                <i class="bi bi-printer"></i> Receipt
              </a>
            </div>
            {{ $order->name }}<br>
            {{ $order->address_line_1 }}<br>
            @if ($order->address_line_2) {{ $order->address_line_2 }}<br> @endif
            {{ $order->city }}, {{ $order->state }} {{ $order->postal_code }}<br>
            {{ $order->country }}<br>
            <small>Phone: {{ $order->phone }}</small>
          </div>

          <hr>
          <div class="row g-2 mt-2">
            @foreach ($order->orderItems as $item)
            <div class="col-12 d-flex align-items-center justify-content-between">
              <div class="d-flex align-items-center">
                <img src="{{ url($item->book->cover_image) }}" alt="{{ $item->book->title }}" class="img-thumbnail me-3" style="width: 60px; height: auto;">
                <div>
                  <div class="fw-semibold">
                    <a href="{{ url('book', $item->book->id) }}">{{ $item->book->title }}</a>
                  </div>
                  <div class="small">Quantity: {{ $item->quantity }}</div>
                </div>
              </div>
              <div class="text-end text-primary fw-medium">
                RM{{ number_format($item->price, 2) }}
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
    @endforeach

    <div class="mt-4">
      {{ $orders->onEachSide(1)->links('pagination::bootstrap-5') }}
    </div>
  </div>
</div>



<div class="row mt-1 g-4">
  <!-- Address Info -->
  <div class="col-md-4 d-flex">
    <div class="card p-4 fs-6 w-100">
      <h4 class="font-weight-bold">Address Information</h4>
      <hr>

      <form action="{{ route('users-profile-update', ['id' => $user->id]) }}" method="POST">
        @csrf
        <div class="mb-3">
          <label for="phone" class="form-label">Phone</label>
          <input type="tel" id="phone" name="phone" class="form-control" value="{{ old('phone', $profile->phone ?? '') }}">
        </div>

        <div class="mb-3">
          <label for="address_line_1" class="form-label">Address Line 1</label>
          <input type="text" name="address_line_1" id="address_line_1" class="form-control" value="{{ old('address_line_1', $profile->address_line_1 ?? '') }}">
        </div>

        <div class="mb-3">
          <label for="address_line_2" class="form-label">Address Line 2</label>
          <input type="text" name="address_line_2" id="address_line_2" class="form-control" value="{{ old('address_line_2', $profile->address_line_2 ?? '') }}">
        </div>

        <div class="mb-3">
          <label for="city" class="form-label">City</label>
          <input type="text" name="city" id="city" class="form-control" value="{{ old('city', $profile->city ?? '') }}">
        </div>

        <div class="mb-3">
          <label for="country" class="form-label">Country</label>
          <select id="country" name="country" class="form-select text-dark">
            <option value="">Country</option>
          </select>
        </div>

        <div class="mb-3">
          <label for="state" class="form-label">State</label>
          <select id="state" name="state" class="form-select text-dark">
            <option value="">State</option>
          </select>
        </div>

        <div class="mb-3">
          <label for="postal_code" class="form-label">Postal Code</label>
          <input type="text" name="postal_code" id="postal_code" class="form-control" value="{{ old('postal_code', $profile->postal_code ?? '') }}">
        </div>

        <div class="text-end">
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </form>
    </div>
  </div>


<div class="col-md-8 d-flex flex-column gap-4">
  <!-- Card: Top Purchased Books -->
  <div class="card p-4 w-100">
    <h5 class="mb-3">Top Purchased Books</h5>
    <canvas id="topBooksChart" height="200"></canvas>
  </div>

  <!-- Card: Book Categories Breakdown -->
<div class="card p-3 w-100">
  <h5 class="mb-3">Book Categories Breakdown</h5>
  <div style="position: relative; width: 250px; height: 250px; margin: auto;">
    <canvas id="categoryPieChart"></canvas>
  </div>








<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="editForm" method="POST" action="{{ route('users-update', $user->id) }}" class="modal-content">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <label id="fieldLabel" class="form-label"></label>
        <input type="hidden" name="field" id="fieldNameInput">
        <input type="text" name="value" id="editInput" class="form-control">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </form>
  </div>
</div>


<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" action="{{ route('users-update', $user->id) }}" class="modal-content">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="field" value="password">
        <label for="passwordInput" class="form-label">New Password</label>
        <input type="password" name="value" id="passwordInput" class="form-control" required minlength="6">
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Update Password</button>
      </div>
    </form>
  </div>
</div>


@endsection

@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  document.querySelectorAll('.editable-field').forEach(field => {
    field.addEventListener('click', () => {
      const label = field.dataset.label; // 'name' or 'email'
      const value = field.dataset.value;

      // Set modal title and input
      document.getElementById('editModalLabel').innerText = `Edit ${label.charAt(0).toUpperCase() + label.slice(1)}`;
      document.getElementById('fieldLabel').innerText = label.charAt(0).toUpperCase() + label.slice(1);
      document.getElementById('fieldNameInput').value = label;
      document.getElementById('editInput').value = value;

      const modal = new bootstrap.Modal(document.getElementById('editModal'));
      modal.show();
    });
  });


  // Listen for change on the select dropdown
  document.getElementById('role-dropdown').addEventListener('change', function() {
    // Get the new value and the current value
    var newRole = this.value;
    var currentRole = "{{ $user->role }}"; // current role from backend

    // Confirm the change if the new role is different
    if (newRole !== currentRole) {
      var confirmChange = confirm(`Are you sure you want to change the role to "${newRole}"?`);

      // If confirmed, submit the form
      if (confirmChange) {
        document.getElementById('role-form').submit();
      } else {
        // If cancelled, reset the dropdown back to the current role
        this.value = currentRole;
      }
    }
  });


  var user_country_name = "{{ old('country', $profile->country ?? 'Malaysia') }}";
  var user_state_name = "{{ old('state', $profile->state ?? '') }}";

  (() => {
    const country_list = country_and_states.country;
    const state_list = country_and_states.states;

    const id_state_option = document.getElementById("state");
    const id_country_option = document.getElementById("country");

    const create_country_selection = () => {
      let option = '<option value="">Country</option>';
      for (const country_code in country_list) {
        const country_name = country_list[country_code];
        let selected = (country_name === user_country_name) ? ' selected' : '';
        option += `<option value="${country_name}"${selected}>${country_name}</option>`;
      }
      id_country_option.innerHTML = option;
    };

    const create_states_selection = () => {
      const selected_country_name = id_country_option.value;
      const selected_country_code = Object.keys(country_list).find(
        code => country_list[code] === selected_country_name
      );

      const state_names = state_list[selected_country_code];

      if (!state_names) {
        id_state_option.innerHTML = '<option value="">State</option>';
        return;
      }

      let option = '<option value="">State</option>';
      state_names.forEach(state => {
        let selected = (state.name === user_state_name) ? ' selected' : '';
        option += `<option value="${state.name}"${selected}>${state.name}</option>`;
      });
      id_state_option.innerHTML = option;
    };

    id_country_option.addEventListener('change', create_states_selection);

    create_country_selection();
    create_states_selection();
  })();


    document.addEventListener("DOMContentLoaded", function() {
      const phoneInput = document.querySelector("#phone");

      if (phoneInput) {
        const iti = window.intlTelInput(phoneInput, {
          initialCountry: "my",
          preferredCountries: ["my"],
          separateDialCode: true,
          utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
        });

        const form = phoneInput.closest("form");

        form.addEventListener("submit", function() {
          const fullNumber = iti.getNumber(); // e.g. +60123456789
          phoneInput.value = fullNumber; // overwrite before submission
        });
      }
    });

     // Bar chart for Top Purchased Books
  const topBooksCtx = document.getElementById('topBooksChart').getContext('2d');
   const topBooksChart = new Chart(topBooksCtx, {
    type: 'bar',
    data: {
      labels: @json($bookLabels),
      datasets: [{
        label: 'Purchases',
        data: @json($bookQuantities),
        backgroundColor: '#4e73df'
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: { display: false },
        title: { display: true, text: 'Top Purchased Books' }
      }
    }
  });

  // Pie chart for Book Categories
   const genreLabels = @json($genreLabels);
  const genreCounts = @json($genreCounts);

  const categoryCtx = document.getElementById('categoryPieChart').getContext('2d');
  const categoryPieChart = new Chart(categoryCtx, {
    type: 'pie',
    data: {
      labels: genreLabels,
      datasets: [{
        data: genreCounts,
        backgroundColor: [
          '#f6c23e', '#36b9cc', '#e74a3b', '#1cc88a', '#858796',
          '#5a5c69', '#fd7e14', '#6610f2', '#20c997', '#17a2b8'
        ]
      }]
    },
    options: {
      responsive: true,
      plugins: {
        title: { display: true, text: 'Book Categories Breakdown' }
      }
    }
  });
</script>

@endpush