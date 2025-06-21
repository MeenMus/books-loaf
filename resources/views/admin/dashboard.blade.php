@extends('admin.layouts.main')

@section('content')

<style>
  .progress {
    height: 30px;
    font-size: 1rem;
    background-color: #e9ecef;
    border-radius: 6px;
    overflow: hidden;
  }

  .progress-bar {
    line-height: 30px;
    font-weight: 600;
    color: white;
    transition: width 0.6s ease;
  }

  /* Color coding based on percentage */
  .progress-bar-low {
    background-color: #e74c3c;
    /* red */
  }

  .progress-bar-medium {
    background-color: #f1c40f;
    /* yellow */
    color: black;
  }

  .progress-bar-high {
    background-color: #2ecc71;
    /* green */
  }
</style>


<div class="row">
  <div class="col-md-12 grid-margin">
    <div class="row">
      <div class="col-12 col-xl-8 mb-4 mb-xl-0">
        <h3 class="font-weight-bold">Welcome {{ Auth::user()->name }}</h3>
        <h6 class="font-weight-normal mb-0">
          All systems are running smoothly! You have
          <a href="{{ route('tickets-list') }}" class="text-primary text-decoration-none">
            {{ $unreadAlerts }} open support ticket{{ $unreadAlerts != 1 ? 's' : '' }}
          </a>.
        </h6>

      </div>
      <div class="col-12 col-xl-4">
        <div class="justify-content-end d-flex">
          <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
            <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button" id="dropdownMenuDate2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
              <i class="mdi mdi-calendar"></i> Today ({{ \Carbon\Carbon::now()->format('d M Y') }})
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                <a class="dropdown-item" href="#">January - March</a>
                <a class="dropdown-item" href="#">March - June</a>
                <a class="dropdown-item" href="#">June - August</a>
                <a class="dropdown-item" href="#">August - November</a>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6 grid-margin stretch-card">
    <div class="card tale-bg">
      <div class="card-people mt-auto">
        <img src="{{ asset('images/dashboard/people.svg')}}" alt="people">
        <div class="weather-info">
          <div class="d-flex">
            @if(isset($weatherData['current_weather']))
            <div class="weather-card">
              <h3>Current Weather in Johor Bharu</h3>
              <p>Temperature: {{ $weatherData['current_weather']['temperature'] }}°C</p>
              <p>Wind Speed: {{ $weatherData['current_weather']['windspeed'] }} km/h</p>
              <p>Weather Code: {{ $weatherData['current_weather']['weathercode'] }}</p>
            </div>
            @else
            <p>Weather data is currently unavailable.</p>
            @endif
            <!-- <div>
              <h2 class="mb-0 font-weight-normal"><i class="icon-sun me-2"></i>31<sup>C</sup></h2>
            </div>
            <div class="ms-2">
              <h4 class="location font-weight-normal">Chicago</h4>
              <h6 class="font-weight-normal">Illinois</h6>
            </div> -->
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6 grid-margin transparent">
    <!-- Row 1 -->
    <div class="row">
      <div class="col-md-6 mb-4 stretch-card transparent">
        <div class="card card-tale">
          <div class="card-body">
            <p class="mb-4">📚 Total Books</p>
            <p class="fs-30 mb-2">{{ $totalBooks }} Books</p>
          </div>
        </div>
      </div>
      <div class="col-md-6 mb-4 stretch-card transparent">
        <div class="card card-dark-blue">
          <div class="card-body">
            <p class="mb-4">📂 Total Genres</p>
            <p class="fs-30 mb-2">{{ $totalGenres }} Genres</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Row 2 -->
    <div class="row">
      <div class="col-md-6 mb-4 stretch-card transparent">
        <div class="card card-light-blue">
          <div class="card-body">
            <p class="mb-4">🛒 Orders</p>
            <p class="fs-30 mb-2">{{ $totalOrders }} Total Orders</p>
          </div>
        </div>
      </div>
      <div class="col-md-6 mb-4 stretch-card transparent">
        <div class="card card-light-danger">
          <div class="card-body">
            <p class="mb-4">📈 Units Sold</p>
            <p class="fs-30 mb-2">{{ $totalUnitsSold }} Total Units Sold</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Row 3: Book Reviews + Total Users side-by-side -->
    <div class="row">
      <div class="col-md-6 mb-4 stretch-card transparent">
        <div class="card card-light-success h-100">
          <div class="card-body">
            <p class="mb-4">🌟 Book Reviews</p>
            <p class="fs-30 mb-2">{{ $totalReviews }} Reviews</p>
            <p>Average Rating:
              @for ($i = 1; $i <= 5; $i++)
                <i class="mdi {{ $i <= round($averageRating) ? 'mdi-star text-warning' : 'mdi-star-outline' }}"></i>
              @endfor
              ({{ round($averageRating, 1) }}/5)
            </p>
          </div>
        </div>
      </div>
      <div class="col-md-6 mb-4 stretch-card transparent">
        <div class="card card-light-info h-100">
          <div class="card-body">
            <p class="mb-4">👥 Total Users</p>
            <p class="fs-30 mb-2">{{ $totalUsers }} Users</p>
            <p>Active members on your platform</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between">
          <p class="card-title">Sales Report</p>
          <a href="#" class="text-info">View all</a>
        </div>
        <p class="font-weight-500">
          This chart shows a comparison of Online (Completed) and Offline (Pending) sales per month.
        </p>
        <div id="custom-sales-chart-legend" class="chartjs-legend mt-4 mb-2"></div>
        <div style="height: 350px;">
          <canvas id="custom-sales-chart"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card position-relative">
      <div class="card-body">
        <h4 class="card-title">Insights</h4>

        <!-- Carousel Start -->
        <div id="chartCarousel" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner">
            <!-- Slide 1: Books Sold by Genre -->
            <div class="carousel-item active">
              <div class="row">
                <div class="col-md-6">
                  <!-- Chart Wrapper with Controlled Height -->
                  <div class="chart-wrapper" style="max-width: 600px; height: 500px; margin: auto;">
                    <canvas id="books-pie-chart"></canvas>
                  </div>

                </div>
                <div class="col-md-6">
                  <h4 class="fw-bold">Books Sold by Genre</h4>
                  @php $totalSold = $booksSoldByGenre->sum('total_sold'); @endphp
                  @foreach ($booksSoldByGenre as $genreData)
                  @php
                  $percentage = $totalSold > 0 ? round(($genreData->total_sold / $totalSold) * 100, 2) : 0;
                  $barClass = 'progress-bar-low';
                  if ($percentage >= 70) {
                  $barClass = 'progress-bar-high';
                  } elseif ($percentage >= 40) {
                  $barClass = 'progress-bar-medium';
                  }
                  @endphp
                  <div class="mb-2">
                    {{ $genreData->genre }} ({{ $genreData->total_sold }} books)
                    <div class="progress mt-1">
                      <div class="progress-bar {{ $barClass }}" role="progressbar"
                        style="width: {{ $percentage }}%;"
                        aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100">
                        {{ $percentage }}%
                      </div>
                    </div>
                  </div>
                  @endforeach
                </div>
              </div>
            </div>

            <!-- Slide 2: Metrics Overview -->
            <div class="carousel-item">
              <div class="row">
                <div class="col-md-6">
                  <div class="chart-wrapper" style="max-width: 500px; height: 400px; margin: auto;">
                    <canvas id="metrics-pie-chart"></canvas>
                  </div>

                </div>
                <div class="col-md-6">
                  <h4 class = "fw-bold">Key Metrics This Month</h4>
                  <ul class="list-group">
                    <li class="list-group-item">New Customers: <strong>{{ $newCustomersThisMonth }}</strong></li>
                    <li class="list-group-item">Total Carts: <strong>{{ $totalCarts }}</strong></li>
                    <li class="list-group-item">Completed Orders: <strong>{{ $completedOrders }}</strong></li>
                    <li class="list-group-item">Conversion Rate: <strong>{{ round($cartConversionRate, 2) }}%</strong></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>

          <!-- Carousel Controls -->
          <button class="carousel-control-prev" type="button" data-bs-target="#chartCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#chartCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
          </button>
        </div>
        <!-- Carousel End -->

      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card position-relative">
      <div class="card-body">
        <h4 class="card-title mb-4">Average Book Ratings</h4>

        <div class="d-flex justify-content-center">
          <div style="height: 400px; width: 100%; max-width: 900px; margin: auto;">
            <canvas id="rating-chart"></canvas>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>


<div class="row mt-4">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Top Orders</h4>

        <!-- Table -->
        <div class="table-responsive">
          <table id="top-orders-table" class="table table-striped">
            <thead>
              <tr>
                <th>Product</th>
                <th>Price (RM)</th>
                <th>Date</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($topOrders as $order)
              <tr>
                <td>{{ $order->product }}</td>
                <td>{{ number_format($order->total_price, 2) }}</td>
                <td>{{ \Carbon\Carbon::parse($order->date)->format('d M Y') }}</td>
                <td>
                  <span class="badge p-2 fw-semibold bg-{{ 
                    $order->order_status === 'completed' ? 'success' : 
                    ($order->order_status === 'cancelled' ? 'danger' : 
                    ($order->order_status === 'shipped' ? 'warning text-dark' : 'info')) 
                  }}">
                    {{ ucfirst($order->order_status) }}
                  </span>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>
</div>


@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@endpush

@push('scripts')
<!-- jQuery (required for DataTables) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  $(document).ready(function () {
    $('#top-orders-table').DataTable({
      pageLength: 10,
      lengthChange: false,
      ordering: true,
      language: {
        search: "_INPUT_",
        searchPlaceholder: "Search product..."
      }
    });
  });

  // Existing Bar Chart - DO NOT TOUCH
  const ctxBar = document.getElementById('custom-sales-chart').getContext('2d');
  const customSalesChart = new Chart(ctxBar, {
    type: 'bar',
    data: {
      labels: {!! json_encode($monthlyLabels) !!},
      datasets: [
        {
          label: 'Offline Sales',
          data: {!! json_encode($monthlyOfflineSales) !!},
          backgroundColor: '#98BDFF',
          borderRadius: 5
        },
        {
          label: 'Online Sales',
          data: {!! json_encode($monthlyOnlineSales) !!},
          backgroundColor: '#4B49AC',
          borderRadius: 5
        }
      ]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      scales: {
        x: {
          grid: { display: false },
          ticks: { color: '#6C7383' }
        },
        y: {
          grid: { display: true },
          ticks: {
            color: '#6C7383',
            beginAtZero: true,
            callback: function (value) {
              return value + '$';
            }
          }
        }
      },
      plugins: {
        legend: {
          display: true,
          position: 'top',
          labels: { color: '#333' }
        }
      }
    }
  });

  // Pie Chart: Books Sold by Genre
  const ctxBooks = document.getElementById('books-pie-chart').getContext('2d');
  new Chart(ctxBooks, {
    type: 'pie',
    data: {
      labels: {!! json_encode($booksSoldByGenre->pluck('genre')) !!},
      datasets: [{
        label: 'Books Sold',
        data: {!! json_encode($booksSoldByGenre->pluck('total_sold')) !!},
        backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40'],
        hoverOffset: 4
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: { position: 'bottom' }
      }
    }
  });

  // Metrics Pie Chart
  const ctxMetrics = document.getElementById('metrics-pie-chart').getContext('2d');
  new Chart(ctxMetrics, {
    type: 'pie',
    data: {
      labels: ['New Customers', 'Total Carts', 'Completed Orders'],
      datasets: [{
        label: 'Metrics',
        data: [{{ $newCustomersThisMonth }}, {{ $totalCarts }}, {{ $completedOrders }}],
        backgroundColor: ['#4CAF50', '#FFC107', '#2196F3'],
        hoverOffset: 4
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: { position: 'bottom' }
      }
    }
  });

  // Bar Chart: Average Rating per Book
  const ctxRating = document.getElementById('rating-chart').getContext('2d');
  new Chart(ctxRating, {
    type: 'bar',
    data: {
      labels: {!! json_encode($booksWithRatings->pluck('title')) !!},
      datasets: [{
        label: 'Average Rating',
        data: {!! json_encode($booksWithRatings->pluck('reviews_avg_rating')) !!},
        backgroundColor: '#f39c12',
        borderRadius: 4
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      scales: {
        x: {
          ticks: {
            callback: function(value, index, values) {
              const label = this.getLabelForValue(value);
              return label.length > 15 ? label.slice(0, 15) + '…' : label;
            },
            maxRotation: 0,
            minRotation: 0
          }
        },
        y: {
          beginAtZero: true,
          max: 5,
          ticks: { stepSize: 1 }
        }
      },
      plugins: {
        legend: { display: false },
        tooltip: {
          callbacks: {
            label: function (context) {
              return context.raw + ' ⭐';
            }
          }
        }
      }
    }
  });
</script>

@endpush


<!-- OLD DAHSBOARD HAKIM ONE DO -->

<!--   <div class="main-content p-4 sm:p-6">
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



<script>
  const ctx = document.getElementById('salesChart').getContext('2d');

  const chart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: {
        !!json_encode($dailySales - > pluck('date')) !!
      },
      datasets: [{
        label: 'Revenue (RM)',
        data: {
          !!json_encode($dailySales - > pluck('total')) !!
        },
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
      labels: {
        !!json_encode($ordersByStatusLine - > first() - > pluck('date') - > unique() - > values()) !!
      },
      datasets: [
        @foreach($ordersByStatusLine as $status => $data) {
          label: '{{ ucfirst($status) }}',
          data: {
            !!json_encode($data - > pluck('count')) !!
          },
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
      labels: {
        !!json_encode($orderValuePerUser - > pluck('name')) !!
      },
      datasets: [{
        label: 'Total Order Value (RM)',
        data: {
          !!json_encode($orderValuePerUser - > pluck('total')) !!
        },
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
      labels: {
        !!json_encode($monthlyRevenue - > pluck('month')) !!
      },
      datasets: [{
        label: 'Revenue (RM)',
        data: {
          !!json_encode($monthlyRevenue - > pluck('revenue')) !!
        },
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