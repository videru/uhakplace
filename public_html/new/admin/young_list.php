<?
	include_once("../include/lib.php");
	require_once("admin_chk.php");

    $rs_list = new $rs_class($dbcon);
	$rs_list->clear();
	$rs_list->set_table($_table['young']);
	
			
			
    /***********************************************************************/
   // 필터 조건에 의한 필터링

	 if($ss[1]){ $rs_list->add_where("national = $ss[1]"); } 
	 if($area){ $rs_list->add_where("area = $area"); } 
	// 검색어로 검색
	if($kw) { $rs_list->add_where("title LIKE '%$kw%' escape '".$dbcon->escape_ch."'");} 

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
    <td background="images/title_bg.gif" style="padding:9pt 0pt 0pt 10pt" valign="top"><font color=#000000><b>학교관리</b></font></td>
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
    <td background="images/search_bg_middle.gif" style="padding:0pt 0pt 0pt 15pt" class="tt4">국가 <select name="ss[1]" onChange="search_form.submit()" class="select">
<option value="">=전체=</option>
<?=rg_html_option($_const['national'],"$ss[1]")?>
</select>&nbsp;&nbsp;&nbsp;지역 <select name="area" onChange="search_form.submit()" class="select2">
<option value="">=전체=</option>
<?
            if($ss[1]==1) {
		     $_const['area'] = $_const['area1'];
			}elseif($ss[1]==2) {
			 $_const['area'] = $_const['area2'];
			}elseif($ss[1]==3) {
			 $_const['area'] = $_const['area3'];
			}elseif($ss[1]==4) {
			 $_const['area'] = $_const['area4'];
			}elseif($ss[1]==5) {
			 $_const['area'] = $_const['area5'];
			}elseif($ss[1]==6) {
			 $_const['area'] = $_const['area6'];
			}elseif($ss[1]==7) {
			 $_const['area'] = $_const['area7'];
			}elseif($ss[1]==8) {
			 $_const['area'] = $_const['area8'];
			}
?>
<?=rg_html_option($_const['area'],"$area")?>
</select>&nbsp;&nbsp;&nbsp;학교이름 <input name="kw" type="text" id="kw" value="<?=$kw?>" size="30" class="cc">&nbsp;&nbsp;&nbsp;<INPUT onfocus=this.blur() type=image src="images/bt_order_search.gif" align="absmiddle">&nbsp;&nbsp;&nbsp;<a href="young_edit.php?<?=$p_str?>&page=<?=$page?>&mode=new"><img src=images/school_regi.gif border="0" align="absmiddle"></a></td>
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
<table width="770" border="0" cellpadding="0" cellspacing="0" align=center>
  <tr bgcolor="#456285" height="25"> 
    <td width="30" align="center" class="tt6">NO</td>
	<td width="40" align="center" class="tt6">수정</td>
	<td width="40" align="center" class="tt6">삭제</td> 
	<td width="80" align="center" class="tt6">국가</td>
	<td width="70" align="center" class="tt6">지역</td>
	<td width="70" align="center" class="tt6">학교구분</td> 
	<td width="250" align="center" class="tt6">학교이름</td> 
	<td width="150" align="center" class="tt6">사무소연락처</td> 
    <td width="40" align="center" class="tt6">체크</td> 
  </tr> 
	<tr>
		<td bgcolor="#BECCDD" height="1" colspan="9"></td>
	</tr>  
  <?
	if($rs_list->num_rows()<1) {
		echo "
	<tr height=\"100\"  bgcolor=\"#FFFFFF\" >
		<td align=\"center\" colspan=\"9\"><B>등록(검색) 된 자료가 없습니다.</td>
	</tr>";
	}
	
	$rs_list->set_table($_table['young']);
		
	$no = $page_info['start_no'];
	while($R=$rs_list->fetch()) {
		$no--;

			if($R[national]==1) {
		     $_const['area'] = $_const['area1'];
			}elseif($R[national]==2) {
			 $_const['area'] = $_const['area2'];
			}elseif($R[national]==3) {
			 $_const['area'] = $_const['area3'];
			}elseif($R[national]==4) {
			 $_const['area'] = $_const['area4'];
			}elseif($R[national]==5) {
			 $_const['area'] = $_const['area5'];
			}elseif($R[national]==6) {
			 $_const['area'] = $_const['area6'];
			}elseif($R[national]==7) {
			 $_const['area'] = $_const['area7'];
			}elseif($R[national]==8) {
			 $_const['area'] = $_const['area8'];
			}

	        $tel = split("/",$R[office_tel]);
            $tel1 = $tel[0] ;
			$tel2 = $tel[1] ;	
?>
  <tr bgcolor="#FFFFFF" height="25"> 
    <td align="center" class="tt5"><?=$no?></td>
	<td align="center" class="tt5"><a href="young_edit.php?<?=$p_str?>&page=<?=$page?>&mode=modify&num=<?=$R[num]?>&national=<?=$R[national]?>"><img src=images/sbt_modify.gif border="0"></a></td>
	<td align="center" class="tt5"><a href="#" onClick="confirm_del('young_edit.php?<?=$p_str?>&page=<?=$page?>&mode=delete&num=<?=$R[num]?>&national=<?=$R[national]?>')"><img src=images/sbt_del.gif border="0"></a></td>
	<td align="center" class="tt5"><img src=images/main_real_national<?=$R[national]?>.gif>&nbsp;<?=$_const['national'][$R[national]]?></td>
	<td align="center" class="tt5"><?=$_const['area'][$R[area]]?></td>
	<td align="center" class="tt5"><?=$_const[section2][$R[section]]?></td>
    <td class="tt5">&nbsp;&nbsp;<?=$R[title]?></td>
    <td align="center" class="tt5"><?=$tel1?><?if($tel2){?><br><?=$tel2?><?}?></td>
    <td align="center" class="tt5"><? if($R[check]=="1"){ ?><img src=images/mark.gif width="24" height="9"><?}?></td>
  </tr>
	<tr>
		<td bgcolor="#BECCDD" height="1" colspan="9"></td>
	</tr>
<?
}
?>
</table>
<br>
<table width="770"  align=center>
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
<script language="JavaScript" type="text/JavaScript">
function open_window(name, url, left, top, width, height, toolbar, menubar, statusbar, scrollbar, resizable)
{
  toolbar_str = toolbar ? 'yes' : 'no';
  menubar_str = menubar ? 'yes' : 'no';
  statusbar_str = statusbar ? 'yes' : 'no';
  scrollbar_str = scrollbar ? 'yes' : 'no';
  resizable_str = resizable ? 'yes' : 'no';

  newWin= window.open(url, name, 'left='+left+',top='+top+',width='+width+',height='+height+',toolbar='+toolbar_str+',menubar='+menubar_str+',status='+statusbar_str+',scrollbars='+scrollbar_str+',resizable='+resizable_str);
}
</script>