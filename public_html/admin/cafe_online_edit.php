<?
	include_once("../include/lib.php");
	require_once("admin_chk.php");
	
 	
		// 상담 삭제
	if($mode=='delete') {	
		$rs->clear();
		$rs->set_table($_table['cafe_online']);
		$rs->add_where("num=$num");
		$rs->delete();
		
		$rs->commit();
		rg_href("cafe_online_list.php?$_get_param[3]");
	}

