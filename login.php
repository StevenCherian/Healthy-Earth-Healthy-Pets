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
                background: #2a9d8f;
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
	
	<body>
	
    	<div class="myheader">
      		<h2>Healthy Earth, Healthy Pets</h2>
    	</div>
    	
    	<div class=sign-in-info>
    		<h4>Admin Email: JebronLames.va@gmail.com | Password: loVE^U^Lebron</h4>
    		<h4>Customer Email: steQueen@gmail.com | Password: S!Q117A</h4>
    	</div>
    	
    	<div class="login-container">
        	<form method="post" action="connection.php">	 
        		<div class ="login" id="log">
        			<h2><strong>Log in to your account</strong></h2>
        			
        			<label for="Email"><b>Email</b></label>
        			<input type="Email" placeholder="Email" name="Email_Address" required>
        			
        			<label for="password"><b>Password</b></label>
        			<input type="Password" placeholder="Password" name="User_Password" required>
        			
        			<div style="display: inline-grid;margin: 3% auto auto auto; grid-row-gap: 7px;">
        				<button type="submit">Login</button>
        				<button type="button" onclick="signUp()">Don't have an account? Sign up!</button>
        			</div>
        	 	</div>
        	</form>
        	
        	<form method="post" action="signup.php">
        		<div class="sign_up" id="sign-up">
        			<h2><strong>Create an account</strong></h2>
        			
        			<label for="first_name"><b>First Name:</b></label>
        			<input type="text" maxlength="25" placeholder="First Name" name="First_Name" required>
        			
        			<label for="last_name"><b>Last Name:</b></label>
        			<input type="text" maxlength="25" placeholder="Last Name" name="Last_Name" required>
        			
        			<label for="email"><b>Email:</b></label>
        			<input type="text" maxlength="50" placeholder="Email" name="Email_Address" required>
        			
        			<label for="password"><b>Password:</b></label>
        			<input type="text" maxlength="100" placeholder="Password" name="User_Password" required>
        			
        			<div style="display: inline-grid;margin: 3% auto auto auto;grid-row-gap: 7px;">
        				<button type="submit">Create Account</button>
        				<button type="button" onclick="login()">Go back</button>
        			</div>
        		</div>
        	</form>
        	
        	<script>
        		
        		function signUp() {
        			document.getElementById('sign-up').style.display='grid';
        			document.getElementById('log').style.display='none';
        		}
        		
        		function login() {
        			document.getElementById('log').style.display='grid';
        			document.getElementById('sign-up').style.display='none';
        		}
        	
        	</script>
		</div>
	</body>
</html>