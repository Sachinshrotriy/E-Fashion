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

   <style>
    /* Container styles */
    .container1 {
        text-align: center;
        padding-bottom: 30px;
    }

    /* Heading styles */
    h1 {
        font-size: 30px;
        text-align: center;
        padding-top: 20px;
        padding-bottom: 20px;
    }

    /* Form styles */
    form textarea {
        height: 50px;
        width: 300px;
    }

    /* Comment box styles */
    div > b {
        font-weight: bold;
    }

    div > p {
        margin: 0;
    }

    div > a {
        margin-right: 10px;
        text-decoration: none;
        color: blue;
    }

    /* Reply box styles */
    .replyDiv {
        display: none;
    }

    .replyDiv textarea {
        height: 100px;
        width: 300px;
    }

    .replyDiv button,
    .replyDiv a {
        margin-top: 10px;
    }
</style>

</head>

<body>
   <div class="hero_area">

      <!-- header section strats -->
      @include('home.header')
      <!-- end header section -->

      <!-- slider section -->
      @include('home.slider')
      <!-- end slider section -->
   </div>

   <!-- product section -->
   @include('home.products')
   <!-- end product section -->

   <!-- why section -->
   @include('home.why')
   <!-- end why section -->

   <!-- arrival section -->
   @include('home.new_arrival')
   <!-- end arrival section -->

   <!-- Comment and Reply Section Start -->

   <div class="container1">
        <h1>Comments</h1>
        <form action="{{url('add_comment')}}" method="POST">
            @csrf
            <textarea name="comment" placeholder="Comment something here"></textarea>
            <br>
            <input type="submit" class="btn btn-primary" value="Comment">
        </form>
    </div>

    <h1 style="font-size: 20px; padding-bottom: 20px; text-align: center;">All Comments</h1>

    <div style="padding-left: 20%;">
        
        @foreach($comment as $comment)
        <div>
            <b>{{$comment->name}}</b>
            <p>{{$comment->comment}}</p>
            <a href="javascript:void(0);" onclick="reply(this)" data-Commentid="{{$comment->id}}">Reply</a>
            @foreach($reply as $rep)
            @if($rep->comment_id==$comment->id)
            <div style="padding-left: 3%; padding-bottom: 5px;">
                <b>{{$rep->name}}</b>
                <p>{{$rep->reply}}</p>
                <a href="javascript:void(0);" onclick="reply(this)" data-Commentid="{{$comment->id}}">Reply</a>
            </div>
            @endif
            @endforeach
        </div>
        @endforeach
    </div>

    <!-- Reply TextBox -->
    <div class="replyDiv">
        <form action="{{url('add_reply')}}" method="POST">
            @csrf
            <input type="text" id="commentId" name="commentId" hidden>
            <textarea name="reply" placeholder="Write something here"></textarea>
            <br>
            <button type="submit" class="btn btn-warning">Reply</button>
            <a href="javascript:void(0);" class="btn" onclick="reply_close(this)">Close</a>
        </form>
    </div>


   <!-- Comment and Reply Section End -->

   <!-- subscribe section -->
   @include('home.subscribe')
   <!-- end subscribe section -->
   <!-- client section -->
   @include('home.client')
   <!-- end client section -->
   <!-- footer start -->
   @include('home.footer')
   <!-- footer end -->
   <div class="cpy_">
      <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>

         Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>

      </p>
   </div>

   <script type="text/javascript">
      function reply(caller) {
         document.getElementById('commentId').value = $(caller).attr('data-Commentid');

         $('.replyDiv').insertAfter($(caller));

         $('.replyDiv').show();

      }

      function reply_close(caller) {

         $('.replyDiv').hide();

      }
   </script>

<script>
        // JavaScript for showing/hiding the reply textbox
        function reply(element) {
            var commentId = element.getAttribute("data-Commentid");
            document.getElementById("commentId").value = commentId;
            var replyDiv = document.querySelector(".replyDiv");
            replyDiv.style.display = "block";
        }

        function reply_close(element) {
            var replyDiv = document.querySelector(".replyDiv");
            replyDiv.style.display = "none";
        }
    </script>

   <script>
      document.addEventListener("DOMContentLoaded", function(event) {
         var scrollpos = localStorage.getItem('scrollpos');
         if (scrollpos) {
            window.scrollTo(0, scrollpos);
         }
      });

      window.onbeforeunload = function(e) {
         localStorage.setItem('scrollpos', window.scrollY);
      };
   </script>


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