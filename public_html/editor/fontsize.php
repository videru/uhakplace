<?
$lang = $_GET['lang'];
if(strlen($lang)) header("Content-Type: text/html; charset=".$lang);
?>
<html>
<head>
<title>FontSize</title>

<script language="javascript" src="modal_popup.js"></script>

<BODY scroll=no leftmargin="1" marginwidth="1" topmargin="1" marginheight="1">

<script language='javascript' src='./center_pop.js'></script>
<table border="0" cellpadding="8" cellspacing="5" width="100%" height="100%" bgcolor="#E6E8EB">
	<tr><td>
	<table border="0" cellpadding="5" cellspacing="0" width="100%">
		<tr>
		<td bgcolor="white">
			<script>document.write(editor_lang[38]);</script>
		</td>
		</tr>
		<tr>
		<td bgcolor="white">
		<table border="1" cellpadding="6" cellspacing="0" width="99%" bordercolor="#CCCCCC" bordercolordark="white" bordercolorlight="black">
			<tr>
			<td>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr><td colspan="4" height="7" width="294"></td></tr>
				<tr>
					<td>
						<a style="cursor:hand;cursor:pointer;" onclick="createFont(1)"><FONT size=1><script>document.write(editor_lang[39]);</script> (1)</FONT></a>
					</td>
				</tr>
				<tr>
					<td>
						<a style="cursor:hand;cursor:pointer;" onclick="createFont(2)"><FONT size=2><script>document.write(editor_lang[39]);</script> (2)</FONT></a>
					</td>
				</tr>
				<tr>
					<td>
						<a style="cursor:hand;cursor:pointer;" onclick="createFont(3)"><FONT size=3><script>document.write(editor_lang[39]);</script> (3)</FONT></a>
					</td>
				</tr>
				<tr>
					<td>
						<a style="cursor:hand;cursor:pointer;" onclick="createFont(4)"><FONT size=4><script>document.write(editor_lang[39]);</script> (4)</FONT></a>
					</td>
				</tr>
				<tr>
					<td>
						<a style="cursor:hand;cursor:pointer;" onclick="createFont(5)"><FONT size=5><script>document.write(editor_lang[39]);</script> (5)</FONT></a>
					</td>
				</tr>
				<tr>
					<td>
						<a style="cursor:hand;cursor:pointer;" onclick="createFont(6)"><FONT size=6><script>document.write(editor_lang[39]);</script> (6)</FONT></a>
					</td>
				</tr>
			</table>
			</td>
			</tr>
		</table>
		</td>
	</tr>
	<td height="5"></td></tr>

	<tr>
	<td align="center">
		<script>document.write('<input type="button" onClick="window.close();" value="' + editor_lang[33] + '" class="input">');</script>
	</td></tr>
</table>

</BODY>
</HTML>
