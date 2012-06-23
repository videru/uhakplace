<?
	include_once("../include/lib.php");
?>
<html>
<head>
<title>필리핀 전문 포털 필사과</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link href="<?=$_url['css']?>style.css" rel="stylesheet" type="text/css">
<script src="<?=$_url['js']?>common.js"></script>
<script src="<?=$_url['js']?>lib.validate.js"></script>
<script src="<?=$_url['js']?>flash.js"></script>
</head>
<body bottommargin="0" topmargin="10" leftmargin="0" rightmargin="0">
<form name="regi_form" method="post" action="online_ok.php" onSubmit="return validate(this)" enctype="multipart/form-data">
<table border="0" cellpadding="0" cellspacing="0" width="450">
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>		
	<tr>
		<td width="110" bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">이름</td>
		<td colspan="2"><input name="student_name" type="text" value="<?=$data['student_name']?>" class="cc" size=10></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">회원ID</td>
		<td colspan="2"><input name="mb_id" type="text" value="<?=$data['mb_id']?>" class="cc" size=10></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">이메일</td>
		<td colspan="2"><input name="email" type="text" value="<?=$data['email']?>" class="cc" size=33></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">전화번호</td>
		<td colspan="2"><input name="tel" type="text" value="<?=$data['tel']?>" class="cc" size=33></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">담당지사</td>
		<td colspan="2"><select name="chain" class="select">
<?=rg_html_option($_regi['chain'],$data['chain'])?>
		</select></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">국가</td>
		<td colspan="2"><select name="national" class="select2">
<?=rg_html_option($_const['national'],$national)?>
		</select></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">등록학교</td>
		<td colspan="2"><input name="title" type="text" value="<?=$data['title']?>" class="cc" size=50></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">등록기간</td>
		<td colspan="2"><input name="study_gigan" type="text" value="<?=$data['study_gigan']?>" class="cc" size=4>주</td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">상담사항</td>
		<td ><textarea name="etc" style="width:97%;" rows="6" class="cc"><?=$data['etc']?></textarea></td>
    </tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	    
</table>
<br>
<table width="200" border="0"  align=center>
	<tr>
		<td width="100" align="center"><INPUT onfocus=this.blur() type=image src="../img/btn_regi.gif"></td>
		<td width="100" align="center"><input type=image src="../img/btn_cancel.gif" onClick="history.back();" ></td>
	</tr>
</table>
</form>
</body>
</html>
<? include($_path['counter']."counter.php"); ?>