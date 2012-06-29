////////////////////////////////////////////////////////////////////////
//
//                            CHEditor 2.9
//
//       Author: ��âȣ
//       EMail:  chna@chcode.com
//       Homepage: http://www.chcode.com
//
//       Copyright (C) 1997-2005, CHCODE. All rights reserved.
//
////////////////////////////////////////////////////////////////////////

var chutil = new CH_UTILITIES();
var command = "";
var editorPath = "";

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

    var el;

    if (this.IE) {
      if (sel.parentElement)
        el = sel.parentElement();
      else {
        el = get_element(sel.item(0),"A");
      }
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
    for(var i = 0; i < parent.frames.length; i++) {
        if(parent.frames(i).name == window.name) {
            eval("parent.frames."+window.name+"." + forecolor.document.body.document.all.CHEditor.value).exec2("ForeColor",obj.style.backgroundColor);
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

    while(eval("editwin"+ this.oname + stmp).tagName!="BODY") {
        myTop += eval("editwin"+ this.oname + stmp).offsetTop;
        stmp += ".offsetParent";
    }

    myLeft = 0;
    stmp = "";

    while(eval("editwin"+ this.oname + stmp).tagName!="BODY") {
        myLeft += eval("editwin"+ this.oname + stmp).offsetLeft;
        stmp += ".offsetParent";
    }

    if(editarea.offsetHeight-tblPopup.offsetHeight > 0)
        eval("document.all."+boxName).style.pixelTop=(myTop + (editarea.offsetHeight-tblPopup.offsetHeight)/2);
    else
        eval("document.all."+boxName).style.pixelTop=(myTop + (editarea.offsetHeight-tblPopup.offsetHeight)/2);

    if(editarea.offsetWidth-tblPopup.offsetWidth > 0)
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
//  eval("document.all."+boxName).focus();
}

function windowPos(idImg, boxName)
{
    myTop = 0;
    stmp = "";

    while (eval("idImg" + stmp).tagName!="BODY") {
        stmp += ".offsetParent";
        myTop += eval("idImg" + stmp).offsetTop;
    }

    myTop = myTop + 27;
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

function box_hide()
{
    document.all.fontType.style.visibility = "hidden";
    document.all.fontSize.style.visibility = "hidden";
    document.all.backcolor.style.visibility = "hidden";
    document.all.forecolor.style.visibility = "hidden";
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
    for(var i = 0; i < parent.frames.length; i++) {
        if(parent.frames(i).name == window.name) {
            eval("parent.frames."+window.name+"." + backcolor.document.body.document.all.CHEditor.value).exec2("BackColor",obj.style.backgroundColor);
            return;
        }
    }
    eval("parent." + backcolor.document.body.document.all.CHEditor.value).exec2("BackColor",obj.style.backgroundColor);
}

function SetColorTable (what)
{
    var strCap = '<table cellpadding=0 cellspacing=0 width=100% border=0 bgcolor=#f0f0f0>' +
        '<tr><td align=right bgcolor=#dedfdf><img src='+this.editorPath+'/icons/close.gif width=13 height=13 align=absmiddle onClick="parent.box_hide();">&nbsp;</td></tr>' +
        '<table cellpadding=1 cellspacing=5 border=1 bordercolor=#666666 style="cursor: hand;font-family: Verdana; font-size: 7px; BORDER-LEFT: buttonhighlight 0px solid; BORDER-RIGHT: buttonshadow 2px solid; BORDER-TOP: buttonhighlight 0px solid; BORDER-BOTTOM: buttonshadow 0px solid;" bgcolor=#f0f0f0>' +
        '<tr><td colspan="10" id=color style="height=20px;font-family: verdana; font-size:12px; text-align:center">&nbsp;</td></tr>';

    var colorRows = [strCap];
    var k = 0;
    var w = 14;
    var h = 10;
    var cmd = (what == 'back') ? 'SetBackColor(color)' : 'SetForeColor(color)';

    for (var i = 0; i < w; i++) {
        colorRows[colorRows.length] = "<TR>";
        for (var j = 0; j < h; j++) {
            colorRows[colorRows.length] = '<td onMouseOver="parent.showColor(color,this)" onClick="parent.'+cmd+'" style="background-color:'+colorTable[k]+';"width=12px">&nbsp;</td>';
            k++;
        }
        colorRows[colorRows.length] = "</TR>";
    }

    colorRows[colorRows.length] =
        '<tr><td colspan="10" style="height=15px;font-size:9pt; text-align:center" onMouseOver="parent.showColor(color,this)" onClick="parent.'+cmd+'">����</td></tr>' +
        '</table>';

    return colorRows.join("\n");
}

function createWindow(width, content)
{
    var htmlOutput = "" +
        "<style>" +
        "body {border:lightgrey 0px solid;background: white; font-family:����}" +
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

function changeFontType(val)
{
    for(var i = 0; i < parent.frames.length; i++) {
        if(parent.frames(i).name == window.name) {
            eval("parent.frames."+window.name+"." + fontType.document.body.document.all.CHEditor.value).exec2("fontName",val);
            return;
        }
    }

    eval("parent." + fontType.document.body.document.all.CHEditor.value).exec2("fontName",val);
}

function changeSize(val)
{
    for(var i = 0; i < parent.frames.length; i++) {
        if(parent.frames(i).name == window.name) {
            eval("parent.frames."+window.name+"." + fontSize.document.body.document.all.CHEditor.value).exec2("fontsize",val);
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
        if(document.getElementById("chkPreviewMode"+this.oname).checked) {
            document.getElementById("chkPreviewMode"+this.oname).checked = false;
            this.displayMode = 'RICH';
        }
    }

    if(this.displayMode=='RICH') {
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
        content = content.replace (reg, "<font color=#0000ff>$1$2$3</font>");
        content = content.replace (reg2, "<font color=#0000ff>$1$2</font> $3<font color=#0000ff>$4</font>");

        editor.document.body.innerHTML = content;
        editor.document.body.clearAttributes;
        editor.document.body.style.fontFamily = 'Courier New';
        editor.document.body.style.fontSize = '9pt';
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


function get_content()
{
    var myobj = eval("id"+this.oname);

    myobj.document.body.style.border = "";
    myobj.document.body.removeAttribute("contentEditable", 0);
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
//    editor.document.body.oncontextmenu = returnFalse;

    editor.document.execCommand("2D-Position", true, true);
    editor.document.execCommand("MultipleSelection", true, true);
    editor.document.execCommand("LiveResize", true, true);
}

function insert (what)
{
    var myobj = eval("id" + this.oname);
    var tmpl;
    var w;
    var h;
    var scroll = 0;

    myobj.focus();

    if (this.IE) this.set_selection();

    if (what == "forecolor") {
        tmpl = "gecko_forecolor.html";
        h = 240;
        w = 250;
    }
    else if (what == "hilitecolor") {
        tmpl = "gecko_hilitecolor.html";
        h = 240;
        w = 250;
    }
    else if (what == "backcolor") {
        tmpl = "gecko_backcolor.html";
        h = 240;
        w = 250;
    }
    else if (what == "image") {
        tmpl = "insert_image.html";
        h = this.IE ? 615 : 650;
        w = 430;
    }
    else if (what == "hlink") {
        tmpl = "insert_hlink.html";
        h = this.IE ? 160 : 180;
        w = this.IE ? 450 : 500;
    }
    else if (what == "em") {
        tmpl = "insert_emicon.html";
        h = this.IE ? 235 : 250;
        w = 400;
    }
    else
        return;

    tmpl = this.editorPath + '/' + tmpl;

    var left = (screen.width-w)/2;
    var top = (screen.height-h)/2;

    window.open(tmpl, "new_window",
                "toolbar=no,menubar=no,personalbar=no,height="+h+",width="+w+"," +
                "left="+left+",top="+top+",scroolbars=yes,resizable=no");
}

function SetGeckoColor(cmd, colour)
{
    document.getElementById("id"+myobj).contentWindow.document.execCommand(cmd, false, colour);
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
    var sel = editor.document.selection.createRange();
    sel.pasteHTML(c);
}

function get_element(elm, tag)
{
    while (elm != null && elm.tagName != tag) {
        if(elm.id == "id"+this.oName)
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

    // �޴� ��ư ���: ���� *****/
    document.write("<table cellpadding=0 cellspacing=0 width=100% id='idToolbar"+myobj+"'style=\""+this.editorToolbar+"\">");
    document.write("<tr><td><table cellpadding=0 cellspacing=0><tr><td>");
    document.write("<table id='toolbar1' cellpadding=1 cellspacing=0>");
    document.write("<tr>");
    document.write("<td title='����'>" + obj.setIcon("bold.gif", 26, 26, myobj + ".exec('Bold',false)") + "</div></td>");
    document.write("<td title='����'>" + obj.setIcon("italic.gif", 26, 26, myobj + ".exec('Italic',false)") + "</div></td>");
    document.write("<td title='����'>" + obj.setIcon("underline.gif", 26, 26, myobj + ".exec('Underline',false)") + "</div></td>");
    document.write("<td title='���� ����'>" + obj.setIcon("justifyleft.gif", 26, 26, myobj + ".exec('JustifyLeft',false)") + "</div></td>");
    document.write("<td title='��� ����'>" + obj.setIcon("justifycenter.gif", 26, 26, myobj + ".exec('JustifyCenter',false)") + "</div></td>");
    document.write("<td title='������ ����'>" + obj.setIcon("justifyright.gif", 26, 26, myobj + ".exec('JustifyRight',false)") + "</div></td>");
    document.write("<td>" + obj.setIcon("orderedlist.gif", 26, 26, myobj + ".exec('InsertOrderedList',false)") + "</div></td>");
    document.write("<td>" + obj.setIcon("unorderedlist.gif", 26, 26, myobj + ".exec('InsertUnorderedList',false)") + "</div></td>");
    document.write("<td>" + obj.setIcon("outdent.gif", 26, 26, myobj + ".exec('Outdent',false)") + "</div></td>");
    document.write("<td>" + obj.setIcon("indent.gif", 26, 26, myobj + ".exec('Indent',false)") + "</div></td>");
    document.write("<td title='�����۸�ũ'>" + obj.setIcon("link.gif", 26, 26, myobj + ".insert('hlink')") + "</div></td>");
    document.write("<td>" + obj.setIcon("unlink.gif", 26, 26, myobj + ".exec('UnLink',false)") + "</div></td>");
    document.write("<td title='�׸��ֱ�'>" + obj.setIcon("image.gif", 26, 26, myobj + ".insert('image')") + "</div></td>");
    document.write("<td title='ǥ�� ������'>" + obj.setIcon("em.gif", 26, 26, myobj + ".insert('em')") + "</div></td>");

    if (this.IE) {
        document.write("<td title='���ڻ�'>" + obj.setIcon("forecolor.gif", 26, 26, myobj + ".displayWindow('forecolor');windowPos(this,'forecolor')",false) + "</div></td>");
        document.write("<td>" + obj.setIcon("backcolor.gif", 26, 26, myobj + ".displayWindow('backcolor');windowPos(this,'backcolor')",false) + "</div></td>");
        document.write("<td title='�۲� ����'>" + obj.setIcon("fonttype.gif", 58, 26, myobj + ".displayWindow('fontType');windowPos(this,'fontType')",false) + "</div></td>");
        document.write("<td title='���� ũ��'>" + obj.setIcon("fontsize.gif", 58, 26, myobj + ".displayWindow('fontSize');windowPos(this,'fontSize')",false) + "</div></td>");
    }
    else {
        document.write("<td>" + obj.setIcon("forecolor.gif", 26, 26, myobj + ".insert('forecolor')") + "</div></td>");
        document.write("<td>" + obj.setIcon("backcolor.gif", 26, 26, myobj + ".insert('hilitecolor')") + "</div></td>");

        document.write("<td><select style='font-size:9pt' id='fontname' onchange='"+myobj+".exec(\"fontname\", this.options[selectedIndex].value)'>" +
                     "<option value='����'>����</option>" +
                     "<option value='����'>����</option>" +
                     "<option value='����'>����</option>" +
                     "<option value='�ü�'>�ü�</option>" +
                     "<option value='Arial'>Arial</option>" +
                     "<option value='Arial Black'>Arial Black</option>" +
                     "<option value='Courier'>Courier</option>" +
                     "<option value='Times New Roman'>Times New Roman</option>" +
                     "<option value='Verdana'>Verdana</option>" +
                    "</select></td>");

        document.write("<td><select style='font-size:9pt' id='fontsize' onchange='"+myobj+".exec(\"fontsize\", this.options[selectedIndex].value)'>" +
                     "<option value='1'>ũ�� 1</option>" +
                     "<option value='2'>ũ�� 2</option>" +
                     "<option value='3'>ũ�� 3</option>" +
                     "<option value='4'>ũ�� 4</option>" +
                     "<option value='5'>ũ�� 5</option>" +
                     "<option value='6'>ũ�� 6</option>" +
                    "</select></td>");
    }

    document.write("</tr></table></td></tr></table></td></tr></table></td></tr><tr><td height='100%'>");
    // �޴� ��ư ���: �� *****/

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
            document.write("<input type=checkbox onclick='"+myobj+".previewMode()' id='chkPreviewMode"+this.oname+"' name='chkPreviewMode"+this.oname+"'><font style='font-size:9pt;'> �̸����� &nbsp;</font>");
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
    editor.document.body.style.fontFamily = this.fontface;
    editor.document.body.style.lineHeight = this.lineheight;

    if (this.IE) {
        editor.document.execCommand("2D-Position", true, true);
        editor.document.execCommand("MultipleSelection", true, true);
        editor.document.execCommand("LiveResize", true, true);
        editor.document.body.style.border = '1px';
        editor.document.body.contentEditable = true;
    }

    if (this.pasteContent) {
        var theForm = this.formName;
        var formValue = eval("document."+theForm+"."+this.pasteContentForm+".value");
//        editor.document.body.innerHTML = formValue;
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

    if(!document.getElementById("horizontalRule")) {
        htmlOutput = "<style>" + ".inputbox {font-size:9pt;}" + "</style>" +
                '<table cellpadding="0" cellspacing="0" width="100%" border="0" bgcolor="#f0f0f0">' +
                        "<tr><td align=right bgcolor=#dedfdf><img src="+this.editorPath+"/icons/close.gif width=13 height=13 align=absmiddle onClick='parent.box_hide();'>&nbsp;</td></tr>" +
                        "<tr><td align=center><div style='margin:5px;'><fieldset><legend><font style=font-size:9pt>���μ� �ֱ�</font></legend>" +
                        "<table cellpadding=0 cellspacing=0 border=0 width=100%><tr><td><div style='margin-left:5px'><font style=font-size:9pt>�� ���� : <input type=text size=5 class=inputbox name=hr_width id=hr_width value=100%> %�� ������ �ȼ�</font></div></td></tr>" +
                        "<tr><td><div style='margin-left:5px'><font style=font-size:9pt>�� ���� : <input type=text size=5 class=inputbox name=hr_size id=hr_size value=2> �ȼ�</font></div></td></tr>" +
                        "<tr><td><div style='margin-left:5px'><font style=font-size:9pt>�� ���� : <input type=text size=5 class=inputbox name=hr_color id=hr_color value=> #000000 �Ǵ� black</font></div></td></tr>" +
                        "<tr><td><div style='margin-left:5px'><font style=font-size:9pt>�� ��� : <input type=checkbox name=hr_shade id=hr_shade value=1> ���</font></div></td></tr>" +
                        "<tr><td height=10></td></tr></table></fieldset></div></td></tr>" +
                        "<tr><td align=center><font style=font-size:9pt><input type=button style='font-size:9pt;width:6em;height:24px;padding-top:3px;' value='Ȯ��' onClick=\"parent.insertHR(hr_width.value,hr_size.value,hr_color.value,hr_shade.checked ? 1 : 0)\"></font>\n</td></tr>" +
            "<tr><td height=3></td></tr>" +
            "</table>";

        htmlOutput = createWindow(270, htmlOutput);
        document.write("<iframe id=horizontalRule name=horizontalRule style='position: absolute; visibility: hidden; z-index: 1;width:1;height:1;'></iframe>");

        if (!this.IE)
            document.getElementById(horizontalRule).contentWindow.document.designMode = "on";

        horizontalRule.document.open("text/html", "replace");
        horizontalRule.document.write(htmlOutput);
        horizontalRule.document.close();
    }

    if(!document.getElementById("forecolor")) {
        htmlOutput = createWindow(200, obj.SetColorTable('fore'));
        document.write("<iframe id=forecolor name=forecolor style='position: absolute; visibility: hidden; z-index: -1;width:1;height:1;'></iframe>");
        forecolor.document.open("text/html", "replace");
        forecolor.document.write(htmlOutput);
        forecolor.document.close();
    }

    if(!document.getElementById("backcolor")) {
        htmlOutput = createWindow(200, obj.SetColorTable('back'));
        document.write("<iframe id=backcolor name=backcolor style='position: absolute; visibility: hidden; z-index: -1;width:1;height:1;'></iframe>");
        backcolor.document.open("text/html", "replace");
        backcolor.document.write(htmlOutput);
        backcolor.document.close();
    }

    if(!document.getElementById("fontType")){
        htmlOutput = '<table cellpadding="0" cellspacing="0" width="100% border="0" bgcolor="'+this.editorPopupBgcolor+'">' +
            "<tr><td bgcolor=#dedfdf><div style='margin-left:5px'><font style=font-size:9pt><b>����ü</b></font>\n</div></td><td align=right bgcolor=#dedfdf><img src="+this.editorPath+"/icons/close.gif width=13 height=13 align=absmiddle onClick='parent.box_hide();'>&nbsp;</td></tr>" +
            "<tr><td colspan=2 onclick=\"parent.changeFontType('����')\" align=center onmouseover='parent."+this.oname+".mouse_over(this)' onmouseout='parent."+this.oname+".mouse_out(this)' class=dropdown style='height:17'><font face='����' style='font-size:9pt'>�����ٶ󸶹ٻ� (����)</font>\n</td></tr>" +
            "<tr><td colspan=2 onclick=\"parent.changeFontType('����')\" align=center onmouseover='parent."+this.oname+".mouse_over(this)' onmouseout='parent."+this.oname+".mouse_out(this)' class=dropdown style='height:17'><font face='����' style='font-size:9pt'>�����ٶ󸶹ٻ� (����)</font>\n</td></tr>" +
            "<tr><td colspan=2 onclick=\"parent.changeFontType('����')\" align=center onmouseover='parent."+this.oname+".mouse_over(this)' onmouseout='parent."+this.oname+".mouse_out(this)' class=dropdown style='height:17'><font face='����' style='font-size:9pt'>�����ٶ󸶹ٻ� (����)</font>\n</td></tr>" +
            "<tr><td colspan=2 onclick=\"parent.changeFontType('�ü�')\" align=center onmouseover='parent."+this.oname+".mouse_over(this)' onmouseout='parent."+this.oname+".mouse_out(this)' class=dropdown style='height:17'><font face='�ü�' style='font-size:9pt'>�����ٶ󸶹ٻ� (�ü�)</font>\n</td></tr>" +
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

    if(!document.getElementById("fontSize")) {
        htmlOutput = '<table cellpadding="0" cellspacing="0" width="100% border="0" bgcolor="'+this.editorPopupBgcolor+'">' +
            "<tr><td bgcolor=#dedfdf><div style='margin-left:5px'><font style=font-size:9pt><b>���� ũ��</b></font>\n</div></td><td align=right bgcolor=#dedfdf><img src="+this.editorPath+"/icons/close.gif width=13 height=13 align=absmiddle onClick='parent.box_hide()'>&nbsp;</td></tr>" +
            "<tr><td colspan=2 onclick=\"parent.changeSize(1)\" onmouseover='parent."+this.oname+".mouse_over(this)' onmouseout='parent."+this.oname+".mouse_out(this)' class=dropdown style='height:20;'><font size=1>�����ٶ󸶹ٻ� (1)</font>\n</td></tr>" +
            "<tr><td colspan=2 onclick=\"parent.changeSize(2)\" onmouseover='parent."+this.oname+".mouse_over(this)' onmouseout='parent."+this.oname+".mouse_out(this)' class=dropdown style='height:20'><font size=2>�����ٶ󸶹ٻ� (2)</font>\n</td></tr>" +
            "<tr><td colspan=2 onclick=\"parent.changeSize(3)\" onmouseover='parent."+this.oname+".mouse_over(this)' onmouseout='parent."+this.oname+".mouse_out(this)' class=dropdown style='height:22'><font size=3>�����ٶ󸶹ٻ� (3)</font>\n</td></tr>" +
            "<tr><td colspan=2 onclick=\"parent.changeSize(4)\" onmouseover='parent."+this.oname+".mouse_over(this)' onmouseout='parent."+this.oname+".mouse_out(this)' class=dropdown style='height:27'><font size=4>�����ٶ󸶹ٻ� (4)</font>\n</td></tr>" +
            "<tr><td colspan=2 onclick=\"parent.changeSize(5)\" onmouseover='parent."+this.oname+".mouse_over(this)' onmouseout='parent."+this.oname+".mouse_out(this)' class=dropdown style='height:33'><font size=5>�����ٶ󸶹ٻ� (5)</font>\n</td></tr>" +
            "<tr><td colspan=2 onclick=\"parent.changeSize(6)\" onmouseover='parent."+this.oname+".mouse_over(this)' onmouseout='parent."+this.oname+".mouse_out(this)' class=dropdown style='height:40'><font size=6>�����ٶ󸶹ٻ� (6)</font>\n</td></tr>" +
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
    // ���� ������ üũ
    // �������� �������� ���� ��� <textarea> ���

    var wmsg = navigator.appVersion+"\n������ �������� �ʽ��ϴ�.";
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
    this.fontface                 = '����';
    this.lineheight               = '16pt';
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
    this.insertEl                 = insertEl;
    this.SetGeckoColor            = SetGeckoColor;
    this.pasteContent             = false;
    this.pasteContentForm         = "paste";
    this.formName                 = "";
    this.insertImage              = insertImage;
    this.hyperLink                = hyperLink;
    this.ViewHTML                 = true;
    this.Preview                  = true;
    this.returnFalse              = returnFalse;
    this.setImages                = [];
    this.getImages                = getImages;    
}
