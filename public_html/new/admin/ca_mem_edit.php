<?
 	include_once("../include/lib.php");
	require_once("admin_chk.php");


	// 학교 삭제
	if($mode=='delete') {	
		$rs->clear();
		$rs->set_table($_table['ca_mem_comm']);
		$rs->add_where("num=$num");
		$rs->delete();
		
		$rs->commit();
		rg_href("cafe_member_edit.php?$_get_param[2]");
	}

	if($_SERVER['REQUEST_METHOD']=='POST') {

     		$rs->clear();
	    	$rs->set_table($_table['ca_mem_comm']);
	    	$rs->add_field("cmt_num","$cmt_num");	
	    	$rs->add_field("cmt_reg_date",time());	
	    	$rs->add_field("cmt_comment","$cmt_comment");	
	    	$rs->add_field("cmt_name","$cmt_name");	 
			$rs->insert();

	     	$rs->commit();	
	    	rg_href("cafe_member_edit.php?$_get_param[2]");
	}


?>