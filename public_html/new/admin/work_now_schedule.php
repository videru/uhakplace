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
		<td height="42" style="background-image:url(images/today_schedule.gif);background-repeat:no-repeat; background-position:5 0; padding:5 0 0 50; font-family:����; font-weight:bold; font-size:11px; color:FFFFFF;">������ ����(<?=$thisyear?>. <?=$thismonth?>�� <?=$today?>��,<?=$yoil?>)
		</TD>
</TR>
						<tr>
							<td bgcolor="#ffffff" height="110" style='padding:7px;word-break:break-all' valign="top"><?
								//��� ����
								$now=mktime(0,0,0,$today_month,$today_day,$today_year);
								$cal_list = new $rs_class($dbcon);						
								$cal_list->clear();
								$cal_list->set_table($_table['today_work']);
								$cal_list->add_where("regi_date='$now'");
								$cal_list->add_order("c_no ASC"); 
										
								if($cal_list->num_rows()<1) { 
								?>��ϵ� ������ �����ϴ�.<?						
								 } else {
								// ���ÿ� �ڷᰡ ���� ��� ǥ��
								while($cal=$cal_list->fetch()) {
									$c_no=$cal['c_no'];						
									$regi_date=$cal['regi_date'];																			
									  $title=rg_conv_text($cal['today_work']);

							   	?><a href="javascript:open_window('regi', 'today_work_edit.php?book=<?=$regi_date?>', 600, 550, 650, 450, 0, 0, 0, 1, 0);")><?=$title?></a><br><?	}
								}
								?></TD>
	</TR>
</TABLE>