<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details Pdf</title>
</head>
<body>
    <h1>THIS IS A PDF FILE!!!</h1>

    Customer Name :<h3>{{$order->name}}</h3>
    Customer Email :<h3>{{$order->email}}</h3>
    Customer Phone :<h3>{{$order->phone}}</h3>
    Customer Address :<h3>{{$order->address}}</h3>
    Customer ID :<h3>{{$order->user_id}}</h3>


    product Name :<h3>{{$order->product_title}}</h3>
    product Price :<h3>{{$order->price}}</h3>
    product Quantity :<h3>{{$order->quantity}}</h3>
    product Payment Status :<h3>{{$order->payment_status}}</h3>
    product ID :<h3>{{$order->product_id}}</h3>

    <br><br>
    <img height="250" width="450" src="product/{{$order->image}}">

</body>
</html>