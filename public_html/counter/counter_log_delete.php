<?
/* =====================================================

  최종수정일 : 
 ===================================================== */
	$site_path='../';
	$site_url='../';
	require_once($site_path.'include/lib.inc.php');

	if(!$auth['site_admin']) {
		rg_href("","관리자만 접속 가능합니다.",'',"close");
	}
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>알지보드 ver <?=$C_RGBOARD_VERSION?> - 접속통계</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link href="<?=$skin_site_url?>style.css" rel="stylesheet" type="text/css">
</head>
<body>
<?
	if($Submit=='확인'){
		$dbqry="
				DELETE FROM `rg_counter_log`
		";
		$rs=query($dbqry,$dbcon);
?>
<form name="form1" method="post" action="">
  접속통계 로그를 삭제했습니다.<br>
  <input type="button" value="닫기" onClick="self.close()">
</form>
<?
	} else {
?>
<form name="form1" method="post" action="">
  접속통계 로그를 삭제합니다.<br>
  확실합니까.?<br>
  <input type="submit" name="Submit" value="확인">
</form>
<?
	}
?>
</body>
</html>
