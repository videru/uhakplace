<? if (!defined('RGBOARD_VERSION')) exit; ?>
<?
/* =====================================================
 ���α׷��� : �������� V4 �Խ��ǽ�Ų

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
?>
<form name="write_form" method="post" action="?<?=$_get_param[3]?>" onSubmit="return validate(this)" enctype="multipart/form-data">
<input type="hidden" name="mode" value="<?=$mode?>">
<input type="hidden" name="act" value="ok">
<input type="hidden" name="bd_num" value="<?=$bd_num?>">
<input type="hidden" name="old_pass" value="<?=$old_pass?>">
<table border="1" cellpadding="3" cellspacing="0" width="600" bordercolordark="white" bordercolorlight="#E1E1E1">
<? if($wcfg['use_notice'] || $wcfg['use_secret'] || $wcfg['use_reply_mail']) { ?>
	<tr>
		<td width="120" align="center" bgcolor="#F0F0F4">&nbsp;</td>
		<td><? if($wcfg['use_notice']) { ?><input type="checkbox" name="bd_notice" value="1" <?=$chk_bd_notice?>> ��������&nbsp;&nbsp;<? } ?>
		<? if($wcfg['use_secret']) { ?><input type="checkbox" name="bd_secret" value="1" <?=$chk_bd_secret?>> ��б�&nbsp;&nbsp;<? } ?>
		<? if($wcfg['use_reply_mail']) { ?><input type="checkbox" name="bd_reply_mail" value="1" <?=$chk_bd_reply_mail?>> �亯���ϼ���&nbsp;&nbsp;<? } ?>
		</td>
	</tr>
<? } ?>
<? if($wcfg['input_name']) { ?>
	<tr>
		<td width="120" align="center" bgcolor="#F0F0F4"><strong>�ۼ���</strong></td>
		<td><input name="bd_name" type="text" value="<?=$bd_name?>" class="input">
		</td>
	</tr>
<? } ?>
<? if($wcfg['input_pass']) { ?>
	<tr>
		<td align="center" bgcolor="#F0F0F4"><strong>��ȣ</strong></td>
		<td><input name="bd_pass" type="password" value="" class="input"></td>
	</tr>
<? } ?>
<? if($wcfg['input_email']) { ?>
	<tr>
		<td align="center" bgcolor="#F0F0F4"><strong>�̸���</strong></td>
		<td><input name="bd_email" type="text" class="input" value="<?=$bd_email?>" size="40">
		</td>
	</tr>
<? } ?>
<? if($wcfg['use_home']) { ?>
	<tr>
    <td align="center" bgcolor="#F0F0F4"><strong>Ȩ������</strong></td>
	  <td><input name="bd_home" type="text" class="input" value="<?=$bd_home?>" size="60"></td>
  </tr>
<? } ?>
<? if($wcfg['use_category']) { ?>
	<tr>
    <td align="center" bgcolor="#F0F0F4"><strong>�з�</strong></td>
	  <td><select name="cat_num">
<option value="">==����==</option>
<?=rg_html_option($_category_info,$cat_num,'cat_num','cat_name')?>
</select></td>
  </tr>
<? } ?>
	<tr>
		<td align="center" bgcolor="#F0F0F4"><strong>����</strong></td>
		<td><input name="bd_subject" type="text" class="input" value="<?=$bd_subject?>" size="60"></td>
	</tr>
<? if($wcfg['use_html']) { ?>
	<tr>
		<td align="center" bgcolor="#F0F0F4"><strong>HTML</strong></td>
		<td><input type="radio" name="bd_html" value="0" <?=$chk_bd_html[0]?>>������&nbsp;&nbsp;
		<input type="radio" name="bd_html" value="1" <?=$chk_bd_html[1]?>>HTML���&nbsp;&nbsp;
		<input type="radio" name="bd_html" value="2" <?=$chk_bd_html[2]?>>HTML+&lt;BR&gt;</td>
	</tr>
<? } ?>
	<tr>
		<td align="center" bgcolor="#F0F0F4"><strong>����</strong></td>
		<td><textarea name="bd_content" cols="60" rows="10"><?=$bd_content?></textarea></td>
	</tr>
  <tr>
		<td align="center" bgcolor="#F0F0F4"><strong>�����׸�</strong></td>
		<td>
<? for($i=0;$i<5;$i++) { ?>
              <?=($i+1)?> : <input name="bd_ext1[<?=$i?>]" type="text" value="<?=$bd_ext1[$i]?>" class="box" size="60" style="width:50%"/> <input name="bd_ext2[<?=$i?>]" type="text" value="<?=$bd_ext2[$i]?>" class="box" size="4"/><br />
<? } ?>
    </td>
	</tr>
<?
	if($wcfg['use_link']) { 
		for($i=0;$i<$wcfg['link_count'];$i++) {
?>
	<tr>
    <td align="center" bgcolor="#F0F0F4"><strong>��ũ #<?=($i+1)?></strong></td>
	  <td>�̸� : <input name="bd_links[<?=$i?>][name]" type="text" class="input" value="<?=$bd_links[$i]['name']?>" size="60"><br>
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
    <td align="center" bgcolor="#F0F0F4"><strong>÷������ #<?=($i+1)?></strong></td>
		<td>
			<input type="file" name="bd_files[<?=$i?>]" class="input" size="40">
			<br />
			<? if($bd_files[$i][name]!='') { ?>
			<?=$bd_files[$i][name]?>
			<input type="checkbox" name="bd_files_del[<?=$i?>]" value="1" />
			����
			<? } ?>
		</td>
	</tr>
<?
		}
	}
?>
<? if($wcfg['spam_chk']) { ?>
	<tr>
		<td align="center" bgcolor="#F0F0F4"><strong>���Թ���</strong></td>
		<td><?=$spam_chk_img?> ������ ���ڸ� �Է����ּ���.
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
?><input type="submit" value=" ��   �� " class="button"><?
		break;
		case 'reply' :
?><input type="submit" value=" ��   �� " class="button"><?
		break;
		case 'modify' :
?><input type="submit" value=" ��   �� " class="button"><?
		break;
	}
?>
			<input type="button" value=" ��   �� " onClick="history.back();" class="button">
		</td>
	</tr>
</table>
</form>