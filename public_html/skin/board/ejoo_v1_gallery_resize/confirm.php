<? if (!defined('RGBOARD_VERSION')) exit; ?>
<?
	if(!$msg)
		switch($_confirm_type) {
			case "comment_delete_admin" : $msg='(�����ڻ���)�ڸ�Ʈ ���� Ȯ���մϱ�?';
			break;
			case "comment_delete_member" : $msg='(���αۻ���)�ڸ�Ʈ ���� Ȯ���մϱ�?';
			break;
			case "delete_admin" : $msg='(�����ڻ���)�ۻ��� Ȯ���մϱ�?';
			break;
			case "delete_member" : $msg='(���αۻ���)�ۻ��� Ȯ���մϱ�?';
			break;
		}
?>
<?=$msg?>
<form action="?" method="post">
<?=$_post_param[3]?>
<input type="hidden" name="bd_num" value="<?=$bd_num?>">
<input type="hidden" name="bc_num" value="<?=$bc_num?>">
<input type="hidden" name="mode" value="<?=$mode?>">
<input type="hidden" name="confirm" value="ok">
<input type="submit" value="Ȯ��" class="button" /> 
<input type="button" value="���" onclick="history.back();" class="button" />
</form>
