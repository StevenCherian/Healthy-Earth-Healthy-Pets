<!DOCTYPE html>

<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
	 	<link rel="stylesheet" href="styles.css">
	 	<title>Healthy Earth, Healthy Pets</title>
	 	
	 	<style>
    	 	body {
                margin: 0;
                margin-block: auto;
                font-family: sans-serif;
                animation: fadeInAnimation ease .6s;
                animation-iteration-count: 1;
                animation-fill-mode: forwards;
                background-color: #2a9d8f;
            }

            @keyframes fadeInAnimation {
                0% { opacity: 0; }
                100% { opacity: 1; }
            }
           
            .header {
              overflow: hidden;
              background-color: #404040;
              padding: 5px 1px;
            }

            .header a {
              float: left;
              color: white;
              text-align: center;
              padding: 12px;
              text-decoration: none;
              font-size: 15px; 
              line-height: 15px;
              border-radius: 4px;
            }

            .header a.logo {
              font-size: 15px;
              font-weight: bold;
              color: white;
            }

            .header a.active {
              background-color: dodgerblue;
              color: white;
            }

            .header-right {
              float: right;
              padding-right: 12px;
            }       

            .main-container {
                padding: 25px;
                width: 95%;
                margin: auto;
                display: grid;
                overflow: auto;
                background-color: #f2f2f2;
                color: #000000;
                text-align: center;
            }
	 	 
        </style>
	</head>
	
	<body>
	
        <div class="header">
          <a href="#default" class="logo">Healthy Earth, Healthy Pets</a>
          <div class="header-right">
            <a href="myaccount.php">Go back</a>
          </div>
        </div>
    	
	</body>
</html>

<?php

require_once('connection.php');

if (!isset($_GET['Appointment_ID']) && $_SERVER['REQUEST_METHOD'] != 'POST') {
    
    // Retrieve list of employees
    $stmt = $conn->prepare("SELECT Appointment_ID, Appointment_Reason FROM Appointment WHERE UserID=:UserID ORDER BY Appointment_Reason");
    $stmt->bindValue(':UserID', $_SESSION['user_ID']); 
    $stmt->execute();
    
    //echo "<form method='get'>";
    //echo "<select name='Appointment_ID' onchange='this.form.submit();'>";
    
    echo "<form method='get'>";
    echo "<div style='width: 100%; padding-top: 10%; display: grid; justify-content: center'>";
    echo "<h4>Choose an employee to edit</h4>";
    echo "<select style='color: black; padding: 5px 30px 5px 30px' name='Appointment_ID' onchange='this.form.submit();'>";
    echo "</div>";
    
    echo "<option value='None'></option>";
    
    while ($row = $stmt->fetch()) {
        echo "<option value='$row[Appointment_ID]'>$row[Appointment_Reason]</option>";
    }
    
    echo "</select>";
    echo "</form>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    
    $Appointment_ID = $_GET["Appointment_ID"];
    
    $stmt = $conn->prepare("SELECT Appointment_ID, Appointment_Reason, Check_In_Time, Check_In_Date
                            FROM Appointment WHERE Appointment_ID=:Appointment_ID");
    $stmt->bindValue(':Appointment_ID', $Appointment_ID);
    
    $stmt->execute();
    
    $row = $stmt->fetch();
    
    echo "<form method='post' action='viewappointments.php'>";
    echo "<table style='border: solid 1px black;'>";
    echo "<tbody>";
    echo "<tr><td>Appointment Reason</td><td><input name='Appointment_Reason' type='text' maxlength='100' size='100' value='$row[Appointment_Reason]'></td></tr>";
    echo "<tr><td>Check-In Time</td><td><input name='Check_In_Time' type='time' maxlength='10' size='10' value='$row[Check_In_Time]'></td></tr>";
    echo "<tr><td>Check-In Date</td><td><input name='Check_In_Date' type='date' maxlength='13' size='13' value='$row[Check_In_Date]'></td></tr>";
    echo "<tr><td></td><td><input type='submit' value='Submit'></td></tr>";
    echo "</tbody>";
    echo "</table>";
    echo "</form>";
    
    $_SESSION["editAppointment_Appointment_ID"] = $Appointment_ID;
    
} else {
    
    try {
        $stmt = $conn->prepare("UPDATE Appointment SET Appointment_Reason=:Appointment_Reason, Check_In_Time=:Check_In_Time, 
                                Check_In_Date=:Check_In_Date WHERE Appointment_ID=:Appointment_ID");
        
        $stmt->bindValue(':Appointment_Reason', $_POST['Appointment_Reason']);
        $stmt->bindValue(':Check_In_Time', $_POST['Check_In_Time']);
        $stmt->bindValue(':Check_In_Date', $_POST['Check_In_Date']);
        $stmt->bindValue(':Appointment_ID', $_SESSION["editAppointment_Appointment_ID"]);
        
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    
    unset ($_SESSION["editAppointment_Appointment_ID"]);
    
    echo "Success";
}

?>