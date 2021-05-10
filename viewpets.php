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

if (!isset($_GET['Pet_ID']) && $_SERVER['REQUEST_METHOD'] != 'POST') {
    
    // Retrieve list of employees
    $stmt = $conn->prepare("SELECT Pet_ID, Pet_Name FROM Pet ORDER BY Pet_Name");
    $stmt->execute();
    
    echo "<form method='get'>";
    echo "<select name='Pet_ID' onchange='this.form.submit();'>";
    
    while ($row = $stmt->fetch()) {
        echo "<option value='$row[Pet_ID]'>$row[Pet_Name]</option>";
    }
    
    echo "</select>";
    echo "</form>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    
    $Pet_ID = $_GET["Pet_ID"];
    
    $stmt = $conn->prepare("SELECT Pet_ID, Pet_Name, Species, Birthdate
                            FROM Pet WHERE Pet_ID=:Pet_ID");
    $stmt->bindValue(':Pet_ID', $Pet_ID);
    
    $stmt->execute();
    
    $row = $stmt->fetch();
    
    echo "<form method='post' action='viewpets.php'>";
    echo "<table style='border: solid 1px black;'>";
    echo "<tbody>";
    echo "<tr><td>Pet name</td><td><input name='Pet_Name' type='text' size='15' value='$row[Pet_Name]'></td></tr>";
    echo "<tr><td>Species</td><td><input name='Species' type='text' size='30' value='$row[Species]'></td></tr>";
    echo "<tr><td>Birthdate</td><td><input name='Birthdate' type='date' size='13' value='$row[Birthdate]'></td></tr>";
    echo "<tr><td></td><td><input type='submit' value='Submit'></td></tr>";
    echo "</tbody>";
    echo "</table>";
    echo "</form>";
    
    $_SESSION["editPet_Pet_ID"] = $Pet_ID;
    
} else {
    
    try {
        $stmt = $conn->prepare("UPDATE Pet SET Pet_Name=:Pet_Name, Species=:Species, 
                                Birthdate=:Birthdate WHERE Pet_ID=:Pet_ID");
        
        $stmt->bindValue(':Pet_Name', $_POST['Pet_Name']);
        $stmt->bindValue(':Species', $_POST['Species']);
        $stmt->bindValue(':Birthdate', $_POST['Birthdate']);
        $stmt->bindValue(':Pet_ID', $_SESSION["editPet_Pet_ID"]);
        
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    
    unset ($_SESSION["editPet_Pet_ID"]);
    
    echo "Success";
}

?>