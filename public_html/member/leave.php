<?
/* =====================================================


  최종수정일 :
2007-07-27 주민등록번호 체크 기능 제외
 ===================================================== */
	include_once("../include/lib.php");
	
	if(!$_mb)
		rg_href($_url['member'].'login.php');
	
	if($_SERVER['REQUEST_METHOD']=='POST' && $form_mode=='leave_ok') {
		$mb_id=strtolower($mb_id);
		$mb_jumin = $mb_jumin1.$mb_jumin2;

		if($_mb['mb_id']!=$mb_id)
			rg_href('','자신의 아이디를 입력하세요.','back');

		if(!$validate->userid($mb_id))
			rg_href('','아이디를 확인해주세요.','back');

		if($validate->is_empty($mb_name) || !$validate->han_only($mb_name))
			rg_href('','이름을 확인해주세요.','back');	

//		if(!$validate->jumin($mb_jumin,'jumin'))
//			rg_href('','주민등록 번호를 정확히 입력해주세요.','back');

//		$mb_jumin = rg_password_encode($mb_jumin);
		$mb_pass = rg_password_encode($mb_pass);
		
		$rs->clear();
		$rs->set_table($_table['member']);
		$rs->add_where("mb_id='".$dbcon->escape_string($mb_id)."'");
		$rs->add_where("mb_name='".$dbcon->escape_string($mb_name)."'");
//		$rs->add_where("mb_jumin='".$dbcon->escape_string($mb_jumin)."'");
		$rs->add_where("mb_pass='".$dbcon->escape_string($mb_pass)."'");
		$rs->select();
		if($rs->num_rows()==0) // 입력정보가 올바르지 않다
			rg_href('','입력하신 정보를 확인 하세요.','back');

		if($_site_info['leave_state']==1) {
			$data=$rs->fetch();
			// 파일삭제하고
			$data['mb_files']=unserialize($data['mb_files']);
			rg_upload_file_delete($_path['member_data'],$data['mb_files']); // 파일삭제
			// 회원정보 삭제
			$rs->delete();
			// 포인트 지우고
			$rs->clear();
			$rs->set_table($_table['point']);
			$rs->add_where("mb_num={$data['mb_num']}");
			$rs->delete();
			// 쪽지 지우고			
			$rs->clear();
			$rs->set_table($_table['note']);
			$rs->add_where("mb_num={$data['mb_num']}");
			$rs->delete();
		} else {
			$rs->add_field("mb_state","3");
			$rs->update();
		}
		
		$ss_mb_id = '';
		$ss_mb_num = '';
		$ss_login_ok = '';
		$_SESSION['ss_mb_id']=$ss_mb_id;
		$_SESSION['ss_mb_num']=$ss_mb_num;
		$_SESSION['ss_login_ok']=$ss_login_ok;
		
//				if (!file_exists($skin_site_path."mb_join_ok.php")) 
		if($ret_url=='') $ret_url='../main/index.php';
		$rs->commit();
		rg_href($ret_url,'탈퇴되었습니다.');
	}

	$c_mb_is_mailing[$data['mb_is_mailing']]='checked';
	$c_mb_is_opening[$data['mb_is_opening']]='checked';
?>
<? include_once($_path['member'].'_header.php'); ?>
<table width="300" align="center" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td>
		<form name="leave_form" method="post" action="?" onSubmit="return validate(this)" enctype='multipart/form-data'>
		<input type="hidden" name="form_mode" value="leave_ok">
		<input type="hidden" name="ret_url" value="../main/index.php">
		<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td height="3" bgcolor="#54A8BA"><img width="1" height="1"></td>
			</tr>
			<tr>
				<td height="28" bgcolor="#F4FAFB">&nbsp;회원탈퇴</td>
			</tr>
			<tr>
				<td height="1" bgcolor="#54A8BA"><img width="1" height="1"></td>
			</tr>
		</table>
		<table width="100%" align="center" border="0" cellpadding="0" cellspacing="6">
			<tr>
			  <td width="90" align="right"><strong>아이디</strong>&nbsp;</td>
			  <td><input type="text" class="input" name="mb_id" size="20" maxlength="12" hname="아이디" value="" required option="userid" tabindex="1"></td>
			</tr>
			<tr>
			  <td height="1" colspan="2" bgcolor="#ECECEC"><img width="1" height="1"></td>
			  </tr>
			<tr>
				<td align="right"><strong>암호</strong></td>
				<td><input name="mb_pass" type="password" class="input" size="20" required hname="암호" tabindex="2"></td>
			</tr>
			<tr>
			  <td height="1" colspan="2" bgcolor="#ECECEC"><img width="1" height="1"></td>
			  </tr>
			<tr>
				<td align="right"><strong>이름</strong>&nbsp;</td>
				<td><input type="text" class="input" name="mb_name" size="20" maxlength="12" hname="이름" required tabindex="2"></td>
				</tr>
			<tr>
				<td height="1" colspan="2" bgcolor="#ECECEC"><img width="1" height="1"></td>
				</tr>
<?php /*?>			<tr>
				<td align="right"><strong>주민등록번호</strong></td>
				<td><input type="text" class="input" name="mb_jumin1" size="6" maxlength="6" required option="jumin" hname="주민등록번호" value="" span="2" glue="-" tabindex="3">
-
  <input type="password" class="input" name="mb_jumin2" size="7" maxlength="7" value="" tabindex="4"></td>
				</tr>
			<tr>
				<td height="1" colspan="2" bgcolor="#ECECEC"><img width="1" height="1"></td>
			</tr><?php */?>
<? if($_site_info['leave_state']==1) { ?>
			<tr>
			  <td colspan="2" align="center">탈퇴하시면 회원정보가 즉시 삭제됩니다.</td>
		  </tr>
<? } else { ?>
			<tr>
			  <td colspan="2" align="center">탈퇴하시면 관리자 확인후 처리됩니다.</td>
		  </tr>
<? } ?>
			<tr>
				<td height="1" colspan="2" bgcolor="#ECECEC"><img width="1" height="1"></td>
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
				<td align="center"><input type="submit" class="button" value=" 회원탈퇴 ">
				  <input type="button" class="button" value=" 취 소 " onClick="history.back()">					</td>
			</tr>
		</table>
		</form>		</td>
	</tr>
</table>
<? include_once($_path['member'].'_footer.php'); ?>
