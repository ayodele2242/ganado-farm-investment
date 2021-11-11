$(".basic").spectrum(
 showAlpha: true
	);
$(".override").spectrum({
    color: "yellow"
});
(".startEmpty").spectrum({
    allowEmpty: true
});




$("#triggerSet").spectrum();

// Show the original input to demonstrate the value changing when calling `set`
$("#triggerSet").show();

$("#btnEnterAColor").click(function() {
    $("#triggerSet").spectrum("set", $("#enterAColor").val());
});


$("#showAlpha").spectrum({
    showAlpha: true
});