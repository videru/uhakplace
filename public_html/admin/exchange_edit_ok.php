<?

	include_once("../include/lib.php");
	require_once("admin_chk.php");
              


	if($_SERVER['REQUEST_METHOD']=='POST') {

		
			$rs->clear();
	    	$rs->set_table($_table['exchange']);
	
	    	$rs->add_field("exchange1","$exchange1");
	    	$rs->add_field("exchange2","$exchange2");
	    	$rs->add_field("exchange3","$exchange3");
	    	$rs->add_field("exchange4","$exchange4");
	    	$rs->add_field("exchange5","$exchange5");
	    	$rs->add_field("exchange6","$exchange6");
	    	$rs->add_field("exchange7","$exchange7");
	    	$rs->add_field("exchange8","$exchange8");
		

			$rs->update();

	    	$rs->commit();

			$url ="school_list.php";		
	}

?>
<script >
   opener.location.href="<?=$url?>";
	self.close();	
</script>