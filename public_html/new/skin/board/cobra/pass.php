<?
/* =====================================================
 ���α׷��� : �������� V4 �Խ��ǽ�Ų

���ϼ��� : �ۻ���,�ڸ�Ʈ����,��б���ȸ�� ��ȣ�Է��� �ʿ��Ѱ�� ȣ��ȴ�.

��������
$msg : ǥ�õ� �޽���
$_confirm_type : �Խ��ǿ��� �Ѿ���� �Է�����
===================================================== */
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
��ȣ�� �Է����ּ���.<br>
<input type="hidden" name="mode" value="<?=$mode?>">
<input type="password" name="old_pass" class="input2">
<input type="image" src="../../cobra/img/confirm.gif" align="absmiddle"> 
<img src="../../cobra/img/cancel.gif" onClick="history.back();" style="cursor:pointer" align="absmiddle">
</form>