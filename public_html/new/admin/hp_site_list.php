<?
	include_once("../include/lib.php");
	require_once("admin_chk.php");
	
	$rs_list = new $rs_class($dbcon);
	$rs_list->clear();
	$rs_list->set_table($_table['hp_site']);
 
    /***********************************************************************/
   // 필터 조건에 의한 필터링

	 if($ss[1]){ $rs_list->add_where("national = $ss[1]"); } 
     $rs_list->add_order("num DESC");


	$page_info=$rs_list->select_list($page,20,10);

	$MENU_L='m5';	


?>	

<? include("_header.php"); ?>
<? include("admin.header.php"); ?>
<table border="0" cellpadding="0" cellspacing="0" width="800" align="center">
  <tr height="40">
    <td background="images/title_bg.gif" style="padding:9pt 0pt 0pt 10pt" valign="top"><font color=#000000><b>페이지관리</b></font></td>
  </tr>
</table>
<br>
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



<table width="770" border="0" cellspacing="0" cellpadding="0" align="center">
 <form name="search_form" method="get" enctype="multipart/form-data">  

  <tr>
    <td background="images/search_bg_middle.gif" style="padding:0pt 0pt 0pt 15pt" class="tt4">국가 <select name="ss[1]" onChange="search_form.submit()" class="select">
<option value="">=전체=</option>
<?=rg_html_option($_const['national'],"$ss[1]")?>
</select>&nbsp;<a href="hp_site_edit.php?<?=$p_str?>&page=<?=$page?>&mode=new"><img src=images/school_regi.gif border="0" align="absmiddle"></a></td>
  </tr>
  <tr> 
    <td><img src="images/search_bg_bottom.gif" width="770" height="16"></td>
  </tr>
  </form>
</table>
<br>
<table width="770" align=center>
		<td align=right>Total: 
			<?=$page_info['total_rows']?>
			(<?=$page_info['page']?>/<?=$page_info['total_page']?>)</td>

</table>
<table width="770" align="center" border=0 cellpadding="1" cellspacing="1" bgcolor="#AEBFD1">
    <input type="hidden" name="school_id" value="<?=$school_id?>">
    <tr> 
      <td width="50" height="26" bgcolor="#EFEFEF" align="center">국가</td>
      <td bgcolor="#FFFFFF">&nbsp;&nbsp;<a href=?national=1>[필리핀]</a></td>
	</tr>    

</table><br>

<table width="770" align="center" border="0" cellpadding="0" cellspacing="1" bgcolor="#A8C3D8">
  <tr align="center" bgcolor="#F7F7F7" height="25">
    <td width="55" align="center">국가</td>
	<td width="40" align="center">코드</td> 
	<td align="center">페이지이름</td> 
	<td width="50" align="center">수정</td> 
	<td width="50" align="center">삭제</td> 
	<td width="90" align="center">페이지보기</td> 
  </tr>   
<?
	if($rs_list->num_rows()<1) {
		echo "
	<tr height=\"100\"  bgcolor=\"#FFFFFF\" >
		<td align=\"center\" colspan=\"9\"><B>등록(검색) 된 자료가 없습니다.</td>
	</tr>";
	}
	
	$rs_list->set_table($_table['hp_site']);
		
	$no = $page_info['start_no'];
	while($R=$rs_list->fetch()) {
		$no--;

?>
  <tr align="center" bgcolor="#FFFFFF" height="30">
	<td align="center"><?=$_const['national'][$R[national]]?></td>
    <td align="center"><?=$R[code]?></td>
    <td align="center"><?=$R[title]?></td>
    <td align="center"><a href="hp_site_edit.php?<?=$p_str?>&page=<?=$page?>&mode=modify&num=<?=$R[num]?>&page=<?=$page?>"><img src=images/sbt_modify.gif border="0"></a></td>
	<td align="center"><a href="#" onClick="confirm_del('hp_site_edit.php?<?=$p_str?>&page=<?=$page?>&mode=delete&num=<?=$R[num]?>&national=<?=$R[national]?>')"><img src=images/sbt_del.gif border="0"></a></td>
	<td align="center"><a href="../phil/site_view.php?code=<?=$R[code]?>" target="_blank">[페이지보기]</a></td>
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
<script language="JavaScript" type="text/JavaScript">
function open_window(name, url, left, top, width, height, toolbar, menubar, statusbar, scrollbar, resizable)
{
  toolbar_str = toolbar ? 'yes' : 'no';
  menubar_str = menubar ? 'yes' : 'no';
  statusbar_str = statusbar ? 'yes' : 'no';
  scrollbar_str = scrollbar ? 'yes' : 'no';
  resizable_str = resizable ? 'yes' : 'no';

  newWin= window.open(url, name, 'left='+left+',top='+top+',width='+width+',height='+height+',toolbar='+toolbar_str+',menubar='+menubar_str+',status='+statusbar_str+',scrollbars='+scrollbar_str+',resizable='+resizable_str);
}
</script>

