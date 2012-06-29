<?
	include_once("../include/lib.php");
	$rs->clear();
	$rs->set_table($_table['ju_school']);
	$rs->add_where("num=$num");
	$rs->add_where("section=$section");
	$rs->select();
	$data=$rs->fetch();	
?>
<html>
<head>
<title>필리핀 전문 포털 필사과</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link href="<?=$_url['css']?>style.css" rel="stylesheet" type="text/css">
</head>
<body bottommargin="0" topmargin="10" leftmargin="0" rightmargin="0">
<table border="0" cellpadding="0" cellspacing="0" width="690" align="center">
    <tr>
	<td bgcolor="#BECCDD" height="1" colspan="2"></td>
  </tr> 
 <tr >
	<td bgcolor="#FFFFFF"><?if($data[school_file1_name]){?>
	  <img src="../data/ju_school/<?=$num?>/<?=$data[school_file1_name]?>" width="180" height="65" align="absmiddle">
    <?}?></td>
	<td width="510"><?=$data['title']?></td>
  </tr>
  <tr>
	<td  height="15" colspan="2"></td>
  </tr>  

  <tr>
	<td bgcolor="#BECCDD" height="1" colspan="2"></td>
  </tr>
<?if($data[national] == 3){?>
  <tr>
	<td colspan="2" style="padding:15 0 10 5"><strong>1.학교개요</strong></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="2"></td>
  </tr>
  
   <tr>
     <td colspan="2" bgcolor="#FFFFFF" "><table width="690" border="0" cellspacing="0" cellpadding="0">
       <tr>
         <td width="410"><table width="410" border="0" align="center" cellpadding="0" cellspacing="0">
           <tr>
             <td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>지역</strong></td>
             <td width="270" bgcolor="#FFFFFF"><?=$ss_list[$data['area']]?></td>
           </tr>
           <tr>
             <td bgcolor="#BECCDD" height="1" colspan="2"></td>
           </tr>
           <tr>
             <td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>연수구분</strong></td>
             <td bgcolor="#FFFFFF"><?=$_const[camp_type2][$data[section]]?></td>
           </tr>
           <tr>
             <td bgcolor="#BECCDD" height="1" colspan="2"></td>
           </tr>
           <tr>
             <td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>홈페이지</strong></td>
             <td>http://
               <?=$data['homepage']?></td>
           </tr>
           <tr>
             <td bgcolor="#BECCDD" height="1" colspan="2"></td>
           </tr>
           <tr>
             <td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>지역/장소</strong></td>
             <td><?=$data['location']?></td>
           </tr>
           <tr>
             <td bgcolor="#BECCDD" height="1" colspan="2"></td>
           </tr>
           <tr>
             <td width="140" bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>총인원</strong></td>
             <td><?=$data['class']?></td>
           </tr>
           <tr>
             <td bgcolor="#BECCDD" height="1" colspan="2"></td>
           </tr>
           <tr>
             <td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>부대시설</strong></td>
             <td><?=$data['etc_facility']?></td>
           </tr>
           <tr>
             <td bgcolor="#BECCDD" height="1" colspan="2"></td>
           </tr>
           <tr>
             <td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>기숙사형태</strong></td>
             <td><?=$data['dorm_type']?></td>
           </tr>
           <tr>
             <td bgcolor="#BECCDD" height="1" colspan="2"></td>
           </tr>
           <tr>
             <td width="140" bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>연수일정</strong></td>
             <td><?=$data['gigan']?></td>
           </tr>
           <tr>
             <td bgcolor="#BECCDD" height="1" colspan="2"></td>
           </tr>
           <tr>
             <td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>수업구성</strong></td>
             <td><?=$data['class_time']?></td>
           </tr>
           <tr>
             <td bgcolor="#BECCDD" height="1" colspan="2"></td>
           </tr>
           <tr>
             <td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>대상연령</strong></td>
             <td><?=$data['age']?></td>
           </tr>
         </table></td>
         <td width="30">&nbsp;</td>
         <td width="250" align="center"><object type='application/x-shockwave-flash' width='250px' height='220px' align='middle' classid='clsid:d27cdb6e-ae6d-11cf-96b8-444553540000' codebase='http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0'><param name='movie' value='<?=$data[movielink]?>' /><param name='allowScriptAccess' value='always' /><param name='allowFullScreen' value='true' /><param name='bgcolor' value='#000000' /><embed src='http://flvs.daum.net/flvPlayer.swf?vid=jjzebGUrbAs$' width='250px' height='220px' allowScriptAccess='always' type='application/x-shockwave-flash' allowFullScreen='true' bgcolor='#000000' ></embed></object></td>
       </tr>
     </table></td>
   </tr>
    
  <tr>
	<td bgcolor="#BECCDD" height="1" colspan="2"></td>
  </tr>
  <tr>
	<td colspan="2" style="padding:15 0 10 5"><strong>2.간략소개/TIP</strong></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="2"></td>
  </tr>
  <tr>
	<td colspan="2"><?=$data['info']?></td>
	</tr>
  <tr>
	<td bgcolor="#BECCDD" height="1" colspan="2"></td>
 </tr>

  <tr>
	<td colspan="2" style="padding:15 0 10 5"><strong>3.수업내용 및 상세프로그램</strong></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="2"></td>
  </tr>  
  <tr>
	<td colspan="2"><?=$data['program']?></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="2"></td>
  </tr>	
  <tr>
	<td colspan="2" style="padding:15 0 10 5"><strong>4.연수비용 상세안내</strong></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="2"></td>
  </tr>
  <tr>
	<td colspan="2"><?=$data['cost_info']?></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="2"></td>
  </tr>
<?}else{?>
<tr>
	<td colspan="2" style="padding:15 0 10 5"><strong>모집요강</strong></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="2"></td>
  </tr>
  <tr>
	<td colspan="2"><?=$data['info']?></td>
	</tr>
  <tr>
	<td bgcolor="#BECCDD" height="1" colspan="2"></td>
  </tr>
  <tr>
	<td colspan="2" style="padding:15 0 10 5"><strong>1.정규수업</strong></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="2"></td>
  </tr>
  <tr>
	<td colspan="2"><?=$data['program']?></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="1" colspan="2"></td>
  </tr>
  <tr>
	<td colspan="2" style="padding:15 0 10 5"><strong>2.방과후 프로그램</strong></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="2"></td>
  </tr>
  <tr>
	<td colspan="2"><?=$data['after_info']?></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="2"></td>
  </tr>
  <tr>
	<td colspan="2" style="padding:15 0 10 5"><strong>3.주말 프로그램</strong></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="2"></td>
  </tr>  
  <tr>
	<td colspan="2"><?=$data['wk_pro']?></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="2"></td>
  </tr>	
</table>
</td>
</tr>
  <tr>
	<td colspan="4" style="padding:15 0 10 5"><strong>4.전체일정안내</strong></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="4"></td>
  </tr>
  <tr>
	<td colspan="4"><?=$data['schedule']?></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="4"></td>
  </tr>
</table>
</td>
</tr>
  <tr>
	<td colspan="4" style="padding:15 0 10 5"><strong>5.캠프 학교 안내</strong></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="4"></td>
  </tr>
  <tr>
	<td colspan="4"><?=$data['camp_school']?></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="4"></td>
  </tr>
</table>
</td>
</tr>
  <tr>
	<td colspan="4" style="padding:15 0 10 5"><strong>6.홈스테이 생활정보</strong></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="4"></td>
  </tr>
  <tr>
	<td colspan="4"><?=$data['homestay']?></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="4"></td>
  </tr>
</table>   
</td>
</tr>
  <tr>
	<td colspan="4" style="padding:15 0 10 5"><strong>7.뉴질랜드-오클랜드 정보</strong></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="4"></td>
  </tr>
  <tr>
	<td colspan="4"><?=$data['national_info']?></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="4"></td>
  </tr>
</table>
</td>
</tr>
  <tr>
	<td colspan="4" style="padding:15 0 10 5"><strong>8.캠프 프로그램 Q & A</strong></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="4"></td>
  </tr>
 <tr>
	<td colspan="4"><?=$data['camp_qna']?></td>
</tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="4"></td>
  </tr>
</table>
</td>
</tr>
<?}?>
   <tr>
	<td colspan="4" >
      <table width="660" border="0" cellpadding="0" cellspacing="0" >
		 <tr>
		   <td width="160"><img src="../data/ju_school/<?=$num?>/<?=$data[school_file2_name]?>" width="160" height="120"></td>
		   <td>&nbsp;</td>
		   <td width="160"><img src="../data/ju_school/<?=$num?>/<?=$data[school_file3_name]?>" width="160" height="120"></td>
		   <td>&nbsp;</td>
		   <td width="160"><img src="../data/ju_school/<?=$num?>/<?=$data[school_file4_name]?>" width="160" height="120"></td>
		   <td>&nbsp;</td>
		   <td width="160"><img src="../data/ju_school/<?=$num?>/<?=$data[school_file5_name]?>" width="160" height="120"></td>
	    </tr> 
	       <tr>
		     <td colspan="7">&nbsp;</td>
		   </tr>
		   <tr>
		    <td width="160"><img src="../data/ju_school/<?=$num?>/<?=$data[school_file6_name]?>" width="160" height="120"></td>
		    <td>&nbsp;</td>
		    <td width="160"><img src="../data/ju_school/<?=$num?>/<?=$data[school_file7_name]?>" width="160" height="120"></td>
		    <td>&nbsp;</td>
		    <td width="160"><img src="../data/ju_school/<?=$num?>/<?=$data[school_file8_name]?>" width="160" height="120"></td>
		    <td>&nbsp;</td>
		    <td width="160"><img src="../data/ju_school/<?=$num?>/<?=$data[school_file9_name]?>" width="160" height="120"></td>
		  </tr> 
      </table>
	</td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="1" colspan="4"></td>
  </tr>
</table>
</body>
</html>
<? include($_path['counter']."counter.php"); ?>