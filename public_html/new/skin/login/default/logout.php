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
<table width="95%" align="center" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td>
		<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td height="3" bgcolor="#54A8BA"><img width="1" height="1"></td>
			</tr>
			<tr>
				<td height="28" bgcolor="#F4FAFB">&nbsp;&nbsp;로그인 되어 있습니다.</td>
			</tr>
			<tr>
				<td height="1" bgcolor="#54A8BA"><img width="1" height="1"></td>
			</tr>
		</table>
		<table width="100%" align="center" border="0" cellpadding="0" cellspacing="4">
			<tr>
				<td width="60" align="right"><strong>아이디</strong>&nbsp;</td>
				<td><?=$mb_id?> <a href="<?=$_url[member]?>note_recv.php">(<?=$note_cnt?>)</a></td>
			</tr>
			<tr>
				<td height="1" colspan="2" bgcolor="#ECECEC"><img width="1" height="1"></td>
				</tr>
			<tr>
				<td align="right"><strong>레벨</strong></td>
				<td><?=$mb_level_name?></td>
			</tr>
<? if($gr_level_name!='') { ?>
			<tr>
				<td height="1" colspan="2" bgcolor="#ECECEC"><img width="1" height="1"></td>
				</tr>
			<tr>
				<td align="right"><strong>그룹레벨</strong></td>
				<td><?=$gr_level_name?></td>
			</tr>
<? } ?>
		</table>
		<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td height="1" bgcolor="#54A8BA"><img width="1" height="1"></td>
			</tr>
			<tr>
				<td height="5"><img width="1" height="1"></td>
			</tr>
			<tr>
				<td align="center"><input type="button" class="button" value="로그아웃" onClick="location.href='<?=$logout_url?>'">
				  <input type="button" class="button" value="정보수정" onClick="location.href='<?=$modify_url?>'">					</td>
			</tr>
		</table>
		</td>
	</tr>
</table>