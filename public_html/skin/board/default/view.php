<? if (!defined('RGBOARD_VERSION')) exit; ?>
<?
/* =====================================================
 ���α׷��� : �������� V4 �Խ��ǽ�Ų

���ϼ��� : �ۺ���

��������

$prev_data : ����������
$next_data : ����������
$vcfg['btn_modify'] : ������ưǥ�ÿ���
$vcfg['btn_del'] : ������ưǥ�ÿ���
$vcfg['btn_reply'] : �亯��ưǥ�ÿ���
$vcfg['btn_vote_yes'] : ��õ��ưǥ�ÿ���
$vcfg['btn_vote_no'] : �ݴ��ưǥ�ÿ���
$vcfg['btn_list'] : �۸�Ϲ�ưǥ�ÿ���

$bbs_code : �Խ����ڵ�
$bd_num : �۹�ȣ
$bd_name : �ۼ���
$bd_email : �̸���
$mb_id : �ۼ��ھ��̵�
$open_homepage : ���ۼ��� �Է��� Ȩ�������ּ�
$open_email : ���ۼ��� �Է��� �̸����ּ�
$open_profile : ȸ��������������
$open_memo : ����������
$mb_icon : ȸ��������

$bd_write_date : ���ۼ���
$bd_home : ��Ȩ������
$vcfg['use_category'] : ī�װ���뿩��
$cat_name : ī�װ���
$vcfg['btn_vote_yes'] : ����/��õ ��뿩��
$vcfg['btn_vote_no'] : �ݴ� ��뿩��
$bd_vote_yes : ����/��õ ��ǥ��
$bd_vote_no : �ݴ� ��ǥ��
$bd_subject : ������
$vcfg['view_image'] : �۳���� �̹����� �Բ�������
$bd_files : ÷����������(�迭)
$bd_content : �۳���
$bd_links : ��ũ���� (�迭)
$vcfg['use_download'] : �ٿ�ε忩��
$vcfg['view_signature'] : ����ǥ�ÿ���
$mb_signature : ����(ȸ���ΰ��)
$vcfg['view_comment'] : �ڸ�Ʈǥ�ÿ���
$vcfg['view_list'] : �۸��ǥ�� ����
===================================================== */
?>
<table width="100%" border="0">
	<tr>
		<td align="left">
<? if($prev_data) { ?>
		<input type="button" value="����" onClick="location.href='<?=$url_view_prev?>'" class="button">
<? } ?>
<? if($next_data) { ?>
		<input type="button" value="����" onClick="location.href='<?=$url_view_next?>'" class="button">
<? } ?>
<? if($vcfg['btn_modify']) { ?>	
		<input type="button" value="����" onClick="location.href='<?=$url_modify?>'" class="button">
<? } ?>
<? if($vcfg['btn_del']) { ?>	
		<input type="button" value="����" onClick="location.href='<?=$url_delete?>'" class="button">
<? } ?>
<? if($vcfg['btn_reply']) { ?>	
		<input type="button" value="�亯" onClick="location.href='<?=$url_reply?>'" class="button">
<? } ?>
<? if($vcfg['btn_vote_yes']) { ?>	
		<input type="button" value="��õ" onClick="location.href='<?=$url_vote_yes?>'" class="button">
<? } ?>
<? if($vcfg['btn_vote_no']) { ?>	
		<input type="button" value="�ݴ�" onClick="location.href='<?=$url_vote_no?>'" class="button">
<? } ?>
		</td>
		<td align="right">
<? if($vcfg['btn_list']) { ?>
		<input type="button" value="��Ϻ���" onClick="location.href='<?=$url_list?>'" class="button">
<? } ?>
		</td>
	</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" width="100%" class="default_bbs_content">
	<tr>
		<th width="120">�ۼ���</th>
		<td><?=$bd_name_layer?></td>
	</tr>
	<tr>
		<th width="120">�ۼ���</th>
		<td><?=$bd_write_date?></td>
	</tr>
<? if($bd_home) { ?>
	<tr>
    <th>Ȩ������</th>
	  <td><?=$bd_home?></td>
  </tr>
<? } ?>
<? if($vcfg['use_category']) { ?>
	<tr>
    <th>�з�</th>
	  <td><?=$cat_name?></td>
  </tr>
<? } ?>
<? if($vcfg['btn_vote_yes'] || $vcfg['btn_vote_no']) { ?>
	<tr>
    <th>&nbsp;</th>
	  <td><? if($vcfg['btn_vote_yes']) { ?>��õ : <?=$bd_vote_yes?><? } ?>
				<? if($vcfg['btn_vote_yes'] && $vcfg['btn_vote_no']) { ?> / <? } ?>
				<? if($vcfg['btn_vote_no']) { ?>�ݴ� : <?=$bd_vote_no?><? } ?></td>
  </tr>
<? } ?>
	<tr>
		<th>����</th>
		<td><?=$bd_subject?></td>
	</tr>
	<tr>
		<th>����</th>
		<td style='word-break:break-all'>
<?
	if($vcfg['view_image']) {
?>
<img id="view_image_width" height="0" width="100%"><br />
<script language="JavaScript" type="text/JavaScript">
if(onload) var set_img_old_onload=onload;
onload=set_img_width_init;
</script>
<?
		foreach($bd_files as $k => $v) {
			if(!rg_file_type_chk($v['type'],'image')) continue;
?>
<img src="<?=$v['view_url']?>" onclick="view_image_popup(this)" style="cursor:hand;" id="view_image"><br><br>
<? 	}
	}
?>		
		
		<?=$bd_content?></td>
	</tr>
<?
	if(is_array($bd_links) && (count($bd_links) > 0)) {
?>
	<tr>
    <th>��ũ</th>
	  <td>
<?
		foreach($bd_links as $k => $v) {
			if($v['url']=='') continue;
			if($v['name']=='') $v['name']=$v['url'];
?>
<a href="<?=$v['link_url']?>" target="_blank"><?=$v['name']?>&nbsp;&nbsp;(<?=number_format($v['hits'])?>)</a><br>
<? 	} ?>
		</td>
  </tr>
<?
	}
?>
<?
	if($vcfg['use_download']) {
?>
	<tr>
    <th>÷������</th>
		<td>
<?
		foreach($bd_files as $k => $v) {
			if($v['name']=='') continue;
?>
<a href="<?=$v['down_url']?>"><?=$v['name']?>&nbsp;&nbsp;Down:<?=number_format($v['hits'])?></a><br>
<? 	} ?>
		</td>
	</tr>
<?
	}
?>
<? if($vcfg['view_signature']) { ?>
	<tr>
    <th>����</th>
		<td>
<?=$mb_signature?>
		</td>
	</tr>
<? } ?>
</table>

<?
	if($vcfg['view_comment']) // �ڸ�Ʈ ǥ�ÿ��� 
		if(file_exists($skin_path."view_comment.php")) include($skin_path."view_comment.php");
?>


<table width="100%" border="0">
	<tr>
		<td align="left">
<? if($prev_data) { ?>
		<input type="button" value="����" onClick="location.href='<?=$url_view_prev?>'" class="button">
<? } ?>
<? if($next_data) { ?>
		<input type="button" value="����" onClick="location.href='<?=$url_view_next?>'" class="button">
<? } ?>
<? if($vcfg['btn_modify']) { ?>	
		<input type="button" value="����" onClick="location.href='<?=$url_modify?>'" class="button">
<? } ?>
<? if($vcfg['btn_del']) { ?>	
		<input type="button" value="����" onClick="location.href='<?=$url_delete?>'" class="button">
<? } ?>
<? if($vcfg['btn_reply']) { ?>	
		<input type="button" value="�亯" onClick="location.href='<?=$url_reply?>'" class="button">
<? } ?>
<? if($vcfg['vote_yes']) { ?>	
		<input type="button" value="��õ" onClick="location.href='<?=$url_vote_yes?>'" class="button">
<? } ?>
<? if($vcfg['vote_no']) { ?>	
		<input type="button" value="�ݴ�" onClick="location.href='<?=$url_vote_no?>'" class="button">
<? } ?>
		</td>
		<td align="right">
<? if($vcfg['btn_list']) { ?>
		<input type="button" value="��Ϻ���" onClick="location.href='<?=$url_list?>'" class="button">
<? } ?>
		</td>
	</tr>
</table>
<? if($vcfg['view_list']) { ?>
<br>
<table width="100%" border="0">
	<tr>
		<td>
<? include('list_main_process.php'); ?>
		</td>
	</tr>
</table>
<? } ?>
