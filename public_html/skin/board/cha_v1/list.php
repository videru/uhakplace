<? if (!defined('RGBOARD_VERSION')) exit; ?>
<table width="100%" cellspacing="0" border="0" cellpadding="0">
<form name="category_form" action="?" method="get" enctype="multipart/form-data">
<?=$_post_param[0]?>
	<tr style="padding-bottom:5px;"> 
		<td>
<? if($_bbs_info['use_category']) { ?>
<img src="<?=$skin_url?>images/category.gif" align="absmiddle">
   <select name="ss[cat]" onChange="document.category_form.submit();">
<option value="">=전체=</option>
<?=rg_html_option($_category_info,$ss['cat'],'cat_num','cat_name')?>
</select>&nbsp;&nbsp;
<? } ?>
		</td>
		<td align="right">Total : 
			<?=$page_info['total_rows']?>
			(<?=$page_info['page']?>/<?=$page_info['total_page']?>)</td>
    </tr>
</form>
</table>
<form name="list_form" method="post" enctype="multipart/form-data" action="?">
<?=$_post_param[3]?>
<input name="mode" type="hidden" value="">
<table border="0" cellpadding="0" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" onmouseover="list_over_color(event,'#FFFFDD',1)" onmouseout='list_out_color(event)'>
	<tr align="center" bgcolor="#E8ECF1" height="30">
<? 
$colspan=5; //기본 수
if($_bbs_auth['cart']) { 
	$colspan=$colspan+1;
	?>	<td width="20"><input type="checkbox" onClick="set_checkbox(list_form,'chk_nums[]',this.checked)" class="none"></td>
<? } ?>
		<td width="40" >번호</td>
<? if($_bbs_info['use_category']) { 
		$colspan=$colspan+1;
		?>	<td width="100">분류</td>
<? } ?>
		<td>제목</td>
		<td width="80">작성자</td>
		<td width="80">작성일</td>
		<td width="60">조회수</td>
		</tr>
		<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#CCCCCC"></td></tr>
<?
	if($rs_list->num_rows()<1) {
		echo "
	<tr height=\"50\">
		<td align=\"center\" colspan=\"".$colspan."\"><B>등록(검색) 된 자료가 없습니다.</td>
	</tr>";
	}

	$no = $page_info['start_no'];
	if(isset($bd_num)) $o_bd_num=$bd_num;
	while($data=$rs_list->fetch()) {
		$i_no=--$no;
		include("list_data_process.php");
		
		if($bd_delete > 0) include($_skin_list_delete); // 삭제글	
		else if($bd_secret > 0) include($_skin_list_secret); // 비밀글
		else if($bd_notice > 0) include($_skin_list_notice); // 공지사항		
		else if($o_bd_num==$bd_num) include($_skin_list_current); // 현재글
		else include($_skin_list_main);
	}
?>
</table>
</form>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td align="center" style="padding-top:10px;">
<?=rg_navi_display($page_info,$_get_param[2]); ?>
		</td>
	</tr>
	<tr>
		<td>
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td>
<? if($_bbs_auth['write']) { ?>
					<img src="<?=$skin_url?>images/write.gif" onclick="location.href='write.php?<?=$_get_param[3]?>'" style="cursor:pointer" align="absmiddle">
<? } ?>
<? if($_bbs_auth['admin']) { ?>
<script>
function board_manager(){
	if(!chk_checkbox(list_form,'chk_nums[]',true)){
		alert('한개이상 선택 하세요.');
		return;
	}
	window_open('', "board_manager", 'scrollbars=no,width=355,height=200');
	document.list_form.action = '<?=$_url['bbs']?>board_manager.php';
	document.list_form.target='board_manager';
	document.list_form.submit();
}
</script>
					<img src="<?=$skin_url?>images/bbs_admin.gif" onclick="board_manager();" style="cursor:pointer" align="absmiddle">
<? } ?>
					</td>
					<td>
						<table width="100%" cellspacing="0" border="0" cellpadding="0">
						<form name="search_form" action="?" method="get" enctype="multipart/form-data" onsubmit="return validate(this)">
						<?=$_post_param[0]?>
							<tr> 
								<td align="right">
									<? if($ss['cat']) { ?>
									<input type="checkbox" name="ss[cat]" value="<?=$ss['cat']?>" checked>분류내검색&nbsp;&nbsp;
									<? } ?>
									<input type="checkbox" name="ss[si]" value="1" <?=$checked_si?>>아이디&nbsp;&nbsp;
									<input type="checkbox" name="ss[sn]" value="1" <?=$checked_sn?>>작성자&nbsp;&nbsp;
									<input type="checkbox" name="ss[st]" value="1" <?=$checked_st?>>제목&nbsp;&nbsp;
									<input type="checkbox" name="ss[sc]" value="1" <?=$checked_sc?>>내용&nbsp;&nbsp;
									<input name="kw" type="text" id="kw" value="<?=$kw?>" size="14" hname="검색어" style="border:0px;width:184px;height:19px;color:#FFFFFF;background-image:url('<?=$skin_url?>images/search_form.gif');" required>
									<input type="image" src="<?=$skin_url?>images/s_search.gif" align="absmiddle"> 
									<img src="<?=$skin_url?>images/s_cancel.gif" onclick="location.href='?<?=$_get_param[0]?>'" style="cursor:pointer" align="absmiddle">
								</td>
							</tr>
							</form>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>