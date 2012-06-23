<?
	include_once("../include/lib.php");
	require_once("admin_chk.php");
   
   // 접근 가능 등급 표시

   if($_mb[mb_level] < 99){

		rg_href("./","접근권한이 없습니다.");
	}


	//당월수익

	$rs_in = new $rs_class($dbcon);
	$rs_in->clear();
	$rs_in->set_table($_table['regi_account']);
	if ($year) { $rs_in->add_where("iphak_date1 = $year");  }
	if ($month) { $rs_in->add_where("iphak_date2  = $month");  }

	while($Rinc=$rs_in->fetch()) {
	$total_iphak = $total_iphak + $Rinc[iphak];  		
	$total_in = $total_in + ($Rinc[class_in] + $Rinc[etc_in]);  
	$total_insen = $total_insen + ($Rinc[class_insen] + $Rinc[etc_insen]); 

	}

	$total_cost = $total_iphak + $total_in - $total_insen; 

//기대수익

  
	$rs_next = new $rs_class($dbcon);
	$rs_next->clear();
	$rs_next->set_table($_table['regi_account']);
	$rs_next->add_where("process_state = 3");  	

	if ($year) { $rs_next->add_where("iphak_date1  = $year");  }
	if ($month) { $rs_next->add_where("iphak_date2 = $month");  }	

	while($next=$rs_next->fetch()) {
	$total_innext = $total_innext + $next[next_import]; 
    }	



    $rs_list = new $rs_class($dbcon);
	$rs_list->clear();
	$rs_list->set_table($_table['regi_account']);

    /***********************************************************************/
   // 필터 조건에 의한 필터링
	// if($ss[0]){ $rs_list->add_where("chain = $ss[0]"); } 

	// 검색어로 검색
	//if($kw) { $rs_list->add_where("student_name LIKE '%$kw%' escape '".$dbcon->escape_ch."'");} 
	if ($year) { $rs_list->add_where("iphak_date1  = $year");  }
	if ($month) { $rs_list->add_where("iphak_date2 = $month");  }	
	
	$rs_list->add_order("iphak_date DESC");	
  
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

<? include("admin.header.php"); ?>
<table border="0" cellpadding="0" cellspacing="0" width="800" align="center">
  <tr height="40">
    <td background="images/title_bg.gif" style="padding:9pt 0pt 0pt 10pt" valign="top"><font color=#000000><b>수속관련 내역</b></font></td>
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
<?if($_mb[mb_level] >= 90){?> 
  <tr>
    <td background="images/search_bg_middle.gif" style="padding:0pt 0pt 0pt 15pt" class="tt4">월별 검색 
<select name="year" class="select">
<option value="">=전체=</option>
<?=rg_html_option($_const[year],$year)?>
		</select>년 <select name="month" class="select">
<option value="">=전체=</option>
<?=rg_html_option($_const[month],$month)?>
		</select>월 <INPUT onfocus=this.blur() type=image src="images/bt_order_search.gif" align="absmiddle"> <?if($_mb[mb_level] > 90){?><a href="bank_note_exel.php?date1=<?=$date1?>&date2=<?=$date2?>"><img src=images/bank_exel_regi.gif border="0"></a>&nbsp;&nbsp;&nbsp;<a href="#"><img src=images/print_regi.gif border="0" onclick="Print(false, window)"></a>&nbsp;&nbsp;&nbsp;<?}?></td>
  </tr>

<?}?>
  <tr> 
    <td><img src="images/search_bg_bottom.gif" width="770" height="16"></td>
  </tr>
</table>
</form>
</div>
<table width="770" border="0" cellpadding="0" cellspacing="0" align="center" > 
  <tr height="35"> 
    <td align="center"><strong><font color="balck" size="3"><?=$date1?>년 <?=$date2?>월</font></strong></td>
  </tr>
</table>
<br>
<table width="770" border="0" cellpadding="0" cellspacing="1" align="center" bgcolor="#B0B0B0"> 
  <tr bgcolor="#DFDFDF" height="35"> 
    <td width="100" class="tt33">수익: </td>
    <td width="285" class="tt33"  bgcolor="#FFFFFF"><?=number_format($total_cost)?></td>
    <td width="100" class="tt33">기대수익: </td>
    <td width="285" class="tt33" bgcolor="#FFFFFF"><?=number_format($total_innext)?></td>
  </tr>
</table>
<br>


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
    $st_no=$rowS[regi_no];


?>
<table width="770" border="0" cellpadding="0" cellspacing="1" align="center" bgcolor="#B0B0B0"> 
  <tr bgcolor="#DFDFDF"> 
    <td class="tt33" width="50">NO</td>
    <td class="tt33" width="90">등록일</td>
   <td class="tt33" width="70">학생이름</td>
    <td class="tt33" width="95">입학금</td>
    <td class="tt33" width="95">매출액</td>
    <td class="tt33" width="95">인센티브</td>
    <td class="tt33" width="95">순수익</td>
    <td class="tt33">기대이익</td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td align="center" class="tt5"><?=$no?></td>
    <td align="center" class="tt5"><?=$R[iphak_date]?></td>	
    <td align="center" class="tt5"><a href="../admin/regi_edit.php?<?=$p_str?>&page=<?=$page?>&mode=modify&num=<?=$st_no?>&year=<?=$year?>&month=<?=$month?>"><?=$student_name?></a></td>		
    <td align="center" class="tt5"><?=number_format($R[iphak])?>원</td>
    <td align="center" class="tt5"><?=number_format($R['class_in']+$R['etc_in'])?>원</td>
    <td align="center" class="tt5"><?=number_format($R['class_insen']+$R['etc_insen'])?>원</td>
    <td align="center" class="tt5"><?=number_format($R['class_in']+$R['etc_in']-$R['class_insen']-$R['etc_insen'])?>원</td>
    <td align="center" class="tt5"><?if($R[cost_in_date] != ""){?><font color="red">학비완납</font><?}else{?><?=number_format($R['next_import'])?>원<?}?></td>
  </tr>
</table>
  <table border="0" cellpadding="0" cellspacing="0" width="770" align=center>  
  <tr> 
    <td height=10 bgcolor="#FFFFFF"></td>
  </tr>
</table>
<?
}
?>

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
