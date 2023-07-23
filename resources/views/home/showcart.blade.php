<!DOCTYPE html>
<html>

<head>
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
    <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
    <!-- font awesome style -->
    <link href="home/css/font-awesome.min.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="home/css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="home/css/responsive.css" rel="stylesheet" />
    <style type="text/css">
        .center {
            margin: auto;
            width: 60%;
            text-align: center;
            padding: 30px;
        }

        table th,
        td {
            border: 1px solid gray;
        }

        .th_deg {
            font-size: 20px;
            padding: 5px;
            background: gainsboro;
        }

        .img_deg {
            height: 110px;
            width: 110px;
        }

        .total_deg {
            font-size: 20px;
            padding-top: 40px;
        }
    </style>
</head>

<body>
    <div class="hero_area">

        <!-- header section strats -->
        @include('home.header')
        <!-- end header section -->

        <div class="center">

            <table>
                <tr>
                    <th class="th_deg">Product Title</th>
                    <th class="th_deg">Product Quantity</th>
                    <th class="th_deg">Price</th>
                    <th class="th_deg">Image</th>
                    <th class="th_deg">Action</th>
                </tr>

                <?php $totalprice = 0; ?>

                @foreach($cart as $cart)

                <tr>
                    <td>{{$cart->product_title}}</td>
                    <td>{{$cart->quantity}}</td>
                    <td>₹{{$cart->price}}</td>
                    <td><img class="img_deg" src="/product/{{$cart->image}}"></td>
                    <td>

                        <a href="{{url('remove_cart',$cart->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure to remove this Product')">Remove Product</a>

                    </td>
                </tr>

                <?php $totalprice = $totalprice + $cart->price ?>

                @endforeach

            </table>

            <div>
                <h1 class="total_deg">Total Price : ₹{{$totalprice}}</h1>
            </div>

            @if($cart->count() > 0)
            <div>
                <h1 style="font-size: 25px; padding-bottom: 15px;">Proceed To Order</h1>

                <a href="{{url('order_now')}}" class="btn btn-warning">Check Out for COD</a>

                <!-- <a href="{{url('/stripe',$totalprice)}}" class="btn btn-danger">Pay Using Card</a> -->

                <a href="#" class="btn btn-danger" onclick="handlePay()">Pay Using Card</a>


            </div>
            @else
            <div>
                <p>Your cart is empty. Please add some products to proceed to order.</p>
            </div>
            @endif
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

    <script>
        function handlePay() {
            // Check if the feature is currently available (replace this with your actual condition)
            const featureAvailable = false;

            if (featureAvailable) {
                // Redirect to the Stripe payment page
                window.location.href = "{{ url('/stripe', $totalprice) }}";
            } else {
                // Show an error message to the user
                alert("Sorry, this feature is not currently available.");
            }
        }
    </script>



</body>

</html>