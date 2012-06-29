<?
/* =====================================================
	
  최종수정일 : 
 ===================================================== */
	include_once("../include/lib.php");
	require_once("admin_chk.php");

	if($_SERVER['REQUEST_METHOD']=="POST" && $mode == "update"){
		$rs->clear();
		$rs->set_table($_table['setup']);
		$rs->add_field("ss_content",serialize($site_info));
		$rs->add_where("ss_name='site_info'");
		$rs->update();
		
		unset($tmp);
		foreach($level_info['level'] as $k => $v)
			if($v!='')
				$tmp[$v]=$level_info['name'][$k];
		ksort($tmp);
		$rs->clear();
		$rs->set_table($_table['setup']);
		$rs->add_field("ss_content",serialize($tmp));
		$rs->add_where("ss_name='level_info'");
		$rs->update();
		
		$rs->commit();
		
		rg_href('?');
	}

	// 사이트 설정
	$rs->clear();
	$rs->set_table($_table['setup']);
	$rs->add_field("ss_content");
	$rs->add_where("ss_name='site_info'");
	$rs->select();
	if($rs->num_rows()<1) {
		$rs->clear_field();
		$rs->add_field("ss_name","site_info");
		$rs->insert();

		$rs->clear_field();
		$rs->add_field("ss_content");
		$rs->select();
	}
	$rs->fetch('tmp');
	$site_info = unserialize($tmp);
	
	// 레벨 정보
	$rs->clear();
	$rs->set_table($_table['setup']);
	$rs->add_field("ss_content");
	$rs->add_where("ss_name='level_info'");
	$rs->select();
	if($rs->num_rows()<1) {
		$rs->clear_field();
		$rs->add_field("ss_name","level_info");
		$rs->insert();

		$rs->clear_field();
		$rs->add_field("ss_content");
		$rs->select();
	}
	$rs->fetch('tmp');
	$level_info = unserialize($tmp);

	
	$MENU_L='m1';	
?>
<? include("_header.php"); ?>
<? include("admin.header.php"); ?>
<table border="0" cellspacing="0" cellpadding="0" width="100%" class="site_content">
  <tr>
    <td bgcolor="#F7F7F7">환경설정</td>
  </tr>
</table>
<br>
<form name=form1 method=post action="?" onSubmit="return validate(this)">
  <input type=hidden name=mode value="update">
  <table border="0" cellspacing="0" cellpadding="0" width="100%" align="center">
    <tr>
      <td class="a_sub_title">사이트 환경설정</td>
    </tr>
  </table>
  <table border="0" cellpadding="0" cellspacing="0" width="100%" class="site_content">
    <tr>
      <td width="120" align="center" bgcolor="#F0F0F4">사이트 이름</td>
      <td><input name="site_info[site_name]" type="text" class="input" value="<?=$site_info['site_name']?>" size="50" required hname='사이트이름'></td>
    </tr>
    <tr>
      <td width="120" align="center" bgcolor="#F0F0F4">운영자 이름</td>
      <td><input name="site_info[admin_name]" type="text" class="input" value="<?=$site_info['admin_name']?>" size="50" required hname='운영자이름'></td>
    </tr>
    <tr>
      <td align="center" bgcolor="#F0F0F4">운영자 이메일</td>
      <td><input name="site_info[admin_email]" type="text" class="input" value="<?=$site_info['admin_email']?>" size="50" required hname="운영자이메일" option="email"></td>
    </tr>
    <tr>
      <td bgcolor="#F0F0F4" align="center">운영자 연락처</td>
      <td><input type="text" class="input" name="site_info[admin_tel]" value="<?=$site_info['admin_tel']?>"></td>
    </tr>

    <tr>
      <td bgcolor="#F0F0F4" align="center">발송이메일주소</td>
      <td><input name="site_info[mail_from]" type="text" class="input" value="<?=$site_info['mail_from']?>" size="50" hname="발송이메일주소"></td>
    </tr>
    <tr>
      <td bgcolor="#F0F0F4" align="center">회신이메일주소</td>
      <td><input name="site_info[mail_return]" type="text" class="input" value="<?=$site_info['mail_return']?>" size="50" option="email" hname="회신이메일주소"></td>
    </tr>
    <?php /*?>		<tr>
			<td align="center" bgcolor="#F0F0F4">상호</td>
			<td><input type="text" class="input" name="site_info[company_name]" value="<?=$site_info['company_name']?>">
				상호를 입력하세요.</td>
		</tr>
		<tr>
			<td align="center" bgcolor="#F0F0F4">사업자 주소</td>
			<td><input type="text" class="input" name="site_info[address]" value="<?=$site_info['address']?>" size=50>
				주소를 입력하세요.</td>
<?php */?>
  </table>
  <br>
  <table border="0" cellspacing="0" cellpadding="0" width="100%" align="center">
    <tr>
      <td class="a_sub_title">포인트설정</td>
    </tr>
  </table>
  <table border="0" cellpadding="0" cellspacing="0" width="100%" class="site_content">
    <tr>
      <td width="120" align="center" bgcolor="#F0F0F4">신규가입시</td>
      <td><input type="text" class="input" name="site_info[join_point]" value="<?=$site_info['join_point']?>" size=10 option="number" hname="가입포인트" dir="rtl"> 
      숫자로만 입력 </td>
    </tr>
    <tr>
      <td width="120" align="center" bgcolor="#F0F0F4">로그인시</td>
      <td><input type="text" class="input" name="site_info[login_point]" value="<?=$site_info['login_point']?>" size=10 option="number" hname="로그인포인트" dir="rtl"> 
      숫자로만 입력 </td>
    </tr>
  </table>
  <br>
  <table border="0" cellspacing="0" cellpadding="0" width="100%" align="center">
    <tr>
      <td class="a_sub_title">회원 환경설정</td>
    </tr>
  </table>
  <table border="0" cellpadding="0" cellspacing="0" width="100%" class="site_content">
    <tr>
      <td width="120" align="center" bgcolor="#F0F0F4">회원 기본 상태 </td>
      <td><?=rg_html_radio("site_info[join_state]",$_const['member_states'],$site_info['join_state'],NULL,NULL,'','','','&nbsp;&nbsp;')?>			
			</td>
    </tr>
    <tr>
      <td align="center" bgcolor="#F0F0F4">회원 기본 레벨</td>
      <td><select name="site_info[join_level]">
<?=rg_html_option($level_info,$site_info['join_level'],NULL,NULL,NULL)?>
</select></td>
    </tr>
    <tr>
      <td align="center" bgcolor="#F0F0F4">탈퇴상태</td>
      <td><?=rg_html_radio("site_info[leave_state]",array(1=>"회원정보 즉시삭제","탈퇴 상태로 변경"),$site_info['leave_state'],NULL,NULL,'','','','&nbsp;&nbsp;')?>
			</td>
    </tr>
<?php /*?>    <tr>
      <td align="center" bgcolor="#F0F0F4">회원가입약관</td>
      <td><textarea class="input" name="member_agreement" rows="10" style="width:98%;"><?=$member_agreement?></textarea></td>
    </tr><?php */?>
    <tr>
      <td align="center" bgcolor="#F0F0F4">기타설정</td>
      <td><input type="checkbox" name="site_info[join_login]" value="1" <?=(($site_info['join_login']=='1')?'checked':'')?>>가입후 자동로그인</td>
    </tr>
  </table>
  <br>
  <table border="0" cellspacing="0" cellpadding="0" width="100%" align="center">
    <tr>
      <td class="a_sub_title">레벨별 이름설정</td>
    </tr>
  </table>
  <table id="tb1" border="0" cellpadding="0" cellspacing="0" width="100%" class="site_content">
    <tr>
      <th align="right" width="120">레벨&nbsp;</th>
      <th>&nbsp;레벨이름 (0 : 비회원, <?=$_const['admin_level']?> : 관리자)</th>
    </tr>
<?
	$i=0;
	if(is_array($level_info)) 
	foreach($level_info as $k => $v) {
		$i++;
?>
    <tr>
      <td align="right"><input type="text" class="input" name=level_info[level][] value="<?=$k?>" size="3" dir="rtl">&nbsp;</td>
      <td>&nbsp;<input type="text" class="input" name=level_info[name][] value="<?=$v?>" size=50> <input type="button" value="삭제" class="button" onClick="level_delete(event)"></td>
    </tr>
<?
	}
?>
	</table>
  <table border="0" cellpadding="0" cellspacing="0" width="100%" class="site_content">
    <tr>
      <td align="center"><input type="button" value=" 추 가 " class="button" onClick="level_insert()"></td>
    </tr>
  </table>
<script>
var row_count=<?=$i?>;

function level_delete(e)
{
	var obj = find_parent_tag(e,'td');
	if(obj.parentNode)
		var idx = obj.parentNode.rowIndex;
	else
		var idx = obj.parentElement.rowIndex;
	var tRow = tb1.deleteRow(idx);
}

function level_insert() {
	if(row_count<100) {
		row_count++;
		if(document.getElementById){
			var Tbl = document.getElementById('tb1');
		} else {
			var Tbl = document.all['tb1'];
		}
		var tRow = Tbl.insertRow(-1);  	
		var tmp=tRow.insertCell(0);
		tmp.innerHTML ='<input type="text" class="input" name=level_info[level][] value="" size="3" dir="rtl">&nbsp;';
		tmp.align='right';
		tmp=tRow.insertCell(1);
		tmp.innerHTML ='&nbsp;<input type="text" class="input" name=level_info[name][] value="" size=50> <input type="button" value="삭제" class="button" onClick="level_delete(event)">';
	}
}
</script>
  <br>
  <table width="100%" align="center">
    <tr>
      <td align=center><input type="submit" value=" 설 정 " class="button">
      </td>
    </tr>
  </table>
</form>
<? include("admin.footer.php"); ?>
<? include("_footer.php"); ?>
