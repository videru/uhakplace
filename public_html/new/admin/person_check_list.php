<?
include_once("../include/lib.php");
require_once("admin_chk.php");
include("setup.php");
//오늘 날짜
$thisyear  = date('Y');  
$thismonth = date('n');  
$today     = date('j');  

//$year, $month 값이 없으면 현재 날짜
if (!$year) $year = $thisyear;
if (!$month) $month = $thismonth;

$datelike=date('Y-m-',mktime(0,0,0,$month,1,$year));
$start_where=mktime(0,0,0,$month,1,$year);
$end_where=mktime(0,0,0,$month,31,$year);

$rs_list = new $rs_class($dbcon);
$rs_list->clear();
$rs_list->set_table($_table['working']);
$rs_list->add_where("regi_date>='$start_where'");
$rs_list->add_where("regi_date<='$end_where'");
$rs_list->add_order("c_no ASC"); 

for($s=0; $data[$s]=$rs_list->fetch(); $s++);

function skipoffset($sno,$eno) {
  for ($i=$sno; $i <= $eno; $i++) {
   ?><td></td><?
  }
}

//날짜의 범위 체크
if ($year > 9999 || $year < 0) rg_href('',"연도는 0~9999년만 가능합니다.",'back'); 
if ($month > 12 || $month < 0) rg_href('',"달은 1~12만 가능합니다.",'back'); 

$maxdate = date(t, mktime(0, 0, 0, $month, 1, $year));

//전월, 차월 이동링크
$pmonth = $month;
$prevmonth = $month - 1;
$nextmonth = $month + 1;
$prevyear = $year ;
$nextyear = $year ;
$prevyeary = $year - 1;
$nextyeary = $year + 1;
if ($month == 1) {
  $prevmonth = 12;
  $prevyear = $year -1;
} 
elseif ($month == 12) {
  $nextmonth = 1;
  $nextyear = $year +1;
}

//1일의 요일
$fors = date('w',mktime(0,0,0,$month,1,$year));
$fore = date('w',mktime(0,0,0,$month,$maxdate,$year));
?>
<? include("_header.php"); ?>
<? include("admin.header.php"); ?>
<table border="0" cellpadding="0" cellspacing="0" width="800" align="center">
  <tr height="40">
    <td background="images/title_bg.gif" style="padding:9pt 0pt 0pt 10pt" valign="top"><font color=#000000><b>업무현황</b></font></td>
  </tr>
</table>
<br>
<style>
A.green:link, A.green:visited, A.green:active   { color:#69A80F; text-decoration:none;}
A.green:hover   { color:#69A80F; text-decoration:none;}
</style>
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


<TABLE cellspacing="0" cellpadding="0" border="0" width="<?=$width?>"  align="center" background="images/bg_table.gif">
	<tr>
	  <td>
<TABLE cellspacing="0" cellpadding="0" border="0" width="100%">
	<tr bgcolor="#FFFFFF" align="center" valign="top">

	  <td><? include ("work_now_schedule.php");?></td>

	  </tr>
</table>
</td>
	  </tr>
</table>
<BR />
<TABLE cellspacing="0" cellpadding="0" border="0" width="<?=$width?>"  align="center">
<tr>
<td width="160">
			<a href="person_check_list.php?year=<?=$prevyeary?>&month=<?=$pmonth?>" title="<?=$prevyeary?>년 <?=$pmonth?>월 보기" style="font-size:11px;" class="green">◀[이전해]</a> 
			<span  style="font-size:13px;font-weight:bold;"><?=$year?>년</span> 
			<a href="person_check_list.php?year=<?=$nextyeary?>&month=<?=$pmonth?>" title="<?=$nextyeary?>년 <?=$pmonth?>월 보기" style="font-size:11px;" class="green">[다음해]▶</a> 
			</td>
			<td><form name="cal_month_form" action="?" method="get" enctype="multipart/form-data">
			<?=$_post_param[0]?>
			<input type="hidden" name="year" value="<?=$year?>">
			<? 
			for($m=1; $m<=12; $m++) {
			 $array_month[$m]=$m.'월';
			}
			?>
			<select name="month" onChange="cal_month_form.submit()">
			<?=rg_html_option($array_month,"$month")?>
			</select>
			</form></td>	
			</tr>
			</table>
<form name="list_form" method="post" enctype="multipart/form-data" action="?">
<?=$_post_param[3]?>
<input name="mode" type="hidden" value="">
<TABLE cellspacing="0" cellpadding="0" border="0"  width="<?=$width?>"  align="center">
	<tr>
	  <td valign="top">
				  <table cellpadding="0" cellspacing="1" border="0" bgcolor="<?=$table_line?>" width="100%">
				    <tr bgcolor="<?=$table_color?>" height="20" align="center" style="font-weight:bold;font-family:tahoma;">
					  <td style="color:<?=$suncor?>">SUN</td>
					  <td style="color:FFFFFF">MON</td>
					  <td style="color:FFFFFF">TUE</td>
					  <td style="color:FFFFFF">WED</td>
					  <td style="color:FFFFFF">THU</td>
					  <td style="color:FFFFFF">FRI</td>
					  <td style="color:<?=$satcor?>">SAT</td>
					</tr>
					<tr bgcolor="#ffffff">
<?
	skipoffset(1,$fors); 
	for($day=1; $day <= $maxdate; $day++) {
	$day_no=$day+0;
	$book=mktime(0, 0, 0, $month, $day, $year);
    $offset = date('w',$book);

	if($offset == 0)	 {
		$bgcolor=$suncor;
		$fontcolor=$sunfcor;
	} elseif($offset == 6) {
		$bgcolor=$satcor;
		$fontcolor=$satfcor;
	} else {
		$bgcolor=$daycor;
		$fontcolor=$dayfcor;
	}

//오늘일 경우 셀 디자인 표시
if($day==$today && $month==$thismonth && $year==$thisyear) $today_bg=" bgcolor='#FFFFDD'";
else $today_bg='';
?>
					<td valign="top" height="<?=$height?>"<?=$today_bg?>>
						<table cellpadding="2" cellspacing="0" border="0" width="100%" style="table-layout:fixed;">
						  <tr>
						    <td nowrap valign="top" >
<?
	//공휴일, 기념일 처리
	$h_m = sprintf("%02d",$month);
	$h_d = sprintf("%02d",$day);
	$h_day=$h_m.$h_d;
	for($h=0;sizeof($holiday_arr)>$h;$h++){
		if($holiday_arr[$h] ==$h_day) {
			$bgcolor=$suncor; 
			$fontcolor=$sunfcor; 
			echo "<font color={$fontcolor}>$holiname_arr[$h]</font>";
		} 
	}

		for($h=0;sizeof($memorialday_arr)>$h;$h++){
		if($memorialday_arr[$h] ==$h_day) {
			echo "<font color={$satfcor}>$memorialname_arr[$h]</font>";
		} 
	}
	//음력처리
	$myarray = soltolun($year,$month,$day);
	$m_m = sprintf("%02d",$myarray[month]);
	$m_d = sprintf("%02d",$myarray[day]);
	$m_day=$m_m.$m_d;
	for($h=0;sizeof($moonday_arr)>$h;$h++){
		if($moonday_arr[$h] ==$m_day) {
			$bgcolor=$suncor; 
			$fontcolor=$sunfcor; 
			echo "<font color={$fontcolor}>$moonname_arr[$h]</font>";
		} 
	}
	if ($myarray[day]==1 || $myarray[day]==5 || $myarray[day]==15 || $myarray[day]==20 || $myarray[day]==25)		echo " <span style='font-size:8pt;color:#999'>($myarray[month].$myarray[day]$myarray[leap])</span>";
?>
</td>
							<td align="right" valign="top" width="<?=$width2?>" bgcolor="<?=$bgcolor?>" style="color:<?=$fontcolor?>">
								<a href="javascript:open_window('regi', 'today_work_edit.php?book=<?=$book?>', 80, 120, 550, 400, 0, 0, 0, 0, 0);")>
<u><?=$day?>
</u></a>&nbsp;</td>
						  </tr>

<?
	for($s=0;$s<sizeof($data);$s++)	{
		
     if($data[$s]['regi_date']==$book)	{//일정이 있다면..

		$c_no=$data[$s]['c_no'];

        $m_no =$data[$s]['consultant'];
?>

		  <tr>
			 <td colspan="2">
				<table cellspacing="1" cellpadding="1" border="0" width="100%" bgcolor="#F7A440">				
		          <tr bgcolor="#FFEBD2" >
			        <td>
					  <table cellspacing="0" cellpadding="0" border="0" width="100%">				
		                <tr>
			              <td ><? 	
	    $rs_mb = new $rs_class($dbcon);
        $rs_mb->clear();
		$rs_mb->set_table($_table['member']);
		$rs_mb->add_where("mb_num=$m_no");
		$rs_mb->select();	
	
	    $R=$rs_mb->fetch();
	    $Sg_name = $R[mb_name];
?><?if($_mb['mb_level'] == 90){?><a href="javascript:open_window('regi', 'person_check_s_view.php?c_no=<?=$data[$s][c_no]?>&mode=modify', 550, 500, 650, 460, 0, 0, 0, 1, 0);")><font class="tt3"><?=$Sg_name?>(<?=rg_date($data[$s]['check_time'], '%H:%M')?>/<?=rg_date($data[$s]['leave_time'], '%H:%M')?>)</font></a><?}else{?><font class="tt3"><?=$Sg_name?>
(<?=rg_date($data[$s]['check_time'], '%H:%M')?>/<?=rg_date($data[$s]['leave_time'], '%H:%M')?>)</font></a><?}?>
			              </td>			
		                </tr>
		              </table> 
			        </td>			
		         </tr>
		      </table> 
			</td>			
		 </tr>

<?  }
	
	}
?>

		  <tr>
			 <td colspan="2" class="tt1">


                                   <?
								//디비 연결
								$now=mktime(0,0,0,$today_month,$today_day,$today_year);
								$cal_list = new $rs_class($dbcon);						
								$cal_list->clear();
								$cal_list->set_table($_table['today_work']);
								$cal_list->add_where("regi_date='$book'");
								$cal_list->add_order("c_no ASC"); 
										
								if($cal_list->num_rows()<1) { 
								?>					
							   &nbsp;
								<?						
								 } else {
								// 오늘에 자료가 있을 경우 표시
								while($cal=$cal_list->fetch()) {
									$c_no=$cal['c_no'];						
									$regi_date=$cal['regi_date'];																			
									  $title=rg_conv_text($cal['today_work']);

							   	?>	
                                  <a href="javascript:open_window('regi', 'today_work_edit.php?book=<?=$regi_date?>', 80, 120, 550, 400, 0, 0, 0, 0, 0);")><font class="tt4"><?=$title?></font></a><br>
								<?	
									}
								}
								?>
			              </td>

		         </tr>
						
						</table>
					</td>
<?
  if ($offset == 6 && $day!=$maxdate) {
    echo "</tr> \n";
    echo "<tr bgcolor='#FFFFFF'> \n";
    }
}

if ($offset != 6) {
  skipoffset($fore,5);
  echo "</tr> \n";
}
?>
</TABLE>
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
</form>
	<table width="<?=$width?>" border="0" cellpadding="0" cellspacing="0" align="center">
				<tr>
					<td>
<? if($_bbs_auth['write']) { ?>
					<img src="<?=$skin_url?>images/write.gif" onclick="location.href='write.php?<?=$_get_param[3]?>'" style="cursor:pointer" align="absmiddle">
<? } ?>
<? if($_bbs_auth['admin']) { ?>
<script>
function board_manager(){
	if(!chk_checkbox(list_form,'chk_nums[]',true)){
		alert('한개이상 선택 하세요.');
		return;
	}
	window_open('', "board_manager", 'scrollbars=no,width=355,height=200');
	document.list_form.action = '<?=$_url['bbs']?>board_manager.php';
	document.list_form.target='board_manager';
	document.list_form.submit();
}
</script>
					<img src="<?=$skin_url?>images/bbs_admin.gif" onclick="board_manager();" style="cursor:pointer" align="absmiddle">
<? } ?>
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