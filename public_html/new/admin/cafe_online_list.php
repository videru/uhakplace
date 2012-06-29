<?
	include_once("../include/lib.php");
	require_once("admin_chk.php");

    $rs_list = new $rs_class($dbcon);
	$rs_list->clear();
	$rs_list->set_table($_table['cafe_online']);
			
			
    /***********************************************************************/
   // 필터 조건에 의한 필터링
//	 if($ss[0]){ $rs_list->add_where("process_state = $ss[0]"); } 
//	 if($ss[1]){ $rs_list->add_where("national = $ss[1]"); } 
	// 검색어로 검색
	if($kw) { $rs_list->add_where("name LIKE '%$kw%' escape '".$dbcon->escape_ch."'");} 

	switch ($ot) {
		case 10 : $rs_list->add_order("num DESC");		break;
		default : $rs_list->add_order("num DESC");		break;
	}
	
	$page_info=$rs_list->select_list($page,20,10);

	$MENU_L='m5';	
?>	
<? include("_header.php"); ?>
<? include("admin.header.php"); ?>
<table border="0" cellpadding="0" cellspacing="0" width="800" align="center">
  <tr height="40">
    <td background="images/title_bg.gif" style="padding:9pt 0pt 0pt 10pt" valign="top"><font color=#000000><b>카페온라인신청</b></font></td>
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
    <td><img src="images/search_bg_top.gif" width="770" height="16"></td>
  </tr>
  <tr>
    <td background="images/search_bg_middle.gif" style="padding:0pt 0pt 0pt 15pt" class="tt4">이름 <input name="kw" type="text" id="kw" value="<?=$kw?>" size="25" class="cc"> <INPUT onfocus=this.blur() type=image src="images/bt_order_search.gif" align="absmiddle"></td>
  </tr>
  <tr> 
    <td background="images/search_bg_middle.gif" align="center"><img src=images/icon_line.gif border="0"></td>
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
<table width="770" border="0" cellpadding="0" cellspacing="0" align="center">
  <tr bgcolor="#456285" height="25"> 
    <td width="30" align="center" class="tt6">NO</td>
	<td width="35" align="center" class="tt6">삭제</td>
	<td width="40" align="center" class="tt6">이름</td>
	<td width="150" align="center" class="tt6">이메일</td>
	<td width="80" align="center" class="tt6">핸드폰</td>
	<td width="190" align="center" class="tt6">연수희망과정</td>
	<td width="190" align="center" class="tt6">예상출국시기</td>
	<td width="60" align="center" class="tt6">등록일</td>
  </tr>   
  <?
	if($rs_list->num_rows()<1) {
		echo "
	<tr height=\"100\"  bgcolor=\"#FFFFFF\" >
		<td align=\"center\" colspan=\"12\"><B>등록(검색) 된 자료가 없습니다.</td>
	</tr>";
	}
	
	$rs_list->set_table($_table['cafe_online']);
	
	$no = $page_info['start_no'];
	while($R=$rs_list->fetch()) {
		$no--;
?>
  <tr height="20"> 
    <td align="center" class="tt5" rowspan="3"><?=$no?></td>
	<td align="center" class="tt5" rowspan="3"><a href="#" onClick="confirm_del('cafe_online_edit.php?<?=$p_str?>&page=<?=$page?>&mode=delete&num=<?=$R[num]?>')"><img src=images/sbt_del.gif border="0"></a></td>
    <td align="center" class="tt5"><?=$R[name]?></td>	
    <td align="center" class="tt5"><?=$R[email]?></td>
    <td align="center" class="tt5"><?=$R[hp]?></td>	
    <td align="center" class="tt5"><?=$_cafe[class_type][$R[e1]]?></td>	
    <td align="center" class="tt5"><?=$_cafe[gigan][$R[p4]]?>(<?=$R[p1]?>.<?=$R[p2]?>.<?=$R[p3]?>)</td>	
    <td align="center" class="tt5"><?=rg_date($R[reg_date],'%y/%m/%d')?></td>
  </tr>
  <tr>
    <td bgcolor="#BECCDD" height="1" colspan="6"></td>
  </tr>
  <tr height="20">
    <td class="tt5_l" colspan="6"><font title="<?=$R[etc_memo]?>"><?=$R[etc_memo]?></font></td>	
  </tr>
  <tr>
    <td bgcolor="#BECCDD" height="1" colspan="13"></td>
  </tr>
<?
}
?>
</table>
<br>
<table width="770" align="center">
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