<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>제스유학원 관리모드</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link href="<?=$_url['css']?>style.css" rel="stylesheet" type="text/css">
</head>
<script src="<?=$_url['js']?>common.js"></script>
<script src="<?=$_url['js']?>lib.validate.js"></script>
<script language="javascript" src="<?=$_url['js']?>LeftMenuTree.js"></script>
<script>
	// 회원아이디 목록창
	function member_list_popup(url_path,form_info)
	{
		// 다중선택여부|폼네임|key필드명|값받을폼이름|표시될폼이름|표시형식$mb_id($mb_name)
		window_open(url_path+'member_list_popup.php?form_info='+form_info,'member_list_popup','scrollbars=no,width=600,height=600');
	}
</script>
<body bottommargin="0" topmargin="0" leftmargin="0" rightmargin="0">
<a name=top>
