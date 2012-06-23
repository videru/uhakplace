<?
	include_once("../include/lib.php");
	require_once("admin_chk.php");

   if($_mb[mb_level] < 99){

		rg_href("./","접근권한이 없습니다.");
	}


   // if ($year=="") {
	//	$year=date("Y");
	//}
//	if ($month=="") {
	//	$month=date("m");
//	}



    //total
	$rs_ch = new $rs_class($dbcon);
	$rs_ch->clear();
	$rs_ch->set_table($_table['regi']);

	//$rs_ch->add_where("chain = 1");		
	if ($year) { $rs_ch->add_where("abroad_date1 = $year");   }		
	if ($month) { $rs_ch->add_where("abroad_date2 = $month");   }		
   
	while($R=$rs_ch->fetch()) {
    $total_anum++;
	$total_aprice = $total_aprice + ($R[study_gigan] + $R[study_gigan2]); 
    }



    //뉴질랜드
	$rs_nat1 = new $rs_class($dbcon);
	$rs_nat1->clear();
	$rs_nat1->set_table($_table['regi']);
	$rs_nat1->add_where("national = 1 or national2 = 1");		
	if ($year) { $rs_nat1->add_where("abroad_date1 = $year");  }
	if ($month) { $rs_nat1->add_where("abroad_date2 = $month");  }		
   
	while($Rn1=$rs_nat1->fetch()) {
    $total_nnum1++;
	$total_nprice1 = $total_nprice1 + ($Rn1[study_gigan]+$Rn1[study_gigan2]); 
    }

    //호주
	$rs_nat2 = new $rs_class($dbcon);
	$rs_nat2->clear();
	$rs_nat2->set_table($_table['regi']);
	$rs_nat2->add_where("national = 2 or national2 = 2");		
	if ($year) { $rs_nat2->add_where("abroad_date1 = $year"); }  
	if ($month) { $rs_nat2->add_where("abroad_date2 = $month");   }			
   
	while($Rn2=$rs_nat2->fetch()) {
    $total_nnum2++;
	$total_nprice2 = $total_nprice2 +  ($Rn2[study_gigan]+$Rn2[study_gigan2]); 
    }

    //필리핀
	$rs_nat3 = new $rs_class($dbcon);
	$rs_nat3->clear();
	$rs_nat3->set_table($_table['regi']);
	$rs_nat3->add_where("national = 3");		
	if ($year) { $rs_nat3->add_where("abroad_date1 = $year");   }
	if ($month) { $rs_nat3->add_where("abroad_date2 = $month");  } 			
   
	while($Rn3=$rs_nat3->fetch()) {
    $total_nnum3++;
	$total_nprice3 = $total_nprice3 +  ($Rn3[study_gigan]+$Rn3[study_gigan]); 
    }

    //영국
	$rs_nat4 = new $rs_class($dbcon);
	$rs_nat4->clear();
	$rs_nat4->set_table($_table['regi']);
	$rs_nat4->add_where("national = 4 or national2 = 4");		
	if ($year) { $rs_nat4->add_where("abroad_date1 = $year");   }
	if ($month) { $rs_nat4->add_where("abroad_date2 = $month");  	 }		
   
	while($Rn4=$rs_nat4->fetch()) {
    $total_nnum4++;
	$total_nprice4 = $total_nprice4 +  ($Rn4[study_gigan]+$Rn4[study_gigan2]); 
    }

    //캐나다
	$rs_nat5 = new $rs_class($dbcon);
	$rs_nat5->clear();
	$rs_nat5->set_table($_table['regi']);
	$rs_nat5->add_where("national = 5 or national2 = 5");		
	if ($year) { $rs_nat5->add_where("abroad_date1 = $year");   }
	if ($month) { $rs_nat5->add_where("abroad_date2 = $month");  	 }		
   
	while($Rn5=$rs_nat4->fetch()) {
    $total_nnum5++;
	$total_nprice5 = $total_nprice4 +  ($Rn5[study_gigan]+$Rn5[study_gigan2]); 
    }





    //이종률
	$rs_mb1 = new $rs_class($dbcon);
	$rs_mb1->clear();
	$rs_mb1->set_table($_table['regi']);
	$rs_mb1->add_where("consult  = 2");		
	if ($year) { $rs_mb1->add_where("abroad_date1 = $year");   }		
	if ($month) { $rs_mb1->add_where("abroad_date2 = $month");  	 }				
   
	while($Rmb1=$rs_mb1->fetch()) {
    $total_mbum1++;
	$total_mbprice1 = $total_mbprice1 + ($Rmb1[study_gigan]+$Rmb1[study_gigan2]); 
    }

    //정현숙
	$rs_mb2 = new $rs_class($dbcon);
	$rs_mb2->clear();
	$rs_mb2->set_table($_table['regi']);
	$rs_mb2->add_where("consult  = 5");		
	if ($year) { $rs_mb2->add_where("abroad_date1 = $year");   }		
	if ($month) { $rs_mb2->add_where("abroad_date2 = $month");  	 }				
   
	while($Rmb2=$rs_mb2->fetch()) {
    $total_mbum2++;
	$total_mbprice2 = $total_mbprice2 + ($Rmb2[study_gigan]+$Rmb2[study_gigan2]); 
    }

 
    //엄경수
	$rs_mb3 = new $rs_class($dbcon);
	$rs_mb3->clear();
	$rs_mb3->set_table($_table['regi']);
	$rs_mb3->add_where("consult  = 4");		
	if ($year) { $rs_mb3->add_where("abroad_date1 = $year");   }		
	if ($month) { $rs_mb3->add_where("abroad_date2 = $month");  	 }				
   
	while($Rmb3=$rs_mb3->fetch()) {
    $total_mbum3++;
	$total_mbprice3 = $total_mbprice3 + ($Rmb3[study_gigan]+$Rmb3[study_gigan2]); 
    }


    //박선미
	$rs_mb4 = new $rs_class($dbcon);
	$rs_mb4->clear();
	$rs_mb4->set_table($_table['regi']);
	$rs_mb4->add_where("consult  = 51");		
	if ($year) { $rs_mb4->add_where("abroad_date1 = $year");   }		
	if ($month) { $rs_mb4->add_where("abroad_date2 = $month");  	 }				
   
	while($Rmb4=$rs_mb4->fetch()) {
    $total_mbum4++;
	$total_mbprice4 = $total_mbprice4 + ($Rmb4[study_gigan]+$Rmb4[study_gigan2]); 
    }

?>	
<? include("_header.php"); ?>
<? include("admin.header.php"); ?>
<table border="0" cellpadding="0" cellspacing="0" width="800" align="center">
  <tr height="40">
    <td background="images/title_bg.gif" style="padding:9pt 0pt 0pt 10pt" valign="top"><font color=#000000><b>수속통계</b></font></td>
  </tr>
</table>
<br>
<table border="0" cellpadding="0" cellspacing="0" width="800" align=center bgcolor="#FFFFFF">
    <tr>  
     <td>
  <table border="0" cellpadding="0" cellspacing="0" width="800" align=center>
	<tr>
		<td bgcolor="#666666" height="2"></td>
	</tr> 
	<tr>
		<td bgcolor="#FFFFFF" height="8"></td>
	</tr> 
  </table>
<table width="770" border="0" cellspacing="0" cellpadding="0" align="center">
 <form name="search_form" method="get" enctype="multipart/form-data">  
  <tr> 
    <td><img src="images/search_bg_top.gif" width="770" height="16"></td>
  </tr>
  <tr>
    <td background="images/search_bg_middle.gif" style="padding:0pt 0pt 0pt 15pt" class="tt4"> 등록일 
<select name="year" class="select">
<option value="">=전체=</option>
<?=rg_html_option($_const[year],$year)?>
		</select>년 <select name="month" class="select">
<option value="">=전체=</option>
<?=rg_html_option($_const[month],$month)?>
		</select>월
   <INPUT onfocus=this.blur() type=image src="images/bt_order_search.gif" align="absmiddle"></td>
  </tr>
  <tr> 
    <td background="images/search_bg_middle.gif" align="center"><img src=images/icon_line.gif border="0"></td>
  </tr>
  <tr> 
    <td><img src="images/search_bg_bottom.gif" width="770" height="16"></td>
  </tr>
  </form>
</table>
<br>
<table width="770" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr> 
    <td align="center" class="text15_b"><?=$year?>년 <?=$month?>월 등록 현황 - 총 등록학생: <?=$total_anum?>명(<?=$total_aprice?>주)</td>
  </tr>
</table>
<br>
<table width="770" border="0" cellpadding="0" cellspacing="0" align="center" >
  <tr>   
	<td ><img src="./images/nat_tit.gif"></td>  
  </tr>  
	<tr>
		<td bgcolor="#FFFFFF" height="12"></td>
	</tr> 
<tr>
    <td >
<table width="100%" border="0" cellpadding="0" cellspacing="0" >  
  <tr valign="bottom"> 
    <td width="20%" align="center" class="tt6" valign="bottom">
      <table width="122" border="0" cellpadding="0" cellspacing="0" align="center">        
		<tr height="6"> 
          <td ><img src="./images/gr_03.gif"></td>
          <td ></td>
        </tr>      
		<tr height="<?=$total_nprice1/2?>"> 
          <td background="./images/gr_02.gif" width="12" align="center" class="tt6"></td>
          <td width="110" align="center" class="tt5"><?=$total_nnum1?>명(<?=$total_nprice1?>주)</td>
        </tr>
        <tr height="6"> 
          <td ><img src="./images/gr_01.gif"></td>
          <td ></td>
        </tr>  
      </table>
	</td>
	<td width="20%" align="center" class="tt6" valign="bottom">
      <table width="122" border="0" cellpadding="0" cellspacing="0" align="center">
		<tr height="6"> 
          <td ><img src="./images/gr_03.gif"></td>
          <td ></td>
        </tr>           
		<tr height="<?=$total_nprice2/2?>"> 
          <td background="./images/gr_02.gif" width="12" align="center" class="tt6"></td>
          <td width="110" align="center" class="tt5"><?=$total_nnum2?>명(<?=$total_nprice2?>주)</td>
        </tr>
        <tr height="6"> 
          <td ><img src="./images/gr_01.gif"></td>
          <td ></td>
        </tr> 
      </table>
	</td>
	<td width="20%" align="center" class="tt6" valign="bottom">
      <table width="122" border="0" cellpadding="0" cellspacing="0" align="center">
		<tr height="6"> 
          <td ><img src="./images/gr_03.gif"></td>
          <td ></td>
        </tr>           
		<tr height="<?=$total_nprice3/2?>"> 
          <td background="./images/gr_02.gif" width="12" align="center" class="tt6"></td>
          <td width="110" align="center" class="tt5"><?=$total_nnum3?>명(<?=$total_nprice3?>주)</td>
        </tr>
        <tr height="6"> 
          <td ><img src="./images/gr_01.gif"></td>
          <td ></td>
        </tr> 
      </table>
	</td>
	<td width="20%" align="center" class="tt6" valign="bottom">
      <table width="122" border="0" cellpadding="0" cellspacing="0" align="center">
		<tr height="6"> 
          <td ><img src="./images/gr_03.gif"></td>
          <td ></td>
        </tr>           
		<tr height="<?=$total_nprice4/2?>"> 
          <td background="./images/gr_02.gif" width="12" align="center" class="tt6"></td>
          <td width="110" align="center" class="tt5"><?=$total_nnum4?>명(<?=$total_nprice4?>주)</td>
        </tr>
        <tr height="6"> 
          <td ><img src="./images/gr_01.gif"></td>
          <td ></td>
        </tr> 
      </table>
	</td>
	<td width="20%" align="center" class="tt6" valign="bottom">
      <table width="122" border="0" cellpadding="0" cellspacing="0" align="center">
		<tr height="6"> 
          <td ><img src="./images/gr_03.gif"></td>
          <td ></td>
        </tr>           
		<tr height="<?=$total_nprice5/2?>"> 
          <td background="./images/gr_02.gif" width="12" align="center" class="tt6"></td>
          <td width="110" align="center" class="tt5"><?=$total_nnum5?>명(<?=$total_nprice5?>주)</td>
        </tr>
        <tr height="6"> 
          <td ><img src="./images/gr_01.gif"></td>
          <td ></td>
        </tr> 
      </table>
	</td>
  </tr>
  <tr bgcolor="#456285" width="300" valign="bottom"> 
    <td width="20%" align="center" class="tt6" valign="bottom">뉴질랜드</td>
	<td width="20%" align="center" class="tt6" valign="bottom">호주</td>
	<td width="20%" align="center" class="tt6" valign="bottom">필리핀</td>
	<td width="20%" align="center" class="tt6" valign="bottom">영국</td>
	<td width="20%" align="center" class="tt6" valign="bottom">캐나다</td>
  </tr>
  <tr>   
	<td height="20"></td>  
  </tr>  
</table>

	</td>
  </tr> 
</table>

<br>
<br>
<table width="770" border="0" cellpadding="0" cellspacing="0" align="center" >
  <tr>   
	<td width="370"><img src="./images/con_tit.gif"></td>  
  </tr>  
	<tr>
		<td bgcolor="#FFFFFF" height="12"></td>
	</tr> 
<tr>
    <td >
<table width="100%" border="0" cellpadding="0" cellspacing="0" >  
  <tr valign="bottom"> 
    <td width="20%" align="center" class="tt6" valign="bottom">
      <table width="122" border="0" cellpadding="0" cellspacing="0" align="center">        
		<tr height="6"> 
          <td ><img src="./images/gr_03.gif"></td>
          <td ></td>
        </tr>      
		<tr height="<?=$total_mbprice1/2?>"> 
          <td background="./images/gr_02.gif" width="12" align="center" class="tt6"></td>
          <td width="110" align="center" class="tt5"><?=$total_mbum1?>명(<?=$total_mbprice1?>주)</td>
        </tr>
        <tr height="6"> 
          <td ><img src="./images/gr_01.gif"></td>
          <td ></td>
        </tr>  
      </table>
	</td>
	<td width="20%" align="center" class="tt6" valign="bottom">
      <table width="122" border="0" cellpadding="0" cellspacing="0" align="center">
		<tr height="6"> 
          <td ><img src="./images/gr_03.gif"></td>
          <td ></td>
        </tr>           
		<tr height="<?=$total_mbprice2/2?>"> 
          <td background="./images/gr_02.gif" width="12" align="center" class="tt6"></td>
          <td width="110" align="center" class="tt5"><?=$total_mbum2?>명(<?=$total_mbprice2?>주)</td>
        </tr>
        <tr height="6"> 
          <td ><img src="./images/gr_01.gif"></td>
          <td ></td>
        </tr> 
      </table>
	</td>
	<td width="20%" align="center" class="tt6" valign="bottom">
      <table width="122" border="0" cellpadding="0" cellspacing="0" align="center">
		<tr height="6"> 
          <td ><img src="./images/gr_03.gif"></td>
          <td ></td>
        </tr>           
		<tr height="<?=$total_mbprice3/2?>"> 
          <td background="./images/gr_02.gif" width="12" align="center" class="tt6"></td>
          <td width="110" align="center" class="tt5"><?=$total_mbum3?>명(<?=$total_mbprice3?>주)</td>
        </tr>
        <tr height="6"> 
          <td ><img src="./images/gr_01.gif"></td>
          <td ></td>
        </tr> 
      </table>
	</td>
	<td width="20%" align="center" class="tt6" valign="bottom">
      <table width="122" border="0" cellpadding="0" cellspacing="0" align="center">
		<tr height="6"> 
          <td ><img src="./images/gr_03.gif"></td>
          <td ></td>
        </tr>           
		<tr height="<?=$total_mbprice4/2?>"> 
          <td background="./images/gr_02.gif" width="12" align="center" class="tt6"></td>
          <td width="110" align="center" class="tt5"><?=$total_mbum4?>명(<?=$total_mbprice4?>주)</td>
        </tr>
        <tr height="6"> 
          <td ><img src="./images/gr_01.gif"></td>
          <td ></td>
        </tr> 
      </table>
	</td>
	<td width="20%" align="center" class="tt6" valign="bottom">
      <table width="122" border="0" cellpadding="0" cellspacing="0" align="center">
		<tr height="6"> 
          <td ><img src="./images/gr_03.gif"></td>
          <td ></td>
        </tr>           
		<tr > 
          <td background="./images/gr_02.gif" width="12" align="center" class="tt6"></td>
          <td width="110" align="center" class="tt5"></td>
        </tr>
        <tr height="6"> 
          <td ><img src="./images/gr_01.gif"></td>
          <td ></td>
        </tr> 
      </table>
	</td>
  </tr>
  <tr bgcolor="#456285" width="300" valign="bottom"> 
    <td width="20%" align="center" class="tt6" valign="bottom">이종률</td>
	<td width="20%" align="center" class="tt6" valign="bottom">정현숙</td>
	<td width="20%" align="center" class="tt6" valign="bottom">엄경수</td>
	<td width="20%" align="center" class="tt6" valign="bottom">박선미</td>
	<td width="20%" align="center" class="tt6" valign="bottom">&nbsp;</td>
  </tr>
  <tr>   
	<td height="20"></td>  
  </tr>  
</table>

	</td>
  </tr> 
</table>

<table border="0" cellpadding="0" cellspacing="0" width="800" align=center>
	<tr>
		<td bgcolor="#FFFFFF" height="8"></td>
	</tr> 	
	<tr>
		<td bgcolor="#666666" height="2"></td>
	</tr> 
  </table>

  </td>
  </tr>
</table>
<? include("admin.footer.php"); ?>
<? include("_footer.php"); ?>