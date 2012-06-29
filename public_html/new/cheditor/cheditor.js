////////////////////////////////////////////////////////////////////////
//
//                            CHEditor 2.9
//
//       Author: 나창호
//       EMail:  chna@chcode.com
//       Homepage: http://www.chcode.com
//
//       Copyright (C) 1997-2005, CHCODE. All rights reserved.
//
////////////////////////////////////////////////////////////////////////

var chutil = new CH_UTILITIES();
var command = "";
var editorPath = "";
var saveobj = ""; // 여러창에서 제어하기위한 전역변수

var htmlKey = [
	"!DOCTYPE", "A", "ABBR", "ACRONYM", "ADDRESS", "APPLET",
	"AREA", "B", "BASE", "BASEFONT", "BGSOUND", "BDO",
	"BIG", "BLINK", "DL", "BODY", "BR", "BUTTON",
	"CAPTION", "CENTER", "CITE", "CODE", "COL", "COLGROUP",
	"COMMENT", "DD", "DEL", "DFN", "DIR", "DIV",
	"FONT", "DT", "EM", "EMBED", "FIELDSET", "BLOCKQUOTE",
	"FORM", "FRAME", "FRAMESET", "H", "H1", "H2",
	"H3", "H4", "H5", "H6", "HEAD", "HR",
	"HTML", "I", "IFRAME", "IMG", "INPUT", "INS",
	"ISINDEX", "KBD", "LABEL", "LEGEND", "LI", "LINK",
	"LISTING", "MAP", "MARQUEE", "MENU", "META", "MULTICOL",
	"NEXTID", "NOBR", "NOFRAMES", "NOSCRIPT", "OBJECT", "OL",
	"OPTGROUP", "OPTION", "P", "PARAM", "PLAINTEXT","PRE",
	"Q", "S", "SAMP", "SCRIPT", "SELECT", "SERVER",
	"SMALL", "SOUND", "SPACER", "SPAN", "STRIKE", "STRONG",
	"STYLE", "SUB", "SUP", "TABLE", "TBODY", "TD",
	"TEXTAREA", "TITLE", "TFOOT", "TH", "THEAD", "TEXTFLOW",
	"TR", "TT", "U", "UL", "VAR", "WBR", "XMP"
];

var colorTable = [
	"#FF0000", "#FFFF00", "#00FF00", "#00FFFF", "#0000FF", "#FF00FF", "#FFFFFF", "#F5F5F5", "#DCDCDC", "#FFFAFA",
	"#D3D3D3", "#C0C0C0", "#A9A9A9", "#808080", "#696969", "#000000", "#2F4F4F", "#708090", "#778899", "#4682B4",
	"#4169E1", "#6495ED", "#B0C4DE", "#7B68EE", "#6A5ACD", "#483D8B", "#191970", "#000080", "#00008B", "#0000CD",
	"#1E90FF", "#00BFFF", "#87CEFA", "#87CEEB", "#ADD8E6", "#B0E0E6", "#F0FFFF", "#E0FFFF", "#AFEEEE", "#00CED1",
	"#5F9EA0", "#48D1CC", "#00FFFF", "#40E0D0", "#20B2AA", "#008B8B", "#008080", "#7FFFD4", "#66CDAA", "#8FBC8F",
	"#3CB371", "#2E8B57", "#006400", "#008000", "#228B22", "#32CD32", "#00FF00", "#7FFF00", "#7CFC00", "#ADFF2F",
	"#98FB98", "#90EE90", "#00FF7F", "#00FA9A", "#556B2F", "#6B8E23", "#808000", "#BDB76B", "#B8860B", "#DAA520",
	"#FFD700", "#F0E68C", "#EEE8AA", "#FFEBCD", "#FFE4B5", "#F5DEB3", "#FFDEAD", "#DEB887", "#D2B48C", "#BC8F8F",
	"#A0522D", "#8B4513", "#D2691E", "#CD853F", "#F4A460", "#8B0000", "#800000", "#A52A2A", "#B22222", "#CD5C5C",
	"#F08080", "#FA8072", "#E9967A", "#FFA07A", "#FF7F50", "#FF6347", "#FF8C00", "#FFA500", "#FF4500", "#DC143C",
	"#FF0000", "#FF1493", "#FF00FF", "#FF69B4", "#FFB6C1", "#FFC0CB", "#DB7093", "#C71585", "#800080", "#8B008B",
	"#9370DB", "#8A2BE2", "#4B0082", "#9400D3", "#9932CC", "#BA55D3", "#DA70D6", "#EE82EE", "#DDA0DD", "#D8BFD8",
	"#E6E6FA", "#F8F8FF", "#F0F8FF", "#F5FFFA", "#F0FFF0", "#FAFAD2", "#FFFACD", "#FFF8DC", "#FFFFE0", "#FFFFF0",
	"#FFFAF0", "#FAF0E6", "#FDF5E6", "#FAEBD7", "#FFE4C4", "#FFDAB9", "#FFEFD5", "#FFF5EE", "#FFF0F5", "#FFE4E1"
];

function CH_UTILITIES()
{
	this.oname;
}

function setIcon(icon_name, width, height, cmd)
{
	var icon = this.editorPath + '/icons/' + icon_name + ' width='+width+' height='+height+' align="absmiddle" ';
	return ("<img src="+icon+"onmouseup=\""+cmd+"\">");
}

function inside_editor(el)
{
	while (el != null) {
		if (el.tagName=="BODY" && el.contentEditable=="true")
			return true;
		el = el.parentElement;
	}
	return false;
}

function set_selection()
{
	var myobj = eval("id" + this.oname);
	this.selection = myobj.document.selection.createRange();
	this.selection_type = myobj.document.selection.type;
}

function fix_selection(oname, selection)
{
	var myobj = eval("id" + oname);

	if(selection.parentElement != null) {
		if(!inside_editor(selection.parentElement())) {
			myobj.focus();
			var selection = myobj.document.selection.createRange();
		}
	}
	else {
		if(!inside_editor(selection.item(0))) {
			myobj.focus();
			var selection = myobj.document.selection.createRange();
		}
	}

	return selection;
}

function fix_selection_type(oname, selection, selection_type)
{
	var myobj = eval("id" + oname);

	if (selection.parentElement != null) {
		if (!inside_editor(selection.parentElement())) {
			myobj.focus();
			var selection_type = myobj.document.selection.type;
		}
	}
	else {
		if (!inside_editor(selection.item(0))) {
			myobj.focus();
			var selectoin_type = myobj.document.selection.type;
		}
	}
	return selection_type;
}

function exec(exec, opt)
{
	var myobj = eval("id" + this.oname);
	var target;
	var selection;
	if (this.IE) {
		selection = myobj.document.selection.createRange();
		var selection_type = myobj.document.selection.type;
		var oname = this.oname;

		selection = fix_selection(oname, selection);
		selection_type = fix_selection_type(oname, selection, selection_type);

		var target = (selection_type == "None" ? myobj.document : selection);
	}
	else {
		target = myobj.document;
	}

	myobj.focus();
	target.execCommand(exec, false, opt);
}

function exec2(exec, opt)
{
	var myobj = eval("id" + this.oname);
	var selection = this.selection;
	var selection_type = this.selection_type;
	var oname = this.oname;

	selection = fix_selection(oname, selection);
	selection_type = fix_selection_type(oname, selection, selection_type);

	var target = (selection_type == "None" ? myobj.document : selection);
	selection.select();
	myobj.focus();
	target.execCommand(exec, false, opt);
}

function exec3(html)
{
	this.box_hide();

	var myobj = eval("id" + this.oname);
	myobj.focus();

	var select = myobj.document.selection.createRange();
	select.pasteHTML(html);
}

function hyperLink (szURL, szTarget, szTitle)
{
	var myobj = eval("id" + this.oname);
	var el;

	if (this.IE) {
		var sel = this.selection;
		var sel_type = this.selection_type;
		var oname = this.oname;

		sel = fix_selection(oname, sel);
		sel_type = fix_selection_type(oname, sel, sel_type);

		var target = (sel_type == "None" ? myobj.document : sel);
		sel.select();

		target.execCommand("UnLink", false);
		target.execCommand("CreateLink", false, szURL);
	}
	else {
		var sel = document.getElementById("id"+this.oname).contentWindow.getSelection();

		if (typeof sel != "undefined") {
			range = sel.getRangeAt(0);
		}
		else {
			range = document.getElementById("id"+this.oname).document.createRange();
		}

		document.getElementById("id"+this.oname).contentDocument.execCommand("CreateLink", false, szURL);
	}

	if (this.IE) {
		el = sel.parentElement ? sel.parentElement() : get_element(sel.item(0),"A");
	}
	else {
		el = range.startContainer.previousSibling;
	}

	if (el) {
		if (szTarget) el.target = szTarget;
		if (szTitle) el.title = szTitle;
	}
}

function showColor (val, obj)
{
	val.style.backgroundColor = obj.style.backgroundColor;
	val.innerText = obj.style.backgroundColor;
}

function SetForeColor (obj)
{
	for (var i = 0; i < parent.frames.length; i++) {
		if (parent.frames(i).name == window.name) {
			eval("parent.frames." + window.name + "." +
				 forecolor.document.body.document.all.CHEditor.value).exec2("ForeColor",obj.style.backgroundColor);

			return;
		}
	}
	eval("parent." + forecolor.document.body.document.all.CHEditor.value).exec2("ForeColor",obj.style.backgroundColor);
}

function dimension(boxName)
{
	var tblPopup = document.frames(boxName).document.body.document.all("tblPopup");
	eval("document.all."+boxName).style.width = tblPopup.offsetWidth;
	eval("document.all."+boxName).style.height = tblPopup.offsetHeight;
}

function box_position(boxName)
{
	var tblPopup = document.frames(boxName).document.body.document.all("tblPopup");
	var editarea = eval("editwin" + this.oname);

	myTop = 0;
	stmp = "";

	while (eval("editwin"+ this.oname + stmp).tagName!="BODY") {
		myTop += eval("editwin"+ this.oname + stmp).offsetTop;
		stmp += ".offsetParent";
	}

	myLeft = 0;
	stmp = "";

	while (eval("editwin"+ this.oname + stmp).tagName!="BODY") {
		myLeft += eval("editwin"+ this.oname + stmp).offsetLeft;
		stmp += ".offsetParent";
	}

	if (editarea.offsetHeight-tblPopup.offsetHeight > 0)
		eval("document.all."+boxName).style.pixelTop=(myTop + (editarea.offsetHeight-tblPopup.offsetHeight)/2);
	else
		eval("document.all."+boxName).style.pixelTop=(myTop + (editarea.offsetHeight-tblPopup.offsetHeight)/2);

	if (editarea.offsetWidth-tblPopup.offsetWidth > 0)
		eval("document.all."+boxName).style.pixelLeft=(myLeft + (editarea.offsetWidth-tblPopup.offsetWidth)/2);
	else
		eval("document.all."+boxName).style.pixelLeft=myLeft;
}

function displayWindow (boxName)
{
	this.box_hide();
	this.set_selection();

	eval(boxName).document.body.document.all.CHEditor.innerText = this.oname;

	this.dimension(boxName);
	this.box_position(boxName);

	eval("document.all."+boxName).style.zIndex = 2;
	eval("document.all."+boxName).style.visibility = "";
	eval("document.all."+boxName).focus();
}

function windowPos(idImg, boxName)
{
	myTop = 0;
	stmp = "";

	while (eval("idImg" + stmp).tagName!="BODY") {
		stmp += ".offsetParent";
		myTop += eval("idImg" + stmp).offsetTop;
	}

	//myTop = myTop + 27;
	myTop = get_top_pos(eval("idImg"));
	myLeft = 0;
	stmp = "";

	while (eval("idImg" + stmp).tagName!="BODY") {
		stmp += ".offsetParent";
		myLeft += eval("idImg" + stmp).offsetLeft;
	}

	myLeft = myLeft + 0;

	eval("document.all."+boxName).style.pixelLeft = myLeft;
	eval("document.all."+boxName).style.pixelTop = myTop;
}

function windowPos2(id, boxName, left)
{
	var myTop  = get_top_pos(document.getElementById(id));
	var myLeft = get_left_pos(document.getElementById(id)) + left; 

	eval("document.all."+boxName).style.pixelTop = myTop;
	eval("document.all."+boxName).style.pixelLeft = myLeft;
}

function box_hide()
{
	document.all.paragraph.style.visibility         = "hidden";
	document.all.fontType.style.visibility          = "hidden";
	//document.all.fontSize.style.visibility          = "hidden";
	//document.all.backcolor.style.visibility         = "hidden";
	//document.all.forecolor.style.visibility         = "hidden";
	document.all.horizontalRule.style.visibility    = "hidden";
	document.all.zoom.style.visibility              = "hidden";
}

function mouse_over(el)
{
	el.style.background = this.selection_color;
	el.style.color = "white";
}

function mouse_out(el)
{
	el.style.background = "";
	el.style.color = "black";
}

function SetBackColor (obj)
{
	for (var i = 0; i < parent.frames.length; i++) {
		if (parent.frames(i).name == window.name) {
			eval("parent.frames."+window.name+"." +
				backcolor.document.body.document.all.CHEditor.value).exec2("BackColor",obj.style.backgroundColor);
			return;
		}
	}
	eval("parent." +
		backcolor.document.body.document.all.CHEditor.value).exec2("BackColor",obj.style.backgroundColor);
}

function SetColorTable (what)
{
	var strCap = '<table cellpadding=0 cellspacing=0 width=100% border=0 bgcolor=#f0f0f0>'+
		'<tr><td align=right bgcolor=#dedfdf>'+
		'<img src='+this.editorPath+'/icons/close.gif width=13 height=13 align=absmiddle '+
		'onClick="parent.box_hide();">&nbsp;'+
		'</td></tr>' +
		'<table cellpadding=1 cellspacing=5 border=1 bordercolor=#666666 style="cursor: '+
		'hand;font-family: Verdana; font-size: 7px; BORDER-LEFT: buttonhighlight 0px solid;'+
		'BORDER-RIGHT: buttonshadow 2px solid; BORDER-TOP: buttonhighlight 0px solid;'+
		'BORDER-BOTTOM: buttonshadow 0px solid;" bgcolor=#f0f0f0>'+
		'<tr><td colspan="10" id=color style="height=20px;font-family: verdana; font-size:12px; text-align:center">&nbsp;'+
		'</td></tr>';

	var colorRows = [strCap];
	var k = 0;
	var w = 14;
	var h = 10;
	var cmd = (what == 'back') ? 'SetBackColor(color)' : 'SetForeColor(color)';

	for (var i = 0; i < w; i++) {
		colorRows[colorRows.length] = "<tr>";
		for (var j = 0; j < h; j++) {
			colorRows[colorRows.length] = '<td onMouseOver="parent.showColor(color,this)" '+
				'onClick="parent.'+cmd+'" style="background-color:'+colorTable[k]+';"width=12px">&nbsp;</td>';
			k++;
		}
		colorRows[colorRows.length] = "</tr>";
	}

	colorRows[colorRows.length] =
		'<tr><td colspan="10" style="height=15px;font-size:9pt; text-align:center" '+
		'onMouseOver="parent.showColor(color,this)" onClick="parent.'+cmd+'">없음</td></tr>'+
		'</table>';

	return colorRows.join("\n");
}

function createWindow(width, content)
{
	var htmlOutput = "" +
		"<style>" +
		"body {border:lightgrey 0px solid;background: white; font-family:굴림}" +
		".dropdown {cursor:hand}" +
		"</style>" +
		"<body topmargin=0 leftmargin=0 rightmargin=0 bottommargin=0 onselectstart=\"return event.srcElement.tagName=='INPUT'\" oncontextmenu='return false'>" +
		"<table border=0 cellpadding=1 cellspacing=0 style='table-layout:fixed;border-right:#c3c3c3 1 solid;border-bottom:#c3c3c3 1 solid;border-left:#aeaeae 1 solid;border-top:#aeaeae 1 solid;' ID=tblPopup>" +
		"<col width="+width+">" +
		"<tr>" +
		"<td>" +
		content +
		"</td>" +
		"</tr>" +
		"</table>" +
		"<input type=text style='display:none;' id='CHEditor' name='CHEditor' contentEditable=true>" +
		"</body>";
	return htmlOutput;
}

function applyParagraph(val)
{
	for (var i = 0; i < parent.frames.length; i++) {
		if (parent.frames(i).name == window.name) {
			eval("parent.frames."+window.name+"." +
				paragraph.document.body.document.all.CHEditor.value).exec2("FormatBlock",val);
			return;
		}
	}
	eval("parent." + paragraph.document.body.document.all.CHEditor.value).exec2("FormatBlock",val);
}

function changeFontType(val)
{
	for (var i = 0; i < parent.frames.length; i++) {
		if (parent.frames(i).name == window.name) {
			eval("parent.frames."+window.name+"." +
				fontType.document.body.document.all.CHEditor.value).exec2("fontName",val);
			return;
		}
	}

	eval("parent." + fontType.document.body.document.all.CHEditor.value).exec2("fontName",val);
}

function changeSize(val)
{
	for (var i = 0; i < parent.frames.length; i++) {
		if (parent.frames(i).name == window.name) {
			eval("parent.frames."+window.name+"." +
				fontSize.document.body.document.all.CHEditor.value).exec2("fontsize",val);
			return;
		}
	}

	eval("parent." + fontSize.document.body.document.all.CHEditor.value).exec2("fontsize",val);
}

function setDisplayMode()
{
	this.box_hide();
	this.set_selection();

	var oname = chutil.oname;
	var editor = eval("id"+this.oname);

	if (this.Preview) {
		if (document.getElementById("chkPreviewMode"+this.oname).checked) {
			document.getElementById("chkPreviewMode"+this.oname).checked = false;
			this.displayMode = 'RICH';
		}
	}

	if (this.displayMode=='RICH') {
		var tmp = this.get_content();
		var key = this.htmlKey.join ("|");
		var reg = new RegExp ("(&lt;\/?)(" + key + ")(&gt;)", "ig");
		var reg2 = new RegExp ("(&lt;)(" + key + ") (.+?)(&gt;)", "ig");

		editor.document.body.innerText = tmp;
		var content = editor.document.body.innerHTML;
		content = content.replace (/&lt;META(.+?)&gt;/ig, "&lt;META content=\"CHEDITOR 2.9\" name=GENERATOR&gt;");
		content = content.replace (/(&lt;\/?)P(&gt;)/ig, "$1DIV$2");
		content = content.replace (/&lt;link href=(.*?)&gt;/ig, '');
		content = content.replace (/(&lt;)P(&gt;)/ig, '');

		// 공백이 들어가는것을 수정 <DIV>&nbsp;</DIV> -> <DIV></DIV> 061012
		//content = content.replace (/(&gt;)&amp;nbsp\;(&lt;)/ig, '$1$2');

		content = content.replace (reg, "<font color=#0000ff>$1$2$3</font>");
		content = content.replace (reg2, "<font color=#0000ff>$1$2</font> $3<font color=#0000ff>$4</font>");

		editor.document.body.innerHTML = content;
		editor.document.body.clearAttributes;
		editor.document.body.style.fontFamily = 'Verdana';
		editor.document.body.style.fontSize = '9pt';
		editor.document.body.style.lineHeight = '120%';
		editor.document.body.style.color = '#000000';
		editor.document.body.style.background = '#ffffff';
		editor.document.body.contentEditable = true;
		editor.document.body.focus();

		this.displayMode = 'HTML';
		eval("idToolbar"+this.oname).style.display = "none";
	}
	else {
		this.put_content(editor.document.body.innerText);
		this.displayMode = 'RICH';
		eval("idToolbar"+this.oname).style.display = "block";
		var el = editor.document.createElement("<link rel='stylesheet' type='text/css' href='"+this.editorPath+"/default.css'>");
		editor.document.childNodes[0].childNodes[0].appendChild(el);
		editor.document.body.focus();
	}
}

function previewMode()
{
	this.box_hide();
	this.set_selection();

	var editor = eval("id"+this.oname);

	if (this.ViewHTML) {
		if (document.getElementById("chkDisplayMode"+this.oname).checked) {
			this.put_content(editor.document.body.innerText);
			this.displayMode = 'RICH';

			var el = editor.document.createElement("<link rel='stylesheet' type='text/css' href='"+this.editorPath+"/default.css'>");
			editor.document.childNodes[0].childNodes[0].appendChild(el);

			eval("idToolbar"+this.oname).style.display = "block";
			editor.document.body.focus();
			document.getElementById("chkDisplayMode"+this.oname).checked = false;
		}
	}

	if (this.displayMode=='RICH') {
		var content = editor.document.body.innerHTML;
		editor.document.body.innerHTML = content;
		editor.document.body.contentEditable = false;
		editor.document.body.focus();
		this.displayMode = 'HTML';
		eval("idToolbar"+this.oname).style.display = "none";
	}
	else {
		var tmp = this.get_content();
		editor.document.body.innerText = tmp;
		this.put_content(editor.document.body.innerText);
		this.displayMode = 'RICH';
		eval("idToolbar"+this.oname).style.display = "block";
		editor.document.body.focus();
	}
}

function returnFalse()
{
	var editor = eval("id"+this.oname);
	var tmp = this.get_content();

	editor.document.body.innerText = tmp;
	this.put_content(editor.document.body.innerText);
	this.displayMode = 'RICH';
	eval("idToolbar"+this.oname).style.display = "block";
	editor.document.body.focus();

	return false;
}

function get_content()
{
	var myobj = eval("id"+this.oname);

	myobj.document.body.style.border = "";
	//myobj.document.body.removeAttribute("contentEditable", 0);
	var el = myobj.document.documentElement;

	var mydoc = this.IE ? el.outerHTML : el.innerHTML;

	mydoc = mydoc.replace("BORDER-RIGHT: medium none; ", "");
	mydoc = mydoc.replace("BORDER-TOP: medium none; ", "");
	mydoc = mydoc.replace("BORDER-BOTTOM: medium none; ", "");
	mydoc = mydoc.replace("BORDER-LEFT: medium none; ", "");
	mydoc = mydoc.replace("BORDER-RIGHT: medium none", "");
	mydoc = mydoc.replace("BORDER-TOP: medium none", "");
	mydoc = mydoc.replace("BORDER-BOTTOM: medium none", "");
	mydoc = mydoc.replace("BORDER-LEFT: medium none", "");
	mydoc = mydoc.replace(" style=\"\"", "");

	return mydoc;
}

function outputBodyHTML()
{
	var str = this.outputHTML();
	var spl = this.IE ? "BODY" : "body";
	str = str.substr(str.indexOf("<"+spl) + 1);
	str = str.substr(str.indexOf(">") + 1);
	var tmp = str.split("</"+spl+">");
	str = tmp[0];
	
	// 공백이 들어가는것을 수정 <DIV>&nbsp;</DIV> -> <DIV></DIV> 061012
	//str = str.replace (/(\>)\&nbsp\;(\<)/ig, '$1$2');
	str = str.replace (/(\<DIV\>\&nbsp\;\<\/DIV\>)$/ig, '');
	//str = str.replace (/^(\&nbsp\;)$/ig, '');

	return str;
}

function outputHTML()
{
	var chkViewHtml = document.getElementById("chkDisplayMode"+this.oname);

	if (chkViewHtml != null && chkViewHtml.checked) {
		var editor = eval("id"+this.oname);
		this.put_content(editor.document.body.innerText);
	}

	var mydoc = this.get_content();
	mydoc = mydoc.replace (/<link href=(.*?)>/ig, '');
	mydoc = mydoc.replace (/(<\/?)P>/ig, "$1DIV>");
	return mydoc;
}

function put_content(sContent)
{
	var editor = eval("id"+this.oname);
	var editorTmp = eval("idtmp"+this.oname);

	var doc = editorTmp.document.open("text/html", "replace");
	doc.write(sContent);
	doc.close();

	var doc = editor.document.open("text/html", "replace");
	doc.write(editorTmp.document.documentElement.outerHTML);
	doc.close();

	editor.document.body.style.border = "";
	editor.document.body.contentEditable = true;
	//editor.document.body.oncontextmenu = returnFalse;

	editor.document.execCommand("2D-Position", true, true);
	editor.document.execCommand("MultipleSelection", true, true);
	editor.document.execCommand("LiveResize", true, true);
}

function insert (what)
{
	saveobj = this.oname;
	var myobj = eval("id" + this.oname);
	var tmpl;
	var w;
	var h;
	var scroll = 0;

	myobj.focus();

	if (this.IE) this.set_selection();

	switch (what) {
	case "forecolor" :
		tmpl = "gecko_forecolor.php";
		h = 240;
		w = 250;
		break;
	case "hilitecolor" :
		tmpl = "gecko_hilitecolor.php";
		h = 240;
		w = 250;
		break;
	case"backcolor" :
		tmpl = "gecko_backcolor.php";
		h = 240;
		w = 250;
		break;
	case "image" :
		tmpl = "insert_image.php";
		h = this.IE ? 615 : 650;
		w = 430;
		break;
	case "media" :
		tmpl = "insert_media.php";
		h = 480;
		w = 430;
		scroll = 1;
		break;
	case "bgimage" :
		tmpl = "insert_bgimage.php";
		h = this.IE ? 220 : 240;
		w = 430;
		break;
	case "table" :
		tmpl = "insert_table.php";
		h = this.IE ? 480 : 500;
		w = 430;
		break;
	case "hlink" :
		tmpl = "insert_hlink.php";
		h = this.IE ? 160 : 180;
		w = this.IE ? 450 : 500;
		break;
	case "em" :
		tmpl = "insert_emicon.php";
		h = this.IE ? 235 : 250;
		w = 400;
		break;
	default:
		return;
	}

	tmpl = this.editorPath + '/' + tmpl;

	var left = (screen.width-w)/2;
	var top = (screen.height-h)/2;

	window.open(tmpl, "new_window",
				"toolbar=no,menubar=no,personalbar=no,height="+h+",width="+w+"," +
				"left="+left+",top="+top+",scrollbars=yes,resizable=no");
}

function insertIE (what)
{
	var myobj = eval("id" + this.oname);
	var tmpl;

	myobj.focus();
	this.set_selection();

	switch(what) {
	case "schar":
		tmpl = "insert_schar.php";
		attr = "dialogHeight: 240px; dialogWidth: 600px; help:no; status:no";
		break;
//    case "em":
//        tmpl = "insert_emicon.php";
//        attr = "dialogHeight: 270px; dialogWidth: 400px; help:no; status:no";
//        break;
	}

	tmpl = this.editorPath + '/' + tmpl;

	var el = showModalDialog(tmpl, this, attr);

	if (el) {
		var selection = myobj.document.selection.createRange();
		selection.parentElement ? selection.pasteHTML(el) : selection.item(0).outerHTML = el;
	}
}


function SetGeckoColor(cmd, colour)
{
	//document.getElementById("id"+myobj).contentWindow.document.execCommand(cmd, false, colour);
	document.getElementById("id"+saveobj).contentWindow.document.execCommand(cmd, false, colour);
}

function insertTable(insertNode)
{
	if (this.IE) {
		var editor = eval("id"+this.oname);
		var sel = editor.document.selection.createRange();
		sel.pasteHTML(insertNode.outerHTML);
	}
	else {
		var sel = document.getElementById("id"+this.oname).contentWindow.getSelection();
		var range = sel.getRangeAt(0);

		sel.removeAllRanges();
		range.deleteContents();

		var container = range.startContainer;
		var pos = range.startOffset;

		range = document.createRange();

		if (container.nodeType==3 && insertNode.nodeType==3) {
			container.insertData(pos, insertNode.nodeValue);

			range.setEnd(container, pos+insertNode.length);
			range.setStart(container, pos+insertNode.length);
		}
		else {
			var afterNode;
			if (container.nodeType==3) {
				var textNode = container;
				container = textNode.parentNode;
				var text = textNode.nodeValue;
				var textBefore = text.substr(0,pos);
				var textAfter = text.substr(pos);
				var beforeNode = document.createTextNode(textBefore);
				var afterNode = document.createTextNode(textAfter);

				container.insertBefore(afterNode, textNode);
				container.insertBefore(insertNode, afterNode);
				container.insertBefore(beforeNode, insertNode);
				container.removeChild(textNode);
			}
			else {
				afterNode = container.childNodes[pos];
				container.insertBefore(insertNode, afterNode);
			}

			range.setEnd(afterNode, 0);
			range.setStart(afterNode, 0);
		}
		sel.addRange(range);
	}
}

function insertImage (img)
{
	var myobj = eval("id" + this.oname);

	if (this.IE) {
		var sel = this.selection;
		var sel_type = this.selection_type;
		var oname = this.oname;

		sel = fix_selection(oname, sel);
		sel_type = fix_selection_type(oname, sel, sel_type);

		var target = (sel_type == "None" ? myobj.document : sel);
		sel.select();

		target.execCommand("InsertImage", false, img.src);
	}
	else {
		var sel = document.getElementById("id"+this.oname).contentWindow.getSelection();

		if (typeof sel != "undefined") {
			range = sel.getRangeAt(0);
		}
		else {
			range = document.getElementById("id"+this.oname).document.createRange();
		}
		document.getElementById("id"+this.oname).contentDocument.execCommand("InsertImage", false, img.src);
	}

	var tmpImg = null;

	if (this.IE) {
		tmpImg = sel.parentElement();
		if (tmpImg.tagName.toLowerCase() != "img") {
			tmpImg = tmpImg.previousSibling;
		}
	}
	else {
		tmpImg = range.startContainer.previousSibling;
	}

	if (img.border) tmpImg.border = parseInt(img.border);
	if (img.hspace) tmpImg.hspace = parseInt(img.hspace);
	if (img.vspace) tmpImg.vspace = parseInt(img.vspace);
	if (img.width)  tmpImg.style.width  = parseInt(img.width);
	if (img.height) tmpImg.style.height = parseInt(img.height);
	if (img.alt)    tmpImg.alt    = img.alt;
	if (img.align)  tmpImg.align  = img.align;

	this.setImages.push(img.src.toLowerCase());
}

function getImages()
{
	var x = eval("id"+this.oname).document.body.getElementsByTagName('img');
	var rdata = new Array;

	for (var i=0; i < this.setImages.length; i++) {
		for (var j=0; j < x.length; j++) {
			if (x[j].src != undefined && x[j].src.toLowerCase() == this.setImages[i]) {
				var tmpImg = x[j].src;
				tmpImg = tmpImg.replace(/.*\/([^\/]+)$/g, "$1");
				rdata.push(tmpImg + " " + x[j].width + " " + x[j].height);
			}
		}
	}

	return(rdata.join(","));
}

function insertEl (c)
{
	var editor = eval("id"+this.oname);
	if (this.IE) {
		var sel = editor.document.selection.createRange();
		sel.pasteHTML(c);
	} else {
		var sel = document.getElementById("id"+this.oname).contentWindow.getSelection();
		document.getElementById("id"+this.oname).contentDocument.execCommand("insertHTML", false, c);        
	}
}

function insertBgImage (img)
{
	var editor = eval("id"+this.oname);

	if (img) {
		img = this.editorPath + '/' + img;
		editor.document.body.style.backgroundImage = "url("+img+")";
	}
	else {
		var s = editor.document.body.style;
		this.IE ? s.removeAttribute("backgroundImage") : s.backgroundImage = "none";
	}
}

function setBackgroundColor()
{
	var oname  = chutil.myobj;
	var editor = eval("id"+oname);
	var color  = editor.document.body.style.backgroundColor;
	var tmpl = this.editorPath + "/insert_colorpicker.php";

	if (!color)
		editor.document.body.bgcolor;

	var arr = showModalDialog (
		tmpl,             
		{
			change  : changeBackgroundColor,
			color   : color,
			editor  : editor
		},
		"dialogWidth:470px; dialogHeight:340px; center:yes; help:no; status:no"
	);

	editor.focus();
}

function changeBackgroundColor (s, editor) {
	editor.document.body.style.backgroundColor = s;
}

function insertHR (width, size, color, opt)
{
	var w = width ? width : "100%";
	var s = size    ? size  : 1;
	var c = color ? color : 0;

	var hr = "<hr width="+w+" size="+s;

	if (c)      hr += " color="+c;
	if (opt)    hr += " noshade";

	hr += ">";

	for (var i = 0; i < parent.frames.length; i++) {
		if (parent.frames(i).name == window.name) {
			eval("parent.frames."+window.name+"." +
				horizontalRule.document.body.document.all.CHEditor.value).exec3(hr);
			return;
		}
	}
	eval("parent." + horizontalRule.document.body.document.all.CHEditor.value).exec3(hr);
}

function viewZoom(val)
{
	for (var i=0; i < parent.frames.length; i++) {
		if (parent.frames(i).name == window.name) {
			eval("parent.frames."+window.name+"." +
				zoom.document.body.document.all.CHEditor.value).box_hide();
			var editor = eval("id"+zoom.document.body.document.all.CHEditor.value);
			editor.document.body.style.zoom = val;
			return;
		}
	}

	eval("parent." + zoom.document.body.document.all.CHEditor.value).box_hide();
	var editor = eval("id"+zoom.document.body.document.all.CHEditor.value);
	editor.document.body.style.zoom = val;
}

function get_element(elm, tag)
{
	while (elm != null && elm.tagName != tag) {
		if (elm.id == "id"+this.oName)
			return null;

		elm = elm.parentElement;
	}
	return elm;
}

function run ()
{
	myobj        = this.oname;
	obj          = eval(myobj);
	chutil.myobj = myobj;

	document.write("<table width='"+this.width+"' height='"+this.height+"' border=0 cellpadding=0 cellspacing=0><tr><td>");

	// 메뉴 버튼 출력: 시작 *****/
	document.write("<table cellpadding=0 cellspacing=0 width=100% id='idToolbar"+myobj+"'style=\""+this.editorToolbar+"\">");
	document.write("<tr><td><table width=100% cellpadding=0 cellspacing=0><tr><td>");
	document.write("<table width=100% cellpadding=1 cellspacing=0>");
	document.write("<tr>");
	/*
	document.write("<span title='실행 취소' style='cursor:pointer;'>" + obj.setIcon("undo.gif", 20, 20, myobj + ".exec('Undo',false)") + "</span>");
	document.write("<span title='되살리기' style='cursor:pointer;'>" + obj.setIcon("redo.gif", 20, 20, myobj + ".exec('Redo',false)") + "</span>");
	document.write("<span title='자르기' style='cursor:pointer;'>" + obj.setIcon("cut.gif", 20, 20, myobj + ".exec('Cut',false)") + "</span>");
	document.write("<span title='복사' style='cursor:pointer;'>" + obj.setIcon("copy.gif", 20, 20, myobj + ".exec('Copy',false)") + "</span>");
	document.write("<span title='붙이기' style='cursor:pointer;'>" + obj.setIcon("paste.gif", 20, 20, myobj + ".exec('Paste',false)") + "</span>");
	document.write("<span title='전체 선택' style='cursor:pointer;'>" + obj.setIcon("selectall.gif", 20, 20, myobj + ".exec('SelectAll',false)") + "</span>");
	*/
	document.write("<span title='속성 제거' style='cursor:pointer;'>" + obj.setIcon("removeformat.gif", 20, 20, myobj + ".exec('RemoveFormat',false)") + "</span>");
	document.write("<span title='굵게' style='cursor:pointer;'>" + obj.setIcon("bold.gif", 20, 20, myobj + ".exec('Bold',false)") + "</span>");
	document.write("<span title='기울기' style='cursor:pointer;'>" + obj.setIcon("italic.gif", 20, 20, myobj + ".exec('Italic',false)") + "</span>");
	document.write("<span title='밑줄' style='cursor:pointer;'>" + obj.setIcon("underline.gif", 20, 20, myobj + ".exec('Underline',false)") + "</span>");
	document.write("<span title='가운데줄' style='cursor:pointer;'>" + obj.setIcon("strike.gif", 20, 20, myobj + ".exec('Strikethrough',false)") + "</span>");
	/*
	document.write("<span title='위첨자' style='cursor:pointer;'>" + obj.setIcon("superscript.gif", 20, 20, myobj + ".exec('Superscript',false)") + "</span>");
	document.write("<span title='아래첨자' style='cursor:pointer;'>" + obj.setIcon("subscript.gif", 20, 20, myobj + ".exec('Subscript',false)") + "</span>");
	*/
	document.write("<span title='왼쪽 정렬' style='cursor:pointer;'>" + obj.setIcon("justifyleft.gif", 20, 20, myobj + ".exec('JustifyLeft',false)") + "</span>");
	document.write("<span title='가운데 정렬' style='cursor:pointer;'>" + obj.setIcon("justifycenter.gif", 20, 20, myobj + ".exec('JustifyCenter',false)") + "</span>");
	document.write("<span title='오른쪽 정렬' style='cursor:pointer;'>" + obj.setIcon("justifyright.gif", 20, 20, myobj + ".exec('JustifyRight',false)") + "</span>");
	document.write("<span title='양쪽 정렬' style='cursor:pointer;'>" + obj.setIcon("justifyfull.gif", 20, 20, myobj + ".exec('JustifyFull',false)") + "</span>");

	document.write("<span title='숫자 목록' style='cursor:pointer;'>" + obj.setIcon("orderedlist.gif", 20, 20, myobj + ".exec('InsertOrderedList',false)") + "</span>");
	document.write("<span title='점 목록' style='cursor:pointer;'>" + obj.setIcon("unorderedlist.gif", 20, 20, myobj + ".exec('InsertUnorderedList',false)") + "</span>");
	document.write("<span title='들여쓰기' style='cursor:pointer;'>" + obj.setIcon("indent.gif", 20, 20, myobj + ".exec('Indent',false)") + "</span>");
	document.write("<span title='내어쓰기' style='cursor:pointer;'>" + obj.setIcon("outdent.gif", 20, 20, myobj + ".exec('Outdent',false)") + "</span>");

	document.write("<span title='링크넣기' style='cursor:pointer;'>" + obj.setIcon("link.gif", 20, 20, myobj + ".insert('hlink')") + "</span>");
	document.write("<span title='링크삭제' style='cursor:pointer;'>" + obj.setIcon("unlink.gif", 20, 20, myobj + ".exec('UnLink',false)") + "</span>");
	document.write("<span title='미디어' style='cursor:pointer;'>" + obj.setIcon("media.gif", 20, 20, myobj + ".insert('media')") + "</span>");
	document.write("<span title='그림넣기' style='cursor:pointer;'>" + obj.setIcon("image.gif", 20, 20, myobj + ".insert('image')") + "</span>");
	document.write("<span title='테이블 만들기' style='cursor:pointer;'>" + obj.setIcon("table.gif", 20, 20, myobj + ".insert('table')") + "</span>");
	document.write("<span title='표정 아이콘' style='cursor:pointer;'>" + obj.setIcon("em.gif", 20, 20, myobj + ".insert('em')") + "</span>");

	//document.write("<span title='가로선' style='cursor:pointer;'>" + obj.setIcon("hr.gif", 20, 20, myobj + ".exec('InsertHorizontalRule',false)") + "</span>");
	document.write("<span title='글자색' style='cursor:pointer;'>" + obj.setIcon("forecolor.gif", 20, 20, myobj + ".insert('forecolor')") + "</span>");

	if (this.IE) {
		/*
		document.write("<span title='특수 문자' style='cursor:pointer;'>" + obj.setIcon("schar.gif", 20, 20, myobj + ".insertIE('schar')") + "</span>");
		document.write("<span title='가로선' style='cursor:pointer;' id='hr'>" + obj.setIcon("hr.gif", 20, 20, myobj + ".displayWindow('horizontalRule');windowPos2('hr','horizontalRule',-100)",false) + "</span>");
		document.write("<span title='글자색' style='cursor:pointer;' id='forecolor'>" + obj.setIcon("forecolor.gif", 20, 20, myobj + ".displayWindow('forecolor');windowPos2('forecolor','forecolor',-100)",false) + "</span>");
		document.write("<span title='배경색' style='cursor:pointer;' id='backcolor'>" + obj.setIcon("backcolor.gif", 20, 20, myobj + ".displayWindow('backcolor');windowPos('backcolor','backcolor',-100)",false) + "</span>");
		document.write("<span title='제목 유형' style='cursor:pointer;'>" + obj.setIcon("paragraph.gif", 53, 26, myobj + ".displayWindow('paragraph');windowPos(this,'paragraph')",false) + "</span>");
		document.write("<span title='글꼴 유형' style='cursor:pointer;'>" + obj.setIcon("fonttype.gif", 53, 26, myobj + ".displayWindow('fontType');windowPos(this,'fontType')",false) + "</span>");
		document.write("<span title='글자 크기' style='cursor:pointer;'>" + obj.setIcon("fontsize.gif", 53, 26, myobj + ".displayWindow('fontSize');windowPos(this,'fontSize')",false) + "</span>");
		*/
		document.write("<span title='배경색' style='cursor:pointer;'>" + obj.setIcon("backcolor.gif", 20, 20, myobj + ".insert('backcolor')") + "</span>");
	}
	else {
		document.write("<span title='배경색' style='cursor:pointer;'>" + obj.setIcon("backcolor.gif", 20, 20, myobj + ".insert('hilitecolor')") + "</span>");

		/*
		document.write("<span title='제목 유형' style='cursor:pointer;'><select style='font-size:9pt' id='formatblock' onchange='"+myobj+".exec(\"FormatBlock\", this.options[selectedIndex].value)'>" +
					 "<option value='<p>'>보통</option>" +
					 "<option value='<h1>'>제목 1</option>" +
					 "<option value='<h2>'>제목 2</option>" +
					 "<option value='<h3>'>제목 3</option>" +
					 "<option value='<h4>'>제목 4</option>" +
					 "<option value='<h5>'>제목 5</option>" +
					 "<option value='<h6>'>제목 6</option>" +
					 "<option value='<address>'>주소</option>" +
					 "<option value='<pre>'>PRE</option>" +
					 "</select></span>");
		*/
	}

	document.write("<select style='font-size:9pt' id='fontname' onchange='"+myobj+".exec(\"fontname\", this.options[selectedIndex].value)'>" +
				 "<option value='굴림' selected>굴림</option>" +
				 "<option value='돋움'>돋움</option>" +
				 "<option value='바탕'>바탕</option>" +
				 "<option value='궁서'>궁서</option>" +
				 "<option value='Arial'>Arial</option>" +
				 "<option value='Arial Black'>Arial Black</option>" +
				 "<option value='Tahoma'>Tahoma</option>" +
				 "<option value='Courier'>Courier</option>" +
				 "<option value='Times New Roman'>Times New</option>" +
				 "<option value='Verdana'>Verdana</option>" +
				"</select>");

	document.write("<select style='font-size:9pt' id='fontsize' onchange='"+myobj+".exec(\"fontsize\", this.options[selectedIndex].value)'>" +
				 "<option value='1'>크기 1</option>" +
				 "<option value='2' selected>크기 2</option>" +
				 "<option value='3'>크기 3</option>" +
				 "<option value='4'>크기 4</option>" +
				 "<option value='5'>크기 5</option>" +
				 "<option value='6'>크기 6</option>" +
				 "<option value='7'>크기 7</option>" +
				"</select>");

	//document.write("<span title='인쇄' style='cursor:pointer;'>" + obj.setIcon("print.gif", 20, 20, myobj + ".exec('Print',false)") + "</span>");
	document.write("</tr></table></td></tr></table></td></tr></table></td></tr><tr><td height='100%'>");
	// 메뉴 버튼 출력: 끝 *****/

	document.write("<table name='editwin"+myobj+"' id='editwin"+myobj+"' cellpadding=0 cellspacing=0 width=100% height=100%>");
	document.write("<tr><td>");
	document.write("<iframe style='width:100%;height:100%;overflow:auto; border:" +
				 this.editorBorder+"' NAME='id"+myobj+"' ID='id"+myobj+"' onfocus=\""+myobj+".box_hide()\"></iframe>");

	document.write("</td></tr></table>");

	if (this.IE) {
		document.write("</td></tr><tr><td>");
		if (this.ViewHTML)
			document.write("<input type=checkbox onclick='"+myobj+".setDisplayMode()' id='chkDisplayMode"+this.oname+"' name='chkDisplayMode"+this.oname+"'><font style='font-size:9pt;'> HTML &nbsp;</font>");
		if (this.Preview)
			document.write("<input type=checkbox onclick='"+myobj+".previewMode()' id='chkPreviewMode"+this.oname+"' name='chkPreviewMode"+this.oname+"'><font style='font-size:9pt;'> 미리보기 &nbsp;</font>");
	}

	document.write("</td></tr></table>");

	editor = eval("id" + myobj);

	if (!this.IE)
		document.getElementById("id"+myobj).contentWindow.document.designMode = "on";

	editor.document.open("text/html", "replace");
	editor.document.write("<html><head></head>");
	editor.document.write("<body style='margin:0;background-color:"+this.editorBgcolor+"'></body></html>");

	if (this.IE)
	{
		var el = editor.document.createElement("<link rel='stylesheet' type='text/css' href='"+this.editorPath+"/default.css'>");
		editor.document.childNodes[0].childNodes[0].appendChild(el);
	}

	editor.document.close();

	editor.document.body.style.fontSize   = this.fontsize;
	editor.document.body.style.color      = this.fontcolor;
	editor.document.body.style.fontFamily = this.fontface;
	editor.document.body.style.lineHeight = this.lineheight;
	editor.document.body.style.paddingLeft   = this.padding;
	editor.document.body.style.paddingTop    = this.padding;
	editor.document.body.style.paddingRight  = this.padding;
	//editor.document.body.style.paddingBottom = this.padding; // 주석을 제거하면 수정시 글자가 보이지 않는 현상이 발생함

	if (this.IE) {
		editor.document.execCommand("2D-Position", true, true);
		editor.document.execCommand("MultipleSelection", true, true);
		editor.document.execCommand("LiveResize", true, true);
		editor.document.body.style.border = '1px';
		editor.document.body.contentEditable = true;
	}

	if (this.pasteContent) {
		var theForm = this.formName;
		//var formValue = eval("document."+theForm+"."+this.pasteContentForm+".value");
		var formValue = document.getElementById(this.pasteContentForm).innerHTML;
//        editor.document.body.innerHTML = formValue;
		// formValue 값이 없을때 &nbsp; 로 변환되는것을 막음
		if (formValue)
			editor.document.body.innerHTML = this.unescape_html(formValue);
	}

	if (this.IE) {
		document.write("<iframe name='idtmp"+myobj+"' contentEditable=true id='idtmp"+myobj+"' style='width:0;height:0;overflow:auto;' noborder onfocus='"+myobj+".box_hide()'></iframe>");
		var tmpeditor = eval("idtmp"+myobj);
		tmpeditor.document.designMode = "on";
		tmpeditor.document.open("text/html","replace");
		tmpeditor.document.write("<html><head></head><body><div></div></body></html>");
		tmpeditor.document.close();
	}

	if (!document.getElementById("horizontalRule")) {
		htmlOutput = "<style>" + ".inputbox {font-size:9pt;}" + "</style>" +
				'<table cellpadding="0" cellspacing="0" width="100%" border="0" bgcolor="#f0f0f0">' +
						"<tr><td align=right bgcolor=#dedfdf><img src="+this.editorPath+"/icons/close.gif width=13 height=13 align=absmiddle onClick='parent.box_hide();'>&nbsp;</td></tr>" +
						"<tr><td align=center><div style='margin:5px;'><fieldset><legend><font style=font-size:9pt>가로선 넣기</font></legend>" +
						"<table cellpadding=0 cellspacing=0 border=0 width=100%><tr><td><div style='margin-left:5px'><font style=font-size:9pt>선 길이 : <input type=text size=5 class=inputbox name=hr_width id=hr_width value=100%> %가 없으면 픽셀</font></div></td></tr>" +
						"<tr><td><div style='margin-left:5px'><font style=font-size:9pt>선 굵기 : <input type=text size=5 class=inputbox name=hr_size id=hr_size value=2> 픽셀</font></div></td></tr>" +
						"<tr><td><div style='margin-left:5px'><font style=font-size:9pt>선 색상 : <input type=text size=5 class=inputbox name=hr_color id=hr_color value=> #000000 또는 black</font></div></td></tr>" +
						"<tr><td><div style='margin-left:5px'><font style=font-size:9pt>선 모양 : <input type=checkbox name=hr_shade id=hr_shade value=1> 평면</font></div></td></tr>" +
						"<tr><td height=10></td></tr></table></fieldset></div></td></tr>" +
						"<tr><td align=center><font style=font-size:9pt><input type=button style='font-size:9pt;width:6em;height:24px;padding-top:3px;' value='확인' onClick=\"parent.insertHR(hr_width.value,hr_size.value,hr_color.value,hr_shade.checked ? 1 : 0)\"></font>\n</td></tr>" +
			"<tr><td height=3></td></tr>" +
			"</table>";

		htmlOutput = createWindow(270, htmlOutput);
		document.write("<iframe id=horizontalRule name=horizontalRule style='position: absolute; visibility: hidden; z-index: 1;width:1;height:1;'></iframe>");

		if (!this.IE) 
			document.getElementById("horizontalRule").contentWindow.document.designMode = "on";

		horizontalRule.document.open("text/html", "replace");
		horizontalRule.document.write(htmlOutput);
		horizontalRule.document.close();
	}

	if (!document.getElementById("forecolor")) {
		htmlOutput = createWindow(200, obj.SetColorTable('fore'));
		document.write("<iframe id=forecolor name=forecolor style='position: absolute; visibility: hidden; z-index: -1;width:1;height:1;'></iframe>");
		forecolor.document.open("text/html", "replace");
		forecolor.document.write(htmlOutput);
		forecolor.document.close();
	}

	if (!document.getElementById("backcolor")) {
		htmlOutput = createWindow(200, obj.SetColorTable('back'));
		document.write("<iframe id=backcolor name=backcolor style='position: absolute; visibility: hidden; z-index: -1;width:1;height:1;'></iframe>");
		backcolor.document.open("text/html", "replace");
		backcolor.document.write(htmlOutput);
		backcolor.document.close();
	}

	if (!document.getElementById("paragraph")) {
		htmlOutput = '<table cellpadding="0" cellspacing="0" width="100%" border="0" bgcolor="'+this.editorPopupBgcolor+'">' +
			"<tr><td bgcolor=#dedfdf><div style='margin-left:5px'><font style=font-size:9pt><b>스타일</b></font>\n</div></td><td align=right bgcolor=#dedfdf><img src="+this.editorPath+"/icons/close.gif width=13 height=13 align=absmiddle onClick='parent.box_hide()'>&nbsp;</td></tr>" +
			"<tr><td colspan=2 onclick=\"parent.applyParagraph('<H1>')\"  align=center onmouseover='parent."+this.oname+".mouse_over(this)' onmouseout='parent."+this.oname+".mouse_out(this)' class=dropdown style='height:45'><h1 style='margin:0'>제목 1</h1></td></tr>" +
			"<tr><td colspan=2 onclick=\"parent.applyParagraph('<H2>')\"  align=center onmouseover='parent."+this.oname+".mouse_over(this)' onmouseout='parent."+this.oname+".mouse_out(this)' class=dropdown style='height:40'><h2 style='margin:0'>제목 2</h2></td></tr>" +
			"<tr><td colspan=2 onclick=\"parent.applyParagraph('<H3>')\"  align=center onmouseover='parent."+this.oname+".mouse_over(this)' onmouseout='parent."+this.oname+".mouse_out(this)' class=dropdown style='height:35'><h3 style='margin:0'>제목 3</h3></td></tr>" +
			"<tr><td colspan=2 onclick=\"parent.applyParagraph('<H4>')\"  align=center onmouseover='parent."+this.oname+".mouse_over(this)' onmouseout='parent."+this.oname+".mouse_out(this)' class=dropdown style='height:30'><h4 style='margin:0'>제목 4</h4></td></tr>" +
			"<tr><td colspan=2 onclick=\"parent.applyParagraph('<H5>')\"  align=center onmouseover='parent."+this.oname+".mouse_over(this)' onmouseout='parent."+this.oname+".mouse_out(this)' class=dropdown style='height:25'><h5 style='margin:0'>제목 5</h5></td></tr>" +
			"<tr><td colspan=2 onclick=\"parent.applyParagraph('<H6>')\"  align=center onmouseover='parent."+this.oname+".mouse_over(this)' onmouseout='parent."+this.oname+".mouse_out(this)' class=dropdown style='height:20'><h6 style='margin:0'>제목 6</h6></td></tr>" +
			"<tr><td colspan=2 onclick=\"parent.applyParagraph('<PRE>')\" align=center onmouseover='parent."+this.oname+".mouse_over(this)' onmouseout='parent."+this.oname+".mouse_out(this)' class=dropdown style='height:20'><pre style='margin:0'>Preformatted</pre></td></tr>" +
			"<tr><td colspan=2 onclick=\"parent.applyParagraph('<P>')\"   align=center onmouseover='parent."+this.oname+".mouse_over(this)' onmouseout='parent."+this.oname+".mouse_out(this)' class=dropdown style='height:20'><p style='margin:0'>보통</p></td></tr>" +
			"<tr><td colspan=2 height=3></td></tr>" +
			"</table>";

		htmlOutput = createWindow(200, htmlOutput);
		document.write("<iframe id=paragraph name=paragraph style='position: absolute; visibility: hidden; z-index: 1;width:1;height:1;'></iframe>");

		paragraph.document.open("text/html", "replace");
		paragraph.document.write(htmlOutput);
		paragraph.document.close();
	}

	if (!document.getElementById("zoom")){
		htmlOutput = '<table cellpadding="0" cellspacing="0" width="100%"border="0" bgcolor="'+this.editorPopupBgcolor+'">' +
			"<tr><td bgcolor=#dedfdf><div style='margin-left:5px'><font style=font-size:9pt><b>본문 확대</b></font>\n</div></td><td align=right bgcolor=#dedfdf><img src="+this.editorPath+"/icons/close.gif width=13 height=13 align=absmiddle onClick='parent.box_hide();'>&nbsp;</td></tr>" +
			"<tr><td colspan=2 onclick=\"parent.viewZoom('500%')\" align=center onmouseover='parent."+this.oname+".mouse_over(this)' onmouseout='parent."+this.oname+".mouse_out(this)' class=dropdown style='height:17'><font style='font-size:9pt'>500%</font>\n</td></tr>" +
			"<tr><td colspan=2 onclick=\"parent.viewZoom('250%')\" align=center onmouseover='parent."+this.oname+".mouse_over(this)' onmouseout='parent."+this.oname+".mouse_out(this)' class=dropdown style='height:17'><font style='font-size:9pt'>250%</font>\n</td></tr>" +
			"<tr><td colspan=2 onclick=\"parent.viewZoom('200%')\" align=center onmouseover='parent."+this.oname+".mouse_over(this)' onmouseout='parent."+this.oname+".mouse_out(this)' class=dropdown style='height:17'><font style='font-size:9pt'>200%</font>\n</td></tr>" +
			"<tr><td colspan=2 onclick=\"parent.viewZoom('150%')\" align=center onmouseover='parent."+this.oname+".mouse_over(this)' onmouseout='parent."+this.oname+".mouse_out(this)' class=dropdown style='height:17'><font style='font-size:9pt'>150%</font>\n</td></tr>" +
			"<tr><td colspan=2 onclick=\"parent.viewZoom('120%')\" align=center onmouseover='parent."+this.oname+".mouse_over(this)' onmouseout='parent."+this.oname+".mouse_out(this)' class=dropdown style='height:17'><font style='font-size:9pt'>120%</font>\n</td></tr>" +
			"<tr><td colspan=2 onclick=\"parent.viewZoom('100%')\" align=center onmouseover='parent."+this.oname+".mouse_over(this)' onmouseout='parent."+this.oname+".mouse_out(this)' class=dropdown style='height:17'><font style='font-size:9pt'>100%</font>\n</td></tr>" +
			"<tr><td colspan=2 onclick=\"parent.viewZoom('75%')\" align=center onmouseover='parent."+this.oname+".mouse_over(this)' onmouseout='parent."+this.oname+".mouse_out(this)' class=dropdown style='height:17'><font style='font-size:9pt'>75%</font>\n</td></tr>" +
			"<tr><td colspan=2 onclick=\"parent.viewZoom('50%')\" align=center onmouseover='parent."+this.oname+".mouse_over(this)' onmouseout='parent."+this.oname+".mouse_out(this)' class=dropdown style='height:17'><font style='font-size:9pt'>50%</font>\n</td></tr>" +
			"<tr><td colspan=2 onclick=\"parent.viewZoom('25%')\" align=center onmouseover='parent."+this.oname+".mouse_over(this)' onmouseout='parent."+this.oname+".mouse_out(this)' class=dropdown style='height:19'><font style='font-size:9pt'>25%</font>\n</td></tr>" +
			"<tr><td colspan=2 height=3></td></tr>" +
			"</table>";
		htmlOutput = createWindow(100, htmlOutput);
		document.write("<iframe id=zoom name=zoom style='position: absolute; visibility: hidden; z-index: -1;width:1;height:1;'></iframe>");
		zoom.document.open("text/html","replace");
		zoom.document.write(htmlOutput);
		zoom.document.close();
	}


	if (!document.getElementById("fontType")){
		htmlOutput = '<table cellpadding="0" cellspacing="0" width="100% border="0" bgcolor="'+this.editorPopupBgcolor+'">' +
			"<tr><td bgcolor=#dedfdf><div style='margin-left:5px'><font style=font-size:9pt><b>글꼴 유형</b></font>\n</div></td><td align=right bgcolor=#dedfdf><img src="+this.editorPath+"/icons/close.gif width=13 height=13 align=absmiddle onClick='parent.box_hide();'>&nbsp;</td></tr>" +
			"<tr><td colspan=2 onclick=\"parent.changeFontType('굴림')\" align=center onmouseover='parent."+this.oname+".mouse_over(this)' onmouseout='parent."+this.oname+".mouse_out(this)' class=dropdown style='height:17'><font face='굴림' style='font-size:9pt'>가나다라마바사 (굴림)</font>\n</td></tr>" +
			"<tr><td colspan=2 onclick=\"parent.changeFontType('돋움')\" align=center onmouseover='parent."+this.oname+".mouse_over(this)' onmouseout='parent."+this.oname+".mouse_out(this)' class=dropdown style='height:17'><font face='돋움' style='font-size:9pt'>가나다라마바사 (돋움)</font>\n</td></tr>" +
			"<tr><td colspan=2 onclick=\"parent.changeFontType('바탕')\" align=center onmouseover='parent."+this.oname+".mouse_over(this)' onmouseout='parent."+this.oname+".mouse_out(this)' class=dropdown style='height:17'><font face='바탕' style='font-size:9pt'>가나다라마바사 (바탕)</font>\n</td></tr>" +
			"<tr><td colspan=2 onclick=\"parent.changeFontType('궁서')\" align=center onmouseover='parent."+this.oname+".mouse_over(this)' onmouseout='parent."+this.oname+".mouse_out(this)' class=dropdown style='height:17'><font face='궁서' style='font-size:9pt'>가나다라마바사 (궁서)</font>\n</td></tr>" +
			"<tr><td colspan=2 onclick=\"parent.changeFontType('Arial')\" align=center onmouseover='parent."+this.oname+".mouse_over(this)' onmouseout='parent."+this.oname+".mouse_out(this)' class=dropdown style='height:17'><font face='Arial' style='font-size:9pt'>ABCDEFGHIJK (Arial)</font>\n</td></tr>" +
			"<tr><td colspan=2 onclick=\"parent.changeFontType('Arial Black')\" align=center onmouseover='parent."+this.oname+".mouse_over(this)' onmouseout='parent."+this.oname+".mouse_out(this)' class=dropdown style='height:17'><font face='Arial Black' style='font-size:9pt'>ABCDEFGHIJK (Arial Black)</font>\n</td></tr>" +
			"<tr><td colspan=2 onclick=\"parent.changeFontType('Arial Narrow')\" align=center onmouseover='parent."+this.oname+".mouse_over(this)' onmouseout='parent."+this.oname+".mouse_out(this)' class=dropdown style='height:17'><font face='Arial Narrow' style='font-size:9pt'>ABCDEFGHIJK (Arial Narrow)</font>\n</td></tr>" +
			"<tr><td colspan=2 onclick=\"parent.changeFontType('Comic Sans MS')\" align=center onmouseover='parent."+this.oname+".mouse_over(this)' onmouseout='parent."+this.oname+".mouse_out(this)' class=dropdown style='height:17'><font face='Comic Sans MS' style='font-size:9pt'>ABCDEFGHIJK (Comic Sans MS)</font>\n</td></tr>" +
			"<tr><td colspan=2 onclick=\"parent.changeFontType('Courier New')\" align=center onmouseover='parent."+this.oname+".mouse_over(this)' onmouseout='parent."+this.oname+".mouse_out(this)' class=dropdown style='height:17'><font face='Courier New' style='font-size:9pt'>ABCDEFGHIJK (Courier New)</font>\n</td></tr>" +
			"<tr><td colspan=2 onclick=\"parent.changeFontType('System')\" align=center onmouseover='parent."+this.oname+".mouse_over(this)' onmouseout='parent."+this.oname+".mouse_out(this)' class=dropdown style='height:19'><font face='System' style='font-size:9pt'>ABCDEFGHIJK (System)</font>\n</td></tr>" +
			"<tr><td colspan=2 onclick=\"parent.changeFontType('Tahoma')\" align=center onmouseover='parent."+this.oname+".mouse_over(this)' onmouseout='parent."+this.oname+".mouse_out(this)' class=dropdown style='height:17'><font face='Tahoma' style='font-size:9pt'>ABCDEFGHIJK (Tahoma)</font>\n</td></tr>" +
			"<tr><td colspan=2 onclick=\"parent.changeFontType('Times New Roman')\"  align=center onmouseover='parent."+this.oname+".mouse_over(this)' onmouseout='parent."+this.oname+".mouse_out(this)' class=dropdown style='height:17'><font face='Times New Roman' style='font-size:9pt'>ABCDEFGHIJK (Times New Roman)</font>\n</td></tr>" +
			"<tr><td colspan=2 onclick=\"parent.changeFontType('Verdana')\" align=center onmouseover='parent."+this.oname+".mouse_over(this)' onmouseout='parent."+this.oname+".mouse_out(this)' class=dropdown style='height:17'><font face='Verdana' style='font-size:9pt'>ABCDEFGHIJK (Verdana)</font></td>\n</tr>" +
			"<tr><td colspan=2 height=3></td></tr>" +
			"</table>";
		htmlOutput = createWindow(220, htmlOutput);
		document.write("<iframe id=fontType name=fontType style='position: absolute; visibility: hidden; z-index: -1;width:1;height:1;'></iframe>");
		fontType.document.open("text/html","replace");
		fontType.document.write(htmlOutput);
		fontType.document.close();
	}

	if (!document.getElementById("fontSize")) {
		htmlOutput = '<table cellpadding="0" cellspacing="0" width="100% border="0" bgcolor="'+this.editorPopupBgcolor+'">' +
			"<tr><td bgcolor=#dedfdf><div style='margin-left:5px'><font style=font-size:9pt><b>글자 크기</b></font>\n</div></td><td align=right bgcolor=#dedfdf><img src="+this.editorPath+"/icons/close.gif width=13 height=13 align=absmiddle onClick='parent.box_hide()'>&nbsp;</td></tr>" +
			"<tr><td colspan=2 onclick=\"parent.changeSize(1)\" onmouseover='parent."+this.oname+".mouse_over(this)' onmouseout='parent."+this.oname+".mouse_out(this)' class=dropdown style='height:20;'><font size=1>가나다라마바사 (1)</font>\n</td></tr>" +
			"<tr><td colspan=2 onclick=\"parent.changeSize(2)\" onmouseover='parent."+this.oname+".mouse_over(this)' onmouseout='parent."+this.oname+".mouse_out(this)' class=dropdown style='height:20'><font size=2>가나다라마바사 (2)</font>\n</td></tr>" +
			"<tr><td colspan=2 onclick=\"parent.changeSize(3)\" onmouseover='parent."+this.oname+".mouse_over(this)' onmouseout='parent."+this.oname+".mouse_out(this)' class=dropdown style='height:22'><font size=3>가나다라마바사 (3)</font>\n</td></tr>" +
			"<tr><td colspan=2 onclick=\"parent.changeSize(4)\" onmouseover='parent."+this.oname+".mouse_over(this)' onmouseout='parent."+this.oname+".mouse_out(this)' class=dropdown style='height:27'><font size=4>가나다라마바사 (4)</font>\n</td></tr>" +
			"<tr><td colspan=2 onclick=\"parent.changeSize(5)\" onmouseover='parent."+this.oname+".mouse_over(this)' onmouseout='parent."+this.oname+".mouse_out(this)' class=dropdown style='height:33'><font size=5>가나다라마바사 (5)</font>\n</td></tr>" +
			"<tr><td colspan=2 onclick=\"parent.changeSize(6)\" onmouseover='parent."+this.oname+".mouse_over(this)' onmouseout='parent."+this.oname+".mouse_out(this)' class=dropdown style='height:40'><font size=6>가나다라마바사 (6)</font>\n</td></tr>" +
			"<tr><td colspan=2 height=3></td></tr>" +
			"</table>";
		htmlOutput = createWindow(280, htmlOutput);
		document.write("<iframe id=fontSize name=fontSize style='position: absolute; visibility: hidden; z-index: -1;width:1;height:1;'></iframe>");
		fontSize.document.open("text/html","replace");
		fontSize.document.write(htmlOutput);
		fontSize.document.close();
	}

	editor.focus();
}

function unescape_html (content)
{
	content = content.replace(/&lt;/g, '<');
	content = content.replace(/&gt;/g, '>');
	content = content.replace(/&quot;/g, '"');
	content = content.replace(/&amp;/g, '&');
	return content;
}

function cheditor (myobj)
{
	// 지원 브라우저 체크
	// 브라우저가 접합하지 않을 경우 <textarea> 출력

	var wmsg = navigator.appVersion+"\n버전는 지원하지 않습니다.";

	if (navigator.appVersion.indexOf("MSIE")!=-1) {
		if (parseFloat(navigator.appVersion.split("MSIE")[1]) < 5.5) {
			this.run = function() {
				document.write("<textarea name=message style='width:100%; height:200px'>"+wmsg+"</textarea>");
			};
			return;
		}
	}

	if (navigator.product == "Gecko") {
		if (navigator.productSub < 20030210) {
			this.run = function() {
				document.write("<textarea name=message style='width:100%; height:200px'>"+wmsg+"</textarea>");
			};
			return;
		}
	}

	this.oname                    = myobj;
	this.IE                       = navigator.userAgent.toLowerCase().indexOf("msie") != -1;
	this.width                    = "100%";
	this.height                   = "300px";
	this.fontsize                 = '9pt';
	this.fontcolor                = '#222222';
	this.fontface                 = '굴림';
	this.lineheight               = '1.1';
	this.padding                  = '10px';
	this.editorBgcolor            = "#ffffff";
	this.editorBorder             = "1px #999 solid";
	this.editorToolbar            = "border-left:#999 1 solid;border-top:#999 1 solid;border-right:#999 1 solid;background:#f0f0f0;";
	this.editorPopupBgcolor       = "#ffffff";
	this.run                      = run;
	this.editorPath               = ".";
	this.unescape_html            = unescape_html;
	this.dimension                = dimension;
	this.displayWindow            = displayWindow;
	this.windowPos                = windowPos;
	this.box_position             = box_position;
	this.box_hide                 = box_hide;
	this.mouse_over               = mouse_over;
	this.mouse_out                = mouse_out;
	this.setIcon                  = setIcon;
	this.exec                     = exec;
	this.exec2                    = exec2;
	this.exec3                    = exec3;
	this.fix_selection;
	this.fix_selection_type;
	this.selection;
	this.selection_type;
	this.set_selection            = set_selection;
	this.SetColorTable            = SetColorTable;
	this.setDisplayMode           = setDisplayMode;
	this.displayMode              = "RICH";
	this.previewMode              = previewMode;
	this.put_content              = put_content;
	this.selection_color          = "#5579aa";
	this.get_content              = get_content;
	this.outputHTML               = outputHTML;
	this.outputBodyHTML           = outputBodyHTML;
	this.htmlKey                  = htmlKey;
	this.get_element              = get_element;
	this.insert                   = insert;
	this.setBackgroundColor       = setBackgroundColor;
	this.insertEl                 = insertEl;
	this.insertIE                 = insertIE;
	this.SetGeckoColor            = SetGeckoColor;
	this.pasteContent             = false;
	this.pasteContentForm         = "paste";
	this.formName                 = "";
	this.insertImage              = insertImage;
	this.insertTable              = insertTable;
	this.insertBgImage            = insertBgImage;
	this.hyperLink                = hyperLink;
	this.ViewHTML                 = true;
	this.Preview                  = true;
	this.returnFalse              = returnFalse;
	this.setImages                = [];
	this.getImages                = getImages;
}
