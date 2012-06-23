<? if (!defined('RGBOARD_VERSION')) exit; ?>
<?
/* =====================================================
  프로그램명 : 알지보드 V4
  화일명 : 
  작성일 : 
  작성자 : 윤범석 ( http://rgboard.com )
  작성자 E-Mail : master@rgboard.com

  최종수정일 : 2007-07-13
2007-07-13
mb_open_field 필드 NOT NULL 제거
 ===================================================== */
if (!defined('SCHEMA_INC_INCLUDED')) {  
    define('SCHEMA_INC_INCLUDED', 1);
// *-- SCHEMA_INC_INCLUDED START --*
	$db_schema['member']				= // 회원
	"(
		mb_num INTEGER NOT NULL,
		mb_id varchar(255) default '' NOT NULL,
		mb_pass varchar(255) default '' NOT NULL,
		mb_name varchar(255) default '' NOT NULL,
		mb_nick varchar(255) default '' NOT NULL,
		mb_level SMALLINT default 0 NOT NULL,
		mb_state SMALLINT default 0 NOT NULL,
		mb_jumin varchar(255) default '' NOT NULL,
		mb_sex char(2) default '' NOT NULL,
		mb_post varchar(255) default '' NOT NULL,
		mb_address1 varchar(255) default '' NOT NULL,
		mb_address2 varchar(255) default '' NOT NULL,
		mb_email varchar(255) default '' NOT NULL,
		mb_tel1 varchar(255) default '' NOT NULL,
		mb_tel2 varchar(255) default '' NOT NULL,
		mb_files varchar,
		mb_is_mailing SMALLINT default 0 NOT NULL,
		mb_is_opening SMALLINT default 0 NOT NULL,
		mb_open_field varchar,
		mb_signature varchar,
		mb_introduce varchar,
		mb_admin_memo varchar,
		mb_ext1 varchar,
		mb_ext2 varchar,
		mb_ext3 varchar,
		mb_ext4 varchar,
		mb_ext5 varchar,
		mb_point INTEGER default 0 NOT NULL,
		login_count INTEGER default 0 NOT NULL,
		login_date INTEGER default 0 NOT NULL,
		login_ip varchar(20) default '' NOT NULL,
		join_date INTEGER default 0 NOT NULL,
		join_ip varchar(20) default '' NOT NULL,
		modify_date INTEGER default 0 NOT NULL,
		modify_ip varchar(20) default '' NOT NULL,
		PRIMARY KEY  (mb_num)
	)";
	$db_schema_index['member']=array('mb_id','mb_name','mb_nick','mb_jumin','mb_state');
	
	$db_schema['group']				= //	그룹
	"(
		gr_num INTEGER NOT NULL,
		gr_id varchar(255) default '' NOT NULL,
		gr_name varchar(255) default '' NOT NULL,
		gr_desc varchar,
		gr_header_file varchar(255) default '' NOT NULL,
		gr_header_tag varchar,
		gr_footer_tag varchar,
		gr_footer_file varchar(255) default '' NOT NULL,
		gr_state SMALLINT default 0 NOT NULL,
		gr_default_state SMALLINT default 0 NOT NULL,
		gr_default_level SMALLINT default 0 NOT NULL,
		gr_level_type SMALLINT default 0 NOT NULL,
		gr_level_info varchar NOT NULL,
		gr_ext_cfg varchar,
		gr_admin_memo varchar NOT NULL,
		gr_reg_date INTEGER default 0 NOT NULL,
		gr_reg_mb INTEGER default 0 NOT NULL,
		PRIMARY KEY  (gr_num)
	)";
	$db_schema_index['group']=array('gr_id','gr_name','gr_state');

	$db_schema['gmember']			= //	그룹회원
	"(
		gm_num INTEGER NOT NULL,
		gr_num INTEGER default 0 NOT NULL,
		mb_num INTEGER default 0 NOT NULL,
		gm_reg_date INTEGER default 0 NOT NULL,
		gm_reg_ip varchar(20) default '' NOT NULL,
		gm_state SMALLINT default 0 NOT NULL,
		gm_level SMALLINT default 0 NOT NULL,
		gm_ext1 varchar,
		gm_ext2 varchar,
		gm_ext3 varchar,
		gm_ext4 varchar,
		gm_ext5 varchar,
		PRIMARY KEY  (gm_num)
	)";
	$db_schema_index['gmember']=array('gr_num','mb_num','gm_state');

	$db_schema['bbs_cfg']			= //	게시판설정
	"(
		bbs_num INTEGER NOT NULL,
		bbs_code varchar(255) default '' NOT NULL,
		bbs_db varchar(255) default '' NOT NULL,
		bbs_db_num INTEGER default 0 NOT NULL,
		gr_num INTEGER default 0 NOT NULL,
		bbs_name varchar(255) default '' NOT NULL,
		bbs_skin varchar(255) default '' NOT NULL,
		use_category SMALLINT default 0 NOT NULL,
		default_content varchar,
		auth_list SMALLINT default 0 NOT NULL,
		auth_view SMALLINT default 0 NOT NULL,
		auth_write SMALLINT default 0 NOT NULL,
		auth_reply SMALLINT default 0 NOT NULL,
		auth_modify SMALLINT default 0 NOT NULL,
		auth_delete SMALLINT default 0 NOT NULL,
		auth_comment SMALLINT default 0 NOT NULL,
		auth_secret SMALLINT default 0 NOT NULL,
		list_cfg varchar,
		write_cfg varchar,
		reply_cfg varchar,
		view_cfg varchar,
		mailing_mb_id varchar,
		admin_mb_id varchar,
		point_write INTEGER default 0 NOT NULL,
		point_reply INTEGER default 0 NOT NULL,
		point_comment INTEGER default 0 NOT NULL,
		header_file varchar(255) default '' NOT NULL,
		header_tag varchar,
		footer_tag varchar,
		footer_file varchar(255) default '' NOT NULL,
		reg_date INTEGER default 0 NOT NULL,
		bbs_ext1 varchar,
		bbs_ext2 varchar,
		bbs_ext3 varchar,
		bbs_ext4 varchar,
		bbs_ext5 varchar,
		admin_memo varchar NOT NULL,
		deny_word varchar NOT NULL,
		deny_html varchar NOT NULL,
		deny_ip varchar NOT NULL,
		PRIMARY KEY  (bbs_num)
	)";
	$db_schema_index['bbs_cfg']=array('bbs_code','bbs_db','bbs_db_num','gr_num');

	$db_schema['bbs_body']			= //	게시판 본문
	"(
		bd_num INTEGER NOT NULL,
		gr_num INTEGER default 0 NOT NULL,
		bbs_db_num INTEGER default 0 NOT NULL,
		mb_num INTEGER default 0 NOT NULL,
		mb_id varchar(255) default '' NOT NULL,
		is_admin SMALLINT default 0 NOT NULL,
		cat_num INTEGER default 0 NOT NULL,
		bd_top_num INTEGER default 0 NOT NULL,
		bd_parent_num INTEGER default 0 NOT NULL,
		bd_sequence INTEGER default 0 NOT NULL,
		bd_depth INTEGER default 0 NOT NULL,
		bd_next_num INTEGER default 0 NOT NULL,
		bd_comment_count INTEGER default 0 NOT NULL,
		bd_name varchar(255) default '' NOT NULL,
		bd_pass varchar(255) default '' NOT NULL,
		bd_email varchar(255) default '' NOT NULL,
		bd_home varchar(255) default '' NOT NULL,
		bd_subject varchar(255) default '' NOT NULL,
		bd_content varchar,
		bd_files varchar,
		bd_links varchar,
		bd_html SMALLINT default 0 NOT NULL,
		bd_secret SMALLINT default 0 NOT NULL,
		bd_notice SMALLINT default 0 NOT NULL,
		bd_reply_mail SMALLINT default 0 NOT NULL,
		bd_delete SMALLINT default 0 NOT NULL,
		bd_write_date INTEGER default 0 NOT NULL,
		bd_write_ip varchar(20) default '' NOT NULL,
		bd_modify_date INTEGER default 0 NOT NULL,
		bd_modify_ip varchar(20) default '' NOT NULL,
		bd_view_count INTEGER default 0 NOT NULL,
		bd_vote_yes INTEGER default 0 NOT NULL,
		bd_vote_no INTEGER default 0 NOT NULL,
		bd_ext1 varchar,
		bd_ext2 varchar,
		bd_ext3 varchar,
		bd_ext4 varchar,
		bd_ext5 varchar,
		PRIMARY KEY  (bd_num)
	)";
	$db_schema_index['bbs_body']=array('bd_top_num','bd_next_num','bd_name','bd_subject',
																		'bd_notice','gr_num','bbs_db_num','cat_num');

	$db_schema['bbs_comment']	= //	게시판 코멘트
	"(
		bc_num INTEGER NOT NULL,
		gr_num INTEGER default 0 NOT NULL,
		bbs_db_num INTEGER default 0 NOT NULL,
		bd_num INTEGER default 0 NOT NULL,
		mb_num INTEGER default 0 NOT NULL,
		mb_id varchar(255) default '' NOT NULL,
		bc_name varchar(255) default '' NOT NULL,
		bc_pass varchar(255) default '' NOT NULL,
		bc_email varchar(255) default '' NOT NULL,
		bc_home varchar(255) default '' NOT NULL,
		bc_content varchar,
		bc_write_date INTEGER default 0 NOT NULL,
		bc_write_ip varchar(20) default '' NOT NULL,
		PRIMARY KEY  (bc_num)
	)";
	$db_schema_index['bbs_comment']=array('gr_num','bbs_db_num','bd_num','mb_num','mb_id','bc_name');

	$db_schema['bbs_category']	= //	게시판 카테고리
	"(
		cat_num INTEGER NOT NULL,
		bbs_db_num INTEGER default 0 NOT NULL,
		cat_order INTEGER default 0 NOT NULL,
		cat_name varchar(255) default '' NOT NULL,
		cat_count INTEGER default 0 NOT NULL,
		PRIMARY KEY  (cat_num)
	)";
	$db_schema_index['bbs_category']=array('cat_order','bbs_db_num');

	$db_schema['setup']				= //	사이트설정
	"(
		ss_num INTEGER NOT NULL,
		ss_name varchar(255) default '' NOT NULL,
		ss_content varchar,
		PRIMARY KEY  (ss_num)
	)";
	$db_schema_index['setup']=array('ss_name');

	$db_schema['point']				= //	포인트내역
	"(
		po_num INTEGER NOT NULL,
		mb_num INTEGER default 0 NOT NULL,
		po_type SMALLINT default 0 NOT NULL,
		po_part1 varchar(255) default '' NOT NULL,
		po_part2 varchar(255) default '' NOT NULL,
		po_point INTEGER default 0 NOT NULL,
		po_current_point INTEGER default 0 NOT NULL,
		po_date INTEGER default 0 NOT NULL,
		po_data varchar,
		PRIMARY KEY  (po_num)
	)";
	$db_schema_index['point']=array('mb_num');

	$db_schema['note']					= //	쪽지
	"(
		nt_num INTEGER NOT NULL,
		mb_num INTEGER default 0 NOT NULL,
		nt_type SMALLINT default 0 NOT NULL,
		nt_save SMALLINT default 0 NOT NULL,
		recv_mb_num INTEGER default 0 NOT NULL,
		sent_mb_num INTEGER default 0 NOT NULL,
		nt_sent_date INTEGER default 0 NOT NULL,
		nt_recv_date INTEGER default 0 NOT NULL,
		nt_sent_num INTEGER default 0 NOT NULL,
		nt_link varchar(255) default '' NOT NULL,
		nt_content varchar,
		PRIMARY KEY  (nt_num)
	)";
	$db_schema_index['note']=array('mb_num','nt_type','nt_save','recv_mb_num','sent_mb_num','nt_sent_num');

	$db_schema['zip']					= //	우편번호
	"(
		seq INTEGER default 0 NOT NULL,
		zipcode varchar(9) default '' NOT NULL,
		sido varchar(5) default '' NOT NULL,
		gugun varchar(16) default '' NOT NULL,
		dong varchar(53) default '' NOT NULL,
		bunji varchar(18) default '' NOT NULL,
		PRIMARY KEY (seq)
	)";
	$db_schema_index['zip']=array('dong');

	$db_schema['counter_day']		= //	일별통계
	"(
		num INTEGER NOT NULL,
		reg_date INTEGER default 0 NOT NULL,
		yy SMALLINT default 0 NOT NULL,
		mm SMALLINT default 0 NOT NULL,
		dd SMALLINT default 0 NOT NULL,
		ww SMALLINT default 0 NOT NULL,
		hh0 INTEGER default 0 NOT NULL,
		hh1 INTEGER default 0 NOT NULL,
		hh2 INTEGER default 0 NOT NULL,
		hh3 INTEGER default 0 NOT NULL,
		hh4 INTEGER default 0 NOT NULL,
		hh5 INTEGER default 0 NOT NULL,
		hh6 INTEGER default 0 NOT NULL,
		hh7 INTEGER default 0 NOT NULL,
		hh8 INTEGER default 0 NOT NULL,
		hh9 INTEGER default 0 NOT NULL,
		hh10 INTEGER default 0 NOT NULL,
		hh11 INTEGER default 0 NOT NULL,
		hh12 INTEGER default 0 NOT NULL,
		hh13 INTEGER default 0 NOT NULL,
		hh14 INTEGER default 0 NOT NULL,
		hh15 INTEGER default 0 NOT NULL,
		hh16 INTEGER default 0 NOT NULL,
		hh17 INTEGER default 0 NOT NULL,
		hh18 INTEGER default 0 NOT NULL,
		hh19 INTEGER default 0 NOT NULL,
		hh20 INTEGER default 0 NOT NULL,
		hh21 INTEGER default 0 NOT NULL,
		hh22 INTEGER default 0 NOT NULL,
		hh23 INTEGER default 0 NOT NULL,
		uhh0 INTEGER default 0 NOT NULL,
		uhh1 INTEGER default 0 NOT NULL,
		uhh2 INTEGER default 0 NOT NULL,
		uhh3 INTEGER default 0 NOT NULL,
		uhh4 INTEGER default 0 NOT NULL,
		uhh5 INTEGER default 0 NOT NULL,
		uhh6 INTEGER default 0 NOT NULL,
		uhh7 INTEGER default 0 NOT NULL,
		uhh8 INTEGER default 0 NOT NULL,
		uhh9 INTEGER default 0 NOT NULL,
		uhh10 INTEGER default 0 NOT NULL,
		uhh11 INTEGER default 0 NOT NULL,
		uhh12 INTEGER default 0 NOT NULL,
		uhh13 INTEGER default 0 NOT NULL,
		uhh14 INTEGER default 0 NOT NULL,
		uhh15 INTEGER default 0 NOT NULL,
		uhh16 INTEGER default 0 NOT NULL,
		uhh17 INTEGER default 0 NOT NULL,
		uhh18 INTEGER default 0 NOT NULL,
		uhh19 INTEGER default 0 NOT NULL,
		uhh20 INTEGER default 0 NOT NULL,
		uhh21 INTEGER default 0 NOT NULL,
		uhh22 INTEGER default 0 NOT NULL,
		uhh23 INTEGER default 0 NOT NULL,
		hits INTEGER default 0 NOT NULL,
		unique_hits INTEGER default 0 NOT NULL,
		PRIMARY KEY  (num),
		CONSTRAINT reg_date_idx UNIQUE (reg_date)
	)";
	$db_schema_index['counter_day']=array('ww','yy','mm','dd');

	$db_schema['counter_etc']		= //	기타통계
	"(
		num INTEGER NOT NULL,
		\"type\" char(3) default '' NOT NULL,
		yy SMALLINT default 0 NOT NULL,
		mm SMALLINT default 0 NOT NULL,
		\"name\" varchar(255) default '' NOT NULL,
		hits INTEGER default 0 NOT NULL,
		unique_hits INTEGER default 0 NOT NULL,
		PRIMARY KEY  (num)
	)";
	$db_schema_index['counter_etc']=array('yy','mm');

	$db_schema['counter_host']		= //	호스트별통계
	"(
		num INTEGER NOT NULL,
		yy SMALLINT default 0 NOT NULL,
		mm SMALLINT default 0 NOT NULL,
		\"host\" varchar(255) default '' NOT NULL,
		hits INTEGER default 0 NOT NULL,
		unique_hits INTEGER default 0 NOT NULL,
		PRIMARY KEY  (num)
	)";
	$db_schema_index['counter_host']=array('yy','mm');

	$db_schema['counter_log']		= //	접속로그
	"(
		num INTEGER NOT NULL,
		ip varchar(20) default '' NOT NULL,
		reg_date INTEGER default 0 NOT NULL,
		\"host\" varchar(255) default '' NOT NULL,
		referrer varchar(255) default '' NOT NULL,
		keyword varchar(255) default '' NOT NULL,
		hits INTEGER default 0 NOT NULL,
		browser varchar(255) default '' NOT NULL,
		os varchar(255) default '' NOT NULL,
		res varchar(255) default '' NOT NULL,
		PRIMARY KEY  (num)
	)";
	$db_schema_index['counter_log']=array('ip','reg_date');

	$db_schema['counter_search']	= //	검색엔진별
	"(
		num INTEGER NOT NULL,
		yy SMALLINT default 0 NOT NULL,
		mm SMALLINT default 0 NOT NULL,
		\"name\" varchar(255) default '' NOT NULL,
		\"host\" varchar(255) default '' NOT NULL,
		keyword varchar(255) default '' NOT NULL,
		hits INTEGER default 0 NOT NULL,
		unique_hits INTEGER default 0 NOT NULL,
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