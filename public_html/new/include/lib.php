<?
/* =====================================================

  ���������� : 2007-07-13
2007-07-13 header("Content-type: text/html; charset=euc-kr"); �߰�
2010-01-28 BOARD_VERSION ��� ����κ� config.php ���� �� ���Ϸ� �̵�
 ===================================================== */

  define('RGBOARD_VERSION', '4.1.1');
	
	set_magic_quotes_runtime(0);
	error_reporting(E_ALL ^ E_NOTICE);

	header("Content-type: text/html; charset=euc-kr");
	
	if(isset($_REQUEST['site_path']) || isset($_REQUEST['site_url'])) exit;
	if(!isset($site_path)) $site_path='../';
	if(!isset($site_url)) $site_url='../';
	if(!isset($site_path) || preg_match("/:\/\//",$site_path)) $site_path='../';	

	// ���� ���̺귯��
	include_once($site_path.'include/config.php');
	include_once($_path['inc'].'func_comm.php');
	include_once($_path['inc'].'validate.php');
	include_once($_path['inc'].'class_db.php');
	
	// magic_quotes_gpc �� �����Ȱ��
	if(get_magic_quotes_gpc()) {
		ini_set('magic_quotes_sybase',0);
    rg_array_recursive_function($_GET, 'stripslashes');
    rg_array_recursive_function($_POST, 'stripslashes');
    rg_array_recursive_function($_COOKIE, 'stripslashes');
    rg_array_recursive_function($_REQUEST, 'stripslashes');
		include_once($_path['inc'].'register_globals.inc.php');
	} else if (!ini_get('register_globals')) {
	// register_globals ������ �ȵǾ� �������
		include_once($_path['inc'].'register_globals.inc.php');
	}

//	@session_set_cookie_params (0,'/',$main_domain);
	if(is_dir($_path['session']))
		@session_save_path($_path['session']);
  session_cache_limiter('nocache, must-revalidate');


// ���������ð� 1�Ϸ� �ø�
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
		echo '����Ÿ���̽� ���� ���Ͽ���.';
		exit;
	}
	
	for($i=0;$i<count($__dbconf);$i++) {
		$__dbconf[$i]=trim(str_replace("\n","",$__dbconf[$i]));
	}

	if($__dbconf[0] != '<'.'?' || $__dbconf[count($__dbconf)-1] != '?'.'>') {
		echo '����Ÿ���̽� ���� ���Ͽ���..';
		exit;
	}
	
	for($i=2;$i<8;$i++) {
		$__dbconf[$i]=substr($__dbconf[$i],2);
	}
	
	$validate = new validate(); // ��ȿ���˻�
	
	$dbcon=false;
	switch($__dbconf[6]) { // �������
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
		echo '����Ÿ���̽� ���ӿ���. ����Ÿ���̽� ������ Ȯ�����ּ���.';
		exit;
	}

//	mysql_query('set names euckr');

	unset($__dbconf);
	$rs=new $rs_class($dbcon);

	// �α��� �Ǿ� �ִ� ���¶�� ȸ�� ������
	if(!empty($_SESSION['ss_login_ok'])	&& !empty($_SESSION['ss_mb_num']) &&
		 !empty($_SESSION['ss_mb_id']) 		&& !empty($_SESSION['ss_hash'])) {
		$rs->clear();
		$rs->set_table($_table['member']);
		$rs->add_where("mb_num={$_SESSION['ss_mb_num']}");
		$rs->add_where("mb_id='{$_SESSION['ss_mb_id']}'");
		$rs->select();
		if($rs->num_rows()<1) {
			// �α��εǾ� �ִ� ȸ���� ������ �ùٸ��� �ʴٸ� �α׾ƿ�.
			// ���������� ����
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
				// ȸ���� $_const['admin_level'] �̻� �̸� ����Ʈ���� 
				$_auth['admin']=($_const['admin_level'] <= $_mb['mb_level']);
			} else {
				// ���������� ����, ���� ���ڿ��� ���ϵ��� ���븦 ���Ҽ� �ִ�.
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
				rg_href("$site_url","�ٸ������� �α��� �ϼ̽��ϴ�.\n�ʱ�ȭ������ �̵��մϴ�.");
			}
		}
	}

	// ����Ʈ ����
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
	
	// ���� ����
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