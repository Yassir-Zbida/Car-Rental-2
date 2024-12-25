<?php
require_once("../db.php");
 
    

class Car {
    private $connection;

    public function __construct($dbConnection) {
        $this->connection = $dbConnection;
    }

    public function deleteCar($id) {
        $stmt = $this->connection->prepare("DELETE FROM cars WHERE ID = ?");
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            header("Location: /pages/cars.php");
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

    // Gestion des voitures
    $car = new Car($connection);
    $car->deleteCar($id);
}
?>
