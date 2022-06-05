<?php
session_start();
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$localhost = 'localhost';
	$username = 'root';
	$password = '';
	$db = 'fdc';

	$oldpassword = $_POST['oldpassword'];

	if($_POST['fpass'] == $_POST['fcpass'])
	{
		$npassword = $_POST['fpass'];
		$_SESSION['pass'] = $cpassword = $_POST['fcpass'];
		$_SESSION['branch'] = $branch = $_POST['fbranch'];
		$number = $_POST['fnumber'];
		$date = $_POST['date'];
		$ecode = $_POST['ecode'];
	}
	else
	{
		header("Location: facultydetails.php");
	}

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

	$sql = "Select * from faculty where Email = '$fmail' and Password = '$oldpassword'";
	$result = $conn->query($sql);
	if($result->num_rows>0)
	{
		while($row = $result->fetch_assoc())
		{
			$ftype = $row['MemberType'];
			$sql1 = "Update faculty set Password = '$npassword', Number = '$number', Branch = '$branch', Date_of_Appoinment = '$date', Employee_Code = '$ecode' Where Email = '$fmail'";
			$result1 = $conn->query($sql1);
			if($result1)
			{
				
				$ftype = $row['MemberType'];
				if($ftype == "Faculty")
				{
					header("Location: facultyhome.php");
				}
				else if($ftype == "HOD")
				{
					header("Location: hodhome.php");
				}
				else if($ftype == "FDC Member")
				{
					header("Location: fdchome.php");
				}
				else if($ftype == "FDC Admin")
				{
					header("Location: fdcadminhome.php");
				}
			}
			else
			{
				header("Location: updationerror.php");
			}
		}
	}
	else
	{
		header("Location: incorrectpass.php");
	}
}
else
{
	header("Location: facultydetails.php");
	//echo "error in first";
}
?>