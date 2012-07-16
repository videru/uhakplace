<?
/* =====================================================

  최종수정일 : 
 ===================================================== */
	include_once("../include/lib.php");
	include_once($_path['inc']."lib_bbs_new.php");
	
	$mode='list';
	
	if($_write_cfg['spam_chk'] >= $_gmb_info['gm_level']) { // 스팸체크코드발생
//		$spam_chk_code=substr(md5(uniqid(rand(), true)),-5);
		$spam_chk_code='12345';
		if($_SESSION["schk_".$spam_chk_code]=='')
			$_SESSION["schk_".$spam_chk_code]=substr(md5(uniqid(rand(), true)),-5);
	}
	
	

	if(file_exists($skin_path.'setup.php')) include($skin_path.'setup.php');
	if(!$_bbs_auth['list']) {
		$_msg_type='list_no_auth';
		include("msg.php");
		exit;
	}
	$title_img_path;
	switch($bbs_code)
	{
		case "jw_notice":$title_img_path = "../n_img/6_1.jpg";
		break;
		case "jw_ot":$title_img_path = "../n_img/6_2.jpg";
		break;
		case "jw_yensu":$title_img_path = "../n_img/6_4.jpg";
		break;
	}
	
	
	include('list_main_process_new.php');
?>
