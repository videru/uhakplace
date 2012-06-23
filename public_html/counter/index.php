<?
/* =====================================================

  ���������� : 
 ===================================================== */
	include_once("../include/lib.php");
	require_once($_path['counter'].'counter.lib.php');
	
	// ���Ӱ��� üũ
	if(!$rg_counter_access_guest && (!$rg_counter_access_guest && !$_auth['admin'])) {
		rg_href($_url['member']."login.php?ret_url=".$_SERVER['PHP_SELF'],"�����ڸ� ���� �����մϴ�.");
	}
		
	$today = mktime(0,0,0,date('m'),date('d'),date('Y'));
	// �ִ� �ּ� �⵵
	$rs->clear();
	$rs->set_table($_table['prefix'].'counter_day');
	$rs->add_field('min(reg_date) as min_date');
	$rs->add_field('max(reg_date) as max_date');
	$rs->fetch('min_date,max_date');
	
	if(!$min_date) $min_date=$today;
	
	if(!$max_date) $max_date=$today;
	
	$min_year=date('Y',$min_date);
	$max_year=date('Y',$max_date);
	
	$min_year_month=date('m',$min_date);
	$max_year_month=date('m',$max_date);

	$type_list=array('main','hour','day','month','year','br','os','res','host','search','log');
	if(!in_array($type,$type_list)) $type='main';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>�������� - �������</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link href="<?=$_url['css']?>style.css" rel="stylesheet" type="text/css">
</head>
<script src="<?=$_url['js']?>common.js"></script>
<script src="<?=$_url['js']?>lib.validate.js"></script>
<style type="text/css">
<!--
.btn1 {
	border: 1px solid;
}

td.title {
  text-align: center;
  padding-top: 2pt;
  padding-bottom: 2pt;
  background-color = rgb(245,245,255);
}

th.sunday {
  text-align: center;
  background-color: rgb(255,220,224);
  border-style: none;
}

th.saturday {
  text-align: center;
  background-color: rgb(224,220,255);
  border-style: none;
}

th.weekday {
  text-align: center;
  background-color: rgb(221,221,221);
  border-style: none;
}

td.invalid {
  text-align: center;
}

td.valid {
  text-align: center;
  background-color: #c8F8F8;
}

td.today {
  text-align: center;
  background-color: rgb(248,255,240);
}

td.omonth {
  text-align: center;
  background-color: rgb(248,245,240);
}

tr.omonth {
  text-align: center;
  background-color: #f8f8c8;
}

p.title {
  font-weight:bold
}

p.sunday {
  color: #D00000;
}

p.saturday {
  color: #0000D0;
}

p.weekday {
  color: #000000;
}

p.today {
	font-weight:bold;
}

.smaller {
}

a.2			{ text-decoration:none; }
a.2:link		{color: #ff0000;font-family: ����;font-size: 9pt;text-decoration: none}
a.2:active	{color: #ccffff;font-family: ����;font-size: 9pt;text-decoration: none}
a.2:visited	{color: #ff0000;font-family: ����;font-size: 9pt;text-decoration: none}
a.2:hover		{color: #3078a8;font-family: ����;font-size: 9pt;text-decoration: none}

-->
</style>
</head>
<script src="calendar.js"></script>
<body>
<?
	$bg[$type]='bgcolor="#8DB9F3"';
?>
<div align="center">
<table width="726" border="0" align="center" cellpadding="0" cellspacing="0" class="site_content">
  <tr align="center">
    <td width="66" <?=$bg['main']?>><a href="?type=main">ó��</a></td>
    <td width="66" <?=$bg['hour']?>><a href="?type=hour">�ð��뺰</a></td>
    <td width="66" <?=$bg['day']?>><a href="?type=day">�Ϻ�</a></td>
    <td width="66" <?=$bg['month']?>><a href="?type=month">����</a></td>
    <td width="66" <?=$bg['year']?>><a href="?type=year">�⺰</a></td>
    <td width="66" <?=$bg['br']?>><a href="?type=br">������</a></td>
    <td width="66" <?=$bg['os']?>><a href="?type=os">�ü��</a></td>
    <td width="66" <?=$bg['res']?>><a href="?type=res">�ػ�</a></td>
    <td width="66" <?=$bg['search']?>><a href="?type=search">�˻�����</a></td>
    <td width="66" <?=$bg['host']?>><a href="?type=host">ȣ��Ʈ��</a></td>
    <td width="66" <?=$bg['log']?>><a href="?type=log">���ӷα�</a></td>
<?php /*?>    <td width="70"><a href="?type=week">
      <?=(($type=='week')?'<b>':'')?>
      ���Ϻ�</a></td><?php */?>
  </tr>
</table>
<br>
<br>
<?
	include('_'.$type.'.inc.php');
?>
<br>
</div>
<div id="CalendarLayer" style="display:none; width:172px; height:180px">
<iframe name="CalendarFrame" src="<?=$_url['js']?>/lib.calendar.js.htm"
width="172" height="180" border="0" frameborder="0" scrolling="no"></iframe></div>
</body>
</html>
