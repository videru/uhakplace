<?
/* =====================================================

  최종수정일 : 
 ===================================================== */
	$data=array();
	
	if($day=='') $day=date('Y-m');
	list($yy,$mm)=explode('-',$day);
	
	if(!$validate->number_only($yy)) exit;
	if(!$validate->number_only($mm)) exit;
	
	$max_counter=0;
	$total_counter=0;
	$max_counter2=0;
	$total_counter2=0;

	$rs->clear();
	$rs->set_table($_table['prefix'].'counter_etc');
	$rs->add_field("name");
	$rs->add_field("unique_hits as counter");
	$rs->add_field("hits as counter2");
	if(DB_TYPE=='cubrid' || DB_TYPE=='oracle')
		$rs->add_where("\"type\"='".$dbcon->escape_string($type)."'");
	else
		$rs->add_where("type='".$dbcon->escape_string($type)."'");
	$rs->add_where("yy=$yy");
	$rs->add_where("mm=$mm");
	$rs->add_order("unique_hits DESC");

	while($tmp=$rs->fetch()) {
		if($tmp['counter'] > $max_counter) $max_counter = $tmp['counter'];
		if($tmp['counter2'] > $max_counter2) $max_counter2 = $tmp['counter2'];
		$total_counter += $tmp['counter'];
		$total_counter2 += $tmp['counter2'];
		$data[$tmp['name']]['name']=$tmp['name'];
		$data[$tmp['name']]['counter']=$tmp['counter'];
		$data[$tmp['name']]['counter2']=$tmp['counter2'];
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
<a href="?type=<?=$type?>&day=<?=date('Y-m',mktime(0,0,0,$mm-1,1,$yy))?>">◀</a>
<select name="yy" onchange="location.href='?type=<?=$type?>&day='+form1.yy.value+'-'+form1.mm.value">
<?
if($min_year>$yy) $min_year=$yy;
if($max_year<$yy) $max_year=$yy;
for($i=$min_year;$i<=$max_year;$i++) {
	if($yy==$i)
		$selected=" selected";
	else
		$selected="";
?>
  <option <?=$selected?> value="<?=$i?>"><?=$i?></option>
<?
}
?>
</select>년
<select name="mm" onchange="location.href='?type=<?=$type?>&day='+form1.yy.value+'-'+form1.mm.value">
<?
for($i=1;$i<=12;$i++) {
	if($mm==$i)
		$selected=" selected";
	else
		$selected="";
?>
  <option <?=$selected?> value="<?=$i?>"><?=$i?></option>
<?
}
?>
</select>월
<a href="?type=<?=$type?>&day=<?=date('Y-m',mktime(0,0,0,$mm+1,1,$yy))?>">▶</a>
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
    <th width="150">
<?
	switch($type) {
		case 'br' : echo '브라우저'; break;
		case 'os' : echo '운영체제'; break;
		case 'res' : echo '해상도'; break;
		case 'br' : echo '브라우저'; break;
	}
?>
		</th>
    <th width="50"></th>
    <th>순수방문자</th>
    <th width="50"></th>
    <th>Hits</th>
  </tr>
<? 
	foreach($data as $key => $val) {
		$val['graph_per']=($val['graph_per']=='')?'0':$val['graph_per'];
		$val['graph_per2']=($val['graph_per2']=='')?'0':$val['graph_per2'];
?>
  <tr> 
    <td align="center"> 
      &nbsp;<?=$val['name']?></td>
    <td align="center"><?=number_format($val['counter'])?></td>
    <td><img src="images/g1.gif" width="<?=$val['graph_per']?>%" height="8"><br></td>
    <td align="center"><?=number_format($val['counter2'])?></td>
    <td><img src="images/g2.gif" width="<?=$val['graph_per2']?>%" height="8"><br></td>
  </tr>
<? 
	}
?>
</table>