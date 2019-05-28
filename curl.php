
<?php
$test = 1;
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "http://apiprojekt.mistert.se/APIcourse/Pages/query_response.php?table=Books&apikey=5cec0d2413d45",
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
// foreach ($response ['results'][$test] as $value) {
//    var_dump ($value);
 //}
// var_dump($response ['results']); 



?>