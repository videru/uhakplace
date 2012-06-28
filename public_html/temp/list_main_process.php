<? if (!defined('RGBOARD_VERSION')) exit; ?>
<?
/* =====================================================

  최종수정일 : 
 ===================================================== */
	if(isset($_REQUEST['skin_path'])) exit;
	
	if($_bbs_auth['list']) {
		include('list_where.php');
		include('list_pre_process.php');

		if($mode==='list') include("_header.php");
		if(file_exists($skin_path."list.php")) include($skin_path."list.php");
		//if($mode==='list') include('_footer.php');
	}
?>