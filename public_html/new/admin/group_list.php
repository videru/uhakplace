<?
/* =====================================================

  최종수정일 : 
 ===================================================== */
	include_once("../include/lib.php");
	require_once("admin_chk.php");
	
	$rs_list = new $rs_class($dbcon);
	$rs_list->clear();
	$rs_list->set_table($_table['group']);

	if(is_array($ss)) {
		foreach($ss as $__k => $__v) {
			switch ($__k) {
				/***********************************************************************/
				// 검색어로 검색
				case '0' : 
					if($kw!='' && $__v!='') {
						$ss_kw=$dbcon->escape_string($kw,DB_LIKE);
						switch ($__v) {
							case '1' : $rs_list->add_where("gr_id LIKE '%$ss_kw%' escape '".$dbcon->escape_ch."'"); break;
							case '2' : $rs_list->add_where("gr_name LIKE '%$ss_kw%' escape '".$dbcon->escape_ch."'"); break;
						}
						unset($ss_kw);
					}
					break; 
				/***********************************************************************/
				// 필터 조건에 의한 필터링
				case '1' : // 상태
					if($__v != '') { $rs_list->add_where("$__v =  gr_state"); } break;
			}
		}
	}

	switch ($ot) {
		case 10 : $rs_list->add_order("gr_num DESC");		break;
		default : $rs_list->add_order("gr_num DESC");		break;
	}
	
	$page_info=$rs_list->select_list($page,20,10);

	$MENU_L='m3';	
?>
<? include("_header.php"); ?>
<? include("admin.header.php"); ?>
<script>
function member_mail(){
	if(!chk_checkbox(list_form,'chk_nums[]',true)){
		alert('한명이상 선택 하세요.');
		return;
	}
	list_form.mode.value='check';
	list_form.action='member_mail.php';
	list_form.submit();
}
function group_del(){
	if(!chk_checkbox(list_form,'chk_nums[]',true)){
		alert('한명이상 선택 하세요.');
		return;
	}
	list_form.mode.value='delete';
	list_form.action='?<?=$p_str?>';
	list_form.submit();
}
</script>
<table border="0" cellspacing="0" cellpadding="0" width="100%" class="site_content">
  <tr>
    <td bgcolor="#F7F7F7">그룹목록</td>
  </tr>
</table>
<br>
<table width="100%" cellspacing="0" style="border-collapse:collapse;table-layout:auto">
<form name="search_form" method="get" enctype="multipart/form-data">
	<tr> 
		<td>
상태 : <select name="ss[1]" onChange="search_form.submit()">
<option value="">=전체=</option>
<?=rg_html_option($_const['group_states'],"$ss[1]")?>
</select>
							
검색: 
<select name="ss[0]">
<? $ss_list = array(1=>'아이디',2=>'이름'); ?>
<?=rg_html_option($ss_list,"$ss[0]")?>
			</select>
			<input name="kw" type="text" id="kw" value="<?=$kw?>" size="14" class="input"> <input type="submit" name="검색" value="검색" class="button"> 
			<input type="button" value="취소" onclick="location.href='?'" class="button">
		</td>
		<td align="right">Total : 
			<?=$page_info['total_rows']?>
			(<?=$page_info['page']?>/<?=$page_info['total_page']?>)</td>
    </tr>
</form>
</table>
<br>
<form name="list_form" method="post" enctype="multipart/form-data" action="?<?=$p_str?>">
<input name="mode" type="hidden" value="">
<table border="0" cellpadding="0" cellspacing="0" width="100%" class="site_list" onmouseover="list_over_color(event,'#FFE6E6',1)" onmouseout='list_out_color(event)'>
	<tr align="center" bgcolor="#F0F0F4">
<?php /*?>		<td width="20"><input type="checkbox" onClick="set_checkbox(list_form,'chk_nums[]',this.checked)" class="none"></td><?php */?>
		<td width="30" >수정</td>
		<td width="30" >삭제</td>
		<td width="40" >번호</td>
		<td>아이디</td>
		<td>이름</td>
		<td>상태</td>
		<td>기본레벨</td>
		<td>레벨기준</td>
		<td>등록일</td>
		<td>등록자</td>
		</tr>
<?
	if($rs_list->num_rows()<1) {
		echo "
	<tr height=\"100\">
		<td align=\"center\" colspan=\"10\"><B>등록(검색) 된 자료가 없습니다.</td>
	</tr>";
	}
	
	$rs_mb=new $rs_class($dbcon);
	$rs_mb->set_table($_table['member']);
	$rs_mb->add_field('mb_id');
	
	$no = $page_info['start_no'];
	while($R=$rs_list->fetch()) {
		$no--;
		if($R[gr_level_type]==1)
			$R[gr_level_info]=unserialize($R[gr_level_info]);
		else
			$R[gr_level_info]=$_level_info;

		$rs_mb->add_where("mb_num=$R[gr_reg_mb]");
		$rs_mb->fetch('gr_reg_id');
		$rs_mb->free_result();
		$rs_mb->clear_where();
?>
	<tr height="25">
<?php /*?>		<td align="center"><input type=checkbox name="chk_nums[]" value="<?=$R[mb_num]?>" class=none></td>
<?php */?>		<td align="center"><a href="group_edit.php?<?=$p_str?>&page=<?=$page?>&mode=modify&num=<?=$R[gr_num]?>">수정</a></td>
		<td align="center"><a href="#" onClick="confirm_del('group_edit.php?<?=$p_str?>&page=<?=$page?>&mode=delete&num=<?=$R[gr_num]?>')">삭제</a></td>
		<td align="center"><?=$no?></td>
		<td align="center"><?=$R[gr_id]?>		  <br /></td>
		<td align="center"><?=$R[gr_name]?></td>
		<td align="center"><?=$_const['group_states'][$R[gr_state]]?></td>
		<td align="center"><?=$R[gr_level_info][$R[gr_default_level]]?></td>
		<td align="center"><?=$_const['group_level_type'][$R[gr_level_type]]?></td>
		<td align="center"><?=rg_date($R[gr_reg_date],'%Y-%m-%d')?></td>
		<td align="center"><?=$gr_reg_id?></td>
		</tr>
<?
}
?>
</table>
</form>
<table width="100%">
	<tr>
		<td width="150">
			<input type="button" value="그룹등록" class="button" onClick="location.href='group_edit.php?<?=$p_str?>&page=<?=$page?>'">
<?php /*?>			<input type="button" value="그룹삭제" class="button" onClick="group_del();"><?php */?>
		</td>
		<td align="center">
<?=rg_navi_display($page_info,$_get_param[2]); ?>
		</td>
	</tr>
</table>
<? include("admin.footer.php"); ?>
<? include("_footer.php"); ?>