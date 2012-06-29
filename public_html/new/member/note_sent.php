<?
/* =====================================================

  최종수정일 : 
 ===================================================== */
	include_once("../include/lib.php");
	
	if(!$_mb)
		rg_href($_url['member'].'login.php');
		
	if($mode=='delete' && $_SERVER['REQUEST_METHOD']=='POST') {
		$rs->clear();
		$rs->set_table($_table['note']);
		$rs->add_where("mb_num={$_mb['mb_num']}");
		if(is_array($_POST['chk_nums'])) {
			$chk_nums=$_POST['chk_nums'];
	    rg_array_recursive_function($chk_nums,'intval');
			$rs->add_where("nt_num IN (". implode("','",$chk_nums) .")");
			$rs->delete();
			$rs->commit();
		} else if($num) {
			$num=intval($num);
			if($num) {
				$rs->add_where("nt_num=$num");
				$rs->delete();
				$rs->commit();
			}
		}
		rg_href('?');
	}

	$rs_list = new $rs_class($dbcon);
	$rs_list->clear();
	$rs_list->set_table($_table['note']);
	$rs_list->add_where("mb_num={$_mb['mb_num']}");
	$rs_list->add_where("sent_mb_num={$_mb['mb_num']}");
	$rs_list->add_where("nt_type=1");
	$rs_list->add_where("nt_save=0");
	$rs_list->add_order("nt_num DESC");
	$page_info=$rs_list->select_list($page,20,10);
?>
<? include_once($_path['member'].'_header.php'); ?>
<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td>
		<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td height="3" bgcolor="#54A8BA"><img width="1" height="1"></td>
			</tr>
			<tr>
				<td height="28" bgcolor="#F4FAFB">&nbsp;&nbsp;보낸쪽지함</td>
			</tr>
			<tr>
				<td height="1" bgcolor="#54A8BA"><img width="1" height="1"></td>
			</tr>
		</table>
		<form name="list_form" method="post" enctype="multipart/form-data" action="?">
		<input name="mode" type="hidden" value="">
		<table border="0" cellpadding="0" cellspacing="0" width="100%" onmouseover="list_over_color(event,'#FFE6E6',1)" onmouseout='list_out_color(event)' class="site_list">
			<tr align="center">
				<th width="20"><input type="checkbox" onClick="set_checkbox(list_form,'chk_nums[]',this.checked)" class="none"></th>
				<th width="40" >번호</th>
				<th width="120">받는이</th>
				<th>내용</th>
				<th width="100">확인시간</th>
				<th width="100">보낸시간</th>
				</tr>
<?
	$rs_mb=new $rs_class($dbcon);
	$rs_mb->set_table($_table['member']);
	$rs_mb->add_field('mb_id');
	$rs_mb->add_field('mb_nick');
	
	$no = $page_info['start_no'];
	if(isset($bd_num)) $o_bd_num=$bd_num;
	while($data=$rs_list->fetch()) {
		$no--;
		extract($data);
		$nt_content=rg_cut_string($nt_content,40);
		$nt_content = rg_get_text($nt_content);
	
		$rs_mb->add_where("mb_num={$data['recv_mb_num']}");
		$rs_mb->fetch('nt_mb_id,nt_mb_nick');
		$rs_mb->free_result();
		$rs_mb->clear_where();
		
		$nt_sent_date=rg_date($nt_sent_date,'%Y-%m-%d %H:%M'); // 날자형식지정
		if($nt_recv_date==0) {
			$nt_recv_date='확인전';
		} else {
			$nt_recv_date=rg_date($nt_recv_date,'%Y-%m-%d %H:%M'); // 날자형식지정
		}
?>
			<tr height="25">
				<td align="center"><input type=checkbox name="chk_nums[]" value="<?=$nt_num?>" class=none></td>
				<td align="center"><?=$no?></td>
				<td align="center"><?=$nt_mb_id?>(<?=$nt_mb_nick?>)</td>
				<td><a href="javascript:note_view('<?=$_url['member']?>','sent','<?=$nt_num?>')"><?=rg_get_text($nt_content)?></a></td>
				<td align="center"><?=$nt_recv_date?></td>
				<td align="center"><?=$nt_sent_date?></td>
				</tr>
		<?
			}
		?>
		</table>
		</form>
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td align="center">
		<?=rg_navi_display($page_info,$_get_param[2]); ?>
				</td>
			</tr>
			<tr>
				<td>
<script>
function note_del(){
	if(!chk_checkbox(list_form,'chk_nums[]',true)){
		alert('한개이상 선택 하세요.');
		return;
	}
	if(!confirm('확실합니까?')){
		return;
	}
	list_form.mode.value='delete';
	list_form.action='?<?=$p_str?>';
	list_form.submit();
}
</script>
					<input name="button" type="button" class="button" onClick="note_del();" value="쪽지삭제">
				</td>
			</tr>
		</table>
		</td>
	</tr>
</table>
<? include_once($_path['member'].'_footer.php'); ?>
