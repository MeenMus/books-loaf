<!DOCTYPE html>
<html>

@include('layouts.header')

<body>

  @include('layouts.navbar')

  <section class="cart padding-medium">
    <div class="container">
      <h3 class="mb-4">Your Cart</h3>

      <form action="{{ route('cart-update') }}" method="POST">
        @csrf

        <div class="row">
          <div class="cart-table">
            <div class="cart-header border-bottom border-top">
              <div class="row d-flex text-capitalize">
                <h4 class="col-lg-4 py-3 m-0">Product</h4>
                <h4 class="col-lg-3 py-3 m-0">Quantity</h4>
                <h4 class="col-lg-4 py-3 m-0">Subtotal</h4>
              </div>
            </div>

            @php $total = 0; @endphp
            @foreach ($cartItems as $cartItem)
            @php
            $book = $cartItem->book;
            $subtotal = $book->price * $cartItem->quantity;
            $total += $subtotal;
            $itemId = $cartItem->id;
            @endphp

            <div class="cart-item border-bottom padding-small">
              <div class="row align-items-center">
                <div class="col-lg-4 col-md-3">
                  <div class="cart-info d-flex gap-2 flex-wrap align-items-center">
                    <div class="col-lg-3">
                      <div class="card-image">
                        <img src="{{ url($book->cover_image) }}" alt="cart-img" class="img-fluid border rounded-3">
                      </div>
                    </div>
                    <div class="col-lg-8 px-5">
                      <div class="card-detail">
                        <h5 class="mt-2"><a href="{{ url('book', $book->id) }}">{{ $book->title }}</a></h5>
                        <div class="card-price mt-3">
                          <span class="price text-primary fw-light">RM{{ number_format($book->price, 2) }}</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-lg-6 col-md-7">
                  <div class="row d-flex">
                    <div class="col-lg-6">
                      <div class="product-quantity my-2">
                        <div class="input-group product-qty align-items-center my-1" style="max-width: 150px;">
                          <button type="button" class="btn btn-outline-secondary p-1 d-flex justify-content-center align-items-center" style="width: 32px; height: 32px;" onclick="changeQty(-1, '{{ $itemId }}', {{ $book->stock }})"> &minus;</button>

                          <input
                            type="text"
                            id="quantity-{{ $itemId }}"
                            name="items[{{ $itemId }}][quantity]"
                            class="form-control bg-white shadow border rounded-3 py-2 mx-2 text-center"
                            value="{{ $cartItem->quantity }}"
                            required
                            style="width: 60px;" readonly>

                          <button type="button" class="btn btn-outline-secondary p-1 d-flex justify-content-center align-items-center" style="width: 32px; height: 32px;" onclick="changeQty(1, '{{ $itemId }}', {{ $book->stock }})">&plus;</button>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="total-price">
                        <span class="money fs-2 fw-light text-primary">RM{{ number_format($subtotal, 2) }}</span>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-lg-1 col-md-2 d-flex justify-content-center align-items-center">
                  <a href="#"
                    onclick="submitDeleteForm({{ $cartItem->id }})"
                    class="d-flex justify-content-center align-items-center"
                    style="font-size: 2rem;">
                    <i class="bi bi-cart-x"></i>
                  </a>
                </div>
              </div>
            </div>
            @endforeach
          </div>

          <div class="cart-totals padding-medium pb-5">
            <h3 class="mb-3">Cart Totals</h3>
            <div class="total-price pb-3">
              <table cellspacing="0" class="table text-capitalize">
                <tbody>
                  <tr class="order-total pt-2 pb-2 border-top border-bottom">
                    <th>Total</th>
                    <td data-title="Total">
                      <span class="price-amount amount text-primary ps-5 fw-light">
                        <bdi><span class="price-currency-symbol">RM</span>{{ number_format($total, 2) }}</bdi>
                      </span>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

            <div class="button-wrap d-flex flex-wrap gap-3">
              <button type="submit" name="action" value="update" class="btn btn-outline-dark">Update Cart</button>
              <a href="{{ url('shop/all') }}" class="btn btn-outline-secondary">Continue Shopping</a>
              <button type="submit" name="action" value="checkout" class="btn btn-primary">Proceed to Checkout</button>
            </div>
          </div>
        </div>
      </form>

      @foreach ($cartItems as $cartItem)
      <form id="remove-cart-{{ $cartItem->id }}" action="{{ route('cart-remove', $cartItem->id) }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
      </form>
      @endforeach

    </div>
  </section>


  @include('layouts.footer')

  <script>
    function changeQty(delta, itemId, maxStock) {
      const input = document.getElementById('quantity-' + itemId);
      let quantity = parseInt(input.value) || 1;

      quantity += delta;
      if (quantity < 1) quantity = 1;
      if (quantity > maxStock) quantity = maxStock;

      input.value = quantity;
    }

    function submitDeleteForm(id) {
      const form = document.getElementById('remove-cart-' + id);
      if (form) form.submit();
    }
  </script>

</body>


</html>