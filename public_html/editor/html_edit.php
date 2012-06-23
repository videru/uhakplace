<?
$lang = $_GET['lang'];
if(strlen($lang)) header("Content-Type: text/html; charset=".$lang);
?>
<HTML>
<HEAD>

<title>Html Editor</title>

<script language="javascript" src="modal_popup.js"></script>
</HEAD>

<BODY scroll=no leftmargin="1" marginwidth="1" topmargin="1" marginheight="1" bgcolor="#E6E8EB">

<script language='javascript' src='./center_pop.js'></script>

<table border="0" cellpadding="5" cellspacing="2" width="100%">
	<form name="add_form">
    <tr>
        <td colspan=2>
		<script>document.write(editor_lang[58]);</script> : <input type="text" name="sh" size=30 class=input><br>
		<script>document.write(editor_lang[59]);</script> : <input type="text" name="reg" size=30 class=input>
		<script>document.write('<input type=button value=" ' + editor_lang[60] + ' " onclick="search();" class="input">');</script>
		</td>
	</tr>
	<tr>
		<td width=40%>
			<script>document.write(editor_lang[61]);</script> : <input type="radio" name="opt1" checked><script>document.write(editor_lang[62]);</script> <input type="radio" name="opt1"><script>document.write(editor_lang[63]);</script>
		</td>
		<td width=60%>
			<script>document.write(editor_lang[64]);</script> : <input type="radio" name="opt2" checked><script>document.write(editor_lang[65]);</script> <input type="radio" name="opt2"><script>document.write(editor_lang[66]);</script>
		</td>
	</tr>
	<tr>
		<td colspan=2 align="center">
		<script language="javascript">
		<!--
			document.writeln('<textarea name="content" wrap="hard" style="width:99%;height:350;" onkeydown="TapKey(this);" class="input">' + valOutPut() + '</textarea>');
		//-->
		</script>
		</td>
	</tr>

	<tr>
	<td colspan="2">
		 <script>document.write('<div align="center"><input type="button" value=" ' + editor_lang[32] + ' " onclick="str_reg()" class=input> &nbsp;<input type="button" value=" ' + editor_lang[33] + ' " onclick="window.close()" class=input></div>');</script>
	</td></tr>
	</form>
</table>

</BODY>
</HTML>
