<? if (!defined('RGBOARD_VERSION')) exit; ?>
<? 
if($subtitle == "11"){
  $navi_b = "��������";
  $navi_s = "��������";

}elseif($subtitle == "21"){
  $navi_b = "�ִϾ��";
  $navi_s = "�ִϾ��";
}elseif($subtitle == "12"){
  $navi_b = "����ķ��";
  $navi_s = "����ķ��";
}elseif($subtitle == "22"){
  $navi_b = "�ִϾ�ķ��";
  $navi_s = "�ִϾ�ķ��";
}elseif($subtitle == "31"){
  $navi_b = "��������";
  $navi_s = "��������";
}elseif($bbs_code == "ju_notice"){
  $navi_b = "Ŀ�´�Ƽ";
  $navi_s = "��������";
  $subtitle = "_notice" ;
  $left ="../junior/inc/left_4.php";
    $PageNum = 4;
    $subPageNum  = 1;	

}elseif($bbs_code == "ju_qna"){
  $navi_b = "Ŀ�´�Ƽ";
  $navi_s = " Q&A";
  $subtitle = "_qna" ;
  $left ="../junior/inc/left_4.php";
    $PageNum = 4;
    $subPageNum  = 2;	

}elseif($bbs_code == "ju_faq"){
  $navi_b = "Ŀ�´�Ƽ";
  $navi_s = " FAQ";
  $subtitle = "_faq" ;
  $left ="../junior/inc/left_4.php";
    $PageNum = 4;
    $subPageNum  = 3;	
}elseif($bbs_code == "ju_photo"){
  $navi_b = "Ŀ�´�Ƽ";
  $navi_s = "���䰶����";
  $subtitle = "_photo" ;
  $left ="../junior/inc/left_4.php";
    $PageNum = 4;
    $subPageNum  = 8;	
}elseif($bbs_code == "ju_story"){
  $navi_b = "Ŀ�´�Ƽ";
  $navi_s = "�����ı�";

  $subtitle = "_yensu" ;
  $left ="../junior/inc/left_4.php";
    $PageNum = 4;
    $subPageNum  = 5;	

}elseif($bbs_code == "ju_talk"){
  $navi_b = "Ŀ�´�Ƽ";
  $navi_s = "�������Ǽҵ�";
  $subtitle = "_talk" ;
  $left ="../junior/inc/left_4.php";
     $PageNum = 4;
    $subPageNum  = 4;	

}elseif($bbs_code == "ju_event"){
  $navi_b = "Ŀ�´�Ƽ";
  $navi_s = "�̺�Ʈ";
  $subtitle = "_event" ;
  $left ="../junior/inc/left_4.php";
    $PageNum = 4;
    $subPageNum  = 6;	
}elseif($bbs_code == "ju_colum"){
  $navi_b = "Ŀ�´�Ƽ";
  $navi_s = "������ Į��";
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