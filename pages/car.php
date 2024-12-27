<?php
require_once '../db.php';

class Car {
    private $db;

    public function __construct(Database $database) {
        $this->db = $database->getConnection();
    }

    public function addCar($carNumber, $brandName, $model, $priceDay, $year) {
    $sql = "INSERT INTO `cars` (`id`, `brand`, `model`, `price_per_day`, `year`) 
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $this->db->prepare($sql);
    $stmt->bind_param("issii", $carNumber, $brandName, $model, $priceDay, $year);

    if ($stmt->execute()) {
        return true; 
    } else {
        return false;
    }
}

    public function getCarById($carId) {
        $sql = "SELECT * FROM cars WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $carId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function updateCar($carId, $brandName, $model, $priceDay, $year) {
        $sql = "UPDATE cars 
                SET brand = ?, model = ?, price_per_day = ?, year = ? 
                WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ssiii", $brandName, $model, $priceDay, $year, $carId);

        if ($stmt->execute()) {
            return "Les informations de la voiture ont été mises à jour avec succès.";
        } else {
            return "Erreur lors de la mise à jour de la voiture : " . $this->db->error;
        }
    }

    public function deleteCar($carId) {
    $sql = "DELETE FROM cars WHERE id = ?";
    $stmt = $this->db->prepare($sql);
    $stmt->bind_param("i", $carId);

    if ($stmt->execute()) {
        return true; 
    } else {
        return false; 
    }
}

    public function getAllCars() {
        $sql = "SELECT * FROM cars ORDER BY year DESC";
        $result = $this->db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>
