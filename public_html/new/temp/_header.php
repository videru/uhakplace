<? if (!defined('RGBOARD_VERSION')) exit; ?>
<?
if(file_exists($skin_path."style.php")) include($skin_path."style.php");

//include('../inc/header.php'); 



?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link href="<?=$_url['css']?>style.css" rel="stylesheet" type="text/css">
<script src="<?=$_url['js']?>common.js"></script>
<script src="<?=$_url['js']?>lib.validate.js"></script>
<script src="<?=$_url['js']?>flash.js"></script>
</head>
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

 //   if($bbs_code=="mtm"){
//	$rr_bbs_name[bbs_name] = "1대1 맞춤컨설팅";
//	}elseif($bbs_code=="online"){
//	$rr_bbs_name[bbs_name] = "온라인신청";

//	}else{
//	$rr_bbs_name[bbs_name] = $rr_bbs_name[bbs_name];
//	}

?>
<?
if($_group_info['gr_id']=="main"){
?>


<table width="692" border="0" cellspacing="0" cellpadding="0"  align="center">
  
   <tr>
      <td>&nbsp;</td>
   </tr>   
   <tr>
      <td >




<?}?>