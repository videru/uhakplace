<?
/* =====================================================

  ���������� : 
 ===================================================== */
	include_once("../include/lib.php");
	include_once($_path['inc']."lib_bbs.php");
	
	if($_bbs_auth['admin']) {
		if($_SERVER['REQUEST_METHOD']=='POST' && $mode) {
			$chk_nums=explode(',',$nums);
			rg_array_recursive_function($chk_nums,'intval');
			sort($chk_nums);
			$nums=implode(",",$chk_nums);
			switch($mode) {
				case 'move' :
					// �׷�����
					$rs->clear();
					$rs->set_table($_table['bbs_cfg']);
					$rs->add_field('bbs_db_num');
					$rs->add_field('gr_num');
					$rs->add_where("bbs_num=$target_bbs_num");
					$rs->fetch('bbs_db_num,gr_num');
					
					// �Խ��� �ڵ� ������Ʈ
					$rs->clear();
					$rs->set_table($_table['bbs_body']);
					$rs->add_field("bbs_db_num",$bbs_db_num);
					$rs->add_field("gr_num",$gr_num);
					$rs->add_where("bbs_db_num={$_bbs_info['bbs_db_num']}");
					$rs->add_where("bd_num IN ($nums)");
					$rs->update();
				break;
				case 'delete' :
					// �ڸ�Ʈ����
					$rs->clear();
					$rs->set_table($_table['bbs_comment']);
					$rs->add_where("bbs_db_num={$_bbs_info['bbs_db_num']}");
					$rs->add_where("bd_num IN ($nums)");
					$rs->delete();	
					
					$rs->clear();
					$rs->set_table($_table['bbs_body']);
					$rs->add_where("bbs_db_num={$_bbs_info['bbs_db_num']}");
					$rs->add_where("bd_num IN ($nums)");
					// ���ϻ���				
					while($data=$rs->fetch()) {
						$data['bd_files']=unserialize($data['bd_files']);
						rg_upload_file_delete($_path['bbs_data'],$data['bd_files']);
					}
					// �ۻ���
					$rs->delete();
				
				break;
				case 'category' :
					$rs->clear();
					$rs->set_table($_table['bbs_body']);
					$rs->add_field('cat_num',$cat_num);
					$rs->add_where("bbs_db_num={$_bbs_info['bbs_db_num']}");
					$rs->add_where("bd_num IN ($nums)");
					$rs->update();
				break;
			}
			$rs->commit();
?>
<script language="javascript">
	opener.location.reload();
	self.close();
</script>
<?
			exit;
		}
	
		$nums=implode(",",$chk_nums);
		
		// ��ü�������̰ų� �׷�����ڶ��
		if($_auth['admin'] || $_auth['group_admin']) {
			$rs_group=new $rs_class($dbcon);
			$rs_group->set_table($_table['group']);
			$rs_group->add_field('gr_name');
			
			$rs->clear();
			$rs->set_table($_table['bbs_cfg']);
			$rs->add_where("bbs_db<>'{$_bbs_info['bbs_db']}'");
			$rs->add_order("gr_num");
			$rs->add_order("bbs_num");
			
			if(!$_auth['admin']) {
				$rs->add_where("gr_num={$_group_info['gr_num']}");
			}
			$bbs_list=array();
			while($R=$rs->fetch()) {
				$rs_group->add_where("gr_num=$R[gr_num]");
				$rs_group->fetch('gr_name');
				$rs_group->free_result();
				$rs_group->clear_where();
				$R['gr_name']=$gr_name;
				$R['bbs_gr_name']=$gr_name.'>'.$R[bbs_name];
				$bbs_list[]=$R;
			}
		}
	}
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
<? if($_bbs_auth['admin']) { ?>
<table width="300" align="center" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td height="10">
		</td>
	</tr>
	<tr>
		<td>
		<form name="board_manager_form" method="post" action="?">
		<input type="hidden" name="bbs_code" value="<?=$bbs_code?>">
		<input type="hidden" name="nums" value="<?=$nums?>">
		<input type="hidden" name="mode" value="">		
		<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td height="3" bgcolor="#54A8BA"><img width="1" height="1"></td>
			</tr>
			<tr>
				<td height="28" bgcolor="#F4FAFB">&nbsp;&nbsp;�Խ��� ���� <?=$bbs_code?>(<?=$_bbs_info['bbs_name']?>)</td>
			</tr>
		</table>
<? if($_auth['admin'] || $_auth['group_admin']) { ?>
		<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td height="1" bgcolor="#54A8BA"><img width="1" height="1"></td>
			</tr>
		</table>
		<table width="300" align="center" border="0" cellpadding="0" cellspacing="6">
			<tr>
			  <td align="center">
        <select name="target_bbs_num">
<?=rg_html_option($bbs_list,NULL,'bbs_num','bbs_gr_name')?>
        </select>
        <input type="button" class="button" onClick="board_manager_form.mode.value='move';board_manager_form.submit()" value=" �̵��ϱ� ">
				</td>
			  </tr>
			</table>
<? } ?>
<? if($_bbs_info['use_category']) { ?>
		<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td height="1" bgcolor="#54A8BA"><img width="1" height="1"></td>
			</tr>
		</table>
		<table width="300" align="center" border="0" cellpadding="0" cellspacing="6">
			<tr>
				<td align="center"><span class="line1">ī�װ� ����:
            <select name="cat_num">
<?=rg_html_option($_category_info,NULL,'cat_num','cat_name')?>
            </select>
            <input type="button" class="button" onClick="board_manager_form.mode.value='category';board_manager_form.submit()" value=" �� �� ">
				</span></td>
				</tr>
		</table>
<? } ?>	
		<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td height="1" bgcolor="#54A8BA"><img width="1" height="1"></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td align="center">
				<input type="button" class="button" onClick="if(!confirm('Ȯ���մϱ�?')) return false;board_manager_form.mode.value='delete';board_manager_form.submit()" value=" �� �� ">
				<input type="button" class="button" value="  ��  ��  " onClick="self.close()">
					</td>
			</tr>
		</table>
		</form>
		</td>
	</tr>
</table>
<? } else { ?>
<table width="300" align="center" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="10"></td>
  </tr>
  <tr>
    <td>
      <table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td height="3" bgcolor="#54A8BA"><img width="1" height="1"></td>
        </tr>
        <tr>
          <td height="28" bgcolor="#F4FAFB">&nbsp;&nbsp;�Խ��� ����</td>
        </tr>
      </table>
			<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td height="1" bgcolor="#54A8BA"><img width="1" height="1"></td>
				</tr>
			</table>
			<table width="300" align="center" border="0" cellpadding="0" cellspacing="6">
				<tr>
					<td align="center">������ �����ϴ�. </td>
					</tr>
			</table>
      <table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td height="1" bgcolor="#54A8BA"><img width="1" height="1"></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td align="center"><input name="button" type="button" class="button" onClick="self.close()" value="  ��  ��  ">          </td>
        </tr>
      </table></td></tr>
</table>
<? } ?>
</body>
</html>
