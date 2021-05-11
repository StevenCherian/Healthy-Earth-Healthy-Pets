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

setlocale(LC_MONETARY, 'en_US');

if (!isset($_GET['Employee_ID'])) {
    
    // Retrieve list of employees
    $stmt = $conn->prepare("SELECT Employee_ID, First_Name, Last_Name FROM Employee ORDER BY First_Name, Last_Name");
    $stmt->execute();
    
//     echo "<form method='get'>";
//     echo "<select name='Employee_ID' onchange='this.form.submit();'>";
    
    echo "<form method='get'>";
    echo "<div style='width: 100%; padding-top: 10%; display: grid; justify-content: center'>";
    echo "<h4>Choose an employee to view</h4>";
    echo "<select style='color: black; padding: 5px 30px 5px 30px' name='Employee_ID' onchange='this.form.submit();'>";
    echo "</div>";
    
    echo "<option value='None'>Choose Employee</option>";
    
    while ($row = $stmt->fetch()) {
        echo "<option value='$row[Employee_ID]'>$row[First_Name] $row[Last_Name]</option>";
    }
    
    echo "</select>";
    echo "</form>";
} else {
    
    $Employee_ID = $_GET["Employee_ID"]; // GET NOT SAFE FOR PRIVACY OF VARIABLES
    
    $stmt = $conn->prepare("SELECT Employee_ID, First_Name, Last_Name, Email_Address, Home_Address, Phone_Number, Salary FROM Employee WHERE Employee_ID=$Employee_ID"); // NOT SAFE FOR SQL INJECTION
    
    //$stmt = $conn->prepare("SELECT employee_id, first_name, last_name, salary FROM employees WHERE employee_id=:employee_id"); // PREPARED STATEMENT (BETTER USE)
    //$stmt->bindValue(':employee_id', $employee_id);
    
    $stmt->execute();
    
    echo "<table style='border: solid 1px black;'>";
    echo "<thead><tr><th>Employee ID</th><th>First Name</th><th>Last Name</th><th>Email Address</th><th>Home Address</th><th>Phone Number</th><th>Salary</th></tr></thead>";
    echo "<tbody>";
    
    $fmt = new NumberFormatter( 'en_US', NumberFormatter::CURRENCY );
    
    while ($row = $stmt->fetch()) {
        echo "<tr><td>$row[Employee_ID]</td><td>$row[First_Name]</td><td>$row[Last_Name]</td><td>$row[Email_Address]</td><td>$row[Home_Address]</td><td>$row[Phone_Number]</td>
                <td>" . $fmt->formatCurrency($row["Salary"], "USD") . "</td></tr>";
    }
    
    echo "</tbody>";
    echo "</table>";
}

?>