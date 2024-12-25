<?php
// Connexion à la base de données
require_once("../db.php");
 
    $db = new Database();
    $connection = $db->getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données du formulaire
    $contractId = $_POST['ContractEdit'];
    $clientId = $_POST['clientIdEdit'];
    $carId = $_POST['carIdEdit'];
    $startDate = $_POST['startDateEdit'];
    $endDate = $_POST['endDateEdit'];
    $totalEdit = $_POST['totalEdit'];

    // Requête préparée pour mettre à jour le contrat
    $updateSql = "UPDATE contracts SET Client_ID = ?, Car_ID = ?, Start_Date = ?, End_Date = ?, Total = ? WHERE ID = ?";

    // Préparer la requête
    if ($stmt = $connection->prepare($updateSql)) {
        // Lier les paramètres
        $stmt->bind_param("iissdi", $clientId, $carId, $startDate, $endDate, $totalEdit, $contractId);

        // Exécuter la requête
        if ($stmt->execute()) {
            echo "Contract updated successfully!";
            header("Location: /pages/contrats.php"); 
            exit;
        } else {
            echo "Error updating contract: " . $stmt->error;
        }

        // Fermer la requête
        $stmt->close();
    } else {
        echo "Error preparing query: " . $connection->error;
    }
}

// Fermer la connexion
$connection->close();
?>
