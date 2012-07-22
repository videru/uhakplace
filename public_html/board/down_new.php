<?
/* =====================================================
  최종수정일 : 
2007-07-27 큐브리드에서 다운로드 안되는 현상수정(sql문 버그)
 ===================================================== */
	include_once("../include/lib.php");
	include_once($_path['inc']."lib_bbs.php");

	$tmp_level=$_gmb_info['gm_level'];
	if($tmp_level=='') $tmp_level=0;
	$vcfg['use_download']=($_view_cfg['use_download'] <= $tmp_level);
	$vcfg['view_image']=($_view_cfg['view_image'] <= $tmp_level);

	if(file_exists($skin_path.'setup.php')) include($skin_path.'setup.php');
	
	if(!$validate->number_only($bd_num)) {
		exit;
	}
	
	if(!$vcfg['view_image'] && $mode=='view') rg_href('','권한이 없습니다.','back');
	if(!$vcfg['use_download'] && $mode=='down') rg_href('','권한이 없습니다.','back');
	
	$rs->clear();
	$rs->set_table($_table['bbs_body']);
	$rs->add_where("bbs_db_num={$_bbs_info['bbs_db_num']}");
	$rs->add_where("bd_num=$bd_num");
	$data=$rs->fetch();	
	if(!$data) {
		rg_href("list.php?$_get_param[3]");
		exit;
	}

	extract($data);
	$bd_files=unserialize($bd_files);

	if($bd_files[$key]) {
		if($mode=='down')
			$type='application/octet-stream';
		else
			$type=$bd_files[$key]['type'];
		
		if(file_exists($_path['bbs_data'].$bd_files[$key][sname])) {
			$LastModified = gmdate("D d M Y H:i:s", filemtime($_path['bbs_data'].$bd_files[$key][sname])); 
			header("Last-Modified: $LastModified GMT"); 
			header("ETag: \"$LastModified\""); 
			echo ($_path['bbs_data'].$bd_files[$key][sname]);
				
				if($mode=='down') {
				$bd_files[$key][hits]++;
				$bd_files=serialize($bd_files);
				$rs->add_field("bd_files",$bd_files);
				$rs->update();
				$rs->commit();
				rg_file_download($_path['bbs_data'].$bd_files[$key][sname],$bd_files[$key][name],$type);
						
			}
		} else 
			rg_href('','파일이 없습니다.','back');
	}
	else
		rg_href('','파일정보가 올바르지 못합니다.','back');
?>