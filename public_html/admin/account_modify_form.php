<?
	include_once("../include/lib.php");
	require_once("admin_chk.php");
	
   if($mode=='modify' || $mode=='delete') {
		$rs->clear();
		$rs->set_table(	$_table['account']);
		$rs->add_where("ac_no=$no");
		$rs->select();
		if($rs->num_rows()!=1) { // 정보가 올바르지 않다면
			rg_href('','정보를 찾을수 없습니다.','back');
		}
		$data=$rs->fetch();		
		
	} else {
		$data=$rs->fetch();		
	}


	   $comm_date3 = date("d", $data[comm_date]); 
?>	
<html>
<head>
<title>관리모드</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link href="<?=$_url['css']?>style.css" rel="stylesheet" type="text/css">
</head>
<body bottommargin="0" topmargin="0" leftmargin="0" rightmargin="0">
<table width="400" border="0" bgcolor="#CCCCCC" align="center" cellpadding="1" cellspacing="1">
 <tr bgcolor="#F7F7F7"> 
    <td height="30" colspan="2" align="center">입출금 내역 관리 수정</td>
  </tr>
</table><br>
<table width="400" border="0" cellpadding="1" cellspacing="1" align="center" bgcolor="#CCCCCC">
  <form  method="post" action="account_modify_ok.php" name=account_form> 
  <input type="hidden" name="no" value="<?=$no?>">	
  <input type="hidden" name="date1" value="<?=$date1?>">
   <input type="hidden" name="date2" value="<?=$date2?>"> 
   <tr bgcolor="#F7F7F7"> 
    <td width="30%" height="26" align="center">일자</td>
    <td width="70%" height="26" bgcolor="white">&nbsp;<input type="text" name="comm_date1" class="input" value="<?=$data[comm_date1]?>" size="4" maxlength="4">년<input type="text" name="comm_date2" value="<?=$data[comm_date2]?>" class="input" size="2" maxlength="2">월<input type="text" name="comm_date3" value="<?=$comm_date3?>" class="input" size="2" maxlength="2">일</td>
  </tr>
  <tr bgcolor="#F7F7F7"> 
    <td height="26" align="center">지사</td>
    <td height="26" bgcolor="white">&nbsp;<select name="chain">
<?=rg_html_option($_regi['chain'],$data['chain'])?>
		</select>
	 </td>
  </tr>
   <tr bgcolor="#F7F7F7"> 
    <td height="26" align="center">입출금내역</td>
    <td height="26" bgcolor="white">&nbsp;<select name="comm_text_no">

   					<option value=" ">==선택==</option>     
              <? 
      
    $rs_list = new $rs_class($dbcon);
	$rs_list->clear();
	$rs_list->set_table($_table['account_kyejung']);
	$rs_list->add_order("kyejung_code ASC");	
	while($R=$rs_list->fetch()) {	
		
         $ky_idx   = $R[kyejung_code];
		 $ky_title = $R[kyejung_name];
?>					
					<option value="<?=$ky_idx?>" <?if($ky_idx==$data['comm_text_no']) {echo "selected";} ?>><?=$ky_title?></option>
<?     } ?>
                    </select>
	 </td>
  </tr>  
  <tr bgcolor="#F7F7F7"> 
    <td height="26" align="center">입출금여부</td>
    <td height="26" bgcolor="white">&nbsp;<select name="in_out_comm">                      
                   <?=rg_html_option( $_const['in_out_comm'],$data['in_out_comm'])?></select> 
	 </td>
  </tr>
<tr bgcolor="#F7F7F7"> 
    <td height="26" align="center">학생이름</td>
    <td height="26" bgcolor="white">&nbsp;<select name="student_no"><option value=" ">==선택==</option>     
              <? 
      
	$rs_list = new $rs_class($dbcon);
	$rs_list->clear();
	$rs_list->set_table($_table['regi']);
	$rs_list->add_order("student_name ASC");
	while($R=$rs_list->fetch()) {	
		
         $Sg_idx   = $R[regi_no];
		 $Sg_title = $R[student_name];
?>					
					<option value="<?=$Sg_idx?>" <?if($Sg_idx==$data['student_no']) {echo "selected";} ?>><?=$Sg_title?></option>
<?     } ?>
                    </select> *학생 관련 경우에만 체크
	 </td>
  </tr>
   <tr bgcolor="#F7F7F7"> 
    <td height="26" align="center">금액</td>
    <td height="26" bgcolor="white">&nbsp;\<input type="text" name="comm" value="<?=$data[comm]?>" class="input" size="10" maxlength="20">
	 </td>
  </tr>
   <tr bgcolor="#F7F7F7"> 
    <td height="26" align="center">비고</td>
    <td height="26" bgcolor="white">&nbsp;<input type="text" name="etc" value="<?=$data[etc]?>"  class="input" size="40" maxlength="50">
	 </td>
  </tr>
<tr>
<td colspan=2 height="50" align="center" bgcolor="white"><input type="submit" name="Submit" value="Submit"></td>
</tr>
</form>
</table>
</body>
</html>