<!DOCTYPE html>
<html>

@include('layouts.header')

<body>

  @include('layouts.navbar')


  <section class="checkout-wrap padding-medium">
    <div class="container">
      <form action="{{ route('checkout-stripe') }}" method="POST">
        @csrf
        <div class="row d-flex flex-wrap">
          <div class="col-lg-6">
            <h3 class="mb-3">Billing Details</h3>
            <div class="billing-details">
              <label for="name">Full Name *</label>
              <input type="text" id="name" name="name" value="{{ auth()->user()->name ?? '' }}" class="form-control mt-2 mb-4 ps-3">
              <label for="cname">Country *</label>
              <select id="country" name="country" class="form-select text-dark mb-4 mt-2">
                <option value="">Country</option>
              </select>
              <label for="address">Address *</label>
              <input type="text" id="address_line_1" name="address_line_1" value="{{ auth()->user()->profile->address_line_1 ?? '' }}" placeholder="Address Line 1" class="form-control mt-3 ps-3 mb-3">
              <input type="text" id="address_line_2" name="address_line_2" value="{{ auth()->user()->profile->address_line_2 ?? '' }}" placeholder="Address Line 2" class="form-control ps-3 mb-4">
              <label for="city">Town / City *</label>
              <input type="text" id="city" name="city" name="address_line_2" value="{{ auth()->user()->profile->city ?? '' }}" class="form-control mt-3 ps-3 mb-4">
              <label for="state">State *</label>
              <select id="state" name="state" class="form-select text-dark  mt-2 mb-4">
                <option value="">State</option>
              </select>
              <label for="postal_code">Postal Code *</label>
              <input type="text" id="postal_code" name="postal_code" value="{{ auth()->user()->profile->postal_code ?? '' }}" class="form-control mt-2 mb-4 ps-3">

              <label for="email">Email address *</label>
              <input type="text" id="email" name="email" value="{{ auth()->user()->email ?? '' }}" class="form-control mt-2 mb-4 ps-3">

              <div class="mt-2 mb-4 ">
                <label for="phone" class="form-label">Phone *</label>
                <br>
                <input type="tel" id="phone" name="phone" class="form-control" value="{{ auth()->user()->profile->phone ?? '' }}">
              </div>

            </div>
          </div>
          <div class="col-lg-5 ms-5" style="float: right;">
            <div class="cart-totals pb-0">
              <h3 class="mb-3">Cart Totals</h3>
              <div class="total-price pb-3">
                <div style="max-height: 650px; overflow-y: auto;">
                  <table cellspacing="0" class="table text-capitalize align-middle mb-0">
                    <tbody>
                      @foreach ($cart->items as $item)
                      <tr>
                        <td class="w-25">
                          <img src="{{ url($item->book->cover_image) }}" alt="{{ $item->book->title }}" class="img-fluid rounded" style="max-height: 150px;">
                        </td>
                        <td>
                          <a href="{{ url('book', $item->book->id) }}">{{ $item->book->title }}</a>
                          <div class="text-dark small mt-2">Qty: {{ $item->quantity }}</div>
                        </td>
                        <td class="text-end text-primary px-4">
                          RM{{ number_format($item->book->price * $item->quantity, 2) }}
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>

                <table class="table text-capitalize align-middle mt-3">
                  <tbody>
                    <tr class="order-total pt-2 pb-2 border-top border-bottom">
                      <th>Shipping Fee</th>
                      <td colspan="2" data-title="Total" class="text-end px-4">
                        <span class="price-amount amount text-primary ps-5 fw-light">
                          <bdi>
                            <span class="price-currency-symbol">RM</span>10.00
                          </bdi>
                        </span>
                      </td>
                    </tr>
                    <tr class="order-total pt-2 pb-2 border-top border-bottom">
                      <th>Total</th>
                      <td colspan="2" data-title="Total" class="text-end px-4">
                        <span class="price-amount amount text-primary ps-5 fw-light">
                          <bdi>
                            <span class="price-currency-symbol">RM</span>{{ number_format($cart->items->sum(fn($item) => $item->book->price * $item->quantity+10), 2) }}
                          </bdi>
                        </span>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="button-wrap mt-2 text-end">
                <a href="{{ url('cart') }}" class="btn btn-dark mx-1">Back to cart</a>
                <button type="submit" class="btn">Place an order</button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </section>

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

</body>


</html>