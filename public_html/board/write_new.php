<?
/* =====================================================

  최종수정일 : 2007-07-13
2007-07-13
입력값 유효성 검사 : $bd_html,$cat_num,$bd_notice,$bd_reply_mail
 ===================================================== */
	include_once("../include/lib.php");
	include_once($_path['inc']."lib_bbs.php");
	
	if(!in_array($mode,array('modify','reply','delete','write'))) $mode='write';
	
	$tmp_level=$_gmb_info['gm_level'];
	if($tmp_level=='') $tmp_level=0;
	$wcfg['use_html']=($_write_cfg['use_html'] <= $tmp_level);
	$wcfg['use_home']=($_write_cfg['use_home'] <= $tmp_level);
	$wcfg['use_secret']=($_write_cfg['use_secret'] <= $tmp_level);
	$wcfg['use_notice']=($_write_cfg['use_notice'] <= $tmp_level);
	$wcfg['use_upload']=($_write_cfg['use_upload'] <= $tmp_level);
	$wcfg['use_link']=($_write_cfg['use_link'] <= $tmp_level);
	$wcfg['use_reply_mail']=($_write_cfg['use_reply_mail'] <= $tmp_level);
	$wcfg['spam_chk']=($_write_cfg['spam_chk'] > $tmp_level) && ($mode=='write' || $mode=='reply');
	
	$wcfg['writer_name']=$_write_cfg['writer_name'];
	$wcfg['writer_modify']=($_write_cfg['writer_modify'] <= $tmp_level || !$_mb);
	// 권한보다 레벨이 크거나 로그인되어 있지 않다면 입력받는다.

	$wcfg['upload_count']=$_write_cfg['upload_count'];
	$wcfg['link_count']=$_write_cfg['link_count'];
	$wcfg['write_deny_time']=$_write_cfg['write_deny_time'];
	$wcfg['reply_delete']=$_write_cfg['reply_delete'];

	$wcfg['use_category']=$_bbs_info['use_category'];

	$wcfg['input_email']=true;
	$wcfg['input_pass']=($_mb)?false:true;
	$wcfg['input_name']=$wcfg['writer_modify'];
	
	if($_mb) {
		switch($wcfg['writer_name']) {
			case "1" : $s_bd_name = $_mb['mb_name']; break;
			case "2" : $s_bd_name = $_mb['mb_id']; break;
			case "3" : $s_bd_name = $_mb['mb_nick']; break;
			default : $s_bd_name = $_mb['mb_id']; break;
		}
		if($s_bd_name == '') $s_bd_name = $_mb['mb_id'];
	} else {
		$s_bd_name='';
	}
	
	if(file_exists($skin_path.'setup.php')) include($skin_path.'setup.php');
	
	if($mode=='reply' || $mode=='modify' || $mode=='delete') {
		if(!$validate->number_only($bd_num)) {
			rg_href("list_new.php?$_get_param[3]");
			exit;
		}
		$rs->clear();
		$rs->set_table($_table['bbs_body']);
		$rs->add_where("bbs_db_num={$_bbs_info['bbs_db_num']}");
		$rs->add_where("bd_num=$bd_num");
		$data=$rs->fetch();	
		if(!$data) {
			rg_href("list_new.php?$_get_param[3]");
			exit;
		}
		$data['bd_files']=unserialize($data['bd_files']);
		$data['bd_links']=unserialize($data['bd_links']);
		
		$tmp=unserialize($data[bd_ext1]); if(is_array($tmp)) $data[bd_ext1]=$tmp;
		$tmp=unserialize($data[bd_ext2]); if(is_array($tmp)) $data[bd_ext2]=$tmp;
		$tmp=unserialize($data[bd_ext3]); if(is_array($tmp)) $data[bd_ext3]=$tmp;
		$tmp=unserialize($data[bd_ext4]); if(is_array($tmp)) $data[bd_ext4]=$tmp;
		$tmp=unserialize($data[bd_ext5]); if(is_array($tmp)) $data[bd_ext5]=$tmp;
		unset($tmp);

		$_get_param[4]=$p_str;
		$_get_param[4]=$_get_param[4]."&mode=$mode&bd_num=$bd_num";

		$_post_param[4]=$_post_param[3];
		$_post_param[4].='<input type="hidden" name="mode" value="'.$mode."\">\n";
		$_post_param[4].='<input type="hidden" name="bd_num" value="'.$bd_num."\">\n";
	}
	
	if(($mode=='reply' || $mode=='write') && !$_auth['bbs_admin'] &&
			($wcfg['write_deny_time']>0) &&
			($_SESSION['ss_write_date']+$wcfg['write_deny_time'] > time())) {
		$write_deny_time = $wcfg['write_deny_time'];
		$_msg_type='write_deny_time';
		include("msg.php");
		exit;
	}

	switch($mode) {
		case 'write' : 
			if(!$_bbs_auth['write']) {
				if($_mb)
					$_msg_type='write_no_auth_member';
				else
					$_msg_type='write_no_auth_guest';
				include("msg.php");
				exit;
			}
		break;
		case 'reply' : 
			if(!$_bbs_auth['reply']) {
				if($_mb)
					$_msg_type='reply_no_auth_member';
				else
					$_msg_type='reply_no_auth_guest';
				include("msg.php");
				exit;
			}
			if($data['bd_notice']) {
				$_msg_type='reply_no_auth_notice';
				include("msg.php");
				exit;
			}
			// 답변글은 공지등록 안됨
			if($bd_notice){
				$_msg_type='reply_no_notice';
				include("msg.php");
				exit;
			}
			$wcfg['use_notice']=false;
		break;
		case 'modify' : 
// 글수정 정리
/*
글수정 권한이 없는 경우 무조건 글 수정 불가(설정레벨이상만 수정가능)
0. 관리자인경우 무조건 수정가능
1. 로그인 된 경우
  - 자신의 글 아닌경우 : 암호입력, 암호가 없는경우 권한 없음
	- 자신의 글 : 수정화면으로
2. 로그인 안된 경우 
	- 암호입력, 암호가 없는경우 권한 없음
*/
			if(!$_auth['bbs_admin']) {
				if(!$_bbs_auth['modify']) {
					if($_mb)
						$_msg_type='modify_no_auth_member';
					else
						$_msg_type='modify_no_auth_guest';
					include("msg.php");
					exit;
				}
				if($wcfg['reply_delete']=='1' || $wcfg['reply_delete']=='2') {
					$rs->clear();
					$rs->set_table($_table['bbs_body']);
					$rs->add_field('count(*) as reply_chk');
					$rs->add_where("bd_parent_num = {$data['bd_num']}");
					$rs->fetch('reply_chk');
					if($reply_chk > 0) {
						$_msg_type='modify_no_auth_reply';
						include("msg.php");
						exit;
					}
				}
				
				if($_mb) {
					// 회원로그인된 경우
					if($_mb['mb_num']!=$data['mb_num']) {
						// 자신이 쓴글이 아니면
						if($data['bd_pass']=='') {
							// 글 암호가 없다면
							$_msg_type='modify_no_auth_member';
							include("msg.php");
							exit;
						} else {
							// 글 암호 있다면
							if($old_pass=='') { // 입력된 암호 없다면
								// 암호입력
								$_pass_type='modify';
								include("pass.php");
								exit;
							} else {
								// 입력된 암호 있다면 비교
								if($data['bd_pass']!=rg_password_encode($old_pass)) {
									// 암호가 다르다면
									// 에러 메시지 표시
									$_msg_type='modify_pass_error';
									include("msg.php");
									exit;
								}
							} // $old_pass==''
						} // $data['bd_pass']==''
					}				
				} else {
					// 회원로그인 안된경우
					if($data['bd_pass']=='') {

						// 글 암호가 없다면
						$_msg_type='modify_no_auth_guest';
						include("msg.php");
						exit;
					} else {
						// 글 암호가 있다면
						if($old_pass=='') { // 입력된 암호 없다면
							// 암호입력
							$_pass_type='modify';
							include("pass.php");
							exit;
						} else {
							// 입력된 암호 있다면 비교
							if($data['bd_pass']!=rg_password_encode($old_pass)) {
								// 암호가 다르다면
								// 에러 메시지 표시
								$_msg_type='modify_pass_error';
								include("msg.php");
								exit;
							}
						} // $old_pass==''
					} // $data['bd_pass']==''
				} // $_mb
			} // !$_auth['bbs_admin']
			$rs->clear();
			$rs->set_table($_table['bbs_body']);
			$rs->add_field('count(*) as reply_chk');
			$rs->add_where("bd_top_num = {$data['bd_top_num']}");
//			$rs->add_where("bd_notice = 0");
			$rs->fetch('reply_chk');
			if($reply_chk > 1) $wcfg['use_notice']=false; // 관련글이 있을경우 공지사항 등록 불가
		break;
		
		case 'delete' : 
// 글삭제 정리
	/*
	관리자는 확인후 삭제
	로그인되어 있는 경우 
		본인의 글인경우 확인후 삭제
		암호가 있다면 암호 확인후 삭제
		암호가 없다면 삭제불가
	로그인 안되어 있다면
		암호가 있다면 확인후 삭제
		없다면 삭제불가
	
	*/
			$rs->clear();
			$rs->set_table($_table['bbs_body']);
			$rs->add_field('count(*) as reply_chk');
			$rs->add_where("bd_parent_num = {$data['bd_num']}");
			$rs->fetch('reply_chk');
			
			if($_auth['bbs_admin']) {
				if($confirm!='ok') {
					$_confirm_type='delete_admin';
					include("confirm.php");
					exit;
				}
			} else {
				if(!$_bbs_auth['delete']) {
					if($_mb)
						$_msg_type='delete_no_auth_member';
					else
						$_msg_type='delete_no_auth_guest';
					include("msg.php");
					exit;
				}
				if($reply_chk > 0 && ($wcfg['reply_delete']=='1' || $wcfg['reply_delete']=='3')) {
					$_msg_type='delete_no_reply';
					include("msg.php");
					exit;
				}
				if($_mb) {
					// 회원로그인된 경우
					if($_mb['mb_num']==$data['mb_num']) {
						if($confirm!='ok') {
							$_confirm_type='delete_member';
							include("confirm.php");
							exit;
						}
					} else {
						// 자신이 쓴글이 아니면
						if($data['bd_pass']=='') {
							// 글 암호가 없다면
							$_msg_type='delete_no_auth_member';
							include("msg.php");
							exit;
						} else {
							// 글 암호 있다면
							if($old_pass=='') { // 입력된 암호 없다면
								// 암호입력
								$_pass_type='delete';
								include("pass.php");
								exit;
							} else {
								// 입력된 암호 있다면 비교
								if($data['bd_pass']!=rg_password_encode($old_pass)) {
									// 암호가 다르다면
									$_msg_type='delete_pass_error';
									include("msg.php");
									exit;
								}
							} // $old_pass==''
						} // $data['bd_pass']==''
					}				
				} else {
					// 회원로그인 안된경우
					if($data['bd_pass']=='') {
						// 글 암호가 없다면
						$_msg_type='delete_no_auth_guest';
						include("msg.php");
						exit;
					} else {
						// 글 암호가 있다면
						if($old_pass=='') { // 입력된 암호 없다면
							// 암호입력
							$_pass_type='delete';
							include("pass.php");
							exit;
						} else {
							// 입력된 암호 있다면 비교
							if($data['bd_pass']!=rg_password_encode($old_pass)) {
								// 암호가 다르다면
								$_msg_type='delete_pass_error';
								include("msg.php");
								exit;
							}
						} // $old_pass==''
					} // $data['bd_pass']==''
				} // $_mb
			} // $_auth['bbs_admin']
			if($reply_chk > 0 && $wcfg['reply_delete']=='4') { // 삭제표시만
				$rs->clear();
				$rs->set_table($_table['bbs_body']);
				$rs->add_field("bd_delete","1");
				$rs->add_where("bd_num=$bd_num");
				$rs->update();
			} else {			
				rg_upload_file_delete($_path['bbs_data'],$data['bd_files']);
				
				$rs->clear();
				$rs->set_table($_table['bbs_body']);
				$rs->add_where("bd_num=$bd_num");
				$rs->delete();
				
				$rs->clear();
				$rs->set_table($_table['bbs_comment']);
				$rs->add_where("bd_num=$bd_num");
				$rs->delete();
			}
			
			// 글삭제시 포인트 차감
			if($data['bd_depth']=='0' && $data['mb_num']) {
				if($_bbs_info['point_write'] > 0)
					rg_set_point($data['mb_num'],$_po_type_code['bbs'],
										-$_bbs_info['point_write'],'글삭제',$_bbs_info['bbs_name'],'');
			} else {
				if($_bbs_info['point_reply'] > 0 && $data['mb_num'])
					rg_set_point($data['mb_num'],$_po_type_code['bbs'],
										-$_bbs_info['point_reply'],'답글삭제',$_bbs_info['bbs_name'],'');
			}
			$rs->commit();
			rg_href("list_new.php?$_get_param[3]");
			exit;
		break;
	}		
	
	if($_SERVER['REQUEST_METHOD']=='POST' && $_POST['act']=='ok') {
		// 업로드체크 (업로드 체크 안함) 
		// 스킨 setup 에서 체크 가능함
		// include('../include/file_upload_chk.php');

		if($wcfg['spam_chk']) { // 스팸체크루틴
			$schk_code = $_SESSION["schk_".$spam_chk_code];
			if($schk_code =='' || $schk_code != $spam_chk) { // 스팸문자 맞지 않음
				$_msg_type='spam_chk';
				include("msg.php");
				exit;
			}
		}

		if($word = rg_str_inword($_bbs_info['deny_word'],$bd_subject)) {
			$_msg_type='deny_word';
			include("msg.php");
			exit;
		}

		if($word = rg_str_inword($_bbs_info['deny_word'],$bd_content)) {
			$_msg_type='deny_word';
			include("msg.php");
			exit;
		}
		
		if($wcfg['input_name']) {
			if($bd_name=='' && $_mb) $bd_name=$s_bd_name;
			if($bd_name=='') {
				$_msg_type='write_no_name';
				include("msg.php");
				exit;
			}
		} else {
			$bd_name=$s_bd_name;
		}
		
		if($mode!='modify') {
			if($bd_pass=='' && !$_mb) {
				$_msg_type='write_no_pass';
				include("msg.php");
				exit;
			}
		}
		
		if($bd_subject=='') {
			$_msg_type='write_no_subject';
			include("msg.php");
			exit;
		}

		if($bd_content=='') {
			$_msg_type='write_no_content';
			include("msg.php");
			exit;
		}
		
		$bd_html = ($wcfg['use_html'])?$bd_html:'0';
		$bd_home = ($wcfg['use_home'])?rg_homepage_chk($bd_home):'';
		$bd_secret = ($wcfg['use_secret'])?$bd_secret:'0';
		$bd_notice = ($wcfg['use_notice'])?$bd_notice:'0';
		$bd_links = ($wcfg['use_link'])?$bd_links:NULL;
		$bd_files = ($wcfg['use_upload'])?$bd_files:NULL;
		$bd_reply_mail = ($wcfg['use_reply_mail'])?$bd_reply_mail:'0';

		$bd_html 				= ($validate->number_only($bd_html))?$bd_html:'0';
		$cat_num 				= ($validate->number_only($cat_num))?$cat_num:'0';
		$bd_secret 			= ($validate->number_only($bd_secret))?$bd_secret:'0';
		$bd_notice 			= ($validate->number_only($bd_notice))?$bd_notice:'0';
		$bd_reply_mail 	= ($validate->number_only($bd_reply_mail))?$bd_reply_mail:'0';
		$bd_email 			= ($validate->email($bd_email))?$bd_email:'';

		$cat_num				= (isset($_category_info[$cat_num]))?$cat_num:'0';
		
		$is_admin				= ($_auth['bbs_admin'])?'1':'0';
		
		if(!$_auth['bbs_admin'] && $bd_html!='0') {
			$bd_subject = rg_script_conv($_bbs_info['deny_html'],$bd_subject);
			$bd_content = rg_script_conv($_bbs_info['deny_html'],$bd_content);
		}
		
		$rs_write = new $rs_class($dbcon);
		$rs_write->clear();
		$rs_write->set_table($_table['bbs_body']);
		$rs_write->add_field("gr_num",$_bbs_info['gr_num']);
		$rs_write->add_field("bbs_db_num",$_bbs_info['bbs_db_num']);
		$rs_write->add_field("cat_num",$cat_num);
		if($bd_pass!='')
			$rs_write->add_field("bd_pass",rg_password_encode($bd_pass));
		$rs_write->add_field("bd_email",$bd_email);
		$rs_write->add_field("bd_home",$bd_home);
		$rs_write->add_field("bd_subject",$bd_subject);
		$rs_write->add_field("bd_content",$bd_content);
		
		//	$rs_write->add_field("bd_write_date",time());		
      $bd_write_date = mktime(0,0,0, $bd_write_date2, $bd_write_date3, $bd_write_date1);
     
	 //게시판 순서 땜시 어쩔 수 없이 임시로
	 
     if(!$bd_ext3){
	 $bd_ext3 =  $bd_write_date ;
	 }   
			
			
			
			$rs_write->add_field("bd_write_date","$bd_write_date");		

		if(is_array($data['bd_links']))
		foreach($data['bd_links'] as $k => $v) { // 기존 hits 는 유지
			$bd_links[$k][hits]=$data['bd_links'][$k][hits];
		}
		
		if(is_array($bd_links))
		foreach($bd_links as $k => $v) { // url 입력 안된경우 변수에서 제외
			if($v['url']=='') unset($bd_links[$k]);
		}
		
		$rs_write->add_field("bd_links",serialize($bd_links));
		$rs_write->add_field("bd_html",$bd_html);
		$rs_write->add_field("bd_secret",$bd_secret);
		$rs_write->add_field("bd_notice",$bd_notice);
		$rs_write->add_field("bd_reply_mail",$bd_reply_mail);

		if(is_array($bd_ext1)) $bd_ext1=serialize($bd_ext1);
		if(is_array($bd_ext2)) $bd_ext2=serialize($bd_ext2);
		if(is_array($bd_ext3)) $bd_ext3=serialize($bd_ext3);
		if(is_array($bd_ext4)) $bd_ext4=serialize($bd_ext4);
		if(is_array($bd_ext5)) $bd_ext5=serialize($bd_ext5);
		$rs_write->add_field("bd_ext1",$bd_ext1);
		$rs_write->add_field("bd_ext2",$bd_ext2);
		$rs_write->add_field("bd_ext3",$bd_ext3);
		$rs_write->add_field("bd_ext4",$bd_ext4);
		$rs_write->add_field("bd_ext5",$bd_ext5);



		if($mode=='modify') {
			if($wcfg['input_name']) {
				$rs_write->add_field("bd_name",$bd_name);
			}
			$rs_write->add_field("bd_modify_date",time());
			$rs_write->add_field("bd_modify_ip",$_SERVER['REMOTE_ADDR']);
			        
			if($view_hit){
			$rs_write->add_field("bd_view_count",$view_hit);
			}
		} else {
			$rs_write->add_field("bd_name",$bd_name);
			if($_mb) {
				$rs_write->add_field("mb_num",$_mb['mb_num']);
				$rs_write->add_field("mb_id",$_mb['mb_id']);
			} else {
				$rs_write->add_field("mb_num",'0');
				$rs_write->add_field("mb_id",'');
			}


			$rs_write->add_field("bd_write_ip",$_SERVER['REMOTE_ADDR']);
			if($view_hit){
			$rs_write->add_field("bd_view_count",$view_hit);
			}else{
			$rs_write->add_field("bd_view_count","0");
			}

			$rs_write->add_field("bd_delete","0");
		}		

		switch($mode) {
			case 'write' : // 글쓰기
				
				$rs_write->add_field("bd_sequence",'1');
				$rs_write->add_field("bd_depth",'0');
				$rs_write->add_field("is_admin",$is_admin);				
				$rs_write->insert();
				$bd_num=$rs_write->get_insert_id();
				
				if($bd_notice>0) {
					$bd_next_num = $bd_num;
				} else {
					$rs->clear();
					$rs->set_table($_table['bbs_body']);
					$rs->add_field('min(bd_next_num) as bd_next_num');
					$rs->add_where("bd_notice > 0");
					$rs->fetch('bd_next_num');	
					if($bd_next_num==NULL) $bd_next_num = $bd_num;
					
					$rs->clear();
					$rs->set_table($_table['bbs_body']);
					$rs->field_sql='bd_next_num = bd_next_num + 1';
					$rs->add_where("bd_notice > 0");
					$rs->update();

				}

				$bd_top_num=$bd_num;
				$bd_parent_num='0';
				
				$rs->clear();
				$rs->set_table($_table['bbs_body']);
				$rs->add_field("bd_top_num",$bd_top_num);
				$rs->add_field("bd_next_num",$bd_next_num);
				$rs->add_field("bd_parent_num",$bd_parent_num);
				$rs->add_where("bd_num=$bd_num");
				$rs->update();
				
/*				$tmp_pol_data=serialize(array(
										'type'=>'bbs',
										'mode'=>$mode,
										'bbs_code'=>$bbs_code,
										'bd_num'=>$bd_num
										));

				rg_set_point($mb_id,$_bbs_info['point_write'],0,'글쓰기 포인트 추가',$_bbs_info['bbs_name'],$tmp_pol_data);
*/
			break;
			case 'reply' : // 응답글
				// next_num은 현재글의 next_num
				$bd_next_num = $data['bd_next_num'];

				// next_num을 하나씩 올린다.
				$rs->clear();
				$rs->set_table($_table['bbs_body']);
				$rs->field_sql='bd_next_num = bd_next_num + 1';
				$rs->add_where("bd_next_num >= $bd_next_num");
				$rs->update();
								
				$bd_depth = $data['bd_depth']+1;
				$bd_sequence = $data['bd_sequence']+1;
				$bd_parent_num = $data['bd_num'];
				$bd_top_num = $data['bd_top_num'];
		
				$rs->clear();
				$rs->set_table($_table['bbs_body']);
				$rs->field_sql='bd_sequence = bd_sequence + 1';
				$rs->add_where("bd_top_num = $bd_top_num");
				$rs->add_where("bd_sequence >= $bd_sequence");
				$rs->update();

				$rs_write->add_field("bd_next_num",$bd_next_num);
				$rs_write->add_field("bd_depth",$bd_depth);
				$rs_write->add_field("bd_sequence",$bd_sequence);
				$rs_write->add_field("bd_parent_num",$bd_parent_num);
				$rs_write->add_field("bd_top_num",$bd_top_num);
				$rs_write->add_field("is_admin",$is_admin);				
				$rs_write->insert();
				$bd_num=$rs_write->get_insert_id();
				unset($data['bd_files']);
				
			break;
			case 'modify' : // 글수정
				// 공지상태가 변경
				if($bd_notice != $data['bd_notice']) {
					if($bd_notice>0) {
						// 공지사항인경우 next_num 값을 구한다(최고로 큰값으로)
						$rs->clear();
						$rs->set_table($_table['bbs_body']);
						$rs->add_field('max(bd_next_num) as bd_next_num');
						$rs->fetch('bd_next_num');	
						
						// 자신의 글보다 next_num 이 크면 하나씩 내린다.
						$rs->clear();
						$rs->set_table($_table['bbs_body']);
						$rs->field_sql='bd_next_num = bd_next_num - 1';
						$rs->add_where("bd_next_num > {$data['bd_next_num']}");
						$rs->update();					
					} else {
						// 공지사항이 아닌경우 next_num 값을 구한다
						// top번호를 기준으로 자신의 글보다 작은것중 큰값을 구한다.
						$rs->clear();
						$rs->set_table($_table['bbs_body']);
						$rs->add_field('max(bd_next_num) as bd_next_num');
						$rs->add_where("bd_top_num < {$data['bd_top_num']}");
						$rs->add_where("bd_notice = 0");
						$rs->fetch('bd_next_num');
						$bd_next_num++;
						
						// 공지사항아니고 새로운 next 보다 크고,
						// 공지사항이면서 자신의 next 보다 작다면 올린다
						$rs->clear();
						$rs->set_table($_table['bbs_body']);
						$rs->field_sql='bd_next_num = bd_next_num + 1';
						
						$rs->add_where("( bd_next_num >= $bd_next_num
								AND bd_notice = 0 )
								 OR ( bd_next_num < {$data['bd_next_num']}
								AND bd_notice = 1 )");
						$rs->update();	
					}
					$rs_write->add_field("bd_next_num",$bd_next_num);
				}
				$rs_write->add_where("bd_num={$data['bd_num']}");
				$rs_write->update();
			break;
		}

		// 파일 업로드
		if($wcfg['use_upload']) {
			$bd_files=rg_file_upload($_path['bbs_data'],"bd_files",$bd_num,$data['bd_files'],$bd_files_del);
			$bd_files=serialize($bd_files);		
	
			$rs->clear();
			$rs->set_table($_table['bbs_body']);
			$rs->add_field("bd_files","$bd_files");
			$rs->add_where("bd_num=$bd_num");
			$rs->update();
		}
		
		if($mode=='write' && $_mb) {
			if($_bbs_info['point_write'] > 0)
				rg_set_point($_mb['mb_num'],$_po_type_code['bbs'],
									$_bbs_info['point_write'],'글작성',$_bbs_info['bbs_name'],'');
		} else if($mode=='reply' && $_mb) {
			if($_bbs_info['point_reply'] > 0)
				rg_set_point($_mb['mb_num'],$_po_type_code['bbs'],
									$_bbs_info['point_reply'],'답글작성',$_bbs_info['bbs_name'],'');
		}
			
		if($wcfg['spam_chk']) { // 스팸세션삭제
			unset($_SESSION["schk_".$spam_chk_code]);
			$_SESSION["schk_".$spam_chk_code]='';
		}
		
		if(file_exists($skin_path."write_ok.php")) include($skin_path."write_ok.php");
		$rs->commit();

		if($mode=='reply' || $mode=='write') {
			$_SESSION['ss_write_date']=time();
		}

		// 메일발송
		if( $mode!='modify' && file_exists($skin_path."mail.php") && (
			($mode=='reply' && ($_write_cfg['use_reply_mail'] < 100) &&
			 $data['bd_reply_mail'] && ($data['bd_email'] != '')) || 
			($_bbs_info["mailing_mb_id"] !=''))) { 
			
			$mail_title = $_site_info['site_name'];
			if($mail_title!='') $mail_title .= " > ";
			$mail_title .= $_bbs_info['bbs_name'];
			if($mode=='reply')
				$mail_title = "[{$mail_title}] 응답글이 올라왔습니다.";
			else
				$mail_title= "[{$mail_title}] 새글이 올라왔습니다.";
			
			$mail_subject = rg_get_text($bd_subject);
			$mail_from_name = rg_get_text($bd_name);
			
			if(!$is_admin && $bd_html != '0') { // 관리자가 쓴글이 아니고 HTML 글이면
				$mail_content = rg_script_conv($_bbs_info['deny_html'],$bd_content);
			} else {
				$mail_content = $bd_content;
			}
			
			$mail_content = rg_conv_text($mail_content,$bd_html);
			$mail_view_url = rg_get_current_url().'view.php?bbs_code='.$bbs_code.'&bd_num='.$bd_num;
	
			// 이메일 추출하기 
			$email_list=array();
			if($_bbs_info["mailing_mb_id"] !='') {
				$tmp=explode (',', $_bbs_info["mailing_mb_id"]);
				foreach($tmp as $k => $v) {
					$v=trim($v);
					$v=$dbcon->escape_string($v);
					$tmp[$k]=$v;
				}
				
				$mailing_id_list='\''.implode ('\',\'', $tmp).'\'';
				$rs->clear();
				$rs->set_table($_table['member']);
				$rs->add_field("mb_email");
				$rs->add_where("mb_id in ($mailing_id_list)");
				$rs->add_where("mb_email <> ''");
				while($R=$rs->fetch()) {
					$email_list[] = $R['mb_email'];
				}				
			}
			
			// 응답글..
			if($mode=='reply' && ($_write_cfg['use_reply_mail'] < 100) &&
			 	 $data['bd_reply_mail'] && ($data['bd_email'] != ''))
				$email_list[] = $data['bd_email'];

			$email_list = array_unique($email_list);
			
			if(count($email_list)>0) {
				// 메일 스킨 적용
				ob_start();
				include($skin_path."mail.php");
				$mail_body = ob_get_contents(); 
				ob_end_clean();
				
				// 메일 발송
				foreach ($email_list as $email) {
					rg_mail($email,$mail_title,$mail_body,"$bd_name<{$bd_email}>");
				}
			}
		}
		
		rg_href("list_new.php?$_get_param[3]&bd_num=$bd_num");
		exit;
	}

	switch($mode) {
		case 'write' :
			$chk_bd_html[0]='checked';
			$bd_content=$_bbs_info['default_content'];
			if($_mb) {
				$bd_name=$s_bd_name;
				$bd_email=$_mb['mb_email'];
			} else {
				$bd_name='';
				$bd_email='';
			}
		break;
		case 'reply' :
			$chk_bd_html[0]='checked';
			// 원문글 인용여부 
			if($_reply_cfg['quote_use']) {
				if(substr($data['bd_subject'],0,strlen($_reply_cfg['subject_prefix']))
				                                     == $_reply_cfg['subject_prefix'])
					$bd_subject = $data['bd_subject'];
				else 
					$bd_subject = $_reply_cfg['subject_prefix'].$data['bd_subject'];			
			
				$bd_content=$_reply_cfg['quote_subject'];
				$bd_content=str_replace('{NAME}',$data['bd_name'],$bd_content);
				$bd_content.="\n";
				$bd_content.=$_reply_cfg['quote_mark'].
											str_replace("\n",$_reply_cfg['quote_mark'],$data['bd_content']);
				$bd_content=rg_html_entity($bd_content);
				$bd_subject=rg_html_entity($bd_subject);
			} else {
//				$bd_content=$_bbs_info['default_content'];
			}
			
			if($_mb) {
				$bd_name=$s_bd_name;
				$bd_email=$_mb['mb_email'];
			} else {
				$bd_name='';
				$bd_email='';
			}
		break;
		case 'modify' :
			extract($data);
			$chk_bd_notice=($bd_notice)?'checked':'';
			$chk_bd_secret=($bd_secret)?'checked':'';
			$chk_bd_reply_mail=($bd_reply_mail)?'checked':'';
			$chk_bd_html[$bd_html]='checked';
			$bd_content=rg_html_entity($bd_content);
			$bd_subject=rg_html_entity($bd_subject);
		break;
	}
	if($wcfg['spam_chk']) { // 스팸체크루틴
//		$spam_chk_code=substr(md5(uniqid(rand(), true)),-5);
		$spam_chk_code='12345';
		if($_SESSION["schk_".$spam_chk_code]=='')
			$_SESSION["schk_".$spam_chk_code]=substr(md5(uniqid(rand(), true)),-5);
		$spam_chk_img='';
		for($i=0;$i<strlen($_SESSION["schk_".$spam_chk_code]);$i++) {
			$spam_chk_img.="<img src='spam_img.php?ord=".$i."&chk_code=".$spam_chk_code."' align='absmiddle'>";
		}
	}

	include_once("../temp/top.php");
	include_once("../temp/nav.php");
	if(file_exists($skin_path."write.php")) include($skin_path."write.php");
	include_once('../temp/footer.php');
?>