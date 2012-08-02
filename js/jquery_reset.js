function reset(){
	var url = location.href;
	var urls = url.split("/monthATND");
	document.location = urls[0];
}