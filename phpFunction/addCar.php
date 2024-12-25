<?php
class Database {
    private $host = "localhost";
    private $username = "root";
    private $password = "safaa";
    private $dbName = "gorent";
    private $connection;

    public function connect() {
        $this->connection = new mysqli($this->host, $this->username, $this->password, $this->dbName);
        if ($this->connection->connect_error) {
            die("Erreur de connexion : " . $this->connection->connect_error);
        }
        return $this->connection;
    }
}

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

