<?

	include_once("../include/lib.php");
	require_once("admin_chk.php");
	

	// »èÁ¦
	if($mode=='delete') {	
		$rs->clear();
		$rs->set_table($_table['account_kyejung']);
		$rs->add_where("ak_no=$num");
		$rs->delete();
		
		$rs->commit();
	}

	if($_SERVER['REQUEST_METHOD']=='POST') {

     		$rs->clear();
	    	$rs->set_table($_table['account_kyejung']);
			$rs->add_field("kyejung_name","$kyejung_name");		
			$rs->add_field("kyejung_code","$kyejung_code");	
		if($mode=='modify') {
			$rs->add_where("ak_no=$num");
			$rs->update();
		} else {
			$rs->insert();
			$ak_no=$rs->get_insert_id();		
		}
	
	}     
	
	  rg_href("account_kyejung_list.php");
?>
