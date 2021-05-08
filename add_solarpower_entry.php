<?php
require_once ('connection.php');

try {
    
    $sqlQuery = "INSERT INTO Solar_Power
                     (Solar_Grid_ID, Grid_Energy_Consumption, MonthYearName)
                     VALUES
                     (:Solar_Grid_ID, :Grid_Energy_Consumption, :MonthYearName)";
    
    $stmt = $conn->prepare($sqlQuery);
    $stmt->bindValue(':Solar_Grid_ID', $_POST["Solar_Grid_ID"]);
    $stmt->bindValue(':Grid_Energy_Consumption', $_POST["Grid_Energy_Consumption"]);
    $stmt->bindValue(':MonthYearName', $_POST["MonthYearName"]);
    $stmt->execute();
    
    header("solarpowerinfo.php");
    
}catch(PDOException $e) {
    echo($e->getMessage());
}
?>