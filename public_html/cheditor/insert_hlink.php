<?
include("./_common.php");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$g4[charset]?>">
<title>하이퍼 링크</title>
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
INPUT, SELECT {
  font-family: "굴림", MS Sans Serif;
  font-size: 9pt;
  vertical-align: middle;
}
font {
  font-size: 9pt;
  font-family: 굴림;
}
form { inline; }
</STYLE>
<script language="JavaScript">
function UpdateProtocol()
{
  var selectedItem        = document.set.protocol.selectedIndex;
  var selectedItemValue   = document.set.protocol.options[selectedItem].value;
  var selectedItemText    = document.set.protocol.options[selectedItem].text;
  var inputtedText        = document.set.link_value.value;

  var protocol = inputtedText.split(":");

  if (protocol[1]) {
    var datum = protocol[1].replace(/^\/\//, "");
    datum = datum.replace(/\\/, "");
    datum = datum.replace(/^\//, "");
  }
  else {
    if(inputtedText.indexOf(":") > 0)
      var datum = "";
    else {
      var datum = protocol[0];
      datum = protocol[0].replace(/^\/\/\//, "//");
    }
  }

  document.set.link_value.value = selectedItemValue + datum;
  document.set.link_value.focus();
}

function returnSelected()
{
  //var obj = window.opener.chutil.myobj;
  var obj = window.opener.saveobj;
  var text;
  var target = null;
  var title = null;

  if (document.set.link_value.value != "") {
    text = document.set.link_value.value;
  }
  else {
    alert("링크 URL을 입력하여 주십시오.");
    return false;
  }

  if (document.set.target.value != "") {
    target = document.set.target.value;
  }

  if (document.set.title.value != "") {
    title = document.set.title.value;
  }

  eval("window.opener."+obj).hyperLink(text, target, title);

  window.close();
}
</script>
</head>
<body>
<form name="set">
<input type="hidden" value="" name="SelTxt">
<table cellpadding="0" cellspacing="0" border="0" width="100%">
  <tr>
    <td align="center">
      <fieldset><legend align="left"><font color=blue>하이퍼링크</font></legend>
      <table border="0" cellspacing="4" align="center">
        <tr>
          <td align="right" width="40"><font>유형:</font>
          </td>
          <td>
            <select name="protocol" onchange="UpdateProtocol();">
            <option value="http://" selected>http
            <option value="https://">https
            <option value="mailto:">mailto
            <option value="file://">file
            <option value="ftp://">ftp
            <option value="gopher://">gopher
            <option value="news:">news
            <option value="telnet:">telnet
            <option value="wias:">wias
            <option value="javascript:">javascript
            </select>
          </td>
          <td align="right"><font>타겟:</font>
          </td>
          <td>
            <select name="target">
              <option value="" selected>없음
              <option value="_self">_self
              <option value="_blank">_blank
              <option value="_parent">_parent
              <option value="_top">_top
            </select>
          </td>
        </tr>
        <tr>
          <td align="right"><font>URL:</font>
          </td>
          <td colspan="3">
            <input type="text" name="link_value" value="http://" size="50">
          </td>
        </tr>
        <tr>
          <td align="right"><font>타이틀:</font>
          </td>
          <td colspan="3">
            <input type="text" name="title" value="" size="50">
          </td>
        </tr>
      </table>
      </fieldset>
    </td>
  </tr>
  <tr>
    <td colspan="2" align="center">
      <table cellpadding="3">
        <tr>
          <td align="center">
            <input type="button" id="button" value="확인" onClick="returnSelected();">
            <input type="button" id="button" value="취소" onClick="window.close()">
          </td>
        </tr>
      </table>
      </form>
    </td>
  </tr>
</table>
</body>
</html>