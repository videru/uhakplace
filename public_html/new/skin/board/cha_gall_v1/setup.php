<?
	//리스트 글 내용 자를 바이트
	$content_cut = '200';
	
	//리스크 이미지 가로, 세로 최고값
	$max_width = '90';
	$max_height = '68';

	// 글목록
	$_skin['i_reply']='<img src='.$skin_url.'images/re.gif>';// 응답글 아이콘
	$_skin['reply_depth']=8; // 응답글 깊이
	
	//$_skin['i_comment_count']='<span style="padding:0px 2px 0px 2px;background:#4ea1bf;color:#FFFFFF;font-family:tahoma;font-size:8px;font-weight:bold;">$bd_comment_count</span>';// 코멘트수
	$_skin['i_comment_count']='<font color=blue style=font-size:8pt>[$bd_comment_count]</font>'; // 코멘트수
	$_skin['i_new']='<img src='.$skin_url.'images/new.gif>'; // new 아이콘
	$_skin['i_secret']='<img src='.$skin_url.'images/secret.gif>'; // 비밀글 아이콘
	$_skin['i_delete1']='<font color=red>- 삭제된글입니다. -</font>'; // 삭제글
	$_skin['i_delete2']='<font color=red>[삭제]$bd_subject</font>'; // 삭제글(관리자)
	$_skin['i_notice']='<img src='.$skin_url.'images/noti.gif>'; // 공지사항
	$_skin['i_currnet']='▶'; // 현재글
	//$_skin['i_currnet']='<img src='.$skin_url.'images/cdoc.gif>'; // 현재글	
?>