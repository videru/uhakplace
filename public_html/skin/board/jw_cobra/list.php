<?echo $title_img_path?>

<table width="980" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="223" valign="top"><embed src="../n_img/left_06.swf" width="223" height="400"></embed></td>
    <td width="37">&nbsp;</td>
    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
       <tr>
        <td><img src="<?
 		switch($bbs_code)
        {
        	case "jw_notice":echo"../n_img/6_1.jpg";
        	break;
        	case "jw_ot":echo "../n_img/6_2.jpg";
        	break;
        	case "jw_yensu":echo "../n_img/6_4.jpg";
        	break;
        	case "jw_qna":echo "../n_img/6_3.jpg";
        	break;
        }
        ?>" width="720" height="250" /></td>
      </tr>
<tr>
 <td>
<table width="692" cellspacing="0" border="0" cellpadding="0">
<form name="category_form" action="?" method="get" enctype="multipart/form-data">
<?=$_post_param[0]?>
	<tr> 
		<td align="right">총: 
			<?=$page_info['total_rows']?>
			(<?=$page_info['page']?>/<?=$page_info['total_page']?> page)</td>
    </tr>
</form>
</table>
<form name="list_form" method="post" enctype="multipart/form-data" action="?">
<?=$_post_param[3]?>
<input name="mode" type="hidden" value="">
<table border="0" cellpadding="0" cellspacing="0" width="692" onmouseover="list_over_color(event,'#FFFBFB',1)" onmouseout='list_out_color(event)'  align="center">
	<tr align="center" bgcolor="#F0F0F4" height="35">
       <td width="10" ><img src="<?=$skin_url?>images/list_left.gif"></td>
<? if($_bbs_auth['cart']) { ?>
		<td width="20" background="<?=$skin_url?>images/list_bg.gif"><input type="checkbox" onClick="set_checkbox(list_form,'chk_nums[]',this.checked)" class="none"></td>
<? } ?>
		<td width="45" align="center"  background="<?=$skin_url?>images/list_bg.gif"><img src="<?=$skin_url?>images/list_no.gif"></td>
		<td width="10" align="center" background="<?=$skin_url?>images/list_bg.gif"><img src="<?=$skin_url?>images/list_line.gif"></td>
		<td align="center" background="<?=$skin_url?>images/list_bg.gif"><img src="<?=$skin_url?>images/list_subject.gif"></td>
		<td width="10" align="center" background="<?=$skin_url?>images/list_bg.gif"><img src="<?=$skin_url?>images/list_line.gif"></td>
		<td width="110" align="center" background="<?=$skin_url?>images/list_bg.gif"><img src="<?=$skin_url?>images/list_writer.gif"></td>
		<td width="10" align="center" background="<?=$skin_url?>images/list_bg.gif"><img src="<?=$skin_url?>images/list_line.gif"></td>
		<td width="70" align="center" background="<?=$skin_url?>images/list_bg.gif"><img src="<?=$skin_url?>images/list_date.gif"></td>
		<td width="10" align="center" background="<?=$skin_url?>images/list_bg.gif"><img src="<?=$skin_url?>images/list_line.gif"></td>
		<td width="36" align="center" background="<?=$skin_url?>images/list_bg.gif"><img src="<?=$skin_url?>images/list_view.gif"></td>
       <td width="10" ><img src="<?=$skin_url?>images/list_right.gif"></td>	
	</tr>
<?
	if($rs_list->num_rows()<1) {
		echo "
	<tr height=\"100\">
		<td align=\"center\" colspan=\"12\"><B>등록(검색) 된 자료가 없습니다.</td>
	</tr>";
	}

	$no = $page_info['start_no'];
	if(isset($bd_num)) $o_bd_num=$bd_num;
	while($data=$rs_list->fetch()) {
		$i_no=--$no;
		include("list_data_process_new.php");
		
		if($bd_delete > 0) include($_skin_list_delete); // 삭제글	
		else if($bd_secret > 0) include($_skin_list_secret); // 비밀글
		else if($bd_notice > 0) include($_skin_list_notice); // 공지사항		
		else if(isset($o_bd_num) && $o_bd_num==$bd_num) include($_skin_list_current); // 현재글
		else include($_skin_list_main);
	}
?>
    <tr>
		<td colspan="12" height="1" bgcolor="#eaecef"></td>
    </tr>
</table>
</form>
<table width="692" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td ></td>
	</tr>				
				<tr>
					<td align="right" >
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
                </tr>
	<tr>
		<td align="center" style="padding-top:12px;">
<?=rg_navi_display($page_info,$_get_param[2]); ?>
		</td>
	</tr>
	<tr>
		<td height="16"></td>
	</tr>
	<tr>
		<td align="center" >
			<table width="692" border="0" cellpadding="0" cellspacing="0" >
                <tr>
					<td>
						<table width="692" cellspacing="0" border="0" cellpadding="0">
						<form name="search_form" action="?" method="get" enctype="multipart/form-data" onsubmit="return validate(this)">
						<?=$_post_param[0]?>
							<tr> 
								
								<td width="110"><img src="<?=$skin_url?>images/searchbg_left.gif"></td>								
								<td width="548" background="<?=$skin_url?>images/searchbg.gif">&nbsp;
									<input type="checkbox" name="ss[sn]" value="1" <?=$checked_sn?>>작성자&nbsp;
									<input type="checkbox" name="ss[st]" value="1" <?=$checked_st?>>제목&nbsp;
									<input type="checkbox" name="ss[sc]" value="1" <?=$checked_sc?>>내용&nbsp;&nbsp;
									<input name="kw" type="text" id="kw" value="<?=$kw?>" size="14" hname="검색어" style="border:0px;width:300px;height:18px;color:#FFFFFF;background-image:url('<?=$skin_url?>images/search_form.gif');" required>
									<input type="image" src="<?=$skin_url?>images/s_search.gif" align="absmiddle">
								</td>
								<td width="34"><img src="<?=$skin_url?>images/searchbg_right.gif"></td>	
							</tr>
							</form>
						</table>
						</td>
				</tr>
			</table>
		</td>
	</tr>
</table>

<!-- 윤곽 -->
</td>
</tr>
</table>
</td>
</tr>
</table>