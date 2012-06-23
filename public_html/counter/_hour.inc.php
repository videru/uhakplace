<?
/* =====================================================
  최종수정일 : 
 ===================================================== */
	if($day=='') $day=date('Y-m-d');
	list($yy,$mm,$dd)=explode('-',$day);

	if(!$validate->number_only($yy)) exit;
	if(!$validate->number_only($mm)) exit;
	if(!$validate->number_only($dd)) exit;

	$data=array();
	$max_counter=0;
	$total_counter=0;
	$max_counter2=0;
	$total_counter2=0;
	
	$rs->clear();
	$rs->set_table($_table['prefix'].'counter_day');
	$rs->add_where("yy=$yy");
	$rs->add_where("mm=$mm");
	$rs->add_where("dd=$dd");
	$R=$rs->fetch();
	
	for($i=0;$i<24;$i++) {
		if($R['uhh'.$i] > $max_counter) $max_counter = $R['uhh'.$i];
		if($R['hh'.$i] > $max_counter2) $max_counter2 = $R['hh'.$i];
		$data[$i]['counter']=$R['uhh'.$i];
		$data[$i]['counter2']=$R['hh'.$i];
	}
		
	$total_counter+=$R['unique_hits'];
	$total_counter2+=$R['hits'];
	
	foreach($data as $key => $val) {
		if($data[$key][counter]>0) {
			$data[$key][count_per] = number_format($data[$key][counter]/$total_counter*100,2,'.','');
			$data[$key][graph_per] = number_format($data[$key][counter]/$max_counter*90,0,'.','');
		} else {
			$data[$key][count_per] = 0;
			$data[$key][graph_per] = 0;
		}
		if($data[$key][counter2]>0) {
			$data[$key][count_per2] = number_format($data[$key][counter2]/$total_counter2*100,2,'.','');
			$data[$key][graph_per2] = number_format($data[$key][counter2]/$max_counter2*90,0,'.','');
		} else {
			$data[$key][count_per2] = 0;
			$data[$key][graph_per2] = 0;
		}
//		$item_list[$key][vit_count]=number_format($item_list[$key][vit_count]);
	}
?>
<table width="700" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td>
<form name="form1">
<input type="hidden" name="type" value="hour" />
<a href="?type=hour&day=<?=date('Y-m-d',mktime(0,0,0,$mm,$dd-1,$yy))?>">◀</a>
<input name="day" type="text" id="iday" value="<?=$day?>" size="10" maxlength="10" onfocus="new CalendarFrame.Calendar(this)" readonly class="input">
<a href="?type=hour&day=<?=date('Y-m-d',mktime(0,0,0,$mm,$dd+1,$yy))?>">▶</a>
<input type="submit" value="보기" class="button" />
<input type="button" value="새로고침" onclick="location.reload()" class="button" />
</form>
		</td>
	</tr>
</table>

<table width="700" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td>&nbsp;</td>
    <td align="right">
    순수 ( 최대 : <?=number_format($max_counter)?>, 총 : <?=number_format($total_counter)?>),
    Hits ( 최대 : <?=number_format($max_counter2)?>, 총 : <?=number_format($total_counter2)?>)</td>
  </tr>
</table>
<table width="700" border="0" cellspacing="0" cellpadding="0" align="center" class="site_list" style="table-layout:fixed">
  <tr>
    <th width="50" align="right">시간</th>
    <th width="50"></th>
    <th>순수방문자</th>
    <th width="50"></th>
    <th>Hits</th>
  </tr>
<? 
	for($i=0;$i<24;$i++) {
?>
  <tr> 
    <td align="center"><?=$i?>~<?=($i+1)?></td>
    <td align="center"><?=number_format($data[$i]['counter'])?></td>
    <td><img src="images/g1.gif" width="<?=$data[$i][graph_per]?>%" height="8" /><br /></td>
    <td align="center"><?=number_format($data[$i]['counter2'])?></td>
    <td><img src="images/g2.gif" width="<?=$data[$i][graph_per2]?>%" height="8"><br></td>
  </tr>
<? 
	}
?>
</table>
<script language=javascript>
	function submit_form() {
		form1.submit()
	}
	ret_function=submit_form;
	createLayer('Calendar');
	changeCal(<?=$mm?>,<?=$yy?>)	
	hide();
</script>