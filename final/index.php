<?php
include_once 'classer/apifunctions.php';
if (isset($_FILES, $_POST['payment'] )) {
    function generatePIN($digits = 4){
        $i = 0; //counter
        $pin = ""; //our default pin is blank.
        while($i < $digits){
            //generate a random number between 0 and 9.
            $pin .= mt_rand(0, 9);
            $i++;
        }
        return $pin;
      }
      $pin = generatePIN();
    $obj = new ApiClass();
    $obj->ApiFunctions($pin);

    $obj->stripeFunctions();
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
<style>
.StripeElement {
    background-color: white;
    padding: 8px 12px;
    border-radius: 4px;
    border: 1px solid transparent;
    box-shadow: 0 1px 3px 0 #e6ebf1;
    -webkit-transition: box-shadow 150ms ease;
    transition: box-shadow 150ms ease;
}
.StripeElement--focus {
    box-shadow: 0 1px 3px 0 #cfd7df;
}
.StripeElement--invalid {
    border-color: #fa755a;
}
.StripeElement--webkit-autofill {
    background-color: #fefde5 !important;
}
</style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form method="post" enctype="multipart/form-data" action="">
    <div class = "user">
    <input type ="text" name="first_name" placeholder="firstname"> </br> </br>
    <input type ="text" name="last_name" placeholder="last"> </br> </br>
    <input type ="text" name="adress" placeholder="adress"> </br> </br>
    <input type="file" name="theFile" value="Välj fil"> </br> </br>
    <input type="submit" value="send" name="submit">
  </div>
  <div class="form-row">
    <label for="card-element">Credit or debit card</label>
    <div id="card-element">
      <!-- a Stripe Element will be inserted here. -->
    </div>
    <!-- Used to display form errors -->
    <div id="card-errors"></div>
  </div>
  <input type="submit" name="payment" value="Payment">
</form>

    <!-- The needed JS files -->
<!-- JQUERY File -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- Stripe JS -->
<script src="https://js.stripe.com/v3/"></script>

<!-- Your JS File -->
<script src="charge.js"></script>
</body>
</html>