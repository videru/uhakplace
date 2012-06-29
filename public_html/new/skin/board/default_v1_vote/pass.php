<? if (!defined('RGBOARD_VERSION')) exit; ?>
<?
/* =====================================================
 프로그램명 : 알지보드 V4 게시판스킨

파일설명 : 글삭제,코멘트삭제,비밀글조회등 암호입력이 필요한경우 호출된다.

변수설명
$msg : 표시될 메시지
$_confirm_type : 게시판에서 넘어오는 입력유형
===================================================== */
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
<form name="pass_form" action="?<?=$_get_param[4]?>" method="post">
암호를 입력해주세요.<br>
<input type="hidden" name="mode" value="<?=$mode?>">
<input type="password" name="old_pass">
<input type="submit" value="확인" class="button" /> 
<input type="button" value="취소" onclick="history.back();" class="button" />
</form>