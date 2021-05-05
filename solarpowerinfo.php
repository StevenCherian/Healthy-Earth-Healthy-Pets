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
                background-color: #1E9963;
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
	 	 
        </style>
	</head>
	
	<?php 
// 	require_once('connection.php');
// 	?>
	
	<body>
	
    	<div class="myheader">
      		<h2>Healthy Earth, Healthy Pets</h2>
    	</div>
    	
    	<div class="electricityinfo-container">
        	<form method="post">	 
        		<div class ="login" id="log">
        			<h3><strong>Enter your Solar Power Information</strong></h3>
        			
        			<label for="SolarGrid#"><b>Solar Grid #:</b></label>
        			<input type="SolarGrid#" placeholder="Solar Grid #" name="Solar Grid #" required>
        			
        			<label for="Grid Energy Consumption"><b>Grid Energy Consumption:</b></label>
        			<input type="Grid Energy Consumption" placeholder="Grid Energy Consumption" name="Grid Energy Consumption" required>
                    
                    <label for="Month"><b>For the month of:</b></label>
        			<input type="Month" placeholder="Month" name="Month" required>
        			
        			<div style="display: inline-grid;margin: 3% auto auto auto; grid-row-gap: 7px;">
        				<button type="submit">Submit</button>
        			</div>
        			
        	 	</div>
        	</form>
		</div>
	</body>
</html>