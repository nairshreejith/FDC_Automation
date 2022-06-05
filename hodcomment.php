<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/png" href="img/logo.jpg">


	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/btn.css">
	<link rel="stylesheet" type="text/css" href="css/table.css">


	<style type="text/css">
		body{
			background-image: url('img/background.jpg');
			background-repeat: no-repeat;  
			background-size: cover;
		}
		</style>
	<title>Comment</title>
</head>
<body>
	<div class="shade">
	<ul>
		<li><a href="hodhome.php">Home</a></li>
		<li><a href="hodrequest.php">Pending Requests</a></li>
		<li><a href="hodhistory.php">History</a></li>
		<li><a href="hodspecialrequestview.php">Special Requests</a></li>
		<li style="float:right"><a class="active" href="logout.php" onclick="preventBack()">Logout</a></li>
	</ul>
		
		<div class="blackboard">
			<div class="form">
				<form action = hodcomment2.php method = 'POST' class="myform">
					<?php
					session_start();
					//$_SESSION['facultymail'] = $facultymail = $_GET['id'];
					$temp = $_GET['id'];
					$arr = explode(",", $temp);
					$_SESSION['facultymail'] = $facultymail = $arr[0];
					$_SESSION['startdate'] = $startdate = $arr[1];
					if($_SERVER['REQUEST_METHOD'] == 'GET')
					{
						$localhost = 'localhost';
						$username = 'root';
						$password = '';
						$db = 'fdc';

						$conn = mysqli_connect($localhost, $username, $password, $db);
						/*if($conn)
						{
							//echo "Connection sucessful";
						}
						else
						{
							echo "Error".mysqli_connect_error();
						}
						*/
						$dbh = new PDO("mysql:host=localhost;dbname=fdc","root","");

						$sql = "Select * from application_data WHERE Email = '$facultymail' and Start_date = '$startdate'";
						$result = $conn->query($sql);
						if($result->num_rows>0)
						{
							while($row = $result->fetch_assoc())
							{
								echo"<p>
										<label>Name: ".$row['Name'].
										"</label>
									</p>".
									"<p>
										<label>Branch: ".$row['Branch'].
										"</label>
									</p>".
									"<p>
										<label>Email id: ".$row['Email'].
										"</lable>
									</p>".
									"<p>
										<label>Type of Program: ".$row['Type'].
										"</label>
									</p>".
									"<p>
										<label>Title: ".$row['Title'].
										"</label>
									</p>".
									"<p>
										<label>Name of Organization: ".$row['Name_of_Organization'].
										"</label>
									</p>".
									"<p>
										<label>Address of Organization: ".$row['Address_of_organization'].
										"</label>
									</p>".
									"<p>
										<label>Other Organizations: ".$row['Other_Organizations'].
										"</label>
									</p>".
									"<p>
										<label>Special Request: ".$row['Special_Request'].
										"</label>
									</p>".					
									"<p>
										<label>Training Start Date: ".$row['Start_date'].
										"</label>
									</p>".
									"<p>
										<label>Training End Date:".$row['End_date'].
										"</label>
									</p>".
									"<p>
										<label>Number of Days: ".$row['Total_no_of_ods'].
										"</label>
									</p>".
									"<p>
										<label>Last date of Registration: ".$row['Last_date_for_registration'].
										"</label>
									</p>".
									"<p>
										<label>Period: ".$row['Period'].
										"</label>
									</p>".
									"<p>
										<label>Registration fee: ".$row['Registration_fee'].
										"</label>
									</p>".
									"<p>
										<label>Period: ".$row['Period'].
										"</label>
									</p>".
									"<p>
										<label>Amount Claimed: ".$row['Amount_claimed'].
										"</label>
									</p>".
									"<p>
										<label>Reason: ".$row['Purpose'].
										"</label>
									</p>";


								$stat = $dbh->prepare("Select * from leave_data_files where Email = '$facultymail'");
								$stat->execute();
								while($roww = $stat->fetch())
								{
									echo"<p>
											<a target = '_blank' href = 'viewfile.php?id=".$roww['Email']."'>".$roww['file_name']."</a>
										</p>";
								}

								echo "<p>
										<label>Remark:
										</label>
										<select name = 'remark'>
											<option>Recommended</option>
											<option>Not Recommended</option>
										</select>
									</p>";
								echo "<p>
										<label>Reason for Remark:
										<label>
										<textarea rows = '4' cols = '40' name = 'remarkreason' maxlength = '400'>
										</textarea>
									</p>";
		}
	}

}
?>
					<p class="wipeout">
						<input type= "submit" value = "submit">
					</p>
				</form>
</body>
</html>