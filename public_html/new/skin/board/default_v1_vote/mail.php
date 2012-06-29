<? if (!defined('RGBOARD_VERSION')) exit; ?>
<?
/* =====================================================
 프로그램명 : 알지보드 V4 게시판스킨

파일설명 : 이메일전송폼

변수설명
$mail_view_url : 글보기 URL
$mail_subject : 글제목
$mail_from_name : 작성자명
$mail_content : 글내용
===================================================== */
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>알지보드 메일발송</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
</head>
<body>
<table border="1" cellpadding="3" cellspacing="0" width="600" bordercolordark="white" bordercolorlight="#E1E1E1" style="table-layout:fixed;font-size:9pt;">
	<tr>
		<td width="120" align="center" bgcolor="#F0F0F4"><strong>제목</strong></td>
		<td><a href="<?=$mail_view_url?>" target="_rgboard"><?=$mail_subject?></a></td>
	</tr>
	<tr>
		<td width="120" align="center" bgcolor="#F0F0F4"><strong>작성자</strong></td>
		<td><?=$mail_from_name?></td>
	</tr>
	<tr>
		<td width="120" align="center" bgcolor="#F0F0F4"><strong>내용</strong></td>
		<td><?=$mail_content?></td>
	</tr>
</table>
</body>
</html>
