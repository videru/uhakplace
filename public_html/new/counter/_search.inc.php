<?
/* =====================================================

  ���������� : 
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
	$rs->set_table($_table['prefix'].'counter_search');
	if($type2=='') {
		$rs->add_field("name");
		$rs->add_field("keyword");
		$rs->add_field("unique_hits as counter");
		$rs->add_field("hits as counter2");
		$rs->add_order("unique_hits DESC");
	} else if($type2=='name') {
		$rs->add_field("name");
		$rs->add_field("sum(unique_hits) as counter");
		$rs->add_field("sum(hits) as counter2");
		$rs->group_sql="name";
		$rs->add_order("counter DESC");
	} else if($type2=='keyword') {
		$rs->add_field("keyword");
		$rs->add_field("sum(unique_hits) as counter");
		$rs->add_field("sum(hits) as counter2");
		$rs->group_sql="keyword";
		$rs->add_order("counter DESC");
	}	
	$rs->add_where("yy=$yy");
	$rs->add_where("mm=$mm");

	$i=0;
	while($tmp=$rs->fetch()) {
		$i++;
		if($tmp['counter'] > $max_counter) $max_counter = $tmp['counter'];
		if($tmp['counter2'] > $max_counter2) $max_counter2 = $tmp['counter2'];
		$total_counter += $tmp['counter'];
		$total_counter2 += $tmp['counter2'];
		$data[$i]['keyword']=$tmp['keyword'];
		$data[$i]['name']=$tmp['name'];
		$data[$i]['counter']=$tmp['counter'];
		$data[$i]['counter2']=$tmp['counter2'];
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
<form name="form1">
		<td width="300">
<a href="?type=<?=$type?>&type2=<?=$type2?>&day=<?=date('Y-m',mktime(0,0,0,$mm-1,1,$yy))?>">��</a>
<select name="yy" onchange="location.href='?type=<?=$type?>&type2=<?=$type2?>&day='+form1.yy.value+'-'+form1.mm.value">
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
</select>��
<select name="mm" onchange="location.href='?type=<?=$type?>&type2=<?=$type2?>&day='+form1.yy.value+'-'+form1.mm.value">
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
</select>��
<a href="?type=<?=$type?>&type2=<?=$type2?>&day=<?=date('Y-m',mktime(0,0,0,$mm+1,1,$yy))?>">��</a>
<input type="button" value="���ΰ�ħ" onclick="location.reload()" />
		</td>
</form>
    <td><a href="?type=search"><?=(($type2=='')?'<b>':'')?>[��ü]<?=(($type2=='')?'</b>':'')?></a>  <a href="?type=search&type2=name"><?=(($type2=='name')?'<b>':'')?>[�˻�������]<?=(($type2=='name')?'</b>':'')?></a>  <a href="?type=search&type2=keyword"><?=(($type2=='keyword')?'<b>':'')?>[Ű���庰]<?=(($type2=='keyword')?'</b>':'')?></a></td>
		<td>&nbsp;</td>
	</tr>
</table>

<table width="700" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td>&nbsp;</td>
    <td align="right">
    ���� ( �ִ� : <?=number_format($max_counter)?>, �� : <?=number_format($total_counter)?>),
    Hits ( �ִ� : <?=number_format($max_counter2)?>, �� : <?=number_format($total_counter2)?>)</td>
  </tr>
</table>

<table width="700" border="0" cellspacing="0" cellpadding="0" align="center" class="site_list" style="table-layout:fixed">
  <tr>
<? if($type2!='keyword') { ?>
    <th width="100">����Ʈ</th>
<? } ?>
<? if($type2!='name') { ?>
    <th width="200">�˻���</th>
<? } ?>
    <th width="50"></th>
    <th>�����湮��</th>
    <th width="50"></th>
    <th>Hits</th>
  </tr>
<? 
	foreach($data as $key => $val) {
		$val['graph_per']=($val['graph_per']=='')?'0':$val['graph_per'];
		$val['graph_per2']=($val['graph_per2']=='')?'0':$val['graph_per2'];
?>
  <tr> 
<? if($type2!='keyword') { ?>
    <td align="center"> 
      &nbsp;<?=$val['name']?></td>
<? } ?>
<? if($type2!='name') { ?>
    <td align="center"> 
      &nbsp;<?=$val['keyword']?></td>
<? } ?>
    <td width="100" align="center"><?=number_format($val['counter'])?></td>
    <td><img src="images/g1.gif" width="<?=$val['graph_per']?>%" height="8"><br></td>
    <td width="100" align="center"><?=number_format($val['counter2'])?></td>
    <td><img src="images/g2.gif" width="<?=$val['graph_per2']?>%" height="8"><br></td>
  </tr>
<? 
	}
?>
</table>
