<?
/* =====================================================
	
  ���������� : 
 ===================================================== */
	include_once("../include/lib.php");
?>
<? include("_header.php"); ?>
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="30%" align="center" valign="middle">&nbsp;</td>
  </tr>
  <tr>
    <td align="center" valign="top">
			<form name="login_form" method="post" action="<?=$_url['member']?>login.php" onSubmit="return validate(this)" enctype="multipart/form-data">
			<input type="hidden" name="form_mode" value="member_login_ok">
			<input type="hidden" name="ret_url" value="<?=$_url['admin']?>index.php">
			<input type="hidden" name="ret_url_login" value="<?=$_url['admin']?>login.php">
				<table align="center" cellpadding="0" cellspacing="0" width="500">
					<tr> 
						<td width="100"> <p><img src="images/logo.gif" width="120" height="55" border="0"></p></td>
						<td align="center"> <p>�������� ������ ������ ���� ���� �ܰ� �Դϴ�.<br>
							������ ���̵�� ��ȣ�� ��Ȯ�� �Է����ּ���.
			</p></td>
					</tr>
				</table>
				<br><br>
				<table align="center" border="0" cellpadding="0" cellspacing="0" width="400" class="site_content">
					<tr> 
						<th width="130" align="right">������ ���̵�&nbsp;:&nbsp;</span></th>
						<td width="264"><input type="text" name="mb_id" size="20" maxlength="20" minlength="2" required hname="���̵�" class="input"></td>
					</tr>
					<tr> 
						<th align="right">������ ��ȣ&nbsp;:&nbsp;</span></th>
						<td><input type="password" name="mb_pass" size="20" maxlength="20" required hname="��ȣ" class="input"></td>
					</tr>
				</table>
				<table align="center" border="0" cellpadding="10" cellspacing="0" width="400">
					<tr> 
						<td> <p align="left"><span style="font-size: 9pt">�δ��� ������� ���ӽ� 
								�������� ������ ������ 
						�����Ͻñ� �ٶ��ϴ�</span></p></td>
					</tr>
				</table>
				<p>
				<table align="center" border="0" cellpadding="0" cellspacing="0" width="400">
					<tr> 
						<td align="center"> <input type="submit" value=" Ȯ �� " class="button">
					&nbsp; 
					<input type="button" value=" �� �� " onclick='history.go(-1);' class="button"></td>
					</tr>
				</table>
			</form>		</td>
  </tr>
</table>


<script language='Javascript'>
	document.login_form.mb_id.focus();
</script>

<? include("_footer.php"); ?>