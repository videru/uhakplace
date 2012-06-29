<? if (!defined('RGBOARD_VERSION')) exit; ?>
<form name="write_form" method="post" action="?<?=$_get_param[3]?>" onSubmit="return validate(this)" enctype="multipart/form-data">
<input type="hidden" name="mode" value="<?=$mode?>">
<input type="hidden" name="act" value="ok">
<input type="hidden" name="bd_num" value="<?=$bd_num?>">
<input type="hidden" name="old_pass" value="<?=$old_pass?>">
<table border="0" cellpadding="0" cellspacing="0" width="600" class="default_bbs_content">
<? if($wcfg['use_notice'] || $wcfg['use_secret'] || $wcfg['use_reply_mail']) { ?>
	<tr>
		<th>&nbsp;</th>
		<td><? if($wcfg['use_notice']) { ?><input type="checkbox" name="bd_notice" value="1" <?=$chk_bd_notice?>> 공지사항&nbsp;&nbsp;<? } ?>
		<? if($wcfg['use_secret']) { ?><input type="checkbox" name="bd_secret" value="1" <?=$chk_bd_secret?>> 비밀글&nbsp;&nbsp;<? } ?>
		<? if($wcfg['use_reply_mail']) { ?><input type="checkbox" name="bd_reply_mail" value="1" <?=$chk_bd_reply_mail?>> 답변메일수신&nbsp;&nbsp;<? } ?>
		</td>
	</tr>
<? } ?>
<? if($wcfg['input_name']) { ?>
	<tr>
		<th width="120">작성자</th>
		<td><input name="bd_name" type="text" value="<?=$bd_name?>" class="input" required hname="작성자">
		</td>
	</tr>
<? } ?>
<? if($wcfg['input_pass']) { ?>
	<tr>
		<th>암호</th>
		<td><input name="bd_pass" type="password" value="" class="input"></td>
	</tr>
<? } ?>
<? if($wcfg['input_email']) { ?>
	<tr>
		<th>이메일</th>
		<td><input name="bd_email" type="text" class="input" value="<?=$bd_email?>" size="40">
		</td>
	</tr>
<? } ?>
<? if($wcfg['use_home']) { ?>
	<tr>
    <th>홈페이지</th>
	  <td><input name="bd_home" type="text" class="input" value="<?=$bd_home?>" size="60"></td>
  </tr>
<? } ?>
<? if($wcfg['use_category']) { ?>
	<tr>
    <th>분류</th>
	  <td><select name="cat_num">
<option value="">==선택==</option>
<?=rg_html_option($_category_info,$cat_num,'cat_num','cat_name')?>
</select></td>
  </tr>
<? } ?>
	<tr>
		<th>제목</th>
		<td><input name="bd_subject" type="text" class="input" value="<?=$bd_subject?>" size="60" required hname="제목"></td>
	</tr>
	<tr>
		<th>내용</th>
		<td>
<? if($wcfg['use_html']) { ?>
<input type="hidden" name="bd_html" value="1">
<?
include("../fckeditor/fckeditor.php");
$oFCKeditor = new FCKeditor('bd_content');
$oFCKeditor->BasePath = $_url['site'].'fckeditor/';
$oFCKeditor->Value = rg_html_entity($bd_content,1);
$oFCKeditor->Height = 300;
$oFCKeditor->ToolbarSet = 'rgboard';
//$oFCKeditor->Config['CustomConfigurationsPath'] = '/fckeditor/user_config.js' ;
$oFCKeditor->Create();
?>
<? } else { ?>
<TEXTAREA name="bd_content" rows="10" cols="60" class="input" required hname="내용"><?=$bd_content?></TEXTAREA>
<? } ?>
    </td>
	</tr>
<?
	if($wcfg['use_link']) { 
		for($i=0;$i<$wcfg['link_count'];$i++) {
?>
	<tr>
    <th>링크 #<?=($i+1)?></th>
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
    <th>첨부파일 #<?=($i+1)?></th>
		<td>
			<input type="file" name="bd_files[<?=$i?>]" class="input" size="40">
			<br />
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
		<th>스팸방지</th>
		<td><?=$spam_chk_img?> 좌측의 문자를 입력해주세요.
		<input name="spam_chk" type="text" class="input" size="10" required hname="스팸방지코드">
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
?><input type="submit" value=" 등   록 " class="button"><?
		break;
		case 'reply' :
?><input type="submit" value=" 등   록 " class="button"><?
		break;
		case 'modify' :
?><input type="submit" value=" 수   정 " class="button"><?
		break;
	}
?>
			<input type="button" value=" 취   소 " onClick="history.back();" class="button">
		</td>
	</tr>
</table>
</form>