<? if (!defined('RGBOARD_VERSION')) exit; ?>
<?
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
<form name="write_form" method="post" action="?<?=$_get_param[3]?>" onSubmit="return validate(this)" enctype="multipart/form-data">
<input type="hidden" name="mode" value="<?=$mode?>">
<input type="hidden" name="act" value="ok">
<input type="hidden" name="bd_num" value="<?=$bd_num?>">
<input type="hidden" name="old_pass" value="<?=$old_pass?>">
<input type="hidden" name="bd_html" value="2">
<input type="hidden" name="bd_write_date1" value="<?=$bd_write_date1?>">
<input type="hidden" name="bd_write_date2" value="<?=$bd_write_date2?>">
<input type="hidden" name="bd_write_date3" value="<?=$bd_write_date3?>">
<table border="1" cellpadding="3" cellspacing="0" width="600" bordercolordark="white" bordercolorlight="#E1E1E1">
<? if($wcfg['use_notice'] || $wcfg['use_secret'] || $wcfg['use_reply_mail']) { ?>
	<tr>
		<td width="120" align="center" bgcolor="#F0F0F4">&nbsp;</td>
		<td><? if($wcfg['use_notice']) { ?><input type="checkbox" name="bd_notice" value="1" <?=$chk_bd_notice?>> 공지사항&nbsp;&nbsp;<? } ?>
		<? if($wcfg['use_secret']) { ?><input type="checkbox" name="bd_secret" value="1" <?=$chk_bd_secret?>> 비밀글&nbsp;&nbsp;<? } ?>
		<? if($wcfg['use_reply_mail']) { ?><input type="checkbox" name="" value="1" <?=$chk_bd_reply_mail?>> 답변메일수신&nbsp;&nbsp;<? } ?>
		</td>
	</tr>
<? } ?>
<? if($_mb[mb_level]>9) { ?>
	<tr>
		<th width="120">작성일</th>
		<td><input name="bd_write_date1" type="text" value="<?=$bd_write_date1?>" class="input" size="4">년<input name="bd_write_date2" type="text" value="<?=$bd_write_date2?>" class="input" size="2">월<input name="bd_write_date3" type="text" value="<?=$bd_write_date3?>" class="input" size="2">일   조회수 <input name="view_hit" type="text" value="<?=$bd_view_count?>" class="input" size="5">
		</td>
	</tr>
<? } ?>
<? if($_mb[mb_level]>9) { ?>
	<tr bgcolor="#f7f7f7">
    <td align="center" bgcolor="#E8ECF1"><strong>플래시콘</strong></td>
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
  <?}?>
<? if($wcfg['input_name']) { ?>
	<tr>
		<td width="120" align="center" bgcolor="#F0F0F4"><strong>작성자</strong></td>
		<td><input name="bd_name" type="text" value="<?=$bd_name?>" class="input">
		</td>
	</tr>
<? } ?>
<? if($wcfg['input_pass']) { ?>
	<tr>
		<td align="center" bgcolor="#F0F0F4"><strong>암호</strong></td>
		<td><input name="bd_pass" type="password" value="" class="input"></td>
	</tr>
<? } ?>
<? if($wcfg['input_email']) { ?>
	<tr>
		<td align="center" bgcolor="#F0F0F4"><strong>이메일</strong></td>
		<td><input name="bd_email" type="text" class="input" value="<?=$bd_email?>" size="40">
		</td>
	</tr>
<? } ?>
<? if($wcfg['use_home']) { ?>
	<tr>
    <td align="center" bgcolor="#F0F0F4"><strong>홈페이지</strong></td>
	  <td><input name="bd_home" type="text" class="input" value="<?=$bd_home?>" size="60"></td>
  </tr>
<? } ?>
<? if($wcfg['use_category']) { ?>
	<tr>
    <td align="center" bgcolor="#F0F0F4"><strong>분류</strong></td>
	  <td><select name="cat_num">
<option value="">==선택==</option>
<?=rg_html_option($_category_info,$cat_num,'cat_num','cat_name')?>
</select></td>
  </tr>
<? } ?>
	<tr>
		<td align="center" bgcolor="#F0F0F4"><strong>제목</strong></td>
		<td><input name="bd_subject" type="text" class="input" value="<?=$bd_subject?>" size="60"></td>
	</tr>

	<tr>
		<td align="center" bgcolor="#F0F0F4"><strong>내용</strong></td>
		<td><?=myEditor(1,'../editor','write_form','bd_content','100%','250');?></td>
	</tr>
<?
	if($wcfg['use_link']) { 
		for($i=0;$i<$wcfg['link_count'];$i++) {
?>
	<tr>
    <td align="center" bgcolor="#F0F0F4"><strong>링크 #<?=($i+1)?></strong></td>
	  <td>이름 : <input name="bd_links[<?=$i?>][name]" type="text" class="input" value="<?=$bd_links[$i]['name']?>" size="60"><br>
URL : <input name="bd_links[<?=$i?>][url]" type="text" class="input" value="<?=$bd_links[$i]['url']?>" size="60"></td>
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
		<td><span id="span_img_id_<?=$i?>" style="display:none"><img id="img_id_<?=$i?>" name="img_id_<?=$i?>" width="300" /><br /></span>
			<input type="file" name="bd_files[<?=$i?>]" class="input" size="40" onchange="if(this.value=='') span_img_id_<?=$i?>.style.display='none'; else { img_id_<?=$i?>.src=this.value;span_img_id_<?=$i?>.style.display=''; }"><br />
			<? if($bd_files[$i][name]!='') { ?>
			<?=$bd_files[$i][name]?>
			<input type="checkbox" name="bd_files_del[<?=$i?>]" value="1" />
			삭제
			<? } ?>
		</td>
	</tr>
<?
		}
	}
?>
<? if($wcfg['spam_chk']) { ?>
	<tr>
		<td align="center" bgcolor="#F0F0F4"><strong>스팸방지</strong></td>
		<td><?=$spam_chk_img?> 좌측의 문자를 입력해주세요.
		<input name="spam_chk" type="text" class="input" size="10">
		<input name="spam_chk_code" type="hidden" value="<?=$spam_chk_code?>"></td>
	</tr>
<? } ?>
</table>

<table width="600" border="0">
	<tr>
		<td align="center">
<?
	switch($mode) {
		case 'write' :
?><input type="submit" value=" 등   록 " class="button"  onClick="editor_wr_ok();"><?
		break;
		case 'reply' :
?><input type="submit" value=" 등   록 " class="button"  onClick="editor_wr_ok();"><?
		break;
		case 'modify' :
?><input type="submit" value=" 수   정 " class="button"  onClick="editor_wr_ok();"> <?
		break;
	}
?>
			<input type="button" value=" 취   소 " onClick="history.back();" class="button">
		</td>
	</tr>
</table>
</form>