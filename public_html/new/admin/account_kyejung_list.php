<?
	include_once("../include/lib.php");
	require_once("admin_chk.php");
	
	$rs_list = new $rs_class($dbcon);
	$rs_list->clear();
	$rs_list->set_table($_table['account_kyejung']);
	$rs_list->add_order("kyejung_code");
?>
<html>
<head>
<title>�������</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link href="<?=$_url['css']?>style.css" rel="stylesheet" type="text/css">
</head>
<body bottommargin="0" topmargin="0" leftmargin="0" rightmargin="0">
<table width="480" align="center" border="0" bgcolor="#CCCCCC" align="center" cellpadding="1" cellspacing="1">
    <tr height="30" align="center" bgcolor="#F7F7F7">        
    <td><b>����� ���� ����</b></td>
	</tr>
</table>
<br>

 <table width="480" border="0" bgcolor="#CCCCCC" align="center" cellpadding="1" cellspacing="1">
         <form name=form_comment method=post action='account_kyejung_ok.php' autocomplete=off> 
				<tr height="30" bgcolor="white">
                  <td colspan="3">&nbsp;&nbsp;<b>����� ����</b></td>
                </tr>
				<tr height="25" bgcolor="#F7F7F7">                  
				  <td align="center">����� ����</td>
                   <td align="center" width="60" >CODE</td>
				  <td align="center" width="70" >���</td>
                </tr>
                <tr height="25" bgcolor="white">              
				  <td >&nbsp;<input type="text" name="kyejung_name" class="input"  size="50" maxlength="50"></td>
                  <td align="center"><input type="text" name="kyejung_code" class="input"  size="3" maxlength="3"></td>
                  <td align="center"><input type="submit" class="submit2" value="���"></td>
				</tr>		                 
</form>
	    </table> 
		<table width="480" border="0" bgcolor="#CCCCCC" align="center" cellpadding="1" cellspacing="1">
      <tr bgcolor="white">
                  <td colspan="3" height="30">&nbsp;&nbsp;<b>����� ���� ����Ʈ</b></td>
                </tr>
				<tr height="25" bgcolor="#F7F7F7">
                 
				  <td align="center">����� ����</td>
                  <td align="center" width="60">CODE</td>
				  <td align="center" width="70">����&nbsp;|&nbsp;����</td>
                </tr>
<?
		if($rs_list->num_rows()<1) {
		echo "
	<tr height=\"100\"  bgcolor=\"#FFFFFF\" >
		<td align=\"center\" colspan=\"3\"><B>���(�˻�) �� �ڷᰡ �����ϴ�.</td>
	</tr>";
	}
	
	$rs_list->set_table($_table['account_kyejung']);
	
	
	$no = $page_info['start_no'];
	while($R=$rs_list->fetch()) {
		$no--;

?>	
   <form name=form_comment method=post action='account_kyejung_ok.php' autocomplete=off> 
				 <input type="hidden" name="num" value="<?=$R[ak_no]?>">
				 <input type="hidden" name="mode" value="modify">	
	<tr height="25" bgcolor="white">            
				 <td >&nbsp;<input type="text" name="kyejung_name" value="<?=$R[kyejung_name]?>" class="input" size="50" maxlength="50"></td>
                  <td align="center" ><input type="text" name="kyejung_code" value="<?=$R[kyejung_code]?>" class="input" size="3" maxlength="3"></td>
				  <td align="center" ><input type="submit" class="submit2" value="����">&nbsp|&nbsp;<a href="account_kyejung_ok.php?mode=delete&num=<?=$R[ak_no]?>">����</a>
				  </td>
				</tr>
		     </form>      
<?
}
?>
	    </table> 	
</body>
</html>