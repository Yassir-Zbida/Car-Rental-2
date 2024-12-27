<?php
require_once("../db.php");
require_once("../pages/contract.php");

// Gestion du formulaire pour l'ajout de contrat
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $clientId = trim(htmlspecialchars($_POST['clientId']));
    $carId = trim(htmlspecialchars($_POST['carId']));
    $startDate = trim(htmlspecialchars($_POST['startDate']));
    $endDate = trim(htmlspecialchars($_POST['endDate']));
    $total = trim(htmlspecialchars($_POST['total']));

    $database = new Database();
    $connection = $database->getConnection();


    $contract = new Contract($connection);
    $result = $contract->addContract($clientId, $carId, $startDate, $endDate, $total);

    if ($result === true) {
        header("Location: ../pages/contrats.php");
        exit();
    } else {
        echo "Erreur : " . $result;
    }
}

$database = new Database();
$connection = $database->getConnection();
$contract = new Contract($connection);
$clients = $contract->getClients();
$cars = $contract->getCars();
?>
