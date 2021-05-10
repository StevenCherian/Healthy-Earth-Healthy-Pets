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
            }       

            button {
              background-color: #2a9d8f;
              color: white;
              padding: 10px 25px;
              margin: 0 auto;
              border: 2px solid #404041;
              border-radius: 14px;
              cursor: pointer;
            }

            input {
                border-radius: 10px;
                border: green;
                padding: 5px 3px 4px 7px;
                margin: 5px 3px 15px 0px;
                font-size: inherit;
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
		<form method="post" action="submitappointment.php">
    		<div id="createAppointmentPopup" style="width:85%; max-width:500px; z-index:100; display:none; padding-top:65px;">
        		<input value="start_time" placeholder="start time">
        		
        		<button type="submit">Create Appointment</button>
    		</div>
		</form>
        <div class="header">
          <a href="#default" class="logo">Healthy Earth, Healthy Pets</a>
          <div class="header-right">
            <a class="active" href="main.php">Home</a>
            <a href="contact.php">Contact</a>
            <a href="myaccount.php">My Account</a>
            <a href="logout.php">Logout</a>
          </div>
        </div>
    	
    	<div class="main-container">	 
        		<div class ="welcome" id="log">
        			<h3><strong>Welcome to Healthy Earth, Healthy Pets!</strong></h3>        			
                </div>
                    
                <h4>We aim to provide quality care to your pets!<br>Contact us or create an account and schedule an appointment to get started.</h4>       			
        			
    		    <div style="display: inline-grid;margin: 3% auto auto auto; grid-row-gap: 7px;">
    				<button onclick="openAppointmentPopup()">Schedule an appointment</button>
    			</div>
		</div>
		<script>
			function openAppointmentPopup() {
				document.findElementByID("createAppointmentPopup").style.display="grid";
			}
			
			function openAppointmentPopup() {
				document.findElementByID("createAppointmentPopup").style.display="none";
			}			
		</script>
	</body>
</html>