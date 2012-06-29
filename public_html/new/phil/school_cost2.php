<?
	include_once("../include/lib.php");

/*	
	$Ebqry="
		SELECT *
		FROM `rg_exchange`
	 ";
    $Es=query($Ebqry,$dbcon);
    $E=mysql_fetch_array($Es);
	
	$modi_date = rg_date($E[modi_date]);
	$emoney_peso = $E[exchange1];
	$emoney_dollor = $E[exchange2];
	
*/	

	$rs->clear();
	$rs->set_table($_table['school_cost']);
	if($num){
	$rs->add_where("sc_no=$num");
    }
	$rs->select();
	$R=$rs->fetch();		

	if($num){	
	$rs_tit = new $rs_class($dbcon);
	$rs_tit->set_table($_table['school']);
	$rs_tit->add_where("num=$num");
	$rs_tit->select();
    $data_tit=$rs_tit->fetch();		
	}


    if($week<"12") {
		$point_fee=0;
	} elseif($week>=12 and $week<16) {
		$point_fee=$R[sale_cost12];
	} elseif($week>=16 and $week<20) {
		$point_fee=$R[sale_cost16];
	} elseif($week>=20 and $week<24) {
	    $point_fee=$R[sale_cost20];
	} elseif($week==24) {
	    $point_fee=$R[sale_cost24];
	} 
	
    $iphak_fee=$R[iphak_cost];
    $ssp_fee=$R[ssp_cost];
    $pickup_fee=$R[pickup_cost1];
    $program = $R[pro_cost.$program_no];
    $program_cost = $program/4;    
	$dorm = $R[dorm_cost.$dorm_no];
	$dorm_cost = $dorm/4;
    $program_fee=$program_cost * $week;
    $dorm_fee=$dorm_cost * $week;

   if($week<="8") {
		$visacost_fee=$R[visaextra_cost8];
	} elseif($week>8 and $week<=12) {
		$visacost_fee=$R[visaextra_cost8]+$R[visaextra_cost12];
	} elseif($week>12 and $week<=16) {
		$visacost_fee=$R[visaextra_cost8]+$R[visaextra_cost12]+$R[visaextra_cost16];
	} elseif($week>16 and $week<=20) {
	    $visacost_fee=$R[visaextra_cost8]+$R[visaextra_cost12]+$R[visaextra_cost16]+$R[visaextra_cost20];
	} elseif($week>20 and $week<=24) {
	   $visacost_fee=$R[visaextra_cost8]+$R[visaextra_cost12]+$R[visaextra_cost16]+$R[visaextra_cost20]+$R[visaextra_cost24];
	} 

    if($R[ssp_type] == 1){
      $ssp_fee = $R[ssp_cost] ;		
	}

    if($R[elect_type] ==1){
     $electcost_fee = $R[elect_cost.$dorm_no]/4 * $week;
     }

    if($week<="4") {
		$insu_fee = $R[school_insufee4];
	} elseif($week>4 and $week<=8) {
		$insu_fee = $R[school_insufee8];
	} elseif($week>8 and $week<=12) {
		$insu_fee = $R[school_insufee12];
	} elseif($week>12 and $week<=16) {
		$insu_fee = $R[school_insufee16];
	} elseif($week>16 and $week<=20) {
	    $insu_fee = $R[school_insufee20];
	} elseif($week>20 and $week<=24) {
	   $insu_fee = $R[school_insufee24];
	} 

    if($R[school_insufeetype] == 1){
	$insu1_fee=$insu_fee;
	}elseif($R[school_insufeetype] == 2){
	$insu1_fee=$insu_fee*$emoney_peso;
	}if($R[school_insufeetype] == 3){
	$insu1_fee=$insu_fee*$emoney_dollor;
	} 


    $visa_extra_no = 1; 
    if($week<="8") {
        $visa_extra_no = 1; 
	} elseif($week>8 and $week<=12) {
        $visa_extra_no = 2; 
	} elseif($week>12 and $week<=16) {
        $visa_extra_no = 3; 
	} elseif($week>16 and $week<=20) {
        $visa_extra_no = 4; 
	} elseif($week>20 and $week<=24) {
        $visa_extra_no = 5; 
	} 
   
    //출국전 합계비용
	if($R[ssp_type]==1 and  $R[elect_type] ==2){
	$total_fee1 = $program_fee + $dorm_fee - $point_fee + $iphak_fee + $ssp_fee + $pickup_fee;
	}elseif($R[ssp_type]==1 and $R[elect_type] ==1){
	$total_fee1 = $program_fee + $dorm_fee - $point_fee + $iphak_fee + $ssp_fee + $electcost_fee + $pickup_fee;
	}elseif($R[ssp_type]==2){	
     $total_fee1 = $program_fee + $dorm_fee - $point_fee + $iphak_fee + $pickup_fee;
	}

?>
<title>:: 유학의 길라잡이 유학PLACE ::</title>
<link href="<?=$_url['css']?>style.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/JavaScript">
function open_window(name, url, left, top, width, height, toolbar, menubar, statusbar, scrollbar, resizable)
{
  toolbar_str = toolbar ? 'yes' : 'no';
  menubar_str = menubar ? 'yes' : 'no';
  statusbar_str = statusbar ? 'yes' : 'no';
  scrollbar_str = scrollbar ? 'yes' : 'no';
  resizable_str = resizable ? 'yes' : 'no';

  newWin= window.open(url, name, 'left='+left+',top='+top+',width='+width+',height='+height+',toolbar='+toolbar_str+',menubar='+menubar_str+',status='+statusbar_str+',scrollbars='+scrollbar_str+',resizable='+resizable_str);
}
</script>
<table width="280" border="0" cellpadding="0" cellspacing="0" >
  <tr >   
    <td><input name="button3" type=button class=button onclick="open_window('fr','school_cost_sch.php?page_no=2', 80, 250, 440, 185, 0, 0, 0, 0, 0);" value='연수비용 견적'></td>
  </tr >
</table>
<br>
<table width="280" border="0" cellspacing="1" cellpadding="1" bgcolor="#cccccc">
   <tr height="22">
    <td class="co_11_c" colspan="2" bgcolor="#FFFFFF"><?=$data_tit[title]?></td>
  </tr>  
  <tr height="22">
    <td bgcolor="#575757" class="co_11_w" colspan="2" >출국전비용</td>
  </tr>
  <tr height="22">
    <td width="73" bgcolor="#f5f5f5" class="co_11_c"><b>등록금</b></td>
    <td width="207" bgcolor="#FFFFFF" class="tit"><?if($week){?><?=number_format($iphak_fee)?>원<?}?></td>
   </tr>
  <tr height="22">   
	<td bgcolor="#f5f5f5" class="co_11_c">픽업비</td>
    <td bgcolor="#FFFFFF" class="tit"><?if($week){?><?=number_format($pickup_fee)?>원<?}?></td>
  </tr>
  <tr height="22">
    <td bgcolor="#f5f5f5" class="co_11_c">수업료</td>
    <td bgcolor="#FFFFFF" class="tit"><?if($week){?><?=number_format($program_fee)?>원<?}?></td>
  </tr>
  <tr height="22">
    <td bgcolor="#f5f5f5" class="co_11_c">기숙사</td>
    <td bgcolor="#FFFFFF" class="tit"><?if($week){ if($dorm_fee==0){?>수업료에 포함<?}else{?><?=number_format($dorm_fee)?>원<?}}?></td>
  </tr>
  <tr height="22">
    <td bgcolor="#f5f5f5" class="co_11_c">학비할인</td>
    <td bgcolor="#FFFFFF" class="tit"><?if($week){?><?=number_format($point_fee)?>원<?}?></td>
  </tr>
  <?if($R[ssp_type]=="1"){?>
  <tr height="22">
    <td bgcolor="#f5f5f5" class="co_11_c"><b>SSP비용</b></td>
    <td bgcolor="#FFFFFF" class="tit"><?if($week){?><?=number_format($ssp_fee)?>원<?}?></td>
  </tr>
  <?}?>
  <?if($R[elect_type]=="1"){?>
  <tr height="22">
    <td bgcolor="#f5f5f5" class="co_11_c"><b>전기세</b></td>
    <td bgcolor="#FFFFFF" class="tit"><?if($week){?>평균 <?=number_format($electcost_fee)?>원<?}?></td>
  </tr>
  <?}?>
  <tr height="22">
    <td bgcolor="#f5f5f5" class="co_11_c"><b>합계</b></td>
    <td bgcolor="#FFFFFF" class="tit"><?if($week){?><b><?=number_format($total_fee1)?>원<?}?></td>
  </tr>
  <tr>
    <td  height="2" colspan="2" bgcolor="#ffffff"></td>
  </tr>
  <tr height="22">
    <td bgcolor="#575757" class="co_11_w" colspan="2" >출국후비용</td>
  </tr>
  <?if($R[ssp_type]=="2"){?>
  <tr height="22">
    <td bgcolor="#f5f5f5" class="co_11_c"><b>SSP비용</b></td>
    <td bgcolor="#FFFFFF" class="tit"><?if($week){?><?=number_format($R[ssp_cost])?><?=$_const['money'][$R['ssp_money']]?> (<?=$_const['money_type'][$R['ssp_type']]?>)<?}?></td>  
  </tr>
  <?}?>  
    <tr height="22">
    <td bgcolor="#f5f5f5" class="co_11_c"><b>비자연장비</b></td>
    <td bgcolor="#FFFFFF" class="tit" ><?if($week){?><?=number_format($visacost_fee)?><?=$_const['money'][$R['visaextra_money']]?> (<?=$visa_extra_no?>차 연장)<?}?></td>
  </tr>
  <tr height="22">
    <td bgcolor="#f5f5f5" class="co_11_c"><b>숙박보증금</b></td>
    <td bgcolor="#FFFFFF" class="tit" ><?if($week){?><?=$R[deposit_name1]?> <?=number_format($R[deposit_cost1])?><?=$_const['money'][$R['deposit_money1']]?> <? if($R[deposit_name2]){?> / <?=$R[deposit_name2]?> <?=number_format($R[deposit_cost2])?><?=$_const['money'][$R['deposit_money2']]?><?}?><?}?></td>
  </tr>
  <tr height="22">
    <td bgcolor="#f5f5f5" class="co_11_c">공항이용료</td>
    <td bgcolor="#FFFFFF" class="tit"><?if($week){?><?=number_format($R[phi_out_cost])?>페소<?}?></td>
  </tr>
  <tr height="22">    
	<td bgcolor="#f5f5f5" class="co_11_c">I-CARD</td>
    <td bgcolor="#FFFFFF" class="tit"><?if($week){?><?=number_format($R[icard_p])?>페소 <?if($R[icard_d]){?>+ <?=$R[icard_d]?>달러<?}?><?}?></td>  
  </tr>

  <tr height="22">
    <td bgcolor="#f5f5f5" class="co_11_c"><b>전기세</b></td>
    <td bgcolor="#FFFFFF" class="tit"><?if($week){?><?=$R[elect_text]?><?}?></td>
  </tr>

  <tr height="22">
    <td bgcolor="#f5f5f5" class="co_11_c"><b>교재비</b></td>
    <td bgcolor="#FFFFFF" class="tit"><?if($week){?><?=$R[book_text]?><?}?></td>
  </tr>
  <tr height="22">    
	<td bgcolor="#f5f5f5" class="co_11_c"><b>용돈</b></td>
    <td bgcolor="#FFFFFF" class="tit"><?if($week){?><?=$R[permoney]?><?}?></td>
  </tr>
  <tr>
    <td  height="2" colspan="2" bgcolor="#ffffff"></td>
  </tr>
  <tr height="22">
    <td bgcolor="#575757" class="co_11_w" colspan="2" >기타비용</td>
  </tr>
  <tr height="22">
    <td bgcolor="#f5f5f5" class="co_11_c"><b>항공료</b></td>
    <td bgcolor="#FFFFFF" class="tit" ><?if($week){?><?=$R[air_cost]?><?}?></td>
  </tr>
  <tr height="22">
    <td width="73" bgcolor="#f5f5f5" class="co_11_c"><b>보험</b></td>
    <td bgcolor="#FFFFFF" class="tit"><?if($week){?><?=$R[insu_cost]?><?}?></td>
  </tr>
    <tr height="22">
    <td bgcolor="#575757" class="co_11_w" colspan="4" >비고(프로모션)</td>
  </tr>
  <tr height="22">
    <td bgcolor="#FFFFFF" class="tit"  colspan="4" ><?if($week){?><?=$R[promo]?><?}?></td>
  </tr>
</table>	