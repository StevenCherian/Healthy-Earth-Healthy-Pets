<?php

require_once ('connection.php');

try {
    
    $sqlQuery = "INSERT INTO Pet
                     (Pet_Name, Species, Birthdate, UserID)
                     VALUES
                     (:petname, :species, :birthdate, :UserID)";
    
    $stmt = $conn->prepare($sqlQuery);
    $stmt->bindValue(':petname', $_POST["petname"]);
    $stmt->bindValue(':species', $_POST["species"]);
    $stmt->bindValue(':birthdate', $_POST["birthdate"]);
    $stmt->bindValue(':UserID', $_SESSION['user_ID'], PDO::PARAM_INT);
    $stmt->execute();
    
    header("Location: main.php");
    
}catch(PDOException $e) {
    echo($e->getMessage());
}
