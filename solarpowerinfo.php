<!DOCTYPE html>

<?php

require_once 'connection.php';

$stmt=$conn->prepare("SELECT UserID FROM Users WHERE UserID = :empID AND (User_Type = 'SolarPowerComp')");
$stmt->bindParam(":empID", $_SESSION['user_ID']);
$stmt->execute();
$admin = $stmt->fetch();

if(!is_array($admin)){
    header("Location: notauthorized.php");
}
?>

<html>
	<?php require_once('connection.php'); ?>
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
            
            .electricityinfo-container {
            	margin: 1%;
                width: 80%;
            	margin-left: auto;
            	margin-right: auto;
            }
            
            .powerinfo {
            	padding: 25px;
            	border-radius: 20px;
            	width: 75%;
            	max-width: 450px;
            	margin: auto;
            	display: grid;
            	overflow: auto;
            	background-color: #f2f2f2;
            	color: #000000;
            }   
	 	 
        </style>
	</head>
	
	<body>
	
        <div class="header">
          <a href="#default" class="logo">Healthy Earth, Healthy Pets</a>
          <div class="header-right">
            <a href="logout.php">Logout</a>
          </div>
        </div>
    	
    	<div class="electricityinfo-container">
        	<form action="add_solarpower_entry.php" method="post">	 
        		<div class ="powerinfo" id="log">
        			<h3><strong>Enter your Solar Power Information</strong></h3>
        			
        			<label for="SolarGrid#"><b>Solar Grid #:</b></label>
        			<input type="SolarGrid#" maxlength="3" placeholder="Solar Grid #" name="Solar_Grid_ID" required>
        			
        			<label for="Grid Energy Consumption"><b>Grid Energy Consumption:</b></label>
        			<input type="Grid Energy Consumption" maxlength="10" placeholder="Grid Energy Consumption" name="Grid_Energy_Consumption" required>
                    
                    <label for="Month"><b>For the month of:</b></label>
        			<input type="Month" maxlength="50" placeholder="Month" name="MonthYearName" required>
        			
        			<div style="display: inline-grid;margin: 3% auto auto auto;">
        				<button type="submit">Submit</button>
        			</div>
        			
        	 	</div>
        	</form>
		</div>
	</body>
</html>