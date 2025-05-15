@extends('admin.layouts.main')

@section('content')

<div class="row">
  <div class="col-md-12 mb-2">
    <div class="row">
      <div class="col-12 col-xl-8 mb-4 mb-xl-0">
        <h3 class="font-weight-bold">User List</h3>
      </div>
    </div>
  </div>
</div>


<div class="admin-card">
  <div class="card-body">
    <div class="table-responsive">
      <table id="usersTable" class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Verified At</th>
            <th>Created At</th>
            <th>Select</th>
          </tr>
        </thead>
        <tbody>
          @foreach($users as $user)
          <tr>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->role}}</td>
            <td>{{$user->email_verified_at}}</td>
            <td>{{$user->created_at}}</td>
            <td>
              <a href="{{ url('users-page/' . $user->id) }}" class="text-blue-600 hover:text-blue-800" style="text-decoration: none;">
                View <i class="bi bi-arrow-right-circle"></i>
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection

@push('scripts')

<script>
  document.addEventListener('DOMContentLoaded', function() {
    $('#usersTable').DataTable();
  });
</script>

@endpush