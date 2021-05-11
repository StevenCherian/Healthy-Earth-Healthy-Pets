
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

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    
    echo "<form method='post' action='addEmployee.php'>";
    echo "<table style='border: solid 1px black;'>";
    echo "<tbody>";
    
    echo "<tr><td>Employee Type</td><td>";
    
    // Retrieve list of store IDs
    $stmt = $conn->prepare("SELECT User_Type FROM Users WHERE User_Type = 'Veterinarian' OR User_Type = 'Receptionist' LIMIT 2");
    $stmt->execute();
    
    echo "<select name='User_Type'>";
    
    echo "<option value='-1'>Emplyee Type Required</option>";
    
    while ($row = $stmt->fetch()) {
        echo "<option value='$row[User_Type]'>$row[User_Type]</option>";
    }
    
    echo "</select>";
    echo "</td></tr>";
    
    echo "<tr><td>First name</td><td><input name='First_Name' type='text' maxlength='10' size='10'></td></tr>";
    echo "<tr><td>Last name</td><td><input name='Last_Name' type='text' maxlength='10' size='10'></td></tr>";
    echo "<tr><td>Email</td><td><input name='Email_Address' type='email' maxlength='40' size='40'></td></tr>";
    echo "<tr><td>Password</td><td><input name='User_Password' type='text' maxlength='100' size='100'></td></tr>";
    echo "<tr><td>Home Address</td><td><input name='Home_Address' type='text' maxlength='40' size='40'></td></tr>";
    echo "<tr><td>Phone Number</td><td><input name='Phone_Number' type='text' maxlength='13' size='13'></td></tr>";
    echo "<tr><td>Weekly Hours</td><td><input name='Weekly_Hours' type='number' min='0' max='99' size='3'></td></tr>";
    echo "<tr><td>Clock-In Time</td><td><input name='Clock_In_Time' type='text' maxlength='10' size='10'></td></tr>";
    echo "<tr><td>Clock-Out Time</td><td><input name='Clock_Out_Time' type='text' maxlength='10' size='10'></td></tr>";
    echo "<tr><td>Salary</td><td><input name='Salary' type='number' min='0' max='1000' size='4'></td></tr>";
    echo "<tr><td>Store ID</td><td>";
    
   
    // Retrieve list of store IDs
    $stmt = $conn->prepare("SELECT ID FROM Healthy_Earth_Healthy_Pets");
    $stmt->execute();
    
    echo "<select name='ID'>";
    
    echo "<option value='-1'>Store ID Required</option>";
    
    while ($row = $stmt->fetch()) {
        echo "<option value='$row[ID]'>$row[ID]</option>";
    }
    
    echo "</select>";
    echo "</td></tr>";
    
    echo "<tr><td></td><td><input type='submit' value='Submit'></td></tr>";
    
    echo "</tbody>";
    echo "</table>";
    echo "</form>";
} else {
    
    try {
        
        $stmt = $conn->prepare("INSERT INTO Users (User_Type, First_Name, Last_Name, Email_Address, User_Password)
                                VALUES (:User_Type, :First_Name, :Last_Name, :Email_Address, :User_Password)");
        
        $password = password_hash($_POST['User_Password'], PASSWORD_BCRYPT);
        
        if($_POST['User_Type'] != -1) {
            $stmt->bindValue(':User_Type', $_POST['User_Type']);
        } else {
            $stmt->bindValue(':User_Type', null, PDO::PARAM_INT);
        }
        $stmt->bindValue(':First_Name', $_POST['First_Name']);
        $stmt->bindValue(':Last_Name', $_POST['Last_Name']);
        $stmt->bindValue(':Email_Address', $_POST['Email_Address']);
        $stmt->bindValue(':User_Password', $password);
        
        if($_POST['User_Type'] != -1) {
            $stmt->bindValue(':User_Type', $_POST['User_Type']);
        } else {
            $stmt->bindValue(':User_Type', null, PDO::PARAM_INT);
        }
        
        $stmt->execute();
        
    } catch (PDOException $e) {
        echo "Error: " . $e.getMessage();
        die();
    }
    
    try {
        $stmt = $conn->prepare("INSERT INTO Employee (Employee_Type, First_Name, Last_Name, Email_Address, Home_Address, Phone_Number, Weekly_Hours,
                                Clock_In_Time, Clock_Out_Time, Salary, ID)
                                VALUES (:User_Type, :First_Name, :Last_Name, :Email_Address, :Home_Address, :Phone_Number, :Weekly_Hours,
                                :Clock_In_Time, :Clock_Out_Time, :Salary, :ID)");
        
        if($_POST['User_Type'] != -1) {
            $stmt->bindValue(':User_Type', $_POST['User_Type']);
        } else {
            $stmt->bindValue(':User_Type', null, PDO::PARAM_INT);
        }
        
        $stmt->bindValue(':First_Name', $_POST['First_Name']);
        $stmt->bindValue(':Last_Name', $_POST['Last_Name']);
        $stmt->bindValue(':Email_Address', $_POST['Email_Address']);
        $stmt->bindValue(':Home_Address', $_POST['Home_Address']);
        $stmt->bindValue(':Phone_Number', $_POST['Phone_Number']);
        $stmt->bindValue(':Weekly_Hours', $_POST['Weekly_Hours']);
        $stmt->bindValue(':Clock_In_Time', $_POST['Clock_In_Time']);
        $stmt->bindValue(':Clock_Out_Time', $_POST['Clock_Out_Time']);
        $stmt->bindValue(':Salary', $_POST['Salary']);
        
        if($_POST['ID'] != -1) {
            $stmt->bindValue(':ID', $_POST['ID']);
        } else {
            $stmt->bindValue(':ID', null, PDO::PARAM_INT);
        }        
        
        
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        die();
    }
    

    
    echo "Success";
}

?>