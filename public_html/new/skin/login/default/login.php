<? if (!defined('RGBOARD_VERSION')) exit; ?>
<table width="95%" align="center" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td>
		<form name="skin_login_form" method="post" action="<?=$login_action?>" onSubmit="return validate(this)" enctype='multipart/form-data'>
		<input type="hidden" name="form_mode" value="member_login_ok">
		<input type="hidden" name="ret_url" value="<?=$ret_url?>">
		<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td height="3" bgcolor="#54A8BA"><img width="1" height="1"></td>
			</tr>
			<tr>
				<td height="28" bgcolor="#F4FAFB">&nbsp;&nbsp;로그인</td>
			</tr>
			<tr>
				<td height="1" bgcolor="#54A8BA"><img width="1" height="1"></td>
			</tr>
		</table>
		<table width="100%" align="center" border="0" cellpadding="0" cellspacing="6">
			<tr>
				<td width="50" align="right"><strong>아이디</strong>&nbsp;</td>
				<td><input type="text" class="input" name="mb_id" size="12" maxlength="12" hname="아이디" required tabindex="111"></td>
			</tr>
			<tr>
				<td height="1" colspan="2" bgcolor="#ECECEC"><img width="1" height="1"></td>
				</tr>
			<tr>
				<td align="right"><strong>암호</strong></td>
				<td><input name="mb_pass" type="password" class="input" size="12" required hname="암호" tabindex="112"></td>
				</tr>
		</table>
		<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td height="1" bgcolor="#54A8BA"><img width="1" height="1"></td>
			</tr>
			<tr>
				<td height="5"><img width="1" height="1"></td>
			</tr>
			<tr>
				<td align="center"><input name="submit" type="submit" class="button" style="width:100" value="   로그인   " tabindex="113" />
				</td>
			</tr>
			<tr>
				<td height="5"><img width="1" height="1"></td>
			</tr>
			<tr>
				<td align="center">
				<input type="button" class="button" value="회원가입" onClick="location.href='<?=$join_url?>'">
				  <input type="button" class="button" value="암호찾기" onClick="location.href='<?=$password_url?>'">					</td>
			</tr>
		</table>
		</form>		</td>
	</tr>
</table>
