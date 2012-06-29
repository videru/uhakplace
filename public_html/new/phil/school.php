<?
	include_once("../include/lib.php");
		
		$rs->clear();
		$rs->set_table($_table['hp_site']);
		$rs->add_where("code=$code");
		$rs->select();
		$data=$rs->fetch();		


?>
<? include("./sub_view_header.php"); ?>

<table width="692" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td >
<table width="692" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="a_sub_title2" background="../img/school_view_title_bg.gif" height="36" ><?=$data['s_title']?> (<?=$data['title']?>)</td>
  </tr>
</table>	
	



<? include("./sub_view_footer.php"); ?>
