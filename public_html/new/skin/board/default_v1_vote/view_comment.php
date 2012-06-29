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
<table border="1" cellpadding="3" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1">
<? if($_bbs_auth['comment']) { // 코멘트 쓰기여부 ?>
	<tr>
		<td>
			<table border="0" cellspacing="0" width="100%">
				<form name="comment_form" action="?" method="post" onSubmit="return validate(this)">
				<?=$_post_param[3]?>
				<input type="hidden" name="mode" value="comment_write">
				<input type="hidden" name="bd_num" value="<?=$bd_num?>">
				<tr>
					<td>
						<table width="100%" cellpadding="3" >
							<tr>
								<td>
									<textarea name="bc_content" cols="60" rows="5" style="width:100%" class="input"></textarea>
								</td>
								<td width="80">
									<input type="submit" value="등록하기" class="button" style="width:95%;height:70">
								</td>
							</tr>
						</table>
					</td>
				</tr>
<? if($vcfg['input_name']) { ?>
				<tr>
					<td>
						<table width="100%" style="table-layout:fixed" cellpadding="3" >
							<tr>
								<td>
								작성자 : <input type="text" name="bc_name" value="<?=$bc_name?>" class="input">
								</td>
								<td>
								암호 : <input type="password" name="bc_pass" class="input">
								</td>
							</tr>
						</table>
					</td>
				</tr>
<? } else { ?>
				<tr>
					<td>
						<table width="100%" style="table-layout:fixed" cellpadding="2" >
							<tr>
								<td>
								작성자 : <?=$bc_name?>
								</td>
							</tr>
						</table>
					</td>
				</tr>
<? } ?>
<? if($vcfg['spam_chk']) { ?>
	<tr>
		<td>스팸방지 : <?=$spam_chk_img?> 좌측의 문자를 입력해주세요.
		<input name="spam_chk" type="text" class="input" size="10">
		<input name="spam_chk_code" type="hidden" value="<?=$spam_chk_code?>"></td>
	</tr>
<? } ?>

				</form>
			</table>
		</td>
	</tr>
<? } ?>
<?
	include("clist_pre_process.php");
	while($data_comment=$rs_comment->fetch()) {
		include("clist_data_process.php");
?>
	<tr>
		<td>
			<table border="0" cellspacing="0" width="100%">
				<tr>
					<td>
						<table width="100%" cellpadding="3" >
							<tr>
								<td>
								작성자 : <?=$bd_name_layer?>
								
								
<? if($comment_delete_chk) { ?>
								-  <a href="<?=$comment_delete_url?>">x</a>
<? } ?>
								</td>
								<td align="right">
								작성일 : <?=$bc_write_date?>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="100%" cellpadding="3" >
							<tr>
								<td>
								<?=$bc_content?>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
<? } ?>	
</table>