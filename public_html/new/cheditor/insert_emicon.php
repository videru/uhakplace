<?
include("./_common.php");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$g4[charset]?>">
<link rel="stylesheet" type="text/css" href="dialog.css">
<title>표정 아이콘 삽입</title>
<script language="JavaScript">
function insert(e) {
  var img;
  var em;
  //var obj = window.opener.chutil.myobj;
  var obj = window.opener.saveobj;

  if (document.all != null) {
    img = e.srcElement;
    em = '<img src='+img.src+' align=absmiddle border=0>';
    eval("window.opener."+obj).insertEl(em);
  }
  else {
    img = e.target;
    em = document.createElement("img");
    em.src = img.src;
    em.border = 0;
    em.align = 'absmiddle';
    eval("window.opener."+obj).insertImage(em);
  }
  window.close();
}

function cancel() {
  window.close();
}
</script>
</head>
<body scroll="no">
<center>
<div class="spacer">
<table border="0" cellpadding="4" cellspacing="0" width="95%">
  <tr>
    <td>
    <fieldset><legend><font style="font-size:9pt;">표정 아이콘 넣기&nbsp;</font></legend>
      <table border="0" align="center" cellpadding="5">
        <tr valign="top">
          <td>
          <table border="0" align="center">
            <tr>
              <td><img hspace="5" src="./icons/em/1.gif" onclick="insert(event)" width="19" height="19"></td>
              <td><img hspace="5" src="./icons/em/2.gif" onclick="insert(event)" width="19" height="19"></td>
              <td><img hspace="5" src="./icons/em/3.gif" onclick="insert(event)" width="19" height="19"></td>
              <td><img hspace="5" src="./icons/em/4.gif" onclick="insert(event)" width="19" height="19"></td>
              <td><img hspace="5" src="./icons/em/5.gif" onclick="insert(event)" width="19" height="19"></td>
              <td><img hspace="5" src="./icons/em/6.gif" onclick="insert(event)" width="19" height="19"></td>
              <td><img hspace="5" src="./icons/em/7.gif" onclick="insert(event)" width="19" height="19"></td>
              <td><img hspace="5" src="./icons/em/8.gif" onclick="insert(event)" width="19" height="19"></td>
              <td><img hspace="5" src="./icons/em/9.gif" onclick="insert(event)" width="19" height="19"></td>
              <td><img hspace="5" src="./icons/em/10.gif" onclick="insert(event)" width="19" height="19"></td>
            </tr>
          </table>
          </td>
        </tr>
        <tr>
          <td>
          <table border="0" align="center">
              <tr>
              <td><img hspace="5" src="./icons/em/11.gif" onclick="insert(event)" width="19" height="19"></td>
              <td><img hspace="5" src="./icons/em/12.gif" onclick="insert(event)" width="19" height="19"></td>
              <td><img hspace="5" src="./icons/em/13.gif" onclick="insert(event)" width="19" height="19"></td>
              <td><img hspace="5" src="./icons/em/14.gif" onclick="insert(event)" width="19" height="19"></td>
              <td><img hspace="5" src="./icons/em/15.gif" onclick="insert(event)" width="19" height="19"></td>
              <td><img hspace="5" src="./icons/em/16.gif" onclick="insert(event)" width="19" height="19"></td>
              <td><img hspace="5" src="./icons/em/17.gif" onclick="insert(event)" width="19" height="19"></td>
              <td><img hspace="5" src="./icons/em/18.gif" onclick="insert(event)" width="19" height="19"></td>
              <td><img hspace="5" src="./icons/em/19.gif" onclick="insert(event)" width="19" height="19"></td>
              <td><img hspace="5" src="./icons/em/20.gif" onclick="insert(event)" width="19" height="19"></td
            </tr>
          </table>
          </td>
        </tr>
        <tr>
          <td>
          <table border="0" align="center">
              <tr>
              <td><img hspace="5" src="./icons/em/21.gif" onclick="insert(event)" width="20" height="20"></td>
              <td><img hspace="5" src="./icons/em/22.gif" onclick="insert(event)" width="20" height="20"></td>
              <td><img hspace="5" src="./icons/em/23.gif" onclick="insert(event)" width="20" height="20"></td>
              <td><img hspace="5" src="./icons/em/24.gif" onclick="insert(event)" width="20" height="20"></td>
              <td><img hspace="5" src="./icons/em/25.gif" onclick="insert(event)" width="20" height="20"></td>
              <td><img hspace="5" src="./icons/em/26.gif" onclick="insert(event)" width="20" height="20"></td>
              <td><img hspace="5" src="./icons/em/27.gif" onclick="insert(event)" width="20" height="20"></td>
              <td><img hspace="5" src="./icons/em/28.gif" onclick="insert(event)" width="20" height="20"></td>
              <td><img hspace="5" src="./icons/em/29.gif" onclick="insert(event)" width="20" height="20"></td>
              <td><img hspace="5" src="./icons/em/30.gif" onclick="insert(event)" width="20" height="20"></td
            </tr>
          </table>
          </td>
        </tr>
        <tr>
          <td>
          <table border="0" align="center">
              <tr>
              <td><img hspace="5" src="./icons/em/31.gif" onclick="insert(event)" width="20" height="20"></td>
              <td><img hspace="5" src="./icons/em/32.gif" onclick="insert(event)" width="20" height="20"></td>
              <td><img hspace="5" src="./icons/em/33.gif" onclick="insert(event)" width="20" height="20"></td>
              <td><img hspace="5" src="./icons/em/34.gif" onclick="insert(event)" width="20" height="20"></td>
              <td><img hspace="5" src="./icons/em/35.gif" onclick="insert(event)" width="20" height="20"></td>
              <td><img hspace="5" src="./icons/em/36.gif" onclick="insert(event)" width="20" height="20"></td>
              <td><img hspace="5" src="./icons/em/37.gif" onclick="insert(event)" width="20" height="20"></td>
              <td><img hspace="5" src="./icons/em/38.gif" onclick="insert(event)" width="20" height="20"></td>
              <td><img hspace="5" src="./icons/em/39.gif" onclick="insert(event)" width="20" height="20"></td>
              <td><img hspace="5" src="./icons/em/40.gif" onclick="insert(event)" width="20" height="20"></td
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
<input type="button" value="닫기" onclick="cancel()" id="button">
</center>
</body>
</html>
