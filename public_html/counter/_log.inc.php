<?
/* =====================================================

  최종수정일 : 
 ===================================================== */
 $url_length=80;
	function open_url($url){
		if(strpos($url,'%')>0) {
		  return urlencode($url);
		} else {
		  return $url;
		}
	}
	
	$rs->clear();
	$rs->set_table($_table['prefix'].'counter_log');
	if($kw!='') {
		$ss_kw=$dbcon->escape_string($kw,DB_LIKE);
		switch($sel) {
			case '1' : $rs->add_where("referrer like '%$ss_kw%' escape '".$dbcon->escape_ch."'"); break;
			case '2' : $rs->add_where("ip like '%$ss_kw%' escape '".$dbcon->escape_ch."'"); break;
			case '3' : $rs->add_where("host like '%$ss_kw%' escape '".$dbcon->escape_ch."'"); break;
			case '4' : $rs->add_where("keyword like '%$ss_kw%' escape '".$dbcon->escape_ch."'"); break;
		}
		unset($ss_kw);
	}
	$rs->add_order("num DESC");
	$page_info=$rs->select_list($page,100,10);
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<form action="?" name="set_date">
<input type="hidden" name="type" value="<?=$type?>">
  <tr>
    <td>
		<select name="sel">
<?
	$key_list=array(1=>'접속경로',2=>'아이피',3=>'호스트',4=>'키워드');
	foreach($key_list as $key => $val) {
		echo "<option value=\"$key\"";
		if($key==$sel) echo " selected ";
		echo ">$val</option>";
	}
?>
		</select>
		<input type="text" name="kw" value="<?=$kw?>">
		<input type="submit">
		</td>
		<td align="right">
		Total : <?=number_format($row_count)?> (<?=number_format($page_info['page'])?>/<?=number_format($page_info['total_page'])?>)
		</td>
  </tr>
</form>
</table>
<script language="JavaScript" type="text/JavaScript">
function ref_open(url)
{
	open(url)
}
</script>
<?=rg_navi_display($page_info,"type=$type&time_start=$time_start&time_end=$time_end&sel=$sel&kw=$kw"); ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="table-layout:fixed" class="site_list">
  <tr> 
    <th width="120"> 일시 </th>
    <th width="110"> 아이피</th>
    <th width="150">키워드</th>
    <th width="40">hits</th>
    <th> 접속경로</th>
    <th width="180">기타정보</th>
  </tr>
  <? 
$mb_function = function_exists('mb_detect_order') && function_exists('iconv');
if($mb_function) {
	$ary[] = "ASCII";
	$ary[] = "EUC-KR";
	$ary[] = "JIS";
	$ary[] = "EUC-JP";
	$ary[] = "UTF-8";
	mb_detect_order($ary);
}	
	while($r=$rs->fetch()) {
?>
  <tr> 
    <td align="center">
      <?=rg_date($r['reg_date'])?>    </td>
    <td width="110" align="center"><?=$r['ip']?>    </td>
    <td><?=$r['keyword']?><br /></td>
    <td align="center"><?=$r['hits']?></td>
    <td nowrap="nowrap"><a href="javascript:ref_open('<?=open_url($r['referrer'])?>')" title="<?=$r['referrer']?>">
  <?
			$tmp=urldecode($r['referrer']);
			if($mb_function) $tmp=iconv(mb_detect_encoding($tmp),"EUC-KR",$tmp);
			echo rg_cut_string($tmp, $url_length, "..");
//			echo mb_detect_encoding($tmp)."$tmp";
			?>
</a><br /></td>
    <td align="center"><?=$r['browser']?>/<?=$r['os']?>/<?=$r['res']?></td>
  </tr>
  <? 
	}
?>
</table>
<?=rg_navi_display($page_info,"type=$type&time_start=$time_start&time_end=$time_end&sel=$sel&kw=$kw"); ?>