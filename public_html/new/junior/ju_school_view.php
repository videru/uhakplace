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
<table width="690" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="690" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="180"><img src="../data/ju_school/<?=$num?>/<?=$data[school_file1_name]?>" width="180" height="65" align="absmiddle"></td>
        <td width="15">&nbsp;</td>
        <td width="495" class="text15_b"><?=$data['s_title']?> (<?=$data['title']?>)</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><table width="690" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="422"><table width="422" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>����</strong></td>
              <td width="345" bgcolor="#FFFFFF"><?=$ss_list[$data['area']]?></td>
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
              <td>http://<?=$data['homepage']?></td>
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
              <td width="77" bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>���ο�</strong></td>
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
              <td width="77" bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>��������</strong></td>
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
        <td width="18">&nbsp;</td>
        <td width="250" align="center"><object type='application/x-shockwave-flash' width='250px' height='220px' align='middle' classid='clsid:d27cdb6e-ae6d-11cf-96b8-444553540000' codebase='http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0'>
          <param name='movie' value='<?=$data[movielink]?>' />
          <param name='allowScriptAccess' value='always' />
          <param name='allowFullScreen' value='true' />
          <param name='bgcolor' value='#000000' />
          <embed src='http://flvs.daum.net/flvPlayer.swf?vid=jjzebGUrbAs$' width='250px' height='220px' allowscriptaccess='always' type='application/x-shockwave-flash' allowfullscreen='true' bgcolor='#000000' ></embed>
        </object></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>2.�����Ұ�/TIP</strong></td>
  </tr>
  <tr>
    <td><?=$data['info']?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>3.�������� �� �����α׷�</strong></td>
  </tr>
  <tr>
    <td><?=$data['program']?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>4.������� �󼼾ȳ�</strong></td>
  </tr>
  <tr>
    <td><?=$data['cost_info']?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><table width="690" border="0" cellpadding="0" cellspacing="0" >
      <tr>
        <td width="168"><img src="../data/ju_school/<?=$num?>/<?=$data[school_file2_name]?>" width="168" height="125" /></td>
        <td>&nbsp;</td>
        <td width="168"><img src="../data/ju_school/<?=$num?>/<?=$data[school_file3_name]?>" width="168" height="125" /></td>
        <td>&nbsp;</td>
        <td width="168"><img src="../data/ju_school/<?=$num?>/<?=$data[school_file4_name]?>" width="168" height="125" /></td>
        <td>&nbsp;</td>
        <td width="168"><img src="../data/ju_school/<?=$num?>/<?=$data[school_file5_name]?>" width="168" height="125" /></td>
      </tr>
      <tr>
        <td colspan="7">&nbsp;</td>
      </tr>
      <tr>
        <td width="168"><img src="../data/ju_school/<?=$num?>/<?=$data[school_file6_name]?>" width="168" height="125" /></td>
        <td>&nbsp;</td>
        <td width="168"><img src="../data/ju_school/<?=$num?>/<?=$data[school_file7_name]?>" width="168" height="125" /></td>
        <td>&nbsp;</td>
        <td width="168"><img src="../data/ju_school/<?=$num?>/<?=$data[school_file8_name]?>" width="168" height="125" /></td>
        <td>&nbsp;</td>
        <td width="168"><img src="../data/ju_school/<?=$num?>/<?=$data[school_file9_name]?>" width="168" height="125" /></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
<? include($_path['counter']."counter.php"); ?>