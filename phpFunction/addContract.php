<?php

if( $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
    $clientId = trim(htmlspecialchars($_POST['clientId']));
    $carId = trim(htmlspecialchars($_POST['carId']));
    $startDate = trim(htmlspecialchars($_POST['startDate']));
    $endDate = trim(htmlspecialchars($_POST['endDate']));
    $total = trim(htmlspecialchars($_POST['total']));
  
    $connection = new mysqli("localhost","root","yassir","gorent");
    if($connection->connect_error) {
        die("". $connection->connect_error);
    } 

$query =  $connection->query("INSERT INTO contracts (Client_ID, Car_ID, Start_Date, End_Date, Total) 
                                VALUES ('$clientId', '$carId', '$startDate', '$endDate', '$total')");
    header("Location: ../pages/contrats.php");

}
?>