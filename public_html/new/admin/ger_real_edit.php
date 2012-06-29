<?

	include_once("../include/lib.php");
	require_once("admin_chk.php");
	

	if($mode=='modify' || $mode=='delete') {
		$rs->clear();
		$rs->set_table(	$_table['ger_sangdam']);
		$rs->add_where("id=$num");
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
		$rs->set_table($_table['ger_sangdam']);
		$rs->add_where("id=$num");
		$rs->delete();
		
		$rs->commit();
		rg_href("ger_real_list.php?$_get_param[3]");
	}

	if($_SERVER['REQUEST_METHOD']=='POST') {

     		
			
			
			$phone_sangdam =  mktime(0,0,0,$phone_sangdamm, $phone_sangdamd, $phone_sangdamy);
			$reg_date  =  mktime(0,0,0,$reg_datem, $reg_dated, $reg_datey);
			
		if($regi_state==2) {	
			
     		$rs->clear();
	    	$rs->set_table($_table['regi']);
	    	$rs->add_field("regi_date1","$phone_sangdamy");
	    	$rs->add_field("regi_date2","$phone_sangdamm");
 	    	$rs->add_field("regi_date3","$phone_sangdamd");
			$rs->add_field("student_name","$name");		
			$rs->add_field("chain","$chain");				
	    	$rs->add_field("national","$national");		
	    	$rs->add_field("mb_id","$user_id");	
	    	$rs->add_field("email","$email");		
	    	$rs->add_field("tel","$phone");	
			$rs->insert();
			$regi_no=$rs->get_insert_id();			
		}	
			
			$rs->clear();
	    	$rs->set_table($_table['ger_sangdam']);
			$rs->add_field("name","$name");		
			$rs->add_field("user_id","$user_id");		
	    	$rs->add_field("phone","$phone");
	    	$rs->add_field("email","$email");
 	    	$rs->add_field("lastschool","$lastschool");
	    	$rs->add_field("grade","$grade");
	    	$rs->add_field("department1","$department1");	
	    	$rs->add_field("department2","$department2");					
	    	$rs->add_field("examinee","$examinee");	
		   	$rs->add_field("subject","$subject");
	    	$rs->add_field("former","$former");	
			$rs->add_field("after","$after");
	    	$rs->add_field("transaction","$transaction");	
			$rs->add_field("sangdam","$sangdam");
	    	$rs->add_field("reg_date","$reg_date");					
	    	$rs->add_field("phone_sangdam","$phone_sangdam");	
	    	$rs->add_field("hope_day","$hope_day");
	    	$rs->add_field("office","$office");		
	    	$rs->add_field("national","$national");
	    	$rs->add_field("tel_able_time","$tel_able_time");
	    	$rs->add_field("chain","$chain");
	    	$rs->add_field("regi_state","$regi_state");


		if($mode=='modify') {
			$rs->add_where("id=$num");
			$rs->update();
		} else {
			$rs->insert();
			$regi_no=$rs->get_insert_id();		
		}
	
		$rs->commit();
		rg_href("ger_real_list.php?$_get_param[3]");
	}

    


     
    if($data[phone_sangdam]<>0) {

    $phone_sangdamy=date(Y, $data[phone_sangdam]);
    $phone_sangdamm=date(m, $data[phone_sangdam]);
    $phone_sangdamd=date(d, $data[phone_sangdam]);
	
	 }else{

    $phone_sangdamy="";
    $phone_sangdamm="";
    $phone_sangdamd="";

    }
  
	$reg_datey=date(Y, $data[reg_date]);
    $reg_datem=date(m, $data[reg_date]);
    $reg_dated=date(d, $data[reg_date]);

	$MENU_L='m5';

?>

<? include("_header.php"); ?>
<? include("admin.header.php"); ?>
<table border="0" cellpadding="0" cellspacing="0" width="800" align="center">
  <tr height="40">
    <td background="images/title_bg.gif" style="padding:9pt 0pt 0pt 10pt" valign="top"><font color=#000000><b>상담예약</b></font></td>
  </tr>
</table>
<form name="regi_form" method="post" action="?<?=$_get_param[3]?>" onSubmit="return validate(this)" enctype="multipart/form-data">
<input type="hidden" name="mode" value="<?=$mode?>" />
<input type="hidden" name="num" value="<?=$num?>" />
<table border="0" cellspacing="0" cellpadding="0" width="800" align="center">
   <tr>
     <td class="a_sub_title"><b>상담예약 <? if($mode=='modify') { ?>수정<?}else{?>등록<? } ?></td>
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

<table border="0" cellpadding="0" cellspacing="0" width="770" align="center">
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>		
	<tr>
		<td width="130" bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>담당지사</strong></td>
		<td width="640"><select name="chain" class="select">
                      <?=rg_html_option($_regi['chain'],$data['chain'])?>
		               </select>
		</td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>이름</strong></td>
		<td><input name="name" type="text" value="<?=$data['name']?>" class="cc" size=8></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>국가</strong></td>
		<td><select name="national" class="select2">
              <?=rg_html_option($_const['national'],$data['national'])?>
		    </select>
		</td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>상담일</strong></td>
		<td><input name="phone_sangdamy" type="text" value="<?=$phone_sangdamy?>" class="cc" size=4>년<input name="phone_sangdamm" type="text" value="<?=$phone_sangdamm?>" class="cc" size=2>월<input name="phone_sangdamd" type="text" value="<?=$phone_sangdamd?>" class="cc" size=2>일</td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>신청일</strong></td>
		<td><input name="reg_datey" type="text" value="<?=$reg_datey?>" class="cc" size=4>년<input name="reg_datem" type="text" value="<?=$reg_datem?>" class="cc" size=2>월<input name="reg_dated" type="text" value="<?=$reg_dated?>" class="cc" size=2>일</td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>연락처</strong></td>
		<td><input name="phone" type="text" value="<?=$data['phone']?>" class="cc" size=30></td>
	</tr>	
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>이메일</strong></td>
		<td><input name="email" type="text" value="<?=$data['email']?>" class="cc" size=30></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>연락가능시간</strong></td>
		<td><input name="tel_able_time" type="text" value="<?=$data['tel_able_time']?>" class="cc" size=30></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>현재/최종학력</strong></td>
		<td><input name="grade" type="text" value="<?=$data['grade']?>" class="cc" size=30></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>희망방문일시</strong></td>
		<td><input name="hope_day" type="text" value="<?=$data['hope_day']?>" class="cc" size=30></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>방문상담 희망 지역</strong></td>
		<td><select name="office" class="select">
             <?=rg_html_option($_regi['chain'],$data['office'])?>
		    </select>
		</td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>수능응시여부</strong></td>
		<td><input name="examinee" type="text" value="<?=$data['examinee']?>" class="cc" size=30></td>
	</tr>	
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>수능계열</strong></td>
		<td><input name="subject" type="text" value="<?=$data['subject']?>" class="cc" size=30></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>전공학과(국내)</strong></td>
		<td><input name="department1" type="text" value="<?=$data['department1']?>" class="cc" size=30></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>독일희망학과(국외)</strong></td>
		<td><input name="department2" type="text" value="<?=$data['department2']?>" class="cc" size=30></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>수능최소성적통과여부</strong></td>
		<td><?if($data['former']){?><input name="former" type="text" value="<?=$data['former']?>" class="cc" size=30>&nbsp;05이전<?}else{?><input name="after" type="text" value="<?=$data['after']?>" class="cc" size=30>&nbsp;05이후<?}?></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>예약상태</strong></td>
		<td><select name="transaction" class="select">
              <?=rg_html_option($_reserv['transaction'],$data['transaction'])?>
		</select>
		</td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>상담상태</strong></td>
		<td><select name="sangdam" class="select2">
            <?=rg_html_option($_reserv['sangdam'],$data['sangdam'])?>
		</select></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>등록상태</strong></td>
		<td><select name="regi_state" class="select3">
            <?=rg_html_option($_reserv['regi_state'],$data['regi_state'])?>
		</select>
		</td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
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