<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  @include('admin.css')

  <style type="text/css">
    .div_center {
      text-align: center;
      padding-top: 40px;
    }

    .font_size {
      font-size: 30px;
      padding-bottom: 40px;
    }

    .text_color {
      color: black;
      padding-bottom: 20px;
    }

    label {
      display: inline-block;
      width: 200px;
    }

    .div_design {
      padding-bottom: 15px;
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
    <!-- partial -->
    <div class="main-panel">
      <div class="content-wrapper">

        @if(session('message'))
        <div class="alert alert-success" id="myAlert">
          <button type="button" class="close" id="closeAlert">&times;</button>
          {{ session('message') }}
        </div>
        @endif

        <div class="div_center">

          <h1 class="font_size">Add Product</h1>

          <form action="{{url('/add_product')}}" method="POST" enctype="multipart/form-data">

            @csrf

            <div class="div_design">

              <label>Product Title :</label>
              <input type="text" class="text_color" name="title" placeholder="Write a Title" required="">

            </div>

            <div class="div_design">

              <label>Product Description :</label>
              <input type="text" class="text_color" name="description" placeholder="Write a Description" required="">

            </div>

            <div class="div_design">

              <label>Product Price :</label>
              <input type="number" class="text_color" name="price" placeholder="Write Price of Product" required="">

            </div>

            <div class="div_design">

              <label>Discounted Price :</label>
              <input type="number" class="text_color" name="dis_price" placeholder="Write Discounted Price">

            </div>

            <div class="div_design">

              <label>Product Quantity :</label>
              <input type="number" min="0" class="text_color" name="quantity" placeholder="Quantity of Product" required="">

            </div>

            <div class="div_design">

              <label>Product Category :</label>
              <select class="text_color" name="category" required="">
                <option value="" selected="">Select a Category Here</option>

                @foreach($category as $category)

                <option value="{{ $category->category_name }}">{{ $category->category_name }}</option>

                @endforeach

              </select>

            </div>

            <div class="div_design">

              <label>Product Image Here :</label>
              <input type="file" name="image" required="">

            </div>

            <div class="div_design">

              <input type="submit" value="Add Product" class="btn btn-primary">

            </div>

          </form>


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