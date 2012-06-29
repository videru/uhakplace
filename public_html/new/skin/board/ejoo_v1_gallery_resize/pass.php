<? if (!defined('RGBOARD_VERSION')) exit; ?>
<?
	if(!$msg)
		switch($_pass_type) {
			case "comment_delete" : $msg='코멘트삭제 : 암호를 입력하세요.';
			break;
			case "view_secret" : $msg='비밀글보기 : 암호를 입력하세요.';
			break;
			
			case "modify" : $msg='글수정 : 암호를 입력하세요.';
			break;
			case "delete" : $msg='글삭제 : 암호를 입력하세요.';
			break;
			
		}
?>
<?=$msg?>
<form name="pass_form" action="?" method="post">
<?=$_post_param[3]?>
<input type="hidden" name="bd_num" value="<?=$bd_num?>">
<input type="hidden" name="bc_num" value="<?=$bc_num?>">
<input type="hidden" name="mode" value="<?=$mode?>">
암호를 입력해주세요.<br>
<input type="password" name="old_pass">
<input type="submit" value="확인" class="button" /> 
<input type="button" value="취소" onclick="history.back();" class="button" />
</form>