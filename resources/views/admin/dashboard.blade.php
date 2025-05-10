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
        <div class="text-3xl font-bold mt-2 text-gray-800">{{ $totalOrders }}</div>
      </div>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
        <div class="p-6 bg-white rounded-lg shadow text-center">
          <div class="text-xl font-semibold text-purple-600">📈 Units Sold</div>
          <div class="text-3xl font-bold mt-2 text-gray-800">{{ $totalUnitsSold }}</div>
        </div>

        <div class="W-50 p-6 bg-white rounded-lg shadow text-center">
          <div class="text-xl font-semibold text-yellow-600">💰 Revenue (By Each Books)</div>
          <div class="text-3xl font-bold mt-2 text-gray-800">RM {{ number_format($totalRevenueByOrderItem, 2) }}</div>
        </div>

        <div class="p-6 bg-white rounded-lg shadow text-center">
          <div class="text-xl font-semibold text-yellow-600">💰 Revenue (By Total Orders)</div>
          <div class="text-3xl font-bold mt-2 text-gray-800">RM {{ number_format($totalOrdersPrice, 2) }}</div>
        </div>

        <div class="bg-white p-4 mt-4 rounded-lg shadow">
          <h2 class="text-lg font-semibold mb-2 text-gray-800">📆 Sales Over Time (By Each Books)</h2>
          <canvas id="salesChart" height="100"></canvas>
        </div>

        <div class="bg-white p-4 mt-4 rounded-lg shadow">
          <h2 class="text-lg font-semibold mb-2 text-gray-800">📈 Order Status Over Time</h2>
          <canvas id="ordersStatusLineChart" height="100"></canvas>
        </div>

        <div class="bg-white p-4 mt-4 rounded-lg shadow">
          <h2 class="ttext-lg font-semibold mb-2 text-gray-800">💵 Total Order Value Per User</h2>
          <canvas id="userOrderBarChart" height="100"></canvas>
        </div>

        <div class="bg-white p-4 mt-4 rounded-lg shadow">
          <h2 class="text-lg font-semibold mb-2 text-gray-800">📆 Monthly Revenue</h2>
          <canvas id="monthlyRevenueChart" height="100"></canvas>
        </div>
      </div>

    </div>
  </div>

  @include('admin.layouts.footer')

</body>


</html>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  const ctx = document.getElementById('salesChart').getContext('2d');

  const chart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: {!! json_encode($dailySales->pluck('date')) !!},
      datasets: [{
        label: 'Revenue (RM)',
        data: {!! json_encode($dailySales->pluck('total')) !!},
        backgroundColor: 'rgba(59, 130, 246, 0.2)',
        borderColor: 'rgba(59, 130, 246, 1)',
        borderWidth: 2,
        tension: 0.3,
        fill: true
      }]
    },
    options: {
      responsive: true,
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            callback: function(value) {
              return 'RM ' + value;
            }
          }
        }
      }
    }
  });

  const ordersStatusLineChart = new Chart(document.getElementById('ordersStatusLineChart'), {
    type: 'line',
    data: {
      labels: {!! json_encode($ordersByStatusLine->first()->pluck('date')->unique()->values()) !!},
      datasets: [
        @foreach ($ordersByStatusLine as $status => $data)
          {
            label: '{{ ucfirst($status) }}',
            data: {!! json_encode($data->pluck('count')) !!},
            borderColor: '{{ $status === "completed" ? "green" : "red" }}',
            backgroundColor: 'transparent',
            tension: 0.4
          },
        @endforeach
      ]
    },
    options: {
      responsive: true,
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            stepSize: 1
          }
        }
      }
    }
  });

 const userOrderBarChart = new Chart(document.getElementById('userOrderBarChart'), {
    type: 'bar',
    data: {
      labels: {!! json_encode($orderValuePerUser->pluck('name')) !!},
      datasets: [{
        label: 'Total Order Value (RM)',
        data: {!! json_encode($orderValuePerUser->pluck('total')) !!},
        backgroundColor: 'rgba(59, 130, 246, 0.7)',
        borderColor: 'rgba(59, 130, 246, 1)',
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      indexAxis: 'x',
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });

  const monthlyRevenueChart = new Chart(document.getElementById('monthlyRevenueChart'), {
    type: 'bar',
    data: {
      labels: {!! json_encode($monthlyRevenue->pluck('month')) !!},
      datasets: [{
        label: 'Revenue (RM)',
        data: {!! json_encode($monthlyRevenue->pluck('revenue')) !!},
        backgroundColor: 'rgba(34, 197, 94, 0.7)',
        borderColor: 'rgba(34, 197, 94, 1)',
        borderWidth: 1
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

