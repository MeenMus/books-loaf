<!DOCTYPE html>
<html>
<style>
  .swiper-slide {
    transition: opacity 0.8s ease-in-out;
  }

  .swiper-next svg,
  .swiper-prev svg {
    background: rgba(255, 255, 255, 0.7);
    border-radius: 50%;
    padding: 10px;
    transition: background 0.3s;
  }

  .swiper-next svg:hover,
  .swiper-prev svg:hover {
    background: rgba(255, 255, 255, 1);
  }

  .insta-image {
    height: 200px;
    /* or any fixed height you prefer */
    object-fit: cover;
    width: 100%;

    /* Custom styles for the swiper container */
    .category-swiper {
      padding: 0 15px;
    }

    /* Arrow styling */
    .chevron-forward-circle,
    .chevron-back-circle {
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .chevron-forward-circle:hover,
    .chevron-back-circle:hover {
      background-color: #f8f9fa !important;
      transform: scale(1.05);
    }

    /* Force star colors in all contexts */
    .star-fill {
      fill: #ffc107 !important;
      /* Gold - override any other fills */
      color: #ffc107 !important;
      /* For currentColor inheritance */
    }

    .star-empty {
      fill: #e4e5e9 !important;
      /* Light gray */
      color: #e4e5e9 !important;
    }

    .star-half {
      fill: #ffc107 !important;
      color: #ffc107 !important;
      opacity: 0.7;
    }

    /* Ensure rating containers force color */
    .rating.text-warning {
      color: #ffc107 !important;
    }
  }

  /* Container for the entire swiper */
  #category-swiper-container {
    position: relative;
    overflow: visible;
    /* Allows arrows to extend outside */
  }

  /* Specific arrow styling */
  #category-swiper-prev,
  #category-swiper-next {
    cursor: pointer;
    opacity: 0.7;
    transition: opacity 0.3s ease;
  }

  #category-swiper-prev:hover,
  #category-swiper-next:hover {
    opacity: 1;
  }

  /* Prevent interference with other elements */
  #category-swiper-prev,
  #category-swiper-next {
    pointer-events: auto;
  }

  /* Card sizing within this specific swiper only */
  #main-category-swiper .swiper-slide {
    width: auto !important;
    margin-right: 15px;
  }

  #main-category-swiper .card-container {
    width: 200px;
    height: 280px;
  }

  /* Larger card styling */
  .client-card {
    padding: 12px;
    /* Increased padding */
    height: 100%;
    /* Fill container */
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: space-between;
  }


  /* Enlarged image */
  .client-card img {
    height: 90px !important;
    /* Increased from 150px */
    width: auto;
    max-width: 100%;
    object-fit: contain;
  }

  /* Larger text */
  .client-card p {
    margin-top: 15px;
    /* Increased spacing */
    font-size: 1.1rem;/
  }

  /* Adjust spacing between cards */
  #main-category-swiper .swiper-slide {
    margin-right: 10px;
    /* Slightly increased gap to balance larger cards */
  }
</style>

@include('layouts.header')

<body>

  @include('layouts.navbar')


  <section id="billboard" class="position-relative d-flex align-items-center py-5 bg-white" style="height: 500px;">

    <!-- Right Arrow -->
    <div class="position-absolute end-0 pe-0 pe-xxl-5 me-0 me-xxl-5 swiper-next main-slider-button-next" style="z-index: 100;">
      <svg class="chevron-forward-circle d-flex justify-content-center align-items-center p-2" width="80" height="80">
        <use xlink:href="#alt-arrow-right-outline"></use>
      </svg>
    </div>

    <!-- Left Arrow -->
    <div class="position-absolute start-0 ps-0 ps-xxl-5 ms-0 ms-xxl-5 swiper-prev main-slider-button-prev" style="z-index: 100;">
      <svg class="chevron-back-circle d-flex justify-content-center align-items-center p-2" width="80" height="80">
        <use xlink:href="#alt-arrow-left-outline"></use>
      </svg>
    </div>

    <!-- Swiper Main -->
    <div class="swiper main-swiper">
      <div class="swiper-wrapper d-flex align-items-center">
        @for ($i = 1; $i <= 3; $i++)
          <div class="swiper-slide">
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-11 p-0">
                <div class="image-holder">
                  <img src="{{ asset('banners/banner-' . $i . '.png') }}?v={{ time() }}" class="img-fluid w-100" alt="banner {{ $i }}">
                </div>
              </div>
            </div>
          </div>
      </div>
      @endfor
    </div>
    </div>
  </section>



  <section id="company-services" class="padding-large pb-0">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-6 pb-3 pb-lg-0">
          <div class="icon-box d-flex">
            <div class="icon-box-icon pe-3 pb-3">
              <svg class="cart-outline">
                <use xlink:href="#cart-outline" />
              </svg>
            </div>
            <div class="icon-box-content">
              <h4 class="card-title mb-1 text-capitalize text-dark">Free delivery</h4>
              <p>Minimum spend of RM150 (Peninsular Malaysia)</p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 pb-3 pb-lg-0">
          <div class="icon-box d-flex">
            <div class="icon-box-icon pe-3 pb-3">
              <svg class="quality">
                <use xlink:href="#quality" />
              </svg>
            </div>
            <div class="icon-box-content">
              <h4 class="card-title mb-1 text-capitalize text-dark">Quality guarantee</h4>
              <p>We ensure top-quality products for your satisfaction.</p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 pb-3 pb-lg-0">
          <div class="icon-box d-flex">
            <div class="icon-box-icon pe-3 pb-3">
              <svg class="price-tag">
                <use xlink:href="#price-tag" />
              </svg>
            </div>
            <div class="icon-box-content">
              <h4 class="card-title mb-1 text-capitalize text-dark">Daily offers</h4>
              <p>Save more with exciting deals every day.</p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 pb-3 pb-lg-0">
          <div class="icon-box d-flex">
            <div class="icon-box-icon pe-3 pb-3">
              <svg class="shield-plus">
                <use xlink:href="#shield-plus" />
              </svg>
            </div>
            <div class="icon-box-content">
              <h4 class="card-title mb-1 text-capitalize text-dark">100% secure payment</h4>
              <p>Shop confidently with our secure payment system.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="best-selling-items" class="position-relative padding-large">
    <div class="container">
      <div class="section-title d-md-flex justify-content-between align-items-center mb-4">
        <h3 class="d-flex align-items-center">Best selling items</h3>
        <a href="{{ url('shop/all') }}" class="btn">View All</a>
      </div>

      <!-- Swiper Controls -->
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

      <!-- Swiper Wrapper -->
      <div class="swiper product-swiper">
        <div class="swiper-wrapper">

          @foreach($bestSellingBooks as $book)
          <div class="swiper-slide">
            <div class="card position-relative p-4 border rounded-3">
              <img src="{{ asset($book->cover_image) }}" class="img-fluid shadow-sm" alt="{{ $book->title }}">

              <h6 class="mt-4 mb-0 fw-bold">
                <a href="{{ url('book/' . $book->id) }}">{{ $book->title }}</a>
              </h6>

              <div class="review-content mt-2 mb-2">
                <p class="fs-6 text-black-50 mb-1">{{ $book->author }}</p>

                <div class="rating d-flex align-items-center">
                  @php
                  $averageRating = round($book->reviews_avg_rating ?? 0, 1);
                  @endphp

                  @if ($averageRating > 0)
                  @for ($i = 1; $i <= 5; $i++)
                    @if($averageRating>= $i)
                    <svg class="star star-fill me-1" width="16" height="16" style="fill: #ffc107;">
                      <use xlink:href="#star-fill"></use>
                    </svg>
                    @elseif($averageRating > ($i - 1) && $averageRating < $i)
                      <svg class="star star-half me-1" width="16" height="16" style="fill: #ffc107;">
                      <use xlink:href="#star-half"></use>
                      </svg>
                      @else
                      <svg class="star star-empty me-1" width="16" height="16" style="fill: #e4e5e9;">
                        <use xlink:href="#star-empty"></use>
                      </svg>
                      @endif
                      @endfor
                      @else
                      {{-- No ratings: show 5 empty stars --}}
                      @for ($i = 1; $i <= 5; $i++)
                        <svg class="star star-empty me-1" width="16" height="16" style="fill: #e4e5e9;">
                        <use xlink:href="#star-empty"></use>
                        </svg>
                        @endfor
                        @endif
                </div>
              </div>

              <span class="price text-primary fw-bold mb-2 fs-5">RM {{ number_format($book->price, 2) }}</span>

              <div class="card-concern position-absolute start-0 end-0 d-flex gap-2 mb-4">
                {{-- Add to cart form --}}
                <form method="POST" action="{{ route('cart-add', $book->id) }}">
                  @csrf
                  <input type="hidden" name="quantity" value="1" id="cartQuantityInput">
                  <button type="submit" class="btn btn-dark" title="Add to cart">
                    <svg class="cart" width="20" height="20">
                      <use xlink:href="#cart"></use>
                    </svg>
                  </button>
                </form>

                {{-- Like form --}}
                <form method="POST" action="{{ route('like', $book->id) }}">
                  @csrf
                  <button type="submit" class="btn {{ $book->isLikedBy(Auth::user()) ? 'btn' : 'btn-dark' }}" title="Add to wishlist">
                    <svg class="wishlist" width="20" height="20">
                      <use xlink:href="#heart"></use>
                    </svg>
                  </button>
                </form>
              </div>

            </div>
          </div>
          @endforeach

        </div>
      </div>
    </div>
  </section>


  <section id="items-listing" class="padding-large pt-0">
    <div class="container">
      <div class="row">
        <!-- BOOKS OF THE YEAR -->
        <div class="col-md-6 mb-4 mb-lg-0 col-lg-3">
          <div class="top-books border rounded-3 p-4">
            <div class="section-title overflow-hidden mb-5 mt-2">
              <h4 class="d-flex flex-column mb-0">Books of the Year</h4>
            </div>
            <div class="items-lists">
              @forelse ($booksOfTheYear as $book)
              <div class="item d-flex mb-4">
                @if(isset($book->cover_image))
                <img src="{{ url($book->cover_image) }}" class="img-fluid shadow-sm" alt="{{ $book->title }}">
                @endif
                <div class="item-content ms-3">
                  <h6 class="mb-0 fw-bold">
                    <a href="{{ url('book/' . $book->id) }}">{{ $book->title }}</a>
                  </h6>
                  <div class="review-content d-flex align-items-center">
                    <p class="my-2 me-2 fs-6 text-black-50">{{ $book->author }}</p>
                    <div class="rating text-warning d-flex align-items-center">
                      @php
                      $averageRating = round($book->reviews_avg_rating ?? 0, 1);
                      @endphp

                      @if ($averageRating > 0)
                      @for ($i = 1; $i <= 5; $i++)
                        @if($averageRating>= $i)
                        <!-- Full Star -->
                        <svg class="star star-fill" width="20" height="20">
                          <use xlink:href="#star-fill"></use>
                        </svg>
                        @elseif($averageRating > ($i - 1) && $averageRating < $i)
                          <!-- Half Star -->
                          <svg class="star star-half" width="20" height="20">
                            <use xlink:href="#star-half"></use>
                          </svg>
                          @else
                          <!-- Empty Star -->
                          <svg class="star star-empty" width="20" height="20">
                            <use xlink:href="#star-empty"></use>
                          </svg>
                          @endif
                          @endfor
                          @else
                          {{-- No ratings: show 5 empty stars --}}
                          @for ($i = 1; $i <= 5; $i++)
                            <svg class="star star-empty" width="20" height="20">
                            <use xlink:href="#star-empty"></use>
                            </svg>
                            @endfor
                            @endif
                    </div>
                  </div>
                  <span class="price text-primary fw-bold mb-2 fs-5">RM {{ number_format($book->price, 2) }}</span>
                </div>
              </div>
              @if (!$loop->last)
              <hr class="gray-400">
              @endif
              @empty
              <p>No top books available yet.</p>
              @endforelse
            </div>
          </div>
        </div>

        <!-- TRENDING NOW -->
        <div class="col-md-6 mb-4 mb-lg-0 col-lg-3">
          <div class="latest-items border rounded-3 p-4">
            <div class="section-title overflow-hidden mb-5 mt-2">
              <h4 class="d-flex flex-column mb-0">#Trending Now</h4>
            </div>
            <div class="items-lists">
              @forelse ($trendingBooks as $book)
              <div class="item d-flex mb-4">
                @if(isset($book->cover_image))
                <img src="{{ url($book->cover_image) }}" class="img-fluid shadow-sm" alt="{{ $book->title }}">
                @endif
                <div class="item-content ms-3">
                  <h6 class="mb-0 fw-bold">
                    <a href="{{ url('book/' . $book->id) }}">{{ $book->title }}</a>
                  </h6>
                  <div class="review-content d-flex align-items-center">
                    <p class="my-2 me-2 fs-6 text-black-50">{{ $book->author }}</p>
                    <div class="rating text-warning d-flex align-items-center">
                      @php
                      $averageRating = round($book->reviews_avg_rating ?? 0, 1);
                      @endphp

                      @if ($averageRating > 0)
                      @for ($i = 1; $i <= 5; $i++)
                        @if($averageRating>= $i)
                        <!-- Full Star -->
                        <svg class="star star-fill" width="20" height="20">
                          <use xlink:href="#star-fill"></use>
                        </svg>
                        @elseif($averageRating > ($i - 1) && $averageRating < $i)
                          <!-- Half Star -->
                          <svg class="star star-half" width="20" height="20">
                            <use xlink:href="#star-half"></use>
                          </svg>
                          @else
                          <!-- Empty Star -->
                          <svg class="star star-empty" width="20" height="20">
                            <use xlink:href="#star-empty"></use>
                          </svg>
                          @endif
                          @endfor
                          @else
                          {{-- No ratings: show 5 empty stars --}}
                          @for ($i = 1; $i <= 5; $i++)
                            <svg class="star star-empty" width="20" height="20">
                            <use xlink:href="#star-empty"></use>
                            </svg>
                            @endfor
                            @endif
                    </div>
                  </div>
                  <span class="price text-primary fw-bold mb-2 fs-5">RM {{ number_format($book->price, 2) }}</span>
                </div>
              </div>
              @if (!$loop->last)
              <hr class="gray-400">
              @endif
              @empty
              <p>No trending books this month yet.</p>
              @endforelse
            </div>
          </div>
        </div>

        <!-- GOTTA HAVE IT -->
        <div class="col-md-6 mb-4 mb-lg-0 col-lg-3">
          <div class="best-reviewed border rounded-3 p-4">
            <div class="section-title overflow-hidden mb-5 mt-2">
              <h4 class="d-flex flex-column mb-0">Gotta Have It!</h4>
            </div>
            <div class="items-lists">
              @forelse ($gottaHaveIt as $book)
              <div class="item d-flex mb-4">
                @if(isset($book->cover_image))
                <img src="{{ url($book->cover_image) }}" class="img-fluid shadow-sm" alt="{{ $book->title }}">
                @endif
                <div class="item-content ms-3">
                  <h6 class="mb-0 fw-bold">
                    <a href="{{ url('book/' . $book->id) }}">{{ $book->title }}</a>
                  </h6>
                  <div class="review-content d-flex align-items-center">
                    <p class="my-2 me-2 fs-6 text-black-50">{{ $book->author }}</p>
                    <div class="rating text-warning d-flex align-items-center">
                      @php
                      $averageRating = round($book->reviews_avg_rating ?? 0, 1);
                      @endphp

                      @if ($averageRating > 0)
                      @for ($i = 1; $i <= 5; $i++)
                        @if($averageRating>= $i)
                        <!-- Full Star -->
                        <svg class="star star-fill" width="20" height="20">
                          <use xlink:href="#star-fill"></use>
                        </svg>
                        @elseif($averageRating > ($i - 1) && $averageRating < $i)
                          <!-- Half Star -->
                          <svg class="star star-half" width="20" height="20">
                            <use xlink:href="#star-half"></use>
                          </svg>
                          @else
                          <!-- Empty Star -->
                          <svg class="star star-empty" width="20" height="20">
                            <use xlink:href="#star-empty"></use>
                          </svg>
                          @endif
                          @endfor
                          @else
                          {{-- No ratings: show 5 empty stars --}}
                          @for ($i = 1; $i <= 5; $i++)
                            <svg class="star star-empty" width="20" height="20">
                            <use xlink:href="#star-empty"></use>
                            </svg>
                            @endfor
                            @endif
                    </div>
                  </div>
                  <span class="price text-primary fw-bold mb-2 fs-5">RM {{ number_format($book->price, 2) }}</span>
                </div>
              </div>
              @if (!$loop->last)
              <hr class="gray-400">
              @endif
              @empty
              <p>No books in this category yet.</p>
              @endforelse
            </div>
          </div>
        </div>

        <!-- NEW ARRIVAL -->
        <div class="col-md-6 mb-4 mb-lg-0 col-lg-3">
          <div class="on-sale border rounded-3 p-4">
            <div class="section-title overflow-hidden mb-5 mt-2">
              <h4 class="d-flex flex-column mb-0">New Arrival</h4>
            </div>
            <div class="items-lists">
              @forelse ($newArrivals as $book)
              <div class="item d-flex mb-4">
                @if(isset($book->cover_image))
                <img src="{{ url($book->cover_image) }}" class="img-fluid shadow-sm" alt="{{ $book->title }}">
                @endif
                <div class="item-content ms-3">
                  <h6 class="mb-0 fw-bold">
                    <a href="{{ url('book/' . $book->id) }}">{{ $book->title }}</a>
                  </h6>
                  <div class="review-content d-flex align-items-center">
                    <p class="my-2 me-2 fs-6 text-black-50">{{ $book->author }}</p>
                    <div class="rating text-warning d-flex align-items-center">
                      @php
                      $averageRating = round($book->reviews_avg_rating ?? 0, 1);
                      @endphp

                      @if ($averageRating > 0)
                      @for ($i = 1; $i <= 5; $i++)
                        @if($averageRating>= $i)
                        <!-- Full Star -->
                        <svg class="star star-fill" width="20" height="20">
                          <use xlink:href="#star-fill"></use>
                        </svg>
                        @elseif($averageRating > ($i - 1) && $averageRating < $i)
                          <!-- Half Star -->
                          <svg class="star star-half" width="20" height="20">
                            <use xlink:href="#star-half"></use>
                          </svg>
                          @else
                          <!-- Empty Star -->
                          <svg class="star star-empty" width="20" height="20">
                            <use xlink:href="#star-empty"></use>
                          </svg>
                          @endif
                          @endfor
                          @else
                          {{-- No ratings: show 5 empty stars --}}
                          @for ($i = 1; $i <= 5; $i++)
                            <svg class="star star-empty" width="20" height="20">
                            <use xlink:href="#star-empty"></use>
                            </svg>
                            @endfor
                            @endif
                    </div>
                  </div>
                  <span class="price text-primary fw-bold mb-2 fs-5">RM {{ number_format($book->price, 2) }}</span>
                </div>
              </div>
              @if (!$loop->last)
              <hr class="gray-400">
              @endif
              @empty
              <p>No new arrivals yet.</p>
              @endforelse
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="categories" class="padding-large pt-0">
    <div class="container position-relative">
      <div class="section-title d-flex justify-content-between align-items-center mb-4">
        <h3 class="d-flex align-items-center">Categories</h3>
      </div>

      <!-- Swiper container with padding for arrows -->
      <div class="position-relative px-5" id="category-swiper-container">
        <!-- Previous Arrow with unique ID -->
        <div id="category-swiper-prev" class="position-absolute top-50 start-0 translate-middle-y z-1 swiper-prev product-slider-button-prev">
          <svg class="chevron-back-circle bg-white rounded-circle shadow-sm p-2" width="40" height="40">
            <use xlink:href="#alt-arrow-left-outline"></use>
          </svg>
        </div>

        <!-- Swiper content -->
        <div class="swiper category-swiper" id="main-category-swiper">
          <div class="swiper-wrapper">
            <!-- Category Slides -->
            @foreach ($homepageGenres as $genre)
            <div class="swiper-slide">
              <div class="card-container">
                <a href="{{ url('shop/' . $genre->id) }}">
                  <div class="client-card text-center">
                    <img src="{{ asset('images/' . ($genreImages[$genre->name] ?? 'default.png')) }}"
                      alt="{{ $genre->name }}"
                      class="img-fluid"
                      style="height:100px; object-fit: contain;" />
                    <p class="mt-2">{{ $genre->name }}</p>
                  </div>
                </a>
              </div>
            </div>
            @endforeach

            <!-- HardCode Categories swiper  -->
            <!-- <div class="swiper-slide">
            <div class="card-container">
              <div class="client-card">
              <img src="images/children.png" alt="Children's Books" class="img-fluid" style="height:150px; object-fit: contain;" />
              <p class="mt-2">Children's</p>
              </div>
            </div>
          </div>

          <div class="swiper-slide">
            <div class="card-container">
              <div class="client-card">
              <img src="images/self care.png" alt="Self Help" class="img-fluid" style="height:150px; object-fit: contain;" />
              <p class="mt-2">Self Help</p>
              </div> 
            </div>
          </div>
          

          <div class="swiper-slide">
            <div class="card-container">
              <div class="client-card">
              <img src="images/thriller.png" alt="Crime & Thriller" class="img-fluid" style="height:150px; object-fit: contain;" />
              <p class="mt-2">Crime</p>
              </div>
            </div>
          </div>

          <div class="swiper-slide">
            <div class="card-container">
              <div class="client-card">
              <img src="images/romance.png" alt="Romance" class="img-fluid" style="height:150px; object-fit: contain;" />
              <p class="mt-2">Romance</p>
              </div>
            </div>
          </div>

          <div class="swiper-slide">
            <div class="card-container">
              <div class="client-card">
              <img src="images/fiction.png" alt="Non-Fiction Books" class="img-fluid" style="height:150px; object-fit: contain;" />
              <p class="mt-2">Non-Fiction</p >
              </div>
            </div>
          </div>

          <div class="swiper-slide">
            <div class="card-container">
              <div class="client-card">
              <img src="images/cooking.png" alt="Cooking" class="img-fluid" style="height:150px; object-fit: contain;" />
              <p class="mt-2">Cooking</p>
              </div>
            </div>
          </div> -->
          </div>
        </div>

        <!-- Next Arrow (positioned right outside content) -->
        <div id="category-swiper-next" class="position-absolute top-50 end-0 translate-middle-y z-1 swiper-next product-slider-button-next">
          <svg class="chevron-forward-circle bg-white rounded-circle shadow-sm p-2" width="40" height="40">
            <use xlink:href="#alt-arrow-right-outline"></use>
          </svg>
        </div>
      </div>
    </div>
  </section>

  <section id="customers-reviews" class="position-relative padding-large"
    style="background-image: url(images/banner-image-bg.jpg); background-size: cover; background-repeat: no-repeat; background-position: center; height: 600px;">
    <div class="container offset-md-3 col-md-6 ">
      <div class="position-absolute top-50 end-0 pe-0 pe-xxl-5 me-0 me-xxl-5 swiper-next testimonial-button-next">
        <svg class="chevron-forward-circle d-flex justify-content-center align-items-center p-2" width="40" height="40">
          <use xlink:href="#alt-arrow-right-outline"></use>
        </svg>
      </div>
      <div class="position-absolute top-50 start-0 ps-0 ps-xxl-5 ms-0 ms-xxl-5 swiper-prev testimonial-button-prev">
        <svg class="chevron-back-circle d-flex justify-content-center align-items-center p-2" width="40" height="40">
          <use xlink:href="#alt-arrow-left-outline"></use>
        </svg>
      </div>
      <div class="section-title mb-4 text-center">
        <h3 class="mb-4">Customers reviews</h3>
      </div>
      <div class="swiper testimonial-swiper ">
        <div class="swiper-wrapper">
          @forelse ($reviews as $review)
          <div class="swiper-slide">
            <div class="card position-relative text-left p-5 border rounded-3">
              <blockquote>"{{ $review->review }}"</blockquote>

              <div class="rating text-warning d-flex align-items-center">
                @for ($i = 0; $i < $review->rating; $i++)
                  <svg class="star star-fill" style="fill: #ffc107;">
                    <use xlink:href="#star-fill"></use>
                  </svg>
                  @endfor
              </div>

              <h5 class="mt-1 fw-normal">{{ $review->user_name }}</h5>
              <p>{{ $review->book_title }}</p>
            </div>
          </div>
          @empty
          <div class="swiper-slide">
            <div class="card text-center p-5 border rounded-3">
              <p>No reviews available yet.</p>
            </div>
          </div>
          @endforelse
        </div>
      </div>
    </div>
  </section>

  <br> </br>

  <section id="instagram">
    <div class="container">
      <div class="text-center mb-4">
        <h3>Instagram</h3>
      </div>
      <div class="row">
        <div class="col-md-2">
          <figure class="instagram-item position-relative rounded-3">
            <a href="https://www.instagram.com/p/DJcFD2PzmRN/?utm_source=ig_web_copy_link&igsh=MzRlODBiNWFlZA==" target="_blank" class="image-link position-relative">
              <div class="icon-overlay position-absolute d-flex justify-content-center">
                <svg class="instagram">
                  <use xlink:href="#instagram"></use>
                </svg>
              </div>
              <img src="images/benefits-of-reading.png" alt="instagram" class="img-fluid rounded-3 insta-image">
            </a>
          </figure>
        </div>

        <div class="col-md-2">
          <figure class="instagram-item position-relative rounded-3">
            <a href="https://www.instagram.com/p/DJcE-hSTeEa/?utm_source=ig_web_copy_link&igsh=MzRlODBiNWFlZA==" target="_blank" class="image-link position-relative">
              <div class="icon-overlay position-absolute d-flex justify-content-center">
                <svg class="instagram">
                  <use xlink:href="#instagram"></use>
                </svg>
              </div>
              <img src="images/fun-facts-reading.png" alt="instagram" class="img-fluid rounded-3 insta-image">
            </a>
          </figure>
        </div>
        <div class="col-md-2">
          <figure class="instagram-item position-relative rounded-3">
            <a href="https://www.instagram.com/p/DKNALXXTy84/?utm_source=ig_web_copy_link" class="image-link position-relative">
              <div class="icon-overlay position-absolute d-flex justify-content-center">
                <svg class="instagram">
                  <use xlink:href="#instagram"></use>
                </svg>
              </div>
              <img src="images/booksloaf-bookstore.jpg" alt="instagram" class="img-fluid rounded-3 insta-image">
            </a>
          </figure>
        </div>
        <div class="col-md-2">
          <figure class="instagram-item position-relative rounded-3">
            <a href="https://www.instagram.com/p/DKM8gupT-SN/?utm_source=ig_web_copy_link" class="image-link position-relative">
              <div class="icon-overlay position-absolute d-flex justify-content-center">
                <svg class="instagram">
                  <use xlink:href="#instagram"></use>
                </svg>
              </div>
              <img src="images/reviewing-good-and-quality-books.png" alt="instagram" class="img-fluid rounded-3 insta-image">
            </a>
          </figure>
        </div>
        <div class="col-md-2">
          <figure class="instagram-item position-relative rounded-3">
            <a href="https://www.instagram.com/p/DKM8y6FzZmJ/?utm_source=ig_web_copy_link" class="image-link position-relative">
              <div class="icon-overlay position-absolute d-flex justify-content-center">
                <svg class="instagram">
                  <use xlink:href="#instagram"></use>
                </svg>
              </div>
              <img src="images/Quotes.png" alt="instagram" class="img-fluid rounded-3 insta-image">
            </a>
          </figure>
        </div>
        <div class="col-md-2">
          <figure class="instagram-item position-relative rounded-3">
            <a href="https://www.instagram.com/p/DKM-nYQT437/?utm_source=ig_web_copy_link" class="image-link position-relative">
              <div class="icon-overlay position-absolute d-flex justify-content-center">
                <svg class="instagram">
                  <use xlink:href="#instagram"></use>
                </svg>
              </div>
              <img src="images/books-to-read.jpg" alt="instagram" class="img-fluid rounded-3 insta-image">
            </a>
          </figure>
        </div>
      </div>
    </div>
  </section>

  @include('layouts.footer')

</body>



</html>


<!-- <script>
  var swiper = new Swiper('.main-swiper', {
    effect: 'fade',
    loop: true,
    autoplay: {
      delay: 5000,
      disableOnInteraction: false,
    },
    navigation: {
      nextEl: '.swiper-button-next', // Correct class
      prevEl: '.swiper-button-prev', // Correct class
    },
    fadeEffect: {
      crossFade: true,
    },
  });
</script> -->