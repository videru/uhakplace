<? if (!defined('RGBOARD_VERSION')) exit; ?>
<?
	if(!$msg)
		switch($_confirm_type) {
			case "comment_delete_admin" : $msg='(관리자삭제)코멘트 삭제 확실합니까?';
			break;
			case "comment_delete_member" : $msg='(본인글삭제)코멘트 삭제 확실합니까?';
			break;
			case "delete_admin" : $msg='(관리자삭제)글삭제 확실합니까?';
			break;
			case "delete_member" : $msg='(본인글삭제)글삭제 확실합니까?';
			break;
		}
?>
<table border="0" cellpadding="5" cellspacing="0" align="center">
<form action="?<?=$_get_param[4]?>" method="post">
<input type="hidden" name="mode" value="<?=$mode?>">
<tr bgcolor="#f7f7f7">
<td align="center">
<table border="0" cellpadding="10" cellspacing="0" bgcolor="#ffffff">
<tr>
<td align="center">
<img src="<?=$skin_url?>images/img_confirm.gif" align="absmiddle" border="0">
<br />
<?=$msg?>
<br />
<br />
</td>
</tr>
</table>
</td></tr><tr><td align="center">
<input type="hidden" name="confirm" value="ok">
<input type="image" src="<?=$skin_url?>images/confirm.gif" align="absmiddle">
<img src="<?=$skin_url?>images/cancel.gif" onClick="history.back();" style="cursor:pointer" align="absmiddle">
</td></tr>
</form>
</table>