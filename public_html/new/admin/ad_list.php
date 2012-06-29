<?
	include_once("../include/lib.php");
	require_once("admin_chk.php");

	$rs_list = new $rs_class($dbcon);
	$rs_list->clear();
	$rs_list->set_table($_table['cf']);
	
			
			
    /***********************************************************************/
   // 필터 조건에 의한 필터링

	// 검색어로 검색
	if($kw) { $rs_list->add_where("company_name LIKE '%$kw%' escape '".$dbcon->escape_ch."'");} 

	switch ($ot) {
		case 10 : $rs_list->add_order("co_no DESC");		break;
		default : $rs_list->add_order("co_no DESC");		break;
	}
	
	$page_info=$rs_list->select_list($page,20,10);

?>	
<? include("_header.php"); ?>
<? include("admin.header.php"); ?>
<table border="0" cellpadding="0" cellspacing="0" width="800" align="center">
  <tr height="40">
    <td background="images/title_bg.gif" style="padding:9pt 0pt 0pt 10pt" valign="top"><font color=#000000><b>광고문의</b></font></td>
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
<table width="770" cellspacing="0" style="border-collapse:collapse;table-layout:auto"  align="center">
<form name="search_form" method="get" enctype="multipart/form-data">
	<tr> 
		<td>
			회사명 : <input name="kw" type="text" id="kw" value="<?=$kw?>" size="14" class="input"> <input type="submit" name="검색" value="검색" class="button"> 
			<input type="button" value="취소" onclick="location.href='?'" class="button">
		</td>
		<td align="right">Total : 
			<?=$page_info['total_rows']?>
			(<?=$page_info['page']?>/<?=$page_info['total_page']?>)</td>
    </tr>
</form>
</table>
<table width="770" border="0" cellpadding="0" cellspacing="0" align="center">
  <tr bgcolor="#456285" height="25"> 
	<td width="25" align="center" class="tt6">NO</td>
    <td width="40" align="center" class="tt6">수정</td>
	<td width="40" align="center" class="tt6">삭제</td>
	<td width="160" align="center" class="tt6">회사명</td>
	<td width="60" align="center" class="tt6">대표자명</td>
	<td width="60" align="center" class="tt6">담당자명</td>
	<td width="85" align="center" class="tt6">전화번호</td> 
	<td width="85" align="center" class="tt6">핸드폰</td> 
	<td width="145" align="center" class="tt6">이메일</td>
	<td width="70" align="center" class="tt6">등록일</td>
  </tr> 
  <tr>
	<td bgcolor="#BECCDD" height="1" colspan="10"></td>
  </tr>   
  <?
	if($rs_list->num_rows()<1) {
		echo "
	<tr height=\"100\"  bgcolor=\"#FFFFFF\" >
		<td align=\"center\" colspan=\"10\"><B>등록(검색) 된 자료가 없습니다.</td>
	</tr>";
	}
	
	$rs_list->set_table($_table['cf']);
	
	
	$no = $page_info['start_no'];
	while($R=$rs_list->fetch()) {
		$no--;

?>
  <tr bgcolor="#FFFFFF" height="25"> 
	<td align="center" style="padding:5pt 2pt 2pt 5pt"><?=$no?></td>
	<td align="center" ><a href="ad_edit.php?<?=$p_str?>&page=<?=$page?>&mode=modify&num=<?=$R[co_no]?>"><img src=images/sbt_modify.gif border="0"></a></td> 
	<td align="center" ><a href="ad_edit.php?<?=$p_str?>&page=<?=$page?>&mode=delete&num=<?=$R[co_no]?>"><img src=images/sbt_del.gif border="0"></a></td> 
    <td align="center"><?=$R[company_name]?></td>	
    <td align="center"><?=$R[president_name]?></td>
    <td align="center"><?=$R[silmu_name]?></td>	
    <td align="center"><?=$R[company_tel]?></td>	
    <td align="center"><?=$R[company_hp]?></td>	
    <td align="center"><?=$R[company_email]?></td>
    <td align="center"><?=rg_date($R[reg_date],'%Y-%m-%d')?></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="1" colspan="10"></td>
  </tr> 
<?
}
?>
</table>
<br>
<table width="770">
	<tr>
		<td align="center">
<?=rg_navi_display($page_info,$_get_param[2]); ?>
		</td>
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