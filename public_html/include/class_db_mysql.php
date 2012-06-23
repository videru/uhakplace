<? if (!defined('RGBOARD_VERSION')) exit; ?>
<?
/* =====================================================

 ===================================================== */
if (!defined('CLASS_DB_MYSQL_INCLUDED')) 
{
	define('CLASS_DB_MYSQL_INCLUDED', 1);
// *-- CLASS_DB_MYSQL_INCLUDED START --*
	
	class mysql_rs_class extends rs_class
	{
		function mysql_rs_class($dbcon)
		{
			parent::rs_class($dbcon);
			$this->rs_type='mysql';
		}
		
		function select_list(&$page,$page_size=20,$display_page=10)
		{
			$tmp_fileds=$this->get_fields();
			$this->clear_field();
			$this->add_field("count(*) as row_count");
			$this->select();
			$tmp=$this->fetch();
			$page_info=rg_navigation($page,$tmp['row_count'],$page_size,$display_page);
			$this->clear_field();
			$this->set_fields($tmp_fileds);
			$this->limit="{$page_info['offset']},{$page_info['rows']}";
			$this->select();
			
			return $page_info;
		}
	}
	
	class mysql_db_class extends db_class
	{
		function mysql_db_class()
		{
			parent::db_class();
			$this->db_type='mysql';
		}


/******************************************************************************
기능 : ESCAPE 문자변환
사용법 : 
******************************************************************************/
		function escape_string($str,$like=0,$decode=0) {
			$source[] = "/'/";
			$target[] = "\'";
			if($like) { // LIKE 문의 문자열인경우
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
		
		// 데이타베이스 초기화
		function connect($host,$user,$pass,$dbname=NULL,$port='') {
//			if($this->debug > 2)
//				echo "DB Server 접속 시도(HOST : $host,USER : $user,PASS : $pass)";
			if($port!='') $host.=':'.$port;
			$this->dbcon = @mysql_connect($host, $user, $pass);
			if(!$this->dbcon) 
			{
				if($this->debug > 0) 
				{
					echo '에러(connect) : '.mysql_error();
					exit;
				}
				return false;
			}
			
			if($this->debug > 2)
				echo "DB Server 접속 성공(HOST : $host,USER : $user)\n";
				
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
					echo "에러(select) : ".mysql_error();
					exit;
				}
				return false;
			}	
			
			$this->dbname=$dbname;
			if($this->debug > 2)
				echo "DB Select 성공(DBNAME : $dbname)\n";
			return true;
		}
		
		// 데이타베이스 닫기
		function dbclose() {
			if($this->dbcon) {
				$result_ = @mysql_close($this->dbcon);
				if(!$result_) {
					if($this->debug>0)	{ 
						echo "에러(close) : ".mysql_error();
						exit;
					}
				}
				return $result_;
			}
		}
	
		// 결과를 읽어서 변수에 저장(변수는 ,로 구분)
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
					unset($GLOBALS[$v]); // 변수 초기화
				}
			}
			
			if ($_cols && is_array($vars))
			{
				if($mode==MYSQL_BOTH)
				{
					for ($i = 0; ($i < count($vars)) && ( $i < count($_cols) ); $i++)
					{
						$GLOBALS[$vars[$i]] = $_cols[$i]; // 숫자로 된 필드가 있을 경우 오작동
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
				echo "fetch 성공\n";
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
		
		// 데이타 베이스로 질의문 전송
		function query($query,$test=false)
		{
			if($test)
			{
				// 테스트 모드 이고 SELETC 문이 아니라면 실행하지 않고 보여준다.
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
				echo "query 성공\n$query\n";
			}
			
			return $result_;
		}
		
		function update_result() {
			$ttmp=mysql_info($this->dbcon);
			if($this->debug > 2)
			{
				echo "MYSQL INFO : $ttmp\n";
			}
			
			if(eregi('^일치하는 Rows : ([0-9].*)개.*변경됨: ([0-9].*)개.*경고: ([0-9].*)개$',
					$ttmp,$tmp))
			{
				$tmp['mysql_info']=$tmp[0];
				$tmp['match']=$tmp[1];
				$tmp['update']=$tmp[2];
				$tmp['warning']=$tmp[3];
			} else $tmp=false;
			return $tmp;
		}
		
		//필드리스트을 구한다.
		function list_fields($table)
		{
			$result = $this->query("SHOW COLUMNS FROM $table");
			if(!$result)
			{
				if($this->debug > 1) echo "에러(list_fields) : ".mysql_error();
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
					echo "field list 성공\n";
					print_r($field_list);
				}
				return $field_list;
			} else {
				return false;
			}
		}
		
		//테이블 목록을 구한다.
		function list_tables($table=NULL)
		{
			if($table!='')
				$result = $this->query("SHOW TABLES LIKE '$table'");
			else
				$result = $this->query("SHOW TABLES");
			if(!$result)
			{
				if($this->debug > 1) echo "에러(list_tables) : ".mysql_error();
				exit;
			}
			if($this->num_rows($result) > 0) {
				$table_list=array();
				while ($row = $this->fetch($result,NULL,MYSQL_NUM)) {
					$table_list[]=$row[0];
				}
				if($this->debug > 3)
				{
					echo "talbe list 성공\n";
					print_r($table_list);
				}
				return $table_list;
			} else {
				return false;
			}
		}
		
		// 결과 행수
		function num_rows($rs)
		{
			$_result=mysql_num_rows($rs);
			if($_result===FALSE)
			{
				if($this->debug > 1) echo "에러(num_rows) : ".mysql_error();
				exit;
			}
			if($this->debug > 2)
			{
				echo "num_rows 성공($_result)\n";
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
} // *-- CLASS_DB_MYSQL_INCLUDED END --*
?>