<?

	include_once("../include/lib.php");
	require_once("admin_chk.php");
	

	
		// 학교 삭제
	if($mode=='delete') {	
		$rs->clear();
		$rs->set_table($_table['regi']);
		$rs->add_where("regi_no=$num");
		$rs->delete();
		
		$rs->commit();
		rg_href("regi_list.php?$_get_param[3]");
	}

	if($_SERVER['REQUEST_METHOD']=='POST') {

     		$rs->clear();
	    	$rs->set_table($_table['regi']);
			$rs->add_field("student_name","$student_name");		
			$rs->add_field("chain","$chain");		
	    	$rs->add_field("regi_date1","$regi_date1");
	    	$rs->add_field("regi_date2","$regi_date2");
 	    	$rs->add_field("regi_date3","$regi_date3");
	    	$rs->add_field("abroad_date1","$abroad_date1");
	    	$rs->add_field("abroad_date2","$abroad_date2");	
	    	$rs->add_field("abroad_date3","$abroad_date3");	
	    	$rs->add_field("airpoet_date1","$airpoet_date1");
	    	$rs->add_field("airpoet_date2","$airpoet_date2");	
	    	$rs->add_field("airpoet_date3","$airpoet_date3");				
	    	$rs->add_field("national","$national");	
		   	$rs->add_field("passport","$passport");
	    	$rs->add_field("passport_check","$passport_check");	
			$rs->add_field("regi_cost","$regi_cost");
	    	$rs->add_field("regi_cost_check","$regi_cost_check");	
			$rs->add_field("school_regi","$school_regi");
	    	$rs->add_field("school_regi_check","$school_regi_check");					
	    	$rs->add_field("air_reserve","$air_reserve");	
	    	$rs->add_field("air_reserve_check","$air_reserve_check");
	    	$rs->add_field("air_paid","$air_paid");		
	    	$rs->add_field("air_paid_check","$air_paid_check");
	    	$rs->add_field("air_ticket","$air_ticket");
	    	$rs->add_field("air_ticket_check","$air_ticket_check");
	    	$rs->add_field("insu","$insu");
	    	$rs->add_field("insu_check","$insu_check");
			$rs->add_field("cost_paid","$cost_paid");	
	    	$rs->add_field("cost_paid_check","$cost_paid_check");			
			$rs->add_field("abroad_ot","$abroad_ot");
	    	$rs->add_field("abroad_ot_check","$abroad_ot_check");
	    	$rs->add_field("abroad","$abroad");	
	    	$rs->add_field("abroad_check","$abroad_check");		
	    	$rs->add_field("mb_id","$mb_id");	
	    	$rs->add_field("email","$email");		
	    	$rs->add_field("tel","$tel");	
	    	$rs->add_field("etc","$etc");	
	    	$rs->add_field("process_state","$process_state");	
		if($mode=='modify') {
			$rs->add_where("regi_no=$num");
			$rs->update();
		} else {
			$rs->insert();
			$regi_no=$rs->get_insert_id();		
		}
	
		$rs->commit();		
			
		
   if ($pp=="1") {
       $url = "regi_list.php?$_get_param[3]";   
   } 
	elseif ($ppcode=="2") {
       $url = "abroad_student_list.php?$_get_param[3]";   
   } else {
       $url = "regi_list.php?$_get_param[3]";	  
   }


}


?>
<script >
    location.href="<?=$url?>";
</script>