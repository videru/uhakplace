<?
/* =====================================================


  ���������� : �ֹι�ȣ ��� �̸��Ϸ� ����
 ===================================================== */
/*
[���̵�ã��]
1. �̸��� �ֹι�ȣ�� �Է�
2. ȸ�����̵��� �� 3�ڸ��� *** �� �����ѵ� �����ش�
3. ������ ȸ�����̵� ã�� ���ؼ��� �̸����ּҸ� �Է� �� ȸ���������� �̸��� �ּҿ� ���ٸ� �߼��Ѵ�.
*/
	include_once("../include/lib.php");

	if($_SERVER['REQUEST_METHOD']=='POST') {
		$mb_email=strtolower($mb_email);
		
		if($validate->is_empty($mb_name) || !$validate->han_only($mb_name))
			rg_href('','�̸��� Ȯ�����ּ���.','back');	

		if($validate->is_empty($mb_email))
			rg_href('','�̸����� �Է����ּ���.','back');
			
		$rs->clear();
		$rs->set_table($_table['member']);
		$rs->add_where("mb_name='".$dbcon->escape_string($mb_name)."'");
		$rs->add_where("mb_email='".$dbcon->escape_string($mb_email)."'");
		$rs->select();
		if($rs->num_rows()==0) // ���Ե��� �ʾҴ�
			rg_href('','���ԵǾ� ���� �ʽ��ϴ�.','back');
					
		$find_id_data=$rs->fetch();

		switch($find_id_data['mb_state']) {
			case 1 : // ���ε� ���̵�
				break;
			case '0' : 
				rg_href('','���δ�����Դϴ�.','back');		
				break;
			case '2' : 
				rg_href('','�̽��ε� ���̵� �Դϴ�.','back');		
				break;
			case '3' : 
				rg_href('','Ż��� ���̵��Դϴ�.\n�簡���� ���Ұ�� �����ڿ��� �����ֽʽÿ�.','back');	
				break;
			default :
				rg_href('','�˼����� ���� �����ڿ��� ���� �ٶ��ϴ�.','back');	
				break;
		}
		if($form_mode=='find_id_email_ok') {
			if($find_id_data['mb_email']!=$mb_email) {
				rg_href('','ȸ���������� �̸����� �ٽ��ѹ� Ȯ���ϼ���.','back');
			}
			extract($find_id_data);
			$mail_to = "$mb_email";
			$mail_subject = "[{$mb_name}]�Բ��� �����Ͻ� ������ �亯�Դϴ�.";
			$mail_from = $_site_info['mail_from'];
			$mail_return=$_site_info['mail_return'];
	
			ob_start();
			include($_path['mail_form'].'member_find_id.php');
			$mail_message=ob_get_contents();
			ob_end_clean();
			$mail_message=str_replace('../','http://'.$_SERVER['HTTP_HOST'].'/',$mail_message);

			$rs->commit();
			if($ret_url=='') $ret_url='../main/index.php';
			if(rg_mail($mail_to,$mail_subject,$mail_message,$mail_from,$mail_return)) {
				rg_href($ret_url,'�̸��� ���ۿ� ���� �߽��ϴ�.\n�̸����� Ȯ�� �Ͻ��� �α��� �ϼ���.');
			} else {
				rg_href($ret_url,'�̸��� ���ۿ� ���� �߽��ϴ�.\n�����ڿ��� ���� �Ͻʽÿ�.');
			}		
		}
	}
?>
<? include_once('_header.php'); ?>
<?
	if($_SERVER['REQUEST_METHOD']=='POST' && $form_mode=='find_id_ok') {
		$find_id_data['mb_id'][ strlen($find_id_data['mb_id'])-1 ]='*';
		$find_id_data['mb_id'][ strlen($find_id_data['mb_id'])-2 ]='*';
		$find_id_data['mb_id'][ strlen($find_id_data['mb_id'])-3 ]='*';
?>
<table width="720" align="center" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td>
		<form name="search_id_form" method="post" action="?" onSubmit="return validate(this)" enctype='multipart/form-data'>
		<input type="hidden" name="form_mode" value="find_id_email_ok">
		<input type="hidden" name="ret_url" value="<?=$ret_url?>">
		<input type="hidden" name="mb_name" value="<?=$mb_name?>">
		<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td height="3" bgcolor="#07472c"><img width="1" height="1"></td>
			</tr>
			<tr>
				<td height="28" bgcolor="#F4FAFB">&nbsp;ȸ�����̵���ȸ���</td>
			</tr>
			<tr>
				<td height="1" bgcolor="#07472c"><img width="1" height="1"></td>
			</tr>
		</table>
		<table width="100%" align="center" border="0" cellpadding="0" cellspacing="6">
			<tr>
			  <td align="center">�Է��Ͻ� ������ ��ġ�ϴ�  ���̵� �Դϴ�. </td>
			  </tr>
			<tr>
				<td height="1" bgcolor="#ECECEC"><img width="1" height="1"></td>
				</tr>
			<tr>
			  <td align="center"><font style="font-size:8px">��</font> <?=$find_id_data['mb_id']?></td>
			  </tr>
			<tr>
				<td height="1" bgcolor="#ECECEC"><img width="1" height="1"></td>
				</tr>
			<tr>
				<td><table width="100%" align="center" border="0" cellpadding="0" cellspacing="6">
				  <TR>
            <TD>�� �������� ���뿡 ���� ���ع����� ���� ��3�ڸ��� '*'�� ǥ���մϴ�.</TD>
				    </TR>
          <TR>
            <TD>'*' ó���� �κ��� Ȯ���Ͻ÷���,�Ʒ� ȸ���������� �̸����ּҸ� �Է� �Ͻø� �ش� �̸����ּҷ� ȸ�����̵� ������ �帳�ϴ�. </TD>
          </TR>
				  </table>
				</td>
				</tr>
			<tr>
				<td height="1" bgcolor="#ECECEC"><img width="1" height="1"></td>
				</tr>
			<tr>
				<td><table width="100%" align="center" border="0" cellpadding="0" cellspacing="6">
						<tr>
							<td width="80" align="right"><strong>�̸���</strong></td>
							<td><input type="text" class="input" name="mb_email" size="20" maxlength="100" option="email" required hname="�̸���" value="<?=$mb_email?>"> <input type="submit" class="button" value=" Ȯ �� "></td>
						</tr>
				  </table>
				  </td>
				</tr>
			<tr>
			
			<tr>
				<td height="1" bgcolor="#ECECEC"><img width="1" height="1"></td>
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
				<td align="center"><input type="button" class="button" value=" ȸ������ " onClick="location.href='<?=$_path['member']?>../newmember/join.php'">
				  <input type="button" class="button" value=" ��ȣã�� " onClick="location.href='<?=$_path['member']?>../newmember/find_pass.php'">					</td>
			</tr>
		</table>
		</form>		</td>
	</tr>
</table>
<script language='Javascript'>
	if(typeof(document.search_id_form.mb_email) != "undefined")
		document.search_id_form.mb_email.focus();
</script>
<? } else { ?>
<table width="720" align="center" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td>
		<form name="search_id_form" method="post" action="?" onSubmit="return validate(this)" enctype='multipart/form-data'>
		<input type="hidden" name="form_mode" value="find_id_ok">
		<input type="hidden" name="ret_url" value='../phil/index_new.php'>
		<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
<!--	<tr>
				<td height="3" bgcolor="#07472c"><img width="1" height="1"></td>
			</tr>
			<tr>
				<td height="28" bgcolor="#F4FAFB">&nbsp;ȸ�����̵���ȸ</td>
			</tr>
			--><tr>
				<td height="1" bgcolor="#07472c"><img width="1" height="1"></td>
			</tr>
		</table>
		<table width="400" align="center" border="0" cellpadding="0" cellspacing="6">
			<tr>
				<td width="80" align="right"><strong>�̸�</strong>&nbsp;</td>
				<td width="130"><input type="text" class="input" name="mb_name" size="20" maxlength="12" hname="�̸�" required tabindex="1"></td>
				<td rowspan="3"><input name="submit" type="submit" class="button" value=" Ȯ �� " style="height:50;width:60" tabindex="3"></td>
			</tr>
			<tr>
				<td></td>
				</tr>
			<tr>
				<td align="right"><strong>�̸���&nbsp;</strong></td>
				<td><input type="text" class="input" name="mb_email" size="20" maxlength="100" option="email" required="required" hname="�̸���" value="" tabindex="2" /></td>
				</tr>
			<tr>
				<td height="1" colspan="3" bgcolor="#ECECEC"><img width="1" height="1"></td>
			</tr>
		</table>
		<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
			<tr>
			  <td height="1" bgcolor="#07472c"><img width="1" height="1"></td>
		  </tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td align="center"><input type="button" class="button" value=" ȸ������ " onClick="location.href='<?=$_path['member']?>../newmember/join.php'">
				  <input type="button" class="button" value=" ��ȣã�� " onClick="location.href='<?=$_path['member']?>../newmember/find_pass.php'">					</td>
			</tr>
		</table>
		</form>		</td>
	</tr>
</table>
<script language='Javascript'>
	if(typeof(document.search_id_form.mb_name) != "undefined")
		document.search_id_form.mb_name.focus();
</script>
<? } ?>
