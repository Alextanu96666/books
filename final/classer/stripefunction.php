
<?php

include_once 'db/db.php';
class StripeClass
{
    private $db;
    public function __construct()
    {
        $this->db = new DB();
        $this->db = $this->db->connect();
    }

    public function stripeFunctions() {
    
        require_once('vendor/stripe/stripe-php/init.php');
\Stripe\Stripe::setApiKey('sk_test_cGwJLBRyZ0QtXxWPYMtNuEf400nInGyjN9'); //YOUR_STRIPE_SECRET_KEY
// Get the token from the JS script
//getting all the info posted from inputs and storing into variables
$token = $_POST['stripeToken'];
$first_name = $_POST['first_name'];
if ($_POST['first_name']) {
    $first_name = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_STRING);
}
$last_name=$_POST['last_name'];
if ($_POST['last_name']) {
    $last_name = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_STRING);
}
$adress=$_POST['adress'];
if ($_POST['adress']) {
    $adress = filter_input(INPUT_POST, 'adress', FILTER_SANITIZE_STRING);
}
$zip_c = $_POST['zip_code'];
if ($_POST['zip_code']) {
    $zip_c = filter_input(INPUT_POST, 'zip_code', FILTER_SANITIZE_STRING);
}
$phone_num=$_POST['phone'];
if ($_POST['phone']) {
    $phone_num = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
}
$email_c= $_POST['email'];
if ($_POST['email']) {
    $email_c = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
}
$State= $_POST['State'];
if ($_POST['State']) {
    $State = filter_input(INPUT_POST, 'State', FILTER_SANITIZE_STRING);
}
$Country=$_POST['country'];
if ($_POST['country']) {
    $Country = filter_input(INPUT_POST, 'country', FILTER_SANITIZE_STRING);
}


// This is a 20.00 charge in SEK.
// Charging a Customer
// Create a Customer with the new variables
$name_first = $first_name;
$name_last = $last_name;
$address = $adress;
$state = $State;
$zip = $zip_c;
$country = $Country;
$phone = $phone_num;
$user_info = [
    'First Name' => $name_first,
    'Last Name' => $name_last,
    'Address' => $address,
    'State' => $state,
    'Zip Code' => $zip,
    'Country' => $country,
    'Phone' => $phone
];
// $customer_id = 'cus_F6Ai4gLolcMAb3';
if (isset($customer_id)) {
    try {
        // Use Stripe's library to make requests...
        $customer = \Stripe\Customer::retrieve($customer_id);
    } catch (\Stripe\Error\Card $e) {
        // Since it's a decline, \Stripe\Error\Card will be caught
        $body = $e->getJsonBody();
        $err  = $body['error'];
    
    //    print('Status is:' . $e->getHttpStatus() . "\n");
    //    print('Type is:' . $err['type'] . "\n");
    //    print('Code is:' . $err['code'] . "\n");
        // param is '' in this case
    //    print('Param is:' . $err['param'] . "\n");
    //    print('Message is:' . $err['message'] . "\n");
    } catch (\Stripe\Error\RateLimit $e) {
        // Too many requests made to the API too quickly
    } catch (\Stripe\Error\InvalidRequest $e) {
        // Invalid parameters were supplied to Stripe's API
    } catch (\Stripe\Error\Authentication $e) {
        // Authentication with Stripe's API failed
        // (maybe you changed API keys recently)
    } catch (\Stripe\Error\ApiConnection $e) {
        // Network communication with Stripe failed
    } catch (\Stripe\Error\Base $e) {
        // Display a very generic error to the user, and maybe send
        // yourself an email
    } catch (Exception $e) {
        // Something else happened, completely unrelated to Stripe
    }
} else {
    try {
        // Use Stripe's library to make requests...
        $customer = \Stripe\Customer::create(array(
            'email' => $email_c,
            'source' => $token,
            'metadata' => $user_info,
        ));
    } catch (\Stripe\Error\Card $e) {
        // Since it's a decline, \Stripe\Error\Card will be caught
        $body = $e->getJsonBody();
        $err  = $body['error'];
    
     //   print('Status is:' . $e->getHttpStatus() . "\n");
     //   print('Type is:' . $err['type'] . "\n");
      //  print('Code is:' . $err['code'] . "\n");
        // param is '' in this case
     //   print('Param is:' . $err['param'] . "\n");
      //  print('Message is:' . $err['message'] . "\n");
    } catch (\Stripe\Error\RateLimit $e) {
        // Too many requests made to the API too quickly
    } catch (\Stripe\Error\InvalidRequest $e) {
        // Invalid parameters were supplied to Stripe's API
    } catch (\Stripe\Error\Authentication $e) {
        // Authentication with Stripe's API failed
        // (maybe you changed API keys recently)
    } catch (\Stripe\Error\ApiConnection $e) {
        // Network communication with Stripe failed
    } catch (\Stripe\Error\Base $e) {
        // Display a very generic error to the user, and maybe send
        // yourself an email
    } catch (Exception $e) {
        // Something else happened, completely unrelated to Stripe
    }
}
if (isset($customer)) {
  //  print_r($customer);
    $charge_customer = true;
    // Save the customer id in your own database!
    // Charge the Customer instead of the card
    try {
        // Use Stripe's library to make requests...
        $charge = \Stripe\Charge::create(array(
            'amount' => 2000,
            'description' => 'Bribes to teacher',
            'currency' => 'sek',
            'customer' => $customer->id,
            'metadata' => $user_info
        ));
    } catch (\Stripe\Error\Card $e) {
        // Since it's a decline, \Stripe\Error\Card will be caught
        $body = $e->getJsonBody();
        $err  = $body['error'];
    
    //    print('Status is:' . $e->getHttpStatus() . "\n");
     //   print('Type is:' . $err['type'] . "\n");
     //   print('Code is:' . $err['code'] . "\n");
        // param is '' in this case
     //   print('Param is:' . $err['param'] . "\n");
     //   print('Message is:' . $err['message'] . "\n");
        $charge_customer = false;
    } catch (\Stripe\Error\RateLimit $e) {
        // Too many requests made to the API too quickly
    } catch (\Stripe\Error\InvalidRequest $e) {
        // Invalid parameters were supplied to Stripe's API
    } catch (\Stripe\Error\Authentication $e) {
        // Authentication with Stripe's API failed
        // (maybe you changed API keys recently)
    } catch (\Stripe\Error\ApiConnection $e) {
        // Network communication with Stripe failed
    } catch (\Stripe\Error\Base $e) {
        // Display a very generic error to the user, and maybe send
        // yourself an email
    } catch (Exception $e) {
        // Something else happened, completely unrelated to Stripe
    }
    if ($charge_customer) {
     //   print_r($charge);
     echo 'Thank You for Your Payment';
    }
}
    
    
        }

}