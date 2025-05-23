@extends('admin.layouts.main')

@section('content')

<div class="row">
  <div class="col-md-12 mb-2">
    <div class="row">
      <div class="col-12 col-xl-8 mb-4 mb-xl-0">
        <h3 class="font-weight-bold">Genres</h3>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-6">
    <div class="admin-card bg-white p-4 rounded shadow">
      <div class="table-responsive">
        <table id="genresTable" class="table text-left table-bordered table-hover">
          <thead class="bg-gray-100">
            <tr>
              <th class="text-center">Genre Name</th>
              <th class="text-center">Created At</th>
              <th class="text-center">Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($genres as $genre)
            <tr class="border-t">
              <td class="px-4 py-2">{{ $genre->name }}</td>
              <td class="px-4 py-2">{{ $genre->created_at }}</td>
              <td class="px-4 py-2 text-center">
                <form action="{{ route('genres-delete') }}" method="POST" onsubmit="return confirm('Delete this genre?');">
                  @csrf
                  @method('DELETE')
                  <button type="submit" style="all: unset; cursor: pointer;" class="text-red-600 hover:text-red-800">
                    <i class="bi bi-trash3-fill text-danger"></i>
                  </button>
                  <input type="hidden" value="{{ $genre->id }}" name="id">
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    <button type="button" class="btn btn-primary mt-3 float-start" data-bs-toggle="modal" data-bs-target="#addgenreModal">
      Add Genre
    </button>
  </div>

<div class="col-6 mt-0">
  <div class="admin-card bg-white p-4 rounded shadow">
    <h5 class="mb-3">Top 5 Genres by Total Quantity Sold</h5>
    <canvas id="genreChart"></canvas>
  </div>
</div>

</div>



<div class="modal fade" id="addgenreModal" tabindex="-1" aria-labelledby="addgenreModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addgenreModalLabel">Add Genre</h5>
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



@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  
<script>
  document.addEventListener('DOMContentLoaded', function() {
    $('#genresTable').DataTable({
      paging: false,
      info: false,
      ordering: true,
      searching: true,
      scrollY: '380px', // <-- Set fixed height
      scrollCollapse: true, // <-- Collapse if not full height
      dom: "<'d-flex justify-content-start mb-2'f>t",
    });
  });

   const genreData = @json($topGenres);

    const ctx = document.getElementById('genreChart').getContext('2d');
    const chart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: genreData.map(g => g.name),
        datasets: [{
          label: 'Books Sold',
          data: genreData.map(g => g.total_quantity ?? 0),
          backgroundColor: 'rgba(54, 162, 235, 0.6)',
          borderColor: 'rgba(54, 162, 235, 1)',
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        scales: {
          y: {
            beginAtZero: true,
            ticks: {
              precision: 0
            }
          }
        }
      }
    });
</script>
@endpush