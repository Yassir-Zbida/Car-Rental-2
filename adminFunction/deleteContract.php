<?php
require_once("../db.php");
require_once("../pages/contract.php");

if (isset($_GET['id'])) {
    $contractId = $_GET['id'];

    // Connexion à la base de données
    $database = new Database();
    $connection = $database->getConnection();

    // Suppression du contrat
    $contract = new Contract($connection);
    $result = $contract->deleteContract($contractId);

    if ($result === true) {
        header("Location: ../pages/contrats.php");
        exit();
    } else {
        echo "Erreur : " . $result;
    }
}
?>
