<? if (!defined('RGBOARD_VERSION')) exit; ?>
<?
/* =====================================================

 ===================================================== */
if (!defined('CLASS_DB_CUBRIDE_INCLUDED')) 
{
	define('CLASS_DB_CUBRIDE_INCLUDED', 1);
// *-- CLASS_DB_CUBRIDE_INCLUDED START --*
	
	class cubride_rs_class extends rs_class
	{
		function cubride_rs_class(&$dbcon)
		{
			parent::rs_class($dbcon);
			$this->rs_type='cubride';
		}
		
		var $rev_names=array('type','name'); // 필드명으로 쓸수 없는 것들
		
		var $db;
		var $rs;
		var $table;
		var $table_attr;
		var $fields;
		var $field_sql;
		var $field_sql_select;
		var $where;
		var $where_sql;
		var $order;
		var $order_sql;
		var $group_sql;
		var $limit;
		var $table_insert_id;
		
		function clear()
		{
//			$this->table='';
//			$this->table_attr=NULL;
			$this->fields=NULL;
			$this->field_sql='';
			$this->field_sql_select='';
			$this->where=NULL;
			$this->where_sql='';
			$this->order=NULL;
			$this->order_sql='';
			$this->group_sql='';
			$this->limit='';
//			$this->table_insert_id='';
//			if($this->rs)
			$this->free_result($this->rs);
		}
		
		function commit() { return $this->db->commit(); }
		function rollback() { return $this->db->rollback(); }
		
		function list_fields() {
			if(!$this->table_attr) $this->table_attr=$this->db->list_fields($this->table);;
			return $this->table_attr;
		}
		
		function free_result() { if($this->rs) $this->db->free_result($this->rs); $this->rs=NULL; }

		function affected_rows() { return $this->db->affected_rows($this->rs); }


		function set_db(&$db) { $this->db=$db; }
		function get_db() { return $this->db; }

		function set_table($table) { $this->table=$this->db->escape_string($table); $this->table_attr=NULL; }
		function get_table() { return $this->table; }

		function num_rows() { if(!$this->rs) $this->select(); return $this->db->num_rows($this->rs); }

		function clear_where() { $this->where=NULL; $this->where_sql=''; }
		function add_where($where) { $this->where[]=$where; }
		function set_where($where) { $this->where=$where; }
		function get_where() { return $this->where; }
		function parse_where() { $this->where_sql=@implode("\nAND ",$this->where); }

		function clear_order() { $this->order=NULL; $this->order_sql=''; }
		function add_order($order) { $this->order[]=$order; }
		function set_order($order) { $this->order=$order; }
		function get_order() { return $this->order; }
		function parse_order() { $this->order_sql=@implode(",",$this->order); }

		function set_limit($limit) { $this->limit=$limit; }
		function get_limit() { return $this->limit; }

		function clear_field() { $this->fields=NULL; $this->field_sql=''; $this->field_sql_select=''; }
		function add_field($field,$value='') { $this->fields[$field]=$value; }
		function set_fields($fields) { $this->fields=$fields; }
		function get_field($field) { return $this->fields[$field]; }
		function get_fields() { return $this->fields; }
		function parse_field($type='') {
			if(is_array($this->fields)) {
				if($type=='insert') {
					$field_list=$this->list_fields();
					$keys=array();
					$values=array();
					foreach($field_list[Field] as $k => $v) {
						if($field_list[Extra][$k]=='serial' && ($this->fields[$v]=='' || $this->fields[$v]=='0')) {
							$result1 = $this->db->query("select {$this->table}__{$v}.next_value from db_root");
							$tmp = $this->db->fetch($result1,NULL,CUBRID_NUM);
							$this->fields[$v] = $tmp[0];
							$this->db->table_insert_id=$this->table_insert_id=$tmp[0];
						}
						
						if(in_array($v,$this->rev_names))
							$keys[$k]="\"$v\"";
						else
							$keys[$k]=$v;
						
						if($field_list[Type][$k]=='STRING' || $field_list[Type][$k]=='CHAR') {
							$values[$k]="'".$this->db->escape_string($this->fields[$v])."'";
						} else {
							if($field_list['Null'][$k]=='NO' && $this->fields[$v]=='') {
								$values[$k]='0';
							} else {
								$values[$k]=$this->db->escape_string($this->fields[$v]);
							}
						}
					}
				
					$this->field_sql='('.implode(",",$keys).') VALUES ('
															.implode(",",$values).')';
					unset($fields);
				} else if($type=='update') {
					$tmp=array();
					$field_list=$this->list_fields();
					$field_list['Field']=array_flip($field_list['Field']);

					foreach($this->fields as $k => $v) {
						$i=$field_list['Field'][$k];
						
						if(in_array($k,$this->rev_names))
							$k="\"$k\"";
							
						if($field_list['Type'][$i]=='STRING' || $field_list['Type'][$i]=='CHAR') {
							$tmp[]="$k='".$this->db->escape_string($v)."'";
						} else {
							if($field_list['Null'][$i]=='NO' && $v=='') {
								$tmp[]="$k=0";
							} else {
								$tmp[]="$k=".$this->db->escape_string($v);
							}
						}							
					}
					$this->field_sql=implode(",\n",$tmp);
				} else			
					$this->field_sql_select=implode(",\n",array_keys($this->fields));
			} else {
				$this->field_sql='';
				$this->field_sql_select='';
			}
		}

		function get_insert_id() {
			return $this->table_insert_id;
/*			$field_list=$this->list_fields();
			$insert_id_field='';
			foreach($field_list[Field] as $k => $v) {
				if($field_list[Extra][$k]=='serial') {
					$insert_id_field=$v;
					break;
				}
			}
			 
			if($insert_id_field!='') {
				$tmp=$this->db->query_fetch("SELECT MAX($insert_id_field) as insert_id FROM {$this->table}");
				return $tmp['insert_id'];
			} else {
				return false;
			}*/
		}

		function insert($re_parse=false,$test=false)
		{
			if($re_parse) $this->field_sql = '';
			
			$sql="INSERT INTO ".$this->table." \n";
			if($this->field_sql=='') $this->parse_field('insert');
			if($this->field_sql=='') return false;
			$sql.=$this->field_sql."\n";
			$this->rs=$this->db->query($sql,$test);
			
		}
		
		function update($re_parse=false,$test=false)
		{
			if($re_parse) $this->where_sql = $this->field_sql = '';
			
			$sql="UPDATE ".$this->table." SET \n";
			if($this->field_sql=='') $this->parse_field('update');
			if($this->field_sql=='') return false;
			$sql.=$this->field_sql."\n";
			if($this->where_sql=='') $this->parse_where();
			if($this->where_sql!='')
				$sql.= "WHERE ".$this->where_sql."\n";
			$this->rs=$this->db->query($sql,$test);
		}
		
		function select($re_parse=false)
		{
			if($re_parse)
				$this->order_sql = $this->where_sql = $this->field_sql_select = '';

			$sql="SELECT ";
			if($this->field_sql_select=='') $this->parse_field('select');
			if($this->field_sql_select=='')
				$sql.="*\n";
			else
				$sql.=$this->field_sql_select."\n";
				
			$sql.="FROM ".$this->table."\n";
			
			if($this->where_sql=='') $this->parse_where();
			if($this->where_sql!='')
				$sql.= "WHERE ".$this->where_sql."\n";

			if($this->group_sql!='')
				$sql.= "GROUP BY ".$this->group_sql."\n";
			
			if($this->order_sql=='') $this->parse_order();
			if($this->order_sql!='')
				$sql.= "ORDER BY ".$this->order_sql."\n";

			if($this->limit!='') {
				$tmp=explode(',',$this->limit);
				if(!isset($tmp[1])) {
					$tmp[1]=$tmp[0];
					$tmp[0]=0;
				}
				$tmp[1]+=$tmp[0]++;
				
				if($this->order_sql!='') 
					$sql.= " for orderby_num() between $tmp[0] and $tmp[1]\n";
				else if($this->group_sql!='') 
					$sql.= " having groupby_num() between $tmp[0] and $tmp[1]\n";
				else {
					if($this->where_sql!='')
						$sql.= " AND inst_num() between $tmp[0] and $tmp[1]\n";
					else
						$sql.= " WHERE inst_num() between $tmp[0] and $tmp[1]\n";
				}
			}

			$this->rs=$this->db->query($sql);
			return $this->rs;
		}
		
		function delete($re_parse=false,$delete_all=false,$test=false)
		{
			if($re_parse) $this->where_sql = '';
				
			$sql="DELETE FROM ".$this->table."\n";

			if($this->where_sql=='') $this->parse_where();
			if(!$delete_all && $this->where_sql=='') {
				echo "DELETE 조건절이 빠져 있습니다.";
				return false;
			}
			if($this->where_sql!='')
				$sql.= "WHERE ".$this->where_sql."\n";
				
			$this->rs=$this->db->query($sql,$test);
		}
		
		function fetch($vars=NULL)
		{
			if(!$this->rs) $this->select();
			$this->fields=$this->db->fetch($this->rs,$vars,CUBRID_ASSOC);
			return $this->fields;
		}
		
		function select_list(&$page,$page_size=20,$display_page=10)
		{
			$tmp_fileds=$this->get_fields();
			$tmp_orders=$this->get_order();
			$this->clear_field();
			$this->clear_order();
			$this->add_field("count(*) as row_count");
			$this->select();
			$tmp=$this->fetch();
			$page_info=rg_navigation($page,$tmp['row_count'],$page_size,$display_page);
			$this->clear_field();
			$this->set_fields($tmp_fileds);
			$this->limit="{$page_info['offset']},{$page_info['rows']}";
			$this->set_order($tmp_orders);
			$this->select(1);

			return $page_info;
		}
	}
	
	class cubride_db_class extends db_class
	{
		function cubride_db_class()
		{
			parent::db_class();
			$this->db_type='cubride';
		}
/******************************************************************************
기능 : ESCAPE 문자변환
사용법 : 
******************************************************************************/
		function escape_string($str,$like=0,$decode=0) {
			$source[] = "/'/";
			$target[] = "''";
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
		function free_result(&$rs) { return @cubrid_close_request($rs); }
		function affected_rows($rs=NULL) {
			if($rs)
				return cubrid_affected_rows($rs);
			else
		 		return false;
		}
		
		// 데이타베이스 초기화
		function connect($host,$user,$pass,$dbname=NULL,$port=33000) {
//			if($this->debug > 2)
//				echo "DB Server 접속 시도(HOST : $host,USER : $user,PASS : $pass)";
			if(!function_exists('cubrid_connect')) return false;
			$this->dbcon = @cubrid_connect($host,$port,$dbname,$user,$pass);
			if(!$this->dbcon) 
			{
				if($this->debug > 0) 
				{
					echo '에러(connect) : '.cubrid_error_msg();
					exit;
				}
				return false;
			}
			
			if($this->debug > 2)
				echo "DB Server 접속 성공(HOST : $host,USER : $user)\n";
	
			return $this->dbcon;
		}
	
		function select_db($dbname) {
/*			if(!@mysql_select_db($dbname,$this->dbcon)) {
				if($this->debug > 0)	{
					echo "에러(select) : ".cubrid_error_msg();
					exit;
				}
				return false;
			}	
			
			$this->dbname=$dbname;
			if($this->debug > 2)
				echo "DB Select 성공(DBNAME : $dbname)\n";*/
			return true;
		}
		
		// 데이타베이스 닫기
		function dbclose() {
			if($this->dbcon) {
				$result_ = @cubrid_disconnect($this->dbcon);
				if(!$result_) {
					if($this->debug>0)	{ 
						echo "에러(close) : ".cubrid_error_msg();
						exit;
					}
				}
				return $result_;
			}
		}
	
		// 결과를 읽어서 변수에 저장(변수는 ,로 구분)
		function fetch($rs,$vars=NULL,$mode='') {
			if($mode=='')  $mode=CUBRID_BOTH;
			$_cols = cubrid_fetch($rs,$mode);
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
				if($mode==CUBRID_BOTH)
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

			$result_ = @cubrid_execute($this->dbcon,$query,CUBRID_INCLUDE_OID);
			if(!$result_)
			{
				if($this->debug > 0) echo "$query<br>".cubrid_error_msg();
				exit;
			}
			
			if($this->debug > 2)
			{
				echo "query 성공\n$query\n";
			}
			
			return $result_;
		}
		
		function update_result() {
/*			$ttmp=mysql_info($this->dbcon);
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
			return $tmp;*/
			return false;
		}
		
		//필드리스트을 구한다.
		function list_fields($table)
		{
			$result = $this->query("select * from db_attribute where class_name = '$table' order by def_order");
			if(!$result)
			{
				if($this->debug > 1) echo "에러(list_fields) : ".cubrid_error_msg();
				exit;
			}
			
			$result1 = $this->query("select name from db_serial where name like '{$table}__%'");
			$serial=array();
			while ($row = $this->fetch($result1,NULL,CUBRID_ASSOC)) {
				$serial[] = substr($row['name'],strlen("{$table}__"));
			}
		
			if($this->num_rows($result) > 0) {
				$field_list=array();
				while ($row = $this->fetch($result,NULL,CUBRID_ASSOC)) {
					$field_list['Field'][]=$row['attr_name'];
					$field_list['Type'][]=$row['data_type'];
					$field_list['Null'][]=$row['is_nullable'];
//					$field_list['Key'][]=$row['Key'];
//					$field_list['Default'][]=$row['Default'];
					if(in_array($row['attr_name'],$serial))
						$field_list['Extra'][]='serial';
					else
						$field_list['Extra'][]='';
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
				$result = $this->query("select * from db_class WHERE is_system_class <> 'YES' AND  class_name LIKE '$table'");
			else
				$result = $this->query("select * from db_class WHERE is_system_class <> 'YES'");
			if(!$result)
			{
				if($this->debug > 1) echo "에러(list_tables) : ".cubrid_error_msg();
				exit;
			}
			if($this->num_rows($result) > 0) {
				$table_list=array();
				while ($row = $this->fetch($result,NULL,CUBRID_NUM)) {
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
			$_result=cubrid_num_rows($rs);
			if($_result===FALSE)
			{
				if($this->debug > 1) echo "에러(num_rows) : ".cubrid_error_msg();
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
			return $this->table_insert_id;
		}
		
		function commit()
		{
			return cubrid_commit($this->dbcon);
		}

		function rollback()
		{
			return cubrid_rollback($this->dbcon);
		}
		
		function error()
		{
			return cubrid_error_msg();
		}
	}
} // *-- CLASS_DB_CUBRIDE_INCLUDED END --*
?>