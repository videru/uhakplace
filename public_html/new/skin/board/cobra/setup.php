<?
/* =====================================================

파일설명 : 게시판스킨 설정
===================================================== */
	// 글목록
	$_skin['i_reply']='<img src='.$skin_url.'images/re.gif>'; // 응답글 아이콘
	$_skin['reply_depth']=8; // 응답글 깊이
	$_skin['i_comment_count']='<font color=blue style=font-size:7pt>[$bd_comment_count]</font>'; // 코멘트수
	$_skin['i_new']='<img src="../img/ico_new.gif">'; // new 아이콘
	$_skin['i_secret']='<img src="../img/secret_head.gif" align=absmiddle>'; // 비밀글 아이콘
	$_skin['i_delete1']='<font color=red>- 삭제된글입니다. -</font>'; // 삭제글
	$_skin['i_delete2']='<font color=red>[삭제]$bd_subject</font>'; // 삭제글(관리자)
	$_skin['i_notice']='<img src='.$skin_url.'images/list_notice.gif>'; // 공지사항
	$_skin['i_currnet']='->'; // 현재글	
?>