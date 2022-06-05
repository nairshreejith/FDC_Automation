<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/png" href="img/logo.jpg">


	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/btn.css">
	<link rel="stylesheet" type="text/css" href="css/table.css">
	<title>Accepted/rejected</title>
</head>
<body>
	<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	require 'vendor/autoload.php';
	session_start();
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
		/*
	//Create a new PHPMailer instance
		$mail = new PHPMailer;
//Tell PHPMailer to use SMTP
		$mail->isSMTP();
//Enable SMTP debugging
// SMTP::DEBUG_OFF = off (for production use)
// SMTP::DEBUG_CLIENT = client messages
// SMTP::DEBUG_SERVER = client and server messages
		$mail->SMTPDebug = SMTP::DEBUG_SERVER;
//Set the hostname of the mail server
		$mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6
//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
		$mail->Port = 465;
//Set the encryption mechanism to use - STARTTLS or SMTPS
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
//Whether to use SMTP authentication
		$mail->SMTPAuth = true;

*/
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

	$values = $_POST['abc'];
	foreach ($values as $key) 
	{
		$arr = explode(',',$key);
		
		$mid = $arr[0];
		$startdate = $arr[1];
		$remark = $arr[2];
	
		
		//echo "$remark";
		//$sql = "Insert into leave_data(HOD_name,HOD_email,HOD_Remark) values ('$_SESSION[name]','$_SESSION[mail]',$remark)";
		
		$flag1 = 0;
		$flag2 = 0;


		if($flag1 == 0 && $flag2 == 0)
		{
			$sql = "Update fdc_leave_data Set Conveyor_Remark = '$remark' Where Faculty_Mailid = '$mid' and Start_Date = '$startdate'";
			$result = $conn->query($sql);
			if($result)
			{
				
			}
			else
			{
				echo "data not inserted";
			}

			$sql = "Update fdc_sanction_data Set Conveyor_Remark = '$remark' Where Faculty_Mail = '$mid' and Start_Date = '$startdate'";
			$result = $conn->query($sql);
			if($result)
			{
				/*header("Location: fdchome.php");*/
			}
			else
			{
				echo "select not working";
			}

			if($remark == 'Accept')
			{
				$ods_sanctioned = 0;
				$amount_sanctioned = 0;

				$sql = "Select Amount_Sanctioned, ODs_sanctioned from fdc_sanction_data Where Faculty_Mail = '$mid' and Start_Date = '$startdate'";
				$result = $conn->query($sql);
				if($result->num_rows>0)
				{
					while($row = $result->fetch_assoc())
					{
						$ods_sanctioned = $row['ODs_sanctioned'];
						$amount_sanctioned = $row['Amount_Sanctioned'];
					}
				}

				$sql = "Update resource_data Set ODs = ODs - '$ods_sanctioned', Amount = Amount - '$amount_sanctioned' where Email = '$mid'";
				$result = $conn->query($sql);

				/*
				//Username to use for SMTP authentication - use full email address for gmail
				//$mail->Username = 'test.wp.alti@gmail.com';
				$mail->Username = 'shreejithsample@gmail.com';
				//Password to use for SMTP authentication
				//$mail->Password = '';
				$mail->Password = '';
				//Set who the message is to be sent from
				$mail->setFrom('shreejithsample@gmail.com', 'Admin');
				//Set an alternative reply-to address
				$mail->addReplyTo('replyto@example.com', 'First Last');
				//Set who the message is to be sent to
				//$mail->addAddress('test.wp.alti@gmail.com', 'John Doe');
				//$mail->addAddress('shreejithsample@gmail.com', 'John Doe');
				$mail->addAddress($mid, 'FACULTY');
				//Set the subject line
				$mail->isHTML(true);        
				$mail->Subject = 'Status For your Leave/ODs Application';
				$mail->Body = "Your status is: Accepted <br> ODs sanctioned:  '$ods_sanctioned' <br> Amount sanctioned: '$amount_sanctioned' "; 
				//Read an HTML message body from an external file, convert referenced images to embedded,
				//convert HTML into a basic plain-text alternative body

				//Replace the plain text body with one created manually
				$mail->AltBody = 'This is a plain-text message body';
				//Attach an image file

				//send the message, check for errors
				if (!$mail->send())
				{
					echo 'Mailer Error: '. $mail->ErrorInfo;
				} 
				else 
				{
					echo 'Message sent!';
				    //Section 2: IMAP
				    //Uncomment these to save your message in the 'Sent Mail' folder.
				    #if (save_mail($mail)) {
				    #    echo "Message saved!";
				    #}
				}
				*/
			}
			else if($remark == 'Reject')
			{
				
				/*
				//Username to use for SMTP authentication - use full email address for gmail
				//$mail->Username = 'test.wp.alti@gmail.com';
				$mail->Username = 'shreejithsample@gmail.com';
				//Password to use for SMTP authentication
				//$mail->Password = '';
				$mail->Password = '';
				//Set who the message is to be sent from
				$mail->setFrom('shreejithsample@gmail.com', 'Admin');
				//Set an alternative reply-to address
				$mail->addReplyTo('replyto@example.com', 'First Last');
				//Set who the message is to be sent to
				//$mail->addAddress('test.wp.alti@gmail.com', 'John Doe');
				//$mail->addAddress('shreejithsample@gmail.com', 'John Doe');
				$mail->addAddress($mid, 'FACULTY');
				//Set the subject line
				$mail->isHTML(true);        
				$mail->Subject = 'Status For your Leave/ODs Application';
				$mail->Body = "Your status is: Rejected"; 
				//Read an HTML message body from an external file, convert referenced images to embedded,
				//convert HTML into a basic plain-text alternative body

				//Replace the plain text body with one created manually
				$mail->AltBody = 'This is a plain-text message body';
				//Attach an image file

				//send the message, check for errors
				if (!$mail->send())
				{
					echo 'Mailer Error: '. $mail->ErrorInfo;
				} 
				else 
				{
					echo 'Message sent!';
				    //Section 2: IMAP
				    //Uncomment these to save your message in the 'Sent Mail' folder.
				    #if (save_mail($mail)) {
				    #    echo "Message saved!";
				    #}
				}
				*/
			}
			if($result)
			{
				header("Location: fdcadminhome.php");
			}
			else
			{	
				$_SESSION['err'] = "*Update is not working.";
				header("Location: conveyorcomment.php");
			}
		}
		
		else
		{
			$_SESSION['errMsg'] = "*Number of ODs or Amount Sanctioned is More.";
			header("Location: conveyorcomment.php");
		}
	}
}
else
{
	header("Location: fdcadminhome.php");
}
?>
</body>
</html>

