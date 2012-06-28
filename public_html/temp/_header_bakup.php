<? if (!defined('RGBOARD_VERSION')) exit; ?>
<script src="<?=$_url['js']?>common.js"></script>
<script src="<?=$_url['js']?>lib.validate.js"></script>
<script src="<?=$_url['js']?>flash.js"></script>
<?
	if(file_exists($skin_path."style.php")) include($skin_path."style.php");
?>
<? include('../inc/header.php'); ?>
<?
	if(file_exists($_group_info['gr_header_file'])) include($_group_info['gr_header_file']);
	if(file_exists($_bbs_info['header_file'])) include($_bbs_info['header_file']);
	echo $_bbs_info['header_tag'];

	if(file_exists($skin_path."header.php")) include($skin_path."header.php");

/*
	$rr_bbs = new $rs_class($dbcon);
    $rr_bbs->clear();
	$rr_bbs->set_table($_table['bbs_cfg']);
	$rr_bbs->add_where("bbs_code = '$bbs_code'");


		$rr_bbs->select();
		$rr_bbs_name=$rr_bbs->fetch();		

*/
?>

<script type="text/javascript">
<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
<style type="text/css">
<!--
.style1 {
	color: #FF3300;
	font-weight: bold;
}
-->
</style>

<body onLoad="MM_preloadImages('img/main_phi_sch2-1.gif','img/main_phi_sch4-1.gif','img/main_phi_sch5-1.gif','img/main_phi_sch6-1.gif','img/main_phi_sch7-1.gif','img/main_phi_sch8-1.gif','img/main_phi_sch9-1.gif','img/main_phi_sch10-1.gif','img/main_phi_sch11-1.gif','img/main_phi_sch12-1.gif','../img/main_phi_sch1-1.gif','../img/main_phi_sch2-1.gif','../img/main_phi_sch4-1.gif','../img/main_phi_sch5-1.gif','../img/main_phi_sch6-1.gif','../img/main_phi_sch7-1.gif','../img/main_phi_sch8-1.gif','../img/main_phi_sch9-1.gif','../img/main_phi_sch10-1.gif','../img/main_phi_sch11-1.gif','../img/main_phi_sch12-1.gif')">

<table width="954" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td width="160" valign="top">
     <table width="160" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><img src="../img/main_to_le_m1.gif" width="160" height="52" /></td>
      </tr>
      <tr>
        <td height="5"></td>
      </tr>
      <tr>
        <td><img src="../img/main_to_le_m2.gif" width="160" height="52" /></td>
      </tr>
      <tr>
        <td height="5"></td>
      </tr>
      <tr>
        <td><img src="../img/main_to_le_m3.gif" width="160" height="52" /></td>
      </tr>
      <tr>
        <td height="12"></td>
      </tr>
      <tr>
        <td><table width="160" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><img src="../img/left_sch_title.gif" width="160" height="46" /></td>
          </tr>
          <tr>
            <td align="center" background="../img/left_sch_bg.gif"><table width="130" border="0" cellspacing="0" cellpadding="0">
         <?
	$rs_bbs = new $rs_class($dbcon);
	$rs_group = new $rs_class($dbcon);
	$rs_group->clear();
	$rs_group->set_table($_table['group']);
	$rs_group->add_where("gr_state=1");
	$rs_group->add_order("gr_num");
	while($g_info=$rs_group->fetch()) {
		$rs_bbs->clear();
		$rs_bbs->set_table($_table['bbs_cfg']);
		$rs_bbs->add_where("gr_num={$g_info['gr_num']}");
		$rs_bbs->add_order("bbs_num");


		while($bbs_info=$rs_bbs->fetch()) {

?>				
				
				
				<tr>
                  <td class="a_text_title" ><a href="../board/list.php?bbs_code=<?=$bbs_info['bbs_code']?>">¡¤ <?=$bbs_info['bbs_name']?></a></td>
                </tr>
                <tr>
                  <td height="1" bgcolor="#e6e6e6"></td>
                </tr>
                <tr>
                  <td height="8"></td>
                </tr>
  <?}}?>
            </table></td>
          </tr>
          <tr>
            <td><img src="../img/left_sch_bottom.gif" width="160" height="14" /></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><img src="../img/main_le_cost.gif" width="160" height="90"></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><img src="../img/main_left_rela.gif" width="160" height="140"></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><img src="../img/main_msn.gif" width="160" height="254"></td>
          </tr>

        </table></td>
      </tr>
     </table>
    </td>
    <td width="12">&nbsp;</td>
    <td width="520" valign="top">
     <table width="520" border="0" cellspacing="0" cellpadding="0" >
      <tr>
        <td><script>m_menu("../fla/main_fla.swf","520","166")</script></td>
        </tr>
      <tr>
        <td height="12"></td>
        </tr>
      <tr>
        <td>
	     <table width="520" border="0" cellspacing="2" cellpadding="2" bgcolor="#ffa803">
          <tr>
            <td height="35" class="a_sub_title2"  bgcolor="#FFFFFF">¡Ý <?=$rr_bbs_name[bbs_name]?></td>
          </tr>
	     </table >
		 </td>
		 </tr>
      <tr>
        <td height="12"></td>
        </tr>
      <tr>
        <td>