<!DOCTYPE html>
<html>
   <head>
      <!-- Basic -->
       <!-- Basic -->
   <meta charset="utf-8" />
   <meta http-equiv="X-UA-Compatible" content="IE=edge" />
   <!-- Mobile Metas -->
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
   <!-- Site Metas -->
   <meta name="keywords" content="" />
   <meta name="description" content="" />
   <meta name="author" content="" />
   <link rel="shortcut icon" href="images/favicon.png" type="">
   <title>E-Fashion</title>
   <!-- bootstrap core css -->
   <link rel="stylesheet" type="text/css" href="{{asset('home/css/bootstrap.css')}}" />
   <!-- font awesome style -->
   <link href="{{asset('home/css/font-awesome.min.css')}}" rel="stylesheet" />
   <!-- Custom styles for this template -->
   <link href="{{asset('home/css/style.css')}}" rel="stylesheet" />
   <!-- responsive style -->
   <link href="{{asset('home/css/responsive.css')}}" rel="stylesheet" />

      <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        .img_deg {
            max-width: 100px;
            max-height: 100px;
        }
        .cnt {
            margin: 20px;
        }
    </style>

   </head>
   <body>
      <div class="hero_area">

         <!-- header section strats -->
         @include('home.header')
         <!-- end header section -->


         <div class="cnt">
        <h1>Your Orders</h1>

        <div>
            <table>
                <tr>
                    <th>Product Title</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Payment Status</th>
                    <th>Delivery Status</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>

                @foreach($order as $order)

                <tr>
                    <td>{{$order->product_title}}</td>
                    <td>{{$order->quantity}}</td>
                    <td>₹ {{$order->price}}</td>
                    <td>{{$order->payment_status}}</td>
                    <td>{{$order->delivery_status}}</td>
                    <td>
                        <img class="img_deg" src="product/{{$order->image}}" alt="Product Image">
                    </td>
                    <td>

                    @if($order->delivery_status=='Processing')

                        <a onclick="return confirm('Are you sure to Cancle this Order !!!')" href="{{url('cancle_order',$order->id)}}" class="btn btn-danger">Cancle Order</a>

                        @else

                        <p style="color: blue;">Not Allowed</p>

                        @endif

                    </td>
                </tr>

                @endforeach

                <!-- Add more rows here if needed -->

            </table>
        </div>
    </div>

      </div>
   

      
      <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
         
            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
         
         </p>
      </div>
      <!-- jQery -->
      <script src="home/js/jquery-3.4.1.min.js"></script>
      <!-- popper js -->
      <script src="home/js/popper.min.js"></script>
      <!-- bootstrap js -->
      <script src="home/js/bootstrap.js"></script>
      <!-- custom js -->
      <script src="home/js/custom.js"></script>
      <script>
    $(document).ready(function() {
        $("#closeAlert").click(function() {
            $("#myAlert").fadeOut();
        });
    });
</script>
   </body>
</html>