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

<table width=980 align=right border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td align=right>
		<a href="http://www.uhakplace.co.kr/new" target="_parent" onFocus="blur();"><img src="../n_img/main_03.jpg" width="48" height="17" border="0" /></a>	
		<a href="<?=$logout_url?>" onFocus="blur();"><img src="../n_img/main_04_1.jpg" width="55" height="17" border="0" /></a><? if($mb_level>'9') { ?><a href="../admin/" target="_blank">[ADMIN]</a><? } ?>
    	<a href="http://www.uhakplace.co.kr/newmember/modify.php" target="_parent" onFocus="blur();"><img src="../n_img/main_05_1.jpg" width="63" height="17" border="0" /></a>
    	<a href="javascript:bookmark();" onFocus="blur();"><img src="../n_img/main_06.jpg" width="64" height="17" border="0" /></a>
		</td>
	</tr>
</table>