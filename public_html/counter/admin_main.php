<?
/* =====================================================

  최종수정일 : 
 ===================================================== */
	include_once("../include/lib.php");
	require_once($_path['counter'].'counter.lib.php');
	
	// 접속가능 체크
	if(!$rg_counter_access_guest && (!$rg_counter_access_guest && !$_auth['admin'])) {
		rg_href($_url['member']."login.php?ret_url=".$_SERVER['PHP_SELF'],"관리자만 접속 가능합니다.");
	}
		
	$today = mktime(0,0,0,date('m'),date('d'),date('Y'));
	// 최대 최소 년도
	$rs->clear();
	$rs->set_table($_table['prefix'].'counter_day');
	$rs->add_field('min(reg_date) as min_date');
	$rs->add_field('max(reg_date) as max_date');
	$rs->fetch('min_date,max_date');
	
	if(!$min_date) $min_date=$today;
	
	if(!$max_date) $max_date=$today;
	
	$min_year=date('Y',$min_date);
	$max_year=date('Y',$max_date);
	
	$min_year_month=date('m',$min_date);
	$max_year_month=date('m',$max_date);

	$type_list=array('main','hour','day','month','year','br','os','res','host','search','log');
	if(!in_array($type,$type_list)) $type='admin_main';
?>
<script src="calendar.js"></script>
<?
	include('admin_main.inc.php');
?>