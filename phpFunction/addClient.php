<?php
if( $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
    $firstName = trim(htmlspecialchars($_POST['first-name']));
    $lastName = trim(htmlspecialchars($_POST['last-name']));
    $email = trim(htmlspecialchars($_POST['email']));
    $phone = trim(htmlspecialchars($_POST['phone']));
    $address = trim(htmlspecialchars($_POST['address']));
    $connection = new mysqli("localhost","root","yassir","gorent");
if($connection->connect_error) {
    die("". $connection->connect_error);
} 
$query = $connection->query("INSERT INTO `clients` (`First_Name`,`Last_Name`,`Phone`,`Email`,`Address`) 
                                    VALUES ('$firstName','$lastName','$phone','$email','$address')");
if($query){
    
    header("Location: /pages/clients.php");
}
else{
    var_dump($query);
}
}
?>