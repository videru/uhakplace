<?
	include_once("../include/lib.php");

    $rs_list = new $rs_class($dbcon);
	$rs_list->clear();
	$rs_list->set_table($_table['young']);
	if($national==""){
      $national = 3;
   }else{
       $national = $national;
    }  
	$rs_list->add_where("national = $national");

	 /***********************************************************************/
   // 필터 조건에 의한 필터링
   if($section){
	$rs_list->add_where("section = $section");   
   }else{
	$rs_list->add_where("section != 1");
   }

	// 검색어로 검색
	if($kw) { $rs_list->add_where("title LIKE '%$kw%' escape '".$dbcon->escape_ch."'");} 

	switch ($ot) {
		case 10 : $rs_list->add_order("num DESC");		break;
		default : $rs_list->add_order("area ASC");		break;
	}
		$page_info=$rs_list->select_list($page,10,10);


if (ereg(",",$data[sc_type])) {
	   // echo ",있다.";
		$str_categoryS = explode(",",$data[sc_type]);
	//	echo sizeof($str_categoryS)."<-- str_categoryS<Br>";

		for ($i=0;$i<sizeof($str_categoryS)-1;$i++) {
			//echo $str_categoryS[$i]."<--<br>";
			
			switch ($str_categoryS[$i])  {
				   case('01') : $checked1 ="1";break;
				   case('02') : $checked2 ="2";break;
				   case('03') : $checked3 ="3";break;
				   case('04') : $checked4 ="4";break;
				   case('05') : $checked5 ="5";break;
				   case('06') : $checked6 ="6";break;
				   case('07') : $checked7 ="7";break;
				   case('08') : $checked8 ="8";break;
				   case('09') : $checked9 ="9";break;
				   case('10') : $checked10="10";break;
				   case('11') : $checked11="11";break;
				   case('12') : $checked12="12";break;
			}
		}
	}else{
	   // echo ",없다.";
			switch ($data[sc_type])  {
				   case('01') : $checked1 ="checked";break;
				   case('02') : $checked2 ="checked";break;
				   case('03') : $checked3 ="checked";break;
				   case('04') : $checked4 ="checked";break;
				   case('05') : $checked5 ="checked";break;
				   case('06') : $checked6 ="checked";break;
				   case('07') : $checked7 ="checked";break;
				   case('08') : $checked8 ="checked";break;
				   case('09') : $checked9 ="checked";break;
				   case('10') : $checked10="checked";break;
				   case('11') : $checked11="checked";break;
				   case('12') : $checked12="checked";break;
			}
	}


	if ($national=="1") {
     $_const['area'] = $_const['area1']; // 뉴질랜드지역
    }elseif($national=="2") {
     $_const['area']= $_const['area2']; // 호주지역
	}elseif($national=="3") {
     $_const['area']= $_const['area3']; //필리핀지역
    }elseif($national=="4") {
    $_const['area']= $_const['area4']; // 영국지역
    }
?>	

<? include("./sub_header.php"); ?>

<table width="520" border="0" cellpadding="0" cellspacing="0" align="center">
<?

 $rs_list->set_table($_table['young']);
		
	$no = $page_info['start_no'];
	while($R=$rs_list->fetch()) {
		$no--; 
?>
  <tr> 
	<td width="182" height="52" background="../img/school_logo_bg.gif" style="padding: 1 1 1 1"><?if($R[school_file1_name]){?><img src="../data/young/<?=$R[num]?>/<?=$R[school_file1_name]?>" width="180" height="80" align="absmiddle"><?}?></td>
	<td width="25" >&nbsp;</td>
	<td width="313" valign="top">
      <table width="313" border="0" cellpadding="0" cellspacing="0" align="center">   
		<tr>
		  <td colspan="3" height="2" bgcolor="#faca7d"></td>
		</tr>	    
		<tr>
		  <td align="center" width="80" bgcolor="#fff0d9"><font color="#ff8a00"><strong>학교이름<strong></font></td>
		  <td style="padding: 5px 5px 5px 5px"><?=$R[s_title]?></td>
		</tr>
	    <tr>
		  <td colspan="3" height="1" bgcolor="#faca7d"></td>
		</tr>	 

	    <tr>
		  <td align="center" bgcolor="#fff0d9"><font color="#ff8a00"><strong>지역<strong></font></td>
		  <td colspan="2" style="padding: 5px 5px 5px 5px"><?=$_const['area'][$R['area']]?></td>
		</tr>
	    <tr>
		  <td colspan="3" height="1" bgcolor="#faca7d"></td>
		</tr>	   


	    <tr>
		  <td align="center" bgcolor="#fff0d9"><font color="#ff8a00"><strong>홈페이지<strong></font></td>
		  <td colspan="2" style="padding: 5px 5px 5px 5px"><?=$R['homepage']?></td>
		</tr>

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
      <?=rg_navi_display($page_info,$_get_param[2]); ?>
		</td>
	</tr>
</table>
<? include("./sub_footer.php"); ?>