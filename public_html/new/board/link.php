<?
/* =====================================================

  ���������� : 
2007-07-27 ť�긮�忡�� ��ũ �ȵǴ� �������(sql�� ����)
 ===================================================== */
	include_once("../include/lib.php");
	include_once($_path['inc']."lib_bbs.php");

	$tmp_level=$_gmb_info['gm_level'];
	if($tmp_level=='') $tmp_level=0;
	$vcfg['use_download']=($_view_cfg['use_download'] <= $tmp_level);

	if(file_exists($skin_path.'setup.php')) include($skin_path.'setup.php');
	
	if(!$validate->number_only($bd_num)) {
		exit;
	}
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
	$bd_links=unserialize($bd_links);
	
	if($bd_links[$key]) {
		$url=$bd_links[$key][url];
		$bd_links[$key][hits]++;
		$bd_links=serialize($bd_links);
		$rs->add_field("bd_links",$bd_links);
		$rs->update();
		$rs->commit();
		rg_href("$url");
	}
	else
		rg_href('','��ũ������ �ùٸ��� ���մϴ�.','back');
?>