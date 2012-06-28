<?
	include_once("../include/lib.php");

    $ret_url = "../main/";

	if(!$_mb)
	{?>
	<script>
	(function(){
	 alert("로그인 하세요");
	 document.location = "http://uhakplace.co.kr/temp/login.html"; 
	})();
	</script>
		
		
	<?
	}
	else
	{
	//if(!$_mb)
	//	rg_href($_url['member'].'login.php?ret_url='.$ret_url);

    $rs_list = new $rs_class($dbcon);
	$rs_list->clear();
	$rs_list->set_table($_table['regi']);
	$rs_list->add_where("mb_id='$_mb[mb_id]'");
			
    /***********************************************************************/
   // 필터 조건에 의한 필터링

     if($out==1){ $rs_list->add_where("process_state < 10");	}

	 if($ss[0]){ $rs_list->add_where("process_state = $ss[0]"); } 
	 if($ss[1]){ $rs_list->add_where("national = $ss[1] or national2 = $ss[1]"); } 


	// 검색어로 검색
	if($kw) { $rs_list->add_where("student_name LIKE '%$kw%' escape '".$dbcon->escape_ch."'");} 
    if($year){ $rs_list->add_where("abroad_date1 = $year"); }
	if($month){ $rs_list->add_where("abroad_date2 = $month");  }
	if($consult){ $rs_list->add_where("consult = $consult"); } 

	switch ($ot) {
		case 10 : $rs_list->add_order("regi_no DESC");		break;
		default : $rs_list->add_order("abroad_date1 DESC, regi_no DESC");		break;
	}
	
   $page_info=$rs_list->select_list($page,20,10);
?>	
<? include_once('_header.php'); ?>
<table width="770" border="0" cellpadding="0" cellspacing="0" align="center">
  <tr bgcolor="#456285" height="25"> 
    <td width="40" align="center" class="tt6">NO</td>
	<td width="35" align="center" class="tt6">수정</td>
	<td width="35" align="center" class="tt6">삭제</td>
	<td width="35" align="center" class="tt6">보기</td>
	<td width="55" align="center" class="tt6">이름</td>
	<td width="55" align="center" class="tt6">담당자</td>
	<td align="center" class="tt6">경로</td>
	<td width="70" align="center" class="tt6">상담일</td> 
	<td width="70" align="center" class="tt6">등록일</td>
	<td width="80" align="center" class="tt6">국가</td>
	<td width="80" align="center" class="tt6">기간</td>
	<td width="90" align="center" class="tt6">연락처</td>
  </tr>   
  <?
	if($rs_list->num_rows()<1) {
		echo "
	<tr height=\"100\"  bgcolor=\"#FFFFFF\" >
		<td align=\"center\" colspan=\"12\"><B>등록(검색) 된 자료가 없습니다.</td>
	</tr>";
	}
	
	$rs_list->set_table($_table['regi']);
	
	$no = $page_info['start_no'];
	while($R=$rs_list->fetch()) {
		$no--;

   if($R[insen_check] == 1){

    $fontcolor="#FFFFFF";
   }else{

   if($R[process_state] == 1){
    $fontcolor="#c3c3c3";
   }elseif($R[process_state] == 2){
    $fontcolor="#FFD4F1";
   }elseif($R[process_state] == 3){
    $fontcolor="#EFD4FF";
   }elseif($R[process_state] == 4){
    $fontcolor="#D6D4FF";
   }elseif($R[process_state] == 5){
    $fontcolor="#D4EDFF";
   }elseif($R[process_state] == 6){
    $fontcolor="#D4FFFD";
   }elseif($R[process_state] == 7){
    $fontcolor="#D4FFDC";
   }elseif($R[process_state] == 8){
    $fontcolor="#F5FFD4";
   }elseif($R[process_state] == 9){
    $fontcolor="#FFF4E2";   
   }elseif($R[process_state] == 10){
    $fontcolor="#edab7a";   
    }elseif($R[process_state] == 11){
    $fontcolor="#e3b3d9";   
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
        }
?>
  <tr height="30" bgcolor=<?=$fontcolor?>> 
    <td align="center" class="tt4_c"><?=$no?></td>
	<td align="center" class="tt4_c"><a href="regi_edit.php?<?=$p_str?>&page=<?=$page?>&mode=modify&num=<?=$R[regi_no]?>&year=<?=$year?>&month=<?=$month?>"><img src=images/sbt_modify.gif border="0"></a></td>
	<td align="center" class="tt4_c"><a href="#" onClick="confirm_del('regi_edit.php?<?=$p_str?>&page=<?=$page?>&mode=delete&num=<?=$R[regi_no]?>&year=<?=$year?>&month=<?=$month?>')"><img src=images/sbt_del.gif border="0"></a></td>
	<td align="center" class="tt4_c"><a href="regi_view.php?<?=$p_str?>&page=<?=$page?>&mode=modify&num=<?=$R[regi_no]?>&year=<?=$year?>&month=<?=$month?>"><img src=images/sbt_view.gif border="0"></a></td>
	<td align="center" class="tt4_c"><?=$R[student_name]?></td>	     
	<td align="center" class="tt4_c"><?=$name[mb_name]?></td>
    <td align="center" class="tt4_c"><?=$_const['root'][$R['rgi_type']]?></td>
    <td align="center" class="tt4_c"><?=$R[regi_date1]?>.<?=$R[regi_date2]?>.<?=$R[regi_date3]?></td>	
    <td align="center" class="tt4_c"><?=$R[abroad_date1]?>.<?=$R[abroad_date2]?>.<?=$R[abroad_date3]?></td>	
    <td align="center" class="tt4_c"><img src="./images/main_real_national<?=$national?>.gif">&nbsp;<?=$_const['national'][$national]?><?=$two?></td>
 	<td class="tt4_c"><?=$R[study_gigan]?><?if($R[study_gigan2]>0){?>(+<?=$R[study_gigan2]?>)<?}?>주</td>   
	<td align="center" class="tt4_c"><?=$R[tel]?></td>	
  </tr>
  <tr>
    <td bgcolor="#BECCDD" height="1" colspan="13"></td>
  </tr>
<?
}
$_get_param[2] = $_get_param[2]."&year=".$year."&month=".$month."&consult=".$consult ;
?>
</table>
<br>
<table width="770" align="center">
	<tr>
		<td align="center"><?=rg_navi_display($page_info,$_get_param[2]); ?></td>
	</tr>
</table>