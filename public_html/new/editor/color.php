<?
$lang = $_GET['lang'];
if(strlen($lang)) header("Content-Type: text/html; charset=".$lang);
?>
<html>
<head>

<title>FontColor</title>

<script language="javascript" src="modal_popup.js"></script>
<script language="javascript">
<!--
var title_write = (elements[1]=='forecolor') ? editor_lang[36] : editor_lang[37];

function createColor(val){
	if(window.open){
		if(!os){
			var returnVal = new Object();
			returnVal.mode = elements[1];
			returnVal.val = val;
			window.returnValue = returnVal;
		}
		else{
			window.opener.htmltrue(elements[1],val,false);
		}
		self.close();
	}
}
//-->
</script>

</head>

<BODY scroll=no leftmargin="1" marginwidth="1" topmargin="1" marginheight="1">

<script language='javascript' src='./center_pop.js'></script>
<table border="0" cellpadding="8" cellspacing="5" width="100%" height="100%" bgcolor="#E6E8EB">
	<tr><td>
	<table align="center" border="0" cellpadding="5" cellspacing="0" width="100%" bgcolor="FFFFFF">
		<tr>
			<td>
			<script>document.write(title_write);</script>
			</td>
		</tr>
		<tr>
			<td>
            <table border="1" cellpadding="2" cellspacing="2" width="100%" style="cursor:hand;cursor:pointer;;" bordercolor="#000000" bordercolorlight="#CCCCCC">
                <tr>
                    <td bgcolor=FFF4E2 ONCLICK="createColor('FFF4E2')" height="13px" width="18px"></td>
                    <td bgcolor=FFFEE0 ONCLICK="createColor('FFFEE0')" height="13px" width="18px"></td>
                    <td bgcolor=EEFAE4 ONCLICK="createColor('EEFAE4')" height="13px" width="18px"></td>
                    <td bgcolor=F0F9E4 ONCLICK="createColor('F0F9E4')" height="13px" width="18px"></td>
                    <td bgcolor=E6FAFB ONCLICK="createColor('E6FAFB')" height="13px" width="18px"></td>
                    <td bgcolor=E5EDFA ONCLICK="createColor('E5EDFA')" height="13px" width="18px"></td>
                    <td bgcolor=E4EEFA ONCLICK="createColor('E4EEFA')" height="13px" width="18px"></td>
                    <td bgcolor=F1E5F9 ONCLICK="createColor('F1E5F9')" height="13px" width="18px"></td>
                    <td bgcolor=FCE5F5 ONCLICK="createColor('FCE5F5')" height="13px" width="18px"></td>
                    <td bgcolor=FEE6E4 ONCLICK="createColor('FEE6E4')" height="13px" width="18px"></td>
                    <td bgcolor=FDE5E3 ONCLICK="createColor('FDE5E3')" height="13px" width="18px"></td>
                    <td bgcolor=FFF4E2 ONCLICK="createColor('FFF4E2')" height="13px" width="18px"></td>
                </tr>
                <tr>
                    <td bgcolor=FEF7C3 ONCLICK="createColor('FEF7C3')" height="13px" width="18px"></td>
                    <td bgcolor=FEF7C3 ONCLICK="createColor('FEF7C3')" height="13px" width="18px"></td>
                    <td bgcolor=EBF6CC ONCLICK="createColor('EBF6CC')" height="13px" width="18px"></td>
                    <td bgcolor=D5F5CC ONCLICK="createColor('D5F5CC')" height="13px" width="18px"></td>
                    <td bgcolor=CDF5F5 ONCLICK="createColor('CDF5F5')" height="13px" width="18px"></td>
                    <td bgcolor=D0E3F2 ONCLICK="createColor('D0E3F2')" height="13px" width="18px"></td>
                    <td bgcolor=CFD5F7 ONCLICK="createColor('CFD5F7')" height="13px" width="18px"></td>
                    <td bgcolor=E3CCF6 ONCLICK="createColor('E3CCF6')" height="13px" width="18px"></td>
                    <td bgcolor=F6CDED ONCLICK="createColor('F6CDED')" height="13px" width="18px"></td>
                    <td bgcolor=FCC5CA ONCLICK="createColor('FCC5CA')" height="13px" width="18px"></td>
                    <td bgcolor=FED5C3 ONCLICK="createColor('FED5C3')" height="13px" width="18px"></td>
                    <td bgcolor=FEE3C5 ONCLICK="createColor('FEE3C5')" height="13px" width="18px"></td>
                </tr>
                <tr>
                    <td bgcolor=FFE9A6 ONCLICK="createColor('FFE9A6')" height="13px" width="18px"></td>
                    <td bgcolor=FDFBA6 ONCLICK="createColor('FDFBA6')" height="13px" width="18px"></td>
                    <td bgcolor=E3F1B3 ONCLICK="createColor('E3F1B3')" height="13px" width="18px"></td>
                    <td bgcolor=BEF0B3 ONCLICK="createColor('BEF0B3')" height="13px" width="18px"></td>
                    <td bgcolor=B4F0F0 ONCLICK="createColor('B4F0F0')" height="13px" width="18px"></td>
                    <td bgcolor=B3D5F1 ONCLICK="createColor('B3D5F1')" height="13px" width="18px"></td>
                    <td bgcolor=B4BEF1 ONCLICK="createColor('B4BEF1')" height="13px" width="18px"></td>
                    <td bgcolor=CFB1EF ONCLICK="createColor('CFB1EF')" height="13px" width="18px"></td>
                    <td bgcolor=EFB4E4 ONCLICK="createColor('EFB4E4')" height="13px" width="18px"></td>
                    <td bgcolor=FEA4AE ONCLICK="createColor('FEA4AE')" height="13px" width="18px"></td>
                    <td bgcolor=FFC1A6 ONCLICK="createColor('FFC1A6')" height="13px" width="18px"></td>
                    <td bgcolor=FFD5A5 ONCLICK="createColor('FFD5A5')" height="13px" width="18px"></td>
                </tr>
                <tr>
                    <td bgcolor=FFE184 ONCLICK="createColor('FFE184')" height="13px" width="18px"></td>
                    <td bgcolor=FFF987 ONCLICK="createColor('FFF987')" height="13px" width="18px"></td>
                    <td bgcolor=D6EE9A ONCLICK="createColor('D6EE9A')" height="13px" width="18px"></td>
                    <td bgcolor=A3EB97 ONCLICK="createColor('A3EB97')" height="13px" width="18px"></td>
                    <td bgcolor=9BEBEA ONCLICK="createColor('9BEBEA')" height="13px" width="18px"></td>
                    <td bgcolor=9CC9EA ONCLICK="createColor('9CC9EA')" height="13px" width="18px"></td>
                    <td bgcolor=9AA9EE ONCLICK="createColor('9AA9EE')" height="13px" width="18px"></td>
                    <td bgcolor=C099EC ONCLICK="createColor('C099EC')" height="13px" width="18px"></td>
                    <td bgcolor=EB9BD6 ONCLICK="createColor('EB9BD6')" height="13px" width="18px"></td>
                    <td bgcolor=FA8A96 ONCLICK="createColor('FA8A96')" height="13px" width="18px"></td>
                    <td bgcolor=FFAE88 ONCLICK="createColor('FFAE88')" height="13px" width="18px"></td>
                    <td bgcolor=FFC887 ONCLICK="createColor('FFC887')" height="13px" width="18px"></td>
                </tr>
                <tr>
                    <td bgcolor=FFDA68 ONCLICK="createColor('FFDA68')" height="13px" width="18px"></td>
                    <td bgcolor=FFFA6A ONCLICK="createColor('FFFA6A')" height="13px" width="18px"></td>
                    <td bgcolor=CDE87F ONCLICK="createColor('CDE87F')" height="13px" width="18px"></td>
                    <td bgcolor=94E682 ONCLICK="createColor('94E682')" height="13px" width="18px"></td>
                    <td bgcolor=82E6E4 ONCLICK="createColor('82E6E4')" height="13px" width="18px"></td>
                    <td bgcolor=84BAE6 ONCLICK="createColor('84BAE6')" height="13px" width="18px"></td>
                    <td bgcolor=8293E5 ONCLICK="createColor('8293E5')" height="13px" width="18px"></td>
                    <td bgcolor=B282E6 ONCLICK="createColor('B282E6')" height="13px" width="18px"></td>
                    <td bgcolor=E781CD ONCLICK="createColor('E781CD')" height="13px" width="18px"></td>
                    <td bgcolor=F86E7B ONCLICK="createColor('F86E7B')" height="13px" width="18px"></td>
                    <td bgcolor=FF9A69 ONCLICK="createColor('FF9A69')" height="13px" width="18px"></td>
                    <td bgcolor=FEBA67 ONCLICK="createColor('FEBA67')" height="13px" width="18px"></td>
                </tr>
                <tr>
                    <td bgcolor=FED24B ONCLICK="createColor('FED24B')" height="13px" width="18px"></td>
                    <td bgcolor=FFFA6A ONCLICK="createColor('FFFA6A')" height="13px" width="18px"></td>
                    <td bgcolor=CEE97E ONCLICK="createColor('CEE97E')" height="13px" width="18px"></td>
                    <td bgcolor=94E680 ONCLICK="createColor('94E680')" height="13px" width="18px"></td>
                    <td bgcolor=7AE6E8 ONCLICK="createColor('7AE6E8')" height="13px" width="18px"></td>
                    <td bgcolor=82BBE6 ONCLICK="createColor('82BBE6')" height="13px" width="18px"></td>
                    <td bgcolor=8293E5 ONCLICK="createColor('8293E5')" height="13px" width="18px"></td>
                    <td bgcolor=B282E6 ONCLICK="createColor('B282E6')" height="13px" width="18px"></td>
                    <td bgcolor=E583CC ONCLICK="createColor('E583CC')" height="13px" width="18px"></td>
                    <td bgcolor=F86E7B ONCLICK="createColor('F86E7B')" height="13px" width="18px"></td>
                    <td bgcolor=FF9A6A ONCLICK="createColor('FF9A6A')" height="13px" width="18px"></td>
                    <td bgcolor=FEBA69 ONCLICK="createColor('FEBA69')" height="13px" width="18px"></td>
                </tr>
                <tr>
                    <td bgcolor=FED24B ONCLICK="createColor('FED24B')" height="13px" width="18px"></td>
                    <td bgcolor=FFF94D ONCLICK="createColor('FFF94D')" height="13px" width="18px"></td>
                    <td bgcolor=C5E465 ONCLICK="createColor('C5E465')" height="13px" width="18px"></td>
                    <td bgcolor=7FE168 ONCLICK="createColor('7FE168')" height="13px" width="18px"></td>
                    <td bgcolor=69E1E0 ONCLICK="createColor('69E1E0')" height="13px" width="18px"></td>
                    <td bgcolor=68AEE1 ONCLICK="createColor('68AEE1')" height="13px" width="18px"></td>
                    <td bgcolor=6A7CE2 ONCLICK="createColor('6A7CE2')" height="13px" width="18px"></td>
                    <td bgcolor=A469E1 ONCLICK="createColor('A469E1')" height="13px" width="18px"></td>
                    <td bgcolor=E169C3 ONCLICK="createColor('E169C3')" height="13px" width="18px"></td>
                    <td bgcolor=FA5263 ONCLICK="createColor('FA5263')" height="13px" width="18px"></td>
                    <td bgcolor=FE854C ONCLICK="createColor('FE854C')" height="13px" width="18px"></td>
                    <td bgcolor=FFAC4C ONCLICK="createColor('FFAC4C')" height="13px" width="18px"></td>
                </tr>
                <tr>
                    <td bgcolor=FFCB2D ONCLICK="createColor('FFCB2D')" height="13px" width="18px"></td>
                    <td bgcolor=FFF82C ONCLICK="createColor('FFF82C')" height="13px" width="18px"></td>
                    <td bgcolor=BAE04D ONCLICK="createColor('BAE04D')" height="13px" width="18px"></td>
                    <td bgcolor=6ADC50 ONCLICK="createColor('6ADC50')" height="13px" width="18px"></td>
                    <td bgcolor=50DCD9 ONCLICK="createColor('50DCD9')" height="13px" width="18px"></td>
                    <td bgcolor=3792D8 ONCLICK="createColor('3792D8')" height="13px" width="18px"></td>
                    <td bgcolor=3650D9 ONCLICK="createColor('3650D9')" height="13px" width="18px"></td>
                    <td bgcolor=8537D8 ONCLICK="createColor('8537D8')" height="13px" width="18px"></td>
                    <td bgcolor=D637AE ONCLICK="createColor('D637AE')" height="13px" width="18px"></td>
                    <td bgcolor=F6182D ONCLICK="createColor('F6182D')" height="13px" width="18px"></td>
                    <td bgcolor=FE5D0F ONCLICK="createColor('FE5D0F')" height="13px" width="18px"></td>
                    <td bgcolor=FF8F0F ONCLICK="createColor('FF8F0F')" height="13px" width="18px"></td>
                </tr>
                <tr>
                    <td bgcolor=EFB400 ONCLICK="createColor('EFB400')" height="13px" width="18px"></td>
                    <td bgcolor=F0E801 ONCLICK="createColor('F0E801')" height="13px" width="18px"></td>
                    <td bgcolor=A2CB27 ONCLICK="createColor('A2CB27')" height="13px" width="18px"></td>
                    <td bgcolor=45C928 ONCLICK="createColor('45C928')" height="13px" width="18px"></td>
                    <td bgcolor=28C8C6 ONCLICK="createColor('28C8C6')" height="13px" width="18px"></td>
                    <td bgcolor=2784C7 ONCLICK="createColor('2784C7')" height="13px" width="18px"></td>
                    <td bgcolor=2843C8 ONCLICK="createColor('2843C8')" height="13px" width="18px"></td>
                    <td bgcolor=7527C9 ONCLICK="createColor('7527C9')" height="13px" width="18px"></td>
                    <td bgcolor=C9279F ONCLICK="createColor('C9279F')" height="13px" width="18px"></td>
                    <td bgcolor=E90419 ONCLICK="createColor('E90419')" height="13px" width="18px"></td>
                    <td bgcolor=F04F01 ONCLICK="createColor('F04F01')" height="13px" width="18px"></td>
                    <td bgcolor=F18000 ONCLICK="createColor('F18000')" height="13px" width="18px"></td>
                </tr>
                <tr>
                    <td bgcolor=D29D00 ONCLICK="createColor('D29D00')" height="13px" width="18px"></td>
                    <td bgcolor=D2CB01 ONCLICK="createColor('D2CB01')" height="13px" width="18px"></td>
                    <td bgcolor=8DB31F ONCLICK="createColor('8DB31F')" height="13px" width="18px"></td>
                    <td bgcolor=3EAE24 ONCLICK="createColor('3EAE24')" height="13px" width="18px"></td>
                    <td bgcolor=23AFAE ONCLICK="createColor('23AFAE')" height="13px" width="18px"></td>
                    <td bgcolor=2373AE ONCLICK="createColor('2373AE')" height="13px" width="18px"></td>
                    <td bgcolor=243BAD ONCLICK="createColor('243BAD')" height="13px" width="18px"></td>
                    <td bgcolor=6723AE ONCLICK="createColor('6723AE')" height="13px" width="18px"></td>
                    <td bgcolor=AF238C ONCLICK="createColor('AF238C')" height="13px" width="18px"></td>
                    <td bgcolor=CB0617 ONCLICK="createColor('CB0617')" height="13px" width="18px"></td>
                    <td bgcolor=D24500 ONCLICK="createColor('D24500')" height="13px" width="18px"></td>
                    <td bgcolor=D27100 ONCLICK="createColor('D27100')" height="13px" width="18px"></td>
                </tr>
                <tr>
                    <td bgcolor=967001 ONCLICK="createColor('967001')" height="13px" width="18px"></td>
                    <td bgcolor=969101 ONCLICK="createColor('969101')" height="13px" width="18px"></td>
                    <td bgcolor=658017 ONCLICK="createColor('658017')" height="13px" width="18px"></td>
                    <td bgcolor=2B7D19 ONCLICK="createColor('2B7D19')" height="13px" width="18px"></td>
                    <td bgcolor=197D7B ONCLICK="createColor('197D7B')" height="13px" width="18px"></td>
                    <td bgcolor=19527F ONCLICK="createColor('19527F')" height="13px" width="18px"></td>
                    <td bgcolor=192A7C ONCLICK="createColor('192A7C')" height="13px" width="18px"></td>
                    <td bgcolor=49197D ONCLICK="createColor('49197D')" height="13px" width="18px"></td>
                    <td bgcolor=78105F ONCLICK="createColor('78105F')" height="13px" width="18px"></td>
                    <td bgcolor=910512 ONCLICK="createColor('910512')" height="13px" width="18px"></td>
                    <td bgcolor=973101 ONCLICK="createColor('973101')" height="13px" width="18px"></td>
                    <td bgcolor=973101 ONCLICK="createColor('973101')" height="13px" width="18px"></td>
                </tr>
                <tr>
                    <td bgcolor=594500 ONCLICK="createColor('594500')" height="13px" width="18px"></td>
                    <td bgcolor=5A5600 ONCLICK="createColor('5A5600')" height="13px" width="18px"></td>
                    <td bgcolor=3D4D0E ONCLICK="createColor('3D4D0E')" height="13px" width="18px"></td>
                    <td bgcolor=194B0E ONCLICK="createColor('194B0E')" height="13px" width="18px"></td>
                    <td bgcolor=0F4B49 ONCLICK="createColor('0F4B49')" height="13px" width="18px"></td>
                    <td bgcolor=0E304B ONCLICK="createColor('0E304B')" height="13px" width="18px"></td>
                    <td bgcolor=0F194C ONCLICK="createColor('0F194C')" height="13px" width="18px"></td>
                    <td bgcolor=2C0E4A ONCLICK="createColor('2C0E4A')" height="13px" width="18px"></td>
                    <td bgcolor=4A0F3B ONCLICK="createColor('4A0F3B')" height="13px" width="18px"></td>
                    <td bgcolor=58020B ONCLICK="createColor('58020B')" height="13px" width="18px"></td>
                    <td bgcolor=591D01 ONCLICK="createColor('591D01')" height="13px" width="18px"></td>
                    <td bgcolor=5B3302 ONCLICK="createColor('5B3302')" height="13px" width="18px"></td>
                </tr>
            </table>
			</td></tr>
		</table>

		<table border="0" cellpadding="5" cellspacing="0" width="100%">
			<tr><td height="5"></td></tr>

			<tr>
				<td align="center">
				<script>document.write('<input type="button" onClick="window.close();" value="' + editor_lang[33] + '" class="input">');</script>
				</td>
			</tr>
		</table>
		</td>
	</tr>
</table>