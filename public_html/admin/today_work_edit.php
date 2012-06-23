<?

	include_once("../include/lib.php");
	require_once("admin_chk.php");
  
   $today_year=date('Y',$book); 
   $today_month=date('m',$book); 
   $today_date=date('d',$book); 
   $today_woe=date('w',$book); 


                

		$rs->clear();
		$rs->set_table($_table['today_work']);
		$rs->add_where("regi_date=$book");
		$rs->select();
		if($rs->num_rows()==1) { // 정보가 올바르지 않다면
		
		$mode = "modify";
		}
		$data=$rs->fetch();		

	
?>


<link href="<?=$_url['css']?>style.css" rel="stylesheet" type="text/css">

<table border="1" cellpadding="6" cellspacing="0" width="530" align="center">
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
	<?=$today_year?>년<?=$today_month?>월<?=$today_date?>일 <?=$today_woe?>요일 전체 주요 일정</b></td>
  </tr>
</table>
<br>
<form name="online_form" method="post" action="today_work_edit_ok.php" onSubmit="return validate(this)" enctype="multipart/form-data">
<input type="hidden" name="mode" value="<?=$mode?>" />
<input type="hidden" name="regi_date" value="<?=$book?>" />
<input type="hidden" name="c_no" value="<?=$data[c_no]?>" />
<table border="1" cellpadding="0" cellspacing="0" width="530" align="center">
	
	<tr height="22">
		<td width="60" align="center" bgcolor="#EFEFEF"><font color="#525252"><strong>전체<br>주요일정</strong></font></td>
		<td colspan="3">&nbsp;<textarea name="today_work" cols=75  rows=10 class=textarea><?=$data[today_work]?></textarea></td>
	</tr>		
</table>
<br>
<table width="450" border="0" align="center">
	<tr>
		<td align="center">
			<?if($mode == "modify"){?>
			<input type="submit" value=" 수 정 " class="button">
			<?}else{?>
			<input type="submit" value=" 등 록 " class="button">
			<?}?>
		</td>
	</tr>
</table>
</form>