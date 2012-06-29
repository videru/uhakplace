<?
$lang = $_GET['lang'];
if(strlen($lang)) header("Content-Type: text/html; charset=".$lang);
?>
<html>
<head>
<title>File Uploaded</title>

<script language="javascript" src="modal_popup.js"></script>
</head>

<BODY scroll=no leftmargin="1" marginwidth="1" topmargin="1" marginheight="1" onload="url_write();">

<script language='javascript' src='./center_pop.js'></script>

<table border="0" cellpadding="8" cellspacing="5" width="100%" height="100%" bgcolor="#E6E8EB">
	<form name="add_form" action="upfile_ok.php" method="post" enctype="multipart/form-data" target="editor_hidden">
	<input type="hidden" name="url" id="url">
	<input type="hidden" name="lang" id="lang">
	<input type="hidden" name="wr" id="wr">
	<iframe name="editor_hidden" style="display:none;"></iframe>
	<tr>
		<td>
		<table border="0" cellpadding="5" cellspacing="0" width="100%">
			<tr>
				<td bgcolor="white">
				<table border="1" cellpadding="6" cellspacing="0" width="99%" bordercolor="#CCCCCC" bordercolordark="white" bordercolorlight="black">
					<tr>
						<td>
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td width="61" align="right">
								<nobr><script>document.write(editor_lang[67]);</script>:&nbsp;
								</td>
								<td colspan="3">
								<table width="100%" border="0" cellspacing="0" cellpadding="0" style="table-layout:fixed">
									<tr>
										<td>
										<input type="file" name="upfile" id="upfile"class="input">
										</td>
									</tr>
								</table>
								</td>
							</tr>

							<tr>
								<td width="61" align="right">
								<nobr><script>document.write(editor_lang[68]);</script>:&nbsp;
								</td>
								<td colspan="3">
								<table width="100%" border="0" cellspacing="0" cellpadding="0">
									<tr>
										<td>
										<input type="text" name="link" id="link" style="width: 95%" class="input">
										</td>
									</tr>
								</table>
								</td>
							</tr>
							<tr>
								<td width="300" height="7" colspan="4"></td>
							</tr>
							<tr>
								<td width="61">
								<nobr><script>document.write(editor_lang[69]);</script>:&nbsp;
								</td>
								<td width="97">
								<input type="text" name="imgsize" class="input">
								</td>
								<td width="42">
								<nobr><script>document.write(editor_lang[70]);</script>:
								</td>
								<td width="100">
								<script>document.write('<select name="alignment"><option value="" selected>' + editor_lang[54] + '</option><option value="center">' + editor_lang[55] + '</option><option value="left">' + editor_lang[56] + '</option><option value="right">' + editor_lang[57] + '</option></select>');</script>
								</td>
							</tr>
						</table>
						</td>
					</tr>
				</table>
				<BR>
				<table border="1" cellpadding="6" cellspacing="0" width="99%" bordercolor="#CCCCCC" bordercolordark="white" bordercolorlight="black">
					<tr>
						<td>
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr><td height="250" align="center">
						<div id="preview_mid"></div>
						</td></tr>
						</table>
						</td>
					</tr>
				</table>
				</td>
			</tr>
			<tr><td height="0"></td></tr>

			<tr>
			<td align=center>
			<script>document.write('<input type="button" value=" ' + editor_lang[77] + ' " onclick="midView();" class="input"> &nbsp;<input type="submit" value=" ' + editor_lang[32] + ' " class="input"> &nbsp;<input type="button" value=" ' + editor_lang[33] + ' " onclick="window.close()" class=input>');</script>
			</td>
		</tr>
		</table>
		</td>
	</tr>
</table>


</BODY>
</HTML>