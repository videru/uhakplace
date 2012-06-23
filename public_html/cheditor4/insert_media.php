<?php
include_once("_common.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=<?=$g4[charset]?>" />
<title>미디어 파일 넣기</title>
<link rel="stylesheet" type="text/css" href="dialog.css" />
</head>
<body oncontextmenu="return false">
<form action="" name="insertImage" style="display:inline">
<fieldset><legend><span class="normal">미디어 재생</span></legend>
<table border="0" cellpadding="0" cellspacing="0" width="240">
  <tr>
    <td align="center">
      <div id="play" style="height:200px;"></div>
    </td>
  </tr>
</table>
</fieldset>
<br />
<fieldset><legend><span class="normal">미디어 파일 URL</span></legend>
<table border="0" width="100%" cellspacing="0" cellpadding="4">
  <tr>
    <td>
      <span class="normal">URL 입력:</span>
    </td>
  </tr>
  <tr>
    <td>
      <input type="text" name="linkurl" id="fm_linkurl" size="50" />
    </td>
  </tr>
</table>
</fieldset>
<div class="spacer"></div>
<div style="text-align:center">
<button onclick="play()" class="button">재생</button>&#160;
<button onclick="DoSubmit()" class="button">확인</button>&#160;
<button onclick="popupClose()" class="button">취소</button>
</div>
</form>
<script type="text/javascript">
//<![CDATA[
var oEditor = parent.chutil.oname;
function play()
{
    var file = document.getElementById("fm_linkurl");
    if (!file.value) return;
    var mediaobj = "<embed src='"+file.value+"' autostart='true' loop='true'></embed>";
    var obj = document.getElementById("play");
    obj.innerHTML = mediaobj;
}

function DoSubmit()
{
    var file = document.getElementById("fm_linkurl");
    var media = "<embed src='"+file.value+"' autostart='true' loop='true'></embed>";
    eval("parent."+oEditor).doCmdPaste(media);
    popupClose();
}

function popupClose() {
    eval('parent.'+oEditor).popupWinClose();
}
//]]>
</script>
</body>
</html>
