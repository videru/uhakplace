<?

	include_once("../include/lib.php");
	require_once("admin_chk.php");
	
  	if($mode=='modify' || $mode=='delete') {
		$rs->clear();
		$rs->set_table(	$_table['sms']);
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
		$rs->set_table($_table['sms']);
		$rs->add_where("num=$num");
		$rs->delete();		
		$rs->commit();
		rg_href("sms_mtm_list.php?$_get_param[3]");
	}

?>
<? include("_header.php"); ?>
<table border="0" cellspacing="0" cellpadding="0" width="300" align="center">
   <tr>
     <td style="padding: 5px 5px 5px 5px"><?=$data['text']?></td>
   </tr>
</table>
<? include("_footer.php"); ?>