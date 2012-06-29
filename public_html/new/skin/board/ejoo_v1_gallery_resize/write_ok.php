<? if (!defined('RGBOARD_VERSION')) exit; ?>
<?
	if($mode=='modify' || $mode=='delete') {
		rg_upload_file_delete($_path['bbs_data_img_rezise'],$data['bd_files']);
	}
		
	// 파일 업로드, 이미지 사이즈 조정
	if($wcfg['use_upload'] && ($mode=='modify' || $mode=='write' || $mode=='reply')) {
		include($skin_path.'asido/class.asido.php');
		Asido::Driver('gd');

		$bd_files=unserialize($bd_files);		
		foreach($bd_files as $key => $v) {
			if(!rg_file_type_chk($bd_files[$key]['type'],'image')) continue;

			$img_info=getimagesize($_path['bbs_data'].$bd_files[$key]['sname']);
			
			if($img_info[0]>$_skin_image_limit_width) {
				$p=pathinfo($_path['bbs_data'].$bd_files[$key][name]);
				if($p['filename']=='') {
					$p['filename']=substr($p['basename'],0, strrpos($p['basename'],'.'));
				}

				if(!function_exists('imageGIF') && $p['extension']=='gif') {
					$p['extension']='png';
					$v['type']='image/x-png';
				}
				
				$filename=uniqid('___tmp___');
				$i1 = Asido::Image($_path['bbs_data'].$bd_files[$key][sname], $_path['bbs_data'].$filename.'.'.$p['extension']);
				Asido::width($i1, $_skin_image_limit_width);
	
				$i1->Save(ASIDO_OVERWRITE_ENABLED);
				unlink($_path['bbs_data'].$bd_files[$key][sname]);
				rename($_path['bbs_data'].$filename.'.'.$p['extension'],
							 $_path['bbs_data'].$bd_files[$key][sname]);
							 
				$bd_files[$key]['name']=$p['filename'].'.'.$p['extension'];
				$bd_files[$key]['size']=filesize($_path['bbs_data'].$bd_files[$key][sname]);
				$bd_files[$key]['type']=$v['type'];
			}
		}

		$bd_files=serialize($bd_files);		
		$rs->clear();
		$rs->set_table($_table['bbs_body']);
		$rs->add_field("bd_files","$bd_files");
		$rs->add_where("bd_num=$bd_num");
		$rs->update();

	}
?>