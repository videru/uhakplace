<center>
<br>
<?
/* =====================================================
 ���α׷��� : �������� V4 �Խ��ǽ�Ų

���ϼ��� : �ۻ����� Ȯ���� �ʿ��Ѱ�� ȣ��ȴ�.

��������
$msg : ǥ�õ� �޽���
$_confirm_type : �Խ��ǿ��� �Ѿ���� �Է�����
===================================================== */
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
<form action="?<?=$_get_param[4]?>" method="post">
<input type="hidden" name="mode" value="<?=$mode?>">
<input type="hidden" name="confirm" value="ok">
<input type="image" src="../img/confirm.gif" align="absmiddle"> 
<img src="../img/cancel.gif" onClick="history.back();" style="cursor:pointer" align="absmiddle">
</form>
</center>