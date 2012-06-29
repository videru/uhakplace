<?
	include_once("../include/lib.php");
	require_once("admin_chk.php");

    if ($year=="") {
		$year=date("Y");
	}
	if ($month=="") {
		$month=date("m");
	}

    //total
	$rs_ch = new $rs_class($dbcon);
	$rs_ch->clear();
	$rs_ch->set_table($_table['regi']);
//	$rs_ch->add_where("chain = 1");		
	$rs_ch->add_where("abroad_date1 = $year");  
	$rs_ch->add_where("abroad_date2 = $month");  
   
	while($R=$rs_ch->fetch()) {
    $total_num++;
	$total_price = $total_price + ($R[study_gigan] + $R[study_gigan2]);     
	}

	$stu_no=$R[regi_no];	

	//당월수익
	$rs_in = new $rs_class($dbcon);
	$rs_in->clear();
	$rs_in->set_table($_table['regi_account']);
//	$rs_in->add_where("chain = 1");		
   
    $ip_ymd = explode("-",$Rin[iphak_date]);
    $ip_y = $ip_ymd[0];
    $ip_m = $ip_ymd[1];
    $ip_d = $ip_ymd[2];

	if($ip_y = $year and $ip_m = $month){
	while($Rin=$rs_in->fetch()) {
	$total_iphak = $total_iphak + $Rin[iphak]; 	
    $total_incom = $total_incom + ($Rin[comm] - $Rin[sale] - $Rin[comm_share1] - $Rin[comm_share2] + $Rin[air_comm] + $Rin[insu_comm] + $Rin[etc_comm]); 	
	}
	}
    $total_in = $total_iphak + $total_incom ; 

	//기대수익
	$rs_next = new $rs_class($dbcon);
	$rs_next->clear();
	$rs_next->set_table($_table['regi_account']);

//	$rs_in->add_where("chain = 1");		
	$rs_next->add_where("cost_in = 0");  
   
	while($Rnext=$rs_next->fetch()) {
	$total_innext = $total_innext + $Rnext[next_import]; 
    }

    $rs_list = new $rs_class($dbcon);
	$rs_list->clear();
	$rs_list->set_table($_table['regi']);
    $rs_list->add_where("process_state < 11");	
			
    /***********************************************************************/
   // 필터 조건에 의한 필터링
	 if($ss[0]){ $rs_list->add_where("process_state = $ss[0]"); } 
	 if($ss[1]){ $rs_list->add_where("national = $ss[1]"); } 

	// 검색어로 검색
	if($kw) { $rs_list->add_where("student_name LIKE '%$kw%' escape '".$dbcon->escape_ch."'");}       
    $rs_list->add_where("abroad_date1 = $year and abroad_date2 = $month");  
	if($consult){ $rs_list->add_where("consult = $consult"); } 
	

	switch ($ot) {
		case 10 : $rs_list->add_order("regi_no DESC");		break;
		default : $rs_list->add_order("abroad_date1 DESC, regi_no DESC");		break;
	}
	
   $page_info=$rs_list->select_list($page,20,10);

   $MENU_L='m5';	
?>	
<? include("_header.php"); ?>
<? include("admin.header.php"); ?>
<table border="0" cellpadding="0" cellspacing="0" width="800" align="center">
  <tr height="40">
    <td background="images/title_bg.gif" style="padding:9pt 0pt 0pt 10pt" valign="top"><font color=#000000><b>등록자관리</b></font></td>
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
    <td background="images/search_bg_middle.gif" style="padding:0pt 0pt 0pt 15pt" class="tt4">진행상황 <select name="ss[0]" onChange="search_form.submit()" class="select">
<option value="">=전체=</option>
<?=rg_html_option($_process['process_state'],"$ss[0]")?>
</select> 국가 <select name="ss[1]" onChange="search_form.submit()"  class="select2">
<option value="">=전체=</option>
<?=rg_html_option($_const['national'],"$ss[1]")?>
</select> 담당자 <select name="consult" class="select">
              <option value="">=전체=</option> 
		 <?       
	    $rs_nb = new $rs_class($dbcon);
	    $rs_nb->clear();
	    $rs_nb->set_table($_table['member']);
        $rs_nb->add_where("mb_id != 'webadmin'");	
        $rs_nb->add_where("mb_id != 'webadmin2'");	
        $rs_nb->add_where("mb_level >= 90");	
	    while($RV=$rs_nb->fetch()) {
		?>

	<option value="<?=$RV[mb_num]?>" <?if ($RV[mb_num]==$consult) { ?>selected<?}?>><?=$RV[mb_name]?></option>  <?     } ?> 
		</select>
		등록일 
<select name="year" class="select">
<?=rg_html_option($_const[year],$year)?>
		</select>년 <select name="month" class="select">
<?=rg_html_option($_const[month],$month)?>
		</select>월  <INPUT onfocus=this.blur() type=image src="images/bt_order_search.gif" align="absmiddle"> <a href="regi_edit.php?<?=$p_str?>&page=<?=$page?>&mode=new")><img src=images/student_regi.gif border="0" align="absmiddle"></a></td>
  </tr>
  <tr> 
    <td background="images/search_bg_middle.gif" align="center"><img src=images/icon_line.gif border="0"></td>
  </tr>
  <tr> 
    <td background="images/search_bg_middle.gif" style="padding:0pt 0pt 0pt 15pt">  
	<SPAN STYLE='font-size:8.0pt;font-family:"돋움";'>	
	<font color=#E6059D>■ [여권/비자 확인]</font>&nbsp;
  <font color=#9E0BF5>■ [입학금 입금]</font>&nbsp;
  <font color=#2218F1>■ [어학교 등록]</font>&nbsp;
  <font color=#1A93EA>■ [항공 예약]</font>&nbsp;
  <font color=#00EEE3>■ [항공비 완납]</font>&nbsp;
  <font color=#01EA2C>■ [항공권 발급]</font>&nbsp;
  <font color=#D0FB40>■ [학비입금]</font>&nbsp;
  <font color=#EBB357>■ [출국 O/T]</font></SPAN>
  </td>
  </tr>
  <tr> 
    <td><img src="images/search_bg_bottom.gif" width="770" height="16"></td>
  </tr>
  </form>
</table>
<br>

<table width="770" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr> 
    <td align="center" class="text15_b"><?=$year?>년 <?=$month?>월 등록 현황</td>
  </tr>
  <tr> 
    <td align="center" class="text15_b">&nbsp;</td>
  </tr>
  <tr> 
    <td><img src="images/search_bg_top.gif" width="770" height="16"></td>
  </tr>
  <tr>
    <td background="images/search_bg_middle.gif" style="padding:0pt 0pt 0pt 15pt">등록학생: <strong><?=$total_num?>명(<?=$total_price?>주)</strong>&nbsp;&nbsp;|&nbsp;&nbsp;당월수익: <strong><?=number_format($total_in)?>원</strong>&nbsp;&nbsp;|&nbsp;&nbsp;기대수익: <strong><?=number_format($total_innext)?>원</strong></td>
  </tr>
  <tr> 
    <td background="images/search_bg_middle.gif" align="center"><img src=images/icon_line.gif border="0"></td>
  </tr>
  <tr>
    <td background="images/search_bg_middle.gif" style="padding:0pt 0pt 0pt 15pt">필리핀: <?=$total_cnum?>명(<?=$total_cprice?>주)&nbsp;&nbsp;|&nbsp;&nbsp;뉴질랜드: <?=$total_anum?>명(<?=$total_aprice?>주)&nbsp;&nbsp;|&nbsp;&nbsp;호주: <?=$total_bnum?>명(<?=$total_bprice?>주)&nbsp;&nbsp;|&nbsp;&nbsp;캐나다: <?=$total_dnum?>명(<?=$total_dprice?>주)&nbsp;&nbsp;|&nbsp;&nbsp;영국: <?=$total_enum?>명(<?=$total_eprice?>주)</td>
  </tr>
  <tr> 
    <td><img src="images/search_bg_bottom.gif" width="770" height="16"></td>
  </tr>
</table>
<br>
<table width="770" border="0" cellpadding="0" cellspacing="0" align="center">
  <tr bgcolor="#456285" height="25"> 
    <td width="40" align="center" class="tt6">NO</td>
	<td width="35" align="center" class="tt6">수정</td>
	<td width="35" align="center" class="tt6">삭제</td>
	<td width="35" align="center" class="tt6">보기</td>
	<td width="55" align="center" class="tt6">이름</td>
	<td width="55" align="center" class="tt6">담당자</td>
	<td align="center" class="tt6">경로</td>
	<td width="70" align="center" class="tt6">상담일</td> 
	<td width="70" align="center" class="tt6">등록일</td>
	<td width="80" align="center" class="tt6">국가</td>
	<td width="80" align="center" class="tt6">기간</td>
	<td width="90" align="center" class="tt6">연락처</td>
  </tr>   
  <?
	if($rs_list->num_rows()<1) {
		echo "
	<tr height=\"100\"  bgcolor=\"#FFFFFF\" >
		<td align=\"center\" colspan=\"12\"><B>등록(검색) 된 자료가 없습니다.</td>
	</tr>";
	}
	
	$rs_list->set_table($_table['regi']);

	
	$no = $page_info['start_no'];
	while($R=$rs_list->fetch()) {
		$no--;

   if($R[process_state] == 1){
    $fontcolor="#FFFFFF";
   }elseif($R[process_state] == 2){
    $fontcolor="#FFD4F1";
   }elseif($R[process_state] == 3){
    $fontcolor="#EFD4FF";
   }elseif($R[process_state] == 4){
    $fontcolor="#D6D4FF";
   }elseif($R[process_state] == 5){
    $fontcolor="#D4EDFF";
   }elseif($R[process_state] == 6){
    $fontcolor="#D4FFFD";
   }elseif($R[process_state] == 7){
    $fontcolor="#D4FFDC";
   }elseif($R[process_state] == 8){
    $fontcolor="#F5FFD4";
   }elseif($R[process_state] == 9){
    $fontcolor="#FFF4E2";   
   }else{
     $fontcolor="#FFFFFF";
   }


   if($R[national2_check] == 1){
     $national = $R[national2];
     $two = "<font color=red>[연계]</font>";
   }else{
     $national = $R[national];
     $two = "";
   }

    
	    $rs_na = new $rs_class($dbcon);
	    $rs_na->clear();
	    $rs_na->set_table($_table['member']);
        $rs_na->add_where("mb_num = $R[consult]");	
        $name=$rs_na->fetch();

?>
  <tr height="30" bgcolor=<?=$fontcolor?>> 
    <td align="center" class="tt4_c"><?=$no?></td>
	<td align="center" class="tt4_c"><a href="regi_edit.php?<?=$p_str?>&page=<?=$page?>&mode=modify&num=<?=$R[regi_no]?>&year=<?=$year?>&month=<?=$month?>"><img src=images/sbt_modify.gif border="0"></a></td>
	<td align="center" class="tt4_c"><a href="#" onClick="confirm_del('regi_edit.php?<?=$p_str?>&page=<?=$page?>&mode=delete&num=<?=$R[regi_no]?>&year=<?=$year?>&month=<?=$month?>')"><img src=images/sbt_del.gif border="0"></a></td>
	<td align="center" class="tt4_c"><a href="regi_view.php?<?=$p_str?>&page=<?=$page?>&mode=modify&num=<?=$R[regi_no]?>&year=<?=$year?>&month=<?=$month?>"><img src=images/sbt_view.gif border="0"></a></td>
	<td align="center" class="tt4_c"><?=$R[student_name]?></td>	     
	 <td align="center" class="tt4_c"><?=$name[mb_name]?></td>
    <td align="center" class="tt4_c"><?=$_const['root'][$R['rgi_type']]?></td>
    <td align="center" class="tt4_c"><?=$R[regi_date1]?>.<?=$R[regi_date2]?>.<?=$R[regi_date3]?></td>	
    <td align="center" class="tt4_c"><?=$R[abroad_date1]?>.<?=$R[abroad_date2]?>.<?=$R[abroad_date3]?></td>	
    <td align="center" class="tt4_c"><img src="./images/main_real_national<?=$national?>.gif">&nbsp;<?=$_const['national'][$national]?><?=$two?></td>
 	<td class="tt4_c"><?=$R[study_gigan]?><?if($R[study_gigan2]>0){?>(+<?=$R[study_gigan2]?>)<?}?>주</td>   
	<td align="center" class="tt4_c"><?=$R[tel]?></td>	
  </tr>
  <tr>
    <td bgcolor="#BECCDD" height="1" colspan="13"></td>
  </tr>
<?
}
?>
</table>
<br>
<table width="770" align="center">
	<tr>
		<td align="center"><?=rg_navi_display($page_info,$_get_param[2]); ?></td>
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