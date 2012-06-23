<?
$lang = $_GET['lang'];
if(strlen($lang)) header("Content-Type: text/html; charset=".$lang);
?>
<html>
<head>

<script language='javascript' src='modal_popup.js'></script>

<BODY scroll=no leftmargin="1" marginwidth="1" topmargin="1" marginheight="1">
<script language='javascript' src='./center_pop.js'></script>
<table border="0" cellpadding="8" cellspacing="5" width="100%" height="100%" bgcolor="#E6E8EB">
	<tr><td>
	<table border="0" cellpadding="5" cellspacing="0" width="100%">
		<tr>
		<td bgcolor="white">
			<script>document.write(editor_lang[40]);</script>
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
						<script>
						document.write('<a style="cursor:hand;cursor:pointer;" onclick="createFont(\'' + editor_lang[41] + '\',true)"><font face="' + editor_lang[41] + '">' + editor_lang[39] + '(' + editor_lang[41] + ')</a></font>');
						</script>
					</td>
				</tr>
				<tr>
					<td>
						<script>
						document.write('<a style="cursor:hand;cursor:pointer;" onclick="createFont(\'' + editor_lang[42] + '\',true)"><font face="' + editor_lang[42] + '">' + editor_lang[39] + '(' + editor_lang[42] + ')</a></font>');
						</script>
					</td>
				</tr>
				<tr>
					<td>
						<script>
						document.write('<a style="cursor:hand;cursor:pointer;" onclick="createFont(\'' + editor_lang[43] + '\')",true><font face="' + editor_lang[43] + '">' + editor_lang[39] + '(' + editor_lang[43] + ')</a></font>');
						</script>
					</td>
				</tr>
				<tr>
					<td>
						<script>
						document.write('<a style="cursor:hand;cursor:pointer;" onclick="createFont(\'' + editor_lang[44] + '\',true)"><font face="' + editor_lang[44] + '">' + editor_lang[39] + '(' + editor_lang[44] + ')</a></font>');
						</script>
					</td>
				</tr>
				<tr>
					<td>
						<a style="cursor:hand;cursor:pointer;" onclick="createFont('arial',true)"><font face="arial">ABCDEFGHIJK (Arial)</a></font>
					</td>
				</tr>
				<tr>
					<td>
						<a style="cursor:hand;cursor:pointer;" onclick="createFont('arial black',true)"><font face="arial black">ABCDEFGHIJK (Arial Black)</a></font>
					</td>
				</tr>
				<tr>
					<td>
						<a style="cursor:hand;cursor:pointer;" onclick="createFont('Arial Narrow',true)"><font face="Arial Narrow">ABCDEFGHIJK (Arial Narrow)</a></font>
					</td>
				</tr>
				<tr>
					<td>
						<a style="cursor:hand;cursor:pointer;" onclick="createFont('Comic Sans MS',true)"><font face="Comic Sans MS">ABCDEFGHIJK (Comic Sans MS)</a></font>
					</td>
				</tr>
				<tr>
					<td>
						<a style="cursor:hand;cursor:pointer;" onclick="createFont('System',true)"><font face="System">ABCDEFGHIJK (System)</a></font>
					</td>
				</tr>
				<tr>
					<td>
						<a style="cursor:hand;cursor:pointer;" onclick="createFont('Tahoma',true)"><font face="Tahoma">ABCDEFGHIJK (Tahoma)</a></font>
					</td>
				</tr>
				<tr>
					<td>
						<a style="cursor:hand;cursor:pointer;" onclick="createFont('Times New Roman',true)"><font face="Times New Roman">ABCDEFGHIJK (Times New Roman)</a></font>
					</td>
				</tr>
				<tr>
					<td>
						<a style="cursor:hand;cursor:pointer;" onclick="createFont('Verdana',true)"><font face="Verdana">ABCDEFGHIJK (Verdana)</a></font>
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
