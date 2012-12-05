$(document).ready(function () {
	$("#cinema").booking_system({
		format: "xls",
		input: $("#xls").text(),
		name_class_element: "hrac",
		img_element: "images/hrac_zmenseny.png",
		img_selected: "images/hrac_pri_najeti_zmenseny.png",
		img_reserved: "images/hrac_pri_najeti_zmenseny.png",
		legend: "false"
	});
});

//function mouseUp(e) {
//	
//}

//function mouseOver(e) {
//	
//}