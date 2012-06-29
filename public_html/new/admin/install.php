<?

  define('RGBOARD_VERSION', 'install 4.2');

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
	clearstatcache();

	if (file_exists($_path['data'].'db_info.php')) { // 이미 설치되어 있음
		$msg="
이미 데이타베이스 설정파일이 있습니다.<br>
재설치 하시려면 해당 파일과 데이타베이스를 초기화 하신후 실행 하시기 바랍니다.";
		include("error.inc.php");
	}
	
	if(!is_dir($_path['data'])) {
		$msg="데이타디렉토리를 찾을 수 없습니다.<br>
확인해주세요.";
		include("error.inc.php");
	}
	
	$data_chk_perms = @fileperms($_path['data']);
	$data_chk_perms=decoct($data_chk_perms);
	$data_chk_perms=substr($data_chk_perms,-1);
	if($data_chk_perms!='7') {
		$msg="
데이타디렉토리(data)의 권한을 707또는 777으로 변경해주시기 바랍니다.<br>
변경방법은 ftp 를 이용하셨을 경우 권한 설정시 Owner(소유자) 와 Group(그룹), Other(모든사용자) 의 권한을 읽기,쓰기,실행이 가능하도록 체크해시고, <br>
telnet 또는 SSH를 이용하실경우 명령어 \"chmod 707 데이타디렉토리명(data)\" 로 변경하실 수 있습니다.<br><br>
변경하셨으면 확인 버튼을 눌러주세요.<br>
<input type=\"button\" onclick=\"location.reload()\" value=\" 확 인 \">
";
		include("error.inc.php");
	}
	
	if($_POST['act']) {
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
				if(!function_exists('cubrid_connect')) {
					$msg="CUBRID 데이타베이스를 지원하지 않는 서버입니다.<br>
	서버관리자에게 문의하세요.<br>";
					include("error.inc.php");
					exit;
				}
				include_once($_path['inc'].'class_db_cubrid.php');
				include_once('schema/cubrid_schema.inc.php');
				define('DB_TYPE', 'cubrid');
			break;
			case 'ORACLE' :
				if(!function_exists('OCILogon')) {
					$msg="오라클 데이타베이스를 지원하지 않는 서버입니다.<br>
	서버관리자에게 문의하세요.<br>";
					include("error.inc.php");
					exit;
				}
				include_once($_path['inc'].'class_db_oracle.php');
				include_once('schema/oracle_schema.inc.php');
				define('DB_TYPE', 'oracle');
			break;
			case 'MYSQL' :
				if(!function_exists('mysql_connect')) {
					$msg="MYSQL 데이타베이스를 지원하지 않는 서버입니다.<br>
	서버관리자에게 문의하세요.<br>";
					include("error.inc.php");
					exit;
				}
				include_once($_path['inc'].'class_db_mysql.php');
				include_once('schema/mysql_schema.inc.php');
				define('DB_TYPE', 'mysql');
			break;
		}

		$db_class=DB_TYPE.'_db_class';
		$rs_class=DB_TYPE.'_rs_class';

		$dbcon = new $db_class();
		$dbcon->set_debug(0);
		$dbcon->connect($db_host, $db_user, $db_password,$db_database_name);
//		mysql_query('set names euckr'); 

		if(!$dbcon->dbcon) {
			$msg="데이타베이스 서버에 접속할수 없습니다.<br>
접속정보를 확인해주세요.<br>
에러 : ".$dbcon->error();
			include("error.inc.php");
			exit;
		}

		@mysql_query('set names euckr');
		$rs = new $rs_class($dbcon);

		$table_list = $dbcon->list_tables();
		$tmp=@array_diff($_table,$table_list);
		$chk=@array_diff($_table,$tmp);
		unset($tmp);

		if(count($chk) > 0) {
			rg_href('','데이타베이스에 이미 테이블이 있습니다.\n재설치 하시려면 알지보드관련 테이블을 모두 삭제해주신후 실행해주세요.\n'.implode('\n',$chk),'back');		
		}
		
		$table_array=array('member','group','gmember','bbs_cfg',
											'bbs_body','bbs_comment','bbs_category','setup',
											'point','note');
		foreach($table_array as $v)									
			$dbcon->query("CREATE TABLE {$_table[$v]} \n {$db_schema[$v]}");
//			$dbcon->query("CREATE TABLE {$_table[$v]} {$db_schema[$v]} DEFAULT CHARSET=euckr");

		if($db_type=='CUBRID') {
			// 인덱스, 시리얼, 트리거 생성
			foreach($table_array as $v)	{
				if(is_array($db_schema_index[$v])) {
					foreach($db_schema_index[$v] as $v1) {
						$dbcon->query("CREATE INDEX {$v1}_idx on {$_table[$v]} ({$v1})");
					}
				}
				
				if($db_schema_serial_field[$v] != '') {
					$serial_name="{$_table[$v]}__{$db_schema_serial_field[$v]}";
					$dbcon->query("CREATE SERIAL $serial_name START WITH 10");
				}
			}
		}

		if($db_type=='ORACLE') {
			// 인덱스, 시퀀스 생성
			$i=0;
			foreach($table_array as $v)	{
				if(is_array($db_schema_index[$v])) {
					foreach($db_schema_index[$v] as $v1) {
						$i++;
						$dbcon->query("CREATE INDEX i{$i}_{$v1}_idx on {$_table[$v]} ({$v1})");
					}
				}
				
				if($db_schema_serial_field[$v] != '') {
					$serial_name="{$_table[$v]}__{$db_schema_serial_field[$v]}";
					$dbcon->query("CREATE SEQUENCE $serial_name START WITH 10");
				}
			}
		}

		$table_array=array('counter_day','counter_etc','counter_host',
											'counter_log','counter_search');
		foreach($table_array as $v)									
			$dbcon->query("CREATE TABLE {$_table['prefix']}{$v} \n {$db_schema[$v]}");
//			$dbcon->query("CREATE TABLE {$_table['prefix']}{$v} {$db_schema[$v]} DEFAULT CHARSET=euckr");
	
		if($db_type=='CUBRID') {
			// 인덱스, 시리얼, 트리거 생성
			foreach($table_array as $v)	{
				if(is_array($db_schema_index[$v])) {
					foreach($db_schema_index[$v] as $v1) {
						$dbcon->query("CREATE INDEX {$v1}_idx on {$_table['prefix']}{$v} ({$v1})");
					}
				}
				
				if($db_schema_serial_field[$v] != '') {
					$serial_name="{$_table['prefix']}{$v}__{$db_schema_serial_field[$v]}";
					$dbcon->query("CREATE SERIAL $serial_name START WITH 10");
				}
			}
		}

		if($db_type=='ORACLE') {
			// 인덱스, 시퀀스 생성
			foreach($table_array as $v)	{
				if(is_array($db_schema_index[$v])) {
					foreach($db_schema_index[$v] as $v1) {
						$i++;
						$dbcon->query("CREATE INDEX i{$i}_{$v1}_idx on {$_table['prefix']}{$v} ({$v1})");
					}
				}
				
				if($db_schema_serial_field[$v] != '') {
					$serial_name="{$_table['prefix']}{$v}__{$db_schema_serial_field[$v]}";
					$dbcon->query("CREATE SEQUENCE $serial_name START WITH 10");
				}
			}
		}
		
		$dbcon->query(
			"INSERT INTO {$_table['group']} 
				(gr_num, gr_id, gr_name, gr_desc, gr_header_file,
					gr_header_tag, gr_footer_tag, gr_footer_file, gr_state,
					gr_default_state, gr_default_level, gr_level_type, gr_level_info,
					gr_ext_cfg, gr_admin_memo, gr_reg_date, gr_reg_mb)
				VALUES 
(1,'main','메인그룹','기본그룹','','','','',1,1,1,0,'a:12:{i:0;s:4:\"손님\";i:1;s:5:\"레벨1\";i:2;s:5:\"레벨2\";i:3;s:5:\"레벨3\";i:4;s:5:\"레벨4\";i:5;s:5:\"레벨5\";i:6;s:5:\"레벨6\";i:7;s:5:\"레벨7\";i:8;s:5:\"레벨8\";i:9;s:5:\"레벨9\";i:50;s:10:\"그룹관리자\";i:90;s:6:\"운영자\";}','','기본그룹임',1183101274,1)");

		// 사이트 기본정보
		$dbcon->query(
			"INSERT INTO {$_table['setup']} 
				(ss_num, ss_name, ss_content)
				VALUES (1,'site_info','a:12:{s:9:\"site_name\";s:10:\"사이트이름\";s:10:\"admin_name\";s:8:\"운영자명\";s:11:\"admin_email\";s:12:\"master@aa.aa\";s:9:\"admin_tel\";s:13:\"000-0000-0000\";s:9:\"mail_from\";s:24:\"발송이메일<master@aa.aa>\";s:11:\"mail_return\";s:12:\"master@aa.aa\";s:10:\"join_point\";s:2:\"10\";s:11:\"login_point\";s:1:\"1\";s:10:\"join_state\";s:1:\"1\";s:10:\"join_level\";s:1:\"1\";s:11:\"leave_state\";s:1:\"2\";s:10:\"join_login\";s:1:\"1\";}')");
		// 레벨정보
		$dbcon->query(
			"INSERT INTO {$_table['setup']} 
				(ss_num, ss_name, ss_content)
				VALUES (2,'level_info','a:12:{i:0;s:4:\"손님\";i:1;s:5:\"레벨1\";i:2;s:5:\"레벨2\";i:3;s:5:\"레벨3\";i:4;s:5:\"레벨4\";i:5;s:5:\"레벨5\";i:6;s:5:\"레벨6\";i:7;s:5:\"레벨7\";i:8;s:5:\"레벨8\";i:9;s:5:\"레벨9\";i:50;s:10:\"그룹관리자\";i:90;s:6:\"운영자\";}')");
		// 회원입력폼
		$dbcon->query(
			"INSERT INTO {$_table['setup']} 
				(ss_num, ss_name, ss_content)
				VALUES (3,'member_form','a:11:{s:7:\"mb_name\";s:1:\"2\";s:7:\"mb_nick\";s:1:\"2\";s:8:\"mb_email\";s:1:\"2\";s:8:\"mb_jumin\";s:1:\"1\";s:7:\"mb_tel1\";s:1:\"2\";s:7:\"mb_tel2\";s:1:\"1\";s:10:\"mb_address\";s:1:\"1\";s:12:\"mb_signature\";s:1:\"1\";s:12:\"mb_introduce\";s:1:\"1\";s:6:\"photo1\";s:1:\"1\";s:5:\"icon1\";s:1:\"1\";}')");
				
				
				
		$dbcon->query(
			"INSERT INTO {$_table['bbs_cfg']}
					(bbs_num, bbs_code, bbs_db, bbs_db_num, gr_num, bbs_name, bbs_skin,
					use_category, default_content, auth_list, auth_view, auth_write,
					auth_reply, auth_modify, auth_delete, auth_comment, auth_secret,
					list_cfg, write_cfg, reply_cfg, view_cfg, mailing_mb_id, admin_mb_id,
					point_write, point_reply, point_comment, header_file, header_tag,
					footer_tag, footer_file, reg_date, bbs_ext1, bbs_ext2, bbs_ext3,
					bbs_ext4, bbs_ext5, admin_memo, deny_word, deny_html, deny_ip)
				VALUES
(1,'notice','notice',1,1,'공지사항','default',0,'',0,0,90,100,90,90,100,100,'a:5:{s:10:\"list_count\";s:2:\"20\";s:8:\"new_time\";s:2:\"24\";s:13:\"subject_limit\";s:2:\"60\";s:10:\"page_count\";s:2:\"10\";s:11:\"date_format\";s:8:\"%Y-%m-%d\";}','a:14:{s:10:\"use_notice\";s:2:\"90\";s:8:\"use_html\";s:1:\"0\";s:10:\"use_secret\";s:3:\"100\";s:8:\"use_home\";s:1:\"0\";s:8:\"use_link\";s:3:\"100\";s:10:\"link_count\";s:1:\"2\";s:10:\"use_upload\";s:3:\"100\";s:12:\"upload_count\";s:1:\"2\";s:11:\"writer_name\";s:1:\"3\";s:13:\"writer_modify\";s:3:\"100\";s:8:\"spam_chk\";s:1:\"0\";s:15:\"write_deny_time\";s:1:\"5\";s:14:\"use_reply_mail\";s:1:\"0\";s:12:\"reply_delete\";s:1:\"4\";}','a:4:{s:14:\"subject_prefix\";s:6:\"[답변]\";s:9:\"quote_use\";s:1:\"1\";s:13:\"quote_subject\";s:21:\"{NAME} 님의 글입니다.\";s:10:\"quote_mark\";s:1:\">\";}','a:14:{s:12:\"view_comment\";s:1:\"0\";s:10:\"view_image\";s:1:\"0\";s:12:\"use_download\";s:1:\"0\";s:14:\"view_signature\";s:3:\"100\";s:9:\"view_list\";s:1:\"0\";s:8:\"btn_list\";s:1:\"0\";s:13:\"btn_prev_next\";s:1:\"0\";s:10:\"btn_modify\";s:1:\"0\";s:7:\"btn_del\";s:1:\"0\";s:9:\"btn_reply\";s:1:\"0\";s:8:\"vote_yes\";s:3:\"100\";s:7:\"vote_no\";s:3:\"100\";s:11:\"date_format\";s:17:\"%Y-%m-%d %H:%M:%S\";s:13:\"c_date_format\";s:17:\"%Y-%m-%d %H:%M:%S\";}','','',0,0,0,'','','','',1183101402,'','','','','','','8억,새끼,개새끼,소새끼,병신,지랄,씨팔,십팔,니기미,찌랄,지랄,쌍년,쌍놈,빙신,좆까,니기미,좆같은게,잡놈,벼엉신,바보새끼,씹새끼,씨발,씨팔,시벌,씨벌,떠그랄,좆밥,추천인,추천id,추천아이디,추천id,추천아이디,추/천/인,쉐이,등신,싸가지,미친놈,미친넘,찌랄,죽습니다,님아,님들아,씨밸넘','script,xml','')");
		
		$dbcon->query(
			"INSERT INTO {$_table['bbs_category']}
					(cat_num, bbs_db_num, cat_order, cat_name, cat_count)
				VALUES
					(1,1,1,'질문',0)");
		$dbcon->query(
			"INSERT INTO {$_table['bbs_category']}
					(cat_num, bbs_db_num, cat_order, cat_name, cat_count)
				VALUES
					(2,1,2,'답변',0)");
		$dbcon->query(
			"INSERT INTO {$_table['bbs_category']}
					(cat_num, bbs_db_num, cat_order, cat_name, cat_count)
				VALUES					
					(3,1,3,'잡담',0)");
					
		$dbcon->query(
			"INSERT INTO {$_table['bbs_cfg']}
					(bbs_num, bbs_code, bbs_db, bbs_db_num, gr_num, bbs_name, bbs_skin,
					use_category, default_content, auth_list, auth_view, auth_write,
					auth_reply, auth_modify, auth_delete, auth_comment, auth_secret,
					list_cfg, write_cfg, reply_cfg, view_cfg, mailing_mb_id, admin_mb_id,
					point_write, point_reply, point_comment, header_file, header_tag,
					footer_tag, footer_file, reg_date, bbs_ext1, bbs_ext2, bbs_ext3,
					bbs_ext4, bbs_ext5, admin_memo, deny_word, deny_html, deny_ip)
				VALUES				(2,'free','free',2,1,'자유게시판','default',0,'',0,0,0,100,0,0,0,50,'a:6:{s:10:\"list_count\";s:2:\"20\";s:8:\"new_time\";s:2:\"24\";s:13:\"subject_limit\";s:2:\"60\";s:10:\"page_count\";s:2:\"10\";s:11:\"date_format\";s:8:\"%Y-%m-%d\";s:11:\"use_mb_icon\";s:1:\"1\";}','a:14:{s:10:\"use_notice\";s:2:\"50\";s:8:\"use_html\";s:1:\"0\";s:10:\"use_secret\";s:1:\"0\";s:8:\"use_home\";s:1:\"0\";s:8:\"use_link\";s:3:\"100\";s:10:\"link_count\";s:1:\"2\";s:10:\"use_upload\";s:3:\"100\";s:12:\"upload_count\";s:1:\"2\";s:11:\"writer_name\";s:1:\"3\";s:13:\"writer_modify\";s:2:\"90\";s:8:\"spam_chk\";s:1:\"0\";s:15:\"write_deny_time\";s:1:\"5\";s:14:\"use_reply_mail\";s:1:\"0\";s:12:\"reply_delete\";s:1:\"4\";}','a:4:{s:14:\"subject_prefix\";s:6:\"[답변]\";s:9:\"quote_use\";s:1:\"1\";s:13:\"quote_subject\";s:21:\"{NAME} 님의 글입니다.\";s:10:\"quote_mark\";s:1:\">\";}','a:14:{s:12:\"view_comment\";s:1:\"0\";s:10:\"view_image\";s:1:\"0\";s:12:\"use_download\";s:1:\"0\";s:14:\"view_signature\";s:1:\"1\";s:9:\"view_list\";s:1:\"0\";s:8:\"btn_list\";s:1:\"0\";s:13:\"btn_prev_next\";s:1:\"0\";s:10:\"btn_modify\";s:1:\"0\";s:7:\"btn_del\";s:1:\"0\";s:9:\"btn_reply\";s:3:\"100\";s:8:\"vote_yes\";s:3:\"100\";s:7:\"vote_no\";s:3:\"100\";s:11:\"date_format\";s:17:\"%Y-%m-%d %H:%M:%S\";s:13:\"c_date_format\";s:17:\"%Y-%m-%d %H:%M:%S\";}','','',1,1,1,'','','','',1185374597,'','','','','','','8억,새끼,개새끼,소새끼,병신,지랄,씨팔,십팔,니기미,찌랄,지랄,쌍년,쌍놈,빙신,좆까,니기미,좆같은게,잡놈,벼엉신,바보새끼,씹새끼,씨발,씨팔,시벌,씨벌,떠그랄,좆밥,추천인,추천id,추천아이디,추천id,추천아이디,추/천/인,쉐이,등신,싸가지,미친놈,미친넘,찌랄,죽습니다,님아,님들아,씨밸넘','script,xml','')");

		$dbcon->query(
			"INSERT INTO {$_table['bbs_category']}
					(cat_num, bbs_db_num, cat_order, cat_name, cat_count)
				VALUES
					(4,2,1,'질문',0)");
		$dbcon->query(
			"INSERT INTO {$_table['bbs_category']}
					(cat_num, bbs_db_num, cat_order, cat_name, cat_count)
				VALUES
					(5,2,2,'답변',0)");
		$dbcon->query(
			"INSERT INTO {$_table['bbs_category']}
					(cat_num, bbs_db_num, cat_order, cat_name, cat_count)
				VALUES					
					(6,2,3,'잡담',0)");
					
		$fp = fopen($_path['data'].'db_info.php', "wb");
		if(!$fp) {
			$msg="
데이타베이스 정보를 저장할수 없습니다.<br>
서버관리자에게 문의해주세요.<br>
";
			include("error.inc.php");
		}
		$dbcfg="<"."?
echo \"<script>alert('잘못된 접근입니다.(알지보드로 ...)');location='http://rgboard.com'</script>\";exit;
//$db_host
//$db_user
//$db_password
//$db_database_name
//$db_type
//$db_port
?".">		
";
		if(!fputs($fp, $dbcfg)) {
			$msg="
데이타베이스 정보를 저장할수 없습니다.<br>
서버관리자에게 문의해주세요.<br>
";
			include("error.inc.php");
		}
		fclose($fp);

		// 기본 데이타디렉토리 설정
		if(!is_dir($_path['member_data']))
			mkdir($_path['member_data'],0707);

		if(!is_dir($_path['bbs_data']))
			mkdir($_path['bbs_data'],0707);

		if(!is_dir($_path['session']))
			mkdir($_path['session'],0707);

		$dbcon->commit();
		rg_href('install_1.php');
	}
?>
<? include("_header.php"); ?>
<script language="javascript">
var db_dport= new Array();
<? foreach($_const['db_type'] as $v) { ?>
db_dport['<?=$v['code']?>']='<?=$v['default_port']?>';
<? } ?>
</script>
<form name="form1" method="post" action="">
<input name="act" type="hidden" value="ok">
<table border="0" width="500" cellspacing="0" cellpadding="0" class="site_content">
    <tr> 
      <td align="center">RGBOARD 데이타베이스 정보 입력 </td>
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
    <input type="submit" class="button1" value=" 확  인 ">
  </div>
</form>
<?
	include("_footer.php");
?>