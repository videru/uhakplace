<? if (!defined('RGBOARD_VERSION')) exit; ?>
<?
/* =====================================================
 프로그램명 : 알지보드 V4 게시판스킨

파일설명 : 게시판 글 목록

변수설명
$_bbs_info['use_category'] : 카테고리 사용유무
$_category_info : 카테고리정보

$page_info['total_rows'] : 페이징 정보, 총게시물수
$page_info['page'] : 페이징 정보, 현재페이지
$page_info['total_page'] : 페이징 정보, 총페이지수
$_post_param[0] : POST방식의 기본정보, 게시판코드만
$_post_param[3] : POST방식의 기본정보, 전체(게시판코드,키워드,필터,정렬,페이지)

$_bbs_auth['cart'] : 카트사용여부
$_bbs_auth['write'] : 글쓰기권한여부
$_bbs_auth['admin'] : 관리자여부

$bd_delete : 삭제여부
$bd_secret : 비밀글여부
$bd_notice : 공지사항여부
$o_bd_num : 최근본글번호
$bd_num : 현재글번호
$_url['bbs'] : 게시판URL

$ss['cat'] : 검색 카테고리선택
$url_all_list : 검색 action URL(list.php를 의미)
$kw : 검색키워드
===================================================== */
?>
<table width="100%" cellspacing="0" border="0" cellpadding="0">
<form name="category_form" action="?" method="get" enctype="multipart/form-data">
<?=$_post_param[0]?>
	<tr> 
		<td>
<? if($_bbs_info['use_category']) { ?>
분류 : 
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
<table border="1" cellpadding="0" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" onmouseover="list_over_color(event,'#FFE6E6',1)" onmouseout='list_out_color(event)'>
	<tr align="center" bgcolor="#F0F0F4">
<? if($_bbs_auth['cart']) { ?>
		<td width="20"><input type="checkbox" onClick="set_checkbox(list_form,'chk_nums[]',this.checked)" class="none"></td>
<? } ?>
		<td width="40" >번호</td>
<? if($_bbs_info['use_category']) { ?>
		<td width="100">분류</td>
<? } ?>
		<td>제목</td>
		<td width="80">작성자</td>
		<td width="80">작성일</td>
		<td width="60">조회수</td>
		</tr>
<?
/*	if($rs_list->num_rows()<1) {
		echo "
	<tr height=\"100\">
		<td align=\"center\" colspan=\"10\"><B>등록(검색) 된 자료가 없습니다.</td>
	</tr>";
	}*/

	$no = $page_info['start_no'];
	if(isset($bd_num)) $o_bd_num=$bd_num;
	while($data=$rs_list->fetch()) {
		$i_no=--$no;
		include("list_data_process.php");
		
		if($bd_delete > 0) include($_skin_list_delete); // 삭제글	
		else if($bd_secret > 0) include($_skin_list_secret); // 비밀글
		else if($bd_notice > 0) include($_skin_list_notice); // 공지사항		
		else if(isset($o_bd_num) && $o_bd_num==$bd_num) include($_skin_list_current); // 현재글
		else include($_skin_list_main);
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
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td>
<? if($_bbs_auth['write']) { ?>
					<input type="button" value="글쓰기" class="button" onclick="location.href='write.php?<?=$_get_param[3]?>'">
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
					<input type="button" value="글관리" class="button" onclick="board_manager();">
<? } ?>
					</td>
					<td>
						<table width="100%" cellspacing="0" border="0" cellpadding="0">
						<form name="search_form" action="<?=$url_all_list?>" method="get" enctype="multipart/form-data" onsubmit="return validate(this)">
						<?=$_post_param[0]?>
							<tr> 
								<td align="right">
									<? if($ss['cat']) { ?>
									<input type="checkbox" name="ss[cat]" value="<?=$ss['cat']?>" checked>분류내검색&nbsp;&nbsp;
									<? } ?>
<?php /*?><input type="checkbox" name="ss[si]" value="1" <?=$checked_si?>>아이디&nbsp;&nbsp;<?php */?>
									<input type="checkbox" name="ss[sn]" value="1" <?=$checked_sn?>>작성자&nbsp;&nbsp;
									<input type="checkbox" name="ss[st]" value="1" <?=$checked_st?>>제목&nbsp;&nbsp;
									<input type="checkbox" name="ss[sc]" value="1" <?=$checked_sc?>>내용&nbsp;&nbsp;
									<input name="kw" type="text" id="kw" value="<?=$kw?>" size="14" class="input" hname="검색어" required>
									<input type="submit" name="검색" value="검색" class="button"> 
									<input type="button" value="취소" onclick="location.href='?<?=$_get_param[0]?>'" class="button">
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