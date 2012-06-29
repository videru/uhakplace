<?
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

$rs_list->clear();
$rs_list->set_table($_table['bbs_body']);
$rs_list->add_where("bbs_db_num = '$bbs_db_num'");
$rs_list->add_where("bd_ext5>='$start_where'");
$rs_list->add_where("bd_ext5<='$end_where'");
if($ss['cat']) $rs_list->add_where("cat_num = {$ss['cat']}");
$rs_list->add_order("bd_num ASC"); 

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
<style>
A.green:link, A.green:visited, A.green:active   { color:#69A80F; text-decoration:none;}
A.green:hover   { color:#69A80F; text-decoration:none;}
</style>

<div style="height:52px"></div><!-- 상단 div와 분리 -->

<table width="980" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="223" valign="top"><embed src="../n_img/left_06.swf" width="223" height="400"></embed></td>
    <td width="37">&nbsp;</td>
    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
       <tr>
        <td><img src="<?
        switch($bbs_code)
        {
        	case "jw_notice":echo"../n_img/6_1.jpg";
        	break;
        	case "jw_ot":echo "../n_img/6_2.jpg";
        	break;
        	case "jw_yensu":echo "../n_img/6_4.jpg";
        	break;
        }
        ?>" width="720" height="250" /></td>
      </tr>
<tr>
 <td>
 <!-- 게시판 내용 -->
<TABLE cellspacing="0" cellpadding="5" border="0" align="center" width="<?=$width?>" background="<?=$skin_url?>images/bg_table.gif">
	<tr>
	  <td>
<TABLE cellspacing="0" cellpadding="10" border="0" align="center" width="100%">
	<tr bgcolor="#FFFFFF" align="center" valign="top">
	  <td width="28%"><? include ($skin_url."prev_month.php");?></td>
	  <td><? include ($skin_url."now_schedule.php");?></td>
	  <td width="28%"><? include ($skin_url."next_month.php");?></td>
	  </tr>
</table>
</td>
	  </tr>
</table>
<BR />
<TABLE cellspacing="0" cellpadding="5" border="0" width="<?=$width?>">
<tr>
<?
if($_bbs_auth['cart']) { 
	?>	<td width="20"><input type="checkbox" onClick="set_checkbox(list_form,'chk_nums[]',this.checked)" class="none"></td>
<? } ?><td width="80">
			<a href="list.php?bbs_code=<?=$bbs_code?>&year=<?=$prevyeary?>&month=<?=$pmonth?>" title="<?=$prevyeary?>년 <?=$pmonth?>월 보기" style="font-size:11px;" class="green">◀</a> 
			<span  style="font-size:13px;font-weight:bold;"><?=$year?>년</span> 
			<a href="list.php?bbs_code=<?=$bbs_code?>&year=<?=$nextyeary?>&month=<?=$pmonth?>" title="<?=$nextyeary?>년 <?=$pmonth?>월 보기" style="font-size:11px;" class="green">▶</a> 
			</td>
			<td>
			<form name="cal_month_form" action="?" method="get" enctype="multipart/form-data">
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
			</form>
</td>
			<? if($_bbs_info['use_category']) { ?><td align="right">
				<form name="category_form" action="?" method="get" enctype="multipart/form-data">
				<?=$_post_param[0]?>
					<img src="<?=$skin_url?>images/category.gif" align="absmiddle">
				   <select name="ss[cat]" onChange="document.category_form.submit();">
					<option value="">=전체=</option>
					<?=rg_html_option($_category_info,$ss['cat'],'cat_num','cat_name')?>
					</select>
				</form>
			</td>
			<? } ?>			
			</tr>
			</table>
<form name="list_form" method="post" enctype="multipart/form-data" action="?">
<?=$_post_param[3]?>
<input name="mode" type="hidden" value="">
<TABLE cellspacing="0" cellpadding="0" border="0"  align="center" width="<?=$width?>">
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
						    <td nowrap>
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
							<td align="right" width="<?=$width2?>" bgcolor="<?=$bgcolor?>" style="color:<?=$fontcolor?>">
								<? if($_bbs_auth['write']) { ?><a href="write.php?<?=$_get_param[3]?>&book=<?=$book?>"><?}?>
								<?=$day?><?=($_bbs_auth['write'])?'</a>':''?>&nbsp;
							</td>
						  </tr>

<?
	for($s=0;$s<sizeof($data);$s++)	{
		include($_skin_list_main);
	}
?>
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
</form>
<br />
	<table width="<?=$width?>" border="0" cellpadding="0" cellspacing="0">
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
			
			</td>
</tr>
</table>
</td>
</tr>
</table>