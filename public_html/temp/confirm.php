<? if (!defined('RGBOARD_VERSION')) exit; ?>
<?
/* =====================================================

  ���������� : 
 ===================================================== */
	if(isset($_REQUEST['skin_path'])) exit;

	include("_header.php");
	if(file_exists($skin_path."confirm.php")) include($skin_path."confirm.php");
	include('_footer.php');
?>