<h4 class="d-flex justify-content-between align-items-center mb-3">
    <span class="text-primary">Your Likes</span>
    <span class="badge bg-primary rounded-pill">{{ $likedBooks->count() }}</span>
</h4>

<ul class="list-group" style="max-height: 300px; overflow-y: auto;">
    @php $total = 0; @endphp
    @forelse ($likedBooks as $like)
    @php
    $book = $like->book;
    $total += $book->price;
    @endphp

    <li class="list-group-item bg-transparent d-flex justify-content-between lh-sm">
        <div>
            <h6><a href="{{ url('book', $book->id) }}">{{ $book->title }}</a></h6>
            <form action="{{ route('cart-add', $book->id) }}" method="POST" class="mt-2">
                @csrf
                <input type="hidden" name="quantity" value="1">
                <button type="submit"
                    class="d-block fw-medium text-capitalize mt-2"
                    style="background:none; border:none; padding:0; color:inherit; font:inherit; cursor:pointer;"
                    onmouseover="this.style.color = 'var(--primary-color)'"
                    onmouseout="this.style.color = 'inherit'">
                    Add to cart
                </button>
            </form>
        </div>
        <span class="text-primary">RM{{ number_format($book->price, 2) }}</span>
    </li>
    @empty
    <li class="list-group-item bg-transparent">No liked books yet.</li>
    @endforelse


</ul>

<ul class="list-group mb-3">
    <li class="list-group-item bg-transparent d-flex justify-content-between">
        <span class="text-capitalize"><b>Total (RM)</b></span>
        <strong>RM{{ number_format($total, 2) }}</strong>
    </li>
</ul>

@if ($likedBooks->count())
<div class="d-flex flex-wrap justify-content-center">
    <form action="{{ route('cart-add-all-liked') }}" method="POST" class="w-100 mb-1">
        @csrf
        <button class="btn btn-dark w-100" type="submit">Add all to cart</button>
    </form>
</div>
@endif