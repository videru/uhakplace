<? if (!defined('RGBOARD_VERSION')) exit; ?>
<?
/* =====================================================

 ===================================================== */
if (!defined('CLASS_DB_INC_INCLUDED')) 
{
	define('CLASS_DB_INC_INCLUDED', 1);
// *-- CLASS_DB_INC_INCLUDED START --*
	class rs_class
	{
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
		var $rs_type;
		
		function clear()
		{
			$this->fields=NULL;
			$this->field_sql='';
			$this->field_sql_select='';
			$this->where=NULL;
			$this->where_sql='';
			$this->order=NULL;
			$this->order_sql='';
			$this->group_sql='';
			$this->limit='';
			$this->free_result($this->rs);
			$this->db_type='';
		}
		
		function rs_class(&$db)
		{
			$this->db=$db;
			$this->table='';
			$this->table_attr=NULL;
			$this->clear();
		}
		
		function commit() { return $this->db->commit(); }
		function rollback() { return $this->db->rollback(); }
		
		function list_fields() {
			if(!$this->table_attr) $this->table_attr=$this->db->list_fields($this->table);;
			return $this->table_attr;
		}
				
		function free_result() { if($this->rs) $this->db->free_result($this->rs); $this->rs=NULL; }

		function affected_rows() { return $this->db->affected_rows(); }


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
				if($type=='insert' || $type=='update') {
					$tmp=array();
					foreach($this->fields as $k => $v) $tmp[]="`$k`='".$this->db->escape_string($v)."'";
					$this->field_sql=implode(",\n",$tmp);
				} else			
					$this->field_sql_select=implode(",\n",array_keys($this->fields));
			} else {
				$this->field_sql='';
				$this->field_sql_select='';
			}
		}

		function get_insert_id() { return $this->db->insert_id(); }

		function insert($re_parse=false,$test=false)
		{
			if($re_parse) $this->field_sql = '';
			
			$sql="INSERT `".$this->table."` SET \n";
			if($this->field_sql=='') $this->parse_field('insert');
			if($this->field_sql=='') return false;
			$sql.=$this->field_sql."\n";
			$this->db->query($sql,$test);
			
		}
		
		function update($re_parse=false,$test=false)
		{
			if($re_parse) $this->where_sql = $this->field_sql = '';
			
			$sql="UPDATE `".$this->table."` SET \n";
			if($this->field_sql=='') $this->parse_field('update');
			if($this->field_sql=='') return false;
			$sql.=$this->field_sql."\n";
			if($this->where_sql=='') $this->parse_where();
			if($this->where_sql!='')
				$sql.= "WHERE ".$this->where_sql."\n";
			$this->db->query($sql,$test);
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

			if($this->limit!='')
				$sql.= "LIMIT ".$this->limit."\n";

			$this->rs=$this->db->query($sql);
			return $this->rs;
		}
		
		function delete($re_parse=false,$delete_all=false,$test=false)
		{
			if($re_parse) $this->where_sql = '';
				
			$sql="DELETE FROM `".$this->table."`\n";

			if($this->where_sql=='') $this->parse_where();
			if(!$delete_all && $this->where_sql=='') {
				echo "DELETE 조건절이 빠져 있습니다.";
				return false;
			}
			if($this->where_sql!='')
				$sql.= "WHERE ".$this->where_sql."\n";
				
			$this->db->query($sql,$test);
		}
		
		function fetch($vars=NULL)
		{
			if(!$this->rs) $this->select();
			$this->fields=$this->db->fetch($this->rs,$vars,MYSQL_ASSOC);
			return $this->fields;
		}
		
		function select_list(&$page,$page_size=20,$display_page=10){ return false; }
		
	}
	
	class db_class
	{
		var $dbcon;
		var $debug;	// 디버그 모드 0:디버그 모드 아님, 1:에러메시지, 2:경고메시지, 3:전부출력
		var $dbname;
		var $table_insert_id;
		var $escape_ch;
		var $db_type;

		function db_class()
		{
			$this->dbcon=NULL;
			$this->debug=0;
			$this->dbname='';
			$this->escape_ch=chr(27);
		}

/******************************************************************************
기능 : ESCAPE 문자변환
사용법 : 
******************************************************************************/
		function escape_string($str,$like=0,$decode=0) { return false; }

		function set_debug($debug) { $this->debug=$debug; }
		function get_debug($debug) { return $this->debug; }
		function free_result(&$rs) { return false; }
		function affected_rows() { return false; }
		
		
		// 데이타베이스 초기화
		function connect($host,$user,$pass,$dbname=NULL,$port='') { return false; }
	
		function select_db($dbname) { return false; }
		
		// 데이타베이스 닫기
		function dbclose() { return false; }
	
		// 결과를 읽어서 변수에 저장(변수는 ,로 구분)
		function fetch($rs,$vars=NULL,$mode='') { return false; }
		
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
		function query($query,$test=false){ return false; }
		
		function update_result() { return false; }
		
		//필드리스트을 구한다.
		function list_fields($table) { return false; }
		
		//테이블 목록을 구한다.
		function list_tables($table=NULL) { return false; }
		
		// 결과 행수
		function num_rows($rs) { return NULL; }
		
		function insert_id() { return NULL; }
		
		function commit() { return true; }

		function rollback() { return false; }
		
		function error() { return ''; }
	}
} // *-- CLASS_DB_INC_INCLUDED END --*
?>