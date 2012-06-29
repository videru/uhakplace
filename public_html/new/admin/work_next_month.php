<?
	
	
	//선택한 월의 총 일수를 구함.
	$total_day=Month_PDay($nextmonth,$nextyear);

	//선택한 월의 1일의 요일을 구함. 일요일은 0.
	$first=date(w,mktime(0,0,0,$nextmonth,1,$nextyear));
?>
<table align="center" cellspacing="0" cellspacing="0" border="0">
<tr><td align="center">
<a href="person_check_list.php?year=<?=$nextyear?>&month=<?=$nextmonth?>"> <span style="font-size:10pt;font-weight:bold;"><?=$nextmonth?>월</span></a> <span style="font-size:8pt;"><?=$nextyear?></span>
</td><tr>
	<tr>
		<td>
				<table align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;">
							<tr>
								<td class="cyoil" style="color:<?=$sun_color?>">일
								</td>
								<td class="cyoil" style="color:<?=$else_color?>">월
								</td>
								<td class="cyoil" style="color:<?=$else_color?>">화
								</td>
								<td class="cyoil" style="color:<?=$else_color?>">수
								</td>
								<td class="cyoil" style="color:<?=$else_color?>">목
								</td>
								<td class="cyoil" style="color:<?=$else_color?>">금
								</td>
								<td class="cyoil" style="color:<?=$sat_color?>">토
								</td>
							</tr>
							<tr>
								<?
									//count는 <tr>태그를 넘기기위한 변수. 변수값이 7이되면 <tr>태그를 삽입한다.
									$count=0;
									
									//첫번째 주에서 빈칸을 1일전까지 빈칸을 삽입
									for($i=0; $i<$first; $i++){
										echo "<td class='cdate'>&nbsp;</td>";
										$count++;
									}
									
									// START : 날짜를 테이블에 표시
									for($day=1;$day<=$total_day;$day++){
										$count++;
										$next_book=mktime(0, 0, 0, $nextmonth, $day, $nextyear);
										
										if ($count==1){//일요일
											$m_over_color=$sun_over_color;
											$day_color=$sun_color;
										} elseif ($count==7){//토요일
											$m_over_color=$sat_over_color;
											$day_color=$sat_color;
										} else {//평일
											$m_over_color=$else_over_color;
											$day_color=$else_color;
										}
										
										// 국공휴일 설정
										$holiday_arr = array("0101", "0301", "0505", "0606", "0717", "0815", "1003", "1225");
										$h_m = sprintf("%02d",$nextmonth);
										$h_d = sprintf("%02d",$day);
										$h_day=$h_m.$h_d;//금일
										for($h=0;sizeof($holiday_arr)>$h;$h++){
											if($holiday_arr[$h] ==$h_day) {
												$day_color=$sun_color;
											}
										}

										//음력처리
										$moonday_arr = array("0101", "0102", "0408", "0814", "0815", "0816", "1230");
										$myarray = soltolun($year,$nextmonth,$day);
										$m_m = sprintf("%02d",$myarray[month]);
										$m_d = sprintf("%02d",$myarray[day]);
										$m_day=$m_m.$m_d;
										for($h=0;sizeof($moonday_arr)>$h;$h++){
											if($moonday_arr[$h] ==$m_day) $day_color=$sun_color;
										}
										
										echo "<td class='cdate' style='color:$day_color;' onMouseOut=this.style.backgroundColor='' onMouseOver=this.style.backgroundColor='$m_over_color'>";
										
										// 알지 스킨 자료실의 달력스킨은 rg_ext5 값에 날짜정보를 자동으로 넣어 쓰기 땜에..
										// 해당일자에 자료가 있을 경우 표시
										$view_date=mktime(0,0,0,$nextmonth,$day,$nextyear);
										$cal_list=new recordset($dbcon);
										$cal_list->clear();
										$cal_list->set_table($_table['working']);
										$cal_list->add_where("regi_date='$view_date'");
										$cal_list->add_order("c_no ASC"); 
										if($cal=$cal_list->fetch()){
											echo "<A HREF='person_check_edit.php?&c_no={$cal[c_no]}&year=$nextyear&month=$nextmonth' title='$cal[working_title]'><b><u><span style=' color:$day_color;'>$day</span></u></b></a></td>" ;
										} else {
											if($_bbs_auth['write']) 	echo "<a href='{$_path['bbs']}write.php?{$_get_param[3]}&book={$next_book}'>";
											echo "<span style=' color:$day_color;'>$day</span>";
											if($_bbs_auth['write']) echo "</a>";
											echo "</td>";
										}
										
										//마지막주의 경우
										if($count==7 && $day == $total_day ){
											echo"</tr>";
										}
										//토요일이 되면 줄바꾸기 위한 <tr>태그 삽입
										elseif($count==7){
											echo "</tr><tr>";
											$count=0;
										}
									}
								// 선택한 월의 마지막날 이후의 빈 셀 삽입
								for($day++; $total_day < $day && $count<7; ){
								echo "<td class='cdate'>&nbsp;</td>";
								$count++;
								}
								echo "</tr></table>";
						?>
					</td>
				</tr>
	</TABLE>