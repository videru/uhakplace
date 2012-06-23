<? if (!defined('RGBOARD_VERSION')) exit; ?>
<?
if(file_exists($skin_path."style.php")) include($skin_path."style.php");


if($_group_info['gr_id']=="junior"){
include('../junior/sub_header.php'); 
}else{
include('../inc/header.php'); 

}

?>

<?
	if(file_exists($_group_info['gr_header_file'])) include($_group_info['gr_header_file']);
	if(file_exists($_bbs_info['header_file'])) include($_bbs_info['header_file']);
	echo $_bbs_info['header_tag'];

	if(file_exists($skin_path."header.php")) include($skin_path."header.php");

	$rr_bbs = new $rs_class($dbcon);
    $rr_bbs->clear();
	$rr_bbs->set_table($_table['bbs_cfg']);
	$rr_bbs->add_where("bbs_code = '$bbs_code'");
	$rr_bbs->select();
	$rr_bbs_name=$rr_bbs->fetch();	

    if($bbs_code=="mtm"){
	$rr_bbs_name[bbs_name] = "1대1 맞춤컨설팅";
	}elseif($bbs_code=="online"){
	$rr_bbs_name[bbs_name] = "온라인신청";

	}else{
	$rr_bbs_name[bbs_name] = $rr_bbs_name[bbs_name];
	}

?>
<?
if($_group_info['gr_id']=="main"){
?>


<table width="692" border="0" cellspacing="0" cellpadding="0"  align="center">
   <tr>
      <td>
	    <table width="692" border="0" cellspacing="0" cellpadding="0" >
<?if($bbs_code=="qna" || $bbs_code=="notice" || $bbs_code=="mtm"  || $bbs_code=="online"  || $bbs_code=="partner"){?>
          <tr>
           <td width="95"><?if($bbs_code=="qna"){?><img src="../img/tap_bo_m5on.gif"><?}else{?><a href="../board/list.php?&bbs_code=qna"><img src="../img/tap_bo_m5.gif" border="0"></a><?}?></td>    
	       <td>&nbsp;</td>	   
		   <td width="95"><?if($bbs_code=="notice"){?><img src="../img/tap_bo_m1on.gif"><?}else{?><a href="../board/list.php?&bbs_code=notice"><img src="../img/tap_bo_m1.gif" border="0"></a><?}?></td>
           <td>&nbsp;</td>
           <td width="95"><?if($bbs_code=="online"){?><img src="../img/tap_bo_m18on.gif"><?}else{?><a href="../board/online.php"><img src="../img/tap_bo_m18.gif" border="0"></a><?}?></td>
           <td>&nbsp;</td>
           <td width="95"><?if($bbs_code=="mtm"){?><img src="../img/tap_bo_m19on.gif"><?}else{?><a href="../board/mtm.php"><img src="../img/tap_bo_m19.gif" border="0"></a><?}?></td>
           <td>&nbsp;</td>
           <td width="95"><?if($bbs_code=="partner"){?><img src="../img/tap_bo_m22on.gif"><?}else{?><a href="../board/list.php?&bbs_code=partner"><img src="../img/tap_bo_m22.gif" border="0"></a><?}?></td>
           <td>&nbsp;</td>
           <td width="95">&nbsp;</td>
           <td>&nbsp;</td>
           <td width="95">&nbsp;</td>
          </tr>
<?}else{?>
          <tr>
           <td width="95"><?if($bbs_code=="news"){?><img src="../img/tap_bo_m2on.gif"><?}else{?><a href="../board/list.php?&bbs_code=news"><img src="../img/tap_bo_m2.gif" border="0"></a><?}?></td>
           <td>&nbsp;</td>
           <td width="95"><?if($bbs_code=="sc_notice"){?><img src="../img/tap_bo_m4on.gif"><?}else{?><a href="../board/list.php?&bbs_code=sc_notice"><img src="../img/tap_bo_m4.gif" border="0"></a><?}?></td>
           <td>&nbsp;</td>
           <td width="95"><?if($bbs_code=="photo"){?><img src="../img/tap_bo_m6on.gif"><?}else{?><a href="../board/list.php?&bbs_code=photo"><img src="../img/tap_bo_m6.gif" border="0"></a><?}?></td>
           <td>&nbsp;</td>
           <td width="95"><?if($bbs_code=="info"){?><img src="../img/tap_bo_m7on.gif"><?}else{?><a href="../board/list.php?&bbs_code=info"><img src="../img/tap_bo_m7.gif" border="0"></a><?}?></td>
           <td>&nbsp;</td>
           <td width="95"><?if($bbs_code=="yensu"){?><img src="../img/tap_bo_m8on.gif"><?}else{?><a href="../board/list.php?&bbs_code=yensu"><img src="../img/tap_bo_m8.gif" border="0"></a><?}?></td>
           <td>&nbsp;</td>
           <td width="95"><?if($bbs_code=="colum"){?><img src="../img/tap_bo_m9on.gif"><?}else{?><a href="../board/list.php?&bbs_code=colum"><img src="../img/tap_bo_m9.gif" border="0"></a><?}?></td>
           <td>&nbsp;</td>
           <td width="95"><?if($bbs_code=="interview"){?><img src="../img/tap_bo_m10on.gif"><?}else{?><a href="../board/list.php?&bbs_code=interview"><img src="../img/tap_bo_m10.gif" border="0"></a><?}?></td>
          </tr>
<?}?>
        </table>
	 </td>
   </tr>   
   <tr>
      <td>&nbsp;</td>
   </tr>   
   <tr>
      <td >

<table width="692" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="a_sub_title2" background="../img/school_view_title_bg.gif" height="36" >◎ <?=$rr_bbs_name[bbs_name]?></td>
  </tr>
</table>	
	




<?}?>