<? if (!defined('RGBOARD_VERSION')) exit; ?>
<style type='text/css'> 
.id_blur { background: transparent url("<?=$skin_url?>images/id_bg.gif") top left} 
.id_focus { background: #ffffe0 ; color: #003300 } 
.pw_blur { background: transparent url("<?=$skin_url?>images/ps_bg.gif") bottom left} 
.pw_focus { background: #ffffe0 ; color: #003300 } 
</style> 
<form name="skin_login_form" method="post" action="<?=$login_action?>" onSubmit="return validate(this)" enctype='multipart/form-data'>
<input type="hidden" name="form_mode" value="member_login_ok">
<input type="hidden" name="ret_url" value="<?=$ret_url?>">
<table width="170" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><img src="<?=$skin_url?>images/login_top.gif" width="170" height="34" /></td>
  </tr>
  <tr>
    <td background="<?=$skin_url?>images/login_bg.gif"><table width="145" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="85"><input type='text' name='mb_id' onFocus="if ( this.value == '' ) { this.className='id_focus input' }" onBlur="if ( this.value == '' ) { this.className='id_blur input' }" class='id_blur input' size="12" maxlength="20" hname="아이디" required tabindex="111" /></td>
        <td width="10" rowspan="2">&nbsp;</td>
        <td width="51" rowspan="2"><input type="image" src="<?=$skin_url?>images/btn_login.gif" class="border" tabindex="3"></td>
      </tr>
      <tr>
        <td><input type='password' name='mb_pass' onFocus="this.className='pw_focus input'" onBlur="if ( this.value == '' ) { this.className='pw_blur input' }" class='pw_blur input' size="12" required hname="암호" tabindex="112" /></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td background="<?=$skin_url?>images/login_bg.gif" ><img src="<?=$skin_url?>images/login_line.gif" width="170" height="24" /></td>
  </tr>
  <tr>
    <td background="<?=$skin_url?>images/login_bg.gif"><table width="145" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="81"><img src="<?=$skin_url?>images/btn_id.gif" width="81" height="19" onClick="location.href='<?=$password_url?>'"  style="cursor:hand;"/></td>
        <td width="6">&nbsp;</td>
        <td width="58"><img src="<?=$skin_url?>images/btn_join.gif" width="58" height="19" onClick="location.href='<?=$join_url?>'" style="cursor:hand;"/></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><img src="<?=$skin_url?>images/login_bottom.gif" width="170" height="15" /></td>
  </tr>
</table>
</form>