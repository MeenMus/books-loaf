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
              <h4 class="mb-4 mt-2">Your Orders</h4>
            </div>

            <form method="GET" class="row mb-4 align-items-end">
              <div class="col-md-3">
                <input type="text" name="search" class="form-control" placeholder="Search Order ID..." value="{{ request('search') }}">
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
                <a href="{{ url('orders') }}" class="btn btn-dark btn-outline-secondary btn-sm py-2 px-3">Reset</a>
              </div>
            </form>


            @foreach ($orders as $order)
            <div class="card mb-4 shadow-sm">
              <div class="row g-0">
                <!-- Left section with order info -->
                <div class="col-md-3 bg-light p-3 d-flex flex-column justify-content-between">
                  <div>
                    <h5 class="mb-1">Order #{{ $order->id }}</h5>
                    <small class="">{{ $order->created_at->format('F j, Y') }}</small>
                    <hr>

                    @php
                    $trackingId = $order->tracking_id;
                    $trackingUrl = null;

                    if (str_starts_with($trackingId, 'MY')) {
                    $trackingUrl = "https://gdexpress.com/tracking/?consignmentno=$trackingId";
                    } elseif (str_starts_with($trackingId, '65')) {
                    $trackingUrl = "https://www.jtexpress.my/tracking/$trackingId";
                    } elseif (str_starts_with($trackingId, 'E')) {
                    $trackingUrl = "https://tracking.pos.com.my/tracking/$trackingId";
                    } elseif (str_starts_with($trackingId, 'NV')) {
                    $trackingUrl = "https://www.ninjavan.co/en-my/tracking?id=$trackingId";
                    }
                    @endphp

                    <a href="{{ $trackingUrl ?? '#' }}" style="font-size: 0.95rem; line-height: 1;" class="btn btn-outline-dark px-2 py-2 {{ $trackingUrl ? '' : 'disabled' }}" {{ $trackingUrl ? 'target=_blank' : 'aria-disabled=true' }}>
                      Track Shipment
                    </a>

                  </div>

                  <div class="mt-3">
                    <div class="fw-bold text-primary mb-1">Total: RM{{ number_format($order->total_price, 2) }}</div>
                    <span class="badge bg-{{ $order->status === 'completed' ? 'success' : ($order->status === 'canceled' ? 'danger' : 'warning') }}">
                      {{ ucfirst($order->status) }}
                    </span>
                  </div>
                </div>

                <!-- Right section with shipping and items -->
                <div class="col-md-9 p-3">
                  <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-start">
                      <strong class="fw-semibold">Shipping to:</strong>
                      <a href="{{ route('orders-receipt-customer', $order->id) }}" target="_blank"
                        class="btn btn-outline-dark px-2 py-2"
                        style="font-size: 0.85rem; line-height: 1;">
                        <i class="bi bi-printer"></i> Receipt
                      </a>
                    </div>
                    {{ $order->name }}<br>
                    {{ $order->address_line_1 }}<br>
                    @if ($order->address_line_2) {{ $order->address_line_2 }}<br> @endif
                    {{ $order->city }}, {{ $order->state }} {{ $order->postal_code }}<br>
                    {{ $order->country }}<br>
                    <small>Phone: {{ $order->phone }}</small>
                  </div>

                  <div>
                    <hr>
                    <div class="row g-2 mt-2">
                      @foreach ($order->orderItems as $item)
                      <div class="col-12 d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                          <img src="{{ url($item->book->cover_image) }}" alt="{{ $item->book->title }}" class="img-thumbnail me-3" style="width: 60px; height: auto;">
                          <div>
                            <div class="fw-semibold">
                              <a href="{{ url('book', $item->book->id) }}">{{ $item->book->title }}</a>
                            </div>
                            <div class="small">Quantity: {{ $item->quantity }}</div>
                            <!-- Review Button -->
                            <!-- Trigger Button -->
                            <div class="position-relative d-inline-block">

                              @php
                              $hasReviewed = $item->book->reviews->where('user_id', auth()->id())->isNotEmpty();
                              @endphp

                              <button
                                type="button"
                                onclick="toggleReviewDropdown({{ $item->book->id }})"
                                class="d-block fw-medium text-capitalize mt-2"
                                style="background: none; border: none; padding: 0px; color: inherit; font: inherit; cursor: pointer;"
                                onmouseover="if (!this.disabled) this.style.color = 'var(--primary-color)'"
                                onmouseout="if (!this.disabled) this.style.color = 'inherit'"
                                @if($hasReviewed)
                                disabled
                                title="You already submitted a review"
                                @endif>
                                Add Review
                              </button>

                              <!-- Dropdown-style Review Form -->
                              <div id="reviewDropdown-{{ $item->book->id }}" class="card shadow p-3 position-absolute z-3 " style="top: 110%; right: 0; min-width: 400px; display: none;">
                                <form method="POST" action="{{ route('review-update') }}">
                                  @csrf
                                  <input type="hidden" name="book_id" value="{{ $item->book->id }}">

                                  <div class="mb-2">
                                    <label class="form-label">Your Rating:</label>
                                    <div class="d-flex gap-4">
                                      @for ($i = 1; $i <= 5; $i++)
                                        <div class="form-check">
                                        <input class="form-check-input" type="radio" name="rating" value="{{ $i }}" id="rating{{ $item->book->id }}-{{ $i }}" required>
                                        <label class="form-check-label" for="rating{{ $item->book->id }}-{{ $i }}">{{ $i }}★</label>
                                    </div>
                                    @endfor
                                  </div>
                              </div>

                              <hr>
                              <div class="mb-3">
                                <label class="form-label">Your Review:</label>
                                <textarea name="review" class="form-control" rows="3" placeholder="Write your thoughts here..." required></textarea>
                              </div>

                              <button type="submit" class="btn btn-primary btn-sm float-end px-2 py-2" style="font-size: 0.95rem; line-height: 1;">Submit</button>

                              </form>
                            </div>
                          </div>



                        </div>
                      </div>
                      <div class="text-end text-primary fw-medium">
                        RM{{ number_format($item->price, 2) }}
                      </div>
                    </div>
                    @endforeach
                  </div>
                </div>
              </div>
            </div>
          </div>
          @endforeach
          <div class="mt-4">
            {{ $orders->onEachSide(1)->links('pagination::bootstrap-5') }}
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


  <script>
    var user_country_name = "{{ old('country', auth()->user()->profile->country ?? 'Malaysia') }}";
    var user_state_name = "{{ old('state', auth()->user()->profile->state ?? '') }}";

    (() => {
      const country_list = country_and_states.country;
      const state_list = country_and_states.states;

      const id_state_option = document.getElementById("state");
      const id_country_option = document.getElementById("country");

      const create_country_selection = () => {
        let option = '<option value="">Country</option>';
        for (const country_code in country_list) {
          const country_name = country_list[country_code];
          let selected = (country_name === user_country_name) ? ' selected' : '';
          option += `<option value="${country_name}"${selected}>${country_name}</option>`;
        }
        id_country_option.innerHTML = option;
      };

      const create_states_selection = () => {
        const selected_country_name = id_country_option.value;
        const selected_country_code = Object.keys(country_list).find(
          code => country_list[code] === selected_country_name
        );

        const state_names = state_list[selected_country_code];

        if (!state_names) {
          id_state_option.innerHTML = '<option value="">State</option>';
          return;
        }

        let option = '<option value="">State</option>';
        state_names.forEach(state => {
          let selected = (state.name === user_state_name) ? ' selected' : '';
          option += `<option value="${state.name}"${selected}>${state.name}</option>`;
        });
        id_state_option.innerHTML = option;
      };

      id_country_option.addEventListener('change', create_states_selection);

      create_country_selection();
      create_states_selection();
    })();


    document.addEventListener("DOMContentLoaded", function() {
      const phoneInput = document.querySelector("#phone");

      if (phoneInput) {
        const iti = window.intlTelInput(phoneInput, {
          initialCountry: "my",
          preferredCountries: ["my"],
          separateDialCode: true,
          utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
        });

        const form = phoneInput.closest("form");

        form.addEventListener("submit", function() {
          const fullNumber = iti.getNumber(); // e.g. +60123456789
          phoneInput.value = fullNumber; // overwrite before submission
        });
      }
    });
  </script>


  <script>
    function toggleReviewDropdown(bookId) {
      const el = document.getElementById(`reviewDropdown-${bookId}`);

      // Hide other open dropdowns (optional)
      document.querySelectorAll('[id^="reviewDropdown-"]').forEach(dropdown => {
        if (dropdown.id !== `reviewDropdown-${bookId}`) dropdown.style.display = 'none';
      });

      // Toggle visibility
      el.style.display = el.style.display === 'block' ? 'none' : 'block';
    }

    // Optional: Close on click outside
    document.addEventListener('click', function(e) {
      if (!e.target.closest('.position-relative')) {
        document.querySelectorAll('[id^="reviewDropdown-"]').forEach(dropdown => {
          dropdown.style.display = 'none';
        });
      }
    });
  </script>

</body>


</html>