<?
/* =====================================================

  최종수정일 : 
 ===================================================== */
	if($day=='') $day=date('Y');
	$yy=$day;

	if(!$validate->number_only($yy)) exit;

	$data=array();
	$max_counter=0;
	$total_counter=0;
	$max_counter2=0;
	$total_counter2=0;
	
	$rs->clear();
	$rs->set_table($_table['prefix'].'counter_day');
	$rs->add_field("mm");
	$rs->add_field("sum(unique_hits) as counter");
	$rs->add_field("sum(hits) as counter2");
	$rs->add_where("yy=$yy");
	$rs->group_sql="mm";

	while($tmp=$rs->fetch()) {
		if($tmp['counter'] > $max_counter) $max_counter = $tmp['counter'];
		if($tmp['counter2'] > $max_counter2) $max_counter2 = $tmp['counter2'];
		$total_counter += $tmp['counter'];
		$total_counter2 += $tmp['counter2'];
		$data[$tmp['mm']]['counter']=$tmp['counter'];
		$data[$tmp['mm']]['counter2']=$tmp['counter2'];
	}

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
	}
?>
<table width="700" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td>
<form name="form1">
<a href="?type=month&day=<?=date('Y',mktime(0,0,0,1,1,$yy-1))?>">◀</a>
<select name="ym" onchange="location.href='?type=month&day='+form1.ym.value">
<?
for($i=$min_year;$i<=$max_year;$i++) {
	if($i==$min_year)
		$min_month=$min_year_month;
	else
		$min_month=1;

	if($i==$max_year)
		$max_month=$max_year_month;
	else
		$max_month=12;
		
	if($year==$i)
		$selected=" selected";
	else
		$selected="";
?>
<option <?=$selected?> value="<?=$i?>"><?=$i?> 년</option>
<?
}
?>
		</select>
<a href="?type=month&day=<?=date('Y',mktime(0,0,0,1,1,$yy+1))?>">▶</a>
<input type="button" value="새로고침" onclick="location.reload()" />
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
    <th width="50">월</th>
    <th width="50"></th>
    <th>순수방문자</th>
    <th width="50"></th>
    <th>Hits</th>
  </tr>
<? 
	for($i=1;$i<13;$i++) {
		$data[$i][graph_per]=($data[$i][graph_per]=='')?'0':$data[$i][graph_per];
		$data[$i][graph_per2]=($data[$i][graph_per2]=='')?'0':$data[$i][graph_per2];
?>
  <tr> 
    <td align="center"><?=$i?></td>
    <td align="center"><?=number_format($data[$i]['counter'])?></td>
    <td><img src="images/g1.gif" width="<?=$data[$i][graph_per]?>%" height="8" border="0"><br>
    <td align="center"><?=number_format($data[$i]['counter2'])?></td>
    <td><img src="images/g2.gif" width="<?=$data[$i][graph_per2]?>%" height="8" border="0"><br>
    </td>
  </tr>
<? 
	}
?>
</table>