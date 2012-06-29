<?
/* =====================================================

  ���������� : 
 ===================================================== */
	$today = mktime(0,0,0,date('m'),date('d'),date('Y'));
	$yesterday = mktime(0,0,0,date('m'),date('d')-1,date('Y'));
	
	$rs->clear();
	$rs->set_table($_table['prefix'].'counter_day');
	$rs->add_where("reg_date=$today");
	$today_data=$rs->fetch();
	
	$rs->clear();
	$rs->set_table($_table['prefix'].'counter_day');
	$rs->add_where("reg_date=$yesterday");
	$yesterday_data=$rs->fetch();
	
	$rs->clear();
	$rs->set_table($_table['prefix'].'counter_day');
	$rs->add_field("sum(hits) as hits");
	$rs->add_field("sum(unique_hits) as unique_hits");
	$total_data=$rs->fetch();
?>
<br />
<table width="600" border="0" cellpadding="0" cellspacing="0" class="site_content">
  <tr>
    <th width="150" align="right">&middot;&nbsp;���� ���� �湮�� : </th>
    <td width="150" align="right"><?=number_format($today_data['unique_hits'])?></td>
    <th width="150" align="right">��&nbsp;���� �� ��Ʈ�� : </th>
    <td width="150" align="right"><?=number_format($today_data['hits'])?></td>
  </tr>
  <tr>
    <th align="right">&middot;&nbsp;���� ���� �湮�� : </th>
    <td align="right"><?=number_format($yesterday_data['unique_hits'])?></td>
    <th align="right">&middot;&nbsp;���� �� ��Ʈ�� : </th>
    <td align="right"><?=number_format($yesterday_data['hits'])?></td>
  </tr>
  <tr>
    <th align="right">&middot;&nbsp;��ü ���� �湮�� : </th>
    <td align="right"><?=number_format($total_data['unique_hits'])?></td>
    <th align="right">&middot;&nbsp;��ü �� ��Ʈ�� : </th>
    <td align="right"><?=number_format($total_data['hits'])?></td>
  </tr>
</table>