$(function(){
	navigator.geolocation.watchPosition(
		function(position){
			geocoder = new google.maps.Geocoder();
			var latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
			if (geocoder) {
				geocoder.geocode({'latLng': latlng}, function(results, status) {
					if (status == google.maps.GeocoderStatus.OK) {
						var num = count(results) - 2;
						var tmp_add = results[num].formatted_address;
						var tmp_add_par = split(', ',tmp_add);
						
						address = tmp_add_par[1];
					}else{
						address = "";
					}
				});
			}
			var date = new Date();
			document.location = 'monthATND.php?address='+address+'&date='+date.getFullYear()+'.'+(date.getMonth()+1)+'.'+date.getDate();
		}
	);
});