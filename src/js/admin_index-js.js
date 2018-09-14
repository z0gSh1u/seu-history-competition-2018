var currentShow = "defaultright";

function showdiv(id) {
	if (currentShow != null) {
		document.getElementById(currentShow).style.display = "none"
	}
	document.getElementById(id).style.display = "inline";
	currentShow = id
}