<!DOCTYPE html>
<html>

<body>

  @include('admin.layouts.sidebar')

  <div class="main-content">
    <h3 class="text-2xl font-bold mb-6">Manage Books</h3>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
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
                </tr>
              </thead>
              <tbody>
                <!-- Example rows, replace with dynamic data -->
                <tr>
                  <td>978-3-16-148410-0</td>
                  <td>Book Title</td>
                  <td>Author Name</td>
                  <td>Genre Name</td>
                  <td>$19.99</td>
                  <td>50</td>
                </tr>
                <!-- More rows can be dynamically inserted here -->
              </tbody>
            </table>
          </div>
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