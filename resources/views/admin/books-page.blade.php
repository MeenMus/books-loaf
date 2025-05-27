@extends('admin.layouts.main')

@section('content')

<div class="row">
  <div class="col-md-12 mb-2">
    <div class="row">
      <div class="col-12 col-xl-8 mb-4 mb-xl-0">
        <h3 class="font-weight-bold">Book Page</h3>
      </div>
    </div>
  </div>
</div>

<div class="row row-cols-1 row-cols-md-5 row-cols-lg-2 g-4">
  <div class="col-12 d-flex">
    <div class="card p-4 fs-6">
      <div class="d-flex flex-wrap">
        <!-- Book Cover -->
        <div class="me-4 mb-1 editable-cover" style="flex: 0 0 49%; position: relative; cursor: pointer;">
          <img src="{{ url($book->cover_image) }}" alt="{{ $book->title }}"
            style="width: 100%; height: 100%; object-fit: cover; border-radius: 8px;">
          <div class="cover-overlay">
            <i class="bi bi-pencil-fill me-2"></i> Edit Cover
          </div>
        </div>

        <!-- Book Info -->
        <div style="flex: 1;">

          <h5 class="fw-bold editable-field" data-label="Title" data-value="{{ $book->title }}">
            <span class="field-text"> {{ $book->title }}</span>
            <span class="edit-overlay">
              <i class="bi bi-pencil-fill"></i> Edit
            </span>
            </p>
          </h5>
          <hr>
          <div class="mb-2">
            <label class="form-label small fw-semibold mb-1">Author :</label>
            <p class="editable-field" data-label="Author" data-value="{{ $book->author }}">
              <span class="field-text">{{ $book->author }}</span>
              <span class="edit-overlay">
                <i class="bi bi-pencil-fill"></i> Edit
              </span>
            </p>
          </div>

          <div class="mb-2">
            <label class="form-label small fw-semibold mb-1">Price:</label>
            <p class="editable-field" data-label="Price" data-value="{{ number_format($book->price, 2) }}">
              <span class="field-text">RM {{ number_format($book->price, 2) }}</span>
              <span class="edit-overlay">
                <i class="bi bi-pencil-fill"></i> Edit
              </span>
            </p>
          </div>

          <div class="mb-2">
            <label class="form-label small fw-semibold mb-1">Stock :</label>
            <p class="editable-field" data-label="Stock" data-value="{{ $book->stock }}">
              <span class="field-text">{{ $book->stock }} available</span>
              <span class="edit-overlay">
                <i class="bi bi-pencil-fill"></i> Edit
              </span>
            </p>
          </div>

          <div class="mb-2">
            <label class="form-label small fw-semibold mb-1">Genre :</label>
            <p class="editable-field" data-label="Genre" data-value="{{ $book->genres->pluck('name')->implode(', ') }}">
              <span class="field-text">{{ $book->genres->pluck('name')->implode(', ') }}</span>
              <span class="edit-overlay">
                <i class="bi bi-pencil-fill"></i> Edit
              </span>
            </p>
          </div>

          <div class="mb-2">
            <label class="form-label small fw-semibold mb-1">ISBN :</label>
            <p>
              <span class="field-text">{{ $book->isbn }}</span>
            </p>
          </div>

          <div class="mb-1 d-flex flex-column" style="height: 100px;">
            <form action="{{ route('books-delete', $book->id) }}" method="POST" class="d-inline mt-auto ms-auto">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger btn-sm text-dark fw-semibold" onclick="return confirm('Are you sure you want to delete this book?')"><i class="bi bi-trash-fill"></i> Delete Book</button>
            </form>
          </div>

        </div>
      </div>

      <hr>

      <!-- Description -->
      <div class="mt-1">
        <div class="editable-field" data-label="Description" data-value="{{ $book->description }}" data-type="textarea">
          <span class="field-text">{!! nl2br(e($book->description)) !!}</span>
          <span class="edit-overlay">
            <i class="bi bi-pencil-fill"></i> Edit
          </span>
        </div>
      </div>


    </div>
  </div>

  <!-- Modal -->

  <div class="modal fade" id="coverModal" tabindex="-1" aria-labelledby="coverModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content p-3">
        <div class="modal-header">
          <h5 class="modal-title" id="coverModalLabel">Edit Cover Image</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="coverForm" action="{{ route('books-update-cover', ['id' => $book->id]) }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="modal-body d-flex flex-column align-items-center">
            <h6 class="mb-3 text-bold">Cover Preview</h6>
            <div style="width: 100%; max-width: 310px; aspect-ratio: 845 / 1206; background-color: #f0f0f0; border: 1px solid #ccc; overflow: hidden;">
              <img id="imagePreview" src="#" alt="No image selected" style="width: 100%; height: 100%; object-fit: cover; display: none;" />
            </div>
            <input type="file" name="cover_image" class="form-control mt-4" accept="image/*" onchange="previewImage(event)">
          </div>

          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save Cover</button>
          </div>
        </form>
      </div>
    </div>
  </div>


  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit Book</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="editForm" action="{{ route('books-update', ['id' => $book->id]) }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="modal-body">

            <div class="mb-3" id="generalFieldWrapper">
              <label for="fieldInput" class="form-label" id="fieldLabel"></label>
              <input type="hidden" name="field" id="fieldNameInput">

              <!-- General text input -->
              <input type="text" class="form-control d-none" name="value" id="editInput">

              <!-- Price input -->
              <input type="number" class="form-control d-none" name="value" id="editPrice" step="0.01">

              <!-- Stock input -->
              <input type="number" class="form-control d-none" name="value" id="editStock">

              <!-- Textarea for Description -->
              <textarea class="form-control d-none" name="value" id="editTextarea" rows="15"></textarea>
            </div>

            <!-- Genre Select Wrapper -->
            <div class="mb-3 d-none" id="genreSelectWrapper">
              <label for="genreSelect" class="form-label">Genre</label>
              <select class="form-select" id="genreSelect" name="genre[]" multiple>
                @foreach($genres as $genre)
                <option value="{{ $genre->id }}" data-name="{{ $genre->name }}">{{ $genre->name }}</option>
                @endforeach
              </select>
            </div>

          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
<!-- Monthly Sales Chart -->
<div class="col-12 mt-4">
  <div class="card p-4">
    <h5 class="fw-bold">Monthly Sales Chart (Last 12 Months)</h5>
    <canvas id="salesChart" height="100"></canvas>
  </div>
</div>


</div>


@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const ctx = document.getElementById('salesChart').getContext('2d');
  const salesChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: {!! json_encode($monthlyLabels ?? []) !!},
      datasets: [{
        label: 'Sales',
        data: {!! json_encode($monthlySales ?? []) !!},
        borderColor: 'rgba(75, 192, 192, 1)',
        backgroundColor: 'rgba(75, 192, 192, 0.2)',
        tension: 0.3
      }]
    },
    options: {
      responsive: true,
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>

<script>
  const genreMap = {};
  document.querySelectorAll('#genreSelect option').forEach(option => {
    genreMap[option.value] = option.dataset.name;
  });

  document.querySelectorAll('.editable-field').forEach(field => {

    field.addEventListener('click', () => {
      const label = field.dataset.label;
      const value = field.dataset.value;

      // Set the label and field name
      document.getElementById('fieldLabel').innerText = label;
      document.getElementById('fieldNameInput').value = label;

      // Get all the necessary elements
      const input = document.getElementById('editInput');
      const textarea = document.getElementById('editTextarea');
      const genreWrapper = document.getElementById('genreSelectWrapper');
      const generalWrapper = document.getElementById('generalFieldWrapper');
      const genreSelect = $('#genreSelect');
      const priceInput = document.getElementById('editPrice');
      const stockInput = document.getElementById('editStock');

      // Reset visibility and disable all fields
      input.classList.add('d-none');
      textarea.classList.add('d-none');
      genreWrapper.classList.add('d-none');
      generalWrapper.classList.add('d-none');
      priceInput.classList.add('d-none');
      stockInput.classList.add('d-none');

      input.disabled = true;
      textarea.disabled = true;
      genreSelect.prop('disabled', true);
      priceInput.disabled = true;
      stockInput.disabled = true;

      // Handle each specific label
      if (label === 'Description') {
        // Show the textarea for description
        generalWrapper.classList.remove('d-none');
        textarea.classList.remove('d-none');
        textarea.disabled = false;
        textarea.value = value;

      } else if (label === 'Genre') {
        // Show the genre select dropdown and populate it
        genreWrapper.classList.remove('d-none');
        genreSelect.prop('disabled', false);

        // Clear any previously selected genres
        genreSelect.val(null).trigger('change');

        // Populate genre select with the current genres
        const currentGenres = value.split(',').map(g => g.trim());
        const selectedIds = [];

        // Map the genre names to their ids
        for (const [id, name] of Object.entries(genreMap)) {
          if (currentGenres.includes(name)) {
            selectedIds.push(id);
          }
        }

        genreSelect.val(selectedIds).trigger('change');

      } else if (label === 'Price' || label === 'Stock') {
        // Show the number input for Price and Stock fields
        generalWrapper.classList.remove('d-none');
        if (label === 'Price') {
          priceInput.classList.remove('d-none');
          priceInput.disabled = false;
          priceInput.value = value;
        } else if (label === 'Stock') {
          stockInput.classList.remove('d-none');
          stockInput.disabled = false;
          stockInput.value = value;
        }

      } else {
        // For other fields (Title, Author, etc.)
        generalWrapper.classList.remove('d-none');
        input.classList.remove('d-none');
        input.disabled = false;
        input.value = value;
      }

      // Show the modal with the appropriate field
      const modal = new bootstrap.Modal(document.getElementById('editModal'));
      modal.show();
    });
  });


  $(document).ready(function() {
    $('#genreSelect').select2({
      theme: 'bootstrap-5',
      placeholder: 'Select genres',
      width: '100%'
    });
  });

  /* COVER */

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

  document.querySelector('.editable-cover').addEventListener('click', function() {
    const modal = new bootstrap.Modal(document.getElementById('coverModal'));
    modal.show();
  });
</script>

@endpush