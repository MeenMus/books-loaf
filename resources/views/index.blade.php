<!DOCTYPE html>
<html>
 <style>
  .swiper-slide {
    transition: opacity 0.8s ease-in-out;
  }
  .swiper-next svg, .swiper-prev svg {
    background: rgba(255, 255, 255, 0.7);
    border-radius: 50%;
    padding: 10px;
    transition: background 0.3s;
  }
  .swiper-next svg:hover, .swiper-prev svg:hover {
    background: rgba(255, 255, 255, 1);
  } 

  .insta-image {
  height: 200px; /* or any fixed height you prefer */
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
}
</style> 

@include('layouts.header')

<body>

  @include('layouts.navbar')


  <section id="billboard" class="position-relative d-flex align-items-center py-5 bg-white" style="height: 500px;">
  
  <!-- Right Arrow -->
  <div class="position-absolute end-0 pe-0 pe-xxl-5 me-0 me-xxl-5 swiper-next main-slider-button-next">
    <svg class="chevron-forward-circle d-flex justify-content-center align-items-center p-2" width="80" height="80">
      <use xlink:href="#alt-arrow-right-outline"></use>
    </svg>
  </div>

  <!-- Left Arrow -->
  <div class="position-absolute start-0 ps-0 ps-xxl-5 ms-0 ms-xxl-5 swiper-prev main-slider-button-prev">
    <svg class="chevron-back-circle d-flex justify-content-center align-items-center p-2" width="80" height="80">
      <use xlink:href="#alt-arrow-left-outline"></use>
    </svg>
  </div>

  <!-- Swiper Main -->
  <div class="swiper main-swiper">
      <div class="swiper-wrapper d-flex align-items-center">
        <div class="swiper-slide">
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-11 p-0">
                <div class="image-holder">
                  <img src="images/1.png" class="img-fluid w-100" alt="banner">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="swiper-slide">
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-11 p-0">
                <div class="image-holder">
                  <img src="images/2.png" class="img-fluid w-100" alt="banner">
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- <div class="swiper-slide">
          <div class="container">
            <div class="row d-flex flex-column-reverse flex-md-row align-items-center">
              <div class="col-md-5 offset-md-1 mt-5 mt-md-0 text-center text-md-start">
                <div class="banner-content">
                  <h2>Your Heart is the Sea</h2>
                  <p>Limited stocks available. Grab it now!</p>
                  <a href="shop" class="btn mt-3">Shop Collection</a>
                </div>
              </div>
              <div class="col-md-6 text-center">
                <div class="image-holder">
                  <img src="images/banner-image.png" class="img-fluid" alt="banner">
                </div>
              </div>
            </div>
          </div>
        </div> -->
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

  <section id="best-selling-items" class="position-relative padding-large ">
    <div class="container">
      <div class="section-title d-md-flex justify-content-between align-items-center mb-4">
        <h3 class="d-flex align-items-center">Best selling items</h3>
        <a href="shop" class="btn">View All</a>
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
          <div class="swiper-slide">
            <div class="card position-relative p-4 border rounded-3">
              <div class="position-absolute">
                <p class="bg-primary py-1 px-3 fs-6 text-white rounded-2">10% off</p>
              </div>
              <img src="images/product-item1.png" class="img-fluid shadow-sm" alt="product item">
              <h6 class="mt-4 mb-0 fw-bold"><a href="single-product">House of Sky Breath</a></h6>
              <div class="review-content d-flex">
                <p class="my-2 me-2 fs-6 text-black-50">Lauren Asher</p>

                <div class="rating text-warning d-flex align-items-center">
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
              <span class="price text-primary fw-bold mb-2 fs-5">RM 870</span>
              <div class="card-concern position-absolute start-0 end-0 d-flex gap-2">
                <button type="button" href="#" class="btn btn-dark" data-bs-toggle="tooltip" data-bs-placement="top"
                  data-bs-title="Tooltip on top">
                  <svg class="cart">
                    <use xlink:href="#cart"></use>
                  </svg>
                </button>
                <a href="#" class="btn btn-dark">
                  <span>
                    <svg class="wishlist">
                      <use xlink:href="#heart"></use>
                    </svg>
                  </span>
                </a>
              </div>
            </div>
          </div>
          <div class="swiper-slide">
            <div class="card position-relative p-4 border rounded-3">
              <img src="images/product-item2.png" class="img-fluid shadow-sm" alt="product item">
              <h6 class="mt-4 mb-0 fw-bold"><a href="single-product">Heartland Stars</a></h6>
              <div class="review-content d-flex">
                <p class="my-2 me-2 fs-6 text-black-50">Lauren Asher</p>

                <div class="rating text-warning d-flex align-items-center">
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

              <span class="price text-primary fw-bold mb-2 fs-5">RM 870</span>
              <div class="card-concern position-absolute start-0 end-0 d-flex gap-2">
                <button type="button" href="#" class="btn btn-dark" data-bs-toggle="tooltip" data-bs-placement="top"
                  data-bs-title="Tooltip on top">
                  <svg class="cart">
                    <use xlink:href="#cart"></use>
                  </svg>
                </button>
                <a href="#" class="btn btn-dark">
                  <span>
                    <svg class="wishlist">
                      <use xlink:href="#heart"></use>
                    </svg>
                  </span>
                </a>
              </div>
            </div>
          </div>
          <div class="swiper-slide">
            <div class="card position-relative p-4 border rounded-3">
              <img src="images/product-item3.png" class="img-fluid shadow-sm" alt="product item">
              <h6 class="mt-4 mb-0 fw-bold"><a href="single-product">Heavenly Bodies</a></h6>
              <div class="review-content d-flex">
                <p class="my-2 me-2 fs-6 text-black-50">Lauren Asher</p>

                <div class="rating text-warning d-flex align-items-center">
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

              <span class="price text-primary fw-bold mb-2 fs-5">RM 870</span>
              <div class="card-concern position-absolute start-0 end-0 d-flex gap-2">
                <button type="button" href="#" class="btn btn-dark" data-bs-toggle="tooltip" data-bs-placement="top"
                  data-bs-title="Tooltip on top">
                  <svg class="cart">
                    <use xlink:href="#cart"></use>
                  </svg>
                </button>
                <a href="#" class="btn btn-dark">
                  <span>
                    <svg class="wishlist">
                      <use xlink:href="#heart"></use>
                    </svg>
                  </span>
                </a>
              </div>
            </div>
          </div>
          <div class="swiper-slide">
            <div class="card position-relative p-4 border rounded-3">
              <div class="position-absolute">
                <p class="bg-primary py-1 px-3 fs-6 text-white rounded-2">10% off</p>
              </div>
              <img src="images/product-item4.png" class="img-fluid shadow-sm" alt="product item">
              <h6 class="mt-4 mb-0 fw-bold"><a href="single-product">His Saving Grace</a></h6>
              <div class="review-content d-flex">
                <p class="my-2 me-2 fs-6 text-black-50">Lauren Asher</p>

                <div class="rating text-warning d-flex align-items-center">
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

              <span class="price text-primary fw-bold mb-2 fs-5">RM 870</span>
              <div class="card-concern position-absolute start-0 end-0 d-flex gap-2">
                <button type="button" href="#" class="btn btn-dark" data-bs-toggle="tooltip" data-bs-placement="top"
                  data-bs-title="Tooltip on top">
                  <svg class="cart">
                    <use xlink:href="#cart"></use>
                  </svg>
                </button>
                <a href="#" class="btn btn-dark">
                  <span>
                    <svg class="wishlist">
                      <use xlink:href="#heart"></use>
                    </svg>
                  </span>
                </a>
              </div>
            </div>
          </div>
          <div class="swiper-slide">
            <div class="card position-relative p-4 border rounded-3">
              <img src="images/product-item5.png" class="img-fluid shadow-sm" alt="product item">
              <h6 class="mt-4 mb-0 fw-bold"><a href="single-product">My Dearest Darkest</a></h6>
              <div class="review-content d-flex">
                <p class="my-2 me-2 fs-6 text-black-50">Lauren Asher</p>

                <div class="rating text-warning d-flex align-items-center d-flex align-items-center">
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

              <span class="price text-primary fw-bold mb-2 fs-5">RM 870</span>
              <div class="card-concern position-absolute start-0 end-0 d-flex gap-2">
                <button type="button" href="#" class="btn btn-dark" data-bs-toggle="tooltip" data-bs-placement="top"
                  data-bs-title="Tooltip on top">
                  <svg class="cart">
                    <use xlink:href="#cart"></use>
                  </svg>
                </button>
                <a href="#" class="btn btn-dark">
                  <span>
                    <svg class="wishlist">
                      <use xlink:href="#heart"></use>
                    </svg>
                  </span>
                </a>
              </div>
            </div>
          </div>
          <div class="swiper-slide">
            <div class="card position-relative p-4 border rounded-3">
              <img src="images/product-item6.png" class="img-fluid shadow-sm" alt="product item">
              <h6 class="mt-4 mb-0 fw-bold"><a href="single-product">The Story of Success</a></h6>
              <div class="review-content d-flex">
                <p class="my-2 me-2 fs-6 text-black-50">Lauren Asher</p>

                <div class="rating text-warning d-flex align-items-center">
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

              <span class="price text-primary fw-bold mb-2 fs-5">RM 870</span>
              <div class="card-concern position-absolute start-0 end-0 d-flex gap-2">
                <button type="button" href="#" class="btn btn-dark" data-bs-toggle="tooltip" data-bs-placement="top"
                  data-bs-title="Tooltip on top">
                  <svg class="cart">
                    <use xlink:href="#cart"></use>
                  </svg>
                </button>
                <a href="#" class="btn btn-dark">
                  <span>
                    <svg class="wishlist">
                      <use xlink:href="#heart"></use>
                    </svg>
                  </span>
                </a>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </section>

  <section id="limited-offer" class="padding-large"
    style="background-image: url(images/banner-image-bg-1.jpg); background-size: cover; background-repeat: no-repeat; background-position: center; height: 800px;">
    <div class="container">
      <div class="row d-flex align-items-center">
        <div class="col-md-6 text-center">
          <div class="image-holder">
            <img src="images/banner-image3.png" class="img-fluid" alt="banner">
          </div>
        </div>
        <div class="col-md-5 offset-md-1 mt-5 mt-md-0 text-center text-md-start">
          <h2>30% Discount on all items. Hurry Up !!!</h2>
          <div id="countdown-clock" class="text-dark d-flex align-items-center my-3">
            <div class="time d-grid pe-3">
              <span class="days fs-1 fw-noRM al"></span>
              <small>Days</small>
            </div>
            <span class="fs-1 text-primary">:</span>
            <div class="time d-grid pe-3 ps-3">
              <span class="hours fs-1 fw-noRM al"></span>
              <small>Hrs</small>
            </div>
            <span class="fs-1 text-primary">:</span>
            <div class="time d-grid pe-3 ps-3">
              <span class="minutes fs-1 fw-noRM al"></span>
              <small>Min</small>
            </div>
            <span class="fs-1 text-primary">:</span>
            <div class="time d-grid ps-3">
              <span class="seconds fs-1 fw-noRM al"></span>
              <small>Sec</small>
            </div>
          </div>
          <a href="shop" class="btn mt-3">Shop Collection</a>
        </div>
      </div>
    </div>
    </div>
  </section>

<section id="items-listing" class="padding-large">
    <div class="container">
      <div class="row">
        <div class="col-md-6 mb-4 mb-lg-0 col-lg-3">
          <div class="featured border rounded-3 p-4">
            <div class="section-title overflow-hidden mb-5 mt-2">
              <h4 class="d-flex flex-column mb-0">Book Of The Year</h4>
            </div>
            <div class="items-lists">
              <div class="item d-flex">
                <img src="images/product-item2.png" class="img-fluid shadow-sm" alt="product item">
                <div class="item-content ms-3">
                  <h6 class="mb-0 fw-bold"><a href="single-product">Thariq Ridzuwan Commando's : His Treasure</a></h6>
                  <div class="review-content d-flex">
                    <p class="my-2 me-2 fs-6 text-black-50">Huda Najwa</p>

                    <div class="rating text-warning d-flex align-items-center">
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
                  <span class="price text-primary fw-bold mb-2 fs-5">RM 35.00</span>
                </div>
              </div>
              <hr class="gray-400">
              <div class="item d-flex">
                <img src="images/product-item1.png" class="img-fluid shadow-sm" alt="product item">
                <div class="item-content ms-3">
                  <h6 class="mb-0 fw-bold"><a href="single-product">Dog Man #12: The Scarlet Shedder (Paperback)n</a></h6>
                  <div class="review-content d-flex">
                    <p class="my-2 me-2 fs-6 text-black-50">Pilkey, Dav</p>
                    <div class="rating text-warning d-flex align-items-center">
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
                  <span class="price text-primary fw-bold mb-2 fs-5">RM 34.90</span>
                </div>
              </div>
              <hr>
              <div class="item d-flex">
                <img src="images/product-item3.png" class="img-fluid shadow-sm" alt="product item">
                <div class="item-content ms-3">
                  <h6 class="mb-0 fw-bold"><a href="single-product">Intermezzo</a></h6>
                  <div class="review-content d-flex">
                    <p class="my-2 me-2 fs-6 text-black-50">Rooney, Sally</p>

                    <div class="rating text-warning d-flex align-items-center">
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
                  <span class="price text-primary fw-bold mb-2 fs-5">RM 89.95</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 mb-4 mb-lg-0 col-lg-3">
          <div class="latest-items border rounded-3 p-4">
            <div class="section-title overflow-hidden mb-5 mt-2">
              <h4 class="d-flex flex-column mb-0">#Trending Now</h4>
            </div>
            <div class="items-lists">
              <div class="item d-flex">
                <img src="images/product-item4.png" class="img-fluid shadow-sm" alt="product item">
                <div class="item-content ms-3">
                  <h6 class="mb-0 fw-bold"><a href="single-product">Rumah Untuk Alie karya Lenn Liu </a></h6>
                  <div class="review-content d-flex">
                    <p class="my-2 me-2 fs-6 text-black-50">Lenn Liu</p>
                    <div class="rating text-warning d-flex align-items-center">
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
                  <span class="price text-primary fw-bold mb-2 fs-5">RM 35.00</span>
                </div>
              </div>
              <hr class="gray-400">
              <div class="item d-flex">
                <img src="images/product-item5.png" class="img-fluid shadow-sm" alt="product item">
                <div class="item-content ms-3">
                  <h6 class="mb-0 fw-bold"><a href="single-product">The Seven Husbands Of Evelyn Hugo (UK)</a></h6>
                  <div class="review-content d-flex">
                    <p class="my-2 me-2 fs-6 text-black-50">Reid,Taylor Jenkins</p>
                    <div class="rating text-warning d-flex align-items-center">
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
                  <span class="price text-primary fw-bold mb-2 fs-5">RM 65.90</span>
                </div>
              </div>
              <hr>
              <div class="item d-flex">
                <img src="images/product-item6.png" class="img-fluid shadow-sm" alt="product item">
                <div class="item-content ms-3">
                  <h6 class="mb-0 fw-bold"><a href="single-product">On Palestine</a></h6>
                  <div class="review-content d-flex">
                    <p class="my-2 me-2 fs-6 text-black-50">Chomsky, Noam; Pappe, Ilanr</p>
                    <div class="rating text-warning d-flex align-items-center">
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
                  <span class="price text-primary fw-bold mb-2 fs-5">RM 68.95</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 mb-4 mb-lg-0 col-lg-3">
          <div class="best-reviewed border rounded-3 p-4">
            <div class="section-title overflow-hidden mb-5 mt-2">
              <h3 class="d-flex flex-column mb-0">Gotta Have It!</h3>
            </div>
            <div class="items-lists">
              <div class="item d-flex">
                <img src="images/product-item7.png" class="img-fluid shadow-sm" alt="product item">
                <div class="item-content ms-3">
                  <h6 class="mb-0 fw-bold"><a href="single-product">Watch Me (Shatter Me: The New Republic #01)</a></h6>
                  <div class="review-content d-flex">
                    <p class="my-2 me-2 fs-6 text-black-50">Mafi, Tahereh</p>
                    <div class="rating text-warning d-flex align-items-center">
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
                  <span class="price text-primary fw-bold mb-2 fs-5">RM 69.95</span>
                </div>
              </div>
              <hr class="gray-400">
              <div class="item d-flex">
                <img src="images/product-item8.png" class="img-fluid shadow-sm" alt="product item">
                <div class="item-content ms-3">
                  <h6 class="mb-0 fw-bold"><a href="single-product">King of Envy</a></h6>
                  <div class="review-content d-flex">
                    <p class="my-2 me-2 fs-6 text-black-50">Huang, Ana</p>
                    <div class="rating text-warning d-flex align-items-center">
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
                  <span class="price text-primary fw-bold mb-2 fs-5">RM 69.90</span>
                </div>
              </div>
              <hr>
              <div class="item d-flex">
                <img src="images/product-item9.png" class="img-fluid shadow-sm" alt="product item">
                <div class="item-content ms-3">
                  <h6 class="mb-0 fw-bold"><a href="single-product">Tales of the Enchanted Forest</a></h6>
                  <div class="review-content d-flex">
                    <p class="my-2 me-2 fs-6 text-black-50">Lauren Asher</p>
                    <div class="rating text-warning d-flex align-items-center">
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
                  <span class="price text-primary fw-bold mb-2 fs-5">RM 870</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 mb-4 mb-lg-0 col-lg-3">
          <div class="on-sale border rounded-3 p-4">
            <div class="section-title overflow-hidden mb-5 mt-2">
              <h3 class="d-flex flex-column mb-0">On sale</h3>
            </div>
            <div class="items-lists">
              <div class="item d-flex">
                <img src="images/product-item10.png" class="img-fluid shadow-sm" alt="product item">
                <div class="item-content ms-3">
                  <h6 class="mb-0 fw-bold"><a href="single-product">The Phoenix Chronicles</a></h6>
                  <div class="review-content d-flex">
                    <p class="my-2 me-2 fs-6 text-black-50">Lauren Asher</p>
                    <div class="rating text-warning d-flex align-items-center">
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
                  <span class="price text-primary fw-bold mb-2 fs-5"><s class="text-black-50">RM 1666</s>
                    RM 999</span>
                </div>
              </div>
              <hr class="gray-400">
              <div class="item d-flex">
                <img src="images/product-item11.png" class="img-fluid shadow-sm" alt="product item">
                <div class="item-content ms-3">
                  <h6 class="mb-0 fw-bold"><a href="single-product">Dreams of Avalon</a></h6>
                  <div class="review-content d-flex">
                    <p class="my-2 me-2 fs-6 text-black-50">Lauren Asher</p>
                    <div class="rating text-warning d-flex align-items-center">
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
                  <span class="price text-primary fw-bold mb-2 fs-5"><s class="text-black-50">RM 500</s>
                    RM 410</span>
                </div>
              </div>
              <hr>
              <div class="item d-flex">
                <img src="images/product-item12.png" class="img-fluid shadow-sm" alt="product item">
                <div class="item-content ms-3">
                  <h6 class="mb-0 fw-bold"><a href="single-product">Legends of the Dragon Isles</a></h6>
                  <div class="review-content d-flex">
                    <p class="my-2 me-2 fs-6 text-black-50">Lauren Asher</p>
                    <div class="rating text-warning d-flex align-items-center">
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
                  <span class="price text-primary fw-bold mb-2 fs-5"><s class="text-black-50">RM 600</s>
                    RM 500</span>
                </div>
              </div>
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
    <div class="position-relative px-5">
      <!-- Previous Arrow (positioned left outside content) -->
      <div class="position-absolute top-50 start-0 translate-middle-y z-1 swiper-prev product-slider-button-prev">
        <svg class="chevron-back-circle bg-white rounded-circle shadow-sm p-2" width="40" height="40">
          <use xlink:href="#alt-arrow-left-outline"></use>
        </svg>
      </div>

      <!-- Swiper content -->
      <div class="swiper category-swiper">
        <div class="swiper-wrapper">
          <!-- Category Slides -->
          <div class="swiper-slide">
           <div class="card-container">
              <div class="client-card">
              <img src="images/public.png" alt="Bacaan Umum" class="img-fluid" style="height:150px; object-fit: contain;" />
              <p class="mt-2">Bacaan Umum</p>
                </div>
            </div>
          </div>

          <div class="swiper-slide">
            <div class="card-container">
              <div class="client-card">
              <img src="images/children.png" alt="Children's Books" class="img-fluid" style="height:150px; object-fit: contain;" />
              <p class="mt-2">Children's Books</p>
              </div>
            </div>
          </div>

          <div class="swiper-slide">
            <div class="card-container">
              <div class="client-card">
              <img src="images/thriller.png" alt="Crime & Thriller" class="img-fluid" style="height:150px; object-fit: contain;" />
              <p class="mt-2">Crime & Thriller</p>
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
              <p class="mt-2">Non-Fiction</p>
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
          </div>
        </div>
      </div>

      <!-- Next Arrow (positioned right outside content) -->
      <div class="position-absolute top-50 end-0 translate-middle-y z-1 swiper-next product-slider-button-next">
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
          <div class="swiper-slide">
            <div class="card position-relative text-left p-5 border rounded-3">
              <blockquote>"Pengalaman membeli buku di BooksLoaf memang terbaik! Proses pembelian sangat mudah dan penghantaran pun cepat. Buku sampai dalam keadaan sempurna dan dibalut dengan kemas. Saya juga suka pilihan buku yang ditawarkan – dari novel, buku motivasi, hingga bahan rujukan pelajaran. Pasti akan beli lagi lepas ni. Terima kasih BooksLoaf!"</blockquote>
              <div class="rating text-warning d-flex align-items-center">
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
              <h5 class="mt-1 fw-noRM al">Nurul Aina, Kelantan</h5>
            </div>
          </div>
          <div class="swiper-slide">
            <div class="card position-relative text-left p-5 border rounded-3">
              <blockquote>"Shopping for books at BooksLoaf was an amazing experience! The ordering process was smooth, and delivery was fast. The books arrived in perfect condition and were well-packaged. I also love the variety of books available – from novels and self-help to academic references. Definitely coming back for more. Thank you, BooksLoaf!"</blockquote>
              <div class="rating text-warning d-flex align-items-center">
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
              <h5 class="mt-1 fw-noRM al">Nadhir Nasar, Perak</h5>
            </div>
          </div>
          <div class="swiper-slide">
            <div class="card position-relative text-left p-5 border rounded-3">
              <blockquote>"BooksLoaf 帮我找到很多实惠的教材。送货速度非常快，我在开学前就收到了全部书籍。非常推荐给学生！"</blockquote>
              <div class="rating text-warning d-flex align-items-center">
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
              <h5 class="mt-1 fw-noRM al">Kevin Tan</h5>
            </div>
          </div>
          <div class="swiper-slide">
            <div class="card position-relative text-left p-5 border rounded-3">
              <blockquote>“我喜欢在 BooksLoaf 浏览最新小说。他们的推荐总是很贴合我的口味，购买流程也很方便”</blockquote>
              <div class="rating text-warning d-flex align-items-center">
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
              <h5 class="mt-1 fw-noRM al">Joyce Ang</h5>
            </div>
          </div>
          <div class="swiper-slide">
            <div class="card position-relative text-left p-5 border rounded-3">
              <blockquote>“I love browsing the latest novels on BooksLoaf. The recommendations are always spot-on and the checkout process is simple.”</blockquote>
              <div class="rating text-warning d-flex align-items-center">
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
              <h5 class="mt-1 fw-noRM al">Jennifer Huh</h5>
            </div>
          </div>
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
        <img src="images/TheBenefitsofReading.jpeg" alt="instagram" class="img-fluid rounded-3 insta-image">
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
        <img src="images/TheFunfactsaboutreading.jpeg" alt="instagram" class="img-fluid rounded-3 insta-image">
      </a>
    </figure>
  </div>
        <div class="col-md-2">
          <figure class="instagram-item position-relative rounded-3">
            <a href="https://templatesjungle.com/" class="image-link position-relative">
              <div class="icon-overlay position-absolute d-flex justify-content-center">
                <svg class="instagram">
                  <use xlink:href="#instagram"></use>
                </svg>
              </div>
              <img src="images/insta-item3.jpg" alt="instagram" class="img-fluid rounded-3 insta-image">
            </a>
          </figure>
        </div>
        <div class="col-md-2">
          <figure class="instagram-item position-relative rounded-3">
            <a href="https://templatesjungle.com/" class="image-link position-relative">
              <div class="icon-overlay position-absolute d-flex justify-content-center">
                <svg class="instagram">
                  <use xlink:href="#instagram"></use>
                </svg>
              </div>
              <img src="images/insta-item4.jpg" alt="instagram" class="img-fluid rounded-3 insta-image">
            </a>
          </figure>
        </div>
        <div class="col-md-2">
          <figure class="instagram-item position-relative rounded-3">
            <a href="https://templatesjungle.com/" class="image-link position-relative">
              <div class="icon-overlay position-absolute d-flex justify-content-center">
                <svg class="instagram">
                  <use xlink:href="#instagram"></use>
                </svg>
              </div>
              <img src="images/insta-item5.jpg" alt="instagram" class="img-fluid rounded-3 insta-image">
            </a>
          </figure>
        </div>
        <div class="col-md-2">
          <figure class="instagram-item position-relative rounded-3">
            <a href="https://templatesjungle.com/" class="image-link position-relative">
              <div class="icon-overlay position-absolute d-flex justify-content-center">
                <svg class="instagram">
                  <use xlink:href="#instagram"></use>
                </svg>
              </div>
              <img src="images/insta-item6.jpg" alt="instagram" class="img-fluid rounded-3 insta-image">
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

