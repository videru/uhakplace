<? if (!defined('RGBOARD_VERSION')) exit; ?>
<?
/* =====================================================
 ���α׷��� : �������� V4 �Խ��ǽ�Ų

���ϼ��� : �ڸ�Ʈ��ƾ

��������
$_bbs_auth['comment'] : �ڸ�Ʈ �Է¿���
$bd_num : �۹�ȣ
$vcfg['input_name'] : �̸��Է¹�����
$bc_name : �̸�
$vcfg['spam_chk'] : ����üũ����
$spam_chk_img : �����̹���
$spam_chk_code : ����üũ�ڵ�(����°���)
$comment_delete_chk : �ڸ�Ʈ���� ���ɿ���
$comment_delete_url : �ڸ�Ʈ���� �ּ�
$bc_write_date : �ڸ�Ʈ �ۼ���
$bc_content : �ڸ�Ʈ����
===================================================== */
?>
<? if($_bbs_auth['comment']) { // �ڸ�Ʈ ���⿩�� ?>
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
      <textarea name="bc_content" cols="60" rows="5" style="width:100%" class="input" required hname="����"></textarea>
    </td>
    <td width="80">
      <input type="submit" value="����ϱ�" class="button" style="width:95%;height:70">
    </td>
  </tr>
<? if($vcfg['input_name']) { ?>
  <tr>
    <td>
    �ۼ��� : <input type="text" name="bc_name" value="<?=$bc_name?>" class="input" required hname="�ۼ���">
    </td>
    <td colspan="2">
    ��ȣ : <input type="password" name="bc_pass" class="input">
    </td>
  </tr>
<? } else { ?>
  <tr>
    <td colspan="3">
    �ۼ��� : <?=$bc_name?>
    </td>
  </tr>
<? } ?>
<? if($vcfg['spam_chk']) { ?>
  <tr>
    <td colspan="3">
      ���Թ��� : <?=$spam_chk_img?> ������ ���ڸ� �Է����ּ���.
    <input name="spam_chk" type="text" class="input" size="10" required hname="���Թ����ڵ�">
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
		alert('�Ѱ��̻� ���� �ϼ���.');
		return;
	}
	if(!confirm('�����Ͻðڽ��ϱ�?')){
		return;
	}
	
	document.cmt_list_form.mode.value='comment_delete';
	document.cmt_list_form.mode2.value='select';
	document.cmt_list_form.submit();
}
</script>
��ü : <input type="checkbox" onClick="set_checkbox(cmt_list_form,'chk_cnums[]',this.checked)" class="none">

<input type="button" value="���� �ڸ�Ʈ����" class="button" onclick="comment_delete_select();">
<? } ?>
</form>
