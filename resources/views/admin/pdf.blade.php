<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details Pdf</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            color: #337ab7;
            text-align: center;
        }
        h3 {
            margin-bottom: 10px;
        }
        img {
            display: block;
            margin: 0 auto;
            max-width: 50%;
            height: auto;
            margin-top: 20px;
        }
        .customer-info {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 20px;
        }
        .product-info {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <h1>Order Details PDF</h1>

    <div class="customer-info">
        <h3>Customer Name : {{$order->name}}</h3>
        <h3>Customer Email : {{$order->email}}</h3>
        <h3>Customer Phone : {{$order->phone}}</h3>
        <h3>Customer Address : {{$order->address}}</h3>
        <h3>Customer ID : {{$order->user_id}}</h3>
    </div>

    <div class="product-info">
        <h3>Product Name : {{$order->product_title}}</h3>
        <h3>Product Price : {{$order->price}}</h3>
        <h3>Product Quantity : {{$order->quantity}}</h3>
        <h3>Product Payment Status : {{$order->payment_status}}</h3>
        <h3>Product ID : {{$order->product_id}}</h3>
    </div>

    <img src="product/{{$order->image}}" alt="Product Image">

</body>
</html>
