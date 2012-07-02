
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title>필리핀 전문 포털 필사과</title>
<link href="../css/style.css" rel="stylesheet" type="text/css">
<script src="../js/common.js"></script>
<script src="../js/lib.validate.js"></script>
<script language="JavaScript"> 
function bookmark() {
	var title= '유학플레이스';
	var url ='http://www.uhakplace.co.kr/';
	
	//document.write("userAgent : " + navigator.userAgent + "<br>");
	if(navigator.userAgent.indexOf("MSIE") > 0 ){
		window.external.AddFavorite(url, title)
	}
	else if(navigator.userAgent.indexOf("Firefox") > 0 ){
	 //document.write("Firefox");
	 window.sidebar.addPanel(title, url, ""); 
	}
	else if(window.opera && window.print)
	{
	  var elem = document.createElement('a'); 
      elem.setAttribute('href',url); 
      elem.setAttribute('title',title); 
      elem.setAttribute('rel','sidebar'); 
      elem.click(); 
	}
	else if(navigator.userAgent.indexOf("Chrome") > 0 ){
	 alert("해당 브라우저에서는 지원되지 않습니다.");
	}
}
</script>
</head>
<?
	include_once("../include/lib.php");
?>
<? include_once('../phil/_header_new.php'); ?>

<body >
<div style="height:35px;"></div>
<table width="980" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr align="right">
    <td>
    	<?=rg_outlogin('jw_top')?>
    	
    </td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><a href="http://uhakplace.co.kr" target="_parent" onFocus="blur();"><img src="../n_img/main_07.jpg" width="274" height="61" border="0" /></a></td>
        <td><embed src="../n_img/new_top_menu.swf" width="706" height="61"></embed></td>
      </tr>
    </table></td>
  </tr>
</table>

<!--원래 것과분리-->
</body>
</html>

