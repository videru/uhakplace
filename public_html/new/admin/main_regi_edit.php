<?

	include_once("../include/lib.php");
	require_once("admin_chk.php");
	
   // ����
	if($mode=='delete') {	
		
		// �б� ����
		$rs->clear();
		$rs->set_table($_table['main_regi']);
		$rs->add_where("num=$num");
		$rs->delete();		
		$rs->commit();
		rg_href("main_regi.php?$_get_param[3]");
	}


?>