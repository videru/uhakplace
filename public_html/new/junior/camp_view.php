<?
	include_once("../include/lib.php");
	$rs->clear();
	$rs->set_table($_table['camp']);
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
	<td bgcolor="#BECCDD" height="1" colspan="4"></td>
  </tr> 
 <tr >
	<td width="130" bgcolor="#FFFFFF" class="a_text_title"><?if($data[school_file1_name]){?>
	  <img src="../data/camp/<?=$num?>/<?=$data[school_file1_name]?>" width="180" height="65" align="absmiddle">
    <?}?></td>
	<td width="470" colspan="3"><?=$data['s_title']?>
(
  <?=$data['title']?>
)</td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="1" colspan="4"></td>
  </tr>
  <tr>
	<td height="15" colspan="4"></td>
  </tr>
  <tr>
	<td colspan="4" style="padding:15 0 10 5"><strong>1.캠프개요</strong></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="4"></td>
  </tr>
   <tr>
	<td colspan="4" style="padding:15 0 10 5"><table width="690%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="58%"><table width="400" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>지역</strong></td>
            <td width="260" bgcolor="#FFFFFF"><?=$ss_list[$data['area']]?></td>
          </tr>
          <tr>
            <td bgcolor="#BECCDD" height="1" colspan="2"></td>
          </tr>
          <tr>
            <td width="140" bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>캠프구분</strong></td>
            <td bgcolor="#FFFFFF"><?=$_const[camp_type][$data[section]]?></td>
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
            <td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>지역/리조트위치</strong></td>
            <td><?=$data['location']?></td>
          </tr>
          <tr>
            <td bgcolor="#BECCDD" height="1" colspan="2"></td>
          </tr>
          <tr>
            <td width="140" bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>영어외수업</strong></td>
            <td><?=$data['eng_etc']?></td>
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
            <td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>주말액티비티</strong></td>
            <td><?=$data['activity']?></td>
          </tr>
        </table></td>
        <td width="6%">&nbsp;</td>
        <td width="36%" align="center"><object type='application/x-shockwave-flash' width='250px' height='220px' align='middle' classid='clsid:d27cdb6e-ae6d-11cf-96b8-444553540000' codebase='http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0'><param name='movie' value='<?=$data[movielink]?>' /><param name='allowScriptAccess' value='always' /><param name='allowFullScreen' value='true' /><param name='bgcolor' value='#000000' /><embed src='<?=$data[movielink]?>' width='250px' height='220px' allowScriptAccess='always' type='application/x-shockwave-flash' allowFullScreen='true' bgcolor='#000000' ></embed></object></td>
      </tr>
    </table></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="1" colspan="4"></td>
  </tr>	
  <tr>
	<td colspan="4" style="padding:15 0 10 5"><strong>2.캠프요강</strong> </td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="4"></td>
  </tr>
  <tr>
	<td colspan="4"><?=$data['info']?></td>
	</tr>
  <tr>
	<td bgcolor="#BECCDD" height="1" colspan="4"></td>
  </tr>
  <tr>
	<td colspan="4" style="padding:15 0 10 5"><strong>3.간락특징/TIP</strong></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="4"></td>
  </tr>
  <tr>
	<td colspan="4"><?=$data['special']?></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="4"></td>
  </tr>
  <tr>
	<td colspan="4" style="padding:15 0 10 5"><strong>4.수업내용 및 상세프로그램</strong></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="4"></td>
  </tr>  
  <tr>
	<td colspan="4"><?=$data['program']?></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="4"></td>
  </tr>	
  <tr>
	<td colspan="4" style="padding:15 0 10 5"><strong>5.Activity소개</strong> </td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="4"></td>
  </tr>
  <tr>
	<td colspan="4"><?=$data['activity_info']?></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="4"></td>
  <tr>
	<td colspan="4" style="padding:15 0 10 5"><strong>6.연수비용 상세안내</strong></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="4"></td>
  </tr>
  <tr>
	<td colspan="4"><?=$data['cost_info']?></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="4"></td>
  </tr>
  <tr>
	<td colspan="4" style="padding:15 0 10 5"><strong>7.이미지</strong></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="4"></td>
  </tr>
 <tr>
	<td colspan="4" >
      <table width="690" border="0" cellpadding="0" cellspacing="0" align="center">
		   <?if($data[school_file1_name]){?>		 
		 <tr>
		   <td width="167"><img src="../data/camp/<?=$num?>/<?=$data[school_file2_name]?>" width="167" height="120"></td>
		   <td>&nbsp;</td>
		   <td width="167"><img src="../data/camp/<?=$num?>/<?=$data[school_file3_name]?>" width="167" height="120"></td>
		   <td>&nbsp;</td>
		   <td width="167"><img src="../data/camp/<?=$num?>/<?=$data[school_file4_name]?>" width="167" height="120"></td>
		   <td>&nbsp;</td>
		   <td width="167"><img src="../data/camp/<?=$num?>/<?=$data[school_file5_name]?>" width="167" height="120"></td>
		   </tr> 
		  <?}?>
		   <?if($data[school_file6_name]){?>
	       <tr>
		     <td colspan="7">&nbsp;</td>
		   </tr>
		   <tr>
		    <td width="167"><img src="../data/camp/<?=$num?>/<?=$data[school_file6_name]?>" width="167" height="120"></td>
		    <td>&nbsp;</td>
		    <td width="167"><img src="../data/camp/<?=$num?>/<?=$data[school_file7_name]?>" width="167" height="120"></td>
		    <td>&nbsp;</td>
		    <td width="167"><img src="../data/camp/<?=$num?>/<?=$data[school_file8_name]?>" width="167" height="120"></td>
		    <td>&nbsp;</td>
		    <td width="167"><img src="../data/camp/<?=$num?>/<?=$data[school_file9_name]?>" width="167" height="120"></td>
		  </tr> 
		  <?}?>
     </table>	</td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="1" colspan="4"></td>
  </tr>
</table>
</body>
</html>
<? include($_path['counter']."counter.php"); ?>