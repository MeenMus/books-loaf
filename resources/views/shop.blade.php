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
                    <a href="{{ url('book/' . $book->id) }}" class="text-dark text-decoration-none">{{ $book->title }}</a>
                  </h6>
                  <p class="fs-6 text-black-50">{{ $book->author }}</p>
                              @if ($book->reviews_avg_rating)
    @php
        $rating = round($book->reviews_avg_rating, 1);
        $fullStars = floor($rating);
        $hasHalfStar = ($rating - $fullStars) >= 0.5;
        $emptyStars = 5 - $fullStars - ($hasHalfStar ? 1 : 0);
    @endphp

    <div class="rating text-warning d-flex align-items-center mb-2">
        {{-- Full stars --}}
        @for ($i = 0; $i < $fullStars; $i++)
            <svg class="star star-fill me-1" style="fill: #ffc107; width: 18px;">
                <use xlink:href="#star-fill"></use>
            </svg>
        @endfor

        {{-- Half star --}}
        @if ($hasHalfStar)
            <svg class="star star-half me-1" style="fill: #ffc107; width: 18px;">
                <use xlink:href="#star-half"></use>
            </svg>
        @endif

        {{-- Empty stars --}}
        @for ($i = 0; $i < $emptyStars; $i++)
            <svg class="star star-empty me-1" style="fill: #e4e5e9; width: 18px;">
                <use xlink:href="#star"></use>
            </svg>
        @endfor
    </div>
@else
    {{-- Show 5 empty stars if no rating --}}
    <div class="rating d-flex align-items-center mb-2">
        @for ($i = 0; $i < 5; $i++)
           <svg class="star star-empty" width="20" height="20" style="fill: none; stroke: #ffc107; stroke-width: 1.5;">
                <use xlink:href="#star" />
            </svg>
        @endfor
    </div>
@endif



                </div>

                <span class="price text-primary fw-bold fs-5">RM{{ number_format($book->price, 2) }}</span>

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
  <svg style="display: none;">
  <symbol id="star-fill" viewBox="0 0 16 16">
    <path d="M3.612 15.443c-.396.198-.824-.149-.746-.592l.83-4.73L.173 
    6.765c-.329-.32-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 
    0l2.184 4.327 4.898.696c.441.062.612.63.282.95l-3.522 
    3.356.83 4.73c.078.443-.35.79-.746.592L8 
    13.187l-4.389 2.256z"/>
  </symbol>
  <symbol id="star-half" viewBox="0 0 16 16">
    <path d="M5.354 5.119l-.83 4.73L.998 6.765l4.898-.696L7.538.792v12.395l-4.389 
    2.256c-.396.198-.824-.149-.746-.592l.83-4.73L.173 
    6.765c-.329-.32-.158-.888.283-.95l4.898-.696z"/>
  </symbol>
  <symbol id="star" viewBox="0 0 16 16">
    <path d="M2.866 14.85c-.078.444.36.791.746.593L8 
    13.187l4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 
    3.522-3.356c.33-.32.16-.888-.282-.95l-4.898-.696L8 
    .792 5.816 5.12l-4.898.696c-.441.062-.612.63-.283.95l3.522 
    3.356-.83 4.73z"/>
  </symbol>
</svg>
</body>


</html>