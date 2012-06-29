<?
	// 새글 아이콘 
	$skin_icon_new = "";  
	//기본값 <img src=\"{$skin_url}new.gif\">
	$flag = 0;

	$topic = $list; //내용까지 보여질 갯수(전체)
	$str=190;//내용의 글자수

	//레이어의 가로,세로
	$lay_wid = 300;
	$lay_hei = 50;

	//자동 슬라이드 설정, 수동은 주석처리
	$auto_slide =  array ("yes", "3000"); //자동, 이동속도 = 3초 

	//$skin_date_format = '%Y-%m-%d'; // 리스트표시형식
	$skin_date_format = '%m-%d'; // 리스트표시형식
	$class[link_title] = ' class=lastest';
	$class[link_list] = ' class=lastest';
?>