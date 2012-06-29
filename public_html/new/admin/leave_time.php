<?

	include_once("../include/lib.php");
	require_once("admin_chk.php"); 
              
//		if($_SERVER['REMOTE_ADDR'] == "121.166.67.192" or $_SERVER['REMOTE_ADDR'] == "58.103.58.194"){		
			
			$rs->clear();
	    	$rs->set_table($_table['working']);
	
	    	$rs->add_field("leave_time",time());		

			$rs->add_where("c_no=$c_no");
			$rs->update();

             rg_href("working_list.php?page=".$page);		


//}else{


//rg_href('','사무실이 아닙니다.','back');

//}


?>

