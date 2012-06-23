<?
	include_once("../include/lib.php");
	require_once("admin_chk.php");


    	function m_count($value) {	  

		$Dqry = "select * from rg4_regi where school_name_no = '$value'" ;		
        $Dresult  = mysql_query($Dqry);
        $total_num = @mysql_num_rows($Dresult);

        return $total_num;
		}


    	function m_count1($value) {	  

		$Dqry = "select * from rg4_regi where school_name_no = '$value'" ;		
        $Dresult  = mysql_query($Dqry);

        while($rowS = mysql_fetch_array($Dresult)) { 
        $total_sc = $total_sc + $rowS[study_gigan] ; 
		}
        return $total_sc;
		}

    $rs_list = new $rs_class($dbcon);
	$rs_list->clear();
	$rs_list->set_table($_table['school']);
    $rs_list->add_where("national  =3");

    /***********************************************************************/
   // 필터 조건에 의한 필터링

      if($out==1){ $rs_list->add_where("process_state < 10");	}


	// 검색어로 검색
	if($kw) { $rs_list->add_where("s_title LIKE '%$kw%' escape '".$dbcon->escape_ch."'");}       


	switch ($ot) {
		case 10 : $rs_list->add_order("group by study_gigan DESC");		break;
		default : $rs_list->add_order("total_gigan DESC");		break;
	}
	
   $page_info=$rs_list->select_list($page,20,10);

   $MENU_L='m5';	
?>	
<? include("_header.php"); ?>
<? include("admin.header.php"); ?>
<table border="0" cellpadding="0" cellspacing="0" width="800" align="center">
  <tr height="40">
    <td background="images/title_bg.gif" style="padding:9pt 0pt 0pt 10pt" valign="top"><font color=#000000><b>학교별통계</b></font></td>
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
    <td background="images/search_bg_middle.gif" style="padding:0pt 0pt 0pt 15pt" class="tt4"> 등록일 
<select name="year" class="select">
<option value="">=전체=</option>
<?=rg_html_option($_const[year],$year)?>
		</select>년 <select name="month" class="select">
<option value="">=전체=</option>
<?=rg_html_option($_const[month],$month)?>
		</select>월 학교명: <input name="kw" type="text" id="kw" value="<?=$kw?>" size="4" class="input"> <INPUT onfocus=this.blur() type=image src="images/bt_order_search.gif" align="absmiddle"></td>
  </tr>
  <tr> 
    <td><img src="images/search_bg_bottom.gif" width="770" height="16"></td>
  </tr>
  </form>
</table>
<br>

<table width="770" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr> 
    <td align="center" class="text15_b"><?=$year?>년 <?=$month?>월 등록 현황</td>
  </tr>
</table>
<br>
<table width="770" border="0" cellpadding="0" cellspacing="0" align="center">
  <tr bgcolor="#456285" height="25"> 
    <td width="40" align="center" class="tt6">NO</td>
	<td width="180" align="center" class="tt6">학교명</td>
	<td width="550" align="center" class="tt6">등록현황</td>
  </tr>   
  <?
	if($rs_list->num_rows()<1) {
		echo "
	<tr height=\"100\"  bgcolor=\"#FFFFFF\" >
		<td align=\"center\" colspan=\"12\"><B>등록(검색) 된 자료가 없습니다.</td>
	</tr>";
	}
	
	$rs_list->set_table($_table['school']);
	
	$no = $page_info['start_no'];
	while($R=$rs_list->fetch()) {
		$no--;

?>
  <tr height="30" > 
    <td align="center" class="tt4_c"><?=$no?></td>
	<td align="center" class="tt4_c"><?=$R[s_title]?> </td>
	<td align="center" class="tt6">
     <table width="550" border="0" cellpadding="0" cellspacing="0" align="center">
       <tr> 
	     <td width="<?=m_count($R[num])*2?>">
           <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
             <tr> 
	          <td height="6" background="./images/gr_02.gif"  ></td>	
	       </tr>
           </table>			 
		 </td>
	     <td width="2"></td>
         <td><?=m_count($R[num])?>명/<?=m_count1($R[num])?>주</td>
       </tr>
     </table>	
	</td>	
  </tr>
  <tr>
    <td bgcolor="#BECCDD" height="1" colspan="13"></td>
  </tr>
<?
}
$_get_param[2] = $_get_param[2]."&year=".$year."&month=".$month;
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