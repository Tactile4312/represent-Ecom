<!DOCTYPE html>
<html>
<head>
    <title>New Stock Added</title>
</head>
<body>
    <h1>New Stock Added</h1>
    <p>A new product stock has been added.</p>
    <p>Product Name: {{ $product->title }}</p>
    <p>Product Quantity: {{ $product->stock }}</p>
</body>
</html>
