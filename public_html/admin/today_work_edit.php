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
		if($rs->num_rows()==1) { // ������ �ùٸ��� �ʴٸ�
		
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
    $today_woe ="��";
  }elseif($today_woe ==2){
    $today_woe ="ȭ";
  }elseif($today_woe ==3){
    $today_woe ="��";
  }elseif($today_woe ==4){
    $today_woe ="��";
  }elseif($today_woe ==5){
    $today_woe ="��";
  }elseif($today_woe ==6){
    $today_woe ="��";
  }elseif($today_woe ==0){
    $today_woe ="��";
  }
	?>
	<?=$today_year?>��<?=$today_month?>��<?=$today_date?>�� <?=$today_woe?>���� ��ü �ֿ� ����</b></td>
  </tr>
</table>
<br>
<form name="online_form" method="post" action="today_work_edit_ok.php" onSubmit="return validate(this)" enctype="multipart/form-data">
<input type="hidden" name="mode" value="<?=$mode?>" />
<input type="hidden" name="regi_date" value="<?=$book?>" />
<input type="hidden" name="c_no" value="<?=$data[c_no]?>" />
<table border="1" cellpadding="0" cellspacing="0" width="530" align="center">
	
	<tr height="22">
		<td width="60" align="center" bgcolor="#EFEFEF"><font color="#525252"><strong>��ü<br>�ֿ�����</strong></font></td>
		<td colspan="3">&nbsp;<textarea name="today_work" cols=75  rows=10 class=textarea><?=$data[today_work]?></textarea></td>
	</tr>		
</table>
<br>
<table width="450" border="0" align="center">
	<tr>
		<td align="center">
			<?if($mode == "modify"){?>
			<input type="submit" value=" �� �� " class="button">
			<?}else{?>
			<input type="submit" value=" �� �� " class="button">
			<?}?>
		</td>
	</tr>
</table>
</form>