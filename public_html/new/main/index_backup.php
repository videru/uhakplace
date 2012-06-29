<?
	include_once("../include/lib.php");
?>
<? include_once('_header.php'); ?>
<?
	$rs_bbs = new $rs_class($dbcon);
	$rs_group = new $rs_class($dbcon);
	$rs_group->clear();
	$rs_group->set_table($_table['group']);
	$rs_group->add_where("gr_state=1");
	$rs_group->add_order("gr_num");
	while($g_info=$rs_group->fetch()) {
		$rs_bbs->clear();
		$rs_bbs->set_table($_table['bbs_cfg']);
		$rs_bbs->add_where("gr_num={$g_info['gr_num']}");
		$rs_bbs->add_order("bbs_num");
		$i=0;
?>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="5" bordercolorlight="#ffffff" bordercolordark="#FFFFFF">
  <tr align="center" bgcolor="#dbe9f8">
    <td height="30" colspan="2"><?=$g_info['gr_name']?></td>
  </tr>
<?
		while($bbs_info=$rs_bbs->fetch()) {
			if($i % 2 == 0) echo "<tr>";
			$i++;
?>
    <td align="center" valign="top" width="50%" height="120">
		<?=rg_lastest($bbs_info['bbs_code'],'default',5,40)?>
		</td>
<?
		}
?>
</table><br />
<?
	}
?>
<? include_once('_footer.php'); ?>