<? if (!defined('RGBOARD_VERSION')) exit; ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>�������� ���Ϲ߼�</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
</head>
<body>
<table border="1" cellpadding="3" cellspacing="0" width="600" bordercolordark="white" bordercolorlight="#E1E1E1" style="table-layout:fixed;font-size:9pt;">
	<tr>
		<td width="120" align="center" bgcolor="#F0F0F4"><strong>����</strong></td>
		<td><a href="<?=$mail_view_url?>" target="_rgboard"><?=$mail_subject?></a></td>
	</tr>
	<tr>
		<td width="120" align="center" bgcolor="#F0F0F4"><strong>�ۼ���</strong></td>
		<td><?=$mail_from_name?></td>
	</tr>
	<tr>
		<td width="120" align="center" bgcolor="#F0F0F4"><strong>����</strong></td>
		<td><?=$mail_content?></td>
	</tr>
</table>
</body>
</html>
