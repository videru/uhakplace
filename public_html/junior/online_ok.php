<?
	include_once("../include/lib.php");

	if($_SERVER['REQUEST_METHOD']=='POST') {
     		$rs->clear();
	    	$rs->set_table($_table['pre_regi']);
			$rs->add_field("student_name","$student_name");		
			$rs->add_field("chain","$chain");		
			$rs->add_field("consult","$consult");	
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
	    	$rs->add_field("school_name","$school_name");	
	    	$rs->add_field("study_gigan","$study_gigan");	
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
	    	$rs->add_field("regi_date",time());	
	    	$rs->add_field("process_state","1");	
		if($mode=='modify') {
			$rs->add_where("regi_no=$num");
			$rs->update();
		} else {
			$rs->insert();
			$num=$rs->get_insert_id();		
		}
	     	$rs->commit();	

           $url = "../junior/index.php";
}
?>
<script>
    alert("상담 문의가 접수되었습니다."); 

    opener.location.href="<?=$url?>";
	self.close();
</script>