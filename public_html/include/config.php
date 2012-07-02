<? if (!defined('RGBOARD_VERSION')) exit; ?>
<?
/* =====================================================

  최종수정일 : 
 ===================================================== */

	if(isset($_REQUEST['site_path']) || isset($_REQUEST['site_url'])) exit;
	if(!isset($site_path)) $site_path='../';
	if(!isset($site_url)) $site_url='../';
	if(!isset($site_path) || preg_match("/:\/\//",$site_path)) $site_path='../';	
	
	$_table									= array(); // 테이블명 배열
	$_table['prefix']				= 'rg4_';	// 테이블명 접두어
	$_table['member']				= $_table['prefix'].'member';	// 회원
	$_table['group']				= $_table['prefix'].'group';	//	그룹
	$_table['gmember']			= $_table['prefix'].'gmember';	//	그룹회원
	$_table['bbs_cfg']			= $_table['prefix'].'bbs_cfg';	//	게시판설정
	$_table['bbs_body']			= $_table['prefix'].'bbs_body';	//	게시판 본문
	$_table['bbs_comment']	= $_table['prefix'].'bbs_comment';	//	게시판 코멘트
	$_table['bbs_category']	= $_table['prefix'].'bbs_category';	//	게시판 카테고리
	$_table['setup']				= $_table['prefix'].'setup';	//	사이트설정
	$_table['point']				= $_table['prefix'].'point';	//	포인트내역
	$_table['note']					= $_table['prefix'].'note';	//	쪽지
	$_table['zip']					= $_table['prefix'].'zip';	//	우편번호

	$_table['school']				= $_table['prefix'].'school';	//	학교
	$_table['school_cost']				= $_table['prefix'].'school_cost';	//	학교
	$_table['pre_regi']			    	= $_table['prefix'].'pre_regi';	//	등혹현황
	$_table['regi']			    	= $_table['prefix'].'regi';	//	등혹현황
	$_table['relaship']			   	= $_table['prefix'].'relaship';	//	연계연수
	$_table['online']			   	= $_table['prefix'].'online';	//	상담신청
    $_table['real_regi']          	= $_table['prefix'].'real_regi';	//	메일수속현황
    $_table['ger_sangdam']          	= $_table['prefix'].'ger_sangdam';	//	독일상담현황
    $_table['consult']          	= $_table['prefix'].'consult';	//	제휴문의
    $_table['cf']          	= $_table['prefix'].'cf';	//	광고문의
    $_table['working']          	= $_table['prefix'].'working';	//	일정관리
    $_table['today_work']          	= $_table['prefix'].'today_work';	//	주요일정
	$_table['camp_regi']					= $_table['prefix'].'camp_regi';	//	캠프등록
	$_table['exchange']					= $_table['prefix'].'exchange';	//	환율
	$_table['account_kyejung']					= $_table['prefix'].'account_kyejung';	//	회계	
	$_table['account']					= $_table['prefix'].'account';	//	회계	
	$_table['st_account']					= $_table['prefix'].'st_account';	//	회계	
	$_table['regi_account']					= $_table['prefix'].'regi_account';	//	수속회계		
	$_table['camp']					= $_table['prefix'].'camp';	//	캠프등록
	$_table['ju_school']					= $_table['prefix'].'ju_school';	//	캠프등록
 	$_table['young']					= $_table['prefix'].'young';	//	캠프등록
 	$_table['intern']					= $_table['prefix'].'intern';	//	캠프등록
 	$_table['hp_site']					= $_table['prefix'].'hp_site';	//	캠프등록
 	$_table['consult']					= $_table['prefix'].'consult';	//	캠프등록
 	$_table['cafe_member']					= $_table['prefix'].'cafe_member';	//	캠프등록
    $_table['ca_mem_comm']		= $_table['prefix'].'ca_mem_comm';	
	$_table['alim']					= $_table['prefix'].'alim';	//	우편번호	
 	$_table['cafe_online']					= $_table['prefix'].'cafe_online';	//	캠프등록
	$_table['sms']					= $_table['prefix'].'sms';	//	우편번호
	$_table['main_regi']					= $_table['prefix'].'main_regi';	//	우편번호


	$_path							= array(); // 서버상의 경로
	$_path['site']			= $site_path;	// 기본경로
	// 사이트 PATH
	$_path['bbs']				= $_path['site'].'board/';	// 게시판
	$_path['css']				= $_path['site'].'css/';	// 스타일시트
	$_path['member']		= $_path['site'].'member/';	// 회원
	$_path['js']				= $_path['site'].'js/';	// 스크립트
	$_path['admin']			= $_path['site'].'admin/';	// 관리자
	$_path['counter']		= $_path['site'].'counter/';	// 카운터
	$_path['inc']				= $_path['site'].'include/';	// 라이브러리등
	$_path['mail_form']	= $_path['site'].'mail/';	// 이메일주소경로
	$_path['skin']			= $_path['site'].'skin/';	// 스킨경로
	// 스킨 PATH
	$_path['bbs_skin']	= $_path['skin'].'board/';	// 게시판 스킨
	$_path['login_skin']= $_path['skin'].'login/';	// 로그인 스킨
	$_path['last_skin']	= $_path['skin'].'last/';	// 최근글 스킨
	// 데이타 PATH
	$_path['data']			= $_path['site'].'data/';	// 데이타파일
	$_path['member_data']	= $_path['data'].'member/';	// 회원 데이타파일
	$_path['bbs_data']	= $_path['data'].'board/';	// 게시판 첨부파일
	$_path['session']		= $_path['data'].'session/';	// 세션

	$_url								= array(); // URL 웹경로
	$_url['site']				= $site_url;	// 기본경로
	// 사이트 URL
	$_url['bbs']				= $_url['site'].'board/';	// 게시판
	$_url['css']				= $_url['site'].'css/';	// 스타일시트
	$_url['member']			= $_url['site'].'member/';	// 회원
	$_url['newmember']			= $_url['site'].'newmember/';	// 회원
	$_url['js']					= $_url['site'].'js/';	// 스크립트
	$_url['admin']			= $_url['site'].'admin/';	// 관리자
	$_url['counter']		= $_url['site'].'counter/';	// 카운터
	$_url['mail_form']	= $_url['site'].'mail/';	// 이메일주소경로
	$_url['skin']				= $_url['site'].'skin/';	// 스킨경로
	// 스킨 URL
	$_url['bbs_skin']		= $_url['skin'].'board/';	// 게시판 스킨
	$_url['login_skin']	= $_url['skin'].'login/';	// 로그인 스킨
	$_url['last_skin']	= $_url['skin'].'last/';	// 최근글 스킨

	// 상수정의
	$_const = array();
	$_const['member_states']		= array(0=>'대기',1=>'승인',2=>'미승인',3=>'탈퇴'); // 회원상태
	$_const['group_states']			= array(0=>'대기',1=>'승인',2=>'미승인',3=>'폐쇄');	// 그룹상태
	$_const['group_level_type']	= array(0=>'회원레벨',1=>'그룹레벨');	// 그룹레벨 적용방식

	$_const['admin_level']			= 90;	// 최고 관리자 레벨
	$_const['group_admin_level']= 50;	// 그룹 관리자 레벨
	$_const['sex']							= array('M'=>'남자','F'=>'여자'); // 성별

	$_const['member_form_state'] = array(0=>'사용안함',1=>'선택',2=>'필수');
	$_const['member_forms'] = array(
		'mb_name' => '이름',
		'mb_nick' => '닉네임',
		'mb_email' => '이메일',
		'mb_jumin' => '주민등록번호',
		'mb_tel1' => '전화번호',
		'mb_tel2' => '핸드폰번호',
		'mb_address' => '주소',
		'mb_signature' => '서명',
		'mb_introduce' => '자기소개',
		'photo1' => '사진',
		'icon1' => '회원아이콘'
	);


	$_const['national']			= array('1'=>'뉴질랜드','2'=>'호주','3'=>'필리핀','4'=>'영국','5'=>'캐나다'); // 나라
	$_const['national01']			= array('1'=>'뉴질랜드','2'=>'호주','3'=>'필리핀','4'=>'영국','5'=>'캐나다','6'=>'미국'); // 나라
	$_const_uhak['national']	= array('6'=>'미국','2'=>'호주','1'=>'뉴질랜드','3'=>'필리핀','5'=>'캐나다'); // 나라

	$_const_main['national']	= array('1'=>'필리핀','2'=>'호주','3'=>'캐나다'); // 나라

	$_camp_list['camp']	= array('1'=>'필리핀 세부 영어/수학 캠프','2'=>'필리핀 일로일로 영어 집중 캠프'); // 캠프
	
	$_camp_s_list['camp']	= array('1'=>'세부','2'=>'일로일로'); // 캠프

	$_const['area1']			= array('1'=>'오클랜드','2'=>'크라이스트쳐치','3'=>'웰링턴','4'=>'기타'); // 뉴질랜드지역	
	$_const['area2']			= array('1'=>'시드니','2'=>'브리스번','3'=>'퍼스','4'=>'멜번','5'=>'호바트','6'=>'케언즈','7'=>'기타지역'); // 호주지역
	$_const['area3']			= array('1'=>'마닐라','2'=>'세부','3'=>'바기오','4'=>'일로일로','5'=>'바콜로드','6'=>'기타지역'); // 필리핀지역	
	$_const['area4']			= array('1'=>'런던','2'=>'브리스틀','3'=>'옥스포드','4'=>'캠브릿지','5'=>'본머스','6'=>'기타지역'); // 영국지역
	$_const['area5']			= array('1'=>'','2'=>'','3'=>'','4'=>'','5'=>'','6'=>'기타지역'); // 캐나다지역

     $_const['root']  = array('1'=>'네이버 뉴질랜드','2'=>'네이버 호주','3'=>'네이버 영국','4'=>'네이버 캐나다','5'=>'네이버 필리핀','6'=>'다음 호주&뉴질랜드','7'=>'전화','8'=>'메신저','9'=>'홈페이지','10'=>'기타'); // 접속경로
	$_regi['rgi']			= array('1'=>'카페','2'=>'홈페이지'); // 지사

	$_const['section']			= array('1'=>'어학연수','2'=>'정규유학'); // 나라

	$_regi['national']			= array('1'=>'필리핀','2'=>'캐나다','3'=>'호주','4'=>'독일','5'=>'필리핀+호주','6'=>'필리핀+캐나다','7'=>'필리핀+호주','8'=>'필리핀+독일'); // 나라
	$_regi['chain']			= array('1'=>'강남','2'=>'부산'); // 지사

	$_reserv['transaction']			= array('1'=>'예약대기','2'=>'전화상담','3'=>'예약완료','4'=>'예약연기'); // 방문상담예약

	$_reserv['sangdam']			= array('1'=>'처리대기','2'=>'상담대기','3'=>'상담완료'); // 방문상담예약

	$_reserv['sang']			= array('1'=>'상담대기','2'=>'상담완료'); // 방문상담예약

    
	$_reserv['regi_state']     = array('1'=>'수속등록전','2'=>'수속등록완료'); // 등록여부

	$_process['process_state']     = array('1'=>'등록대기','2'=>'여권/비자 확인','3'=>'입학금 입금','4'=>'어학교 등록','5'=>'항공 예약','6'=>'항공비 완납','7'=>'항공권 발급','8'=>'학비입금','9'=>'학비송금','10'=>'출국 O/T','11'=>'출국'); // 등록진행상황

	$_relaship['national']			= array('1'=>'필리핀+호주','2'=>'필리핀+캐나다','3'=>'필리핀+독일'); // 연계연수

    $_const['section']        = array('1'=>'대학부설','2'=>'사설'); // 학교구분
    
	$_const['section2']        = array('1'=>'정규대학','3'=>'초.중고등 공립','4'=>'초.중고등 사설',); // 학교구분

    $_const['in_out_comm']        = array('1'=>'입금','2'=>'출금',); // 학교구분

	$_const['money_type']			= array('1'=>'국내납부','2'=>'현지납부'); // 지사
    $_const['money']	= array('1'=>'원','2'=>'페소','3'=>'달러'); // 지사

    $_const['sc_type']	= array('1'=>'스파르타어학원','2'=>'시설 좋은 어학원','3'=>'주변환경 짱 어학원','4'=>'영어기숙사 있는 어학원','5'=>'1대1수업5시간이상 어학원','6'=>'저렴한 어학원','7'=>'중,소규모어학원','8'=>'대규모어학원','9'=>'국적비율이 좋은 어학원','10'=>'대학부설 어학원','11'=>'다양한 코스','12'=>'IELTS'); 

   $_const[year]       = array('2010'=>'2010','2011'=>'2011','2012'=>'2012','2013'=>'2013','2014'=>'2014'); 
   $_const[month]       = array('1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10','11'=>'11','12'=>'12'); 


   $_const[no]       = array('1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8'); 


   $_const[rate]       = array('0'=>'0%','1'=>'10%','2'=>'30%','3'=>'50%','4'=>'70%','5'=>'90%'); 
  
   $_const[camp_type]       = array('1'=>'주니어캠프','2'=>'가족캠프'); 


   $_const[camp_type2]     = array('1'=>'주니어연수','2'=>'가족연수'); 


    $_const['tel']	= array('1'=>'010','2'=>'011','3'=>'016','4'=>'019','5'=>'017','6'=>'018'); // 지사


   $_cafe[class_type]       = array('1'=>'필리핀어학연수','2'=>'필리핀+연계연수(호주, 뉴질랜드, 영국, 캐나다)','3'=>'호주, 뉴질랜드, 영국, 캐나다 연수'); 

   $_cafe[gigan]       = array('1'=>'3개월이하','2'=>'3개월~6개월','3'=>'6개월~12개월','4'=>'12개월이상'); 

	
	// 디비 형태
	$_const['db_type']					= array();
	$_const['db_type']['MYSQL']	= array('code'=>'MYSQL','name'=>'Mysql','hname'=>'Mysql','default_port'=>'3306');
	$_const['db_type']['CUBRID']= array('code'=>'CUBRID','name'=>'Cubrid','hname'=>'큐브리드','default_port'=>'33000');
	$_const['db_type']['ORACLE']= array('code'=>'ORACLE','name'=>'Oracle','hname'=>'오라클','default_port'=>'1521');

	// 포인트형태
	$_po_type_code		= array('etc'=>'0','bbs'=>'1','shop'=>'2','admin'=>'10');
	$_po_type_name		= array('0'=>'기타','1'=>'게시판','2'=>'쇼핑몰','10'=>'관리자');
	
	$_auth=false;			// 권한 초기화
	$_bbs_auth=false;	// 게시판 권한 초기화
	$_mb=false;				// 회원정보초기화
?>