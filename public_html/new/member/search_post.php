<?
/* =====================================================

  ���������� : 
	2007-12-10 $form_info,$dong ���� XSS ����� ����
 ===================================================== */
	include_once("../include/lib.php");
	$is_use=false;
	$form_info=rg_html_entity($form_info);
	$dong=rg_html_entity($dong);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link href="<?=$_url['css']?>style.css" rel="stylesheet" type="text/css">
</head>
<script src="<?=$_url['js']?>common.js"></script>
<script src="<?=$_url['js']?>lib.validate.js"></script>
<body bottommargin="0" topmargin="0" leftmargin="0" rightmargin="0">
<table width="430" align="center" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td height="10">
		</td>
	</tr>
	<tr>
		<td>
		<form name="login_form" method="post" action="?" onSubmit="return validate(this)" enctype='multipart/form-data'>
		<input type="hidden" name="form_info" value="<?=$form_info?>">
		<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td height="3" bgcolor="#54A8BA"><img width="1" height="1"></td>
			</tr>
			<tr>
				<td height="28" bgcolor="#F4FAFB">&nbsp;&nbsp;�����ȣã��</td>
			</tr>
			<tr>
				<td height="1" bgcolor="#54A8BA"><img width="1" height="1"></td>
			</tr>
		</table>
<? if($dbcon->list_tables($_table['zip'])) { ?>		
		<table width="100%" align="center" border="0" cellpadding="0" cellspacing="6">
			<tr>
			  <td align="center">
ã���� �ϴ� ������ '���̸�'�� �Է����ֽʽÿ�.<br>
�� : ����� ������ �Ｚ1���̶�� '�Ｚ1'�� �Է��Ͻø� �˴ϴ�. 
				</td>
			  </tr>
			<tr>
				<td height="1" bgcolor="#ECECEC"><img width="1" height="1"></td>
			</tr>
			</table>
		<table width="350" align="center" border="0" cellpadding="0" cellspacing="6">
			<tr>
				<td width="70" align="right"><strong>���̸�&nbsp;:</strong></td>
				<td align="center"><input type="text" class="input" name="dong" size="20" maxlength="12" minbyte="4"  hname="���̸�" required  value="<?=$dong?>"> ��(��/��)</td>
				<td width="70">
				  <input type="submit" class="button" value=" �˻� "></td>
			</tr>
		</table>
<? } else { ?>
		<table width="100%" align="center" border="0" cellpadding="0" cellspacing="6">
			<tr>
			  <td align="center">
�����ȣ���̺��� �����ϴ�.<br>
�����ڸ�忡�� �����ȣ ���̺��� �����Ͻʽÿ�.
				</td>
			  </tr>
			<tr>
				<td height="1" bgcolor="#ECECEC"><img width="1" height="1"></td>
			</tr>
			</table>
<? } ?>
		<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td height="1" bgcolor="#54A8BA"><img width="1" height="1"></td>
			</tr>
		</table>
<? if($dong!='') { ?>
<?
	list($form_name,$post1,$post2,$addr1,$addr2)=explode('|',$form_info);
	if($addr2!='') $form_addr2="opener.$form_name.$addr2";
?>
<script>
function submit_post(post,addr) {
post=post.split('-');
if(window.opener.document.getElementById('<?=$post1?>') != null) {
	window.opener.document.getElementById('<?=$post1?>').value = post[0];
	window.opener.document.getElementById('<?=$post2?>').value = post[1];
	window.opener.document.getElementById('<?=$addr1?>').value = addr;
<? if($form_addr2!='') { ?>
	window.opener.document.getElementById('<?=$addr2?>').focus();
<? } ?>    			    
}
else {
	window.opener.document.<?=$form_name?>.<?=$post1?>.value = post[0];
	window.opener.document.<?=$form_name?>.<?=$post2?>.value = post[1];
	window.opener.document.<?=$form_name?>.<?=$addr1?>.value = addr;
<? if($form_addr2!='') { ?>
	window.opener.document.<?=$form_name?>.<?=$addr2?>.focus();
<? } ?>   
}
self.close()
}
</script>
		<table width="98%" align="center" border="0" cellpadding="0" cellspacing="0">
<?
	$rs_list = new $rs_class($dbcon);
	$rs_list->clear();
	$rs_list->set_table($_table['zip']);
	$rs_list->add_order("seq");
	$rs_list->add_where("dong LIKE '%".$dbcon->escape_string($dong,DB_LIKE)."%' escape '".$dbcon->escape_ch."'");
	$rs_list->select();
	if($rs_list->num_rows()<1) {
		echo "
	<tr height=\"100\">
		<td align=\"center\"><B>���(�˻�) �� �ڷᰡ �����ϴ�.</td>
	</tr>";
	}
	$page_info=$rs_list->select_list($page,50,10);
	$no = $page_info['start_no'];
	while($R=$rs_list->fetch()) {
		$no--;
?>
			<tr>
				<td height="24" style="padding-left:5px"><a href="javascript:#" onClick="submit_post('<?=$R[zipcode]?>','<?=$R[sido]?> <?=$R[gugun]?> <?=$R[dong]?>');"><?=$R[zipcode]?> : <?=$R[sido]?> <?=$R[gugun]?> <?=$R[dong]?> <?=$R[bunji]?></a></td>
			</tr>
			<tr>
				<td height="1" bgcolor="#ECECEC"><img width="1" height="1"></td>
			</tr>
<?
	}
?>
			<tr>
				<td height="1" bgcolor="#54A8BA"><img width="1" height="1"></td>
			</tr>
			<tr>
				<td align="center"><?=rg_navi_display($page_info,"dong=$dong&form_info=$form_info"); ?></td>
			</tr>
		</table>	
<? } ?>		
		<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td align="center">
				<input type="button" class="button" value="  ��  ��  " onClick="self.close()">
					</td>
			</tr>
		</table>
		</form>		</td>
	</tr>
	<tr>
		<td height="10">
		</td>
	</tr>
</table>
</body>
</html>

