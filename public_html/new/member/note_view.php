<?
/* =====================================================

  ���������� : 
 ===================================================== */
	include_once("../include/lib.php");
	
	if(!$_mb)
		rg_href('','�α����� �̿����ּ���.','close');
	
	if(!$validate->number_only($num) && $mode!='new') {
		rg_href("",'�ùٸ� ������ �ƴմϴ�.','close');
		exit;
	}
	
	switch($mode) {
		case 'save_ok' : // ��������
			$rs->clear();
			$rs->set_table($_table['note']);
			$rs->add_field("nt_save","1");
			$rs->add_where("mb_num={$_mb['mb_num']}");
			$rs->add_where("nt_save!=1");
			$rs->add_where("nt_num=$num");
			$rs->update();
			$rs->commit();
			rg_href("",'���������Կ� ���� �߽��ϴ�..','close','','opener.location.reload()');
		break;
		case 'delete_ok' : // ��������
			$rs->clear();
			$rs->set_table($_table['note']);
			$rs->add_where("mb_num={$_mb['mb_num']}");
			$rs->add_where("nt_num=$num");
			$rs->delete();
			$rs->commit();
			rg_href("",'������ ���� �߽��ϴ�..','close','','opener.location.reload()');
		break;
		case 'new' : // ������Ȯ��
			$rs->clear();
			$rs->set_table($_table['note']);
			$rs->add_where("mb_num={$_mb['mb_num']}");
			$rs->add_where("recv_mb_num={$_mb['mb_num']}");
			$rs->add_where("nt_recv_date=0");
			$rs->add_where("nt_type=2");
			$rs->add_where("nt_save=0");
			$rs->add_order('nt_num'); // ���� ������ ���� Ȯ��
			$rs->set_limit('2');
			$data=$rs->fetch(); // ����Ȯ��
			$data_next=$rs->fetch(); // ��������Ȯ��(�ִٸ� ������ư���� Ȯ�� �Ҽ� �̵���)
		break;
		case 'recv' : // ��������Ȯ��
			$rs->clear();
			$rs->set_table($_table['note']);
			$rs->add_where("mb_num={$_mb['mb_num']}");
			$rs->add_where("recv_mb_num={$_mb['mb_num']}");
			$rs->add_where("nt_type=2");
			$rs->add_where("nt_save=0");
			$rs->add_where("nt_num=$num");
			$data=$rs->fetch(); // ����Ȯ��
			
			$rs->clear();
			$rs->add_where("mb_num={$_mb['mb_num']}");
			$rs->add_where("recv_mb_num={$_mb['mb_num']}");
			$rs->add_where("nt_type=2");
			$rs->add_where("nt_save=0");
			$rs->add_where("nt_num > $num");
			$rs->add_order('nt_num');
			$rs->set_limit('1');
			$data_next=$rs->fetch();

			$rs->clear();
			$rs->add_where("mb_num={$_mb['mb_num']}");
			$rs->add_where("recv_mb_num={$_mb['mb_num']}");
			$rs->add_where("nt_type=2");
			$rs->add_where("nt_save=0");
			$rs->add_where("nt_num < $num");
			$rs->add_order('nt_num DESC');
			$rs->set_limit('1');
			$data_prev=$rs->fetch();
		break;
		case 'sent' : // ��������Ȯ��
			$rs->clear();
			$rs->set_table($_table['note']);
			$rs->add_where("mb_num={$_mb['mb_num']}");
			$rs->add_where("sent_mb_num={$_mb['mb_num']}");
			$rs->add_where("nt_num=$num");
			$rs->add_where("nt_type=1");
			$rs->add_where("nt_save=0");
			$data=$rs->fetch(); // ����Ȯ��

			$rs->clear();
			$rs->add_where("mb_num={$_mb['mb_num']}");
			$rs->add_where("sent_mb_num={$_mb['mb_num']}");
			$rs->add_where("nt_type=1");
			$rs->add_where("nt_save=0");
			$rs->add_where("nt_num > $num");
			$rs->add_order('nt_num');
			$rs->set_limit('1');
			$data_next=$rs->fetch();

			$rs->clear();
			$rs->add_where("mb_num={$_mb['mb_num']}");
			$rs->add_where("sent_mb_num={$_mb['mb_num']}");
			$rs->add_where("nt_type=1");
			$rs->add_where("nt_save=0");
			$rs->add_where("nt_num < $num");
			$rs->add_order('nt_num DESC');
			$rs->set_limit('1');
			$data_prev=$rs->fetch();
		break;
		case 'save' : // ��������Ȯ��
			$rs->clear();
			$rs->set_table($_table['note']);
			$rs->add_where("mb_num={$_mb['mb_num']}");
			$rs->add_where("nt_num=$num");
			$rs->add_where("nt_save=1");
			$data=$rs->fetch(); // ����Ȯ��

			$rs->clear();
			$rs->add_where("mb_num={$_mb['mb_num']}");
			$rs->add_where("nt_save=1");
			$rs->add_where("nt_num > $num");
			$rs->add_order('nt_num');
			$rs->set_limit('1');
			$data_next=$rs->fetch();

			$rs->clear();
			$rs->add_where("mb_num={$_mb['mb_num']}");
			$rs->add_where("nt_save=1");
			$rs->add_where("nt_num < $num");
			$rs->add_order('nt_num DESC');
			$rs->set_limit('1');
			$data_prev=$rs->fetch();
		break;
	}

	if($data['nt_type']=='2' && $data['nt_recv_date']==0) { // ����Ȯ��
		$data['nt_recv_date']=time();
		$rs->clear();
		$rs->set_table($_table['note']);
		$rs->add_where("mb_num={$_mb['mb_num']}");
		$rs->add_where("recv_mb_num={$_mb['mb_num']}");
		$rs->add_where("nt_type=2");
		$rs->add_where("nt_num=$num");
		$rs->add_field("nt_recv_date",$data['nt_recv_date']);	 // Ȯ�νð�
		$rs->update();
		
		if($data['nt_sent_num']!=0) {
			$rs->clear();
			$rs->set_table($_table['note']);
			$rs->add_where("nt_num={$data['nt_sent_num']}");	// Ȯ�νð�
			$rs->add_field("nt_recv_date",$data['nt_recv_date']);
			$rs->update();
		}	
	}
	
	$rs->clear();
	$rs->set_table($_table['member']);
	$rs->add_field('mb_id');
	$rs->add_field('mb_nick');
	$rs->add_where("mb_num={$data['recv_mb_num']}");
	$rs->fetch('mb_id,mb_nick');
	$data['recv_mb_id']=$mb_id;
	$data['recv_mb_nick']=$mb_nick;
	
	$rs->clear();
	$rs->set_table($_table['member']);
	$rs->add_field('mb_id');
	$rs->add_field('mb_nick');
	$rs->add_where("mb_num={$data['sent_mb_num']}");
	$rs->fetch('mb_id,mb_nick');
	$data['sent_mb_id']=$mb_id;
	$data['sent_mb_nick']=$mb_nick;
	
	$data['nt_sent_date']=rg_date($data['nt_sent_date'],'%Y-%m-%d %H:%M'); // ������������
	if($data['nt_recv_date']==0) {
		$data['nt_recv_date']='Ȯ����';
	} else {
		$data['nt_recv_date']=rg_date($data['nt_recv_date'],'%Y-%m-%d %H:%M'); // ������������
	}
	$rs->commit();
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
<table width="350" align="center" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td height="10">
		</td>
	</tr>
	<tr>
		<td>
		<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td height="3" bgcolor="#54A8BA"><img width="1" height="1"></td>
			</tr>
			<tr>
				<td height="28" bgcolor="#F4FAFB">&nbsp;&nbsp;����Ȯ��</td>
			</tr>
			<tr>
				<td height="1" bgcolor="#54A8BA"><img width="1" height="1"></td>
			</tr>
		</table>
		<table width="100%" align="center" border="0" cellpadding="0" cellspacing="3" style="table-layout:fixed">
			<tr>
				<td>
					<table width="100%" align="center" border="0" cellpadding="0" cellspacing="3" style="table-layout:fixed">
						<tr>				
							<td width="60" align="right"><strong>������</strong>&nbsp;</td>
							<td><?=$data['sent_mb_id']?> (<?=$data['sent_mb_nick']?>) , <?=$data['nt_sent_date']?></td>
						</tr>
						<tr>
							<td height="1" colspan="2" bgcolor="#ECECEC"><img width="1" height="1"></td>
						</tr>
						<tr>
							<td align="right"><strong>�޴���</strong>&nbsp;</td>
							<td><?=$data['recv_mb_id']?> (<?=$data['recv_mb_nick']?>) , <?=$data['nt_recv_date']?></td>
						</tr>
					</table>
				</td>
			<tr>
				<td align="center"><textarea name="nt_content" cols="50" rows="15" class="input" hname="����" readonly><?=rg_get_text($data['nt_content'])?></textarea></td>
				</tr>
		</table>
		<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
		<form name="note_view_form" method="post" action="?">
		<input type="hidden" name="mode" value="save_ok">
		<input type="hidden" name="num" value="<?=$num?>">
			<tr>
				<td height="1" bgcolor="#54A8BA"><img width="1" height="1"></td>
			</tr>
			<tr>
				<td height="10"></td>
			</tr>
			<tr>
				<td align="center">
<? if($data_prev) { ?>
				<input type="button" class="button" value="����" onClick="location.href='note_view.php?mode=<?=$mode?>&num=<?=$data_prev['nt_num']?>'">
<? } ?>
<? if($data_next) { ?>
				<input type="button" class="button" value="����" onClick="location.href='note_view.php?mode=<?=$mode?>&num=<?=$data_next['nt_num']?>'">
<? } ?>
<? if($data['sent_mb_num']!=$_mb['mb_num']) { ?>
				<input type="button" class="button" value="����" onClick="note_write('<?=$_url['member']?>','<?=$data['sent_mb_id']?>')">
<? } ?>
<? if($data['nt_type']!='3') { ?>
				<input type="button" class="button" value="�����Կ�����" onClick="note_view_form.mode.value='save_ok';note_view_form.submit();">
<? } ?>
				<input type="button" class="button" value="����" onClick="if(!confirm('�����Ͻðڽ��ϱ�?'))  return;note_view_form.mode.value='delete_ok';note_view_form.submit();">
				<input type="button" class="button" value="�ݱ�" onClick="self.close()">
					</td>
			</tr>
		</form>
		</table>
		</td>
	</tr>
</table>
</body>
</html>

