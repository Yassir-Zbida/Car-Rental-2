<?php
if( isset($_GET["id"])){
    $id=$_GET["id"];
    $connection = new mysqli("localhost","root","yassir","gorent");
    $stmt= $connection -> query(" DELETE FROM clients WHERE id =$id ; ");
   header("location: /pages/clients.php");
} 
?>