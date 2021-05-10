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

if (!isset($_GET['Company_ID']) && $_SERVER['REQUEST_METHOD'] != 'POST') {
    
    // Retrieve list of employees
    $stmt = $conn->prepare("SELECT Company_ID, Company_Name FROM Electricity_Supplier ORDER BY Company_Name");
    $stmt->execute();
    
    echo "<form method='get'>";
    echo "<select name='Company_ID' onchange='this.form.submit();'>";
    echo "<option value='None'></option>";
    
    while ($row = $stmt->fetch()) {
        echo "<option value='$row[Company_ID]'>$row[Company_Name]</option>";
    }
    
    echo "</select>";
    echo "</form>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    
    $Company_ID = $_GET["Company_ID"];
    
    $stmt = $conn->prepare("SELECT Company_ID, Company_Name, Email_Address, Company_Address, Company_Phone_Number
                            FROM Electricity_Supplier WHERE Company_ID=:Company_ID");
    $stmt->bindValue(':Company_ID', $Company_ID);
    
    $stmt->execute();
    
    $row = $stmt->fetch();
    
    echo "<form method='post' action='editpowercompanyinfo.php'>";
    echo "<table style='border: solid 1px black;'>";
    echo "<tbody>";
    echo "<tr><td>Company name</td><td><input name='Company_Name' type='text' size='30' value='$row[Company_Name]'></td></tr>";
    echo "<tr><td>Address</td><td><input name='Company_Address' type='text' size='50' value='$row[Company_Address]'></td></tr>";
    echo "<tr><td>Phone Number</td><td><input name='Company_Phone_Number' type='text' size='13' value='$row[Company_Phone_Number]'></td></tr>";
    echo "<tr><td></td><td><input type='submit' value='Submit'></td></tr>";
    echo "</tbody>";
    echo "</table>";
    echo "</form>";
    
    $_SESSION["editElectricity_Supplier_Company_ID"] = $Company_ID;
    
} else {
    
    try {
        $stmt = $conn->prepare("UPDATE Electricity_Supplier SET Company_Name=:Company_Name, Company_Address=:Company_Address, 
                                Company_Phone_Number=:Company_Phone_Number WHERE Company_ID=:Company_ID");
        
        $stmt->bindValue(':Company_Name', $_POST['Company_Name']);
        $stmt->bindValue(':Company_Address', $_POST['Company_Address']);
        $stmt->bindValue(':Company_Phone_Number', $_POST['Company_Phone_Number']);
        $stmt->bindValue(':Company_ID', $_SESSION["editElectricity_Supplier_Company_ID"]);
        
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    
    unset ($_SESSION["editElectricity_Supplier_Company_ID"]);
    
    echo "Success";
}

?>