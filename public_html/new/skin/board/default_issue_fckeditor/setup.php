<? if (!defined('RGBOARD_VERSION')) exit; ?>
<?
	// 글목록
	$_skin['i_reply']="<font color=blue style=font-size:8pt>└</font>"; // 응답글 아이콘
	$_skin['reply_depth']=8; // 응답글 깊이
	$_skin['i_comment_count']='<font color=blue style=font-size:8pt>[$bd_comment_count]</font>'; // 코멘트수
	$_skin['i_new']=' <font color=red style=font-size:8pt>new</font>'; // new 아이콘
	$_skin['i_secret']='<font color=blue>[비밀]</font>'; // 비밀글 아이콘
	$_skin['i_delete1']='<font color=red>- 삭제된글입니다. -</font>'; // 삭제글
	$_skin['i_delete2']='<font color=red>[삭제]$bd_subject</font>'; // 삭제글(관리자)
	$_skin['i_notice']='<font color=blue>[공지]</font>'; // 공지사항
	$_skin['i_currnet']='->'; // 현재글	
?>