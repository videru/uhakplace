<?
	include_once("../include/lib.php");
	require_once("admin_chk.php");
   
   // 접근 가능 등급 표시



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
<? include("_header.php"); ?>
<object id=factory style="display:none" classid="clsid:1663ed61-23eb-11d2-b92f-008048fdd814" codebase="http://www.dreamys.com/script/smsx.cab#Version=6,4,438,06">
</object>
<script>

function doBlink() {
var blink = document.all.tags("BLINK")
for (var i=0; i<blink.length; i++)
blink[i].style.visibility = blink[i].style.visibility == "" ? "hidden" : "" 
}

function startBlink() {
if (document.all)
setInterval("doBlink()",500)
}
window.onLoad = startBlink();
</script> 
<style media="print">
.noprint     { display: none }
</style>
<script defer>
<!--
function window.onload() {
  factory.printing.header = "";   // Header에 들어갈 문장
  factory.printing.footer = "";   // Footer에 들어갈 문장
  factory.printing.leftMargin =0   // 왼쪽 여백 사이즈
  factory.printing.topMargin = 0   // 위 여백 사이즈
  factory.printing.rightMargin = 0  // 오른쪽 여백 사이즈
  factory.printing.bottomMargin = 0  // 아래 여백 사이즈
  factory.printing.portrait = false;   // true 면 세로인쇄, false 면 가로인쇄
  //factory.printing.SetMarginMeasure(2); // 테두리 여백 사이즈 단위를 인치로 설정합니다.
  //factory.printing.printer = "HP DeskJet 870C";  // 프린트 할 프린터 이름
  //factory.printing.paperSize = "A4";   // 용지 사이즈
  //factory.printing.paperSource = "Manual feed";   // 종이 Feed 방식
  //factory.printing.collate = true;   //  순서대로 출력하기
  //factory.printing.copies = 2;   // 인쇄할 매수
  //factory.printing.SetPageRange(True, 1, 8); // True로 설정하고 1, 3이면 1페이지에서 3페이지까지 출력
  //factory.printing.Print(true) // 출력하기

  // enable control buttons
  var templateSupported = factory.printing.IsTemplateSupported();
  var controls = idControls.all.tags("input");
  for ( i = 0; i < controls.length; i++ ) {
    controls[i].disabled = false;
    if ( templateSupported && controls[i].className == "ie55" )
      controls[i].style.display = "inline";
  }
}

function SpoolStatus(start) {

  window.status = start?
    "Please wait for spooling to complete ...":
    "Spooling is complete";
}

function Print(prompt, frame) {
  if ( factory.printing.Print(prompt, frame) ) {
    SpoolStatus(true);
  }
}

function PrintHTML(url) {
  SpoolStatus(true);
  factory.printing.WaitForSpoolingComplete();
  SpoolStatus(false);
}
//-->
</script>
<DIV class=noprint id=idControls>
<? include("admin.header.php"); ?>
<table border="0" cellpadding="0" cellspacing="0" width="800" align="center">
  <tr height="40">
    <td background="images/title_bg.gif" style="padding:9pt 0pt 0pt 10pt" valign="top"><font color=#000000><b>수속관련 입출금 내역</b></font></td>
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
<form name="search_form" method="get" enctype="multipart/form-data">
<table width="770" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr> 
    <td><img src="images/search_bg_top.gif" width="770" height="16"></td>
  </tr>
<?if($_mb[mb_level] == 90){?> 
  <tr>
    <td background="images/search_bg_middle.gif" style="padding:0pt 0pt 0pt 15pt" class="tt4">월별 검색 
	  <select name="date1" class="select">
      <?=rg_html_option($_const[year],"$date1")?> 
	  </select>
      <select name="date2"  class="select">
      <?=rg_html_option($_const[month],"$date2")?>
       </select>&nbsp;&nbsp;&nbsp;담당지사 <select name="ss[0]"  class="select2">
<option value="">=전체=</option>
<?=rg_html_option($_regi['chain'],"$ss[0]")?>
</select></td>
  </tr>
  <tr> 
    <td background="images/search_bg_middle.gif" align="center"><img src=images/icon_line.gif border="0"></td>
  </tr>
<?}?>
  <tr> 
    <td background="images/search_bg_middle.gif" style="padding:0pt 0pt 0pt 15pt"><?if($_mb[mb_level] == 90){?><INPUT onfocus=this.blur() type=image src="images/bt_order_search.gif">&nbsp;&nbsp;&nbsp;<?}?><a href="javascript:open_window('kyejung', 'account_kyejung_list.php', 80, 120, 500, 650, 0, 0, 0, 0, 0);")><img src=images/bank_noto_regi.gif border="0"></a>&nbsp;&nbsp;&nbsp;<?if($_mb[mb_level] == 90){?><a href="bank_note_exel.php?date1=<?=$date1?>&date2=<?=$date2?>"><img src=images/bank_exel_regi.gif border="0"></a>&nbsp;&nbsp;&nbsp;<a href="#"><img src=images/print_regi.gif border="0" onclick="Print(false, window)"></a>&nbsp;&nbsp;&nbsp;<?}?><a href="javascript:open_window('regi', 'account_regi_form.php?date1=<?=$date1?>&date2=<?=$date2?>', 80, 120, 450, 320, 0, 0, 0, 0, 0);")><img src=images/bank_regi.gif border="0"></a></td>
  </tr>
  <tr> 
    <td><img src="images/search_bg_bottom.gif" width="770" height="16"></td>
  </tr>
</table>
</form>
</div>
<?if($_mb[mb_level] == 90){?>
<table width="770" border="0" cellpadding="0" cellspacing="1" align="center" bgcolor="#B0B0B0">
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
  <tr bgcolor="#DFDFDF"> 
    <td rowspan="2" class="tt33">NO</td>
    <td rowspan="2" class="tt33">지사</td>
    <td rowspan="2" class="tt33">학생이름</td>
    <td colspan="3" class="tt33">등록금</td>
    <td colspan="3" class="tt33">학비</td>
    <td colspan="3" class="tt33">숙소</td>
    <td rowspan="2" class="tt33">수익금액</td>
  </tr>
  <tr bgcolor="#DFDFDF"> 
    <td class="tt33">입금금액</td>
    <td class="tt33">지출금액</td>
    <td class="tt33">수익금액</td>
    <td class="tt33">입금금액</td>
    <td class="tt33">지출금액</td>
    <td class="tt33">수익금액</td>
    <td class="tt33">입금금액</td>
    <td class="tt33">지출금액</td>
    <td class="tt33">수익금액</td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td rowspan="4" class="tt5"><?=$no?></td>
    <td rowspan="4" class="tt5"><?=$_regi['chain'][$R[chain]]?></td>
    <td rowspan="4" class="tt5"><?=$student_name?></td>
    <td class="tt5"><?=number_format($R[iphak_incomm])?></td>
    <td class="tt5"><?=number_format($R[iphak_outcomm])?></td>
    <td class="tt5"><?=number_format($R[iphak_incomm]-$R[iphak_outcomm])?></td>
    <td class="tt5"<?=number_format($R[cost_incomm])?></td>
    <td class="tt5"><?=number_format($R[cost_outcomm])?></td>
    <td class="tt5"><?=number_format($R[cost_incomm]-$R[cost_outcomm])?></td>
    <td class="tt5"><?=number_format($R[dorm_incomm])?></td>
    <td class="tt5"><?=number_format($R[dorm_outcomm])?></td>		
    <td class="tt5"><?=number_format($R[dorm_incomm]-$R[dorm_outcomm])?></td>
    <td rowspan="4" class="tt5"><?=number_format($R[iphak_incomm]-$R[iphak_outcomm]+$R[cost_incomm]-$R[cost_outcomm]+$R[dorm_incomm]-$R[dorm_outcomm]+$R[airfee_incomm]-$R[airfee_outcomm]+$R[insu_incomm]-$R[insu_outcomm]+$R[hs_info_incomm]+$R[pickup_incomm]+$R[jien1_incomm]-$R[hs_info_outcomm]+$R[pickup_outcomm]+$R[jien1_outcomm])?></td>
  </tr>
  <tr bgcolor="#DFDFDF"> 
    <td colspan="3" align="center" class="tt33">항공</td>
    <td colspan="3" align="center" class="tt33">보험</td>
    <td colspan="3" align="center" class="tt33">기타</td>
  </tr>
  <tr bgcolor="#DFDFDF"> 
    <td align="center" class="tt33">입금금액</td>
    <td align="center" class="tt33">지출금액</td>
    <td align="center" class="tt33">수익금액</td>
    <td align="center" class="tt33">입금금액</td>
    <td align="center" class="tt33">지출금액</td>
    <td align="center" class="tt33">수익금액</td>
    <td align="center" class="tt33">입금금액</td>
    <td align="center" class="tt33">지출금액</td>
    <td align="center" class="tt33">수익금액</td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td align="center" class="tt5"><?=number_format($R[airfee_incomm])?></td>
    <td align="center" class="tt5"><?=number_format($R[airfee_outcomm])?></td>		
    <td align="center" class="tt5"><?=number_format($R[airfee_incomm]-$R[airfee_outcomm])?></td>
    <td align="center" class="tt5"><?=number_format($R[insu_incomm])?></td>
    <td align="center" class="tt5"><?=number_format($R[insu_outcomm])?></td>	
    <td align="center" class="tt5"><?=number_format($R[insu_incomm]-$R[insu_outcomm])?></td>
    <td align="center" class="tt5"><?=number_format($R[hs_info_incomm]+$R[pickup_incomm]+$R[jien1_incomm])?></td>		
    <td align="center" class="tt5"><?=number_format($R[hs_info_outcomm]+$R[pickup_outcomm]+$R[jien1_outcomm])?></td>
    <td align="center" class="tt5"><?=number_format($R[hs_info_incomm]+$R[pickup_incomm]+$R[jien1_incomm]-$R[hs_info_outcomm]+$R[pickup_outcomm]+$R[jien1_outcomm])?></td>
  </tr>
  <?
}
?>
</table>
  <table border="0" cellpadding="0" cellspacing="0" width="770" align=center>  
  <tr> 
    <td height=10 bgcolor="#FFFFFF"></td>
  </tr>
</table>
<?}?>
  <table border="0" cellpadding="0" cellspacing="1" width="770" align=center bgcolor="#B0B0B0">  
  <tr bgcolor="#DFDFDF"height="25"> 
    <td width="600" class="tt33">합 계</td>
    <td bgcolor="#FFFFFF" class="tt5"><?=number_format($total_total)?></td>
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
