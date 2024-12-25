<?php

require_once("../db.php");


class Client {
    private $connection;

    public function __construct($dbConnection) {
        $this->connection = $dbConnection;
    }

    public function addClient($firstName, $lastName, $email, $phone, $address) {
        $stmt = $this->connection->prepare("INSERT INTO `clients` (`First_Name`, `Last_Name`, `Phone`, `Email`, `Address`) 
                                            VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $firstName, $lastName, $phone, $email, $address);
        if ($stmt->execute()) {
            header("Location: /pages/clients.php");
            exit();
        } else {
            echo "Erreur : " . $stmt->error;
        }
        $stmt->close();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $firstName = trim(htmlspecialchars($_POST['first-name']));
    $lastName = trim(htmlspecialchars($_POST['last-name']));
    $email = trim(htmlspecialchars($_POST['email']));
    $phone = trim(htmlspecialchars($_POST['phone']));
    $address = trim(htmlspecialchars($_POST['address']));

    // Connexion à la base de données
    $database = new Database();
    $connection = $database->getConnection();

    // Gestion des clients
    $client = new Client($connection);
    $client->addClient($firstName, $lastName, $email, $phone, $address);
}
?>
