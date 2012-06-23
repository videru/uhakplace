<?
	include_once("../include/lib.php");
	require_once("admin_chk.php");

    $rs_list = new $rs_class($dbcon);
	$rs_list->clear();
	$rs_list->set_table($_table['sms']);
	
			
			
    /***********************************************************************/
   // 필터 조건에 의한 필터링

	 if($ss[1]){ $rs_list->add_where("national = $ss[1]"); } 
	 if($area){ $rs_list->add_where("area = $area"); } 
	// 검색어로 검색
	if($kw) { $rs_list->add_where("title LIKE '%$kw%' escape '".$dbcon->escape_ch."'");} 

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
    <td background="images/title_bg.gif" style="padding:9pt 0pt 0pt 10pt" valign="top"><font color=#000000><b>SMS 상담문의</b></font></td>
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

<table width="770" align=center>
		<td align=right>Total: 
			<?=$page_info['total_rows']?>
			(<?=$page_info['page']?>/<?=$page_info['total_page']?>)</td>

</table>
<table width="770" border="0" cellpadding="0" cellspacing="0" align=center>
  <tr bgcolor="#456285" height="25"> 
    <td width="30" align="center" class="tt6">NO</td>
	<td width="50" align="center" class="tt6">상담완료</td>
	<td width="40" align="center" class="tt6">삭제</td> 
	<td width="50" align="center" class="tt6">이름</td> 
	<td width="90" align="center" class="tt6">연락처</td> 
    <td width="370" align="center" class="tt6">상담내용</td> 
    <td width="140" align="center" class="tt6">등록일</td> 
  </tr> 
	<tr>
		<td bgcolor="#BECCDD" height="1" colspan="9"></td>
	</tr>  
  <?
	if($rs_list->num_rows()<1) {
		echo "
	<tr height=\"100\"  bgcolor=\"#FFFFFF\" >
		<td align=\"center\" colspan=\"9\"><B>등록(검색) 된 자료가 없습니다.</td>
	</tr>";
	}
	
	$rs_list->set_table($_table['sms']);		
	$no = $page_info['start_no'];
	while($R=$rs_list->fetch()) {
		$no--;
?>
  <tr bgcolor="#FFFFFF" height="25"> 
    <td align="center" class="tt5"><?=$no?></td>
	<td align="center" class="tt5">상담완료</td>
	<td align="center" class="tt5"><a href="#" onClick="confirm_del('sms_mtm_edit.php?<?=$p_str?>&page=<?=$page?>&mode=delete&num=<?=$R[num]?>')"><img src=images/sbt_del.gif border="0"></a></td>
    <td class="tt5">&nbsp;&nbsp;<?=$R[name]?></td>
    <td align="center" class="tt5"><?=$R[tel]?></td>
    <td class="tt5_l"><a href="#" onclick="window_open('./sms_mtm_edit.php?mode=modify&num=<?=$R[num]?>','con','scrollbars=no,width=300,height=80');"><?=rg_cut_string($R[text],34,'...')?></a></td>
    <td align="center" class="tt5"><?=rg_date($R[reg_date])?></td>
  </tr>
	<tr>
		<td bgcolor="#BECCDD" height="1" colspan="9"></td>
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