<?
/* =====================================================

  ���������� : 
 ===================================================== */
	include_once("../include/lib.php");
	$is_use=false;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link href="<?=$_url['css']?>style.css" rel="stylesheet" type="text/css">
</head>
<script src="<?=$_url['js']?>common.js"></script>
<script src="<?=$_url['js']?>lib.validate.js"></script>
<body bottommargin="0" topmargin="0" leftmargin="0" rightmargin="0">
<table width="300" align="center" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td height="10">
		</td>
	</tr>
	<tr>
		<td>
		<form name="login_form" method="post" action="?" onSubmit="return validate(this)" enctype='multipart/form-data'>
		<input type="hidden" name="form_info" value="<?=$form_info?>">
		<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td height="3" bgcolor="#54A8BA"><img width="1" height="1"></td>
			</tr>
			<tr>
				<td height="28" bgcolor="#F4FAFB">&nbsp;&nbsp;���̵� �ߺ�Ȯ��</td>
			</tr>
			<tr>
				<td height="1" bgcolor="#54A8BA"><img width="1" height="1"></td>
			</tr>
		</table>
		<table width="300" align="center" border="0" cellpadding="0" cellspacing="6">
			<tr>
			  <td align="center">
<?
	if($mb_id!='') { 
		if(!$validate->userid($mb_id)) {
?> (<?=$mb_id?>)�� ���̵�� ����� �� �����ϴ�.<? 
		} else {
			$rs->clear();
			$rs->set_table($_table['member']);
			$rs->add_where("mb_id='".$dbcon->escape_string($mb_id)."'");
			$rs->select();
			if(!$rs->num_rows()) { 
				$is_use=true;
?> (<?=$mb_id?>)�� ��밡���� ���̵� �Դϴ�.<? 
			} else {
?> (<?=$mb_id?>)�� �̹̻������ ���̵� �Դϴ�.<br>�ٸ� ���̵� �Է��ϼ���.<? 
			}
		}
	} else { 
?> ����� ���̵� �Է� ���ּ���.<?
	}
?>
				</td>
			  </tr>
			<tr>
				<td height="1" bgcolor="#ECECEC"><img width="1" height="1"></td>
			</tr>
			</table>
		<table width="300" align="center" border="0" cellpadding="0" cellspacing="6">
			<tr>
				<td width="50" align="right"><strong>���̵�</strong>&nbsp;</td>
				<td width="120"><input type="text" class="input" name="mb_id" size="18" maxlength="12" hname="���̵�" required option="userid"  value="<?=$mb_id?>"></td>
				<td><input name="submit" type="submit" class="button" value="�ߺ�Ȯ��"></td>
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
				<td align="center">
<? if($is_use) { ?>
<?
	list($form_name,$f_mb_id)=explode('|',$form_info);
	$form_mb_id="opener.$form_name.$f_mb_id";
?>
<script language="javascript">
function id_use() {
	if(window.opener.document.getElementById('<?=$f_mb_id?>') != null) {
		obj=window.opener.document.getElementById('<?=$f_mb_id?>');
	} else {
		obj=window.opener.document.<?=$form_name?>.<?=$f_mb_id?>
	}

	obj.value='<?=$mb_id?>';
	obj.focus();
	self.close()
}
</script>
				<input type="button" class="button" value=" ����ϱ� " onClick="id_use()">
<? } ?>
				<input type="button" class="button" value="  ��  ��  " onClick="self.close()">
					</td>
			</tr>
		</table>
		</form>		</td>
	</tr>
</table>
</body>
</html>

