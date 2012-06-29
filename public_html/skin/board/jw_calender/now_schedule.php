<?
	//오늘 날짜를 년월일요일별로 구하기
	$today_year=date("Y");
	$today_month=date("n");
	$today_day=date("j");
	
	switch(date("w")) {
		case "1" :
		$yoil = "월";
		break;
		case "2" :
		$yoil = "화";
		break;
		case "3" :
		$yoil = "수";
		break;
		case "4" :
		$yoil = "목";
		break;
		case "5" :
		$yoil = "금";
		break;
		case "6" :
		$yoil = "<font color=blue>토</font>";
		break;
		default :
		$yoil = "<font color=red>일</font>";
		break;
	}
?>
<TABLE width="100%" cellspacing="0" cellpadding="0" border="0"  bgcolor="#C3E288" style="border:2px solid #C3E288;">
	<tr>
		<td height="42" style="background-image:url(<?=$skin_url?>images/today_schedule.gif);background-repeat:no-repeat; background-position:5 0; padding:5 0 0 50; font-family:돋움; font-weight:bold; font-size:11px; color:FFFFFF;">오늘의 일정(<?=$thisyear?>. <?=$thismonth?>월 <?=$today?>일,<?=$yoil?>)
		</TD>
</TR>
						<tr>
							<td bgcolor="#ffffff" height="110" style='padding:7px;word-break:break-all' valign="top">
							<?
								//디비 연결
								$now=mktime(0,0,0,$today_month,$today_day,$today_year);
								$cal_list->clear();
								$cal_list->set_table($_table['bbs_body']);
								$cal_list->add_where("bbs_db_num = '$bbs_db_num'");
								$cal_list->add_where("bd_ext5='$now'");
								$cal_list->add_order("bd_num ASC"); 
										
								if($cal_list->num_rows()<1) { 
								echo "<img src=\"{$skin_url}images/dot.gif\" border=\"0\" align=\"absmiddle\">등록된 일정이 없습니다.";
								} else {
								// 오늘에 자료가 있을 경우 표시
								while($cal=$cal_list->fetch()) {
									$doc_num=$cal['bd_num'];
									$title=$cal['bd_subject'];
									$content=strip_tags($cal['bd_content']);
									$content = rg_cut_string($content, 38, "...");
									echo "<img src=\"../images/arrow.gif\" border=\"0\" align=\"absmiddle\"> <A HREF=\"{$_path['bbs']}view.php?bbs_code={$cal_id}&bd_num={$doc_num}&year=$year&month=$month\"  title=\"$content\">{$title}</a><br>";
									}
								}
								?>
		</TD>
	</TR>
</TABLE>