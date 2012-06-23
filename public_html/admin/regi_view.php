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

	$rs_ac = new $rs_class($dbcon);
	$rs_ac->clear();
	$rs_ac->set_table($_table['regi_account']);
	$rs_ac->add_where("stu_no=$num");
	$rs_ac->select();
	
	$data_ac=$rs_ac->fetch();	



		
	} else {
		$data=$rs->fetch();		

	}
	
  
	    $rs_na = new $rs_class($dbcon);
	    $rs_na->clear();
	    $rs_na->set_table($_table['member']);
        $rs_na->add_where("mb_num = $data[consult]");	
        $name=$rs_na->fetch();

	$MENU_L='m5';

?>

<? include("_header.php"); ?>
<? include("admin.header.php"); ?>
<table border="0" cellpadding="0" cellspacing="0" width="800" align="center">
  <tr height="40">
    <td background="images/title_bg.gif" style="padding:9pt 0pt 0pt 10pt" valign="top"><font color=#000000><b>학생관리</b></font></td>
  </tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" width="800" align="center">
   <tr>
     <td class="a_sub_title">등록현황<? if($mode=='modify') { ?>수정<?}else{?>등록<? } ?></td>
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
<table border="0" cellpadding="0" cellspacing="0" width="770" align="center" >
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>		
	<tr>
		<td width="110" bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">이름</td>
		<td colspan="2"><?=$data['student_name']?></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">회원ID</td>
		<td colspan="2"><?=$data['mb_id']?></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">등록경로</td>
		<td colspan="2"><?=$_const['root'][$data['rgi_type']]?></td>
	</tr>	
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">이메일</td>
		<td colspan="2"><?=$data['email']?></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">전화번호</td>
		<td colspan="2"><?=$data['tel']?></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">담당지사</td>
		<td colspan="2"><?=$_regi['chain'][$data['chain']]?></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	
	<tr>
		<td width="110" bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">수속담당자</td>
		<td colspan="2"><?=$name[mb_name]?></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">상담일</td>
		<td colspan="2"><?=$data['regi_date1']?>-<?=$data['regi_date2']?>-<?=$data['regi_date3']?></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">등록일</td>
		<td colspan="2"><?=rg_date($data['abroad_date1'],"%Y-%m-%d")?></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">국가</td>
		<td colspan="2"><?=$_const['national'][$data['national']]?>
		</select></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">등록학교</td>
		<td colspan="2"><?=$data['school_name']?></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">등록기간</td>
		<td colspan="2"><?=$data['study_gigan']?>주</td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">진행상황</td>
		<td colspan="2"><?=$_process['process_state'][$data['process_state']]?>
		</select></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><input type="checkbox" name="passport_check" value="1" <? if($data[passport_check] == "1") {echo "checked";} ?>>여권/비자 확인</td>
		<td colspan="2"><?=$data['passport']?></td>
	</tr>	
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><input type="checkbox" name="regi_cost_check" value="1" <? if($data[regi_cost_check] == "1") {echo "checked";} ?>>입학금 입금</td>
		<td colspan="2"><?=$data['regi_cost']?></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><input type="checkbox" name="school_regi_check" value="1" <? if($data[school_regi_check] == "1") {echo "checked";} ?>>어학교 등록</td>
		<td colspan="2"><?=$data['school_regi']?></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><input type="checkbox" name="air_reserve_check" value="1" <? if($data[air_reserve_check] == "1") {echo "checked";} ?>>항공 예약</td>
		<td colspan="2"><?=$data['air_reserve']?></td>
	</tr>	
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><input type="checkbox" name="air_paid_check" value="1" <? if($data[air_paid_check] == "1") {echo "checked";} ?>>항공비 완납</td>
		<td colspan="2"><?=$data['air_paid']?></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><input type="checkbox" name="air_ticket_check" value="1" <? if($data[air_ticket_check] == "1") {echo "checked";} ?>>항공권 발급</td>
		<td colspan="2"><?=$data['air_ticket']?></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><input type="checkbox" name="cost_paid_check" value="1" <? if($data[cost_paid_check] == "1") {echo "checked";} ?>>학비입금</td>
		<td colspan="2"><?=$data['cost_paid']?></td>
	</tr>	
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>		
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><input type="checkbox" name="insu_check" value="1" <? if($data[insu_check] == "1") {echo "checked";} ?>>보험가입</td>
		<td colspan="2"><?=$data['insu']?></td>
	</tr>	
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><input type="checkbox" name="abroad_ot_check" value="1" <? if($data[abroad_ot_check] == "1") {echo "checked";} ?>>출국 O/T</td>
		<td colspan="2"><?=$data['abroad_ot']?></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><input type="checkbox" name="abroad_check" value="1" <? if($data[abroad_check] == "1") {echo "checked";} ?>>출국</td>
		<td colspan="2"><?=$data['abroad']?></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">상담사항</td>
		<td width="600"><?=$data['etc']?></td>
        <td bgcolor="#FFFFFF"></td>
    </tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	
    <tr>
	    <td height="30" colspan="3"></td>
    </tr>
    <tr>
	    <td bgcolor="#BECCDD" height="2" colspan="3"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">입학금</td>
		<td colspan="2"><?=$data_ac['iphak_date1']?>년 <?=$data_ac['iphak_date2']?>월 <?=$data_ac['iphak_date3']?>일 <?=number_format($data_ac['iphak'])?>원 </td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">학비</td>
		<td colspan="2">입금: <?=$data_ac['cost_in_date1']?>년 <?=$data_ac['cost_in_date2']?>월 <?=$data_ac['cost_in_date3']?>일 <?=$data_ac['cost_in']?>원  <br>송금: <?=$data_ac['cost_out_date1']?>년 <?=$data_ac['cost_out_date2']?>월 <?=$data_ac['cost_out_date3']?>일 <?=number_format($data_ac['cost_out'])?>원</td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">환차액</td>
		<td colspan="2"><?=$data_ac['exch_date1']?>년 <?=$data_ac['exch_date2']?>월 <?=$data_ac['exch_date3']?>일 <?=number_format($data_ac['exchange'])?>원</td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">송금수수료</td>
		<td colspan="2"><?=$data_ac['ba_fee_date1']?>년 <?=$data_ac['ba_fee_date2']?>월 <?=$data_ac['ba_fee_date3']?>일 <?=number_format($data_ac['bank_fee'])?>원</td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">학비컴</td>
		<td colspan="2"><?=$data_ac['comm_date1']?>년 <?=$data_ac['comm_date2']?>월 <?=$data_ac['comm_date3']?>일 <?=number_format($data_ac['comm'])?>원</td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">할인액</td>
		<td colspan="2"><?=$data_ac['sale_date1']?>년 <?=$data_ac['sale_date2']?>월 <?=$data_ac['sale_date3']?>일 <?=number_format($data_ac['sale'])?></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">컴쉐어</td>
		<td colspan="2"><?=$data_ac['co_sh1_date1']?>년 <?=$data_ac['co_sh1_date2']?>월 <?=$data['co_sh1_date3']?>일 <?=number_format($data_ac['comm_share1'])?>원 <br><?=$data_ac['co_sh2_date1']?>년 <?=$data_ac['co_sh2_date2']?>월 <?=$data_ac['co_sh2_date3']?>일 <?=number_format($data_ac['comm_share2'])?></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">항공컴</td>
		<td colspan="2"><?=$data_ac['air_date1']?>년 <?=$data_ac['air_date2']?>월 <?=$data_ac['air_date3']?>일 <?=number_format($data_ac['air_comm'])?>원 (ex.3500000, ','없이 숫자만 기입하세요) </td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>		
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">보험컴</td>
		<td colspan="2"> <?=$data_ac['insu_date1']?>년 <?=$data_ac['insu_date2']?>월 <?=$data_ac['insu_date3']?>일 <?=number_format($data_ac['insu_comm'])?></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">기타컴</td>
		<td colspan="2"><?=$data_ac['etc_date1']?>년 <?=$data_ac['etc_date2']?>월 <?=$data_ac['etc_date3']?>일 <?=number_format($data_ac['etc_comm'])?>원  </td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="2" colspan="3"></td>
    </tr>	
    <tr>
	    <td height="30" colspan="3"></td>
    </tr>	
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	
<? for ($i=1; $i<=10; $i++){?>
   <tr>
    <td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>파일<?=$i?></strong></td>
	<td colspan="2" class="a_s_text_title">      
<?if($data[school_file1_name]){?>
<a href="../data/student_file/<?=$data[school_file.$i._name]?>"><?=$data[school_file.$i._name]?></a><?}?>
	</td>
  </tr>
<?}?>
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

<? include("admin.footer.php"); ?>
<? include("_footer.php"); ?>