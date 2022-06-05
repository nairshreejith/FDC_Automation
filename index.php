<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>KJSCE Login</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/btn.css">
	<link rel="stylesheet" type="text/css" href="css/login.css">
	<link rel="icon" type="image/png" href="img/logo.jpg">
	<style type="text/css">
		body{
			background-image: url('img/background.jpg');
			background-repeat: no-repeat;  
			background-size: cover;
		}
	</style>
</head>
<body>
	<div>
		<ul>
			<a href="home.php"><img src="img/logo.jpg" class="img"></a>
			<li><a href="home.php">Home</a></li>
			<li><a href="about.php">About</a></li>
			<li><a href="contact.php">Contact Us</a></li>
			<li style="float: right;"><a href="index.php" class="active">Login</a></li>
		</ul>
	</div>
	<div class="login-box">
		<a href="index.php"><img src="img/logo.jpg" alt="KJSCE" class="avatar"></a>
			<h1>Login</h1>
			<form action="login.php" method="POST">
				
				<input type = "text" name = "mail" placeholder="Email" autofocus required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
				
				<input type = "password" name = "password" placeholder="Password" required>

				<p style="color: red;">
				<?php
				if(isset($_SESSION["errMsg"]))
				{
						$errMsg = $_SESSION["errMsg"];
                        echo "<span>$errMsg</span>";
                }
				?>
				</p>
				<?php
   					 unset($_SESSION["errMsg"]);
				?>
				<input type = "submit" value = "Submit" onclick="validation()">
				<a href="#">Forgot Password?</a>
			</form>
	</div>
</body>
</html>