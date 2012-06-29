<?
	include_once("../include/lib.php");
	require_once("admin_chk.php");

    $rs_list = new $rs_class($dbcon);
	$rs_list->clear();
	$rs_list->set_table($_table['relaship']);
	
						
    /***********************************************************************/
   // 필터 조건에 의한 필터링

	 if($area){ $rs_list->add_where("area = $area"); } 
	
	$page_info=$rs_list->select_list($page,20,10);

	$MENU_L='m5';	
?>	

<? include("_header.php"); ?>
<? include("admin.header.php"); ?>


<table width="100%" cellspacing="0" style="border-collapse:collapse;table-layout:auto">
<form name="search_form" method="get" enctype="multipart/form-data">
	<tr> 
		<td>
지역 : <select name="area" onChange="search_form.submit()">
<option value="">=전체=</option>
<?=rg_html_option($_relaship['national'],"$area")?>
</select> 
		 <input type="submit" name="검색" value="검색" class="button"> 
			<input type="button" value="취소" onclick="location.href='?'" class="button">
		</td>
		<td align="right">Total : 
			<?=$page_info['total_rows']?>
			(<?=$page_info['page']?>/<?=$page_info['total_page']?>)</td>
    </tr>
</form>
</table>
<br>
<table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#A8C3D8">
  <tr bgcolor="#F7F7F7" height="25"> 
    <td width="30" align="center">NO</td>
	<td width="40" align="center">수정</td>
	<td width="40" align="center">삭제</td> 
	<td width="50" align="center">국가</td>
	<td width="85" align="center">제목</td>	
  </tr>   
  <?
	if($rs_list->num_rows()<1) {
		echo "
	<tr height=\"100\"  bgcolor=\"#FFFFFF\" >
		<td align=\"center\" colspan=\"9\"><B>등록(검색) 된 자료가 없습니다.</td>
	</tr>";
	}
	
	$rs_list->set_table($_table['relaship']);
	
	
	$no = $page_info['start_no'];
	while($R=$rs_list->fetch()) {
		$no--;

?>
  <tr bgcolor="#FFFFFF" height="30"> 
    <td align="center"><?=$no?></td>
	<td align="center"><a href="relaship_edit.php?<?=$p_str?>&page=<?=$page?>&mode=modify&num=<?=$R[num]?>">[수정]</a></td>
	<td align="center"><a href="relaship_edit.php?<?=$p_str?>&page=<?=$page?>&mode=delete&num=<?=$R[num]?>">[삭제]</td>
	<td align="center"><?=$_relaship['national'][$R[area]]?></td>
    <td>&nbsp;&nbsp;<?=$R[title]?></td>
 <?
}
?>
 </table>

<table width="100%">
	<tr>
		<td width="150">
			<input type="button" value="학교등록" class="button" onClick="location.href='relaship_edit.php?<?=$p_str?>&page=<?=$page?>&mode=new'">
			<?php /*?><input type="button" value="학교삭제" class="button" onClick="school_del();"><?php */?>
		</td>
		<td align="center">
<?=rg_navi_display($page_info,$_get_param[2]); ?>
		</td>
	</tr>
</table>