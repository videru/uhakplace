<?
/* =====================================================
	
  ���������� : 
 ===================================================== */
	include_once("../include/lib.php");
	require_once("admin_chk.php");
	
	$rs_list = new $rs_class($dbcon);
	$rs_list->clear();
	$rs_list->set_table($_table['member']);
    $rs_list->add_where("mb_id <> 'webadmin'");
	if(is_array($ss)) {
		foreach($ss as $__k => $__v) {
			switch ($__k) {
				/***********************************************************************/
				// �˻���� �˻�
				// 1=>'ȸ�����̵�',2=>'ȸ������',3=>'�ֹι�ȣ',4=>'ȸ���ּ�',5=>'��ȭ��ȣ', 6=>'�޴���',7=>'�̸���'
				case '0' : 
					if($kw!='' && $__v!='') {
						$ss_kw=$dbcon->escape_string($kw,DB_LIKE);
						switch ($__v) {
							case '1' : $rs_list->add_where("mb_id LIKE '%$ss_kw%' escape '".$dbcon->escape_ch."'"); break;
							case '2' : $rs_list->add_where("mb_name LIKE '%$ss_kw%' escape '".$dbcon->escape_ch."'"); break;
							case '3' : $jumin=$dbcon->escape_string(rg_password_encode($kw));
												 $rs_list->add_where("mb_jumin = '$jumin'"); break;
							case '4' : $rs_list->add_where("(mb_address1 LIKE '%$ss_kw%' escape '".$dbcon->escape_ch."' OR mb_address2 LIKE '%$ss_kw%' escape '".$dbcon->escape_ch."') "); break;
							case '5' : $rs_list->add_where("mb_tel1 LIKE '%$ss_kw%' escape '".$dbcon->escape_ch."'"); break;
							case '6' : $rs_list->add_where("mb_tel2 LIKE '%$ss_kw%' escape '".$dbcon->escape_ch."'"); break;
							case '7' : $rs_list->add_where("mb_email LIKE '%$ss_kw%' escape '".$dbcon->escape_ch."'"); break;
						}
						unset($ss_kw);
					}
					break; 
				/***********************************************************************/
				// ���� ���ǿ� ���� ���͸�
				case '1' : // ȸ������
					if($__v != '') { $rs_list->add_where("$__v =  mb_state"); } break;
				case '2' : // ȸ������
					if($__v !== '') { $rs_list->add_where("$__v =  mb_level"); } break;
			}
		}
	}

	switch ($ot) {
		case 10 : $rs_list->add_order("mb_num DESC");		break;
		default : $rs_list->add_order("mb_num DESC");		break;
	}
	
	$page_info=$rs_list->select_list($page,20,10);

	$MENU_L='m2';	
?>
<? include("_header.php"); ?>
<? include("admin.header.php"); ?>
<script>
function member_mail(){
	if(!chk_checkbox(list_form,'chk_nums[]',true)){
		alert('�Ѹ��̻� ���� �ϼ���.');
		return;
	}
	list_form.mode.value='check';
	list_form.action='member_mail.php';
	list_form.submit();
}
function member_del(){
	if(!chk_checkbox(list_form,'chk_nums[]',true)){
		alert('�Ѹ��̻� ���� �ϼ���.');
		return;
	}
	list_form.mode.value='delete';
	list_form.action='?<?=$p_str?>';
	list_form.submit();
}
</script>
<table border="0" cellspacing="0" cellpadding="0" width="100%" class="site_content">
  <tr>
    <td bgcolor="#F7F7F7">ȸ�����</td>
  </tr>
</table>
<br>
<table width="100%" cellspacing="0" style="border-collapse:collapse;table-layout:auto">
<form name="search_form" method="get" enctype="multipart/form-data">
	<tr> 
		<td>
���� : <select name="ss[1]" onChange="search_form.submit()">
<option value="">=��ü=</option>
<?=rg_html_option($_const['member_states'],"$ss[1]")?>
</select>
���� : <select name="ss[2]" onChange="search_form.submit()">
<option value="">=��ü=</option>
<?=rg_html_option($_level_info,"$ss[2]")?>
</select>							
�˻�: <select name="ss[0]">
<? $ss_list = array(1=>'ȸ�����̵�',2=>'ȸ������',3=>'�ֹι�ȣ',4=>'ȸ���ּ�',5=>'��ȭ��ȣ',
						6=>'�޴���',7=>'�̸���'); ?>
<?=rg_html_option($ss_list,"$ss[0]")?>
			</select>
			<input name="kw" type="text" id="kw" value="<?=$kw?>" size="14" class="input"> <input type="submit" name="�˻�" value="�˻�" class="button"> 
			<input type="button" value="���" onclick="location.href='?'" class="button">
		</td>
		<td align="right">Total : 
			<?=$page_info['total_rows']?>
			(<?=$page_info['page']?>/<?=$page_info['total_page']?>)</td>
    </tr>
</form>
</table>
<br>
<form name="list_form" method="post" enctype="multipart/form-data" action="?<?=$p_str?>">
<input name="mode" type="hidden" value="">
<table border="0" cellpadding="0" cellspacing="0" width="100%" class="site_list" onmouseover="list_over_color(event,'#FFE6E6',1)" onmouseout='list_out_color(event)'>
	<tr align="center" bgcolor="#F0F0F4">
		<td width="20"><input type="checkbox" onClick="set_checkbox(list_form,'chk_nums[]',this.checked)" class="none"></td>
		<td width="30" >����</td>
		<td width="30" >����</td>
		<td width="40" >��ȣ</td>
		<td>���̵�</td>
		<td>����</td>
		<td>����</td>
		<td>����Ʈ</td>
		<td>����</td>
		<td>�α���</td>
		<td>IP</b></td>		
		<td>����</td>
		</tr>
<?
	if($rs_list->num_rows()<1) {
		echo "
	<tr height=\"100\">
		<td align=\"center\" colspan=\"12\"><B>���(�˻�) �� �ڷᰡ �����ϴ�.</td>
	</tr>";
	}
	
	$no = $page_info['start_no'];
	while($R=$rs_list->fetch()) {
		$no--;
?>
	<tr height="25">
		<td align="center"><input type=checkbox name="chk_nums[]" value="<?=$R[mb_num]?>" class=none></td>
		<td align="center"><a href="member_edit.php?<?=$p_str?>&page=<?=$page?>&mode=modify&num=<?=$R[mb_num]?>">����</a></td>
		<td align="center"><a href="#" onClick="confirm_del('member_edit.php?<?=$p_str?>&page=<?=$page?>&mode=delete&num=<?=$R[mb_num]?>')">����</a></td>
		<td align="center"><?=$no?></td>
		<td align="center"><?=$R[mb_id]?></td>
		<td align="center"><?=$_const['member_states'][$R[mb_state]]?></td>
		<td align="center"><?=$_level_info[$R[mb_level]]?></td>
		<td align="center"><?=$R[mb_point]?></td>
		<td align="center"><?=rg_date($R[join_date],'%Y-%m-%d')?></td>
		<td align="center"><?=rg_date($R[login_date],'%Y-%m-%d')?></td>
		<td align="center"><?=$R[login_ip]?><br /></td>		
		<td align="center"><?=$R[login_count]?></td>
		</tr>
<?
}
?>
</table>
</form>
<table width="100%">
	<tr>
		<td width="150">
			<input type="button" value="ȸ�����" class="button" onClick="location.href='member_edit.php?<?=$p_str?>&page=<?=$page?>&mode=join'">
			<?php /*?><input type="button" value="ȸ������" class="button" onClick="member_del();"><?php */?>
		</td>
		<td align="center">
<?=rg_navi_display($page_info,$_get_param[2]); ?>
		</td>
	</tr>
</table>
<? include("admin.footer.php"); ?>
<? include("_footer.php"); ?>