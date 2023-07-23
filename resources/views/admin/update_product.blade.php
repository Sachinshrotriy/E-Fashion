<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->

  <base href="/public">

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

          <h1 class="font_size">Edit Product</h1>

          <form action="{{url('/update_product_confirm',$product->id)}}" method="POST" enctype="multipart/form-data">

          @csrf

          <div class="div_design">

            <label>Product Title :</label>
            <input type="text" class="text_color" name="title" placeholder="Write a Title" required="" value="{{$product->title}}">

          </div>

          <div class="div_design">

            <label>Product Description :</label>
            <input type="text" class="text_color" name="description" placeholder="Write a Description" required="" value="{{$product->description}}">

          </div>

          <div class="div_design">

            <label>Product Price :</label>
            <input type="number" class="text_color" name="price" placeholder="Write Price of Product" required="" value="{{$product->price}}">

          </div>

          <div class="div_design">

            <label>Discounted Price :</label>
            <input type="number" class="text_color" name="dis_price" placeholder="Write Discounted Price" value="{{$product->discount_price}}">

          </div>

          <div class="div_design">

            <label>Product Quantity :</label>
            <input type="number" min="0" class="text_color" name="quantity" placeholder="Quantity of Product" required="" value="{{$product->quantity}}">

          </div>

          <div class="div_design">

            <label>Product Category :</label>
            <select class="text_color" name="category" required="">
            <option  value="{{$product->category}}" selected="">{{$product->category}}</option>

            @foreach($category as $category)

            <option value="{{ $category->category_name }}">{{ $category->category_name }}</option>
            
            @endforeach
            
        
          </select>

          </div>

          <div class="div_design">

            <label>Current Product Image :</label>
            <img height="100" width="100" style="margin:auto" src="/product/{{$product->image}}">

          </div>

          <div class="div_design">

            <label>Change Product Image Here :</label>
            <input type="file" name="image">

          </div>

          <div class="div_design">

            <input type="submit" value="update Product" class="btn btn-primary">

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