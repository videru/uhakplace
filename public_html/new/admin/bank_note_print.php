<?
	include_once("../include/lib.php");
	require_once("admin_chk.php");
   
    if ($date1=="") {
		$date1=date("Y");
	}
	if ($date2=="") {
		$date2=date("m");
	}

    $rs_list = new $rs_class($dbcon);
	$rs_list->clear();
	$rs_list->set_table($_table['account']);
	$rs_list->add_where("comm_date1 = $date1 and comm_date2 = $date2");		
			
    /***********************************************************************/
   // 필터 조건에 의한 필터링
	 if($ss[0]){ $rs_list->add_where("chain = $ss[0]"); } 

	// 검색어로 검색
	if($kw) { $rs_list->add_where("student_name LIKE '%$kw%' escape '".$dbcon->escape_ch."'");} 

	$rs_list->add_order("comm_date ASC");	
	$rs_list->add_order("ac_no ASC");  	
	
?>	
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>유학플레이스 관리모드</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link href="http://www.uhakplace.co.kr/css/style.css" rel="stylesheet" type="text/css">
</head>
<script src="http://www.uhakplace.co.kr/js/common.js"></script>
<script src="http://www.uhakplace.co.kr/js/lib.validate.js"></script>
<script src="http://www.uhakplace.co.kr/js/carendar.js"></script>
<script language="javascript">
// http://happyscript.com
function printWindow() {
factory.printing.header = ""
factory.printing.footer = ""
  factory.printing.portrait = true;   // true 면 세로인쇄, false 면 가로인쇄
factory.printing.leftMargin = 15.0
factory.printing.topMargin = 15.0
factory.printing.rightMargin = 15.0
factory.printing.bottomMargin = 15.0

factory.printing.Print(false, window)
}
</script>
<script> 
function window::onload(){ printWindow(); } 
</script> 
</HEAD>
<body bottommargin="0" topmargin="0" leftmargin="0" rightmargin="0">
<object id=factory style="display:none" viewastext classid="clsid:1663ed61-23eb-11d2-b92f-008048fdd814" codebase="http://www.uhakplace.co.kr/js/smsx.cab#Version=6,4,438,06"></object>
<table width="700" border=0 cellpadding="0" cellspacing="0">
<?
    if($ss[0]){
    $Tqry = "select * from rg4_account where comm_date1 = $date1 and comm_date2 = $date2 and chain = $ss[0]" ;	
    }else{
    $Tqry = "select * from rg4_account where comm_date1 = $date1 and comm_date2 = $date2" ;		
    }
    $resultT = mysql_query($Tqry);  
    $totalnum  = @mysql_num_rows($resultT);
    for ($i=0;$i<$totalnum;$i++) {
	$rowT =mysql_fetch_array($resultT);		
    if($rowT[in_out_comm]==1){
	$total_anum++;
    $total_aprice = $total_aprice + $rowT[comm];
    }
	if($rowT[in_out_comm]==2){
	$total_bnum++;
    $total_bprice = $total_bprice + $rowT[comm];
    }

    $total_tnum++;
    $total_tprice = $total_aprice-$total_bprice;
 
}
if($ss[0]==1){
	$chain ="강남";
}elseif($ss[0]==2){
	$chain ="부산";
}
?>
<tr bgcolor="#FFFFFF" height="25" align="center"  >
<td colspan="8" style="border: #000000 solid; border-width: 1px 1px 1px 1px"><b><?=$date1?>년 <?=$date2?>월 <?=$chain?> 입출금 내역</b></td>
</tr>
<tr>
    <td  height="18"  align="right" colspan="8" style="border: #000000 solid; border-width: 0px 1px 1px 1px">수익금액: \<?=number_format($total_tprice)?> (입금액: \<?=number_format($total_aprice)?>/지출액: \<?=number_format($total_bprice)?>)&nbsp;&nbsp;</td>
  </tr>    
  <tr height="18" > 
	<td bgcolor="#456285" width="30"  align="center" class="tt6"  style="border: #000000 solid; border-width: 0px 1px 1px 1px">NO</td>	
 	<td bgcolor="#456285" width="50" align="center"  class="tt6"  style="border: #000000 solid; border-width: 0px 1px 1px 0px">등록일</td>   
	<td bgcolor="#456285" width="30" align="center" class="tt6" style="border: #000000 solid; border-width: 0px 1px 1px 0px">지사</td>
	<td bgcolor="#456285" width="120" align="center" class="tt6" style="border: #000000 solid; border-width: 0px 1px 1px 0px">입출금내역</td>	
	<td bgcolor="#456285" width="80" align="center" class="tt6" style="border: #000000 solid; border-width: 0px 1px 1px 0px">입금금액</td>
	<td bgcolor="#456285" width="80" align="center" class="tt6" style="border: #000000 solid; border-width: 0px 1px 1px 0px">지출금액</td>
	<td bgcolor="#456285" width="80" align="center" class="tt6" style="border: #000000 solid; border-width: 0px 1px 1px 0px">잔고</td>
	<td bgcolor="#456285" align="center" class="tt6" style="border: #000000 solid; border-width: 0px 1px 1px 0px">비고</td>
  </tr>   
  <?

	$rs_list->set_table($_table['account']);	
	
	while($R=$rs_list->fetch()) {
		$no++;
	    
 
	  if($R[in_out_comm]==1){	 
	   $com1 = number_format($R[comm]);
	   $com2 = "-";  
	   
        $ttt1 = $R[comm];
		$ttt2 = 0;

	  }elseif($R[in_out_comm]==2){	 
	   $com1 = "-";
	   $com2 = number_format($R[comm]);  
	        
		$ttt1 = 0;
		$ttt2 = $R[comm];	  
	  }
	

    $total_tt1 = $total_tt1 + $ttt1 ;
    $total_tt2 = $total_tt2 + $ttt2 ;

    $total_ttprice = $total_ttprice + ($ttt1-$ttt2);

  	$Dqry = "select * from rg4_account_kyejung where kyejung_code = '$R[comm_text_no]'" ;		 
    $resultD = mysql_query($Dqry);
    $rowD = mysql_fetch_array($resultD);
    $kyejung_name=$rowD[kyejung_name];

  	$Sqry = "select * from rg4_regi where regi_no = '$R[student_no]'" ;		 
    $resultS = mysql_query($Sqry);
    $rowS = mysql_fetch_array($resultS);
    $student_name=$rowS[student_name];
?>
  <tr bgcolor="#FFFFFF" height="18">     
	<td align="center" class="tt4_c" style="border: #000000 solid; border-width: 0px 1px 1px 1px"><?=$no?></td>
	<td align="center" class="tt4_c"  style="border: #000000 solid; border-width: 0px 1px 1px 0px"><?=rg_date($R[comm_date],'%y.%m.%d')?></td>
    <td align="center" class="tt4_c"  style="border: #000000 solid; border-width: 0px 1px 1px 0px"><?=$_regi['chain'][$R[chain]]?></td>
    <td align="center" class="tt4_c"  style="border: #000000 solid; border-width: 0px 1px 1px 0px"><?if($R[student_no]>0){?><?=$student_name?> <?}?><?=$rowD[kyejung_name]?></td>
    <td align="center" class="tt4_c"  style="border: #000000 solid; border-width: 0px 1px 1px 0px"><font color="blue"><?=$com1?></font></td>	
    <td align="center" class="tt4_c"  style="border: #000000 solid; border-width: 0px 1px 1px 0px"><font color="red"><?=$com2?></font></td>
    <td align="center" class="tt4_c"  style="border: #000000 solid; border-width: 0px 1px 1px 0px"><strong><?=number_format($total_ttprice)?></strong></td>
    <td align="center" class="tt4_c"  style="border: #000000 solid; border-width: 0px 1px 1px 0px"><?=$R[etc]?>&nbsp;</td>    
  </tr>
<?}?>
  <tr bgcolor="#FFFFFF" height="18"> 
    <td align="center" colspan="4" class="tt4_c"   style="border: #000000 solid; border-width: 0px 1px 1px 1px">합 계</td>
    <td align="center" class="tt4_c"  style="border: #000000 solid; border-width: 0px 1px 1px 0px"><strong><font color="blue"><?=number_format($total_tt1)?></font></strong></td>	
    <td align="center" class="tt4_c"  style="border: #000000 solid; border-width: 0px 1px 1px 0px"><strong><font color="red"><?=number_format($total_tt2)?></font></strong></td>	
    <td align="center" class="tt4_c"  style="border: #000000 solid; border-width: 0px 1px 1px 0px"><strong><?=number_format($total_ttprice)?></strong></td>
    <td align="center" class="tt4_c"  style="border: #000000 solid; border-width: 0px 1px 1px 0px">&nbsp;</td>    
  </tr>
</table>
<? include("_footer.php"); ?>