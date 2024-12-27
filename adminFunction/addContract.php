<?php
require_once("../db.php"); // Inclure la classe Database

// Classe pour gérer les contrats
class Contract {
    private $connection;

    public function __construct($dbConnection) {
        $this->connection = $dbConnection;
    }

    public function addContract($clientId, $carId, $startDate, $endDate, $total) {
        $stmt = $this->connection->prepare("INSERT INTO contracts (Client_ID, Car_ID, Start_Date, End_Date, Total) 
                                            VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("iissi", $clientId, $carId, $startDate, $endDate, $total);

        if ($stmt->execute()) {
            header("Location: ../pages/contrats.php");
            exit();
        } else {
            echo "Erreur : " . $stmt->error;
        }
        $stmt->close();
    }
}

// Gestion du formulaire
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $clientId = trim(htmlspecialchars($_POST['clientId']));
    $carId = trim(htmlspecialchars($_POST['carId']));
    $startDate = trim(htmlspecialchars($_POST['startDate']));
    $endDate = trim(htmlspecialchars($_POST['endDate']));
    $total = trim(htmlspecialchars($_POST['total']));

    // Connexion à la base de données
    $database = new Database();
    $connection = $database->getConnection();

    // Ajout du contrat
    $contract = new Contract($connection);
    $contract->addContract($clientId, $carId, $startDate, $endDate, $total);
}

// Récupération des clients pour la liste déroulante
function getClients($connection) {
    $stmt = $connection->prepare("SELECT id, First_Name, Last_Name FROM clients");
    $stmt->execute();
    $result = $stmt->get_result();

    $clients = [];
    while ($row = $result->fetch_assoc()) {
        $clients[] = $row;
    }

    $stmt->close();
    return $clients;
}

// Récupération des voitures pour la liste déroulante
function getCars($connection) {
    $stmt = $connection->prepare("SELECT id, Model FROM cars");
    $stmt->execute();
    $result = $stmt->get_result();

    $cars = [];
    while ($row = $result->fetch_assoc()) {
        $cars[] = $row;
    }

    $stmt->close();
    return $cars;
}

// Connexion à la base de données
$database = new Database();
$connection = $database->getConnection();
$clients = getClients($connection);
$cars = getCars($connection);
?>
