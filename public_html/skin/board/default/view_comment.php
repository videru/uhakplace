<? if (!defined('RGBOARD_VERSION')) exit; ?>
<?
/* =====================================================
 프로그램명 : 알지보드 V4 게시판스킨

파일설명 : 코멘트루틴

변수설명
$_bbs_auth['comment'] : 코멘트 입력여부
$bd_num : 글번호
$vcfg['input_name'] : 이름입력받을지
$bc_name : 이름
$vcfg['spam_chk'] : 스팸체크여부
$spam_chk_img : 스팸이미지
$spam_chk_code : 스팸체크코드(현재는고정)
$comment_delete_chk : 코멘트삭제 가능여부
$comment_delete_url : 코멘트삭제 주소
$bc_write_date : 코멘트 작성일
$bc_content : 코멘트내용
===================================================== */
?>
<? if($_bbs_auth['comment']) { // 코멘트 쓰기여부 ?>
<table border="0" cellpadding="0" cellspacing="3" width="100%" style="table-layout:fixed;border:1px solid #CCC">
<col width="50%" />
<col width="" />
<col width="80" />
  <form name="comment_form" action="?" method="post" onSubmit="return validate(this)">
  <?=$_post_param[3]?>
  <input type="hidden" name="mode" value="comment_write">
  <input type="hidden" name="bd_num" value="<?=$bd_num?>">
  <tr>
    <td colspan="2">
      <textarea name="bc_content" cols="60" rows="5" style="width:100%" class="input" required hname="내용"></textarea>
    </td>
    <td width="80">
      <input type="submit" value="등록하기" class="button" style="width:95%;height:70">
    </td>
  </tr>
<? if($vcfg['input_name']) { ?>
  <tr>
    <td>
    작성자 : <input type="text" name="bc_name" value="<?=$bc_name?>" class="input" required hname="작성자">
    </td>
    <td colspan="2">
    암호 : <input type="password" name="bc_pass" class="input">
    </td>
  </tr>
<? } else { ?>
  <tr>
    <td colspan="3">
    작성자 : <?=$bc_name?>
    </td>
  </tr>
<? } ?>
<? if($vcfg['spam_chk']) { ?>
  <tr>
    <td colspan="3">
      스팸방지 : <?=$spam_chk_img?> 좌측의 문자를 입력해주세요.
    <input name="spam_chk" type="text" class="input" size="10" required hname="스팸방지코드">
    <input name="spam_chk_code" type="hidden" value="<?=$spam_chk_code?>"></td>
  </tr>
<? } ?>
  </form>
</table>
<? } ?>

<form name="cmt_list_form" method="post" enctype="multipart/form-data" action="?">
<?=$_post_param[3]?>
<input name="mode" type="hidden" value="">
<input name="mode2" type="hidden" value="">
<input type="hidden" name="bd_num" value="<?=$bd_num?>">
<table border="0" cellpadding="0" cellspacing="3" width="100%">
<?
	include("clist_pre_process.php");
	while($data_comment=$rs_comment->fetch()) {
		include("clist_data_process.php");
?>
	<tr>
		<td style="border-bottom:1px #CCC solid">
			<table border="0" cellspacing="0" width="100%">
        <tr>
          <td>
<? if($_bbs_auth['admin']) { ?>
<input type=checkbox name="chk_cnums[]" value="<?=$bc_num?>" class=none>
<? } ?>
          <?=$bd_name_layer?>
<span style="color:#999">( <?=$bc_write_date?>, <?=$bc_write_ip?> )</span>
<? if($comment_delete_chk) { ?>
          -  <a href="<?=$comment_delete_url?>">x</a>
<? } ?>
          </td>
        </tr>
				<tr>
					<td>
<?=$bc_content?>
					</td>
				</tr>
			</table>
		</td>
	</tr>
<? } ?>	
</table>
<? if($_bbs_auth['admin']) { ?>
<script>
function comment_delete_select(){
	if(!chk_checkbox(cmt_list_form,'chk_cnums[]',true)){
		alert('한개이상 선택 하세요.');
		return;
	}
	if(!confirm('삭제하시겠습니까?')){
		return;
	}
	
	document.cmt_list_form.mode.value='comment_delete';
	document.cmt_list_form.mode2.value='select';
	document.cmt_list_form.submit();
}
</script>
전체 : <input type="checkbox" onClick="set_checkbox(cmt_list_form,'chk_cnums[]',this.checked)" class="none">

<input type="button" value="선택 코멘트삭제" class="button" onclick="comment_delete_select();">
<? } ?>
</form>
