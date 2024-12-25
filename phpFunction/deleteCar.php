<?php
if( isset($_GET["id"])){
    $id=$_GET["id"];
    $connection = new mysqli("localhost","root","yassir","gorent");
    $stmt= $connection -> query(" DELETE FROM cars WHERE ID =$id ; ");
   header("location: /pages/cars.php");
} 
?>