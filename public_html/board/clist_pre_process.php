<? if (!defined('RGBOARD_VERSION')) exit; ?>
<?
/* =====================================================
  최종수정일 : 
 ===================================================== */
	if(isset($_REQUEST['skin_path'])) exit;
	
	$rs_comment = new $rs_class($dbcon);
	$rs_comment->clear();
	$rs_comment->set_table($_table['bbs_comment']);
	$rs_comment->add_where("bd_num=$bd_num");
	$rs_comment->add_order("bc_write_date DESC, bc_num");


	$page_info=$rs_comment->select_list($page,10,10);
		$no = $page_info['start_no'];
?>