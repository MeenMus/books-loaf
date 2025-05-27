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


<div class="row g-4">
  <div class="col-4 d-flex">
    <div class="card p-4 fs-6 w-100">
      <h4 class="font-weight-bold">Profile</h4>
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
        <p>
          {{ $user->email_verified_at ?? '-' }}
        </p>
      </div>


      <div class="mb-0">
        <div class="d-flex gap-2 mt-3">
          <!-- Change Password Button -->
          <button type="button" class="btn btn-warning btn-sm fw-semibold text-dark" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
            <i class="bi bi-shield-lock-fill"></i> Change Password
          </button>

          <!-- Delete Button -->
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
  </div>
</div>


<div class="row mt-1 g-4">
  <div class="col-4 d-flex">
    <div class="card p-4 fs-6 w-100">
      <h4 class="font-weight-bold">Address Information</h4>
      <hr>

      <form action="{{ route('users-profile-update', ['id' => $user->id]) }}" method="POST">
        @csrf
        <div class="mb-3">
          <label for="phone" class="form-label">Phone</label>
          <br>
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
          <label for="country" class="form-label ">Country</label>
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
</script>

@endpush