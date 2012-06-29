<? if (!defined('RGBOARD_VERSION')) exit; ?>
<?
/* =====================================================

	
	==> �̿ϼ�
 ===================================================== */
if (!defined('CLASS_DB_MSSQL_INCLUDED')) 
{
	define('CLASS_DB_MSSQL_INCLUDED', 1);
// *-- CLASS_DB_MSSQL_INCLUDED START --*
	
	class mssql_rs_class extends rs_class
	{
		function mssql_rs_class($dbcon)
		{
			parent::rs_class($dbcon);
			$this->rs_type='mssql';
		}
	}
	
	class mssql_db_class extends db_class
	{
		function mssql_db_class()
		{
			$this->escape_ch=chr(27);
			parent::db_class();
			$this->db_type='mysql';
		}


/******************************************************************************
��� : ESCAPE ���ں�ȯ
���� : 
******************************************************************************/
		function escape_string($str,$like=0,$decode=0) {
			$source[] = "/'/";
			$target[] = "\'";
			if($like) { // LIKE ���� ���ڿ��ΰ��
				$source[] = '/%/';
				$target[] = $this->escape_ch.'%';
				$source[] = '/_/';
				$target[] = $this->escape_ch.'_';
			}
			if($decode)
				return preg_replace($target, $source, $str);
			else
				return preg_replace($source, $target, $str);
		}

		function set_debug($debug) { $this->debug=$debug; }
		function get_debug($debug) { return $this->debug; }
		function free_result(&$rs) { return @mysql_free_result($rs); }
		function affected_rows() { return @mysql_affected_rows($this->dbcon); }
		
		// ����Ÿ���̽� �ʱ�ȭ
		function connect($host,$user,$pass,$dbname=NULL,$port='') {
//			if($this->debug > 2)
//				echo "DB Server ���� �õ�(HOST : $host,USER : $user,PASS : $pass)";
			if($port!='') $host.=':'.$port;
			$this->dbcon = @mysql_connect($host, $user, $pass);
			if(!$this->dbcon) 
			{
				if($this->debug > 0) 
				{
					echo '����(connect) : '.mysql_error();
					exit;
				}
				return false;
			}
			
			if($this->debug > 2)
				echo "DB Server ���� ����(HOST : $host,USER : $user)\n";
				
			if($dbname!=NULL) {
				if(!$this->select_db($dbname)) {
					$this->dbcon=NULL;
					return false;
				}
			}
	
			return $this->dbcon;
		}
	
		function select_db($dbname) {
			if(!@mysql_select_db($dbname,$this->dbcon)) {
				if($this->debug > 0)	{
					echo "����(select) : ".mysql_error();
					exit;
				}
				return false;
			}	
			
			$this->dbname=$dbname;
			if($this->debug > 2)
				echo "DB Select ����(DBNAME : $dbname)\n";
			return true;
		}
		
		// ����Ÿ���̽� �ݱ�
		function dbclose() {
			if($this->dbcon) {
				$result_ = @mysql_close($this->dbcon);
				if(!$result_) {
					if($this->debug>0)	{ 
						echo "����(close) : ".mysql_error();
						exit;
					}
				}
				return $result_;
			}
		}
	
		// ����� �о ������ ����(������ ,�� ����)
		function fetch($rs,$vars=NULL,$mode='') {
			if($mode=='')  $mode=MYSQL_BOTH;
			$_cols = @mysql_fetch_array($rs,$mode);
			if($vars!=NULL)
			{
				$vars=str_replace(' ','',$vars);
				$vars=explode(',',$vars);
			}
			
			if (is_array($vars))
			{
				foreach($vars as $v)
				{
					unset($GLOBALS[$v]); // ���� �ʱ�ȭ
				}
			}
			
			if ($_cols && is_array($vars))
			{
				if($mode==MYSQL_BOTH)
				{
					for ($i = 0; ($i < count($vars)) && ( $i < count($_cols) ); $i++)
					{
						$GLOBALS[$vars[$i]] = $_cols[$i]; // ���ڷ� �� �ʵ尡 ���� ��� ���۵�
					}				
				}
				else
				{
					$i=0;
					foreach($_cols as $v)
					{
						$GLOBALS[$vars[$i]] = $v;
						$i++;
						if($i>count($vars)) break;
					}
				}
			}
			
			if($this->debug > 3)
			{
				echo "fetch ����\n";
				print_r($_cols);
			}
			
			return $_cols;
		}
		
		function query_fetch($query,$vars=NULL,$rs_name=NULL,$test=false){
			$result_ = $this->query($query,$test);
			if($rs_name) $GLOBALS[$rs_name]=$result_;
			if(!$result_)
				return false;
	
			$_cols = $this->fetch($result_,$vars,$test);
			if(!$_cols)
				return false;
			return $_cols;
		}
		
		// ����Ÿ ���̽��� ���ǹ� ����
		function query($query,$test=false)
		{
			if($test)
			{
				// �׽�Ʈ ��� �̰� SELETC ���� �ƴ϶�� �������� �ʰ� �����ش�.
				if(!eregi('^SELECT',$query))
				{
					echo $query;
					return true;
				}
			}
			
			$result_ = mysql_query($query,$this->dbcon);
			if(!$result_)
			{
				if($this->debug > 0) echo "$query<br>".mysql_error();
				exit;
			}
			
			if($this->debug > 2)
			{
				echo "query ����\n$query\n";
			}
			
			return $result_;
		}
		
		function update_result() {
			$ttmp=mysql_info($this->dbcon);
			if($this->debug > 2)
			{
				echo "MYSQL INFO : $ttmp\n";
			}
			
			if(eregi('^��ġ�ϴ� Rows : ([0-9].*)��.*�����: ([0-9].*)��.*���: ([0-9].*)��$',
					$ttmp,$tmp))
			{
				$tmp['mysql_info']=$tmp[0];
				$tmp['match']=$tmp[1];
				$tmp['update']=$tmp[2];
				$tmp['warning']=$tmp[3];
			} else $tmp=false;
			return $tmp;
		}
		
		//�ʵ帮��Ʈ�� ���Ѵ�.
		function list_fields($table)
		{
			$result = $this->query("SHOW COLUMNS FROM $table");
			if(!$result)
			{
				if($this->debug > 1) echo "����(list_fields) : ".mysql_error();
				exit;
			}
			if($this->num_rows($result) > 0) {
				$field_list=array();
				while ($row = $this->fetch($result,NULL,MYSQL_ASSOC)) {
					$field_list['Field'][]=$row['Field'];
					$field_list['Type'][]=$row['Type'];
					$field_list['Null'][]=$row['Null'];
					$field_list['Key'][]=$row['Key'];
					$field_list['Default'][]=$row['Default'];
					$field_list['Extra'][]=$row['Extra'];
				}
				if($this->debug > 3)
				{
					echo "field list ����\n";
					print_r($field_list);
				}
				return $field_list;
			} else {
				return false;
			}
		}
		
		//���̺� ����� ���Ѵ�.
		function list_tables($table=NULL)
		{
			if($table!='')
				$result = $this->query("SHOW TABLES LIKE '$table'");
			else
				$result = $this->query("SHOW TABLES");
			if(!$result)
			{
				if($this->debug > 1) echo "����(list_tables) : ".mysql_error();
				exit;
			}
			if($this->num_rows($result) > 0) {
				$table_list=array();
				while ($row = $this->fetch($result,NULL,MYSQL_NUM)) {
					$table_list[]=$row[0];
				}
				if($this->debug > 3)
				{
					echo "talbe list ����\n";
					print_r($table_list);
				}
				return $table_list;
			} else {
				return false;
			}
		}
		
		// ��� ���
		function num_rows($rs)
		{
			$_result=mysql_num_rows($rs);
			if($_result===FALSE)
			{
				if($this->debug > 1) echo "����(num_rows) : ".mysql_error();
				exit;
			}
			if($this->debug > 2)
			{
				echo "num_rows ����($_result)\n";
			}
			return $_result;
		}
		
		function insert_id()
		{
			return mysql_insert_id($this->dbcon);
		}
		
		function commit()
		{
			return true;
		}

		function rollback()
		{
			return false;
		}
		
		function error()
		{
			return mysql_error();
		}
	}
} // *-- CLASS_DB_MSSQL_INCLUDED END --*
?>