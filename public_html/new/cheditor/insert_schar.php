<?
include("./_common.php");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$g4[charset]?>">
<link rel="stylesheet" type="text/css" href="dialog.css">
<script language="JavaScript" TYPE="text/javascript">
<!--♨
var chars = ["!","&quot;","#",'$',"%","&","'","(",")","*","+","-",".","/",
			 "0","1","2","3","4","5","6","7","8","9",":",";","&lt;","=","&gt;",
			 "?","@","A","B","C","D","E","F","G","H","I","J","K","L","M","N",
			 "O","P","Q","R","S","T","U","V","W","X","Y","Z","[","]","^","_","`",
			 "a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q",
			 "r","s","t","u","v","w","x","y","z","{","|","}","~","&euro;","&lsquo;",
			 "&rsquo;","&rsquo;","&ldquo;","&rdquo;","&ndash;","&mdash;","&iexcl;",
			 "&cent;","&pound;","&pound;","&curren;","&yen;","&brvbar;","&sect;",
			 "&uml;","&copy;","&ordf;","&laquo;","&not;","&reg;","&macr;","&deg;",
			 "&plusmn;","&sup2;","&sup3;","&acute;","&micro;","&para;","&middot;",
			 "&cedil;","&sup1;","&ordm;","&raquo;","&frac14;","&frac12;","&frac34;",
			 "&iquest;","&Agrave;","&Aacute;","&Acirc;","&Atilde;","&Auml;","&Aring;",
			 "&AElig;","&Ccedil;","&Egrave;","&Eacute;","&Ecirc;","&Euml;","&Igrave;",
			 "&Iacute;","&Icirc;","&Iuml;","&ETH;","&Ntilde;","&Ograve;","&Oacute;",
			 "&Ocirc;","&Otilde;","&Ouml;","&times;","&Oslash;","&Ugrave;","&Uacute;",
			 "&Ucirc;","&Uuml;","&Yacute;","&THORN;","&szlig;","&agrave;","&aacute;",
			 "&acirc;","&atilde;","&auml;","&aring;","&aelig;","&ccedil;","&egrave;",
			 "&eacute;","&ecirc;","&euml;","&igrave;","&iacute;","&icirc;","&iuml;",
			 "&eth;","&ntilde;","&ograve;","&oacute;","&ocirc;","&otilde;","&ouml;",
			 "&divide;","&oslash;","&ugrave;","&uacute;","&ucirc;","&uuml;","&uuml;",
			 "&yacute;","&thorn;","&yuml;","◇","◆","▲","▼","♡","♥","☎","☏",
			 "♣","♧","★","☆","☞","☜","▒","⊙","『","』","♬","♪","㉿","♀",
			 "♂","♨","▣","【","】","♨"]

function tab(w,h) {
  var strtab = ["<TABLE border='0' cellspacing='1' cellpadding='0' align='center'>"]
  var k = 0;
  for(var i = 0; i < w; i++) {
    strtab[strtab.length] = "<TR>";
    for(var j = 0; j < h; j++) {
      strtab[strtab.length] = "<TD id=demo name=demo style='border:1px solid #999;background-color:#fff;' width=16 height=16 nowrap align='center' onClick='getchar(this)' onMouseOver='hover(this,true)' onMouseOut='hover(this,false)'>"+(chars[k]||'')+"</TD>";
      k++;
    }
    strtab[strtab.length]="</TR>";
  }
  strtab[strtab.length] = "</TABLE>";
  return strtab.join("\n");
}

function hover(obj, val) {
  if (!obj.innerHTML) {
    obj.style.cursor = "default";
    return;
  }
  obj.style.backgroundColor = val ? "#5579aa" : "#fff";
  obj.style.color = val ? "#fff" : "#000";
}

function getchar(obj) {
  	if (!obj.innerHTML)
    	return;
    
	var c = obj.innerHTML || "";
// 	var obj = window.opener.chutil.myobj;
// 	eval("window.opener."+obj).insertEl(c);
 	window.returnValue = c;
 	window.close();
}
function cancel() {
  window.returnValue = null;
  window.close();
}
//-->
</SCRIPT>
<title>문자 선택</title>
</head>

<body scroll="no">
<center>
<div class="spacer">
<table border="0" cellpadding="0" cellspacing="0" width="95%">
	<tr>
		<td>
			<fieldset><legend><font style="font-size:9pt;">특수 문자 넣기&nbsp;</font></legend>
			<div style="margin:5px 0 0 0;"></div>
      <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
          <td>
            <SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">document.write(tab(7,32))</SCRIPT>
          </td>
        </tr>
      </table>
			</fieldset>
		</tr>
	</td>
</table>		
</div>
<div class="spacer"></div>
<input type="button" value="닫기" onclick="cancel()" id="button">
</center>
</body>
</html>
