<?php
if( $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
    $carNumber = trim(htmlspecialchars($_POST['carNumber']));
    $brandName = trim(htmlspecialchars($_POST['brandName']));
    $model = trim(htmlspecialchars($_POST['model']));
    $priceDay = trim(htmlspecialchars($_POST['priceDay']));
    $year = trim(htmlspecialchars($_POST['year']));
    $connection = new mysqli("localhost","root","yassir","gorent");
if($connection->connect_error) {
    die("". $connection->connect_error);
} 
$query = $connection->query("INSERT INTO `cars` (`ID`, `Brand`, `Model`, `Price/Day`, `Year`) 
                             VALUES ('$carNumber', '$brandName', '$model', '$priceDay', '$year')");
if($query){
    header("Location: /pages/cars.php");
}

}
?>
