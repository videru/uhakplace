<? if (!defined('RGBOARD_VERSION')) exit; ?>
<form name="write_form" method="post" action="?<?=$_get_param[3]?>" onSubmit="return validate(this)" enctype="multipart/form-data">
<input type="hidden" name="mode" value="<?=$mode?>">
<input type="hidden" name="act" value="ok">
<input type="hidden" name="bd_num" value="<?=$bd_num?>">
<input type="hidden" name="old_pass" value="<?=$old_pass?>">
<table border="0" cellpadding="1" cellspacing="1" width="100%">
		<TR> 
			<TD style="font-weight:bold;"><? if($mode=='write') echo "���� ���"; elseif($mode=='modify') echo "�� ����"; else echo "�亯�� ���";?></td>
		 <td align=right><font color=red><b><b>*</b></b></font> ǥ�ð� �ִ� �κ��� �ʼ��׸��Դϴ�.<B>&nbsp;</B>
			</TD>
		</TR>
	<tr bgcolor="#cccccc" height="1">
		<td colspan="2"></td>
	</tr>
<? if($wcfg['use_notice'] || $wcfg['use_secret'] || $wcfg['use_reply_mail']) { ?>
	<tr bgcolor="#f7f7f7">
		<td width="120" align="center" bgcolor="#E8ECF1"><strong>������</strong></td>
		<td><? if($wcfg['use_notice']) { ?><input type="checkbox" name="bd_notice" value="1" <?=$chk_bd_notice?>>��������&nbsp;&nbsp;<? } ?>
		<? if($wcfg['use_secret']) { ?><input type="checkbox" name="bd_secret" value="1" <?=$chk_bd_secret?>>��б�&nbsp;&nbsp;<? } ?>
		<? if($wcfg['use_reply_mail']) { ?><input type="checkbox" name="bd_reply_mail" value="1" <?=$chk_bd_reply_mail?>>�亯���ϼ���&nbsp;&nbsp;<? } ?>
		</td>
	</tr>
<? } ?>
<? if($wcfg['input_name']) { ?>
	<tr bgcolor="#f7f7f7">
		<td width="120" align="center" bgcolor="#E8ECF1"><font color=red><b><b>*</b></b></font> <strong>�ۼ���</strong></td>
		<td><input name="bd_name" type="text" value="<?=$bd_name?>" class="input" style="width:90%;" required hname="�ۼ���">
		</td>
	</tr>
<? } ?>
<? if($wcfg['input_pass']) { ?>
	<tr bgcolor="#f7f7f7">
		<td align="center" bgcolor="#E8ECF1"><font color=red><b><b>*</b></b></font> <strong>��ȣ</strong></td>
		<td><input name="bd_pass" type="password" value="" class="input" style="width:90%;"></td>
	</tr>
<? } ?>
<? if($wcfg['input_email']) { ?>
	<tr bgcolor="#f7f7f7">
		<td align="center" bgcolor="#E8ECF1"><strong>�̸���</strong></td>
		<td><input name="bd_email" type="text" class="input" style="width:90%;" value="<?=$bd_email?>" size="40">
		</td>
	</tr>
<? } ?>
<? if($wcfg['use_home']) { ?>
	<tr bgcolor="#f7f7f7">
    <td align="center" bgcolor="#E8ECF1"><strong>Ȩ������</strong></td>
	  <td><input name="bd_home" type="text" class="input" style="width:90%;" value="<?=$bd_home?>" size="60"></td>
  </tr>
<? } ?>
<? if($wcfg['use_category']) { ?>
	<tr bgcolor="#f7f7f7">
    <td align="center" bgcolor="#E8ECF1"><strong>�з�</strong></td>
	  <td><select name="cat_num">
<option value="">==����==</option>
<?=rg_html_option($_category_info,$cat_num,'cat_num','cat_name')?>
</select></td>
  </tr>
<? } ?>
	<tr bgcolor="#f7f7f7">
		<td align="center" bgcolor="#E8ECF1"><font color=red><b><b>*</b></b></font> <strong>����</strong></td>
		<td><input name="bd_subject" type="text" class="input" style="width:90%;" value="<?=$bd_subject?>" size="60" required hname="����"></td>
	</tr>
<? if($wcfg['use_html']) { ?>
	<tr bgcolor="#f7f7f7">
		<td align="center" bgcolor="#E8ECF1"><strong>HTML</strong></td>
		<td><input type="radio" name="bd_html" value="0" <?=$chk_bd_html[0]?>>������&nbsp;&nbsp;
		<input type="radio" name="bd_html" value="1" <?=$chk_bd_html[1]?>>HTML���&nbsp;&nbsp;
		<input type="radio" name="bd_html" value="2" <?=$chk_bd_html[2]?>>HTML+&lt;BR&gt;</td>
	</tr>
<? } ?>
	<tr bgcolor="#f7f7f7">
		<td align="center" bgcolor="#E8ECF1">
		<SCRIPT LANGUAGE="JavaScript"> 
		<!-- //textarea ����ũ�� ����
		function formresize(mode) {
		    if (mode == "up") {
		        document.write_form.bd_content.rows = document.write_form.bd_content.rows + 2;
		    } else if (mode == "down") {
		        if (1 < document.write_form.bd_content.rows) {
		        document.write_form.bd_content.rows = document.write_form.bd_content.rows - 2;
	        }
	    }
		document.write_form.bd_content.focus();
		}
		//--> 
		</SCRIPT>
		<a style="cursor:pointer" title="�Է�â ���α��� ���̱�" onclick="formresize('down')">��</a><br>
		<font color=red><b>*</b></font> <strong>����</strong><br>
		<a style="cursor:pointer" title="�Է�â ���α��� �ø���" onclick="formresize('up')">��</a>
		</td>
		<td><textarea name="bd_content" cols="60" rows="10" style="width:90%;" required hname="����"><?=$bd_content?></textarea></td>
	</tr>
<?
	if($wcfg['use_link']) { 
		for($i=0;$i<$wcfg['link_count'];$i++) {
?>
	<tr bgcolor="#f7f7f7">
    <td align="center" bgcolor="#E8ECF1"><strong>��ũ #<?=($i+1)?></strong></td>
	  <td>�̸� : <input name="bd_links[<?=$i?>][name]" type="text" class="input" style="width:90%;" value="<?=$bd_links[$i]['name']?>" size="60"><br>
URL : <input name="bd_links[<?=$i?>][url]" type="text" class="input" style="width:90%;" value="<?=$bd_links[$i]['url']?>" size="60"></td>
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
    <td align="center" bgcolor="#E8ECF1"><strong>÷������ #<?=($i+1)?></strong></td>
		<td>
			<input type="file" name="bd_files[<?=$i?>]" class="input" style="width:90%;" size="40">
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
	<tr bgcolor="#f7f7f7">
		<td align="center" bgcolor="#E8ECF1"><font color=red><b>*</b></font><strong>���Թ���</strong></td>
		<td><?=$spam_chk_img?> ���� ���ڸ� �Է����ּ���.
		<input name="spam_chk" type="text" class="input" size="15" required hname="���Թ����ڵ�">
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
			<input type="image" src="<?=$skin_url?>images/confirm.gif" align="absmiddle"> 
			<img src="<?=$skin_url?>images/cancel.gif" onClick="history.back();" style="cursor:pointer" align="absmiddle">
		</td>
	</tr>
</table>
</form>