<!DOCTYPE html>
<html>

<head>
    <title>Receipt #{{ $order->id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        .logo {
            max-width: 160px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .company-info {
            text-align: right;
            font-size: 14px;
        }

        .details {
            margin-top: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }

        th,
        td {
            padding: 8px 12px;
            border-bottom: 1px solid #ccc;
        }

        .total {
            text-align: right;
            margin-top: 20px;
            font-size: 18px;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 14px;
            color: #777;
        }

        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body>

    <div class="header">
        <img src="{{ asset('logo.png') }}" class="logo" alt="Booksloaf Logo">
        <div class="company-info">
            <strong>BooksLoaf</strong><br>
            UTM SPACE JOHOR<br>
            Aras 4 dan 5, Blok T05, Skudai,<br>
            81310 Johor Bahru, Johor Darul Ta'zim<br>
            +60 11 2161 6451<br>
            booksloaf@gmail.com
        </div>
    </div>

    <div class="details" style="margin-top: 30px; margin-bottom: 10px; line-height: 0.5;">
        <p><strong>Order #{{ $order->id }}</strong></p>
        <p>{{ $order->name }}</p>
        <p>{{ $order->email }}</p>
        <p>{{ $order->phone }}</p>
        <p>{{ $order->created_at->format('Y-m-d H:i') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Book</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->orderItems as $item)
            <tr>
                <td>{{ $item->book->title }}</td>
                <td>{{ $item->quantity }}</td>
                <td>RM{{ number_format($item->price, 2) }}</td>
                <td>RM{{ number_format($item->quantity * $item->price, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total">
        <strong>Total: RM{{ number_format($order->total_price, 2) }}</strong>
    </div>

    <div class="footer">
        <p>Thank you for your purchase!</p>
    </div>

</body>

<script>
    window.addEventListener('load', function() {
        window.print();
    });

    window.addEventListener('afterprint', function() {
        window.close();
    });
</script>


</html>