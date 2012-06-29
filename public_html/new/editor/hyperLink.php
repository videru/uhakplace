<?
$lang = $_GET['lang'];
if(strlen($lang)) header("Content-Type: text/html; charset=".$lang);
?>
<html>
<head>

<title>HyperLink</title>

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
			<script>document.write(editor_lang[45]);</script>
		</td>
		</tr>
		<tr>
		<td bgcolor="white">
		<table border="1" cellpadding="6" cellspacing="0" width="99%" bordercolor="#CCCCCC" bordercolordark="white" bordercolorlight="black">
			<tr>
			<td>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr><td colspan="2" height="7" width="100%"></td></tr>
				<tr>
					<td width="15%" align="right">TYPE: &nbsp;</td>
					<td width="85%">
						<select name="type" onchange="changeLink()">
						<option value="http://" checked>http://</option>
						<option value="mailto:">mailto:</option>
						<option value="file://">file://</option>
						<option value="ftp://">ftp://</option>
						<option value="gopher://">gopher://</option>
						<option value="news:">news:</option>
						<option value="telnet:">telnet:</option>
						</select>
					</td>
				</tr>

				<tr><td colspan="2" height="7" width="100%"></td></tr>
				<tr>
					<td align="right">URL: &nbsp;</td>
					<td>
						<input type="text" name="link" style="width:90%" value="http://" class="input">
					</td>
				</tr>

				<tr><td colspan="4" height="7" width="100%"></td></tr>
			</table>
			</td>
			</tr>
		</table>
		</td>
	</tr>
	<td height="5"></td></tr>

	<tr>
	<td align="center">
		<script>document.write('<input type="button" value=" ' + editor_lang[32] + ' " onclick="createLink()" class=input> &nbsp;<input type="button" value=" ' + editor_lang[33] + ' " onclick="window.close()" class=input>');</script>
	</td></tr>
	</table>
	</td>
	</tr>
	</form>
</table>
</BODY>
</HTML>
