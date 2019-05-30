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
        require_once('fill_book.php');
        $filename = $_FILES['theFile']['name'];
        
        // The nested array to hold all the arrays
        $books = [];
        $books[] = ['ISBN', 'Book title', 'Author_id', 'publisher_id', 'categories', 'pages'];
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