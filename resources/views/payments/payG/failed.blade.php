<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Payment </title>
      <link rel="icon" href="/fav1.png">
      
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="{{asset('/ecollect/assets/bootstrap4/bootstrap.min.css')}}">
      <link rel="stylesheet" href="{{asset('/ecollect/assets/css/style.css')}}">
      <link rel="stylesheet" href="{{asset('/ecollect/assets/css/responsive.css')}}">
      <link rel="stylesheet" href="{{asset('/ecollect/assets/css/slick-theme.min.css')}}">
      <link rel="stylesheet" href="{{asset('/ecollect/assets/css/slick.min.css')}}">
      <link href= "https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
   </head>
   <body style="margin-bottom: 0;">

        <div class="result-section">
            <div class="cont-sec success-cont">
               <img src="{{asset('/ecollect/assets/images/failed.png')}}" class="img-fluid statimg">
               <h4 style="color: #E53651;">Failed!</h4>
               <p>Oh no!!, Your payment has failed.
               </p>
            </div>
         </div>

         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
         <script src="{{asset('/ecollect/assets/js/slick.min.js')}}"></script>
         <script src="{{asset('/ecollect/assets/js/custom.js')}}"></script>
         <script src="{{asset('/ecollect/assets/bootstrap4/jquery.min.js')}}"></script>
         <script src="{{asset('/ecollect/assets/bootstrap4/popper.min.js')}}"></script>
         <script src="{{asset('/ecollect/assets/bootstrap4/bootstrap.min.js')}}"></script>

         <script>
           $(document).ready(function(){
             setTimeout(function(){

               if ("{{$_GET['orderId']}}") {
                 window.location = '/pg/payG/redirect?orderId={{$_GET["orderId"]}}'
               }
               else {
                 window.close()
               }
             },3000)
           })
         </script>

      </body>
   </html>
