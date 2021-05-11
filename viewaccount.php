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
            <a href="myaccount.php">Go back</a>
          </div>
        </div>
    	
	</body>
</html>

<?php

require_once('connection.php');

if (!isset($_GET['UserID']) && $_SERVER['REQUEST_METHOD'] != 'POST') {
    
    // Retrieve list of employees
    $stmt = $conn->prepare("SELECT UserID, First_Name FROM Users WHERE UserID=:UserID ORDER BY First_Name");
    $stmt->bindValue(':UserID', $_SESSION['user_ID']);
    $stmt->execute();
    
    //echo "<form method='get'>";
    //echo "<select name='Appointment_ID' onchange='this.form.submit();'>";
    
    echo "<form method='get'>";
    echo "<div style='width: 100%; padding-top: 10%; display: grid; justify-content: center'>";
    echo "<h4>Choose an account to view</h4>";
    echo "<select style='color: black; padding: 5px 30px 5px 30px' name='UserID' onchange='this.form.submit();'>";
    echo "</div>";
    
    echo "<option value='None'></option>";
    
    while ($row = $stmt->fetch()) {
        echo "<option value='$row[UserID]'>$row[First_Name]</option>";
    }
    
    echo "</select>";
    echo "</form>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    
    $UserID = $_GET["UserID"];
    
    $stmt0 = $conn->prepare("SELECT UserID FROM Users WHERE UserID=:UserID");
    $stmt0->bindValue(':UserID', $UserID);
    $stmt0->execute();
    $row0 = $stmt0->fetch();
    
    $stmt1=$conn->prepare("SELECT Users.UserID FROM Users WHERE Users.UserID = :empID LIMIT 1;");
    $stmt1->bindParam(":empID", $_SESSION['user_ID']);
    $stmt1->execute();
    $admin = $stmt1->fetch();
    
    if($row0 != $admin){
        header("Location: notauthorized.php");
    }
    
    $stmt = $conn->prepare("SELECT UserID, First_Name, Last_Name, User_Password
                            FROM Users WHERE UserID=:UserID");
    $stmt->bindValue(':UserID', $UserID);
    
    $stmt->execute();
    
    $row = $stmt->fetch();
    
    echo "<form method='post' action='viewappointments.php'>";
    echo "<table style='border: solid 1px black;'>";
    echo "<tbody>";
    echo "<tr><td>First Name</td><td><input name='First_Name' type='text' maxlength='25' size='25' value='$row[First_Name]'></td></tr>";
    echo "<tr><td>Last Name</td><td><input name='Last_Name' type='text' maxlength='25' size='25' value='$row[Last_Name]'></td></tr>";
    echo "<tr><td>Password</td><td><input name='User_Password' type='text' maxlength='100' size='25' value='$row[User_Password]'></td></tr>";
    echo "<tr><td></td><td><input type='submit' value='Submit'></td></tr>";
    echo "</tbody>";
    echo "</table>";
    echo "</form>";
    
    $_SESSION["editUsers_UserID"] = $UserID;
    
} else {
    
    try {
        $stmt = $conn->prepare("UPDATE Users SET First_Name=:First_Name, Last_Name=:Last_Name, 
                                User_Password=:User_Password WHERE UserID=:UserID");
        $password = password_hash($_POST['User_Password'], PASSWORD_BCRYPT);
        
        $stmt->bindValue(':First_Name', $_POST['First_Name']);
        $stmt->bindValue(':Last_Name', $_POST['Last_Name']);
        $stmt->bindValue(':User_Password', $password);
        $stmt->bindValue(':UserID', $_SESSION["editUsers_UserID"]);
        
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    
    unset ($_SESSION["editUsers_UserID"]);
    
    echo "Success";
}

?>