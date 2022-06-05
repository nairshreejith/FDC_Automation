<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/btn.css">
	<link rel="stylesheet" type="text/css" href="css/login.css">
	<title>Adding a member</title>
</head>
<body>
	<?php

/*
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
require 'vendor/autoload.php';
*/
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

$mname = $_POST['mname'];
$memail = $_POST['memail'];
$mpassword = $_POST['mpassword'];

if(!empty($_POST['mtype']))
{
	$mtype = '';
	$i = 0;
	foreach ($_POST['mtype'] as $type) {
		if($i == 0)
		{
			$mtype = $mtype.$type;
			$i = $i + 1;
		}
		else
		{
			$mtype = $mtype.','.$type;
		}
	};
		//echo '$mtype';
}

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
$mail->addAddress($memail, $mtype);
//Set the subject line
$mail->isHTML(true);        
$mail->Subject = 'Password for Faculty Leave Portal';
$mail->Body = "Your emailid for login is: $memail <br> Your Password for login is:  $mpassword  <br> You are successfully registered as $mtype "; 
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body

//Replace the plain text body with one created manually
$mail->AltBody = 'This is a plain-text message body';
//Attach an image file

//send the message, check for errors
if (!$mail->send()) {
    echo 'Mailer Error: '. $mail->ErrorInfo;
} else {
    echo 'Message sent!';
    //Section 2: IMAP
    //Uncomment these to save your message in the 'Sent Mail' folder.
    #if (save_mail($mail)) {
    #    echo "Message saved!";
    #}
}
*/
$localhost = 'localhost';
$username = 'root';
$password = '';
$db = 'fdc';

$conn = mysqli_connect($localhost, $username, $password, $db);
if($conn)
{
	//echo "Connection sucessful";
}
else
{
	//echo "Error".mysqli_connect_error();
}

$ods = 12;
$amount = 12000;
$special_ods = 0;
$special_amount = 0;

echo "'$mname','$memail','$mtype','$mpassword'";
$sql = "Insert into faculty(Name, Email, MemberType, Password) values ('$mname','$memail','$mtype','$mpassword')";
$result = $conn->query($sql);
if($result)
{
	$sql2 = "Insert into resource_data(Name,Email,ODs,Amount,Special_Ods,Special_Amount) values('$mname', '$memail','$ods','$amount','$special_ods','$special_amount')";
	$result2 = $conn->query($sql2);
	if($result2)
	{
		echo "<script>
				alert('Member Successfully Added');
				window.location.href='fdcadminhome.php';
				</script>";
	}
	else
	{
		$_SESSION['errMsg'] = "*Couldnt Update The Details.";
		header("Location: addmember.php");
	}
}
else
{
	$_SESSION['errMsg'] = "*Couldnt Update The Details.";
		header("Location: addmember.php");
}

}
?>

</body>
</html>