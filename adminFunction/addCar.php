<?php

require_once("../db.php");
require_once("../pages/car.php");

 


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $carNumber = trim(htmlspecialchars($_POST['carNumber']));
    $brandName = trim(htmlspecialchars($_POST['brandName']));
    $model = trim(htmlspecialchars($_POST['model']));
    $priceDay = trim(htmlspecialchars($_POST['priceDay']));
    $year = trim(htmlspecialchars($_POST['year']));

    // Connexion à la base de données
    $database = new Database();
    $car = new Car($database);

    $result=$car->addCar($carNumber, $brandName, $model, $priceDay, $year);
    if ($result) { // Si true, redirige
    header("Location: /pages/cars.php?success=added");
    exit();
} else {
    echo "Erreur lors de l'ajout de la voiture.";
  }
}
?>


