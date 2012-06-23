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
		`mb_num` int(11) NOT NULL auto_increment,
		`mb_id` varchar(255) NOT NULL default '',
		`mb_pass` varchar(255) NOT NULL default '',
		`mb_name` varchar(255) NOT NULL default '',
		`mb_nick` varchar(255) NOT NULL default '',
		`mb_level` int(3) NOT NULL default '0',
		`mb_state` int(1) NOT NULL default '0',
		`mb_jumin` varchar(255) NOT NULL default '',
		`mb_sex` char(2) NOT NULL default '',
		`mb_post` varchar(255) NOT NULL default '',
		`mb_address1` varchar(255) NOT NULL default '',
		`mb_address2` varchar(255) NOT NULL default '',
		`mb_email` varchar(255) NOT NULL default '',
		`mb_tel1` varchar(255) NOT NULL default '',
		`mb_tel2` varchar(255) NOT NULL default '',
		`mb_files` text,
		`mb_is_mailing` int(1) NOT NULL default '0',
		`mb_is_opening` int(1) NOT NULL default '0',
		`mb_open_field` text,
		`mb_signature` text,
		`mb_introduce` text,
		`mb_admin_memo` text,
		`mb_ext1` text,
		`mb_ext2` text,
		`mb_ext3` text,
		`mb_ext4` text,
		`mb_ext5` text,
		`mb_point` int(11) NOT NULL default '0',
		`login_count` int(11) NOT NULL default '0',
		`login_date` int(11) NOT NULL default '0',
		`login_ip` varchar(20) NOT NULL default '',
		`join_date` int(11) NOT NULL default '0',
		`join_ip` varchar(20) NOT NULL default '',
		`modify_date` int(11) NOT NULL default '0',
		`modify_ip` varchar(20) NOT NULL default '',
		PRIMARY KEY  (`mb_num`),
		KEY `mb_id` (`mb_id`),
		KEY `mb_name` (`mb_name`),
		KEY `mb_nick` (`mb_nick`),
		KEY `mb_jumin` (`mb_jumin`),
		KEY `mb_state` (`mb_state`)
	)";
	$db_schema['group']				= //	그룹
	"(
		`gr_num` int(11) NOT NULL auto_increment,
		`gr_id` varchar(255) NOT NULL default '',
		`gr_name` varchar(255) NOT NULL default '',
		`gr_desc` text,
		`gr_header_file` varchar(255) NOT NULL default '',
		`gr_header_tag` text,
		`gr_footer_tag` text,
		`gr_footer_file` varchar(255) NOT NULL default '',
		`gr_state` int(1) NOT NULL default '0',
		`gr_default_state` int(1) NOT NULL default '0',
		`gr_default_level` int(3) NOT NULL default '0',
		`gr_level_type` int(1) NOT NULL default '0',
		`gr_level_info` text NOT NULL,
		`gr_ext_cfg` text,
		`gr_admin_memo` text NOT NULL,
		`gr_reg_date` int(11) NOT NULL default '0',
		`gr_reg_mb` int(11) NOT NULL default '0',
		PRIMARY KEY  (`gr_num`),
		KEY `gr_id` (`gr_id`),
		KEY `gr_name` (`gr_name`),
		KEY `gr_state` (`gr_state`)
	)";
	$db_schema['gmember']			= //	그룹회원
	"(
		`gm_num` int(11) NOT NULL auto_increment,
		`gr_num` int(11) NOT NULL default '0',
		`mb_num` int(11) NOT NULL default '0',
		`gm_reg_date` int(11) NOT NULL default '0',
		`gm_reg_ip` varchar(20) NOT NULL default '',
		`gm_state` int(1) NOT NULL default '0',
		`gm_level` int(2) NOT NULL default '0',
		`gm_ext1` text,
		`gm_ext2` text,
		`gm_ext3` text,
		`gm_ext4` text,
		`gm_ext5` text,
		PRIMARY KEY  (`gm_num`),
		KEY `gr_num` (`gr_num`),
		KEY `mb_num` (`mb_num`),
		KEY `gm_state` (`gm_state`)
	)";
	$db_schema['bbs_cfg']			= //	게시판설정
	"(
		`bbs_num` int(11) NOT NULL auto_increment,
		`bbs_code` varchar(255) NOT NULL default '',
		`bbs_db` varchar(255) NOT NULL default '',
		`bbs_db_num` int(11) NOT NULL default '0',
		`gr_num` int(11) NOT NULL default '0',
		`bbs_name` varchar(255) NOT NULL default '',
		`bbs_skin` varchar(255) NOT NULL default '',
		`use_category` int(1) NOT NULL default '0',
		`default_content` text,
		`auth_list` int(3) NOT NULL default '0',
		`auth_view` int(3) NOT NULL default '0',
		`auth_write` int(3) NOT NULL default '0',
		`auth_reply` int(3) NOT NULL default '0',
		`auth_modify` int(3) NOT NULL default '0',
		`auth_delete` int(3) NOT NULL default '0',
		`auth_comment` int(3) NOT NULL default '0',
		`auth_secret` int(3) NOT NULL default '0',
		`list_cfg` text,
		`write_cfg` text,
		`reply_cfg` text,
		`view_cfg` text,
		`mailing_mb_id` text,
		`admin_mb_id` text,
		`point_write` int(11) NOT NULL default '0',
		`point_reply` int(11) NOT NULL default '0',
		`point_comment` int(11) NOT NULL default '0',
		`header_file` varchar(255) NOT NULL default '',
		`header_tag` text,
		`footer_tag` text,
		`footer_file` varchar(255) NOT NULL default '',
		`reg_date` int(11) NOT NULL default '0',
		`bbs_ext1` text,
		`bbs_ext2` text,
		`bbs_ext3` text,
		`bbs_ext4` text,
		`bbs_ext5` text,
		`admin_memo` text NOT NULL,
		`deny_word` text NOT NULL,
		`deny_html` text NOT NULL,
		`deny_ip` text NOT NULL,
		PRIMARY KEY  (`bbs_num`),
		KEY `bbs_code` (`bbs_code`),
		KEY `bbs_db` (`bbs_db`),
		KEY `bbs_db_num` (`bbs_db_num`),
		KEY `gr_num` (`gr_num`)
	)";
	$db_schema['bbs_body']			= //	게시판 본문
	"(
		`bd_num` int(11) NOT NULL auto_increment,
		`gr_num` int(11) NOT NULL default '0',
		`bbs_db_num` int(11) NOT NULL default '0',
		`mb_num` int(11) NOT NULL default '0',
		`mb_id` varchar(255) NOT NULL default '',
		`is_admin` tinyint(1) NOT NULL default '0',
		`cat_num` int(11) NOT NULL default '0',
		`bd_top_num` int(11) NOT NULL default '0',
		`bd_parent_num` int(11) NOT NULL default '0',
		`bd_sequence` int(11) NOT NULL default '0',
		`bd_depth` int(11) NOT NULL default '0',
		`bd_next_num` int(11) NOT NULL default '0',
		`bd_comment_count` int(11) NOT NULL default '0',
		`bd_name` varchar(255) NOT NULL default '',
		`bd_pass` varchar(255) NOT NULL default '',
		`bd_email` varchar(255) NOT NULL default '',
		`bd_home` varchar(255) NOT NULL default '',
		`bd_subject` varchar(255) NOT NULL default '',
		`bd_content` text,
		`bd_files` text,
		`bd_links` text,
		`bd_html` int(1) NOT NULL default '0',
		`bd_secret` int(1) NOT NULL default '0',
		`bd_notice` int(1) NOT NULL default '0',
		`bd_reply_mail` int(1) NOT NULL default '0',
		`bd_delete` int(1) NOT NULL default '0',
		`bd_write_date` int(11) NOT NULL default '0',
		`bd_write_ip` varchar(20) NOT NULL default '',
		`bd_modify_date` int(11) NOT NULL default '0',
		`bd_modify_ip` varchar(20) NOT NULL default '',
		`bd_view_count` int(11) NOT NULL default '0',
		`bd_vote_yes` int(11) NOT NULL default '0',
		`bd_vote_no` int(11) NOT NULL default '0',
		`bd_ext1` text,
		`bd_ext2` text,
		`bd_ext3` text,
		`bd_ext4` text,
		`bd_ext5` text,
		PRIMARY KEY  (`bd_num`),
		KEY `bd_top_num` (`bd_top_num`),
		KEY `bd_next_num` (`bd_next_num`),
		KEY `bd_name` (`bd_name`),
		KEY `bd_subject` (`bd_subject`),
		KEY `bd_notice` (`bd_notice`),
		KEY `gr_num` (`gr_num`),
		KEY `bbs_db_num` (`bbs_db_num`),
		KEY `cat_num` (`cat_num`)
	)";
	$db_schema['bbs_comment']	= //	게시판 코멘트
	"(
		`bc_num` int(11) NOT NULL auto_increment,
		`gr_num` int(11) NOT NULL default '0',
		`bbs_db_num` int(11) NOT NULL default '0',
		`bd_num` int(11) NOT NULL default '0',
		`mb_num` int(11) NOT NULL default '0',
		`mb_id` varchar(255) NOT NULL default '',
		`bc_name` varchar(255) NOT NULL default '',
		`bc_pass` varchar(255) NOT NULL default '',
		`bc_email` varchar(255) NOT NULL default '',
		`bc_home` varchar(255) NOT NULL default '',
		`bc_content` text,
		`bc_write_date` int(11) NOT NULL default '0',
		`bc_write_ip` varchar(20) NOT NULL default '',
		PRIMARY KEY  (`bc_num`),
		KEY `gr_num` (`gr_num`),
		KEY `bbs_db_num` (`bbs_db_num`),
		KEY `bd_num` (`bd_num`),
		KEY `mb_num` (`mb_num`),
		KEY `mb_id` (`mb_id`),
		KEY `bc_name` (`bc_name`)
	)";
	$db_schema['bbs_category']	= //	게시판 카테고리
	"(
		`cat_num` int(11) NOT NULL auto_increment,
		`bbs_db_num` int(11) NOT NULL default '0',
		`cat_order` int(11) NOT NULL default '0',
		`cat_name` varchar(255) NOT NULL default '',
		`cat_count` int(11) NOT NULL default '0',
		PRIMARY KEY  (`cat_num`),
		KEY `cat_order` (`cat_order`),
		KEY `bbs_db_num` (`bbs_db_num`)
	)";
	$db_schema['setup']				= //	사이트설정
	"(
		`ss_num` int(11) NOT NULL auto_increment,
		`ss_name` varchar(255) NOT NULL default '',
		`ss_content` text,
		PRIMARY KEY  (`ss_num`),
		KEY `ss_name` (`ss_name`)
	)";
	$db_schema['point']				= //	포인트내역
	"(
		`po_num` int(11) NOT NULL auto_increment,
		`mb_num` int(11) NOT NULL default '0',
		`po_type` int(2) NOT NULL default '0',
		`po_part1` varchar(255) NOT NULL default '',
		`po_part2` varchar(255) NOT NULL default '',
		`po_point` int(11) NOT NULL default '0',
		`po_current_point` int(11) NOT NULL default '0',
		`po_date` int(11) NOT NULL default '0',
		`po_data` text,
		PRIMARY KEY  (`po_num`),
		KEY `mb_num` (`mb_num`)
	)";
	$db_schema['note']					= //	쪽지
	"(
		`nt_num` int(11) NOT NULL auto_increment,
		`mb_num` int(11) NOT NULL default '0',
		`nt_type` int(1) NOT NULL default '0',
		`nt_save` int(1) NOT NULL default '0',
		`recv_mb_num` int(11) NOT NULL default '0',
		`sent_mb_num` int(11) NOT NULL default '0',
		`nt_sent_date` int(11) NOT NULL default '0',
		`nt_recv_date` int(11) NOT NULL default '0',
		`nt_sent_num` int(11) NOT NULL default '0',
		`nt_link` varchar(255) NOT NULL default '',
		`nt_content` text,
		PRIMARY KEY  (`nt_num`),
		KEY `mb_num` (`mb_num`),
		KEY `nt_type` (`nt_type`),
		KEY `nt_save` (`nt_save`),
		KEY `recv_mb_num` (`recv_mb_num`),
		KEY `sent_mb_num` (`sent_mb_num`),
		KEY `nt_sent_num` (`nt_sent_num`)
	)";

	$db_schema['zip']					= //	우편번호
	"(
		`seq` int(6) NOT NULL default '0',
		`zipcode` varchar(9) NOT NULL default '',
		`sido` varchar(5) NOT NULL default '',
		`gugun` varchar(16) NOT NULL default '',
		`dong` varchar(53) NOT NULL default '',
		`bunji` varchar(18) NOT NULL default '',
		PRIMARY KEY  (`seq`),
		KEY `dong` (`dong`)
	)";

	$db_schema['counter_day']		= //	일별통계
	"(
		`num` int(11) NOT NULL auto_increment,
		`reg_date` int(11) NOT NULL default '0',
		`yy` int(4) NOT NULL default '0',
		`mm` tinyint(2) NOT NULL default '0',
		`dd` tinyint(2) NOT NULL default '0',
		`ww` tinyint(1) NOT NULL default '0',
		`hh0` int(11) NOT NULL default '0',
		`hh1` int(11) NOT NULL default '0',
		`hh2` int(11) NOT NULL default '0',
		`hh3` int(11) NOT NULL default '0',
		`hh4` int(11) NOT NULL default '0',
		`hh5` int(11) NOT NULL default '0',
		`hh6` int(11) NOT NULL default '0',
		`hh7` int(11) NOT NULL default '0',
		`hh8` int(11) NOT NULL default '0',
		`hh9` int(11) NOT NULL default '0',
		`hh10` int(11) NOT NULL default '0',
		`hh11` int(11) NOT NULL default '0',
		`hh12` int(11) NOT NULL default '0',
		`hh13` int(11) NOT NULL default '0',
		`hh14` int(11) NOT NULL default '0',
		`hh15` int(11) NOT NULL default '0',
		`hh16` int(11) NOT NULL default '0',
		`hh17` int(11) NOT NULL default '0',
		`hh18` int(11) NOT NULL default '0',
		`hh19` int(11) NOT NULL default '0',
		`hh20` int(11) NOT NULL default '0',
		`hh21` int(11) NOT NULL default '0',
		`hh22` int(11) NOT NULL default '0',
		`hh23` int(11) NOT NULL default '0',
		`uhh0` int(11) NOT NULL default '0',
		`uhh1` int(11) NOT NULL default '0',
		`uhh2` int(11) NOT NULL default '0',
		`uhh3` int(11) NOT NULL default '0',
		`uhh4` int(11) NOT NULL default '0',
		`uhh5` int(11) NOT NULL default '0',
		`uhh6` int(11) NOT NULL default '0',
		`uhh7` int(11) NOT NULL default '0',
		`uhh8` int(11) NOT NULL default '0',
		`uhh9` int(11) NOT NULL default '0',
		`uhh10` int(11) NOT NULL default '0',
		`uhh11` int(11) NOT NULL default '0',
		`uhh12` int(11) NOT NULL default '0',
		`uhh13` int(11) NOT NULL default '0',
		`uhh14` int(11) NOT NULL default '0',
		`uhh15` int(11) NOT NULL default '0',
		`uhh16` int(11) NOT NULL default '0',
		`uhh17` int(11) NOT NULL default '0',
		`uhh18` int(11) NOT NULL default '0',
		`uhh19` int(11) NOT NULL default '0',
		`uhh20` int(11) NOT NULL default '0',
		`uhh21` int(11) NOT NULL default '0',
		`uhh22` int(11) NOT NULL default '0',
		`uhh23` int(11) NOT NULL default '0',
		`hits` int(11) NOT NULL default '0',
		`unique_hits` int(11) NOT NULL default '0',
		PRIMARY KEY  (`num`),
		UNIQUE KEY `reg_date` (`reg_date`),
		KEY `ww` (`ww`),
		KEY `yy` (`yy`),
		KEY `mm` (`mm`),
		KEY `dd` (`dd`)
	)";
	
	$db_schema['counter_etc']		= //	기타통계
	"(
		`num` int(11) NOT NULL auto_increment,
		`type` char(3) NOT NULL default '',
		`yy` int(4) NOT NULL default '0',
		`mm` tinyint(2) NOT NULL default '0',
		`name` varchar(255) NOT NULL default '',
		`hits` int(11) NOT NULL default '0',
		`unique_hits` int(11) NOT NULL default '0',
		PRIMARY KEY  (`num`),
		KEY `yy` (`yy`),
		KEY `mm` (`mm`)
	)";
	
	$db_schema['counter_host']		= //	호스트별통계
	"(
		`num` int(11) NOT NULL auto_increment,
		`yy` int(4) NOT NULL default '0',
		`mm` tinyint(2) NOT NULL default '0',
		`host` varchar(255) NOT NULL default '',
		`hits` int(11) NOT NULL default '0',
		`unique_hits` int(11) NOT NULL default '0',
		PRIMARY KEY  (`num`),
		KEY `yy` (`yy`),
		KEY `mm` (`mm`)
	)";
	
	$db_schema['counter_log']		= //	접속로그
	"(
		`num` int(11) NOT NULL auto_increment,
		`ip` varchar(20) NOT NULL default '',
		`reg_date` int(11) NOT NULL default '0',
		`host` varchar(255) NOT NULL default '',
		`referrer` varchar(255) NOT NULL default '',
		`keyword` varchar(255) NOT NULL default '',
		`hits` int(11) NOT NULL default '0',
		`browser` varchar(255) NOT NULL default '',
		`os` varchar(255) NOT NULL default '',
		`res` varchar(255) NOT NULL default '',
		PRIMARY KEY  (`num`),
		KEY `ip` (`ip`),
		KEY `reg_date` (`reg_date`)
	)";
	
	$db_schema['counter_search']	= //	검색엔진별
	"(
		`num` int(11) NOT NULL auto_increment,
		`yy` int(4) NOT NULL default '0',
		`mm` tinyint(2) NOT NULL default '0',
		`name` varchar(255) NOT NULL default '',
		`host` varchar(255) NOT NULL default '',
		`keyword` varchar(255) NOT NULL default '',
		`hits` int(11) NOT NULL default '0',
		`unique_hits` int(11) NOT NULL default '0',
		PRIMARY KEY  (`num`),
		KEY `yy` (`yy`),
		KEY `mm` (`mm`)
	)";
	
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