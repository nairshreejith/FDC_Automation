<?php

$to = 'shreyans.k@somaiya.edu';
$subject = 'Trying the php mail function';
$message = "<h1>Hiiii: '$to'</h1>";

$headers = "From: shreyans.k@somaiya.edu";
//$headers = "Reply-To: admin@gmail.com\r\n";
//$headers = "Content Type: text/html\r\n";

mail($to, $subject, $message, $headers);

?>