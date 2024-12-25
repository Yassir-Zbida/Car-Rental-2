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
    $database = new Database();
    $connection = $database->connect();

    // Gestion des clients
    $client = new Client($connection);
    $client->deleteClient($id);
}
?>
