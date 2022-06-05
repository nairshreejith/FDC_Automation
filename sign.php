<?php
session_start();
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$_SESSION['name'] = $fname = $_POST['fname'];
	$fnumber = $_POST['fnumber'];
	$_SESSION['mail'] = $fmail = $_POST['fmail'];
	$_SESSION['branch'] = $fbranch = $_POST['fbranch'];
	$_SESSION['pass'] = $fpass = $_POST['fpass'];
	$fcpass = $_POST['fcpass'];

	$localhost = 'localhost';
	$username = 'root';
	$password = '';
	$db = 'fdc';

	$ods = 12;
	$amount = 12000;

	if(isset($_POST['ftype']))
	{
		$_SESSION['type'] = $ftype = $_POST['ftype'];
	}

	$conn = mysqli_connect($localhost, $username, $password, $db);
	if($conn)
	{
		echo "Connection sucessful";
	}
	else
	{
		echo "Error".mysqli_connect_error();
	}

	/*function prompt($message){
		echo("<script type='text/javascript'> var answer = prompt('".$message."'); </script>");
		$answer = "<script type='text/javascript'> document.write(answer); </script>";
		return($answer);
	}*/
	if($fpass != $fcpass)
	{
		/*$m = "Wrong input";		
		$msg = prompt($m);
		echo "$msg";
		*/
		header("Location: signin.html");
	}
	else
	{

		$flag = 0;

		$sql = "Select * from faculty where Email = '$fmail'";
		$result = $conn->query($sql);
		if($result->num_rows>0)
		{
			$flag = 1;
		}

		if($flag == 0)
		{
			$sql = "Insert into faculty(Name,Email,Number,Branch,MemberType,Password) values('$fname', '$fmail', '$fnumber', '$fbranch', '$ftype', '$fpass')";
			$result = $conn->query($sql);
			if($result)
			{
				$sql2 = "Insert into resource_data(Name,Email,ODs,Amount) values('$fname', '$fmail','$ods','$amount')";
				$result2 = $conn->query($sql2);
				if($result2)
				{
					echo "data inserted";
					if($ftype == "Faculty")
					{
						header("Location: facultyhome.html");
					}
					else if($ftype == "HOD")
					{
						header("Location: hodhome.html");
					}
					else if($ftype == "FDC Member")
					{
						header("Location: fdchome.html");
					}
					else if($ftype == "FDC Admin")
					{
						header("Location: fdcadmin.php");
					}
				}
				else
				{
					echo "second not working";
				}
			}
			else
			{
				echo "cant insert";
			}
		}
		else
		{
			echo "duplicate found";
		}
	}
}
?>