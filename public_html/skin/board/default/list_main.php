<? if (!defined('RGBOARD_VERSION')) exit; ?>
<?
/* =====================================================
 ���α׷��� : �������� V4 �Խ��ǽ�Ų

���ϼ��� : �Խ��� �� ���

��������
$_bbs_info['use_category'] : ī�װ� �������
$cat_name : ī�װ���

$_post_param[0] : POST����� �⺻����, �Խ����ڵ常
$_post_param[3] : POST����� �⺻����, ��ü(�Խ����ڵ�,Ű����,����,����,������)

$_bbs_auth['cart'] : īƮ��뿩��
$_bbs_auth['write'] : �۾�����ѿ���
$_bbs_auth['admin'] : �����ڿ���

$bd_delete : ��������
$bd_secret : ��бۿ���
$bd_notice : �������׿���
$o_bd_num : �ֱٺ��۹�ȣ
$bd_num : ����۹�ȣ
$_url['bbs'] : �Խ���URL

$ss['cat'] : �˻� ī�װ�����
$url_all_list : �˻� action URL(list.php�� �ǹ�)
$kw : �˻�Ű����

$i_no : �ۼ�����ȣ
$i_reply : ����۵鿩����,������ (setup.php ���� ����)
$i_secret : ��б۾����� (setup.php ���� ����)
$i_new : �ֱٱ۾����� (setup.php ���� ����,ǥ�ýð��� �Խ��ǰ����ڿ���)
$i_comment_count : �ڸ�Ʈ���� (���´� setup.php ���� ����)
$view_url : �ۺ��� URL
$bd_subject : ������

$bbs_code : �Խ����ڵ�
$mb_icon : �ۼ��ڰ� ȸ���̸� ȸ��������
$mb_id : ȸ���̶�� ���̵�
$bd_name : �ۼ��ڸ�
$open_homepage : ���ۼ��� �Է��� Ȩ�������ּ�
$open_email : ���ۼ��� �Է��� �̸����ּ�
$open_profile : ȸ��������������
$open_memo : ����������

$bd_write_date : ���ۼ���
$bd_view_count : ����ȸ��
$bd_vote_yes : ��õ/���� ǥ��
$bd_vote_no : �ݴ� ǥ��

��Ÿ list_data_process.php �� ����� ����
===================================================== */
?>
	<tr height="25">
<? if($_bbs_auth['cart']) { ?>
		<td align="center"><input type=checkbox name="chk_nums[]" value="<?=$bd_num?>" class=none></td>
<? } ?>
		<td align="center"><?=$i_no?></td>
<? if($_bbs_info['use_category']) { ?>
		<td align="center"><?=$cat_name?><br></td>
<? } ?>
		<td><?=$i_reply?> <?=$i_secret?> <a href="<?=$view_url?>"><?=$bd_subject?></a> <?=$i_comment_count?> <?=$i_new?></td>
		<td align="center"><?=$bd_name_layer?></td>
		<td align="center"><?=$bd_write_date?></td>
		<td align="center"><?=$bd_view_count?></td>
		</tr>