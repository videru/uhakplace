<?

	include_once("../include/lib.php");
	require_once("admin_chk.php");
	


		$rs->clear();
		$rs->set_table($_table['real_regi']);

		$rs->select();
		
		$data=$rs->fetch();		

	  

	if($_SERVER['REQUEST_METHOD']=='POST') {

			$rs->clear();
	    	$rs->set_table($_table['real_regi']);
			$rs->add_field("v1","$v1");		
	    	$rs->add_field("v2","$v2");
			$rs->add_field("v3","$v3");	
			$rs->add_field("v4","$v4");	
			$rs->add_field("v5","$v5");		
	    	$rs->add_field("v6","$v6");
			$rs->add_field("v7","$v7");	
			$rs->add_field("v8","$v8");	
			$rs->add_field("v9","$v9");		
	    	$rs->add_field("v10","$v10");
			$rs->add_field("v11","$v11");	
			$rs->add_field("v12","$v12");	
			$rs->add_field("v13","$v13");		
	    	$rs->add_field("v14","$v14");
			$rs->add_field("v15","$v15");	
			$rs->add_field("v16","$v16");	
			$rs->add_field("v17","$v17");		
	    	$rs->add_field("v18","$v18");
			$rs->add_field("v19","$v19");	
			$rs->add_field("v20","$v20");
			$rs->add_field("v1_national","$v1_national");
			$rs->add_field("v2_national","$v2_national");
			$rs->add_field("v3_national","$v3_national");
			$rs->add_field("v4_national","$v4_national");
			$rs->add_field("v5_national","$v5_national");
			$rs->add_field("v6_national","$v6_national");
			$rs->add_field("v7_national","$v7_national");
			$rs->add_field("v8_national","$v8_national");
			$rs->add_field("v9_national","$v9_national");
			$rs->add_field("v10_national","$v10_national");
			$rs->add_field("v11_national","$v11_national");
			$rs->add_field("v12_national","$v12_national");
			$rs->add_field("v13_national","$v13_national");
			$rs->add_field("v14_national","$v14_national");
			$rs->add_field("v15_national","$v15_national");
			$rs->add_field("v16_national","$v16_national");
			$rs->add_field("v17_national","$v17_national");
			$rs->add_field("v18_national","$v18_national");
			$rs->add_field("v19_national","$v19_national");
			$rs->add_field("v20_national","$v20_national");
			$rs->update();		
		
		$rs->commit();
		rg_href("real_regi_edit.php");
	}

?>
<? include("_header.php"); ?>
<? include("admin.header.php"); ?>
<table border="0" cellpadding="0" cellspacing="0" width="800" align="center">
  <tr height="40">
    <td background="images/title_bg.gif" style="padding:9pt 0pt 0pt 10pt" valign="top"><font color=#000000><b>메인수속현황</b></font></td>
  </tr>
</table>
<form name="mb_form" method="post" action="?<?=$_get_param[3]?>" enctype="multipart/form-data">
<input type="hidden" name="mode" value="<?=$mode?>" />
<input type="hidden" name="num" value="<?=$num?>" />
<table border="0" cellpadding="0" cellspacing="0" width="800" align=center bgcolor="#FFFFFF">
    <tr>  
     <td>
  <table border="0" cellpadding="0" cellspacing="0" width="800" align=center>
	<tr>
		<td bgcolor="#666666" height="2"></td>
	</tr> 
	<tr>
		<td bgcolor="#FFFFFF" height="8"></td>
	</tr> 
  </table>
<table border="0" cellpadding="0" cellspacing="0" width="770" align=center>
	<tr>
		<td bgcolor="#BECCDD" height="1" colspan="3"></td>
	</tr>  
<?	
  for ($i=1; $i <= 20; $i++) {	
?>	
	
	<tr height="30">
		<td align="center" width="40"><strong><?=$i?></strong></td>
		<td width="65"><select name="v<?=$i?>_national" id="national" class="select">

<?=rg_html_option($_const['national'],$data["v".$i."_national"])?>

		</select>
		</td>
		<td><input name="v<?=$i?>" type="text" value="<?=$data["v".$i]?>" class="cc" size=90></td>
	</tr>
	<tr>
		<td bgcolor="#BECCDD" height="1" colspan="3"></td>
	</tr>  

<?}?>
</table>

  <table border="0" cellpadding="0" cellspacing="0" width="800" align=center>
	<tr>
		<td bgcolor="#FFFFFF" height="8"></td>
	</tr> 	
	<tr>
		<td bgcolor="#666666" height="2"></td>
	</tr> 
  </table>

  </td>
  </tr>
</table>
<br>
<table width="770" border="0" align=center>
	<tr>
		<td align="center"><INPUT onfocus=this.blur() type=image src="images/bt_write.gif"></td>
	</tr>
</table>
</form>

<? include("admin.footer.php"); ?>
<? include("_footer.php"); ?>