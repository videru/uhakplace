<?
	include_once("../include/lib.php");
	require_once("admin_chk.php");

    $rs_list = new $rs_class($dbcon);
	$rs_list->clear();
	$rs_list->set_table($_table['consult']);
			
			
    /***********************************************************************/
   // ���� ���ǿ� ���� ���͸�
//	 if($ss[0]){ $rs_list->add_where("process_state = $ss[0]"); } 
//	 if($ss[1]){ $rs_list->add_where("national = $ss[1]"); } 
	// �˻���� �˻�
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
    <td background="images/title_bg.gif" style="padding:9pt 0pt 0pt 10pt" valign="top"><font color=#000000><b>1:1����������</b></font></td>
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
    <td background="images/search_bg_middle.gif" style="padding:0pt 0pt 0pt 15pt" class="tt4">�̸� <input name="kw" type="text" id="kw" value="<?=$kw?>" size="25" class="cc"> <INPUT onfocus=this.blur() type=image src="images/bt_order_search.gif" align="absmiddle"></td>
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
    <td width="40" align="center" class="tt6">NO</td>
	<td width="50" align="center" class="tt6">���Ϸ�</td>
	<td width="35" align="center" class="tt6">����</td>
	<td width="40" align="center" class="tt6">�̸�</td>
	<td width="140" align="center" class="tt6">�̸���</td>
	<td width="90" align="center" class="tt6">��ȭ</td>
	<td width="90" align="center" class="tt6">�ڵ���</td>
	<td width="220" align="center" class="tt6">�޸�</td>
	<td width="60" align="center" class="tt6">�����</td>
  </tr>   
  <?
	if($rs_list->num_rows()<1) {
		echo "
	<tr height=\"100\"  bgcolor=\"#FFFFFF\" >
		<td align=\"center\" colspan=\"12\"><B>���(�˻�) �� �ڷᰡ �����ϴ�.</td>
	</tr>";
	}
	
	$rs_list->set_table($_table['consult']);
	
	$no = $page_info['start_no'];
	while($R=$rs_list->fetch()) {
		$no--;
?>
  <tr height="30" > 
    <td align="center" class="tt5"><?=$no?></td>
	<td align="center" class="tt5"><a href="consult_edit.php?process2=2&name=<?=$R[name]?>&email=<?=$R[email]?>&hp=<?=$R[hp]?>&num=<?=$R[num]?>">���Ϸ�</a></td>
	<td align="center" class="tt5"><a href="consult_edit.php?<?=$p_str?>&page=<?=$page?>&mode=delete&num=<?=$R[num]?>"><img src=images/sbt_del.gif border="0"></a></td>
    <td align="center" class="tt5"><?=$R[name]?></td>	
    <td align="center" class="tt5"><?=$R[email]?></td>
    <td align="center" class="tt5"><?=$R[tel]?></td>	
    <td align="center" class="tt5"><?=$R[hp]?></td>	
    <td class="tt5_l"><a href="#" onclick="window_open('./consult_edit.php?mode=modify&num=<?=$R[num]?>','con','scrollbars=no,width=300,height=120');"><?=rg_cut_string($R[etc_memo],34,'...')?></a></td>	
    <td align="center" class="tt5"><?=rg_date($R[reg_date],'%y/%m/%d')?></td>
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