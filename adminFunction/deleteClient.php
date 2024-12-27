<?php
require_once("../db.php");
require_once("../pages/user.php");

if (isset($_GET["id"])) {
    $id = intval($_GET["id"]);

    // Connexion à la base de données et création de l'objet User
    $db = new Database();
    $user = new User($db);

    // Suppression de l'utilisateur
    $result = $user->deleteUser($id);

    if ($result === "L'utilisateur a été supprimé avec succès.") {
        header("Location: /pages/clients.php?success=deleted");
        exit();
    } else {
        echo "Erreur : " . $result;
    }
} else {
    echo "ID de client manquant.";
}
?>
