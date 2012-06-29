<?
/* =====================================================
	
  최종수정일 : 
 ===================================================== */
	include_once("../include/lib.php");



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
		if($ret_url=='') $ret_url='index.php';
			rg_href($ret_url);




?>