<?php

require_once("../db.php");
 
$db = new Database();
$connection = $db->getConnection();
 
class Car {
    private $connection;

    public function __construct($dbConnection) {
        $this->connection = $dbConnection;
    }

    public function addCar($carNumber, $brandName, $model, $priceDay, $year) {
        $stmt = $this->connection->prepare("INSERT INTO `cars` (`ID`, `Brand`, `Model`, `Price/Day`, `Year`) 
                                            VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssis", $carNumber, $brandName, $model, $priceDay, $year);
        if ($stmt->execute()) {
            header("Location: /pages/cars.php");
            exit();
        } else {
            echo "Erreur : " . $stmt->error;
        }
        $stmt->close();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $carNumber = trim(htmlspecialchars($_POST['carNumber']));
    $brandName = trim(htmlspecialchars($_POST['brandName']));
    $model = trim(htmlspecialchars($_POST['model']));
    $priceDay = trim(htmlspecialchars($_POST['priceDay']));
    $year = trim(htmlspecialchars($_POST['year']));

    // Connexion à la base de données
    $db = new Database();
    $connection = $db->getConnection();

    // Gestion des voitures
    $car = new Car($connection);
    $car->addCar($carNumber, $brandName, $model, $priceDay, $year);
}
?>
class Car {
    private $connection;

    public function __construct($dbConnection) {
        $this->connection = $dbConnection;
    }

    public function addCar($carNumber, $brandName, $model, $priceDay, $year) {
        $stmt = $this->connection->prepare("INSERT INTO `cars` (`ID`, `Brand`, `Model`, `Price/Day`, `Year`) 
                                            VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssis", $carNumber, $brandName, $model, $priceDay, $year);
        if ($stmt->execute()) {
            header("Location: /pages/cars.php");
            exit();
        } else {
            echo "Erreur : " . $stmt->error;
        }
        $stmt->close();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $carNumber = trim(htmlspecialchars($_POST['carNumber']));
    $brandName = trim(htmlspecialchars($_POST['brandName']));
    $model = trim(htmlspecialchars($_POST['model']));
    $priceDay = trim(htmlspecialchars($_POST['priceDay']));
    $year = trim(htmlspecialchars($_POST['year']));

    // Connexion à la base de données
    $database = new Database();
    $connection = $database->connect();

    // Gestion des voitures
    $car = new Car($connection);
    $car->addCar($carNumber, $brandName, $model, $priceDay, $year);
}
?>

