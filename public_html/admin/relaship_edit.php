<?

	include_once("../include/lib.php");
	require_once("admin_chk.php");
	

	if($mode=='modify' || $mode=='delete') {
		$rs->clear();
		$rs->set_table($_table['relaship']);
		$rs->add_where("num=$num");
		$rs->select();
		if($rs->num_rows()!=1) { // ������ �ùٸ��� �ʴٸ�
			rg_href('','������ ã���� �����ϴ�.','back');
		}
		$data=$rs->fetch();		
	} else {
		$data=$rs->fetch();		
	}
	
   // ����
	if($mode=='delete') {	
		
		// �б� ����
		$rs->clear();
		$rs->set_table($_table['relaship']);
		$rs->add_where("num=$num");
		$rs->delete();
		
		$rs->commit();
		rg_href("relaship_list.php?$_get_param[3]");
	}

	if($_SERVER['REQUEST_METHOD']=='POST') {

			$rs->clear();
	    	$rs->set_table($_table['relaship']);
			$rs->add_field("title","$title");		
	    	$rs->add_field("area","$area");
			$rs->add_field("info","$info");	
			$rs->add_field("memo","$memo");	

		if($mode=='modify') {
			$rs->add_where("num=$num");
			$rs->update();
		} else {
			$rs->insert();
			$num=$rs->get_insert_id();		
		}
		
		$rs->commit();
		rg_href("relaship_list.php?$_get_param[3]");
	}


	$MENU_L='m5';

?>
<?
include_once('../editor/func_editor.php');
$content = "$data[info]";
?>
<? include("_header.php"); ?>
<? include("admin.header.php"); ?>
<table border="1" cellpadding="6" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1">
  <tr>
    <td bgcolor="#F7F7F7">���迬�� ���� <? if($mode=='modify') { ?>����<?}else{?>���<? } ?>	</td>
  </tr>
</table>
<br>
<form name="mb_form" method="post" action="?<?=$_get_param[3]?>" enctype="multipart/form-data">
<input type="hidden" name="mode" value="<?=$mode?>" />
<input type="hidden" name="num" value="<?=$num?>" />
<table border="1" cellpadding="3" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1">
	<tr>
		<td align="center" bgcolor="#F0F0F4"><strong>����</strong></td>
		<td><input name="title" type="text" value="<?=$data['title']?>" class="input" size=110></td>
	</tr>
	<tr>
		<td align="center" bgcolor="#F0F0F4"><strong>����</strong></td>
		<td><select name="area" class="input" id="area">
<?if($mode=="modify"){?>
<?=rg_html_option($_relaship['national'],$data['area'])?>
<?}else{?>
<?=rg_html_option($_relaship['national'],$area)?>
<?}?>
</select></td>
	</tr>	
	<tr>
		<td align="center" bgcolor="#F0F0F4"><strong>�����Ұ�</strong></td>
		<td><?=myEditor(1,'../editor','mb_form','info','660','200');?></td>
	</tr>
	<tr>
		<td align="center" bgcolor="#F0F0F4"><strong>�޸�</strong></td>
		<td><textarea name="memo" cols=78  rows=2 class=textarea><?=$data['memo']?></textarea></td>
	</tr>	
</table>
<br>
<table width="600" border="0" align="center">
	<tr>
		<td align="center">
			<input type="submit" value="���/����" class="button"  onClick="editor_wr_ok();">
			<input type="button" value=" ��   �� " onClick="history.back();" class="button">
		</td>
	</tr>
</table>
</form>
<? include("admin.footer.php"); ?>
<? include("_footer.php"); ?>