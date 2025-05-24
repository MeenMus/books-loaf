<!DOCTYPE html>
<html lang="en">

@include('layouts.header')

<body>

  @include('layouts.navbar')

  <section class="single-product padding-large">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="d-flex gap-3 product-preview">
            <div class="swiper  overflow-hidden bg-white" style="max-height: 550px;">
              <img src="{{ url($book->cover_image) }}" alt="single-product"
                class="img-fluid w-100 h-100 object-fit-contain">
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="product-info ps-lg-5 pt-3 pt-lg-0">
            <div class="element-header">
              <h3 class="product-title">{{ $book->title }}</h3>
              <div class="product-price d-flex align-items-center mt-2">
                <span class="fs-2 fw-light text-primary me-2">RM {{ $book->price }}</span>
              </div>

              <!-- RATING PLEASE -->
              <div class="rating text-warning d-flex align-items-center mb-2">
                <svg class="star star-fill">
                  <use xlink:href="#star-fill"></use>
                </svg>
                <svg class="star star-fill">
                  <use xlink:href="#star-fill"></use>
                </svg>
                <svg class="star star-fill">
                  <use xlink:href="#star-fill"></use>
                </svg>
                <svg class="star star-fill">
                  <use xlink:href="#star-fill"></use>
                </svg>
                <svg class="star star-fill">
                  <use xlink:href="#star-fill"></use>
                </svg>
              </div>

            </div>
            <hr>

            <div class="meta-product my-4">
              <div class="meta-item d-flex mb-1">
                <span class="fw-medium me-2">ISBN:</span>
                <ul class="list-unstyled d-flex mb-0">
                  <li data-value="S">{{$book->isbn}}</li>
                </ul>
              </div>
              <div class="meta-item d-flex mb-1">
                <span class="fw-medium me-2">Category:</span>
                <ul class="select-list list-unstyled d-flex mb-0 flex-wrap gap-1">
                  @foreach($book->genres as $genre)
                  <li class="select-item"><a href="{{ url('shop/' . $genre->id) }}">{{ $genre->name }}</a>@if(!$loop->last),@endif</li>
                  @endforeach
                </ul>
              </div>
            </div>
            <hr>

            <div class="cart-wrap">
              <div class="product-quantity my-4">
                <div class="item-title">
                  <l><b>{{ $book->stock }}</b> in stock</l>
                </div>

                {{-- ADD TO CART FORM --}}

                <div class="stock-button-wrap mt-2 d-flex flex-wrap align-items-center">
                  <div class="product-quantity">
                    <div class="input-group product-qty align-items-center my-1" style="max-width: 150px;">

                      <button type="button" class="btn btn-outline-secondary p-1 d-flex justify-content-center align-items-center" style="width: 32px; height: 32px;" onclick="changeQty(-1, {{ $book->stock }})">&minus;</button>

                      <input type="text" id="quantity" name="quantity" class="form-control bg-white shadow border rounded-3 py-2 mx-2 text-center" value="1" required style="width: 60px;" readonly>

                      <button type="button" class="btn btn-outline-secondary p-1 d-flex justify-content-center align-items-center" style="width: 32px; height: 32px;" onclick="changeQty(1, {{ $book->stock }})"> &plus;</button>

                    </div>
                  </div>
                </div>

                <div class="action-buttons my-3 d-flex flex-wrap gap-3">
                  <a href="#" class="btn btn-dark">Order now</a>

                  {{-- Add to cart form --}}
                  <form method="POST" action="{{ route('cart-add', $book->id) }}">
                    @csrf
                    <input type="hidden" name="quantity" value="1" id="cartQuantityInput">
                    <button type="submit" class="btn btn-dark">Add to cart</button>
                  </form>

                  {{-- Like form --}}
                  <form action="{{ route('like', $book->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn {{ $book->isLikedBy(Auth::user()) ? 'btn' : 'btn-dark' }}">
                      <svg class="heart" width="21" height="21">
                        <use xlink:href="#heart"></use>
                      </svg>
                    </button>
                  </form>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="product-tabs">
    <div class="container">
      <div class="row">
        <div class="tabs-listing">
          <nav>
            <div class="nav nav-tabs d-flex justify-content-center py-3" id="nav-tab" role="tablist">
              <button class="nav-link text-capitalize active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Description</button>
              <button class="nav-link text-capitalize" id="nav-information-tab" data-bs-toggle="tab" data-bs-target="#nav-information" type="button" role="tab" aria-controls="nav-information" aria-selected="false">Additional information</button>
              <button class="nav-link text-capitalize" id="nav-shipping-tab" data-bs-toggle="tab" data-bs-target="#nav-shipping" type="button" role="tab" aria-controls="nav-shipping" aria-selected="false">Shipping & Return</button>
              <button class="nav-link text-capitalize" id="nav-review-tab" data-bs-toggle="tab" data-bs-target="#nav-review" type="button" role="tab" aria-controls="nav-review" aria-selected="false">Reviews (02)</button>
            </div>
          </nav>
          <div class="tab-content border-bottom py-4" id="nav-tabContent">
            <div class="tab-pane fade active show" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
              <p>{{$book->description}}</p>
            </div>
            <div class="tab-pane fade" id="nav-information" role="tabpanel" aria-labelledby="nav-information-tab">
              <p>It is Comfortable and Best</p>
              <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </div>
            <div class="tab-pane fade" id="nav-shipping" role="tabpanel" aria-labelledby="nav-shipping-tab">
              <p>Returns Policy</p>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce eros justo, accumsan non dui sit amet. Phasellus semper volutpat mi sed imperdiet. Ut odio lectus, vulputate non ex non, mattis sollicitudin purus. Mauris consequat justo a enim interdum, in consequat dolor accumsan. Nulla iaculis diam purus, ut vehicula leo efficitur at.</p>
              <p>Interdum et malesuada fames ac ante ipsum primis in faucibus. In blandit nunc enim, sit amet pharetra erat aliquet ac.</p>
              <p>Shipping</p>
              <p>Pellentesque ultrices ut sem sit amet lacinia. Sed nisi dui, ultrices ut turpis pulvinar. Sed fringilla ex eget lorem consectetur, consectetur blandit lacus varius. Duis vel scelerisque elit, et vestibulum metus. Integer sit amet tincidunt tortor. Ut lacinia ullamcorper massa, a fermentum arcu vehicula ut. Ut efficitur faucibus dui Nullam tristique dolor eget turpis consequat varius. Quisque a interdum augue. Nam ut nibh mauris.</p>
            </div>
            <div class="tab-pane fade" id="nav-review" role="tabpanel" aria-labelledby="nav-review-tab">
              <div class="review-box review-style d-flex gap-3 flex-column">
                <div class="review-item d-flex">
                  <div class="review-content">
                    <div class="rating text-primary">
                      <svg class="star star-fill">
                        <use xlink:href="#star-fill"></use>
                      </svg>
                      <svg class="star star-fill">
                        <use xlink:href="#star-fill"></use>
                      </svg>
                      <svg class="star star-fill">
                        <use xlink:href="#star-fill"></use>
                      </svg>
                      <svg class="star star-fill">
                        <use xlink:href="#star-fill"></use>
                      </svg>
                      <svg class="star star-fill">
                        <use xlink:href="#star-fill"></use>
                      </svg>
                    </div>
                    <div class="review-header">
                      <span class="author-name fw-medium">Tom Johnson</span>
                      <span class="review-date">- 07/05/2022</span>
                    </div>
                    <p>Vitae tortor condimentum lacinia quis vel eros donec ac. Nam at lectus urna duis convallis convallis</p>
                  </div>
                </div>
              </div>
              <div class="add-review margin-small">
                <h3>Add a review</h3>
                <p>Your email address will not be published. Required fields are marked *</p>
                <div class="review-rating py-2">
                  <span class="my-2">Your rating *</span>
                  <div class="rating text-secondary">
                    <svg class="star star-fill">
                      <use xlink:href="#star-fill"></use>
                    </svg>
                    <svg class="star star-fill">
                      <use xlink:href="#star-fill"></use>
                    </svg>
                    <svg class="star star-fill">
                      <use xlink:href="#star-fill"></use>
                    </svg>
                    <svg class="star star-fill">
                      <use xlink:href="#star-fill"></use>
                    </svg>
                    <svg class="star star-fill">
                      <use xlink:href="#star-fill"></use>
                    </svg>
                  </div>
                </div>
                <input type="file" class="jfilestyle py-3 border-0" data-text="Choose your file">
                <form id="form" class="d-flex gap-3 flex-wrap">
                  <div class="w-100 d-flex gap-3">
                    <div class="w-50">
                      <input type="text" name="name" placeholder="Write your name here *" class="form-control w-100">
                    </div>
                    <div class="w-50">
                      <input type="text" name="email" placeholder="Write your email here *" class="form-control w-100">
                    </div>
                  </div>
                  <div class="w-100">
                    <textarea placeholder="Write your review here *" class="form-control w-100"></textarea>
                  </div>
                  <label class="w-100">
                    <input type="checkbox" required="" class="d-inline">
                    <span>Save my name, email, and website in this browser for the next time.</span>
                  </label>
                  <button type="submit" name="submit" class="btn my-3">Submit</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="related-items" class="position-relative padding-large ">
    <div class="container">
      <div class="section-title d-md-flex justify-content-between align-items-center mb-4">
        <h3 class="d-flex align-items-center">Related Items</h3>
        <a href="all" class="btn">View All</a>
      </div>
      <div class="position-absolute top-50 end-0 pe-0 pe-xxl-5 me-0 me-xxl-5 swiper-next product-slider-button-next">
        <svg class="chevron-forward-circle d-flex justify-content-center align-items-center p-2" width="80" height="80">
          <use xlink:href="#alt-arrow-right-outline"></use>
        </svg>
      </div>
      <div class="position-absolute top-50 start-0 ps-0 ps-xxl-5 ms-0 ms-xxl-5 swiper-prev product-slider-button-prev">
        <svg class="chevron-back-circle d-flex justify-content-center align-items-center p-2" width="80" height="80">
          <use xlink:href="#alt-arrow-left-outline"></use>
        </svg>
      </div>
      <div class="swiper product-swiper">
        <div class="swiper-wrapper">
          @foreach ($relatedBooks as $related)
          <div class="swiper-slide">
            <div class="card position-relative p-4 border rounded-3">
              @if(isset($related->cover_image))
              <img src="{{ url($related->cover_image) }}" class="img-fluid shadow-sm" alt="{{ $related->title }}">
              @endif
              <h6 class="mt-4 mb-0 fw-bold">
                <a href="{{ url('book/' . $related->id) }}">{{ $related->title }}</a>
              </h6>
              <div class="review-content d-flex">
                <p class="my-2 me-2 fs-6 text-black-50">{{ $related->author }}</p>

                <div class="rating text-warning d-flex align-items-center">
                  @for ($i = 0; $i < 5; $i++)
                    <svg class="star star-fill">
                    <use xlink:href="#star-fill"></use>
                    </svg>
                    @endfor
                </div>
              </div>
              <span class="price text-primary fw-bold mb-2 fs-5">RM{{ $related->price }}</span>
              <div class="card-concern position-absolute start-0 end-0 d-flex gap-2">
                <button type="button" class="btn btn-dark">
                  <svg class="cart">
                    <use xlink:href="#cart"></use>
                  </svg>
                </button>
                <a href="#" class="btn btn-dark">
                  <svg class="wishlist">
                    <use xlink:href="#heart"></use>
                  </svg>
                </a>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </section>

  @include('layouts.footer')


  <script>
    let quantity = 1;
    const maxStock = {{$book -> stock}};

    // Handle both inputs safely
    const displayInput = document.getElementById('quantity') || document.getElementById('quantityDisplay');
    const hiddenInput = document.getElementById('cartQuantityInput');

    function changeQty(delta) {
      quantity = parseInt(displayInput.value) || 1;
      quantity += delta;

      if (quantity < 1) quantity = 1;
      if (quantity > maxStock) quantity = maxStock;

      // Update both inputs (if they exist)
      if (displayInput) displayInput.value = quantity;
      if (hiddenInput) hiddenInput.value = quantity;
    }
  </script>
</body>


</html>