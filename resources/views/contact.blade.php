<!DOCTYPE html>
<html>

@include('layouts.header')

<body>

  @include('layouts.navbar')

  <div class="contact-us padding-large">
    <div class="container">
      <div class="row">
        <div class="contact-info col-lg-6 pb-3">
          <h3>Contact Us</h3>
          <p class="mb-5"> We are here to help you with any questions or conserns you may have.
          <div class="page-content d-flex flex-wrap">
            <div class="col-lg-6 col-sm-12">
              <div class="content-box text-dark pe-4 mb-5">
                <h5 class="fw-bold">Office</h5>
                <div class="contact-address pt-3">
                  <p>📍<b>UTM SPACE JOHOR </b>
                    <br>
                    <br> Aras 4 dan 5, Blok T05, Skudai,
                    <br> 81310 Johor Bahru, Johor Darul Ta'zim
                  </p>
                </div>
                <div class="contact-number">
                  <p>
                    <a href="#">📞 +60 11 2161 6451</a>
                  </p>
                </div>
                <div class="email-address">
                  <p>
                    <a href="#">📧 booksloaf@gmail.com </a>
                  </p>
                </div>
                <br>
                <!-- Google Map Embed -->
                <div class="map-location">
                  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.3341315816615!2d103.6526624!3d1.5628564999999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31da7144b481abf3%3A0x4cc971cc1cb65ed8!2sUTMSPACE%20JOHOR!5e0!3m2!1sen!2smy!4v1748014152566!5m2!1sen!2smy" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-sm-12">
              <div class="content-box">
                <div class="image-holder mb-5">
                  <img src="images/utmspace.jpg" alt="our-store" style="width:85%">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="inquiry-item col-lg-6">
          <h3>Submit a Support Ticket</h3>
          <p class="mb-5">We're here to help. Submit your issue or inquiry below.</p>

          <form method="POST" action="{{ route('support.store') }}" class="d-flex gap-3 flex-wrap">
            @csrf

            <div class="w-100 d-flex gap-3">
              <div class="w-50">
                <input type="text" name="name" class="form-control w-100"
                  value="{{ auth()->user()->name }}" readonly>
              </div>
              <div class="w-50">
                <input type="number" name="phone" placeholder="PHONE NUMBER *"
                  class="form-control w-100" required>
              </div>
            </div>

            <div class="w-100">
              <input type="email" name="email" class="form-control w-100"
                value="{{ auth()->user()->email }}" readonly>
            </div>

            <div class="w-100">
              <select name="subject" class="form-control w-100" required>
                <option value="" disabled selected>-- Select Subject --</option>
                <option value="Account Issue">Account Issue</option>
                <option value="Payment Problem">Payment Problem</option>
                <option value="Book Request">Book Request</option>
                <option value="Technical Error">Technical Error</option>
                <option value="Other">Other</option>
              </select>
            </div>

            <div class="w-100">
              <textarea name="message" class="form-control w-100" rows="6"
                placeholder="Describe your issue or message..." required></textarea>
            </div>

            <button type="submit" class="btn btn-primary my-3">Submit Ticket</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <section id="customers-reviews" class="position-relative padding-large"
    style="background-image: url(images/banner-image-bg.jpg); background-size: cover; background-repeat: no-repeat; background-position: center; height: 600px;">
    <div class="container offset-md-3 col-md-6 ">
      <div class="position-absolute top-50 end-0 pe-0 pe-xxl-5 me-0 me-xxl-5 swiper-next testimonial-button-next">
        <svg class="chevron-forward-circle d-flex justify-content-center align-items-center p-2" width="80" height="80">
          <use xlink:href="#alt-arrow-right-outline"></use>
        </svg>
      </div>
      <div class="position-absolute top-50 start-0 ps-0 ps-xxl-5 ms-0 ms-xxl-5 swiper-prev testimonial-button-prev">
        <svg class="chevron-back-circle d-flex justify-content-center align-items-center p-2" width="80" height="80">
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

  <section id="latest-posts" class="padding-large">
    <div class="container">
      <div class="section-title d-md-flex justify-content-between align-items-center mb-4">
        <h3 class="d-flex align-items-center">Latest posts</h3>
        <a href="shop" class="btn">View All</a>
      </div>
      <div class="row">
        <div class="col-md-3 posts mb-4">
          <img src="images/post-item1.jpg" alt="post image" class="img-fluid rounded-3">
          <a href="blog" class="fs-6 text-primary">Books</a>
          <h4 class="card-title mb-2 text-capitalize text-dark"><a href="single-post">The Strength of Independent Bookstores in a Digital Age*</a></h4>
          <p class="mb-2">Bookstores have been around for centuries, maintaining a sense of support within communities even as
            they evolved over time. <span><a class="text-decoration-underline text-black-50" href="single-post">Read More</a></span>
          </p>
        </div>
        <div class="col-md-3 posts mb-4">
          <img src="images/post-item2.jpg" alt="post image" class="img-fluid rounded-3">
          <a href="blog" class="fs-6 text-primary">Books</a>
          <h4 class="card-title mb-2 text-capitalize text-dark"><a href="single-post">📚 Impact of COVID-19 on Book Sales
            </a></h4>
          <p class="mb-2">An analysis of how the pandemic affected the U.S. book publishing market, including trade and educational sectors.
            <span><a class="text-decoration-underline text-black-50" href="single-post">Read More</a></span>
          </p>
        </div>
        <div class="col-md-3 posts mb-4">
          <img src="images/post-item3.jpg" alt="post image" class="img-fluid rounded-3">
          <a href="blog" class="fs-6 text-primary">Books</a>
          <h4 class="card-title mb-2 text-capitalize text-dark"><a href="single-post">Online Purchase Behavior of Generation Y in Malaysia"</a></h4>
          <p class="mb-2">A study investigating the online purchase behavior of Gen Y in Malaysia and identifying influencing factors.
            <span><a class="text-decoration-underline text-black-50" href="single-post">Read More</a></span>
          </p>
        </div>
        <div class="col-md-3 posts mb-4">
          <img src="images/post-item4.jpg" alt="post image" class="img-fluid rounded-3">
          <a href="blog" class="fs-6 text-primary">Books</a>
          <h4 class="card-title mb-2 text-capitalize text-dark"><a href="single-post">Factors Influencing Consumer Behaviour towards Online Purchase Intention on Popular Shopping Platforms in Malaysia"*
            </a></h4>
          <p class="mb-2">Research exploring how the quality of e-commerce in Malaysia impacts consumer preferences.
            <span><a class="text-decoration-underline text-black-50" href="single-post">Read More</a></span>
          </p>
        </div>
      </div>
    </div>
  </section>

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


@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('ticket_submitted'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Ticket Submitted',
        text: 'Your support ticket has been received. We’ll get back to you shortly!',
        confirmButtonText: 'Okay'
    });
</script>
@endif
@endpush
