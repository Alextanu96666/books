<?php
include_once 'classer/apifunctions.php';
include_once 'classer/stripefunction.php';
include_once 'classer/register.php';

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

      


      if (isset($_POST['stripeToken'])) {
          
          $obj = new ApiClass();
          $obj->ApiFunctions($pin);
          $obj2 = new StripeClass();
          $obj2->stripeFunctions();
          $obj3 = new Register();
          $obj3->registration();

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
    <form method="post" enctype="multipart/form-data" action="" id="payment-form"> </br> </br>
    <input type="text" name="first_name" placeholder="first_name"> </br> </br>
    <input type="text" name="last_name" placeholder="last_name"> </br> </br>
    <input type="text" name="adress" placeholder="adress"> </br> </br>
    <input type="text" name="email" placeholder="email"> </br> </br>
    <input type="text" name="zip_code" placeholder="Zip code"> </br> </br>
    <input type="text" name="State" placeholder="Län"> </br> </br>
    <input type="text" name="country" placeholder="Country"> </br> </br>
    <input type="text" name="phone" placeholder="phone number"> </br> </br>
    <input type="file" name="theFile" value="välj fil"> </br> </br>
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