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

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $clientId = trim(htmlspecialchars($_POST['clientId']));
    $carId = trim(htmlspecialchars($_POST['carId']));
    $startDate = trim(htmlspecialchars($_POST['startDate']));
    $endDate = trim(htmlspecialchars($_POST['endDate']));
    $total = trim(htmlspecialchars($_POST['total']));

    // Connexion à la base de données
    $database = new Database();
    $connection = $database->connect();

    // Gestion des contrats
    $contract = new Contract($connection);
    $contract->addContract($clientId, $carId, $startDate, $endDate, $total);
}
?>
