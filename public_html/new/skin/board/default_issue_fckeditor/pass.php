<? if (!defined('RGBOARD_VERSION')) exit; ?>
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
<?=$msg?>
<form name="pass_form" action="?<?=$_get_param[4]?>" method="post">
<input type="hidden" name="mode" value="<?=$mode?>">
��ȣ�� �Է����ּ���.<br>
<input type="password" name="old_pass">
<input type="submit" value="Ȯ��" class="button" /> 
<input type="button" value="���" onclick="history.back();" class="button" />
</form>