<?
	include_once("../include/lib.php");
		
		$rs->clear();
		$rs->set_table($_table['hp_site']);
		$rs->add_where("code=$code");
		$rs->select();
		$data=$rs->fetch();		

$data['content'] = ereg_replace("<P>"," ",$data['content']);
$data['content'] = ereg_replace("</P>","<br>",$data['content']);
$data['content'] = ereg_replace("<br />","",$data['content']);

$code = $data['code'];
$code_t=substr($data['code'],0,2);  


?>
<? include("./sub_view_header.php"); ?>

<table width="692" border="0" cellspacing="0" cellpadding="0">
<?if($code_t ==31){?>
  <tr>
    <td >
<table width="692" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="95"><?if($code=="3101"){?><img src="../img/tap_ph_m1on.gif"><?}else{?><a href="../phil/site_view.php?code=3101"><img src="../img/tap_ph_m1.gif" border="0"></a><?}?></td>
	<td width="4">&nbsp;</td>	
    <td width="95"><?if($code=="3102"){?><img src="../img/tap_ph_m2on.gif"><?}else{?><a href="../phil/site_view.php?code=3102"><img src="../img/tap_ph_m2.gif" border="0"></a><?}?></td>
	<td width="4">&nbsp;</td>		   
    <td width="95"><?if($code=="3103"){?><img src="../img/tap_ph_m3on.gif"><?}else{?><a href="../phil/site_view.php?code=3103"><img src="../img/tap_ph_m3.gif" border="0"></a><?}?></td>
	<td width="4">&nbsp;</td>	
    <td width="95"><?if($code=="3104"){?><img src="../img/tap_ph_m4on.gif"><?}else{?><a href="../phil/site_view.php?code=3104"><img src="../img/tap_ph_m4.gif" border="0"></a><?}?></td>
	<td>&nbsp;</td>	   
  </tr>
</table>	
	
	</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>  
<?}elseif($code_t == 10 || $code_t == 20 || $code_t == 40 || $code_t == 50){?>
  <tr>
    <td >
<table width="692" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="95"><?if($code=="1001"){?><img src="../img/tap_two_m1on.gif"><?}else{?><a href="../phil/site_view.php?code=1001"><img src="../img/tap_two_m1.gif" border="0"></a><?}?></td>
	<td width="4">&nbsp;</td>	
    <td width="95"><?if($code=="2001"){?><img src="../img/tap_two_m2on.gif"><?}else{?><a href="../phil/site_view.php?code=2001"><img src="../img/tap_two_m2.gif" border="0"></a><?}?></td>
	<td width="4">&nbsp;</td>		   
    <td width="95"><?if($code=="5001"){?><img src="../img/tap_two_m3on.gif"><?}else{?><a href="../phil/site_view.php?code=5001"><img src="../img/tap_two_m3.gif" border="0"></a><?}?></td>
	<td width="4">&nbsp;</td>	
    <td width="95"><?if($code=="4001"){?><img src="../img/tap_two_m4on.gif"><?}else{?><a href="../phil/site_view.php?code=4001"><img src="../img/tap_two_m4.gif" border="0"></a><?}?></td>
	<td>&nbsp;</td>	   
  </tr>
</table>	
	
	</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>  
<?}?>


  <tr>
    <td >
<table width="692" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="a_sub_title2" background="../img/school_view_title_bg.gif" height="36" ><?=$data['title']?></td>
  </tr>
</table>
	</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="692">
<table width="692" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="692"><?=$data['content']?></td>
  </tr>
</table>	
	
	</td>
  </tr>

</table>


<? include("./sub_view_footer.php"); ?>
