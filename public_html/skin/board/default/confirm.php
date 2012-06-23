<? if (!defined('RGBOARD_VERSION')) exit; ?>
<?
/* =====================================================
 프로그램명 : 알지보드 V4 게시판스킨

파일설명 : 글삭제등 확인이 필요한경우 호출된다.

변수설명
$msg : 표시될 메시지
$_confirm_type : 게시판에서 넘어오는 입력유형
===================================================== */
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
<br />
<?=$msg?>
<form action="?<?=$_get_param[4]?>" method="post">
<input type="hidden" name="mode" value="<?=$mode?>">
<input type="hidden" name="confirm" value="ok">
<input type="submit" value="확인" class="button" /> 
<input type="button" value="취소" onclick="history.back();" class="button" />
</form>
