//	easy WebEditor (DHTML wysiwyg À¥¿¡µðÅÍ)
//	Beta 20061228
//	http://cafe.daum.net/easyeditor
//º¯¼ö¼³Á¤
var easyConfig = {
	//----------------------------------------------------
	//style
	border:"1px solid #cdcdcd",	//±âº» border
	bgcolor : "#fff",			//±âº» bgcolor
	font : "normal 10pt ±¼¸²",	//±âº» ÆùÆ® style(font-style, font-variant, font-weight)
	color : "#000",				//±âº» ÆùÆ® ÄÃ·¯
	margin : "5px",				//³»ºÎ margin
	width : "100%",				//±âº» width
	height : "200px",			//±âº» height
	//----------------------------------------------------
	filepath : ".",	
	imgpath : "./img/easy",		//¹öÆ° ÀÌ¹ÌÁö°æ·Î
	over_bordercolor : "#fff",	//¹öÆ° ¿À¹ö½Ã º¸´õÄÃ·¯
	over_bgcolor : "#ff6600",	//¹öÆ° ¿À¹ö½Ã bgcolor
	divbtn_bgcolor : "#fff",	//¹öÆ° ¿µ¿ª div bgcolor
	//----------------------------------------------------
	//±âº»¹öÆ° 
	Btn : null,
	BtnList : {
		font	: ["±ÛÀÚÃ¼","font.gif"], size : ["±ÛÀÚÅ©±â","size.gif"],
		undo	: ["µÇµ¹¸®±â","undo.gif"], redo : ["Àç½ÇÇà","redo.gif"],
		bold	: ["±½°Ô","bold.gif"], italic : ["±â¿ï¸®±â","italic.gif"],
		strike	: ["Ãë¼Ò¼±","strike.gif"], left : ["¿ÞÂÊ ¸ÂÃã","left.gif"],
		center	: ["°¡¿îµ¥ ¸ÂÃã","center.gif"], right : ["¿À¸¥ÂÊ ¸ÂÃã","right.gif"],
		justify : ["È¥ÇÕÁ¤·Ä","justify.gif"], clean : ["½ºÅ¸ÀÏ Áö¿ò","clean.gif"],
		del		: ["¼±ÅÃ»èÁ¦","del.gif"], color : ["±ÛÀÚ»ö","color.gif"],
		hilite	: ["±ÛÀÚ ¹è°æ»ö","hilite.gif"], link	: ["¸µÅ© »ðÀÔ","link.gif"],
		unlink	: ["¸µÅ© ÇØÁ¦","unlink.gif"], ul1 : ["¹øÈ£´Þ±â","ul1.gif"],
		ul2		: ["±âÈ£´Þ±â","ul2.gif"], outdent : ["³»¾î¾²±â","outdent.gif"],
		indent	: ["µé¿©¾²±â","indent.gif"], hr : ["¼öÆò¼± »ðÀÔ","hr.gif"],
		all		: ["ÀüÃ¼¼±ÅÃ","selectall.gif"], save : ["¹®¼­ ÀúÀå","save.gif"],
		sup	: ["À­Ã·ÀÚ","sup.gif"], sub : ["¾Æ·¡Ã·ÀÚ","sub.gif"],
		underline : ["¹ØÁÙ","underline.gif"], about : ["ÀÌÁö À¥¿¡µðÅÍ","about.gif"],
		//cut	: ["Àß¶ó³»±â","cut.gif"],copy: ["º¹»ç","copy.gif"],paste: ["ºÙ¿©³Ö±â","paste.gif"],
		source  : ["¼Ò½ºº¸±â","source.gif"], bar : ["±¸ºÐ¼±","bar.gif"]
	},	
	//----------------------------------------------------
	//±âº»¹öÆ°ÅÛÇÃ¸´ (all,simple)
	BtnTemplate  : {
		all : ["save","preview","bar","all","undo","redo","bar",
				"font","size","bar","color","hilite","bar","bold","italic",
				"underline","strike","bar","sup","sub","bar","clean","del","bar","outdent","indent",
				"bar","ul1","ul2","bar","left","center","right","justify","bar","hr","link",
				"unlink","bar","table","image","bar","source"],
		simple : ["source","bar","bold","color","hilite"]
	},
	version : "Beta",
	name : "easyWebEditor"
}
// easyEditor
function easyEditor(id)
{
	if(typeof(document.execCommand)=="undefined") return;
	easyUtil.init();
	//config¼³Á¤
	this.cfg = easyConfig;
	this.cfg.preid = easyConfig.name+"_"+id;
	this.cfg.Btn = easyConfig.BtnTemplate["all"]; //±âº» ¹öÆ° ÅÛÇÃ¸´
	this.mode = "wysiwyg";
	this.btn = "";
	this.sel	  = null;
	this.range	  = null;
	this.sel_html = "";
	this._doc		= null;
	this._textarea	= document.getElementById(id);
	this._div		= document.createElement("div");		//ÀüÃ¼ div
	this._divbtn	= document.createElement("div");		//¹öÆ°¿µ¿ª div
	this._iframe	= document.createElement("iframe");		//iframe
	this._text		= document.createElement("textarea");	//textarea(source)
	this._div.id	= this.cfg.preid+"_div";
	this._divbtn.id	= this.cfg.preid+"_divbtn";
	this._iframe.id	= this.cfg.preid+"_iframe";
	this._text.id	= this.cfg.preid+"_text";
}
//easyEditor.init
easyEditor.prototype.init = function()
{	
	this._textarea.style.display="none";
	//source
	this._text.style.width = this.cfg.width;
	this._text.style.height= this.cfg.height;
	this._text.style.border= "none";
	this._text.style.display="none";
	this._text.style.font = "9pt ±¼¸²";
	this._text.style.background = "#efefef url("+this.cfg.imgpath+"/source_bg.gif) 0 -2px";
	this._text.style.lineHeight = "165%";
	//iframe
	this._iframe.style.width = this.cfg.width;
	this._iframe.style.height= this.cfg.height;	
	//this._iframe.scrolling	 = "yes";
	this._iframe.frameBorder = "no";
	//this._iframe.onmouseover = easyUtil.hideDiv;
	//ÀüÃ¼ div	
	this._div.style.border	= this.cfg.border;
	this._div.style.width	= this.cfg.width;
	//¹öÆ° div		
	this._divbtn.style.padding	="2px";
	this._divbtn.style.backgroundColor = this.cfg.divbtn_bgcolor;
	this._divbtn.style.borderBottom = this.cfg.border;
	if(easyUtil.isIE) {this._divbtn.style.width = this.cfg.width;}	
	//»ðÀÔ
	this._textarea.parentNode.insertBefore(this._div, this._textarea);
	this._div.appendChild(this._divbtn);
	this._div.appendChild(this._iframe);
	this._div.appendChild(this._text);	
	//¹öÆ°¿ä¼Ò »ðÀÔ
	this.setBtn();
	//iframe doc
	this._doc = this._iframe.contentWindow.document;
	this._doc.designMode="on";
	//±âº» css¼³Á¤ 
	var css  = "body{margin:"+this.cfg.margin+";background-color:"+this.cfg.bgcolor+";}";
	css		+= " body,table,td{font:"+this.cfg.font+";color:"+this.cfg.color+";}";
	this._iframe.css = css;
	this._doc.open();
	this._doc.write('<html><head><style type="text/css">'+css+'</style></head><body>'+this._textarea.value+'</body></html>');
	this._doc.close();
	
	var self=this;
	easyUtil.addEvent(this._doc, "mousedown", easyUtil.hideDiv);
	if(easyUtil.isIE)
	{
		easyUtil.addEvent(this._doc, "keydown", function(e) {
			var range=self._doc.selection.createRange();
			if(e.keyCode==13 && range.parentElement().tagName!="LI")
			{			
				e.cancelBubble=true; e.returnValue=false;
				range.pasteHTML("<br />"); range.select(); return false;
			}
		});
	}
};
//easyEditor.setBtn
easyEditor.prototype.setBtn = function()
{
	this.cfg.Btn.push("bar","ab"+"out");
	var arr=this.cfg.Btn;
	var len=arr.length; var str=order=tmp=""; var btn=tag=null;
	var self=this; var bgcolor=this.cfg.divbtn_bgcolor;
	var over_bordercolor=this.cfg.over_bordercolor;
	var over_bgcolor=this.cfg.over_bgcolor;

	for(var i=0;i<len;i++)
	{
		tmp = "";
		order = easyUtil.trim(arr[i]);		
		btn = this.cfg.BtnList[order];

		if(order!="br" && !btn)
		{	
			if(order!="") alert("¾ø´Â ¹öÆ°¸í·ÉÀÔ´Ï´Ù ("+order+")");
			continue;
		}
		if(order=="bar")
		{
			tag			= document.createElement("img");
			tag.src		= this.cfg.imgpath+"/"+btn[1];
			tag.width	= 2;
			tag.height	= 18;
			tag.hspace	= 4;
			tag.align	="absmiddle";
			this._divbtn.appendChild(tag);
		}
		else if(order=="br") //br
		{
			this._divbtn.appendChild(document.createElement("br"));
		}
		else
		{
			tag			= document.createElement("img");
			tag.id		= this.cfg.preid+"_btn_"+order;
			tag.src		= this.cfg.imgpath+"/"+btn[1];
			tag.align	="absmiddle";
			tag.alt		= btn[0];
			tag.cmd		= order;
			tag.style.cursor="pointer";
			tag.style.border="1px solid "+this.cfg.divbtn_bgcolor;
					
			tag.onclick = function() { self.cmd(this, this.cmd); };
			tag.onmouseover = function() 
				{ this.style.border="1px solid "+over_bordercolor;this.style.backgroundColor=over_bgcolor; };
			tag.onmouseout = function() 
				{ this.style.border="1px solid "+bgcolor;this.style.backgroundColor=""; };
			this._divbtn.appendChild(tag);
		}
	}
};
//easyEditor.cmd
easyEditor.prototype.cmd = function(btn, order, value) 
{
	var self = (this) ? this:easyUtil._editor;
	var doc = self._doc;
	if(self.mode=="text" && order!="source") {alert("'¼Ò½ºº¸±â' ÇØÁ¦ÈÄ »ç¿ëÇØ ÁÖ¼¼¿ä!");	return;}
	self.focus();
	easyUtil.hideDiv();	self.btn = btn;

	try{var create_func = self.cfg.BtnList[order][2];}catch(e) {}
	if(typeof(create_func)=="function")	order = "create_order";

	switch(order)
	{		
		case "create_order":	//»ç¿ëÀÚ Ãß°¡¸í·É
			self.setSelection();
			easyUtil._editor = self;
			easyUtil.order = order;
			create_func(self);
		break;
		case "hyperlink": 	
			var link_text = (self.sel_html) ? self.sel_html : easyUtil._linktxt.value;
			var html = "<a href='"+easyUtil._linktxt.value+"' target='_blank'>"+link_text+"</a>";
			self.innerHTML(html);			
		break;
		case "color": case "hilite":
		case "font": case "size":
		case "link": case "about": 
			var div=null;
			if(order=="color")		{ order = "forecolor"; easyUtil.tblSet_color(); div=easyUtil._colortbl;}
			else if(order=="hilite"){ order = "hilitecolor"; easyUtil.tblSet_color(); div=easyUtil._colortbl;}
			else if(order=="font")	{ order = "fontname"; easyUtil.tblSet_font(); div=easyUtil._fonttbl;}
			else if(order=="size")	{ order = "fontsize"; easyUtil.tblSet_size(); div=easyUtil._sizetbl;}
			else if(order=="about")	{ easyUtil.tblSet_about(); div=easyUtil._abouttbl;}
			else if(order=="link") 
			{
				order = "hyperlink"; 
				easyUtil.tblSet_link();
				div=easyUtil._linktbl; 
				easyUtil._linktxt.value = "http://";
				self.setSelection();
			}
		
			easyUtil._editor = self;
			easyUtil.order = order;
			easyUtil.showDiv(div);
		break;
		case "source":
			if(self.mode=="wysiwyg")
			{
				self._text.value = self.getHtml();
				self._iframe.style.display = "none";
				self._text.style.display = "";
				btn.onmouseout = null;
				self.mode="text";				
			}
			else if(self.mode=="text")
			{
				doc.body.innerHTML = self.getHtml();
				self._text.style.display = "none";
				self._iframe.style.display = "";
				bgcolor = self.cfg.divbtn_bgcolor;
				btn.onmouseout = function() 
					{ this.style.border="1px solid "+bgcolor;this.style.backgroundColor=""; };
				self.mode="wysiwyg";
			}
		break;
		default:
			if(order=="strike")		order = "strikethrough";
			else if(order=="ul1")	order = "insertorderedlist";
			else if(order=="ul2")	order = "insertunorderedlist";			
			else if(order=="hr")	order = "inserthorizontalrule";
			else if(order=="clean") order = "removeformat";
			else if(order=="save")	order = "saveas";
			else if(order=="all")	order = "selectall";
			else if(order=="sup")	order = "superscript";
			else if(order=="sub")	order = "subscript";
			else if(order=="del")	order = "delete";
			else if(order=="justify") order = "justifyfull";
			else if(order=="center"||order=="left"||order=="right") order = "justify"+order; 
			else if(order=="hilitecolor" && easyUtil.isIE) order = "backcolor";
			doc.execCommand(order, false, value);
		break;
	}
};
//easyEditor.focus
easyEditor.prototype.focus = function() 
{
	if(this.mode=="text") this._text.focus();
	else this._iframe.contentWindow.focus();
}
//easyEditor.getHtml
easyEditor.prototype.getHtml = function() 
{
	var html = "";
	var doc = this._doc;
	if(this.mode=="text") html = this._text.value;
	else
	{
		for(i in doc.links) { if(!doc.links[i].target) doc.links[i].target = "_blank"; }
		html = doc.body.innerHTML;
	}
	this._textarea.value = html;
	return html;
}
//easyEditor.setSelection
easyEditor.prototype.setSelection = function() 
{
	var _iframe=this._iframe;
	var sel=null,range=null,html="";

	if(this._doc.selection)
	{
		sel = this._doc.selection;
		range = sel.createRange();
		html = range.htmlText;
	}
	else if(_iframe.contentWindow.getSelection)
	{
		sel=_iframe.contentWindow.getSelection();
		if (typeof(sel)!="undefined") range=sel.getRangeAt(0);
		else range=this._doc.createRange();
		if(sel.rangeCount > 0 && window.XMLSerializer)
		{	
			html=new XMLSerializer().serializeToString(range.cloneContents());
		}
	}
	this.sel = sel;
	this.range = range;
	this.sel_html = html;
}
//easyEditor.innerHTML
easyEditor.prototype.innerHTML = function(html) 
{
	if(easyUtil.mode=="text") return;
	if(this.range.pasteHTML) this.range.pasteHTML(html);
	else this._doc.execCommand("inserthtml", false, html);
}
//easyUtil
var easyUtil = {	
	_editor : null,	_colortbl : null,
	_fonttbl : null, _sizetbl : null,
	_abouttbl : null, 
	_linktbl : null, _linktxt : null,
	arrtbl : new Array("color","font","size","link","about"),
	order : "",
	is_init : 0,
	isIE : (window.showModalDialog) ? 1:0,
	
	init : function()
	{
		if(easyUtil.is_init) return;

		var s="<style>";
		s += ".easyWebEditorDiv a {text-decoration:none;color:#000}"
		s += "#"+easyConfig.name+"_colortbl a {border:1px solid #f5f5f5;padding:0 6px;height:9px;font:8px verdana;text-decoration:none}";
		s += "</style>";
		document.write(s);
		easyUtil.is_init=1;
	},	
	showDiv : function(div)
	{
		var btn = easyUtil._editor.btn;
		div.style.top= easyUtil.curTop(btn) + btn.offsetHeight + "px";
		div.style.left = easyUtil.curLeft(btn) + "px";
		div.style.display="";
	},
	hideDiv : function()
	{
		if(typeof(easyUtil)!="object") return;
		for(var i=0; i<easyUtil.arrtbl.length; i++)
		{
			try{ eval('easyUtil._'+easyUtil.arrtbl[i]+'tbl.style.display="none"'); }
			catch(e) { }
		}
	},
	curTop : function(el) 
	{
		var top = el.offsetTop;
		var parent = el.offsetParent;
		while(parent) {	top += parent.offsetTop; parent = parent.offsetParent; }
		return top;
	},
	curLeft : function(el) 
	{
		var left = el.offsetLeft;
		var parent = el.offsetParent;
		while(parent) {	left += parent.offsetLeft; parent = parent.offsetParent; }
		return left;
	},
	tblSet_about : function()
	{	
		if(easyUtil._abouttbl) return;
		var s="<span style='color:#ff6600'>ÀÌÁö À¥¿¡µðÅÍ</span><br/>¹öÀü "+easyConfig.version+" <br/>";
		s +="µµ¿ò <a href='http://cafe.daum.net/easyeditor' target='_blank'>http://cafe.daum.net/easyeditor</a>";
		var d = easyUtil.getDiv(easyConfig.name+"_abouttbl",s);
		d.style.font = "9pt µ¸¿ò";	d.style.lineHeight ="150%";	
		document.body.appendChild(d); easyUtil._abouttbl = d;
	},
	tblSet_link : function()
	{	
		if(easyUtil._linktbl) return;
		var id = easyConfig.name+"_linktxt";
		var s = "<input type='text' value='http://' style='width:230px;font:8pt µ¸¿ò;color:gray' id='"+id+"' /><br>";
		s += "¸µÅ©ÁÖ¼Ò(URL)¸¦ ³Ö¾îÁÖ¼¼¿ä<br><br>";
		s += "<a href='javascript:;' onclick=\"easyUtil._editor.cmd(null, easyUtil.order, '');\">È®ÀÎ</a>";
		
		var div = easyUtil.getDiv(easyConfig.name+"_linktbl",s);
		div.style.padding = "15px";
		div.style.font = "8pt µ¸¿ò";
		document.body.appendChild(div);
		easyUtil._linktbl = div;
		easyUtil._linktxt = document.getElementById(id);
	},
	tblSet_size : function()
	{
		if(easyUtil._sizetbl) return;
		var size = new Array(8,10,12,14,18,24);
		var s="";

		for(var i=0; i<size.length; i++)
		{
			s += "<a href='javascript:;' onclick=\"easyUtil._editor.cmd(null, easyUtil.order,'"+(i+1)+"');\" style='font:"+size[i]+"pt ±¼¸²;'>°¡³ª´Ù¶ó ("+size[i]+")</a><br />";
		}
		var div = easyUtil.getDiv(easyConfig.name+"_sizetbl",s);
		div.style.padding = "5px";
		document.body.appendChild(div);
		easyUtil._sizetbl = div;
	},
	tblSet_font : function()
	{
		if(easyUtil._fonttbl) return;
		var font = new Array("±¼¸²","µ¸¿ò","±Ã¼­","arial","verdana");
		var s=""; var pattern=/^[°¡-ÆR]+$/;

		for(var i=0; i<font.length; i++)
		{
			txt = (pattern.test(font[i])) ? "°¡³ª´Ù¶ó¸¶¹Ù»ç":"abcdefghijkl";
			s += "<a href='javascript:;' onclick=\"easyUtil._editor.cmd(null, easyUtil.order,'"+font[i]+"');\" style='font:10pt "+font[i]+";line-height:170%'>"+txt+" ("+font[i]+")</a><br />";
		}
		var div = easyUtil.getDiv(easyConfig.name+"_fonttbl",s);
		div.style.padding = "5px";
		document.body.appendChild(div);
		easyUtil._fonttbl = div;
	},
	tblSet_color : function()
	{
		if(easyUtil._colortbl) return;
		var col= new Array();
		col[0] = new Array("#ffffff","#e5e4e4","#d9d8d8","#c0bdbd","#a7a4a4","#8e8a8b","#827e7f","#767173","#5c585a","#000000");
		col[1] = new Array("#fefcdf","#fef4c4","#feed9b","#fee573","#ffed43","#f6cc0b","#e0b800","#c9a601","#ad8e00","#8c7301");
		col[2] = new Array("#ffded3","#ffc4b0","#ff9d7d","#ff7a4e","#ff6600","#e95d00","#d15502","#ba4b01","#a44201","#8d3901");
		col[3] = new Array("#ffd2d0","#ffbab7","#fe9a95","#ff7a73","#ff483f","#fe2419","#f10b00","#d40a00","#940000","#6d201b");
		col[4] = new Array("#ffdaed","#ffb7dc","#ffa1d1","#ff84c3","#ff57ac","#fd1289","#ec0078","#d6006d","#bb005f","#9b014f");
		col[5] = new Array("#fcd6fe","#fbbcff","#f9a1fe","#f784fe","#f564fe","#f546ff","#f328ff","#d801e5","#c001cb","#8f0197");
		col[6] = new Array("#e2f0fe","#c7e2fe","#add5fe","#92c7fe","#6eb5ff","#48a2ff","#2690fe","#0162f4","#013add","#0021b0");
		col[7] = new Array("#d3fdff","#acfafd","#7cfaff","#4af7fe","#1de6fe","#01deff","#00cdec","#01b6de","#00a0c2","#0084a0");
		col[8] = new Array("#edffcf","#dffeaa","#d1fd88","#befa5a","#a8f32a","#8fd80a","#79c101","#3fa701","#307f00","#156200");
		col[9] = new Array("#d4c89f","#daad88","#c49578","#c2877e","#ac8295","#c0a5c4","#969ac2","#92b7d7","#80adaf","#9ca53b");
		var s="";
		for(var i=0; i<10; i++)
		{
			for(var j=0; j<10; j++)
			{
				color = col[i][j];
				s += "<a href='javascript:;' onclick=\"easyUtil._editor.cmd(null, easyUtil.order,'"+color+"');\" style='background-color:"+color+";'>&nbsp;</a>";
			}
			s += "<br />";
		}
		var div = easyUtil.getDiv(easyConfig.name+"_colortbl",s);
		document.body.appendChild(div);
		easyUtil._colortbl = div;
	},
	getDiv : function(id, html)
	{
		var div = document.createElement("div");
		div.id = id;
		div.className = "easyWebEditorDiv";
		div.style.position = "absolute";
		div.style.backgroundColor = "#f5f5f5";
		div.style.display = "none";
		div.style.border = "1px solid #ccc";
		div.style.padding = "5px";
		div.innerHTML = html;
		return div;
	},
	addEvent : function(object, type, listener)
	{	
		if(object.addEventListener) { object.addEventListener(type, listener, false); } 
		else if(object.attachEvent) { object.attachEvent("on"+type, listener); } 
	},
	trim : function(s) {return s.replace(/^\s+|\s+$/g,'');} 
};
//--------------------------------------------------------
//¸í·É(¹öÆ°) Ãß°¡
easyConfig.BtnList.table = ["Å×ÀÌºí »ðÀÔ","table.gif", 
function (self){ 
	window.open(easyConfig.filepath+"/table.html","table","width=400,height=220,status=1");
} ];

easyConfig.BtnList.preview = ["¹Ì¸®º¸±â","preview.gif",
function (self){
	var w=window.open("","preview","width=800,height=600,status=1,scrollbars=1,resizable=1");
	w.document.open();
	w.document.write("<style>"+self._iframe.css+"</style>"+self.getHtml());
	w.document.close();
}];

easyConfig.BtnList.image = ["ÀÌ¹ÌÁö »ðÀÔ","image.gif",
function (self){
	var order = "image";
	var txt_id = easyConfig.name+"_imagetxt";
	var div_id = easyConfig.name+"_imagetbl";
	var div = null;
	
	if(self.btn) //image ·¹ÀÌ¾î º¸¿©ÁÖ±â
	{	
		if(!document.getElementById(div_id))
		{	
			var s="";
			s +="<input type='text' value='http://' style='width:230px;font:8pt µ¸¿ò;color:gray' id='"+txt_id+"' /><br />";
			s += "ÀÌ¹ÌÁöÁÖ¼Ò(URL)¸¦ ³Ö¾îÁÖ¼¼¿ä<br /><br />";
			s += "<a href='javascript:;' onclick=\"easyUtil._editor.cmd(null, '"+order+"', '');\">È®ÀÎ</a>";
			div = easyUtil.getDiv(div_id,s);
			div.style.padding = "15px";
			div.style.font = "8pt µ¸¿ò";
			document.body.appendChild(div);
			easyUtil._imagetbl = div;
			easyUtil.arrtbl.push(order);
		}
		else
		{
			document.getElementById(txt_id).value = "http://";
			div = document.getElementById(div_id);
		}
		easyUtil.showDiv(div);
	}
	else //¸í·É½ÇÇà(ÀÌ¹ÌÁö»ðÀÔ)
	{
		var html = "<img src='"+document.getElementById(txt_id).value+"' border='0' />";
		self.innerHTML(html);
	}
}];