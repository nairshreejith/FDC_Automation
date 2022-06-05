<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="background.css">
	<link rel="stylesheet" type="text/css" href="table.css">
	<link rel="stylesheet" type="text/css" href="logoutcss.css">
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

		$remark = $_POST['remark'];
		$remark_reason = $_POST['remark_reason'];
		$amount_sanctioned = $_POST['amount_sanctioned'];
		$ods_sanctioned = $_POST['ods_sanctioned'];
		$date_of_meeting = $_POST['date_of_meeting'];

		$conn = mysqli_connect($localhost, $username, $password, $db);
	/*if($conn)
	{
		echo "Connection sucessful";
	}
	else
	{
		echo "Error".mysqli_connect_error();
	}*/

	$mid = $_SESSION['facultymail'];
	$startdate = $_SESSION['startdate'];
	$title = $_SESSION['title'];

	//echo "$remark";
	//$sql = "Insert into leave_data(HOD_name,HOD_email,HOD_Remark) values ('$_SESSION[name]','$_SESSION[mail]',$remark)";
	
	$flag1 = 0;
	$flag2 = 0;

	$sql1 = "Select * from resource_data Where Email = '$mid'";
	$result1 = $conn->query($sql1);
	if($result1->num_rows>0)
	{
		while($row1 = $result1->fetch_assoc())
		{
			if(($row1['ODs'] - $ods_sanctioned >= 0) && ($row1['Amount'] - $amount_sanctioned >= 0) )
			{
				$flag1 = 0;
			}
			else
			{
				$flag1 = 1;
			}
		}
	}

	$sql3 = "Select * from application_data Where Email = '$mid' and Start_Date = '$startdate'";
	$result3 = $conn->query($sql3);
	$requestedods = 0;
	$requestedamount = 0;

	if($result3->num_rows>0)
	{
		while($row3 = $result3->fetch_assoc())
		{
			$requestedods = $row3['Total_no_of_ods'];
			$requestedamount = $row3['Amount_claimed'];
			if(($row3['Total_no_of_ods'] - $ods_sanctioned >= 0) && ($row3['Amount_claimed'] - $amount_sanctioned >= 0))
			{
				$flag2 = 0;
			}
			else
			{
				$flag2 = 1;
			}
		}
	}
	else
	{
		//echo "Error";
	}

	if($flag1 == 0 && $flag2 == 0)
	{
		$sql = "Update fdc_leave_data Set FDCM_name = '$_SESSION[name]', FDCM_mail = '$_SESSION[mail]', FDCM_Remark = '$remark', FDCM_Remark_Reason = '$remark_reason' Where Faculty_Mailid = '$mid' and Start_Date = '$startdate'";
		$result = $conn->query($sql);
		if($result)
		{
			
		}
		else
		{
			echo "data not inserted";
		}

		$sql = "Update fdc_sanction_data Set FDCM_name = '$_SESSION[name]', FDCM_mail = '$_SESSION[mail]', Remark = '$remark', Remark_Reason = '$remark_reason', Date_of_Meeting = '$date_of_meeting', Amount_Sanctioned = '$amount_sanctioned', ODs_sanctioned = '$ods_sanctioned' Where Faculty_Mail = '$mid' and Start_Date = '$startdate'";
		$result = $conn->query($sql);
		if($result)
		{
			/*header("Location: fdchome.php");*/
		}
		else
		{
			echo "select not working";
		}

		if($remark == 'Forward')
		{
			/*$sql = "Update resource_data Set ODs = ODs - '$ods_sanctioned', Amount = Amount - '$amount_sanctioned' where Email = '$mid'";
			$result = $conn->query($sql);*/

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
		else if($remark == 'Revert')
		{
			$sql = "Insert into reverted_applications values('$mid','$title','$startdate','$requestedods','$requestedamount','$remark_reason')";
			$result = $conn->query($sql);
			if(!$result)
				echo "101";
		
			$sql = "Delete from admin_sanction_data Where Faculty_Mail = '$mid' and Title = '$title' and Start_Date = '$startdate'";
			$result = $conn->query($sql);
			if(!$result)
				echo "1";
		
			$sql = "Delete from application_data Where Email = '$mid' and Title = '$title' and Start_date = '$startdate'";
			$result = $conn->query($sql);
			if(!$result)
				echo "2";

			$sql = "Delete from fdc_leave_data Where Faculty_Mailid = '$mid' and Start_Date = '$startdate'";
			$result = $conn->query($sql);
			if(!$result)
				echo "3";

			$sql = "Delete from fdc_sanction_data Where Faculty_Mail = '$mid' and Start_Date = '$startdate'";
			$result = $conn->query($sql);
			if(!$result)
				echo "4";

			$sql = "Delete from leave_data Where Email = '$mid' and Start_Date = '$startdate'";
			$result = $conn->query($sql);
			if(!$result)
				echo "5";

			$sql = "Delete from leave_data_files Where Email = '$mid' and Start_Date = '$startdate'";
			$result = $conn->query($sql);
			if(!$result)
				echo "6";


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
			header("Location: fdchome.php");
		}
		else
		{
			echo "update not working";
		}
	}
	
	else
	{
		header("Location: ods_error.php");
	}
}
else
{
	echo "error";
}
?>
</body>
</html>

