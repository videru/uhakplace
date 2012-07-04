<? if (!defined('RGBOARD_VERSION')) exit; ?>
<?
/* =====================================================

  최종수정일 : 
 ===================================================== */
	if(isset($_REQUEST['skin_path'])) exit;

	include("../temp/top.php");
	if(file_exists($skin_path."msg.php")) include($skin_path."msg.php");
	include('../temp/footer.php');
?>