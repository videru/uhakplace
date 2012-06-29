<?
    $PageNum = "1" ;
	$subPageNum = "9" ;
	$ssubNum = "9" ;
	include_once("../include/lib.php");

	if($_SERVER['REQUEST_METHOD']=='POST') {

			$rs->clear();
	    	$rs->set_table($_table['consult']);			
			$rs->add_field("process","1");	
	    	$rs->add_field("name","$name");	
	    	$rs->add_field("email","$email");	

	    	$rs->add_field("tel","$tel");	
	    	$rs->add_field("hp","$hp");	
	    	$rs->add_field("etc_memo","$etc_memo");	
	    	$rs->add_field("reg_date",time());	

			$rs->insert();


			$rs->commit();
	
		    rg_href("../index.php","상담 문의가 접수되었습니다.");

	}


?>
<script language="JavaScript">


<!--
	function send(){		
      document.member_form.submit();
}
//-->
</script>
<? include("./sub_header.php"); ?>

<? include("./sub_footer.php"); ?>