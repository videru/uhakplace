<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<?
	include_once("../include/lib.php");

	
	$national = $_GET['national'];
	$state = $_GET['state'];
	$area = $_GET['area'];
	
    $rs_list = new $rs_class($dbcon);
	$rs_list->clear();
	$rs_list->set_table($_table['school']);
	if($national==3){
   	$rs_list->add_where("national = 3");
    }else{
   	$rs_list->add_where("national = $national" );
    } 

	
	if($national==3 and $te !="20"){

	$rs_list->add_where("sc_type LIKE '%$te%' escape '".$dbcon->escape_ch."'");
    }  

	if($area){

   	$rs_list->add_where("area = $area");
    }  

     $rs_list->add_order("best DESC, num DESC");	

     $page_info=$rs_list->select_list($page,10,10);

?>	
 
<body onLoad="MM_preloadImages('img/main_phi_sch2-1.gif','img/main_phi_sch4-1.gif','img/main_phi_sch5-1.gif','img/main_phi_sch6-1.gif','img/main_phi_sch7-1.gif','img/main_phi_sch8-1.gif','img/main_phi_sch9-1.gif','img/main_phi_sch10-1.gif','img/main_phi_sch11-1.gif','img/main_phi_sch12-1.gif','../img/main_phi_sch1-1.gif','../img/main_phi_sch2-1.gif','../img/main_phi_sch4-1.gif','../img/main_phi_sch5-1.gif','../img/main_phi_sch6-1.gif','../img/main_phi_sch7-1.gif','../img/main_phi_sch8-1.gif','../img/main_phi_sch9-1.gif','../img/main_phi_sch10-1.gif','../img/main_phi_sch11-1.gif','../img/main_phi_sch12-1.gif')">
 

<div><? include_once('../temp/top.php'); ?></div>
<div style="height:52px"></div>
<table width="980" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="223" valign="top"><embed src="../n_img/left_04.swf" width="223" height="400"></embed></td>
    <td width="37">&nbsp;</td>
    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td>
<? include("../phil/sub_header_new.php"); ?>

<table width="520" border="0" cellpadding="0" cellspacing="0" align="center">
  <?if($national==3){?>
   <tr> 
	<td colspan="3" >
     <table width="520" border="0" cellpadding="0" cellspacing="0" >
	  <?if($te){?>
	  <tr> 
	   <td width="75"><?if($te==20){?><img src="../img/s_tap_lo_0on.gif"><?}else{?><a href="school_list_new.php?national=3&te=20"><img src="../img/s_tap_lo_0.gif" border="0"></a><?}?></td>
	   <td width="4">&nbsp;</td>	
	   <td width="75"><?if($te==1){?><img src="../img/s_tap_te_1on.gif"><?}else{?><a href="school_list_new.php?national=3&te=01"><img src="../img/s_tap_te_1.gif" border="0"></a><?}?></td>
	   <td width="4">&nbsp;</td>
	   <td width="75"><?if($te==2){?><img src="../img/s_tap_te_2on.gif"><?}else{?><a href="school_list_new.php?national=3&te=02"><img src="../img/s_tap_te_2.gif" border="0"></a><?}?></td>
	   <td width="4">&nbsp;</td>	
	   <td width="75"><?if($te==3){?><img src="../img/s_tap_te_3on.gif"><?}else{?><a href="school_list_new.php?national=3&te=03"><img src="../img/s_tap_te_3.gif" border="0"></a><?}?></td>
	   <td width="4">&nbsp;</td>
	   <td width="75"><?if($te==4){?><img src="../img/s_tap_te_4on.gif"><?}else{?><a href="school_list_new.php?national=3&te=04"><img src="../img/s_tap_te_4.gif" border="0"></a><?}?></td>
	   <td width="4">&nbsp;</td>	
	   <td width="75"><?if($te==5){?><img src="../img/s_tap_te_5on.gif"><?}else{?><a href="school_list_new.php?national=3&te=05"><img src="../img/s_tap_te_5.gif" border="0"></a><?}?></td>
	   <td width="4">&nbsp;</td>	
	   <td width="75"><?if($te==6){?><img src="../img/s_tap_te_6on.gif"><?}else{?><a href="school_list_new.php?national=3&te=06"><img src="../img/s_tap_te_6.gif" border="0"></a><?}?></td>
	   </tr>
      <tr> 
	    <td colspan="13" height="4" ></td>
      </tr>
	  <tr> 
	   <td width="75"><?if($te==7){?><img src="../img/s_tap_te_7on.gif"><?}else{?><a href="school_list_new.php?national=3&te=07"><img src="../img/s_tap_te_7.gif" border="0"></a><?}?></td>
	   <td width="4">&nbsp;</td>	
	   <td width="75"><?if($te==8){?><img src="../img/s_tap_te_8on.gif"><?}else{?><a href="school_list_new.php?national=3&te=08"><img src="../img/s_tap_te_8.gif" border="0"></a><?}?></td>
	   <td width="4">&nbsp;</td>
	   <td width="75"><?if($te==9){?><img src="../img/s_tap_te_9on.gif"><?}else{?><a href="school_list_  new.php?national=3&te=09"><img src="../img/s_tap_te_9.gif" border="0"></a><?}?></td>
	   <td width="4">&nbsp;</td>	
	   <td width="75"><?if($te==10){?><img src="../img/s_tap_te_10on.gif"><?}else{?><a href="school_list_new.php?national=3&te=10"><img src="../img/s_tap_te_10.gif" border="0"></a><?}?></td>
	   <td width="4">&nbsp;</td>
	   <td width="75"><?if($te==11){?><img src="../img/s_tap_te_11on.gif"><?}else{?><a href="school_list_new.php?national=3&te=11"><img src="../img/s_tap_te_11.gif" border="0"></a><?}?></td>
	   <td width="4">&nbsp;</td>	
	   <td width="75"><?if($te==12){?><img src="../img/s_tap_te_12on.gif"><?}else{?><a href="school_list_new.php?national=3&te=12"><img src="../img/s_tap_te_12.gif" border="0"></a><?}?></td>
	   <td width="4">&nbsp;</td>	
	   <td width="75">&nbsp;</td>
	   </tr>
      <?}else{?>
	  <tr> 
	   <td width="75"><?if(!$area){?><img src="../img/s_tap_lo_0on.gif"><?}else{?><a href="school_list_new.php?&national=3"><img src="../img/s_tap_lo_0.gif" border="0"></a><?}?></td>
	   <td width="4">&nbsp;</td>	
	   <td width="75"><?if($area==1){?><img src="../img/s_tap_lo_1on.gif"><?}else{?><a href="school_list_new.php?&national=3&area=1"><img src="../img/s_tap_lo_1.gif" border="0"></a><?}?></td>
	   <td width="4">&nbsp;</td>
	   <td width="75"><?if($area==2){?><img src="../img/s_tap_lo_2on.gif"><?}else{?><a href="school_list_new.php?&national=3&area=2"><img src="../img/s_tap_lo_2.gif" border="0"></a><?}?></td>
	   <td width="4">&nbsp;</td>	
	   <td width="75"><?if($area==3){?><img src="../img/s_tap_lo_3on.gif"><?}else{?><a href="school_list_new.php?&national=3&area=3"><img src="../img/s_tap_lo_3.gif" border="0"></a><?}?></td>
	   <td width="4">&nbsp;</td>
	   <td width="75"><?if($area==4){?><img src="../img/s_tap_lo_4on.gif"><?}else{?><a href="school_list_new.php?&national=3&area=4"><img src="../img/s_tap_lo_4.gif" border="0"></a><?}?></td>
	   <td width="4">&nbsp;</td>	
	   <td width="75"><?if($area==5){?><img src="../img/s_tap_lo_5on.gif"><?}else{?><a href="school_list_new.php?&national=3&area=5"><img src="../img/s_tap_lo_5.gif" border="0"></a><?}?></td>
	   <td width="4">&nbsp;</td>	
	   <td width="75"><?if($area==6){?><img src="../img/s_tap_lo_6on.gif"><?}else{?><a href="school_list_new.php?&national=3&area=6"><img src="../img/s_tap_lo_6.gif" border="0"></a><?}?></td>
	   </tr>
	   <?}?>
	   </table>
	</td>
  </tr>  
  <tr> 
	<td colspan="3" height="20" ></td>
  </tr>
  <?}?>
<?

 $rs_list->set_table($_table['school']);
		
	$no = $page_info['start_no'];
	while($R=$rs_list->fetch()) {
		$no--; 
?>
  <tr> 
	<td width="182" height="52" background="../img/school_logo_bg.gif" style="padding: 1 1 1 1"><?if($R[school_file1_name]){?><img src="../data/school/<?=$R[num]?>/<?=$R[school_file1_name]?>" width="180" height="80" align="absmiddle"><?}?></td>
	<td width="25" >&nbsp;</td>
	<td width="313" valign="top">
      <table width="313" border="0" cellpadding="0" cellspacing="0" align="center">   
		<tr>
		  <td colspan="3" height="2" bgcolor="#faca7d"></td>
		</tr>	    
		<tr>
		  <td align="center" width="80" bgcolor="#fff0d9"><font color="#ff8a00"><strong>학교이름<strong></font></td>
		  <td style="padding: 5px 5px 5px 5px"><?=$R[s_title]?></td>
		  <td align="right"><a href="./school_view_new.php?num=<?=$R[num]?>&national=<?=$R[national]?>"><img src="../img/btn_more_bl.gif" align="absmiddle" border="0"></a></td>
		</tr>
	    <tr>
		  <td colspan="3" height="1" bgcolor="#faca7d"></td>
		</tr>	 
		<?if($national==3){?>
	    <tr>
		  <td align="center" bgcolor="#fff0d9"><font color="#ff8a00"><strong>지역<strong></font></td>
		  <td colspan="2" style="padding: 5px 5px 5px 5px"><?=$_const['area3'][$R['area']]?></td>
		</tr>
	    <tr>
		  <td colspan="3" height="1" bgcolor="#faca7d"></td>
		</tr>	   
	    <tr>
		  <td align="center" bgcolor="#fff0d9"><font color="#ff8a00"><strong>설립연도<strong></font></td>
		  <td colspan="2" style="padding: 5px 5px 5px 5px"><?=$R['open_date']?></td>
		</tr>
        <?}else{?>
	    <tr>
		  <td align="center" bgcolor="#fff0d9"><font color="#ff8a00"><strong>지역<strong></font></td>
		  <td colspan="2" style="padding: 5px 5px 5px 5px"><?=$data['location']?></td>
		</tr>
	    <tr>
		  <td colspan="3" height="1" bgcolor="#faca7d"></td>
		</tr>	   
	    <tr>
		  <td align="center" bgcolor="#fff0d9"><font color="#ff8a00"><strong>설립연도<strong></font></td>
		  <td colspan="2" style="padding: 5px 5px 5px 5px"><?=$R['homepage']?></td>
		</tr>
		<?}?>
	    <tr>
		  <td colspan="3" height="2" bgcolor="#faca7d"></td>
		</tr>	   
      </table>


	</td>
  </tr>
  <tr> 
	<td colspan="3" height="20" ></td>
  </tr>
<?
}
?>
</table>
<br>
<table width="520"  align="center">
	<tr>
		<td align="center">
      <?=rg_navi_display($page_info,"&national={$national}&te={$te}&area={$area}"); ?>
		</td>
	</tr>
</table>
<? include("../phil/sub_footer_new.php"); ?>
</td>
      </tr> 
      
    </table></td>
  </tr>
</table>
<div><? include_once('../temp/footer.php'); ?></div>
</body>