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
<form action="?" method="post">
<?=$_post_param[3]?>
<input type="hidden" name="bd_num" value="<?=$bd_num?>">
<input type="hidden" name="bc_num" value="<?=$bc_num?>">
<input type="hidden" name="mode" value="<?=$mode?>">
<input type="hidden" name="confirm" value="ok">
<input type="submit" value="확인" class="button" /> 
<input type="button" value="취소" onclick="history.back();" class="button" />
</form>
