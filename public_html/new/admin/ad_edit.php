<?
	include_once("../include/lib.php");
	require_once("admin_chk.php");
	

	if($mode=='modify' || $mode=='delete') {
		$rs->clear();
		$rs->set_table(	$_table['cf']);
		$rs->add_where("co_no=$num");
		$rs->select();
		if($rs->num_rows()!=1) { // ������ �ùٸ��� �ʴٸ�
			rg_href('','������ ã���� �����ϴ�.','back');
		}
		$data=$rs->fetch();
		
	} else {
		$data=$rs->fetch();		
	}
 	
		// ��� ����
	if($mode=='delete') {	
		$rs->clear();
		$rs->set_table($_table['cf']);
		$rs->add_where("co_no=$num");
		$rs->delete();
		
		$rs->commit();
		rg_href("ad_list.php?$_get_param[3]");
	}

	if($_SERVER['REQUEST_METHOD']=='POST') {

		$rs->clear();
		$rs->set_table($_table['cf']);

		$rs->add_field("company_name","$company_name");
		$rs->add_field("president_name","$president_name");
		$rs->add_field("silmu_name","$silmu_name");
		$rs->add_field("company_email","$company_email");
		$rs->add_field("company_tel","$company_tel");
		$rs->add_field("company_hp","$company_hp");
		$rs->add_field("etc","$etc");
	
		if($mode=='modify') {
			$rs->add_where("co_no=$num");
			$rs->update();
			$rs->commit();
		}

		rg_href("ad_list.php?$_get_param[3]");
	}
?>

<? include("_header.php"); ?>
<? include("admin.header.php"); ?>
<table border="0" cellpadding="0" cellspacing="0" width="800" align="center">
  <tr height="40">
    <td background="images/title_bg.gif" style="padding:9pt 0pt 0pt 10pt" valign="top"><font color=#000000><b>������</b></font></td>
  </tr>
</table>
<form name="regi_form" method="post" action="?<?=$_get_param[3]?>" onSubmit="return validate(this)" enctype="multipart/form-data">
<input type="hidden" name="mode" value="<?=$mode?>" />
<input type="hidden" name="page" value="<?=$page?>" />
<input type="hidden" name="num" value="<?=$num?>" />
<table border="0" cellspacing="0" cellpadding="0" width="800" align="center">
   <tr>
     <td class="a_sub_title"><b>������ <? if($mode=='modify') { ?>����<?}else{?>����<? } ?></td>
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

<table border="0" cellpadding="0" cellspacing="0" width="770" align="center">    
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>ȸ���</strong></td>
		<td><input name="company_name" type="text" value="<?=$data['company_name']?>" class="cc" size=30></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>��ǥ�ڸ�</strong></td>
		<td><input name="president_name" type="text" value="<?=$data['president_name']?>" class="cc" size=8></td>
	</tr>    
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>����ڸ�</strong></td>
		<td><input name="silmu_name" type="text" value="<?=$data['silmu_name']?>" class="cc" size=8></td>
	</tr>	
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>�̸���</strong></td>
		<td><input name="company_email" type="text" value="<?=$data['company_email']?>" class="cc" size=30></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>��ȭ</strong></td>
		<td><input name="company_tel" type="text" value="<?=$data['company_tel']?>" class="cc" size=15></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>�ڵ���</strong></td>
		<td><input name="company_hp" type="text" value="<?=$data['company_hp']?>" class="cc" size=15></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>��Ÿ�ϽǸ���</strong></td>
		<td><textarea name="etc" cols=80  rows=8  class=textarea><?=$data['etc']?></textarea></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
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
<table width="200" border="0"  align=center>
	<tr>
		<td width="100" align="center"><input type="submit" value=" �� �� " class="button"></td>
		<td width="100" align="center"><input type=button value=" �� �� " onClick="history.back();"  class="button"></td>
	</tr>
</table>
</form>
<? include("admin.footer.php"); ?>
<? include("_footer.php"); ?>