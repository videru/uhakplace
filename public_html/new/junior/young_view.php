<?
	include_once("../include/lib.php");
	$rs->clear();
	$rs->set_table($_table['young']);
	$rs->add_where("num=$num");
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
	<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>로고</strong></td>
	<td><?if($data[school_file1_name]){?><img src="../data/young/<?=$num?>/<?=$data[school_file1_name]?>" width="180" height="65" align="absmiddle"><?}?></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="1" colspan="2"></td>
  </tr>  
  <tr>
	<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>지역</strong></td>
	<td bgcolor="#FFFFFF"><?=$ss_list[$data['area']]?></select>
	</td>
   </tr>
  <tr>
	<td bgcolor="#BECCDD" height="1" colspan="2"></td>
  </tr>  
  <tr >
	<td width="80" bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>학교이름</strong></td>
	<td width="480" align="left"><?=$data['title']?></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="1" colspan="2"></td>
  </tr>
   <tr>
	<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>학교구분</strong></td>
	<td align="left"><?=$_const['section2'][$data['section']]?></td>
  </tr> 
  <tr>
	<td bgcolor="#BECCDD" height="1" colspan="2"></td>
  </tr> 
   <tr>
	<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>홈페이지</strong></td>
	<td ><?=$data['homepage']?></td>
  </tr> 
  <tr>
	<td bgcolor="#BECCDD" height="1" colspan="2"></td>
  </tr>  
   <tr>
	<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>주소</strong></td>
	<td><?=$data['location']?></td>
  </tr> 
  <tr>
	<td bgcolor="#BECCDD" height="1" colspan="2"></td>
  </tr>    
  <tr>
	<td colspan="2"><?=$data['info']?></td>
	</tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="2"></td>
  </tr>
 <tr>
   <tr>
	<td colspan="2" >
      <table width="690" border="0" cellpadding="0" cellspacing="0" align="center">
		   <?if($data[school_file1_name]){?>		 
		 <tr>
		   <td width="167"><img src="../data/young/<?=$num?>/<?=$data[school_file2_name]?>" width="167" height="120"></td>
		   <td>&nbsp;</td>
		   <td width="167"><img src="../data/young/<?=$num?>/<?=$data[school_file3_name]?>" width="167" height="120"></td>
		   <td>&nbsp;</td>
		   <td width="167"><img src="../data/young/<?=$num?>/<?=$data[school_file4_name]?>" width="167" height="120"></td>
		   <td>&nbsp;</td>
		   <td width="167"><img src="../data/young/<?=$num?>/<?=$data[school_file5_name]?>" width="167" height="120"></td>
		   </tr> 
		  <?}?>
		   <?if($data[school_file6_name]){?>
	       <tr>
		     <td colspan="7">&nbsp;</td>
		   </tr>
		   <tr>
		    <td width="167"><img src="../data/young/<?=$num?>/<?=$data[school_file6_name]?>" width="167" height="120"></td>
		    <td>&nbsp;</td>
		    <td width="167"><img src="../data/young/<?=$num?>/<?=$data[school_file7_name]?>" width="167" height="120"></td>
		    <td>&nbsp;</td>
		    <td width="167"><img src="../data/young/<?=$num?>/<?=$data[school_file8_name]?>" width="167" height="120"></td>
		    <td>&nbsp;</td>
		    <td width="167"><img src="../data/young/<?=$num?>/<?=$data[school_file9_name]?>" width="167" height="120"></td>
		  </tr> 
		  <?}?>
      </table>
	</td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="1" colspan="2"></td>
  </tr>
</table>
</body>
</html>
<? include($_path['counter']."counter.php"); ?>