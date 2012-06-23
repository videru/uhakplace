<?

	include_once("../include/lib.php");
	require_once("admin_chk.php");
	

	if($mode=='modify' || $mode=='delete') {
		$rs->clear();
		$rs->set_table(	$_table['regi']);
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
		$rs->set_table($_table['regi']);
		$rs->add_where("regi_no=$num");
		$rs->delete();
		
		$rs->commit();
		rg_href("regi_list.php?$_get_param[3]");
	}

	if($_SERVER['REQUEST_METHOD']=='POST') {

     		$rs->clear();
	    	$rs->set_table($_table['regi']);
			$rs->add_field("student_name","$student_name");		
			$rs->add_field("chain","$chain");		
	    	$rs->add_field("regi_date1","$regi_date1");
	    	$rs->add_field("regi_date2","$regi_date2");
 	    	$rs->add_field("regi_date3","$regi_date3");
	    	$rs->add_field("abroad_date1","$abroad_date1");
	    	$rs->add_field("abroad_date2","$abroad_date2");	
	    	$rs->add_field("abroad_date3","$abroad_date3");	
	    	$rs->add_field("airpoet_date1","$airpoet_date1");
	    	$rs->add_field("airpoet_date2","$airpoet_date2");	
	    	$rs->add_field("airpoet_date3","$airpoet_date3");				
	    	$rs->add_field("national","$national");	
		   	$rs->add_field("passport","$passport");
	    	$rs->add_field("passport_check","$passport_check");	
			$rs->add_field("regi_cost","$regi_cost");
	    	$rs->add_field("regi_cost_check","$regi_cost_check");	
			$rs->add_field("school_regi","$school_regi");
	    	$rs->add_field("school_regi_check","$school_regi_check");					
	    	$rs->add_field("air_reserve","$air_reserve");	
	    	$rs->add_field("air_reserve_check","$air_reserve_check");
	    	$rs->add_field("air_paid","$air_paid");		
	    	$rs->add_field("air_paid_check","$air_paid_check");
	    	$rs->add_field("air_ticket","$air_ticket");
	    	$rs->add_field("air_ticket_check","$air_ticket_check");
	    	$rs->add_field("insu","$insu");
	    	$rs->add_field("insu_check","$insu_check");
			$rs->add_field("cost_paid","$cost_paid");	
	    	$rs->add_field("cost_paid_check","$cost_paid_check");			
			$rs->add_field("abroad_ot","$abroad_ot");
	    	$rs->add_field("abroad_ot_check","$abroad_ot_check");
	    	$rs->add_field("abroad","$abroad");	
	    	$rs->add_field("abroad_check","$abroad_check");		
	    	$rs->add_field("mb_id","$mb_id");	
	    	$rs->add_field("email","$email");		
	    	$rs->add_field("tel","$tel");	
	    	$rs->add_field("etc","$etc");	
	    	$rs->add_field("process_state","$process_state");	
		if($mode=='modify') {
			$rs->add_where("regi_no=$num");
			$rs->update();
		} else {
			$rs->insert();
			$regi_no=$rs->get_insert_id();		
		}
	
		$rs->commit();
		rg_href("regi_list.php?$_get_param[3]");
	}


	$MENU_L='m5';

?>

<? include("_header.php"); ?>
<? include("admin.header.php"); ?>
<table border="1" cellpadding="6" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1">
  <tr>
    <td bgcolor="#F7F7F7">등록현황<? if($mode=='modify') { ?>수정<?}else{?>등록<? } ?>	</td>
  </tr>
</table>
<br>
<form name="regi_form" method="post" action="?<?=$_get_param[3]?>" onSubmit="return validate(this)" enctype="multipart/form-data">
<input type="hidden" name="mode" value="<?=$mode?>" />
<input type="hidden" name="num" value="<?=$num?>" />
<table border="1" cellpadding="2" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1">
    <tr>
	<td bgcolor="#F7F7F7" colspan=4>관리자만 보는 정보입니다.</td>
  </tr>  
</table>
<br>
<table border="1" cellpadding="3" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1">
	<tr>
		<td align="center" bgcolor="#F0F0F4"><strong>이름</strong></td>
		<td><input name="student_name" type="text" value="<?=$data['student_name']?>" class="input" size=10></td>
	</tr>
	<tr>
		<td align="center" bgcolor="#F0F0F4"><strong>회원ID</strong></td>
		<td><input name="mb_id" type="text" value="<?=$data['mb_id']?>" class="input" size=10></td>
	</tr>
	<tr>
		<td align="center" bgcolor="#F0F0F4"><strong>이메일</strong></td>
		<td><input name="email" type="text" value="<?=$data['email']?>" class="input" size=20></td>
	</tr>
	<tr>
		<td align="center" bgcolor="#F0F0F4"><strong>전화번호</strong></td>
		<td><input name="tel" type="text" value="<?=$data['tel']?>" class="input" size=20></td>
	</tr>
	<tr>
		<td align="center" bgcolor="#F0F0F4"><strong>담당지사</strong></td>
		<td><select name="chain" class="input" id="chain">
<?=rg_html_option($_regi['chain'],$data['chain'])?>
		</select></td>
	</tr>
	<tr>
		<td align="center" bgcolor="#F0F0F4"><strong>상담일</strong></td>
		<td><input name="regi_date1" type="text" value="<?=$data['regi_date1']?>" class="input" size=4>년<input name="regi_date2" type="text" value="<?=$data['regi_date2']?>" class="input" size=2>월<input name="regi_date3" type="text" value="<?=$data['regi_date3']?>" class="input" size=2>일</td>
	</tr>
	<tr>
		<td align="center" bgcolor="#F0F0F4"><strong>등록일</strong></td>
		<td><input name="abroad_date1" type="text" value="<?=$data['abroad_date1']?>" class="input" size=4>년<input name="abroad_date2" type="text" value="<?=$data['abroad_date2']?>" class="input" size=2>월<input name="abroad_date3" type="text" value="<?=$data['abroad_date3']?>" class="input" size=2>일</td>
	</tr>
	<tr>
		<td align="center" bgcolor="#F0F0F4"><strong>국가</strong></td>
		<td><select name="national" class="input" id="national">
<?=rg_html_option($_const['national'],$data['national'])?>
		</select></td>
	</tr>
	<tr>
		<td align="center" bgcolor="#F0F0F4"><strong>진행상황</strong></td>
		<td><select name="process_state" class="input" id="chain">
<?=rg_html_option($_process['process_state'],$data['process_state'])?>
		</select></td>
	</tr>
	<tr>
		<td align="center" bgcolor="#F0F0F4"><strong>여권/비자 확인</strong></td>
		<td><input type="checkbox" name="passport_check" value="1" <? if($data[passport_check] == "1") {echo "checked";} ?>><input name="passport" type="text" value="<?=$data['passport']?>" class="input" size=100></td>
	</tr>	
	<tr>
		<td align="center" bgcolor="#F0F0F4"><strong>입학금 입금</strong></td>
		<td><input type="checkbox" name="regi_cost_check" value="1" <? if($data[regi_cost_check] == "1") {echo "checked";} ?>><input name="regi_cost" type="text" value="<?=$data['regi_cost']?>" class="input" size=100></td>
	</tr>
	<tr>
		<td align="center" bgcolor="#F0F0F4"><strong>어학교 등록</strong></td>
		<td><input type="checkbox" name="school_regi_check" value="1" <? if($data[school_regi_check] == "1") {echo "checked";} ?>><input name="school_regi" type="text" value="<?=$data['school_regi']?>" class="input" size=100></td>
	</tr>
	<tr>
		<td align="center" bgcolor="#F0F0F4"><strong>항공 예약</strong></td>
		<td><input type="checkbox" name="air_reserve_check" value="1" <? if($data[air_reserve_check] == "1") {echo "checked";} ?>><input name="air_reserve" type="text" value="<?=$data['air_reserve']?>" class="input" size=100></td>
	</tr>	
	<tr>
		<td align="center" bgcolor="#F0F0F4"><strong>항공비 완납</strong></td>
		<td><input type="checkbox" name="air_paid_check" value="1" <? if($data[air_paid_check] == "1") {echo "checked";} ?>><input name="air_paid" type="text" value="<?=$data['air_paid']?>" class="input" size=100></td>
	</tr>
	<tr>
		<td align="center" bgcolor="#F0F0F4"><strong>항공권 발급</strong></td>
		<td><input type="checkbox" name="air_ticket_check" value="1" <? if($data[air_ticket_check] == "1") {echo "checked";} ?>><input name="air_ticket" type="text" value="<?=$data['air_ticket']?>" class="input" size=100></td>
	</tr>
	<tr>
		<td align="center" bgcolor="#F0F0F4"><strong>학비입금</strong></td>
		<td><input type="checkbox" name="cost_paid_check" value="1" <? if($data[cost_paid_check] == "1") {echo "checked";} ?>><input name="cost_paid" type="text" value="<?=$data['cost_paid']?>" class="input" size=100></td>
	</tr>	
	<tr>
		<td align="center" bgcolor="#F0F0F4"><strong>보험가입</strong></td>
		<td><input type="checkbox" name="insu_check" value="1" <? if($data[insu_check] == "1") {echo "checked";} ?>><input name="insu" type="text" value="<?=$data['insu']?>" class="input" size=100></td>
	</tr>	

	<tr>
		<td align="center" bgcolor="#F0F0F4"><strong>출국 O/T</strong></td>
		<td><input type="checkbox" name="abroad_ot_check" value="1" <? if($data[abroad_ot_check] == "1") {echo "checked";} ?>><input name="abroad_ot" type="text" value="<?=$data['abroad_ot']?>" class="input" size=100></td>
	</tr>
	<tr>
		<td align="center" bgcolor="#F0F0F4"><strong>출국</strong></td>
		<td><input type="checkbox" name="abroad_check" value="1" <? if($data[abroad_check] == "1") {echo "checked";} ?>><input name="airpoet_date1" type="text" value="<?=$data['airpoet_date1']?>" class="input" size=4>년<input name="airpoet_date2" type="text" value="<?=$data['airpoet_date2']?>" class="input" size=2>월<input name="airpoet_date3" type="text" value="<?=$data['airpoet_date3']?>" class="input" size=2>일<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="abroad" type="text" value="<?=$data['abroad']?>" class="input" size=100></td>
	</tr>
	<tr>
		<td align="center" bgcolor="#F0F0F4"><strong>상담사항</strong></td>
		<td><textarea name="etc" cols="100" rows="6"><?=$data['etc']?></textarea></td>
</table>
<br>
<table width="600" border="0" align="center">
	<tr>
		<td align="center">
			<input type="submit" value="등록/수정" class="button">
			<input type="button" value=" 취   소 " onClick="history.back();" class="button">
		</td>
	</tr>
</table>
</form>
<? include("admin.footer.php"); ?>
<? include("_footer.php"); ?>