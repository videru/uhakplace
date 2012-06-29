<? if (!defined('RGBOARD_VERSION')) exit; ?>
<?
		if(!$msg)
			switch($_msg_type) {
				case "deny_ip" : $msg=$ip.'는 접근이 금지되어 있습니다.';
				break;
				case "deny_word" : $msg=$word.'(은)는 사용할수 없는 단어입니다.';
				break;
				case "spam_chk" : $msg='스팸방지 문자를 정확히 입력해주세요.';
				break;
				case "vote_already" : $msg='이미투표 하셨습니다.';
				break;
				case "vote_yes_auth" : $msg='추천권한이 없습니다.';
				break;
				case "vote_no_auth" : $msg='반대권한이 없습니다.';
				break;

				case "list_no_auth" : $msg='글 목록을 볼수 없습니다..';
				break;
				
				case "write_no_auth_member" : $msg='글쓰기 권한이 없습니다.';
				break;
				case "write_no_auth_guest" : $msg='글쓰기 권한이 없습니다.<br>회원인경우 로그인 해주세요.';
				break;
				case "write_deny_time" : $msg=$write_deny_time.'초 후에 글을 올려주세요.(도배방지)';
				break;
				case "write_no_name" : $msg='작성자명을 입력해주세요.';
				break;
				case "write_no_pass" : $msg='암호를 입력해주세요.';
				break;
				case "write_no_subject" : $msg='제목을 입력해주세요.';
				break;
				case "write_no_content" : $msg='글내용을 입력해주세요.';
				break;

				case "reply_no_auth_member" : $msg='답변글 권한이 없습니다.';
				break;
				case "reply_no_auth_guest" : $msg='답변글 권한이 없습니다.<br>회원인경우 로그인 해주세요.';
				break;
				case "reply_no_auth_notice" : $msg='공지사항에 답변을 달수 없습니다.';
				break;
				case "reply_no_notice" : $msg='답변글은 공지사항 글로 등록할수 없습니다.';
				break;


				case "modify_no_auth_member" : $msg='글수정 권한이 없습니다.';
				break;
				case "modify_no_auth_guest" : $msg='글수정 권한이 없습니다.<br>회원인경우 로그인 해주세요.';
				break;
				case "modify_no_auth_reply" : $msg='관련글이 있는경우 수정이 불가능합니다.';
				break;
				case "modify_pass_error" : $msg='글수정 암호가 다릅니다.';
				break;

				case "delete_no_auth_member" : $msg='글삭제 권한이 없습니다.';
				break;
				case "delete_no_auth_guest" : $msg='글삭제 권한이 없습니다.<br>회원인경우 로그인 해주세요.';
				break;
				case "delete_no_auth_reply" : $msg='관련글이 있는경우 삭제가 불가능합니다.';
				break;
				case "delete_pass_error" : $msg='글삭제 암호가 다릅니다.';
				break;

				case "comment_write_no_auth_member" : $msg='코멘트를 작성할 수 없습니다.';
				break;
				case "comment_write_no_auth_guest" : $msg='코멘트를 작성할 수 없습니다.<br>회원인경우 로그인 해주세요.';
				break;
				case "comment_write_no_name" : $msg='코멘트 작성자명을 입력해주세요.';
				break;
				case "comment_write_no_pass" : $msg='코멘트 암호를 입력해주세요.';
				break;
				case "comment_write_no_content" : $msg='코멘트를 입력해주세요.';
				break;
				case "comment_delete_no_auth_member" : $msg='코멘트 삭제권한이 없습니다.';
				break;
				case "comment_delete_no_auth_guest" : $msg='코멘트 삭제권한이 없습니다.<br>회원인경우 로그인 해주세요.';
				break;
				case "comment_delete_pass_error" : $msg='코멘트 삭제 암호가 다릅니다.';
				break;
				
				case "view_secret_error" : $msg='비밀글을 볼수 없습니다.';
				break;
				case "view_secret_pass_error" : $msg='비밀글 암호가 다릅니다.';
				break;
				case "view_delete_error" : $msg='삭제된 글입니다.';
				break;
				
			}
?>
<br />
<?=$msg?>
<br />
<input type="button" value="확인" onclick="history.back();" class="button" />