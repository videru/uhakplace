<? 
	include_once("../include/lib.php");
	

   $url = "school_cost".$page_no.".php?num=".$num."&week=".$week."&program_no=".$program_no."&dorm_no=".$dorm_no;   
   
?>
<script >
   opener.location.href="<?=$url?>";
   self.close();	
</script>
