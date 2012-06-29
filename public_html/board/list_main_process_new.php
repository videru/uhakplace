<? if (!defined('RGBOARD_VERSION')) exit; ?>
<link href="<?=$_url['css']?>style.css" rel="stylesheet" type="text/css">
<script src="<?=$_url['js']?>common.js"></script>
<script src="<?=$_url['js']?>lib.validate.js"></script>
<script src="<?=$_url['js']?>flash.js"></script>
<?
/* =====================================================

  최종수정일 : 
 ===================================================== */
	if(isset($_REQUEST['skin_path'])) exit;
	if(file_exists($skin_path."style.php")) include($skin_path."style.php");
	
	
	
	if($_bbs_auth['list']) {
		include('list_where.php');
		include('list_pre_process.php');

		if($mode==='list') include("../temp/top.php");
		if(file_exists($skin_path."list.php")) include($skin_path."list.php");
		if($mode==='list') include('../temp/footer.php');
	}
?>