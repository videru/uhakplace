<?
$lang = $_GET['lang'];
if(strlen($lang)) header("Content-Type: text/html; charset=".$lang);
?>
<html>
<head>
<title>characteristic</title>

<script language="javascript" src="modal_popup.js"></script>

</head>

<BODY scroll=no leftmargin="1" marginwidth="1" topmargin="1" marginheight="1">
<script language='javascript' src='./center_pop.js'></script>
<table border="0" cellpadding="8" cellspacing="5" width="100%" height="100%" bgcolor="#E6E8EB">
	<form name="add_form">
	<tr><td>
	<table border="0" cellpadding="5" cellspacing="0" width="100%">
		<tr>
		<td bgcolor="white">
			<script>document.write(editor_lang[34]);</script>
		</td>
		</tr>
		<tr>
		<td bgcolor="white">
		<table border="1" cellpadding="6" cellspacing="0" width="99%" bordercolor="#CCCCCC" bordercolordark="white" bordercolorlight="black">
			<tr>
				<td>
				<table border="0" cellspacing="0" width="100%" cellpadding="4" bgcolor="white">
					<tr></tr>
					<script>
					for(var i=0; i<editor_char.length; i++){
						if(i%10 == 0) {
							document.write('<tr></tr>');
						}
						document.write('<td><a style="cursor:hand;cursor:pointer;" onclick="insertHtml(\'' + editor_char[i] + '\');">' + editor_char[i] + '</a></td>');
					}
					</script>
					</table>
				</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
	<td height="5"></td></tr>

	<tr>
	<td align="center">
		<script>document.write('<input type="button" onClick="window.close();" value="' + editor_lang[33] + '" class="input">');</script>
	</td></tr>
	</table>
	</td></tr>
	</form>
</table>

</BODY>
</HTML>
