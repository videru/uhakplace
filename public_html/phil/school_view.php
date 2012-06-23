<?
	include_once("../include/lib.php");
	
	
//	if(!$_mb)
//		rg_href($_url['member'].'login.php','회원가입이 필요한 서비스입니다.');



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
	   // echo ",있다.";
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
	   // echo ",없다.";
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
    <td >
<table width="692" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="a_sub_title2" background="../img/school_view_title_bg.gif" height="36" ><?=$data['s_title']?> (<?=$data['title']?>)</td>
  </tr>
</table>	
	
	
	</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><table width="692" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="220"valign="top">
          <table width="220" border="0" cellspacing="0" cellpadding="0">
           <tr>
             <td  height="195" style="padding: 2px 0 0 2px" valign="top" background="../img/sch_view_img_bg.gif" ><img src="../data/school/<?=$num?>/<?=$data[school_file2_name]?>" width="216" height="191" align="absmiddle" /></td>
            </tr>
		</table>

		
		</td>
        <td width="13">&nbsp;</td>
        <td width="459" valign="top"><table width="459" cellpadding="0" cellspacing="0">
          <?if($national == 3){?>
          <tr>
            <td bgcolor="#dcdcdc" height="1" colspan="4"></td>
          </tr>
          <tr>
            <td width="68" bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 2pt">·학교구분</td>
            <td width="161" bgcolor="#FFFFFF" class="a_s_text_title" ><?=$_const['section'][$data[section]]?></td>
            <td width="68" bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 2pt">·홈페이지</td>
            <td width="162" class="a_s_text_title" ><?=$data['homepage']?></td>
          </tr>
          <tr>
            <td bgcolor="#dcdcdc" height="1" colspan="4"></td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 2pt">·주소</td>
            <td colspan="3" class="a_s_text_title" ><?=$data['location']?></td>
          </tr>
          <tr>
            <td bgcolor="#dcdcdc" height="1" colspan="4"></td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 2pt">·설립연도</td>
            <td class="a_s_text_title" ><?=$data['open_date']?></td>
            <td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 2pt">·총인원</td>
            <td  class="a_s_text_title" ><?=$data['total']?>
              명</td>
          </tr>
          <tr>
            <td bgcolor="#dcdcdc" height="1" colspan="4"></td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 2pt">·1타임시간</td>
            <td class="a_s_text_title" ><?=$data['class_time']?>
              분</td>
            <td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 2pt">·튜터</td>
            <td class="a_s_text_title" ><?=$data['teacher_no']?>
              명</td>
          </tr>
          <tr>
            <td bgcolor="#dcdcdc" height="1" colspan="4"></td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 2pt">·네이티브</td>
            <td class="a_s_text_title" ><?=$data['native_class']?></td>
            <td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 2pt">·스파르타</td>
            <td class="a_s_text_title" ><?=$data['sparta_program']?></td>
          </tr>
          <tr>
            <td bgcolor="#dcdcdc" height="1" colspan="4"></td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 2pt">·기숙사형태</td>
            <td class="a_s_text_title" colspan="3"><?=$data['dorm_type']?></td>
          </tr>
          <tr>
            <td bgcolor="#dcdcdc" height="1" colspan="4"></td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 2pt">·기타시설</td>
            <td class="a_s_text_title" colspan="3"><?=$data['etc_facility']?></td>
          </tr>
          <tr>
            <td bgcolor="#dcdcdc" height="1" colspan="4"></td>
          </tr>
          <?}else{?>
          <tr>
            <td bgcolor="#dcdcdc" height="1" colspan="4"></td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 2pt">·지역/위치</td>
            <td colspan="3" class="a_s_text_title" ><?=$data['location']?></td>
          </tr>
          <tr>
            <td bgcolor="#dcdcdc" height="1" colspan="4"></td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 2pt">·홈페이지</td>
            <td colspan="3" class="a_s_text_title" ><?=$data['homepage']?></td>
          </tr>
          <tr>
            <td bgcolor="#dcdcdc" height="1" colspan="4"></td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 2pt">·학교소개</td>
            <td colspan="3" class="a_s_text_title" ><?=$data['native_info']?></td>
          </tr>
          <tr>
            <td bgcolor="#dcdcdc" height="1" colspan="4"></td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 2pt">·입학금/수업료</td>
            <td colspan="3" class="a_s_text_title" ><?=$data['native_cost']?></td>
          </tr>
          <tr>
            <td bgcolor="#dcdcdc" height="1" colspan="4"></td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 2pt">·코스</td>
            <td colspan="3" class="a_s_text_title" ><?=$data['native_course']?></td>
          </tr>
          <tr>
            <td bgcolor="#dcdcdc" height="1" colspan="4"></td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 2pt">·프로모션</td>
            <td class="a_s_text_title" colspan="3"><?=$data['native_promo']?></td>
          </tr>
          <tr>
            <td bgcolor="#dcdcdc" height="1" colspan="4"></td>
          </tr>
		  <?}?>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
	<table width="692" border="0" cellpadding="1" cellspacing="1" bgcolor="#cccccc">
      <tr>
        <td bgcolor="#f0f0f0" height="45">	
	<table width="670" border="0" cellpadding="0" cellspacing="0" align="center">
      <tr>
        <td width="120"><img src="../img/icon/tel_icon.gif" align="absmiddle" />&nbsp;02-522-2062~3</td>
        <td>&nbsp;</td>
        <td width="200"><img src="../img/icon/nate_icon.gif" align="absmiddle" />&nbsp;jongryul20@nate.com&nbsp;<img src="../img/icon/msn_icon.gif" align="absmiddle" />&nbsp;uhakplace@hotmail.com</td>
        <td width="30">&nbsp;</td>
        <td align="right" width="76"  >&nbsp;</td>
        <td>&nbsp;</td>
        <td align="right" width="76" ><a href="#" onClick="cost();"><img src="../img/btn_or_cost.gif" border="0"  align="absmiddle"/></a></td>
        <td>&nbsp;</td>
        <td align="right" width="76" ><a href="../board/online.php?num=<?=$num?>"><img src="../img/btn_or_online.gif" border="0"   align="absmiddle"/></a></td>
        <td>&nbsp;</td>
        <td align="right" width="76" ><a href="../phil/school_list.php"><img src="../img/btn_or_list.gif" border="0"   align="absmiddle"/></a></td>
      </tr>
    </table>	
        </td>	
		</tr>
		</table>	
	</td>
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
<?if($row){?>
  <tr>
    <td><img src="../img/school_sub_ti3.gif" width="692" height="40" /></td>
  </tr>
  <tr>
    <td><?=$data['row']?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <?}?>
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
    <td>
	  <table width="692" border="0" cellpadding="0" cellspacing="0" align="center">
	    <tr>
		  <td><img src="../img/sc_view_img_bg_top.gif"></td>
		 </tr>
	    <tr>
		  <td background="../img/sc_view_img_bg_middle.gif" align="center">
			<table width="660" border="0" cellpadding="0" cellspacing="0" align="center">
	       <?if($national ==3){?>
			 <tr>
		      <td colspan="7">학교시설</td>
		     </tr>	         
			 <tr>
		      <td width="160"><img src="../data/school/<?=$num?>/<?=$data[school_file2_name]?>" width="160" height="120"></td>
		      <td>&nbsp;</td>
		      <td width="160"><img src="../data/school/<?=$num?>/<?=$data[school_file3_name]?>" width="160" height="120"></td>
		      <td>&nbsp;</td>
		      <td width="160"><img src="../data/school/<?=$num?>/<?=$data[school_file4_name]?>" width="160" height="120"></td>
		      <td>&nbsp;</td>
		      <td width="160"><img src="../data/school/<?=$num?>/<?=$data[school_file5_name]?>" width="160" height="120"></td>
		      </tr> 
	          <tr>
		      <td colspan="7">&nbsp;</td>
		      </tr>			  
	         <tr>
		      <td colspan="7">기숙사시설</td>
		     </tr>	         
			 <tr>
		      <td width="160"><img src="../data/school/<?=$num?>/<?=$data[school_file10_name]?>" width="160" height="120"></td>
		      <td>&nbsp;</td>
		      <td width="160"><img src="../data/school/<?=$num?>/<?=$data[school_file11_name]?>" width="160" height="120"></td>
		      <td>&nbsp;</td>
		      <td width="160"><img src="../data/school/<?=$num?>/<?=$data[school_file12_name]?>" width="160" height="120"></td>
		      <td>&nbsp;</td>
		      <td width="160"><img src="../data/school/<?=$num?>/<?=$data[school_file13_name]?>" width="160" height="120"></td>
		      </tr> 
	          <tr>
		      <td colspan="7">&nbsp;</td>
		      </tr>
	         <tr>
		      <td colspan="7">강의실&수업사진</td>
		     </tr>	         
			 <tr>
		      <td width="160"><img src="../data/school/<?=$num?>/<?=$data[school_file18_name]?>" width="160" height="120"></td>
		      <td>&nbsp;</td>
		      <td width="160"><img src="../data/school/<?=$num?>/<?=$data[school_file19_name]?>" width="160" height="120"></td>
		      <td>&nbsp;</td>
		      <td width="160"><img src="../data/school/<?=$num?>/<?=$data[school_file20_name]?>" width="160" height="120"></td>
		      <td>&nbsp;</td>
		      <td width="160"><img src="../data/school/<?=$num?>/<?=$data[school_file21_name]?>" width="160" height="120"></td>
		      </tr> 
	          <tr>
		      <td colspan="7">&nbsp;</td>
		      </tr>
	         <tr>
		      <td colspan="7">액티비티</td>
		     </tr>	         
			 <tr>
		      <td width="160"><img src="../data/school/<?=$num?>/<?=$data[school_file26_name]?>" width="160" height="120"></td>
		      <td>&nbsp;</td>
		      <td width="160"><img src="../data/school/<?=$num?>/<?=$data[school_file27_name]?>" width="160" height="120"></td>
		      <td>&nbsp;</td>
		      <td width="160"><img src="../data/school/<?=$num?>/<?=$data[school_file28_name]?>" width="160" height="120"></td>
		      <td>&nbsp;</td>
		      <td width="160"><img src="../data/school/<?=$num?>/<?=$data[school_file29_name]?>" width="160" height="120"></td>
		      </tr>
			  <?}else{?>
			 <tr>
		      <td width="160"><img src="../data/school/<?=$num?>/<?=$data[school_file2_name]?>" width="160" height="120"></td>
		      <td>&nbsp;</td>
		      <td width="160"><img src="../data/school/<?=$num?>/<?=$data[school_file3_name]?>" width="160" height="120"></td>
		      <td>&nbsp;</td>
		      <td width="160"><img src="../data/school/<?=$num?>/<?=$data[school_file4_name]?>" width="160" height="120"></td>
		      <td>&nbsp;</td>
		      <td width="160"><img src="../data/school/<?=$num?>/<?=$data[school_file5_name]?>" width="160" height="120"></td>
		      </tr> 
			  <?}?>
			</table>		  
		  </td>
		 </tr>	
	    <tr>
		  <td><img src="../img/sc_view_img_bg_bottom.gif"></td>
		 </tr>
	  </table>	 
	</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
	<table width="692" border="0" cellpadding="1" cellspacing="1" bgcolor="#cccccc">
      <tr>
        <td bgcolor="#f0f0f0" height="45">	
	<table width="670" border="0" cellpadding="0" cellspacing="0" align="center">
      <tr>
        <td width="120"><img src="../img/icon/tel_icon.gif" align="absmiddle" />&nbsp;02-522-2062~3</td>
        <td>&nbsp;</td>
        <td width="200"><img src="../img/icon/nate_icon.gif" align="absmiddle" />&nbsp;&nbsp;jongryul20@nate.com&nbsp;<img src="../img/icon/msn_icon.gif" align="absmiddle" />&nbsp;uhakplace@hotmail.com</td>
        <td width="30">&nbsp;</td>
        <td align="right" width="76"  >&nbsp;</td>
        <td>&nbsp;</td>
        <td align="right" width="76" ><a href="#" onClick="cost();"><img src="../img/btn_or_cost.gif" border="0"  align="absmiddle"/></a></td>
        <td>&nbsp;</td>
        <td align="right" width="76" ><a href="../board/online.php?num=<?=$num?>"><img src="../img/btn_or_online.gif" border="0"   align="absmiddle"/></a></td>
        <td>&nbsp;</td>
        <td align="right" width="76" ><a href="../phil/school_list.php"><img src="../img/btn_or_list.gif" border="0"   align="absmiddle"/></a></td>
      </tr>
    </table>	
        </td>	
		</tr>
		</table>	
	</td>
  </tr>
</table>
<? include("./sub_view_footer.php"); ?>
<script type="text/javascript">
 function cost()
 {
  window.open('../phil/school_cost.php?&num=<?=$num?>', 'window' ,'toolbar=no,width=410,height=690,fullscreen=no,directories=no,status=no,scrollbars=no,resize=no,menubar=no,location=no');
 }   
</script>