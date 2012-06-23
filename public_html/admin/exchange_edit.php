<?

	include_once("../include/lib.php");
	require_once("admin_chk.php");
  
               
	if($mode=='modify') {
		$rs->clear();
		$rs->set_table($_table['exchange']);

		$rs->select();
		$ex=$rs->fetch();		
	}

?>


<link href="<?=$_url['css']?>style.css" rel="stylesheet" type="text/css">

<form name="online_form" method="post" action="exchange_edit_ok.php" onSubmit="return validate(this)" enctype="multipart/form-data">
<input type="hidden" name="mode" value="<?=$mode?>" />
<table border="0" cellpadding="1" cellspacing="1" width="450" align="center" bgcolor="#CCCCCC">
	
	<tr height="22">
		<td width="90" align="center" bgcolor="#EFEFEF"><font color="#525252"><strong>유로</strong></font></td>
		<td  bgcolor="#FFFFFF">&nbsp;<input name="exchange1" type="text" value="<?=$ex[exchange1]?>" class="input" size=10></td>
	</tr>	
	
	<tr height="22">
		<td width="90" align="center" bgcolor="#EFEFEF"><font color="#525252"><strong>미국(USD)</strong></font></td>
		<td  bgcolor="#FFFFFF">&nbsp;<input name="exchange3" type="text" value="<?=$ex[exchange3]?>" class="input" size=10></td>
	</tr>		
	<tr height="22">
		<td width="90" align="center" bgcolor="#EFEFEF"><font color="#525252"><strong>영국(파운드)</strong></font></td>
		<td  bgcolor="#FFFFFF">&nbsp;<input name="exchange4" type="text" value="<?=$ex[exchange4]?>" class="input" size=10></td>
	</tr>
	<tr height="22">
		<td width="90" align="center" bgcolor="#EFEFEF"><font color="#525252"><strong>일본(엔)</strong></font></td>
		<td  bgcolor="#FFFFFF">&nbsp;<input name="exchange5" type="text" value="<?=$ex[exchange5]?>" class="input" size=10></td>
	</tr>	
	<tr height="22">
		<td width="90" align="center" bgcolor="#EFEFEF"><font color="#525252"><strong>캐나다(CAD)</strong></font></td>
		<td bgcolor="#FFFFFF">&nbsp;<input name="exchange7" type="text" value="<?=$ex[exchange7]?>" class="input" size=10></td>
	</tr>	
	<tr height="22">
		<td width="90" align="center" bgcolor="#EFEFEF"><font color="#525252"><strong>호주(AUD)</strong></font></td>
		<td bgcolor="#FFFFFF">&nbsp;<input name="exchange8" type="text" value="<?=$ex[exchange8]?>" class="input" size=10></td>
	</tr>	
</table>
<br>
<table width="450" border="0" align="center">
	<tr>
		<td align="center">
			<input type="submit" value=" 수 정 " class="button">
		</td>
	</tr>
</table>
</form>