<? if (!defined('RGBOARD_VERSION')) exit; ?>
<?
	// 글목록
	$_skin['i_reply']="<font color=blue style=font-size:8pt>└</font>"; // 응답글 아이콘
	$_skin['reply_depth']=8; // 응답글 깊이
	$_skin['i_comment_count']='<font color=blue style=font-size:8pt>[$bd_comment_count]</font>'; // 코멘트수
	$_skin['i_new']=' <font color=red style=font-size:8pt>new</font>'; // new 아이콘
	$_skin['i_secret']='<font color=blue>[비밀]</font>'; // 비밀글 아이콘
	$_skin['i_delete1']='<font color=red>- 삭제된글입니다. -</font>'; // 삭제글
	$_skin['i_delete2']='<font color=red>[삭제]$bd_subject</font>'; // 삭제글(관리자)
	$_skin['i_notice']='<font color=blue>[공지]</font>'; // 공지사항
	$_skin['i_currnet']='->'; // 현재글
	
	$_skin_use_image_resize=true;
	$_skin_image_limit_width=800; // 최대 이미지크기 (정해진 넓이 이상이면 사이즈 조정)
	$_skin_thumb_image_width=140; // 목록 이미지 넓이
	$_skin_thumb_image_height=100; // 목록 이미지 높이
	$_path['bbs_data_img_rezise']	= $_path['data'].'board_img_resize/';	// 섬네일 파일

	if(eregi('\/down\.php$',$_SERVER['PHP_SELF']) && $mode=='view_resize') {
		// 섬네일처리
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
		
		if($bd_files[$key] && rg_file_type_chk($bd_files[$key]['type'],'image')) {
			if(!is_dir($_path['bbs_data_img_rezise'])) {
				if(!mkdir($_path['bbs_data_img_rezise'],0707)) {
					rg_href('',"섬네일 이미지 디렉토리 생성실패 {$_path['bbs_data_img_rezise']} 폴더를 만들어주세요.\\n권한(퍼미션)은 707 로 설정",'back');
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
			rg_href('','파일정보가 올바르지 못합니다.','back');
		exit;
	}
?>