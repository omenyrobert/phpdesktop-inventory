<?php
 session_start();

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
	</head>
<body style="background-color: #f9f9f9;">
	<div style="display: flex;">
		
		<div>
			<div style="background-color: #ffffff; display: flex; width: 1500px; justify-content: center;">
		<img src="logo.png" style="width: 150px; "><h1 style="color: #e810c7; margin-top: 50px;"><b>Stock Management/ Inventory System</b></h1>
	</div>
	</div>
</div>
	
	<center>
		<div style="background-color: #e810c7; width: 500px; padding-top: 50px; margin-top: 50px; padding-bottom: 100px; ">
			<!-- Login Form Starts -->
			<form method="POST"  action="login_query.php">	
				<h1 style="color: #ffffff; font-size: 40px;">LOGIN</h1>
				<div class="form-group">
					<label style="color: black;">Username</label><br/>
					<input type="text" name="username"  style=" width: 200px; border:none; padding: 10px; border-radius: 50px;" required="required"/>
				</div>
				<div class="form-group">
					<label style="color: black;">Password</label><br/>
					<input type="password" name="password"  style=" width: 200px; border:none; padding: 10px; border-radius: 50px;" required="required"/>
				</div>
				<?php
					//checking if the session 'error' is set. Erro session is the message if the 'Username' and 'Password' is not valid.
					if(ISSET($_SESSION['error'])){
				?>
				<!-- Display Login Error message -->
					<div class="alert alert-danger"><?php echo $_SESSION['error']?></div>
				<?php
					//Unsetting the 'error' session after displaying the message. 
					session_unset($_SESSION['error']);
					}
				?><br/>
				<button style="color: #ffffff; background-color: black; width: 220px; border:none; padding: 10px; border-radius: 50px;" name="login">Login</button>
			</form>	
			<!-- Login Form Ends -->
		</div>
	</center>
	</div>
</body>
</html>