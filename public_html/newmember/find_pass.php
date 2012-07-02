<?
/* =====================================================

  최종수정일 : 
 ===================================================== */
/*
[암호 찾기]
1. 아이디,이름,주민번호를 입력
2. 회원이메일의 이메일 @ 앞부분중 뒷자리 3자리를 * 로 변경한뒤 보여준다
3. 확인후 발송 버튼을 누른다.
*/
	include_once("../include/lib.php");

	if($_SERVER['REQUEST_METHOD']=='POST') {
		$mb_id=strtolower($mb_id);
		$mb_email=strtolower($mb_email);

		if(!$validate->userid($mb_id))
			rg_href('','아이디를 확인해주세요.','back');

		if($validate->is_empty($mb_name) || !$validate->han_only($mb_name))
			rg_href('','이름을 확인해주세요.','back');	

		if($validate->is_empty($mb_email))
			rg_href('','이메일을 입력해주세요.','back');

		$rs->clear();
		$rs->set_table($_table['member']);
		$rs->add_where("mb_id='".$dbcon->escape_string($mb_id)."'");
		$rs->add_where("mb_name='".$dbcon->escape_string($mb_name)."'");
//		$rs->add_where("mb_jumin='".$dbcon->escape_string($mb_jumin)."'");
		$rs->add_where("mb_email='".$dbcon->escape_string($mb_email)."'");
		$rs->select();
		if($rs->num_rows()==0) // 가입되지 않았다.
			rg_href('','가입되어 있지 않습니다.','back');

		$find_pass_data=$rs->fetch();

		switch($find_pass_data['mb_state']) {
			case 1 : // 승인된 아이디
				break;
			case '0' : 
				rg_href('','승인대기중입니다.','back');		
				break;
			case '2' : 
				rg_href('','미승인된 아이디 입니다.','back');		
				break;
			case '3' : 
				rg_href('','탈퇴된 아이디입니다.\n재가입을 원할경우 관리자에게 메일주십시요.','back');	
				break;
			default :
				rg_href('','알수없는 오류 관리자에게 연락 바랍니다.','back');	
				break;
		}
		if($form_mode=='find_pass_email_ok') {
			extract($find_pass_data);
			$mb_pass=rg_rnd_string(6);

			$rs->add_field("mb_pass",rg_password_encode("$mb_pass"));
			$rs->update();
			
			$mail_to = "$mb_email";
			$mail_subject = "[{$mb_name}]님께서 문의하신 내용의 답변입니다.";
			$mail_from = $_site_info['mail_from'];
			$mail_return=$_site_info['mail_return'];
	
			ob_start();
			include($_path['mail_form'].'member_find_pass.php');
			$mail_message=ob_get_contents();
			ob_end_clean();
			$mail_message=str_replace('../','http://'.$_SERVER['HTTP_HOST'].'/',$mail_message);
			
			$rs->commit();
			if($ret_url=='') $ret_url='../phil/index_new.php';
			if(rg_mail($mail_to,$mail_subject,$mail_message,$mail_from,$mail_return)) {
				rg_href($ret_url,'이메일 전송에 성공 했습니다.\n이메일을 확인 하신후 로그인 하세요.');
			} else {
				rg_href($ret_url,'이메일 전송에 실패 했습니다.\n관리자에게 문의 하십시요.');
			}
		}
	}
?>
<? include_once('_header.php'); ?>
<?
	if($_SERVER['REQUEST_METHOD']=='POST' && $form_mode=='find_pass_ok') {
		list($email_id,$email_domain)=explode('@',$find_pass_data['mb_email']);
		
		$email_id[strlen($email_id)-1]='*';
		$email_id[strlen($email_id)-2]='*';
		$email_id[strlen($email_id)-3]='*';
?>
<table width="720" align="center" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td>
		<form name="search_id_form" method="post" action="?" onSubmit="return validate(this)" enctype='multipart/form-data'>
		<input type="hidden" name="form_mode" value="find_pass_email_ok">
		<input type="hidden" name="ret_url" value="<?=$ret_url?>">
		<input type="hidden" name="mb_id" value="<?=$mb_id?>">
		<input type="hidden" name="mb_name" value="<?=$mb_name?>">
		<input type="hidden" name="mb_email" value="<?=$mb_email?>">
		<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td height="3" bgcolor="#07472c"><img width="1" height="1"></td>
			</tr>
			<tr>
				<td height="28" bgcolor="#F4FAFB">&nbsp;회원정보조회결과</td>
			</tr>
			<tr>
				<td height="1" bgcolor="#07472c"><img width="1" height="1"></td>
			</tr>
		</table>
		<table width="100%" align="center" border="0" cellpadding="0" cellspacing="6">
			<tr>
			  <td align="center">입력하신 정보와 일치하는 회원의 이메일 주소입니다. </td>
			  </tr>
			<tr>
				<td height="1" bgcolor="#ECECEC"><img width="1" height="1"></td>
				</tr>
			<tr>
			  <td align="center"><font style="font-size:8px">◆</font> <?=$email_id?>@<?=$email_domain?></td>
			  </tr>
			<tr>
				<td height="1" bgcolor="#ECECEC"><img width="1" height="1"></td>
				</tr>
			<tr>
				<td><table width="100%" align="center" border="0" cellpadding="0" cellspacing="6">
				  <TR>
            <TD>※ 개인정보 도용에 따른 피해방지를 위해 끝3자리는 '*'로 표시합니다.</TD>
				    </TR>
          <TR>
            <TD>※ 암호는 암호화 되어 있어 확인이 불가능합니다.<br>
※ 아래 "이메일로받기"버튼을 클릭 하시면 임시 암호를 이메일로 전송해 드립니다.<br>
※ 암호가 변경되어 전송되기 때문에 이메일을 확인후 변경된 암호로 로그인 하셔야 합니다.
</TD>
          </TR>
				  </table>
				</td>
				</tr>
			<tr>
				<td height="1" bgcolor="#ECECEC"><img width="1" height="1"></td>
				</tr>
			<tr>
				<td align="center"><input type="submit" class="button" value="이메일로받기">
				  </td>
				</tr>
			<tr>
			
			<tr>
				<td height="1" bgcolor="#ECECEC"><img width="1" height="1"></td>
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
				<td align="center"><input type="button" class="button" value=" 회원가입 " onClick="location.href='<?=$_path['member']?>../newmember/join.php'">
				  <input type="button" class="button" value=" 암호찾기 " onClick="location.href='<?=$_path['member']?>../newmember/find_pass.php'">					</td>
			</tr>
		</table>
		</form>		</td>
	</tr>
</table>
<script language='Javascript'>
	if(typeof(document.search_id_form.mb_email) != "undefined")
		document.search_id_form.mb_email.focus();
</script>
<? } else { ?>
<table width="720" align="center" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td>
		<form name="search_id_form" method="post" action="?" onSubmit="return validate(this)" enctype='multipart/form-data'>
		<input type="hidden" name="form_mode" value="find_pass_ok">
		<input type="hidden" name="ret_url" value='../phil/index_new.php'>
		<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
			<!--<tr>
				<td height="3" bgcolor="#07472c"><img width="1" height="1"></td>
			</tr>
			<tr>
				<td height="28" bgcolor="#F4FAFB">&nbsp;회원암호조회</td>
			</tr>
            -->
			<tr>
				<td height="1" bgcolor="#07472c"><img width="1" height="1"></td>
			</tr>
		</table>
		<table width="400" align="center" border="0" cellpadding="0" cellspacing="6">
			<tr>
			  <td width="80" align="right"><strong>아이디</strong>&nbsp;</td>
			  <td width="130"><input type="text" class="input" name="mb_id" size="20" maxlength="12" hname="아이디" value="" required option="userid" tabindex="1"></td>
			  <td rowspan="5"><input name="submit" type="submit" class="button" value=" 확 인 " style="height:80;width:60" tabindex="5"></td>
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
			<tr>
				<td align="right"><strong>이메일</strong></td>
				<td><input type="text" class="input" name="mb_email" size="20" required="required" value="" option="email" hname="이메일" tabindex="3" /></td>
		  </tr>
			<tr>
				<td height="1" colspan="3" bgcolor="#ECECEC"><img width="1" height="1"></td>
			</tr>
		</table>
		<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td height="1" bgcolor="#07472c"><img width="1" height="1"></td>
		  </tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td align="center"><input type="button" class="button" value=" 회원가입 " onClick="location.href='<?=$_path['member']?>../newmember/join.php'">
				  <input type="button" class="button" value=" 아이디찾기 " onClick="location.href='<?=$_path['member']?>../newmember/find_id.php'">					</td>
			</tr>
		</table>
		</form>		</td>
	</tr>
</table>
<script language='Javascript'>
	if(typeof(document.search_id_form.mb_id) != "undefined")
		document.search_id_form.mb_id.focus();
</script>
<? } ?>
