<?php
require_once("../db.php");
require_once("../pages/user.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $firstName = trim(htmlspecialchars($_POST['first-name']));
    $lastName = trim(htmlspecialchars($_POST['last-name']));
    $email = trim(htmlspecialchars($_POST['email']));
    $phone = trim(htmlspecialchars($_POST['phone']));
    $address = trim(htmlspecialchars($_POST['address']));

    // Connexion à la base de données et création de l'objet User
    $database = new Database();
    $user = new User($database);

    // Ajout de l'utilisateur
    $result = $user->addUser($firstName, $lastName, $email, $phone, $address);

    if ($result === "L'utilisateur a été ajouté avec succès.") {
        header("Location: /pages/clients.php?success=added");
        exit();
    } else {
        echo "Erreur : " . $result;
    }
}
?>
