<? if (!defined('RGBOARD_VERSION')) exit; ?>
<style type='text/css'> 
.id_blur { background: transparent url("<?=$skin_url?>images/id_bg.gif") top left} 
.id_focus {background: transparent url("<?=$skin_url?>images/id_bg2.gif") top left} color: #3c9dbc } 
.pw_blur { background: transparent url("<?=$skin_url?>images/ps_bg.gif") bottom left} 
.pw_focus { background: transparent url("<?=$skin_url?>images/id_bg2.gif") top left}color: #3c9dbc } 
</style> 
<table width="162" border="0" cellspacing="0" cellpadding="0">
 <form name="skin_login_form" method="post" action="<?=$login_action?>" onSubmit="return validate(this)" enctype='multipart/form-data'>
<input type="hidden" name="form_mode" value="member_login_ok">
<input type="hidden" name="ret_url" value="<?=$ret_url?>">
  <tr>
    <td><img src="<?=$skin_url?>images/login_tit.gif" width="162" height="38" /></td>
  </tr>
  <tr>
    <td background="<?=$skin_url?>images/login_tbg.gif"><table width="120" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="24" valign="top"><input type='text' name='mb_id' onFocus="if ( this.value == '' ) { this.className='id_focus input' }" onBlur="if ( this.value == '' ) { this.className='id_blur input' }" class='id_blur input' size="18" maxlength="20" hname="아이디" required tabindex="111" /></td>
      </tr>
      <tr>
        <td height="28" valign="top"><input type='password' name='mb_pass' onFocus="this.className='pw_focus input'" onBlur="if ( this.value == '' ) { this.className='pw_blur input' }" class='pw_blur input' size="18" required hname="암호" tabindex="112" /></td>
      </tr>
      <tr>
        <td><input type="image" src="<?=$skin_url?>images/btn_login.gif" class="border" tabindex="3"> <img src="<?=$skin_url?>images/btn_join.gif" width="58" height="20" onClick="location.href='<?=$join_url?>'" style="cursor:hand;"/></td>
      </tr>
      <tr>
        <td height="27" align="center"><img src="<?=$skin_url?>images/btn_ps.gif" width="111" height="13"  onClick="location.href='<?=$password_url?>'"  style="cursor:hand;"/></td>
      </tr>
    </table></td>
  </tr>
  
  <tr>
    <td><img src="<?=$skin_url?>images/login_bot.gif" width="162" height="19" /></td>
  </tr>
  </form>
</table>