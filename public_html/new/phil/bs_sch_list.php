<?
	include_once("../include/lib.php");

    $rs_list = new $rs_class($dbcon);
	$rs_list->clear();
	$rs_list->set_table($_table['school']);
	if($national==""){
      $national = 3;
   }else{
       $national = $national;
    }  
	$rs_list->add_where("national = $national");
	$rs_list->add_where("best = 1");

	$page_info=$rs_list->select_list($page,10,10);

?>	

<? include("./sub_header.php"); ?>

<table width="520" border="0" cellpadding="0" cellspacing="0" align="center">
<?

 $rs_list->set_table($_table['school']);
		
	$no = $page_info['start_no'];
	while($R=$rs_list->fetch()) {
		$no--; 
?>
  <tr> 
	<td width="182" height="52" background="../img/school_logo_bg.gif" style="padding: 1 1 1 1"><?if($R[school_file1_name]){?><img src="../data/school/<?=$R[num]?>/<?=$R[school_file1_name]?>" width="180" height="80" align="absmiddle"><?}?></td>
	<td width="25" >&nbsp;</td>
	<td width="313" valign="top">
      <table width="313" border="0" cellpadding="0" cellspacing="0" align="center">   
		<tr>
		  <td colspan="3" height="2" bgcolor="#faca7d"></td>
		</tr>	    
		<tr>
		  <td align="center" width="80" bgcolor="#fff0d9"><font color="#ff8a00"><strong>학교이름<strong></font></td>
		  <td style="padding: 5px 5px 5px 5px"><?=$R[s_title]?></td>
		  <td align="right"><a href="./school_view.php?num=<?=$R[num]?>&national=<?=$R[national]?>"><img src="../img/btn_more_bl.gif" align="absmiddle" border="0"></a></td>
		</tr>
	    <tr>
		  <td colspan="3" height="1" bgcolor="#faca7d"></td>
		</tr>	 
		<?if($national==3){?>
	    <tr>
		  <td align="center" bgcolor="#fff0d9"><font color="#ff8a00"><strong>지역<strong></font></td>
		  <td colspan="2" style="padding: 5px 5px 5px 5px"><?=$_const['area3'][$R['area']]?></td>
		</tr>
	    <tr>
		  <td colspan="3" height="1" bgcolor="#faca7d"></td>
		</tr>	   
	    <tr>
		  <td align="center" bgcolor="#fff0d9"><font color="#ff8a00"><strong>설립연도<strong></font></td>
		  <td colspan="2" style="padding: 5px 5px 5px 5px"><?=$R['open_date']?></td>
		</tr>
        <?}else{?>
	    <tr>
		  <td align="center" bgcolor="#fff0d9"><font color="#ff8a00"><strong>지역/위치<strong></font></td>
		  <td colspan="2" style="padding: 5px 5px 5px 5px"><?=$data['location']?></td>
		</tr>
	    <tr>
		  <td colspan="3" height="1" bgcolor="#faca7d"></td>
		</tr>	   
	    <tr>
		  <td align="center" bgcolor="#fff0d9"><font color="#ff8a00"><strong>홈페이지<strong></font></td>
		  <td colspan="2" style="padding: 5px 5px 5px 5px"><?=$R['homepage']?></td>
		</tr>
		<?}?>
	    <tr>
		  <td colspan="3" height="2" bgcolor="#faca7d"></td>
		</tr>	   
      </table>


	</td>
  </tr>
  <tr> 
	<td colspan="3" height="20" ></td>
  </tr>
<?
}
?>
</table>
<br>
<table width="520"  align="center">
	<tr>
		<td align="center">
      <?=rg_navi_display($page_info,$_get_param[2]); ?>
		</td>
	</tr>
</table>
<? include("./sub_footer.php"); ?>