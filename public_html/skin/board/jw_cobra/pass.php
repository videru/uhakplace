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