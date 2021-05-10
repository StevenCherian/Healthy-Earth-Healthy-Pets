<?php

require_once ('connection.php');

try {
    
    $sqlQuery = "INSERT INTO Appointment
                     (Appointment_Reason, Check_In_Time, Check_In_Date)
                     VALUES
                     (:apptrsn, :checkintime, :checkindate)";
    
    $stmt = $conn->prepare($sqlQuery);
    $stmt->bindValue(':Appointment_Reason', $_POST["apptrsn"]);
    $stmt->bindValue(':Check_In_Time', $_POST["checkintime"]);
    $stmt->bindValue(':Check_In_Date', $_POST["checkindate"]);
    $stmt->execute();
    
    header("Location: main.php");
    
}catch(PDOException $e) {
    echo($e->getMessage());
}
