@extends('admin.layouts.main')

@section('content')

<div class="row">
  <div class="col-md-12 mb-2">
    <div class="row">
      <div class="col-12 col-xl-8 mb-4 mb-xl-0">
        <h3 class="font-weight-bold">Book List</h3>
      </div>
    </div>
  </div>
</div>

<div class="admin-card">
  <!-- Card Content: DataTable -->
  <div class="card-body">
    <div class="table-responsive">
      <table id="booksTable" class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>ISBN</th>
            <th>Title</th>
            <th>Author</th>
            <th>Genre</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Created At</th>
            <th>Select</th>
          </tr>
        </thead>
        <tbody>
          @foreach($books as $book)
          <tr>
            <td>{{$book->isbn}}</td>
            <td style="white-space: normal; ">{{$book->title}}</td>
            <td style="white-space: normal; ">{{$book->author}}</td>
            <td style="white-space: normal; ">{{ $book->genres->pluck('name')->join(', ') }}</td>
            <td>{{$book->price}}</td>
            <td>{{$book->stock}}</td>
            <td>{{$book->created_at}}</td>
            <td>
              <a href="{{ url('books-page/' . $book->id) }}" style="text-decoration: none;">
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
    $('#booksTable').DataTable();
  });
</script>
@endpush