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
<table border="0" cellpadding="1" cellspacing="1" width="100%">
		<TR> 
			<TD style="font-weight:bold;"><? if($mode=='write') echo "새글 등록"; elseif($mode=='modify') echo "글 수정"; else echo "답변글 등록";?></td>
		 <td align=right><font color=red><b><b>*</b></b></font> 표시가 있는 부분은 필수항목입니다.<B>&nbsp;</B>
			</TD>
		</TR>
	<tr bgcolor="#cccccc" height="1">
		<td colspan="2"></td>
	</tr>
<? if($wcfg['use_notice'] || $wcfg['use_secret'] || $wcfg['use_reply_mail']) { ?>
	<tr bgcolor="#f7f7f7">
		<td width="120" align="center" bgcolor="#E8ECF1"><strong>글종류</strong></td>
		<td><? if($wcfg['use_notice']) { ?><input type="checkbox" name="bd_notice" value="1" <?=$chk_bd_notice?>>공지사항&nbsp;&nbsp;<? } ?>
		<? if($wcfg['use_secret']) { ?><input type="checkbox" name="bd_secret" value="1" <?=$chk_bd_secret?>>비밀글&nbsp;&nbsp;<? } ?>
		<? if($wcfg['use_reply_mail']) { ?><input type="checkbox" name="" value="1" <?=$chk_bd_reply_mail?>>답변메일수신&nbsp;&nbsp;<? } ?>
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
<? if($wcfg['input_name']) { ?>
	<tr bgcolor="#f7f7f7">
		<td width="120" align="center" bgcolor="#E8ECF1"><font color=red><b><b>*</b></b></font> <strong>작성자</strong></td>
		<td><input name="bd_name" type="text" value="<?=$bd_name?>" class="input" style="width:90%;" >
		</td>
	</tr>
<? } ?>
<? if($wcfg['input_pass']) { ?>
	<tr bgcolor="#f7f7f7">
		<td align="center" bgcolor="#E8ECF1"><font color=red><b><b>*</b></b></font> <strong>암호</strong></td>
		<td><input name="bd_pass" type="password" value="" class="input" style="width:90%;"></td>
	</tr>
<? } ?>
<? if($wcfg['input_email']) { ?>
	<tr bgcolor="#f7f7f7">
		<td align="center" bgcolor="#E8ECF1"><strong>이메일</strong></td>
		<td><input name="bd_email" type="text" class="input" style="width:90%;" value="<?=$bd_email?>" size="40">
		</td>
	</tr>
<? } ?>
<? if($wcfg['use_home']) { ?>
	<tr bgcolor="#f7f7f7">
    <td align="center" bgcolor="#E8ECF1"><strong>홈페이지</strong></td>
	  <td><input name="bd_home" type="text" class="input" style="width:90%;" value="<?=$bd_home?>" size="60"></td>
  </tr>
<? } ?>
<? if($wcfg['use_category']) { ?>
	<tr bgcolor="#f7f7f7">
    <td align="center" bgcolor="#E8ECF1"><strong>분류</strong></td>
	  <td><select name="cat_num">
<option value="">==선택==</option>
<?=rg_html_option($_category_info,$cat_num,'cat_num','cat_name')?>
</select></td>
  </tr>
<? } ?>
	<tr bgcolor="#f7f7f7">
    <td align="center" bgcolor="#E8ECF1"><strong>학교명</strong></td>
	  <td><input name="bd_ext5" type="text" class="input" style="width:90%;" value="<?=$bd_ext5?>" size="60"></td>
  </tr>

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
	<tr bgcolor="#f7f7f7">
		<td align="center" bgcolor="#E8ECF1"><font color=red><b><b>*</b></b></font> <strong>제목</strong></td>
		<td><input name="bd_subject" type="text" class="input" style="width:90%;" value="<?=$bd_subject?>" size="60"></td>
	</tr>
	<tr bgcolor="#f7f7f7">
		<td colspan="2"><?=myEditor(1,'../editor','write_form','bd_content','100%','250');?></td>
	</tr>
<?
	if($wcfg['use_link']) { 
		for($i=0;$i<$wcfg['link_count'];$i++) {
?>
	<tr bgcolor="#f7f7f7">
    <td align="center" bgcolor="#E8ECF1"><strong>링크 #<?=($i+1)?></strong></td>
	  <td>
	<table border="0" cellpadding="0" cellspacing="0" width="90%">
	<!--  
	  <tr>
	    <td width="40" align="center">이름</td><td><input name="bd_links[<?=$i?>][name]" type="text" class="input" style="width:100%;" value="<?=$bd_links[$i]['name']?>" size="60"></td>
	   </tr>
   -->
	   <tr>
	     <td align="center">URL</td><td><input name="bd_links[<?=$i?>][url]" type="text" class="input" style="width:100%;" value="<?=$bd_links[$i]['url']?>" size="60"></td>
	  </tr>
	</table>
	</td>
  </tr>
<?
		}
	}
?>
<?
	if($wcfg['use_upload']) {
		for($i=0;$i<$wcfg['upload_count'];$i++) {
?>
	<tr bgcolor="#f7f7f7">
    <td align="center" bgcolor="#E8ECF1"><strong>첨부파일 #<?=($i+1)?></strong></td>
		<td>
			<input type="file" name="bd_files[<?=$i?>]" class="input" style="width:90%;" size="60">
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
	<tr bgcolor="#f7f7f7">
		<td align="center" bgcolor="#E8ECF1"><font color=red><b>*</b></font><strong>스팸방지</strong></td>
		<td><?=$spam_chk_img?> 왼쪽 문자를 입력해주세요.
		<input name="spam_chk" type="text" class="input" size="15">
		<input name="spam_chk_code" type="hidden" value="<?=$spam_chk_code?>"></td>
	</tr>
<? } ?>
	<tr bgcolor="#cccccc" height="1">
		<td colspan="2"></td>
	</tr>
</table>

<table width="100%" border="0">
	<tr>
		<td align="center">
			<input type="image" src="<?=$skin_url?>images/confirm.gif" align="absmiddle" onClick="editor_wr_ok();"> 
			<img src="<?=$skin_url?>images/cancel.gif" onClick="history.back();" style="cursor:pointer" align="absmiddle">
		</td>
	</tr>
</table>
</form>