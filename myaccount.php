<!DOCTYPE html>

<?php require_once ('connection.php');?>

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
            
            .button {
              background-color: #2a9d8f;
              color: white;
              padding: 10px 25px;
              margin: 0 auto;
              border: 2px solid #404041;
              border-radius: 14px;
              cursor: pointer;
              text-decoration-line: inherit;
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
            
            .welcome {
            	text-align: center;
            }
	 	 
        </style>
	</head>
	
	<body>
	
        <div class="header">
          <a href="#default" class="logo">Healthy Earth, Healthy Pets</a>
          <div class="header-right">
            <a href="main.php">Home</a>
            <a href="contact.php">Contact</a>
            <a class="active" href="myaccount.php">My Account</a>
            <a href="logout.php">Logout</a>
          </div>
        </div>
    	
    	<div class="main-container">
    		<div class="welcome">
    			<h4>Welcome</h4>
            </div>
			
            <div class="buttonSelections">                
                <div style="display: inline-grid; margin: 3% auto auto auto; grid-row-gap: 7px;">
    				<a class="button" href="viewpets.php">View or edit your pets</a>
                    <a class="button" href="viewappointments.php">View or edit your appointments</a>
                    
    			</div>
            </div>
            
		</div>
	</body>
</html>