<? if (!defined('RGBOARD_VERSION')) exit; ?>
<?
/* =====================================================

  최종수정일 : 2007-07-17
2007-07-17
list_where.php 에서 분리
 ===================================================== */
	if(isset($_REQUEST['skin_path'])) exit;

	if(!isset($rs_list)) exit;

	$page_info=$rs_list->select_list($page,$_list_cfg['list_count'],$_list_cfg['page_count']);

	$_skin_list_main=$skin_path.'list_main.php';
	$_skin_list_secret=(file_exists($skin_path."list_secret.php"))?$skin_path.'list_secret.php':$_skin_list_main;
	$_skin_list_delete=(file_exists($skin_path."list_delete.php"))?$skin_path.'list_delete.php':$_skin_list_main;
	$_skin_list_notice=(file_exists($skin_path."list_notice.php"))?$skin_path.'list_notice.php':$_skin_list_main;
	$_skin_list_current=(file_exists($skin_path."list_current.php"))?$skin_path.'list_current.php':$_skin_list_main;

	if(isset($kw)) $kw = rg_html_entity($kw);
?>