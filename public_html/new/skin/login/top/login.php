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
		<td width="32" ><img src="../img/top_id.gif" align="absmiddle"></td>
		<td width="5">&nbsp;</td>		
		<td width="53" ><input type="text" class="input" name="mb_id" size="10" maxlength="12" hname="아이디" required tabindex="111"></td>
		<td width="10">&nbsp;</td>			
		<td width="42" ><img src="../img/top_pass.gif" align="absmiddle"></td>
		<td width="5">&nbsp;</td>		
		<td width="45" ><input name="mb_pass" type="password" class="input" size="12" required hname="암호" tabindex="112"></td>
		<td width="10">&nbsp;</td>		
		<td width="50" ><input src="../img/btn_login.gif" type="image" /></td>		
		<td width="40">&nbsp;</td>		
		<td width="58"><a href="../main/"><img src="../img/btn_home.gif" border="0"></a></td>		
		<td width="6">&nbsp;</td>
		<td width="48"><a href="<?=$join_url?>"><img src="../img/btn_top_join.gif" border="0"></a></td>	
		<td width="6">&nbsp;</td>
		<td width="48"><a href="../member/modify.php"><img src="../img/top_modify.gif" border="0"></a></td>
		<td width="6">&nbsp;</td>
		<td width="66"><a href="../member/regi_list.php"><img src="../img/btn_top_cs.gif" border="0"></a></td>
	</tr>
</form>	
</table>
