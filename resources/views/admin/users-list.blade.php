<!DOCTYPE html>
<html>

<body>

  @include('admin.layouts.sidebar')

  <div class="main-content zoom">
    <h3 class="font-bold mb-6">Users</h3>

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
                    View <i class="bi bi-arrow-right-circle ms-1"></i>
                  </a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  @include('admin.layouts.footer')

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      $('#usersTable').DataTable();
    });
  </script>

</body>


</html>