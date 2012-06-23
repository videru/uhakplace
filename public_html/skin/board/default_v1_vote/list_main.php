<? if (!defined('RGBOARD_VERSION')) exit; ?>
<?
/* =====================================================
 프로그램명 : 알지보드 V4 게시판스킨

파일설명 : 게시판 글 목록

변수설명
$_bbs_info['use_category'] : 카테고리 사용유무
$cat_name : 카테고리명

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

$i_no : 글순서번호
$i_reply : 응답글들여쓰기,아이콘 (setup.php 에서 정의)
$i_secret : 비밀글아이콘 (setup.php 에서 정의)
$i_new : 최근글아이콘 (setup.php 에서 정의,표시시간은 게시판관리자에서)
$i_comment_count : 코멘트개수 (형태는 setup.php 에서 정의)
$view_url : 글보기 URL
$bd_subject : 글제목

$bbs_code : 게시판코드
$mb_icon : 작성자가 회원이면 회원아이콘
$mb_id : 회원이라면 아이디
$bd_name : 작성자명
$open_homepage : 글작성시 입력한 홈페이지주소
$open_email : 글작성시 입력한 이메일주소
$open_profile : 회원정보공개여부
$open_memo : 쪽지보내기

$bd_write_date : 글작성일
$bd_view_count : 글조회수
$bd_vote_yes : 추천/찬성 표수
$bd_vote_no : 반대 표수

기타 list_data_process.php 와 디비구조 참고
===================================================== */
?>
	<tr height="25">
<? if($_bbs_auth['cart']) { ?>
		<td align="center"><input type=checkbox name="chk_nums[]" value="<?=$bd_num?>" class=none></td>
<? } ?>
		<td align="center"><?=$i_no?></td>
<? if($_bbs_info['use_category']) { ?>
		<td align="center"><?=$cat_name?><br></td>
<? } ?>
		<td><?=$i_reply?> <?=$i_secret?> <a href="<?=$view_url?>"><?=$bd_subject?></a> <?=$i_comment_count?> <?=$i_new?></td>
		<td align="center"><?=$bd_name_layer?></td>
		<td align="center"><?=$bd_write_date?></td>
		<td align="center"><?=$bd_view_count?></td>
		</tr>