<?
/* =====================================================

  최종수정일 : 2007-07-13
2007-07-13 header("Content-type: text/html; charset=euc-kr"); 추가
2010-01-28 BOARD_VERSION 상수 선언부분 config.php 에서 본 파일로 이동
 ===================================================== */

  define('RGBOARD_VERSION', '4.1.1');
	
	set_magic_quotes_runtime(0);
	error_reporting(E_ALL ^ E_NOTICE);

	header("Content-type: text/html; charset=euc-kr");
	
	if(isset($_REQUEST['site_path']) || isset($_REQUEST['site_url'])) exit;
	if(!isset($site_path)) $site_path='../';
	if(!isset($site_url)) $site_url='../';
	if(!isset($site_path) || preg_match("/:\/\//",$site_path)) $site_path='../';	

	// 메인 라이브러리
	include_once($site_path.'include/config.php');
	include_once($_path['inc'].'func_comm.php');
	include_once($_path['inc'].'validate.php');
	include_once($_path['inc'].'class_db.php');
	
	// magic_quotes_gpc 가 설정된경우
	if(get_magic_quotes_gpc()) {
		ini_set('magic_quotes_sybase',0);
    rg_array_recursive_function($_GET, 'stripslashes');
    rg_array_recursive_function($_POST, 'stripslashes');
    rg_array_recursive_function($_COOKIE, 'stripslashes');
    rg_array_recursive_function($_REQUEST, 'stripslashes');
		include_once($_path['inc'].'register_globals.inc.php');
	} else if (!ini_get('register_globals')) {
	// register_globals 설정이 안되어 있을경우
		include_once($_path['inc'].'register_globals.inc.php');
	}

//	@session_set_cookie_params (0,'/',$main_domain);
	if(is_dir($_path['session']))
		@session_save_path($_path['session']);
  session_cache_limiter('nocache, must-revalidate');


// 세션유지시간 1일로 늘림
ini_set("session.cookie_lifetime", "86400"); 
ini_set("session.cache_expire", "86400"); 
ini_set("session.gc_maxlifetime", "86400"); 
ini_set("session.cookie_domain", ".uhakplace.co.kr");
  session_start();	

	$__dbconf=@file($_path['data'].'db_info.php');
	if(!$__dbconf) {
		header ("Cache-Control: no-cache, must-revalidate");
		header ("Pragma: no-cache");
		rg_href($_path['admin'].'install.php');
		exit;
	}
	if(count($__dbconf) < 9) {
		echo '데이타베이스 설정 파일에러.';
		exit;
	}
	
	for($i=0;$i<count($__dbconf);$i++) {
		$__dbconf[$i]=trim(str_replace("\n","",$__dbconf[$i]));
	}

	if($__dbconf[0] != '<'.'?' || $__dbconf[count($__dbconf)-1] != '?'.'>') {
		echo '데이타베이스 설정 파일에러..';
		exit;
	}
	
	for($i=2;$i<8;$i++) {
		$__dbconf[$i]=substr($__dbconf[$i],2);
	}
	
	$validate = new validate(); // 유효성검사
	
	$dbcon=false;
	switch($__dbconf[6]) { // 디비종류
		case 'CUBRID' :
			include_once($_path['inc'].'class_db_cubrid.php');
			define('DB_TYPE', 'cubrid');
		break;
		case 'ORACLE' :
			include_once($_path['inc'].'class_db_oracle.php');
			define('DB_TYPE', 'oracle');
		break;
		case 'MYSQL' :
			include_once($_path['inc'].'class_db_mysql.php');
			define('DB_TYPE', 'mysql');
		break;
	}
	
	$db_class=DB_TYPE.'_db_class';
	$rs_class=DB_TYPE.'_rs_class';
	
	$dbcon = new $db_class();
	$dbcon->set_debug(1);
	$dbcon->connect($__dbconf[2],$__dbconf[3],$__dbconf[4],$__dbconf[5],$__dbconf[7]);

	if(!is_object($dbcon) || !$dbcon->dbcon) {
		echo '데이타베이스 접속에러. 데이타베이스 정보를 확인해주세요.';
		exit;
	}

//	mysql_query('set names euckr');

	unset($__dbconf);
	$rs=new $rs_class($dbcon);

	// 로그인 되어 있는 상태라면 회원 정보를
	if(!empty($_SESSION['ss_login_ok'])	&& !empty($_SESSION['ss_mb_num']) &&
		 !empty($_SESSION['ss_mb_id']) 		&& !empty($_SESSION['ss_hash'])) {
		$rs->clear();
		$rs->set_table($_table['member']);
		$rs->add_where("mb_num={$_SESSION['ss_mb_num']}");
		$rs->add_where("mb_id='{$_SESSION['ss_mb_id']}'");
		$rs->select();
		if($rs->num_rows()<1) {
			// 로그인되어 있는 회원의 정보가 올바르지 않다면 로그아웃.
			// 비정상적인 접근
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
			$_mb=false;
		} else {
			$_mb=$rs->fetch();
//			$ss_hash_chk = md5($_mb['login_ip'].$_mb['mb_id'].$_mb['mb_num']);
//			$ss_hash_chk = md5($_mb['join_date'].$_mb['mb_id'].$_mb['mb_num']);
			$ss_hash_chk = md5($_mb['login_date'].$_mb['mb_id'].$_mb['mb_num']);
			if($_SESSION['ss_hash'] == $ss_hash_chk) {
				$_mb['mb_files']=unserialize($_mb['mb_files']);
				// 회원레벨이 $_const['admin_level'] 이상 이면 사이트관리자 
				$_auth['admin']=($_const['admin_level'] <= $_mb['mb_level']);
			} else {
				// 비정상적인 접근, 차후 관리자에게 메일등의 조취를 취할수 있다.
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
				$_mb=false;
				rg_href("$site_url","다른곳에서 로그인 하셨습니다.\n초기화면으로 이동합니다.");
			}
		}
	}

	// 사이트 설정
	$rs->clear();
	$rs->set_table($_table['setup']);
	$rs->add_field("ss_content");
	$rs->add_where("ss_name='site_info'");
	$rs->select();
	if($rs->num_rows()<1) {
		$rs->clear_field();
		$rs->add_field("ss_name","site_info");
		$rs->insert();

		$rs->clear_field();
		$rs->add_field("ss_content");
		$rs->select();
	}
	$rs->fetch('tmp');
	$_site_info = unserialize($tmp);
	unset($tmp);
	
	// 레벨 정보
	$rs->clear();
	$rs->set_table($_table['setup']);
	$rs->add_field("ss_content");
	$rs->add_where("ss_name='level_info'");
	$rs->select();
	if($rs->num_rows()<1) {
		$rs->clear_field();
		$rs->add_field("ss_name","level_info");
		$rs->insert();

		$rs->clear_field();
		$rs->add_field("ss_content");
		$rs->select();
	}
	$rs->fetch('tmp');
	$_level_info = unserialize($tmp); 
	unset($tmp);

	if($_mb) $_mb['mb_level_name']=$_level_info[$_mb['mb_level']];
?>