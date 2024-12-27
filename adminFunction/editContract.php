<?php
require_once("../db.php"); 
require_once("../pages/contract.php");


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $contractId = trim(htmlspecialchars($_POST['ContractEdit']));
    $clientId = trim(htmlspecialchars($_POST['clientIdEdit']));
    $carId = trim(htmlspecialchars($_POST['carIdEdit']));
    $startDate = trim(htmlspecialchars($_POST['startDateEdit']));
    $endDate = trim(htmlspecialchars($_POST['endDateEdit']));
    $total = trim(htmlspecialchars($_POST['totalEdit']));


    if (empty($contractId) || empty($clientId) || empty($carId) || empty($startDate) || empty($endDate) || !is_numeric($total)) {
        die("Veuillez remplir tous les champs correctement.");
    }

    $database = new Database();
    $connection = $database->getConnection();

    $contract = new Contract($connection);
    $result = $contract->updateContract($contractId, $clientId, $carId, $startDate, $endDate, $total);

    if ($result === true) {
        header("Location: ../pages/contrats.php");
        exit();
    } else {
        echo "Erreur lors de la mise à jour : " . $result;
    }
}
?>
