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
	
	include("inc/header.inc.php");
	
	$active = "choose_place.php";
	$type = "navbar-inverse";
	include('inc/navigation.inc.php');
	echo $navigation;
	
	$form = new PFBC\Form("select_place");
	$form->configure(array(
		"prevent" => array("bootstrap", "jQuery", "focus"),
		"view" => new PFBC\View\Search
	));
	$form->addElement(new PFBC\Element\Hidden("form", "select_place"));
	$form->addElement(new PFBC\Element\Select("", "place", $place));
	$form->addElement(new PFBC\Element\Button("Vybrat místo"));
?>

<script type="text/JavaScript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.tokeninput.js"></script>
<h2>Zadejte město:</h2></header><section>
    <div>
		<form action="choose_move.php" method="GET">
			<input type="text" id="cities" name="search" />
			<input id="choose_place_submit" type="submit" name="Odeslat"/>
		</form>
        <script type="text/javascript">
        $(document).ready(function() {
            $("#cities").tokenInput([{
				id:1,
                name: "Plzeň",
				description: " ... je statutární město na západě Čech ..."
            },
			{
				id:2,
                name: "České Budějovice",
				description: " ... metropole Jižních Čech ..."
            },
			{
				id:3,
                name: "Praha",
				description: " ... hlavní město ČR ..."
            }
          ], {
			  method: "GET",
              propertyToSearch: "name",
			  searchingText: "Vyhledávám ...",
			  hintText: "Sem napište město",
			  noResultsText: "Nebyl nalezen žádný výsledek.",
			  theme: "facebook",
			  resultsFormatter: function(item){ return "<li>" + "<img src='images/mesto.png' title='mesto' height='25px' width='25px' />" + "<div style='display: inline-block; padding-left: 10px; width:350px;' ><div>" + item.name  + item.description + "</div></div></li>" },
			  onAdd: function () {
				  jQuery("#choose_place_submit").trigger("click");
              }
          });
        });
        </script>
    </div>

<?php include("inc/foot.inc.php");