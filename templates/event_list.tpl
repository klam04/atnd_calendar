<!DOCTYPE>
<html xml:lang="ja" lang="ja" dir="ltr">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>ATND_EVENT_LIST</title>
<link href='http://fonts.googleapis.com/css?family=Economica' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<script type="text/javascript" src="js/jquery_month.js"></script>
<script type="text/javascript" src="js/jquery_reset.js"></script>
</head>
<body>
<header>{$header_month}</header>
<table id="event_list">
{foreach from=$event_list item=list}
<p>{$list}</p>
{/foreach}
<tr height="95px"><td></td></tr>
</table>
<div id="sub_footer">
<table width="100%">
<tr>
<td align="left">&nbsp;&nbsp;GPS(現在)：{$address}</td>
<td align="right"><button id="event_btn" type=button onclick="reset()">更新</button>&nbsp;&nbsp;</td>
</tr>
</table>
</div>
<footer>
<button id="footer_btn" type=button onclick="setMonth(1)">PREV</button>
<button id="footer_btn" type=button onclick="setMonth(0)">TODAY</button>
<button id="footer_btn" type=button onclick="setMonth(2)">NEXT</button>
</footer>
</body>
</html>