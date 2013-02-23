<?php
if (!isset($_SESSION["booking-system"]["logged"])) {
	$_SESSION["booking-system"]["message"] = "Nejdřív se musíte přihlásit.";
	$_SESSION["booking-system"]["message_type"] = "error";
	header("Location: sign_in.php");
}
?>
