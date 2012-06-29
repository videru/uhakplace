<?
/* =====================================================

  최종수정일 : 
 ===================================================== */
/*
	2007-07-10 현재 사용안함
*/
	include_once("../include/lib.php");
	require_once("admin_chk.php");

	if($_SERVER['REQUEST_METHOD']=="POST" && $mode == "update"){
		$rs->clear();
		$rs->set_table($_table['setup']);
		$rs->add_field("ss_content",$deny_word);
		$rs->add_where("ss_name='deny_word'");
		$rs->update();

		$rs->clear();
		$rs->set_table($_table['setup']);
		$rs->add_field("ss_content",$deny_html);
		$rs->add_where("ss_name='deny_html'");
		$rs->update();
		
		$rs->clear();
		$rs->set_table($_table['setup']);
		$rs->add_field("ss_content",$deny_ip);
		$rs->add_where("ss_name='deny_ip'");
		$rs->update();

		rg_href('?');
	}

	// 차단단어
	$rs->clear();
	$rs->set_table($_table['setup']);
	$rs->add_field("ss_content");
	$rs->add_where("ss_name='deny_word'");
	$rs->select();
	if($rs->num_rows()<1) {
		$rs->clear_field();
		$rs->add_field("ss_name","deny_word");
		$rs->insert();

		$rs->clear_field();
		$rs->add_field("ss_content");
		$rs->select();
	}
	$rs->fetch('deny_word');

	// 차단html
	$rs->clear();
	$rs->set_table($_table['setup']);
	$rs->add_field("ss_content");
	$rs->add_where("ss_name='deny_html'");
	$rs->select();
	if($rs->num_rows()<1) {
		$rs->clear_field();
		$rs->add_field("ss_name","deny_html");
		$rs->insert();

		$rs->clear_field();
		$rs->add_field("ss_content");
		$rs->select();
	}
	$rs->fetch('deny_html');
	
	// 차단아이피
	$rs->clear();
	$rs->set_table($_table['setup']);
	$rs->add_field("ss_content");
	$rs->add_where("ss_name='deny_ip'");
	$rs->select();
	if($rs->num_rows()<1) {
		$rs->clear_field();
		$rs->add_field("ss_name","deny_ip");
		$rs->insert();

		$rs->clear_field();
		$rs->add_field("ss_content");
		$rs->select();
	}
	$rs->fetch('deny_ip');

	
	$MENU_L='m1';	
?>
<? include("_header.php"); ?>
<? include("admin.header.php"); ?>
<table border="0" cellspacing="0" cellpadding="0" width="100%" class="site_content">
  <tr>
    <td bgcolor="#F7F7F7">제한설정</td>
  </tr>
</table>
<br>
<form name=form1 method=post action="?" onSubmit="return validate(this)">
  <input type=hidden name=mode value="update">
  <table border="1" cellpadding="0" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1">
    <tr>
      <td width="120" align="center" bgcolor="#F0F0F4">제한할단어목록</td>
      <td><textarea name="deny_word" cols="60" rows="10" class="input"><?=$deny_word?></textarea></td>
    </tr>
    <tr>
      <td align="center" bgcolor="#F0F0F4">제한할HTML</td>
      <td><textarea name="deny_html" cols="60" rows="10" class="input"><?=$deny_html?></textarea></td>
    </tr>
    <tr>
      <td width="120" align="center" bgcolor="#F0F0F4">접속제한 IP </td>
      <td><textarea name="deny_ip" cols="60" rows="10" class="input"><?=$deny_ip?></textarea></td>
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
      <td align=center><input type="submit" value=" 설 정 " class="button">      </td>
    </tr>
  </table>
</form>
<? include("admin.footer.php"); ?>
<? include("_footer.php"); ?>
