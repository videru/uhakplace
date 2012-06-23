<?
    $PageNum = 1;
    $subPageNum  = 1;	
	$subtitle = "11" ;

	include_once("../include/lib.php");
 
    $rs_list = new $rs_class($dbcon);
	$rs_list->clear();
	$rs_list->set_table($_table['ju_school']);
    $rs_list->add_where("section = 2"); 	
    include_once('../junior/sub_header.php'); 

?>
mmmm
<?  include_once('../junior/sub_footer.php'); ?>