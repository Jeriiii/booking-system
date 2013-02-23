<?php 
	session_start();
	include("inc/message.inc.php");
	include("inc/authorization.inc.php");
	include("PFBC/Form.php");
	include("inc/protection.inc.php");
	// jednoradkovy
	
	if(isset($_GET["place"])){
		$input = gpc_addslashes($_GET["place"]);
	}else{
		$input = 1;
	}

	$place = array(
		"1" => "sál 1",
		"2" => "sál 2",
		"3" => "sál 3",
	);
	
	include("inc/header.inc.php");
	
	include("inc/model_db.inc.php");
	$input_file = Model_db::getInstance()->loadInputFromFile($input);
	$active = "index.php";
	$type = "navbar-inverse";
	include('inc/navigation.inc.php');
	echo $navigation;
	echo "<legend>Výběr místa</legend></header><section>";
	
	$form = new PFBC\Form("select_place");
	$form->configure(array(
		"prevent" => array("bootstrap", "jQuery", "focus"),
		"view" => new PFBC\View\Search,
		"method" => "get"
	));
	$form->addElement(new PFBC\Element\Hidden("form", "select_place"));
	$select = new PFBC\Element\Select("", "place", $place);
	$select->setValue($input);
	$form->addElement($select);
	$form->addElement(new PFBC\Element\Button("Vybrat místo"));
?>
	<div id="json">
		<?php 
			$json = Model_db::getInstance()->loadAllSeatsFromDatabaseJSON($input);
			echo $json;
		?>
	</div>
	<div id="table">
		<table>
			<tr><td></td><td></td><td></td></tr>
			<tr><td></td><td></td><td></td></tr>
			<tr><td></td><td></td><td></td></tr>
		</table>
	</div>
	<div id="xls">
		<?php 
			$filename = "data/" . $input_file;
			if(file_exists ($filename))
				echo file_get_contents($filename);
			else
				die("Vstupní soubor nebyl nalezen");
		?>
	</div>
	<div class="row">
		<div class="span6"><?php $form->render(); ?></div>
		<div class="span9" id="legend">
			<div class="row"></div>
		</div>
	</div>
		<div id="reserved_system">
			<div id="left"><img src="images/leva_strana_kina.png" alt="left_img"></div>
			<div id="middle">
				<div id="head"></div>
				<div id="cinema"></div>
				<div id="foot"></div>
			</div>
			<div id="right"><img src="images/prava_strana_kina.png" alt="right_img"></div>
			<div style="clear: both"></div>
		</div>
		<div id="reserved"><ul>
			<?php
				$place = 1;
				
				if(isset($get_place))
					$place = $get_place;

				$elements = Model_db::getInstance()->loadReservedSeatsFromDatabase($place);
				while ($reserved = $elements->fetch())
				{
					echo "<li>" . $reserved->element_number . "_" . $reserved->serie_number . "</li>";
				}
			?>
		</ul></div>
		<div id="selected">
			<form action="save.php" method="post">
				<input type="hidden" name="id_user" value="<?php echo $_SESSION["booking-system"]["id_user"] ?>" />
				<input type="hidden" name="id_place" value="<?php echo $place ?>" />
				<div class="span3 offset12"><input type='submit' value='Zarezervovat' class="bnt btn-large btn-success" /></div>
			</form>
		</div>

		<script type="text/JavaScript" src="js/jquery.js"></script>
		<script type="text/JavaScript" src="js/jquery.cinemaPlugin.js"></script>	
		<script type="text/JavaScript" src="js/test.js"></script>
		
<?php include("inc/foot.inc.php");