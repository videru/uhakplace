<? if (!defined('RGBOARD_VERSION')) exit; ?>
<? if($_mb) { ?>
			<table width="175"  border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td height="10"></td>
				</tr>
				<tr>
					<td height="25" align="center">- ���������� -</td>
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
				<tr>
					<td height="25"><img src="../images/m_sub_icon01.gif" width="18" height="10" align="absmiddle"> <a href="<?=$_url['member']?>modify.php">��������</a></td>
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
				<tr>
					<td height="25"><img src="../images/m_sub_icon01.gif" width="18" height="10" align="absmiddle"> <a href="<?=$_url['member']?>login.php?logout">�α׾ƿ�</a></td>
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
				<tr>
					<td height="25"><img src="../images/m_sub_icon01.gif" width="18" height="10" align="absmiddle"> <a href="<?=$_url['member']?>leave.php">ȸ��Ż��</a></td>
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
				<tr>
					<td height="25"><img src="../images/m_sub_icon01.gif" width="18" height="10" align="absmiddle"> <a href="<?=$_url['member']?>point_list.php">����Ʈ����</a></td>
				</tr>
				<tr>
					<td><table width="95%"  border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td width="5" height="1"></td>
							<td height="2" bgcolor="#C1C1C1"></td>
							<td width="5" height="1"></td>
						</tr>
						<tr>
							<td height="1" colspan="3"></td>
						</tr>
					</table></td>
				</tr>
				<tr>
					<td height="25"><img src="../images/m_sub_icon01.gif" width="18" height="10" align="absmiddle"> <a href="<?=$_url['member']?>note_recv.php">����������</a></td>
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
				<tr>
					<td height="25"><img src="../images/m_sub_icon01.gif" width="18" height="10" align="absmiddle"> <a href="<?=$_url['member']?>note_sent.php">����������</a></td>
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
				<tr>
					<td height="25"><img src="../images/m_sub_icon01.gif" width="18" height="10" align="absmiddle"> <a href="<?=$_url['member']?>note_save.php">����������</a></td>
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
				<tr>
					<td height="25"><img src="../images/m_sub_icon01.gif" width="18" height="10" align="absmiddle"> <a href="javascript:void(0)" onclick="note_write('<?=$_url['member']?>','')">��������</a></td>
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
			</table>
<? } else { ?>
			<table width="175"  border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td height="10"></td>
				</tr>
				<tr>
					<td height="25" align="center">- Member -</td>
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
				<tr>
					<td height="25"><img src="../images/m_sub_icon01.gif" width="18" height="10" align="absmiddle"> <a href="<?=$_url['member']?>login.php">�α���</a></td>
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
				<tr>
					<td height="25"><img src="../images/m_sub_icon01.gif" width="18" height="10" align="absmiddle"> <a href="<?=$_url['member']?>join.php">ȸ������</a></td>
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
				<tr>
					<td height="25"><img src="../images/m_sub_icon01.gif" width="18" height="10" align="absmiddle"> <a href="<?=$_url['member']?>find_id.php">���̵�ã��</a></td>
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
				</tr>				<tr>
					<td height="25"><img src="../images/m_sub_icon01.gif" width="18" height="10" align="absmiddle"> <a href="<?=$_url['member']?>find_pass.php">��ȣã��</a></td>
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
			</table>
<? } ?>