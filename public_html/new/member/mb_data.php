<?
/* =====================================================

  ���������� : 
 ===================================================== */
	include_once("../include/lib.php");
	
	$tmp=base64_decode($mb_data);
	parse_str($tmp, $mb_data);
	unset($tmp);
	
	$mb_num=$mb_data['mb_num'];
	$key=$mb_data['key'];
	
	if(!$validate->number_only($mb_num)) {
		rg_href('','���������� �ùٸ��� ���մϴ�.','back');
		exit;
	}
	
	$rs->clear();
	$rs->set_table($_table['member']);
	$rs->add_where("mb_num=".$dbcon->escape_string($mb_num));
	$rs->select();
	if($rs->num_rows()!=1) { // ȸ�������� �ùٸ��� �ʴٸ�
		rg_href('','ȸ�������� ã���� �����ϴ�.','back');
	}
	$data=$rs->fetch();
	
	$data['mb_files']=unserialize($data['mb_files']);
	
	if($data['mb_files'][$key]) {
		if($mode=='down')
			$type='application/octet-stream';
		else
			$type=$data['mb_files'][$key]['type'];

		$LastModified = gmdate("D d M Y H:i:s", filemtime($_path['member_data'].$data['mb_files'][$key][sname])); 
		header("Last-Modified: $LastModified GMT"); 
		header("ETag: \"$LastModified\""); 

		rg_file_download($_path['member_data'].$data['mb_files'][$key][sname],$data['mb_files'][$key][name],$type);
	}
	else
		rg_href('','���������� �ùٸ��� ���մϴ�.','back');
?>