<!DOCTYPE html>
<html>

<body>

  @include('admin.layouts.sidebar')

  <div class="main-content zoom">
    <h3 class="font-bold mb-6">Books</h3>

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
                <th>Select</th>
              </tr>
            </thead>
            <tbody>
              @foreach($books as $book)
              <tr>
                <td>{{$book->isbn}}</td>
                <td>{{$book->title}}</td>
                <td>{{$book->author}}</td>
                <td> {{ $book->genres->pluck('name')->join(', ') }} </td>
                <td>{{$book->price}}</td>
                <td>{{$book->stock}}</td>
                <td>
                  <a href="{{ url('books-page/' . $book->id) }}" class="text-blue-600 hover:text-blue-800" style="text-decoration: none;">
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
      $('#booksTable').DataTable();
    });
  </script>
</body>


</html>