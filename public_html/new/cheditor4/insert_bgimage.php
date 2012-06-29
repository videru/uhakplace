<?php
include_once("_common.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=<?=$g4[charset]?>" />
<title>CHEditor</title>
<script type="text/javascript">
//<![CDATA[
var oEditor = parent.chutil.oname;
function doSubmit(img) {
  if (img) {
    eval("parent."+oEditor).insertBgImage(img);
    popupClose();
  }
}
function remove(){
  eval("parent."+oEditor).insertBgImage(null);
  popupClose();
}
function popupClose() {
    eval('parent.'+oEditor).popupWinClose();
}
//]]>
</script>
<link rel="stylesheet" type="text/css" href="dialog.css" />
</head>
<div class="wrapper">
    <fieldset>
    <table width="100%" border="0" cellspacing="0" cellpadding="6">
      <tr>
        <td><img onclick="doSubmit('patterns/gray.jpg')" border="1" src="patterns/thumbnail/gray.jpg" alt="" width="50" height="50" /></td>
        <td><img onclick="doSubmit('patterns/flowers.gif')" border="1" src="patterns/thumbnail/flowers.gif" alt="" width="50" height="50" /></td>
        <td><img border="1" src="icons/dot.gif" width="50" height="50" alt="" /></td>
        <td><img border="1" src="icons/dot.gif" width="50" height="50" alt="" /></td>
        <td><img border="1" src="icons/dot.gif" width="50" height="50" alt="" /></td>
        <td><img border="1" src="icons/dot.gif" width="50" height="50" alt="" /></td>
      </tr>
      <tr>
        <td><img border="1" src="icons/dot.gif" width="50" height="50" alt="" /></td>
        <td><img border="1" src="icons/dot.gif" width="50" height="50" alt="" /></td>
        <td><img border="1" src="icons/dot.gif" width="50" height="50" alt="" /></td>
        <td><img border="1" src="icons/dot.gif" width="50" height="50" alt="" /></td>
        <td><img border="1" src="icons/dot.gif" width="50" height="50" alt="" /></td>
        <td><img border="1" src="icons/dot.gif" width="50" height="50" alt="" /></td>
      </tr>
    </table>
    </fieldset>
    <div class="spacer">
      <button onclick="remove()" class="button10em">배경그림 삭제</button>&#160;<button onclick="popupClose()" class="button10em">취소</button>
    </div>
</div>
<script type="text/javascript">
//<![CDATA[
var imgs = document.getElementsByTagName('img');
for (i=0; i < imgs.length; i++) {
    var img = imgs[i].src;

    while (img.indexOf("/") != -1)
        img = img.slice(img.indexOf("/") + 1);

    img = img.slice(img.indexOf("/")+1);

    if (img == 'dot.gif')
        continue;

    imgs[i].className = 'handCursor';
}
//]]>
</script>
</body>
</html>
