<!DOCTYPE html>

<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
	 	<link rel="stylesheet" href="styles.css">
	 	<title>Healthy Earth, Healthy Pets</title>
	 	
	 	<style>
/*     	 	body { */
/*                 margin: 1%; */
/*                 margin-block: auto; */
/*                 font-family: sans-serif; */
/*                 animation: fadeInAnimation ease .6s; */
/*                 animation-iteration-count: 1; */
/*                 animation-fill-mode: forwards; */
/*             } */

/*             @keyframes fadeInAnimation { */
/*                 0% { */
/*                     opacity: 0; */
/*                 } */
/*                 100% { */
/*                     opacity: 1; */
/*                 } */
/*             } */
	 	 
        </style>
	</head>
	
	<?php 
	require_once('connection.php');
	?>
	
	<body>
	
    	<div class="myheader" id="myHeader">
      		<h2>Healthy Earth, Healthy Pets</h2>
    	</div>
    	
    	<form method="post">	 
    		<div class ="login" id="log">
    			<h2><strong>Log in to your account</strong></h2>
    			
    			<label for="Email"><b>Email</b></label>
    			<input type="Email" placeholder="Email" name="Email" required>
    			
    			<label for="password"><b>Password</b></label>
    			<input type="Password" placeholder="Password" name="Password" required>
    			
    			<div style="display: inline-grid;margin: 3% auto auto auto; grid-row-gap: 7px;">
    				<button type="submit">Login</button>
    				<button type="button" onclick="signUp()">Don't have an account? Sign up!</button>
    			</div>
    	 	</div>
    	</form>
    	
    	<form method="post">
    		<div class="sign_up" id="sign-up">
    			<h2><strong>Create an account</strong></h2>
    			
    			<label for="first_name"><b>First Name:</b></label>
    			<input type="text" placeholder="First Name" name="first_name" required>
    			
    			<label for="last_name"><b>Last Name:</b></label>
    			<input type="text" placeholder="Last Name" name="last_name" required>
    			
				<label for="username"><b>Username::</b></label>
    			<input type="text" placeholder="Username" name="Username" required>
    			
    			<label for="email"><b>Email:</b></label>
    			<input type="text" placeholder="Email" name="Email" required>
    			
    			<label for="password"><b>Password:</b></label>
    			<input type="text" placeholder="Password" name="Password" required>
    			
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
	
	</body>
</html>