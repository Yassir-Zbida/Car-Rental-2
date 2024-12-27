<?php
require_once("../db.php");

class Contract {
    private $connection;

    public function __construct($dbConnection) {
        $this->connection = $dbConnection;
    }

    public function addContract($clientId, $carId, $startDate, $endDate, $total) {
        $stmt = $this->connection->prepare("INSERT INTO contracts (user_id, car_id, start_date, end_date, total) 
                                            VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("iissi", $clientId, $carId, $startDate, $endDate, $total);

        if ($stmt->execute()) {
            return true;
        } else {
            return $stmt->error;
        }
    }

    public function getContractById($contractId) {
        $stmt = $this->connection->prepare("SELECT * FROM contracts WHERE id = ?");
        $stmt->bind_param("i", $contractId);
        $stmt->execute();
        $result = $stmt->get_result();

        $contract = $result->fetch_assoc();
        $stmt->close();

        return $contract;
    }
    public function updateContract($contractId, $clientId, $carId, $startDate, $endDate, $total) {
        $stmt = $this->connection->prepare("UPDATE contracts SET user_id = ?, car_id = ?, start_date = ?, end_date = ?, total = ? WHERE id = ?");
        $stmt->bind_param("iissdi", $clientId, $carId, $startDate, $endDate, $total, $contractId);

        if ($stmt->execute()) {
            return true;
        } else {
            error_log("Erreur lors de la mise à jour : " . $stmt->error);
            return $stmt->error;
        }
    }


    public function deleteContract($contractId) {
        $stmt = $this->connection->prepare("DELETE FROM contracts WHERE id = ?");
        $stmt->bind_param("i", $contractId);

        if ($stmt->execute()) {
            return true;
        } else {
            return $stmt->error;
        }
    }


    public function getClients() {
        $stmt = $this->connection->prepare("SELECT id, first_name, last_name FROM users WHERE role = 'client'");
        $stmt->execute();
        $result = $stmt->get_result();

        $clients = [];
        while ($row = $result->fetch_assoc()) {
            $clients[] = $row;
        }

        $stmt->close();
        return $clients;
    }


    public function getCars() {
        $stmt = $this->connection->prepare("SELECT id, model FROM cars");
        $stmt->execute();
        $result = $stmt->get_result();

        $cars = [];
        while ($row = $result->fetch_assoc()) {
            $cars[] = $row;
        }

        $stmt->close();
        return $cars;
    }
}
?>
