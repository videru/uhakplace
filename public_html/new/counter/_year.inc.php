<?
/* =====================================================

  최종수정일 : 
 ===================================================== */
	$data=array();
	$max_counter=0;
	$total_counter=0;
	$max_counter2=0;
	$total_counter2=0;
	
	$rs->clear();
	$rs->set_table($_table['prefix'].'counter_day');
	$rs->add_field("yy");
	$rs->add_field("sum(unique_hits) as counter");
	$rs->add_field("sum(hits) as counter2");
	$rs->group_sql="yy";
	
	while($tmp=$rs->fetch()) {
		if($tmp['counter'] > $max_counter) $max_counter = $tmp['counter'];
		if($tmp['counter2'] > $max_counter2) $max_counter2 = $tmp['counter2'];
		$total_counter += $tmp['counter'];
		$total_counter2 += $tmp['counter2'];
		$data[$tmp['yy']]['counter']=$tmp['counter'];
		$data[$tmp['yy']]['counter2']=$tmp['counter2'];
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
    <td>&nbsp;</td>
    <td align="right">
    순수 ( 최대 : <?=number_format($max_counter)?>, 총 : <?=number_format($total_counter)?>),
    Hits ( 최대 : <?=number_format($max_counter2)?>, 총 : <?=number_format($total_counter2)?>)</td>
  </tr>
</table>

<table width="700" border="0" cellspacing="0" cellpadding="0" align="center" class="site_list" style="table-layout:fixed">
  <tr>
    <th width="50">년도</th>
    <th width="50"></th>
    <th>순수방문자</th>
    <th width="50"></th>
    <th>Hits</th>
  </tr>
<? 
	foreach($data as $i => $val) {
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