<?
/* =====================================================

  최종수정일 : 
 ===================================================== */
	include_once("../include/lib.php");
	
	$tmp=base64_decode($mb_data);
	parse_str($tmp, $mb_data);
	unset($tmp);
	
	$mb_num=$mb_data['mb_num'];
	$key=$mb_data['key'];
	
	if(!$validate->number_only($mb_num)) {
		rg_href('','파일정보가 올바르지 못합니다.','back');
		exit;
	}
	
	$rs->clear();
	$rs->set_table($_table['member']);
	$rs->add_where("mb_num=".$dbcon->escape_string($mb_num));
	$rs->select();
	if($rs->num_rows()!=1) { // 회원정보가 올바르지 않다면
		rg_href('','회원정보를 찾을수 없습니다.','back');
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
		rg_href('','파일정보가 올바르지 못합니다.','back');
?>