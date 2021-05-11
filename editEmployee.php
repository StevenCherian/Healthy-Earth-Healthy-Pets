<!DOCTYPE html>

<?php

require_once 'connection.php';

$stmt=$conn->prepare("SELECT UserID FROM Users WHERE UserID = :empID AND (User_Type = 'Veterinarian')");
$stmt->bindParam(":empID", $_SESSION['user_ID']);
$stmt->execute();
$admin = $stmt->fetch();

if(!is_array($admin)){
    header("Location: notauthorized.php");
}
?>

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
              background-color: #333333;
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
            <a href="admin_main.php">Go back</a>
          </div>
        </div>
    	
	</body>
</html>

<?php

require_once('connection.php');

if (!isset($_GET['Employee_ID']) && $_SERVER['REQUEST_METHOD'] != 'POST') {
    
    // Retrieve list of employees
    $stmt = $conn->prepare("SELECT Employee_ID, First_Name, Last_Name FROM Employee ORDER BY First_Name, Last_Name");
    $stmt->execute();
    
    echo "<form method='get'>";
    echo "<div style='width: 100%; padding-top: 10%; display: grid; justify-content: center'>";
    echo "<h4>Choose an employee to edit</h4>";
    echo "<select style='color: black; padding: 5px 30px 5px 30px' name='Employee_ID' onchange='this.form.submit();'>";
    echo "</div>";
    
  //  echo "<select style='margin: auto; left: 0; right: 0; padding: 5px 30px 5px 30px' name='Employee_ID' onchange='this.form.submit();'>";
    echo "<option value='None'>Choose Employee</option>";
    
    while ($row = $stmt->fetch()) {
        echo "<option value='$row[Employee_ID]'>$row[First_Name] $row[Last_Name]</option>";
    }
    
    echo "</select>";
    echo "</form>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    
    $Employee_ID = $_GET["Employee_ID"];
    
    $stmt = $conn->prepare("SELECT Employee_ID, First_Name, Last_Name, Email_Address, Home_Address, Phone_Number, Weekly_Hours, Clock_In_Time, 
                            Clock_Out_Time, Salary FROM Employee WHERE Employee_ID=:Employee_ID");
    $stmt->bindValue(':Employee_ID', $Employee_ID);
    
    $stmt->execute();
    
    $row = $stmt->fetch();
    
    echo "<form method='post' action='editEmployee.php'>";
    echo "<table style='border: solid 1px black;'>";
    echo "<tbody>";
    echo "<tr><td>First name</td><td><input name='First_Name' type='text' maxlength='10' size='10' value='$row[First_Name]'></td></tr>";
    echo "<tr><td>Last name</td><td><input name='Last_Name' type='text' maxlength='10' size='10' value='$row[Last_Name]'></td></tr>";
    echo "<tr><td>Email</td><td><input name='Email_Address' type='email' maxlength='40' size='40' value='$row[Email_Address]'></td></tr>";
    echo "<tr><td>Home Address</td><td><input name='Home_Address' type='text' maxlength='40' size='40' value='$row[Home_Address]'></td></tr>";
    echo "<tr><td>Phone Number</td><td><input name='Phone_Number' type='text' maxlength='13' size='13' value='$row[Phone_Number]'></td></tr>";
    echo "<tr><td>Weekly Hours</td><td><input name='Weekly_Hours' type='number' min='0' max='99' size='2' value='$row[Weekly_Hours]'></td></tr>";
    echo "<tr><td>Clock-In Time</td><td><input name='Clock_In_Time' type='text' maxlength='10' size='10' value='$row[Clock_In_Time]'></td></tr>";
    echo "<tr><td>Clock-Out Time</td><td><input name='Clock_Out_Time' type='text' maxlength='10' size='10' value='$row[Clock_Out_Time]'></td></tr>";
    echo "<tr><td>Salary</td><td><input name='Salary' type='number' min='0' max='10000000' size='8' value='$row[Salary]'></td></tr>";
    echo "<tr><td></td><td><input type='submit' value='Submit'></td></tr>";
    echo "</tbody>";
    echo "</table>";
    echo "</form>";
    
    $_SESSION["editEmployee_Employee_ID"] = $Employee_ID;
    
} else {
    
    try {
        $stmt = $conn->prepare("UPDATE Employee SET First_Name=:First_Name, Last_Name=:Last_Name, Email_Address=:Email_Address,
                                Home_Address=:Home_Address, Phone_Number=:Phone_Number, Weekly_Hours=:Weekly_Hours,
                                Clock_In_Time=:Clock_In_Time, Clock_Out_Time=:Clock_Out_Time, Salary=:Salary WHERE Employee_ID=:Employee_ID");
        
        $stmt->bindValue(':First_Name', $_POST['First_Name']);
        $stmt->bindValue(':Last_Name', $_POST['Last_Name']);
        $stmt->bindValue(':Email_Address', $_POST['Email_Address']);
        $stmt->bindValue(':Home_Address', $_POST['Home_Address']);
        $stmt->bindValue(':Phone_Number', $_POST['Phone_Number']);
        $stmt->bindValue(':Weekly_Hours', $_POST['Weekly_Hours']);
        $stmt->bindValue(':Clock_In_Time', $_POST['Clock_In_Time']);
        $stmt->bindValue(':Clock_Out_Time', $_POST['Clock_Out_Time']);
        $stmt->bindValue(':Salary', $_POST['Salary']);
        $stmt->bindValue(':Employee_ID', $_SESSION["editEmployee_Employee_ID"]);
        
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    
    unset ($_SESSION["editEmployee_Employee_ID"]);
    
    echo "Success";
}

?>