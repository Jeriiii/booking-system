<?php
session_start();
include("inc/message.inc.php");
include("inc/authorization.inc.php");
include("PFBC/Form.php");
	$place = array(
		"1" => "Bathman",
		"2" => "Avatar",
		"3" => "Harry Potter",
	);
	$city = array(
		"1" => "Plzeň",
		"2" => "České Budějovice",
		"3" => "Praha"
	);
	
	include("inc/header.inc.php");
	
	$active = "choose_move.php";
	$type = "navbar-inverse";
	include('inc/navigation.inc.php');
	echo $navigation;
	if(array_key_exists("search", $_GET))
		echo "<h2>" . $city[gpc_addslashes($_GET["search"])] . "</h2>";
	else
		echo "<h2>Plzeň</h2>";
	echo "</header><section>";
?>


	<div id="slide_show">
		<div class="slider-wrapper theme-default">
			<div id="slider" class="nivoSlider">
				<img src="images/slideshow/toystory.jpg" data-thumb="images/slideshow/toystory.jpg" alt="" />
				<img src="images/slideshow/up.jpg" data-thumb="images/slideshow/up.jpg" alt=""/>
				<img src="images/slideshow/walle.jpg" data-thumb="images/slideshow/walle.jpg" alt="" />
				<img src="images/slideshow/nemo.jpg" data-thumb="images/slideshow/nemo.jpg" alt=""/>
			</div>
		</div>
	</div>

	<script type="text/JavaScript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery.nivo.slider.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        $('#slider').nivoSlider();
    });
    </script>

<?php
echo "<h2>Seznam promítaných filmů:</h2>";
echo "<table class='table'>";
echo "<thead><th>jméno filmu</th><th>od</th><th>do</th><th>sál</th></thead>";

include("inc/model_db.inc.php");
$films = Model_db::getInstance()->loadMoves();

while($film = $films->fetch())
{
	echo "<tr>";
	echo	"<td><a href='index.php?place=" . $film->hall . "'>" . $film->name . "</a></td>
		<td>" . $film->start . "</td>
		<td>" . $film->end . "</td>
		<td>" . $film->hall . "</td>";
	echo "</tr></a>";
}

echo "</table>";
?>	
	
<?php include("inc/foot.inc.php");
