<?
include("./_common.php");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$g4[charset]?>">
<title>���̺� �����</title>
<script language=JavaScript src="table_color.js"></script>
<script language=JavaScript>
function DoReturn()
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
        var obj = window.opener.chutil.myobj;
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
            tr =document.createElement("tr");
            for (var j=0; j < cols; j++) {
                td = document.createElement("td");
                if (!ie) {
                    br = document.createElement("br");
                    td.appendChild(br);
                }
                tr.appendChild(td);
            }
            tbody.appendChild(tr);
        }
        table.appendChild(tbody);
        eval("window.opener."+obj).insertTable(table);
    }
    window.close();
}
</script>
<style type="text/css">
body {
  background-color: #f7f5f3;
  margin: 5px;
  border: 0;
  padding: 5px;
}
.button {
  font-size: 9pt;
  padding-top: 3px;
  height: 24px;
  width: 6em;
}
img { border: 0; }
font {
  font-size: 9pt;
  font-family: ����;
}
select { font-size: 9pt; }
</style>
</head>
<body scroll="no">
<center>
<fieldset><legend><font color="blue">���̺� ��/�� ����</font></legend>
<table cellspacing="0" cellpadding="4" width="100%">
  <tr>
    <td><font>��:</font>
    </td>
    <td><input type=text size=3 name=numrows id=numrows value="1">
    </td>
    <td><font>��:</font>
    </td>
    <td><input type=text size=3 name=numcols id=numcols value="2">
    </td>
  </tr>
</table>
</fieldset>
<br>
<fieldset><legend><font color="blue">���̺� �Ӽ�</font></legend>
<table cellspacing="0" cellpadding="4" width="100%">
  <tr>
    <td><font>����:</font>
    </td>
    <td><input type=text size=3 name=width id=width value="100">
    <select id="widthtype" name="widthtype" id="widthtype">
    <option value="%" selected>�ۼ�Ʈ
    <option value="">�ȼ�
    </select>
    </td>
    <td><font>����:</font>
    </td>
    <td><input type=text size=3 name=height id=height value="0">
    <select id="heighttype" name="heighttype" id="heighttype">
    <option value="%">�ۼ�Ʈ
    <option value="" selected>�ȼ�
    </select>
    </td>
  </tr>
  <tr>
    <td><font>�� �е�:</font>
    </td>
    <td><input type=text size=3 name=cellpd id=cellpd value="0">
    </td>
    <td><font>�� ����:</font>
    </td>
    <td><input type=text size=3 name=cellsp id=cellsp value="1">
    </td>
  </tr>
  <tr>
    <td><font>�׵θ� ũ��:</font>
    </td>
    <td><input type=text size=3 name=bordersize id=bordersize value="1">
    </td>
    <td><font>����:</font>
    </td>
    <td><select id=talign name=talign>
    <option vlaue="left">����
    <option value="center">���
    <option value="right">������
    </select>
    </td>
  </tr>
  <tr>
    <td colspan="2"><font>�׵θ� ����:</font>
    </td>
    <td colspan="2">
      <input type=text size=10 name=idbordercolor id=idbordercolor>
    </td>
  </tr>
  <tr>
    <td colspan="4" align="center">
        <script>document.write(drawColor('bordercolor'))</script>
    </td>
  </tr>
  <tr>
    <td colspan="2"><font>���̺� ������:</font>
    </td>
    <td colspan="2">
      <input type=text size=10 name=idbgcolor id=idbgcolor>
    </td>
  </tr>
  <tr>
    <td align="center" colspan="4">
        <script>document.write(drawColor('bgcolor'))</script>
    </td>
  </tr>
  <tr>
    <td colspan="4"><font>��� �̹��� URL:</font>
      <input type=text size=30 name=bgimg id=bgimg>
    </td>
  </tr>
</table>
</fieldset>
<br>
<input type=button onclick="DoReturn();" class=button value="�����">
<input type=button onclick="window.close();" class=button value="���">
</center>
</body>
</html>
