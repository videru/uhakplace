<? if (!defined('RGBOARD_VERSION')) exit; ?>
<?
/* =====================================================

  암호입력

  최종수정일 : 
 ===================================================== */
	if(isset($_REQUEST['skin_path'])) exit;

	include("_header.php");
	if(file_exists($skin_path."pass.php")) include($skin_path."pass.php");
	include('_footer.php');
?>