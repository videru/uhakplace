<?

	include_once("../include/lib.php");
	require_once("admin_chk.php");
	

    $rs_list = new $rs_class($dbcon);
	$rs_list->clear();
	$rs_list->set_table($_table['alim']);
	
	$rs_list->add_order("num DESC");
	
	$page_info=$rs_list->select_list($page,20,10);


	if($_SERVER['REQUEST_METHOD']=='POST') {

			$rs->clear();
	    	$rs->set_table($_table['alim']);
	    	$rs->add_field("text","$text");

		if($mode=='modify') {
			
			$rs->add_where("num=$num");
			$rs->update();
		} else {
			$rs->insert();
			$num=$rs->get_insert_id();		
		}
		
		$rs->commit();
		rg_href("main_alim.php");
	}

?>
<? include("_header.php"); ?>
<? include("admin.header.php"); ?>
<table border="0" cellpadding="0" cellspacing="0" width="800" align="center">
  <tr height="40">
    <td background="images/title_bg.gif" style="padding:9pt 0pt 0pt 10pt" valign="top"><font color=#000000><b>메인알림</b></font></td>
  </tr>
</table>



<form name="mb_form" method="post" action="?<?=$_get_param[3]?>" enctype="multipart/form-data">

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
<form name="mb_form" method="post" action="?<?=$_get_param[3]?>" enctype="multipart/form-data">
<table border="0" cellpadding="0" cellspacing="0" width="770" align=center>
	<tr>
		<td bgcolor="#BECCDD" height="2" colspan="5"></td>
	</tr>  
	
	<tr height="30">
			<td width="40" align="center" class="tt5">신규</td>	
		<td width="335"><input name="text" type="text" class="cc" size=70></td>
		<td ><INPUT onfocus=this.blur() type=image src="images/sbt_regi.gif"></td>
	</tr>
	<tr>
		<td bgcolor="#BECCDD" height="2" colspan="5"></td>
	</tr>  
</table>
</form>


<table border="0" cellpadding="0" cellspacing="0" width="770" align=center>
	<tr>
		<td bgcolor="#BECCDD" height="1" colspan="5"></td>
	</tr>  
 <?
	if($rs_list->num_rows()<1) {
		echo "
	<tr height=\"100\"  bgcolor=\"#FFFFFF\" >
		<td align=\"center\" colspan=\"9\"><B>등록(검색) 된 자료가 없습니다.</td>
	</tr>";
	}
	
	$rs_list->set_table($_table['alim']);
		
	$no = $page_info['start_no'];
	while($R=$rs_list->fetch()) {
		$no--;

?>	
<form name="mb_form" method="post" action="?<?=$_get_param[3]?>" enctype="multipart/form-data">
<input type="hidden" name="mode" value="modify" />
<input type="hidden" name="num" value="<?=$R[num]?>" />
	<tr height="30">
		<td width="40" align="center" class="tt5"><?=$no?></td>
		<td  width="335"><input name="text" type="text" value="<?=$R["text"]?>" class="cc" size=40></td>
	<td width="40"><INPUT onfocus=this.blur() type=image src="images/sbt_modify.gif"></td>
	<td ><a href="#" onClick="confirm_del('main_regi_edit.php?<?=$p_str?>&page=<?=$page?>&mode=delete&num=<?=$R[num]?>&national=<?=$R[national]?>')"><img src=images/sbt_del.gif border="0"></a></td>
	</tr>
</form>
	<tr>
		<td bgcolor="#BECCDD" height="1" colspan="5"></td>
	</tr>  
<?
}
?>
</table>
<br>
<table width="770"  align=center>
	<tr>
		<td align="center"><?=rg_navi_display($page_info,$_get_param[2]); ?></td>
	</tr>
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


<? include("admin.footer.php"); ?>
<? include("_footer.php"); ?>