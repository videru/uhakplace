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
<?=$msg?>
<form action="?<?=$_get_param[4]?>" method="post">
<input type="hidden" name="mode" value="<?=$mode?>">
<input type="hidden" name="confirm" value="ok">
<input type="submit" value="확인" class="button" /> 
<input type="button" value="취소" onclick="history.back();" class="button" />
</form>
