<?
	if(!$msg)
		switch($_pass_type) {
			case "comment_delete" : $msg='�ڸ�Ʈ���� : ��ȣ�� �Է��ϼ���.';
			break;
			case "view_secret" : $msg='��бۺ��� : ��ȣ�� �Է��ϼ���.';
			break;
			
			case "modify" : $msg='�ۼ��� : ��ȣ�� �Է��ϼ���.';
			break;
			case "delete" : $msg='�ۻ��� : ��ȣ�� �Է��ϼ���.';
			break;
			
		}
?>
<table border="0" cellpadding="5" cellspacing="0" align="center">
<form name="pass_form" action="?<?=$_get_param[4]?>" method="post">
<input type="hidden" name="mode" value="<?=$mode?>">
<tr bgcolor="#f7f7f7">
<td align="center">
<table border="0" cellpadding="10" cellspacing="0" bgcolor="#ffffff">
<tr>
<td align="center" colspan="2">
<img src="<?=$skin_url?>images/img_pass.gif" align="absmiddle" border="0">
<br />
<?=$msg?>
<br />
<br />
</td>
</tr>
<tr>
<td align="right">
<input type="password" name="old_pass" class="input">
</td>
<td>
<input type="image" src="<?=$skin_url?>images/confirm.gif" align="absmiddle">
<img src="<?=$skin_url?>images/cancel.gif" onClick="history.back();" style="cursor:pointer" align="absmiddle">
</td></tr>
</table>
</td></tr>
</form>
</table>