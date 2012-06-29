<?

	include_once("../include/lib.php");
	require_once("admin_chk.php");
  
   $today_year=date('Y'); 
   $today_month=date('m'); 
   $today_date=date('d'); 
   $today_woe=date('w'); 

   $regi_date = mktime(0, 0, 0, $today_month, $today_date, $today_year);
                

	
   // 삭제
	if($mode=='delete') {	

		
		//삭제
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

	    	$rs->add_field("admin_comment","$admin_comment");
		
		if($mode=='modify') {
			$rs->add_where("c_no=$c_no");
			$rs->update();

		}else {
			$rs->insert();	
			$rs->commit();    	
		}

		    $rs->commit();

  	}

			$url ="person_check_list.php?page=".$page;		
?>
<script >
   opener.location.href="<?=$url?>";
	self.close();	
</script>
?>
