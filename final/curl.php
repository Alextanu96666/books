
<?php
$test = 1;
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://5ce8007d9f2c390014dba45e.mockapi.io/books/9789137152615",
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
var_dump($response);
// foreach ($response ['results'][$test] as $value) {
//    var_dump ($value);
 //}
// var_dump($response ['results']); 



?>