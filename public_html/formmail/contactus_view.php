<?
###############################
#Coded By. 샤프라이플         #
#Coded. 2002/9/24             #
#Update. 2005/6/30            #
###############################

include "config.php";

$files = file("data/count".".txt");
$count = $files[0];
$max = $count+1;

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
        <td width=331 bordercolordark=black bordercolorlight=black bgcolor=#33CCFF>
                <p align=center><b><span style=font-size:12pt;><font face=돋움 color=blue>V</font><font face=돋움>iew</font></span></b></p>
        </td>
    </tr>
	";

if($action == "delete"){
	unlink ("data/$number".".txt");
	echo "
	<tr>
            <td width=331 bgcolor=#AEDEFF bordercolordark=#CCCCCC bordercolorlight=#CCCCCC>

                <p>                           <p align=center style=line-height:100%; margin-top:0; margin-bottom:0;><font face=돋움><span style=font-size:10pt;>삭제완료</span></font>
					<p align=center style=line-height:100%; margin-top:0; margin-bottom:0;><font face=돋움><span style=font-size:10pt;><a href=contactus_view.php>리스트보기</a></span></font></td>
</tr>
		";
	exit;
}

if($action == "reset"){
	for($i=0; $i<$max; $i++){
		if(file_exists("data/$i".".txt")){
			unlink ("data/$i".".txt");
		}
	}
	$fp = fopen("data/count.txt", "w"); #데이터 생성
	fwrite($fp, "0");
	fclose($fp);
	echo "
	<tr>
            <td width=331 bgcolor=#AEDEFF bordercolordark=#CCCCCC bordercolorlight=#CCCCCC>

                <p>                           <p align=center style=line-height:100%; margin-top:0; margin-bottom:0;><font face=돋움><span style=font-size:10pt;>리셋완료</span></font> 
					<p align=center style=line-height:100%; margin-top:0; margin-bottom:0;><font face=돋움><span style=font-size:10pt;><a href=contactus_view.php>리스트보기</a></span></font></td>
</tr>
		";
}

if(empty($action)){
	for($i=$count; $i>0; $i--){
		if(file_exists("data/$i".".txt")){
			$fp=fopen("data/$i".".txt","r");
			$text = fread($fp,filesize("data/$i".".txt"));
			$text = nl2br("$text");
			echo "
	  <tr>
            <td width=331 bgcolor=#AEDEFF bordercolordark=#CCCCCC bordercolorlight=#CCCCCC>

                <p>                           <p style=line-height:100%; margin-top:0; margin-bottom:0;><font face=돋움><span style=font-size:10pt;><font color=blue>[$i]</font><br>$text</span></font>                <p style=line-height:100%; margin-top:0; margin-bottom:0; align=right><font face=돋움><span style=font-size:10pt;><a href=contactus_view.php?action=delete&number=$i>삭제</a></span></font>        </td>
</tr>
			";
		}else{
			echo "
		<tr>
            <td width=331 bgcolor=#AEDEFF bordercolordark=#CCCCCC bordercolorlight=#CCCCCC>

                <p>                           <p style=line-height:100%; margin-top:0; margin-bottom:0;><font face=돋움><span style=font-size:10pt;>삭제되었습니다</span></font>                <p style=line-height:100%; margin-top:0; margin-bottom:0; align=right><font face=돋움><span style=font-size:10pt;>삭제</span></font>        </td>
</tr>
			";
		}
	}
}
echo "</table>";


?>