<?php
session_start();
session_destroy();
unset($_SESSION["mail"]);
unset($_SESSION["pass"]);
header("Location:index.php");
exit();
?>