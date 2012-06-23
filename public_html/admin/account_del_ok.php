<?
	include_once("../include/lib.php");
	require_once("admin_chk.php");
	

		$comm_date = mktime(0,0,0,$comm_date2,$comm_date3,$comm_date1);
     		

	      if($student_no>0){

	        $rs_list = new $rs_class($dbcon);
	        $rs_list->clear();
	        $rs_list->set_table($_table['st_account']);
	        $rs_list->add_where("student_no = $student_no");		
					
			
			$rs_list->clear();
	    	$rs_list->set_table($_table['st_account']);

	    	$rs_list->add_field("comm_date1","$comm_date1");	
	    	$rs_list->add_field("comm_date2","$comm_date2");	

	    	$rs_list->add_field("chain","$chain");	
	    	$rs_list->add_field("student_no","$student_no");	
	    	$rs_list->add_field("comm_text_no","$comm_text_no");		

	        if($comm_text_no==111 and $in_out_comm==1){
			$rs_list->add_field("iphak_incomm",0);	
	    	}
            if($comm_text_no==111 and $in_out_comm==2){
			$rs_list->add_field("iphak_outcomm",0);	
    	    }
            if($comm_text_no==121 and $in_out_comm==1){
			$rs_list->add_field("cost_incomm",0);	
    	    } 
            if($comm_text_no==121 and $in_out_comm==2){			
			$rs_list->add_field("cost_outcomm",0);				
    	    }
            if($comm_text_no==131 and $in_out_comm==1){				
			$rs_list->add_field("dorm_incomm",0);				
    	    }	
            if($comm_text_no==131 and $in_out_comm==2){			
			$rs_list->add_field("dorm_outcomm","$comm");				
    	    }
            if($comm_text_no==141 and $in_out_comm==1){
    	    $rs_list->add_field("airfee_incomm",0);	
    	    }  
            if($comm_text_no==141 and $in_out_comm==2){			
			$rs_list->add_field("airfee_outcomm",0);				
    	    }	 
            if($comm_text_no==151 and $in_out_comm==1){				
			$rs_list->add_field("insu_incomm",0);				
    	    }	
            if($comm_text_no==151 and $in_out_comm==2){				
			$rs_list->add_field("insu_outcomm",0);	
    	    }	
            if($comm_text_no==161 and $in_out_comm==1){				
			$rs_list->add_field("hs_info_incomm",0);				
    	    }	
            if($comm_text_no==161 and $in_out_comm==2){				
			$rs_list->add_field("hs_info_outcomm",0);	
    	    }
            if($comm_text_no==171 and $in_out_comm==1){				
			$rs_list->add_field("pickup_incomm",0);				
    	    }	
            if($comm_text_no==171 and $in_out_comm==2){				
			$rs_list->add_field("pickup_outcomm",0);
    	    }	
            if($comm_text_no==181 and $in_out_comm==1){				
			$rs_list->add_field("jien1_incomm",0);				
    	    }
            if($comm_text_no==181 and $in_out_comm==2){				
			$rs_list->add_field("jien1_outcomm",0);
    	    }			
				

		    $rs_list->add_where("student_no=$student_no");
			$rs_list->update();	
			$rs_list->commit();
			
						
		$rs->clear();
		$rs->set_table($_table['account']);
		$rs->add_where("ac_no=$no");
		$rs->delete();
		
		$rs->commit();	

        }else{

		$rs->clear();
		$rs->set_table($_table['account']);
		$rs->add_where("ac_no=$no");
		$rs->delete();
		
		$rs->commit();	

  }

		rg_href("bank_note.php?date1=".$date1."&date2=".$date2);	
?>