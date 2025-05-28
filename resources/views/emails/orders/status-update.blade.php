@component('mail::message')

# Order Status Update

Hello **{{ $order->name }}**,

Your order (ID: **#{{ $order->id }}**) has been updated.  
**New status:** _{{ ucfirst($order->status) }}_

---

@switch($status)
@case('pending')
We’ve received your order and it’s being processed. You’ll be notified once it ships.
@break

@case('completed')
Your order has been completed successfully. Thank you for shopping with us!
@break

@case('cancelled')
Unfortunately, your order has been cancelled. If this was a mistake, feel free to contact support.
@break

@case('shipped')
Your order is on its way!  
@if ($order->tracking_id)
**Tracking ID:** {{ $order->tracking_id }}<br>
@endif
You can expect delivery soon. 
@break
@endswitch

---

## Order Summary:

@foreach ($order->orderItems as $item)
<table width="100%" style="margin-bottom: 20px;">
  <tr>
    <td width="80" style="padding-right: 10px;">
      <img src="{{ url($item->book->cover_image) }}" alt="{{ $item->book->title }}" width="70" style="border-radius: 6px;">
    </td>
    <td>
      <strong>{{ $item->book->title }}</strong><br>
      Quantity: {{ $item->quantity }}<br>
      Price: RM{{ number_format($item->price * $item->quantity, 2) }}
    </td>
  </tr>
</table>
@endforeach

**Shipping:** RM10  
**Total:** **RM{{ number_format($order->total_price, 2) }}**

---

@component('mail::button', ['url' => route('orders')])
View My Orders
@endcomponent

Thanks,  
**BooksLoaf Team**

@endcomponent
