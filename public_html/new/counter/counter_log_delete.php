<?
/* =====================================================

  ���������� : 
 ===================================================== */
	$site_path='../';
	$site_url='../';
	require_once($site_path.'include/lib.inc.php');

	if(!$auth['site_admin']) {
		rg_href("","�����ڸ� ���� �����մϴ�.",'',"close");
	}
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>�������� ver <?=$C_RGBOARD_VERSION?> - �������</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link href="<?=$skin_site_url?>style.css" rel="stylesheet" type="text/css">
</head>
<body>
<?
	if($Submit=='Ȯ��'){
		$dbqry="
				DELETE FROM `rg_counter_log`
		";
		$rs=query($dbqry,$dbcon);
?>
<form name="form1" method="post" action="">
  ������� �α׸� �����߽��ϴ�.<br>
  <input type="button" value="�ݱ�" onClick="self.close()">
</form>
<?
	} else {
?>
<form name="form1" method="post" action="">
  ������� �α׸� �����մϴ�.<br>
  Ȯ���մϱ�.?<br>
  <input type="submit" name="Submit" value="Ȯ��">
</form>
<?
	}
?>
</body>
</html>
