@component('mail::message')

# Thank you for your order!

**Order ID:** {{ $order->id }}  
**Placed on:** {{ $order->created_at->format('Y-m-d H:i') }}

## Items:
@foreach ($order->orderItems as $item)
<table style="width: 100%; margin-bottom: 10px;">
    <tr>
        <td style="width: 60px;">
            <img src="{{ url($item->book->cover_image) }}" alt="{{ $item->book->title }}" width="50" style="border-radius: 4px;">
        </td>
        <td style="padding-left: 10px;">
            <strong>{{ $item->book->title }}</strong><br>
            Quantity: {{ $item->quantity }}<br>
            RM{{ number_format($item->price * $item->quantity, 2) }}
        </td>
    </tr>
</table>
@endforeach

**Shipping:** RM10  
**Total:** **RM{{ number_format($order->total_price, 2) }}**

We'll notify you once your order is on the way!

Thanks,  
BooksLoaf Team  
@endcomponent

