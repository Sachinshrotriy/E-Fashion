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
        /* Center the data within the col-sm-8 div */
        .container {
            padding: 20px;
        }

        .checkout-container {
            display: flex;
            justify-content: center;
            align-items: flex-start;
        }

        .checkout-form {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .col-md-6 {
            flex: 0 0 48%;
            max-width: 48%;
        }

        h1,
        h5 {
            text-align: center;
        }

        table {
            width: 100%;
            max-width: 400px;
            margin: auto;
        }

        form textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            resize: none;
        }

        .btn-success {
            margin-top: 10px;
        }

        .alert {
            margin-top: 20px;
        }

        .user-info {
            padding: 20px;
            background-color: #f2f2f2;
            border-radius: 5px;
        }
    </style>
</head>

<body>


    <div class="hero_area">

        <!-- header section strats -->
        @include('home.header')
        <!-- end header section -->


        @if(session('message'))
        <div class="alert alert-success" id="myAlert">
          <button type="button" class="close" id="closeAlert">&times;</button>
          {{ session('message') }}
        </div>
        @endif

        <div class="container checkout-container">
            <div class="checkout-form">
                <div class="col-md-6">
                    <h1>Order Summary</h1>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td>Amount</td>
                                <td>₹ {{$total}}</td>
                            </tr>
                            <tr>
                                <td>Tax</td>
                                <td>₹ 0</td>
                            </tr>
                            <tr>
                                <td>Total Amount</td>
                                <td>₹ {{$total}}</td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- Address Form -->
                    <form action="/orderplace" method="POST">
                        @csrf
                        <div class="form-group">
                            <textarea name="address" placeholder="Enter Your Address" id="address" cols="30" rows="4" required></textarea>
                            <button type="submit" class="btn btn-success">Place Order (COD)</button>
                        </div>
                    </form>
                </div>

                <div class="col-md-6 user-info">
                    <h5>User Information</h5>
                    <p>Name: {{ $user->name }}</p>
                    <p>Email: {{ $user->email }}</p>
                </div>
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