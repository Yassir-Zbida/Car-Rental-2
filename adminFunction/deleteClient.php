<?php
require_once("../db.php");
 
    
class Client {
    private $connection;

    public function __construct($dbConnection) {
        $this->connection = $dbConnection;
    }

    public function deleteClient($id) {
        $stmt = $this->connection->prepare("DELETE FROM clients WHERE id = ?");
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            header("Location: /pages/clients.php");
            exit();
        } else {
            echo "Erreur : " . $stmt->error;
        }
        $stmt->close();
    }
}

if (isset($_GET["id"])) {
    $id = intval($_GET["id"]);

    // Connexion à la base de données
    $db = new Database();
    $connection = $db->getConnection();


    // Gestion des clients
    $client = new Client($connection);
    $client->deleteClient($id);
}
?>
