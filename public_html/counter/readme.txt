알지보드용 접속통계프로그램

설치방법
==================================================
카운터가 동작하기 원하는 파일에 rg_counter.php 를 인클루드 한다.
Ex) 
<?
	include($site_path."counter/counter.php");
?>

또는 rg4_counter/rg_counter.php 를 참고해 스크립트만 끼워 넣어도 됩니다.
==================================================

설정변경
==================================================
rg4_counter/counter.lib.php 파일을 열어 설정을 수정 한다.

	// 카운터 사용 여부
	$rg_counter_use=true;

	// 로그 여부 (로그를 안남긴다면 로그는 1일까지만 저장하고 그전 데이타는 삭제)
	$rg_counter_log_on=false;
	
	// 일반 방문자도 통계 조회 여부 true / false
	$rg_counter_access_guest=false;
==================================================


==================================================
CREATE TABLE `rg4_counter_day` (
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
  UNIQUE KEY `reg_date` (`reg_date`)
) TYPE=MyISAM;

CREATE TABLE `rg4_counter_etc` (
  `num` int(11) NOT NULL auto_increment,
  `type` char(3) NOT NULL default '',
  `name` varchar(255) NOT NULL default '',
  `hits` int(11) NOT NULL default '0',
  `unique_hits` int(11) NOT NULL default '0',
  PRIMARY KEY  (`num`)
) TYPE=MyISAM;

CREATE TABLE `rg4_counter_host` (
  `num` int(11) NOT NULL auto_increment,
  `host` varchar(255) NOT NULL default '',
  `hits` int(11) NOT NULL default '0',
  `unique_hits` int(11) NOT NULL default '0',
  PRIMARY KEY  (`num`)
) TYPE=MyISAM;

CREATE TABLE `rg4_counter_log` (
  `num` int(11) NOT NULL auto_increment,
  `ip` varchar(20) NOT NULL default '',
  `reg_date` int(11) NOT NULL default '0',
  `host` varchar(255) NOT NULL default '',
  `referrer` varchar(255) NOT NULL default '',
  `keyword` varchar(255) NOT NULL default '',
  `hits` int(11) NOT NULL default '0',
  `browser` int(11) NOT NULL default '0',
  `os` int(11) NOT NULL default '0',
  `res` int(11) NOT NULL default '0',
  PRIMARY KEY  (`num`),
  KEY `ip` (`ip`),
  KEY `reg_date` (`reg_date`)
) TYPE=MyISAM;

CREATE TABLE `rg4_counter_search` (
  `num` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `host` varchar(255) NOT NULL default '',
  `keyword` varchar(255) NOT NULL default '',
  `hits` int(11) NOT NULL default '0',
  `unique_hits` int(11) NOT NULL default '0',
  PRIMARY KEY  (`num`)
) TYPE=MyISAM;

==================================================