<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>BooksLoaf - Payment</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .container {
            display: flex;
            padding: 30px;
            gap: 40px;
        }

        .left-panel, .right-panel {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }

        .left-panel {
            flex: 2;
        }

        .right-panel {
            flex: 1;
        }

        .step-indicator {
            display: flex;
            gap: 10px;
            margin-bottom: 25px;
        }

        .step-indicator span {
            font-weight: bold;
        }

        input[type="text"], input[type="email"], input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .btn {
    padding: 10px 20px;
    background-color: #a75f09;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    width: auto;
    min-width: 120px;
}


        .order-summary img {
            width: 80px;
            height: auto;
            margin-bottom: 10px;
        }

        .summary-item {
            margin: 10px 0;
        }

        .total {
            font-weight: bold;
            font-size: 18px;
        }

        .apply-code {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }

        .apply-code input {
            flex: 2;
        }

        .apply-code button {
            flex: 1;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="left-panel">
        <div class="step-indicator">
            <span>Account</span> → 
            <span>Shipping</span> → 
            <span><strong>Payment</strong></span>
        </div>

        <h2>Payment Details</h2>

        <form>
            <label>Name on Card</label>
            <input type="text" placeholder="John Doe">

            <label>Card Number</label>
            <input type="text" placeholder="XXXX XXXX XXXX XXXX">

            <label>Expiry Date</label>
            <input type="text" placeholder="MM/YY">

            <label>CVV</label>
            <input type="text" placeholder="123">

            <button class="btn">Confirm Payment</button>
        </form>

        <br>
        <button class="btn" style="background-color: #aaa;">Cancel Order</button>
    </div>

    <div class="right-panel order-summary">
        <img src="{{ asset('images/five-survive.jpg') }}" alt="Five Survive Cover">
        <div><strong>Five Survive</strong></div>
        <div>RM 59.00</div>

        <div class="apply-code">
            <input type="text" placeholder="Gift Card / Discount Code">
            <button class="btn" style="padding: 10px;">Apply</button>
        </div>

        <hr>
        <div class="summary-item">Sub total: RM 59.00</div>
        <div class="summary-item">Tax: 8%</div>
        <div class="summary-item">Shipping: <span style="color: green;">RM 10.00</span></div>
        <div class="total">Total: RM 73.72</div>
    </div>
</div>
</body>
</html>
