<?
/* =====================================================

���������� :
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
	if($ret_url=='') $ret_url='../phil/index_new.php';
	rg_href($ret_url);
}

if($_SESSION['ss_login_ok']) {
	if($ret_url=='') $ret_url='../phil/index_new.php';
	rg_href($ret_url);
}
if($_SERVER['REQUEST_METHOD']=='POST' && $form_mode=='member_login_ok') {
	$mb_id=strtolower($mb_id);
	if($ret_url_login=='')
		$ret_url_login='?ret_url=' . urlencode($ret_url);

	if(!$validate->userid($mb_id))
		rg_href($ret_url_login,'���̵� Ȯ�����ּ���.');
		
	if(!$validate->strlen_chk($mb_pass,4,12))
		rg_href($ret_url_login,'��ȣ�� Ȯ�����ּ���.');

	$mb_pass = rg_password_encode($mb_pass);

	$rs->clear();
	$rs->set_table($_table['member']);
	$rs->add_where("mb_id='".$dbcon->escape_string($mb_id)."'");
	$rs->select();
	if(!$rs->num_rows()) //
		rg_href($ret_url_login,'���Ե��� ���� ���̵� �Դϴ�.');

	$data=$rs->fetch();
	if($data['mb_pass']!=$mb_pass) {
		rg_href($ret_url_login,'��ȣ�� ��Ȯ�� �Է��ϼ���.');
	}

	switch($data['mb_state']) {
		case 1 : // ���ε� ���̵�
			break;
		case '0' :
			rg_href($ret_url_login,'���δ�����Դϴ�.');
			break;
		case '2' :
			rg_href($ret_url_login,'�̽��ε� ���̵� �Դϴ�.');
			break;
		case '3' :
			rg_href($ret_url_login,'Ż��� ���̵��Դϴ�.\n�簡���� ���Ұ�� �����ڿ��� �����ֽʽÿ�.');
			break;
		default :
			rg_href($ret_url_login,'�˼����� ���� �����ڿ��� ���� �ٶ��ϴ�.');
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

	// ���� �α��� ���ڿ� ���� �α��� ���ڰ� �ٸ��ٸ� �α��� ����Ʈ �ø���.
	if(floor($data['login_date']/86400) < floor(time()/86400))
		rg_set_point($data['mb_num'],$_po_type_code['etc'],
				$_site_info['login_point'],'�α���','�α�������Ʈ','');
		
	$ss_mb_id = $data['mb_id'];
	$ss_mb_num = $data['mb_num'];
	$ss_login_ok = 'ok';
	// �α��� üũ��� �ؽ�����Ÿ �α��νð�,���̵�,ȸ����ȣ�� üũ
	//		$ss_hash = md5($data['login_ip'].$data['mb_id'].$data['mb_num']);
	//		$ss_hash = md5($data['join_date'].$data['mb_id'].$data['mb_num']);
	$ss_hash = md5($login_date.$data['mb_id'].$data['mb_num']);
	$_SESSION['ss_mb_id']=$ss_mb_id;
	$_SESSION['ss_mb_num']=$ss_mb_num;
	$_SESSION['ss_login_ok']=$ss_login_ok;
	$_SESSION['ss_hash']=$ss_hash;
	$rs->commit();
	if($ret_url=='') $ret_url='../phil/index_new.php';
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
													<form  name="skin_login_form" method="post" action="<?
													echo "login.php"?>" onSubmit="return validate(this)" enctype='multipart/form-data'>
													<input type="hidden" name="form_mode" value="member_login_ok">
													<input type="hidden" name="ret_url" value="<??>">	
													<tr>
														<td width="108" height="59" rowspan="2"><img
															src="../n_img/login_04.jpg" width="108" height="59" /></td>
														<td width="188" height="30"><input type="text"
															class="input" name="mb_id" size="20" maxlength="12"
															hname="���̵�" required tabindex="101"></td>
														<td height="59" rowspan="2"><input type="image"
															src="../n_img/login_06.png" class="border" tabindex="3">
														</td>
													</tr>
													<tr>
														<td width="188">
														<input name="mb_pass" type="password"
															class="input" size="20" required hname="��ȣ"
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
		href="http://www.uhakplace.co.kr/temp/8_3.php" target="_parent"
		onfocus="blur();">
	<area shape="rect" coords="248,85,372,110"
		href="http://www.uhakplace.co.kr/temp/8_4.php" target="_parent"
		onfocus="blur();">
	<area shape="rect" coords="249,110,373,139"
		href="http://www.uhakplace.co.kr/temp/8_2.php" target="_parent"
		onfocus="blur();">
</map>
</body>
</html>
