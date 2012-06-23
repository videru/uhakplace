<?
/* =====================================================

  ���������� : 
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
		
		// ���� ���̺귯��
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
//			rg_href('','mysql������ �������� �Է����ּ���.','','back');
//		}

		switch($db_type) { // �������
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
			$msg="����Ÿ���̽� ������ �����Ҽ� �����ϴ�.<br>
ȣ��Ʈ,����ھ��̵�,��ȣ�� Ȯ�����ּ���.<br>
���� : ".$dbcon->error();
			include("error.inc.php");
			exit;
		}
		$rs = new $rs_class($dbcon);

/*		if(!@$dbcon->select_db($mysql_database_name)) {
			$msg="����Ÿ���̽��� ���� �Ҽ� �����ϴ�.<br>
	����Ÿ���̽����� Ȯ���ϼ���.<br>			
	���� : ".mysql_error();
			include("error.inc.php");
			exit;
		}*/
		
		// ���̺� ����
		$tmp=$dbcon->list_tables();
		foreach($tmp as $v) {
			if(eregi("^({$_table['prefix']})",$v)) {
				$dbcon->query("drop table $v ");
			}
		}
		
		if($db_type=='CUBRID') {
			// �ø���
			$rs->set_table('db_serial');
			$rs->add_field('name');
			$rs->add_where("name LIKE '{$_table['prefix']}_%'");
			$serial_list=array();
			while ($rs->fetch('serial_name')) {
				$dbcon->query("DROP SERIAL $serial_name");
			}
		
//			// Ʈ���� ����
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
			// ����������
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
		rg_href("../","����Ÿ���̽� ���̺�� ����Ÿ�� �����Ͽ����ϴ�.");
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
<form name="form1" method="post" action="" onSubmit="if(!confirm('������ ������ �ٽ� �츱�� �����ϴ�.\nȮ���մϱ�?')) return false;">
  <input name="act" type="hidden" value="ok">
<table width="500" border="0" cellspacing="0" cellpadding="0" class="site_content">
  <tr>
    <td align="center">�������� ���� <br>
      <br>
      ����Ͻô� �������� ����Ÿ���̽��� ������̺��� �����մϴ�.<br>
      <font color="#FF0000">��� ������ �����Ǵ� �����ϰ� �������ֽñ� �ٶ��ϴ�.</font></td>
  </tr>
</table>
<br>
<table border="0" cellpadding="0" cellspacing="0" width="500" class="site_content">
  <tr>
    <td height="24" align="right" bgcolor="#F7F7F7">����� :&nbsp;</td>
    <td><select name="db_type" class="input" id="db_type" required itemname="db type" onChange="form1.db_port.value=db_dport[this.value]">
<?=rg_html_option($_const['db_type'],"MYSQL",'code','hname')?>
		</select>
        <font color="#FF0000"> �������</font></td>
  </tr>
  <tr>
    <td height="24" align="right" bgcolor="#F7F7F7">Port :&nbsp;</td>
    <td><input name="db_port" type="text" id="db_port" value="3306" required itemname="Port">
        <font color="#FF0000"> ������Ʈ</font></td>
  </tr>
  <tr>
    <td height="24" align="right" bgcolor="#F7F7F7">Host Name :&nbsp;</td>
    <td><input name="db_host" type="text" id="db__host" value="localhost" required itemname="Host Name">
        <font color="#FF0000"> ȣ��Ʈ ��</font></td>
  </tr>
  <tr>
    <td width="150" height="24" align="right" bgcolor="#F7F7F7">User ID :&nbsp;</td>
    <td><input name="db_user" type="text" id="db_user" required itemname="User ID">
        <font color="#FF0000"> ���� ����ڸ�</font></td>
  </tr>
  <tr>
    <td height="24" align="right" bgcolor="#F7F7F7">User Password :&nbsp;</td>
    <td><input name="db_password" type="password" id="db_password" required itemname="User Password">
        <font color="#FF0000"> ����� ��ȣ</font></td>
  </tr>
  <tr>
    <td height="24" align="right" bgcolor="#F7F7F7">DB Name :&nbsp;</td>
    <td><input name="db_database_name" type="text" id="db_database_name" required itemname="DB Name">
        <font color="#FF0000"> ��뵥��Ÿ���̽���</font></td>
  </tr>
</table>
<br>
  <div align="center">
    <input type="submit" class="button1" value=" Ȯ �� ">
  </div>
</form>
<? include("admin.footer.php"); ?>
<? include("_footer.php"); ?>