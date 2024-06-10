<!DOCTYPE html>
<html>
<head>
    <title>Order Confirmation</title>
</head>
<body>
    <h1>Order Confirmation</h1>
    <p>Thank you for your purchase!</p>
    <p>Order details:</p>
    <ul>
        @foreach ($order->products as $product)
            <li>{{ $product->title }} - {{ $product->pivot->quantity }}</li>
        @endforeach
    </ul>
</body>
</html>
