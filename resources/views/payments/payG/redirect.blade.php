<!DOCTYPE html>
<html>
    <head>
      <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
      <meta content="utf-8" http-equiv="encoding">
      <title>Redirecting...</title>
      <meta name="csrf-token" content="{{ csrf_token()}}">
      <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@600;900&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
      <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@600;700&display=swap" rel="stylesheet">

    </head>
<body>
  <h4><strong>Please wait while we process your request.</strong> </h4>
  <h4>Do not hit back button untill the transaction is completed.</h4>

    <div class="formDiv d-none" style="display:none">
      <form class="" action="{{$returnUrl}}" method="post">
        <?php foreach ($returnData as $key => $value): ?>
          <input type="text" name="{{$key}}" value="{{$value}}">
        <?php endforeach; ?>

        <div class="">
          <button type="submit">Submit</button>
        </div>
      </form>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script>
    $('form').submit();
  </script>

  <body>
</html>
