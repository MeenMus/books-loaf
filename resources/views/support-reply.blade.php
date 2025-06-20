<!DOCTYPE html>
<html>

@include('layouts.header')

<body>

    @include('layouts.navbar')

    <div class="shopify-grid padding-medium">
        <div class="container">
            <div class="row flex-row-reverse">
                <main class="col-lg-9 d-flex flex-column">
                    <div class="mb-5">

                        <h3 class="mb-4">Support Ticket #{{ $ticket->id }} — {{ $ticket->subject }}</h3>

                        @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <div class="card mb-4">
                            <div class="card-body">
                                @foreach ($ticket->replies as $reply)
                                <div class="mb-3 p-3 border rounded bg-light">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <strong>{{ $reply->user_id ? $reply->user->name : 'Admin' }}</strong>
                                        <small>{{ $reply->created_at->format('Y-m-d H:i') }}</small>
                                    </div>
                                    <hr>
                                    <p class="mt-2 mb-0">{!! nl2br(e($reply->message)) !!}</p>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <form method="POST" action="{{ route('support-reply-submit', $ticket->id) }}">
                            @csrf
                            <div class="mb-3">
                                <label for="message" class="form-label fw-semibold">Your Reply</label>
                                <textarea name="message" class="form-control" rows="5" required></textarea>
                            </div>
                            <button class="btn btn-primary float-end" @if($ticket->status === 'closed') disabled title="This ticket is closed and cannot be replied to." @endif>
                                Send Reply
                            </button>
                        </form>
                    </div>
                </main>

                <aside class="col-md-3">
                    <div class="widget-product-categories">
                        <div class="section-title overflow-hidden mb-0">
                            <h3 class="d-flex flex-column mb-0">My Account</h3>
                        </div>
                        <br>
                        <div>
                            <ul class="product-categories mb-0 sidebar-list list-unstyled">
                                <li class="cat-item mb-2">
                                    <a href="{{url('profile')}}">Profile Details</a>
                                </li>
                                <li class="cat-item mb-2">
                                    <a href="{{url('orders')}}">Orders</a>
                                </li>
                                <li class="cat-item">
                                    <a href="{{url('support')}}">Support Tickets</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </aside>


            </div>
        </div>
    </div>


    @include('layouts.footer')

</body>

</html>