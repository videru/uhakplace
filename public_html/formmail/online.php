<?
	include_once("../include/lib.php");

	if($_SERVER['REQUEST_METHOD']=='POST') {

			$rs->clear();
	    	$rs->set_table($_table['cafe_online']);			
			$rs->add_field("process","1");	
	    	$rs->add_field("name","$name");	
	    	$rs->add_field("email","$email");	

	    	$rs->add_field("tel","$tel");	
	    	$rs->add_field("hp","$hp");	
	    	$rs->add_field("etc_memo","$etc_memo");	

	    	$rs->add_field("e1","$e1");	
	    	$rs->add_field("p4","$p4");	
	    	$rs->add_field("p1","$p1");	
	    	$rs->add_field("p2","$p2");	
	    	$rs->add_field("p3","$p3");	

	    	$rs->add_field("reg_date",time());	

			$rs->insert();


			$rs->commit();
	
	 echo "<center><font color=blue>온라인 상담 신청이 성공적으로 접수되었습니다.
		<script language=javascript>
			setTimeout('window.close()', 3000);
		</script>
			";
		exit;

	}


?>
<script language="JavaScript">


<!--
	function send(){		
      document.member_form.submit();
}
//-->
</script>



<html>

<head>
<title>온라인 상담신청</title>
<meta name="generator" content="Namo WebEditor v6.0">
<style>
<!--
a:link { text-decoration:none; }
a:visited { text-decoration:none; }
a:active { text-decoration:none; }
a:hover { text-decoration:none; }
-->
</style>
</head>

<body bgcolor="white" text="black" link="blue" vlink="purple" alink="red" leftmargin="0" marginwidth="0" topmargin="0" marginheight="0">
<form name="contactus" method="post" action="?" onsubmit="return validate(this)" enctype='multipart/form-data'>
   	<table border="0" cellspacing="0" width="500" align="center">
      <tr>
        <td ><img src="http://uhakplace.co.kr/formmail/img/online_popup_title.gif"></td>
     </tr> 
      <tr>
        <td height="12" ></td>
     </tr> 	 
   	</table>
	<table border="0" cellspacing="1" width="500" bgcolor="#cccccc" align="center">
      <tr>
        <td width="100" bgcolor="#e2e2e2" align="center" height="25" ><span style="font-size:10pt;"><font face="돋움" color="black">이름</font></span></td>
        <td  bgcolor="#FFFFFF">&nbsp;<input type=text  size="20" name="name" style="border-width:1; border-color:ccc; border-style:solid;" maxlength="10"></td>
    </tr>
    <tr>
       <td bgcolor="#e2e2e2" align="center" height="25" ><span style="font-size:10pt;"><font face="돋움" color="black">E - Mail</font></td>
       <td bgcolor="#FFFFFF">&nbsp;<input type=text size="20" name="email" style="border-width:1; border-color:ccc; border-style:solid;" maxlength="50"></td>
    </tr>
	<tr>
      <td bgcolor="#e2e2e2" align="center" height="25" ><span style="font-size:10pt;"><font face="돋움" color="black">연락처</font></span></td>
      <td bgcolor="#FFFFFF">&nbsp;<input type=text size="20" name="hp" style="border-width:1; border-color:ccc; border-style:solid;" maxlength="50"></td>
    </tr>
	<tr>
      <td bgcolor="#e2e2e2" align="center" height="25" ><span style="font-size:10pt;"><font face="돋움" color="black">연수희망과정</font></span></td>
      <td bgcolor="#FFFFFF"><span style="font-size:10pt;"><font face="돋움" color="black"><input type="radio" name="e1" value="1">필리핀어학연수 <br><input type="radio" name="e1" value="2">필리핀+연계연수(호주, 뉴질랜드, 영국, 캐나다)  <br><input type="radio" name="e1" value="3">호주, 뉴질랜드, 영국, 캐나다</font></span></td>
    </tr>
	<tr>
      <td bgcolor="#e2e2e2" align="center" height="25" ><span style="font-size:10pt;"><font face="돋움" color="black">연수기간</font></span></td>
      <td bgcolor="#FFFFFF">&nbsp;<select name="p4" size="1">
				        <option>==== 선택====</option>
				        <option value="1">3개월이하</option>
				        <option value="2">3개월~6개월</option>
				        <option value="3">6개월~12개월</option>
                <option value="4">12개월이상</option>
			            </select></td>
    </tr>
	<tr>
      <td bgcolor="#e2e2e2" align="center" height="25" ><span style="font-size:10pt;"><font face="돋움" color="black">예상출국시기</font></span></td>
      <td bgcolor="#FFFFFF">&nbsp;<span style="font-size:10pt;"><font face="돋움" color="black"><select name="p1" size="1">
			                <option value="2009">2009</option>
			                <option value="2010">2010</option>
                    <option value="2011">2011</option>
                    <option value="2012">2012</option>
                    <option value="2013">2013</option>
                    <option value="2014">2014</option>
                    <option value="2015">2015</option>
			            </select>년
				    <select name="p2" size="1">
				        <option value="1">1</option>
				        <option value="2">2</option>
				        <option value="3">3</option>
				        <option value="4">4</option>
				        <option value="5">5</option>
				        <option value="6">6</option>
				        <option value="7">7</option>
				        <option value="8">8</option>
				        <option value="9">9</option>
				        <option value="10">10</option>
				        <option value="11">11</option>
				        <option value="12">12</option>
			            </select>월
				    <select name="p3" size="1">
			                <option value="1">1</option>
			                <option value="2">2</option>
			                <option value="3">3</option>
			                <option value="4">4</option>
			                <option value="5">5</option>
			                <option value="6">6</option>
			                <option value="7">7</option>
			                <option value="8">8</option>
			                <option value="9">9</option>
			                <option value="10">10</option>
			                <option value="11">11</option>
			                <option value="12">12</option>
			                <option value="13">13</option>
			                <option value="14">14</option>
			                <option value="15">15</option>
			                <option value="16">16</option>
			                <option value="17">17</option>
			                <option value="18">18</option>
			                <option value="19">19</option>
			                <option value="20">20</option>
			                <option value="21">21</option>
			                <option value="22">22</option>
			                <option value="23">23</option>
			                <option value="24">24</option>
			                <option value="25">25</option>
			                <option value="26">26</option>
			                <option value="27">27</option>
			                <option value="28">28</option>
			                <option value="29">29</option>
			                <option value="30">30</option>
			                <option value="31">31</option>
			            </select>일 </font></span>
</td>
    </tr>

    <tr>
      <td bgcolor="#e2e2e2" align="center" height="25" ><span style="font-size:10pt;"><font face="돋움" color="black">기타하실말씀</font></span></td>
	  <td  height="132" bgcolor="#FFFFFF">&nbsp;<font face="돋움" color="black"><textarea name="etc_memo" rows="9" cols="50" style="border-width:1; border-color:ccc; border-style:solid;"></textarea></td>
    </tr>
    <tr height="45" >
      <td colspan="2" bgcolor="#FFFFFF" align="center"><input type="submit" value="    저장    " style="font-size:9pt; color:blue; background-color:rgb(225,226,252); border-width:1; border-color:blue; border-style:solid; height:18;" name="send">&nbsp;
	    <input type="reset" value="다시 쓰기" style="font-size:9pt; color:blue; background-color:rgb(231,227,255); border-width:1; border-color:blue; border-style:solid; height:18;" name="reset"></td>
</font>   

</tr>
</table>
</form>
</body>

</html>
