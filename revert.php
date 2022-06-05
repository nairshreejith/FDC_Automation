<?php 
session_start()
?>

<!DOCTYPE html>
<html>
<head>
</head>
<body>
		<?php
		
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
			$facultymail = $_SESSION['mail'];
			$sql = "Select * from reverted_applications";
			$result = $conn->query($sql);
			if($result->num_rows>0)
			{
				echo "<p style='text-align: center;  font-size: 20px;'><label>Reverted </label></p>";
				echo "<table border = '1 solid black'>
					<tr>
						<td>Title</td>
						<td>Start Date</td>
						<td>ODs</td>
						<td>Amount Claimed</td>
						<td>FDCmember Comment</td>
					</tr>";
				while($row = $result->fetch_assoc())
				{

					echo "<tr><td>".$row['Title']."</td>".
					"<td>".$row['Start_Date']."</td>".
					"<td>".$row['ODs']."</td>".
					"<td>".$row['Amount']."</td>".
					"<td>".$row['FDCM_Remark_Reason']."</td></tr>";
					//"<td>ndxhjbfd</td></tr>";
					//'<td><a href = "status2.php?id='.$temp.'">View</a></td></tr>';
				
				}
			}
		?>
</body>
</html>