<?php
/*
INSERT INTO `faculty`(`Name`, `Email`, `Date_of_Appoinment`, `Employee_Code`, `Number`, `Branch`, `MemberType`, `Password`) VALUES ('Admin', 'admin@gmail.com', '01/01/1999', 'one', '1234567890', 'IT', 'FDC Admin', 'aaa')
*/
session_start();
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$_SESSION['mail'] = $fmail = $_POST['mail'];
	$_SESSION['pass'] = $fpass = $_POST['password'];
	
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

	$ftype = "";
	$fbranch = "";

	$sql = "Select * from faculty where Email = '$fmail' and Password = '$_SESSION[pass]' and Inactive = '0'";
	$result = $conn->query($sql);
	if($result->num_rows>0)
	{
		while($row = $result->fetch_assoc())
		{
			$_SESSION['name'] = $row['Name'];
			if($row['Branch'] == '')
			{
				header("Location: facultydetails.php");
			}

			else
			{
				$_SESSION['name'] = $row['Name'];
				$_SESSION['branch'] = $row['Branch'];
				$ftype = $row['MemberType'];

				$type = explode(',', $ftype);
				$count = count($type);
				if($count > 1)
				{	
					echo "<form action = 'facultydetails3.php' method = 'GET'>";
					foreach ($type as $key) {
						if($key == 'FDC Member')
						{
							$key1 = 'FDC_Member';
						}
						else if($key == 'FDC Admin')
						{
							$key1 = 'FDC_Admin';	
						}
						else
						{
							$key1 = $key;
						}
						echo "<input type = 'radio' name = 'facultytype' value = ".$key1.">".$key;
					}
					echo "<input type = 'submit' value = 'Submit'></form>";
				}
				else
				{	
					echo "in";
					$type = implode('',$type);
					if($type == "Faculty")
					{
						header("Location: facultyhome.php");
					}
					else if($type == "HOD")
					{
						header("Location: hodhome.php");
					}
					else if($type == "FDC Member")
					{
						header("Location: fdchome.php");
					}
					else if($type == "FDC Admin")
					{
						header("Location: fdcadminhome.php");
					}
				}
			}
		}
	}
	else
	{
		$_SESSION['errMsg'] = "*Invalid Email or Password";
		header("Location: index.php");
	}

}
else
{
	header("Location: index.php");
}
?>