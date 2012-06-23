<?

	include_once("../include/lib.php");
	require_once("admin_chk.php");
  
   $today_year=date('Y'); 
   $today_month=date('m'); 
   $today_date=date('d'); 
   $today_woe=date('w'); 

   $regi_date = mktime(0, 0, 0, $today_month, $today_date, $today_year);
                
	if($mode=='modify' || $mode=='delete') {
		$rs->clear();
		$rs->set_table($_table['working']);
		$rs->add_where("c_no=$c_no");
		$rs->select();
		if($rs->num_rows()!=1) { // 정보가 올바르지 않다면
			rg_href('','정보를 찾을수 없습니다.','back');
		}
		$data=$rs->fetch();		
	} else {
		$data=$rs->fetch();		
	}
	
?>


<link href="<?=$_url['css']?>style.css" rel="stylesheet" type="text/css">
<table border="1" cellpadding="6" cellspacing="0" width="550" align="center">
  <tr>
    <td bgcolor="#F7F7F7" align="center"><b>
	<?

 
  if($today_woe ==1){
    $today_woe ="월";
  }elseif($today_woe ==2){
    $today_woe ="화";
  }elseif($today_woe ==3){
    $today_woe ="수";
  }elseif($today_woe ==4){
    $today_woe ="목";
  }elseif($today_woe ==5){
    $today_woe ="금";
  }elseif($today_woe ==6){
    $today_woe ="토";
  }elseif($today_woe ==0){
    $today_woe ="일";
  }
	?>
	<?=date('Y')?>년<?=date('m')?>월<?=date('d')?>일 <?=$today_woe?>요일 <?=$_mb[mb_name]?> 출퇴근 및 업무일지</b></td>
  </tr>
</table>
<br>
<form name="online_form" method="post" action="person_check_edit_ok.php?<?=$_get_param[3]?>" onSubmit="return validate(this)" enctype="multipart/form-data">
<input type="hidden" name="mode" value="<?=$mode?>" />
<input type="hidden" name="page" value="<?=$page?>" />
<input type="hidden" name="c_no" value="<?=$c_no?>" />
<table border="1" cellpadding="0" cellspacing="0" width="530" align="center">
	<tr height="22">
		<td width="90" align="center" bgcolor="#EFEFEF"><font color="#525252"><strong>출근시간</strong></font></td>
		<td width="160">&nbsp;<?=rg_date($data[check_time], '%H:%M')?></td>
		<td width="90" align="center" bgcolor="#EFEFEF"><font color="#525252"><strong>퇴근시간</strong></font></td>
		<td width="160">&nbsp;<?=rg_date($data[leave_time], '%H:%M')?></td>
	</tr>		
	
	
	<tr height="2">
		<td width="90" align="center" bgcolor="#EFEFEF"><font color="#525252"><strong>주요업무</strong></font></td>
		<td colspan="3">&nbsp;<textarea name="working_title" cols=70  rows=3  class=textarea><?=$data[working_title]?></textarea></td>
	</tr>	
	
	<tr height="22">
		<td width="90" align="center" bgcolor="#EFEFEF"><font color="#525252"><strong>오전업무</strong></font></td>
		<td colspan="3">&nbsp;<textarea name="morning_work_text" cols=70  rows=3  class=textarea><?=$data[morning_work_text]?></textarea></td>
	</tr>		
	<tr height="22">
		<td width="90" align="center" bgcolor="#EFEFEF"><font color="#525252"><strong>오후업무</strong></font></td>
		<td colspan="3">&nbsp;<textarea name="afternoon_work_text" cols=70  rows=3  class=textarea><?=$data[afternoon_work_text]?></textarea></td>
	</tr>
	<tr height="22">
		<td width="90" align="center" bgcolor="#EFEFEF"><font color="#525252"><strong>내일업무</strong></font></td>
		<td colspan="3">&nbsp;<textarea name="tomorrow_work_text" cols=70  rows=3  class=textarea><?=$data[tomorrow_work_text]?></textarea></td>
	</tr>	
	<tr height="22">
		<td width="90" align="center" bgcolor="#EFEFEF"><font color="#525252"><strong>건의사항</strong></font></td>
		<td colspan="3">&nbsp;<textarea name="etc_work_text" cols=70  rows=3  class=textarea><?=$data[etc_work_text]?></textarea></td>
	</tr>
</table>
<br>

<table width="450" border="0" align="center">
	<tr>
		<td align="center">
			<input type="submit" value=" 수 정 " class="button">
			<input type="button" value="삭 제 " onClick="history.back();" class="button">
		</td>
	</tr>
</table>
</form>

<br>
<table border="1" cellpadding="0" cellspacing="0" width="530" align="center">
	<tr height="22">
		<td width="90" align="center" bgcolor="#EFEFEF"><font color="#525252"><strong>대표이사<br>전달사항</strong></font></td>
		<td >&nbsp;<?=$data[admin_comment]?></td>
	</tr>
</table>