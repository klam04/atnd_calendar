<?php
require 'libs/Smarty.class.php';

$smarty = new Smarty;

$smarty->compile_check = true;

$atnd_url="http://api.atnd.org/events/?";

$nowdate = preg_split("/[.]/",$_GET['date']);

$address =$_GET['address'];
$address = mb_convert_encoding($address, "utf-8", "auto");

$searchdate=date("Ym",mktime(0, 0, 0, $nowdate[1],1,$nowdate[0]));

$xml = simplexml_load_file(urlencode($atnd_url."keyword=$address&ym=$searchdate&count=100"));

$event_list = array();

for($i=0;$i<count($xml->events->event);$i++){
	
	$event_title=$xml->events->event[$i]->title;
	$event_url=$xml->events->event[$i]->event_url;
	
	$tmp_date = preg_split("/[T,-]/",$xml->events->event[$i]->started_at);
	$started_at=date("Ymd",mktime(0, 0, 0, $tmp_date[1],$tmp_date[2],$tmp_date[0]));
	
	$list_value="<button id=\"event_btn\" type=button onclick=\"window.open('$event_url')\">$event_title</button>";
	
	if(isset($event_list[$started_at])){
		$event_list[$started_at] = $event_list[$started_at].$list_value;
	}
	else{
		$event_list += array($started_at => $list_value);
	}
}

$event_views = array();

for($i=1;$i<32;$i++){
	if(checkdate($nowdate[1],$i,$nowdate[0])){
		$_date = mktime(0, 0, 0, $nowdate[1],$i,$nowdate[0]);
		
		$_key_date = date("Ymd",$_date);
		$_day = date("d",$_date);
		$_days = date("D",$_date);
		
		$eve=isset($event_list[$_key_date])?$event_list[$_key_date]:null;
		
		$_bgcolor = $_key_date==date("Ymd")?"mdaysize":"daysize";
		
		if($_days == "Sat"){
			array_push($event_views,"<tr><td id=\"$_bgcolor\">$_day(<span id=\"_sat\">$_days</span>)</td><td>$eve</td></tr>");
		}
		elseif($_days == "Sun"){
			array_push($event_views,"<tr><td id=\"$_bgcolor\">$_day(<span id=\"_sun\">$_days</span>)</td><td>$eve</td></tr>");
		}
		else{
			array_push($event_views,"<tr><td id=\"$_bgcolor\">$_day($_days)</td><td>$eve</td></tr>");
		}
	}
}

$smarty->assign("event_list", $event_views);
$smarty->assign("address", $address);
$smarty->assign("header_month", date("M",mktime(0, 0, 0, $nowdate[1],1,$nowdate[0])));

$smarty->display('event_list.tpl');