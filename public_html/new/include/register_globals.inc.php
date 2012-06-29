<? if (!defined('RGBOARD_VERSION')) exit; ?>
<?
/* =====================================================

  최종수정일 : 2007-07-14
2007-07-14 _GET과 _POST,$_COOKIE 데이타를 전역변수로 선언한다
 ===================================================== */
	// register_globals 이 off 인경우 실행
	function rg_gpc_extract($array)
	{
		global $_gpc_blacklist;
		
		if(!is_array($array)) return false;
		
		$valid_variables = preg_replace($_gpc_blacklist, '', array_keys($array));
		$valid_variables = array_unique($valid_variables);
	
		foreach ( $valid_variables as $key ) {
			if(strlen($key)===0) continue;
			$GLOBALS[$key] = $array[$key];
		}
		return true;
	}

	$_gpc_blacklist = array(
			'/^GLOBALS$/i',  // 전역변수
			'/^_.*$/i'       // _로 시작하는 변수
	);

	$raw = phpversion();
	list($v_Upper,$v_Major,$v_Minor) = explode(".",$raw);
	// PHP 버전이 4.1.0 이하인 경우
	if(($v_Upper >= 4 && $v_Major < 1) || $v_Upper < 4){
		$_FILES = $HTTP_POST_FILES;
		$_GET = $HTTP_GET_VARS;
		$_POST = $HTTP_POST_VARS;
		$_COOKIE = $HTTP_COOKIE_VARS;
		$_SERVER = $HTTP_SERVER_VARS;
	}
	rg_gpc_extract($_GET);
	rg_gpc_extract($_POST);
	rg_gpc_extract($_COOKIE);
//	rg_gpc_extract($_SERVER);
	foreach($_FILES as $key => $value) {
		$GLOBALS[$key]=$_FILES[$key]['tmp_name'];
		foreach($value as $ext => $value2) {
			$key2 = $key."_".$ext;
			$GLOBALS[$key2]=$value2;
		}
	}
	unset($_gpc_blacklist);
	unset($raw);
	unset($v_Upper);
	unset($v_Major);
	unset($v_Minor);
?>