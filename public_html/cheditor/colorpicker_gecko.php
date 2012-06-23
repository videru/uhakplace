<?
include("./_common.php");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$g4[charset]?>">
<title>배경색</title>
<script src="color_picker_simple.js"></script>
<script language=javascript>
function DoReturn() {
  var scolor = document.all.colorp1Col.value;
  window.returnValue = scolor;
  window.close();
}

function DoReset() {
  window.returnValue = '';
  window.close();
}
</script>
<style type="text/css">
body {
  background-color: #eeeeee;
  margin: 0;
  border: 0;
  padding: 0;
}

#button {
  font-size: 9pt;
  padding-top: 3px;
  height: 24px;
  width: 6em;
}
img {
  border: 0;
}

font {
  font-size: 9pt;
}
</style>
</head>

<body scroll="no">
<center>
<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><img src="./icons/dot.gif" width="1" height="10"></td>
  </tr>
</table>
<table cellpadding="1" cellpadding="0" width="95%">
  <tr>
    <td bgcolor="#55555d">
      <table border="0" cellpadding="4" cellspacing="0" width="100%">
        <tr bgcolor="white">
          <td>
            <font>배경색:</font>
          </td>
        </tr>
        <tr bgcolor="white">
          <td>
            <script>
            document.write(drawColor('colorp1'))
            </script>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><img src="./icons/dot.gif" width="1" height="10"></td>
  </tr>
</table>
<input type="button" value="확인" onClick="DoReturn();" id="button">
<input type="button" value="취소" onClick="window.close();" id="button">
</center>
</body>
</html>
