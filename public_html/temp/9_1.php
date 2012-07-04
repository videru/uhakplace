<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title>필리핀 전문 포털 필사과</title>


<?
$bbs_code="mtm";
	include_once("../include/lib.php");

	if($_SERVER['REQUEST_METHOD']=='POST') {

			$rs->clear();
	    	$rs->set_table($_table['consult']);			
			$rs->add_field("process","1");	
	    	$rs->add_field("name","$name");	
	    	$rs->add_field("email","$email");	

	    	$rs->add_field("tel","$tel");	
	    	$rs->add_field("hp","$hp");	
	    	$rs->add_field("etc_memo","$etc_memo");	
	    	$rs->add_field("reg_date",time());	

			$rs->insert();


			$rs->commit();
	
		    rg_href("../phil/index_new.php","상담 문의가 접수되었습니다.");

	}


?>
<script language="JavaScript">


<!--
	function send(){		
      document.member_form.submit();
}
//-->
</script>

</head>

<body>
<div><? include_once('./top.php'); ?></div>
<div style="height:52px"></div>
<table width="980" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="223" valign="top"><embed src="../n_img/left_08.swf" width="223" height="400"></embed></td>
    <td width="37">&nbsp;</td>
    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><img src="../n_img/9_1.jpg" width="720" height="250" /></td>
      </tr>
      <tr>
        <td>
        	  	<form name="member_form" method="post" action="?"
								onsubmit="return validate(this)" enctype='multipart/form-data'>
								<table width="692" cellpadding="0" cellspacing="0"
									align="center">


									<tr>
										<td><img src="../img/online/online_table_top.gif">
										
										</td>
									</tr>
									<tr>
										<td background="../img/online/online_table_bg.gif">
											<table width="660" cellpadding="0" cellspacing="0"
												align="center">
												<tr>
													<td colspan="2" height="1"><img
														src="../img/online/online_table_line.gif">
													
													</td>
												</tr>
												<tr>
													<td width="120" bgcolor="#f8f8f8" height="40">&nbsp;&nbsp;<img
														src="../img/online/name.gif">
													
													</td>
													<td bgcolor="#ffffff" style="padding: 5px 5px 5px 5px"><input
														name="name" type="text" class="input" size="20">
													
													</td>
												</tr>
												<tr>
													<td colspan="2" height="1"><img
														src="../img/online/online_table_line.gif">
													
													</td>
												</tr>
												<tr>
													<td bgcolor="#f8f8f8" height="40">&nbsp;&nbsp;<img
														src="../img/online/tel2.gif">
													
													</td>
													<td bgcolor="#ffffff" style="padding: 5px 5px 5px 5px"><input
														name="tel" type="text" class="input" size="20">
													
													</td>
												</tr>
												<tr>
													<td colspan="2" height="1"><img
														src="../img/online/online_table_line.gif">
													
													</td>
												</tr>
												<tr>
													<td bgcolor="#f8f8f8" height="40">&nbsp;&nbsp;<img
														src="../img/online/hp2.gif">
													
													</td>
													<td bgcolor="#ffffff" style="padding: 5px 5px 5px 5px"><input
														name="hp" type="text" class="input" size="20">
													
													</td>
												</tr>
												<tr>
													<td colspan="2" height="1"><img
														src="../img/online/online_table_line.gif">
													
													</td>
												</tr>
												<tr>
													<td bgcolor="#f8f8f8" height="40">&nbsp;&nbsp;<img
														src="../img/online/email.gif">
													
													</td>
													<td bgcolor="#ffffff" style="padding: 5px 5px 5px 5px"><input
														name="email" type="text" class="input" size="20">
													
													</td>
												</tr>
												<tr>
													<td colspan="2" height="1"><img
														src="../img/online/online_table_line.gif">
													
													</td>
												</tr>
												<tr>
													<td bgcolor="#f8f8f8">&nbsp;&nbsp;<img
														src="../img/online/text.gif">
													
													</td>
													<td bgcolor="#ffffff" style="padding: 10px 0 0 5px"><textarea
															name="etc_memo" cols="80" rows="20"></textarea>
													</td>
												</tr>
												</td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td><img src="../img/online/online_table_bottom.gif">
										
										</td>
									</tr>
									<tr>
										<td height="20"></td>
									</tr>
									<tr>
										<td align="center"><a href="javascript:send()"
											onFocus="this.blur()"><img src="../img/btn_regi.gif"
												border="0">
										
										</a>&nbsp;&nbsp;&nbsp;<a href="#" onFocus="this.blur()"><img
												src="../img/btn_cancel.gif" border="0"
												onClick="history.back();">
										
										</a>
										</td>
									</tr>
								</table>

							</form>
						</td>
      </tr>
    </table></td>
  </tr>
</table>
<div><? include_once('./footer.php'); ?></div>
</body>
</html>



