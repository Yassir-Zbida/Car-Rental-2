<?php
require_once '../db.php';

class User {
    private $db;

    public function __construct(Database $database) {
        $this->db = $database->getConnection();
    }


    public function getUserById($userId) {
        $sql = "SELECT * FROM users WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function addUser($firstName, $lastName, $email, $phone, $address) {
        $sql = "INSERT INTO `users` (`first_name`, `last_name`, `phone`, `email`, `address`, created_at, updated_at) 
                VALUES (?, ?, ?, ?, ?, NOW(), NOW())";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("sssss", $firstName, $lastName, $phone, $email, $address);

        if ($stmt->execute()) {
            return "L'utilisateur a été ajouté avec succès.";
        } else {
            return "Erreur lors de l'ajout de l'utilisateur : " . $this->db->error;
        }
    }
    
    public function updateUser($userId, $username, $email,  $firstName, $lastName,  $phone, $address , $password = null,) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "Adresse email invalide.";
        }

        $sql = "UPDATE users SET username = ?, email = ? ,first_name = ? , last_name = ? , phone = ? , address = ? , updated_at = NOW()";
        if (!empty($password)) {
            $sql .= ", password_hash = ?";
        }
        $sql .= " WHERE id = ?";

        $stmt = $this->db->prepare($sql);
        if (!empty($password)) {
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $stmt->bind_param("sssissssi", $username, $email, $firstName, $lastName, $phone, $address, $passwordHash, $userId);
        } else {
            $stmt->bind_param("ssssssi",$username, $email, $firstName, $lastName, $phone, $address, $userId);
        }

        if ($stmt->execute()) {
            return "Les informations de l'utilisateur ont été mises à jour avec succès.";
        } else {
            return "Erreur lors de la mise à jour des informations : " . $this->db->error;
        }
    }


    public function deleteUser($userId) {
        $sql = "DELETE FROM users WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $userId);

        if ($stmt->execute()) {
            return "L'utilisateur a été supprimé avec succès.";
        } else {
            return "Erreur lors de la suppression de l'utilisateur : " . $this->db->error;
        }
    }


    public function getAllUsers() {
        $sql = "SELECT * FROM users ORDER BY created_at DESC";
        $result = $this->db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>

