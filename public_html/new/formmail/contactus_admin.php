<?
###############################
#Coded By. »þÇÁ¶óÀÌÇÃ         #
#Coded. 2002/9/24             #
#Update. 2005/6/30            #
###############################

include "config.php";

if(empty($inputpass)){
	echo "
<html>

<head>
<title>C o n t a c t  U s</title>
<meta name=generator content=Namo WebEditor v6.0>
<style>
<!--
a:link { text-decoration:none; }
a:visited { text-decoration:none; }
a:active { text-decoration:none; }
a:hover { text-decoration:none; }
-->
</style>
</head>

<body bgcolor=white text=black link=blue vlink=purple alink=red leftmargin=0 marginwidth=0 topmargin=0 marginheight=0>
<form name=admin method=post action=contactus_admin.php enctype=Text/html>
    <table border=1 cellspacing=1 width=339 bgcolor=#F2F2F9 bordercolordark=#CCCCCC bordercolorlight=#CCCCCC style=border-width:1pt; border-color:blue; border-style:dotted; bordercolor=#CCCCCC align=center>
        <tr>
            <td width=331 colspan=2 bordercolordark=black bordercolorlight=black bgcolor=#33CCFF>

                <p align=center><b><span style=font-size:12pt;><font face=µ¸¿ò color=blue>A</font><font face=µ¸¿ò>dmin</font></span></b></p>
        </td>
    </tr>
        <tr>
            <td width=101 bgcolor=#CCCCCC bordercolordark=#CCCCCC bordercolorlight=#CCCCCC>

                <p align=center><span style=font-size:10pt;><font face=µ¸¿ò color=black>°ü¸®ÀÚ ºñ¹Ð¹øÈ£</font></span></p>
        </td>
            <td width=225 bordercolordark=#CCCCCC bordercolorlight=#CCCCCC>

                <p><font color=black><input type=password onMouseOver=this.style.background='#fdf6f6' onMouseOut=this.style.background='#f7f7fd' size=30 name=inputpass style=color:blue; background-color:rgb(247,247,255); border-width:1; border-color:blue; border-style:solid; maxlength=50>
</font>           </tr>
            <tr>
                <td width=331 colspan=2 bordercolordark=#CCCCCC bordercolorlight=#CCCCCC>
            
            
                    <p align=center> 
            <font color=black><input type=submit value=    ÀúÀå     style=font-size:9pt; color:blue; background-color:rgb(225,226,252); border-width:1; border-color:blue; border-style:solid; height:18; name=send>&nbsp;
	    <input type=reset value=´Ù½Ã ¾²±â style=font-size:9pt; color:blue; background-color:rgb(231,227,255); border-width:1; border-color:blue; border-style:solid; height:18; name=reset>
</font>            </tr>
</table>
</form>
</body>

</html>
";
	exit;
}
if(isset($inputpass)){
	if($inputpass == $password){
		echo "
<html>

<head>
<title>C o n t a c t  U s</title>
<meta name=generator content=Namo WebEditor v6.0>
<style>
<!--
a:link { text-decoration:none; }
a:visited { text-decoration:none; }
a:active { text-decoration:none; }
a:hover { text-decoration:none; }
-->
</style>
</head>

<body bgcolor=white text=black link=blue vlink=purple alink=red leftmargin=0 marginwidth=0 topmargin=0 marginheight=0>
<table border=1 cellspacing=1 width=339 bgcolor=#F2F2F9 bordercolordark=#CCCCCC bordercolorlight=#CCCCCC style=border-width:1pt; border-color:blue; border-style:dotted; bordercolor=#CCCCCC align=center>
    <tr>
        <td width=331 colspan=2 bordercolordark=black bordercolorlight=black bgcolor=#33CCFF>
                <p align=center><b><span style=font-size:12pt;><font face=µ¸¿ò color=blue>A</font><font face=µ¸¿ò>dmin</font></span></b></p>
        </td>
    </tr>
    <tr>
        <td width=101 bgcolor=#CCCCCC bordercolordark=#CCCCCC bordercolorlight=#CCCCCC>
                <p align=center><a href=contactus_view.php><font face=µ¸¿ò color=blue><span style=font-size:10pt;>¸®½ºÆ®º¸±â</span></font></a></p>
        </td>
        <td width=225 bordercolordark=#CCCCCC bordercolorlight=#CCCCCC>
                <p><font face=µ¸¿ò><span style=font-size:10pt;>&nbsp;&lt;- Å¬¸¯</span></font><font face=µ¸¿ò><span style=font-size:10pt;></span></font></tr>
        <tr>
            <td width=101 bgcolor=#CCCCCC bordercolordark=#CCCCCC bordercolorlight=#CCCCCC>
                <p align=center><a href=contactus_view.php?action=reset><font face=µ¸¿ò color=blue><span style=font-size:10pt;>¸®</span></font><font face=µ¸¿ò color=blue><span style=font-size:10pt; text-decoration:none;>½ºÆ®</span></font><font face=µ¸¿ò color=blue><span style=font-size:10pt; text-decoration:none;>¸®¼Â</a></span></font></p>
        </td>
            <td width=225 bordercolordark=#CCCCCC bordercolorlight=#CCCCCC>
                <p><font face=µ¸¿ò><span style=font-size:10pt;>&nbsp;&lt;- Å¬¸¯</span></font><font face=µ¸¿ò><span style=font-size:10pt;></span></font></tr>
            <tr>
                <td width=331 colspan=2 bordercolordark=#CCCCCC bordercolorlight=#CCCCCC>
            
            
            
            
                    <p align=center> 
                        </tr>
</table>
</body>

</html>
	";
	}else{
		error_cls('ºñ¹Ð¹øÈ£°¡ ¸ÂÁö ¾Ê½À´Ï´Ù');
		exit;
	}
}


?>