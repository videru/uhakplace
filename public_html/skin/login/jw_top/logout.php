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

<table align=right border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td align="right"><b><?=$_mb['mb_name']?>(<?=$mb_id?>)</b> <? if($mb_level>'9') { ?><a href="../admin/" target="_blank">[ADMIN]</a><? } ?><td >
		<td width="6">&nbsp;</td>
		<td width="49"><a href="<?=$logout_url?>"><img src="../img/top_logout.gif"  border="0"></td>
		<td width="6">&nbsp;</td>
		<td width="48"><a href="<?=$modify_url?>"><img src="../img/top_modify.gif" border="0"></a></td>
	</tr>
</table>