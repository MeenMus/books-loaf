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

  /* Force star colors in all contexts */
.star-fill {
    fill: #ffc107 !important; /* Gold - override any other fills */
    color: #ffc107 !important; /* For currentColor inheritance */
}

.star-empty {
    fill: #e4e5e9 !important; /* Light gray */
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
  overflow: visible; /* Allows arrows to extend outside */
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
  height: 240px;
}

/* Larger card styling */
.client-card {
  padding: 12px; /* Increased padding */
  height: 100%; /* Fill container */
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: space-between;
}


/* Enlarged image */
.client-card img {
  height: 200px !important; /* Increased from 150px */
  width: auto;
  max-width: 100%;
  object-fit: contain;
}

/* Larger text */
.client-card p {
   margin-top: 15px; /* Increased spacing */
  font-size: 1.1rem; /
}

/* Adjust spacing between cards */
#main-category-swiper .swiper-slide {
  margin-right: 10px; /* Slightly increased gap to balance larger cards */
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
              <img src="images/bayang-sofea.jpg" class="img-fluid shadow-sm" alt="product item">
              <h6 class="mt-4 mb-0 fw-bold"><a href="https://booksloaf.com/book/60">Bayang Sofea</a></h6>
              <div class="review-content d-flex">
                <p class="my-2 me-2 fs-6 text-black-50">Teme Abdullah</p>

                <div class="rating text-warning d-flex align-items-center">
                  <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">
                    <use xlink:href="#star-fill"></use>
                  </svg>
                 <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                    <use xlink:href="#star-fill"></use>
                  </svg>
                 <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                    <use xlink:href="#star-fill"></use>
                  </svg>
                 <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                    <use xlink:href="#star-fill"></use>
                  </svg>
                 <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                    <use xlink:href="#star-fill"></use>
                  </svg>
                </div>
              </div>
              <span class="price text-primary fw-bold mb-2 fs-5">RM 34.00</span>
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
              <img src="images/great-big-beautiful-life.jpg" class="img-fluid shadow-sm" alt="product item">
              <h6 class="mt-4 mb-0 fw-bold"><a href="https://booksloaf.com/book/164">Great Big Beautiful Life</a></h6>
              <div class="review-content d-flex">
                <p class="my-2 me-2 fs-6 text-black-50">Emily Henry</p>

                <div class="rating text-warning d-flex align-items-center">
                 <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                    <use xlink:href="#star-fill"></use>
                  </svg>
                 <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                    <use xlink:href="#star-fill"></use>
                  </svg>
                 <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                    <use xlink:href="#star-fill"></use>
                  </svg>
                 <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                    <use xlink:href="#star-fill"></use>
                  </svg>
                 <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                    <use xlink:href="#star-fill"></use>
                  </svg>
                </div>
              </div>

              <span class="price text-primary fw-bold mb-2 fs-5">RM 80.00</span>
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
              <img src="images/library-of-lost-hearts.jpg" class="img-fluid shadow-sm" alt="product item">
              <h6 class="mt-4 mb-0 fw-bold"><a href="https://booksloaf.com/book/27">Library of Lost Hearts</a></h6>
              <div class="review-content d-flex">
                <p class="my-2 me-2 fs-6 text-black-50">NF Afrina</p>

                <div class="rating text-warning d-flex align-items-center">
                 <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                    <use xlink:href="#star-fill"></use>
                  </svg>
                 <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                    <use xlink:href="#star-fill"></use>
                  </svg>
                 <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                    <use xlink:href="#star-fill"></use>
                  </svg>
                 <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                    <use xlink:href="#star-fill"></use>
                  </svg>
                </div>
              </div>

              <span class="price text-primary fw-bold mb-2 fs-5">RM 39.00</span>
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
              <img src="images/siapa-sangka-terjatuh-cinta.jpg" class="img-fluid shadow-sm" alt="product item">
              <h6 class="mt-4 mb-0 fw-bold"><a href="https://booksloaf.com/book/62">Siapa Sangka Terjatuh Cinta</a></h6>
              <div class="review-content d-flex">
                <p class="my-2 me-2 fs-6 text-black-50">Violet Fasha</p>

                <div class="rating text-warning d-flex align-items-center">
                 <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                    <use xlink:href="#star-fill"></use>
                  </svg>
                 <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                    <use xlink:href="#star-fill"></use>
                  </svg>
                 <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                    <use xlink:href="#star-fill"></use>
                  </svg>
                 <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                    <use xlink:href="#star-fill"></use>
                  </svg>
                </div>
              </div>

              <span class="price text-primary fw-bold mb-2 fs-5">RM 32.00</span>
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
              <img src="images/surrounded-by-idiots.jpg" class="img-fluid shadow-sm" alt="product item">
              <h6 class="mt-4 mb-0 fw-bold"><a href="https://booksloaf.com/book/174">Surrounded by Idiots</a></h6>
              <div class="review-content d-flex">
                <p class="my-2 me-2 fs-6 text-black-50">Thomas Erikson</p>

                <div class="rating text-warning d-flex align-items-center d-flex align-items-center">
                 <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                    <use xlink:href="#star-fill"></use>
                  </svg>
                 <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                    <use xlink:href="#star-fill"></use>
                  </svg>
                 <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                    <use xlink:href="#star-fill"></use>
                  </svg>
                 <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                    <use xlink:href="#star-fill"></use>
                  </svg>
                  <br>
                </div>
              </div>

              <span class="price text-primary fw-bold mb-2 fs-5">RM 62.90</span>
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
              <img src="images/the-midnight-library.jpg" class="img-fluid shadow-sm" alt="product item">
              <h6 class="mt-4 mb-0 fw-bold"><a href="https://booksloaf.com/book/119">The Midnight Library</a></h6>
              <div class="review-content d-flex">
                <p class="my-2 me-2 fs-6 text-black-50">Matt Haig</p>

                <div class="rating text-warning d-flex align-items-center">
                 <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                    <use xlink:href="#star-fill"></use>
                  </svg>
                 <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                    <use xlink:href="#star-fill"></use>
                  </svg>
                 <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                    <use xlink:href="#star-fill"></use>
                  </svg>
                 <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                    <use xlink:href="#star-fill"></use>
                  </svg>
                 <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                    <use xlink:href="#star-fill"></use>
                  </svg>
                </div>
              </div>

              <span class="price text-primary fw-bold mb-2 fs-5">RM 42.00</span>
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
                <img src="images/Thariq Ridzuwan.jpg" class="img-fluid shadow-sm" alt="product item">
                <div class="item-content ms-3">
                  <h6 class="mb-0 fw-bold"><a href="https://booksloaf.com/book/48">Thariq Ridzuwan Commando's : His Treasure</a></h6>
                  <div class="review-content d-flex">
                    <p class="my-2 me-2 fs-6 text-black-50">Huda Najwa</p>

                    <div class="rating text-warning d-flex align-items-center">
                     <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                        <use xlink:href="#star-fill"></use>
                      </svg>
                     <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                        <use xlink:href="#star-fill"></use>
                      </svg>
                     <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                        <use xlink:href="#star-fill"></use>
                      </svg>
                     <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                        <use xlink:href="#star-fill"></use>
                      </svg>
                     <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                        <use xlink:href="#star-fill"></use>
                      </svg>
                    </div>
                  </div>
                  <span class="price text-primary fw-bold mb-2 fs-5">RM 35.00</span>
                </div>
              </div>
              <hr class="gray-400">
              <div class="item d-flex">
                <img src="images/dog-man.jpg" class="img-fluid shadow-sm" alt="product item">
                <div class="item-content ms-3">
                  <h6 class="mb-0 fw-bold"><a href="https://booksloaf.com/book/151">Dog Man: Big Jim Believes</a></h6>
                  <div class="review-content d-flex">
                    <p class="my-2 me-2 fs-6 text-black-50">Pilkey, Dav</p>
                    <div class="rating text-warning d-flex align-items-center">
                     <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                        <use xlink:href="#star-fill"></use>
                      </svg>
                     <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                        <use xlink:href="#star-fill"></use>
                      </svg>
                     <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                        <use xlink:href="#star-fill"></use>
                      </svg>
                     <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                        <use xlink:href="#star-fill"></use>
                      </svg>
                     <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                        <use xlink:href="#star-fill"></use>
                      </svg>
                    </div>
                  </div>
                  <span class="price text-primary fw-bold mb-2 fs-5">RM 34.90</span>
                </div>
              </div>
              <hr>
              <div class="item d-flex">
                <img src="images/i-hope-this-doesnt-find-you.jpg" class="img-fluid shadow-sm" alt="product item">
                <div class="item-content ms-3">
                  <h6 class="mb-0 fw-bold"><a href="https://booksloaf.com/book/31">I Hope This Doesn't Find You</a></h6>
                  <div class="review-content d-flex">
                    <p class="my-2 me-2 fs-6 text-black-50">Liang, Ann</p>

                    <div class="rating text-warning d-flex align-items-center">
                     <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                        <use xlink:href="#star-fill"></use>
                      </svg>
                     <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                        <use xlink:href="#star-fill"></use>
                      </svg>
                     <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                        <use xlink:href="#star-fill"></use>
                      </svg>
                     <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                        <use xlink:href="#star-fill"></use>
                      </svg>
                     <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                        <use xlink:href="#star-fill"></use>
                      </svg>
                    </div>
                  </div>
                  <span class="price text-primary fw-bold mb-2 fs-5">RM 65.90</span>
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
                <img src="images/rumah-untuk-alie.jpg" class="img-fluid shadow-sm" alt="product item">
                <div class="item-content ms-3">
                  <h6 class="mb-0 fw-bold"><a href="https://booksloaf.com/book/49">Rumah Untuk Alie karya Lenn Liu </a></h6>
                  <div class="review-content d-flex">
                    <p class="my-2 me-2 fs-6 text-black-50">Lenn Liu</p>
                    <div class="rating text-warning d-flex align-items-center">
                     <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                        <use xlink:href="#star-fill"></use>
                      </svg>
                     <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                        <use xlink:href="#star-fill"></use>
                      </svg>
                     <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                        <use xlink:href="#star-fill"></use>
                      </svg>
                     <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                        <use xlink:href="#star-fill"></use>
                      </svg>
                     <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                        <use xlink:href="#star-fill"></use>
                      </svg>
                    </div>
                  </div>
                  <span class="price text-primary fw-bold mb-2 fs-5">RM 35.00</span>
                </div>
              </div>
              <hr class="gray-400">
              <div class="item d-flex">
                <img src="images/seven-husband-of-evelyn-hugo.jpg" class="img-fluid shadow-sm" alt="product item">
                <div class="item-content ms-3">
                  <h6 class="mb-0 fw-bold"><a href="https://booksloaf.com/book/176">The Seven Husbands Of Evelyn Hugo (UK)</a></h6>
                  <div class="review-content d-flex">
                    <p class="my-2 me-2 fs-6 text-black-50">Reid,Taylor Jenkins</p>
                    <div class="rating text-warning d-flex align-items-center">
                     <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                        <use xlink:href="#star-fill"></use>
                      </svg>
                     <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                        <use xlink:href="#star-fill"></use>
                      </svg>
                     <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                        <use xlink:href="#star-fill"></use>
                      </svg>
                     <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                        <use xlink:href="#star-fill"></use>
                      </svg>
                     <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                        <use xlink:href="#star-fill"></use>
                      </svg>
                    </div>
                  </div>
                  <span class="price text-primary fw-bold mb-2 fs-5">RM 65.90</span>
                </div>
              </div>
              <hr>
              <div class="item d-flex">
                <img src="images/how-was-your-day.jpg" class="img-fluid shadow-sm" alt="product item">
                <div class="item-content ms-3">
                  <h6 class="mb-0 fw-bold"><a href="https://booksloaf.com/book/67">How Was Your Day</a></h6>
                  <div class="review-content d-flex">
                    <p class="my-2 me-2 fs-6 text-black-50">Cheeming Boeyr</p>
                    <div class="rating text-warning d-flex align-items-center">
                     <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                        <use xlink:href="#star-fill"></use>
                      </svg>
                     <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                        <use xlink:href="#star-fill"></use>
                      </svg>
                     <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                        <use xlink:href="#star-fill"></use>
                      </svg>
                     <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                        <use xlink:href="#star-fill"></use>
                      </svg>
                     <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                        <use xlink:href="#star-fill"></use>
                      </svg>
                    </div>
                  </div>
                  <span class="price text-primary fw-bold mb-2 fs-5">RM 39.90</span>
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
                <img src="images/watch-me.jpg" class="img-fluid shadow-sm" alt="product item">
                <div class="item-content ms-3">
                  <h6 class="mb-0 fw-bold"><a href="https://booksloaf.com/book/30">Watch Me (Shatter Me: The New Republic #01)</a></h6>
                  <div class="review-content d-flex">
                    <p class="my-2 me-2 fs-6 text-black-50">Mafi, Tahereh</p>
                    <div class="rating text-warning d-flex align-items-center">
                     <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                        <use xlink:href="#star-fill"></use>
                      </svg>
                     <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                        <use xlink:href="#star-fill"></use>
                      </svg>
                     <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                        <use xlink:href="#star-fill"></use>
                      </svg>
                     <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                        <use xlink:href="#star-fill"></use>
                      </svg>
                     <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                        <use xlink:href="#star-fill"></use>
                      </svg>
                    </div>
                  </div>
                  <span class="price text-primary fw-bold mb-2 fs-5">RM 69.95</span>
                </div>
              </div>
              <hr class="gray-400">
              <div class="item d-flex">
                <img src="images/king-of-envy.jpg" class="img-fluid shadow-sm" alt="product item">
                <div class="item-content ms-3">
                  <h6 class="mb-0 fw-bold"><a href="https://booksloaf.com/book/175">King of Envy</a></h6>
                  <div class="review-content d-flex">
                    <p class="my-2 me-2 fs-6 text-black-50">Huang, Ana</p>
                    <div class="rating text-warning d-flex align-items-center">
                     <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                        <use xlink:href="#star-fill"></use>
                      </svg>
                     <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                        <use xlink:href="#star-fill"></use>
                      </svg>
                     <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                        <use xlink:href="#star-fill"></use>
                      </svg>
                     <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                        <use xlink:href="#star-fill"></use>
                      </svg>
                     <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                        <use xlink:href="#star-fill"></use>
                      </svg>
                    </div>
                  </div>
                  <span class="price text-primary fw-bold mb-2 fs-5">RM 69.90</span>
                </div>
              </div>
              <hr>
              <div class="item d-flex">
                <img src="images/girl-woman-other.jpg" class="img-fluid shadow-sm" alt="product item">
                <div class="item-content ms-3">
                  <h6 class="mb-0 fw-bold"><a href="https://booksloaf.com/book/125">Girl, Woman, Other</a></h6>
                  <div class="review-content d-flex">
                    <p class="my-2 me-2 fs-6 text-black-50">Bernardine Evaristo</p>
                    <div class="rating text-warning d-flex align-items-center">
                     <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                        <use xlink:href="#star-fill"></use>
                      </svg>
                     <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                        <use xlink:href="#star-fill"></use>
                      </svg>
                     <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                        <use xlink:href="#star-fill"></use>
                      </svg>
                     <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                        <use xlink:href="#star-fill"></use>
                      </svg>
                     <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                        <use xlink:href="#star-fill"></use>
                      </svg>
                    </div>
                  </div>
                  <span class="price text-primary fw-bold mb-2 fs-5">RM 56.90</span>
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
                <img src="images/iron-flame.jpg" class="img-fluid shadow-sm" alt="product item">
                <div class="item-content ms-3">
                  <h6 class="mb-0 fw-bold"><a href="https://booksloaf.com/shop/all?s=thariq&page=4">Iron Flame</a></h6>
                  <div class="review-content d-flex">
                    <p class="my-2 me-2 fs-6 text-black-50">Yarros, Rebecca</p>
                    <div class="rating text-warning d-flex align-items-center">
                     <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                        <use xlink:href="#star-fill"></use>
                      </svg>
                     <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                        <use xlink:href="#star-fill"></use>
                      </svg>
                     <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                        <use xlink:href="#star-fill"></use>
                      </svg>
                     <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                        <use xlink:href="#star-fill"></use>
                      </svg>
                     <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                        <use xlink:href="#star-fill"></use>
                      </svg>
                    </div>
                  </div>
                  <span class="price text-primary fw-bold mb-2 fs-5"><s class="text-black-50">RM79.90</s>
                  RM63.92</span>
                </div>
              </div>
              <hr class="gray-400">
              <div class="item d-flex">
                <img src="images/good-girl-bad-blood.jpg" class="img-fluid shadow-sm" alt="product item">
                <div class="item-content ms-3">
                  <h6 class="mb-0 fw-bold"><a href="https://booksloaf.com/book/172">	Good Girl, Bad Blood</a></h6>
                  <div class="review-content d-flex">
                    <p class="my-2 me-2 fs-6 text-black-50">Holly Jackson</p>
                    <div class="rating text-warning d-flex align-items-center">
                     <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                        <use xlink:href="#star-fill"></use>
                      </svg>
                     <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                        <use xlink:href="#star-fill"></use>
                      </svg>
                     <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                        <use xlink:href="#star-fill"></use>
                      </svg>
                     <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                        <use xlink:href="#star-fill"></use>
                      </svg>
                     <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                        <use xlink:href="#star-fill"></use>
                      </svg>
                    </div>
                  </div>
                   <span class="price text-primary fw-bold mb-2 fs-5"><s class="text-black-50">RM59.90</s>
                  RM43.92</span>
                </div>
              </div>
              <hr>
              <div class="item d-flex">
                <img src="images/the-hunger-games.jpg" class="img-fluid shadow-sm" alt="product item">
                <div class="item-content ms-3">
                  <h6 class="mb-0 fw-bold"><a href="https://booksloaf.com/book/20">The Hunger Games</a></h6>
                  <div class="review-content d-flex">
                    <p class="my-2 me-2 fs-6 text-black-50">Suzanne Collins</p>
                    <div class="rating text-warning d-flex align-items-center">
                     <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                        <use xlink:href="#star-fill"></use>
                      </svg>
                     <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                        <use xlink:href="#star-fill"></use>
                      </svg>
                     <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                        <use xlink:href="#star-fill"></use>
                      </svg>
                     <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                        <use xlink:href="#star-fill"></use>
                      </svg>
                     <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                        <use xlink:href="#star-fill"></use>
                      </svg>
                    </div>
                  </div>
                   <span class="price text-primary fw-bold mb-2 fs-5"><s class="text-black-50">RM 14.90</s>
                  RM10.90</span>
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
          <div class="swiper-slide">
           <div class="card-container">
              <div class="client-card">
              <img src="images/public.png" alt="Fiction" class="img-fluid" style="height:150px; object-fit: contain;" />
              <p class="mt-2">Fiction</p>
                </div>
            </div>
          </div>

          <div class="swiper-slide">
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
          </div>
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
          <div class="swiper-slide">
            <div class="card position-relative text-left p-5 border rounded-3">
              <blockquote>"Pengalaman membeli buku di BooksLoaf memang terbaik! Proses pembelian sangat mudah dan penghantaran pun cepat. Buku sampai dalam keadaan sempurna dan dibalut dengan kemas. Saya juga suka pilihan buku yang ditawarkan – dari novel, buku motivasi, hingga bahan rujukan pelajaran. Pasti akan beli lagi lepas ni. Terima kasih BooksLoaf!"</blockquote>
              <div class="rating text-warning d-flex align-items-center">
               <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                  <use xlink:href="#star-fill"></use>
                </svg>
               <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                  <use xlink:href="#star-fill"></use>
                </svg>
               <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                  <use xlink:href="#star-fill"></use>
                </svg>
               <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                  <use xlink:href="#star-fill"></use>
                </svg>
               <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
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
               <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                  <use xlink:href="#star-fill"></use>
                </svg>
               <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                  <use xlink:href="#star-fill"></use>
                </svg>
               <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
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
               <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                  <use xlink:href="#star-fill"></use>
                </svg>
               <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                  <use xlink:href="#star-fill"></use>
                </svg>
               <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                  <use xlink:href="#star-fill"></use>
                </svg>
               <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
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
               <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                  <use xlink:href="#star-fill"></use>
                </svg>
               <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                  <use xlink:href="#star-fill"></use>
                </svg>
               <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                  <use xlink:href="#star-fill"></use>
                </svg>
               <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                  <use xlink:href="#star-fill"></use>
                </svg>
               <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
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
               <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                  <use xlink:href="#star-fill"></use>
                </svg>
               <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                  <use xlink:href="#star-fill"></use>
                </svg>
               <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                  <use xlink:href="#star-fill"></use>
                </svg>
               <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
                  <use xlink:href="#star-fill"></use>
                </svg>
               <svg class="star star-fill" style="fill: #ffc107; color: #ffc107;">>
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
              <img src="images/booksloaf-bookstore.jpg" alt="instagram" class="img-fluid rounded-3 insta-image" >
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

