<?
/* =====================================================

  최종수정일 : 
 ===================================================== */
   include($_url['counter']."setup.php");			
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
<table width="<?=$width?>" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr height="60">
     <td background="images/counter_main_br.gif" style="padding:9pt 0pt 0pt 10pt" valign="top">오늘 총 히트수:&nbsp;<?=number_format($today_data['hits'])?>&nbsp;&nbsp;오늘 순수 방문자:&nbsp;<?=number_format($today_data['unique_hits'])?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;어제 총 히트수:&nbsp;
        <?=number_format($yesterday_data['hits'])?>&nbsp;&nbsp;어제 순수 방문자:&nbsp;<?=number_format($yesterday_data['unique_hits'])?><br>전체 총 히트수:&nbsp;<?=number_format($total_data['hits'])?>&nbsp;&nbsp;전체 순수 방문자:&nbsp;<?=number_format($total_data['unique_hits'])?></td>
</tr>
</table>