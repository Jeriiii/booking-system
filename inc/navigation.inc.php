<?php
function get_navigation($active, $type)
{
	$navigation = '<header><nav class="navbar ' . $type . '"><div class="navbar-inner"><ul class="nav">';
	
	$nav_list = array(
		"sign_in.php" => "Přihlášení",
		"registration.php" => "Registrace",
		"choose_place.php" => "Města",
		"choose_move.php" => "Filmy",
		"index.php" => "Rezervace",
		"preview.php" => "Shrnutí",
		"sign_out.php" => "Odhlášení",
		"squash/index.php" => "<i>Přejít na rezervaci squashe</i>",
	);
	
	foreach($nav_list as $key => $item)
	{
		if($key == $active)
		{
			$navigation = $navigation . '<li class="active"><a href="' . $key . '">' . $item . '</a></li>';
		}else{
			$navigation = $navigation . '<li><a href="' . $key . '">' . $item . '</a></li>';
		}
	}
	$navigation = $navigation . '</ul></div></nav>';
	
	return $navigation;
}
if(!isset($type)) $type = "";
$navigation = get_navigation($active, $type);
?>
