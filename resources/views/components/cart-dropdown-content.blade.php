<h4 class="d-flex justify-content-between align-items-center mb-3">
    <span class="text-primary">Your Cart</span>
    <span class="badge bg-primary rounded-pill">{{ Auth::user()->cart?->cartItems()->sum('quantity') ?? 0 }}</span>
</h4>

<ul class="list-group" style="max-height: 300px; overflow-y: auto;">
    @php $total = 0; @endphp
    @forelse ($cartBooks as $cart)
    @php
    $book = $cart->book;
    $total += $book->price * $cart->quantity;
    @endphp

    <li class="list-group-item bg-transparent d-flex justify-content-between lh-sm">
        <div>
            <h5><a href="{{ url('book', $book->id) }}">{{ $book->title }}</a></h5>
            <small>Quantity: {{ $cart->quantity }}</small>
        </div>
        <span class="text-primary">RM{{ number_format($book->price, 2) }}</span>
    </li>
    @empty
    <li class="list-group-item bg-transparent">No books in cart yet.</li>
    @endforelse
</ul>

<ul class="list-group mb-3">
    <li class="list-group-item bg-transparent d-flex justify-content-between">
        <span class="text-capitalize"><b>Total (RM)</b></span>
        <strong>RM{{ number_format($total, 2) }}</strong>
    </li>
</ul>

@if ($cartBooks->count())
<div class="d-flex flex-wrap justify-content-center">
    <a href="{{ url('cart') }}" class="btn btn-dark w-100 mb-1">View Cart</a>
    <a href="{{ url('checkout') }}" class="btn btn-primary w-100">Go To Checkout</a>
</div>
@endif