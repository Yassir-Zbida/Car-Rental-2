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
    $connection = $database->connect();

    // Gestion des clients
    $client = new Client($connection);
    $client->addClient($firstName, $lastName, $email, $phone, $address);
}
?>
