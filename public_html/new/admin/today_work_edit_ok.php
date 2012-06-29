<?

	include_once("../include/lib.php");
	require_once("admin_chk.php");
  


	
   // 삭제
	if($mode=='delete') {	

		
		//삭제
		$rs->clear();
		$rs->set_table($_table['today_work']);
		$rs->add_where("c_no=$c_no");
		$rs->delete();
		
		$rs->commit();
		rg_href("person_check_list.php");
	}

	if($_SERVER['REQUEST_METHOD']=='POST') {

		
			$rs->clear();
	    	$rs->set_table($_table['today_work']);
	
	    	$rs->add_field("today_work","$today_work");
	    	$rs->add_field("regi_date","$regi_date");
			
		if($mode=='modify') {
			$rs->add_where("c_no=$c_no");
			$rs->update();

		}else {
			$rs->insert();	

		}

		    $rs->commit();

  	}

			$url ="person_check_list.php";		
?>
<script >
   opener.location.href="<?=$url?>";
	self.close();	
</script>
?>
