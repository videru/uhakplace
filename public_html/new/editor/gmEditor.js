//-------------------------------------------------------------------//
//  프로그램명 : gmEditor v1.2
//-------------------------------------------------------------------//
//  최초 개발 완료일 : 2006-01-05
//  개발사 및 저작권자 : PHP몬스터
//  웹사이트 : http://www.phpmonster.co.kr
//  개 발 자 : 박요한 (misnam@gmail.com)
//-------------------------------------------------------------------//
//                           카피라이트
//-------------------------------------------------------------------//
//  본 프로그램은 무료 프로그램으로 배포됩니다.
//  gmEditor는 GNU General Public License(GPL) 를 따릅니다.
//  보다 자세한 내용은 LICENSE를 참조하십시요.
//  참고: http://korea.gnu.org/people/chsong/copyleft/gpl.ko.htmll
//-------------------------------------------------------------------//
//                           개발환경
//-------------------------------------------------------------------//
//  Browser: 익스플로러, 파이어폭스, 네스케이프, 오페라
//  Server : PHP가 지원되는 모든 서버
//-------------------------------------------------------------------//


var str,os;
var gmFrame = '';
var ostmp = navigator.appName.charAt(0);

// browser
os = (ostmp=='M') ? '' : 1;

// frame type
gmFrame = document.getElementById("gmEditor").contentWindow;

// IE ? Nets
str = "<style>body{font-family: 돋움;font-size: 12px;color: #555555;margin: 0px}td{font-size :11px; font-family: Tahoma,Verdana,Arial;}p{margin-top:1px;margin-bottom:1px;}</style>\n";



// new document
function newDoc(){
	gmFrame.document.open("text/html");
	gmFrame.document.write(str);
	gmFrame.document.write("&nbsp;");
	gmFrame.document.close();
	gmFrame.focus();
}

// layer Hide
function Layerhide(name){
	document.getElementById(name).innerHTML = '';
}

// zoom
function zoom(id){
	if(id) gmFrame.document.body.style.zoom = id + '%';
} // end func

function zoom_click(){
	if(os == 1) return false;
	var zoom_per = ['300','250','200','150','100','75','50','25'];
	var body = '<table align="center" border="0" cellpadding="0" cellspacing="0" width="90" bgcolor="CCCCCC" style="cursor:hand;" onMouseLeave="Layerhide(\'zoomin\');">';
		body += '<tr><td height=1></td></tr>';
		body += '<tr>';
		body += '  <td>';
		body += '  <table align="center" border="0" cellpadding="0" cellspacing="0" width="98%" bgcolor="#FFFFFF">';

		body += '<tr height="25" bgcolor="#EFEFEF">';
		body += '   <td>';
		body += '       &nbsp;&nbsp;<b>' + editor_lang[78];
		body += '   </td>';
		body += '   <td align="right">';
		body += '       <img src="' + _editor_url + '/img/close.gif" border=0 align="absmiddle" oncliCk="Layerhide(\'zoomin\');">&nbsp;&nbsp;';
		body += '   </td>';
		body += '</tr>';
		body += '<tr><td bgcolor="#EFEFEF" height=1 colspan="2"></td></tr>';

		for(var i=0; i<zoom_per.length; i++){
			body += '<tr onmouseover="this.style.backgroundColor=\'#B6BCD2\';" style="BACKGROUND-COLOR: WHITE" onmouseout="this.style.backgroundColor=\'WHITE\';">';
			body += '   <td height="20" align="center" colspan="2">';
			body += '       &nbsp;&nbsp;<a style="cursor:hand;" onclick="zoom(' + zoom_per[i] + ')">' + zoom_per[i] + '%</a>';
			body += '   </td>';
			body += '</tr>';
			body += '<tr><td bgcolor="#EFEFEF" height=1 colspan="2"></td></tr>';
		} // end for

		body += '	<tr><td bgcolor="#CCCCCC" height=1 colspan="2"></td></tr>';
		body += '	</table>';
		body += '   </td>';
		body += '</tr>';
		body += '</table>';

	document.getElementById('zoomin').innerHTML = body;

} // end func


// modal
function createHTML(val,key){
	var width,height,filename;

	switch(key){
		case 1: // Table
			width = 352; height = !os ? 490 : 457; filename = 'table.php';
		break;

		case 2: // charac
			width = 304; height = !os ? 415 : 375; filename = 'characteristic.php';
		break;

		case 3: // icon
			width = 232; height = !os ? 275 : 248; filename = 'emotions.php';
		break;

		case 4: // Fontname
			width = 250; height = !os ? 335 : 302; filename = 'fontname.php';
		break;

		case 5: // color
			width = 260; height = !os ? 305 : 278; filename = 'color.php';
		break;

		case 6: // Back Color
			width = 260; height = !os ? 305 : 278; filename = 'color.php';
		break;

		case 7: // Font Size
			width = 350; height = !os ? 280 : 249; filename = 'fontsize.php';
		break;

		case 8: // Link
			width = 360; height = !os ? 200 : 173; filename = 'hyperLink.php';
		break;

		case 9: // Image Uploaded
			width = 400; height = !os ? 460 : 434; filename = 'upfile.php';
		break;

		case 10: // Media Uploaded
			width = 400; height = !os ? 460 : 434; filename = 'media.php';
		break;

		case 11: // Html Editor
			width = 550; height = !os ? 520 : 485; filename = 'html_edit.php';
		break;

		case 12: // preview
			width = 640; height = 580; filename = 'preview.php';
		break;
	}

	if(!os){
		if((key == 5) || (key == 6)){
			val = (key == 6) ? 'backcolor' : 'forecolor';
		}
		arguments.charsets = document.getElementById('editor_stom').value;
		arguments.arg = val;
		arguments.url = _editor_url;
		if((key == 11) || (key == 12)) arguments.html = window.SubmitHTML();
		vrValue = window.showModalDialog(_editor_url+'/'+filename+'?lang='+arguments.charsets,arguments,"help=no;dialogWidth="+width+"px;dialogHeight:"+height+"px; center:yes; status:no; resizable:no;");

		// return Value Key
		if(vrValue){
			if(vrValue.mode == 'makeTag'){
				var tmp_vrValue = vrValue.val;
				if(tmp_vrValue) window.HTMLPaste(tmp_vrValue);
			}
			else if(vrValue.mode == 'InsertData'){
				gmFrame.document.body.innerHTML = vrValue.html;
			}
			else{
				window.htmltrue(vrValue.mode,vrValue.val,false);
			}
		}
	}
	else{
		document.getElementById('editor_stom').value = document.getElementById('editor_stom').value + '#' + val;
		obj = window.open(_editor_url+'/'+filename,'_editor_tb','staus=no, width='+width+', height='+height+',scrollbars=no,toolbar=no,menubar=no');
	}
}


// Contents
function Edit_Modify(_contentName,_contentValue){
	return eval("document." + _contentName + "." + _contentValue + ".value");
}

// Submit's
function SubmitHTML(){
	var tmp = !os ? gmFrame.document.body.innerHTML : gmFrame.document.documentElement.innerHTML;
	var tmp_content = '';
	tmp_content = tmp.replace(/<(\/?)br>/gi,"");
	tmp_content = tmp_content.replace(/<br>/gi,"");
	tmp_content = tmp_content.replace(/ /gi,"");
	tmp_content = tmp_content.replace(/&nbsp;/gi,"");
	tmp_content = tmp_content.replace(/<head>(.*?)<(\/?)head>/gi,"");
	tmp_content = tmp_content.replace(/<style>(.*?)<(\/?)style>/gi,"");
	tmp_content = tmp_content.replace(/<(\/?)body>/gi,"");

	return (tmp_content==0) ? '' : tmp;
}

// HTML
function HTMLPaste(key){
	gmFrame.focus();

	// IE
	if(!os){
		past = gmFrame.document.selection.createRange();
		past.pasteHTML(key);
	}

	// Net
	else{
		gmFrame.document.execCommand("inserthtml",false,key);
	}

} // end if

function htmltrue(key,val,mode){
	gmFrame.focus();
	gmFrame.document.execCommand(key,(mode ? mode : false),(val ? val : null));
	return false;
}


gmFrame.focus();
gmFrame.document.open("text/html");
gmFrame.document.writeln(str);
gmFrame.document.writeln(Edit_Modify(_contentName,_contentValue));
gmFrame.document.close();

gmFrame.document.designMode = "On";