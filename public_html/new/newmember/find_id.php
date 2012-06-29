<?
/* =====================================================


  최종수정일 : 주민번호 대신 이메일로 변경
 ===================================================== */
/*
[아이디찾기]
1. 이름과 주민번호를 입력
2. 회원아이디의 끝 3자리를 *** 로 변경한뒤 보여준다
3. 완전한 회원아이디를 찾기 위해서는 이메일주소를 입력 후 회원정보상의 이메일 주소와 같다면 발송한다.
*/
	include_once("../include/lib.php");

	if($_SERVER['REQUEST_METHOD']=='POST') {
		$mb_email=strtolower($mb_email);
		
		if($validate->is_empty($mb_name) || !$validate->han_only($mb_name))
			rg_href('','이름을 확인해주세요.','back');	

		if($validate->is_empty($mb_email))
			rg_href('','이메일을 입력해주세요.','back');
			
		$rs->clear();
		$rs->set_table($_table['member']);
		$rs->add_where("mb_name='".$dbcon->escape_string($mb_name)."'");
		$rs->add_where("mb_email='".$dbcon->escape_string($mb_email)."'");
		$rs->select();
		if($rs->num_rows()==0) // 가입되지 않았다
			rg_href('','가입되어 있지 않습니다.','back');
					
		$find_id_data=$rs->fetch();

		switch($find_id_data['mb_state']) {
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
		if($form_mode=='find_id_email_ok') {
			if($find_id_data['mb_email']!=$mb_email) {
				rg_href('','회원정보상의 이메일을 다시한번 확인하세요.','back');
			}
			extract($find_id_data);
			$mail_to = "$mb_email";
			$mail_subject = "[{$mb_name}]님께서 문의하신 내용의 답변입니다.";
			$mail_from = $_site_info['mail_from'];
			$mail_return=$_site_info['mail_return'];
	
			ob_start();
			include($_path['mail_form'].'member_find_id.php');
			$mail_message=ob_get_contents();
			ob_end_clean();
			$mail_message=str_replace('../','http://'.$_SERVER['HTTP_HOST'].'/',$mail_message);

			$rs->commit();
			if($ret_url=='') $ret_url='../main/index.php';
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
	if($_SERVER['REQUEST_METHOD']=='POST' && $form_mode=='find_id_ok') {
		$find_id_data['mb_id'][ strlen($find_id_data['mb_id'])-1 ]='*';
		$find_id_data['mb_id'][ strlen($find_id_data['mb_id'])-2 ]='*';
		$find_id_data['mb_id'][ strlen($find_id_data['mb_id'])-3 ]='*';
?>
<table width="720" align="center" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td>
		<form name="search_id_form" method="post" action="?" onSubmit="return validate(this)" enctype='multipart/form-data'>
		<input type="hidden" name="form_mode" value="find_id_email_ok">
		<input type="hidden" name="ret_url" value="<?=$ret_url?>">
		<input type="hidden" name="mb_name" value="<?=$mb_name?>">
		<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td height="3" bgcolor="#07472c"><img width="1" height="1"></td>
			</tr>
			<tr>
				<td height="28" bgcolor="#F4FAFB">&nbsp;회원아이디조회결과</td>
			</tr>
			<tr>
				<td height="1" bgcolor="#07472c"><img width="1" height="1"></td>
			</tr>
		</table>
		<table width="100%" align="center" border="0" cellpadding="0" cellspacing="6">
			<tr>
			  <td align="center">입력하신 정보와 일치하는  아이디 입니다. </td>
			  </tr>
			<tr>
				<td height="1" bgcolor="#ECECEC"><img width="1" height="1"></td>
				</tr>
			<tr>
			  <td align="center"><font style="font-size:8px">◆</font> <?=$find_id_data['mb_id']?></td>
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
            <TD>'*' 처리된 부분을 확인하시려면,아래 회원정보상의 이메일주소를 입력 하시면 해당 이메일주소로 회원아이디를 전송해 드립니다. </TD>
          </TR>
				  </table>
				</td>
				</tr>
			<tr>
				<td height="1" bgcolor="#ECECEC"><img width="1" height="1"></td>
				</tr>
			<tr>
				<td><table width="100%" align="center" border="0" cellpadding="0" cellspacing="6">
						<tr>
							<td width="80" align="right"><strong>이메일</strong></td>
							<td><input type="text" class="input" name="mb_email" size="20" maxlength="100" option="email" required hname="이메일" value="<?=$mb_email?>"> <input type="submit" class="button" value=" 확 인 "></td>
						</tr>
				  </table>
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
		<input type="hidden" name="form_mode" value="find_id_ok">
		<input type="hidden" name="ret_url" value="../main/index.php">
		<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
<!--	<tr>
				<td height="3" bgcolor="#07472c"><img width="1" height="1"></td>
			</tr>
			<tr>
				<td height="28" bgcolor="#F4FAFB">&nbsp;회원아이디조회</td>
			</tr>
			--><tr>
				<td height="1" bgcolor="#07472c"><img width="1" height="1"></td>
			</tr>
		</table>
		<table width="400" align="center" border="0" cellpadding="0" cellspacing="6">
			<tr>
				<td width="80" align="right"><strong>이름</strong>&nbsp;</td>
				<td width="130"><input type="text" class="input" name="mb_name" size="20" maxlength="12" hname="이름" required tabindex="1"></td>
				<td rowspan="3"><input name="submit" type="submit" class="button" value=" 확 인 " style="height:50;width:60" tabindex="3"></td>
			</tr>
			<tr>
				<td></td>
				</tr>
			<tr>
				<td align="right"><strong>이메일&nbsp;</strong></td>
				<td><input type="text" class="input" name="mb_email" size="20" maxlength="100" option="email" required="required" hname="이메일" value="" tabindex="2" /></td>
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
				  <input type="button" class="button" value=" 암호찾기 " onClick="location.href='<?=$_path['member']?>../newmember/find_pass.php'">					</td>
			</tr>
		</table>
		</form>		</td>
	</tr>
</table>
<script language='Javascript'>
	if(typeof(document.search_id_form.mb_name) != "undefined")
		document.search_id_form.mb_name.focus();
</script>
<? } ?>
