<? if (!defined('RGBOARD_VERSION')) exit; ?>
<?
/* =====================================================

  ��ȣ�Է�

  ���������� : 
 ===================================================== */
	if(isset($_REQUEST['skin_path'])) exit;

	include_once("../temp/top.php");
	include_once("../temp/nav.php");
	if(file_exists($skin_path."pass.php")) include($skin_path."pass.php");
	include_once('../temp/footer.php');
?>