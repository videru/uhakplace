<?
/* =====================================================

최종수정일 :
===================================================== */
include_once("../include/lib.php");

if(isset($logout)) {
	$ss_mb_id='';
	$ss_mb_num='';
	$ss_login_ok='';
	$ss_hash='';
	$_SESSION['ss_mb_id']=$ss_mb_id;
	$_SESSION['ss_mb_num']=$ss_mb_num;
	$_SESSION['ss_login_ok']=$ss_login_ok;
	$_SESSION['ss_hash']=$ss_hash;
	unset($_SESSION['ss_mb_id']);
	unset($_SESSION['ss_mb_num']);
	unset($_SESSION['ss_login_ok']);
	unset($_SESSION['ss_hash']);
	if($ret_url=='') $ret_url='../main/index.php';
	rg_href($ret_url);
}

if($_SESSION['ss_login_ok']) {
	if($ret_url=='') $ret_url='../main/index.php';
	rg_href($ret_url);
}

if($_SERVER['REQUEST_METHOD']=='POST' && $form_mode=='member_login_ok') {
	$mb_id=strtolower($mb_id);
	if($ret_url_login=='')
		$ret_url_login='?ret_url=' . urlencode($ret_url);

	if(!$validate->userid($mb_id))
		rg_href($ret_url_login,'아이디를 확인해주세요.');
		
	if(!$validate->strlen_chk($mb_pass,4,12))
		rg_href($ret_url_login,'암호를 확인해주세요.');

	$mb_pass = rg_password_encode($mb_pass);

	$rs->clear();
	$rs->set_table($_table['member']);
	$rs->add_where("mb_id='".$dbcon->escape_string($mb_id)."'");
	$rs->select();
	if(!$rs->num_rows()) //
		rg_href($ret_url_login,'가입되지 않은 아이디 입니다.');

	$data=$rs->fetch();
	if($data['mb_pass']!=$mb_pass) {
		rg_href($ret_url_login,'암호를 정확히 입력하세요.');
	}

	switch($data['mb_state']) {
		case 1 : // 승인된 아이디
			break;
		case '0' :
			rg_href($ret_url_login,'승인대기중입니다.');
			break;
		case '2' :
			rg_href($ret_url_login,'미승인된 아이디 입니다.');
			break;
		case '3' :
			rg_href($ret_url_login,'탈퇴된 아이디입니다.\n재가입을 원할경우 관리자에게 메일주십시요.');
			break;
		default :
			rg_href($ret_url_login,'알수없는 오류 관리자에게 연락 바랍니다.');
			break;
	}
	$login_date=time();
	$rs->clear();
	$rs->set_table($_table['member']);
	$rs->add_field("login_count",$data['login_count']+1);
	$rs->add_field("login_date",$login_date);
	$rs->add_field("login_ip",$_SERVER['REMOTE_ADDR']);
	$rs->add_where("mb_num={$data['mb_num']}");
	$rs->update();

	// 지난 로그인 날자와 현재 로그인 날자가 다르다면 로그인 포인트 올린다.
	if(floor($data['login_date']/86400) < floor(time()/86400))
		rg_set_point($data['mb_num'],$_po_type_code['etc'],
				$_site_info['login_point'],'로그인','로그인포인트','');
		
	$ss_mb_id = $data['mb_id'];
	$ss_mb_num = $data['mb_num'];
	$ss_login_ok = 'ok';
	// 로그인 체크방법 해쉬데이타 로그인시간,아이디,회원번호로 체크
	//		$ss_hash = md5($data['login_ip'].$data['mb_id'].$data['mb_num']);
	//		$ss_hash = md5($data['join_date'].$data['mb_id'].$data['mb_num']);
	$ss_hash = md5($login_date.$data['mb_id'].$data['mb_num']);
	$_SESSION['ss_mb_id']=$ss_mb_id;
	$_SESSION['ss_mb_num']=$ss_mb_num;
	$_SESSION['ss_login_ok']=$ss_login_ok;
	$_SESSION['ss_hash']=$ss_hash;
	$rs->commit();
	if($ret_url=='') $ret_url='../main/index.php';
	rg_href($ret_url);
}
?>

<div>
	<? include_once('./top.php'); ?>
</div>

<div style="height: 52px"></div>



<table width="980" border="0" align="center" cellpadding="0"
	cellspacing="0">
	<tr>
		<td width="223" valign="top"><embed src="../n_img/left_08.swf"
				width="223" height="400"></embed></td>
		<td width="37">&nbsp;</td>
		<td valign="top"><table width="100%" border="0" cellspacing="0"
				cellpadding="0">
				<tr>
					<td><img src="../n_img/8_1.jpg" width="720" height="250" /></td>
				</tr>
				<tr>
					<td valign="top"><table width="100%" border="0" cellspacing="0"
							cellpadding="0">
							<tr>
								<td width="284" height="323" align="left" valign="top"><img
									src="../n_img/login_01.jpg" width="284" height="323" /></td>
								<td valign="top"><table width="100%" border="0" cellspacing="0"
										cellpadding="0">
										<tr>
											<td align="left" valign="top"><img
												src="../n_img/login_03.jpg" width="412" height="85" /></td>
										</tr>
										<tr>
											<td style="background-repeat: no-repeat" height="59"
												align="left" background="../n_img/login_05.jpg">
												<table width="100%" border="0" cellspacing="0"
													cellpadding="0">
													<form  name="skin_login_form" method="post" action="<?=$login_action?>" onSubmit="return validate(this)" enctype='multipart/form-data'>
													<input type="hidden" name="form_mode" value="member_login_ok">
													<input type="hidden" name="ret_url" value="<?=$ret_url?>">	
													<tr>
														<td width="108" height="59" rowspan="2"><img
															src="../n_img/login_04.jpg" width="108" height="59" /></td>
														<td width="188" height="30"><input type="text"
															class="input" name="mb_id" size="20" maxlength="12"
															hname="아이디" required tabindex="101"></td>
														<td height="59" rowspan="2"><input type="image"
															src="../n_img/login_06.png" class="border" tabindex="3">
														</td>
													</tr>
													<tr>
														<td width="188">
														<input name="mb_pass" type="password"
															class="input" size="20" required hname="암호"
															tabindex="102">
															
														</td>
													</tr>
													
													</form>
												</table>
											</td>
										</tr>
										<tr>
											<td align="left" valign="top"><img
												src="../n_img/login_02.jpg" width="412" height="179"
												border="0" usemap="#Map" /></td>
										</tr>
									</table></td>
							</tr>
						</table></td>
				</tr>
			</table></td>
	</tr>
</table>


<div style="height: 100px"></div>
<div>
	<? include_once('./footer.php'); ?>
</div>


<script language='Javascript'>
	if(typeof(document.login_form.mb_id) != "undefined")
		document.login_form.mb_id.focus();
</script>

<map name="Map" id="Map">
	<area shape="rect" coords="249,55,370,85"
		href="http://www.uhakplace.co.kr/temp/8_3.html" target="_parent"
		onfocus="blur();">
	<area shape="rect" coords="248,85,372,110"
		href="http://www.uhakplace.co.kr/temp/8_4.html" target="_parent"
		onfocus="blur();">
	<area shape="rect" coords="249,110,373,139"
		href="http://www.uhakplace.co.kr/temp/8_2.html" target="_parent"
		onfocus="blur();">
</map>
</body>
</html>
