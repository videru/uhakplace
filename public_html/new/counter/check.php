<?
/* =====================================================

  최종수정일 : 
 ===================================================== */
	include_once("../include/lib.php");
	require_once($_path['counter'].'counter.lib.php');
	require_once($_path['counter'].'php_browser_detection.php');
	
	if(!$rg_counter_use) exit;
	
	$yy = date('Y');
	$mm = date('n');
	$dd = date('j');
	$hh = date('G');
	$ww = date('w');
	$now = time();
	$today = mktime(0,0,0,date('m'),date('d'),date('Y'));
	$yesterday = mktime(0,0,0,date('m'),date('d')-1,date('Y'));
	$tomorrow = mktime(0,0,0,date('m'),date('d')+1,date('Y'));
	$today_date = date("Y-m-d"); // 오늘날자

	$agent = browser_detection('full');
	$br=trim($agent[7].' '.$agent[9]); // 브라우저
	if($agent[5]=='nt') {
		if($agent[6]=='5.0') {
			$os='win 2000';
		} else if($agent[6]=='5.1') {
			$os='win xp';
		} else if($agent[6]=='5.2') {
			$os='win 2003';
		} else
			$os=trim($agent[5].' '.$agent[6]);
	} else
		$os=trim($agent[5].' '.$agent[6]); // 브라우저
		
	$referrer=$_GET['referrer']; // 레퍼럴
	if($_GET['res_w'] && $_GET['res_h'])
		$res=$_GET['res_w'].'x'.$_GET['res_h']; // 해상도
	else
		$res='';
	$page=$_SERVER['HTTP_REFERER']; // 현재페이지
	$ip=$_SERVER['REMOTE_ADDR'];
	$tmp=parse_url($referrer);
	$ref_host=$tmp['host'];
	$ref_query=$tmp['query'];
	$tmp=parse_url($page);
	$page_host=$tmp['host'];
	if($ref_host == $page_host) { // 자신의 사이트라면 레퍼럴은 인정 못함
		$referrer='';
		$ref_host='';
		$ref_query='';	
	}
	
	if($referrer!='') {
		foreach($search_engines as $key => $val) {
			if(eregi($key,$ref_host)) {
				parse_str($ref_query, $querys);
				$engine_host=$key; // 검색엔진 도메인
				$engine_name=$val[0]; // 검색엔진 이름
				$engine_keyword=urlutfchr($querys[$val[1]]); // 키워드
				$engine_keyword=check_conv_utf_kr($engine_keyword);
			}			
		}
	}
	
	// 오늘 접속이 있었는지 확인
	$rs->clear();
	$rs->set_table($_table['prefix'].'counter_log');
	$rs->add_field('count(*) as ip_chk');
	$rs->add_where("reg_date >= $today");
	$rs->add_where("reg_date < $tomorrow");
	$rs->add_where("ip='".$dbcon->escape_string($ip)."'");
	$rs->fetch('ip_chk');
	if($ip_chk>0) {
		$unique_ip=false;
		$rs->clear_field();
		$rs->field_sql="hits = hits+1";
		$rs->update();
	} else {
		$unique_ip=true;
		$rs->clear_field();
		$rs->add_field("ip",$ip);
		$rs->add_field("reg_date",$now);
		$rs->add_field("host",$ref_host);
		$rs->add_field("referrer",$referrer);
		$rs->add_field("keyword",$engine_keyword);
		$rs->add_field("hits",1);
		$rs->add_field("browser",$br);
		$rs->add_field("os",$os);
		$rs->add_field("res",$res);
		$rs->insert();
	}
	
	// 브라우저 통계 업데이트
	if($br!='') {
		$rs->clear();
		$rs->set_table($_table['prefix'].'counter_etc');
		$rs->field_sql="hits = hits+1";
		if($unique_ip)	$rs->field_sql.=",unique_hits = unique_hits+1";
		if(RG_DBTYPE==RG_DB_CUBRID || RG_DBTYPE==RG_DB_ORACLE) {
			$rs->add_where("\"type\" = 'br'");
		} else {
			$rs->add_where("type = 'br'");
		}
		$rs->add_where("yy = $yy");
		$rs->add_where("mm = $mm");
		if(RG_DBTYPE==RG_DB_ORACLE)
			$rs->add_where("\"name\" = '".$dbcon->escape_string($br)."'");
		else
			$rs->add_where("name = '".$dbcon->escape_string($br)."'");
		$rs->update();
		if($rs->affected_rows()==0) {
			$rs->clear_field();
			$rs->add_field("type",'br');
			$rs->add_field("yy",$yy);
			$rs->add_field("mm",$mm);
			$rs->add_field("name",$br);
			$rs->add_field("hits",'1');
			$rs->add_field("unique_hits",'1');
			$rs->insert();
		}
	}
	
	// OS 통계 업데이트
	if($os!='') {
		$rs->clear();
		$rs->set_table($_table['prefix'].'counter_etc');
		$rs->field_sql="hits = hits+1";
		if($unique_ip)	$rs->field_sql.=",unique_hits = unique_hits+1";
		if(RG_DBTYPE==RG_DB_CUBRID || RG_DBTYPE==RG_DB_ORACLE) {
			$rs->add_where("\"type\" = 'os'");
		} else {
			$rs->add_where("type = 'os'");
		}
		$rs->add_where("yy = $yy");
		$rs->add_where("mm = $mm");
		if(RG_DBTYPE==RG_DB_ORACLE)
			$rs->add_where("\"name\" = '".$dbcon->escape_string($os)."'");
		else
			$rs->add_where("name = '".$dbcon->escape_string($os)."'");
		$rs->update();
		if($rs->affected_rows()==0) {
			$rs->clear_field();
			$rs->add_field("type",'os');
			$rs->add_field("yy",$yy);
			$rs->add_field("mm",$mm);
			$rs->add_field("name",$os);
			$rs->add_field("hits",'1');
			$rs->add_field("unique_hits",'1');
			$rs->insert();
		}
	}
	
	// 해상도 통계 업데이트
	if($res!='') {
		$rs->clear();
		$rs->set_table($_table['prefix'].'counter_etc');
		$rs->field_sql="hits = hits+1";
		if($unique_ip)	$rs->field_sql.=",unique_hits = unique_hits+1";
		if(RG_DBTYPE==RG_DB_CUBRID || RG_DBTYPE==RG_DB_ORACLE) {
			$rs->add_where("\"type\" = 'res'");
		} else {
			$rs->add_where("type = 'res'");
		}
		$rs->add_where("yy = $yy");
		$rs->add_where("mm = $mm");
		if(RG_DBTYPE==RG_DB_ORACLE)
			$rs->add_where("\"name\" = '".$dbcon->escape_string($res)."'");
		else
			$rs->add_where("name = '".$dbcon->escape_string($res)."'");
		$rs->update();
		if($rs->affected_rows()==0) {
			$rs->clear_field();
			$rs->add_field("type",'res');
			$rs->add_field("yy",$yy);
			$rs->add_field("mm",$mm);
			$rs->add_field("name",$res);
			$rs->add_field("hits",'1');
			$rs->add_field("unique_hits",'1');
			$rs->insert();
		}
	}
		
	// 레퍼럴 호스트 통계 업데이트
	if($ref_host!='') {
		$rs->clear();
		$rs->set_table($_table['prefix'].'counter_host');
		$rs->field_sql="hits = hits+1";
		if($unique_ip)	$rs->field_sql.=",unique_hits = unique_hits+1";
		$rs->add_where("yy = $yy");
		$rs->add_where("mm = $mm");
		$rs->add_where("host = '".$dbcon->escape_string($ref_host)."'");
		$rs->update();
		if($rs->affected_rows()==0) {
			$rs->clear_field();
			$rs->add_field("yy",$yy);
			$rs->add_field("mm",$mm);
			$rs->add_field("host",$ref_host);
			$rs->add_field("hits",'1');
			$rs->add_field("unique_hits",'1');
			$rs->insert();
		}	
	}
		
	// 검색엔진 통계 업데이트
	if($engine_keyword!='') {
		$keyword_array=explode(" ",$engine_keyword); // 검색어를 공백으로 분리한다
		$rs->set_table($_table['prefix'].'counter_search');
		foreach($keyword_array as $keyword) {
			$rs->clear();
			$rs->field_sql="hits = hits+1";
			if($unique_ip)	$rs->field_sql.=",unique_hits = unique_hits+1";
			$rs->add_where("yy = $yy");
			$rs->add_where("mm = $mm");
			$rs->add_where("host = '".$dbcon->escape_string($engine_host)."'");
			$rs->add_where("keyword = '".$dbcon->escape_string($keyword)."'");
			$rs->update();
			if($rs->affected_rows()==0) {
				$rs->clear_field();
				$rs->add_field("yy",$yy);
				$rs->add_field("mm",$mm);
				$rs->add_field("host",$engine_host);
				$rs->add_field("name",$engine_name);
				$rs->add_field("keyword",$keyword);
				$rs->add_field("hits",'1');
				$rs->add_field("unique_hits",'1');
				$rs->insert();
			}
		}
	}
	
	// 통계 업데이트
	$rs->clear();
	$rs->set_table($_table['prefix'].'counter_day');
	$rs->field_sql="hh{$hh}=hh{$hh}+1,hits=hits+1";
	if($unique_ip)	$rs->field_sql.=",uhh{$hh}=uhh{$hh}+1,unique_hits=unique_hits+1";;	
	$rs->add_where("reg_date = $today");
	$rs->update();
	if($rs->affected_rows()==0) {
		$rs->clear_field();
		$rs->add_field("reg_date",$today);
		$rs->add_field("yy",$yy);
		$rs->add_field("mm",$mm);
		$rs->add_field("dd",$dd);
		$rs->add_field("ww",$ww);
		$rs->add_field("hh{$hh}","1");
		$rs->add_field("hits","1");
		$rs->add_field("uhh{$hh}","1");
		$rs->add_field("unique_hits","1");		
		$rs->insert();
		
		if(!$rg_counter_log_on) { // 로그를 안남긴다.(1일전꺼 삭제)
			$log_del_day = mktime(0,0,0,date('m'),date('d')-1,date('Y'));
		} else { // 로그를 남겨도 3개월 이전의 데이타는 삭제한다.
			$log_del_day = mktime(0,0,0,date('m')-3,date('d'),date('Y'));
		}
		$rs->clear();
		$rs->set_table($_table['prefix'].'counter_log');
		$rs->add_where("reg_date < $log_del_day");
		$rs->delete();
	}
	$rs->commit();
?>