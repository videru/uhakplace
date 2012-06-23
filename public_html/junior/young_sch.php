<?
    $PageNum = 3;
    $subPageNum  = 1;	

	$subtitle = "31" ;
	include_once("../include/lib.php");
 
    $rs_list = new $rs_class($dbcon);
	$rs_list->clear();
	$rs_list->set_table($_table['young']);
    $rs_list->add_where("section != 1"); 
	
	$page_info=$rs_list->select_list($page,10,10);


	include_once('../junior/sub_header.php'); 


?>
<table width="668" border="0" align="center" cellpadding="0" cellspacing="0" >
  <tr>
    <td><img src="./img/young_imh.gif"/></td>
  </tr>
</table>
<?  include_once('../junior/sub_footer.php'); ?>