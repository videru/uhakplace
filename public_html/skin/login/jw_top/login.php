<? if (!defined('RGBOARD_VERSION')) exit; ?>
<style type='text/css'> 
.id_blur { background: transparent url("<?=$skin_url?>images/login_bg.gif") top left} 
.id_focus { background: #ffffe0 ; color: #003300 } 
.pw_blur { background: transparent url("<?=$skin_url?>images/login_bg.gif") bottom left} 
.pw_focus { background: #ffffe0 ; color: #003300 } 
</style> 

<table width="530" border="0" cellpadding="0" cellspacing="0">
<form name="skin_login_form" method="post" action="<?=$login_action?>" onSubmit="return validate(this)" enctype='multipart/form-data'>
<input type="hidden" name="form_mode" value="member_login_ok">
<input type="hidden" name="ret_url" value="<?=$ret_url?>">	
	<tr>
		<a href="http://www.uhakplace.co.kr/new" target="_parent" onFocus="blur();"><img src="../n_img/main_03.jpg" width="48" height="17" border="0" /></a>	
		<a href="http://www.uhakplace.co.kr/temp/login.php" target="_parent" onFocus="blur();"><img src="../n_img/main_04.jpg" width="55" height="17" border="0" /></a>
    	<a href="http://www.uhakplace.co.kr/temp/8_2.php" target="_parent" onFocus="blur();"><img src="../n_img/main_05.jpg" width="63" height="17" border="0" /></a>
    	<a href="javascript:bookmark();" onFocus="blur();"><img src="../n_img/main_06.jpg" width="64" height="17" border="0" /></a>
	</tr>
</form>	
</table>
