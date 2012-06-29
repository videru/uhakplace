////////////////////////////////////////////////////////////////////////
//
//                            CHEditor 2.0
//
//       Author: ³ªÃ¢È£
//       EMail:  chna@chcode.com
//       Homepage: http://www.chcode.com
//
//       Copyright (C) 1997-2004, CHCODE. All rights reserved.
//
////////////////////////////////////////////////////////////////////////

function drawColor(el)
{
    var colour = [
    "FFFFCC","FFCC66","FF9900","FFCC99","FF6633","FFCCCC","CC9999","FF6699","FF99CC","FF66CC","FFCCFF","CC99CC","CC66FF","CC99FF","9966CC","CCCCFF","9999CC","3333FF","6699FF","0066FF","99CCFF","66CCFF","99CCCC","CCFFFF","99FFCC","66CC99","66FF99","99FF99","CCFFCC","33FF33","66FF00","CCFF99","99FF00","CCFF66","CCCC66","FFFFFF",
    "FFFF99","FFCC00","FF9933","FF9966","CC3300","FF9999","CC6666","FF3366","FF3399","FF00CC","FF99FF","CC66CC","CC33FF","9933CC","9966FF","9999FF","6666FF","3300FF","3366FF","0066CC","3399FF","33CCFF","66CCCC","99FFFF","66FFCC","33CC99","33FF99","66FF66","99CC99","00FF33","66FF33","99FF66","99FF33","CCFF00","CCCC33","CCCCCC",
    "FFFF66","FFCC33","CC9966","FF6600","FF3300","FF6666","CC3333","FF0066","FF0099","FF33CC","FF66FF","CC00CC","CC00FF","9933FF","6600CC","6633FF","6666CC","3300CC","0000FF","3366CC","0099FF","00CCFF","339999","66FFFF","33FFCC","00CC99","00FF99","33FF66","66CC66","00FF00","33FF00","66CC00","99CC66","CCFF33","999966","999999",
    "FFFF33","CC9900","CC6600","CC6633","FF0000","FF3333","993333","CC3366","CC0066","CC6699","FF33FF","CC33CC","9900CC","9900FF","6633CC","6600FF","666699","3333CC","0000CC","0033FF","6699CC","3399CC","669999","33FFFF","00FFCC","339966","33CC66","00FF66","669966","00CC00","33CC00","66CC33","99CC00","CCCC99","999933","666666",
    "FFFF00","CC9933","996633","993300","CC0000","FF0033","990033","996666","993366","CC0099","FF00FF","990099","996699","660099","663399","330099","333399","000099","0033CC","003399","336699","0099CC","006666","00FFFF","33CCCC","009966","00CC66","339933","336633","33CC33","339900","669933","99CC33","666633","999900","333333",
    "CCCC00","996600","663300","660000","990000","CC0033","330000","663333","660033","990066","CC3399","993399","660066","663366","330033","330066","333366","000066","000033","003366","006699","003333","336666","00CCCC","009999","006633","009933","006600","003300","00CC33","009900","336600","669900","333300","666600","000000"];

    var htmloutput = ["<table border=0 cellpadding=0 cellspacing=0>" +
                      "<tr><td><table border='0' cellspacing='1' cellpadding='0' align='center' bgcolor=#000000>"]
    var k = 0;

    for(var i = 0; i < 6; i++) {
        htmloutput[htmloutput.length] = "<TR>";
        for(var j = 0; j < 36; j++) {
            htmloutput[htmloutput.length] = "<TD bgcolor=#"+colour[k]+" id="+el+" name="+el+" width=9 height=9 nowrap align='center' onClick=\"getColor(this, this.id)\"></TD>";
            k++;
        }
        htmloutput[htmloutput.length] = "</TR>";
    }
    htmloutput[htmloutput.length] = "</table></td></tr></table>";
    return htmloutput.join("\n");
}

function getColor(el, target)
{
    var c = el.bgColor;
    var e = document.getElementById("id"+target);
    e.value = c;
    e.style.backgroundColor = c;
}
