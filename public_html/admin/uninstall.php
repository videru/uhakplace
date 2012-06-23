<?
/* =====================================================

  최종수정일 : 
 ===================================================== */
  define('RGBOARD_VERSION', 'uninstall');

	if($_POST[act]=='ok') {
		set_magic_quotes_runtime(0);
		error_reporting(E_ALL ^ E_NOTICE);
	
		header("Content-type: text/html; charset=euc-kr");
	
		if(isset($_REQUEST['site_path'])) exit;
		if(!isset($site_path)) $site_path='../';
		if(!isset($site_url)) $site_url='../';
		if(!isset($site_path) || preg_match("/:\/\//",$site_path)) $site_path='../';	
		
		// 메인 라이브러리
		include_once($site_path.'include/config.php');
		include_once($_path['inc'].'func_comm.php');
		include_once($_path['inc'].'validate.php');
		include_once($_path['inc'].'class_db.php');

		$db_type=trim($_POST[db_type]);
		$db_port=trim($_POST[db_port]);
		$db_host=trim($_POST[db_host]);
		$db_user=trim($_POST[db_user]);
		$db_password=trim($_POST[db_password]);
		$db_database_name=trim($_POST[db_database_name]);

//		if(!$mysql_host || !$mysql_user || !$mysql_password || !$mysql_database_name) {
//			rg_href('','mysql정보를 빠짐없이 입력해주세요.','','back');
//		}

		switch($db_type) { // 디비종류
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
		$dbcon->connect($db_host, $db_user, $db_password,$db_database_name);
		if(!$dbcon->dbcon) {
			$msg="데이타베이스 서버에 접속할수 없습니다.<br>
호스트,사용자아이디,암호를 확인해주세요.<br>
에러 : ".$dbcon->error();
			include("error.inc.php");
			exit;
		}
		$rs = new $rs_class($dbcon);

/*		if(!@$dbcon->select_db($mysql_database_name)) {
			$msg="데이타베이스로 접속 할수 없습니다.<br>
	데이타베이스명을 확인하세요.<br>			
	에러 : ".mysql_error();
			include("error.inc.php");
			exit;
		}*/
		
		// 테이블 삭제
		$tmp=$dbcon->list_tables();
		foreach($tmp as $v) {
			if(eregi("^({$_table['prefix']})",$v)) {
				$dbcon->query("drop table $v ");
			}
		}
		
		if($db_type=='CUBRID') {
			// 시리얼
			$rs->set_table('db_serial');
			$rs->add_field('name');
			$rs->add_where("name LIKE '{$_table['prefix']}_%'");
			$serial_list=array();
			while ($rs->fetch('serial_name')) {
				$dbcon->query("DROP SERIAL $serial_name");
			}
		
//			// 트리거 삭제
//			$rs->clear();
//			$rs->set_table('db_trig');
//			$rs->add_field('trigger_name');
//			$rs->add_where("target_class_name LIKE '{$_table['prefix']}_%'");
//			$serial_list=array();
//			while ($rs->fetch('trigger_name')) {
//				$dbcon->query("DROP TRIGGER $trigger_name");
//			}
		}
		
		if($db_type=='ORACLE') {
			// 시퀀스삭제
			$rs->set_table('all_sequences');
			$rs->add_field('sequence_name');
			$rs->add_where("sequence_owner='".$dbcon->dbname."'");
			$rs->add_where("sequence_name LIKE '".strtoupper($_table['prefix'])."_%'");
			$serial_list=array();
			while ($rs->fetch('sequence_name')) {
				$dbcon->query("drop sequence $sequence_name");
			}
		}
		
		rg_delete_board_file($_path['member_data']);
		rg_delete_board_file($_path['bbs_data']);
		rg_delete_board_file($_path['session']);
		unlink($_path['data'].'db_info.php');
		$dbcon->commit();
		rg_href("../","데이타베이스 테이블과 데이타를 삭제하였습니다.");
	}
	include_once("../include/lib.php");
	require_once("admin_chk.php");

	$MENU_L='m5';
?>
<? include("_header.php"); ?>
<? include("admin.header.php"); ?>
<script language="javascript">
var db_dport= new Array();
<? foreach($_const['db_type'] as $v) { ?>
db_dport['<?=$v['code']?>']='<?=$v['default_port']?>';
<? } ?>
</script>
<form name="form1" method="post" action="" onSubmit="if(!confirm('삭제된 정보는 다시 살릴수 없습니다.\n확실합니까?')) return false;">
  <input name="act" type="hidden" value="ok">
<table width="500" border="0" cellspacing="0" cellpadding="0" class="site_content">
  <tr>
    <td align="center">알지보드 삭제 <br>
      <br>
      사용하시던 알지보드 데이타베이스의 모든테이블을 삭제합니다.<br>
      <font color="#FF0000">모든 정보가 삭제되니 신중하게 실행해주시기 바랍니다.</font></td>
  </tr>
</table>
<br>
<table border="0" cellpadding="0" cellspacing="0" width="500" class="site_content">
  <tr>
    <td height="24" align="right" bgcolor="#F7F7F7">사용디비 :&nbsp;</td>
    <td><select name="db_type" class="input" id="db_type" required itemname="db type" onChange="form1.db_port.value=db_dport[this.value]">
<?=rg_html_option($_const['db_type'],"MYSQL",'code','hname')?>
		</select>
        <font color="#FF0000"> 디비형태</font></td>
  </tr>
  <tr>
    <td height="24" align="right" bgcolor="#F7F7F7">Port :&nbsp;</td>
    <td><input name="db_port" type="text" id="db_port" value="3306" required itemname="Port">
        <font color="#FF0000"> 접속포트</font></td>
  </tr>
  <tr>
    <td height="24" align="right" bgcolor="#F7F7F7">Host Name :&nbsp;</td>
    <td><input name="db_host" type="text" id="db__host" value="localhost" required itemname="Host Name">
        <font color="#FF0000"> 호스트 명</font></td>
  </tr>
  <tr>
    <td width="150" height="24" align="right" bgcolor="#F7F7F7">User ID :&nbsp;</td>
    <td><input name="db_user" type="text" id="db_user" required itemname="User ID">
        <font color="#FF0000"> 접속 사용자명</font></td>
  </tr>
  <tr>
    <td height="24" align="right" bgcolor="#F7F7F7">User Password :&nbsp;</td>
    <td><input name="db_password" type="password" id="db_password" required itemname="User Password">
        <font color="#FF0000"> 사용자 암호</font></td>
  </tr>
  <tr>
    <td height="24" align="right" bgcolor="#F7F7F7">DB Name :&nbsp;</td>
    <td><input name="db_database_name" type="text" id="db_database_name" required itemname="DB Name">
        <font color="#FF0000"> 사용데이타베이스명</font></td>
  </tr>
</table>
<br>
  <div align="center">
    <input type="submit" class="button1" value=" 확 인 ">
  </div>
</form>
<? include("admin.footer.php"); ?>
<? include("_footer.php"); ?>