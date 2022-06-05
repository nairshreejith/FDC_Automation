<?php
//session_start();

$fmail = $_SESSION['mail'];

$localhost = 'localhost';
$username = 'root';
$password = '';
$db = 'fdc';


$conn = mysqli_connect($localhost, $username, $password, $db);
if($conn)
{
	echo "Connection sucessful";
}
else
{
	echo "Error".mysqli_connect_error();
}

$sql = "Select * from faculty where Email = '$fmail'";
$result = $conn->query($sql);
if($result->num_rows>0)
{
	while($row = $result->fetch_assoc())
	{
		$ftype = $row['MemberType'];
		$type = explode(',', $ftype);
		$count = count($type);
		if($count > 1)
		{	
			foreach ($type as $key)
			{
				if($key == 'Faculty')
					echo "<li><a href='facultyhome.php'>Faculty</a></li>";
				if($key == 'HOD')
					echo "<li><a href='hodhome.php'>HOD</a></li>";
				if($key == 'FDC Member')
					echo "<li><a href='fdchome.php'>FDC Member</a></li>";
				if($key == 'FDC Admin')
					echo "<li><a href='fdcadminhome.php'>FDC admin</a></li>";
			}
		}
	}
}
?>