<? 
include_once("../include/lib.php");
if(!$num){
$num ="0";
}

	$rs->clear();
	$rs->set_table($_table['school_cost']);
	if($num){
	$rs->add_where("sc_no=$num");
    }
	$rs->select();
	$R=$rs->fetch();		


?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<title>필리핀 전문 포탈 유학플레이스</title>
<link href="<?=$_url['css']?>style.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/JavaScript">
<!--		              

function citychange(ct) {
  if (ct.value == "") {    
  }
  else  {
	location.href = "?school_area="+ct.value;
  }
}

function schoolchange(st) {
  if (st.value == "") {    
  }
  else  {
	location.href = "?school_area=<?=$school_area?>&num="+st.value;
  }
}
//-->
</script> 
</head>
 <body>
<table border="0" cellpadding="1" cellspacing="1"  width="410"  align="center" bgcolor="#CCCCCC">	
	 <tr bgcolor="#FFFFFF">
		<td width="55" align="center" bgcolor="#F0F0F4"><strong>도시</strong></td>
		<td width="130">&nbsp;<select name="school_area" class="select2" onchange="citychange(this);">
             <option>==도시선택==</option>
		<?=rg_html_option($_const['area3'],$school_area)?>
        </select>
		</td>
		<td width="80" align="center" bgcolor="#F0F0F4"><strong>학교이름</strong>
		</td>
		<td>&nbsp;<select name="num" class="select" onchange="schoolchange(this);">
     <option>==학교선택==</option>
<? 

    $rs_list = new $rs_class($dbcon);
	$rs_list->clear();
	$rs_list->set_table($_table['school']);
	$rs_list->add_where("national = '3'"); 
	$rs_list->add_where("area = $school_area"); 	 
	 
     while($data=$rs_list->fetch()) {
	 
       $Sg_idx   = $data[num];
       $Sg_title = $data[s_title];
?>
    <option value="<?=$Sg_idx?>" <?if ($num==$Sg_idx) { ?>selected<?}?>><?=$Sg_title?></option>
<?     } ?>
  </select>
		</td>    
	 </tr>
	</table>	 
	<br>
<?

		$rs->clear();
		$rs->set_table($_table['school_cost']);
		if($num){
		$rs->add_where("sc_no=$num");
        }
		$rs->select();
		$R=$rs->fetch();	

?>
<form  method="post" action="school_cost1.php" name=room_form onSubmit="return check_userinfo();"> 
<input type=hidden name='num' value = <?=$R[num]?>>	 
	 <table width="410" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td bgcolor="#939CAE" height="1"></td>
          </tr>  
  <tr>
    <td height="22" bgcolor="#f5f5f5" class="co_11_c">프로그램</td>
    <td bgcolor="#FFFFFF" style="padding: 0 0 0 4px"><select name="program_no" class="select">
      <option value="">== 프로그램 선택 ==</option>
      <? for ($k=1; $k<=12; $k++){?>      
	  <?if($R[pro_name.$k]){?>
      <option value="<?=$k?>" <?if ($k==$program_no) { ?>selected<?}?>>
      <?=$R[pro_name.$k]?>
      </option>
      <?}}?> 
    </select></td>
  </tr>
  <tr>
    <td height="22" bgcolor="#f5f5f5" class="co_11_c">기숙사</td>
    <td bgcolor="#FFFFFF" style="padding: 0 0 0 4px"><select name="dorm_no" class="select2">
      <option value="">== 숙소 선택 ==</option>
      <? for ($d=1; $d<=12; $d++){?>    
	  <?if($R[dorm_name.$d]){?>
      <option value="<?=$d?>" <?if ($d==$dorm_no) { ?>selected<?}?>>
      <?=$R[dorm_name.$d]?>
      </option>
      <?}}?>
    </select></td>
  </tr>
  <tr>
    <td height="22" bgcolor="#f5f5f5" class="co_11_c">연수기간</td>
    <td bgcolor="#FFFFFF" style="padding: 0 0 0 4px"><select name="week" class="select3">
      <option value="">== 연수기간 선택 ==</option>
      <option value="4" <?if (4==$week) { ?>selected<?}?>>4주</option>
      <option value="8" <?if (8==$week) { ?>selected<?}?>>8주</option>
      <option value="12" <?if (12==$week) { ?>selected<?}?>>12주</option>
      <option value="16" <?if (16==$week) { ?>selected<?}?>>16주</option>
      <option value="20" <?if (20==$week) { ?>selected<?}?>>20주</option>
      <option value="24" <?if (24==$week) { ?>selected<?}?>>24주</option>
    </select></td>
  </tr>
          <tr> 
            <td bgcolor="#939CAE" height="1"></td>
          </tr>
         <tr> 
            <td bgcolor="#FFFFFF" height="10"></td>
          </tr>
			<tr height="30"> 
              <td align="center"><input type="submit" value="연수비용 견적" class="button">	 
  
			  </td>
          </tr>
		  </table>
</form>
</body>
</html>