<?
	include_once("../include/lib.php");
	require_once("admin_chk.php");
   
   // 접근 가능 등급 표시

	$fileN1 = $date1."년_".$date2."월_수속관련 입출금 내역";
	header( "Content-type: application/vnd.ms-word" ); 
	header("Cache-control: private");
	header( "Content-Disposition: attachment; filename=$fileN1.doc" ); 
	header( "Content-Description: PHP4 Generated Data" ); 

    if ($date1=="") {
		$date1=date("Y");
	}
	if ($date2=="") {
		$date2=date("m");
	}

    $rs_list = new $rs_class($dbcon);
	$rs_list->clear();
	$rs_list->set_table($_table['st_account']);
	$rs_list->add_where("comm_date1 = $date1 and comm_date2 = $date2");		
			
    /***********************************************************************/
   // 필터 조건에 의한 필터링
	 if($ss[0]){ $rs_list->add_where("chain = $ss[0]"); } 

	// 검색어로 검색
	if($kw) { $rs_list->add_where("student_name LIKE '%$kw%' escape '".$dbcon->escape_ch."'");} 

	$rs_list->add_order("student_no ASC");	
  	
	

?>	
<link href="http://gojes.com/rg4_css/style.css" rel="stylesheet" type="text/css">

<table width="1410" border=0 cellpadding="0" cellspacing="0">
<?
	$Tqry = "select * from rg4_st_account where comm_date1 = $date1 and comm_date2 = $date2" ;		 
    $resultT = mysql_query($Tqry);  
    $totalnum  = @mysql_num_rows($resultT);
    for ($i=0;$i<$totalnum;$i++) {
	$rowT =mysql_fetch_array($resultT);		

	$total_anum++;
    $total_aprice = $total_aprice + ($rowT[iphak_incomm]+$rowT[cost_incomm]+$rowT[dorm_incomm]+$rowT[airfee_incomm]+$rowT[insu_incomm]   +$rowT[hs_info_incomm]+$rowT[pickup_incomm]+$rowT[jien1_incomm]+$rowT[jien2_incomm]);


	$total_bnum++;
    $total_bprice = $total_bprice +($rowT[iphak_outcomm]+$rowT[cost_outcomm]+$rowT[dorm_outcomm]+$rowT[airfee_outcomm]+$rowT[insu_outcomm]   +$rowT[hs_info_outcomm]+$rowT[pickup_outcomm]+$rowT[jien1_outcomm]+$rowT[jien2_outcomm]);


    $total_tnum++;
    $total_tprice = $total_aprice-$total_bprice;
  
}

if($ss[0]==1){
	$chain ="강남";
}elseif($ss[0]==2){
	$chain ="부산";
}

?>
<tr bgcolor="#FFFFFF" height="25" align="center">
<td><font size=3><b><?=$date1?>년 <?=$date2?>월 <?=$chain?> 입출금 내역</b></font></td>
</tr>

<tr bgcolor="#FFFFFF" height="25" align="right">
<td>수익금액: \<?=number_format($total_tprice)?><br>입금액: \<?=number_format($total_aprice)?>&nbsp;&nbsp;/&nbsp;&nbsp;지출액: \<?=number_format($total_bprice)?></td>
</tr>
</table>
<br>

<table width="1410" border="0" cellpadding="0" cellspacing="1" bgcolor="#A8C3D8">
  <tr bgcolor="#F7F7F7"> 
    <td width="30" align="center" rowspan="3"><b>NO</b></td>
	<td width="50" align="center" rowspan="3"><b>지사</b></td>
	<td align="center" rowspan="3"><b>학생이름</b></td>	
	<td width="195" align="center" colspan="3"><b>등록금</b></td>
	<td width="195" align="center" colspan="3"><b>학비</b></td> 
	<td width="195" align="center" colspan="3"><b>숙소</b></td>
	<td width="195" align="center" colspan="3"><b>항공</b></td> 
	<td width="195" align="center" colspan="3"><b>보험</b></td>
	<td width="195" align="center" colspan="3"><b>기타</b></td> 
	<td width="70" align="center" rowspan="3"><b>수익금액</b></td>
  </tr> 
  <tr bgcolor="#A8C3D8" height="1"> 
    <td colspan="15"></td>
  </tr>  
  <tr bgcolor="#F7F7F7">
	<td width="65" align="center"><font color="blue">입금금액</font></td>
	<td width="65" align="center"><font color="red">지출금액</font></td>
	<td width="65" align="center">수익금액</td>
	<td width="65" align="center"><font color="blue">입금금액</font></td>
	<td width="65" align="center"><font color="red">지출금액</font></td>
	<td width="65" align="center">수익금액</td>
	<td width="65" align="center"><font color="blue">입금금액</font></td>
	<td width="65" align="center"><font color="red">지출금액</font></td>
	<td width="65" align="center">수익금액</td>
	<td width="65" align="center"><font color="blue">입금금액</font></td>
	<td width="65" align="center"><font color="red">지출금액</font></td>
	<td width="65" align="center">수익금액</td>
	<td width="65" align="center"><font color="blue">입금금액</font></td>
	<td width="65" align="center"><font color="red">지출금액</font></td>
	<td width="65" align="center">수익금액</td>
	<td width="65" align="center"><font color="blue">입금금액</font></td>
	<td width="65" align="center"><font color="red">지출금액</font></td>
	<td width="65" align="center">수익금액</td>
  <tr bgcolor="#A8C3D8" height="1"> 
    <td colspan="19"></td>
  </tr>
  <?
	if($rs_list->num_rows()<1) {
		echo "
	<tr height=\"100\"  bgcolor=\"#FFFFFF\" >
		<td align=\"center\" colspan=\"22\"><B>등록(검색) 된 자료가 없습니다.</td>
	</tr>";
	}
	
	$rs_list->set_table($_table['st_account']);	
	
	while($R=$rs_list->fetch()) {
		$no++;
	
	    $total_iphak_in = $total_iphak_in + $R[iphak_incomm] ;
	    $total_iphak_out = $total_iphak_out + $R[iphak_outcomm] ;
	    $total_iphak_inout = $total_iphak_in - $total_iphak_out ;

	    $total_cost_in = $total_cost_in + $R[cost_incomm] ;
	    $total_cost_out = $total_cost_out + $R[cost_outcomm] ;
	    $total_cost_inout = $total_cost_in - $total_cost_out ;

	    $total_dorm_in = $total_dorm_in + $R[dorm_incomm] ;
	    $total_dorm_out = $total_dorm_out + $R[dorm_outcomm] ;
	    $total_dorm_inout = $total_dorm_in - $total_dorm_out ;

	    $total_airfee_in = $total_airfee_in + $R[airfee_incomm] ;
	    $total_airfee_out = $total_airfee_out + $R[airfee_outcomm] ;
	    $total_airfee_inout = $total_airfee_in - $total_airfee_out ;

	    $total_insu_in = $total_insu_in + $R[insu_incomm] ;
	    $total_insu_out = $total_insu_out + $R[insu_outcomm] ;
	    $total_insu_inout = $total_insu_in - $total_insu_out ;


	    $total_etc_in = $total_etc_in + ($R[hs_info_incomm]+$R[pickup_incomm]+$R[jien1_incomm]) ;
	    $total_etc_out = $total_etc_out + ($R[hs_info_outcomm]+$R[pickup_outcomm]+$R[jien1_outcomm]) ;
	    $total_etc_inout = $total_etc_in - $total_etc_out ;



       $total_total = $total_total + (
$R[iphak_incomm]-$R[iphak_outcomm]+$R[cost_incomm]-$R[cost_outcomm]+$R[dorm_incomm]-$R[dorm_outcomm]+$R[airfee_incomm]-$R[airfee_outcomm]+$R[insu_incomm]-$R[insu_outcomm]+$R[hs_info_incomm]+$R[pickup_incomm]+$R[jien1_incomm]-$R[hs_info_outcomm]+$R[pickup_outcomm]+$R[jien1_outcomm]) ;

   
  	$Dqry = "select * from rg4_account_kyejung where kyejung_code = '$R[comm_text_no]'" ;		 
    $resultD = mysql_query($Dqry);
    $rowD = mysql_fetch_array($resultD);
    $kyejung_name=$rowD[kyejung_name];

  	$Sqry = "select * from rg4_regi where regi_no = '$R[student_no]'" ;		 
    $resultS = mysql_query($Sqry);
    $rowS = mysql_fetch_array($resultS);
    $student_name=$rowS[student_name];
?>
  <tr bgcolor="#FFFFFF" height="25"> 
    <td align="center"><?=$no?></td>
    <td align="center"><?=$_regi['chain'][$R[chain]]?></td>
    <td align="center"><?=$student_name?></td>
    <td align="center"><font color="blue"><?=number_format($R[iphak_incomm])?></font></td>	
    <td align="center"><font color="red"><?=number_format($R[iphak_outcomm])?></font></td>
    <td align="center"><?=number_format($R[iphak_incomm]-$R[iphak_outcomm])?></td>		
    <td align="center"><font color="red"><?=number_format($R[cost_incomm])?></font></td>
    <td align="center"><font color="red"><?=number_format($R[cost_outcomm])?></font></td>
    <td align="center"><?=number_format($R[cost_incomm]-$R[cost_outcomm])?></td>	
    <td align="center"><font color="red"><?=number_format($R[dorm_incomm])?></font></td>
    <td align="center"><font color="blue"><?=number_format($R[dorm_outcomm])?></font></td>		
    <td align="center"><?=number_format($R[dorm_incomm]-$R[dorm_outcomm])?></td>
    <td align="center"><font color="red"><?=number_format($R[airfee_incomm])?></font></td>
    <td align="center"><font color="blue"><?=number_format($R[airfee_outcomm])?></font></td>		
    <td align="center"><?=number_format($R[airfee_incomm]-$R[airfee_outcomm])?></td>
    <td align="center"><font color="red"><?=number_format($R[insu_incomm])?></font></td>
    <td align="center"><font color="blue"><?=number_format($R[insu_outcomm])?></font></td>	
    <td align="center"><?=number_format($R[insu_incomm]-$R[insu_outcomm])?></td>
    <td align="center"><font color="blue"><?=number_format($R[hs_info_incomm]+$R[pickup_incomm]+$R[jien1_incomm])?></font></td>		
    <td align="center"><font color="red"><?=number_format($R[hs_info_outcomm]+$R[pickup_outcomm]+$R[jien1_outcomm])?></font></td>
    <td align="center"><?=number_format($R[hs_info_incomm]+$R[pickup_incomm]+$R[jien1_incomm]-$R[hs_info_outcomm]+$R[pickup_outcomm]+$R[jien1_outcomm])?></td>
    <td align="center"><?=number_format($R[iphak_incomm]-$R[iphak_outcomm]+$R[cost_incomm]-$R[cost_outcomm]+$R[dorm_incomm]-$R[dorm_outcomm]+$R[airfee_incomm]-$R[airfee_outcomm]+$R[insu_incomm]-$R[insu_outcomm]+$R[hs_info_incomm]+$R[pickup_incomm]+$R[jien1_incomm]-$R[hs_info_outcomm]+$R[pickup_outcomm]+$R[jien1_outcomm])?></td>
  </tr>

<?
}
?>
  <tr bgcolor="#A8C3D8" height="2"> 
    <td colspan="19"></td>
  </tr>
  <tr bgcolor="#FFFFFF" height="25"> 
    <td align="center" colspan="3">합 계</td>
    <td align="center"><font color="blue"><?=number_format($total_iphak_in)?></font></td>	
    <td align="center"><font color="red"><?=number_format($total_iphak_out)?></font></td>
    <td align="center"><font color="blue"><?=number_format($total_iphak_inout)?></font></td>		
    <td align="center"><font color="blue"><?=number_format($total_cost_in)?></font></td>	
    <td align="center"><font color="red"><?=number_format($total_cost_out)?></font></td>
    <td align="center"><font color="blue"><?=number_format($total_cost_inout)?></font></td>	
    <td align="center"><font color="blue"><?=number_format($total_dorm_in)?></font></td>	
    <td align="center"><font color="red"><?=number_format($total_dorm_out)?></font></td>
    <td align="center"><font color="blue"><?=number_format($total_dorm_inout)?></font></td>	
    <td align="center"><font color="blue"><?=number_format($total_airfee_in)?></font></td>	
    <td align="center"><font color="red"><?=number_format($total_airfee_out)?></font></td>
    <td align="center"><font color="blue"><?=number_format($total_airfee_inout)?></font></td>	
    <td align="center"><font color="blue"><?=number_format($total_insu_in)?></font></td>	
    <td align="center"><font color="red"><?=number_format($total_insu_out)?></font></td>
    <td align="center"><font color="blue"><?=number_format($total_insu_inout)?></font></td>	
    <td align="center"><font color="blue"><?=number_format($total_etc_in)?></font></td>	
    <td align="center"><font color="red"><?=number_format($total_etc_out)?></font></td>
    <td align="center"><font color="blue"><?=number_format($total_etc_inout)?></font></td>	
    <td align="center"><?=number_format($total_total)?></td>
  </tr>
</table>

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
