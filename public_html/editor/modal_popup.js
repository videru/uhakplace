	/* =================================================================
	//	참    조: 팝업창 
	//	작 성 일: 2006.06.16
	================================================================= */

	var ostmp = navigator.appName.charAt(0);
	var os = (ostmp=='M') ? '' : 1;

	if(!os){
		var elements = new Array();
		var vArguments = window.dialogArguments;
		elements[0] = vArguments.charsets;
		elements[1] = vArguments.arg;
	}
	else{
		var element = opener.document.getElementById("editor_stom").value;
		var elements = element.split('#');
		opener.document.getElementById("editor_stom").value = elements[0];
	}

	function url_write(){
		var tmp_editor_url = !os ? vArguments.url : opener.document.getElementById("editor_url").value;
		document.getElementById('url').value = tmp_editor_url;
		document.getElementById('lang').value = elements[0];
		document.getElementById('wr').value = elements[1];

		document.getElementById('upfile').disabled = ((elements[1] == 1) ? true : false);
		document.getElementById('upfile').style.background = ((elements[1] == 1) ? 'silver' : 'FFFFFF');
	}

	function midView(){
		var upload = document.getElementById("upfile");
		var link = document.getElementById("link");
		var url;

		if((elements[1] != 1) && upload.value){
			url = upload.value;
			document.getElementById('link').value = "";
		}
		else{
			url = link.value;
			document.getElementById('upfile').value = "";
		}

		var key = "<OBJECT ID='MMPlayer1' classid='CLSID:22d6f312-b0f6-11d0-94ab-0080c74c7e95' 'http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#Version=6,4,5,715' standby='Loading Microsoft Windows Media Player components...' type='application/x-oleobject' width='300' height='250'>";
			key += "<PARAM NAME=filename VALUE='" + url + "'>";
			key += "<PARAM NAME=ShowControls VALUE=true>";
			key += "<PARAM NAME=menu VALUE=true>";
			key += "<PARAM NAME=ShowStatusBar VALUE=high>";
			key += "<PARAM NAME=wmode VALUE=transparent>";
			key += "<embed wmode=transparent>";
			key += "<EMBED src='" + url + "' menu=false quality=high TYPE='application/x-oleobject'>";
			key += "</OBJECT>";

		document.getElementById('preview_mid').innerHTML = key;
	}

	function imgview(id){
		var size1,size2;
		var tmp = new Image();
		var key_1 = document.getElementById('upfile').value;
		var key_2 = document.getElementById('link').value;
		var imgObj = document.images;
		var tmp_key = ((id == 1) && (elements[1] != 1)) ? key_1 : key_2;

		if(id == 1) document.getElementById('link').value = "";
		else document.getElementById('upfile').value = "";

		tmp.src = tmp_key;
		size1 = tmp.width;
		size2 = tmp.height;

		size1 = (250>=size1) ? size1 : 250;
		size2 = (250>=size2) ? size2 : 250;
		
		imgObj.Pickimg.style.display = "";
		imgObj.Pickimg.src = tmp_key;
		imgObj.Pickimg.width = size1;
		imgObj.Pickimg.height = size2;
	}

	function insertHtml(val){
		if(val){
			if(!os){
				var returnVal = new Object();
				returnVal.mode = 'makeTag';
				returnVal.val = val;
				window.returnValue = returnVal;
			}
			else{
				window.opener.HTMLPaste(val);
			}
		}
		self.close();
	}

	function createTable(color){
		if(window.open){
			var val;
			var u = document.add_form;
			var key_1 = u.border.value;
			var key_2 = u.cellspacing.value;
			var key_3 = u.cellpadding.value;
			var key_4 = u.width.value;
			var key_5 = u.widthExt.value;
			var key_6 = u.alignment.value;
			var key_7 = u.rows.value;
			var key_8 = u.cols.value;
			var key_9 = u.bgcolor.value;
			var tmp_per = parseInt(100/key_8);
				key_4 = (key_4 > 0) ? key_4 : 100;
				key_7 = (key_7 > 0) ? key_7 : 1;
				key_8 = (key_8 > 0) ? key_8 : 1;

			val = '<table border="' + key_1 + '" cellspacing="' + key_2 + '" cellpadding="' + key_3 + '" width="' + key_4 + key_5 + '" align="' + key_6 + '"';
			val += key_9 ? ' bgcolor="' + key_9 + '"' : '';
			val += '>';

			for (var i=0; i<key_7; i++){
				val += '<TR>';
				for (var j=0; j<key_8; j++) val += '<TD width="' + tmp_per + '%">&nbsp;</TD>';
				val += '</TR>';
			}
			val += '</TABLE>';
			return val;
		}
	}

	function inserColor(color){
		var u = document.add_form;
		u.bgcolor.value = color;
		document.getElementById('table_view').innerHTML = createTable(color);
	}

	function tableView(color){
		document.getElementById('table_view').innerHTML = createTable(color);
	}

	function insertTable(){
		var val = createTable();
		if(!os){
			var returnVal = new Object();
			returnVal.mode = 'makeTag';
			returnVal.val = val;
			window.returnValue = returnVal;
		}
		else{
			window.opener.HTMLPaste(val);
		}
		self.close();
	}

	function changeLink(){
		var tmp_link,tmp_url;
		var u = document.add_form;

		tmp_link = u.link.value.split(':');
		if(tmp_link[1]){
			tmp_url = tmp_link[1].replace(/^\/\//,'');
			tmp_url = tmp_url.replace(/:/,'');
			tmp_url = tmp_url.replace(/\//,'');
		}
		else{
			tmp_url = '';
		}
		u.link.value = u.type.value + tmp_url;
	}

	function createLink(){
		if(window.open){
			var val = document.add_form.link.value;
			if(!os){
				var returnVal = new Object();
				returnVal.mode = 'CreateLink';
				returnVal.val = val;
				window.returnValue = returnVal;
			}
			else{
				window.opener.htmltrue('CreateLink',val,false);
			}
			self.close();
		}
	}

	function zoomout(id){
		if(id){
			document.getElementById('zoomin').style.zoom = id;
		}
	}

	function zoomVal(){
		document.getElementById('zoom_val').disabled = ((os == 1) ? true : false);
	}

	function createEmotions(key){
		if(window.open){
			var tmp_editor_url = !os ? vArguments.url : opener.document.getElementById("editor_url").value;
				val = '<img src="' + tmp_editor_url + '/img/emotions/' + key + '" border="0">';
			if(!os){
				var returnVal = new Object();
				returnVal.mode = 'makeTag';
				returnVal.val = val;
				window.returnValue = returnVal;
			}
			else{
				window.opener.HTMLPaste(val);
			}
			self.close();
		}
	}

	function createFont(val,key){
		if(window.open){
			var tmp = (key == true) ? 'fontname' : 'fontsize';
			if(!os){
				var returnVal = new Object();
				returnVal.mode = tmp;
				returnVal.val = val;
				window.returnValue = returnVal;
			}
			else{
				window.opener.htmltrue(tmp,val,false);
			}
			self.close();
		}
	}

	function search(){
		var shflag = "";
		var gmform = document.add_form;
		var str = gmform.sh.value;
		var str2 = gmform.reg.value;

		if(gmform.opt1[1].checked) shflag = "g";
		if(gmform.opt2[1].checked) shflag += "i";

		replacekey = new RegExp(str,shflag);
		gmform.content.value = gmform.content.value.replace(replacekey,str2);
	}

	function str_reg(){
		if(window.open){
			if(!os){
				var returnVal = new Object();
				returnVal.mode = 'InsertData';
				returnVal.html = document.add_form.content.value;
				window.returnValue = returnVal;
			}
			else{
				opener.gmFrame.document.body.innerHTML = document.add_form.content.value;
			}
			window.close();
		}
	}

	function TapKey(idx){
		if(event.keyCode==9) {
			var sel,tapkey;
			idx.focus();
			tapkey = "	";
			idx.sel = document.selection.createRange();
			idx.sel.text = tapkey;
			event.returnValue = false;
		}  
	}

	function valOutPut(){
		var text = !os ? vArguments.html : opener.gmFrame.document.body.innerHTML;
		text = text.replace(/&/g, "&amp;");
		text = text.replace(/"/g, "&quot;");
		text = text.replace(/</g, "&lt;");
		text = text.replace(/>/g, "&gt;");
		text = text.replace(/'/g, "&#39;");
		return text;
	}

	document.write('<STYLE>');
	document.write('td {font-size :9pt;color :#666666;}');
	document.write('a {text-decoration: none;color:#333333}');
	document.write('.input {font-family: "돋움체";font-size: 11px;color: #333333;border: 1px solid #CCCCCC;}');
	document.write('p{margin-top:1px;margin-bottom:1px;}');
	document.write('</STYLE>');
	document.write('<sc'+'ript language-"javascript" src="./languages/' + elements[0] + '/java.lang.js"></sc'+'ript>');
	if(os)
	document.charset = elements[0];
