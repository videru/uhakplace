<?
/* =====================================================


���ϼ��� : ���ۼ�

��������
$mode : ���ۼ����(write,modify,replay)
$bd_num : �ۼ���,�亯�� �� ��� �۹�ȣ
$old_pass : �ۼ����� ���� ��ȣ
$wcfg['use_notice'] : ��������
$wcfg['use_secret'] : ��б�
$wcfg['use_reply_mail'] : �����
$wcfg['input_name'] : �̸��Է¿���
$wcfg['input_pass'] : ��ȣ�Է¿���
$wcfg['input_email'] : �̸����Է¿���
$wcfg['use_home'] : Ȩ������
$wcfg['use_category'] : ī�װ�
$wcfg['use_html'] : html���
$wcfg['use_link'] : ��ũ���
$wcfg['use_upload'] : ���ε�
$vcfg['spam_chk'] : ����üũ����
$spam_chk_img : �����̹���
$spam_chk_code : ����üũ�ڵ�(����°���)
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
		<td colspan="3"><? if($wcfg['use_notice']) { ?><input type="checkbox" name="bd_notice" value="1" <?=$chk_bd_notice?>> ��������&nbsp;&nbsp;<? } ?>
		<? if($wcfg['use_secret']) { ?><input type="checkbox" name="bd_secret" value="1" <?=$chk_bd_secret?>> ��б�&nbsp;&nbsp;<? } ?>
		<? if($wcfg['use_reply_mail']) { ?><input type="checkbox" name="bd_reply_mail" value="1" <?=$chk_bd_reply_mail?>> �亯���ϼ���&nbsp;&nbsp;<? } ?>
		</td>
	</tr>
    <tr>
		<td colspan="4" height="1" bgcolor="#3694D4"></td>
    </tr>
<? } ?>
<? if($_mb[mb_level]>9) { ?>
	<tr>
		<th width="120">�ۼ���</th>
		<td><input name="bd_write_date1" type="text" value="<?=$bd_write_date1?>" class="input" size="4">��<input name="bd_write_date2" type="text" value="<?=$bd_write_date2?>" class="input" size="2">��<input name="bd_write_date3" type="text" value="<?=$bd_write_date3?>" class="input" size="2">��   ��ȸ�� <input name="view_hit" type="text" value="<?=$bd_view_count?>" class="input" size="5">
		</td>
	</tr>
<? } ?>

<? if($wcfg['input_name']) { ?>
	<tr height="25">
		<td width="120" align="center" bgcolor="#F0F0F4"><strong>�ۼ���</strong></td>
		<td>&nbsp;<input name="bd_name" type="text" value="<?=$bd_name?>" class="input2">
		</td>
<?if($wcfg['input_pass']) { ?>
		<td align="center" bgcolor="#F0F0F4" width="120"><strong>��ȣ</strong></td>
		<td>&nbsp;<input name="bd_pass" type="password" value="" class="input2"></td>
<? } ?>
	</tr>
    <tr>
		<td colspan="4" height="1" bgcolor="#3694D4"></td>
    </tr>
<? } ?>
<? if($wcfg['input_email']) { ?>
	<tr height="25">
		<td align="center" bgcolor="#F0F0F4"><strong>�̸���</strong></td>
		<td>&nbsp;<input name="bd_email" type="text" class="input2" value="<?=$bd_email?>" size="30">
		</td>
<? } ?>
<? if($wcfg['use_home']) { ?>
    <td align="center" bgcolor="#F0F0F4" width="120"><strong>Ȩ������</strong></td>
	<td >&nbsp;<input name="bd_home" type="text" class="input2" value="<?=$bd_home?>" size="30"></td>
<? } ?>
	</tr>
    <tr>
		<td colspan="4" height="1" bgcolor="#3694D4"></td>
    </tr>

<? if($wcfg['use_category']) { ?>
	<tr height="25">
    <td align="center" bgcolor="#F0F0F4"><strong>�з�</strong></td>
	  <td>&nbsp;<select name="cat_num">
<option value="">==����==</option>
<?=rg_html_option($_category_info,$cat_num,'cat_num','cat_name')?>
</select></td>
  </tr>
    <tr>
		<td colspan="4" height="1" bgcolor="#3694D4"></td>
    </tr>
<? } ?>

	<tr height="25">
		<td align="center" bgcolor="#F0F0F4"><strong>����</strong></td>
		<td colspan="3">&nbsp;<input name="bd_subject" type="text" class="input2" value="<?=$bd_subject?>" size="80"><? if($_mb[mb_level]>9) { ?><br/><input type="radio" name="bd_ext5" value="0" <?if($bd_ext5==0){ echo "checked";}?>>�⺻���� <input type="radio" name="bd_ext5" value="1" <?if($bd_ext5==1){ echo "checked";}?>>�Ķ��� <input type="radio" name="bd_ext5" value="2" <?if($bd_ext5==2){ echo "checked";}?>>������<? } ?> <input type="checkbox" name="bd_ext4" value="1" <?if($bd_ext4==1){ echo "checked";}?>>����</td>
	</tr>
    <tr>
		<td colspan="4" height="1" bgcolor="#3694D4"></td>
    </tr>
<? if($_mb[mb_level]>9) { ?>
	<tr height="25">
    <td align="center" bgcolor="#F0F0F4"><strong>�÷�����</strong></td>
	  <td>&nbsp;<script src='<?=$_url['site']?>/anicon/anicon_layer.js'></script> 
<input type='checkbox' name=anicon onclick='chk_anicon(this)'> 
<input name="bd_ext2" type=text readonly id="bd_ext2" value="<?=$bd_ext2?>" itemname='�ִ���' style="width:120;height:18;"> 
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
		<td align="center" bgcolor="#F0F0F4"><strong>����</strong></td>
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
    <td align="center" bgcolor="#F0F0F4"><strong>��ũ #<?=($i+1)?></strong></td>
	  <td colspan="3">�̸� : <input name="bd_links[<?=$i?>][name]" type="text" class="input2" value="<?=$bd_links[$i]['name']?>" size="60"><br>
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
    <td align="center" bgcolor="#F0F0F4"><strong>÷������ #<?=($i+1)?></strong></td>
		<td colspan="3">&nbsp;<input type="file" name="bd_files[<?=$i?>]" class="input2" size="40">
			<br />
			<? if($bd_files[$i][name]!='') { ?>
			<?=$bd_files[$i][name]?>
			<input type="checkbox" name="bd_files_del[<?=$i?>]" value="1" />
			����
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
		<td align="center" bgcolor="#F0F0F4"><strong>���Թ���</strong></td>
		<td colspan="3"><?=$spam_chk_img?> ������ ���ڸ� �Է����ּ���.
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