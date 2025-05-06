<!DOCTYPE html>
<html>

<body>

  @include('admin.layouts.sidebar')

  <div class="main-content">
    <h3 class="text-2xl font-bold mb-6">Book Creator</h3>

    <div class="row g-4">
      <!-- Form Card -->
      <div class="col-lg-7">
        <div class="admin-card">
          <div class="card-body">
            <form action="{{ route('books-store') }}" method="POST" enctype="multipart/form-data">
              @csrf

              <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
              </div>

              <div class="mb-3">
                <label for="author" class="form-label">Author</label>
                <input type="text" class="form-control" id="author" name="author" required>
              </div>

              <div class="mb-3">
                <label for="isbn" class="form-label">ISBN</label>
                <input type="text" class="form-control" id="isbn" name="isbn" required>
              </div>

              <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
              </div>

              <div class="mb-3">
                <label for="genre" class="form-label">Genre</label>
                <select class="form-select" id="genre" name="genre[]" multiple required>
                  @foreach($genres as $genre)
                  <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                  @endforeach
                </select>
              </div>

              <div class="mb-3">
                <label for="price" class="form-label">Price (MYR)</label>
                <input type="number" step="0.01" class="form-control" id="price" name="price" required>
              </div>

              <div class="mb-3">
                <label for="stock" class="form-label">Stock</label>
                <input type="number" class="form-control" id="stock" name="stock" required>
              </div>

              <div class="mb-3">
                <label for="cover_image" class="form-label">Cover Image</label>
                <input class="form-control" type="file" id="cover_image" name="cover_image" accept="image/*" onchange="previewImage(event)">
              </div>

              <div class="text-end mt-4">
                <button type="submit" class="btn btn-primary">Create Book</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="col-lg-5">
        <div class="admin-card d-flex flex-column align-items-center text-center">
          <h4 class="mb-4 text-bold">Cover Preview</h4>
          <div style="width: 310px; aspect-ratio: 845 / 1206; background-color: #f0f0f0; border: 1px solid #ccc; overflow: hidden;">
            <img id="imagePreview" src="#" alt="No image selected" style="width: 100%; height: 100%; object-fit: cover; display: none;" />
          </div>
        </div>
      </div>

    </div>

    @include('admin.layouts.footer')

    <script>
      function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('imagePreview');

        if (input.files && input.files[0]) {
          const reader = new FileReader();

          reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
          };

          reader.readAsDataURL(input.files[0]);
        }
      }

      $(document).ready(function() {
        $('#genre').select2({
          theme: 'bootstrap-5',
          placeholder: 'Select genres',
          width: '100%' // ensures it fits in the form nicely
        });
      });
    </script>
    



</body>


</html>