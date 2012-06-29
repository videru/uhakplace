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
		rg_href("cafe_member_edit.php?&page=".$page_no."&mode=modify&num=".$cmt_num."&national=".$national);
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

            if($pp == "regi"){
	    	rg_href("regi_edit.php?&page=".$page_no."&mode=modify&num=".$cmt_regi_num."&national=".$national);
	        }else{
	    	rg_href("cafe_member_edit.php?&page=".$page_no."&mode=modify&num=".$cmt_num."&national=".$national);
            }

	}


?>