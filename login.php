<!DOCTYPE html>

<html>
	<head>
	
		<meta name="viewport" content="width=device-width, initial-scale=1">
	 	<link rel="stylesheet" href="styles.css">
	 	<title>Healthy Earth, Healthy Pets</title>
	
	</head>
	
	<?php 
	require_once('connection.php');
	?>
	
	<body>
	
	<form method="post">
	 
		<div class ="login" id="log">
			<h2><strong>Healthy Earth,<br>Healthy Pets</strong></h2>
			
			<label for="Email"><b>Email</b></label>
			<input type="Email" placeholder="Email" name="Email" required>
			
			<label for="password"><b>Password</b></label>
			<input type="Password" placeholder="Password" name="Password" required>
			
			<div style="display: inline-grid;margin: 3% auto auto auto; grid-row-gap: 7px;">
				<button type="submit">Login</button>
				<button type="button" onclick="signUp()">Don't have an accuont? Sign up!</button>
			</div>
	 	</div>
	 	
	</form>
	
	<form method="post">
	
		<div class="sign_up" id="sign-up">
			<h2><strong>Healthy Earth,<br>Healthy Pets</strong></h2>
			
			<label for="first_name"><b>First Name:</b></label>
			<input type="text" placeholder="First Name" name="first_name" required>
			
			<label for="last_name"><b>Last Name:</b></label>
			<input type="text" placeholder="Last Name" name="last_name" required>
			
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