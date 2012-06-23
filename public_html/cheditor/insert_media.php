<?
include("./_common.php");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$g4[charset]?>">
<title>미디어 파일 넣기</title>
<STYLE TYPE="text/css">
body {
  background-color: #f7f5f3;
  margin: 5px;
  border: 0;
  padding: 5px;
}
#button {
  font-size: 9pt;
  padding-top: 3px;
  height: 24px;
  width: 6em;
}
img { border: 0; }
font {
  font-size: 9pt;
  font-family: 굴림;
}
</STYLE>
</head>
<body bgcolor="#dedfdf" oncontextmenu="return false" scroll="no">
<center>
<form action="" name="insertImage" method=get style="inline">
<fieldset><legend><font color="blue">미디어 재생</font></legend>
<table border="0" cellpadding="0" cellspacing="0" width="240">
  <tr>
    <td>
    <div id="play" style="height:200px">

    </div>
    </td>
  </tr>
</table>
</fieldset>
<br>
<fieldset><legend><font color="blue">미디어 파일 URL</font></legend>
<table border="0" width="100%" cellspacing="0" cellpadding="4">
  <tr>
    <td>
      <font>URL 입력:</font>
    </td>
  </tr>
  <tr>
    <td>
      <input type="text" name="linkurl" id="linkurl" size="50">
    </td>
  </tr>
</table>
</fieldset>
<br>
<input type="button" value="재생" onClick="play();" id="button">
<input type="button" value="확인" onClick="DoReturn();" id="button">
<input type="button" value="취소" onClick="window.close();" id="button">
</form>
</center>
<script language=javascript>
function play()
{
   var file = document.getElementById("linkurl");
	if (!file.value) return;

    var mediaobj = "<embed src='"+file.value+"' autostart='true' loop='true'></embed>";
    var obj = document.getElementById("play");
    obj.innerHTML = mediaobj;
}

function DoReturn()
{
  var file = document.getElementById("linkurl");
  var media = "<embed src='"+file.value+"'autostart='true' loop='true'>";
  //var obj = window.opener.chutil.myobj;
  var obj = window.opener.saveobj;
  eval("window.opener."+obj).insertEl(media);
  window.close();
}
</script>
</body>
</html>
