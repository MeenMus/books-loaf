<!DOCTYPE html>
<html>

<body class="bg-gray-100 min-h-screen flex">

  @include('admin.layouts.sidebar')

  <div class="main-content p-4 sm:p-6">
    <h1 class="text-2xl font-bold mb-6">Admin Dashboard</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      <div class="p-6 bg-white rounded-lg shadow text-center">
        <div class="text-xl font-semibold text-blue-600">📚 Total Books</div>
        <div class="text-3xl font-bold mt-2 text-gray-800">{{ $totalBooks }}</div>
      </div>

      <div class="p-6 bg-white rounded-lg shadow text-center">
        <div class="text-xl font-semibold text-green-600">📂 Total Genres</div>
        <div class="text-3xl font-bold mt-2 text-gray-800">{{ $totalGenres }}</div>
      </div>

      {{-- Placeholder card for users/orders --}}
      <div class="p-6 bg-white rounded-lg shadow text-center">
        <div class="text-xl font-semibold text-red-600">🛒 Orders</div>
        <div class="text-3xl font-bold mt-2 text-gray-800">—</div>
      </div>
    </div>
  </div>

  @include('admin.layouts.footer')

</body>


</html>


