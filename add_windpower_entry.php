<?php
require_once ('connection.php');

try {
    
    $sqlQuery = "INSERT INTO Wind_Power
                     (Turbine_Grid_ID, Turbine_Energy_Consumption, MonthYearName)
                     VALUES
                     (:Turbine_Grid_ID, :Turbine_Energy_Consumption, :MonthYearName)";
    
    $stmt = $conn->prepare($sqlQuery);
    $stmt->bindValue(':Turbine_Grid_ID', $_POST["Turbine_Grid_ID"]);
    $stmt->bindValue(':Turbine_Energy_Consumption', $_POST["Turbine_Energy_Consumption"]);
    $stmt->bindValue(':MonthYearName', $_POST["MonthYearName"]);
    $stmt->execute();
    
    header("Location windpowerinfo.php");
    
}catch(PDOException $e) {
    echo($e->getMessage());
}
?>