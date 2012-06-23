<?
/* =====================================================

  최종수정일 : 
 ===================================================== */
 
	// 카운터 사용할지
	$rg_counter_use=true;

	// 로그를 남길지 (로그를 안남긴다면 로그는 1일까지만 저장하고 그전꺼는 삭제)
	$rg_counter_log_on=true;
	
	// 일반 방문자도 통계화면을 볼수 있는지 true 볼수 있다, false 볼수 없음
	$rg_counter_access_guest=false;

	// 검색엔진 목록
	$search_engines['naver.com']=array('네이버','query');
	$search_engines['empas.com']=array('엠파스','q');
	$search_engines['daum.net']=array('다음','q');
	$search_engines['nate.com']=array('네이트','Query');
	$search_engines['dreamwiz.com']=array('드림위즈','q');
	$search_engines['yahoo.com']=array('야후','p');
	$search_engines['google.co.kr']=array('구글','q');
	$search_engines['google.com']=array('구글','q');
	$search_engines['paran.com']=array('파란','Query');
	$search_engines['korea.com']=array('코리아닷컴','keyword');
	$search_engines['msn.co.kr']=array('MSN','q');

	$weeks=array(0=>'일',1=>'월',2=>'화',3=>'수',4=>'목',5=>'금',6=>'토');

	// 유니코드 디코딩
	function urlutfchr($text){
		return urldecode(preg_replace_callback('/%u([[:alnum:]]{4})/', 'unitostring', $text));
	}	

	function unitostring($text){
		return iconv('UTF-16LE', 'UHC', chr(hexdec(substr($text[1], 2, 2))).chr(hexdec(substr($text[1], 0, 2))));
	}
	
	function check_conv_utf_kr($str) { // 유니코드 확인 하여 변환하기
		if(iconv("EUC-KR","EUC-KR",$str)==$str) {
			return $str;
		} else {
			return iconv("UTF-8","EUC-KR",$str);
		}
	}
?>