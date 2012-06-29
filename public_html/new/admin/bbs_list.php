<?
/* =====================================================
  프로그램명 : 알지보드 V4
  화일명 : 
  작성일 : 
  작성자 : 윤범석 ( http://rgboard.com )
  작성자 E-Mail : master@rgboard.com

  최종수정일 : 
 ===================================================== */
 	include_once("../include/lib.php");
	require_once("admin_chk.php");
	
	$rs_list = new $rs_class($dbcon);
	$rs_list->clear();
	$rs_list->set_table($_table['bbs_cfg']);

	if(is_array($ss)) {
		foreach($ss as $__k => $__v) {
			switch ($__k) {
				/***********************************************************************/
				// 검색어로 검색
				case '0' : 
					if($kw!='' && $__v!='') {
						$ss_kw=$dbcon->escape_string($kw,DB_LIKE);
						switch ($__v) {
							case '1' : $rs_list->add_where("bbs_name LIKE '%$ss_kw%' escape '".$dbcon->escape_ch."'"); break;
							case '2' : $rs_list->add_where("bbs_code LIKE '%$ss_kw%' escape '".$dbcon->escape_ch."'"); break;
							case '3' : $rs_list->add_where("bbs_db LIKE '%$ss_kw%' escape '".$dbcon->escape_ch."'"); break;
							case '4' : $rs_list->add_where("bbs_skin LIKE '%$ss_kw%' escape '".$dbcon->escape_ch."'"); break;
						}
						unset($ss_kw);
					}
					break; 
				/***********************************************************************/
				// 필터 조건에 의한 필터링
				case '1' : // 
					if($__v != '') { $rs_list->add_where("$__v =  gr_num"); } break;
			}
		}
	}

	switch ($ot) {
		case 10 : $rs_list->add_order("bbs_num DESC");		break;
		default : $rs_list->add_order("bbs_num DESC");		break;
	}
	
	$page_info=$rs_list->select_list($page,20,10);

	$MENU_L='m4';	
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
    <td bgcolor="#F7F7F7">게시판목록</td>
  </tr>
</table>
<br>
<table width="100%" cellspacing="0" style="border-collapse:collapse;table-layout:auto">
<form name="search_form" method="get" enctype="multipart/form-data">
	<tr> 
		<td>
그룹 : <select name="ss[1]" onChange="search_form.submit()">
<option value="">=전체=</option>
<?
	$rs->clear();
	$rs->set_table($_table['group']);
?>
<?=rg_html_option_rs($rs,$ss[1],'gr_num','gr_name')?>
</select>
							
검색: 
<select name="ss[0]">
<? $ss_list = array(1=>'이름',2=>'게시판코드',3=>'디비',4=>'스킨'); ?>
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
		<td width="30" >보기</td>
		<td width="55" bgcolor="#F0F0F4" >카테고리</td>
		<td width="40" >번호</td>
		<td>코드</td>
		<td>디비</td>
		<td>그룹</td>
		<td>이름</td>
		<td>스킨</td>
		<td>카테고리</td>
		<td>등록일</td>
		</tr>
<?
	if($rs_list->num_rows()<1) {
		echo "
	<tr height=\"100\">
		<td align=\"center\" colspan=\"12\"><B>등록(검색) 된 자료가 없습니다.</td>
	</tr>";
	}
	
	$rs_group=new $rs_class($dbcon);
	$rs_group->set_table($_table['group']);
	$rs_group->add_field('gr_name');
	
	$no = $page_info['start_no'];
	while($R=$rs_list->fetch()) {
		$no--;
		if($R[gr_level_type]==1)
			$R[gr_level_info]=unserialize($R[gr_level_info]);
		else
			$R[gr_level_info]=$_level_info;
			
		$rs_group->add_where("gr_num=$R[gr_num]");
		$rs_group->fetch('gr_name');
		$rs_group->free_result();
		$rs_group->clear_where();
?>
	<tr height="25">
<?php /*?>		<td align="center"><input type=checkbox name="chk_nums[]" value="<?=$R[mb_num]?>" class=none></td>
<?php */?>		<td align="center"><a href="bbs_edit.php?<?=$p_str?>&page=<?=$page?>&mode=modify&num=<?=$R[bbs_num]?>">수정</a></td>
		<td align="center"><a href="#" onClick="confirm_del('bbs_edit.php?<?=$p_str?>&page=<?=$page?>&mode=delete&num=<?=$R[bbs_num]?>')">삭제</a></td>
		<td align="center"><a href="<?=$_url['bbs']?>list.php?bbs_code=<?=$R[bbs_code]?>" target="_blank">보기</a></td>
		<td align="center"><a href="javascript:void(0)" onClick="window_open('bbs_category.php?bbs_db_num=<?=$R[bbs_db_num]?>','category','scrollbars=yes,width=400,height=500')">카테고리</a></td>
		<td align="center"><?=$no?></td>
		<td align="center"><?=$R[bbs_code]?>		  <br /></td>
		<td align="center"><?=$R[bbs_db]?></td>
		<td align="center"><?=$gr_name?></td>
		<td align="center"><?=$R[bbs_name]?></td>
		<td align="center"><?=$R[bbs_skin]?></td>
		<td align="center"><?=$R[use_category]?></td>
		<td align="center"><?=rg_date($R[reg_date],'%Y-%m-%d')?></td>
		</tr>
<?
}
?>
</table>
</form>
<table width="100%">
	<tr>
		<td width="150">
			<input type="button" value="게시판등록" class="button" onClick="location.href='bbs_edit.php?<?=$p_str?>&page=<?=$page?>'">
<?php /*?>			<input type="button" value="그룹삭제" class="button" onClick="group_del();"><?php */?>
		</td>
		<td align="center">
<?=rg_navi_display($page_info,$_get_param[2]); ?>
		</td>
	</tr>
</table>
<? include("admin.footer.php"); ?>
<? include("_footer.php"); ?>