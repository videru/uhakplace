<? if (!defined('RGBOARD_VERSION')) exit; ?>
<? if($_mb) { ?>
			<table width="175"  border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td height="10"></td>
				</tr>
				<tr>
					<td height="25" align="center">- 마이페이지 -</td>
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
					<td height="25"><img src="../images/m_sub_icon01.gif" width="18" height="10" align="absmiddle"> <a href="<?=$_url['member']?>modify.php">정보수정</a></td>
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
					<td height="25"><img src="../images/m_sub_icon01.gif" width="18" height="10" align="absmiddle"> <a href="<?=$_url['member']?>login.php?logout">로그아웃</a></td>
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
					<td height="25"><img src="../images/m_sub_icon01.gif" width="18" height="10" align="absmiddle"> <a href="<?=$_url['member']?>leave.php">회원탈퇴</a></td>
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
					<td height="25"><img src="../images/m_sub_icon01.gif" width="18" height="10" align="absmiddle"> <a href="<?=$_url['member']?>point_list.php">포인트내역</a></td>
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
					<td height="25"><img src="../images/m_sub_icon01.gif" width="18" height="10" align="absmiddle"> <a href="<?=$_url['member']?>note_recv.php">받은쪽지함</a></td>
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
					<td height="25"><img src="../images/m_sub_icon01.gif" width="18" height="10" align="absmiddle"> <a href="<?=$_url['member']?>note_sent.php">보낸쪽지함</a></td>
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
					<td height="25"><img src="../images/m_sub_icon01.gif" width="18" height="10" align="absmiddle"> <a href="<?=$_url['member']?>note_save.php">쪽지보관함</a></td>
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
					<td height="25"><img src="../images/m_sub_icon01.gif" width="18" height="10" align="absmiddle"> <a href="javascript:void(0)" onclick="note_write('<?=$_url['member']?>','')">쪽지쓰기</a></td>
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
					<td height="25"><img src="../images/m_sub_icon01.gif" width="18" height="10" align="absmiddle"> <a href="<?=$_url['member']?>login.php">로그인</a></td>
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
					<td height="25"><img src="../images/m_sub_icon01.gif" width="18" height="10" align="absmiddle"> <a href="<?=$_url['member']?>join.php">회원가입</a></td>
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
					<td height="25"><img src="../images/m_sub_icon01.gif" width="18" height="10" align="absmiddle"> <a href="<?=$_url['member']?>find_id.php">아이디찾기</a></td>
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
					<td height="25"><img src="../images/m_sub_icon01.gif" width="18" height="10" align="absmiddle"> <a href="<?=$_url['member']?>find_pass.php">암호찾기</a></td>
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