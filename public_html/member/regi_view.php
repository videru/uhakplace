<?
	include_once("../include/lib.php");

        $rs = new $rs_class($dbcon);
		$rs->clear();
		$rs->set_table(	$_table['regi']);
		$rs->add_where("mb_id='$_mb[mb_id]'");
		$rs->select();
		$data=$rs->fetch();		


if(!$data['consult']){
$data['consult'] = $_mb[mb_name];
}else{
$data['consult'] = $data['consult'];
}
?>

<? include_once($_path['member'].'_header.php'); ?>
<table border="0" cellpadding="0" cellspacing="0" width="770" align="center" >
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="4"></td>
    </tr>		
	<tr>
		<td width="110" bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">이름</td>
		<td width="275" class="a_s_text_title"><?=$data['student_name']?>   (영문: <?=$data['student_ename']?>)</td>
		<td width="110"  bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">회원ID</td>
		<td width="275"  class="a_s_text_title"><?=$data['mb_id']?></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="4"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">등록경로</td>
		<td colspan="3"  class="a_s_text_title"><?=$_const['root'][$data['rgi_type']]?></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="4"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">이메일</td>
		<td  class="a_s_text_title"><?=$data['email']?></td>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">전화번호</td>
		<td class="a_s_text_title"><?=$data['tel']?></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="4"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">담당지사</td>
		<td class="a_s_text_title"><?=$_regi['chain'][$data['chain']]?>
		</select></td>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">수속담당자</td>
		<td  class="a_s_text_title">
         <?       
	    $rs_list = new $rs_class($dbcon);
	    $rs_list->clear();
	    $rs_list->set_table($_table['member']);
        $rs_list->add_where("mb_id != 'webadmin'");	
        $rs_list->add_where("mb_level >= 90");	
	    $RV=$rs_list->fetch();
		?>
<?=$RV[mb_name]?>
		</td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="4"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">상담일</td>
		<td class="a_s_text_title"><?=$data['regi_date']?></td>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">등록일</td>
		<td class="a_s_text_title"><?=$data['abroad_date']?></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="4"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">출국일</td>
		<td  class="a_s_text_title"><?=$data['airpoet_date']?></td>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">국가</td>
		<td class="a_s_text_title"><?=$_const['national'][$data['national']]?>&nbsp;연계 <?=$_const['national'][$data['national2']]?></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="4"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">연수기간</td>
		<td colspan="3" class="a_s_text_title"><?=$data['study_gigan']?>주&nbsp;&nbsp;|&nbsp;&nbsp;연계:<?=$data['study_gigan2']?>주</td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="4"></td>
    </tr>
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">수업시작/종료</td>
		<td colspan="3" class="a_s_text_title"><?=$data['open_date']?> ~ <?=rg_date($data[end_date1],'%Y-%m-%d')?>&nbsp;&nbsp;|&nbsp;&nbsp;연계:<?=$data['open_date2']?> ~ <?=rg_date($data[end_date21],'%Y-%m-%d')?></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="4"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">등록학교</td>
		<td colspan="3" class="a_s_text_title">필리핀: 
		 <?       
	    $rs_sc = new $rs_class($dbcon);
	    $rs_sc->clear();
	    $rs_sc->set_table($_table['school']);
        $rs_sc->add_where("national = 3");	
	   $SC=$rs_sc->fetch();

		?>
	<?=$SC[title]?>
		</select><br>연계(or 기타국가): <?=$data['school_name2']?></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="4"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">진행상황</td>
		<td colspan="2" class="a_s_text_title"><?=$_process['process_state'][$data['process_state']]?></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="4"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 3pt"><input type="checkbox" name="passport_check" value="1" <? if($data[passport_check] == "1") {echo "checked";} ?>>여권/비자 확인</td>
		<td colspan="3" class="a_s_text_title"><?=$data['passport']?> (여권번호:<?=$data['passport_no']?>)</td>
	</tr>	
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="4"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 3pt"><input type="checkbox" name="regi_cost_check" value="1" <? if($data[regi_cost_check] == "1") {echo "checked";} ?>>입학금 입금</td>
		<td colspan="3" class="a_s_text_title"><?=$data['regi_cost']?></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="4"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 3pt"><input type="checkbox" name="school_regi_check" value="1" <? if($data[school_regi_check] == "1") {echo "checked";} ?>>어학교 등록</td>
		<td colspan="3" class="a_s_text_title"><?=$data['school_regi']?></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="4"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 3pt"><input type="checkbox" name="air_reserve_check" value="1" <? if($data[air_reserve_check] == "1") {echo "checked";} ?>>항공 예약</td>
		<td colspan="3" class="a_s_text_title"><?=$data['air_reserve']?></td>
	</tr>	
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="4"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 3pt"><input type="checkbox" name="air_paid_check" value="1" <? if($data[air_paid_check] == "1") {echo "checked";} ?>>항공비 완납</td>
		<td colspan="3" class="a_s_text_title"><?=$data['air_paid']?></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="4"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><input type="checkbox" name="air_ticket_check" value="1" <? if($data[air_ticket_check] == "1") {echo "checked";} ?>>항공권 발급</td>
		<td colspan="3" class="a_s_text_title"><?=$data['air_ticket']?></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="4"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 3pt"><input type="checkbox" name="cost_paid_check" value="1" <? if($data[cost_paid_check] == "1") {echo "checked";} ?>>학비입금</td>
		<td colspan="3" class="a_s_text_title"><?=$data['cost_paid']?></td>
	</tr>	
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="4"></td>
    </tr>		
		<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 3pt"><input type="checkbox" name="cost_bank_check" value="1" <? if($data[cost_bank_check] == "1") {echo "checked";} ?>>학비송금</td>
		<td colspan="3" class="a_s_text_title"><?=$data['cost_bank']?></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="4"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 3pt"><input type="checkbox" name="insu_check" value="1" <? if($data[insu_check] == "1") {echo "checked";} ?>>보험가입</td>
		<td colspan="3" class="a_s_text_title"><?=$data['insu']?></td>
	</tr>	
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="4"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 3pt"><input type="checkbox" name="abroad_ot_check" value="1" <? if($data[abroad_ot_check] == "1") {echo "checked";} ?>>출국 O/T</td>
		<td colspan="3" class="a_s_text_title"><?=$data['abroad_ot']?></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="4"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 3pt"><input type="checkbox" name="abroad_check" value="1" <? if($data[abroad_check] == "1") {echo "checked";} ?>>출국</td>
		<td colspan="3" class="a_s_text_title"><?=$data['abroad']?></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="4"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 3pt"><input type="checkbox" name="dormi_check" value="1" <? if($data[dormi_check] == "1") {echo "checked";} ?>>숙박</td>
		<td colspan="3" class="a_s_text_title"><?=$data['dormi']?></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="4"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 3pt"><input type="checkbox" name="pickup_check" value="1" <? if($data[pickup_check] == "1") {echo "checked";} ?>>픽업</td>
		<td colspan="3" class="a_s_text_title"><?=$data['pickup']?></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="4"></td>
    </tr>	
</table>

<? include_once($_path['member'].'_footer.php'); ?>