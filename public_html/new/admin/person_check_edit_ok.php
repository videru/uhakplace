<?

	include_once("../include/lib.php");
	require_once("admin_chk.php");
  
   $today_year=date('Y'); 
   $today_month=date('m'); 
   $today_date=date('d'); 
   $today_woe=date('w'); 

   $regi_date = mktime(0, 0, 0, $today_month, $today_date, $today_year);
                

	
   // ����
	if($mode=='delete') {	

		
		//����
		$rs->clear();
		$rs->set_table($_table['working']);
		$rs->add_where("c_no=$c_no");
		$rs->delete();
		
		$rs->commit();
		rg_href("working_list.php?page=".$page);
	}

	if($_SERVER['REQUEST_METHOD']=='POST') {

		
			$rs->clear();
	    	$rs->set_table($_table['working']);
	
	    	$rs->add_field("working_title","$working_title");
	    	$rs->add_field("morning_work_title","$morning_work_title");
	    	$rs->add_field("morning_work_text","$morning_work_text");
	    	$rs->add_field("afternoon_work_title","$afternoon_work_title");
	    	$rs->add_field("afternoon_work_text","$afternoon_work_text");
	    	$rs->add_field("tomorrow_work_title","$tomorrow_work_title");
	    	$rs->add_field("tomorrow_work_text","$tomorrow_work_text");
	    	$rs->add_field("etc_work_title","$etc_work_title");
	    	$rs->add_field("etc_work_text","$etc_work_text");
		
		if($mode=='modify') {
			$rs->add_where("c_no=$c_no");
			$rs->update();

		}else {
			$rs->insert();	
			$rs->commit();    	
		}

		    $rs->commit();

  	}

			$url ="working_list.php?page=".$page;		
?>
<script >
   opener.location.href="<?=$url?>";
	self.close();	
</script>
?>
