<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>유학플레이스 관리모드</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link href="http://uhakplace.co.kr/css/style.css" rel="stylesheet" type="text/css">
</head>
<script src="<?=$_url['js']?>common.js"></script>
<script src="<?=$_url['js']?>lib.validate.js"></script>
<script src="<?=$_url['js']?>carendar.js"></script>
<script language="javascript" src="LeftMenuTree.js"></script>
<script>
	// 회원아이디 목록창
	function member_list_popup(url_path,form_info)
	{
		// 다중선택여부|폼네임|key필드명|값받을폼이름|표시될폼이름|표시형식$mb_id($mb_name)
		window_open(url_path+'member_list_popup.php?form_info='+form_info,'member_list_popup','scrollbars=no,width=600,height=600');
	}
</script>
<script language="javascript">
// http://happyscript.com
function printWindow() {
factory.printing.header = ""
factory.printing.footer = ""
  factory.printing.portrait = true;   // true 면 세로인쇄, false 면 가로인쇄
factory.printing.leftMargin = 15.0
factory.printing.topMargin = 15.0
factory.printing.rightMargin = 15.0
factory.printing.bottomMargin = 15.0

factory.printing.Print(false, window)
}
</script>
<body bottommargin="0" topmargin="0" leftmargin="0" rightmargin="0">
<a name=top>
<object id=factory style="display:none" viewastext classid="clsid:1663ed61-23eb-11d2-b92f-008048fdd814" codebase="<?=$_url['js']?>smsx.cab#Version=6,4,438,06"></object>