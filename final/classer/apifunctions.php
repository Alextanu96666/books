<?php
include_once 'db/db.php';
class ApiClass
{
    private $db;
    public function __construct()
    {
        $this->db = new DB();
        $this->db = $this->db->connect();
    }
    public function ApiFunctions($pin) {
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
        if ($books) {
            $filename = $pin . '.csv';
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
}

}