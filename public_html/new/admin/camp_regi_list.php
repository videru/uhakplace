<?
	include_once("../include/lib.php");
	require_once("admin_chk.php");

    $rs_list = new $rs_class($dbcon);
	$rs_list->clear();
	$rs_list->set_table($_table['camp_regi']);
	
			
			
    /***********************************************************************/
   // 필터 조건에 의한 필터링

	 if($ss[1]){ $rs_list->add_where("process = $ss[1]"); } 
	// 검색어로 검색
	if($kw) { $rs_list->add_where("student_name LIKE '%$kw%' escape '".$dbcon->escape_ch."'");} 

	switch ($ot) {
		case 10 : $rs_list->add_order("regi_no DESC");		break;
		default : $rs_list->add_order("regi_no DESC");		break;
	}
	
	$page_info=$rs_list->select_list($page,20,10);

	$MENU_L='m5';	
?>	
<? include("_header.php"); ?>
<? include("admin.header.php"); ?>
<table border="0" cellpadding="0" cellspacing="0" width="800" align="center">
  <tr height="40">
    <td background="images/title_bg.gif" style="padding:9pt 0pt 0pt 10pt" valign="top"><font color=#000000><b>캠프등록 관리</b></font></td>
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
<form name="search_form" method="get" enctype="multipart/form-data">
<table width="770" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr> 
    <td><img src="images/search_bg_top.gif" width="770" height="16"></td>
  </tr>
  <tr>
    <td background="images/search_bg_middle.gif" style="padding:0pt 0pt 0pt 15pt" class="tt4">국가 <select name="ss[1]" onChange="search_form.submit()" class="select">
<option value="">=전체=</option>
<?=rg_html_option($_reserv['sangdam'],"$ss[1]")?>
</select>&nbsp;&nbsp;&nbsp;이름 <input name="kw" type="text" id="kw" value="<?=$kw?>" size="30" class="cc"></td>
  </tr>
  <tr> 
    <td background="images/search_bg_middle.gif" align="center"><img src=images/icon_line.gif border="0"></td>
  </tr>
  <tr> 
    <td background="images/search_bg_middle.gif" style="padding:0pt 0pt 0pt 15pt"><INPUT onfocus=this.blur() type=image src="images/bt_order_search.gif">&nbsp;&nbsp;&nbsp;<a href="camp_regi_edit.php?<?=$p_str?>&page=<?=$page?>&mode=new")><img src=images/student_regi.gif border="0"></a></td>
  </tr>
  <tr> 
    <td><img src="images/search_bg_bottom.gif" width="770" height="16"></td>
  </tr>
</table>
</form>
<table width="770" align=center>
		<td align=right>Total: 
			<?=$page_info['total_rows']?>
			(<?=$page_info['page']?>/<?=$page_info['total_page']?>)</td>

</table>
<table width="770" border="0" cellpadding="0" cellspacing="0" align=center>
  <tr bgcolor="#456285" height="25"> 
    <td width="30" align="center" class="tt6">NO</td>
	<td width="40" align="center" class="tt6">수정</td>
	<td width="40" align="center" class="tt6">삭제</td>
	<td width="80" align="center" class="tt6">코스</td>
	<td width="50" align="center" class="tt6">이름</td>
	<td width="60" align="center" class="tt6">보호자</td>
	<td width="90" align="center" class="tt6">연락처</td>
	<td width="90" align="center" class="tt6">자택번호</td> 
	<td width="130" align="center" class="tt6">이메일</td>
	<td width="80" align="center" class="tt6">등록일</td>
	<td width="80" align="center" class="tt6">진행상황</td>
  </tr>   
  <?
	if($rs_list->num_rows()<1) {
		echo "
	<tr height=\"100\"  bgcolor=\"#FFFFFF\" >
		<td align=\"center\" colspan=\"13\"><B>등록(검색) 된 자료가 없습니다.</td>
	</tr>";
	}
	
	$rs_list->set_table($_table['camp_regi']);
	
	
	$no = $page_info['start_no'];
	while($R=$rs_list->fetch()) {
		$no--;


			switch ($R[process]) {
									case "4" : $font_sd="<font color='blue'>";break;
									case "3" : $font_sd="<font color='green'>";break;
									case "1" : $font_sd="<font color='red'>";break;
									case "2" : $font_sd="<font color=''>";break;
}

?>
  <tr bgcolor="#FFFFFF" height="25"> 
    <td align="center" class="tt5"><?=$no?></td>
	<td align="center" class="tt5"><a href="camp_regi_edit.php?<?=$p_str?>&page=<?=$page?>&mode=modify&num=<?=$R[regi_no]?>"><img src=images/sbt_modify.gif border="0"></a></td>
	<td align="center" class="tt5"><a href="camp_regi_edit.php?<?=$p_str?>&page=<?=$page?>&mode=delete&num=<?=$R[regi_no]?>"><img src=images/sbt_del.gif border="0"></td>
    <td align="center" class="tt5"><?=$_camp_s_list['camp'][$R[course]]?></td>	    
	<td align="center" class="tt5"><?=$R[student_name]?></td>	
    <td align="center" class="tt5"><?=$R[parent1]?></td>
    <td align="center" class="tt5"><?=$R[parent1_hp]?></td>
    <td align="center" class="tt5"><?=$R[tel]?></td>
    <td align="center" class="tt5"><?=$R[email]?></td>
    <td align="center" class="tt5"><?=rg_date($R[regi_date],'%Y-%m-%d')?></td>	
    <td align="center" class="tt5"><?=$font_sd?><?=$_reserv['sangdam'][$R[process]]?></font></td>	
  </tr>
  <tr>
    <td bgcolor="#BECCDD" height="1" colspan="11"></td>
  </tr>
<?
}
?>
</table><br>
<table width="770" align=center>
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