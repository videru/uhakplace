<?
	include_once("../include/lib.php");
	require_once("admin_chk.php");

	$today_year=date('Y'); 
	$today_month=date('m'); 
	$today_date=date('d'); 
	$today_woe=date('w'); 

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

	$start_work = "10:00:00";	
	$end_work = "19:00:00";

	$data = array("������" => "2", "��ȫ��" => "4", "..." => "5", "..." => "199");


	if($day=='') $day=date('Y-m');
	list($yy,$mm)=explode('-',$day);

	if(!$validate->number_only($yy)) exit;
	if(!$validate->number_only($mm)) exit;

	$min_year = 2007;
	$max_year = date('Y');
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
<br>

<table width="700" border="0" cellpadding="0" cellspacing="0" align="center">
<form name="form1">
  <tr>
	<td colspan=2 style="padding-bottom:5px;" align=right>
<a href="?day=<?=date('Y-m',mktime(0,0,0,$mm-1,1,$yy))?>">��</a>
<select name="yy" onchange="location.href='?day='+form1.yy.value+'-'+form1.mm.value" class="select">
<?
if($min_year>$yy) $min_year=$yy;
if($max_year<$yy) $max_year=$yy;
for($i=$min_year;$i<=$max_year;$i++) {
	if($yy==$i)
		$selected=" selected";
	else
		$selected="";
?>
  <option <?=$selected?> value="<?=$i?>"><?=$i?></option>
<?
}
?>
</select>��
<select name="mm" onchange="location.href='?day='+form1.yy.value+'-'+form1.mm.value"  class="select2">
<?
for($i=1;$i<=12;$i++) {
	if($mm==$i) {
		$selected=" selected";
	} else {
		$selected="";
	}
?>
	<? 
		if ($i < 10) {
	?>
		<option <?=$selected?> value="0<?=$i?>"><?=$i?></option>
	<?
		} else {
	?>
		<option <?=$selected?> value="<?=$i?>"><?=$i?></option>
	<?
		}
	?>
<?
}
?>
</select>��
<a href="?day=<?=date('Y-m',mktime(0,0,0,$mm+1,1,$yy))?>">��</a>
<input type="button" value="���ΰ�ħ" onclick="location.reload()" class="button2"/>	
	</td>
  </tr>
</form>
  <tr>
    <td bgcolor="#BECCDD" height="1" colspan="5"></td>
  </tr> 
  <tr bgcolor="#456285" height="30">     
    <td width="100"  align="center" class="tt6">�̸�</td>
	<td width="600" align="center" class="tt6">����</td>
  </tr>	
  <tr>
    <td bgcolor="#BECCDD" height="1" colspan="5"></td>
  </tr>
<? foreach($data as $name => $consultant) { ?>
<?
	$Tqry = "select c_no, from_unixtime(regi_date,'%Y-%m-%d') sdate, DATE_FORMAT(from_unixtime(regi_date,'%Y-%m-%d'),'%w') syo, from_unixtime(check_time, '%H:%i:%s') stime, from_unixtime(leave_time, '%H:%i:%s') etime, if(isnull(working_title),'1','0') as wtitle from rg4_working where consultant = ".$consultant." and date_format(from_unixtime(regi_date), '%Y-%m') = '".$day."'  order by c_no desc";	
	
    $resultT = mysql_query($Tqry);  
    $totalnum  = @mysql_num_rows($resultT);
    
	if($totalnum < 1) {
?>
  <tr bgcolor="#E6E6E6" height="30">
    <td align=center><?=$name?></td>
	<td bgcolor="#ffffff">&nbsp;&nbsp;<font color="#B7B7B7">�ش�� �����Ͱ� �����ϴ�.</td>
  </tr>	
  <tr>
    <td bgcolor="#BECCDD" height="1" colspan="5"></td>
  </tr>	
<?
	} else {
?>
  <tr>
    <td>
<?
	$tot_point = 0;
	$max_counter = 85;

		for ($i=0;$i<$totalnum;$i++) {			
			$rowT =mysql_fetch_array($resultT);			
			
		if ($rowT[syo] >= 1 && $rowT[syo] < 6) {	//�ָ�����
			
			$gap_stime = strtotime($rowT[stime]) - strtotime($start_work);
			$gap_stime_min = intval($gap_stime / 60); 

			$gap_etime = strtotime($rowT[etime]) - strtotime($end_work);
			$gap_etime_min = intval($gap_etime / 60);

	//////////////////////////////////////////////////////////////////////////////////��ٽð� ����
			if ($gap_stime < 0 && $gap_stime > -(1*60*60)) {	//����(1�ð��̳�)
				$tot_point = intval($tot_point + 1);

			} elseif($gap_stime <= -(1*60*60)) {	//����(1�ð�����~)
				$tot_point = intval($tot_point + 3);

			} elseif ($gap_stime > 0 && $gap_stime < (10*60)) {	//����(~10���̳� - 9��40��)
				$tot_point = intval($tot_point - 1);

			} elseif ($gap_stime >= (10*60) && $gap_stime < (30*60)) {	//����(10~30���̳� - 9��40�� ~ 10��)
				$tot_point = intval($tot_point - 2);
			
			} elseif ($gap_stime >= (30*60) && $gap_stime < (90*60)) {	//����(30~60���̳� - 10�� ~ 11��)
				$tot_point = intval($tot_point - 4);

			} elseif ($gap_stime >= (90*60)) {	//����(11�� ����)
				$tot_point = intval($tot_point - 5);

			} else { // ����(0)
				$tot_point = $tot_point;
			}
	//////////////////////////////////////////////////////////////////////////////////��ٽð� ���� ��


	//////////////////////////////////////////////////////////////////////////////////��ٽð� ����
			if ($gap_etime > 0 && $gap_etime < (1*60*60)) {	//����(~19:30)
				$tot_point = intval($tot_point + 1);

			} elseif($gap_etime > (1*60*60) && $gap_etime < (2*60*60)) {	//����(~20:30)
				$tot_point = intval($tot_point + 2);

			} elseif($gap_etime > (2*60*60) && $gap_etime < (3*60*60)) {	//����(~21:30)
				$tot_point = intval($tot_point + 3);

			} elseif($gap_etime > (3*60*60) && $gap_etime < (4*60*60)) {	//����(~22:30)
				$tot_point = intval($tot_point + 4);

			} elseif($gap_etime > (4*60*60) && $gap_etime < (5.5*60*60)) {	//����(~24:00)
				$tot_point = intval($tot_point + 5);

			} else { // ���� or ���� ���(0)
				$tot_point = $tot_point;
			}
	//////////////////////////////////////////////////////////////////////////////////��ٽð� ���� ��

			//if ($rowT[wtitle]){	//�������� ������ ������ -3
			//	$tot_point = intval($tot_point - 3);
			//}
		}
		}
		$graph_per = number_format($tot_point/$max_counter*90,0,'.','');
	?>
  <tr bgcolor="#E6E6E6" height="30">
    <td align=center><?=$name?></td>
	<td bgcolor="#ffffff"><img src="<?=$_url['counter']?>images/gr_02.gif" width="<?=$graph_per?>%" height="12"> (<?=$tot_point?>)</td>
  </tr>
  <tr>
    <td bgcolor="#BECCDD" height="1" colspan="5"></td>
  </tr>			
	<?
	}
?>
<? } ?>
	</td>
  </tr>
</table><br>
<table width="770" border=0 cellspacing=3 bgcolor="#D7D7D7" align=center>
	<tr>
		<td align=center><b>�򰡱���</b></td>
	</tr>
	<tr>
		<td bgcolor="#ffffff" style="padding-left:10px;padding-right:10px;padding-top:5px;padding-bottom:5px;">
		<li>�򰡴� �ſ� �� ���ͳ� ���������� ���� �Ǵ��Ѵ�.</li>
		<li>���� ��� ���� (1�ð� �� 1�� ���� / 2�ð� �� 3�� ���� / +10�� �̳� 1�� ���� / +30�� �̳� 2�� ���� / 10��~11�� 4�� ���� / 11��~12�� 5�� ����)</li>
		<li>���� ��� ���� (1�ð� �� �ʰ��ٹ� 1�� ���� / 1�ð� �̻� �ʰ��ٹ� 1�� ����[�������� �� 1�ð� �ʰ��ٹ��� 1���� ����])</li>
		</td>
	</tr>
</table>
<br>
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