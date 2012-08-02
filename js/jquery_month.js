function setMonth(type){
	var url = location.href;
	var urls = url.split("&date=");
	var data = urls[1];
	
	if(type==1){
		var nextdate = data.split(".");
		if(parseInt(nextdate[1]) == 1){
			document.location = urls[0]+'&date='+(parseInt(nextdate[0])-1)+'.12.1';
		}
		else{
			document.location = urls[0]+'&date='+nextdate[0]+'.'+(parseInt(nextdate[1])-1)+'.1';
		}
		
	}
	else if(type==2){
		var nextdate = data.split(".");
		if(parseInt(nextdate[1]) == 12){
			document.location = urls[0]+'&date='+(parseInt(nextdate[0])+1)+'.1.1';
		}
		else{
			document.location = urls[0]+'&date='+nextdate[0]+'.'+(parseInt(nextdate[1])+1)+'.1';
		}
	}
	else{
		var nowdate = new Date();
		document.location = urls[0]+'&date='+nowdate.getFullYear()+'.'+(nowdate.getMonth()+1)+'.'+nowdate.getDate();
	}
}