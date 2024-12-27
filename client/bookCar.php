<?php
require_once '../db.php';
require_once '../pages/contract.php';


$database = new Database();
$contractManager = new Contract($database->getConnection());


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $carId = $_POST['car_id'];

    $clientId = 1; 
    $startDate = date('Y-m-d'); 
    $endDate = date('Y-m-d', strtotime('+3 days')); 
    $total = 100; 

    $result = $contractManager->addContract($clientId, $carId, $startDate, $endDate, $total);

    if ($result === true) {
        echo "Booking successful!";
    
    } else {
        echo "Error: " . $result;
    }
} else {
    echo "Invalid request.";
}
?>
