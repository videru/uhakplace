<? if (!defined('RGBOARD_VERSION')) exit; ?>
<?
	// �۸��
	$_skin['i_reply']="<font color=blue style=font-size:8pt>��</font>"; // ����� ������
	$_skin['reply_depth']=8; // ����� ����
	$_skin['i_comment_count']='<font color=blue style=font-size:8pt>[$bd_comment_count]</font>'; // �ڸ�Ʈ��
	$_skin['i_new']=' <font color=red style=font-size:8pt>new</font>'; // new ������
	$_skin['i_secret']='<font color=blue>[���]</font>'; // ��б� ������
	$_skin['i_delete1']='<font color=red>- �����ȱ��Դϴ�. -</font>'; // ������
	$_skin['i_delete2']='<font color=red>[����]$bd_subject</font>'; // ������(������)
	$_skin['i_notice']='<font color=blue>[����]</font>'; // ��������
	$_skin['i_currnet']='->'; // �����
	
	$_skin_use_image_resize=true;
	$_skin_image_limit_width=800; // �ִ� �̹���ũ�� (������ ���� �̻��̸� ������ ����)
	$_skin_thumb_image_width=140; // ��� �̹��� ����
	$_skin_thumb_image_height=100; // ��� �̹��� ����
	$_path['bbs_data_img_rezise']	= $_path['data'].'board_img_resize/';	// ������ ����

	if(eregi('\/down\.php$',$_SERVER['PHP_SELF']) && $mode=='view_resize') {
		// ������ó��
		if(!$validate->number_only($bd_num)) {
			exit;
		}
		
		if(!$vcfg['view_image'] && $mode=='view') rg_href('','������ �����ϴ�.','back');
		if(!$vcfg['use_download'] && $mode=='down') rg_href('','������ �����ϴ�.','back');
		
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
		
		if($bd_files[$key] && rg_file_type_chk($bd_files[$key]['type'],'image')) {
			if(!is_dir($_path['bbs_data_img_rezise'])) {
				if(!mkdir($_path['bbs_data_img_rezise'],0707)) {
					rg_href('',"������ �̹��� ���丮 �������� {$_path['bbs_data_img_rezise']} ������ ������ּ���.\\n����(�۹̼�)�� 707 �� ����",'back');
				}
			}
			if(!file_exists($_path['bbs_data_img_rezise'].$bd_files[$key][sname])) {
				include($skin_path.'asido/class.asido.php');
				Asido::Driver('gd');
				$p=pathinfo($_path['bbs_data'].$bd_files[$key][name]);
				
				if(!function_exists('imageGIF') && $p['extension']=='gif') {
					$p['extension']='png';
				}
				$filename=uniqid('___tmp___');
				$i1 = Asido::Image($_path['bbs_data'].$bd_files[$key][sname], $_path['bbs_data_img_rezise'].$filename.'.'.$p['extension']);
				Asido::Frame($i1, $_skin_thumb_image_width, $_skin_thumb_image_height, Asido::Color(0, 0, 0));

				$i1->Save(ASIDO_OVERWRITE_ENABLED);

				rename($_path['bbs_data_img_rezise'].$filename.'.'.$p['extension'],
							 $_path['bbs_data_img_rezise'].$bd_files[$key][sname]);
			}
			$LastModified = gmdate("D d M Y H:i:s", filemtime($_path['bbs_data_img_rezise'].$bd_files[$key][sname])); 
			header("Last-Modified: $LastModified GMT"); 
			header("ETag: \"$LastModified\""); 

			rg_file_download($_path['bbs_data_img_rezise'].$bd_files[$key][sname],'resize_'.$bd_files[$key][name],$bd_files[$key]['type']);
		}
		else
			rg_href('','���������� �ùٸ��� ���մϴ�.','back');
		exit;
	}
?>