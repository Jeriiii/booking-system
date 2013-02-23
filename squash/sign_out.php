<?php
session_start();
session_destroy();
session_start();
$_SESSION["booking-system"]["message"] = "Byl jste úspěšně odhlášen";
$_SESSION["booking-system"]["message_type"] = "success";
header("Location: sign_in.php")
?>
