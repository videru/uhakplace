<?
$lang = $_GET['lang'];
if(strlen($lang)) header("Content-Type: text/html; charset=".$lang);
?>
<HTML>
<HEAD>

<title>Preview</title>

<script language="javascript" src="modal_popup.js"></script>
</HEAD>

<BODY scroll=no leftmargin="1" marginwidth="1" topmargin="1" marginheight="1" onload="zoomVal();">

<script language='javascript' src='./center_pop.js'></script>
<table border="0" cellpadding="8" cellspacing="0" width="100%" height="100%" bgcolor="#E6E8EB">
	<tr>
		<td>
		<table border="0" cellpadding="0" cellspacing="0" width="100%">
			<tr>
				<td>
				<script>document.write('<select style="background-color:#CCFFFF;" id="zoom_val" onchange="zoomout(this.value)"><option value="">' + editor_lang[78] + '</option><option value="300%">300%</option><option value="250%">250%</option><option value="200%">200%</option><option value="150%">150%</option><option value="100%">100%</option><option value="75%">75%</option><option value="50%">50%</option><option value="25%">25%</option></select>');</script>
				</td>
				<td>
					<DIV ALIGN="RIGHT"><a style="cursor:hand;cursor:pointer" onclick="print();">[PRINT]</a></DIV>
				</td>
			</tr>
			<tr><td height="5"></td></tr>
		</table>
		<table border="0" cellpadding="0" cellspacing="0" width="100%" height="95%" bgcolor="white">
			<tr>
				<td valign="top">
				<div style="width: 610; height:510; overflow:auto;">
				<span id="zoomin">
				<script language=javascript>
				<!--
					var tmp_data_write = !os ? vArguments.html : window.opener.SubmitHTML();
					document.write(tmp_data_write);
				//-->
				</script>
				</span>
				</div>
				</td>
			</tr>
		</table>
		</td>
	</tr>
</table>

</BODY>
</HTML>
