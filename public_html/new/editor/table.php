<?
$lang = $_GET['lang'];
if(strlen($lang)) header("Content-Type: text/html; charset=".$lang);
?>
<html>
<head>

<title>Table</title>

<script language="javascript" src="modal_popup.js"></script>

</head>

<BODY scroll=no onload="tableView();" leftmargin="1" marginwidth="1" topmargin="1" marginheight="1">

<script language='javascript' src='./center_pop.js'></script>

<table border="0" cellpadding="8" cellspacing="5" width="100%" height="100%" bgcolor="#E6E8EB">
	<form name="add_form">
	<input type="hidden" name="bgcolor" id="bgcolor">
	<tr><td>
	<table border="0" cellpadding="5" cellspacing="0" width="100%">
		<tr>
		<td bgcolor="white">
		<script>document.write(editor_lang[46]);</script>
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
					<td width="95">
					&nbsp;&nbsp;<script>document.write(editor_lang[47]);</script>:
					</td>
					<td width="65">
					<input type="text" name="rows" size="4"  value="4" onChange="tableView();" class="input">
					</td>
					<td width="53">
					<script>document.write(editor_lang[48]);</script>
					</td>
					<td width="81">
					<input type="text" name="cols" size="4"  value="3" onChange="tableView();" class="input">
					</td>
				</tr>
				<tr>
					<td width="294" height="7" colspan="4"></td>
				</tr>
				<tr>
					<td width="95">
					&nbsp;&nbsp;<script>document.write(editor_lang[49]);</script>:
					</td>
					<td width="65"><input type="text" name="cellpadding" size="4" value="1" onChange="tableView();" class="input"></td>
					<td width="53">
					<script>document.write(editor_lang[50]);</script>
					</td>
					<td width="81">
					<script>document.write('<select name=alignment onChange="tableView();"><option value="" selected>' + editor_lang[54] + '</option><option value="center">' + editor_lang[55] + '</option><option value="left">' + editor_lang[56] + '</option><option value="right">' + editor_lang[57] + '</option></select>');</script>
					</td>
				</tr>
				<tr>
					<td width="294" height="7" colspan="4"></td>
				</tr>
				<tr>
					<td width="95">
					&nbsp;&nbsp;<script>document.write(editor_lang[51]);</script>
					</td>
					<td width="65">
					<input type="text" name="border" size="4"  value="1" onChange="tableView();" class="input">
					</td>
					<td width="53">
					<script>document.write(editor_lang[52]);</script>
					</td>
					<td width="81">
					<input type="text" name="cellspacing" size="4"  value="1" onChange="tableView();" class="input">
					</td>
				</tr>
				<tr><td width="294" height="7" colspan="4"></td></tr>
				
				<tr>
					<td width="95">
					&nbsp;&nbsp;:<script>document.write(editor_lang[53]);</script>
					</td>
					<td width="199" colspan="3">
					<input type="text" name="width" value="100" style="width:50px" maxlength=4 onChange="tableView();" class="input">
					<select name="widthExt" onChange="tableView();">
					<option value="%" selected>%</option>
					<option value="">px</option>
					</select>
					</td>
					</tr>
				</table>

				<BR>
				
				<table border="1" cellpadding="2" cellspacing="2" width="100%" style="cursor:hand;cursor:pointer;;" bordercolor="#000000" bordercolorlight="#CCCCCC">
					<tr>
						<td width="104" bgcolor="#CCFF99" ONCLICK="inserColor('#CCFF99');" height="13px" width="18px"></td>
						<td width="104" bgcolor="#99CC00" ONCLICK="inserColor('#99CC00');" height="13px" width="18px"></td>
						<td width="104" bgcolor="#CCCC99" ONCLICK="inserColor('#CCCC99');" height="13px" width="18px"></td>
						<td width="104" bgcolor="#CCFFFF" ONCLICK="inserColor('#CCFFFF');" height="13px" width="18px"></td>
						<td width="104" bgcolor="#99CCFF" ONCLICK="inserColor('#99CCFF');" height="13px" width="18px"></td>
						<td width="104" bgcolor="#CCCCFF" ONCLICK="inserColor('#CCCCFF');" height="13px" width="18px"></td>
						<td width="104" bgcolor="#FFFFCC" ONCLICK="inserColor('#FFFFCC');" height="13px" width="18px"></td>
						<td width="104" bgcolor="#FFFF33" ONCLICK="inserColor('#FFFF33');" height="13px" width="18px"></td>
						<td width="104" bgcolor="#CCCC00" ONCLICK="inserColor('#CCCC00');" height="13px" width="18px"></td>
					</tr>

					<tr>
						<td width="104" ONCLICK="inserColor('');" height="13px" width="18px"></td>
						<td width="104" bgcolor="#FAFAFA" ONCLICK="inserColor('#FAFAFA');" height="13px" width="18px"></td>
						<td width="104" bgcolor="#EFEFEF" ONCLICK="inserColor('#EFEFEF');" height="13px" width="18px"></td>
						<td width="104" bgcolor="#FFCCCC" ONCLICK="inserColor('#FFCCCC');" height="13px" width="18px"></td>
						<td width="104" bgcolor="#FF99CC" ONCLICK="inserColor('#FF99CC');" height="13px" width="18px"></td>
						<td width="104" bgcolor="#FF9999" ONCLICK="inserColor('#FF9999');" height="13px" width="18px"></td>
						<td width="104" bgcolor="#CC9933" ONCLICK="inserColor('#CC9933');" height="13px" width="18px"></td>
						<td width="104" bgcolor="#996699" ONCLICK="inserColor('#996699');" height="13px" width="18px"></td>
						<td width="104" bgcolor="#666666" ONCLICK="inserColor('#666666');" height="13px" width="18px"></td>
					</tr>
				</table>
				</td>
				</tr>
			</table>
			<BR>
			<table border="1" cellpadding="6" cellspacing="0" width="99%" bordercolor="#CCCCCC" bordercolordark="white" bordercolorlight="black"><tr><td><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td height="160" align="center">
			
			<div id="table_view" style="width: 100%; height:160; overflow:auto;"></div>
			
			</td></tr></table></td></tr></table>
			</td>
		</tr>
		<td height="5"></td></tr>

		<tr>
			<td align="center">
			<script>document.write('<input type="button" value=" ' + editor_lang[32] + ' " onclick="insertTable()" class=input> &nbsp;<input type="button" value=" ' + editor_lang[33] + ' " onclick="window.close()" class=input>');</script>
			</td>
		</tr>
		</table>
		</td>
	</tr>
	</form>
</table>
</BODY>
</HTML>
