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
            <a href="admin_main.php">Go back</a>
          </div>
        </div>
    	
	</body>
</html>

<?php

require_once('connection.php');

// Show all employees
$stmt=$conn->prepare("SELECT UserID FROM Users WHERE userID = :emp AND (User_Type = 'Veterinarian' OR User_Type = 'SolarPowerComp' OR User_Type = 'WindPowerComp')");
$stmt->bindParam(":empID", "$_SESSION[User_ID]");
$stmt->execute();
$admin = $stmt->fetch();

if(is_array($admin)){}
else{
    
}

$stmt = $conn->prepare("SELECT Employee_ID, First_Name, Last_Name FROM Employee ORDER BY First_Name, Last_Name");
$stmt->execute();

echo "<table style='border: solid 1px black;'>";
echo "<thead><tr><th>Employee ID</th><th>First name</th><th>Last name</th></tr></thead>";
echo "<tbody>";

while ($row = $stmt->fetch()) {
    
    
    
    echo "<tr><td>$row[Employee_ID]</td><td>$row[First_Name]</td><td>$row[Last_Name]</td></tr>";
}

echo "</tbody>";
echo "</table>";

?>