<? if (!defined('RGBOARD_VERSION')) exit; ?>
<?
/* =====================================================

  ���������� : 2007-07-16
2007-07-16
�˻���� �˻��� AND�������θ� �Ǵ��ͼ���
�˻��� escape ���� üũ
 ===================================================== */
	if(isset($_REQUEST['skin_path'])) exit;

	if(!isset($rs_list))
		$rs_list = new $rs_class($dbcon);
	$rs_list->clear();
	$rs_list->set_table($_table['bbs_body']);
	$rs_list->add_where("bbs_db_num={$_bbs_info['bbs_db_num']}");

	if(!empty($kw) && is_array($ss) && count($ss) > 0 ){
		$ss_kw=$dbcon->escape_string($kw,DB_LIKE);
		$ss_find=array();
		foreach($ss as $__k => $__v) {
			if($__v=='1') {
				switch($__k) {
					// ���̵�
					case 'si' : $ss_find[]="mb_id LIKE '%$ss_kw%' escape '".$dbcon->escape_ch."'"; break;
					// �̸�
					case 'sn' : $ss_find[]="bd_name LIKE '%$ss_kw%' escape '".$dbcon->escape_ch."'"; break;
					// ����
					case 'st' : $ss_find[]="bd_subject LIKE '%$ss_kw%' escape '".$dbcon->escape_ch."'"; break;
					// ����
					case 'sc' : $ss_find[]="bd_content LIKE '%$ss_kw%' escape '".$dbcon->escape_ch."'"; break;
				}
			}
		}		
		if(count($ss_find) > 0) {
			if($ss['sf'] == 'and') {
				$rs_list->add_where("(".implode(" AND ",$ss_find).")");
			} else {
				$rs_list->add_where("(".implode(" OR ",$ss_find).")");
			}
		}
		unset($ss_find);
		unset($ss_kw);
	}

	if(is_array($ss)) {
		foreach($ss as $__k => $__v) {
			if(in_array($__k,array('si','sn','st','sc','sf'))) continue;
			switch ($__k) {
				/***********************************************************************/
				// ���� ���ǿ� ���� ���͸�
				case 'cat' : // ī�װ�
					if($__v != '') { $rs_list->add_where("$__v =  cat_num"); } break;
			}
		}
	}
	
//	$dbcon->set_debug(3);
	
	$rs->set_table($_table['bbs_body']);
	$field_list=$rs_list->list_fields();
	if(isset($ot) && is_array($ot)) {
		foreach($ot as $__k => $__v) {
			if(in_array($__k,$field_list['Field'])) {
				if($__v)
					$rs_list->add_order("$__k ASC");
				else
					$rs_list->add_order("$__k DESC");
			}
		}
	} else {
		if(isset($ot) && in_array($ot,$field_list['Field'])) {
			if($__v)
				$rs_list->add_order("$__k ASC");
			else
				$rs_list->add_order("$__k DESC");
		} else {
		//	$rs_list->add_order("bd_next_num DESC");
			$rs_list->add_order("bd_notice DESC");
			//$rs_list->add_order("bd_ext3 DESC");
			$rs_list->add_order("bd_write_date DESC");
			$rs_list->add_order("bd_next_num DESC");
		}
	}
	if(file_exists($skin_path.'list_where.php')) include($skin_path.'list_where.php');
?>