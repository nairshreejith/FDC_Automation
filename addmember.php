<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Add Member</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/png" href="img/logo.jpg">


	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/btn.css">
	<link rel="stylesheet" type="text/css" href="css/login.css">
	
	
	<style type="text/css">
		body{
			background-image: url('img/background.jpg');
			background-repeat: no-repeat;  
			background-size: 2000px;
		}


		input[type="checkbox"]{
			width: 1em;
			height:1.1em;
		}

		.login-box{
			height: 660px;
			margin-top:110px;
			width: 450px;
		}

	</style>
</head>
<body>
		<ul>
			<a href="fdcadminhome.php"><img src="img/logo.jpg" class="img"></a>
			<li><a href="fdcadminhome.php">Home</a></li>
			<li class="dropdown"><a href="#" class="dropbtn active">Member <i class="fa fa-caret-down"></i></a>
					<div class="dropdown-content">
					<a href="addmember.php" >Add Member</a>
					<a href="deletemember.php">Delete Member</a>
				</div>
			</li>
			<li><a href="specialrequest.php">Special Request</a></li>
			<li><a href="fdcadminhistory.php">History</a></li>
			<li><a href="conveyorcomment.php">Conveyor</a></li>

			<li style="float: right;"><a href="logout.php" onclick="preventBack()">Logout</a></li>
		</ul>


		<div class="login-box">
		<a href="addmember.php"><img src="img/logo.jpg" alt="KJSCE" class="avatar"></a>
			<h1 style="color: black;">Add Member</h1>
			<form action="add.php" method="POST">
				<label>Member Name:</label>
				<input type="text" name="mname" required autofocus><br>

				<label>Member Email: </label>
				<input type="text" name="memail" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"><br>

				<label>Member Type:</label><br>
				<p id="checkedValue" style="color: red; font-size: 15px;"></p><br>
					<input type = "checkbox" name = "mtype[]" value = "Faculty">Faculty<br>
					<input type = "checkbox" name = "mtype[]" value = "HOD">HOD<br>
					<input type = "checkbox" name = "mtype[]" value = "FDC Member">FDC Member<br>
					<input type = "checkbox" name = "mtype[]" value = "FDC Admin">FDC Admin<br>
					<input type = "checkbox" name = "mtype[]" value = "FDC Admin">Principal<br>

				<label>Password: </label>
				<input type="password" name="mpassword" required><br>
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

        		<input type="submit" value="Submit" id="check">
			</form>
	</div>
</body>

<script type="text/javascript">
	var btn = document.getElementById('check');
var msg = document.getElementById('checkedValue');
btn.addEventListener('click', function() {
  var len = document.querySelectorAll('.checkbox input[type="checkbox"]:checked').length
  if (len <= 0) {
    msg.innerHTML = "*Please check at least one";
  }
})
</script>