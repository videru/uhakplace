<? if (!defined('RGBOARD_VERSION')) exit; ?>
<?
	$rs_note = new $rs_class($dbcon);
	$rs_note->clear();
	$rs_note->set_table($_table['note']);
	$rs_note->add_field("count(*) as cnt");
	$rs_note->add_where("mb_num={$_mb['mb_num']}");
	$rs_note->add_where("recv_mb_num={$_mb['mb_num']}");
	$rs_note->add_where("nt_type=2");
	$rs_note->add_where("nt_save=0");
	$tmp=$rs_note->fetch();
	$note_cnt=$tmp['cnt'];
?>

<table width="95%" align="right" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td width="30">&nbsp;</td>		
		<td width="40"><a href="<?=$logout_url?>"><img src="../junior/img/top_t_m5.gif" ></a></td>
		<td align="center"><img src="../junior/img/top_m_line.gif"></td>
		<td width="50"><a href="../intro/mtm.php"><img src="../junior/img/top_t_m3.gif"></a></td>
		<td align="center"><img src="../junior/img/top_m_line.gif"></td>
		<td width="40"><a href="../intro/sitemap.php"><img src="../junior/img/top_t_m4.gif"></a></td>
	</tr>
</table>