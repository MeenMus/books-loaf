<!DOCTYPE html>
<html>


@include('layouts.header')


<body>

  @include('layouts.navbar')

  <div class="shopify-grid padding-medium">
    <div class="container">
      <div class="row flex-row-reverse">
        <main class="col-lg-9 d-flex flex-column">
          <div class="mb-5">
            <div>
              <h4 class="mb-4 mt-2">Profile Details</h4>
              <form action="{{ route('profile-update') }}" method="POST">
                @csrf
                <div class="billing-details">
                  <label for="name">Full Name</label>
                  <input type="text" id="name" name="name" value="{{ auth()->user()->name ?? '' }}" class="form-control mt-2 mb-4 ps-3">
                  <label for="cname">Country</label>
                  <select id="country" name="country" class="form-select text-dark mb-4 mt-2">
                    <option value="">Country</option>
                  </select>
                  <label for="address">Address</label>
                  <input type="text" id="address_line_1" name="address_line_1" value="{{ auth()->user()->profile->address_line_1 ?? '' }}" placeholder="Address Line 1" class="form-control mt-3 ps-3 mb-3">
                  <input type="text" id="address_line_2" name="address_line_2" value="{{ auth()->user()->profile->address_line_2 ?? '' }}" placeholder="Address Line 2" class="form-control ps-3 mb-4">
                  <label for="city">Town / City</label>
                  <input type="text" id="city" name="city" name="address_line_2" value="{{ auth()->user()->profile->city ?? '' }}" class="form-control mt-3 ps-3 mb-4">
                  <label for="state">State</label>
                  <select id="state" name="state" class="form-select text-dark  mt-2 mb-4">
                    <option value="">State</option>
                  </select>
                  <label for="postal_code">Postal Code</label>
                  <input type="text" id="postal_code" name="postal_code" value="{{ auth()->user()->profile->postal_code ?? '' }}" class="form-control mt-2 mb-4 ps-3">

                  <label for="email">Email address</label>
                  <input type="text" id="email" name="email" value="{{ auth()->user()->email ?? '' }}" class="form-control mt-2 mb-4 ps-3">

                  <div class="mt-2 mb-4 ">
                    <label for="phone" class="form-label">Phone</label>
                    <br>
                    <input type="tel" id="phone" name="phone" class="form-control" value="{{ auth()->user()->profile->phone ?? '' }}">
                  </div>
                </div>
                <button type="submit" class="btn mt-3 float-end">Update Profile</button>
              </form>
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
</body>


</html>