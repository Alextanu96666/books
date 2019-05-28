  <pre> 
<?php

$filename = 'isbn.csv';
// The nested array to hold all the arrays
$books = [];
$books[] = ['ISBN', 'Book title', 'Beskrivning'];
// Open the file for reading
if ($file_handle = fopen($filename, 'r')) {
    // Read one line from the csv file, use comma as separator
    while ($data = fgetcsv($file_handle)) {
        $books[] = fill_book($data[0]);
    }
    // Close the file
    fclose($file_handle);
}
// Display the code in a readable format
//var_dump($books);
if ($books) {
    $filename = 'new_books.csv';
    $file_to_write = fopen($filename, 'w');
    $everything_is_awesome = true;
    foreach ($books as $book) {
//        $book = fill_book($book[0]);
        //var_dump($book);
        $everything_is_awesome = $everything_is_awesome && fputcsv($file_to_write, $book);
    }
    fclose($file_to_write);
    if ($everything_is_awesome) {
        echo '<a href="' . $filename . '">Download file</a>';
    } else {
        echo 'Everything is NOT awesome';
    }
}
function fill_book($isbn)
{
  
  $curl = curl_init();
  
  curl_setopt_array($curl, array(
  CURLOPT_URL => "http://apiprojekt.mistert.se/APIcourse/Pages/query_response.php?table=Books&apikey=5cec0d2413d45&ISBN=$isbn",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache"
  ),
  ));
  $response = curl_exec($curl);
  $err = curl_error($curl);
  
  curl_close($curl);
  
  $response = json_decode($response, true); //because of true, it's in an array
 // var_dump($response['results'][0]['Namn']);
  $book = [];
  $book[0] = $isbn;
  $book[1] = $response['results'][0]['Namn'];
  $book[2] = $response['results'][0]['Beskrivning'];
  return $book;
var_dump($book);
}

?>

<html>
<head>
<title>stripe php</title>
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
</head>
<body>
<form action="charge.php" method="post" id="payment-form">
  <div class = "user">
    <input type ="text" name="first_name" placeholder="firstname">
    <input type ="text" name="last_name" placeholder="last">
    <input type ="text" name="adress" placeholder="adress">
  </div>
  <div class="form-row">
    <label for="card-element">Credit or debit card</label>
    <div id="card-element">
      <!-- a Stripe Element will be inserted here. -->
    </div>
    <!-- Used to display form errors -->
    <div id="card-errors"></div>
  </div>
  <button>Submit Payment</button>
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