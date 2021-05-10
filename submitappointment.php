<?php

require_once ('connection.php');

try {
    
    $sqlQuery = "INSERT INTO Appointment
                     (Appointment_Reason, Check_In_Time, Check_In_Date)
                     VALUES
                     (:apptrsn, :checkintime, :checkindate)";
    
    $stmt = $conn->prepare($sqlQuery);
    $stmt->bindValue(':apptrsn', $_POST["apptrsn"]);
    $stmt->bindValue(':checkintime', $_POST["checkintime"]);
    $stmt->bindValue(':checkindate', $_POST["checkindate"]);
    $stmt->execute();
    
    header("Location: main.php");
    
}catch(PDOException $e) {
    echo($e->getMessage());
}
