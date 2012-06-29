<? if (!defined('RGBOARD_VERSION')) exit; ?>
<? 
if($subtitle == "11"){
  $navi_b = "가족연수";
  $navi_s = "가족연수";

}elseif($subtitle == "21"){
  $navi_b = "주니어연수";
  $navi_s = "주니어연수";
}elseif($subtitle == "12"){
  $navi_b = "가족캠프";
  $navi_s = "가족캠프";
}elseif($subtitle == "22"){
  $navi_b = "주니어캠프";
  $navi_s = "주니어캠프";
}elseif($subtitle == "31"){
  $navi_b = "조기유학";
  $navi_s = "조기유학";
}elseif($bbs_code == "ju_notice"){
  $navi_b = "커뮤니티";
  $navi_s = "공지사항";
  $subtitle = "_notice" ;
  $left ="../junior/inc/left_4.php";
    $PageNum = 4;
    $subPageNum  = 1;	

}elseif($bbs_code == "ju_qna"){
  $navi_b = "커뮤니티";
  $navi_s = " Q&A";
  $subtitle = "_qna" ;
  $left ="../junior/inc/left_4.php";
    $PageNum = 4;
    $subPageNum  = 2;	

}elseif($bbs_code == "ju_faq"){
  $navi_b = "커뮤니티";
  $navi_s = " FAQ";
  $subtitle = "_faq" ;
  $left ="../junior/inc/left_4.php";
    $PageNum = 4;
    $subPageNum  = 3;	
}elseif($bbs_code == "ju_photo"){
  $navi_b = "커뮤니티";
  $navi_s = "포토갤러리";
  $subtitle = "_photo" ;
  $left ="../junior/inc/left_4.php";
    $PageNum = 4;
    $subPageNum  = 8;	
}elseif($bbs_code == "ju_story"){
  $navi_b = "커뮤니티";
  $navi_s = "연수후기";

  $subtitle = "_yensu" ;
  $left ="../junior/inc/left_4.php";
    $PageNum = 4;
    $subPageNum  = 5;	

}elseif($bbs_code == "ju_talk"){
  $navi_b = "커뮤니티";
  $navi_s = "연수에피소드";
  $subtitle = "_talk" ;
  $left ="../junior/inc/left_4.php";
     $PageNum = 4;
    $subPageNum  = 4;	

}elseif($bbs_code == "ju_event"){
  $navi_b = "커뮤니티";
  $navi_s = "이벤트";
  $subtitle = "_event" ;
  $left ="../junior/inc/left_4.php";
    $PageNum = 4;
    $subPageNum  = 6;	
}elseif($bbs_code == "ju_colum"){
  $navi_b = "커뮤니티";
  $navi_s = "전문가 칼럼";
  $subtitle = "_colum" ;
  $left ="../junior/inc/left_4.php";
    $PageNum = 4;
    $subPageNum  = 7;	
}

if($bbs_code){
$left = $left;
}else{
  $left ="../junior/inc/left_".$PageNum.".php";
}
    include_once('../junior/_header.php'); 

?>
<table width="930" border="0" cellspacing="0" cellpadding="0" align="center"  >
  <tr>
	<td height="12"></td>
	</tr>
  <tr>
	<td valign="top" background="../junior/img/sub_table_bg.gif">
       <table width="874" border="0" cellspacing="0" cellpadding="0" align="center">	
         <tr>
          <td valign="top" height="40" colspan="5"></td>
         </tr>        
		 <tr>
           <td width="165" valign="top"><?include ($left) ;?></td>
		   <td width="25" valign="top">&nbsp;</td>
		   <td width="668" valign="top"><table width="668" border="0" cellspacing="0" cellpadding="0">
             <tr>
               <td width="668"><table width="668" border="0" cellspacing="0" cellpadding="0" align="center">
                   <tr>
                     <td width="300"><img src="../junior/img/sub_title<?=$subtitle?>.gif" width="300" height="29"></td>
                     <td width="368" align="right">	             
					 <table border="0" cellspacing="0" cellpadding="0" align="right">
		           <tr>
			        <td width="73"><img src="../junior/../junior/img/sub_navi_home.gif"/></td>
					<td background="../junior/../junior/img/sub_navi_bg.gif" class="tt4" style="padding: 5px 0 0 0"><?=$navi_b?></td>
					<td width="16"><img src="../junior/../junior/img/sub_navi_arrow.gif"/></td>
					<td background="../junior/../junior/img/sub_navi_bg.gif" class="tt4" style="padding: 5px 0 0 0"><?=$navi_s?></td>
					<td width="16"><img src="../junior/../junior/img/sub_navi_right.gif"/></td>
				   </tr>
	             </table>	</td>
                   </tr>
               </table></td>
             </tr>
             <tr>
               <td height="40" valign="top"><img src="../junior/img/sub_title_line.gif" width="668" height="34"></td>
             </tr>
              <tr>
               <td>