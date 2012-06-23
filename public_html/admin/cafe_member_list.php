<?
	include_once("../include/lib.php");
	require_once("admin_chk.php");

    $rs_list = new $rs_class($dbcon);
	$rs_list->clear();
	$rs_list->set_table($_table['cafe_member']);
    $rs_list->add_where("regi_state = 1");	
			
			
    /***********************************************************************/
   // 필터 조건에 의한 필터링
	 if($ss[0]){ $rs_list->add_where("regi_state = $ss[0]"); } 
	 if($ss[1]){ $rs_list->add_where("national = $ss[1]"); } 
	 if($ss[2]){ $rs_list->add_where("consult = $ss[2]"); } 
	 if($ss[3]){ $rs_list->add_where("rate = $ss[3]"); } 
	// 검색어로 검색
	if($kw) { $rs_list->add_where("name LIKE '%$kw%' escape '".$dbcon->escape_ch."'");} 

   if($regi_date1) {   

   if($regi_date1 and !$regi_date2) {   
   $re_date=explode("-",$regi_date1);
   $regi_date11 =mktime(0,0,0,$re_date[1],$re_date[2],$re_date[0]);
   $regi_date12 =mktime(24,0,0,$re_date[1],$re_date[2],$re_date[0]);
   $rs_list->add_where("regi_date between $regi_date11 and $regi_date12");  
   }
   elseif($regi_date1 and $regi_date2) {   
   $re_date=explode("-",$regi_date1);
   $regi_date11 =mktime(0,0,0,$re_date[1],$re_date[2],$re_date[0]);    
   $re_date2=explode("-",$regi_date2);
   $regi_date21 =mktime(24,0,0,$re_date2[1],$re_date2[2],$re_date2[0]);
   $rs_list->add_where("regi_date between $regi_date11 and $regi_date21");  
   }

   }

	switch ($ot) {
		case 10 : $rs_list->add_order("num DESC");		break;
		default : $rs_list->add_order("num DESC");		break;
	}
	
	$page_info=$rs_list->select_list($page,20,10);

	$MENU_L='m5';	
?>	
<? include("_header.php"); ?>
<? include("admin.header.php"); ?>
<table border="0" cellpadding="0" cellspacing="0" width="800" align="center">
  <tr height="40">
    <td background="images/title_bg.gif" style="padding:9pt 0pt 0pt 10pt" valign="top"><font color=#000000><b>상담관리</b></font></td>
  </tr>
</table>
<br>
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
<table width="770" border="0" cellspacing="0" cellpadding="0" align="center">
 <form name="search_form" method="get" enctype="multipart/form-data">  
  <tr> 
    <td><img src="images/search_bg_top.gif" width="770" height="16"></td>
  </tr>
  <tr>
    <td background="images/search_bg_middle.gif" style="padding:0pt 0pt 0pt 15pt" class="tt4">진행상황 <select name="ss[0]" onChange="search_form.submit()" class="select">
<option value="">=전체=</option>
<?=rg_html_option($_reserv['regi_state'],"$ss[0]")?>
</select> 국가 <select name="ss[1]" onChange="search_form.submit()"  class="select2">
<option value="">=전체=</option>
<?=rg_html_option($_const['national'],"$ss[1]")?>
</select> 
담당자 <select name="ss[2]" onChange="search_form.submit()"  class="select2">
 <option value="">=전체=</option>        
		 <?       
	    $rs_mem = new $rs_class($dbcon);
	    $rs_mem->clear();
	    $rs_mem->set_table($_table['member']);
        $rs_mem->add_where("mb_id != 'webadmin'");	
        $rs_mem->add_where("mb_level >= 90");	
	    while($RV=$rs_mem->fetch()) {

		?>
	<option value="<?=$RV[mb_num]?>" <?if ($RV[mb_num]==$ss[2]) { ?>selected<?}?>><?=$RV[mb_name]?></option>  <?     } ?> 
		</select>
등급 <select name="ss[3]" onChange="search_form.submit()"  class="select2">
<option value="">=전체=</option>
<?=rg_html_option($_const[rate],"$ss[3]")?>
</select> 
</td>
  </tr>
  <tr> 
    <td background="images/search_bg_middle.gif" align="center"><img src=images/icon_line.gif border="0"></td>
  </tr>
  <tr> 
    <td background="images/search_bg_middle.gif" style="padding:0pt 0pt 0pt 15pt">등록일 
<input type="text" name="regi_date1" class="cc" size="10" readonly onclick="popUpCalendar(this, regi_date1, 'yyyy-mm-dd')" > ~ <input type="text" name="regi_date2" class="cc" size="10" readonly onclick="popUpCalendar(this, regi_date2, 'yyyy-mm-dd')">
이름 <input name="kw" type="text" id="kw" value="<?=$kw?>" size="10" class="cc"> <INPUT onfocus=this.blur() type=image src="images/bt_order_search.gif"  align="absmiddle">&nbsp;&nbsp;&nbsp;<a href="cafe_member_edit.php?<?=$p_str?>&page=<?=$page?>&mode=new")><img src=images/student_regi.gif border="0" align="absmiddle"></a></td>
  </tr>

  <tr> 
    <td><img src="images/search_bg_bottom.gif" width="770" height="16"></td>
  </tr>
  </form>
</table>
<br>

<table width="770" align=center>
 <tr>  
   <td align="center" colspan="2"><font size="3"><strong><?=$regi_date1?> <?if($regi_date2){?>~ <?=$regi_date2?><?}?></strong></font></td> 
</tr>
<tr>
  <td >등급(수속확률)  <font color="#cccccc">■ 0%</font> <font color="#75f6fb">■ 10%</font> <font color="#f558ff">■ 30%</font> <font color="#4fff42">■ 50%</font> <font color="#fb7c4f">■ 70%</font> <font color="#43a9ff">■ 90%</font></td>
  <td align=right>Total: 
			<?=$page_info['total_rows']?>
			(<?=$page_info['page']?>/<?=$page_info['total_page']?>)</td>
</tr>
</table>
<table width="770" border="0" cellpadding="0" cellspacing="0" align="center">
  <tr bgcolor="#456285" height="25"> 
    <td width="30" align="center" class="tt6">NO</td>
	<td width="35" align="center" class="tt6">수정</td>
	<td width="35" align="center" class="tt6">삭제</td>
	<td width="35" align="center" class="tt6">보기</td>
	<td width="75" align="center" class="tt6">상담일</td>
	<td width="45" align="center" class="tt6">담당자</td> 
	<td width="45" align="center" class="tt6">이름</td>
 	<td width="90" align="center" class="tt6">핸드폰</td> 
	<td width="85" align="center" class="tt6">출국예정일</td>
	<td width="80" align="center" class="tt6">국가</td>
	<td width="145" align="center" class="tt6">이메일</td>
	<td width="70" align="center" class="tt6">진행상황</td>
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
   if($R[rate] == 0){
	   $fontcolor ="#efefef";
   }
   elseif($R[rate] == 1){
	   $fontcolor ="#abfcff";
   }elseif($R[rate] ==2){
	   $fontcolor ="#faabff";
   }elseif($R[rate] == 3){
	   $fontcolor ="#bfffba";
   }elseif($R[rate] == 4){
	   $fontcolor ="#ffbfa8";
   }elseif($R[rate] == 5){
	   $fontcolor ="#badfff";
   }


    $rs_adm = new $rs_class($dbcon);
    $rs_adm->clear();
    $rs_adm->set_table($_table['member']);
    $rs_adm->add_where("mb_num = $R[consult]");	
    $R_adm=$rs_adm->fetch();

?>
  <tr height="30" bgcolor=<?=$fontcolor?>> 
    <td align="center" class="tt4_c"><?=$no?></td>
	<td align="center" class="tt4_c"><a href="cafe_member_edit.php?<?=$p_str?>&page=<?=$page?>&mode=modify&num=<?=$R[num]?>&national=<?=$R[national]?>"><img src=images/sbt_modify.gif border="0"></a></td>
	<td align="center" class="tt4_c"><a href="#" onClick="confirm_del('cafe_member_edit.php?<?=$p_str?>&page=<?=$page?>&mode=delete&num=<?=$R[num]?>')"><img src=images/sbt_del.gif border="0"></a></td>
	<td align="center" class="tt4_c"><a href="cafe_member_view.php?<?=$p_str?>&page=<?=$page?>&mode=modify&num=<?=$R[num]?>"><img src=images/sbt_view.gif border="0"></a></td>
    <td align="center" class="tt4_c"><?=rg_date($R[regi_date],'%Y-%m-%d')?></td>	   
    <td align="center" class="tt4_c"><?=$R_adm[mb_name]?></td>	
	<td align="center" class="tt4_c"><?=$R[name]?></td>	
    <td align="center" class="tt4_c"><?=$_const['tel'][$R[tel1]]?>.<?=$R[tel2]?>.<?=$R[tel3]?></td>	
    <td align="center" class="tt4_c"><?=$R[abroad_date]?></td>	
    <td align="center" class="tt4_c"><img src=images/main_real_national<?=$R[national]?>.gif>&nbsp;<?=$_const['national'][$R[national]]?></td>
    <td align="center" class="tt4_c"><?=$R[email]?></td>
    <td align="center" class="tt4_c"><?=$_reserv['regi_state'][$R[regi_state]]?></td>
  </tr>
  <tr>
    <td bgcolor="#BECCDD" height="1" colspan="12"></td>
  </tr>
<?
}
?>
</table>
<br>
<table width="770" align="center">
	<tr>
		<td align="center"><?=rg_navi_display($page_info,$_get_param[2]); ?></td>
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
<? include("admin.footer.php"); ?>
<? include("_footer.php"); ?>