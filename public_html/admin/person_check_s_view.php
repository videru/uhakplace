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

<table border="0" cellpadding="0" cellspacing="0" width="580" align="center">	
	
	<tr height="60">
		<td width="50" align="center" bgcolor="#EFEFEF"><font color="#525252"><strong>주요<br>업무</strong></font></td>
		<td style='padding:5px;'><?=rg_conv_text($data[working_title])?></td>
	</tr>	
  <tr>
    <td height="1" colspan="2" bgcolor="#A6CEE9"></td>
  </tr>  	
	<tr height="60">
		<td align="center" bgcolor="#EFEFEF"><font color="#525252"><strong>오전<br>업무</strong></font></td>
		<td style='padding:5px;'><?=rg_conv_text($data[morning_work_text])?></td>
	</tr>	
  <tr>
    <td height="1" colspan="2" bgcolor="#A6CEE9"></td>
  </tr>  	
	<tr height="60">
		<td align="center" bgcolor="#EFEFEF"><font color="#525252"><strong>오후<br>업무</strong></font></td>
		<td style='padding:5px;'><?=rg_conv_text($data[afternoon_work_text])?></td>
	</tr>
  <tr>
    <td height="1" colspan="2" bgcolor="#A6CEE9"></td>
  </tr>  
	<tr height="60">
		<td align="center" bgcolor="#EFEFEF"><font color="#525252"><strong>내일<br>업무</strong></font></td>
		<td style='padding:5px;'><?=rg_conv_text($data[tomorrow_work_text])?></td>
	</tr>	
  <tr>
    <td height="1" colspan="2" bgcolor="#A6CEE9"></td>
  </tr>  
	<tr height="60">
		<td align="center" bgcolor="#EFEFEF"><font color="#525252"><strong>건의<br>사항</strong></font></td>
		<td  style='padding:5px;'><?=rg_conv_text($data[etc_work_text])?></td>
	</tr>
  <tr>
    <td height="2" colspan="2" bgcolor="#A6CEE9"></td>
  </tr>  
</table>
<br>
<form name="online_form" method="post" action="person_admin_edit_ok.php?<?=$_get_param[3]?>" onSubmit="return validate(this)" enctype="multipart/form-data">
<input type="hidden" name="mode" value="<?=$mode?>" />
<input type="hidden" name="page" value="<?=$page?>" />
<input type="hidden" name="c_no" value="<?=$c_no?>" />
<table border="1" cellpadding="0" cellspacing="0" width="580" align="center">
	<tr height="22">
		<td width="90" align="center" bgcolor="#EFEFEF"><font color="#525252"><strong>대표이사<br>전달사항</strong></font></td>
		<td>&nbsp;<textarea name="admin_comment" cols=70  rows=4  class=textarea><?=$data[admin_comment]?></textarea></td>
		<td align="center"><input type="submit" value=" 수 정 " class="button">
		</td>
	</tr>
</table>
</form>