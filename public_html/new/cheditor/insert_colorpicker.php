<?
include("./_common.php");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$g4[charset]?>">
<TITLE>색상 선택</TITLE>
<SCRIPT LANGUAGE="JavaScript" src="color_picker.js"></SCRIPT>
<SCRIPT LANGUAGE=JavaScript>
<!--
function select_color(s)
{
    var varg = {};
    argv = window.dialogArguments;

    if (!argv) {
        alert ("오류: 객체가 없습니다!");
        window.returnValue = false;
        window.close ();
    }

    if (argv.change)
        argv.change (s, argv.editor);
}
// -->
</SCRIPT>

<SCRIPT LANGUAGE=JavaScript FOR=Cancel EVENT=onclick>
<!--
    var varg = {};
    argv = window.dialogArguments;

    if (argv.change)
        argv.change (argv.color, argv.editor);

    window.returnValue = argv.color;
    window.close ();
// -->
</SCRIPT>

<SCRIPT LANGUAGE=JavaScript FOR=Ok EVENT=onclick>
<!--
    window.returnValue = SelectColor.value;
    window.close();
// -->
</SCRIPT>
<STYLE TYPE="text/css">
body {
  background-color: #f7f5f3;
  margin: 0;
  scroll: no;
  border: 0;
  padding: 0;
}

button {
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
.colorImage	{cursor: url('icons/picker.ani');}
</STYLE>
</HEAD>

<BODY scroll="no">
<div id=D4 style="position:absolute; top:0; left:0; visibility:visible; z-index:0;">
<div id=D1 onmousedown=clickS1() style="position:absolute; top:25; left:3; width:8; height:8; visibility:visible; z-index:10;" class="colorImage">
<img src="./icons/sel.gif" border=0></div>
<div id=D2 onmousedown=clickS2() style="position:absolute; top:240; left:1; visibility:visible; z-index:10;" class="colorImage">
<img src="./icons/sel2.gif" border=0></div>
<div id=D3 onmousedown=clickS3() style="position:absolute; top:130; left:322; visibility:visible; z-index:10;">
<img src="./icons/sel3.gif" border=0></div>

<div style="position:absolute; top:24; left:332; visibility:visible; z-index:5;">
<table border style="border-width:1px; border-color:black;">
  <tr>
    <td width="100" height="68" style="border-width:0; border-color:white; border-style:none;">&nbsp;</td>
  </tr>
</table>
</div>

<div id=s3 onmousedown=clickS3() style="position:absolute; top:130; left:310; visibility:visible; z-index:5;">
<form name=colorTable action="javascript:return false">
<table border="0" cellpadding="0" cellspacing="0" class="colorImage"
    style="margin:0px;
    padding:0px;
    border-width:1px;
    border-style: inset;">
    <script>makeColorTable();</script>
    <tr>
    <td width="8" height="6" bgcolor="black" style="font-size:0; letter-spacing:0; text-indent:0; margin:0px; padding:0px; border-width:0; border-color:black; border-style:none;"><p>&nbsp;</td>
    </tr>
</table>
</form>
</div>
<div id=viewCol style="background-color:#FFFFFF; position:absolute; width:108; height:72; left:332; top:25;"></div>
<table border=0>
  <tr>
    <td>
      <font>사용자 색상 선택:</font>
    </td>
  </tr>
  <tr>
    <td width="325" valign=top><p>
      <img src="./icons/setcolor.gif" width="313" height="73" onmousemove="dragCol();">
    </td>
    <td width="121" rowspan="2" align=left valign=top>&nbsp;</td>
  </tr>
  <tr>
    <td width="325" height=18 align=left >
      <font style="font-size:9pt;">&nbsp;<span ID=RGB>#FFFFFF</span></font>
    </td>
  </tr>
  <tr>
    <td width="325">
      <table>
        <tr>
          <td style="padding:0px; border-width:1px; border-style: inset;" class="colorImage">
            <img src="./icons/palmore.jpg" width="289" height="118" onmousedown=clickS2()></td>
          <td width=20 align=right>&nbsp;</td>
        <tr>
      </table>
    </td>
    <td width="132" valign=top align="right">
      <div>
      <table border=0>
        <tr>
          <td align=right>
            <font>빨강:</font>
          </td>
          <td><input type=text value=255 size=3 ID=redCol></td>
        </tr>
        <tr>
          <td align=right>
            <font>녹색:</font>
          </td>
          <td><input type=text value=255 size=3 ID=greenCol></td>
        </tr>
        <tr>
          <td align=right>
            <font>파랑:</font>
          </td>
          <td><input type=text value=255 size=3 ID=blueCol></td>
        </tr>
        <tr>
          <td align=right>
            <font>HEX:</font>
          </td>
          <td><input ID="SelectColor" type=text value=#FFFFFF size=7></td>
        </tr>
      </table>
      </div>
    </td>
  </tr>
</table>
<center>
<br>
<button id="Ok" type=submit>확인</button>&nbsp;
<button id="Cancel" type=button>취소</button>

</center>
</div>
</BODY>
</HTML>
