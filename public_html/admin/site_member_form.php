<?
	include_once("../include/lib.php");
	require_once("admin_chk.php");

	if($_SERVER['REQUEST_METHOD']=="POST" && $mode == "update"){
		unset($tmp);
		$rs->clear();
		$rs->set_table($_table['setup']);
		$rs->add_field("ss_content",serialize($member_form));
		$rs->add_where("ss_name='member_form'");
		$rs->update();
		
		$rs->commit();
		
		rg_href('?');
	}

	// 사이트 설정
	$rs->clear();
	$rs->set_table($_table['setup']);
	$rs->add_field("ss_content");
	$rs->add_where("ss_name='member_form'");
	$rs->select();
	if($rs->num_rows()<1) {
		$rs->clear_field();
		$rs->add_field("ss_name","member_form");
		$rs->insert();
		$rs->commit();
		
		$rs->clear_field();
		$rs->add_field("ss_content");
		$rs->select();
	}
	$rs->fetch('tmp');
	$member_form = unserialize($tmp);
		
	$MENU_L='m1';	
?>
<? include("_header.php"); ?>
<? include("admin.header.php"); ?>
<table border="0" cellspacing="0" cellpadding="0" width="100%" class="site_content">
  <tr>
    <td bgcolor="#F7F7F7">기본정보 &gt; 회원항목설정</td>
  </tr>
</table>
<br>
<form name=form1 method=post action="?" onSubmit="return validate(this)">
  <input type=hidden name=mode value="update">
  <table border="0" cellspacing="0" cellpadding="0" width="100%" align="center">
    <tr>
      <td class="a_sub_title">회원항목설정</td>
    </tr>
  </table>
  <table border="0" cellpadding="0" cellspacing="0" width="100%" class="site_content">
  	<col width="110" align="right" />
    <col align="left" />
<?
	$i=0;
	if(is_array($_const['member_forms'])) 
	foreach($_const['member_forms'] as $k => $v) {
		$i++;
?>
    <tr>
      <th align="right"><?=$v?>&nbsp;:&nbsp;</th>
      <td>&nbsp;<?=rg_html_radio("member_form[{$k}]",$_const['member_form_state'],$member_form[$k])?></td>
    </tr>
<?
	}
?>
	</table>
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
