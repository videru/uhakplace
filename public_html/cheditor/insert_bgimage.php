<?
include("./_common.php");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$g4[charset]?>">
<title>배경 그림 넣기</title>
<script language='JavaScript'>
//var obj = window.opener.chutil.myobj;
var obj = window.opener.saveobj;
function DoReturn(img) {
  if (img) {
    eval("window.opener."+obj).insertBgImage(img);
    window.close();
  }
}
function Remove(){
  eval("window.opener."+obj).insertBgImage(null);
  window.close();
}
</script>
<LINK rel="stylesheet" type="text/css" href="dialog.css">
<style type="text/css">
</style>
</head>
<body style="margin:10;">
<DIV ALIGN="center">
<fieldset>
<legend><font color="blue">배경 그림 넣기</font></legend>
<table width="100%" align="center"border="0" cellspacing="0" cellpadding="6">
  <tr align="center" valign="top">
    <td><img onclick="DoReturn('patterns/gray.jpg')" border=1 src="patterns/thumbnail/gray.jpg" width="50" height="50"><BR></td>
    <td><img onclick="DoReturn('patterns/flowers.gif')" border=1 src="patterns/thumbnail/flowers.gif" width="50" height="50"><BR></td>
    <td><img onclick="DoReturn()" border=1 src="icons/dot.gif" width="50" height="50"><BR></td>
    <td><img onclick="DoReturn()" border=1 src="icons/dot.gif" width="50" height="50"><BR></td>
    <td><img onclick="DoReturn()" border=1 src="icons/dot.gif" width="50" height="50"><BR></td>
    <td><img onclick="DoReturn()" border=1 src="icons/dot.gif" width="50" height="50"><BR></td>
  </tr>
  <tr align="center">
    <td><img onclick="DoReturn()" border=1 src="icons/dot.gif" width="50" height="50"><BR></td>
    <td><img onclick="DoReturn()" border=1 src="icons/dot.gif" width="50" height="50"><BR></td>
    <td><img onclick="DoReturn()" border=1 src="icons/dot.gif" width="50" height="50"><BR></td>
    <td><img onclick="DoReturn()" border=1 src="icons/dot.gif" width="50" height="50"><BR></td>
    <td><img onclick="DoReturn()" border=1 src="icons/dot.gif" width="50" height="50"><BR></td>
    <td><img onclick="DoReturn()" border=1 src="icons/dot.gif" width="50" height="50"><BR></td>
  </tr>
</table>
</fieldset>
<p>
<input value="배경 그림 삭제" type=button onClick="Remove()" id="button8em">
<input value="취소" type=button onClick="window.close()" id="button8em">
</DIV>
</body>
</html>
