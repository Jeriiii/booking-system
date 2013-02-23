<?php
function get_message(){
	if(isset($_SESSION["booking-system"]["message"]))
	{
		if(isset($_SESSION["booking-system"]["message_type"]))
		{
			switch ($_SESSION["booking-system"]["message_type"])
			{
				case "info":
					return '<div class="alert alert-info">' . $_SESSION["booking-system"]["message"] . '</div>';
				case "error":
					return '<div class="alert alert-error">' . $_SESSION["booking-system"]["message"] . '</div>';
				case "success":
					return '<div class="alert alert-success">' . $_SESSION["booking-system"]["message"] . '</div>';	
			}
			unset($_SESSION["booking-system"]["message_type"]);
		}else{
			return '<div class="alert alert-info">' . $_SESSION["booking-system"]["message"] . '</div>';
		}
		
	}
	return NULL;
}
$message = get_message();
/* smazani zpravy ze secny */
if(isset($_SESSION["booking-system"]["message"])) unset($_SESSION["booking-system"]["message"]);
?>
