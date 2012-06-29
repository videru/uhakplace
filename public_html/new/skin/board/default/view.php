<? if (!defined('RGBOARD_VERSION')) exit; ?>
<?
/* =====================================================
 프로그램명 : 알지보드 V4 게시판스킨

파일설명 : 글보기

변수설명

$prev_data : 이전글정보
$next_data : 다음글정보
$vcfg['btn_modify'] : 수정버튼표시여부
$vcfg['btn_del'] : 삭제버튼표시여부
$vcfg['btn_reply'] : 답변버튼표시여부
$vcfg['btn_vote_yes'] : 추천버튼표시여부
$vcfg['btn_vote_no'] : 반대버튼표시여부
$vcfg['btn_list'] : 글목록버튼표시여부

$bbs_code : 게시판코드
$bd_num : 글번호
$bd_name : 작성자
$bd_email : 이메일
$mb_id : 작성자아이디
$open_homepage : 글작성시 입력한 홈페이지주소
$open_email : 글작성시 입력한 이메일주소
$open_profile : 회원정보공개여부
$open_memo : 쪽지보내기
$mb_icon : 회원아이콘

$bd_write_date : 글작성일
$bd_home : 글홈페이지
$vcfg['use_category'] : 카테고리사용여부
$cat_name : 카테고리명
$vcfg['btn_vote_yes'] : 찬성/추천 사용여부
$vcfg['btn_vote_no'] : 반대 사용여부
$bd_vote_yes : 찬성/추천 투표수
$bd_vote_no : 반대 투표수
$bd_subject : 글제목
$vcfg['view_image'] : 글내용과 이미지를 함께보여줌
$bd_files : 첨부파일정보(배열)
$bd_content : 글내용
$bd_links : 링크정보 (배열)
$vcfg['use_download'] : 다운로드여부
$vcfg['view_signature'] : 서명표시여부
$mb_signature : 서명(회원인경우)
$vcfg['view_comment'] : 코멘트표시여부
$vcfg['view_list'] : 글목록표시 여부
===================================================== */
?>
<table width="100%" border="0">
	<tr>
		<td align="left">
<? if($prev_data) { ?>
		<input type="button" value="이전" onClick="location.href='<?=$url_view_prev?>'" class="button">
<? } ?>
<? if($next_data) { ?>
		<input type="button" value="다음" onClick="location.href='<?=$url_view_next?>'" class="button">
<? } ?>
<? if($vcfg['btn_modify']) { ?>	
		<input type="button" value="수정" onClick="location.href='<?=$url_modify?>'" class="button">
<? } ?>
<? if($vcfg['btn_del']) { ?>	
		<input type="button" value="삭제" onClick="location.href='<?=$url_delete?>'" class="button">
<? } ?>
<? if($vcfg['btn_reply']) { ?>	
		<input type="button" value="답변" onClick="location.href='<?=$url_reply?>'" class="button">
<? } ?>
<? if($vcfg['btn_vote_yes']) { ?>	
		<input type="button" value="추천" onClick="location.href='<?=$url_vote_yes?>'" class="button">
<? } ?>
<? if($vcfg['btn_vote_no']) { ?>	
		<input type="button" value="반대" onClick="location.href='<?=$url_vote_no?>'" class="button">
<? } ?>
		</td>
		<td align="right">
<? if($vcfg['btn_list']) { ?>
		<input type="button" value="목록보기" onClick="location.href='<?=$url_list?>'" class="button">
<? } ?>
		</td>
	</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" width="100%" class="default_bbs_content">
	<tr>
		<th width="120">작성자</th>
		<td><?=$bd_name_layer?></td>
	</tr>
	<tr>
		<th width="120">작성일</th>
		<td><?=$bd_write_date?></td>
	</tr>
<? if($bd_home) { ?>
	<tr>
    <th>홈페이지</th>
	  <td><?=$bd_home?></td>
  </tr>
<? } ?>
<? if($vcfg['use_category']) { ?>
	<tr>
    <th>분류</th>
	  <td><?=$cat_name?></td>
  </tr>
<? } ?>
<? if($vcfg['btn_vote_yes'] || $vcfg['btn_vote_no']) { ?>
	<tr>
    <th>&nbsp;</th>
	  <td><? if($vcfg['btn_vote_yes']) { ?>추천 : <?=$bd_vote_yes?><? } ?>
				<? if($vcfg['btn_vote_yes'] && $vcfg['btn_vote_no']) { ?> / <? } ?>
				<? if($vcfg['btn_vote_no']) { ?>반대 : <?=$bd_vote_no?><? } ?></td>
  </tr>
<? } ?>
	<tr>
		<th>제목</th>
		<td><?=$bd_subject?></td>
	</tr>
	<tr>
		<th>내용</th>
		<td style='word-break:break-all'>
<?
	if($vcfg['view_image']) {
?>
<img id="view_image_width" height="0" width="100%"><br />
<script language="JavaScript" type="text/JavaScript">
if(onload) var set_img_old_onload=onload;
onload=set_img_width_init;
</script>
<?
		foreach($bd_files as $k => $v) {
			if(!rg_file_type_chk($v['type'],'image')) continue;
?>
<img src="<?=$v['view_url']?>" onclick="view_image_popup(this)" style="cursor:hand;" id="view_image"><br><br>
<? 	}
	}
?>		
		
		<?=$bd_content?></td>
	</tr>
<?
	if(is_array($bd_links) && (count($bd_links) > 0)) {
?>
	<tr>
    <th>링크</th>
	  <td>
<?
		foreach($bd_links as $k => $v) {
			if($v['url']=='') continue;
			if($v['name']=='') $v['name']=$v['url'];
?>
<a href="<?=$v['link_url']?>" target="_blank"><?=$v['name']?>&nbsp;&nbsp;(<?=number_format($v['hits'])?>)</a><br>
<? 	} ?>
		</td>
  </tr>
<?
	}
?>
<?
	if($vcfg['use_download']) {
?>
	<tr>
    <th>첨부파일</th>
		<td>
<?
		foreach($bd_files as $k => $v) {
			if($v['name']=='') continue;
?>
<a href="<?=$v['down_url']?>"><?=$v['name']?>&nbsp;&nbsp;Down:<?=number_format($v['hits'])?></a><br>
<? 	} ?>
		</td>
	</tr>
<?
	}
?>
<? if($vcfg['view_signature']) { ?>
	<tr>
    <th>서명</th>
		<td>
<?=$mb_signature?>
		</td>
	</tr>
<? } ?>
</table>

<?
	if($vcfg['view_comment']) // 코멘트 표시여부 
		if(file_exists($skin_path."view_comment.php")) include($skin_path."view_comment.php");
?>


<table width="100%" border="0">
	<tr>
		<td align="left">
<? if($prev_data) { ?>
		<input type="button" value="이전" onClick="location.href='<?=$url_view_prev?>'" class="button">
<? } ?>
<? if($next_data) { ?>
		<input type="button" value="다음" onClick="location.href='<?=$url_view_next?>'" class="button">
<? } ?>
<? if($vcfg['btn_modify']) { ?>	
		<input type="button" value="수정" onClick="location.href='<?=$url_modify?>'" class="button">
<? } ?>
<? if($vcfg['btn_del']) { ?>	
		<input type="button" value="삭제" onClick="location.href='<?=$url_delete?>'" class="button">
<? } ?>
<? if($vcfg['btn_reply']) { ?>	
		<input type="button" value="답변" onClick="location.href='<?=$url_reply?>'" class="button">
<? } ?>
<? if($vcfg['vote_yes']) { ?>	
		<input type="button" value="추천" onClick="location.href='<?=$url_vote_yes?>'" class="button">
<? } ?>
<? if($vcfg['vote_no']) { ?>	
		<input type="button" value="반대" onClick="location.href='<?=$url_vote_no?>'" class="button">
<? } ?>
		</td>
		<td align="right">
<? if($vcfg['btn_list']) { ?>
		<input type="button" value="목록보기" onClick="location.href='<?=$url_list?>'" class="button">
<? } ?>
		</td>
	</tr>
</table>
<? if($vcfg['view_list']) { ?>
<br>
<table width="100%" border="0">
	<tr>
		<td>
<? include('list_main_process.php'); ?>
		</td>
	</tr>
</table>
<? } ?>
