<?
	include_once("../include/lib.php");
	require_once("admin_chk.php");

    $rs_list = new $rs_class($dbcon);
	$rs_list->clear();
	$rs_list->set_table($_table['ger_sangdam']);
	
			
			
    /***********************************************************************/
   // ���� ���ǿ� ���� ���͸�

	 if($ss[1]){ $rs_list->add_where("national = $ss[1]"); } 
	// �˻���� �˻�
	if($kw) { $rs_list->add_where("name LIKE '%$kw%' escape '".$dbcon->escape_ch."'");} 

	switch ($ot) {
		case 10 : $rs_list->add_order("id DESC");		break;
		default : $rs_list->add_order("id DESC");		break;
	}
	
	$page_info=$rs_list->select_list($page,20,10);

	$MENU_L='m5';	
?>	
<? include("_header.php"); ?>
<? include("admin.header.php"); ?>
<table border="0" cellpadding="0" cellspacing="0" width="800" align="center">
  <tr height="40">
    <td background="images/title_bg.gif" style="padding:9pt 0pt 0pt 10pt" valign="top"><font color=#000000><b>��㿹��</b></font></td>
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
    <td background="images/search_bg_middle.gif" style="padding:0pt 0pt 0pt 15pt" class="tt4">���� <select name="ss[1]" onChange="search_form.submit()" class="select">
<option value="">=��ü=</option>
<?=rg_html_option($_const['national'],"$ss[1]")?>
</select> 
			�̸� <input name="kw" type="text" id="kw" value="<?=$kw?>" size="20" class="cc"></td>
  </tr>
  <tr> 
    <td background="images/search_bg_middle.gif" align="center"><img src=images/icon_line.gif border="0"></td>
  </tr>
  <tr> 
    <td background="images/search_bg_middle.gif" style="padding:0pt 0pt 0pt 15pt"><INPUT onfocus=this.blur() type=image src="images/bt_order_search.gif">&nbsp;&nbsp;&nbsp;<a href="ger_real_edit.php?<?=$p_str?>&page=<?=$page?>&mode=new"><img src=images/consult_regi.gif border="0"></a>
			<?php /*?><input type="button" value="�б�����" class="button" onClick="school_del();"><?php */?></td>
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
    <td width="30" class="tt6">NO</td>
	<td width="40" class="tt6">����</td>
	<td width="40" class="tt6">����</td>
	<td width="50" class="tt6">�̸�</td>
	<td width="40" class="tt6">����</td>
	<td width="60" class="tt6">�����</td> 
	<td width="60" class="tt6">��û��</td>
	<td width="60" class="tt6">����</td>
	<td width="90" class="tt6">��ȭ��ȣ</td> 
	<td width="160" class="tt6">�̸���</td>	
	<td width="70" class="tt6">�������</td> 
	<td width="70" class="tt6">������</td>
  </tr>   
  <?
	if($rs_list->num_rows()<1) {
		echo "
	<tr height=\"100\"  bgcolor=\"#FFFFFF\" >
		<td align=\"center\" colspan=\"12\"><B>���(�˻�) �� �ڷᰡ �����ϴ�.</td>
	</tr>";
	}
	
	$rs_list->set_table($_table['ger_sangdam']);
	
	
	$no = $page_info['start_no'];
	while($R=$rs_list->fetch()) {
		$no--;


				switch ($R[transaction]) {
									case "1" : $font_tran="<font color='red'>"; break;
									case "3" : $font_tran="<font color='green'>";break;
									case "2" : $font_tran="<font color='blue'>";break;
									case "4" : $font_tran="<font color=''>";break;
}
								switch ($R[sangdam]) {
									case "3" : $font_sd="<font color='green'>";break;
									case "1" : $font_sd="<font color='red'>";break;
									case "2" : $font_sd="<font color=''>";break;
}

?>
  <tr bgcolor="#FFFFFF" height="30"> 
    <td align="center" class="tt5"><?=$no?></td>
	<td align="center" class="tt5"><a href="ger_real_edit.php?<?=$p_str?>&page=<?=$page?>&mode=modify&num=<?=$R[id]?>"><img src=images/sbt_modify.gif border="0"></a></td>
	<td align="center" class="tt5"><a href="ger_real_edit.php?<?=$p_str?>&page=<?=$page?>&mode=delete&num=<?=$R[id]?>"><img src=images/sbt_del.gif border="0"></td>
    <td align="center" class="tt5"><?=$R[name]?></td>	
    <td align="center" class="tt5"><?=$_regi['chain'][$R[chain]]?></td>
    <td align="center" class="tt5"><?=rg_date($R[phone_sangdam],'%y.%m.%d')?></td>	
    <td align="center" class="tt5"><?=rg_date($R[reg_date],'%y.%m.%d')?></td>	
    <td align="center" class="tt5"><img src=images/main_real_national<?=$R[national]?>.gif>&nbsp;<?=$_const['national'][$R[national]]?></td>
    <td align="center" class="tt5"><?=$R[phone]?></td>
    <td align="center" class="tt5"><?=$R[email]?></td>
    <td align="center" class="tt5"><?=$font_tran?><?=$_reserv['transaction'][$R[transaction]]?></font></td>
    <td align="center" class="tt5"><?=$font_sd?><?=$_reserv['sangdam'][$R[sangdam]]?></font></td>
  </tr>
	<tr>
		<td bgcolor="#BECCDD" height="1" colspan="12"></td>
	</tr>  
<?
}
?>
</table>
<br>
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