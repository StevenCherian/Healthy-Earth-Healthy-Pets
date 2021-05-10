<?php

require_once ('connection.php');

try {
    
    $sqlQuery = "INSERT INTO Pet
                     (Pet_Name, Species, Birthdate)
                     VALUES
                     (:petname, :species, :birthdate)";
    
    $stmt = $conn->prepare($sqlQuery);
    $stmt->bindValue(':petname', $_POST["petname"]);
    $stmt->bindValue(':species', $_POST["species"]);
    $stmt->bindValue(':birthdate', $_POST["birthdate"]);
    $stmt->execute();
    
    header("Location: main.php");
    
}catch(PDOException $e) {
    echo($e->getMessage());
}
