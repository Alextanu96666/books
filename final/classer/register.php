
<?php

include_once 'db/db.php';
class Register
{
    private $db;
    public function __construct()
    {
        $this->db = new DB();
        $this->db = $this->db->connect();
    }

    public function registration() {
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
//inserting all the data from inputs into the database
$stmt = $this->db->prepare('INSERT INTO users (first, last, adress, email, zip, state, country, phone) VALUES (:first, :last, :adress, :email, :zip, :state, :country, :phone)');
$stmt->bindValue(':first', $first_name, PDO::PARAM_STR);
$stmt->bindValue(':last', $last_name, PDO::PARAM_STR);
$stmt->bindValue(':adress', $adress, PDO::PARAM_STR);
$stmt->bindValue(':email', $email_c, PDO::PARAM_STR);
$stmt->bindValue(':zip', $zip_c, PDO::PARAM_STR);
$stmt->bindValue(':state', $State, PDO::PARAM_STR);
$stmt->bindValue(':country', $Country, PDO::PARAM_STR);
$stmt->bindValue(':phone', $phone_num, PDO::PARAM_STR);
$stmt->execute();
    }

}