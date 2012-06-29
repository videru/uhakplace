<?php
/*
 $arr_browser = array ("iPhone","iPod","IEMobile","Mobile","lgtelecom","PPC");
for($indexi = 0 ; $indexi < count($arr_browser) ; $indexi++) {
 if(strpos($_SERVER['HTTP_USER_AGENT'],$arr_browser[$indexi]) == true){
   header("Location: http://m.uhakplace.co.kr");
   exit;
 }
}
*/
?>

<?
	$site_path='../';
	$site_url='../';
	ob_start();
	include_once($site_path."include/lib.php");
	ob_end_clean();
	$LastModified = gmdate("D d M Y H:i:s", filemtime($_SERVER['SCRIPT_FILENAME'])); 
	header("Last-Modified: $LastModified GMT");
	header("ETag: \"$LastModified\""); 
?>
<html>
<head>
<title>:: 유학의 길라잡이 유학PLACE ::</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
</head>
<frameset rows="*,0" frameborder="NO" border="0" framespacing="0">
  <frame src="../phil/index_new.php" name="">
<frame src="about:blank"></frameset>
<noframes>
<body alink="#FFFFFF" link="#FFFFFF" vlink="#FFFFFF" text="#FFFFFF" onLoad="location.href='../phil/index_new.php'" bgcolor="#FFFFFF">
<a href="../phil/index_new.php">메인화면으로</a>
</body>
</noframes>
</html>