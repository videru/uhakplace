<?
	include_once("../include/lib.php");
	require_once("admin_chk.php");

    $rs_list = new $rs_class($dbcon);
	$rs_list->clear();
	$rs_list->set_table($_table['working']);
    $rs_list->add_where("consultant = '$_mb[mb_num]'");
    $rs_list->add_order("c_no DESC");	
	
	$page_info=$rs_list->select_list($page,20,10);


?>	
<? include("_header.php"); ?>
<? include("admin.header.php"); ?>
<table border="0" cellpadding="0" cellspacing="0" width="800" align="center">
  <tr height="40">
    <td background="images/title_bg.gif" style="padding:9pt 0pt 0pt 10pt" valign="top"><font color=#000000><b>��������</b></font></td>
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
<table width="770" border="0" cellpadding="0" cellspacing="0" align="center">
  <tr>
    <td bgcolor="#BECCDD" height="1" colspan="5"></td>
  </tr> 
 <? 

   $today_year=date('Y'); 
   $today_month=date('m'); 
   $today_date=date('d'); 
   $today_woe=date('w'); 

   $standard_date = mktime(0, 0, 0, $today_month, $today_date, $today_year);


  if($today_woe ==1){
    $today_woe ="��";
  }elseif($today_woe ==2){
    $today_woe ="ȭ";
  }elseif($today_woe ==3){
    $today_woe ="��";
  }elseif($today_woe ==4){
    $today_woe ="��";
  }elseif($today_woe ==5){
    $today_woe ="��";
  }elseif($today_woe ==6){
    $today_woe ="��";
  }elseif($today_woe ==0){
    $today_woe ="��";
  }


?>

    <tr bgcolor="#456285" height="30">     
    <td width="90"  align="center" class="tt6">��¥</td>
	<td width="60" align="center" class="tt6">����</td>
	<td width="596" align="center" class="tt6">�ֿ����</td>
	<td width="90" align="center" class="tt6">��ٽð�</td>
	<td width="90" align="center" class="tt6">��ٽð�</td>
  </tr>	
  <tr>
    <td bgcolor="#BECCDD" height="1" colspan="5"></td>
  </tr>
   
 <?
    $rs_mb = new $rs_class($dbcon);
	$rs_mb->set_table($_table['working']);
    $rs_mb->add_where("regi_date = '$standard_date'");
    $rs_mb->add_where("consultant = '$_mb[mb_num]'");
	$rs_mb->select();	
    if($rs_mb->num_rows()<1) {

?>
   <tr bgcolor="#E6E6E6" height="30">     
    <td align="center" class="tt555"><?=$today_year?>-<?=$today_month?>-<?=$today_date?></td>
	<td align="center" class="tt555"><?=$today_woe?></td>
	<td class="tt55">&nbsp;���� ��ٵ����� ���� �ʾҽ��ϴ�.</td>
	<td align="center" class="tt555"><a href="check_time.php?regi_date=<?=$standard_date?>")>[��ٵ���]</a></td>
	<td align="center" class="tt555">-</td>
  </tr>	
  <tr>
    <td bgcolor="#BECCDD" height="1" colspan="5"></td>
  </tr>
  <?
  }
  
	$rs_list->set_table($_table['working']);
	
	
	$no = $page_info['start_no'];
	while($R=$rs_list->fetch()) {
		$no--;

 

   $check_woe = date("w", $R[regi_date]); 
  
  if($check_woe ==1){
    $check_woe ="��";
  }elseif($check_woe ==2){
    $check_woe ="ȭ";
  }elseif($check_woe ==3){
    $check_woe ="��";
  }elseif($check_woe ==4){
    $check_woe ="��";
  }elseif($check_woe ==5){
    $check_woe ="��";
  }elseif($check_woe ==6){
    $check_woe ="��";
  }elseif($check_woe ==0){
    $check_woe ="��";
  }

if($R[working_title]==""){
	$R[working_title]= "������ �ֿ������ ����ؼ� �Է��ϼ���. [�����Է�]";
}else{
	$R[working_title]=$R[working_title];
}

   
?>


  <tr bgcolor="#FFFFFF" height="30"> 
    <td align="center" class="tt555"><?=rg_date($R[regi_date], '%Y-%m-%d')?></td>
	<td align="center" class="tt555"><?=$check_woe?></td>
	<td class="tt55">&nbsp;<a href="javascript:open_window('regi', 'person_check_edit.php?page=<?=$page?>&c_no=<?=$R[c_no]?>&mode=modify', 80, 120, 550, 550, 0, 0, 0, 0, 0);")><?=$R[working_title]?></a></td>	
    <td align="center" class="tt555"><?=rg_date($R[check_time], '%H:%M')?></td>	 
    <td align="center" class="tt555"><?if($R[leave_time]==""){?><a href="leave_time.php?page=<?=$page?>&c_no=<?=$R[c_no]?>">[��ٵ���]</a><?}else{?><?=rg_date($R[leave_time], '%H:%M')?><?}?></td>
  </tr>
  <tr>
    <td bgcolor="#BECCDD" height="1" colspan="5"></td>
  </tr>
<?
}
?>

</table>

<br>
<table width="770" align=center>
	<tr>
		<td align="center">
<?=rg_navi_display($page_info,$_get_param[2]); ?>
		</td>
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