<?php
$connection = new mysqli("localhost", "root", "yassir", "gorent");
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $contractId = $_POST['ContractEdit'];
    $clientid = $_POST['clientIdEdit'];
    $carId= $_POST['carIdEdit'];
    $startDate = $_POST['startDateEdit'];
    $endDate = $_POST['endDateEdit'];
    $totalEdit = $_POST['totalEdit'];
    

    $updateSql = "update contracts set Client_ID='$clientid', Car_ID='$carId', Start_Date='$startDate' ,Total='$totalEdit' where ID = $contractId";

    if ($connection->query($updateSql) === TRUE) {
        echo "Client updated successfully!";
        header("Location: /pages/contrats.php"); 
        exit;
    } else {
        echo "Error updating client: " . $connection->error;
    }

   

}