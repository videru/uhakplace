<? if (!defined('RGBOARD_VERSION')) exit; ?>
			<table width="175"  border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td height="10"></td>
				</tr>
				<tr>
					<td height="25" align="center">- <?=$_group_info['gr_name']?> -</td>
				</tr>
				<tr>
					<td><table width="95%"  border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td width="5" height="1"></td>
							<td height="1" bgcolor="#C1C1C1"></td>
							<td width="5" height="1"></td>
						</tr>
						<tr>
							<td height="1" colspan="3"></td>
						</tr>
					</table></td>
				</tr>
<?
	$rs->clear();
	$rs->set_table($_table['bbs_cfg']);
	$rs->add_where("gr_num={$_group_info['gr_num']}");
	while($tmp_bbs=$rs->fetch()) {
?>
				<tr>
					<td height="25"><img src="../images/m_sub_icon01.gif" width="18" height="10" align="absmiddle"> <a href="../rg4_board/list.php?bbs_code=<?=$tmp_bbs['bbs_code']?>"><?=$tmp_bbs['bbs_name']?></a></td>
				</tr>
				<tr>
					<td><table width="95%"  border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td width="5" height="1"></td>
							<td height="1" bgcolor="#C1C1C1"></td>
							<td width="5" height="1"></td>
						</tr>
						<tr>
							<td height="1" colspan="3"></td>
						</tr>
					</table></td>
				</tr>
<?
	}
?>
			</table>