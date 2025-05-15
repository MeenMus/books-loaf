@extends('admin.layouts.main')

@section('content')
<div class="row">
  <div class="col-md-12 grid-margin">
    <div class="row">
      <div class="col-12 col-xl-8 mb-4 mb-xl-0">
        <h3 class="font-weight-bold">Welcome John</h3>
        <h6 class="font-weight-normal mb-0">All systems are running smoothly! You have <span class="text-primary">3 unread alerts!</span></h6>
      </div>
      <div class="col-12 col-xl-4">
        <div class="justify-content-end d-flex">
          <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
            <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button" id="dropdownMenuDate2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
              <i class="mdi mdi-calendar"></i> Today (10 Jan 2021) </button>
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
            <div>
              <h2 class="mb-0 font-weight-normal"><i class="icon-sun me-2"></i>31<sup>C</sup></h2>
            </div>
            <div class="ms-2">
              <h4 class="location font-weight-normal">Chicago</h4>
              <h6 class="font-weight-normal">Illinois</h6>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6 grid-margin transparent">
    <div class="row">
      <div class="col-md-6 mb-4 stretch-card transparent">
        <div class="card card-tale">
          <div class="card-body">
            <p class="mb-4">Today’s Bookings</p>
            <p class="fs-30 mb-2">4006</p>
            <p>10.00% (30 days)</p>
          </div>
        </div>
      </div>
      <div class="col-md-6 mb-4 stretch-card transparent">
        <div class="card card-dark-blue">
          <div class="card-body">
            <p class="mb-4">Total Bookings</p>
            <p class="fs-30 mb-2">61344</p>
            <p>22.00% (30 days)</p>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
        <div class="card card-light-blue">
          <div class="card-body">
            <p class="mb-4">Number of Meetings</p>
            <p class="fs-30 mb-2">34040</p>
            <p>2.00% (30 days)</p>
          </div>
        </div>
      </div>
      <div class="col-md-6 stretch-card transparent">
        <div class="card card-light-danger">
          <div class="card-body">
            <p class="mb-4">Number of Clients</p>
            <p class="fs-30 mb-2">47033</p>
            <p>0.22% (30 days)</p>
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
        <p class="font-weight-500">The total number of sessions within the date range. It is the period time a user is actively engaged with your website, page or app, etc</p>
        <div id="sales-chart-legend" class="chartjs-legend mt-4 mb-2"></div>
        <canvas id="sales-chart"></canvas>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card position-relative">
      <div class="card-body">
        <div id="detailedReports" class="carousel slide detailed-report-carousel position-static pt-2" data-bs-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <div class="row">
                <div class="col-md-12 col-xl-3 d-flex flex-column justify-content-start">
                  <div class="ml-xl-4 mt-3">
                    <p class="card-title">Detailed Reports</p>
                    <h1 class="text-primary">$34040</h1>
                    <h3 class="font-weight-500 mb-xl-4 text-primary">North America</h3>
                    <p class="mb-2 mb-xl-0">The total number of sessions within the date range. It is the period time a user is actively engaged with your website, page or app, etc</p>
                  </div>
                </div>
                <div class="col-md-12 col-xl-9">
                  <div class="row">
                    <div class="col-md-6 border-right">
                      <div class="table-responsive mb-3 mb-md-0 mt-3">
                        <table class="table table-borderless report-table">
                          <tr>
                            <td class="text-muted">Illinois</td>
                            <td class="w-100 px-0">
                              <div class="progress progress-md mx-4">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </td>
                            <td>
                              <h5 class="font-weight-bold mb-0">713</h5>
                            </td>
                          </tr>
                          <tr>
                            <td class="text-muted">Washington</td>
                            <td class="w-100 px-0">
                              <div class="progress progress-md mx-4">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </td>
                            <td>
                              <h5 class="font-weight-bold mb-0">583</h5>
                            </td>
                          </tr>
                          <tr>
                            <td class="text-muted">Mississippi</td>
                            <td class="w-100 px-0">
                              <div class="progress progress-md mx-4">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 95%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </td>
                            <td>
                              <h5 class="font-weight-bold mb-0">924</h5>
                            </td>
                          </tr>
                          <tr>
                            <td class="text-muted">California</td>
                            <td class="w-100 px-0">
                              <div class="progress progress-md mx-4">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </td>
                            <td>
                              <h5 class="font-weight-bold mb-0">664</h5>
                            </td>
                          </tr>
                          <tr>
                            <td class="text-muted">Maryland</td>
                            <td class="w-100 px-0">
                              <div class="progress progress-md mx-4">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </td>
                            <td>
                              <h5 class="font-weight-bold mb-0">560</h5>
                            </td>
                          </tr>
                          <tr>
                            <td class="text-muted">Alaska</td>
                            <td class="w-100 px-0">
                              <div class="progress progress-md mx-4">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </td>
                            <td>
                              <h5 class="font-weight-bold mb-0">793</h5>
                            </td>
                          </tr>
                        </table>
                      </div>
                    </div>
                    <div class="col-md-6 mt-3">
                      <div class="daoughnutchart-wrapper">
                        <canvas id="north-america-chart"></canvas>
                      </div>
                      <div id="north-america-chart-legend">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="carousel-item">
              <div class="row">
                <div class="col-md-12 col-xl-3 d-flex flex-column justify-content-start">
                  <div class="ml-xl-4 mt-3">
                    <p class="card-title">Detailed Reports</p>
                    <h1 class="text-primary">$34040</h1>
                    <h3 class="font-weight-500 mb-xl-4 text-primary">North America</h3>
                    <p class="mb-2 mb-xl-0">The total number of sessions within the date range. It is the period time a user is actively engaged with your website, page or app, etc</p>
                  </div>
                </div>
                <div class="col-md-12 col-xl-9">
                  <div class="row">
                    <div class="col-md-6 border-right">
                      <div class="table-responsive mb-3 mb-md-0 mt-3">
                        <table class="table table-borderless report-table">
                          <tr>
                            <td class="text-muted">Illinois</td>
                            <td class="w-100 px-0">
                              <div class="progress progress-md mx-4">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </td>
                            <td>
                              <h5 class="font-weight-bold mb-0">713</h5>
                            </td>
                          </tr>
                          <tr>
                            <td class="text-muted">Washington</td>
                            <td class="w-100 px-0">
                              <div class="progress progress-md mx-4">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </td>
                            <td>
                              <h5 class="font-weight-bold mb-0">583</h5>
                            </td>
                          </tr>
                          <tr>
                            <td class="text-muted">Mississippi</td>
                            <td class="w-100 px-0">
                              <div class="progress progress-md mx-4">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 95%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </td>
                            <td>
                              <h5 class="font-weight-bold mb-0">924</h5>
                            </td>
                          </tr>
                          <tr>
                            <td class="text-muted">California</td>
                            <td class="w-100 px-0">
                              <div class="progress progress-md mx-4">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </td>
                            <td>
                              <h5 class="font-weight-bold mb-0">664</h5>
                            </td>
                          </tr>
                          <tr>
                            <td class="text-muted">Maryland</td>
                            <td class="w-100 px-0">
                              <div class="progress progress-md mx-4">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </td>
                            <td>
                              <h5 class="font-weight-bold mb-0">560</h5>
                            </td>
                          </tr>
                          <tr>
                            <td class="text-muted">Alaska</td>
                            <td class="w-100 px-0">
                              <div class="progress progress-md mx-4">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </td>
                            <td>
                              <h5 class="font-weight-bold mb-0">793</h5>
                            </td>
                          </tr>
                        </table>
                      </div>
                    </div>
                    <div class="col-md-6 mt-3">
                      <div class="daoughnutchart-wrapper">
                        <canvas id="south-america-chart"></canvas>
                      </div>
                      <div id="south-america-chart-legend"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <a class="carousel-control-prev" href="#detailedReports" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          </a>
          <a class="carousel-control-next" href="#detailedReports" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <p class="card-title mb-0">Top Products</p>
        <div class="table-responsive">
          <table class="table table-striped table-borderless">
            <thead>
              <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Date</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Search Engine Marketing</td>
                <td class="font-weight-bold">$362</td>
                <td>21 Sep 2018</td>
                <td class="font-weight-medium">
                  <div class="badge badge-success">Completed</div>
                </td>
              </tr>
              <tr>
                <td>Search Engine Optimization</td>
                <td class="font-weight-bold">$116</td>
                <td>13 Jun 2018</td>
                <td class="font-weight-medium">
                  <div class="badge badge-success">Completed</div>
                </td>
              </tr>
              <tr>
                <td>Display Advertising</td>
                <td class="font-weight-bold">$551</td>
                <td>28 Sep 2018</td>
                <td class="font-weight-medium">
                  <div class="badge badge-warning">Pending</div>
                </td>
              </tr>
              <tr>
                <td>Pay Per Click Advertising</td>
                <td class="font-weight-bold">$523</td>
                <td>30 Jun 2018</td>
                <td class="font-weight-medium">
                  <div class="badge badge-warning">Pending</div>
                </td>
              </tr>
              <tr>
                <td>E-Mail Marketing</td>
                <td class="font-weight-bold">$781</td>
                <td>01 Nov 2018</td>
                <td class="font-weight-medium">
                  <div class="badge badge-danger">Cancelled</div>
                </td>
              </tr>
              <tr>
                <td>Referral Marketing</td>
                <td class="font-weight-bold">$283</td>
                <td>20 Mar 2018</td>
                <td class="font-weight-medium">
                  <div class="badge badge-warning">Pending</div>
                </td>
              </tr>
              <tr>
                <td>Social media marketing</td>
                <td class="font-weight-bold">$897</td>
                <td>26 Oct 2018</td>
                <td class="font-weight-medium">
                  <div class="badge badge-success">Completed</div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection



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
 -->


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