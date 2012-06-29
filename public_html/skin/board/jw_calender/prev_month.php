<?
	//�Ͽ��� ��
	$sun_color="#DE8E9C";
	$sun_over_color="#FFF0FD";
	//����� ��
	$sat_color="#99CCCC";
	$sat_over_color="#ECF5FF";
	//������ ��¥ ��
	$else_color="#888888";
	$else_over_color="#F7F7F7";
	
	//�Ѵ��� �� ��¥ ��� �Լ�
	function Month_PDay($i_month,$i_year){
		$day=1;
		while(checkdate($i_month,$day,$i_year)){
			$day++;
		}
		$day--;
		return $day;
	}
	
	//������ ���� �� �ϼ��� ����.
	$total_day=Month_PDay($prevmonth,$prevyear);

	//������ ���� 1���� ������ ����. �Ͽ����� 0.
	$first=date(w,mktime(0,0,0,$prevmonth,1,$prevyear));
?>
<STYLE>
td.cyoil{
	width:27;/*��¥ �� ����*/
	height:25; /*���ϸ� �� ����*/
	text-align:center;
	font-weight:bold;
	background-color:#EDEDED;
	border:1px solid #CCC;
}
td.cdate{
text-align:center;
height:20; /*��¥ �� ����*/
border:1px solid #CCC;
word-break:break-all;
padding:0px;
}
</STYLE>

<table align="center" cellspacing="0" cellspacing="0" border="0">
<tr><td align="center">
<a href="<?=$_path['bbs']?>list.php?bbs_code=<?=$bbs_code?>&year=<?=$prevyear?>&month=<?=$prevmonth?>"><span style="font-size:10pt;font-weight:bold;"><?=$prevmonth?>��</span></a> <span style="font-size:8pt;"><?=$prevyear?></span>
</td><tr>
	<tr>
		<td>
				<table align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;">
							<tr>
								<td class="cyoil" style="color:<?=$sun_color?>">��</td>
								<td class="cyoil" style="color:<?=$else_color?>">��</td>
								<td class="cyoil" style="color:<?=$else_color?>">ȭ</td>
								<td class="cyoil" style="color:<?=$else_color?>">��</td>
								<td class="cyoil" style="color:<?=$else_color?>">��</td>
								<td class="cyoil" style="color:<?=$else_color?>">��</td>
								<td class="cyoil" style="color:<?=$sat_color?>">��</td>
							</tr>
							<tr>
								<?
									//count�� <tr>�±׸� �ѱ������ ����. �������� 7�̵Ǹ� <tr>�±׸� �����Ѵ�.
									$count=0;
									
									//ù��° �ֿ��� ��ĭ�� 1�������� ��ĭ�� ����
									for($i=0; $i<$first; $i++){
										echo "<td class='cdate'>&nbsp;</td>";
										$count++;
									}
									
									// START : ��¥�� ���̺� ǥ��
									for($day=1;$day<=$total_day;$day++){
										$count++;
										$prev_book=mktime(0, 0, 0, $prevmonth, $day, $prevyear);
										
										if ($count==1){//�Ͽ���
											$m_over_color=$sun_over_color;
											$day_color=$sun_color;
										} elseif ($count==7){//�����
											$m_over_color=$sat_over_color;
											$day_color=$sat_color;
										} else {//����
											$m_over_color=$else_over_color;
											$day_color=$else_color;
										}
										
										// �������� ����
										$holiday_arr = array("0101", "0301", "0505", "0606", "0717", "0815", "1003", "1225");
										$h_m = sprintf("%02d",$prevmonth);
										$h_d = sprintf("%02d",$day);
										$h_day=$h_m.$h_d;//����
										for($h=0;sizeof($holiday_arr)>$h;$h++){
											if($holiday_arr[$h] ==$h_day) $day_color=$sun_color;
										}

										//����ó��
										$moonday_arr = array("0101", "0102", "0408", "0814", "0815", "0816", "1230");
										$myarray = soltolun($year,$prevmonth,$day);
										$m_m = sprintf("%02d",$myarray[month]);
										$m_d = sprintf("%02d",$myarray[day]);
										$m_day=$m_m.$m_d;
										for($h=0;sizeof($moonday_arr)>$h;$h++){
											if($moonday_arr[$h] ==$m_day) $day_color=$sun_color;
										}
										
										echo "<td class='cdate' style='color:$day_color;' onMouseOut=this.style.backgroundColor='' onMouseOver=this.style.backgroundColor='$m_over_color'>";
										
										// ���� ��Ų �ڷ���� �޷½�Ų�� rg_ext5 ���� ��¥������ �ڵ����� �־� ���� ����..
										// �ش����ڿ� �ڷᰡ ���� ��� ǥ��
										$view_date=mktime(0,0,0,$prevmonth,$day,$prevyear);
										$cal_list=new $rs_class($dbcon);
										$cal_list->clear();
										$cal_list->set_table($_table['bbs_body']);
										$cal_list->add_where("bbs_db_num = '$bbs_db_num'");
										$cal_list->add_where("bd_ext5='$view_date'");
										$cal_list->add_order("bd_num ASC"); 
										if($cal=$cal_list->fetch()){
											echo "<A HREF='{$_path['bbs']}view.php?bbs_code={$bbs_code}&bd_num={$cal[bd_num]}&year=$prevyear&month=$prevmonth' title='$cal[bd_subject]'><b><u><span style=' color:$day_color;'>$day</span></u></b></a></td>" ;
										} else {
											if($_bbs_auth['write']) 	echo "<a href='{$_path['bbs']}write.php?{$_get_param[3]}&book={$prev_book}'>";
											echo "<span style=' color:$day_color;'>$day</span>";
											if($_bbs_auth['write']) echo "</a>";
											echo "</td>";
										}
										
										//���������� ���
										if($count==7 && $day == $total_day ){
											echo"</tr>";
										}
										//������� �Ǹ� �ٹٲٱ� ���� <tr>�±� ����
										elseif($count==7){
											echo "</tr><tr>";
											$count=0;
										}
									}
								// ������ ���� �������� ������ �� �� ����
								for($day++; $total_day < $day && $count<7; ){
								echo "<td class='cdate'>&nbsp;</td>";
								$count++;
								}
								echo "</tr></table>";
						?>
					</td>
				</tr>
	</TABLE>