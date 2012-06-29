////////////////////////////////////////////////////////////////////////
//
//                            CHEditor 4.2.4
//
//       Author: Na Chang-Ho
//       EMail:  chna@chcode.com
//       Homepage: http://www.chcode.com
//
//       Copyright (C) 1997-2008, CHSoft. All rights reserved.
//
////////////////////////////////////////////////////////////////////////
var chutil = new CH_UTILITIES();
var GB = {
    colors : [
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
    ],
    MSIE    : navigator.userAgent.toLowerCase().indexOf("msie")  != -1,
    GECKO   : navigator.userAgent.toLowerCase().indexOf('gecko') != -1,
    OPERA   : navigator.userAgent.toLowerCase().indexOf('opera') != -1,

    editorMode          : 'rich',
    popupIFrame         : ['fontType', 'fontSize', 'paragraph', 'foreColor', 'backColor', 'BGColor'],
    imageBorder         : '#ccc solid',
    currentRS           : new Object(),
    autoHeight          : false,
    frameFocus          : (navigator.userAgent.toLowerCase().indexOf("msie")  != -1) ? 'onfocus' : 'onload'
}

function CH_UTILITIES()
{
    this.oname;
}

function cheditor(oname)
{
    if (typeof(document.execCommand) == 'undefined')
        return;

    if (GB.MSIE) {
       if (parseFloat(navigator.appVersion.split("MSIE")[1]) < 5.5) {
            this.run = function() {
                document.write("<textarea name=\"message\" id=\"message\" style=\"width:100%;height:200px\"></textarea>");
            };
            return;
        }
    }

    if (GB.GECKO) {
        if (navigator.productSub < 20030210) {
            this.run = function() {
                document.write("<textarea name=\"message\" id=\"message\" style=\"width:100%;height:200px\"></textarea>");
            };
            return;
        }
    }

    this.config = {
        editorWidth     : '100%',
        editorHeight    : '300px',
        editorFontSize  : '9pt',
        editorFontFace  : 'gulim',
        editorBorder    : '1px solid #ccc',
        tabIndex        : 0,
        lineHeight      : 16,
        editorBgcolor   : '#fff',
        editorPath      : '.',
        popupAutoKill   : true,
        fullHTMLSource  : false,
        hrefTarget      : '_blank',
        showTagPath     : true,
        toolBarSplit    : false,
        useBR           : false,
        imgMaxWidth     : 400,
        imgReSize       : true,
        includeHostname : true,
        imgBorder       : '#999 solid',
        usePreview      : true,
        usePrint        : false,
        useCopy         : false,
        usePaste        : true,
        usePasteFromWord: true,
        useSelectAll    : false,
        useBold         : true,
        useUnderline    : true,
        useStrike       : true,
        useItalic       : true,
        useSuperscript  : false,
        useSubscript    : false,
        useJustifyLeft  : false,
        useJustifyCenter: false,
        useJustifyRight : false,
        useJustifyFull  : false,
        useOrderedList  : false,
        useUnOrderedList: false,
        useOutdent      : false,
        useIndent       : false,
        useFontType     : true,
        useParagraph    : true,
        useFontSize     : true,
        useBackColor    : true,
        useForeColor    : true,
        useBGColor      : false,
        useSChar        : false,
        useHyperLink    : true,
        useUnLink       : true,
        useFlash        : true,
        useMedia        : false,
        useUploadImage  : true,
        useBGImage      : false,
        useEmontion     : true,
        useHR           : true,
        autoHeight      : false,
        setPosition     : false
    };
    this.selectedColor      = '#ffc985';
    this.editorPopupBgcolor = '#e3efff';
    this.oname              = oname;
    this.editArea           = null;
    this.editAreaWrapper    = null;
    this.inputForm          = null;
    this.selection          = null;
    this.selectionType      = null;
    this.displayMode        = 'RICH';
    this.szTmp              = '';
    this.images             = new Array();
    this.popupID            = null;
}

cheditor.prototype = {
plainMode : function () {
    this.editAreaWrapper.style.display = 'none';
    document.getElementById('idToolbar'+this.oname).style.display = 'none';
    document.getElementById('editArea_'+this.oname).style.display = 'none';
    document.getElementById('checkBox'+this.oname).style.display = 'none';
    document.getElementById('plain_id'+this.oname).style.display = '';
    document.getElementById('plain_id'+this.oname).focus();
    if (this.config.showTagPath)
        document.getElementById('statusBlock'+this.oname).style.display = 'none';
    this.resetData();
},

htmlMode : function () {
    document.getElementById('plain_id'+this.oname).style.display = 'none';
    this.editAreaWrapper.style.display = '';
    document.getElementById('editArea_'+this.oname).style.display = '';
    document.getElementById('idToolbar'+this.oname).style.display = '';
    document.getElementById('checkBox'+this.oname).style.display = '';
    if (this.config.showTagPath)
        document.getElementById('statusBlock'+this.oname).style.display = '';
    this.resetData();
    this.editArea.focus();
},

createTextarea : function () {
    var wrapper = document.getElementById('container_'+this.oname);
    var textarea = document.createElement("textarea");
    textarea.style.width = this.config.editorWidth;
    textarea.style.height = this.config.editorHeight;
    textarea.style.border = this.config.editorBorder;
    textarea.style.padding = '10px';
    textarea.id = "plain_id"+this.oname;
    textarea.style.display = 'none';
    textarea.style.fontSize = '9pt';
    textarea.style.position = 'relative';
    if (this.config.tabIndex) textarea.tabIndex = this.config.tabIndex;
    wrapper.appendChild(textarea);
},

useBR : function (el) {
    this.editArea.focus();
},

resetData : function () {
    if (GB.editorMode == 'rich') {
        document.getElementById('plain_id'+this.oname).value = this.outputBodyText();
        GB.editorMode = 'plain';
    }
    else {
        var szPlain = document.getElementById('plain_id'+this.oname).value;
        szPlain = szPlain.replace(/\n/g,'<br>');
        this.resetEditArea(szPlain);
        this.setEditorOpt();
        GB.editorMode = 'rich';
    }
},

resetEditArea : function (loadContents) {
    this.editAreaWrapper.style.visibility = 'hidden';
    var oEditor = document.getElementById('id'+this.oname).contentWindow;
    oEditor.document.designMode = "on";
    if (!GB.MSIE) oEditor.document.execCommand('useCSS', false, false);
    oEditor.document.open("text/html", "replace");
    oEditor.document.write("<html><head></head><body>"+loadContents+"</body></html>");
    oEditor.document.close();
    this.editAreaWrapper.style.backgroundColor = this.config.editorBgcolor;
    this.editAreaWrapper.style.margin = '0px';
    this.editAreaWrapper.style.padding = '0px';
    this.editAreaWrapper.fontSize   = this.config.editorFontSize;
    oEditor.document.body.style.fontSize   = this.config.editorFontSize;
    oEditor.document.body.style.fontFamily = this.config.editorFontFace;
    this.editAreaWrapper.style.visibility = 'visible';
    return oEditor;
},

startDrag : function (event, el) {
    GB.currentRS.elNode = this.editAreaWrapper;
    var y = GB.MSIE ? window.event.clientY + document.documentElement.scrollTop + document.body.scrollTop :
        event.clientY + window.pageYOffset;

    GB.currentRS.cursorStartY = y;
    GB.currentRS.elStartTop = parseInt(GB.currentRS.elNode.style.height);
    if (isNaN(GB.currentRS.elStartTop)) GB.currentRS.elStartTop = 0;

    if (GB.MSIE) {
        document.attachEvent("onmousemove", eval(chutil.oname).dragGo);
        document.attachEvent("onmouseup",   eval(chutil.oname).dragStop);
        window.event.cancelBubble = true;
        window.event.returnValue = false;
    }
    else {
        if (GB.GECKO) GB.currentRS.elNode.style.visibility = 'hidden';
        document.addEventListener("mousemove", eval(chutil.oname).dragGo,   true);
        document.addEventListener("mouseup",   eval(chutil.oname).dragStop, true);
        event.preventDefault();
    }
},

dragGo : function (event) {
    var y = (GB.MSIE) ? window.event.clientY + document.documentElement.scrollTop + document.body.scrollTop :
        event.clientY + window.pageYOffset;
    var h = (GB.currentRS.elStartTop + y - GB.currentRS.cursorStartY);
    GB.currentRS.elNode.style.height  = (h < 1 ? 1 : h) + 'px';

    if (GB.MSIE) {
        window.event.cancelBubble = true;
        window.event.returnValue = false;
    }
    else
        event.preventDefault();
},

dragStop : function () {
    if (GB.MSIE) {
        document.detachEvent("onmousemove", eval(chutil.oname).dragGo);
        document.detachEvent("onmouseup",   eval(chutil.oname).dragStop);
    }
    else {
        if (GB.GECKO) GB.currentRS.elNode.style.visibility = 'visible';
        document.removeEventListener("mousemove", eval(chutil.oname).dragGo,   true);
        document.removeEventListener("mouseup",   eval(chutil.oname).dragStop, true);
    }
},

run : function () {
    document.write('<div style="visibility:hidden;position:relative;color:#000;width:'+this.config.editorWidth+'" id="container_'+this.oname+'">');
    this.drawToolbar();
    document.write('<div style="border:'+this.config.editorBorder+'" id="editArea_'+this.oname+'">');
    document.write('<iframe frameborder="0" style="border:0px;width:100%;height:'+this.config.editorHeight+';overflow:auto"'+' id="id'+this.oname+'"');
    if (this.config.tabIndex) document.write(' tabindex="'+this.config.tabIndex+'"');
    document.write(' '+GB.frameFocus+'="chutil.oname=\''+this.oname+'\'"></iframe>');
    document.write('</div>');
    document.write('<div id="CHModifyBlock'+this.oname+'" style="display:none;border-right:'+this.config.editorBorder+';border-left:'+this.config.editorBorder+';border-bottom:'+this.config.editorBorder+';padding:2px;background-color:#eee;font-size:7pt;font-family:verdana;text-align:left">&#160;</div>');

    if (this.config.showTagPath) {
        document.write('<div id="statusBlock'+this.oname+'" style="position:relative;text-align:left;line-height:11px;height:16px;background-color:#eee;border-right:'+this.config.editorBorder+';border-left:'+this.config.editorBorder+';border-bottom:'+this.config.editorBorder+';">');
        document.write('<div id="CHstatusBar'+this.oname+'" style="position:absolute;left:0px;padding:2px;font-size:8pt;font-family:verdana">&lt;HTML&gt; &lt;BODY&gt;</div>');
        document.write('<div onmousedown="'+this.oname+'.startDrag(event,this)" id="reSize'+this.oname+'" style="position:absolute;right:0px;width:11px;cursor:move"><img src="'+this.config.editorPath+'/icons/statusbar_resize.gif" width="11" height="16" alt=""></div>');
        document.write('</div>');
    }
    document.write('<div id="checkBox'+this.oname+'" style="text-align:left;font-size:9pt">');
    if (this.config.useSource)
        document.write('<input type="checkbox" onclick="'+this.oname+'.setDisplayMode()" id="chkDisplayMode" />HTML소스 ');
    if (this.config.usePreview)
        document.write('<input type="checkbox" onclick="'+this.oname+'.previewMode()" id="chkPreviewMode" />미리보기');
    document.write('</div>');

    var loadContents = '';
    if (this.inputForm && document.getElementById(this.inputForm))
        loadContents = document.getElementById(this.inputForm).value;

    if (!GB.MSIE && this.config.setPosition) {
        var show = document.getElementById(this.config.setPosition);
        var container = document.getElementById("container_"+this.oname);
        show.appendChild(container);
    }

    this.editAreaWrapper = document.getElementById("id"+this.oname);
    this.editArea = this.resetEditArea(loadContents);

    document.write('<iframe frameborder="0" border="0" name="idtmp'+this.oname+'" contentEditable="true" id="idtmp'+this.oname+'" style="visibility:hidden;width:0px;height:0px;overflow:auto;" onfocus="'+this.oname+'.boxHide()"></iframe>');
    var tmpeditor = eval("idtmp"+this.oname);
    tmpeditor.document.designMode = "on";
    tmpeditor.document.open("text/html","replace");
    tmpeditor.document.write("<html><head></head><body></body></html>");
    tmpeditor.document.close();

    if (!document.getElementById("foreColor")) {
        htmlOutput = this.createWindow(200, this.setColorTable('fore'));
        document.write('<iframe frameborder="0" id="foreColor" name="foreColor" style="position:absolute;visibility:hidden;z-index:-1;width:1px;height:1px;"></iframe>');
        foreColor.document.open("text/html", "replace");
        foreColor.document.write(htmlOutput);
        foreColor.document.close();
    }
    if (!document.getElementById("backColor")) {
        htmlOutput = this.createWindow(200, this.setColorTable('back'));
        document.write('<iframe frameborder="0" id="backColor" name="backColor" style="position:absolute;visibility:hidden;z-index:-1;width:1px;height:1px;"></iframe>');
        backColor.document.open("text/html", "replace");
        backColor.document.write(htmlOutput);
        backColor.document.close();
    }
    if (!document.getElementById("BGColor")) {
        htmlOutput = this.createWindow(200, this.setColorTable('bgColor'));
        document.write('<iframe frameborder="0" id="BGColor" name="BGColor" style="position:absolute;visibility:hidden;z-index:-1;width:1px;height:1px;"></iframe>');
        BGColor.document.open("text/html", "replace");
        BGColor.document.write(htmlOutput);
        BGColor.document.close();
    }
    if (!document.getElementById("fontType")){
        htmlOutput = '<div style="background-color:'+this.editorPopupBgcolor+'">' +
            "<div style='padding:4px 0px 0px 2px;color:#0E2C5D;background:#6b90c0 url("+this.config.editorPath+"/icons/title_bar_bg.gif);float:left;font-size:9pt'>글꼴 모양</div>"+
            "<div style='background:#6b90c0 url("+this.config.editorPath+"/icons/title_bar_bg.gif);text-align:right;padding:3px;font-size:9pt'>&#160;<img src='"+this.config.editorPath+"/icons/close.gif' width='13' height='13' onclick='parent."+this.oname+".boxHide();' style='vertical-align:top' alt='' /></div>" +
            "<div style='clear:both;border-top:1px solid #8db3e5'></div>" +
            "<div onclick=\"parent."+this.oname+".changeFontType('gulim')\" align=center onmouseover='parent."+this.oname+".mouseOver(this)' onmouseout='parent."+this.oname+".mouseOut(this)' class=dropdown style='padding:2px;font-family:gulim;font-size:9pt;margin:1px'>가나다라마바사 (굴림)</div>" +
            "<div onclick=\"parent."+this.oname+".changeFontType('batang')\" align=center onmouseover='parent."+this.oname+".mouseOver(this)' onmouseout='parent."+this.oname+".mouseOut(this)' class=dropdown style='padding:2px;font-family:batang;font-size:9pt;margin:1px'>가나다라마바사 (바탕)</div>" +
            "<div onclick=\"parent."+this.oname+".changeFontType('dotum')\" align=center onmouseover='parent."+this.oname+".mouseOver(this)' onmouseout='parent."+this.oname+".mouseOut(this)' class=dropdown style='padding:2px;font-family:dotum;font-size:9pt;margin:1px'>가나다라마바사 (돋움)</div>" +
            "<div onclick=\"parent."+this.oname+".changeFontType('gungsuh')\" align=center onmouseover='parent."+this.oname+".mouseOver(this)' onmouseout='parent."+this.oname+".mouseOut(this)' class=dropdown style='padding:2px;font-family:gungsuh;font-size:9pt;margin:1px'>가나다라마바사 (궁서)</div>" +
            "<div onclick=\"parent."+this.oname+".changeFontType('Arial')\" align=center onmouseover='parent."+this.oname+".mouseOver(this)' onmouseout='parent."+this.oname+".mouseOut(this)' class=dropdown style='padding:2px;font-family:Arial;font-size:9pt;margin:1px'>ABCDEFGHIJK (Arial)</div>" +
            "<div onclick=\"parent."+this.oname+".changeFontType('Arial Black')\" align=center onmouseover='parent."+this.oname+".mouseOver(this)' onmouseout='parent."+this.oname+".mouseOut(this)' class=dropdown style='padding:2px;font-family:Arial Black;font-size:9pt;margin:1px'>ABCDEFGHIJK (Arial Black)</div>" +
            "<div onclick=\"parent."+this.oname+".changeFontType('Arial Narrow')\" align=center onmouseover='parent."+this.oname+".mouseOver(this)' onmouseout='parent."+this.oname+".mouseOut(this)' class=dropdown style='padding:2px;font-family:Arial Narrow;font-size:9pt;margin:1px'>ABCDEFGHIJK (Arial Narrow)</div>" +
            "<div onclick=\"parent."+this.oname+".changeFontType('Comic Sans MS')\" align=center onmouseover='parent."+this.oname+".mouseOver(this)' onmouseout='parent."+this.oname+".mouseOut(this)' class=dropdown style='padding:2px;font-family:Comic Sans MS;font-size:9pt;margin:1px'>ABCDEFGHIJK (Comic Sans MS)</div>" +
            "<div onclick=\"parent."+this.oname+".changeFontType('Courier New')\" align=center onmouseover='parent."+this.oname+".mouseOver(this)' onmouseout='parent."+this.oname+".mouseOut(this)' class=dropdown style='padding:2px;font-family:Courier New;font-size:9pt;margin:1px'>ABCDEFGHIJK (Courier New)</div>" +
            "<div onclick=\"parent."+this.oname+".changeFontType('Tahoma')\" align=center onmouseover='parent."+this.oname+".mouseOver(this)' onmouseout='parent."+this.oname+".mouseOut(this)' class=dropdown style='padding:2px;font-family:Tahoma;font-size:9pt;margin:1px'>ABCDEFGHIJK (Tahoma)</div>" +
            "<div onclick=\"parent."+this.oname+".changeFontType('Times New Roman')\"  align=center onmouseover='parent."+this.oname+".mouseOver(this)' onmouseout='parent."+this.oname+".mouseOut(this)' class=dropdown style='padding:2px;font-family:Times New Roman;font-size:9pt;margin:1px'>ABCDEFGHIJK (Times New Roman)</div>" +
            "<div onclick=\"parent."+this.oname+".changeFontType('Verdana')\" align=center onmouseover='parent."+this.oname+".mouseOver(this)' onmouseout='parent."+this.oname+".mouseOut(this)' class=dropdown style='padding:2px;font-family:Verdana;font-size:9pt;margin:1px'>ABCDEFGHIJK (Verdana)</div>" +
            "</div>";

        htmlOutput = this.createWindow(220, htmlOutput);
        document.write('<iframe frameborder="0" id="fontType" name="fontType" style="position: absolute;visibility: hidden;z-index: -1;width:1px;height:1px"></iframe>');
        fontType.document.open("text/html","replace");
        fontType.document.write(htmlOutput);
        fontType.document.close();
    }
    if (!document.getElementById("paragraph")) {
        htmlOutput = '<div style="background-color:'+this.editorPopupBgcolor+'">' +
            "<div style='padding:4px 0px 0px 2px;color:#0E2C5D;background:#6b90c0 url("+this.config.editorPath+"/icons/title_bar_bg.gif);float:left;font-size:9pt'>제목 선택</div>"+
            "<div style='background:#6b90c0 url("+this.config.editorPath+"/icons/title_bar_bg.gif);text-align:right;padding:3px;font-size:9pt'>&#160;<img src='"+this.config.editorPath+"/icons/close.gif' width='13' height='13' onclick='parent."+this.oname+".boxHide();' style='vertical-align:top' alt='' /></div>" +
            "<div style='clear:both;border-top:1px solid #8db3e5'></div>" +
            "<div onclick=\"parent."+this.oname+".applyParagraph('<H1>')\"  align='center' onmouseover='parent."+this.oname+".mouseOver(this)' onmouseout='parent."+this.oname+".mouseOut(this)' class='dropdown' style='padding:3px;margin:1px'><h1 style='margin:0'>제목 1</h1></div>" +
            "<div onclick=\"parent."+this.oname+".applyParagraph('<H2>')\"  align='center' onmouseover='parent."+this.oname+".mouseOver(this)' onmouseout='parent."+this.oname+".mouseOut(this)' class='dropdown' style='padding:3px;margin:1px'><h2 style='margin:0'>제목 2</h2></div>" +
            "<div onclick=\"parent."+this.oname+".applyParagraph('<H3>')\"  align='center' onmouseover='parent."+this.oname+".mouseOver(this)' onmouseout='parent."+this.oname+".mouseOut(this)' class='dropdown' style='padding:3px;margin:1px'><h3 style='margin:0'>제목 3</h3></div>" +
            "<div onclick=\"parent."+this.oname+".applyParagraph('<H4>')\"  align='center' onmouseover='parent."+this.oname+".mouseOver(this)' onmouseout='parent."+this.oname+".mouseOut(this)' class='dropdown' style='padding:3px;margin:1px'><h4 style='margin:0'>제목 4</h4></div>" +
            "<div onclick=\"parent."+this.oname+".applyParagraph('<H5>')\"  align='center' onmouseover='parent."+this.oname+".mouseOver(this)' onmouseout='parent."+this.oname+".mouseOut(this)' class='dropdown' style='padding:3px;margin:1px'><h5 style='margin:0'>제목 5</h5></div>" +
            "<div onclick=\"parent."+this.oname+".applyParagraph('<H6>')\"  align='center' onmouseover='parent."+this.oname+".mouseOver(this)' onmouseout='parent."+this.oname+".mouseOut(this)' class='dropdown' style='padding:3px;margin:1px'><h6 style='margin:0'>제목 6</h6></div>" +
            "<div onclick=\"parent."+this.oname+".applyParagraph('<PRE>')\" align='center' onmouseover='parent."+this.oname+".mouseOver(this)' onmouseout='parent."+this.oname+".mouseOut(this)' class='dropdown' style='padding:3px;margin:1px'><pre style='margin:0'>Preformatted</pre></div>" +
            "<div onclick=\"parent."+this.oname+".applyParagraph('<P>')\"   align='center' onmouseover='parent."+this.oname+".mouseOver(this)' onmouseout='parent."+this.oname+".mouseOut(this)' class='dropdown' style='padding:3px;margin:1px'><p style='margin:0px'>보통</p></div>" +
            "</div>";

        htmlOutput = this.createWindow(200, htmlOutput);
        document.write('<iframe frameborder="0" id="paragraph" name="paragraph" style="position: absolute;visibility: hidden; z-index: 1;width:1px;height:1px"></iframe>');
        paragraph.document.open("text/html", "replace");
        paragraph.document.write(htmlOutput);
        paragraph.document.close();
    }
    if (!document.getElementById("fontSize")) {
        htmlOutput =  '<div style="background-color:'+this.editorPopupBgcolor+'">' +
            "<div style='padding:4px 0px 0px 2px;color:#0E2C5D;background:#6b90c0 url("+this.config.editorPath+"/icons/title_bar_bg.gif);float:left;font-size:9pt'>글꼴 크기</div>"+
            "<div style='background:#6b90c0 url("+this.config.editorPath+"/icons/title_bar_bg.gif);text-align:right;padding:3px;font-size:9pt'>&#160;<img src='"+this.config.editorPath+"/icons/close.gif' width='13' height='13' onclick='parent."+this.oname+".boxHide();' style='vertical-align:top' alt='' /></div>" +
            "<div style='clear:both;border-top:1px solid #8db3e5'></div>" +
            "<div onclick=\"parent."+this.oname+".changeFontSize(8)\" onmouseover='parent."+this.oname+".mouseOver(this)' onmouseout='parent."+this.oname+".mouseOut(this)' class='dropdown' style='padding:2px;margin:1px;'><span style='font-size:8pt'>가나다라 (8pt)</span></div>" +
            "<div onclick=\"parent."+this.oname+".changeFontSize(9)\" onmouseover='parent."+this.oname+".mouseOver(this)' onmouseout='parent."+this.oname+".mouseOut(this)' class='dropdown' style='padding:2px;margin:1px;'><span style='font-size:9pt'>가나다라 (9pt)</span></div>" +
            "<div onclick=\"parent."+this.oname+".changeFontSize(10)\" onmouseover='parent."+this.oname+".mouseOver(this)' onmouseout='parent."+this.oname+".mouseOut(this)' class='dropdown' style='padding:2px;margin:1px;'><span style='font-size:10pt'>가나다라 (10pt)</span></div>" +
            "<div onclick=\"parent."+this.oname+".changeFontSize(11)\" onmouseover='parent."+this.oname+".mouseOver(this)' onmouseout='parent."+this.oname+".mouseOut(this)' class='dropdown' style='padding:2px;margin:1px;'><span style='font-size:11pt'>가나다라 (11pt)</span></div>" +
            "<div onclick=\"parent."+this.oname+".changeFontSize(12)\" onmouseover='parent."+this.oname+".mouseOver(this)' onmouseout='parent."+this.oname+".mouseOut(this)' class='dropdown' style='padding:2px;margin:1px;'><span style='font-size:12pt'>가나다라 (12pt)</span></div>" +
            "<div onclick=\"parent."+this.oname+".changeFontSize(14)\" onmouseover='parent."+this.oname+".mouseOver(this)' onmouseout='parent."+this.oname+".mouseOut(this)' class='dropdown' style='padding:2px;margin:1px;'><span style='font-size:14pt'>가나다라 (14pt)</span></div>" +
            "<div onclick=\"parent."+this.oname+".changeFontSize(16)\" onmouseover='parent."+this.oname+".mouseOver(this)' onmouseout='parent."+this.oname+".mouseOut(this)' class='dropdown' style='padding:2px;margin:1px;'><span style='font-size:16pt'>가나다라 (16pt)</span></div>" +
            "<div onclick=\"parent."+this.oname+".changeFontSize(18)\" onmouseover='parent."+this.oname+".mouseOver(this)' onmouseout='parent."+this.oname+".mouseOut(this)' class='dropdown' style='padding:2px;margin:1px;'><span style='font-size:18pt'>가나다라 (18pt)</span></div>" +
            "</div>";

        htmlOutput = this.createWindow(200, htmlOutput);
        document.write('<iframe frameborder="0" id="fontSize" name="fontSize" style="position: absolute;visibility: hidden;z-index: -1;width:1px;height:1px;"></iframe>');
        fontSize.document.open("text/html","replace");
        fontSize.document.write(htmlOutput);
        fontSize.document.close();
    }

    document.write('<div id="dwindow_'+this.oname+'" style="border:1px solid #8db3e5;visibility:hidden;position:absolute;background-color:#ebe9ed;left:0px;top:0px;" onselectstart="return false">');
    document.write('<div style="text-align:left;height:10px;padding:10px 0px 0px 3px;background:#6b90c0 url('+this.config.editorPath+'/icons/title_bar_bg.gif);"><div id="popupTitle_'+this.oname+'" style="margin-top:-7px;font-size:9pt;color:#0e2c5d;"></div></div>');
    document.write('<div id="cframe_'+this.oname+'" style="border-top:1px solid #8db3e5;background-color:#ebe9ed;"></div></div>');
    document.write('</div>'); //Container

    if (GB.MSIE && this.config.setPosition) {
        var show = document.getElementById(this.config.setPosition);
        var container = document.getElementById("container_"+this.oname);
        show.appendChild(container);
    }

    document.getElementById("container_"+this.oname).style.visibility = 'visible';
    this.popupID = document.getElementById('dwindow_'+this.oname);
    GB.autoHeight = this.config.autoHeight;
    this.editArea.focus();
    this.createTextarea();
    this.setEditorOpt();
},

movePosition : function (el) {
    var show = document.getElementById(el);
    var container = document.getElementById("showEditor");
    show.appendChild(container);
},

setEditorOpt : function () {
    if (GB.MSIE) this.editArea.document.onkeydown = this.doOnKeyPress;
    this.addEvent(this.editArea.document, "mouseup");
},

addEvent : function (doc, ev) {
    var func = function () { cheditor.setEditorEvent(chutil.oname) };
    GB.MSIE ? doc.attachEvent("on"+ev, func) : doc.addEventListener(ev, func, false);
},

toolbarButtonOut : function (elemButton) {
    var nTop = elemButton.style.top.substring(0, elemButton.style.top.length - 2);
    elemButton.style.top = nTop * 1 + 22 + 'px';
},

toolbarButtonOver : function (elemButton) {
    var nTop = elemButton.style.top.substring(0, elemButton.style.top.length - 2);
    elemButton.style.top = nTop - 22 + 'px';
},

drawToolbar : function () {
    document.write('<img src="'+this.config.editorPath+'"/icons/toolbar_icon_1.gif" width="1" height="1" style="display:none" alt="" />');
    document.write('<img src="'+this.config.editorPath+'"/icons/toolbar_icon_2.gif" width="1" height="1" style="display:none" alt="" />');
    document.write('<img src="'+this.config.editorPath+'"/icons/toolbar_icon_3.gif" width="1" height="1" style="display:none" alt="" />');
    document.write('<img src="'+this.config.editorPath+'"/icons/toolbar_icon_4.gif" width="1" height="1" style="display:none" alt="" />');
    document.write('<img src="'+this.config.editorPath+'"/icons/toolbar_icon_5.gif" width="1" height="1" style="display:none" alt="" />');
    document.write('<img src="'+this.config.editorPath+'"/icons/toolbar_icon_6.gif" width="1" height="1" style="display:none" alt="" />');
    document.write('<img src="'+this.config.editorPath+'"/icons/toolbar_icon_7.gif" width="1" height="1" style="display:none" alt="" />');
    document.write('<img src="'+this.config.editorPath+'"/icons/toolbar_icon_8.gif" width="1" height="1" style="display:none" alt="" />');
    document.write('<img src="'+this.config.editorPath+'"/icons/toolbar_icon_9.gif" width="1" height="1" style="display:none" alt="" />');
    document.write('<img src="'+this.config.editorPath+'"/icons/toolbar_icon_10.gif" width="1" height="1" style="display:none" alt="" />');
    document.write('<table border="0" cellpadding="0" cellspacing="0" width="100%" id="idToolbar'+this.oname+'">');
    document.write('<tr><td align="left">');
    if (this.config.usePrint) this.drawToolbarIcon(1,0,22,"btnPrint"+this.oname, "인쇄", this.oname + ".doCmd('Print',false)");
    if (this.config.useCopy) this.drawToolbarIcon(1,132,22,"btnCopy"+this.oname, "복사", this.oname + ".doCmd('Copy',false)");
    if (this.config.useCut) this.drawToolbarIcon(2,0,22,"btnCut"+this.oname, "잘라내기", this.oname + ".doCmd('Cut',false)");
    if (this.config.usePaste) this.drawToolbarIcon(2,44,22,"btnPaste"+this.oname, "붙이기", this.oname + ".doCmd('Paste',false)");
    if (this.config.usePasteFromWord) this.drawToolbarIcon(10,88,22,"btnPaste"+this.oname, "MS워드 붙이기", this.oname + ".doCmd('PasteFromWord',false)");
    if (this.config.useSelectAll) this.drawToolbarIcon(2,88,22,"btnSelectAll"+this.oname, "전체 선택", this.oname + ".doCmd('SelectAll',false)");
    if (this.config.useBold) this.drawToolbarIcon(2,132,22,"btnBold"+this.oname, "진하게", this.oname + ".doCmd('Bold',false)");
    if (this.config.useUnderline) this.drawToolbarIcon(3,0,22,"btnUnderline"+this.oname, "밑줄", this.oname + ".doCmd('Underline',false)");
    if (this.config.useStrike) this.drawToolbarIcon(3,44,22,"btnStrikethrough"+this.oname, "취소선", this.oname + ".doCmd('Strikethrough',false)");
    if (this.config.useItalic) this.drawToolbarIcon(3,88,22,"btnItalic"+this.oname, "기울임", this.oname + ".doCmd('Italic',false)");
    if (this.config.useSuperscript) this.drawToolbarIcon(3,132,22,"btnSuperscript"+this.oname, "위첨자", this.oname + ".doCmd('Superscript',false)");
    if (this.config.useSubscript) this.drawToolbarIcon(4,0,22,"btnSubscript"+this.oname, "아래 첨자", this.oname + ".doCmd('Subscript',false)");
    if (this.config.useJustifyLeft) this.drawToolbarIcon(4,44,22,"btnJustifyLeft"+this.oname, "왼쪽 정렬", this.oname + ".doCmd('JustifyLeft',false)");
    if (this.config.useJustifyCenter) this.drawToolbarIcon(4,88,22,"btnJustifyCenter"+this.oname, "가운데 정렬", this.oname + ".doCmd('JustifyCenter',false)");
    if (this.config.useJustifyRight) this.drawToolbarIcon(4,132,22,"btnJustifyRight"+this.oname, "오른쪽 정렬", this.oname + ".doCmd('JustifyRight',false)");
    if (this.config.useJustifyFull) this.drawToolbarIcon(5,0,22,"btnJustifyFull"+this.oname, "양쪽 정렬", this.oname + ".doCmd('JustifyFull',false)");
    if (this.config.useOrderedList) this.drawToolbarIcon(5,44,22,"btnOrderedList"+this.oname, "문단 번호", this.oname + ".doCmd('InsertOrderedList',false)");
    if (this.config.useUnOrderedList) this.drawToolbarIcon(5,88,22,"btnUnorderedList"+this.oname, "글 머리표",    this.oname + ".doCmd('InsertUnorderedList',false)");
    if (this.config.useOutdent) this.drawToolbarIcon(5,132,22,"btnOutdent"+this.oname, "왼쪽여백 줄이기", this.oname + ".doCmd('Outdent',false)");
    if (this.config.useIndent) this.drawToolbarIcon(6,0,22,"btnIndent"+this.oname, "왼쪽여백 늘리기", this.oname + ".doCmd('Indent',false)");
    if (this.config.toolBarSplit) document.write('</td></tr><tr><td>');
    if (this.config.useFontType) this.drawToolbarIcon(8,0,29,"btnFontType"+this.oname, "글꼴",this.oname+".windowPos(this,'fontType');"+ this.oname + ".displayWindow('fontType');");
    if (this.config.useParagraph) this.drawToolbarIcon(8,44,29,"btnParaGraph"+this.oname, "제목",this.oname+".windowPos(this,'paragraph');"+this.oname + ".displayWindow('paragraph');");
    if (this.config.useFontSize) this.drawToolbarIcon(8,88,29,"btnFontSize"+this.oname, "글꼴크기",this.oname+".windowPos(this,'fontSize');"+this.oname + ".displayWindow('fontSize');");
    if (this.config.useBackColor) this.drawToolbarIcon(9,88,22,"btnBackColor"+this.oname, "형광펜",this.oname+".windowPos(this,'backColor');"+this.oname + ".displayWindow('backColor');");
    if (this.config.useForeColor) this.drawToolbarIcon(9,132,22,"btnForeColor"+this.oname, "글자색",this.oname+".windowPos(this,'foreColor');"+this.oname + ".displayWindow('foreColor');");
    if (this.config.useBGColor) this.drawToolbarIcon(9,44,22,"btnBGColor"+this.oname, "바탕색",this.oname+".windowPos(this,'BGColor');"+this.oname + ".displayWindow('BGColor');");
    if (this.config.useSChar) this.drawToolbarIcon(7,132,22,"btnSChar"+this.oname, "특수문자", this.oname + ".windowOpen('schar')");
    if (this.config.useHyperLink) this.drawToolbarIcon(6,44,22,"btnhyperLink"+this.oname, "하이퍼링크", this.oname + ".windowOpen('hyperLink')");
    if (this.config.useUnLink) this.drawToolbarIcon(6,88,22,"btnUnLink"+this.oname, "하이퍼링크 해제", this.oname + ".doCmd('UnLink',false)");
    if (this.config.useFlash) this.drawToolbarIcon(9,0,22,"btnFlash"+this.oname, "플래쉬 무비", this.oname + ".windowOpen('flash')");
    if (this.config.useMedia) this.drawToolbarIcon(6,132,22,"btnMedia"+this.oname, "미디어", this.oname + ".windowOpen('media')");
    if (this.config.useUploadImage) this.drawToolbarIcon(7,0,22,"btnImage"+this.oname, "그림넣기", this.oname + ".windowOpen('image')");
    if (this.config.useBGImage) this.drawToolbarIcon(7,44,22,"btnBgImage"+this.oname, "배경그림", this.oname + ".windowOpen('bgimage')");
    if (this.config.useEmontion) this.drawToolbarIcon(7,88,22,"btnEm"+this.oname, "표정 아이콘", this.oname + ".windowOpen('emotion')");
    if (this.config.useHR) this.drawToolbarIcon(10,0,22,"btnHorizontalRule"+this.oname, "가로선", this.oname + ".doCmd('InsertHorizontalRule')");
    document.write('</td></tr></table>');
},

changeFontType : function (val) {
    eval(fontType.document.getElementById("CHEditor").value).doCmdPopup("fontName",val);
},

setColor : function (color, _which) {
    if (_which == 'back')
        eval(backColor.document.getElementById("CHEditor").value).doCmdPopup(GB.MSIE ? 'BackColor' : 'HiliteColor', color);
    else
        eval(foreColor.document.getElementById("CHEditor").value).doCmdPopup('ForeColor', color);
},

setBgColor : function (color) {
    if (GB.MSIE)
        eval(BGColor.document.getElementById("CHEditor").value).doBgColor(color);
    else
        eval(BGColor.document.getElementById("CHEditor").value).doCmdPopup("BackColor",color);
},

doBgColor : function (color) {
    this.editArea.document.body.style.backgroundColor = color;
    this.selection.select();
    this.boxHide();
    this.editArea.focus();
},

applyParagraph : function (val) {
    eval(paragraph.document.getElementById("CHEditor").value).doCmdPopup("FormatBlock",val);
},

changeFontSize : function (val) {
    eval(fontSize.document.getElementById("CHEditor").value).doCmdPopup("fontSize",val);
},

getElement : function (elm, tag) {
    while (elm != null && elm.tagName != tag) {
        if (elm.id == 'id'+this.oname) return null;
        elm = elm.parentElement;
    }
    return elm;
},

hyperLink: function (szURL, szTarget, szTitle) {
    var selection = this.selection;
    var selectionType = this.selectionType;
    var range, el;

    if (GB.MSIE) {
        selection.select();
        selection = this.fixSelection(selection);
        selectionType = this.fixSelectionType(selection, selectionType);
        var target = (selectionType == "None" ? document.getElementById('id'+this.oname).document : selection);
        target.execCommand("UnLink", false);
        target.execCommand("CreateLink", false, szURL);
        el = selection.parentElement ? selection.parentElement() : this.getElement(selection.item(0),"A");
    }
    else {
        selection = this._getSelection();
        if (typeof selection != "undefined") range = selection.getRangeAt(0);
        document.getElementById("id"+this.oname).contentDocument.execCommand("CreateLink", false, szURL);
        el = range.startContainer.previousSibling;
    }

    if (el) {
        if (szTarget) el.target = szTarget;
        if (szTitle) el.title = szTitle;
    }
},

insertBgImage: function (img) {
    this.editArea.focus();
    if (img) {
        img = this.config.editorPath + '/' + img;
        this.editArea.document.body.style.backgroundImage = "url("+img+")";
    }
    else {
        var s = this.editArea.document.body.style;
        GB.MSIE ? s.removeAttribute("backgroundImage") : s.backgroundImage = "none";
    }
},

doInsertImage : function (images) {
    for (var i=0; i<images.length; i++) {
        var img = new Image();
        img.src = images[i]['filepath'];
        img.width = images[i]['width'];
        img.height = images[i]['height'];
        img.align = images[i]['align'];
        img.alt = images[i]['alt'] ? images[i]['alt'] : '';
        img.border = 0;

        var imgInfo = new Object();
        imgInfo['src'] = img.src;
        imgInfo['filename'] = images[i]['fileorig'];
        imgInfo['fileid'] = images[i]['filename'];
        imgInfo['width'] = img.width;
        imgInfo['height'] = img.height;

        this.images.push(imgInfo);
        this.insertImage(img);
    }
},

insertImage : function (image) {
    var linebreak = false;
    var reSize = false;
    var outer = image;

    if (this.config.imgReSize) reSize = this.resizeImageComplete(image);
    if (image.alt == 'break') {
        linebreak = true;
        image.removeAttribute("align");
        image.alt = '';
    }

    if (reSize) {
        var szRandom = Math.random();
        var imgId = 'image_'+szRandom;
        var thumb = 'thumb_'+szRandom;
        var href = document.createElement('a');

        imgId = imgId.replace(/\./,'');
        thumb = thumb.replace(/\./,'');

        image.id = imgId;
        image.className = 'chimg_photo';
        image.onload = 'true';
        href.id = thumb;
        href.href = image.src;
        href.className = 'imageUtil';
        href.onclick = 'return hs.run(this)';
        href.appendChild(image);
        outer = href;
    }

    if (linebreak) {
        var p = document.createElement('p');
        p.style.width = '100%';
        p.style.margin = '5px 0px';
        p.appendChild(outer);
        outer = p;
    }

    this.doCmdPaste(this._outerHTML(outer));
},

_outerHTML : function (obj) {
    if (obj) {
        if (GB.MSIE) return obj.outerHTML;
        else {
            var html = document.createElement('div');
            html.appendChild(obj);
            return html.innerHTML;
        }
    }
},

resizeImageComplete : function (img) {
    var maxWidth = this.config.imgMaxWidth;
    if (img.width <= maxWidth) return false;

    img.style.width  = maxWidth + 'px';
    img.style.height = Math.round((img.height * maxWidth) / img.width) + 'px';
    img.removeAttribute("width");
    img.removeAttribute("height");

    return true;
},

showTagSelector : function (on) {
    if (!this.config.showTagPath) return;
    var el = document.getElementById("CHstatusBar"+this.oname);
    el.style.display = on ? '' : 'none';
},

makeHtmlContent : function () {
    if (GB.MSIE)
        return this.editArea.document.body.innerText;

    var content = this.editArea.document.body.innerHTML;
    content = content.replace (/<br>/ig, '\n');
    content = content.replace (/<\/font>/ig, '');
    content = content.replace (/<font (.+?)>/ig, '');
    return content;
},

resetStatusBar : function () {
    document.getElementById('CHstatusBar'+this.oname).innerHTML = '&lt;HTML&gt; &lt;BODY&gt; ';
},

previewMode : function () {
    this.selection = null;
    this.popupWinClose();
    this.resetStatusBar();
    this.editAreaWrapper.style.visibility = 'hidden';

    if (this.displayMode=='RICH') {
        document.getElementById("CHModifyBlock"+this.oname).style.display = 'none';
        this.showTagSelector(false);
        this.editArea.document.body.contentEditable = false;
        if (!GB.MSIE) this.editArea.document.designMode = "off";
        this.displayMode = 'HTML';
        var tmpHeight = this.editAreaWrapper.offsetHeight +
            document.getElementById("idToolbar"+this.oname).offsetHeight;
        document.getElementById("idToolbar"+this.oname).style.display = "none";
        this.editAreaWrapper.style.height =  tmpHeight+'px';
    }
    else {
        this.displayMode = 'RICH';
        this.editArea.document.body.contentEditable = true;
        if (!GB.MSIE) this.editArea.document.designMode = "on";
        document.getElementById("idToolbar"+this.oname).style.display = '';
        var tmpHeight = this.editAreaWrapper.offsetHeight -
            document.getElementById("idToolbar"+this.oname).offsetHeight;
        this.editAreaWrapper.style.height = tmpHeight + 'px';
        this.showTagSelector(true);
        this.setEditorOpt();
    }
    this.editAreaWrapper.style.visibility = 'visible';
    this.editArea.focus();
},

putContents : function (sContent) {
    if (!GB.MSIE)
        sContent = sContent.replace(/&lt;/g,'<').replace(/&gt;/g,'>');

    this.editArea.document.body.style.cssText = this.szTmp;
    this.editArea.document.body.innerHTML = (this.config.fullHTMLSource == false) ? sContent :
       this.docSplit(sContent);
    this.editArea.document.body.contentEditable = true;

    if (GB.MSIE) {
        this.editArea.document.execCommand("2D-Position", true, true);
        this.editArea.document.execCommand("MultipleSelection", true, true);
        this.editArea.document.execCommand("LiveResize", true, true);
    }
},

getImages : function () {
    var img = this.editArea.document.body.getElementsByTagName('img');
    var imgNumber = this.images.length;
    var imgArr = new Array();

    for (i=0; i<img.length; i++) {
        if (img[i].src) {
            var imgid = img[i].src;
            imgid = imgid.slice(imgid.lastIndexOf("/") + 1);
            for (var j=0; j<imgNumber; j++) {
                if (this.images[j]['fileid'] == imgid) {
                    imgArr.push(this.images[j]);
                    break;
                }
            }
        }
    }

    return imgArr.length > 0 ? imgArr : false;
},

getContents : function (op) {
    if (this.config.hrefTarget != '' || this.config.hrefTarget != null) {
        for (var i=0; i < this.editArea.document.links.length; i++) {
            if (!this.editArea.document.links[i].target) {
                this.editArea.document.links[i].target = this.config.hrefTarget;
            }
        }
    }

    this.szTmp = this.editArea.document.body.style.cssText;
    this.editArea.document.body.style.border = "";
    this.editArea.document.body.removeAttribute("contentEditable", 0);

    if (op == true) {
        var img = this.editArea.document.body.getElementsByTagName('img');
        var hostname = location.hostname;
        for (i=0; i<img.length; i++) {
            if (img[i].src) {
                if (!this.config.includeHostname && img[i].src.indexOf(hostname) != -1) {
                    img[i].src = img[i].src.substring(img[i].src.indexOf(hostname) + hostname.length);
                }

                if (img[i].getAttribute("onload")) {
                    var href = img[i].parentNode;
                    if (href && href.nodeName == 'A') {
                        href.removeAttribute("target");
                    }
                    img[i].onload = 'javascript:addCaption(this)';
                }
            }
            else {
                img[i].removeAttribute("onload", "", 0);
            }
        }
    }

    var content = this.editArea.document.documentElement;
    var mydoc = '';

    if (GB.MSIE) mydoc = content.outerHTML;
    else if (GB.OPERA) mydoc = '<HTML>'+content.innerHTML+'</BODY></HTML>';
    else mydoc = '<html>'+content.innerHTML+'</html>';

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
},

docSplit : function (mydoc) {
    mydoc = mydoc.substr(mydoc.search(/<body/ig) + 1);
    mydoc = mydoc.substr(mydoc.indexOf(">") + 1);
    mydoc = mydoc.slice(0, mydoc.search(/<\/body/ig));
    mydoc = mydoc.replace(/^\s+/g, "");
    return mydoc;
},

returnContents : function (mydoc) {
    this.editArea.document.body.contentEditable = true;
    if (this.inputForm && document.getElementById(this.inputForm))
        document.getElementById(this.inputForm).value = mydoc;
    return mydoc;
},

outputPlainText : function () {
    var mydoc = document.getElementById('plain_id'+this.oname).value;
    mydoc = mydoc.replace(/\n/g, '<br />');
    return this.returnContents(mydoc);
},

outputHTML : function () {
    if (GB.editorMode != 'rich') return this.outputPlainText();
    this.resetViewHTML();
    var mydoc = this.getContents(true);
    mydoc = mydoc.replace (/<META(.+?)name=generator>/ig, "");
    mydoc = mydoc.replace (/<link href=(.*?)>/ig, '');
    return this.returnContents(mydoc);
},

outputBodyHTML : function () {
    if (GB.editorMode != 'rich') return this.outputPlainText();
    var str = this.docSplit(this.outputHTML());
    return this.returnContents(str);
},

outputBodyText : function () {
    return (GB.MSIE) ? this.editArea.document.body.innerText :
        this.outputBodyHTML().replace(/<br>/ig, "\n").replace(/<[^>]+>/g, "");
},

resetViewHTML : function () {
    var chkViewHtml = document.getElementById("chkDisplayMode");
    if (chkViewHtml != null && chkViewHtml.checked) {
        chkViewHtml.checked = false;
        this.setDisplayMode();
    }
},

returnFalse : function () {
    this.resetViewHTML();
    this.editArea.focus();
    var img = this.editArea.document.body.getElementsByTagName('img');
    for (i=0; i<img.length; i++) {
        if (img[i].src) {
            if (img[i].getAttribute("onload")) {
                img[i].onload = 'true';
            }
        }
        else {
            img[i].removeAttribute("onload", "", 0);
            img[i].removeAttribute("className", "", 0);
        }
    }
    this.setEditorOpt();
    return false;
},

trimSpace : function (str) {
    str = str.replace (/^\s+/g, '');
    str = str.replace (/\s+$/g, '');
    str = str.replace (/\r\n/g, '');
    str = str.replace (/\n/g, '');
    return str;
},

strLength : function (str) {
    var len = str.length;
    var mbytes = 0;
    var i = 0;

    for (; i<len; i++) {
        var c = str.charCodeAt(i);
        if (c > 128) mbytes++;
    }

    return (len-mbytes) + (mbytes*2);
},

contentsLengthAll : function () {
    this.resetViewHTML();
    return this.outputHTML().length;
},

contentsLength : function () {
    this.resetViewHTML();
    var content = this.outputBodyHTML();
    content = this.trimSpace(content);

    if (!content || content == "")
        return 0;

    return this.strLength(content);
},

inputLength : function () {
    this.resetViewHTML();
    var content = this.trimSpace(this.outputBodyText());

    if (!content || content == "")
        return 0;

    return this.strLength(content);
},

setSelection : function () {
    this.selection = this._getSelection();
    this.selectionType = this._getSelectionType(this.selection);
},

dimension : function (boxName) {
    var tblPopup = eval(boxName).document.getElementById('tblPopup');
    document.getElementById(boxName).style.width = tblPopup.offsetWidth + 'px';
    document.getElementById(boxName).style.height = tblPopup.offsetHeight + 'px';
},

displayWindow : function (boxName) {
    this.boxHide();
    this.setSelection();
    eval(boxName).document.getElementById("CHEditor").value = this.oname;
    this.dimension(boxName);
    document.getElementById(boxName).style.visibility = "visible";
    document.getElementById(boxName).style.zIndex = 2;

    if (this.config.popupAutoKill)
        document.getElementById(boxName).onmouseout = this.boxHide;

    this.popupWinClose();
},

mouseOver : function (el) {
    el.style.background = this.selectedColor;
},

mouseOut : function (el) {
    el.style.background = this.editorPopupBgcolor;
},

windowPos : function (idImg, boxName) {
    var myLeft = idImg.parentNode.offsetLeft;
    var myTop = idImg.parentNode.offsetTop + 24;
    document.getElementById(boxName).style.left = myLeft + 'px';
    document.getElementById(boxName).style.top = myTop + 'px';
},

boxHide : function() {
    for (i=0; i < GB.popupIFrame.length; i++)
        if (document.getElementById(GB.popupIFrame[i]))
            document.getElementById(GB.popupIFrame[i]).style.visibility = 'hidden';
},

createWindow : function (width, content) {
    var str = '<style>'
        + 'body {margin:0px;padding:0px;border:0px;background-color:'+this.editorPopupBgcolor+';font-family:'+this.config.editorFontFace+'}'
        + '.dropdown {cursor:pointer}'
        + '</style>'
        + '<body onselectstart="return event.srcElement.tagName==\'INPUT\'" oncontextmenu="return false">'
        + '<div style="width:'+width+'px;margin:0px;padding:0px;border:#8db3e5 1px solid;" id="tblPopup">'
        + content
        + '</div>'
        + '<input type="text" style="display:none" id="CHEditor" contentEditable="true" />'
        + '</body>';

    return str;
},


setColorTable : function (_which) {
    var title = (_which == 'back') ? '형광펜' : (_which == 'bgColor' ? '바탕색' : '글자색');
    var strCap =
        '<div style="padding:4px 0px 0px 2px;color:#0E2C5D;background:#6b90c0 url('+this.config.editorPath+'/icons/title_bar_bg.gif);float:left;font-size:9pt">'+title+'</div>'+
        '<div style="background:#6b90c0 url('+this.config.editorPath+'/icons/title_bar_bg.gif);text-align:right;padding:3px;font-size:9pt">&#160;<img src="'+this.config.editorPath+'/icons/close.gif" width="13" height="13" onclick="parent.'+this.oname+'.boxHide();" style="vertical-align:top" alt="" /></div><div style="border-top:1px solid #8db3e5">' +
        '     <table cellpadding="1" cellspacing="5" style="cursor: '+
        '         pointer;font-family:Verdana;font-size:7px;border:0px'+
        '         " bgcolor="#e3efff">'+
        '       <tr>'+
        '         <td colspan="10" id="cellColor" style="border:1px solid #000;height:20px;font-family:verdana;font-size:12px;text-align:center">없음'+
        '         </td>'+
        '       </tr>';
    var colorRows = [strCap];
    var k = 0;
    var w = 14;
    var h = 10;
    var eCellColor = "document.getElementById('cellColor').style.backgroundColor";
    var cmd = (_which == 'back') ? ".setColor("+eCellColor+",'back')" :
        (_which == 'fore' ? ".setColor("+eCellColor+",'fore')" : ".setBgColor("+eCellColor+")");

    colorRows[colorRows.length] = '<div style="padding:1px">';

    for (var i = 0; i < w; i++) {
        colorRows[colorRows.length] = "<tr>";
        for (var j = 0; j < h; j++) {
            colorRows[colorRows.length] = '<td onmouseover="parent.'+this.oname+'.showColor(document.getElementById(\'cellColor\'),this)" '+
                'onclick="parent.'+this.oname+cmd+';" bgcolor="'+GB.colors[k]+'" style="font-size:7px;border:1px solid #aaa;width:12px;">&#160;</td>';
            k++;
        }
        colorRows[colorRows.length] = "</tr>";
    }

    colorRows[colorRows.length] =
        '<tr>'+
        '  <td colspan="10" style="border:1px solid #000;height:15px;font-size:9pt;text-align:center; " '+
        '    onmouseover="parent.'+this.oname+'.showColor(document.getElementById(\'cellColor\'),this)" onclick="parent.'+this.oname+cmd+'">색상 없음'+
        '  </td>'+
        '</tr>'+
        '</table></div>';

    return colorRows.join("\n");
},

showColor : function (val, obj) {
    if (obj.bgColor)
        val.innerHTML = val.style.backgroundColor = obj.bgColor;
    else {
        val.innerHTML = '없음';
        GB.MSIE ? val.style.removeAttribute('backgroundColor') : val.style.backgroundColor = "";
    }
},

doOnKeyPress : function () {
    var oEditor     = document.getElementById("id"+chutil.oname).contentWindow;
    var editArea    = document.getElementById("id"+chutil.oname);
    var areaHeight  = parseInt(editArea.style.height);
    var key = oEditor.event.keyCode;

    if (key) {
        if (key == 13) {
            if (GB.autoHeight && oEditor.document.body.scrollHeight+40 > areaHeight)
                editArea.style.height = oEditor.document.body.scrollHeight+40+'px';
            if (GB.MSIE && oEditor.event.shiftKey == false) {
                var sel = oEditor.document.selection.createRange();
                oEditor.event.returnValue = false;
                oEditor.event.cancelBubble = true;
                sel.pasteHTML('<br />');
                sel.select();
                sel.moveEnd("character", 1);
                sel.moveStart("character", 1);
                sel.collapse(false);
                return false;
            }
            else
                return oEditor.event.keyCode = 13;
        }
        if (GB.autoHeight && (key == 8 || key == 46) && oEditor.document.body.scrollHeight+30 < areaHeight)
            editArea.style.height = oEditor.document.body.scrollHeight+30+'px';
    }
},

drawToolbarIcon : function (iconBlock, top, iconWidth, id, toolTip, cmd) {
    document.write("<div style=\"text-align:left;float:left;margin:0px 2px 0px 0px;width:"+iconWidth+"px;height:24px;\">");
    document.write("<span unselectable=\"on\" style=\"cursor:pointer;position:absolute;clip:rect(0px "+iconWidth+"px 22px 0px);\">");
    switch (iconBlock) {
        case 1: document.write("<img id=\""+id+"\" title=\""+toolTip+"\" src=\""+this.config.editorPath+"/icons/toolbar_icon_1.gif\" style=\"position:absolute;top:-"+top+"px;width:"+iconWidth+"px;\" onmouseover=\""+this.oname+".toolbarButtonOver(this)\" onmouseout=\""+this.oname+".toolbarButtonOut(this)\" onmouseup=\""+cmd+"\" alt=\"\" />"); break;
        case 2: document.write("<img id=\""+id+"\" title=\""+toolTip+"\" src=\""+this.config.editorPath+"/icons/toolbar_icon_2.gif\" style=\"position:absolute;top:-"+top+"px;width:"+iconWidth+"px;\" onmouseover=\""+this.oname+".toolbarButtonOver(this)\" onmouseout=\""+this.oname+".toolbarButtonOut(this)\" onmouseup=\""+cmd+"\" alt=\"\" />"); break;
        case 3: document.write("<img id=\""+id+"\" title=\""+toolTip+"\" src=\""+this.config.editorPath+"/icons/toolbar_icon_3.gif\" style=\"position:absolute;top:-"+top+"px;width:"+iconWidth+"px;\" onmouseover=\""+this.oname+".toolbarButtonOver(this)\" onmouseout=\""+this.oname+".toolbarButtonOut(this)\" onmouseup=\""+cmd+"\" alt=\"\" />"); break;
        case 4: document.write("<img id=\""+id+"\" title=\""+toolTip+"\" src=\""+this.config.editorPath+"/icons/toolbar_icon_4.gif\" style=\"position:absolute;top:-"+top+"px;width:"+iconWidth+"px;\" onmouseover=\""+this.oname+".toolbarButtonOver(this)\" onmouseout=\""+this.oname+".toolbarButtonOut(this)\" onmouseup=\""+cmd+"\" alt=\"\" />"); break;
        case 5: document.write("<img id=\""+id+"\" title=\""+toolTip+"\" src=\""+this.config.editorPath+"/icons/toolbar_icon_5.gif\" style=\"position:absolute;top:-"+top+"px;width:"+iconWidth+"px;\" onmouseover=\""+this.oname+".toolbarButtonOver(this)\" onmouseout=\""+this.oname+".toolbarButtonOut(this)\" onmouseup=\""+cmd+"\" alt=\"\" />"); break;
        case 6: document.write("<img id=\""+id+"\" title=\""+toolTip+"\" src=\""+this.config.editorPath+"/icons/toolbar_icon_6.gif\" style=\"position:absolute;top:-"+top+"px;width:"+iconWidth+"px;\" onmouseover=\""+this.oname+".toolbarButtonOver(this)\" onmouseout=\""+this.oname+".toolbarButtonOut(this)\" onmouseup=\""+cmd+"\" alt=\"\" />"); break;
        case 7: document.write("<img id=\""+id+"\" title=\""+toolTip+"\" src=\""+this.config.editorPath+"/icons/toolbar_icon_7.gif\" style=\"position:absolute;top:-"+top+"px;width:"+iconWidth+"px;\" onmouseover=\""+this.oname+".toolbarButtonOver(this)\" onmouseout=\""+this.oname+".toolbarButtonOut(this)\" onmouseup=\""+cmd+"\" alt=\"\" />"); break;
        case 8: document.write("<img id=\""+id+"\" title=\""+toolTip+"\" src=\""+this.config.editorPath+"/icons/toolbar_icon_8.gif\" style=\"position:absolute;top:-"+top+"px;width:"+iconWidth+"px;\" onmouseover=\""+this.oname+".toolbarButtonOver(this)\" onmouseout=\""+this.oname+".toolbarButtonOut(this)\" onmouseup=\""+cmd+"\" alt=\"\" />"); break;
        case 9: document.write("<img id=\""+id+"\" title=\""+toolTip+"\" src=\""+this.config.editorPath+"/icons/toolbar_icon_9.gif\" style=\"position:absolute;top:-"+top+"px;width:"+iconWidth+"px;\" onmouseover=\""+this.oname+".toolbarButtonOver(this)\" onmouseout=\""+this.oname+".toolbarButtonOut(this)\" onmouseup=\""+cmd+"\" alt=\"\" />"); break;
        case 10: document.write("<img id=\""+id+"\" title=\""+toolTip+"\" src=\""+this.config.editorPath+"/icons/toolbar_icon_10.gif\" style=\"position:absolute;top:-"+top+"px;width:"+iconWidth+"px;\" onmouseover=\""+this.oname+".toolbarButtonOver(this)\" onmouseout=\""+this.oname+".toolbarButtonOut(this)\" onmouseup=\""+cmd+"\" alt=\"\" />"); break;
        default: break;
    }
    document.write("</span></div>");
},

popupWinLoad : function (url, popupWidth, popupHeight, szTitle) {
    var oTitle = document.getElementById('popupTitle_'+this.oname);
    var container = document.getElementById('editArea_'+this.oname);
    var posLeft = container.offsetWidth;
    var posTop = container.offsetTop;
    var offLeft = (container.offsetWidth-popupWidth) > 0 ? container.offsetLeft + (container.offsetWidth-popupWidth)/2 :
        container.offsetLeft;
    var dwindow = this.popupID;

    dwindow.style.width = popupWidth+"px";
    dwindow.style.left = offLeft+'px';
    dwindow.style.top = posTop+'px';
    dwindow.style.zIndex = 1001;

    var cframe = document.getElementById("cframe_"+this.oname);
    var iframe = document.createElement("iframe");
    iframe.style.width = "100%";
    iframe.style.height = popupHeight+'px';
    iframe.style.border = "0px";
    iframe.frameBorder = 0;
    iframe.src = url;
    cframe.innerHTML = '';
    cframe.appendChild(iframe);
    oTitle.innerHTML = szTitle;
    document.getElementById('container_'+this.oname).style.zIndex = 1000;
    dwindow.style.visibility = "visible";
},

popupWinClose : function () {
    if (this.popupID == null) return;
    this.popupID.style.visibility = "hidden";
    document.getElementById("cframe_"+this.oname).src = "";
    this.popupID.style.zIndex = -1;
    document.getElementById('container_'+this.oname).style.zIndex = 100;
    this.editArea.focus();
},

windowOpen : function (_which) {
    var tmpl, w, h;
    var popupTitle = '';
    this.editArea.focus();
    this.boxHide();

    if (GB.MSIE) this.setSelection();

    switch (_which) {
        case "image"     : tmpl = "insert_image.html";  h = 435; w = 354; popupTitle = '그림 넣기'; break;
        case "media"     : tmpl = "insert_media.html";  h = 480; w = 430; popupTitle = '미디어'; break;
        case "bgimage"   : tmpl = "insert_bgimage.html";h = 190; w = 430; popupTitle = '배경 이미지'; break;
        case "hyperLink" : tmpl = "insert_hlink.html";  h = 145; w = 420; popupTitle = '하이퍼링크'; break;
        case "emotion"   : tmpl = "insert_emicon.html"; h = 210; w = 400; popupTitle = '표정 아이콘'; break;
        case "schar"     : tmpl = "insert_schar.html";  h = 180; w = 500; popupTitle = '특수 문자'; break;
        case "flash"     : tmpl = "insert_flash.html";  h = 295; w = 500; popupTitle = '플래쉬 무비'; break;
        default: return;
    }

    tmpl = this.config.editorPath + '/' + tmpl;
    this.popupWinLoad(tmpl, w, h, popupTitle);
},

_getSelection : function() {
    return GB.MSIE ? this.editArea.document.selection.createRange() :
        this.editArea.getSelection();
},

_getSelectionType : function(rng) {
    return GB.MSIE ? this.editArea.document.selection.type :
        rng.getRangeAt(0).startContainer.nodeType;
},

doCmd : function(cmd, opt) {
    this.popupWinClose();
    this.selection = null;

    var oTarget = null;
    var range = this._getSelection();
    var nodeType = this._getSelectionType(range);

    if (GB.MSIE) {
        range = this.fixSelection(range);
        nodeType = this.fixSelectionType(range, nodeType);
        oTarget = (nodeType == 'None') ? this.editArea.document : range;
        range.select();
    }
    else {
        range = (typeof range != "undefined") ? range.getRangeAt(0) : this.editArea.document.createRange();
        oTarget = (typeof range != "undefined") ? this.editArea.document : range;
    }

    if (cmd.toLowerCase() == 'print') {
        this.editArea.print();
        return;
    }
    var pasteFromWord = false;
    if (cmd == 'PasteFromWord') {
        cmd = 'Paste';
        pasteFromWord = true;
    }

    if (!GB.MSIE && ((cmd == 'Cut') || (cmd == 'Copy') || (cmd == 'Paste'))) {
        try {
            oTarget.execCommand(cmd, false, opt);
        }
        catch (e) {
            var keyboard = '';
            var command = '';
            switch (cmd) {
                case 'Cut'  : keyboard = 'x'; command = '자르기'; break;
                case 'Copy' : keyboard = 'c'; command = '복사'; break;
                case 'Paste': keyboard = 'v'; command = '붙이기'; break;
            }
            alert('사용하고 계신 브라우저에서는 \'' + command + '\' 명령을 사용하실 수 없습니다. \n' +
            '키보드 단축키를 이용하여 주세요. \(윈도 사용자: Ctrl + ' + keyboard + ', 맥킨토시 사용자: Apple + ' + keyboard + '\)')
        }
        this.editArea.focus();
        return;
    }

    try {
        if (pasteFromWord == true) {
            var editorTmp = eval("idtmp"+this.oname);
            editorTmp.document.execCommand("SelectAll");
            editorTmp.document.execCommand("Paste");
            selection.pasteHTML(this.cleanFromWord());
            selection.select();
        }
        else {
            oTarget.execCommand(cmd, false, opt);
        }
    }
    catch (e) {
        alert(cmd + ": 지원되지 않는 명령입니다.");
    }
    if (this.config.showTagPath) cheditor.setEditorEvent(this.oname);
},

cleanFromWord : function () {
    var editorTmp = eval("idtmp"+this.oname);
    for (var i=0; i < editorTmp.document.body.all.length; i++) {
        editorTmp.document.body.all[i].removeAttribute("className", "", 0);
        editorTmp.document.body.all[i].removeAttribute("style", "", 0);
    }
    var sHTML = editorTmp.document.body.innerHTML;
    var str = sHTML;
    var arrTmp = str.split('<?xml:namespace prefix = o ns = "urn:schemas-microsoft-com:office:office" />');
    if (arrTmp.length > 1) str = arrTmp.join("");
    var arrTmp = str.split("<o:p>");
    if (arrTmp.length > 1) str = arrTmp.join("");
    var arrTmp = str.split("</o:p>");
    if (arrTmp.length > 1) str = arrTmp.join("");
    var arrTmp = str.split("<o:p>&nbsp;");
    if (arrTmp.length > 1) str = arrTmp.join("");
    var arrTmp = str.split("<P>&nbsp;</P>");
    if (arrTmp.length > 1) str = arrTmp.join("");
    var arrTmp = str.split("<P>");
    if (arrTmp.length > 1) str = arrTmp.join("");
    var arrTmp = str.split("</P>");
    if (arrTmp.length > 1) str = arrTmp.join("<br>");
    var arrTmp = str.split("<STRONG>");
    if (arrTmp.length > 1) str = arrTmp.join("");
    var arrTmp = str.split("</STRONG>");
    if (arrTmp.length > 1) str = arrTmp.join("");
    str = str.replace(/<\/?span(.*?)>/ig, '');
    str = str.replace(/<\/?font(.*?)>/ig, '');
    str = str.replace(/&nbsp;<br>/ig, "<br>");

    return str;
},

doCmdPaste : function(str) {
    if (GB.MSIE) {
        this.selection.select();
        if (this.selectionType == "Control") return;
        this.selection.pasteHTML(str);
    }
    else
        this.doCmd('insertHTML', str);
},

doCmdPopup : function(cmd, opt) {
    var target;
    var selection = this.selection;
    var selectionType = this.selectionType;

    this.editArea.focus();

    if (GB.MSIE) {
        target = (selectionType == 'None') ? this.editArea.document : selection;
        selection.select();
    }
    else {
        ran =(typeof selection != "undefined") ? selection.getRangeAt(0) :
            this.editArea.document.createRange();
        target = this.editArea.document;
    }

    try {
        if (cmd == 'fontSize') {
            target.execCommand(cmd, false, 2);
            this.setFontSize(this.editArea.document.body, opt);
        }
        else
            target.execCommand(cmd, false, opt);
    }
    catch(e) {
        alert(cmd + ": 지원되지 않는 명령입니다.");
    }

    if (this.config.showTagPath) cheditor.setEditorEvent(this.oname);
    this.boxHide();
},

setFontSize : function (el, val) {
    if (!el) return;

    if (el.hasChildNodes()) {
        var len = el.childNodes.length;
        var idx =0;
        for (; idx < len; idx++) {
            if (el.nodeName == 'FONT') {
                if (el.getAttribute('size') != 'undefined') {
                    el.removeAttribute('size');
                    el.style.fontSize = val+'pt';
                }
            }
            this.setFontSize(el.childNodes[idx], val);
        }
    }
},

insideEditor : function(el) {
    while (el != null) {
        if (el.tagName.toLowerCase() == "body" && el.contentEditable == "true")
            return true;
        el = el.parentElement;
    }
    return false;
},

fixSelection : function(selection) {
    if (GB.MSIE) {
        if(selection.parentElement != null) {
            if(!this.insideEditor(selection.parentElement())) {
                this.editArea.focus();
                selection = this._getSelection();
            }
        }
        else {
            if(!this.insideEditor(selection.item(0))) {
                this.editArea.focus();
                selection = this._getSelection();
            }
        }
    }
    return selection;
},

fixSelectionType : function(selection, selectionType) {
    if (GB.MSIE) {
        if (selection.parentElement != null) {
            if (!this.insideEditor(selection.parentElement())) {
                this.editArea.focus();
                return this._getSelectionType();
            }
        }
        else {
            if (!this.insideEditor(selection.item(0))) {
                this.editArea.focus();
                return this._getSelectionType();
            }
        }
    }
}
};

cheditor.modifyImage = function (img, editBlock) {
    var a_align = new Array("baseline","top","middle","bottom","texttop","absmiddle","absbottom","left","right");
    var a_text = new Array("기준선","위쪽","가운데","아래쪽","문자열 위쪽","선택 영역의 가운데","선택 영역의 아래쪽","왼쪽","오른쪽");
    if (img.hspace < 0) img.hspace = 0;
    if (img.vspace < 0) img.vspace = 0;
    if (img.border < 0 || img.border == '') img.border = 0;
    var htmlOutput = '<table cellpadding="0" cellspacing="0" border="0"><tr>' +
        '<td width="110"><font style="font-size:9pt">가로 픽셀: <input type="text" size="3" style="font-size:9pt" value="'+img.width+'" id="n_width" />&#160;</font>\n</td>' +
        '<td width="110"><font style="font-size:9pt">가로 여백: <input type="text" size="3" style="font-size:9pt" value="'+img.hspace+'" id="n_hspace" />&#160;</font>\n</td>' +
        '<td width="200"><font style="font-size:9pt">정렬: <select id="n_alignment" name="n_alignment" style="font-size:9pt">' +
        '<option value="">없음</option>';
        for (var i=0; i<a_align.length; i++) {
            htmlOutput += '<option value='+a_align[i];
            if (img.align == a_align[i].toLowerCase()) htmlOutput += ' selected';
            htmlOutput += '>'+a_text[i]+'</option>';
        }

     htmlOutput += '</select><select id="n_alignment_caption" name="n_alignment_caption" style="display:none;font-size:9pt">'+
        '<option value="left">왼쪽</option><option value="right">오른쪽</option></select></font></td>' +
        '<td>&#160;<font style="font-size:9pt">괘선 두께: <input type="text" size="1" style="font-size:9pt" value="'+img.border+'" id="n_border" />&#160;</font>\n</td></tr>' +
        '<tr><td><font style="font-size:9pt">세로 픽셀: <input type="text" size="3" style="font-size:9pt" value="'+img.height+'" id="n_height" />&#160;</font>\n</td>' +
        '<td><font style="font-size:9pt">세로 여백: <input type="text" size="3" style="font-size:9pt" value="'+img.vspace+'" id="n_vspace" />&#160;</font>\n</td>' +
        '<td colspan="2"><font style="font-size:9pt">설명: <input type="text" size="25" id="n_alt" style="font-size:9pt" value="'+img.alt+'" />' +
        '&#160;<button style="height:21px;font-size:9pt;" id="editimg">수정</button>' +
        '&#160;<input type="checkbox" id="isCaption" style="background-color:#a3d260" />캡션</font>\n</td></tr></table>';

    editBlock.innerHTML = htmlOutput;

    document.getElementById("isCaption").onclick = function() {
        if (document.getElementById("isCaption").checked) {
            document.getElementById("n_alignment_caption").style.display = '';
            document.getElementById("n_alignment").style.display = 'none';
        }
        else {
            document.getElementById("n_alignment_caption").style.display = 'none';
            document.getElementById("n_alignment").style.display = '';
        }
    };
    document.getElementById("editimg").onclick = function() {
        var n_width  = document.getElementById("n_width");
        var n_height = document.getElementById("n_height");
        var n_hspace = document.getElementById("n_hspace");
        var n_vspace = document.getElementById("n_vspace");
        var n_border = document.getElementById("n_border");
        var n_alt    = document.getElementById("n_alt");

        if (n_width.value == '' || n_width.value == null || n_width.value < 1) {
            alert("가로 픽셀 크기를 입력하여 주십시오");
            return;
        }
        else if (n_height.value == '' || n_height.value == null || n_height.value < 1) {
            alert("세로 픽셀 크기를 입력하여 주십시오");
            return;
        }
        else {
            var n_align  = '';
            if (document.getElementById("n_alignment").style.display != 'none') {
                n_align = document.getElementById("n_alignment");
            }
            else {
                n_align = document.getElementById("n_alignment_caption");
            }

            img.width  = parseInt(n_width.value);
            img.height = parseInt(n_height.value);

            if (parseInt(n_hspace.value) > 0) img.hspace = parseInt(n_hspace.value);
            else img.removeAttribute("hspace", "", 0);
            if (parseInt(n_vspace.value) > 0) img.vspace = parseInt(n_vspace.value);
            else img.removeAttribute("vspace", "", 0);
            if (parseInt(n_border.value) > 0) {
                img.style.border = n_border.value+'px ' + GB.imageBorder;
                img.removeAttribute("border", "", 0);
            }
            else img.removeAttribute("style", "", 0);
            if (n_align.value != '')  img.align  = n_align.value ;
            else img.removeAttribute("align", "", 0);
            if (n_alt.value != '') img.alt = n_alt.value;
            else img.alt = '';

            if (document.getElementById("isCaption").checked) {
                var id = img.getAttribute("id");
                if (id) {
                    id = id.replace(/image/, 'thumb');
                    var lb = eval("id"+chutil.oname).document.getElementById(id);
                    if (lb) lb.onclick = 'return hs.run(this,\''+img.alt.replace(/\'/,'')+'\')';
                }
                img.className = 'chimg_photo';
                img.onload = 'true';
                alert('캡션은 에디터 안에서는 보이지 않습니다.\n글 작성 완료 후 HTML 페이지 상에서 보입니다.');
            }
            else {
                img.removeAttribute("className", "", 0);
                img.removeAttribute("onload", "", 0);
            }
        }
    };
};

cheditor.setEditorEvent = function (oname) {
    var statusBar = document.getElementById("CHstatusBar"+oname);
    var modifyBlock = document.getElementById("CHModifyBlock"+oname);
    var oEditor = document.getElementById("id"+oname).contentWindow;
    var cmd, el, sel, rng, _parent, ancestors = [];

    if (GB.MSIE) {
        sel = oEditor.document.selection;
    }
    else {
        sel = oEditor.getSelection();
        if (typeof sel != "undefined") {
            try {
                rng = sel.getRangeAt(0);
            }
            catch(e) {
                rng = oEditor.document.createRange();
            }
        }
        else {
            rng = oEditor.document.createRange();
        }
    }

    if (GB.MSIE) {
        rng = sel.createRange();

        if (sel.type == "Text" || sel.type == "None") {
            _parent = rng.parentElement();
        }
        else if (sel.type == "Control") {
            _parent = rng.item(0);
        }
        else {
            _parent = oEditor.document.body;
        }
    }
    else try {
        _parent = rng.commonAncestorContainer;
        if (!rng.collapsed && rng.startContainer == rng.endContainer &&
            rng.startOffset - rng.endOffset < 2 && rng.startContainer.hasChildNodes())
        {
            _parent = rng.startContainer.childNodes[rng.startOffset];
        }

        while (_parent.nodeType == 3) {
            _parent = _parent.parentNode;
        }
    }
    catch (e) {
        _parent= null;
    }

    while (_parent && (_parent.nodeType == 1) && (_parent.tagName.toLowerCase() != 'body')) {
        ancestors.push(_parent);
        _parent = _parent.parentNode;
    }

    ancestors.push(oEditor.document.body);

    for (var i = ancestors.length; --i >= 0;) {
        el = ancestors[i];
        if (!el) countine;

        switch (el.tagName.toLowerCase()) {
            case "img" : cmd = "img"; break;
            case "td" : cmd = "td"; break;
            default : continue;
        }
    }

    switch (cmd) {
    case "img" :
        modifyBlock.style.display = "block";
        cheditor.modifyImage(el, modifyBlock);
        break;
    case "td" :
        modifyBlock.style.display = "block";
        cheditor.modifyCell(el, modifyBlock);
        break;
    default :
        modifyBlock.style.display = "none";
        modifyBlock.innerHTML = '';
    }

    if (statusBar) {
        var found = false, a;
        statusBar.innerHTML = '&lt;HTML&gt; &lt;BODY&gt; ';

        for (var i = ancestors.length; --i >= 0;) {
            el = ancestors[i];
            if (!el || el.tagName.toUpperCase() == 'HTML' || el.tagName.toUpperCase() == 'BODY')
                continue;
            var tag = el.tagName.toUpperCase();
            a = document.createElement("a");
            a.href = "#";
            a.el = el;
            a.style.color = 'blue';
            a.style.fontSize = '8pt';
            a.style.fontFamily = 'verdana';
            a.title = el.style.cssText;
            a.onmouseover = function () { this.style.textDecoration = 'none'; }
            a.onmouseout = function () { this.style.textDecoration = 'underline'; }
            a.onclick = function () {
                this.blur();
                cheditor.tagSelector(oEditor,this.el);
                document.getElementById("removeSelected").style.display = '';
                return false;
            };

            a.appendChild(document.createTextNode(tag));
            statusBar.appendChild(document.createTextNode('<'));
            statusBar.appendChild(a);
            statusBar.appendChild(document.createTextNode('> '));
            found = true;
        }

        if (found) {
            a = document.createElement("a");
            a.href = "#";
            a.style.color = 'red';
            a.id = "removeSelected";
            a.style.display = "none";
            a.style.fontSize = '8pt';
            a.style.fontFamily = 'verdana';
            a.onclick = function () {
                this.blur();
                oEditor.document.execCommand("RemoveFormat", false, false);
                oEditor.focus();
                cheditor.setEditorEvent(oname);
                return false;
            };

            a.appendChild(document.createTextNode('REMOVE'));
            statusBar.style.width = document.getElementById("statusBlock"+oname).scrollWidth - 22+ 'px';
            var div = document.createElement('span');
            div.style.marginTop = '2px';
            div.appendChild(a);
            statusBar.appendChild(div);
        }
    }
};

cheditor.tagSelector = function (oEditor, node) {
    var range = null;
    oEditor.focus();

    if (GB.MSIE) {
        range = oEditor.document.body.createTextRange();
        if (range) {
            range.moveToElementText(node);
            range.select();
        }
    }
    else {
        var selection = oEditor.getSelection();
        if (typeof selection != "undefined") {
            try {
                range = selection.getRangeAt(0);
            }
            catch(e) { range = oEditor.document.createRange(); }
        }
        else
            range = oEditor.document.createRange();

        range.selectNodeContents(node);
        selection.removeAllRanges();
        selection.addRange(range);
    }
};
