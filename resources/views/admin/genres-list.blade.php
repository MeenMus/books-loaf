<!DOCTYPE html>
<html>

<body>

  @include('admin.layouts.sidebar')

  <div class="main-content p-6">
    <div class="flex justify-between items-center mb-6">
      <h3 class="text-2xl font-bold">Genres</h3>
    </div>

    <div class="row">
      <div class="col-6 mx-auto p-3">
        <div class="admin-card bg-white p-4 rounded shadow">
          <div class="table-responsive">
            <table id="genresTable" class="table text-left table-bordered table-hover">
              <thead class="bg-gray-100">
                <tr>
                  <th class="px-4 py-2">Genre Name</th>
                  <th class="px-4 py-2 text-center">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($genres as $genre)
                <tr class="border-t">
                  <td class="px-4 py-2">{{ $genre->name }}</td>
                  <td class="px-4 py-2 text-center">
                    <form action="{{ route('genres-delete') }}" method="POST" onsubmit="return confirm('Delete this genre?');">
                      @csrf
                      <button type="submit" style="all: unset; cursor: pointer;" class="text-red-600 hover:text-red-800">
                        <i class="bi bi-trash3-fill text-danger"></i>
                      </button>
                      <input type="hidden" value="{{$genre->id}}" name="id">
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        <button type="button" class="btn btn-primary mt-3 float-end" data-bs-toggle="modal" data-bs-target="#addgenreModal">
          Add Genre
        </button>
      </div>
    </div>
  </div>

  @include('admin.layouts.footer')

  <div class="modal fade" id="addgenreModal" tabindex="-1" aria-labelledby="addgenreModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addgenreModalLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('genres-store') }}" method="POST">
          @csrf
          <div class="modal-body">
            <div class="mb-3">
              <label for="genre" class="form-label">Genre Name</label>
              <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="modal-footer ">
              <button type="submit" class="btn btn-success">Save changes</button>
            </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      $('#genresTable').DataTable({
        paging: false,
        info: false,
        ordering: false,
        searching: true,
        scrollCollapse: true,
        dom: 'f'
      });
    });
  </script>
</body>


</html>