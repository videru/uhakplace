<?
	include_once("../include/lib.php");
	require_once("admin_chk.php");
   
   // 접근 가능 등급 표시
   
    if($_mb[mb_level] < 99){ rg_href("./","접근권한이 없습니다."); }

    if ($date1=="") { $date1=date("Y"); }
	if ($date2=="") { $date2=date("m"); }

    $rs_list = new $rs_class($dbcon);
	$rs_list->clear();
	$rs_list->set_table($_table['account']);
	$rs_list->add_where("comm_date1 = $date1 and comm_date2 = $date2");		
			
    /***********************************************************************/
   // 필터 조건에 의한 필터링
	// if($ss[0]){ $rs_list->add_where("chain = $ss[0]"); } 
	 if($student_no>0){ $rs_list->add_where("student_no = $student_no"); } 
	 if($ak_no>0){ $rs_list->add_where("comm_text_no  = '$ak_no'"); } 
	// 검색어로 검색
	if($kw) { $rs_list->add_where("student_name LIKE '%$kw%' escape '".$dbcon->escape_ch."'");} 

	$rs_list->add_order("comm_date ASC");	
	$rs_list->add_order("ac_no ASC");  	
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
    <td background="images/title_bg.gif" style="padding:9pt 0pt 0pt 10pt" valign="top"><font color=#000000><b>입출금 전체내역</b></font></td>
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
	  <select name="date1" class="select">
      <?=rg_html_option($_const[year],"$date1")?> 
	  </select>
      <select name="date2"  class="select">
      <?=rg_html_option($_const[month],"$date2")?>
       </select>&nbsp;&nbsp;&nbsp;<select name="student_no" class="select2"><option >==학생이름==</option>     
 <? 
 	$rs_st = new $rs_class($dbcon);
	$rs_st->clear();
	$rs_st->set_table($_table['regi']);
	$rs_st->add_order("student_name ASC");
	while($R_st=$rs_st->fetch()) {	
	  $Sg_idx   = $R_st[regi_no];
	  $Sg_title = $R_st[student_name];
?>					
	<option value="<?=$Sg_idx?>" <?if($Sg_idx==$student_no) {echo "selected";} ?>><?=$Sg_title?></option>
<? } ?>
 </select>
<select name="ak_no" class="select2"><option>==입출금내역==</option>     
<?     
	$rs_kj = new $rs_class($dbcon);
	$rs_kj->clear();
	$rs_kj->set_table($_table['account_kyejung']);
	//$rs_kj->add_order("ak_no ASC");
	while($R_rs_kj=$rs_kj->fetch()) {			
     $KJ_idx   = $R_rs_kj[kyejung_code];
	 $KJ_title = $R_rs_kj[kyejung_name];
?>					
	<option value="<?=$KJ_idx?>" <?if($KJ_idx==$ak_no) {echo "selected";} ?>><?=$KJ_title?></option>
<?  } ?>
</select>
<INPUT onfocus=this.blur() type=image src="images/bt_order_search.gif" align="absmiddle"></td>
  </tr>
  <tr> 
    <td background="images/search_bg_middle.gif" align="center"><img src=images/icon_line.gif border="0"></td>
  </tr>
<?}?>
  <tr> 
    <td background="images/search_bg_middle.gif" style="padding:0pt 0pt 0pt 15pt"><?if($_mb[mb_level] == 90){?><INPUT onfocus=this.blur() type=image src="images/bt_order_search.gif">&nbsp;&nbsp;&nbsp;<?}?><a href="javascript:open_window('kyejung', 'account_kyejung_list.php', 80, 120, 500, 650, 0, 0, 0, 1, 0);")><img src=images/bank_noto_regi.gif border="0"></a>&nbsp;&nbsp;&nbsp;<?if($_mb[mb_level] >= 90){?><a href="bank_note_exel.php?date1=<?=$date1?>&date2=<?=$date2?>&ss[0]=<?=$ss[0]?>"><img src=images/bank_exel_regi.gif border="0"></a>&nbsp;&nbsp;&nbsp;<a href="javascript:open_window('regi', 'bank_note_print.php?date1=<?=$date1?>&date2=<?=$date2?>&ss[0]=<?=$ss[0]?>', 80, 120, 700, 500, 0, 0, 0, 0, 0);")><img src=images/print_regi.gif border="0"></a>&nbsp;&nbsp;&nbsp;<?}?><a href="javascript:open_window('regi', 'account_regi_form.php?date1=<?=$date1?>&date2=<?=$date2?>', 80, 120, 450, 320, 0, 0, 0, 0, 0);")><img src=images/bank_regi.gif border="0"></a></td>
  </tr>
  <tr> 
    <td><img src="images/search_bg_bottom.gif" width="770" height="16"></td>
  </tr>
</table>
</form>
</div>
<?if($_mb[mb_level] >= 90){?>
<table width="770" border=0 cellpadding="0" cellspacing="0" align=center>
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
<tr bgcolor="#FFFFFF" height="25" align="center">
<td><b><?=$date1?>년 <?=$date2?>월 <?=$chain?> 입출금 내역</b></td>
</tr>

<tr bgcolor="#FFFFFF" height="25" align="right">
<td>수익금액: \<?=number_format($total_tprice)?> (입금액: \<?=number_format($total_aprice)?>/지출액: \<?=number_format($total_bprice)?>)</td>
</tr>
</table>
<table width="770" border="0" cellpadding="0" cellspacing="0" align=center>
  <tr bgcolor="#456285"  height="25" > 
	<td width="25" align="center" class="tt6">NO</td>	
	<td width="40" align="center" class="tt6">삭제</td>   
 	<td width="50" align="center"  class="tt6">등록일</td>   
	<td width="40" align="center" class="tt6">지사</td>
	<td width="120" align="center" class="tt6">입출금내역</td>	
	<td width="100" align="center" class="tt6">입금금액</td>
	<td width="100" align="center" class="tt6">지출금액</td>
	<td width="60" align="center" class="tt6">잔고</td>
	<td width="235" align="center" class="tt6">비고</td>
  </tr>   
    <tr>
    <td bgcolor="#BECCDD" height="1" colspan="4"></td>
  </tr>
  <?
	if($rs_list->num_rows()<1) {
		echo "
	<tr height=\"100\"  bgcolor=\"#FFFFFF\" >
		<td align=\"center\" colspan=\"12\"><B>등록(검색) 된 자료가 없습니다.</td>
	</tr>";
	}
	$rs_list->set_table($_table['account']);		
	while($R=$rs_list->fetch()) {
		$no++;	    
	//$comm_text=substr($R[comm_text_no],0,1);

  //  if($comm_text==1){
 
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
	
 //   }elseif($comm_text==5){	
//	   $com1 = "-";
//	   $com2 = "-";  
//	   $com3 = "-"; 	  
//	   $com4 = "-"; 	  
//	   $com5 = number_format($R[comm]);   

//		$ttt1 = 0;
//		$ttt2 = 0;
//        $ttt3 = 0;
//		$ttt4 = 0;
//		$ttt5 = $R[comm];  	 

//	}else{	 
	 
//	 if($R[in_out_comm]==1){	 
//	   $com1 = "-";
//	   $com2 = "-";  
//	   $com3 = number_format($R[comm]); 	  
//	   $com4 = "-"; 	  
//	   $com5 = "-";   

//		$ttt1 = 0;
//		$ttt2 = 0;
//        $ttt3 = $R[comm];
//		$ttt4 = 0;
//		$ttt5 = 0;  

//	  }elseif($R[in_out_comm]==2){	 
//	   $com1 = "-";
//	   $com2 = "-";  
//	   $com3 = "-"; 	  
//	   $com4 = number_format($R[comm]); 	  
//	   $com5 = "-"; 
	  
//		$ttt1 = 0;
//		$ttt2 = 0;
//        $ttt3 = 0;
//		$ttt4 = $R[comm];
//		$ttt5 = 0;  	  
	  	  
//	  }

	//}

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
  <tr bgcolor="#FFFFFF" height="25">     
	<td align="center" class="tt5"><?=$no?></td>
<td align="center" class="tt5"><a href=account_del_ok.php?no=<?=$R[ac_no]?>&student_no=<?=$R[student_no]?>&comm_text_no=<?=$R[comm_text_no]?>&in_out_comm=<?=$R[in_out_comm]?>&date1=<?=$date1?>&date2=<?=$date2?>><img src=images/sbt_del.gif border="0"></a></td>
	<td align="center" class="tt5"><?=rg_date($R[comm_date],'%y.%m.%d')?></td>
    <td align="center" class="tt5"><?=$_regi['chain'][$R[chain]]?></td>
    <td align="center" class="tt5"><a href="javascript:open_window('regi', 'account_modify_form.php?mode=modify&no=<?=$R[ac_no]?>', 80, 120, 450, 320, 0, 0, 0, 0, 0);")><?if($R[student_no]>0){?><?=$student_name?> <?}?><?=$rowD[kyejung_name]?></a></td>
    <td align="center" class="tt5"><font color="blue"><?=$com1?></font></td>	
    <td align="center" class="tt5"><font color="red"><?=$com2?></font></td>
    <td align="center" class="tt5"><?=number_format($total_ttprice)?></td>
    <td align="center" class="tt5"><?=$R[etc]?></td>    
  </tr>
    <tr>
    <td bgcolor="#BECCDD" height="1" colspan="12"></td>
  </tr>
<?}?>
  <tr bgcolor="#A8C3D8" height="1"> 
    <td colspan="12"></td>
  </tr>
  <tr bgcolor="#FFFFFF" height="25"> 
    <td align="center" colspan="5" class="tt5">합 계</td>
    <td align="center" class="tt5"><font color="blue"><?=number_format($total_tt1)?></font></td>	
    <td align="center" class="tt5"><font color="red"><?=number_format($total_tt2)?></font></td>	
    <td align="center" class="tt5"><?=number_format($total_ttprice)?></td>
    <td align="center"  class="tt5">&nbsp;</td>
  </tr>
    <tr>
    <td bgcolor="#BECCDD" height="2" colspan="12"></td>
  </tr>
</table>
<?}?>
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
  <table border="0" cellpadding="0" cellspacing="0" width="800" align=center>	
	<tr height="30">
      <td class="tt2"><img src=images/icon_text_02.gif>&nbsp;입출금 현황 수정은 [입출금내역]을 클릭하시면 수정하는 창이 뜹니다.</td>
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