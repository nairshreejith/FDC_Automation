<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="button.css">
	<link rel="stylesheet" type="text/css" href="blackboard.css">


	<script type="text/javascript">
		function preventBack() { window.history.forward(); }
		setTimeout("preventBack()", 0);
		window.onunload = function () { null };

	</script>

	<style type="text/css">
		.myform{
			color: white;
			font-size: 15px;
			padding: 70px 20px 20px;
		}
		body{
			background-image: url('laptop.jpg');
			background-repeat: no-repeat;  
			background-size: 1500px 800px;
		}

		select{
			width: 5em;
			height:2.2em;
		}

		.blackboard:before {
			box-sizing: border-box;
			display: block;
			position: absolute;
			width: 100%;
			height: 100%;
			background-image: linear-gradient( 175deg, transparent, transparent 40px, rgba(120, 120, 120, 0.1) 100px, rgba(120, 120, 120, 0.1) 110px, transparent 220px, transparent), linear-gradient( 200deg, transparent 80%, rgba(50, 50, 50, 0.3)), radial-gradient( ellipse at right bottom, transparent, transparent 200px, rgba(80, 80, 80, 0.1) 260px, rgba(80, 80, 80, 0.1) 320px, transparent 400px, transparent);
			border: #2c2c2c solid 2px;
			content: "";
			font-family: 'Permanent Marker', cursive;
			font-size: 2.2em;
			color: rgba(238, 238, 238, 0.7);
			text-align: center;
			padding-top: 20px;
		}

		input[type="number"]{
			width: 3em;
		}

	</style>
	<title>User details</title>
	
</head>
<body>
	<div class="shade">
	<ul>
		<li><a href="facultydetails.php">Edit Details</a></li>
		<li style="float:right;"><a class="active" href="logout.php" onclick="preventBack()">Logout</a></li>
	</ul>

		<?php
		session_start();
		if($_SERVER['REQUEST_METHOD'] == 'GET')
		{
			$localhost = 'localhost';
			$username = 'root';
			$password = '';
			$db = 'fdc';

			$conn = mysqli_connect($localhost, $username, $password, $db);
	/*if($conn)
	{
		echo "Connection sucessful<br>";
	}
	else
	{
		echo "Error".mysqli_connect_error();
	}*/

	$fmail = $_SESSION['mail'];

	$sql = "Select * from faculty Where Email = '$fmail'";
	$result = $conn->query($sql);
	if($result->num_rows > 0)
	{
		while($row = $result->fetch_assoc())
		{
			?>


			<div class="blackboard">
				<div class="form">
					<p><label>
						<?php echo "Welcome ".$row['Name']."!";
						echo "<br>Email: ".$row['Email']; ?></label></p>
						<?php 
					}
				}
			}
			?>


			<form action = "facultydetails2.php" method = "POST" class="myform">
				<p>
					<label>Employee Code:</label>
					<input type = "number" name = "ecode" required>
				</p>
				<p>
					<label>Date of Appointment:</label>
					<input type = "date" name = "date" required>
				</p>
				<p>
					<label>Branch:</label>
					<select name = "fbranch" required>
						<option value=""></option>
						<option>Comps</option>
						<option>IT</option>
						<option>Mech</option>
						<option>EXTC</option>
						<option>ETRX</option>
					</select>
				</p>
				<p>
					<label>Phone No:</label>
					<input type = "text" name = "fnumber" required pattern="[789][0-9]{9}">
				</p>
				<p>
					<label>Old Password:</label>
					<input type = "password" name = "oldpassword" >
				</p>
				<p>
					<label>New Password:</label>
					<input type = "password" name = "fpass" id="pass">
				</p>
				<p>
					<label>Enter Password Again:</label>
					<input type = "password" name = "fcpass" id="cpass">
				</p>
				<p class="wipeout">
					<input type = "submit" value = "Submit" style="font-size: 20px" id="btnSubmit">
				</p>
			</form>
		</div>
	</div>
</div>
</body>
</html>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">
$(function () {
        $("#btnSubmit").click(function () {
            var password = $("#pass").val();
            var confirmPassword = $("#cpass").val();
            if (password != confirmPassword) {
                alert("Passwords do not match.");
                return false;
            }
            return true;
        });
    });

</script>