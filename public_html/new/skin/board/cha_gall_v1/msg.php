<?
		if(!$msg)
			switch($_msg_type) {
				case "deny_ip" : $msg=$ip.'�� ������ �����Ǿ� �ֽ��ϴ�.';
				break;
				case "deny_word" : $msg=$word.'(��)�� ����Ҽ� ���� �ܾ��Դϴ�.';
				break;
				case "spam_chk" : $msg='���Թ��� ���ڸ� ��Ȯ�� �Է����ּ���.';
				break;
				case "vote_already" : $msg='�̹���ǥ �ϼ̽��ϴ�.';
				break;
				case "vote_yes_auth" : $msg='��õ������ �����ϴ�.';
				break;
				case "vote_no_auth" : $msg='�ݴ������ �����ϴ�.';
				break;

				case "list_no_auth" : $msg='�� ����� ���� �����ϴ�..';
				break;
				
				case "write_no_auth_member" : $msg='�۾��� ������ �����ϴ�.';
				break;
				case "write_no_auth_guest" : $msg='�۾��� ������ �����ϴ�.<br>ȸ���ΰ�� �α��� ���ּ���.';
				break;
				case "write_deny_time" : $msg=$write_deny_time.'�� �Ŀ� ���� �÷��ּ���.(�������)';
				break;
				case "write_no_name" : $msg='�ۼ��ڸ��� �Է����ּ���.';
				break;
				case "write_no_pass" : $msg='��ȣ�� �Է����ּ���.';
				break;
				case "write_no_subject" : $msg='������ �Է����ּ���.';
				break;
				case "write_no_content" : $msg='�۳����� �Է����ּ���.';
				break;

				case "reply_no_auth_member" : $msg='�亯�� ������ �����ϴ�.';
				break;
				case "reply_no_auth_guest" : $msg='�亯�� ������ �����ϴ�.<br>ȸ���ΰ�� �α��� ���ּ���.';
				break;
				case "reply_no_auth_notice" : $msg='�������׿� �亯�� �޼� �����ϴ�.';
				break;
				case "reply_no_notice" : $msg='�亯���� �������� �۷� ����Ҽ� �����ϴ�.';
				break;


				case "modify_no_auth_member" : $msg='�ۼ��� ������ �����ϴ�.';
				break;
				case "modify_no_auth_guest" : $msg='�ۼ��� ������ �����ϴ�.<br>ȸ���ΰ�� �α��� ���ּ���.';
				break;
				case "modify_no_auth_reply" : $msg='���ñ��� �ִ°�� ������ �Ұ����մϴ�.';
				break;
				case "modify_pass_error" : $msg='�ۼ��� ��ȣ�� �ٸ��ϴ�.';
				break;

				case "delete_no_auth_member" : $msg='�ۻ��� ������ �����ϴ�.';
				break;
				case "delete_no_auth_guest" : $msg='�ۻ��� ������ �����ϴ�.<br>ȸ���ΰ�� �α��� ���ּ���.';
				break;
				case "delete_no_auth_reply" : $msg='���ñ��� �ִ°�� ������ �Ұ����մϴ�.';
				break;
				case "delete_pass_error" : $msg='�ۻ��� ��ȣ�� �ٸ��ϴ�.';
				break;

				case "comment_write_no_auth_member" : $msg='�ڸ�Ʈ�� �ۼ��� �� �����ϴ�.';
				break;
				case "comment_write_no_auth_guest" : $msg='�ڸ�Ʈ�� �ۼ��� �� �����ϴ�.<br>ȸ���ΰ�� �α��� ���ּ���.';
				break;
				case "comment_write_no_name" : $msg='�ڸ�Ʈ �ۼ��ڸ��� �Է����ּ���.';
				break;
				case "comment_write_no_pass" : $msg='�ڸ�Ʈ ��ȣ�� �Է����ּ���.';
				break;
				case "comment_write_no_content" : $msg='�ڸ�Ʈ�� �Է����ּ���.';
				break;
				case "comment_delete_no_auth_member" : $msg='�ڸ�Ʈ ���������� �����ϴ�.';
				break;
				case "comment_delete_no_auth_guest" : $msg='�ڸ�Ʈ ���������� �����ϴ�.<br>ȸ���ΰ�� �α��� ���ּ���.';
				break;
				case "comment_delete_pass_error" : $msg='�ڸ�Ʈ ���� ��ȣ�� �ٸ��ϴ�.';
				break;
				
				case "view_secret_error" : $msg='��б��� ���� �����ϴ�.';
				break;
				case "view_secret_pass_error" : $msg='��б� ��ȣ�� �ٸ��ϴ�.';
				break;
				case "view_delete_error" : $msg='������ ���Դϴ�.';
				break;
				
			}
?>
<table border="0" cellpadding="5" cellspacing="0" align="center">
<tr bgcolor="#f7f7f7">
<td align="center">
<table border="0" cellpadding="10" cellspacing="0" bgcolor="#ffffff">
<tr>
<td align="center">
<img src="<?=$skin_url?>images/img_errmsg.gif" align="absmiddle" border="0">
<br />
<?=$msg?>
<br />
<br />
<img src="<?=$skin_url?>images/confirm.gif" onclick="history.back();" align="absmiddle" style="cursor:pointer">
</td></tr>
</table>
</td></tr>
</table>