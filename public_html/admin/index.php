<?
/* =====================================================

  최종수정일 : 
 ===================================================== */
	include_once("../include/lib.php");
	require_once("admin_chk.php");

    $rs_list = new $rs_class($dbcon);
	$rs_list->clear();
	$rs_list->set_table($_table['bbs_cfg']);

	if(is_array($ss)) {
		foreach($ss as $__k => $__v) {
			switch ($__k) {
				/***********************************************************************/
				// 검색어로 검색
				case '0' : 
					if($kw!='' && $__v!='') {
						$ss_kw=$dbcon->escape_string($kw,DB_LIKE);
						switch ($__v) {
							case '1' : $rs_list->add_where("bbs_name LIKE '%$ss_kw%' escape '".$dbcon->escape_ch."'"); break;
							case '2' : $rs_list->add_where("bbs_code LIKE '%$ss_kw%' escape '".$dbcon->escape_ch."'"); break;
							case '3' : $rs_list->add_where("bbs_db LIKE '%$ss_kw%' escape '".$dbcon->escape_ch."'"); break;
							case '4' : $rs_list->add_where("bbs_skin LIKE '%$ss_kw%' escape '".$dbcon->escape_ch."'"); break;
						}
						unset($ss_kw);
					}
					break; 
				/***********************************************************************/
				// 필터 조건에 의한 필터링
				case '1' : // 
					if($__v != '') { $rs_list->add_where("$__v =  gr_num"); } break;
			}
		}
	}

	switch ($ot) {
		case 10 : $rs_list->add_order("bbs_num DESC");		break;
		default : $rs_list->add_order("bbs_num DESC");		break;
	}
	
  $page_info=$rs_list->select_list($page,20,10);

  $now_date1 = date("Y");
  $now_date2 = date("m");
  $now_date3 = date("d");

  $now_imsi_date = mktime(0,0,0,$now_date2,$now_date3-1,$now_date1);

  $now_date11 = rg_date($now_imsi_date, '%Y');
  $now_date12 = rg_date($now_imsi_date, '%m');
  $now_date13 = rg_date($now_imsi_date, '%d');
?>	

<? include("_header.php"); ?>
<? include("admin.header.php"); ?>
<table border="0" cellpadding="0" cellspacing="0" width="800" align="center">
  <tr height="40">
    <td background="images/title_bg.gif" style="padding:9pt 0pt 0pt 10pt" valign="top"><font color=#000000><b>관리자 페이지 [<?=rg_date(time(),"%Y.%m.%d")?>]</b></font></td>
  </tr>
</table>
<br>
<table border="0" cellspacing="0" cellpadding="0" width="800" align="center">
   <tr>
     <td class="a_sub_title">2일간 등록내역</td>
   </tr>
</table>
<?
    $rs_list = new $rs_class($dbcon);
	$rs_list->clear();
	$rs_list->set_table($_table['regi']);
    $rs_list->add_where("(abroad_date1 = $now_date1 and abroad_date2 = $now_date2 and abroad_date3 = $now_date3) or (abroad_date1 = $now_date11 and abroad_date2 = $now_date12 and abroad_date3 = $now_date13)");	
    $rs_list->add_order("regi_no DESC");		
	
	$page_info=$rs_list->select_list($page,5,10);

?>
<table border="0" cellpadding="0" cellspacing="0" width="800" align=center bgcolor="#FFFFFF">
    <tr>  
     <td>
  <table border="0" cellpadding="0" cellspacing="0" width="800" align=center>
	<tr>
		<td bgcolor="#666666" height="2"></td>
	</tr> 
	<tr>
		<td bgcolor="#FFFFFF" height="8"></td>
	</tr> 
  </table>
<table width="770" border="0" cellspacing="0" cellpadding="0"  align=center>
	<tr bgcolor="#456285" height="25">
	    <td width="40" align="center" class="tt6">NO</td>
		<td width="60" align="center" class="tt6">이름</td>
		<td width="50" align="center" class="tt6">지사</td>
		<td width="70" align="center" class="tt6">상담일</td> 
		<td width="70" align="center" class="tt6">등록일</td>
		<td width="70" align="center" class="tt6">출국일</td>
		<td width="70" align="center" class="tt6">국가</td>
		<td width="90" align="center" class="tt6">전화번호</td> 
		<td width="160" align="center" class="tt6">이메일</td>
		<td width="90" align="center" class="tt6">진행상황</td>	
	</tr>
 <?
	if($rs_list->num_rows()<1) {
		echo "
	<tr height=\"50\"  bgcolor=\"#FFFFFF\">
		<td align=\"center\" colspan=\"10\" ><B>등록(검색) 된 자료가 없습니다.</td>
	</tr>
	<tr>
		<td bgcolor=\"#BECCDD\" height=\"1\" colspan=\"10\"></td>
	</tr>		
		";
	}
	
	$rs_list->set_table($_table['regi']);
	
	
	$no = $page_info['start_no'];
	while($R=$rs_list->fetch()) {
		$no--;
?>
	<tr height="25"> 
		<td align="center" class="tt5"><a href="regi_edit.php?<?=$p_str?>&page=<?=$page?>&mode=modify&num=<?=$R[regi_no]?>&pp=1"><?=$no?></a></td>
		<td align="center" class="tt5"><a href="regi_edit.php?<?=$p_str?>&page=<?=$page?>&mode=modify&num=<?=$R[regi_no]?>&pp=1"><?=$R[student_name]?></a></td>	
		<td align="center" class="tt5"><a href="regi_edit.php?<?=$p_str?>&page=<?=$page?>&mode=modify&num=<?=$R[regi_no]?>&pp=1"><?=$_regi['chain'][$R[chain]]?></a></td>
		<td align="center" class="tt5"><a href="regi_edit.php?<?=$p_str?>&page=<?=$page?>&mode=modify&num=<?=$R[regi_no]?>&pp=1"><?=$R[regi_date1]?>.<?=$R[regi_date2]?>.<?=$R[regi_date3]?></a></td>	
		<td align="center" class="tt5"><a href="regi_edit.php?<?=$p_str?>&page=<?=$page?>&mode=modify&num=<?=$R[regi_no]?>&pp=1"><?=$R[abroad_date1]?>.<?=$R[abroad_date2]?>.<?=$R[abroad_date3]?></a></td>	
		<td align="center" class="tt5"><a href="regi_edit.php?<?=$p_str?>&page=<?=$page?>&mode=modify&num=<?=$R[regi_no]?>&pp=1"><?=$R[airpoet_date1]?>.<?=$R[airpoet_date2]?>.<?=$R[airpoet_date3]?></a></td>	
		<td align="center" class="tt5"><a href="regi_edit.php?<?=$p_str?>&page=<?=$page?>&mode=modify&num=<?=$R[regi_no]?>&pp=1"><?if($R[national]){?><img src=images/main_real_national<?=$R[national]?>.gif border=0>&nbsp;<?=$_const['national'][$R[national]]?><?}else{?>-<?}?></a></td>
		<td align="center" class="tt5"><a href="regi_edit.php?<?=$p_str?>&page=<?=$page?>&mode=modify&num=<?=$R[regi_no]?>&pp=1"><?=$R[tel]?></a></td>
		<td align="center" class="tt5"><a href="regi_edit.php?<?=$p_str?>&page=<?=$page?>&mode=modify&num=<?=$R[regi_no]?>&pp=1"><?=$R[email]?></a></td>
        <td align="center" class="tt5"><?=$_process['process_state'][$R[process_state]]?></td>
	</tr>
	<tr>
		<td bgcolor="#BECCDD" height="1" colspan="10"></td>
	</tr>
<?
	}
?>
	<tr>
		<td height="8" colspan="10"></td>
	</tr>	
	<tr>
		<td align="center"  colspan="10"><?=rg_navi_display($page_info,$_get_param[2]); ?></td>
	</tr>
</table>
  <table border="0" cellpadding="0" cellspacing="0" width="800" align=center>
	<tr>
		<td bgcolor="#FFFFFF" height="8"></td>
	</tr> 	
	<tr>
		<td bgcolor="#666666" height="2"></td>
	</tr> 
  </table>

  </td>
  </tr>
</table>
<br>
<table border="0" cellspacing="0" cellpadding="0" width="800" align="center">
   <tr>
     <td class="a_sub_title">2일간 상담 예약 [48시간 이내 기준]</td>
   </tr>
</table>
<?
	$rs_ger = new $rs_class($dbcon);
	$rs_ger->clear();
	$rs_ger->set_table($_table['ger_sangdam']);
	$rs_ger->add_where("reg_date > (unix_timestamp(now())-172800)"); 
	$rs_ger->add_order("id DESC");
	$page_info=$rs_ger->select_list($page,5,10);
?>
<table border="0" cellpadding="0" cellspacing="0" width="800" align=center bgcolor="#FFFFFF">
    <tr>  
     <td>
  <table border="0" cellpadding="0" cellspacing="0" width="800" align=center>
	<tr>
		<td bgcolor="#666666" height="2"></td>
	</tr> 
	<tr>
		<td bgcolor="#FFFFFF" height="8"></td>
	</tr> 
  </table>
<table width="770" border="0" cellspacing="0" cellpadding="0"  align=center>
	<tr bgcolor="#456285" height="25">
	    <td width="40" class="tt6">NO</td>
		<td width="50" class="tt6">이름</td>
		<td width="60" class="tt6">지사</td>		
		<td width="140" class="tt6">핸드폰번호</td> 
		<td width="160" class="tt6">이메일</td>
		<td width="100" class="tt6">희망연수국가</td>
		<td width="90" class="tt6">희망방문일시</td>
		<td width="90" class="tt6">상담일</td> 
		<td width="80"  align="center" class="tt6">예약상태</td>
		<td width="80"  align="center" class="tt6">상담상태</td>
	</tr>

<?
	if($rs_ger->num_rows()<1) {
		echo "
	<tr height=\"50\">
		<td align=\"center\" colspan=\"12\"><B>등록(검색) 된 자료가 없습니다.</td>
	</tr>
	<tr>
		<td bgcolor=\"#BECCDD\" height=\"1\" colspan=\"10\"></td>
	</tr>		
	";
	}
	
	$no = $page_info['start_no'];
	while($ger=$rs_ger->fetch()) {
		
		$no--;	
?>
	<tr>
	<tr height="25">
		<td align="center" class="tt5"><a href="ger_real_edit.php?<?=$p_str?>&page=<?=$page?>&mode=modify&num=<?=$ger[id]?>"><?=$no?></a></td>
		<td align="center" class="tt5"><a href="ger_real_edit.php?<?=$p_str?>&page=<?=$page?>&mode=modify&num=<?=$ger[id]?>"><?=$ger[name]?></a></td>
		<td align="center" class="tt5"><a href="ger_real_edit.php?<?=$p_str?>&page=<?=$page?>&mode=modify&num=<?=$ger[id]?>"><?=$_regi['chain'][$ger[chain]]?></a></td>
		<td align="center" class="tt5"><a href="ger_real_edit.php?<?=$p_str?>&page=<?=$page?>&mode=modify&num=<?=$ger[id]?>"><?=$ger[phone]?></a></td>
		<td align="center" class="tt5"><a href="ger_real_edit.php?<?=$p_str?>&page=<?=$page?>&mode=modify&num=<?=$ger[id]?>"><?=$ger[email]?></a></td>
		<td align="center" class="tt5"><a href="ger_real_edit.php?<?=$p_str?>&page=<?=$page?>&mode=modify&num=<?=$ger[id]?>"><?if($ger[national]){?><img src=images/main_real_national<?=$ger[national]?>.gif border=0>&nbsp;<?=$_const['national'][$ger[national]]?><?}else{?>-<?}?></a></td>
		<td align="center" class="tt5"><a href="ger_real_edit.php?<?=$p_str?>&page=<?=$page?>&mode=modify&num=<?=$ger[id]?>"><?=rg_date($ger[hope_day],'%y.%m.%d')?></a></td>
		<td align="center" class="tt5"><a href="ger_real_edit.php?<?=$p_str?>&page=<?=$page?>&mode=modify&num=<?=$ger[id]?>"><?=rg_date($ger[$R[phone_sangdam]],'%y.%m.%d')?></a></td>
		<td align="center" class="tt5"><a href="ger_real_edit.php?<?=$p_str?>&page=<?=$page?>&mode=modify&num=<?=$ger[id]?>"><?=$_reserv['transaction'][$ger[transaction]]?></a></td>
		<td align="center" class="tt5"><a href="ger_real_edit.php?<?=$p_str?>&page=<?=$page?>&mode=modify&num=<?=$ger[id]?>"><?=$_reserv['sangdam'][$ger[sangdam]]?></a></td>
	</tr>
	<tr>
		<td bgcolor="#BECCDD" height="1" colspan="10"></td>
	</tr>
<?
	}
?>
	<tr>
		<td height="8" colspan="10"></td>
	</tr>	
	<tr>
		<td align="center"  colspan="10"><?=rg_navi_display($page_info,$_get_param[2]); ?></td>
	</tr>
</table>
  <table border="0" cellpadding="0" cellspacing="0" width="800" align=center>
	<tr>
		<td bgcolor="#FFFFFF" height="8"></td>
	</tr> 	
	<tr>
		<td bgcolor="#666666" height="2"></td>
	</tr> 
  </table>

  </td>
  </tr>
</table>
<br>
<table border="0" cellspacing="0" cellpadding="0" width="800" align="center">
   <tr>
     <td><iframe src="./alim.php" width="800" height="250" border="0" frameborder="no" scrolling="no" marginwidth="0" hspace="0" vspace="0"></iframe></td>
   </tr>
</table>
<br>

<table border="0" cellspacing="0" cellpadding="0" width="800" align="center">
   <tr>
     <td class="a_sub_title">2일간 회원가입 [48시간 이내 기준]</td>
   </tr>
</table>
<?
	$rs_mb = new $rs_class($dbcon);
	$rs_mb->clear();
	$rs_mb->set_table($_table['member']);
	$rs_mb->add_where("join_date > (unix_timestamp(now())-172800)"); 
	$rs_mb->add_order("mb_num DESC");
	$page_info=$rs_mb->select_list($page,5,10);
?>
<table border="0" cellpadding="0" cellspacing="0" width="800" align=center bgcolor="#FFFFFF">
    <tr>  
     <td>
  <table border="0" cellpadding="0" cellspacing="0" width="800" align=center>
	<tr>
		<td bgcolor="#666666" height="2"></td>
	</tr> 
	<tr>
		<td bgcolor="#FFFFFF" height="8"></td>
	</tr> 
  </table>
<table width="770" border="0" cellspacing="0" cellpadding="0"  align=center>
	<tr bgcolor="#456285" height="25">
	    <td width="40" class="tt6">NO</td>
		<td width="70" class="tt6">아이디</td>
		<td width="50" class="tt6">이름</td>
		<td width="90" class="tt6">핸드폰번호</td> 
		<td width="160" class="tt6">이메일</td>
		<td width="80" class="tt6">희망연수국가</td>
		<td width="100" class="tt6">가입 IP</td>
		<td width="140" class="tt6">주소</td>
		<td width="70"  align="center" class="tt6">회원상태</td>
	</tr>

<?
	if($rs_mb->num_rows()<1) {
		echo "
	<tr height=\"50\">
		<td align=\"center\" colspan=\"12\"><B>등록(검색) 된 자료가 없습니다.</td>
	</tr>
	<tr>
		<td bgcolor=\"#BECCDD\" height=\"1\" colspan=\"9\"></td>
	</tr>		
	";
	}
	
	$no = $page_info['start_no'];
	while($mb=$rs_mb->fetch()) {		
	 $no--;	
     $mb_address = rg_cut_string($mb[mb_address1], 20, "..");
?>
	<tr>
	<tr height="25">
		<td align="center" class="tt5"><a href="member_edit.php?<?=$p_str?>&page=<?=$page?>&mode=modify&num=<?=$mb[mb_num]?>"><?=$no?></a></td>
		<td align="center" class="tt5"><a href="member_edit.php?<?=$p_str?>&page=<?=$page?>&mode=modify&num=<?=$mb[mb_num]?>"><?=$mb[mb_id]?></a></td>
		<td align="center" class="tt5"><a href="member_edit.php?<?=$p_str?>&page=<?=$page?>&mode=modify&num=<?=$mb[mb_num]?>"><?=$mb[mb_name]?></a></td>
		<td align="center" class="tt5"><a href="member_edit.php?<?=$p_str?>&page=<?=$page?>&mode=modify&num=<?=$mb[mb_num]?>"><?=$mb[mb_tel2]?></a></td>
		<td align="center" class="tt5"><a href="member_edit.php?<?=$p_str?>&page=<?=$page?>&mode=modify&num=<?=$mb[mb_num]?>"><?=$mb[mb_email]?></a></td>
		<td align="center" class="tt5"><a href="member_edit.php?<?=$p_str?>&page=<?=$page?>&mode=modify&num=<?=$mb[mb_num]?>"><?if($mb['mb_ext1']){?><img src=images/main_real_national<?=$mb['mb_ext1']?>.gif border=0>&nbsp;<?=$_const['national'][$mb['mb_ext1']]?></a><?}else{?>-<?}?></td>
		<td align="center" class="tt5"><a href="member_edit.php?<?=$p_str?>&page=<?=$page?>&mode=modify&num=<?=$mb[mb_num]?>"><?=$mb['join_ip']?></a></td>
		<td align="center" class="tt5"><a href="member_edit.php?<?=$p_str?>&page=<?=$page?>&mode=modify&num=<?=$mb[mb_num]?>"><?=$mb_address?></a></td>
		<td align="center" class="tt5"><a href="member_edit.php?<?=$p_str?>&page=<?=$page?>&mode=modify&num=<?=$mb[mb_num]?>"><?=$_const['member_states'][$mb[mb_state]]?></a></td>

	</tr>
	<tr>
		<td bgcolor="#BECCDD" height="1" colspan="9"></td>
	</tr>
<?
	}
?>
	<tr>
		<td height="8" colspan="10"></td>
	</tr>	
	<tr>
		<td align="center"  colspan="10"><?=rg_navi_display($page_info,$_get_param[2]); ?></td>
	</tr>
</table>
  <table border="0" cellpadding="0" cellspacing="0" width="800" align=center>
	<tr>
		<td bgcolor="#FFFFFF" height="8"></td>
	</tr> 	
	<tr>
		<td bgcolor="#666666" height="2"></td>
	</tr> 
  </table>

  </td>
  </tr>
</table>
<br>
<table border="0" cellspacing="0" cellpadding="0" width="800" align="center">
   <tr>
     <td class="a_sub_title">접속통계 <a href="counter.php">[접속통계 자세히보기]</a></td>
   </tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" width="800" align=center bgcolor="#FFFFFF">
    <tr>  
     <td>
  <table border="0" cellpadding="0" cellspacing="0" width="800" align=center>
	<tr>
		<td bgcolor="#666666" height="2"></td>
	</tr> 
	<tr>
		<td bgcolor="#FFFFFF" height="8"></td>
	</tr> 
  </table>
<table width="770" border="0" cellspacing="0" cellpadding="0"  align=center>
	<tr>
		<td bgcolor="#BECCDD" height="1" colspan="6"></td>
	</tr>
	<tr>
		<td>
		<td bgcolor="#FFFFFF" height="60" align=center><? include("../counter/admin_main.php"); ?></td>
	</tr>
	<tr>
		<td bgcolor="#BECCDD" height="1" colspan="6"></td>
	</tr>
</table>
  <table border="0" cellpadding="0" cellspacing="0" width="800" align=center>
	<tr>
		<td bgcolor="#FFFFFF" height="8"></td>
	</tr> 	
	<tr>
		<td bgcolor="#666666" height="2"></td>
	</tr> 
  </table>
  </td>
  </tr>
</table>
<br>
<table border="0" cellspacing="0" cellpadding="0" width="800" align="center">
   <tr>
     <td class="a_sub_title">게시판관리</td>
   </tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" width="800" align=center bgcolor="#FFFFFF">
    <tr>  
     <td>
  <table border="0" cellpadding="0" cellspacing="0" width="800" align=center>
	<tr>
		<td bgcolor="#666666" height="2"></td>
	</tr> 
	<tr>
		<td bgcolor="#FFFFFF" height="8"></td>
	</tr> 
  </table>
<table width="770" border="0" cellspacing="0" cellpadding="0"  align=center>
	<tr>
		<td bgcolor="#BECCDD" height="1" colspan="6"></td>
	</tr>
	<tr>
		<td>
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
	<tr bgcolor="#FFFFFF">
		<?
		while($bbs_info=$rs_bbs->fetch()) {
			if($i % 6 == 0) echo "<tr>";
			$i++;
?>
		<td bgcolor="#FFFFFF" width=800/6 height="30" align=center><a href="<?=$_url['bbs']?>list.php?bbs_code=<?=$bbs_info['bbs_code']?>" target=_blank><?=$bbs_info['bbs_name']?></a></td>
<?
		}
?>	
		</tr>
	<tr>
		<td bgcolor="#BECCDD" height="1" colspan="6"></td>
	</tr>
<?
}
?>
</table>
  <table border="0" cellpadding="0" cellspacing="0" width="800" align=center>
	<tr>
		<td bgcolor="#FFFFFF" height="8"></td>
	</tr> 	
	<tr>
		<td bgcolor="#666666" height="2"></td>
	</tr> 
  </table>

  </td>
  </tr>
</table>
<? include("admin.footer.php"); ?>
<? include("_footer.php"); ?>