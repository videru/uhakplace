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
<title>�ʸ��� ���� ���� �ʻ��</title>
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
	<td colspan="2" style="padding:15 0 10 5"><strong>1.�б�����</strong></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="2"></td>
  </tr>
  
   <tr>
     <td colspan="2" bgcolor="#FFFFFF" "><table width="690" border="0" cellspacing="0" cellpadding="0">
       <tr>
         <td width="410"><table width="410" border="0" align="center" cellpadding="0" cellspacing="0">
           <tr>
             <td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>����</strong></td>
             <td width="270" bgcolor="#FFFFFF"><?=$ss_list[$data['area']]?></td>
           </tr>
           <tr>
             <td bgcolor="#BECCDD" height="1" colspan="2"></td>
           </tr>
           <tr>
             <td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>��������</strong></td>
             <td bgcolor="#FFFFFF"><?=$_const[camp_type2][$data[section]]?></td>
           </tr>
           <tr>
             <td bgcolor="#BECCDD" height="1" colspan="2"></td>
           </tr>
           <tr>
             <td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>Ȩ������</strong></td>
             <td>http://
               <?=$data['homepage']?></td>
           </tr>
           <tr>
             <td bgcolor="#BECCDD" height="1" colspan="2"></td>
           </tr>
           <tr>
             <td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>����/���</strong></td>
             <td><?=$data['location']?></td>
           </tr>
           <tr>
             <td bgcolor="#BECCDD" height="1" colspan="2"></td>
           </tr>
           <tr>
             <td width="140" bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>���ο�</strong></td>
             <td><?=$data['class']?></td>
           </tr>
           <tr>
             <td bgcolor="#BECCDD" height="1" colspan="2"></td>
           </tr>
           <tr>
             <td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>�δ�ü�</strong></td>
             <td><?=$data['etc_facility']?></td>
           </tr>
           <tr>
             <td bgcolor="#BECCDD" height="1" colspan="2"></td>
           </tr>
           <tr>
             <td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>���������</strong></td>
             <td><?=$data['dorm_type']?></td>
           </tr>
           <tr>
             <td bgcolor="#BECCDD" height="1" colspan="2"></td>
           </tr>
           <tr>
             <td width="140" bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>��������</strong></td>
             <td><?=$data['gigan']?></td>
           </tr>
           <tr>
             <td bgcolor="#BECCDD" height="1" colspan="2"></td>
           </tr>
           <tr>
             <td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>��������</strong></td>
             <td><?=$data['class_time']?></td>
           </tr>
           <tr>
             <td bgcolor="#BECCDD" height="1" colspan="2"></td>
           </tr>
           <tr>
             <td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>��󿬷�</strong></td>
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
	<td colspan="2" style="padding:15 0 10 5"><strong>2.�����Ұ�/TIP</strong></td>
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
	<td colspan="2" style="padding:15 0 10 5"><strong>3.�������� �� �����α׷�</strong></td>
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
	<td colspan="2" style="padding:15 0 10 5"><strong>4.������� �󼼾ȳ�</strong></td>
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
	<td colspan="2" style="padding:15 0 10 5"><strong>�����䰭</strong></td>
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
	<td colspan="2" style="padding:15 0 10 5"><strong>1.���Լ���</strong></td>
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
	<td colspan="2" style="padding:15 0 10 5"><strong>2.����� ���α׷�</strong></td>
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
	<td colspan="2" style="padding:15 0 10 5"><strong>3.�ָ� ���α׷�</strong></td>
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
	<td colspan="4" style="padding:15 0 10 5"><strong>4.��ü�����ȳ�</strong></td>
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
	<td colspan="4" style="padding:15 0 10 5"><strong>5.ķ�� �б� �ȳ�</strong></td>
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
	<td colspan="4" style="padding:15 0 10 5"><strong>6.Ȩ������ ��Ȱ����</strong></td>
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
	<td colspan="4" style="padding:15 0 10 5"><strong>7.��������-��Ŭ���� ����</strong></td>
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
	<td colspan="4" style="padding:15 0 10 5"><strong>8.ķ�� ���α׷� Q & A</strong></td>
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