<?php
function fill_book($isbn)
{
    
    $curl = curl_init();
    
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://5ce8007d9f2c390014dba45e.mockapi.io/books/$isbn",
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
    $book[1] = $response['title'];
    $book[2] = $response['author_id'];
    $book[3] = $response['publisher_id'];
    $book[4] = $response['categories'][0];
    $book[5] = $response['pages'];
    
    return $book;
    var_dump($book);
}

?>