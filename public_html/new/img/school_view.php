<?
	include_once("../include/lib.php");
	
	
//	if(!$_mb)
//		rg_href($_url['member'].'login.php','ȸ�������� �ʿ��� �����Դϴ�.');



		$rs->clear();
		$rs->set_table($_table['school']);
		$rs->add_where("num=$num");
		$rs->select();
		$data=$rs->fetch();		


	
            if($national==1) {
		     $_const['area'] = $_const['area1'];
			}elseif($national==2) {
			 $_const['area'] = $_const['area2'];
			}elseif($national==3) {
			 $_const['area'] = $_const['area3'];
			}elseif($national==4) {
			 $_const['area'] = $_const['area4'];
			}elseif($national==5) {
			 $_const['area'] = $_const['area5'];
			}elseif($national==6) {
			 $_const['area'] = $_const['area6'];
			}elseif($national==7) {
			 $_const['area'] = $_const['area7'];
			}elseif($national==8) {
			 $_const['area'] = $_const['area8'];
			}

	$data[school_cost] = ereg_replace("<P>"," ",$R[school_cost]);
	$data[school_cost] = ereg_replace("</P>","<br>",$R[school_cost]);




if (ereg(",",$data[sc_type])) {
	   // echo ",�ִ�.";
		$str_categoryS = explode(",",$data[sc_type]);
	//	echo sizeof($str_categoryS)."<-- str_categoryS<Br>";

		for ($i=0;$i<sizeof($str_categoryS)-1;$i++) {
			//echo $str_categoryS[$i]."<--<br>";
			
			switch ($str_categoryS[$i])  {
				   case('01') : $checked1 ="checked";break;
				   case('02') : $checked2 ="checked";break;
				   case('03') : $checked3 ="checked";break;
				   case('04') : $checked4 ="checked";break;
				   case('05') : $checked5 ="checked";break;
				   case('06') : $checked6 ="checked";break;
				   case('07') : $checked7 ="checked";break;
				   case('08') : $checked8 ="checked";break;
				   case('09') : $checked9 ="checked";break;
				   case('10') : $checked10="checked";break;
				   case('11') : $checked11="checked";break;
				   case('12') : $checked12="checked";break;
			}
		}
	}else{
	   // echo ",����.";
			switch ($data[sc_type])  {
				   case('01') : $checked1 ="checked";break;
				   case('02') : $checked2 ="checked";break;
				   case('03') : $checked3 ="checked";break;
				   case('04') : $checked4 ="checked";break;
				   case('05') : $checked5 ="checked";break;
				   case('06') : $checked6 ="checked";break;
				   case('07') : $checked7 ="checked";break;
				   case('08') : $checked8 ="checked";break;
				   case('09') : $checked9 ="checked";break;
				   case('10') : $checked10="checked";break;
				   case('11') : $checked11="checked";break;
				   case('12') : $checked12="checked";break;
			}
	}

?>
<? include("./sub_view_header.php"); ?>

<table width="692" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="a_sub_title2" background="../img/school_view_title_bg.gif" height="36" ><?=$data['s_title']?> (<?=$data['title']?>)</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><table width="692" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="220" height="195" style="padding: 2px 0 0 2px" valign="top" background="../img/sch_view_img_bg.gif" ><img src="../data/school/<?=$num?>/<?=$data[school_file2_name]?>" width="216" height="191" align="absmiddle" /></td>
        <td width="13">&nbsp;</td>
        <td width="459" valign="top"><table width="459" cellpadding="0" cellspacing="0">
          
          <tr>
            <td bgcolor="#dcdcdc" height="1" colspan="4"></td>
          </tr>
          <tr>
            <td width="68" bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 2pt">���б�����</td>
            <td width="161" bgcolor="#FFFFFF" class="a_s_text_title" ><?=$_const['section'][$data[section]]?></td>
            <td width="68" bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 2pt">��Ȩ������</td>
            <td width="162" class="a_s_text_title" ><?=$data['homepage']?></td>
          </tr>
          <tr>
            <td bgcolor="#dcdcdc" height="1" colspan="4"></td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 2pt">������/��ġ</td>
            <td colspan="3" class="a_s_text_title" ><?=$data['location']?></td>
          </tr>
          <tr>
            <td bgcolor="#dcdcdc" height="1" colspan="4"></td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 2pt">����������</td>
            <td class="a_s_text_title" ><?=$data['open_date']?></td>
            <td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 2pt">�����ο�</td>
            <td  class="a_s_text_title" ><?=$data['total']?>
              ��</td>
          </tr>
          <tr>
            <td bgcolor="#dcdcdc" height="1" colspan="4"></td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 2pt">��1Ÿ�ӽð�</td>
            <td class="a_s_text_title" ><?=$data['class_time']?>
              ��</td>
            <td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 2pt">��Ʃ��</td>
            <td class="a_s_text_title" ><?=$data['teacher_no']?>
              ��</td>
          </tr>
          <tr>
            <td bgcolor="#dcdcdc" height="1" colspan="4"></td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 2pt">������Ƽ��</td>
            <td class="a_s_text_title" ><?=$data['native_class']?></td>
            <td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 2pt">�����ĸ�Ÿ</td>
            <td class="a_s_text_title" ><?=$data['sparta_program']?></td>
          </tr>
          <tr>
            <td bgcolor="#dcdcdc" height="1" colspan="4"></td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 2pt">�����������</td>
            <td class="a_s_text_title" colspan="3"><?=$data['dorm_type']?></td>
          </tr>
          <tr>
            <td bgcolor="#dcdcdc" height="1" colspan="4"></td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 2pt">����Ÿ�ü�</td>
            <td class="a_s_text_title" colspan="3"><?=$data['etc_facility']?></td>
          </tr>
          <tr>
            <td bgcolor="#dcdcdc" height="1" colspan="4"></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><table width="390" border="0" align="right" cellpadding="0" cellspacing="0">
      <tr>
        <td align="right" width="76" >&nbsp;</td>
        <td>&nbsp;</td>
        <td align="right" width="76"  ><img src="../img/btn_or_img.gif" /></td>
        <td>&nbsp;</td>
        <td align="right" width="76" ><img src="../img/btn_or_cost.gif" /></td>
        <td>&nbsp;</td>
        <td align="right" width="76" ><img src="../img/btn_or_online.gif" /></td>
        <td>&nbsp;</td>
        <td align="right" width="76" ><img src="../img/btn_or_list.gif" /></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><img src="../img/school_sub_ti1.gif" width="692" height="40" /></td>
  </tr>
  <tr>
    <td><?=$data['info']?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><img src="../img/school_sub_ti2.gif" width="692" height="40" /></td>
  </tr>
  <tr>
    <td><?=$data['program']?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><img src="../img/school_sub_ti3.gif" width="692" height="40" /></td>
  </tr>
  <tr>
    <td><?=$data['row']?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><img src="../img/school_sub_ti4.gif" width="692" height="40" /></td>
  </tr>
  <tr>
    <td><?=$data['map']?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><table width="390" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td align="right" width="76" >&nbsp;</td>
        <td>&nbsp;</td>
        <td align="right" width="76"  ><img src="../img/btn_or_img.gif" /></td>
        <td>&nbsp;</td>
        <td align="right" width="76" ><img src="../img/btn_or_cost.gif" /></td>
        <td>&nbsp;</td>
        <td align="right" width="76" ><img src="../img/btn_or_online.gif" /></td>
        <td>&nbsp;</td>
        <td align="right" width="76" ><img src="../img/btn_or_list.gif" /></td>
      </tr>
    </table></td>
  </tr>
</table>
<? include("./sub_view_footer.php"); ?>