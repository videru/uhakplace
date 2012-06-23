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
    htmlKey : [
    "!doctype", "a", "abbr", "acronym", "address", "applet", "area", "b", "base", "basefont", "bgsound", "bdo",
    "big", "blink", "dl", "body", "br", "button", "caption", "center", "cite", "code", "col", "colgroup",
    "comment", "dd", "del", "dfn", "dir", "div", "font", "dt", "em", "embed", "fieldset", "blockquote",
    "form", "frame", "frameset", "h", "h1", "h2", "h3", "h4", "h5", "h6", "head", "hr",
    "html", "i", "iframe", "img", "input", "ins", "isindex", "kbd", "label", "legend", "li", "link",
    "listing", "map", "marquee", "menu", "meta", "multicol", "nextid", "nobr", "noframes", "noscript", "object", "ol",
    "optgroup", "option", "p", "param", "plaintext","pre", "q", "s", "samp", "script", "select", "server",
    "small", "sound", "spacer", "span", "strike", "strong", "style", "sub", "sup", "table", "tbody", "td",
    "textarea", "title", "tfoot", "th", "thead", "textflow", "tr", "tt", "u", "ul", "var", "wbr", "xmp" ],
 
    MSIE    : navigator.userAgent.toLowerCase().indexOf("msie")   != -1,
    CHROME  : navigator.userAgent.toLowerCase().indexOf('chrome') != -1,
    GECKO   : navigator.userAgent.toLowerCase().indexOf('gecko')  != -1,
    OPERA   : navigator.userAgent.toLowerCase().indexOf('opera')  != -1,
 
    editorMode          : 'rich',
    popupIFrame         : ['fontType', 'fontSize', 'paragraph', 'boxStyle', 'foreColor', 'backColor', 'BGColor'],
    imageBorder         : '#ccc solid',
    currentRS           : new Object(),
    autoHeight          : false,
    frameFocus          : (navigator.userAgent.toLowerCase().indexOf("msie")  != -1) ? 'onfocus' : 'onload',
    LANG                : { toolTip : { btnPrint : '인쇄',
                                        btnUndo : '실행취소',
                                        btnRedo : '되돌리기',
                                        btnCopy : '복사',
                                        btnCut : '잘라내기',
                                        btnPaste : '붙이기',
                                        btnPasteFromWord : 'MS워드 붙이기',
                                        btnSelectAll : '전체 선택',
                                        btnBold : '진하게',
                                        btnUnderline : '밑줄',
                                        btnStrike : '취소선',
                                        btnItalic : '기울임',
                                        btnSuperscript : '위첨자',
                                        btnSubscript : '아래첨자',
                                        btnJustifyLeft : '왼쪽 정렬',
                                        btnJustifyCenter : '가운데 정렬',
                                        btnJustifyRight : '오른쪽 정렬',
                                        btnJustifyFull : '양쪽 정렬',
                                        btnOrderedList : '문단 번호',
                                        btnUnOrderedList : '글 머리표',
                                        btnOutdent : '왼쪽여백 줄이기',
                                        btnIndent : '왼쪽여백 늘리기',
                                        btnFontType : '글꼴',
                                        btnParagraph : '제목',
                                        btnFontSize : '글꼴 크기',
                                        btnBoxStyle : '박스',
                                        btnBackColor : '형광펜',
                                        btnForeColor : '글자색',
                                        btnBGColor : '바탕색',
                                        btnSChar : '특수 문자',
                                        btnHyperLink : '하이퍼링크',
                                        btnUnLink : '하이퍼링크 해제',
                                        btnFlash : '플래쉬 무비',
                                        btnMedia : '미디어',
                                        btnUploadImage : '그림 넣기',
                                        btnBGImage : '배경 그림',
                                        btnEmotion : '표정 아이콘',
                                        btnHR : '가로선',
                                        btnTable : '표',
                                        btnPageBreak : '인쇄 페이지 나눔' }
                            }
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
        if (navigator.productSub < 20030107) {
            this.run = function() {
                document.write("<textarea name=\"message\" id=\"message\" style=\"width:100%;height:200px\"></textarea>");
            };
            return;
        }
    }
 
    this.config = {
        editorWidth     : '100%',
        editorHeight    : '600px',
        editorFontSize  : '9pt',
        editorFontFace  : 'gulim',
        editorBorder    : '1px solid #ccc',
        tabIndex        : 0,
        lineHeight      : '17px',
        editorPath      : '.',
        popupAutoKill   : true,
        fullHTMLSource  : true,
        hrefTarget      : '_blank',
        showTagPath     : true,
        toolBarSplit    : true,
        useBR           : true,
        imgMaxWidth     : 630,
        imgReSize       : true,
        includeHostname : true,
        editAreaMargin  : '7px',
        useSource       : true,
        usePreview      : true,
        usePrint        : true,
        useUndo         : true,
        useRedo         : true,
        useCopy         : true,
        useCut          : true,
        usePaste        : true,
        usePasteFromWord: true,
        useSelectAll    : true,
        useBold         : true,
        useUnderline    : true,
        useStrike       : true,
        useItalic       : true,
        useSuperscript  : true,
        useSubscript    : true,
        useJustifyLeft  : true,
        useJustifyCenter: true,
        useJustifyRight : true,
        useJustifyFull  : true,
        useOrderedList  : true,
        useUnOrderedList: true,
        useOutdent      : true,
        useIndent       : true,
        useFontType     : true,
        useParagraph    : true,
        useFontSize     : true,
        useBackColor    : true,
        useForeColor    : true,
        useBGColor      : true,
        useSChar        : true,
        useHyperLink    : true,
        useUnLink       : true,
        useFlash        : true,
        useMedia        : true,
        useUploadImage  : true,
        useBGImage      : true,
        useEmotion      : true,
        useHR           : true,
        autoHeight      : false,
        useTable        : true,
        useBoxStyle     : true,
        usePageBreak    : true
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
    this.undoSteps          = 20;
    this.undoTimeout        = 500;
    this.undoQueue          = new Array(this.undoSteps);
    this.undoPos            = -1;
    this.customUndo         = true;
    this.timerUndo          = null;
    this.images             = new Array();
    this.toolbarRow1        = new Object();
    this.toolbarRow2        = new Object();
    this.popupID            = null;
    this.currentMode		= 'rich';
}
 
cheditor.prototype = {
plainMode : function () {
    this.editAreaWrapper.style.display = 'none';
    document.getElementById('idToolbar_'+this.oname).style.display = 'none';
    document.getElementById('editArea_'+this.oname).style.display = 'none';
    document.getElementById('checkBox_'+this.oname).style.display = 'none';
    document.getElementById('plainId_'+this.oname).style.display = '';
    document.getElementById('plainId_'+this.oname).focus();
    if (this.config.showTagPath)
        document.getElementById('statusBlock'+this.oname).style.display = 'none';
    this.resetData();
},
 
htmlMode : function () {
    document.getElementById('plainId_'+this.oname).style.display = 'none';
    this.editAreaWrapper.style.display = '';
    document.getElementById('editArea_'+this.oname).style.display = '';
    document.getElementById('idToolbar_'+this.oname).style.display = '';
    document.getElementById('checkBox_'+this.oname).style.display = '';
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
    textarea.id = "plainId_"+this.oname;
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
        document.getElementById('plainId_'+this.oname).value = this.outputBodyText();
        GB.editorMode = 'plain';
    }
    else {
        var szPlain = document.getElementById('plainId_'+this.oname).value;
        szPlain = szPlain.replace(/\n/g,'<br>');
        this.resetEditArea(szPlain);
        this.setEditorOpt();
        GB.editorMode = 'rich';
    }
},
 
undoSnapshot : function () {
    ++this.undoPos;
    if (this.undoPos >= this.undoSteps) {
        this.undoQueue.shift();
        --this.undoPos;
    }
    var take = true;
    var txt = this.getContents(false);
 
    if (this.undoPos > 0) take = (this.undoQueue[this.undoPos - 1] != txt);
    take ? this.undoQueue[this.undoPos] = txt : this.undoPos--;
},
 
updateUndoQueue : function () {
    if (this.customUndo && !this.timerUndo) {
        this.undoSnapshot();
        var editor = this;
        this.timerUndo = setTimeout(function() { editor.timerUndo = null;}, this.undoTimeout);
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
    this.editAreaWrapper.style.margin = '0px';
    this.editAreaWrapper.style.padding = '0px';
    this.editAreaWrapper.fontSize = this.config.editorFontSize;
    oEditor.document.body.style.fontSize = this.config.editorFontSize;
    oEditor.document.body.style.fontFamily = this.config.editorFontFace;
    oEditor.document.body.style.margin = this.config.editAreaMargin;
    oEditor.document.body.style.lineHeight = this.config.lineHeight;
    this.editAreaWrapper.style.visibility = 'visible';
    return oEditor;
},
 
startDrag : function (event) {
    GB.currentRS.elNode = this.editAreaWrapper;
    var y = GB.MSIE ? window.event.clientY + document.documentElement.scrollTop + document.body.scrollTop :
        event.clientY + window.pageYOffset;
 
    GB.currentRS.cursorStartY = y;
    GB.currentRS.elStartTop = parseInt(GB.currentRS.elNode.style.height);
    if (isNaN(GB.currentRS.elStartTop)) GB.currentRS.elStartTop = 0;
 
    if (GB.MSIE) {
        document.attachEvent("onmousemove", this.dragGo);
        document.attachEvent("onmouseup",   this.dragStop);
        window.event.cancelBubble = true;
        window.event.returnValue = false;
    }
    else {
        if (GB.GECKO) GB.currentRS.elNode.style.visibility = 'hidden';
        document.addEventListener("mousemove", this.dragGo,   true);
        document.addEventListener("mouseup",   this.dragStop, true);
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
 
switchEditorMode : function (which) {
	this.editArea.focus();
	if (this.currentMode == which) return;
 
	switch (which) {
		case 'rich' :
			if (this.currentMode == 'preview')
				this.previewMode();
			else if (this.currentMode == 'code')
				this.editMode();
			document.getElementById('tabEditModeRich').src = this.config.editorPath+'/icons/edit_mode_rich_a.gif';
			if (this.config.useSource) document.getElementById('tabEditModeCode').src = this.config.editorPath+'/icons/edit_mode_code_b.gif';
			document.getElementById('tabEditModePreview').src = this.config.editorPath+'/icons/edit_mode_view_b.gif';
			break;
		case 'code' :
			document.getElementById('tabEditModeRich').src = this.config.editorPath+'/icons/edit_mode_rich_b.gif';
			document.getElementById('tabEditModeCode').src = this.config.editorPath+'/icons/edit_mode_code_a.gif';
			document.getElementById('tabEditModePreview').src = this.config.editorPath+'/icons/edit_mode_view_b.gif';
			this.editMode();
			break;
		case 'preview' :
			this.previewMode();
			document.getElementById('tabEditModeRich').src = this.config.editorPath+'/icons/edit_mode_rich_b.gif';
			if (this.config.useSource) document.getElementById('tabEditModeCode').src = this.config.editorPath+'/icons/edit_mode_code_b.gif';
			document.getElementById('tabEditModePreview').src = this.config.editorPath+'/icons/edit_mode_view_a.gif';
			break;
		default : break;
	}
	this.currentMode = which;
},
 
run : function () {
    document.write('<div style="position:relative;color:#000;width:'+this.config.editorWidth+'" id="container_'+this.oname+'">');
    this.drawToolbar();
    document.write('<div style="border:'+this.config.editorBorder+'" id="editArea_'+this.oname+'">');
    document.write('<iframe frameborder="0" style="border:0px;width:100%;height:'+this.config.editorHeight+';overflow:auto"'+' id="id'+this.oname+'"');
    if (this.config.tabIndex) document.write(' tabindex="'+this.config.tabIndex+'"');
    document.write(' '+GB.frameFocus+'="chutil.oname=\''+this.oname+'\'"></iframe>');
    document.write('</div>');
    document.write('<div id="CHModifyBlock'+this.oname+'" style="display:none;border-right:'+this.config.editorBorder+';border-left:'+this.config.editorBorder+';border-bottom:'+this.config.editorBorder+';padding:2px;background-color:#ededed;font-size:7pt;font-family:verdana;text-align:left">&#160;</div>');
 
    if (this.config.showTagPath) {
        document.write('<div id="statusBlock'+this.oname+'" style="line-height:11px;height:16px;background-color:#ededed;border-right:'+this.config.editorBorder+';border-left:'+this.config.editorBorder+';">');
        document.write('<div id="CHstatusBar'+this.oname+'" style="float:left;padding:2px;font-size:8pt;font-family:verdana;color:#333">&lt;html&gt; &lt;body&gt;</div>');
        document.write('<div onmousedown="'+this.oname+'.startDrag(event)" id="reSize'+this.oname+'" style="float:right;width:11px;cursor:move"><img src="'+this.config.editorPath+'/icons/statusbar_resize.gif" width="11" height="16" alt=""></div>');
        document.write('</div>');
    }
    document.write('<div style="padding-left:4px;text-align:left;background:url('+this.config.editorPath+'/icons/statusbar_bgline.gif);background-repeat:repeat-x;background-position:top">');
    document.write('<img width="24" height="20" id="tabEditModeRich" src="'+this.config.editorPath+'/icons/edit_mode_rich_a.gif" onclick="'+this.oname+'.switchEditorMode(\'rich\')" style="cursor:pointer" title="입력모드" />');
    if (this.config.useSource)
    	document.write('<img width="24" height="20" id="tabEditModeCode" src="'+this.config.editorPath+'/icons/edit_mode_code_b.gif" onclick="'+this.oname+'.switchEditorMode(\'code\')" style="cursor:pointer" title="편집모드" />');
    document.write('<img width="24" height="20" id="tabEditModePreview" src="'+this.config.editorPath+'/icons/edit_mode_view_b.gif" onclick="'+this.oname+'.switchEditorMode(\'preview\')" style="cursor:pointer" title="미리보기" />');
    document.write('</div>');
 
    var loadContents = '';
    if (this.inputForm && document.getElementById(this.inputForm))
        loadContents = document.getElementById(this.inputForm).value;
 
    this.editAreaWrapper = document.getElementById("id"+this.oname);
    this.editArea = this.resetEditArea(loadContents);
 
    document.write('<iframe frameborder="0" border="0" name="idtmp'+this.oname+'" contentEditable="true" id="idtmp'+this.oname+'" style="visibility:hidden;width:0px;height:0px;overflow:auto;" onfocus="'+this.oname+'.boxHide()"></iframe>');
    var tmpeditor = eval("idtmp"+this.oname);
    tmpeditor.document.designMode = "on";
    tmpeditor.document.open("text/html","replace");
    tmpeditor.document.write("<html><head></head><body></body></html>");
    tmpeditor.document.close();
 
    if (!document.getElementById("foreColor_"+this.oname)) {
        htmlOutput = this.createWindow(200, this.setColorTable('fore'));
        document.write('<iframe frameborder="0" id="foreColor_'+this.oname+'" name="foreColor" style="position:absolute;visibility:hidden;z-index:-1;width:1px;height:1px;"></iframe>');
         var doc = document.getElementById('foreColor_'+this.oname).contentWindow;
        doc.document.open("text/html","replace");
        doc.document.write(htmlOutput);
        doc.document.close();
    }
    if (!document.getElementById("backColor_"+this.oname)) {
        htmlOutput = this.createWindow(200, this.setColorTable('back'));
        document.write('<iframe frameborder="0" id="backColor_'+this.oname+'" name="backColor" style="position:absolute;visibility:hidden;z-index:-1;width:1px;height:1px;"></iframe>');
        var doc = document.getElementById('backColor_'+this.oname).contentWindow;
        doc.document.open("text/html","replace");
        doc.document.write(htmlOutput);
        doc.document.close();
    }
    if (!document.getElementById("BGColor_"+this.oname)) {
        htmlOutput = this.createWindow(200, this.setColorTable('bgColor'));
        document.write('<iframe frameborder="0" id="BGColor_'+this.oname+'" name="BGColor" style="position:absolute;visibility:hidden;z-index:-1;width:1px;height:1px;"></iframe>');
        var doc = document.getElementById('BGColor_'+this.oname).contentWindow;
        doc.document.open("text/html","replace");
        doc.document.write(htmlOutput);
        doc.document.close();
    }
    if (!document.getElementById("fontType_"+this.oname)){
        htmlOutput = '<div style="background-color:'+this.editorPopupBgcolor+'">' +
            "<div style='padding:4px 0px 0px 2px;color:#0e2c5d;background:#ebe9ed url("+this.config.editorPath+"/icons/title_bar_bg.gif);float:left;font-size:9pt'>글꼴 모양</div>"+
            "<div style='background:#ebe9ed url("+this.config.editorPath+"/icons/title_bar_bg.gif);text-align:right;padding:3px;font-size:9pt'>&#160;<img src='"+this.config.editorPath+"/icons/close.gif' width='13' height='13' onclick='parent."+this.oname+".boxHide();' style='vertical-align:top' alt='' /></div>" +
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
        document.write('<iframe frameborder="0" id="fontType_'+this.oname+'" style="position: absolute;visibility: hidden;z-index: -1;width:1px;height:1px"></iframe>');
        var doc = document.getElementById('fontType_'+this.oname).contentWindow;
        doc.document.open("text/html","replace");
        doc.document.write(htmlOutput);
        doc.document.close();
    }
    if (!document.getElementById("paragraph_"+this.oname)) {
        htmlOutput = '<div style="background-color:'+this.editorPopupBgcolor+'">' +
            "<div style='padding:4px 0px 0px 2px;color:#0e2c5d;background:#6b90c0 url("+this.config.editorPath+"/icons/title_bar_bg.gif);float:left;font-size:9pt'>제목 선택</div>"+
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
        document.write('<iframe frameborder="0" id="paragraph_'+this.oname+'" name="paragraph" style="position: absolute;visibility: hidden; z-index: 1;width:1px;height:1px"></iframe>');
        var doc = document.getElementById('paragraph_'+this.oname).contentWindow;
        doc.document.open("text/html","replace");
        doc.document.write(htmlOutput);
        doc.document.close();
    }
    if (!document.getElementById("fontSize_"+this.oname)) {
        htmlOutput =  '<div style="background-color:'+this.editorPopupBgcolor+'">' +
            "<div style='padding:4px 0px 0px 2px;color:#0e2c5d;background:#6b90c0 url("+this.config.editorPath+"/icons/title_bar_bg.gif);float:left;font-size:9pt'>글꼴 크기</div>"+
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
        document.write('<iframe frameborder="0" id="fontSize_'+this.oname+'" name="fontSize" style="position: absolute;visibility: hidden;z-index: -1;width:1px;height:1px;"></iframe>');
        var doc = document.getElementById('fontSize_'+this.oname).contentWindow;
        doc.document.open("text/html","replace");
        doc.document.write(htmlOutput);
        doc.document.close();
    }
    if (!document.getElementById("boxStyle_"+this.oname)){
        htmlOutput =  '<div style="background-color:'+this.editorPopupBgcolor+'">' +
            "<div style='padding:4px 0px 0px 2px;color:#0e2c5d;background:#6b90c0 url("+this.config.editorPath+"/icons/title_bar_bg.gif);float:left;font-size:9pt'>박스 스타일</div>"+
            "<div style='background:#6b90c0 url("+this.config.editorPath+"/icons/title_bar_bg.gif);text-align:right;padding:3px;font-size:9pt'>&#160;<img src='"+this.config.editorPath+"/icons/close.gif' width='13' height='13' onclick='parent."+this.oname+".boxHide();' style='vertical-align:top' alt='' /></div>" +
            "<div style='clear:both;border-top:1px solid #8db3e5'></div>" +
            "<div onclick=\"parent."+this.oname+".boxStyle(this)\" align='center' style='border:1px #dedfdf solid;background-color:#f7f7f7;padding:3px;font-size:9pt;margin:2px;cursor:pointer;'>가나다 ABC</div>" +
            "<div onclick=\"parent."+this.oname+".boxStyle(this)\" align='center' style='border:1px #aee8e8 solid;background-color:#bfffff;padding:3px;font-size:9pt;margin:2px;cursor:pointer;'>가나다 ABC</div>" +
            "<div onclick=\"parent."+this.oname+".boxStyle(this)\" align='center' style='border:1px #d3bceb solid;background-color:#e6ccff;padding:3px;font-size:9pt;margin:2px;cursor:pointer;'>가나다 ABC</div>" +
            "<div onclick=\"parent."+this.oname+".boxStyle(this)\" align='center' style='border:1px #e8e88b solid;background-color:#ffff99;padding:3px;font-size:9pt;margin:2px;cursor:pointer;'>가나다 ABC</div>" +
            "<div onclick=\"parent."+this.oname+".boxStyle(this)\" align='center' style='border:1px #c3e89e solid;background-color:#d6ffad;padding:3px;font-size:9pt;margin:2px;cursor:pointer;'>가나다 ABC</div>" +
            "<div onclick=\"parent."+this.oname+".boxStyle(this)\" align='center' style='border:1px #e8c8b7 solid;background-color:#ffdcc9;padding:3px;font-size:9pt;margin:2px;cursor:pointer;'>가나다 ABC</div>" +
            "</div>";
        htmlOutput = this.createWindow(100, htmlOutput);
        document.write('<iframe frameborder="0" id="boxStyle_'+this.oname+'" name="boxStyle" style="position:absolute;visibility:hidden;z-index:-1;width:1px;height:1px"></iframe>');
        var doc = document.getElementById('boxStyle_'+this.oname).contentWindow;
        doc.document.open("text/html","replace");
        doc.document.write(htmlOutput);
        doc.document.close();
    }
    document.write('<div id="dwindow_'+this.oname+'" style="border:1px solid #8db3e5;visibility:hidden;position:absolute;background-color:#ebe9ed;left:0px;top:0px;" onselectstart="return false">');
    document.write('<div style="text-align:left;height:10px;padding:10px 0px 0px 3px;background:#6b90c0 url('+this.config.editorPath+'/icons/title_bar_bg.gif);"><div id="popupTitle_'+this.oname+'" style="margin-top:-7px;font-size:9pt;color:#0e2c5d;"></div></div>');
    document.write('<div id="cframe_'+this.oname+'" style="border-top:1px solid #8db3e5;background-color:#ebe9ed;"></div></div>');
    document.write('</div>'); //Container
 
    this.popupID = document.getElementById('dwindow_'+this.oname);
    GB.autoHeight = this.config.autoHeight;
    this.editArea.focus();
    this.createTextarea();
    this.setEditorOpt();
},
 
thisTest : function ()
{
	alert('hello');
},
 
setEditorOpt : function () {
	var editor = this;
	if (GB.MSIE) this.editArea.document.onkeydown = this.doOnKeyPress;
    this.addEvent(this.editArea.document, "mouseup");
    this.addEvent(this.editArea.document, "keyup");
},
 
addEvent : function (doc, ev) {
    this.updateUndoQueue();
    var func = function () { cheditor.setEditorEvent(chutil.oname) };
    if (GB.MSIE) {
        doc.detachEvent("on"+ev, func);
        doc.attachEvent("on"+ev, func);
    }
    else {
        doc.removeEventListener(ev, func, true);
        doc.addEventListener(ev, func, false);
    }
},
 
toolbarButtonOut : function (elemButton) {
    var nTop = elemButton.style.top.substring(0, elemButton.style.top.length - 2);
    elemButton.style.top = nTop * 1 + 22 + 'px';
},
 
toolbarButtonOver : function (elemButton) {
    var nTop = elemButton.style.top.substring(0, elemButton.style.top.length - 2);
    elemButton.style.top = nTop - 22 + 'px';
},
 
preloadToolbar : function () {
    var imgTag = '<img src="'+this.config.editorPath+'/icons/toolbar_icon_';
    for (var i=1; i<12; i++) {
        document.write(imgTag+i+'.gif" width="1" height="1" style="display:none" alt="" />');
    }
},
 
showToolbar : function (tb) {
    for (var i in tb) {
        if (tb[i].use == false) continue;
        this.drawToolbarIcon(tb[i].icon[0],tb[i].icon[1],tb[i].icon[2],
            i+this.oname, GB.LANG.toolTip[i], this.oname + tb[i].exec);
    }
},
 
drawToolbar : function () {
    this.preloadToolbar();
    this.toolbarRow1 = {
        //btnPrint : { use : this.config.usePrint, icon : [1,0,22], exec : ".doCmd('print', false)" },
        btnUndo : { use : this.config.useUndo, icon : [1,44,22], exec : ".undo()" },
        btnRedo : { use : this.config.useRedo, icon : [1,88,22], exec : ".redo()" },
        //btnCopy : { use : this.config.useCopy, icon : [1,132,22], exec : ".doCmd('Copy', false)" },
        //btnCut : { use : this.config.useCut, icon : [2,0,22], exec : ".doCmd('Cut', false)" },
        //btnPaste : { use : this.config.usePaste, icon : [2,44,22], exec : ".doCmd('Paste', false)" },
        //btnPasteFromWord : { use : this.config.usePasteFromWord, icon : [10,88,22], exec : ".doCmd('PasteFromWord', false)" },
        //btnSelectAll : { use : this.config.useSelectAll, icon : [2,88,22], exec : ".doCmd('SelectAll', false)" },
        btnBold : { use : this.config.useBold, icon : [2,132,22], exec : ".doCmd('Bold', false)" },
        btnUnderline : { use : this.config.useUnderline, icon : [3,0,22], exec : ".doCmd('Underline', false)" },
        btnStrike : { use : this.config.useStrike, icon : [3,44,22], exec : ".doCmd('Strikethrough', false)" },
        btnItalic : { use : this.config.useItalic, icon : [3,88,22], exec : ".doCmd('Italic', false)" },
        btnSuperscript : { use : this.config.useSuperscript, icon : [3,132,22], exec : ".doCmd('Superscript', false)" },
        btnSubscript : { use : this.config.useSubscript, icon : [4,0,22], exec : ".doCmd('Subscript', false)" },
        btnJustifyLeft : { use : this.config.useJustifyLeft, icon : [4,44,22], exec : ".doCmd('JustifyLeft', false)" },
        btnJustifyCenter : { use : this.config.useJustifyCenter, icon : [4,88,22], exec : ".doCmd('JustifyCenter', false)" },
        btnJustifyRight : { use : this.config.useJustifyRight, icon : [4,132,22], exec : ".doCmd('JustifyRight', false)" },
        btnJustifyFull : { use : this.config.useJustifyFull, icon : [5,0,22], exec : ".doCmd('JustifyFull', false)" },
        btnOrderedList : { use : this.config.useOrderedList, icon : [5,44,22], exec : ".doCmd('InsertOrderedList', false)" },
        btnUnOrderedList : { use : this.config.useUnOrderedList, icon : [5,88,22], exec : ".doCmd('InsertUnOrderedList', false)" },
        btnOutdent : { use : this.config.useOutdent, icon : [5,132,22], exec : ".doCmd('Outdent', false)" },
        btnIndent : { use : this.config.useIndent, icon : [6,0,22], exec : ".doCmd('Indent', false)" }
    };
    this.toolbarRow2 = {
        btnFontType : { use : this.config.useFontType, icon : [8,0,30], exec : ".windowPos(this,'fontType_"+this.oname+"');"+this.oname+".displayWindow('fontType_"+this.oname+"');" },
        btnParagraph : { use : this.config.useParagraph, icon : [8,44,30], exec : ".windowPos(this,'paragraph_"+this.oname+"');"+this.oname+".displayWindow('paragraph_"+this.oname+"');" },
        btnFontSize : { use : this.config.useFontSize, icon : [8,88,30], exec : ".windowPos(this,'fontSize_"+this.oname+"');"+this.oname+".displayWindow('fontSize_"+this.oname+"');" },
        //btnBoxStyle : { use : this.config.useBoxStyle, icon : [11,0,22], exec : ".windowPos(this,'boxStyle_"+this.oname+"');"+this.oname+".displayWindow('boxStyle_"+this.oname+"');" },
        btnBackColor : { use : this.config.useBackColor, icon : [9,88,22], exec : ".windowPos(this,'backColor_"+this.oname+"');"+this.oname+".displayWindow('backColor_"+this.oname+"');" },
        btnForeColor : { use : this.config.useForeColor, icon : [9,132,22], exec : ".windowPos(this,'foreColor_"+this.oname+"');"+this.oname+".displayWindow('foreColor_"+this.oname+"');" },
        //btnBGColor : { use : this.config.useBGColor, icon : [9,44,22], exec : ".windowPos(this,'BGColor_"+this.oname+"');"+this.oname+".displayWindow('BGColor_"+this.oname+"');" },
        btnSChar : { use : this.config.useSChar, icon : [7,132,22], exec : ".windowOpen('schar')" },
        btnHyperLink : { use : this.config.useHyperLink, icon : [6,44,22], exec : ".windowOpen('hyperLink')" },
        btnUnLink : { use : this.config.useUnLink, icon : [6,88,22], exec : ".doCmd('UnLink',false)" },
        btnFlash : { use : this.config.useFlash, icon : [9,0,22], exec : ".windowOpen('flash')" },
        btnMedia : { use : this.config.useMedia, icon : [6,132,22], exec : ".windowOpen('media')" },
        btnUploadImage : { use : this.config.useUploadImage, icon : [7,0,22], exec : ".windowOpen('image')" },
        //btnBGImage : { use : this.config.useBGImage, icon : [7,44,22], exec : ".windowOpen('bgimage')" },
        btnEmotion : { use : this.config.useEmotion, icon : [7,88,22], exec : ".windowOpen('emotion')" }
        //,btnHR : { use : this.config.useHR, icon : [10,0,22], exec : ".doCmd('InsertHorizontalRule')" },
        //btnTable : { use : this.config.useTable, icon : [10,44,22], exec : ".windowOpen('table')" }
		//,btnPageBreak : { use : this.config.usePageBreak, icon : [10,132,22], exec : ".printPageBreak()" }
    };
 
    document.write('<table border="0" cellpadding="0" cellspacing="0" width="100%" id="idToolbar_'+this.oname+'">');
    document.write('<tr><td align="left">');
    this.showToolbar(this.toolbarRow1);
    if (this.config.toolBarSplit) document.write('</td></tr><tr><td>');
    this.showToolbar(this.toolbarRow2);
 
    if (GB.MSIE && this.config.useBR)
        document.write('<div style="float:left"><input type="checkbox" id="chkUseBR'+this.oname+'" checked="checked" onclick="'+this.oname+'.useBR(this)" /><span style="font-size:8pt;font-family:verdana">BR</span></div>');
    document.write('</td></tr></table>');
},
 
changeFontType : function (val) {
    var el = document.getElementById('fontType_'+this.oname).contentWindow;
    eval(el.document.getElementById("CHEditor").value).doCmdPopup("fontName",val);
},
 
setColor : function (color, _which) {
    if (_which == 'back') {
        var el = document.getElementById('backColor_'+this.oname).contentWindow;
        eval(el.document.getElementById("CHEditor").value).doCmdPopup(GB.MSIE ? 'BackColor' : 'HiliteColor', color);
    }
    else {
        var el = document.getElementById('foreColor_'+this.oname).contentWindow;
        eval(el.document.getElementById("CHEditor").value).doCmdPopup('ForeColor', color);
    }
},
 
setBgColor : function (color) {
    var el = document.getElementById('BGColor_'+this.oname).contentWindow;
    if (GB.MSIE)
        eval(el.document.getElementById("CHEditor").value).doBgColor(color);
    else
        eval(el.document.getElementById("CHEditor").value).doCmdPopup("BackColor",color);
},
 
doBgColor : function (color) {
    this.editArea.document.body.style.backgroundColor = color;
    this.selection.select();
    this.boxHide();
    this.editArea.focus();
},
 
applyParagraph : function (val) {
    var el = document.getElementById('paragraph_'+this.oname).contentWindow;
    eval(el.document.getElementById("CHEditor").value).doCmdPopup("FormatBlock",val);
},
 
changeFontSize : function (val) {
    var el = document.getElementById('fontSize_'+this.oname).contentWindow;
    eval(el.document.getElementById("CHEditor").value).doCmdPopup("fontSize",val);
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
    var range, linked, targetEl;
 
    if (GB.MSIE) {
        selection.select();
        selection = this.fixSelection(selection);
        selectionType = this.fixSelectionType(selection, selectionType);
        if (selectionType == "None") {
            targetEl = document.getElementById('id'+this.oname).document;
        }
        else {
            targetEl = selection;
            targetEl.execCommand("UnLink", false);
        }
        targetEl.execCommand("CreateLink", false, szURL);
        linked = selection.parentElement ? selection.parentElement() : this.getElement(selection.item(0),"A");
    }
    else {
        selection = this._getSelection();
        if (typeof selection != "undefined") range = selection.getRangeAt(0);
        document.getElementById("id"+this.oname).contentDocument.execCommand("CreateLink", false, szURL);
        linked = range.startContainer.previousSibling;
    }
 
    if (linked) {
        if (szTarget) linked.target = szTarget;
        if (szTitle) linked.title = szTitle;
    }
},
 
boxStyle: function (el) {
    var range = this._getSelection();
 
    if (!GB.MSIE) {
        range = (typeof range != "undefined") ?
            range.getRangeAt(0) : this.editArea.document.createRange();
    }
 
    var newNode = document.createElement("div");
    newNode.style.backgroundColor = el.style.backgroundColor;
    newNode.style.border = el.style.border;
    newNode.style.padding = el.style.padding;
    newNode.style.margin = "5px 0px 5px 0px";
 
    if (GB.MSIE) {
        var ctx = this.selection.htmlText;
        newNode.innerHTML = ctx ? ctx : '&nbsp;';
        this.doCmdPaste(newNode.outerHTML);
    }
    else {
        var ctx = range != '' ? range.extractContents() : document.createElement('br');
        newNode.appendChild(ctx);
        range.insertNode(newNode);
        range.setEnd(newNode, 0);
        range.setStart(newNode, 0);
    }
    this.boxHide();
    this.editArea.focus();
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
 
insertTable: function (insertNode) {
    if (GB.MSIE) {
        this.selection.select();
        this.selection.pasteHTML(insertNode.outerHTML);
        return;
    }
 
    var sel = this._getSelection();
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
        if (container.nodeType == 3) {
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
 
insertImage : function (img) {
    var linebreak = false;
    var reSize = false;
    var outer = img;
 
    if (this.config.imgReSize) reSize = this.resizeImageComplete(img);
    if (img.alt == 'break') {
        linebreak = true;
        img.removeAttribute("align");
        img.alt = '';
    }
 
    if (reSize) {
        var szRandom = Math.random();
        var imgId = 'image_'+szRandom;
        var thumb = 'thumb_'+szRandom;
        var href = document.createElement('a');
 
        imgId = imgId.replace(/\./,'');
        thumb = thumb.replace(/\./,'');
 
        img.id = imgId;
        img.className = 'chimg_photo';
        img.onload = 'true';
        href.id = thumb;
        href.href = img.src;
        href.className = 'imageUtil';
        href.onclick = 'return hs.run(this)';
        href.appendChild(img);
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
 
editMode: function () {
    this.selection = null;
    this.popupWinClose();
    this.resetStatusBar();
 
    if (this.currentMode == 'rich' || this.currentMode == 'preview') {
        var tmpBody = this.getContents(true);
        this.szTmp = this.editArea.document.body.style.cssText;
 
        var content = (this.config.fullHTMLSource == false) ? this.docSplit(tmpBody) : tmpBody;
        content = content.replace (/<meta(.+?)name=generator>/ig, "");
        content = content.replace (/<link href=(.*?)>/ig, '');
 
        var key = GB.htmlKey.join ("|");
        var reg = new RegExp ("(&lt;\/?)(" + key + ")(&gt;)", "ig");
        var reg2 = new RegExp ("(&lt;)(" + key + ") (.+?)=(.+?)(&gt;)", "ig");
 
        content = content.replace(/</g,'&lt;').replace(/>/g,'&gt;');
        content = content.replace (/\n/g, '<br />');
        content = content.replace (reg, "<font color=\"#0000c8\">$1$2$3</font>");
        content = content.replace (reg2, "<font color=\"#0000c8\">$1$2</font> <font color=\"#b40000\">$3</font>=<font color=\"#248f00\">$4</font><font color=\"#0000c8\">$5</font>");
 
        this.editArea.document.body.innerHTML = content;
        this.editArea.document.body.clearAttributes;
        this.editArea.document.body.contentEditable = true;
        this.editArea.document.body.style.fontFamily = 'courier new,gulim';
        this.editArea.document.body.style.fontSize = '9pt';
        this.editArea.document.body.style.color = '#000';
        this.editArea.document.body.style.lineHeight = this.config.lineHeight;
        this.editArea.document.body.style.background = '#fff';
 
        var tmpHeight = this.editAreaWrapper.offsetHeight + document.getElementById("idToolbar_"+this.oname).offsetHeight;
        document.getElementById("idToolbar_"+this.oname).style.display = "none";
        this.editAreaWrapper.style.height = tmpHeight + 'px';
        this.showTagSelector(false);
    }
    else {
        this.editAreaWrapper.style.visibility = 'hidden';
        this.putContents(this.makeHtmlContent());
        document.getElementById("idToolbar_"+this.oname).style.display = '';
        var tmpHeight = this.editAreaWrapper.offsetHeight - document.getElementById("idToolbar_"+this.oname).offsetHeight;
        this.editAreaWrapper.style.height = tmpHeight + 'px';
        if (!this.config.fullHTMLSource) this.editArea.document.body.style.cssText = this.szTmp;
        this.showTagSelector(true);
        this.setEditorOpt();
        this.editAreaWrapper.style.visibility = 'visible';
        this.editArea.document.body.contentEditable = true;
    }
    this.editArea.document.body.focus();
},
 
makeHtmlContent : function () {
    if (GB.MSIE) return this.editArea.document.body.innerText;
 
    var content = this.editArea.document.body.innerHTML;
    content = content.replace (/<br>/ig, '\n');
    content = content.replace (/<\/font>/ig, '');
    content = content.replace (/<font (.+?)>/ig, '');
 
    return content;
},
 
resetStatusBar : function () {
    if (this.config.showTagPath)
        document.getElementById('CHstatusBar'+this.oname).innerHTML = '&lt;html&gt; &lt;body&gt; ';
},
 
previewMode : function () {
    this.selection = null;
    this.popupWinClose();
    this.resetStatusBar();
    if (this.config.useSource) {
        if (this.currentMode == 'code') {
            this.putContents(this.makeHtmlContent());
            this.currentMode = 'rich';
        }
    }
    this.editAreaWrapper.style.visibility = 'hidden';
    if (this.currentMode=='rich') {
        document.getElementById("CHModifyBlock"+this.oname).style.display = 'none';
        this.showTagSelector(false);
        this.editArea.document.body.contentEditable = false;
        if (!GB.MSIE) this.editArea.document.designMode = "off";
        var tmpHeight = this.editAreaWrapper.offsetHeight +
            document.getElementById("idToolbar_"+this.oname).offsetHeight;
        document.getElementById("idToolbar_"+this.oname).style.display = "none";
        this.editAreaWrapper.style.height =  tmpHeight+'px';
    }
    else {
        this.editArea.document.body.contentEditable = true;
        if (!GB.MSIE) this.editArea.document.designMode = "on";
        document.getElementById("idToolbar_"+this.oname).style.display = '';
        var tmpHeight = this.editAreaWrapper.offsetHeight -
            document.getElementById("idToolbar_"+this.oname).offsetHeight;
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
 
    sContent = (this.config.fullHTMLSource == false) ? sContent : this.docSplit(sContent);
    if (GB.MSIE) {
        this.editArea.document.open("text/html","replace");
        this.editArea.document.write(sContent);
        this.editArea.document.close();
        this.editArea.document.execCommand("2D-Position", true, true);
        this.editArea.document.execCommand("MultipleSelection", true, true);
        this.editArea.document.execCommand("LiveResize", true, true);
    }
    else {
        this.editArea.document.body.innerHTML = sContent;
    }
 
    this.editArea.document.body.style.cssText = this.szTmp;
    this.editArea.document.body.contentEditable = true;
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
    var mydoc = document.getElementById('plainId_'+this.oname).value;
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

/*
contentsFocus : function () {
    if (GB.CHROME) {
        document.getElementById('id'+this.oname).focus();
    }
    else
        this.editArea.focus();
},
*/
 
returnFalse : function () {
    this.resetViewHTML();
    if (GB.CHROME) {
        document.getElementById('id'+this.oname).focus();
    }
    else
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
    var popup = document.getElementById(boxName).contentWindow.document.body;
    document.getElementById(boxName).style.width = popup.scrollWidth + 'px';
    document.getElementById(boxName).style.height = popup.scrollHeight + 'px';
},
 
displayWindow : function (boxName) {
    this.boxHide();
    this.setSelection();
    document.getElementById(boxName).contentWindow.document.getElementById("CHEditor").value = this.oname;
    this.dimension(boxName);
    document.getElementById(boxName).style.visibility = "visible";
    document.getElementById(boxName).style.zIndex = 1001;
 
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
    var myLeft = document.getElementById(idImg.id).parentNode.offsetLeft;
    var box = document.getElementById(boxName);
    var myTop = document.getElementById(idImg.id).parentNode.parentNode.offsetHeight + 24;
    box.style.left = myLeft + 'px';
    box.style.top = myTop + 'px';
},
 
boxHide : function() {
    for (i=0; i < GB.popupIFrame.length; i++) {
        if (document.getElementById(GB.popupIFrame[i]+'_'+chutil.oname)) {
            document.getElementById(GB.popupIFrame[i]+'_'+chutil.oname).style.visibility = 'hidden';
        }
    }
},
 
createWindow : function (width, content) {
    var str = '<style>'
        + 'body {margin:0px;padding:0px;border:0px;background-color:'+this.editorPopupBgcolor+';font-family:'+this.config.editorFontFace+'}'
        + '.dropdown {cursor:pointer}'
        + '</style>'
        + '<body onselectstart="return event.srcElement.tagName==\'INPUT\'" oncontextmenu="return false">'
        + '<div style="width:'+width+'px;margin:0px;padding:0px;border:#8db3e5 1px solid;background-color:'+this.editorPopupBgcolor+';">'
        + content
        + '</div>'
        + '<input type="text" style="display:none" id="CHEditor" contentEditable="true" value="" />'
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
    var oEditor = document.getElementById("id"+chutil.oname).contentWindow;
    var editArea = document.getElementById("id"+chutil.oname);
    var areaHeight = parseInt(editArea.style.height);
    var key = oEditor.event.keyCode;
 
    if (key) {
        if (key == 13) {
            if (GB.autoHeight && oEditor.document.body.scrollHeight+40 > areaHeight)
                editArea.style.height = oEditor.document.body.scrollHeight+40+'px';
            if (document.getElementById('chkUseBR'+chutil.oname).checked == true && oEditor.event.shiftKey == false) {
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
        case 11: document.write("<img id=\""+id+"\" title=\""+toolTip+"\" src=\""+this.config.editorPath+"/icons/toolbar_icon_11.gif\" style=\"position:absolute;top:-"+top+"px;width:"+iconWidth+"px;\" onmouseover=\""+this.oname+".toolbarButtonOver(this)\" onmouseout=\""+this.oname+".toolbarButtonOut(this)\" onmouseup=\""+cmd+"\" alt=\"\" />"); break;
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
    document.getElementById('container_'+this.oname).style.zIndex = 100;
    this.popupID.style.zIndex = -1;
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
        case "media"     : tmpl = "insert_media.php";  h = 480; w = 430; popupTitle = '미디어'; break;
        case "bgimage"   : tmpl = "insert_bgimage.php"; h = 190; w = 430; popupTitle = '배경 이미지'; break;
        case "table"     : tmpl = "insert_table.php";  h = 460; w = 430; popupTitle = '테이블 만들기'; break;
        case "hyperLink" : tmpl = "insert_hlink.php";  h = 145; w = 420; popupTitle = '하이퍼링크'; break;
        case "emotion"   : tmpl = "insert_emicon.php"; h = 210; w = 400; popupTitle = '표정 아이콘'; break;
        case "schar"     : tmpl = "insert_schar.php";  h = 180; w = 500; popupTitle = '특수 문자'; break;
        case "flash"     : tmpl = "insert_flash.php";  h = 295; w = 500; popupTitle = '플래쉬 무비'; break;
        default: return;
    }
 
    this.popupWinLoad(this.config.editorPath + '/' + tmpl, w, h, popupTitle);
},
 
_getSelection : function() {
    return GB.MSIE ? this.editArea.document.selection.createRange() :
        this.editArea.getSelection();
},
 
_getSelectionType : function(rng) {
    return GB.MSIE ? this.editArea.document.selection.type :
        rng.getRangeAt(0).startContainer.nodeType;
},
 
undo : function () {
    this.editArea.focus();
    this.updateUndoQueue();
    if (this.undoPos > 0) {
        var txt = this.undoQueue[--this.undoPos];
        if (txt) {
            this.editAreaWrapper.style.visibility = 'hidden';
            this.putContents(txt);
            this.editAreaWrapper.style.visibility = 'visible';
        }
        else ++this.undoPos;
    }
    this.selection = null;
    this.setEditorOpt();
    if (this.config.showTagPath) cheditor.setEditorEvent(this.oname);
},
 
redo : function () {
    this.editArea.focus();
    if (this.undoPos < this.undoQueue.length - 1) {
        var txt = this.undoQueue[++this.undoPos];
        if (txt) {
            this.editAreaWrapper.style.visibility = 'hidden';
            this.putContents(txt);
            this.editAreaWrapper.style.visibility = 'visible';
        }
        else --this.undoPos;
    }
    this.setEditorOpt();
    if (this.config.showTagPath) cheditor.setEditorEvent(this.oname);
},
 
doCmd : function(cmd, opt) {
    this.popupWinClose();
    this.updateUndoQueue();
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
    var arrTmp = str.split('<'+'?xml:namespace prefix = o ns = "urn:schemas-microsoft-com:office:office" />');
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
 
printPageBreak : function () {
    this.setSelection();
    var str = '<div style="page-break-after:always;border-top:1px #f45000 dotted;border-bottom:1px #f45000 dotted;height:3px;font-size:1px;margin:5px 0px 10px 0px">&nbsp;</div>\n';
    this.doCmdPaste(str);
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
                if (el.getAttribute('size')) {
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
 
cheditor.modifyCell = function (cell, statusbar) {
    while (cell != null && cell.tagName.toLowerCase() != "td") cell = cell.parentNode;
 
    var tbl = cell;
    var row = tbl;
    var editorPath = eval(chutil.oname).config.editorPath;
 
    while (tbl != null && tbl.tagName.toLowerCase() != "table") tbl = tbl.parentNode;
    while (row != null && row.tagName.toLowerCase() != "tr") row = row.parentNode;
 
    var t_width  = tbl.style.width  ? tbl.style.width  : tbl.width;
    var t_height = tbl.style.height ? tbl.style.height : tbl.getAttribute("height");
    var t_cellpadding = tbl.cellPadding;
    var t_cellspacing = tbl.cellSpacing;
    var t_bgcolor = tbl.getAttribute("bgcolor") ? tbl.bgColor : '';
    var t_bordercolor = tbl.getAttribute("bordercolor") ? tbl.getAttribute("bordercolor") : '';
    var t_border = tbl.getAttribute("border") ? tbl.border : '';
    var c_width = cell.getAttribute("width") ? cell.getAttribute("width") : '';
    var c_height = cell.getAttribute("height") ? cell.getAttribute("height") : '';
    var c_align = cell.getAttribute("align") ? cell.align : '';
    var c_bgcolor = cell.getAttribute("bgcolor") ? cell.bgColor : '';
    var is_ie = navigator.userAgent.toLowerCase().indexOf("msie") != -1;
 
    if (t_height == null) t_height = '';
    t_width = t_width.replace(/px/ig, '');
    t_height = t_height.replace(/px/ig, '');
 
    var html_output = '<table cellpadding="0" cellspacing="0" style="margin-top:5px;">' +
                      '<tr><td><span style="font-size:9pt;">가로 폭: <input type="text" size="4" value="'+t_width+'" id="n_width" />&#160;</span>\n</td>' +
                      '<td>&#160;<span style="font-size:9pt;">셀 패딩: <input type="text" size="1" value="'+t_cellpadding+'" id="n_cellpadding" /></span>\n</td>' +
                      '<td align="right"><span style="font-size:9pt;">테이블 배경 색: <input type="text" size="6" value="'+t_bgcolor+'" id="n_bgcolor" />&#160;</span>\n</td>' +
                      '<td>&#160;<span style="font-size:9pt;">테이블 정렬: <select id="alignment" style="font-size:9pt">' +
                      '<option value="">없음</option>' +
                      '<option value="left">왼쪽</option>' +
                      '<option value="center">가운데</option>' +
                      '<option value="right">오른쪽</option>' +
                      '</select></span></td>' +
                      '</tr><tr>' +
                      '<td><span style="font-size:9pt;">세로 폭: <input type="text" size="4" value="'+t_height+'" id="n_height" />&#160;</span>\n</td>' +
                      '<td>&#160;<span style="font-size:9pt;">셀 간격: <input type="text" size="1" value="'+t_cellspacing+'" id="n_cellspacing" /></span>\n</td>' +
                      '<td align="right"><span style="font-size:9pt;">테이블 테두리 색: <input type="text" size="6" value="'+t_bordercolor+'" id="n_bordercolor" />&#160;</span>\n</td>' +
                      '<td>&#160;<span style="font-size:9pt;">테두리 두께: <input type="text" size="1" value="'+t_border+'" id="n_border" /></span>\n</td>' +
                      '</tr><tr>' +
                      '<td><span style="font-size:9pt;">셀 가로: <input type="text" size="4" value="'+c_width+'" id="c_width" />&#160;</span>\n</td>' +
                      '<td>&#160;<span style="font-size:9pt;">가로 정렬: <select id="c_alignment" style="font-size:9pt;">' +
                      '<option value="">없음</option>' +
                      '<option value="left">왼쪽</option>' +
                      '<option value="center">가운데</option>' +
                      '<option value="right">오른쪽</option>' +
                      '<option value="justify">양쪽</option>' +
                      '</select></span></td>' +
                      '<td align="right"><span style="font-size:9pt;">셀 배경 색: <input type="text" size="6" value="'+c_bgcolor+'" id="c_bgcolor" />&#160;</span>\n</td>' +
                      '<td>&#160;<span style="font-size:9pt;">No Wrap:<input type="checkbox" value="'+t_bgcolor+'" id="nowrap" />&#160;</span>\n' +
                      '<button style="width:54px;height:21px;font-size:9pt;padding-top:2px" id="editcell">수정</button></td>' +
                      '</tr><tr>' +
                      '<td><span style="font-size:9pt;">셀 세로: <input type="text" size="4" value="'+c_height+'" id="c_height" />&#160;</span>\n</td>' +
                      '<td>&#160;<span style="font-size:9pt;">세로 정렬: <select id="c_valignment" style="font-size:9pt;">' +
                      '<option value="">없음</option>' +
                      '<option value=top>위쪽</option>' +
                      '<option value=middle>가운데</option>' +
                      '<option value=bottom>아래</option>' +
                      '<option value=baseline>기준선</option>' +
                      '</select></span></td>' +
                      '<td style=padding-left:12px colspan=2>' +
                      '<img style="vertical-align:middle;width:20px;height:20px;cursor:pointer;" src="'+editorPath+'/icons/increasecolspan.gif" id="increasecolspan" title="ColSpan 증가" />' +
                      '<img style="vertical-align:middle;width:20px;height:20px;cursor:pointer;" src="'+editorPath+'/icons/decreasecolspan.gif" id="decreasecolspan" title="ColSpan 감소" />' +
                      '<img style="vertical-align:middle;width:20px;height:20px;cursor:pointer;" src="'+editorPath+'/icons/increaserowspan.gif" id="increaserowspan" title="RowSpan 증가" />' +
                      '<img style="vertical-align:middle;width:20px;height:20px;cursor:pointer;" src="'+editorPath+'/icons/decreaserowspan.gif" id="decreaserowspan" title="RowSpan 감소" />&#160;&#160;&#160;&#160;' +
                      '<img style="vertical-align:middle;width:20px;height:20px;cursor:pointer;" src="'+editorPath+'/icons/addcol.gif" id="addcol" title="행 삽입" />&#160;' +
                      '<img style="vertical-align:middle;width:20px;height:20px;cursor:pointer;" src="'+editorPath+'/icons/addcols.gif" id="addcols" title="셀 삽입" />&#160;' +
                      '<img style="vertical-align:middle;width:20px;height:20px;cursor:pointer;" src="'+editorPath+'/icons/removecol.gif" id="removecol" title="행 삭제" />&#160;' +
                      '<img style="vertical-align:middle;width:20px;height:20px;cursor:pointer;" src="'+editorPath+'/icons/removecols.gif" id="removecols" title="셀 삭제" />&#160;' +
                      '<img style="vertical-align:middle;width:20px;height:20px;cursor:pointer;" src="'+editorPath+'/icons/addrow.gif" id="addrows" title="열 삽입" />&#160;' + 
                      '<img style="vertical-align:middle;width:20px;height:20px;cursor:pointer;" src="'+editorPath+'/icons/removerow.gif" id="removerow" title="열 삭제" />' +
                      '</td></tr></table>';
 
    statusbar.innerHTML = html_output;
    document.getElementById("nowrap").checked = cell.getAttribute("nowrap") ? true : false;
 
    if (tbl.getAttribute("align")) { document.getElementById("alignment").value = tbl.getAttribute("align"); }
    if (cell.getAttribute("align")) { document.getElementById("c_alignment").value  = cell.getAttribute("align"); }
    if (cell.getAttribute("valign")) { document.getElementById("c_valignment").value    = cell.getAttribute("valign"); }
 
    document.getElementById("editcell").onclick = function() {
        var n_width = document.getElementById("n_width");
        var n_height = document.getElementById("n_height");
        var n_align = document.getElementById("alignment");
        var n_cellpadding = document.getElementById("n_cellpadding");
        var n_cellspacing = document.getElementById("n_cellspacing");
        var n_bgcolor = document.getElementById("n_bgcolor");
        var n_border = document.getElementById("n_border");
        var n_bordercolor = document.getElementById("n_bordercolor");
        var c_width = document.getElementById("c_width");
        var c_height = document.getElementById("c_height");
        var c_bgcolor = document.getElementById("c_bgcolor");
        var c_align = document.getElementById("c_alignment");
        var c_valign = document.getElementById("c_valignment");
 
        tbl.border = parseInt(n_border.value);
        tbl.removeAttribute("width", 0);
        tbl.removeAttribute("height", 0);
 
        if (n_width.value) tbl.style.width = n_width.value;
        if (n_height.value > 0) tbl.style.height = n_height.value;
 
        tbl.cellPadding = n_cellpadding.value;
        tbl.cellSpacing = n_cellspacing.value;
 
        if (n_align.value != "") tbl.align = n_align.value;
        else if (tbl.getAttribute("align")) tbl.removeAttribute("align", 0);
 
        if (n_bgcolor.value) tbl.bgColor = n_bgcolor.value;
        else tbl.removeAttribute("bgcolor", 0);
 
        if (n_bordercolor.value) tbl.setAttribute("bordercolor", n_bordercolor.value);
        else tbl.removeAttribute("bordercolor", 0);
 
        if (c_width.value > 0) cell.width = c_width.value;
        if (c_height.value > 0) cell.height = c_height.value;
 
        cell.noWrap = document.getElementById("nowrap").checked ? true : false;
 
        if (c_align.value != "") cell.align = c_align.value;
        else cell.removeAttribute("align", 0);
 
        if (c_valign.value != "") cell.vAlign = c_valign.value;
        else cell.removeAttribute("valign", 0);
 
        if (c_bgcolor.value) cell.bgColor = c_bgcolor.value;
        else cell.removeAttribute("bgcolor", 0);
    }
 
    document.getElementById("increasecolspan").onclick = function() { cell.colSpan++; }
    document.getElementById("decreasecolspan").onclick = function() {
        if (cell.colSpan == 1) cell.removeAttribute("colspan", 0);
        else cell.colSpan = cell.colSpan - 1;
    }
    document.getElementById("increaserowspan").onclick = function() { cell.rowSpan++; }
    document.getElementById("decreaserowspan").onclick = function() {
        if (cell.rowSpan == 1) cell.removeAttribute("rowspan", 0);
        else cell.rowSpan = cell.rowSpan - 1;
    }
    document.getElementById("addcol").onclick = function() {
        for (var i=0; i<tbl.rows.length; i++) {
            var trow = tbl.rows.item(i);
            var col = trow.insertCell(cell.cellIndex);
            if (!GB.MSIE) {
                var br = document.createElement("br");
                col.appendChild(br);
            }
        }
    }
    document.getElementById("addcols").onclick = function() {
        var col = row.insertCell(cell.cellIndex);
        if (!GB.MSIE) {
            var br = document.createElement("br");
            col.appendChild(br);
        }
    }
    document.getElementById("removecol").onclick = function() {
        for (var i=0; i<tbl.rows.length; i++) {
            var trow = tbl.rows.item(i);
            trow.deleteCell(cell.cellIndex);
        }
    }
    document.getElementById("removecols").onclick = function() { row.deleteCell(cell.cellIndex); }
    document.getElementById("addrows").onclick = function() {
        var nrow = tbl.insertRow(row.rowIndex);
        var len = row.cells.length;
        for (var i=0; i<len; i++) {
            var td = nrow.insertCell(i);
            if (!GB.MSIE) {
                var br = document.createElement("br");
                td.appendChild(br);
            }
        }
    }
    document.getElementById("removerow").onclick = function() { tbl.deleteRow(row.rowIndex); }
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
        if (el.src.indexOf('/icons/em/') == -1) {
            modifyBlock.style.display = "block";
            cheditor.modifyImage(el, modifyBlock);
        }
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
        var found = false;
        statusBar.innerHTML = '&lt;html&gt; &lt;body&gt; ';
 
        for (var i = ancestors.length; --i >= 0;) {
            el = ancestors[i];
            if (!el || el.tagName.toLowerCase() == 'html' || el.tagName.toLowerCase() == 'body')
                continue;
            var tag = el.tagName.toUpperCase();
            var a = document.createElement("a");
            a.href = "#";
            a.el = el;
            a.style.color = '#0033cc';
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
 
            a.appendChild(document.createTextNode(tag.toLowerCase()));
            statusBar.appendChild(document.createTextNode('<'));
            statusBar.appendChild(a);
            statusBar.appendChild(document.createTextNode('> '));
            found = true;
        }
 
        if (found) {
            var a = document.createElement("a");
            a.href = "#";
            a.style.color = '#cc3333';
            a.id = "removeSelected";
            a.style.display = "none";
            a.style.fontSize = '8pt';
            a.style.fontFamily = 'verdana';
            a.onclick = function() {
                this.blur();
                oEditor.document.execCommand("RemoveFormat", false, null);
                oEditor.focus();
                cheditor.setEditorEvent(oname);
                return false;
            };
 
            a.appendChild(document.createTextNode('remove'));
            var span = document.createElement('span');
            span.style.marginTop = '2px';
            span.appendChild(a);
            statusBar.appendChild(span);
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