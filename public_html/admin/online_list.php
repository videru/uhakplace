<?
	include_once("../include/lib.php");
	require_once("admin_chk.php");

    $rs_list = new $rs_class($dbcon);
	$rs_list->clear();
	$rs_list->set_table($_table['consult']);
	
			
			
    /***********************************************************************/
   // ���� ���ǿ� ���� ���͸�

	// �˻���� �˻�
	if($kw) { $rs_list->add_where("company_name LIKE '%$kw%' escape '".$dbcon->escape_ch."'");} 

	switch ($ot) {
		case 10 : $rs_list->add_order("co_no DESC");		break;
		default : $rs_list->add_order("co_no DESC");		break;
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
			ȸ��� : <input name="kw" type="text" id="kw" value="<?=$kw?>" size="14" class="input"> <input type="submit" name="�˻�" value="�˻�" class="button"> 
			<input type="button" value="���" onclick="location.href='?'" class="button">
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
	<td width="60" align="center">[����]</td>
	<td width="60" align="center">[����]</td>
	<td width="180" align="center">ȸ���</td>
	<td width="100" align="center">��ǥ�ڸ�</td>
	<td width="100" align="center">����ڸ�</td>
	<td width="140" align="center">��ȭ��ȣ</td> 
	<td width="200" align="center">�̸���</td>
	<td width="100" align="center">�����</td>
  </tr>   
  <?
	if($rs_list->num_rows()<1) {
		echo "
	<tr height=\"100\"  bgcolor=\"#FFFFFF\" >
		<td align=\"center\" colspan=\"9\"><B>���(�˻�) �� �ڷᰡ �����ϴ�.</td>
	</tr>";
	}
	
	$rs_list->set_table($_table['online']);
	
	
	$no = $page_info['start_no'];
	while($R=$rs_list->fetch()) {
		$no--;

?>
  <tr bgcolor="#FFFFFF" height="30"> 
    <td align="center"><?=$no?></td>
	<td align="center"><a href="consult_edit.php?<?=$p_str?>&page=<?=$page?>&mode=modify&num=<?=$R[no]?>">[����]</a></td>
	<td align="center"><a href="consult_edit.php?<?=$p_str?>&page=<?=$page?>&mode=delete&num=<?=$R[no]?>?>">[����]</td>
    <td align="center"><?=$R[company_name]?></td>	
    <td align="center"><?=$R[president_name]?></td>
    <td align="center"><?=$R[silmu_name]?></td>	
    <td align="center"><?=$R[company_tel]?></td>	
    <td align="center"><?=$R[company_hp]?></td>
    <td align="center"><?=$R[company_email]?></td>
    <td align="center"><?=$R[reg_date]?></td>
  </tr>
<?
}
?>
</table>
<table width="980">
	<tr>
		<td align="center">
<?=rg_navi_display($page_info,$_get_param[2]); ?>
		</td>
	</tr>
</table>