<?
	//���� ��¥�� ����Ͽ��Ϻ��� ���ϱ�
	$today_year=date("Y");
	$today_month=date("n");
	$today_day=date("j");
	
	switch(date("w")) {
		case "1" :
		$yoil = "��";
		break;
		case "2" :
		$yoil = "ȭ";
		break;
		case "3" :
		$yoil = "��";
		break;
		case "4" :
		$yoil = "��";
		break;
		case "5" :
		$yoil = "��";
		break;
		case "6" :
		$yoil = "<font color=blue>��</font>";
		break;
		default :
		$yoil = "<font color=red>��</font>";
		break;
	}
?>
<TABLE width="100%" cellspacing="0" cellpadding="0" border="0"  bgcolor="#C3E288" style="border:2px solid #C3E288;">
	<tr>
		<td height="42" style="background-image:url(<?=$skin_url?>images/today_schedule.gif);background-repeat:no-repeat; background-position:5 0; padding:5 0 0 50; font-family:����; font-weight:bold; font-size:11px; color:FFFFFF;">������ ����(<?=$thisyear?>. <?=$thismonth?>�� <?=$today?>��,<?=$yoil?>)
		</TD>
</TR>
						<tr>
							<td bgcolor="#ffffff" height="110" style='padding:7px;word-break:break-all' valign="top">
							<?
								//��� ����
								$now=mktime(0,0,0,$today_month,$today_day,$today_year);
								$cal_list->clear();
								$cal_list->set_table($_table['bbs_body']);
								$cal_list->add_where("bbs_db_num = '$bbs_db_num'");
								$cal_list->add_where("bd_ext5='$now'");
								$cal_list->add_order("bd_num ASC"); 
										
								if($cal_list->num_rows()<1) { 
								echo "<img src=\"{$skin_url}images/dot.gif\" border=\"0\" align=\"absmiddle\">��ϵ� ������ �����ϴ�.";
								} else {
								// ���ÿ� �ڷᰡ ���� ��� ǥ��
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