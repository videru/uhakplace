<?
/* =====================================================

  ���������� : 
 ===================================================== */
	include_once("../include/lib.php");

	if(!$_mb) {
		rg_href('','�α��� �� �̿����ּ���.','close');
	}

	if($_SERVER['REQUEST_METHOD']=='POST' && $mode=='note_write_ok') {
		$recv_id=explode(',',$recv_id);
		$recv_num=array();
		if(count($recv_id)==0) {
			rg_href('','�޴��� ���̵� �Է����ּ���.','back');
		}
		$rs->clear();
		$rs->set_table($_table['member']);
		$rs->add_field('mb_num');
		foreach($recv_id as $val) {
			$val=trim($val);
			$rs->clear_where();
			$rs->free_result();
			$rs->add_where("mb_state=1");
			$rs->add_where("mb_id='".$dbcon->escape_string($val)."'");
			$rs->fetch('mb_num');
			if($mb_num=='') {
				rg_href('','�޴��� ���̵� Ȯ�� �ϼ���.','back');
			}
			$recv_num[]=$mb_num;
		}
		
		$rs->clear();
		$rs->set_table($_table['note']);
		$rs->add_field("sent_mb_num",$_mb['mb_num']);
		$rs->add_field("nt_sent_date",time());
		$rs->add_field("nt_recv_date","0");
		$rs->add_field("nt_link",$nt_link);
		$rs->add_field("nt_content",$nt_content);
		$fileds=$rs->get_fields();
		
		foreach($recv_num as $val) {
			if($save_sent_box=='1') {
				// ���� ������ ����
				$rs->clear_field();
				$rs->set_fields($fileds);
				$rs->add_field("mb_num",$_mb['mb_num']);
				$rs->add_field("nt_type",'1');
				$rs->add_field("recv_mb_num",$val);
				$rs->add_field("nt_sent_num",0);
				$rs->insert();
				$nt_recv_num=$rs->get_insert_id();
			} else {
				$nt_recv_num=0;
			}
			// ���濡 ���� ����
			$rs->clear_field();
			$rs->set_fields($fileds);
			$rs->add_field("mb_num",$val);
			$rs->add_field("nt_type",'2');
			$rs->add_field("recv_mb_num",$val);
			$rs->add_field("nt_sent_num",$nt_recv_num);
			$rs->insert();
		}
		$rs->commit();
		rg_href('','���������� ����!!','close');
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
<table width="350" align="center" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td height="10">
		</td>
	</tr>
	<tr>
		<td>
		<form name="note_write_form" method="post" action="?" onSubmit="return validate(this)" enctype='multipart/form-data'>
		<input type="hidden" name="mode" value="note_write_ok">
		<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td height="3" bgcolor="#54A8BA"><img width="1" height="1"></td>
			</tr>
			<tr>
				<td height="28" bgcolor="#F4FAFB">&nbsp;&nbsp;��������</td>
			</tr>
			<tr>
				<td height="1" bgcolor="#54A8BA"><img width="1" height="1"></td>
			</tr>
		</table>
		<table width="100%" align="center" border="0" cellpadding="0" cellspacing="6" style="table-layout:fixed">
			<tr>
				<td width="100" align="right"><strong>�޴��� ���̵�</strong></td>
				<td><input type="text" class="input" name="recv_id" size="35" hname="���̵�" required value="<?=$recv_id?>"></td>
			</tr>
			<tr>
				<td height="1" colspan="2" bgcolor="#ECECEC"><img width="1" height="1"></td>
			</tr>
			<tr>
				<td colspan="2" align="center"><textarea name="nt_content" cols="50" rows="15" class="input" hname="����"></textarea></td>
				</tr>
			<tr>
				<td height="1" colspan="2" bgcolor="#ECECEC"><img width="1" height="1"></td>
			</tr>
			<tr>
				<td colspan="2" align="center"><input type="checkbox" name="save_sent_box" value="1" checked class="none">
				  ���������Կ� ���� (����Ȯ��) </td>
			</tr>
		</table>
		<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td height="1" bgcolor="#54A8BA"><img width="1" height="1"></td>
			</tr>
			<tr>
				<td height="10"></td>
			</tr>
			<tr>
				<td align="center">
				<input type="submit" class="button" value=" ������ ">
				<input type="button" class="button" value="  ��  ��  " onClick="self.close()">
					</td>
			</tr>
		</table>
		</form>		</td>
	</tr>
</table>
</body>
</html>

