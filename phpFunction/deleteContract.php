<?php
require_once("../db.php");
 
    

class Contract {
    private $connection;

    public function __construct($dbConnection) {
        $this->connection = $dbConnection;
    }

    public function deleteContract($id) {
        $stmt = $this->connection->prepare("DELETE FROM contracts WHERE ID = ?");
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            header("Location: /pages/contrats.php");
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

    // Gestion des contrats
    $contract = new Contract($connection);
    $contract->deleteContract($id);
}
?>
