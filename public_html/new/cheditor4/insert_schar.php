<?php
include_once("_common.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=<?=$g4[charset]?>" />
<link rel="stylesheet" type="text/css" href="dialog.css" />
<script type="text/javascript">
//<![CDATA[
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
  var strtab = ["<table border='0' cellspacing='1' cellpadding='0' align='center'>"]
  var k = 0;
  for(i=0; i < w; i++) {
    strtab[strtab.length] = "<tr>";
    for(var j = 0; j < h; j++) {
      strtab[strtab.length] = "<td class='handCursor' style='border:1px solid #999;background-color:#fff;width:12px;height:12px;text-align:center' onClick='getchar(this)' onMouseOver='hover(this,true)' onMouseOut='hover(this,false)'>"+(chars[k]||'')+"</td>";
      k++;
    }
    strtab[strtab.length]="</tr>";
  }
  strtab[strtab.length] = "</table>";
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
var oEditor = parent.chutil.oname;
function getchar(obj) {
  if (!obj.innerHTML) return;
  var c = obj.innerHTML || "";

  eval('parent.'+oEditor).doCmdPaste(c);
  popupClose();
}

function popupClose() {
    eval('parent.'+oEditor).popupWinClose();
}
//]]>
</script>
<title>문자 선택</title>
</head>
<body scroll="no">
<center>
<script type="text/javascript">document.write(tab(7,32))</script>
<div class="spacer"></div>
<button onclick="popupClose()" class="button">닫기</button>
</center>
</body>
</html>
