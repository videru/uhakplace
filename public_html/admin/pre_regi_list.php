<?
	include_once("../include/lib.php");
	require_once("admin_chk.php");

    $rs_list = new $rs_class($dbcon);
	$rs_list->clear();
	$rs_list->set_table($_table['pre_regi']);
    $rs_list->add_where("process_state < 10");	
			
			
    /***********************************************************************/
   // 필터 조건에 의한 필터링
	 if($ss[0]){ $rs_list->add_where("process_state = $ss[0]"); } 
	 if($ss[1]){ $rs_list->add_where("national = $ss[1]"); } 
	// 검색어로 검색
	if($kw) { $rs_list->add_where("student_name LIKE '%$kw%' escape '".$dbcon->escape_ch."'");} 

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
    <td background="images/title_bg.gif" style="padding:9pt 0pt 0pt 10pt" valign="top"><font color=#000000><b>홈페이지 온라인신청</b></font></td>
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
    <td background="images/search_bg_middle.gif" style="padding:0pt 0pt 0pt 15pt" class="tt4">국가 <select name="ss[1]" onChange="search_form.submit()"  class="select2">
<option value="">=전체=</option>
<?=rg_html_option($_const['national'],"$ss[1]")?>
</select> 이름 <input name="kw" type="text" id="kw" value="<?=$kw?>" size="8" class="cc">&nbsp;&nbsp;<INPUT onfocus=this.blur() type=image src="images/bt_order_search.gif" align="absmiddle">&nbsp;<a href="pre_regi_edit.php?<?=$p_str?>&page=<?=$page?>&mode=new")><img src=images/student_regi.gif border="0" align="absmiddle"></a></td>
  </tr>
  <tr> 
    <td background="images/search_bg_middle.gif" align="center"><img src=images/icon_line.gif border="0"></td>
  </tr>
  <tr> 
    <td><img src="images/search_bg_bottom.gif" width="770" height="16"></td>
  </tr>
  </form>
</table>
<br>
<table width="770" align=center>
		<td align=right>Total: 
			<?=$page_info['total_rows']?>
			(<?=$page_info['page']?>/<?=$page_info['total_page']?>)</td>

</table>
<table width="770" border="0" cellpadding="0" cellspacing="0" align="center">
  <tr bgcolor="#456285" height="25"> 
    <td width="30" align="center" class="tt6">NO</td>
	<td width="40" align="center" class="tt6">수정</td>
	<td width="40" align="center" class="tt6">삭제</td>
	<td width="50" align="center" class="tt6">이름</td>
	<td width="40" align="center" class="tt6">지사</td> 
	<td width="65" align="center" class="tt6">등록일</td>
	<td width="65" align="center" class="tt6">출국일</td>
	<td width="80" align="center" class="tt6">국가</td>
	<td width="100" align="center" class="tt6">전화번호</td> 
	<td width="100" align="center" class="tt6">이메일</td>
	<td width="80" align="center" class="tt6">등록처</td>
	<td width="80" align="center" class="tt6">진행상황</td>
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


   if($R[process_state] == 1){
    $fontcolor="#FFFFFF";
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
   }else{
     $fontcolor="#FFFFFF";
   }

   if($R[insert_gubun] == 1){
    $insert_gubun = "유학플레이스";
   }elseif($R[insert_gubun] == 2){
    $insert_gubun = "유학마켓";
   }
?>
  <tr height="30" bgcolor=<?=$fontcolor?>> 
    <td align="center" class="tt5"><?=$no?></td>
	<td align="center" class="tt5"><a href="./pre_regi_edit.php?<?=$p_str?>&amp;page=<?=$page?>&amp;mode=modify&amp;num=<?=$R[num]?>"><img src="./images/sbt_modify.gif" border="0" /></a></td>
	<td align="center" class="tt5"><a href="#" onclick="confirm_del('pre_regi_edit.php?<?=$p_str?>&amp;page=<?=$page?>&amp;mode=delete&amp;num=<?=$R[num]?>')"><img src="./images/sbt_del.gif" border="0" /></a></td>
    <td align="center" class="tt5"><?=$R[student_name]?></td>	
    <td align="center" class="tt5"><?=$_regi['chain'][$R[chain]]?></td>
    <td align="center" class="tt5"><?=rg_date($R[regi_date],'%Y.%m.%d')?></td>	
    <td align="center" class="tt5"><?=$R[airpoet_date1]?>.<?=$R[airpoet_date2]?>.<?=$R[airpoet_date3]?></td>	
    <td align="center" class="tt5"><img src=images/main_real_national<?=$R[national]?>.gif>&nbsp;<?=$_const['national'][$R[national]]?></td>
    <td align="center" class="tt5"><?=$R[tel]?></td>
    <td align="center" class="tt5"><?=$R[email]?></td>
    <td align="center" class="tt5"><?=$insert_gubun?></td>
	<td align="center" class="tt5"><?=$_reserv['sang'][$R[process_state]]?></td>
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