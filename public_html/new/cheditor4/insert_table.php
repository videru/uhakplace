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

function drawColor(el)
{
    var colour = [
    "FFFFCC","FFCC66","FF9900","FFCC99","FF6633","FFCCCC","CC9999","FF6699","FF99CC","FF66CC","FFCCFF","CC99CC","CC66FF","CC99FF","9966CC","CCCCFF","9999CC","3333FF","6699FF","0066FF","99CCFF","66CCFF","99CCCC","CCFFFF","99FFCC","66CC99","66FF99","99FF99","CCFFCC","33FF33","66FF00","CCFF99","99FF00","CCFF66","CCCC66","FFFFFF",
    "FFFF99","FFCC00","FF9933","FF9966","CC3300","FF9999","CC6666","FF3366","FF3399","FF00CC","FF99FF","CC66CC","CC33FF","9933CC","9966FF","9999FF","6666FF","3300FF","3366FF","0066CC","3399FF","33CCFF","66CCCC","99FFFF","66FFCC","33CC99","33FF99","66FF66","99CC99","00FF33","66FF33","99FF66","99FF33","CCFF00","CCCC33","CCCCCC",
    "FFFF66","FFCC33","CC9966","FF6600","FF3300","FF6666","CC3333","FF0066","FF0099","FF33CC","FF66FF","CC00CC","CC00FF","9933FF","6600CC","6633FF","6666CC","3300CC","0000FF","3366CC","0099FF","00CCFF","339999","66FFFF","33FFCC","00CC99","00FF99","33FF66","66CC66","00FF00","33FF00","66CC00","99CC66","CCFF33","999966","999999",
    "FFFF33","CC9900","CC6600","CC6633","FF0000","FF3333","993333","CC3366","CC0066","CC6699","FF33FF","CC33CC","9900CC","9900FF","6633CC","6600FF","666699","3333CC","0000CC","0033FF","6699CC","3399CC","669999","33FFFF","00FFCC","339966","33CC66","00FF66","669966","00CC00","33CC00","66CC33","99CC00","CCCC99","999933","666666",
    "FFFF00","CC9933","996633","993300","CC0000","FF0033","990033","996666","993366","CC0099","FF00FF","990099","996699","660099","663399","330099","333399","000099","0033CC","003399","336699","0099CC","006666","00FFFF","33CCCC","009966","00CC66","339933","336633","33CC33","339900","669933","99CC33","666633","999900","333333",
    "CCCC00","996600","663300","660000","990000","CC0033","330000","663333","660033","990066","CC3399","993399","660066","663366","330033","330066","333366","000066","000033","003366","006699","003333","336666","00CCCC","009999","006633","009933","006600","003300","00CC33","009900","336600","669900","333300","666600","000000"];

    var htmloutput = ["<table border='0' cellpadding='0' cellspacing='0'>" +
                      "<tr><td bgcolor='#000000'><table border='0' cellspacing='1' cellpadding='0' align='center'>"]
    var k = 0;

    for (var i = 0; i < 6; i++) {
        htmloutput[htmloutput.length] = "<tr>";
        for (var j = 0; j < 36; j++) {
            htmloutput[htmloutput.length] = "<td bgcolor='#"+colour[k]+"' id='"+el+"' width='9' height='9' onclick='getColor(this)'></td>";
            k++;
        }
        htmloutput[htmloutput.length] = "</tr>";
    }

    htmloutput[htmloutput.length] = "</table></td></tr></table>";
    return htmloutput.join("\n");
}

function getColor(el)
{
    var color = el.bgColor;
    var input = document.getElementById("id"+el.id);
    input.style.backgroundColor = input.value = color.toUpperCase();
}

function doSubmit()
{
    var rows    = parseInt(document.getElementById("numrows").value);
    var cols    = parseInt(document.getElementById("numcols").value);
    var border  = parseInt(document.getElementById("bordersize").value);
    var width   = document.getElementById("width").value + document.getElementById("widthtype").value;
    var height  = document.getElementById("height").value + document.getElementById("heighttype").value;
    var cellpd  = parseInt(document.getElementById("cellpd").value);
    var cellsp  = parseInt(document.getElementById("cellsp").value);
    var bgcolor = document.getElementById("idbgcolor").value;
    var align   = document.getElementById("talign").value;
    var bgimg   = document.getElementById("bgimg").value;
    var bordercolor = document.getElementById("idbordercolor").value;

    var table = null;

    if ((rows > 0) && (cols > 0)) {
        table = document.createElement("table");
        table.setAttribute("border", border);
        table.setAttribute("cellpadding", cols);
        table.setAttribute("cellspacing", rows);
        table.setAttribute("width", width);
        table.setAttribute("height", height);
        table.setAttribute("cellpadding", cellpd);
        table.setAttribute("cellspacing", cellsp);
        table.setAttribute("align", align);

        if (bgcolor) table.setAttribute("bgcolor", bgcolor);
        if (bordercolor) table.setAttribute("bordercolor", bordercolor);
        if (bgimg) table.setAttribute("background", bgimg);

        tbody = document.createElement("tbody");
        var ie = navigator.userAgent.toLowerCase().indexOf("msie") != -1;

        for (var i=0; i < rows; i++) {
            var tr =document.createElement("tr");
            for (var j=0; j < cols; j++) {
                var td = document.createElement("td");
                if (!ie) {
                    var br = document.createElement("br");
                    td.appendChild(br);
                }
                tr.appendChild(td);
            }
            tbody.appendChild(tr);
        }
        table.appendChild(tbody);
        eval("parent."+oEditor).insertTable(table);
    }
    popupClose();
}
function popupClose() {
    eval('parent.'+oEditor).popupWinClose();
}
//]]>
</script>
<link rel="stylesheet" type="text/css" href="dialog.css" />
</head>
<body>
<fieldset><legend><span class="normal">테이블 행/열 개수</span></legend>
<table cellspacing="0" cellpadding="4" width="100%">
  <tr>
    <td><span class="normal">행:</span>
    </td>
    <td><input type="text" size="3" name="numrows" id="numrows" value="1" />
    </td>
    <td><span class="normal">열:</span>
    </td>
    <td><input type="text" size="3" name="numcols" id="numcols" value="2" />
    </td>
  </tr>
</table>
</fieldset>
<br />
<fieldset><legend><span class="normal">테이블 속성</span></legend>
<table cellspacing="0" cellpadding="4" width="100%">
  <tr>
    <td><span class="normal">가로:</span>
    </td>
    <td><input type="text" size="3" name="width" id="width" value="100" />
    <select name="widthtype" id="widthtype">
    <option value="%" selected="selected" />퍼센트
    <option value="" />픽셀
    </select>
    </td>
    <td><span class="normal">높이:</span>
    </td>
    <td><input type="text" size="3" name="height" id="height" value="0" />
    <select name="heighttype" id="heighttype">
    <option value="%" />퍼센트
    <option value="" selected="selected" />픽셀
    </select>
    </td>
  </tr>
  <tr>
    <td><span class="normal">셀 패딩:</span>
    </td>
    <td><input type="text" size="3" name="cellpd" id="cellpd" value="0" />
    </td>
    <td><span class="normal">셀 간격:</span>
    </td>
    <td><input type="text" size="3" name="cellsp" id="cellsp" value="1" />
    </td>
  </tr>
  <tr>
    <td><span class="normal">테두리 크기:</span>
    </td>
    <td><input type="text" size="3" name="bordersize" id="bordersize" value="1" />
    </td>
    <td><span class="normal">정렬:</span>
    </td>
    <td><select id="talign" name="talign">
    <option vlaue="left" />왼쪽
    <option value="center" />가운데
    <option value="right" />오른쪽
    </select>
    </td>
  </tr>
  <tr>
    <td colspan="2"><span class="normal">테두리 색상:</span>
    </td>
    <td colspan="2">
      <input type="text" size="10" name="idbordercolor" id="idbordercolor" />
    </td>
  </tr>
  <tr>
    <td colspan="4" align="center">
      <script type="text/javascript">document.write(drawColor('bordercolor'))</script>
    </td>
  </tr>
  <tr>
    <td colspan="2"><span class="normal">테이블 바탕색:</span>
    </td>
    <td colspan="2">
      <input type="text" size="10" name="idbgcolor" id="idbgcolor" />
    </td>
  </tr>
  <tr>
    <td align="center" colspan="4">
        <script type="text/javascript">document.write(drawColor('bgcolor'))</script>
    </td>
  </tr>
  <tr>
    <td colspan="4"><span class="normal">배경 이미지 URL:</span>
      <input type="text" size="30" name="bgimg" id="bgimg" />
    </td>
  </tr>
</table>
</fieldset>
<div class="spacer"></div>
<div style="text-align:center">
<button onclick="doSubmit()" class="button8em">만들기</button>&#160;<button onclick="popupClose()" class="button8em">취소</button>
</div>
</body>
</html>
