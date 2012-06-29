<?

	include_once("../include/lib.php");
	require_once("admin_chk.php");
	

	if($mode=='modify' || $mode=='delete') {
		$rs->clear();
		$rs->set_table(	$_table['camp_regi']);
		$rs->add_where("regi_no=$num");
		$rs->select();
		if($rs->num_rows()!=1) { // 정보가 올바르지 않다면
			rg_href('','정보를 찾을수 없습니다.','back');
		}
		$data=$rs->fetch();		
		
	} else {
		$data=$rs->fetch();		
	}
	
 	
		// 학교 삭제
	if($mode=='delete') {	
		$rs->clear();
		$rs->set_table($_table['camp_regi']);
		$rs->add_where("regi_no=$num");
		$rs->delete();
		
		$rs->commit();
		rg_href("camp_regi_list.php?$_get_param[3]");
	}

	if($_SERVER['REQUEST_METHOD']=='POST') {

     		$rs->clear();
	    	$rs->set_table($_table['camp_regi']);
			$rs->add_field("course","$course");	
			$rs->add_field("gigan","$gigan");	
			$rs->add_field("student_name","$student_name");	
			$rs->add_field("student_ename","$student_ename");		
	    	$rs->add_field("student_age","$student_age");
	    	$rs->add_field("jumin1","$jumin1");					
	    	$rs->add_field("jumin2","$jumin2");	
            $rs->add_field("student_level","$student_level");		
	    	$rs->add_field("school_name","$school_name");
	    	$rs->add_field("post","$post");	
	    	$rs->add_field("mb_address1","$mb_address1");
	    	$rs->add_field("mb_address2","$mb_address2");		
	    	$rs->add_field("parent1","$parent1");
	    	$rs->add_field("parent1_hp","$parent1_hp");
	    	$rs->add_field("parent2","$parent2");
			$rs->add_field("parent2_hp","$parent2_hp");
	    	$rs->add_field("email","$email");
	    	$rs->add_field("tel","$tel");					
	    	$rs->add_field("process","$process");		
		if($mode=='modify') {
			$rs->add_where("regi_no=$num");
			$rs->update();
		} else {
			$rs->insert();
			$regi_no=$rs->get_insert_id();		
		}
	
		$rs->commit();
		rg_href("camp_regi_list.php?$_get_param[3]");
	}


	$MENU_L='m5';

?>

<? include("_header.php"); ?>
<? include("admin.header.php"); ?>
<table border="0" cellpadding="0" cellspacing="0" width="800" align="center">
  <tr height="40">
    <td background="images/title_bg.gif" style="padding:9pt 0pt 0pt 10pt" valign="top"><font color=#000000><b>캠프등록현황</b></font></td>
  </tr>
</table>
<form name="regi_form" method="post" action="?<?=$_get_param[3]?>" onSubmit="return validate(this)" enctype="multipart/form-data">
<input type="hidden" name="mode" value="<?=$mode?>" />
<input type="hidden" name="num" value="<?=$num?>" />
<table border="0" cellspacing="0" cellpadding="0" width="800" align="center">
   <tr>
     <td class="a_sub_title">캠프등록현황<? if($mode=='modify') { ?>수정<?}else{?>등록<? } ?></td>
   </tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" width="800" align=center bgcolor="#FFFFFF">
    <tr>  
     <td>  
  <table border="0" cellpadding="0" cellspacing="0" width="800" align=center>
	<tr>
		<td bgcolor="#666666" height="2"></td>
	</tr> 
	<tr>
		<td bgcolor="#FFFFFF" height="8"></td>
	</tr> 
  </table>
<form name="regi_form" method="post" action="?<?=$_get_param[3]?>" onSubmit="return validate(this)" enctype="multipart/form-data">
<input type="hidden" name="mode" value="<?=$mode?>" />
<input type="hidden" name="num" value="<?=$num?>" />
<table border="0" cellpadding="0" cellspacing="0" width="770" align="center">
	<tr> 
         <td bgcolor="#BECCDD" height="1" colspan="2"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">진행상황</td>
		<td><select name="process" class="select2">
             <option value="">=전체=</option>
           <?=rg_html_option($_reserv['sangdam'],"$data[process]")?>
           </select> 
		</td>
	</tr>	
	<tr> 
         <td bgcolor="#BECCDD" height="1" colspan="2"></td>
    </tr>
	<tr>
		<td width="110" bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">코스</td>
		<td><select name="course" class="select">
             <?=rg_html_option($_camp_list['camp'],"$data[course]")?>
            </select> 
        </td>
	</tr>	
	<tr> 
         <td bgcolor="#BECCDD" height="1" colspan="2"></td>
    </tr>
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">이름(한글)</td>
		<td><input name="student_name" type="text" class="cc" size=8 value="<?=$data[student_name]?>" ></td>
	</tr>
	<tr> 
         <td bgcolor="#BECCDD" height="1" colspan="2"></td>
    </tr>
	<tr>		
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">이름(영문)</td>
		<td><input name="student_ename" type="text" class="cc" size=25 value="<?=$data[student_ename]?>"> </td>
	</tr>	
	<tr> 
         <td bgcolor="#BECCDD" height="1" colspan="2"></td>
    </tr>
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">주민등록번호</td>
		<td><input name="jumin1" type="text" class="cc" size=6 value="<?=$data[jumin1]?>">-<input name="jumin2" type="text" class="cc" size=7 value="<?=$data[jumin2]?>"></td>
	</tr>
	<tr> 
         <td bgcolor="#BECCDD" height="1" colspan="2"></td>
    </tr>
	<tr>		
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">나이</td>
		<td><input name="student_age" type="text" class="cc" size=3 value="<?=$data[student_age]?>"> </td>
	</tr>	
	<tr> 
         <td bgcolor="#BECCDD" height="1" colspan="2"></td>
    </tr>		
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">학년</td>
		<td><input name="student_level" type="text" class="cc" size=3 value="<?=$data[student_level]?>"></td>
	</tr>
	<tr> 
         <td bgcolor="#BECCDD" height="1" colspan="2"></td>
    </tr>
	<tr>		
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">학교명</td>
		<td><input name="school_name" type="text" class="cc" size=25 value="<?=$data[school_name]?>"></td>
	</tr>		
	<tr> 
         <td bgcolor="#BECCDD" height="1" colspan="2"></td>
    </tr>			
	<tr height="45">
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">주소</td>
		<td><input type="text" class="cc" name="mb_post1" size="3" maxlength="3" readonly value="<?=$data['mb_post1']?>" span="2" hname="우편번호" <?=$required['mb_address']?>> -
    <input type="text" class="cc" name="mb_post2" size="3" maxlength="3" readonly value="<?=$data['mb_post2']?>">
      <img src="images/bt_zip.gif" onClick="search_post('<?=$_url['member']?>','regi_form|mb_post1|mb_post2|mb_address1|mb_address2')"><br>
<input name="mb_address1" type="text" value="<?=$data[mb_address1]?>" class="cc" size=40>&nbsp;<input name="mb_address2" type="text" value="<?=$data[mb_address2]?>" class="cc" size=40></td>
	</tr>	
	<tr> 
         <td bgcolor="#BECCDD" height="1" colspan="2"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">보호자1</td>
		<td class="a_s_text_title">이름 <input name="parent1" type="text" class="cc" size=6  value="<?=$data[parent1]?>">&nbsp;&nbsp;&nbsp;연락처 <input name="parent1_hp" type="text" class="cc" size=15  value="<?=$data[parent1_hp]?>"></td>
	</tr>
	<tr> 
         <td bgcolor="#BECCDD" height="1" colspan="2"></td>
    </tr>
	<tr>		
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">보호자2</td>
		<td class="a_s_text_title">이름 <input name="parent2" type="text" class="cc" size=6>&nbsp;&nbsp;&nbsp;연락처 <input name="parent2_hp" type="text" class="cc" size=15  value="<?=$data[parent2_hp]?>"></td>
	</tr> 
	<tr> 
         <td bgcolor="#BECCDD" height="1" colspan="2"></td>
    </tr>
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">자택전화</td>
		<td><input name="tel" type="text" class="cc" size=15  value="<?=$data[tel]?>"></td>
	<tr> 
         <td bgcolor="#BECCDD" height="1" colspan="2"></td>
    </tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">e-mail</td>
		<td><input name="email" type="text" class="cc" size=40   value="<?=$data[email]?>"></td>
	</tr>
	<tr> 
         <td bgcolor="#BECCDD" height="1" colspan="2"></td>
    </tr>		
</table>
  <table border="0" cellpadding="0" cellspacing="0" width="800" align=center>
	<tr>
		<td bgcolor="#FFFFFF" height="8"></td>
	</tr> 	
	<tr>
		<td bgcolor="#666666" height="2"></td>
	</tr> 
  </table>

  </td>
  </tr>
</table>
<br>
<table width="200" border="0"  align=center>
	<tr>
		<td width="100" align="center"><INPUT onfocus=this.blur() type=image src="images/bt_write.gif"></td>
		<td width="100" align="center"><input type=image src="images/bt_list2.gif" onClick="history.back();" ></td>
	</tr>
</table>
</form>
<? include("admin.footer.php"); ?>
<? include("_footer.php"); ?>