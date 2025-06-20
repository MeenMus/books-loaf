<!DOCTYPE html>
<html>


@include('layouts.header')

<style>
  .pagination .page-item {
    margin: 0 6px;
    /* increase horizontal gap */
  }
</style>


<body>

  @include('layouts.navbar')

  <div class="shopify-grid padding-medium">
    <div class="container">
      <div class="row flex-row-reverse">
        <main class="col-lg-9 d-flex flex-column">
          <div class="mb-5">
            <div>
              <h4 class="mb-4 mt-2">Your Support Tickets</h4>
            </div>

            <form method="GET" class="row mb-4 align-items-end">
              <div class="col-md-3">
                <input type="text" name="search" class="form-control" placeholder="Search..." value="{{ request('search') }}">
              </div>

              <div class="col-md-2">
                <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
              </div>

              <div class="col-md-2">
                <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
              </div>

              <div class="col-md-2">
                <select name="sort" class="form-select">
                  <option value="latest" {{ request('sort', 'latest') === 'latest' ? 'selected' : '' }}>Latest</option>
                  <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>Oldest</option>
                </select>
              </div>

              <div class="col-md-2 d-flex align-items-center gap-2">
                <button type="submit" class="btn btn-sm py-2 px-3">Search</button>
                <a href="{{ url('support') }}" class="btn btn-dark btn-outline-secondary btn-sm py-2 px-3">Reset</a>
              </div>
            </form>

            @forelse ($tickets as $ticket)
            <div class="card mb-4 shadow-sm">
              <div class="card-body">
                <h5 class="mb-2 fw-bold">Support Ticket #{{ $ticket->id }} — {{ $ticket->subject }}</h5>
                <hr>
                <p class="mb-2" style="white-space: pre-line;">{{ Str::limit($ticket->message, 150) }}</p>
                <hr>
                <div class="d-flex justify-content-between align-items-center">
                  <div>
                    <span class="badge bg-{{ $ticket->status === 'resolved' ? 'success' : ($ticket->status === 'closed' ? 'secondary' : 'warning') }}">
                      {{ ucfirst($ticket->status) }}
                    </span>
                    <small class="ms-2">{{ $ticket->created_at->format('Y-m-d H:i') }}</small>
                  </div>

                  <a href="{{ url('support-reply/' . $ticket->id) }}" class="btn btn-outline-primary btn-sm px-3">
                    View & Reply
                  </a>
                </div>
              </div>
            </div>
            @empty
            <p>No support tickets found.</p>
            @endforelse

            <div class="mt-4">
              {{ $tickets->onEachSide(1)->links('pagination::bootstrap-5') }}
            </div>


        </main>

        <aside class="col-md-3">
          <div class="widget-product-categories">
            <div class="section-title overflow-hidden mb-0">
              <h3 class="d-flex flex-column mb-0">My Account</h3>
            </div>
            <br>
            <div>
              <ul class="product-categories mb-0 sidebar-list list-unstyled">
                <li class="cat-item mb-2">
                  <a href="{{url('profile')}}">Profile Details</a>
                </li>
                <li class="cat-item mb-2">
                  <a href="{{url('orders')}}">Orders</a>
                </li>
                <li class="cat-item">
                  <a href="{{url('support')}}">Support Tickets</a>
                </li>
              </ul>
            </div>
          </div>
        </aside>
      </div>
    </div>
  </div>



  @include('layouts.footer')


</body>


</html>