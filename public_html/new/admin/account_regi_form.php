<?
	include_once("../include/lib.php");
	require_once("admin_chk.php");
	
	if ($date3=="") {
		$date3=date("d");
	}

?>	
<html>
<head>
<title>�������</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link href="<?=$_url['css']?>style.css" rel="stylesheet" type="text/css">
</head>
<body bottommargin="0" topmargin="0" leftmargin="0" rightmargin="0">
<table width="400" border="0" bgcolor="#CCCCCC" align="center" cellpadding="1" cellspacing="1">
 <tr bgcolor="#F7F7F7"> 
    <td height="30" colspan="2" align="center">����� ���� ����</td>
  </tr>
</table><br>
<table width="400" border="0" cellpadding="1" cellspacing="1" align="center" bgcolor="#CCCCCC">
  <form  method="post" action="account_regi_ok.php" name=account_form> 

  <input type=hidden name='date1' value = <?=$date1?>>
  <input type=hidden name='date2' value = <?=$date2?>>
   <tr bgcolor="#F7F7F7"> 
    <td width="30%" height="26" align="center">����</td>
    <td width="70%" height="26" bgcolor="white">&nbsp;<input type="text" name="paid1" class="input" value="<?=$date1?>" size="4" maxlength="4">��<input type="text" name="paid2" value="<?=$date2?>" class="input" size="2" maxlength="2">��<input type="text" name="paid3" value="<?=$date3?>" class="input" size="2" maxlength="2">��</td>
  </tr>
  <tr bgcolor="#F7F7F7"> 
    <td height="26" align="center">����</td>
    <td height="26" bgcolor="white">&nbsp;<select name="chain">                      
                      <option value="1">����</option>
                      <option value="2">�λ�</option>
                    </select>
	 </td>
  </tr>
   <tr bgcolor="#F7F7F7"> 
    <td height="26" align="center">����ݳ���</td>
    <td height="26" bgcolor="white">&nbsp;<select name="comm_text_no">

   					<option value=" ">==����==</option>     
              <? 
      
	$rs_list = new $rs_class($dbcon);
	$rs_list->clear();
	$rs_list->set_table($_table['account_kyejung']);
	$rs_list->add_order("kyejung_code ASC");	
	while($R=$rs_list->fetch()) {	
		
         $ky_idx   = $R[kyejung_code];
		 $ky_title = $R[kyejung_name];
?>					
					<option value="<?=$ky_idx?>"><?=$ky_title?></option>
<?     } ?>
                    </select>
	 </td>
  </tr> 
<tr bgcolor="#F7F7F7"> 
    <td height="26" align="center">�л��̸�</td>
    <td height="26" bgcolor="white">&nbsp;<select name="student_no"><option value=" ">==����==</option>     
              <? 
      
    $rs_list = new $rs_class($dbcon);
	$rs_list->clear();
	$rs_list->set_table($_table['regi']);
	$rs_list->add_order("student_name ASC");
	while($R=$rs_list->fetch()) {	
		
         $Sg_idx   = $R[regi_no];
		 $Sg_title = $R[student_name];
?>					
					<option value="<?=$Sg_idx?>"><?=$Sg_title?></option>
<?     } ?>
                    </select> *�л� ���� ��쿡�� üũ
	 </td>
  </tr>  
  <tr bgcolor="#F7F7F7"> 
    <td height="26" align="center">����ݿ���</td>
    <td height="26" bgcolor="white">&nbsp;<select name="in_out_comm">                      
                      <option value="1">�Ա�</option>
                      <option value="2">���</option>
                    </select>
	 </td>
  </tr>

   <tr bgcolor="#F7F7F7"> 
    <td height="26" align="center">�ݾ�</td>
    <td height="26" bgcolor="white">&nbsp;\<input type="text" name="comm" class="input" size="10" maxlength="20">
	 </td>
  </tr>
   <tr bgcolor="#F7F7F7"> 
    <td height="26" align="center">���</td>
    <td height="26" bgcolor="white">&nbsp;<input type="text" name="etc" class="input" size="40" maxlength="50">
	 </td>
  </tr>
<tr>
<td colspan=2 height="50" align="center" bgcolor="white"><input type="submit" name="Submit" value="Submit"></td>
</tr>
</form>
</table>
</body>
</html>