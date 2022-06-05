<!DOCTYPE HTML>
<html>
<head>

<link rel="stylesheet" type="text/css" href="button.css">
<link rel="stylesheet" type="text/css" href="blackboard.css">
	<style type="text/css">

		.myform{
			color: white;
			font-size: 15px;
			padding: 70px 20px 20px;
		}

		.blackboard:before {
		box-sizing: border-box;
		display: block;
		position: absolute;
		width: 100%;
		height: 100%;
		background-image: linear-gradient( 175deg, transparent, transparent 40px, rgba(120, 120, 120, 0.1) 100px, rgba(120, 120, 120, 0.1) 110px, transparent 220px, transparent), linear-gradient( 200deg, transparent 80%, rgba(50, 50, 50, 0.3)), radial-gradient( ellipse at right bottom, transparent, transparent 200px, rgba(80, 80, 80, 0.1) 260px, rgba(80, 80, 80, 0.1) 320px, transparent 400px, transparent);
		border: #2c2c2c solid 2px;
		content: "Add";
		font-family: 'Permanent Marker', cursive;
		font-size: 2.2em;
		color: rgba(238, 238, 238, 0.7);
		text-align: center;
		padding-top: 20px;
}

	</style>
</head>
<body style="background-image: url('laptop.jpg');
	background-repeat: no-repeat;  background-size: 1500px 800px;">

		
<div class="shade">
	<div class="grid">
		<div class="item">
			<a style="margin-right: 5px;" href="deletemember.php">Delete Member</a>

			&nbsp&nbsp

			<a style="margin-right: 5px;" href="specialrequest.php">Special Request</a>
		

			<a style="margin-left: 830px;" href="logout.php">Logout</a>
		</div>
	</div>
		<div class="blackboard">
				<div class="form">
					<form action="add.php" method="post" class="myform">
						<p>
								<label>Member Name: </label>
								<input type="text" name="mname">
						</p>
						<p>
								<label>Member Email: </label>
								<input type="text" name="memail">
						</p>
						<p>
								<label>Member Type: </label><br>
								<input type = "radio" name = "mtype" value = "Faculty">Faculty
								<br>
								<input type = "radio" name = "mtype" value = "HOD">HOD
								<br>
								<input type = "radio" name = "mtype" value = "FDC Member">FDC Member
								<br>
								<input type = "radio" name = "mtype" value = "FDC Admin">FDC Admin
						</p>
						<p>
								<label>Password: </label>
								<input type="text" name="mpassword">
						</p>
						<p class="wipeout">
								<input type="submit" value="Submit" />
						</p>

					</form>
				</div>
		</div>
</div>

</body>
</html>