<? if (!defined('RGBOARD_VERSION')) exit; ?>
<?
/* =====================================================

  ���������� : 
 ===================================================== */
	if(isset($_REQUEST['skin_path'])) exit;

	include("../temp/top.php");
	if(file_exists($skin_path."confirm.php")) include($skin_path."confirm.php");
	include('../temp/footer.php');
?>