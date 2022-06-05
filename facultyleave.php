<?php 
session_start();
?>
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
	<title>Leave Details</title>
</head>
<body>
	<div class="shade">
		<ul>
		<li><a href="facultyhome.php">Home</a></li>
		<li><a href="facultyleave.php">Apply For Training Program</a></li>
		<li><a href="status.php">Status</a></li>
		<li><a href="facultyspecialrequeststatus.php">Special Request Status</a></li>
		<li style="float:right"><a class="active" href="logout.php">Logout</a></li>
	</ul>
		<div class="avatar">
			<div class="form">
				<form action = "facultyleave.php" method = "POST" enctype = "multipart/form-data" class="myform">
					<center><p>
						<label>Name:
							<?php 
							echo $_SESSION['name'];
							?></label>
						</p>
						<p>
							<label>Email ID:
								<?php 
								echo $_SESSION['mail'];
								?></label>
							</p>
							<p>
								<label>Branch: 
									<?php 
									echo $_SESSION['branch'];?></label>
								</p>
								<?php

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
	$sql = "Select * from resource_data where Email = '$_SESSION[mail]'";
	$result = $conn->query($sql);
	if($result->num_rows>0)
	{
		while($row = $result->fetch_assoc())
		{
			echo "<p>
			<label>Number of Ods claimable: ".$row['ODs']."</label>
			</p>";
			echo "<p>
			<label>Amount claimable: ".$row['Amount']."</label>
			</p>";
		}
	}
}
?>
</center>

<div class="login-box">
<p>
	<label>Training Program:</label>
	<select required name = "type">
		<option value=""></option>
		<option>STTP</option>
		<option>Symposium</option>
		<option>Workshop</option>
		<option>Conference</option>
		<option>Seminar</option>
	</select>
</p>
<p>
	<label>Title:</label>
	<input type = "text" name = "title"  required>
</p>
<p>
	<label>Name of Organization:</label>
	<input type = "text" name = "name_organization" required>
</p>
<p>
	<label>Address of Organization:</label>
	<input type = "text" name = "address_organization" required>
</p>
<p>
	<label>Other Organizations:</label>
	<input type = "text" name = "other_organization" >
</p>
<p>
	<label>Special Request:</label>
	<input type = "radio" name = "srequest" value = "Yes" required >Yes
	<input type = "radio" name = "srequest" value = "No" >No
</p>
<p>
	<label>Training Start Date:</label>
	<input type = "date" name = "startdate" required>
</p>
<p>
	<label>Training End Date:</label>
	<input type = "date" name = "enddate" required>
</p>
<p>
	<label>Last date of registration:</label>
	<input type = "date" name = "lastdate" required>
</p>
<p>
	<label>Period:</label>
	<select name = "period"  required>
		<option value=""></option>
		<option>Non Vaction Period</option>
		<option>Vacation Period</option>
	</select>
</p>
<p>
	<label>Registration Fee:</label>
	<input type = "number" name = "fee"  required>
</p>
<p>
	<label>Amount Claimed:</label>
	<input type = "number" name = "amount" required>
</p>
<p>
	<label>Purpose:</label>
	<textarea rows = "3" cols = "25" name = "reason" maxlength = "400" required>
	</textarea>
</p>

<p class="wipeout">
	<input type="submit" value="Submit" name = "btn"/>
</p>
</form>
</div>
</div>
</div>
</div>
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	
	$type = $_POST['type'];
	$title = $_POST['title'];
	$name_organization = $_POST['name_organization'];
	$address_organization = $_POST['address_organization'];
	$other_organization = $_POST['other_organization'];
	$startdate = $_POST['startdate'];
	$enddate = $_POST['enddate'];
	//$ods = $_POST['ods'];
	$lastdate = $_POST['lastdate'];
	$period = $_POST['period'];
	$fee = $_POST['fee'];
	$amount = $_POST['amount'];
	$reason = $_POST['reason'];

	if(isset($_POST['srequest']))
	{
		$srequest = $_POST['srequest'];
	}

	$localhost = 'localhost';
	$username = 'root';
	$password = '';
	$db = 'fdc';

	$conn = mysqli_connect($localhost, $username, $password, $db);
	/*if($conn)
	{
		echo "Connection sucessful";
	}
	else
	{
		echo "Error".mysqli_connect_error();
	}*/

	

	$date1 = new DateTime($startdate);
	$date2 = new DateTime($enddate);
	$interval = $date1->diff($date2);
	$ods = $interval->days;	
	$flag = 0;

	$sqls = "Select Start_date from application_data where Email = '$_SESSION[mail]'";
	$results = $conn->query($sqls);
	if($results->num_rows>0)
	{
		while($rows = $results->fetch_assoc())
		{
			if($rows['Start_date'] == $startdate)
			{
				$flag = 1;
				break;			
			}
			else
			{}
		}
	}

	if($flag == 0)
	{
		$sql = "Insert into leave_data(Branch,Name,Email,Start_date,Number_of_ODs,Amount,Reason) values ('$_SESSION[branch]','$_SESSION[name]','$_SESSION[mail]','$startdate','$ods','$amount','$reason')";
		$result = $conn->query($sql);
		
		if($result)
		{
			header("Location: leavemessage.php");
			//header("Location: facultyhome.html");
		}
		else
		{
			header("Location: leavemessage1.php");
		}




		$sql2 = "Insert into fdc_leave_data(Branch,Faculty_Name,Faculty_Mailid,Start_date,Number_of_ODs,Amount,Reason,Special_Request) values ('$_SESSION[branch]','$_SESSION[name]','$_SESSION[mail]','$startdate','$ods','$amount','$reason','$srequest')";
		$result2 = $conn->query($sql2);

		/*if($result2)
		{
			echo "data inserted";
			//header("Location: facultyhome.html");
		}
		else
		{
			echo "data not inserted in fdc leave ";
		}*/



		$sql3 = "Insert into application_data(Name,Email,Branch,Type,Title,Name_of_Organization,Address_of_Organization,Other_Organizations,Start_date,End_date,Total_no_of_ods,Last_date_for_registration,Period,Registration_fee,Amount_claimed,Purpose,Special_Request) values ('$_SESSION[name]','$_SESSION[mail]','$_SESSION[branch]','$type','$title','$name_organization','$address_organization','$other_organization','$startdate','$enddate','$ods','$lastdate','$period','$fee','$amount','$reason','$srequest')";
		$result3 = $conn->query($sql3);

		/*if($result3)
		{
			echo "data inserted";
			//header("Location: facultyhome.html");
		}
		else
		{
			echo "data not inserted in application ";
		}*/



		$sql4 = "Insert into fdc_sanction_data(Faculty_Name,Faculty_Mail,Start_date,Branch,Special_Request) values ('$_SESSION[name]','$_SESSION[mail]','$startdate','$_SESSION[branch]','$srequest')";
		$result4 = $conn->query($sql4);
		
		/*if($result4)
		{
			echo "data inserted";
			//header("Location: facultyhome.html");
		}
		else
		{
			echo "data not inserted in sanction";
		}*/



		if($srequest == 'Yes')
		{
			$sql5 = "Insert into admin_sanction_data(Faculty_name, Faculty_Mail, Special_Ods, Special_Amount, Title, Start_date) values ('$_SESSION[name]','$_SESSION[mail]', '$ods', '$amount', '$title', '$startdate')";
			$result5 = $conn->query($sql5);

			/*if($result5)
			{
				echo "data inserted";
				//header("Location: facultyhome.html");
			}
			else
			{
				echo "data not inserted in sanction";
			}*/
		}
		
		
	}
	else
	{
		header("Location: leavemessage1.php");
	}
}
?>
</body>
</html>