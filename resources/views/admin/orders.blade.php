<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    @include('admin.css')

    <style type="text/css">
        .title_deg {
            text-align: center;
            font-size: 25px;
            font-weight: bold;
            padding-bottom: 30px;
        }

        .table_deg {
            border: 2px solid skyblue;
            width: 100%;
            margin: auto;
            text-align: center;
        }

        .th_deg {
            background-color: skyblue;
            color: black;
        }

        .img_size {
            width: 100px;
            height: 100px;
        }

        td,
        th {
            border: 1px solid skyblue;
        }

        .table-container {
            overflow-x: auto;
            padding-bottom: 20px;
            max-width: 100%;
            /* Add some bottom padding to avoid overlapping the scroll bar with other elements */
        }

        .table_deg {
            min-width: 100%;
            /* Adjust this value if needed */
        }
    </style>

</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        @include('admin.sidebar')
        <!-- partial -->

        <!-- partial:partials/_navbar.html -->
        @include('admin.nevbar')

        <div class="main-panel">
            <div class="content-wrapper">

                <h1 class="title_deg">All Orders</h1>

                <div class="table-container">
                    <table class="table_deg">

                        <tr class="th_deg">

                            <th style="padding: 10px;">Name</th>
                            <th style="padding: 10px;">Email</th>
                            <th style="padding: 10px;">Address</th>
                            <th style="padding: 10px;">Phone</th>
                            <th style="padding: 10px;">Product_title</th>
                            <th style="padding: 10px;">Quantity</th>
                            <th style="padding: 10px;">Price</th>
                            <th style="padding: 10px;">Payment Status</th>
                            <th style="padding: 10px;">Delivery Status</th>
                            <th style="padding: 10px;">Image</th>
                            <th style="padding: 10px;">Delivered</th>
                            <th style="padding: 10px;">Print Pdf</th>
                        </tr>

                        @foreach($order as $order)

                        <tr>
                            <td>{{$order->name}}</td>
                            <td>{{$order->email}}</td>
                            <td>{{$order->address}}</td>
                            <td>{{$order->phone}}</td>
                            <td>{{$order->product_title}}</td>
                            <td>{{$order->quantity}}</td>
                            <td>{{$order->price}}</td>
                            <td>{{$order->payment_status}}</td>
                            <td>{{$order->delivery_status}}</td>
                            <td>
                                <img class="img_size" src="/product/{{$order->image}}">
                            </td>

                            <td>

                                @if($order->delivery_status=='Processing')

                                <a href="{{url('delivered',$order->id)}}" onclick="return confirm('Are u sure to deliver this order')" class="btn btn-primary">Delivered</a>

                                @else

                                <button class="btn btn-success no-click" disabled>Delivered</button>


                                @endif

                            </td>

                            <td>
                                <a href="{{url('print_pdf',$order->id)}}" class="btn btn-secondary">Print PDF</a>
                            </td>

                        </tr>

                        @endforeach

                    </table>

                </div>
            </div>
        </div>


    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
</body>

</html>