<?
	include_once("../include/lib.php");
	require_once("admin_chk.php");

    $rs_list = new $rs_class($dbcon);
	$rs_list->clear();
	$rs_list->set_table($_table['ger_sangdam']);
	
			
			
    /***********************************************************************/
   // 필터 조건에 의한 필터링

	 if($ss[1]){ $rs_list->add_where("national = $ss[1]"); } 
	// 검색어로 검색
	if($kw) { $rs_list->add_where("name LIKE '%$kw%' escape '".$dbcon->escape_ch."'");} 

	switch ($ot) {
		case 10 : $rs_list->add_order("regi_no DESC");		break;
		default : $rs_list->add_order("regi_no DESC");		break;
	}
	
	$page_info=$rs_list->select_list($page,20,10);

	$MENU_L='m5';	
?>	
<? include("_header.php"); ?>
<? include("admin.header.php"); ?>


<table width="980" cellspacing="0" style="border-collapse:collapse;table-layout:auto">
<form name="search_form" method="get" enctype="multipart/form-data">
	<tr> 
		<td>
국가 : <select name="ss[1]" onChange="search_form.submit()">
<option value="">=전체=</option>
<?=rg_html_option($_regi['national'],"$ss[1]")?>
</select> 
			이름 : <input name="kw" type="text" id="kw" value="<?=$kw?>" size="14" class="input"> <input type="submit" name="검색" value="검색" class="button"> 
			<input type="button" value="취소" onclick="location.href='?'" class="button">
		</td>
		<td align="right">Total : 
			<?=$page_info['total_rows']?>
			(<?=$page_info['page']?>/<?=$page_info['total_page']?>)</td>
    </tr>
</form>
</table>
<br>
<table width="980" border="0" cellpadding="0" cellspacing="1" bgcolor="#A8C3D8">
  <tr bgcolor="#F7F7F7" height="25"> 
    <td width="40" align="center">NO</td>
	<td width="60" align="center">[수정]</td>
	<td width="60" align="center">[삭제]</td>
	<td width="80" align="center">이름</td>
	<td width="100" align="center">담당지사</td>
	<td width="100" align="center">상담일</td> 
	<td width="100" align="center">등록일</td>
	<td width="130" align="center">국가</td>
	<td width="140" align="center">전화번호</td> 
	<td width="170" align="center">이메일</td>
  </tr>   
  <?
	if($rs_list->num_rows()<1) {
		echo "
	<tr height=\"100\"  bgcolor=\"#FFFFFF\" >
		<td align=\"center\" colspan=\"9\"><B>등록(검색) 된 자료가 없습니다.</td>
	</tr>";
	}
	
	$rs_list->set_table($_table['ger_sangdam']);
	
	
	$no = $page_info['start_no'];
	while($R=$rs_list->fetch()) {
		$no--;

?>
  <tr bgcolor="#FFFFFF" height="30"> 
    <td align="center"><?=$no?></td>
	<td align="center"><a href="regi_edit.php?<?=$p_str?>&page=<?=$page?>&mode=modify&num=<?=$R[regi_no]?>">[수정]</a></td>
	<td align="center"><a href="regi_edit.php?<?=$p_str?>&page=<?=$page?>&mode=delete&num=<?=$R[regi_no]?>?>">[삭제]</td>
    <td align="center"><?=$R[name]?></td>	
    <td align="center"><?=$_regi['chain'][$R[chain]]?></td>
    <td align="center"><?=$R[regi_date1]?>.<?=$R[regi_date2]?>.<?=$R[regi_date3]?></td>	
    <td align="center"><?=$R[abroad_date1]?>.<?=$R[abroad_date2]?>.<?=$R[abroad_date3]?></td>	
    <td align="center"><?=$_regi['national'][$R[national]]?></td>
    <td align="center"><?=$R[tel]?></td>
    <td align="center"><?=$R[email]?></td>
  </tr>
<?
}
?>
</table>
<table width="980">
	<tr>
		<td width="150">
			<input type="button" value="등록" class="button" onClick="location.href='regi_edit.php?<?=$p_str?>&page=<?=$page?>&mode=new'">
			<?php /*?><input type="button" value="삭제" class="button" onClick="regi_del();"><?php */?>
		</td>
		<td align="center">
<?=rg_navi_display($page_info,$_get_param[2]); ?>
		</td>
	</tr>
</table>