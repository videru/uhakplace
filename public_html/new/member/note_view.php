<?
/* =====================================================

  최종수정일 : 
 ===================================================== */
	include_once("../include/lib.php");
	
	if(!$_mb)
		rg_href('','로그인후 이용해주세요.','close');
	
	if(!$validate->number_only($num) && $mode!='new') {
		rg_href("",'올바른 접근이 아닙니다.','close');
		exit;
	}
	
	switch($mode) {
		case 'save_ok' : // 쪽지저장
			$rs->clear();
			$rs->set_table($_table['note']);
			$rs->add_field("nt_save","1");
			$rs->add_where("mb_num={$_mb['mb_num']}");
			$rs->add_where("nt_save!=1");
			$rs->add_where("nt_num=$num");
			$rs->update();
			$rs->commit();
			rg_href("",'쪽지보관함에 저장 했습니다..','close','','opener.location.reload()');
		break;
		case 'delete_ok' : // 쪽지삭제
			$rs->clear();
			$rs->set_table($_table['note']);
			$rs->add_where("mb_num={$_mb['mb_num']}");
			$rs->add_where("nt_num=$num");
			$rs->delete();
			$rs->commit();
			rg_href("",'쪽지를 삭제 했습니다..','close','','opener.location.reload()');
		break;
		case 'new' : // 새쪽지확인
			$rs->clear();
			$rs->set_table($_table['note']);
			$rs->add_where("mb_num={$_mb['mb_num']}");
			$rs->add_where("recv_mb_num={$_mb['mb_num']}");
			$rs->add_where("nt_recv_date=0");
			$rs->add_where("nt_type=2");
			$rs->add_where("nt_save=0");
			$rs->add_order('nt_num'); // 먼저 보낸것 부터 확인
			$rs->set_limit('2');
			$data=$rs->fetch(); // 쪽지확인
			$data_next=$rs->fetch(); // 다음쪽지확인(있다면 다음버튼으로 확인 할수 이도록)
		break;
		case 'recv' : // 받은쪽지확인
			$rs->clear();
			$rs->set_table($_table['note']);
			$rs->add_where("mb_num={$_mb['mb_num']}");
			$rs->add_where("recv_mb_num={$_mb['mb_num']}");
			$rs->add_where("nt_type=2");
			$rs->add_where("nt_save=0");
			$rs->add_where("nt_num=$num");
			$data=$rs->fetch(); // 쪽지확인
			
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
		case 'sent' : // 보낸쪽지확인
			$rs->clear();
			$rs->set_table($_table['note']);
			$rs->add_where("mb_num={$_mb['mb_num']}");
			$rs->add_where("sent_mb_num={$_mb['mb_num']}");
			$rs->add_where("nt_num=$num");
			$rs->add_where("nt_type=1");
			$rs->add_where("nt_save=0");
			$data=$rs->fetch(); // 쪽지확인

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
		case 'save' : // 보낸쪽지확인
			$rs->clear();
			$rs->set_table($_table['note']);
			$rs->add_where("mb_num={$_mb['mb_num']}");
			$rs->add_where("nt_num=$num");
			$rs->add_where("nt_save=1");
			$data=$rs->fetch(); // 쪽지확인

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

	if($data['nt_type']=='2' && $data['nt_recv_date']==0) { // 수신확인
		$data['nt_recv_date']=time();
		$rs->clear();
		$rs->set_table($_table['note']);
		$rs->add_where("mb_num={$_mb['mb_num']}");
		$rs->add_where("recv_mb_num={$_mb['mb_num']}");
		$rs->add_where("nt_type=2");
		$rs->add_where("nt_num=$num");
		$rs->add_field("nt_recv_date",$data['nt_recv_date']);	 // 확인시간
		$rs->update();
		
		if($data['nt_sent_num']!=0) {
			$rs->clear();
			$rs->set_table($_table['note']);
			$rs->add_where("nt_num={$data['nt_sent_num']}");	// 확인시간
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
	
	$data['nt_sent_date']=rg_date($data['nt_sent_date'],'%Y-%m-%d %H:%M'); // 날자형식지정
	if($data['nt_recv_date']==0) {
		$data['nt_recv_date']='확인전';
	} else {
		$data['nt_recv_date']=rg_date($data['nt_recv_date'],'%Y-%m-%d %H:%M'); // 날자형식지정
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
				<td height="28" bgcolor="#F4FAFB">&nbsp;&nbsp;쪽지확인</td>
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
							<td width="60" align="right"><strong>보낸이</strong>&nbsp;</td>
							<td><?=$data['sent_mb_id']?> (<?=$data['sent_mb_nick']?>) , <?=$data['nt_sent_date']?></td>
						</tr>
						<tr>
							<td height="1" colspan="2" bgcolor="#ECECEC"><img width="1" height="1"></td>
						</tr>
						<tr>
							<td align="right"><strong>받는이</strong>&nbsp;</td>
							<td><?=$data['recv_mb_id']?> (<?=$data['recv_mb_nick']?>) , <?=$data['nt_recv_date']?></td>
						</tr>
					</table>
				</td>
			<tr>
				<td align="center"><textarea name="nt_content" cols="50" rows="15" class="input" hname="내용" readonly><?=rg_get_text($data['nt_content'])?></textarea></td>
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
				<input type="button" class="button" value="이전" onClick="location.href='note_view.php?mode=<?=$mode?>&num=<?=$data_prev['nt_num']?>'">
<? } ?>
<? if($data_next) { ?>
				<input type="button" class="button" value="다음" onClick="location.href='note_view.php?mode=<?=$mode?>&num=<?=$data_next['nt_num']?>'">
<? } ?>
<? if($data['sent_mb_num']!=$_mb['mb_num']) { ?>
				<input type="button" class="button" value="답장" onClick="note_write('<?=$_url['member']?>','<?=$data['sent_mb_id']?>')">
<? } ?>
<? if($data['nt_type']!='3') { ?>
				<input type="button" class="button" value="보관함에저장" onClick="note_view_form.mode.value='save_ok';note_view_form.submit();">
<? } ?>
				<input type="button" class="button" value="삭제" onClick="if(!confirm('삭제하시겠습니까?'))  return;note_view_form.mode.value='delete_ok';note_view_form.submit();">
				<input type="button" class="button" value="닫기" onClick="self.close()">
					</td>
			</tr>
		</form>
		</table>
		</td>
	</tr>
</table>
</body>
</html>

