<?
/* =====================================================

  ����üũ �̹��� ���

  ���������� : 
 ===================================================== */
	include_once("../include/lib.php");

	$schk_code = $_SESSION["schk_".$chk_code];
	if(preg_match('/^[0-9]/',$schk_code[$ord])) { // ����
		$file='images_spam/'.$schk_code[$ord].".gif";
	} else if(preg_match('/^[a-z]/',$schk_code[$ord])) { // �ҹ���
		$file='images_spam/'.$schk_code[$ord]."1.gif";
	} else if(preg_match('/^[A-Z]/',$schk_code[$ord])) { // �빮��
		$file='images_spam/'.$schk_code[$ord]."2.gif";
	}
	header ("Cache-Control: no-cache, must-revalidate");
	header ("Pragma: no-cache");
	$LastModified = gmdate("D d M Y H:i:s", time()); 
	header("Last-Modified: $LastModified GMT"); 
	header("ETag: \"$LastModified\"");
		
	rg_file_download($file,'-','application/octet-stream');
?>