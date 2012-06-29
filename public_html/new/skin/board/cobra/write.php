<?
/* =====================================================


파일설명 : 글작성

변수설명
$mode : 글작성모드(write,modify,replay)
$bd_num : 글수정,답변글 일 경우 글번호
$old_pass : 글수정시 원래 암호
$wcfg['use_notice'] : 공지사항
$wcfg['use_secret'] : 비밀글
$wcfg['use_reply_mail'] : 응답글
$wcfg['input_name'] : 이름입력여부
$wcfg['input_pass'] : 암호입력여부
$wcfg['input_email'] : 이메일입력여부
$wcfg['use_home'] : 홈페이지
$wcfg['use_category'] : 카테고리
$wcfg['use_html'] : html사용
$wcfg['use_link'] : 링크사용
$wcfg['use_upload'] : 업로드
$vcfg['spam_chk'] : 스팸체크여부
$spam_chk_img : 스팸이미지
$spam_chk_code : 스팸체크코드(현재는고정)
===================================================== */


if($bd_write_date){
$bd_write_date1 = date(Y, $bd_write_date);
$bd_write_date2 = date(m, $bd_write_date);
$bd_write_date3 = date(d, $bd_write_date);
}else{
$bd_write_date1 = date(Y);
$bd_write_date2 = date(m);
$bd_write_date3 = date(d);
}
?>
<?
include_once('../editor/func_editor.php');
$content = $bd_content;


?>
<form name="write_form" method="post" action="?" onSubmit="return validate(this)" enctype="multipart/form-data">
<?=$_post_param[3]?>
<input type="hidden" name="mode" value="<?=$mode?>">
<input type="hidden" name="act" value="ok">
<input type="hidden" name="bd_num" value="<?=$bd_num?>">
<input type="hidden" name="old_pass" value="<?=$old_pass?>">
<input type="hidden" name="bd_html" value="1">
<input type="hidden" name="bd_write_date1" value="<?=$bd_write_date1?>">
<input type="hidden" name="bd_write_date2" value="<?=$bd_write_date2?>">
<input type="hidden" name="bd_write_date3" value="<?=$bd_write_date3?>">
<table border="0" cellpadding="0" cellspacing="0" width="100%" align="center">
    <tr>
		<td colspan="4" height="1" bgcolor="#3694D4"></td>
    </tr>
<? if($wcfg['use_notice'] || $wcfg['use_secret'] || $wcfg['use_reply_mail']) { ?>
	<tr height="25">
		<td width="120" align="center" bgcolor="#F0F0F4">&nbsp;</td>
		<td colspan="3"><? if($wcfg['use_notice']) { ?><input type="checkbox" name="bd_notice" value="1" <?=$chk_bd_notice?>> 공지사항&nbsp;&nbsp;<? } ?>
		<? if($wcfg['use_secret']) { ?><input type="checkbox" name="bd_secret" value="1" <?=$chk_bd_secret?>> 비밀글&nbsp;&nbsp;<? } ?>
		<? if($wcfg['use_reply_mail']) { ?><input type="checkbox" name="bd_reply_mail" value="1" <?=$chk_bd_reply_mail?>> 답변메일수신&nbsp;&nbsp;<? } ?>
		</td>
	</tr>
    <tr>
		<td colspan="4" height="1" bgcolor="#3694D4"></td>
    </tr>
<? } ?>
<? if($_mb[mb_level]>9) { ?>
	<tr>
		<th width="120">작성일</th>
		<td><input name="bd_write_date1" type="text" value="<?=$bd_write_date1?>" class="input" size="4">년<input name="bd_write_date2" type="text" value="<?=$bd_write_date2?>" class="input" size="2">월<input name="bd_write_date3" type="text" value="<?=$bd_write_date3?>" class="input" size="2">일   조회수 <input name="view_hit" type="text" value="<?=$bd_view_count?>" class="input" size="5">
		</td>
	</tr>
<? } ?>

<? if($wcfg['input_name']) { ?>
	<tr height="25">
		<td width="120" align="center" bgcolor="#F0F0F4"><strong>작성자</strong></td>
		<td>&nbsp;<input name="bd_name" type="text" value="<?=$bd_name?>" class="input2">
		</td>
<?if($wcfg['input_pass']) { ?>
		<td align="center" bgcolor="#F0F0F4" width="120"><strong>암호</strong></td>
		<td>&nbsp;<input name="bd_pass" type="password" value="" class="input2"></td>
<? } ?>
	</tr>
    <tr>
		<td colspan="4" height="1" bgcolor="#3694D4"></td>
    </tr>
<? } ?>
<? if($wcfg['input_email']) { ?>
	<tr height="25">
		<td align="center" bgcolor="#F0F0F4"><strong>이메일</strong></td>
		<td>&nbsp;<input name="bd_email" type="text" class="input2" value="<?=$bd_email?>" size="30">
		</td>
<? } ?>
<? if($wcfg['use_home']) { ?>
    <td align="center" bgcolor="#F0F0F4" width="120"><strong>홈페이지</strong></td>
	<td >&nbsp;<input name="bd_home" type="text" class="input2" value="<?=$bd_home?>" size="30"></td>
<? } ?>
	</tr>
    <tr>
		<td colspan="4" height="1" bgcolor="#3694D4"></td>
    </tr>

<? if($wcfg['use_category']) { ?>
	<tr height="25">
    <td align="center" bgcolor="#F0F0F4"><strong>분류</strong></td>
	  <td>&nbsp;<select name="cat_num">
<option value="">==선택==</option>
<?=rg_html_option($_category_info,$cat_num,'cat_num','cat_name')?>
</select></td>
  </tr>
    <tr>
		<td colspan="4" height="1" bgcolor="#3694D4"></td>
    </tr>
<? } ?>

	<tr height="25">
		<td align="center" bgcolor="#F0F0F4"><strong>제목</strong></td>
		<td colspan="3">&nbsp;<input name="bd_subject" type="text" class="input2" value="<?=$bd_subject?>" size="80"><? if($_mb[mb_level]>9) { ?><br/><input type="radio" name="bd_ext5" value="0" <?if($bd_ext5==0){ echo "checked";}?>>기본색상 <input type="radio" name="bd_ext5" value="1" <?if($bd_ext5==1){ echo "checked";}?>>파란색 <input type="radio" name="bd_ext5" value="2" <?if($bd_ext5==2){ echo "checked";}?>>빨간색<? } ?> <input type="checkbox" name="bd_ext4" value="1" <?if($bd_ext4==1){ echo "checked";}?>>볼드</td>
	</tr>
    <tr>
		<td colspan="4" height="1" bgcolor="#3694D4"></td>
    </tr>
<? if($_mb[mb_level]>9) { ?>
	<tr height="25">
    <td align="center" bgcolor="#F0F0F4"><strong>플래시콘</strong></td>
	  <td>&nbsp;<script src='<?=$_url['site']?>/anicon/anicon_layer.js'></script> 
<input type='checkbox' name=anicon onclick='chk_anicon(this)'> 
<input name="bd_ext2" type=text readonly id="bd_ext2" value="<?=$bd_ext2?>" itemname='애니콘' style="width:120;height:18;"> 
<? 
$flash=explode("_",$bd_ext2); 
if($flash[2]) { 
echo "<img src='../anicon/thum_img/flash_con$flash[2].gif' align='absmiddle'>"; 
} 
?> </td>
  </tr>
    <tr>
		<td colspan="4" height="1" bgcolor="#3694D4"></td>
    </tr>
<? } ?>
	<tr>
		<td align="center" bgcolor="#F0F0F4"><strong>내용</strong></td>
		<td colspan="3"><?=myEditor(1,'../editor','write_form','bd_content','100%','500');?></td>
	</tr>
    <tr>
		<td colspan="4" height="1" bgcolor="#3694D4"></td>
    </tr>
<?
	if($wcfg['use_link']) { 
		for($i=0;$i<$wcfg['link_count'];$i++) {
?>
	<tr>
    <td align="center" bgcolor="#F0F0F4"><strong>링크 #<?=($i+1)?></strong></td>
	  <td colspan="3">이름 : <input name="bd_links[<?=$i?>][name]" type="text" class="input2" value="<?=$bd_links[$i]['name']?>" size="60"><br>
URL : <input name="bd_links[<?=$i?>][url]" type="text" class="input2" value="<?=$bd_links[$i]['url']?>" size="60"></td>
  </tr>
    <tr>
		<td colspan="4" height="1" bgcolor="#3694D4"></td>
    </tr>
<?
		}
	}
?>
<?
	if($wcfg['use_upload']) {
		for($i=0;$i<$wcfg['upload_count'];$i++) {
?>
	<tr>
    <td align="center" bgcolor="#F0F0F4"><strong>첨부파일 #<?=($i+1)?></strong></td>
		<td colspan="3">&nbsp;<input type="file" name="bd_files[<?=$i?>]" class="input2" size="40">
			<br />
			<? if($bd_files[$i][name]!='') { ?>
			<?=$bd_files[$i][name]?>
			<input type="checkbox" name="bd_files_del[<?=$i?>]" value="1" />
			삭제
			<? } ?>
		</td>
	</tr>
    <tr>
		<td colspan="4" height="1" bgcolor="#3694D4"></td>
    </tr>
<?
		}
	}
?>
<? if($wcfg['spam_chk']) { ?>
	<tr>
		<td align="center" bgcolor="#F0F0F4"><strong>스팸방지</strong></td>
		<td colspan="3"><?=$spam_chk_img?> 좌측의 문자를 입력해주세요.
		<input name="spam_chk" type="text" class="input" size="10">
		<input name="spam_chk_code" type="hidden" value="<?=$spam_chk_code?>"></td>
	</tr>
    <tr>
		<td colspan="4" height="1" bgcolor="#3694D4"></td>
    </tr>
<? } ?>
</table>
<br>
<table width="100%" border="0"  align="center">
	<tr>
		<td align="center">
<?
	switch($mode) {
		case 'write' :
?><input type="image" src="<?=$skin_url?>images/new_write.gif" align="absmiddle"  onClick="editor_wr_ok();"><?
		break;
		case 'reply' :
?><input type="image" src="<?=$skin_url?>images/rep_write.gif" align="absmiddle"  onClick="editor_wr_ok();"><?
		break;
		case 'modify' :
?><input type="image" src="<?=$skin_url?>images/mod_write.gif" align="absmiddle"  onClick="editor_wr_ok();"><?
		break;
	}
?>
			<img src="<?=$skin_url?>images/cancel.gif" onClick="history.back();" style="cursor:pointer" align="absmiddle">
		</td>
	</tr>
</table>
</form>