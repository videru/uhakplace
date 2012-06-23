<?
/* =====================================================

  최종수정일 : 
 ===================================================== */
	include_once("../include/lib.php");
	require_once("admin_chk.php");

    $now = time() ;

       
    $now_date1 = date("Y");
    $now_date2 = date("m");
    $now_date3 = date("d");


    $now_imsi_date = mktime(0,0,0,$now_date2+2,31,$now_date1);

	$rs_to = new $rs_class($dbcon);
	$rs_to->clear();
	$rs_to->set_table($_table['regi']);
	//$rs_to->add_where("airpoet_date1 = $now_date1"); 
	$rs_to->add_where("airpoet_date_int >= $now and airpoet_date_int <= $now_imsi_date"); 
	$rs_to->add_order("airpoet_date1 ASC, airpoet_date2 ASC, airpoet_date3 ASC");

	$page_info=$rs_to->select_list($page,5,10);
?>	

<? include("_header.php"); ?>
<table border="0" cellspacing="0" cellpadding="0" width="800" align="center">
   <tr>
     <td class="a_sub_title">예상 출국일 알림</td>
   </tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" width="800" align=center bgcolor="#FFFFFF">
    <tr>  
     <td>
  <table border="0" cellpadding="0" cellspacing="0" width="800" align=center>
	<tr>
		<td bgcolor="#666666" height="2"></td>
	</tr> 
	<tr>
		<td bgcolor="#FFFFFF" height="8"></td>
	</tr> 
  </table>
<table width="770" border="0" cellspacing="0" cellpadding="0"  align=center>
	<tr bgcolor="#456285" height="25">
    <td width="40" align="center" class="tt6">NO</td>
	<td width="35" align="center" class="tt6">수정</td>
	<td width="45" align="center" class="tt6">이름</td>
	<td width="45" align="center" class="tt6">담당자</td>
	<td width="165" align="center" class="tt6">경로</td>
	<td width="65" align="center" class="tt6">상담일</td> 
	<td width="65" align="center" class="tt6">등록일</td>
	<td width="60" align="center" class="tt6">출국일</td>
	<td width="110" align="center" class="tt6">국가</td>
	<td width="50" align="center" class="tt6">기간</td>
	<td width="90" align="center" class="tt6">연락처</td>
	</tr>

<?
	if($rs_to->num_rows()<1) {
		echo "
	<tr height=\"50\">
		<td align=\"center\" colspan=\"12\"><B>등록(검색) 된 자료가 없습니다.</td>
	</tr>
	<tr>
		<td bgcolor=\"#BECCDD\" height=\"1\" colspan=\"10\"></td>
	</tr>		
	";
	}
	
	$no = $page_info['start_no'];
	while($R=$rs_to->fetch()) {
		
	$no--;	

    if($now_date2 == 10){

if($R[airpoet_date2] ==  $now_date2){
	$mon= "mon_0";
}elseif($R[airpoet_date2] ==  $now_date2+1){
	$mon= "mon_1";
}elseif($R[airpoet_date2] ==  $now_date2+2){
	$mon= "mon_2";
}elseif($R[airpoet_date2] ==  1){
	$mon= "mon_3";
}

	}elseif($now_date2 == 11){

if($R[airpoet_date2] ==  $now_date2){
	$mon= "mon_0";
}elseif($R[airpoet_date2] ==  $now_date2+1){
	$mon= "mon_1";
}elseif($R[airpoet_date2] ==  1){
	$mon= "mon_2";
}elseif($R[airpoet_date2] ==  2){
	$mon= "mon_3";
}

	}elseif($now_date2 == 12){

if($R[airpoet_date2] ==  $now_date2){
	$mon= "mon_0";
}elseif($R[airpoet_date2] ==  1){
	$mon= "mon_1";
}elseif($R[airpoet_date2] ==  2){
	$mon= "mon_2";
}elseif($R[airpoet_date2] ==  3){
	$mon= "mon_3";
}


	}else{

if($R[airpoet_date2] ==  $now_date2){
	$mon= "mon_0";
}elseif($R[airpoet_date2] ==  $now_date2+1){
	$mon= "mon_1";
}elseif($R[airpoet_date2] ==  $now_date2+2){
	$mon= "mon_2";
}elseif($R[airpoet_date2] ==  $now_date2+3){
	$mon= "mon_3";
}

	}


   if($R[national2_check] == 1){
     $national = $R[national2];
     $two = "<font color=red>[연계]</font>";
   }else{
     $national = $R[national];
     $two = "";
   }

        $rs_na = new $rs_class($dbcon);
	    $rs_na->clear();
	    $rs_na->set_table($_table['member']);
        $rs_na->add_where("mb_num = $R[consult]");	
        $name=$rs_na->fetch();

?>
	<tr>
	<tr height="25">
    <td align="center" class="tt4_c"><?=$no?></td>
	<td align="center" class="tt4_c"><a href="regi_edit.php?<?=$p_str?>&page=<?=$page?>&mode=modify&num=<?=$R[regi_no]?>&year=<?=$year?>&month=<?=$month?>" target="_parent"><img src=images/sbt_modify.gif border="0"></a></td>
	<td align="center" class="tt4_c"><?=$R[student_name]?></td>	     
	<td align="center" class="tt4_c"><?=$name[mb_name]?></td>
    <td align="center" class="tt4_c"><?=$_const['root'][$R['rgi_type']]?></td>
    <td align="center" class="tt4_c"><?=$R[regi_date1]?>.<?=$R[regi_date2]?>.<?=$R[regi_date3]?></td>	
    <td align="center" class="tt4_c"><?=$R[abroad_date1]?>.<?=$R[abroad_date2]?>.<?=$R[abroad_date3]?></td>	
	<td align="center" class="tt5"><a href="regi_edit.php?<?=$p_str?>&page=<?=$page?>&mode=modify&num=<?=$R[regi_no]?>" target="_parent"><img src="./images/<?=$mon?>.gif" border="0" align="absmiddle"> </a></td>
    <td align="center" class="tt4_c"><img src="./images/main_real_national<?=$national?>.gif">&nbsp;<?=$_const['national'][$national]?><?=$two?></td>
 	<td class="tt4_c"><?=$R[study_gigan]?><?if($R[study_gigan2]>0){?>(+<?=$R[study_gigan2]?>)<?}?>주</td>   
	<td align="center" class="tt4_c"><?=$R[tel]?></td>	
	</tr>
	<tr>
		<td bgcolor="#BECCDD" height="1" colspan="13"></td>
	</tr>
<?
	}
?>
	<tr>
		<td height="8" colspan="13"></td>
	</tr>	
	<tr>
		<td align="center"  colspan="13"><?=rg_navi_display($page_info,$_get_param[2]); ?></td>
	</tr>
</table>
  <table border="0" cellpadding="0" cellspacing="0" width="800" align=center>
	<tr>
		<td bgcolor="#FFFFFF" height="8"></td>
	</tr> 	
	<tr>
		<td bgcolor="#666666" height="2"></td>
	</tr> 
  </table>

  </td>
  </tr>
</table>
<? include("_footer.php"); ?>