<?
/* =====================================================
	
  ���������� : 
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

	// ����Ʈ ����
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
	
	// ���� ����
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
    <td bgcolor="#F7F7F7">ȯ�漳��</td>
  </tr>
</table>
<br>
<form name=form1 method=post action="?" onSubmit="return validate(this)">
  <input type=hidden name=mode value="update">
  <table border="0" cellspacing="0" cellpadding="0" width="100%" align="center">
    <tr>
      <td class="a_sub_title">����Ʈ ȯ�漳��</td>
    </tr>
  </table>
  <table border="0" cellpadding="0" cellspacing="0" width="100%" class="site_content">
    <tr>
      <td width="120" align="center" bgcolor="#F0F0F4">����Ʈ �̸�</td>
      <td><input name="site_info[site_name]" type="text" class="input" value="<?=$site_info['site_name']?>" size="50" required hname='����Ʈ�̸�'></td>
    </tr>
    <tr>
      <td width="120" align="center" bgcolor="#F0F0F4">��� �̸�</td>
      <td><input name="site_info[admin_name]" type="text" class="input" value="<?=$site_info['admin_name']?>" size="50" required hname='����̸�'></td>
    </tr>
    <tr>
      <td align="center" bgcolor="#F0F0F4">��� �̸���</td>
      <td><input name="site_info[admin_email]" type="text" class="input" value="<?=$site_info['admin_email']?>" size="50" required hname="����̸���" option="email"></td>
    </tr>
    <tr>
      <td bgcolor="#F0F0F4" align="center">��� ����ó</td>
      <td><input type="text" class="input" name="site_info[admin_tel]" value="<?=$site_info['admin_tel']?>"></td>
    </tr>

    <tr>
      <td bgcolor="#F0F0F4" align="center">�߼��̸����ּ�</td>
      <td><input name="site_info[mail_from]" type="text" class="input" value="<?=$site_info['mail_from']?>" size="50" hname="�߼��̸����ּ�"></td>
    </tr>
    <tr>
      <td bgcolor="#F0F0F4" align="center">ȸ���̸����ּ�</td>
      <td><input name="site_info[mail_return]" type="text" class="input" value="<?=$site_info['mail_return']?>" size="50" option="email" hname="ȸ���̸����ּ�"></td>
    </tr>
    <?php /*?>		<tr>
			<td align="center" bgcolor="#F0F0F4">��ȣ</td>
			<td><input type="text" class="input" name="site_info[company_name]" value="<?=$site_info['company_name']?>">
				��ȣ�� �Է��ϼ���.</td>
		</tr>
		<tr>
			<td align="center" bgcolor="#F0F0F4">����� �ּ�</td>
			<td><input type="text" class="input" name="site_info[address]" value="<?=$site_info['address']?>" size=50>
				�ּҸ� �Է��ϼ���.</td>
<?php */?>
  </table>
  <br>
  <table border="0" cellspacing="0" cellpadding="0" width="100%" align="center">
    <tr>
      <td class="a_sub_title">����Ʈ����</td>
    </tr>
  </table>
  <table border="0" cellpadding="0" cellspacing="0" width="100%" class="site_content">
    <tr>
      <td width="120" align="center" bgcolor="#F0F0F4">�ű԰��Խ�</td>
      <td><input type="text" class="input" name="site_info[join_point]" value="<?=$site_info['join_point']?>" size=10 option="number" hname="��������Ʈ" dir="rtl"> 
      ���ڷθ� �Է� </td>
    </tr>
    <tr>
      <td width="120" align="center" bgcolor="#F0F0F4">�α��ν�</td>
      <td><input type="text" class="input" name="site_info[login_point]" value="<?=$site_info['login_point']?>" size=10 option="number" hname="�α�������Ʈ" dir="rtl"> 
      ���ڷθ� �Է� </td>
    </tr>
  </table>
  <br>
  <table border="0" cellspacing="0" cellpadding="0" width="100%" align="center">
    <tr>
      <td class="a_sub_title">ȸ�� ȯ�漳��</td>
    </tr>
  </table>
  <table border="0" cellpadding="0" cellspacing="0" width="100%" class="site_content">
    <tr>
      <td width="120" align="center" bgcolor="#F0F0F4">ȸ�� �⺻ ���� </td>
      <td><?=rg_html_radio("site_info[join_state]",$_const['member_states'],$site_info['join_state'],NULL,NULL,'','','','&nbsp;&nbsp;')?>			
			</td>
    </tr>
    <tr>
      <td align="center" bgcolor="#F0F0F4">ȸ�� �⺻ ����</td>
      <td><select name="site_info[join_level]">
<?=rg_html_option($level_info,$site_info['join_level'],NULL,NULL,NULL)?>
</select></td>
    </tr>
    <tr>
      <td align="center" bgcolor="#F0F0F4">Ż�����</td>
      <td><?=rg_html_radio("site_info[leave_state]",array(1=>"ȸ������ ��û���","Ż�� ���·� ����"),$site_info['leave_state'],NULL,NULL,'','','','&nbsp;&nbsp;')?>
			</td>
    </tr>
<?php /*?>    <tr>
      <td align="center" bgcolor="#F0F0F4">ȸ�����Ծ��</td>
      <td><textarea class="input" name="member_agreement" rows="10" style="width:98%;"><?=$member_agreement?></textarea></td>
    </tr><?php */?>
    <tr>
      <td align="center" bgcolor="#F0F0F4">��Ÿ����</td>
      <td><input type="checkbox" name="site_info[join_login]" value="1" <?=(($site_info['join_login']=='1')?'checked':'')?>>������ �ڵ��α���</td>
    </tr>
  </table>
  <br>
  <table border="0" cellspacing="0" cellpadding="0" width="100%" align="center">
    <tr>
      <td class="a_sub_title">������ �̸�����</td>
    </tr>
  </table>
  <table id="tb1" border="0" cellpadding="0" cellspacing="0" width="100%" class="site_content">
    <tr>
      <th align="right" width="120">����&nbsp;</th>
      <th>&nbsp;�����̸� (0 : ��ȸ��, <?=$_const['admin_level']?> : ������)</th>
    </tr>
<?
	$i=0;
	if(is_array($level_info)) 
	foreach($level_info as $k => $v) {
		$i++;
?>
    <tr>
      <td align="right"><input type="text" class="input" name=level_info[level][] value="<?=$k?>" size="3" dir="rtl">&nbsp;</td>
      <td>&nbsp;<input type="text" class="input" name=level_info[name][] value="<?=$v?>" size=50> <input type="button" value="����" class="button" onClick="level_delete(event)"></td>
    </tr>
<?
	}
?>
	</table>
  <table border="0" cellpadding="0" cellspacing="0" width="100%" class="site_content">
    <tr>
      <td align="center"><input type="button" value=" �� �� " class="button" onClick="level_insert()"></td>
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
		tmp.innerHTML ='&nbsp;<input type="text" class="input" name=level_info[name][] value="" size=50> <input type="button" value="����" class="button" onClick="level_delete(event)">';
	}
}
</script>
  <br>
  <table width="100%" align="center">
    <tr>
      <td align=center><input type="submit" value=" �� �� " class="button">
      </td>
    </tr>
  </table>
</form>
<? include("admin.footer.php"); ?>
<? include("_footer.php"); ?>
