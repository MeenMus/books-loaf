@extends('admin.layouts.main')

@section('content')


<div class="row">
  <div class="col-md-12 mb-2">
    <div class="row">
      <div class="col-12 col-xl-8 mb-4 mb-xl-0">
        <h3 class="font-weight-bold">Upload Banners</h3>
      </div>
    </div>
  </div>
</div>


<div class="admin-card">
  <div class="card-body mb-5">
    <form method="POST" action="{{ route('banners-store') }}" enctype="multipart/form-data">
      @csrf

      @for ($i = 1; $i <= 3; $i++)
        <div class="mb-4">
          <label for="banner{{ $i }}" class="form-label">Banner {{ $i }} (851 x 315)</label>
          <input type="file" name="banners[{{ $i }}]" id="banner{{ $i }}" class="form-control" accept="image/*" onchange="previewImage(event, {{ $i }})">

          <div class="mt-2" style="width: 310px; aspect-ratio: 851 / 315; background-color: #f0f0f0; border: 1px solid #ccc; overflow: hidden;">
            <img id="preview{{ $i }}" src="{{ asset('banners/banner-' . $i . '.png') }}?v={{ time() }}" style="width: 100%; height: 100%; object-fit: cover;">
          </div>
        </div>
      @endfor

      <button type="submit" class="btn btn-primary float-end">Upload Banners</button>
    </form>
  </div>
</div>

@endsection

@push('scripts')
<script>
  function previewImage(event, index) {
    const input = event.target;
    const preview = document.getElementById('preview' + index);

    if (input.files && input.files[0]) {
      const reader = new FileReader();
      reader.onload = function(e) {
        preview.src = e.target.result;
      };
      reader.readAsDataURL(input.files[0]);
    }
  }
</script>
@endpush