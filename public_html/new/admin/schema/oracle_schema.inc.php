<? if (!defined('RGBOARD_VERSION')) exit; ?>
<?
/* =====================================================
  프로그램명 : 알지보드 V4
  화일명 : 
  작성일 : 
  작성자 : 윤범석 ( http://rgboard.com )
  작성자 E-Mail : master@rgboard.com

  최종수정일 : 2008-04-02
 ===================================================== */
if (!defined('SCHEMA_INC_INCLUDED')) {  
    define('SCHEMA_INC_INCLUDED', 1);
// *-- SCHEMA_INC_INCLUDED START --*
	$db_schema['member']				= // 회원
	"(
		mb_num INTEGER,
		mb_id varchar2(255) default '',
		mb_pass varchar2(255) default '',
		mb_name varchar2(255) default '',
		mb_nick varchar2(255) default '',
		mb_level SMALLINT default 0,
		mb_state SMALLINT default 0,
		mb_jumin varchar2(255) default '',
		mb_sex char(2) default '',
		mb_post varchar2(255) default '',
		mb_address1 varchar2(255) default '',
		mb_address2 varchar2(255) default '',
		mb_email varchar2(255) default '',
		mb_tel1 varchar2(255) default '',
		mb_tel2 varchar2(255) default '',
		mb_files varchar2(4000),
		mb_is_mailing SMALLINT default 0,
		mb_is_opening SMALLINT default 0,
		mb_open_field varchar2(4000),
		mb_signature varchar2(4000),
		mb_introduce varchar2(4000),
		mb_admin_memo varchar2(4000),
		mb_ext1 varchar2(4000),
		mb_ext2 varchar2(4000),
		mb_ext3 varchar2(4000),
		mb_ext4 varchar2(4000),
		mb_ext5 varchar2(4000),
		mb_point INTEGER default 0,
		login_count INTEGER default 0,
		login_date INTEGER default 0,
		login_ip varchar2(20) default '',
		join_date INTEGER default 0,
		join_ip varchar2(20) default '',
		modify_date INTEGER default 0,
		modify_ip varchar2(20) default '',
		PRIMARY KEY  (mb_num)
	)";
	$db_schema_index['member']=array('mb_id','mb_name','mb_nick','mb_jumin','mb_state');
	
	$db_schema['group']				= //	그룹
	"(
		gr_num INTEGER,
		gr_id varchar2(255) default '',
		gr_name varchar2(255) default '',
		gr_desc varchar2(4000),
		gr_header_file varchar2(255) default '',
		gr_header_tag varchar2(4000),
		gr_footer_tag varchar2(4000),
		gr_footer_file varchar2(255) default '',
		gr_state SMALLINT default 0,
		gr_default_state SMALLINT default 0,
		gr_default_level SMALLINT default 0,
		gr_level_type SMALLINT default 0,
		gr_level_info varchar2(4000),
		gr_ext_cfg varchar2(4000),
		gr_admin_memo varchar2(4000),
		gr_reg_date INTEGER default 0,
		gr_reg_mb INTEGER default 0,
		PRIMARY KEY  (gr_num)
	)";
	$db_schema_index['group']=array('gr_id','gr_name','gr_state');

	$db_schema['gmember']			= //	그룹회원
	"(
		gm_num INTEGER,
		gr_num INTEGER default 0,
		mb_num INTEGER default 0,
		gm_reg_date INTEGER default 0,
		gm_reg_ip varchar2(20) default '',
		gm_state SMALLINT default 0,
		gm_level SMALLINT default 0,
		gm_ext1 varchar2(4000),
		gm_ext2 varchar2(4000),
		gm_ext3 varchar2(4000),
		gm_ext4 varchar2(4000),
		gm_ext5 varchar2(4000),
		PRIMARY KEY  (gm_num)
	)";
	$db_schema_index['gmember']=array('gr_num','mb_num','gm_state');

	$db_schema['bbs_cfg']			= //	게시판설정
	"(
		bbs_num INTEGER,
		bbs_code varchar2(255) default '',
		bbs_db varchar2(255) default '',
		bbs_db_num INTEGER default 0,
		gr_num INTEGER default 0,
		bbs_name varchar2(255) default '',
		bbs_skin varchar2(255) default '',
		use_category SMALLINT default 0,
		default_content varchar2(4000),
		auth_list SMALLINT default 0,
		auth_view SMALLINT default 0,
		auth_write SMALLINT default 0,
		auth_reply SMALLINT default 0,
		auth_modify SMALLINT default 0,
		auth_delete SMALLINT default 0,
		auth_comment SMALLINT default 0,
		auth_secret SMALLINT default 0,
		list_cfg varchar2(4000),
		write_cfg varchar2(4000),
		reply_cfg varchar2(4000),
		view_cfg varchar2(4000),
		mailing_mb_id varchar2(4000),
		admin_mb_id varchar2(4000),
		point_write INTEGER default 0,
		point_reply INTEGER default 0,
		point_comment INTEGER default 0,
		header_file varchar2(255) default '',
		header_tag varchar2(4000),
		footer_tag varchar2(4000),
		footer_file varchar2(255) default '',
		reg_date INTEGER default 0,
		bbs_ext1 varchar2(4000),
		bbs_ext2 varchar2(4000),
		bbs_ext3 varchar2(4000),
		bbs_ext4 varchar2(4000),
		bbs_ext5 varchar2(4000),
		admin_memo varchar2(4000),
		deny_word varchar2(4000),
		deny_html varchar2(4000),
		deny_ip varchar2(4000),
		PRIMARY KEY  (bbs_num)
	)";
	$db_schema_index['bbs_cfg']=array('bbs_code','bbs_db','bbs_db_num','gr_num');

	$db_schema['bbs_body']			= //	게시판 본문
	"(
		bd_num INTEGER,
		gr_num INTEGER default 0,
		bbs_db_num INTEGER default 0,
		mb_num INTEGER default 0,
		mb_id varchar2(255) default '',
		is_admin SMALLINT default 0,
		cat_num INTEGER default 0,
		bd_top_num INTEGER default 0,
		bd_parent_num INTEGER default 0,
		bd_sequence INTEGER default 0,
		bd_depth INTEGER default 0,
		bd_next_num INTEGER default 0,
		bd_comment_count INTEGER default 0,
		bd_name varchar2(255) default '',
		bd_pass varchar2(255) default '',
		bd_email varchar2(255) default '',
		bd_home varchar2(255) default '',
		bd_subject varchar2(255) default '',
		bd_content varchar2(4000),
		bd_files varchar2(4000),
		bd_links varchar2(4000),
		bd_html SMALLINT default 0,
		bd_secret SMALLINT default 0,
		bd_notice SMALLINT default 0,
		bd_reply_mail SMALLINT default 0,
		bd_delete SMALLINT default 0,
		bd_write_date INTEGER default 0,
		bd_write_ip varchar2(20) default '',
		bd_modify_date INTEGER default 0,
		bd_modify_ip varchar2(20) default '',
		bd_view_count INTEGER default 0,
		bd_vote_yes INTEGER default 0,
		bd_vote_no INTEGER default 0,
		bd_ext1 varchar2(4000),
		bd_ext2 varchar2(4000),
		bd_ext3 varchar2(4000),
		bd_ext4 varchar2(4000),
		bd_ext5 varchar2(4000),
		PRIMARY KEY  (bd_num)
	)";
	$db_schema_index['bbs_body']=array('bd_top_num','bd_next_num','bd_name','bd_subject',
																		'bd_notice','gr_num','bbs_db_num','cat_num');

	$db_schema['bbs_comment']	= //	게시판 코멘트
	"(
		bc_num INTEGER,
		gr_num INTEGER default 0,
		bbs_db_num INTEGER default 0,
		bd_num INTEGER default 0,
		mb_num INTEGER default 0,
		mb_id varchar2(255) default '',
		bc_name varchar2(255) default '',
		bc_pass varchar2(255) default '',
		bc_email varchar2(255) default '',
		bc_home varchar2(255) default '',
		bc_content varchar2(4000),
		bc_write_date INTEGER default 0,
		bc_write_ip varchar2(20) default '',
		PRIMARY KEY  (bc_num)
	)";
	$db_schema_index['bbs_comment']=array('gr_num','bbs_db_num','bd_num','mb_num','mb_id','bc_name');

	$db_schema['bbs_category']	= //	게시판 카테고리
	"(
		cat_num INTEGER,
		bbs_db_num INTEGER default 0,
		cat_order INTEGER default 0,
		cat_name varchar2(255) default '',
		cat_count INTEGER default 0,
		PRIMARY KEY  (cat_num)
	)";
	$db_schema_index['bbs_category']=array('cat_order','bbs_db_num');

	$db_schema['setup']				= //	사이트설정
	"(
		ss_num INTEGER,
		ss_name varchar2(255) default '',
		ss_content varchar2(4000),
		PRIMARY KEY  (ss_num)
	)";
	$db_schema_index['setup']=array('ss_name');

	$db_schema['point']				= //	포인트내역
	"(
		po_num INTEGER,
		mb_num INTEGER default 0,
		po_type SMALLINT default 0,
		po_part1 varchar2(255) default '',
		po_part2 varchar2(255) default '',
		po_point INTEGER default 0,
		po_current_point INTEGER default 0,
		po_date INTEGER default 0,
		po_data varchar2(4000),
		PRIMARY KEY  (po_num)
	)";
	$db_schema_index['point']=array('mb_num');

	$db_schema['note']					= //	쪽지
	"(
		nt_num INTEGER,
		mb_num INTEGER default 0,
		nt_type SMALLINT default 0,
		nt_save SMALLINT default 0,
		recv_mb_num INTEGER default 0,
		sent_mb_num INTEGER default 0,
		nt_sent_date INTEGER default 0,
		nt_recv_date INTEGER default 0,
		nt_sent_num INTEGER default 0,
		nt_link varchar2(255) default '',
		nt_content varchar2(4000),
		PRIMARY KEY  (nt_num)
	)";
	$db_schema_index['note']=array('mb_num','nt_type','nt_save','recv_mb_num','sent_mb_num','nt_sent_num');

	$db_schema['zip']					= //	우편번호
	"(
		seq INTEGER default 0,
		zipcode varchar2(9) default '',
		sido varchar2(5) default '',
		gugun varchar2(16) default '',
		dong varchar2(53) default '',
		bunji varchar2(18) default '',
		PRIMARY KEY (seq)
	)";
	$db_schema_index['zip']=array('dong');

	$db_schema['counter_day']		= //	일별통계
	"(
		num INTEGER,
		reg_date INTEGER default 0,
		yy SMALLINT default 0,
		mm SMALLINT default 0,
		dd SMALLINT default 0,
		ww SMALLINT default 0,
		hh0 INTEGER default 0,
		hh1 INTEGER default 0,
		hh2 INTEGER default 0,
		hh3 INTEGER default 0,
		hh4 INTEGER default 0,
		hh5 INTEGER default 0,
		hh6 INTEGER default 0,
		hh7 INTEGER default 0,
		hh8 INTEGER default 0,
		hh9 INTEGER default 0,
		hh10 INTEGER default 0,
		hh11 INTEGER default 0,
		hh12 INTEGER default 0,
		hh13 INTEGER default 0,
		hh14 INTEGER default 0,
		hh15 INTEGER default 0,
		hh16 INTEGER default 0,
		hh17 INTEGER default 0,
		hh18 INTEGER default 0,
		hh19 INTEGER default 0,
		hh20 INTEGER default 0,
		hh21 INTEGER default 0,
		hh22 INTEGER default 0,
		hh23 INTEGER default 0,
		uhh0 INTEGER default 0,
		uhh1 INTEGER default 0,
		uhh2 INTEGER default 0,
		uhh3 INTEGER default 0,
		uhh4 INTEGER default 0,
		uhh5 INTEGER default 0,
		uhh6 INTEGER default 0,
		uhh7 INTEGER default 0,
		uhh8 INTEGER default 0,
		uhh9 INTEGER default 0,
		uhh10 INTEGER default 0,
		uhh11 INTEGER default 0,
		uhh12 INTEGER default 0,
		uhh13 INTEGER default 0,
		uhh14 INTEGER default 0,
		uhh15 INTEGER default 0,
		uhh16 INTEGER default 0,
		uhh17 INTEGER default 0,
		uhh18 INTEGER default 0,
		uhh19 INTEGER default 0,
		uhh20 INTEGER default 0,
		uhh21 INTEGER default 0,
		uhh22 INTEGER default 0,
		uhh23 INTEGER default 0,
		hits INTEGER default 0,
		unique_hits INTEGER default 0,
		PRIMARY KEY  (num),
		CONSTRAINT reg_date_idx UNIQUE (reg_date)
	)";
	$db_schema_index['counter_day']=array('ww','yy','mm','dd');

	$db_schema['counter_etc']		= //	기타통계
	"(
		num INTEGER,
		\"type\" char(3) default '',
		yy SMALLINT default 0,
		mm SMALLINT default 0,
		\"name\" varchar2(255) default '',
		hits INTEGER default 0,
		unique_hits INTEGER default 0,
		PRIMARY KEY  (num)
	)";
	$db_schema_index['counter_etc']=array('yy','mm');

	$db_schema['counter_host']		= //	호스트별통계
	"(
		num INTEGER,
		yy SMALLINT default 0,
		mm SMALLINT default 0,
		\"host\" varchar2(255) default '',
		hits INTEGER default 0,
		unique_hits INTEGER default 0,
		PRIMARY KEY  (num)
	)";
	$db_schema_index['counter_host']=array('yy','mm');

	$db_schema['counter_log']		= //	접속로그
	"(
		num INTEGER,
		ip varchar2(20) default '',
		reg_date INTEGER default 0,
		\"host\" varchar2(255) default '',
		referrer varchar2(255) default '',
		keyword varchar2(255) default '',
		hits INTEGER default 0,
		browser varchar2(255) default '',
		os varchar2(255) default '',
		res varchar2(255) default '',
		PRIMARY KEY  (num)
	)";
	$db_schema_index['counter_log']=array('ip','reg_date');

	$db_schema['counter_search']	= //	검색엔진별
	"(
		num INTEGER,
		yy SMALLINT default 0,
		mm SMALLINT default 0,
		\"name\" varchar2(255) default '',
		\"host\" varchar2(255) default '',
		keyword varchar2(255) default '',
		hits INTEGER default 0,
		unique_hits INTEGER default 0,
		PRIMARY KEY  (num)
	)";
	$db_schema_index['counter_search']=array('yy','mm');

	// 시리얼, 트리거
	$db_schema_serial_field['member']			= 'mb_num';
	$db_schema_serial_field['group']				= 'gr_num';
	$db_schema_serial_field['gmember']			= 'gm_num';
	$db_schema_serial_field['bbs_cfg']			= 'bbs_num';
	$db_schema_serial_field['bbs_body']		= 'bd_num';
	$db_schema_serial_field['bbs_comment']	= 'bc_num';
	$db_schema_serial_field['bbs_category']= 'cat_num';
	$db_schema_serial_field['setup']				= 'ss_num';
	$db_schema_serial_field['point']				= 'po_num';
	$db_schema_serial_field['note']				= 'nt_num';
	$db_schema_serial_field['counter_day']	= 'num';
	$db_schema_serial_field['counter_etc']	= 'num';
	$db_schema_serial_field['counter_host']= 'num';
	$db_schema_serial_field['counter_log']	= 'num';
	$db_schema_serial_field['counter_search']= 'num';

	// 카테고리 기본 데이타
	$db_bbs_catrgory_data = array();
	$db_bbs_catrgory_data[] = array('1','질문');
	$db_bbs_catrgory_data[] = array('2','답변');
	$db_bbs_catrgory_data[] = array('3','잡담');
	
/*
	// 기본사이트설정 기본 데이타
	$mysql_site_data[] = "(1, '알지보드 - ver $C_RGBOARD_VERSION', 'main', '/', 0, '/', '/', '', ',1,2,2,1,1,1,1,0,0,0,0,0,0,0,1,1,1', 1, 1, 100, 1, 0, 1, 60, '000000', '', '', '', '', '', '', '', '', '', '')
	";
	
	$mysql_group_data[] = "(1, 'main', 1, '메인그룹', '\{\$site_path\}addon/head.php', '', '\{\$site_path\}addon/foot.php', '', '', 0, 0, 0, 0, 0, 1057302330, 1, '000000', '', '', '', '', '', '', '', '', '', '')
	";*/

} // *-- SCHEMA_INC_INCLUDED END --*
?>