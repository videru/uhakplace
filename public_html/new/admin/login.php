<?
/* =====================================================
	
  최종수정일 : 
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
						<td align="center"> <p>알지보드 관리자 접속을 위한 인증 단계 입니다.<br>
							관리자 아이디와 암호를 정확히 입력해주세요.
			</p></td>
					</tr>
				</table>
				<br><br>
				<table align="center" border="0" cellpadding="0" cellspacing="0" width="400" class="site_content">
					<tr> 
						<th width="130" align="right">관리자 아이디&nbsp;:&nbsp;</span></th>
						<td width="264"><input type="text" name="mb_id" size="20" maxlength="20" minlength="2" required hname="아이디" class="input"></td>
					</tr>
					<tr> 
						<th align="right">관리자 암호&nbsp;:&nbsp;</span></th>
						<td><input type="password" name="mb_pass" size="20" maxlength="20" required hname="암호" class="input"></td>
					</tr>
				</table>
				<table align="center" border="0" cellpadding="10" cellspacing="0" width="400">
					<tr> 
						<td> <p align="left"><span style="font-size: 9pt">부당한 방법으로 접속시 
								불이익을 받을수 있으니 
						주의하시기 바랍니다</span></p></td>
					</tr>
				</table>
				<p>
				<table align="center" border="0" cellpadding="0" cellspacing="0" width="400">
					<tr> 
						<td align="center"> <input type="submit" value=" 확 인 " class="button">
					&nbsp; 
					<input type="button" value=" 뒤 로 " onclick='history.go(-1);' class="button"></td>
					</tr>
				</table>
			</form>		</td>
  </tr>
</table>


<script language='Javascript'>
	document.login_form.mb_id.focus();
</script>

<? include("_footer.php"); ?>