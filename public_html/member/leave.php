<?
/* =====================================================


  ���������� :
2007-07-27 �ֹε�Ϲ�ȣ üũ ��� ����
 ===================================================== */
	include_once("../include/lib.php");
	
	if(!$_mb)
		rg_href($_url['member'].'login.php');
	
	if($_SERVER['REQUEST_METHOD']=='POST' && $form_mode=='leave_ok') {
		$mb_id=strtolower($mb_id);
		$mb_jumin = $mb_jumin1.$mb_jumin2;

		if($_mb['mb_id']!=$mb_id)
			rg_href('','�ڽ��� ���̵� �Է��ϼ���.','back');

		if(!$validate->userid($mb_id))
			rg_href('','���̵� Ȯ�����ּ���.','back');

		if($validate->is_empty($mb_name) || !$validate->han_only($mb_name))
			rg_href('','�̸��� Ȯ�����ּ���.','back');	

//		if(!$validate->jumin($mb_jumin,'jumin'))
//			rg_href('','�ֹε�� ��ȣ�� ��Ȯ�� �Է����ּ���.','back');

//		$mb_jumin = rg_password_encode($mb_jumin);
		$mb_pass = rg_password_encode($mb_pass);
		
		$rs->clear();
		$rs->set_table($_table['member']);
		$rs->add_where("mb_id='".$dbcon->escape_string($mb_id)."'");
		$rs->add_where("mb_name='".$dbcon->escape_string($mb_name)."'");
//		$rs->add_where("mb_jumin='".$dbcon->escape_string($mb_jumin)."'");
		$rs->add_where("mb_pass='".$dbcon->escape_string($mb_pass)."'");
		$rs->select();
		if($rs->num_rows()==0) // �Է������� �ùٸ��� �ʴ�
			rg_href('','�Է��Ͻ� ������ Ȯ�� �ϼ���.','back');

		if($_site_info['leave_state']==1) {
			$data=$rs->fetch();
			// ���ϻ����ϰ�
			$data['mb_files']=unserialize($data['mb_files']);
			rg_upload_file_delete($_path['member_data'],$data['mb_files']); // ���ϻ���
			// ȸ������ ����
			$rs->delete();
			// ����Ʈ �����
			$rs->clear();
			$rs->set_table($_table['point']);
			$rs->add_where("mb_num={$data['mb_num']}");
			$rs->delete();
			// ���� �����			
			$rs->clear();
			$rs->set_table($_table['note']);
			$rs->add_where("mb_num={$data['mb_num']}");
			$rs->delete();
		} else {
			$rs->add_field("mb_state","3");
			$rs->update();
		}
		
		$ss_mb_id = '';
		$ss_mb_num = '';
		$ss_login_ok = '';
		$_SESSION['ss_mb_id']=$ss_mb_id;
		$_SESSION['ss_mb_num']=$ss_mb_num;
		$_SESSION['ss_login_ok']=$ss_login_ok;
		
//				if (!file_exists($skin_site_path."mb_join_ok.php")) 
		if($ret_url=='') $ret_url='../main/index.php';
		$rs->commit();
		rg_href($ret_url,'Ż��Ǿ����ϴ�.');
	}

	$c_mb_is_mailing[$data['mb_is_mailing']]='checked';
	$c_mb_is_opening[$data['mb_is_opening']]='checked';
?>
<? include_once($_path['member'].'_header.php'); ?>
<table width="300" align="center" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td>
		<form name="leave_form" method="post" action="?" onSubmit="return validate(this)" enctype='multipart/form-data'>
		<input type="hidden" name="form_mode" value="leave_ok">
		<input type="hidden" name="ret_url" value="../main/index.php">
		<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td height="3" bgcolor="#54A8BA"><img width="1" height="1"></td>
			</tr>
			<tr>
				<td height="28" bgcolor="#F4FAFB">&nbsp;ȸ��Ż��</td>
			</tr>
			<tr>
				<td height="1" bgcolor="#54A8BA"><img width="1" height="1"></td>
			</tr>
		</table>
		<table width="100%" align="center" border="0" cellpadding="0" cellspacing="6">
			<tr>
			  <td width="90" align="right"><strong>���̵�</strong>&nbsp;</td>
			  <td><input type="text" class="input" name="mb_id" size="20" maxlength="12" hname="���̵�" value="" required option="userid" tabindex="1"></td>
			</tr>
			<tr>
			  <td height="1" colspan="2" bgcolor="#ECECEC"><img width="1" height="1"></td>
			  </tr>
			<tr>
				<td align="right"><strong>��ȣ</strong></td>
				<td><input name="mb_pass" type="password" class="input" size="20" required hname="��ȣ" tabindex="2"></td>
			</tr>
			<tr>
			  <td height="1" colspan="2" bgcolor="#ECECEC"><img width="1" height="1"></td>
			  </tr>
			<tr>
				<td align="right"><strong>�̸�</strong>&nbsp;</td>
				<td><input type="text" class="input" name="mb_name" size="20" maxlength="12" hname="�̸�" required tabindex="2"></td>
				</tr>
			<tr>
				<td height="1" colspan="2" bgcolor="#ECECEC"><img width="1" height="1"></td>
				</tr>
<?php /*?>			<tr>
				<td align="right"><strong>�ֹε�Ϲ�ȣ</strong></td>
				<td><input type="text" class="input" name="mb_jumin1" size="6" maxlength="6" required option="jumin" hname="�ֹε�Ϲ�ȣ" value="" span="2" glue="-" tabindex="3">
-
  <input type="password" class="input" name="mb_jumin2" size="7" maxlength="7" value="" tabindex="4"></td>
				</tr>
			<tr>
				<td height="1" colspan="2" bgcolor="#ECECEC"><img width="1" height="1"></td>
			</tr><?php */?>
<? if($_site_info['leave_state']==1) { ?>
			<tr>
			  <td colspan="2" align="center">Ż���Ͻø� ȸ�������� ��� �����˴ϴ�.</td>
		  </tr>
<? } else { ?>
			<tr>
			  <td colspan="2" align="center">Ż���Ͻø� ������ Ȯ���� ó���˴ϴ�.</td>
		  </tr>
<? } ?>
			<tr>
				<td height="1" colspan="2" bgcolor="#ECECEC"><img width="1" height="1"></td>
			</tr>
		</table>
		<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td height="1" bgcolor="#54A8BA"><img width="1" height="1"></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td align="center"><input type="submit" class="button" value=" ȸ��Ż�� ">
				  <input type="button" class="button" value=" �� �� " onClick="history.back()">					</td>
			</tr>
		</table>
		</form>		</td>
	</tr>
</table>
<? include_once($_path['member'].'_footer.php'); ?>
