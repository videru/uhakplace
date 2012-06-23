<?php
include_once("_common.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=<?=$g4[charset]?>" />
<link rel="stylesheet" type="text/css" href="dialog.css" />
<title>CHEditor</title>
<script type="text/javascript">
//<![CDATA[
var oEditor = parent.chutil.oname;
function insert(img)
{
  eval('parent.'+oEditor).doCmdPaste('<img src="'+img.src+'" border="0" style="vertical-align:middle" alt="">');
  popupClose();
}
function popupClose() {
    eval('parent.'+oEditor).popupWinClose();
}
//]]>
</script>
</head>
<body>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
  <tr>
    <td>
    <fieldset>
      <table border="0" align="center" cellpadding="5">
        <tr valign="top">
          <td>
          <table border="0" align="center">
            <tr>
              <td class="cursor"><img hspace="5" src="./icons/em/1.gif" onclick="insert(this)" width="19" height="19" alt="" /></td>
              <td><img hspace="5" src="./icons/em/2.gif" onclick="insert(this)" width="19" height="19" alt="" /></td>
              <td><img hspace="5" src="./icons/em/3.gif" onclick="insert(this)" width="19" height="19" alt="" /></td>
              <td><img hspace="5" src="./icons/em/4.gif" onclick="insert(this)" width="19" height="19" alt="" /></td>
              <td><img hspace="5" src="./icons/em/5.gif" onclick="insert(this)" width="19" height="19" alt="" /></td>
              <td><img hspace="5" src="./icons/em/6.gif" onclick="insert(this)" width="19" height="19" alt="" /></td>
              <td><img hspace="5" src="./icons/em/7.gif" onclick="insert(this)" width="19" height="19" alt="" /></td>
              <td><img hspace="5" src="./icons/em/8.gif" onclick="insert(this)" width="19" height="19" alt="" /></td>
              <td><img hspace="5" src="./icons/em/9.gif" onclick="insert(this)" width="19" height="19" alt="" /></td>
              <td><img hspace="5" src="./icons/em/10.gif" onclick="insert(this)" width="19" height="19" alt="" /></td>
            </tr>
          </table>
          </td>
        </tr>
        <tr>
          <td>
          <table border="0" align="center">
              <tr>
              <td><img hspace="5" src="./icons/em/11.gif" onclick="insert(this)" width="19" height="19" alt="" /></td>
              <td><img hspace="5" src="./icons/em/12.gif" onclick="insert(this)" width="19" height="19" alt="" /></td>
              <td><img hspace="5" src="./icons/em/13.gif" onclick="insert(this)" width="19" height="19" alt="" /></td>
              <td><img hspace="5" src="./icons/em/14.gif" onclick="insert(this)" width="19" height="19" alt="" /></td>
              <td><img hspace="5" src="./icons/em/15.gif" onclick="insert(this)" width="19" height="19" alt="" /></td>
              <td><img hspace="5" src="./icons/em/16.gif" onclick="insert(this)" width="19" height="19" alt="" /></td>
              <td><img hspace="5" src="./icons/em/17.gif" onclick="insert(this)" width="19" height="19" alt="" /></td>
              <td><img hspace="5" src="./icons/em/18.gif" onclick="insert(this)" width="19" height="19" alt="" /></td>
              <td><img hspace="5" src="./icons/em/19.gif" onclick="insert(this)" width="19" height="19" alt="" /></td>
              <td><img hspace="5" src="./icons/em/20.gif" onclick="insert(this)" width="19" height="19" alt="" /></td>
            </tr>
          </table>
          </td>
        </tr>
        <tr>
          <td>
          <table border="0" align="center">
              <tr>
              <td><img hspace="5" src="./icons/em/21.gif" onclick="insert(this)" width="19" height="19" alt="" /></td>
              <td><img hspace="5" src="./icons/em/22.gif" onclick="insert(this)" width="19" height="19" alt="" /></td>
              <td><img hspace="5" src="./icons/em/23.gif" onclick="insert(this)" width="19" height="19" alt="" /></td>
              <td><img hspace="5" src="./icons/em/24.gif" onclick="insert(this)" width="19" height="19" alt="" /></td>
              <td><img hspace="5" src="./icons/em/25.gif" onclick="insert(this)" width="19" height="19" alt="" /></td>
              <td><img hspace="5" src="./icons/em/26.gif" onclick="insert(this)" width="19" height="19" alt="" /></td>
              <td><img hspace="5" src="./icons/em/27.gif" onclick="insert(this)" width="19" height="19" alt="" /></td>
              <td><img hspace="5" src="./icons/em/28.gif" onclick="insert(this)" width="19" height="19" alt="" /></td>
              <td><img hspace="5" src="./icons/em/29.gif" onclick="insert(this)" width="19" height="19" alt="" /></td>
              <td><img hspace="5" src="./icons/em/30.gif" onclick="insert(this)" width="19" height="19" alt="" /></td>
            </tr>
          </table>
          </td>
        </tr>
        <tr>
          <td>
          <table border="0" align="center">
              <tr>
              <td><img hspace="5" src="./icons/em/31.gif" onclick="insert(this)" width="19" height="19" alt="" /></td>
              <td><img hspace="5" src="./icons/em/32.gif" onclick="insert(this)" width="19" height="19" alt="" /></td>
              <td><img hspace="5" src="./icons/em/33.gif" onclick="insert(this)" width="19" height="19" alt="" /></td>
              <td><img hspace="5" src="./icons/em/34.gif" onclick="insert(this)" width="19" height="19" alt="" /></td>
              <td><img hspace="5" src="./icons/em/35.gif" onclick="insert(this)" width="19" height="19" alt="" /></td>
              <td><img hspace="5" src="./icons/em/36.gif" onclick="insert(this)" width="19" height="19" alt="" /></td>
              <td><img hspace="5" src="./icons/em/37.gif" onclick="insert(this)" width="19" height="19" alt="" /></td>
              <td><img hspace="5" src="./icons/em/38.gif" onclick="insert(this)" width="19" height="19" alt="" /></td>
              <td><img hspace="5" src="./icons/em/39.gif" onclick="insert(this)" width="19" height="19" alt="" /></td>
              <td><img hspace="5" src="./icons/em/40.gif" onclick="insert(this)" width="19" height="19" alt="" /></td>
            </tr>
          </table>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
</div>
<div class="spacer"></div>
<div style="text-align:center">
  <button onclick="popupClose()" class="button">´Ý±â</button>
</div>
<script type="text/javascript" language="javascript">
//<![CDATA[
var imgs = document.getElementsByTagName('img');
for (i=0; i < imgs.length; i++) imgs[i].className = 'handCursor';
//]]>
</script>
</body>
</html>
