<?php
require_once("../db.php");
require_once("../pages/car.php");
    

if (isset($_GET["id"])) {
    $id = intval($_GET["id"]);
    $db = new Database();
    $car = new Car($db);
   $result= $car->deleteCar($id);
    
   if ($result) { 
    header("Location: ../pages/cars.php?success=deleted");
    exit();
} else {
    echo "Erreur lors de la suppression de la voiture.";
}
} else {
    echo "ID de car manquant.";
}

?>
