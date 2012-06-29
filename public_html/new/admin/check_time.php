<?

	include_once("../include/lib.php");
	require_once("admin_chk.php");
  
   $today_year=date('Y'); 
   $today_month=date('m'); 
   $today_date=date('d'); 
   $today_woe=date('w'); 

   $regi_date = mktime(0, 0, 0, $today_month, $today_date, $today_year);
                
	
//	if($_SERVER['REMOTE_ADDR'] == "121.166.67.192" or $_SERVER['REMOTE_ADDR'] == "58.103.58.194")
			
			$rs->clear();
	    	$rs->set_table($_table['working']);
	
	    	$rs->add_field("consultant","$_mb[mb_num]");
	    	$rs->add_field("consultant_hp","$_mb[mb_tel]");
	    	$rs->add_field("check_time",time());
	    	$rs->add_field("regi_date","$regi_date");
		

			$rs->insert();	
		    $rs->commit();

            rg_href("working_list.php?");				
	

//}else{


//rg_href('','사무실이 아닙니다..','back');

//}



?>
