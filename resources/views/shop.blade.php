<!DOCTYPE html>
<html>


@include('layouts.header')


<body>

  @include('layouts.navbar')

  <div class="shopify-grid padding-medium">
    <div class="container">
      <div class="row flex-row-reverse g-md-5">
        <main class="col-md-9 d-flex flex-column" style="min-height: 100vh;">
          <div class="filter-shop d-flex flex-wrap justify-content-between mb-5">
            <div class="showing-product">
              <h4 class="mt-2">{{$genre->name}}</h4>
            </div>
            <div class="dropdown">
              <a href="#" class="dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown">
                @switch($sort)
                @case('name_asc') Name (A - Z) @break
                @case('name_desc') Name (Z - A) @break
                @case('price_low_high') Price (Low-High) @break
                @case('price_high_low') Price (High-Low) @break
                @case('rating_high') Rating (Highest) @break
                @case('rating_low') Rating (Lowest) @break
                @default Default sorting
                @endswitch
              </a>

              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="?sort=">Default sorting</a></li>
                <li><a class="dropdown-item" href="?sort=name_asc">Name (A - Z)</a></li>
                <li><a class="dropdown-item" href="?sort=name_desc">Name (Z - A)</a></li>
                <li><a class="dropdown-item" href="?sort=price_low_high">Price (Low-High)</a></li>
                <li><a class="dropdown-item" href="?sort=price_high_low">Price (High-Low)</a></li>
                <li><a class="dropdown-item" href="?sort=rating_high">Rating (Highest)</a></li>
                <li><a class="dropdown-item" href="?sort=rating_low">Rating (Lowest)</a></li>
              </ul>
            </div>
          </div>
          <div class="row product-content product-store">
            @forelse ($books as $book)
            <div class="col-lg-3 col-md-4 mb-4">
              <div class="card h-100 d-flex flex-column p-4 border rounded-3">

                @if(isset($book->cover_image))
                <img src="{{ url($book->cover_image) }}" class="img-fluid shadow-sm" alt="{{ $book->title }}">
                @endif

                <div class="mt-4 mb-auto">
                  <h6 class="fw-bold">
                    <a href="{{ url('book/' . $book->id) }}">{{ $book->title }}</a>
                  </h6>
                  
                  <p class="fs-6 text-black-50">{{ $book->author }}</p>

                  <div class="rating text-warning">
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

                <span class="price text-primary fw-bold fs-5">RM{{ number_format($book->price, 2) }}</span>

                <div class="card-concern position-absolute start-0 end-0 d-flex gap-2 mb-5">
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
            @empty
            <p>No books were found!.</p>
            @endforelse
          </div>
          <div class="mt-auto">
            <nav class="py-5" aria-label="Page navigation">
              <ul class="pagination justify-content-center gap-4">

                @if ($books->onFirstPage())
                <li class="page-item disabled">
                  <a class="page-link">Prev</a>
                </li>
                @else
                <li class="page-item">
                  <a class="page-link" href="{{ $books->previousPageUrl() }}">Prev</a>
                </li>
                @endif

                @foreach ($books->getUrlRange(1, $books->lastPage()) as $page => $url)
                @if ($page == $books->currentPage())
                <li class="page-item active" aria-current="page">
                  <span class="page-link">{{ $page }}</span>
                </li>
                @else
                <li class="page-item">
                  <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                </li>
                @endif
                @endforeach

                @if ($books->hasMorePages())
                <li class="page-item">
                  <a class="page-link" href="{{ $books->nextPageUrl() }}">Next</a>
                </li>
                @else
                <li class="page-item disabled">
                  <a class="page-link">Next</a>
                </li>
                @endif

              </ul>
            </nav>
          </div>
        </main>
        <aside class="col-md-3">
          <div class="widget-product-categories">
            <div class="section-title overflow-hidden mb-0">
              <h3 class="d-flex flex-column mb-0">Categories</h3>
            </div>
            <br>

            <!-- Search Bar -->
            <input type="text" class="form-control form-control-sm rounded-top mb-4" id="genreSearch" placeholder="Search">

            <!-- Scrollable List -->
            <div style="max-height: 1350px; overflow-y: auto;">
              <ul class="product-categories mb-0 sidebar-list list-unstyled" id="genreList">
                <li class="cat-item">
                  <a href="all">All</a>
                </li>
                <br>
                @foreach($genres as $genre)
                <li class="cat-item">
                  <a href="{{ $genre->id }}">{{ $genre->name }}</a>
                </li>
                <br>
                @endforeach
              </ul>
            </div>
          </div>
        </aside>
      </div>
    </div>
  </div>


  @include('layouts.footer')


  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const searchInput = document.getElementById('genreSearch');
      const items = document.querySelectorAll('#genreList .cat-item');

      searchInput.addEventListener('input', function() {
        const query = this.value.toLowerCase();
        items.forEach(item => {
          const text = item.textContent.toLowerCase();
          const br = item.nextElementSibling;
          const match = text.includes(query);
          item.style.display = match ? 'list-item' : 'none';
          if (br && br.tagName === 'BR') br.style.display = match ? 'block' : 'none';
        });
      });
    });
  </script>

  <script>
    function sortBooks(select) {
      const sort = select.value;
      const url = new URL(window.location.href);
      url.searchParams.set('sort', sort);
      window.location.href = url.toString();
    }
  </script>
</body>


</html>