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
	$rs_list->set_table($_table['regi_account']);

    /***********************************************************************/
   // 필터 조건에 의한 필터링
	 if($ss[0]){ $rs_list->add_where("chain = $ss[0]"); } 

	// 검색어로 검색
	if($kw) { $rs_list->add_where("student_name LIKE '%$kw%' escape '".$dbcon->escape_ch."'");} 

  $rs_list->add_where("chain = $ss[0]");  


//	$rs_list->add_order("student_no ASC");	
  	


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

  <?
	if($rs_list->num_rows()<1) {
		echo "
	<tr height=\"100\"  bgcolor=\"#FFFFFF\" >
		<td align=\"center\" colspan=\"22\"><B>등록(검색) 된 자료가 없습니다.</td>
	</tr>";
	}
	
	$rs_list->set_table($_table['regi_account']);	
	
	while($R=$rs_list->fetch()) {
		$no++;
	
  	$Sqry = "select * from rg4_regi where regi_no = '$R[stu_no]'" ;		 
    $resultS = mysql_query($Sqry);
    $rowS = mysql_fetch_array($resultS);
    $student_name=$rowS[student_name];
?>
<table width="770" border="0" cellpadding="0" cellspacing="1" align="center" bgcolor="#B0B0B0"> 
  <tr bgcolor="#DFDFDF"> 
    <td class="tt33">NO</td>
    <td class="tt33">지사</td>
    <td class="tt33">학생이름</td>
    <td class="tt33">입학금</td>
    <td class="tt33">학비입금</td>
    <td class="tt33">학비송금</td>
    <td class="tt33">환차액</td>
    <td class="tt33">송금수수료</td>
    <td class="tt33">학비컴</td>
    <td class="tt33">할인액</td>
    <td class="tt33">컴쉐어</td>
    <td class="tt33">총학비수수료</td>
    <td class="tt33">항공컴</td>
    <td class="tt33">보험컴</td>
    <td class="tt33">기타컴</td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td class="tt33"><?=$no?></td>
    <td class="tt33"><?=$_regi['chain'][$R[chain]]?></td>
    <td class="tt33"><?=$student_name?></td>
    <td class="tt33"><?if($R[iphak_date1] == $date1 and $R[iphak_date2] == $date2){?><?=number_format($R[iphak])?><?}?></td>
    <td class="tt33"><?if($R[cost_in_date1] == $date1 and $R[cost_in_date2] == $date2){?><?=number_format($R[cost_in])?><?}?></td>
    <td class="tt33"><?if($R[cost_out_date1] == $date1 and $R[cost_out_date2] == $date2){?><?=number_format($R[cost_out])?><?}?></td>
    <td class="tt33"><?if($R[exch_date1] == $date1 and $R[exch_date2] == $date2){?><?=number_format($R[exchange])?><?}?></td>
    <td class="tt33"><?if($R[ba_fee_date1] == $date1 and $R[ba_fee_date2] == $date2){?><?=number_format($R[bank_fee])?><?}?></td>
    <td class="tt33"><?if($R[comm_date1] == $date1 and $R[comm_date2] == $date2){?><?=number_format($R[comm])?><?}?></td>
    <td class="tt33"><?if($R[sale_date1] == $date1 and $R[sale_date2] == $date2){?><?=number_format($R[sale])?><?}?></td>
    <td class="tt33"><?if($R[co_sh1_date1] == $date1 and $R[co_sh1_date2] == $date2){?><?=number_format($R[comm_share1])?><?}?><br><?if($R[co_sh2_date1] == $date1 and $R[co_sh2_date2] == $date2){?><?=number_format($R[comm_share1])?><?}?></td>
    <td class="tt33">,,</td>
    <td class="tt33"><?if($R[air_date1] == $date1 and $R[air_date2] == $date2){?><?=number_format($R[air_comm])?><?}?></td>
    <td class="tt33"><?if($R[insu_date1] == $date1 and $R[insu_date2] == $date2){?><?=number_format($R[insu_comm])?><?}?></td>
    <td class="tt33"><?if($R[etc_date1] == $date1 and $R[etc_date2] == $date2){?><?=number_format($R[etc_comm])?><?}?></td>
  </tr>
</table>
  <table border="0" cellpadding="0" cellspacing="0" width="770" align=center>  
  <tr> 
    <td height=10 bgcolor="#FFFFFF"></td>
  </tr>
</table>
<?
}}
?>
 <table border="0" cellpadding="0" cellspacing="1" width="770" align=center bgcolor="#B0B0B0">  
  <tr bgcolor="#DFDFDF"height="25"> 
    <td width="704" class="tt33">합 계</td>
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
