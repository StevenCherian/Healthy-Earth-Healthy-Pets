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
            
            .myheader {
              padding: 1px;
              width: 100%;
              background: #404040;
              color: #f2f2f2;
              font-size: 12px;
              text-align: center;
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
	
	<?php 
	require_once('connection.php');
	?>
	
	<body>
	
    	<div class="myheader">
      		<h2>Healthy Earth, Healthy Pets</h2>
    	</div>
    	
    	<div class="electricityinfo-container">
        	<form action="add_solarpower_entry.php" method="post">	 
        		<div class ="powerinfo" id="log">
        			<h3><strong>Enter your Solar Power Information</strong></h3>
        			
        			<label for="SolarGrid#"><b>Solar Grid #:</b></label>
        			<input type="SolarGrid#" placeholder="Solar Grid #" name="Solar_Grid_ID" required>
        			
        			<label for="Grid Energy Consumption"><b>Grid Energy Consumption:</b></label>
        			<input type="Grid Energy Consumption" placeholder="Grid Energy Consumption" name="Grid_Energy_Consumption" required>
                    
                    <label for="Month"><b>For the month of:</b></label>
        			<input type="Month" placeholder="Month" name="MonthYearName" required>
        			
        			<div style="display: inline-grid;margin: 3% auto auto auto;">
        				<button type="submit">Submit</button>
        			</div>
        			
        	 	</div>
        	</form>
		</div>
	</body>
</html>