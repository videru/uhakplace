<?
$lang = $_GET['lang'];
if(strlen($lang)) header("Content-Type: text/html; charset=".$lang);
?>
<html>
<head>
<title>emotions</title>

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
		<script>document.write(editor_lang[35]);</script>
		</td>
		</tr>
		<tr>
		<td bgcolor="white">
		<table border="1" cellpadding="6" cellspacing="0" width="99%" bordercolor="#CCCCCC" bordercolordark="white" bordercolorlight="black">
			<tr>
				<td>
				<table border="0" cellspacing="3" width="100%" bordercolordark="white" bordercolorlight="#009999" cellpadding="3" bgcolor="white">
					<tr>
						<td align="center" width="22" height="22"><img onclick="createEmotions('01.gif')" style="cursor:hand;cursor:pointer;" src="img/emotions/01.gif" width="18" height="18" border="0"></td>
						<td align="center" width="22" height="22"><img onclick="createEmotions('02.gif')" style="cursor:hand;cursor:pointer;" src="img/emotions/02.gif" width="18" height="18" border="0"></td>
						<td align="center" width="22" height="22"><img onclick="createEmotions('03.gif')" style="cursor:hand;cursor:pointer;" src="img/emotions/03.gif" width="18" height="18" border="0"></td>

						<td align="center" width="22" height="22"><img onclick="createEmotions('04.gif')" style="cursor:hand;cursor:pointer;" src="img/emotions/04.gif" width="18" height="18" border="0"></td>
						<td align="center" width="22" height="22"><img onclick="createEmotions('05.gif')" style="cursor:hand;cursor:pointer;" src="img/emotions/05.gif" width="18" height="18" border="0"></td>
						<td align="center" width="22" height="22"><img onclick="createEmotions('06.gif')" style="cursor:hand;cursor:pointer;" src="img/emotions/06.gif" width="18" height="18" border="0"></td>
					</tr>

					<tr>
						<td align="center" width="22" height="22"><img onclick="createEmotions('07.gif')" style="cursor:hand;cursor:pointer;" src="img/emotions/07.gif" width="18" height="18" border="0"></td>
						<td align="center" width="22" height="22"><img onclick="createEmotions('08.gif')" style="cursor:hand;cursor:pointer;" src="img/emotions/08.gif" width="18" height="18" border="0"></td>
						<td align="center" width="22" height="22"><img onclick="createEmotions('09.gif')" style="cursor:hand;cursor:pointer;" src="img/emotions/09.gif" width="18" height="18" border="0"></td>
						<td align="center" width="22" height="22"><img onclick="createEmotions('10.gif')" style="cursor:hand;cursor:pointer;" src="img/emotions/10.gif" width="18" height="18" border="0"></td>
						<td align="center" width="22" height="22"><img onclick="createEmotions('11.gif')" style="cursor:hand;cursor:pointer;" src="img/emotions/11.gif" width="18" height="18" border="0"></td>
						<td align="center" width="22" height="22"><img onclick="createEmotions('12.gif')" style="cursor:hand;cursor:pointer;" src="img/emotions/12.gif" width="18" height="18" border="0"></td>
					</tr>
					<tr>
						<td align="center" width="22" height="22"><img onclick="createEmotions('13.gif')" style="cursor:hand;cursor:pointer;" src="img/emotions/13.gif" width="18" height="18" border="0"></td>
						<td align="center" width="22" height="22"><img onclick="createEmotions('14.gif')" style="cursor:hand;cursor:pointer;" src="img/emotions/14.gif" width="18" height="18" border="0"></td>
						<td align="center" width="22" height="22"><img onclick="createEmotions('15.gif')" style="cursor:hand;cursor:pointer;" src="img/emotions/15.gif" width="18" height="18" border="0"></td>
						<td align="center" width="22" height="22"><img onclick="createEmotions('16.gif')" style="cursor:hand;cursor:pointer;" src="img/emotions/16.gif" width="18" height="18" border="0"></td>
						<td align="center" width="22" height="22"><img onclick="createEmotions('17.gif')" style="cursor:hand;cursor:pointer;" src="img/emotions/17.gif" width="18" height="18" border="0"></td>
						<td align="center" width="22" height="22"><img onclick="createEmotions('18.gif')" style="cursor:hand;cursor:pointer;" src="img/emotions/18.gif" width="18" height="18" border="0"></td>
					</tr>
					<tr>
						<td align="center" width="22" height="22"><img onclick="createEmotions('19.gif')" style="cursor:hand;cursor:pointer;" src="img/emotions/19.gif" width="18" height="18" border="0"></td>
						<td align="center" width="22" height="22"><img onclick="createEmotions('20.gif')" style="cursor:hand;cursor:pointer;" src="img/emotions/20.gif" width="18" height="18" border="0"></td>
						<td align="center" width="22" height="22"><img onclick="createEmotions('21.gif')" style="cursor:hand;cursor:pointer;" src="img/emotions/21.gif" width="18" height="18" border="0"></td>
						<td align="center" width="22" height="22"><img onclick="createEmotions('22.gif')" style="cursor:hand;cursor:pointer;" src="img/emotions/22.gif" width="18" height="18" border="0"></td>
						<td align="center" width="22" height="22"><img onclick="createEmotions('23.gif')" style="cursor:hand;cursor:pointer;" src="img/emotions/23.gif" width="18" height="18" border="0"></td>
						<td align="center" width="22" height="22"><img onclick="createEmotions('24.gif')" style="cursor:hand;cursor:pointer;" src="img/emotions/24.gif" width="18" height="18" border="0"></td>
					</tr>
					<tr>
						<td align="center" width="22" height="22"><img onclick="createEmotions('25.gif')" style="cursor:hand;cursor:pointer;" src="img/emotions/25.gif" width="18" height="18" border="0"></td>
						<td align="center" width="22" height="22"><img onclick="createEmotions('26.gif')" style="cursor:hand;cursor:pointer;" src="img/emotions/26.gif" width="18" height="18" border="0"></td>
						<td align="center" width="22" height="22"><img onclick="createEmotions('27.gif')" style="cursor:hand;cursor:pointer;" src="img/emotions/27.gif" width="18" height="18" border="0"></td>
						<td align="center" width="22" height="22"><img onclick="createEmotions('28.gif')" style="cursor:hand;cursor:pointer;" src="img/emotions/28.gif" width="18" height="18" border="0"></td>
						<td align="center" width="22" height="22"><img onclick="createEmotions('29.gif')" style="cursor:hand;cursor:pointer;" src="img/emotions/29.gif" width="18" height="18" border="0"></td>
						<td align="center" width="22" height="22"><img onclick="createEmotions('30.gif')" style="cursor:hand;cursor:pointer;" src="img/emotions/30.gif" width="18" height="18" border="0"></td>
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
			</td>
		</tr>
		</table>
		</td>
	</tr>
	</form>
</table>

</BODY>
</HTML>
