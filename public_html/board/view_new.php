<?
/* =====================================================

  최종수정일 : 
	2007-12-10 $bd_home XSS취약점 수정
 ===================================================== */
	include_once("../include/lib.php");
	include_once($_path['inc']."lib_bbs_new.php");
	
	$tmp_level=$_gmb_info['gm_level'];
	if($tmp_level=='') $tmp_level=0;
	$vcfg['use_html']=($_write_cfg['use_html'] <= $tmp_level);
	$vcfg['date_format']=$_view_cfg['date_format'];
	$vcfg['view_image']=($_view_cfg['view_image'] <= $tmp_level);
	$vcfg['view_list']=(($_view_cfg['view_list'] <= $tmp_level) && $_bbs_auth['list']);
//	$vcfg['view_signature']=($_view_cfg['view_signature'] <= $tmp_level);
	$vcfg['view_signature']=$_view_cfg['view_signature'];
	$vcfg['view_comment']=($_view_cfg['view_comment'] <= $tmp_level);
	$vcfg['use_download']=($_view_cfg['use_download'] <= $tmp_level);
	$vcfg['vote_yes']=($_view_cfg['vote_yes'] <= $tmp_level);
	$vcfg['vote_no']=($_view_cfg['vote_no'] <= $tmp_level);

	$vcfg['btn_vote_yes']=($_view_cfg['vote_yes'] < 100);
	$vcfg['btn_vote_no']=($_view_cfg['vote_no'] < 100);

	$vcfg['btn_prev_next']=($_view_cfg['btn_prev_next'] <= $tmp_level);
	$vcfg['btn_list']=($_view_cfg['btn_list'] <= $tmp_level);
	$vcfg['btn_modify']=($_view_cfg['btn_modify'] <= $tmp_level);
	$vcfg['btn_del']=($_view_cfg['btn_del'] <= $tmp_level);
	$vcfg['btn_reply']=($_view_cfg['btn_reply'] <= $tmp_level);

	$vcfg['use_category']=$_bbs_info['use_category'];

	$vcfg['spam_chk']=($_write_cfg['spam_chk'] > $tmp_level);
	if(!$_bbs_auth['comment']) $vcfg['spam_chk']=false;
	
	$vcfg['input_name']=($_write_cfg['writer_modify'] <= $tmp_level || !$_mb);	
	
	$vreq['bc_pass']=($_mb)?'':'required'; // 로그인전이라면 암호 필수입력
	
	if($_mb) {
		switch($_write_cfg['writer_name']) {
			case "1" : $s_bc_name = $_mb['mb_name']; break;
			case "2" : $s_bc_name = $_mb['mb_id']; break;
			case "3" : $s_bc_name = $_mb['mb_nick']; break;
			default : $s_bc_name = $_mb['mb_id']; break;
		}
		if($s_bc_name == '') $s_bc_name = $_mb['mb_id'];
	} else {
		$s_bc_name='';
	}
	
	$url_list_org=$url_list;
	if(empty($mode)) $mode='view';

	if(file_exists($skin_path.'setup.php')) include($skin_path.'setup.php');
	
	if(!$validate->number_only($bd_num)) {
		rg_href("list_new.php?$_get_param[3]");
		exit;
	}

	$_get_param[4]=$p_str;
	$_get_param[4]=$_get_param[4]."&bd_num=$bd_num";
	$_post_param[4]=$_post_param[3];
	$_post_param[4].='<input type="hidden" name="bd_num" value="'.$bd_num."\">\n";

	if($mode=='comment_delete') {
		if($mode2!='select') {
			if(!$validate->number_only($bc_num)) {
				rg_href("list_new.php?$_get_param[3]");
				exit;
			}
		}
		$_get_param[4]=$_get_param[4]."&bc_num=$bc_num";
		$_post_param[4].='<input type="hidden" name="bc_num" value="'.$bc_num."\">\n";
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

	extract($data);

	if($mode=='vote_yes' || $mode=='vote_no') {
		if($mode=='vote_yes' && !$vcfg['vote_yes']) {
			$_msg_type='vote_yes_auth';
			include("msg_new.php");
			exit;
		}
		if($mode=='vote_no' && !$vcfg['vote_no']) {
			$_msg_type='vote_no_auth';
			include("msg_new.php");
			exit;
		}
		// 투표여부
		$tmp=explode(',',$_COOKIE["vote_chk"]);
		if(!in_array("{$_bbs_info['bbs_db_num']}:$bd_num",$tmp)){
			$rs->clear();
			$rs->set_table($_table['bbs_body']);
			if($mode=='vote_no')
				$rs->field_sql='bd_vote_no = bd_vote_no + 1';
			else
				$rs->field_sql='bd_vote_yes = bd_vote_yes + 1';
			$rs->add_where("bbs_db_num={$_bbs_info['bbs_db_num']}");
			$rs->add_where("bd_num=$bd_num");
			$rs->update();
			array_push($tmp, "{$_bbs_info['bbs_db_num']}:$bd_num");
			$vote_chk = implode(',',$tmp);
			setcookie("vote_chk", $vote_chk, time()+3600*24*30); // 한달
		} else {
			$_msg_type='vote_already';
			include("msg_new.php");
			exit;
		}
		unset($tmp);
	
		$rs->commit();
		rg_href("view_new.php?$_get_param[4]");
	}
	
	if($mode=='comment_write' || $mode=='comment_delete') {
		if($mode=='comment_write') {
			if(!$vcfg['view_comment']) {
				if($_mb)
					$_msg_type='comment_write_no_auth_member';
				else
					$_msg_type='comment_write_no_auth_guest';
				include("msg_new.php");
				exit;
			}
			
			if($vcfg['spam_chk']) { // 스팸체크루틴
				$schk_code = $_SESSION["schk_".$spam_chk_code];
				if($schk_code =='' || $schk_code != $spam_chk) { // 스팸문자 맞지 않음
					$_msg_type='spam_chk';
					include("msg_new.php");
					exit;
				}
			}
			
			if($vcfg['input_name']) {
				if($bc_name=='' && $_mb) $bc_name=$s_bc_name;
				if($bc_name=='') {
					$_msg_type='comment_write_no_name';
					include("msg_new.php");
					exit;
				}
			} else {
				$bc_name=$s_bc_name;
			}
			
			if($bc_pass=='' && !$_mb) {
				$_msg_type='comment_write_no_pass';
				include("msg_new.php");
				exit;
			}
			
			if($bc_content=='') {
				$_msg_type='comment_write_no_content';
				include("msg_new.php");
				exit;
			}
			
			$rs->clear();
			$rs->set_table($_table['bbs_comment']);
			$rs->add_field("gr_num","$gr_num");
			$rs->add_field("bbs_db_num","$bbs_db_num");
			$rs->add_field("bd_num","$bd_num");
			$rs->add_field("mb_num",$_mb['mb_num']);
			$rs->add_field("mb_id",$_mb['mb_id']);
			$rs->add_field("bc_name","$bc_name");
			$rs->add_field("bc_pass",rg_password_encode($bc_pass));
			$rs->add_field("bc_email","$bc_email");
			$rs->add_field("bc_home",rg_homepage_chk($bc_home));
			$rs->add_field("bc_content","$bc_content");
			
            $bc_write_date = mktime(0,0,0, $bc_write_date2, $bc_write_date3, $bc_write_date1);		
		//	$rs->add_field("bc_write_date",time());

			$rs->add_field("bc_write_date","$bc_write_date");	
			
			$rs->add_field("bc_write_ip",$_SERVER['REMOTE_ADDR']);
			$rs->insert();
			// 포인트
			if($_bbs_info['point_comment'] > 0 && $_mb)
				rg_set_point($_mb['mb_num'],$_po_type_code['bbs'],
									$_bbs_info['point_comment'],'코멘트작성',$_bbs_info['bbs_name'],'');
		} else if($mode=='comment_delete') {
			// 코멘트삭제 루틴
			if($mode2=='select') { // 선택삭제
				if(!$_auth['bbs_admin']) {
					$_msg_type='comment_delete_no_auth_member';
					include("msg_new.php");
				} else {
					if(is_array($chk_cnums)) {
						$rs->clear();
						$rs->set_table($_table['bbs_comment']);
						$rs->add_where("bd_num=$bd_num");
						$rs->add_where("bc_num IN ('".implode("','",$chk_cnums)."')");
						while($data_comment=$rs->fetch()) {
							// 삭제시 포인트 차감
							if($_bbs_info['point_comment'] > 0 && $data_comment['mb_num'])
								rg_set_point($data_comment['mb_num'],$_po_type_code['bbs'],
													-$_bbs_info['point_comment'],'코멘트삭제',$_bbs_info['bbs_name'],'');
						}
						$rs->delete();
					}
				}
			} else {
				if(!$validate->number_only($bc_num)) {
					rg_href("view_new.php?$_get_param[4]");
					exit;
				}
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
				$rs->set_table($_table['bbs_comment']);
				$rs->add_where("bd_num=$bd_num");
				$rs->add_where("bc_num=$bc_num");
				$data_comment=$rs->fetch();
				if($_auth['bbs_admin']) {
					if($confirm!='ok') {
						$_confirm_type='comment_delete_admin';
						include("confirm_new.php");
						exit;
					}
				} else {
					if($_mb) {
						// 회원로그인된 경우
						if($_mb['mb_num']==$data_comment['mb_num']) {
							if($confirm!='ok') {
								$_confirm_type='comment_delete_member';
								include("confirm_new.php");
								exit;
							}
						} else {
							// 자신이 쓴글이 아니면
							if($data_comment['bc_pass']=='') {
								// 글 암호가 없다면
								$_msg_type='comment_delete_no_auth_member';
								include("msg_new.php");
								exit;
							} else {
								// 글 암호 있다면
								if($old_pass=='') { // 입력된 암호 없다면
									// 암호입력
									$_pass_type='comment_delete';
									include("pass_new.php");
									exit;
								} else {
									// 입력된 암호 있다면 비교
									if($data_comment['bc_pass']!=rg_password_encode($old_pass)) {
										// 암호가 다르다면
										// 에러 메시지 표시
										$_msg_type='comment_delete_pass_error';
										include("msg_new.php");
										exit;
									}
								} // $old_pass==''
							} // $data['bc_pass']==''
						}				
					} else {
						// 회원로그인 안된경우
						if($data_comment['bc_pass']=='') {
							// 글 암호가 없다면
							$_msg_type='comment_delete_no_auth_guest';
							include("msg_new.php");
							exit;
						} else {
							// 글 암호가 있다면
							if($old_pass=='') { // 입력된 암호 없다면
								// 암호입력
								$_pass_type='comment_delete';
								include("pass_new.php");
								exit;
							} else {
								// 입력된 암호 있다면 비교
								if($data_comment['bc_pass']!=rg_password_encode($old_pass)) {
									// 암호가 다르다면
									// 에러 메시지 표시
									$_msg_type='comment_delete_pass_error';
									include("msg_new.php");
									exit;
								}
							} // $old_pass==''
						} // $data['bd_pass']==''
					} // $_mb
				} // $_auth['bbs_admin']
				
	
	
				$rs->clear();
				$rs->set_table($_table['bbs_comment']);
				$rs->add_where("bd_num=$bd_num");
				$rs->add_where("bc_num=$bc_num");
				$rs->delete();
				
				// 삭제시 포인트 차감
				if($_bbs_info['point_comment'] > 0 && $data_comment['mb_num'])
					rg_set_point($data_comment['mb_num'],$_po_type_code['bbs'],
										-$_bbs_info['point_comment'],'코멘트삭제',$_bbs_info['bbs_name'],'');
			}
		}
		$rs->clear();
		$rs->set_table($_table['bbs_comment']);
		$rs->add_field("count(*) as bd_comment_count");
		$rs->add_where("bd_num=$bd_num");
		$rs->fetch("bd_comment_count");
		
		$rs->clear();
		$rs->set_table($_table['bbs_body']);
		$rs->add_field("bd_comment_count",$bd_comment_count);
		$rs->add_where("bd_num=$bd_num");
		$rs->update();

		if($vcfg['spam_chk']) { // 스팸세션삭제
			unset($_SESSION["schk_".$spam_chk_code]);
			$_SESSION["schk_".$spam_chk_code]='';
		}
		$rs->commit();
		
		// 메일발송
		if( file_exists($skin_path."mail.php") && $mode=='comment_write' && 
				(
					($_write_cfg['use_reply_mail'] < 100) && $data['bd_reply_mail'] && ($data['bd_email'] != '') || 
					($_bbs_info["mailing_mb_id"] !=''))) { 
			
			$mail_title = $_site_info['site_name'];
			if($mail_title!='') $mail_title .= " > ";
			$mail_title .= $_bbs_info['bbs_name'];
			$mail_title = "[{$mail_title}] 코멘트가 올라왔습니다.";
			
			$mail_subject = rg_get_text($data[bd_subject]);
			$mail_from_name = rg_get_text($bc_name);
			$mail_content = rg_conv_text($bc_content);
			$mail_view_url = rg_get_current_url().'view_new.php?bbs_code='.$bbs_code.'&bd_num='.$bd_num;
	
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
			if($mode=='comment_write' && ($_write_cfg['use_reply_mail'] < 100) &&
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
					rg_mail($email,$mail_title,$mail_body,"$bc_name<{$bc_email}>");
				}
			}
		}


		rg_href("view_new.php?$_get_param[4]");
	} // 코멘트 관련 여기까지

	// 권한체크	
	// 비밀글이라면
	if($bd_secret > 0) {
		if(!($_auth['bbs_admin'] || $_bbs_auth['secret'])) { // 권한 없으면
			if(!$_mb || $mb_num!=$_mb['mb_num']) { // 로그인 안되어 있고 자신의 글 아니라면
				if($bd_pass=='') { // 암호가 없다면
					// 에러 메시지 표시
					$_msg_type='view_secret_error';
					include("msg_new.php");
					exit;
				} else {
					if($old_pass=='') { // 암호입력
						// 암호입력
						$_pass_type='view_secret';
						include("pass_new.php");
						exit;
					} else {
						if($bd_pass!=rg_password_encode($old_pass)) {
							// 에러 메시지 표시
							$_msg_type='view_secret_pass_error';
							include("msg_new.php");
							exit;
						}
					}
				}
			}
		}
	} else if(!$_bbs_auth['view']) { // 일반글이라면
		if($_mb)
			$_msg_type='view_no_auth_member';
		else
			$_msg_type='view_no_auth_guest';
		include("msg_new.php");
		exit;
	}
	
	// 삭제글이라면
	if($bd_delete > 0) {
		if(!$_auth['bbs_admin']) { // 관리자가 아니라면
			// 에러 메시지 표시
			$_msg_type='view_delete_error';
			include("msg_new.php");
			exit;
		}
	}
	
	// 글내용 분석 시작 부분
	$tmp=unserialize($bd_ext1); if(is_array($tmp)) $bd_ext1=$tmp;
	$tmp=unserialize($bd_ext2); if(is_array($tmp)) $bd_ext2=$tmp;
	$tmp=unserialize($bd_ext3); if(is_array($tmp)) $bd_ext3=$tmp;
	$tmp=unserialize($bd_ext4); if(is_array($tmp)) $bd_ext4=$tmp;
	$tmp=unserialize($bd_ext5); if(is_array($tmp)) $bd_ext5=$tmp;
	unset($tmp);

	$bd_files=unserialize($bd_files);
	$bd_links=unserialize($bd_links);
	
	if(is_array($bd_links))
	foreach($bd_links as $k => $v) {
		if($v['url']=='') continue;
		if($v['name']=='') $v['name']=$v['url'];
		$bd_links[$k][link_url]=$_url['bbs']."link.php?$_get_param[3]&bd_num=$bd_num&key=$k";
	}	
	
	if(is_array($bd_files) && (count($bd_files) > 0)) {
		if($vcfg['view_image'])
		foreach($bd_files as $k => $v) {
			if($v['name']=='') continue;
			$bd_files[$k]['view_url']=$_url['bbs']."down.php?$_get_param[3]&bd_num=$bd_num&key=$k&mode=view";
		}
	
		if($vcfg['use_download'])
		foreach($bd_files as $k => $v) {
			if($v['name']=='') continue;
			$bd_files[$k]['down_url']=$_url['bbs']."down.php?$_get_param[3]&bd_num=$bd_num&key=$k&mode=down";
		}
	} else {
		$vcfg['use_download']=$vcfg['view_image']=false;
	}
	
	$mb_data=false;
	$open_profile='';
	$open_memo='';
	$mb_icon='';
	if($mb_num) { // 회원이 쓴 글
		$rs->clear();
		$rs->set_table($_table['member']);
		$rs->add_where("mb_num=$mb_num");
		$mb_data=$rs->fetch();
		if($mb_data) {
			if($mb_data && $mb_data['mb_is_opening'] && $_mb || $_auth['admin']) {
				$mb_of=unserialize($mb_data['mb_open_field']);
				$open_profile='1';
				$open_memo='1';
			}
			
			$mb_data['mb_files']=unserialize($mb_data['mb_files']);
	
			if(($_list_cfg['use_mb_icon'] <= $mb_data[mb_level]) && ($mb_data['mb_files']['icon1']['name']!='')){
				if(rg_file_type_chk($mb_data['mb_files']['icon1']['type'],'image')) {
					$icon_data = rg_base64("mb_num=$mb_num&key=icon1");
					$mb_icon = "{$_url['member']}mb_data.php?mb_data=$icon_data";
					unset($icon_data);
				}
				unset($is_image);
			}
		}
	}

	if($vcfg['view_signature']<100 && $mb_data) { // 서명 표시여부
		// 작성자 정보 가져오기
		$mb_signature=rg_conv_text($mb_data['mb_signature']);
		$mb_level=$mb_data['mb_level'];
		// 그룹레벨
		if($_group_info['gr_level_type']=='1') {
		// 그룹레벨 적용
			$rs->clear();
			$rs->set_table($_table["gmember"]);
			$rs->add_field("gm_level");
			$rs->add_where("gr_num={$_bbs_info['gr_num']}");
			$rs->add_where("gm_state=1");
			$rs->add_where("mb_num={$_mb['mb_num']}");
			$rs->fetch("gm_level"); // 해당 회원이 있다면 읽어온다
			$tmp_level=$gm_level;
		} else {
		// 사이트레벨 적용
			$tmp_level=$mb_level;
		}
		if($tmp_level=='') $tmp_level=0;
		$vcfg['view_signature']=(($_view_cfg['view_signature'] <= $tmp_level) && $mb_signature!='');
	} else {
		$mb_signature='';
		$vcfg['view_signature']=false;
	}

	$url_modify="write_new.php?$_get_param[3]&bd_num=$bd_num&mode=modify";
	$url_delete="write_new.php?$_get_param[3]&bd_num=$bd_num&mode=delete";
	$url_reply="write_new.php?$_get_param[3]&bd_num=$bd_num&mode=reply";
	$url_list=$url_list_org."&bd_num=$bd_num";
	$url_vote_yes="view_new.php?$_get_param[3]&bd_num=$bd_num&mode=vote_yes";
	$url_vote_no="view_new.php?$_get_param[3]&bd_num=$bd_num&mode=vote_no";

	if($is_admin) {
		$bd_content = rg_conv_text($bd_content,$bd_html);
	} else {
		if($bd_html != '0') { // 관리자가 쓴글이 아니고 HTML 글이면
		//  write 에서 변환해서 저장됨 한번더 체크
			$bd_content = rg_script_conv($_bbs_info['deny_html'],$bd_content);
		}
		$bd_content = rg_conv_text($bd_content,$bd_html);
		$bd_email = rg_get_text($bd_email);
		$bd_name = rg_get_text($bd_name);
		$bd_subject = rg_get_text($bd_subject);
		$bd_home = rg_get_text($bd_home);
	}

	$bc_name=$s_bc_name;
	$bd_write_date=rg_date($bd_write_date,$vcfg['date_format']);
	if($cat_num)
		$cat_name=$_category_name_array[$cat_num];	// 카테고리명
	else
		$cat_name='';
		
	if(!$_auth['bbs_admin']) $bd_write_ip = rg_hidden_ip($bd_write_ip);
	if(!$_auth['bbs_admin']) $bd_modify_ip = rg_hidden_ip($bd_modify_ip);
	// 글내용 분석 끝 부분
	
	if($vcfg['btn_prev_next']) {
		include("list_where.php");
		$rs->clear();
		$rs->set_table($rs_list->get_table());
		$rs->set_where($rs_list->get_where());
		$rs->add_where("bd_next_num > {$data['bd_next_num']}");
		if(!$_auth['bbs_admin'] && !$_bbs_auth['secret'])
			$rs->add_where("bd_secret = 0");
		if(!$_auth['bbs_admin'])
			$rs->add_where("bd_delete = 0");
		$rs->add_order('bd_next_num');
//		$rs->set_order($rs_list->get_order());
		$rs->set_limit('1');
		$prev_data=$rs->fetch();
		
		$rs->clear();
		$rs->set_table($rs_list->get_table());
		$rs->set_where($rs_list->get_where());
		$rs->add_where("bd_next_num < {$data['bd_next_num']}");
		if(!$_auth['bbs_admin'] && !$_bbs_auth['secret'])
			$rs->add_where("bd_secret = 0");
		if(!$_auth['bbs_admin'])
			$rs->add_where("bd_delete = 0");
		$rs->add_order('bd_next_num DESC');
//		$rs->set_order($rs_list->get_order());
		$rs->set_limit('1');
		$next_data=$rs->fetch();
		
		if($prev_data) {
			if(!$prev_data['is_admin']) {
				$prev_data['bd_email'] = rg_get_text($prev_data['bd_email']);
				$prev_data['bd_name'] = rg_get_text($prev_data['bd_name']);
				$prev_data['bd_subject'] = rg_get_text($prev_data['bd_subject']);
			}
//			$prev_data['bd_content'] = rg_conv_text($prev_data['bd_content'],$prev_data['bd_html']);
			$url_view_prev="view_new.php?$_get_param[3]&bd_num={$prev_data['bd_num']}";
		}	else {
			$url_view_prev="";
		}

		if($next_data) {
			if(!$next_data['is_admin']) {
				$next_data['bd_email'] = rg_get_text($next_data['bd_email']);
				$next_data['bd_name'] = rg_get_text($next_data['bd_name']);
				$next_data['bd_subject'] = rg_get_text($next_data['bd_subject']);
			}
//			$next_data['bd_content'] = rg_conv_text($next_data['bd_content'],$next_data['bd_html']);
			$url_view_next="view_new.php?$_get_param[3]&bd_num={$next_data['bd_num']}";
		}	else {
			$url_view_next="";
		}
	}	
	
	// 글 조회수 올리기 
//	if($data[mb_num] == '0' || $_mb[mb_num] != $data[mb_num]) {
		$tmp=explode(',',$_COOKIE["view_chk"]);
	//	if(!in_array("{$_bbs_info['bbs_db_num']}:$bd_num",$tmp)){
			$rs->clear();
			$rs->set_table($_table['bbs_body']);
			$rs->field_sql='bd_view_count = bd_view_count + 1';
			$rs->add_where("bbs_db_num={$_bbs_info['bbs_db_num']}");
			$rs->add_where("bd_num=$bd_num");
			$rs->update();
			array_push($tmp, "{$_bbs_info['bbs_db_num']}:$bd_num");
			$view_chk = implode(',',$tmp);
			setcookie("view_chk", $view_chk, time()+3600*24*30); // 한달
//		}
		unset($tmp);
//	}

	if($vcfg['spam_chk']) { // 스팸체크루틴
//		$spam_chk_code=substr(md5(uniqid(rand(), true)),-5);
		$spam_chk_code='12345';
		if($_SESSION["schk_".$spam_chk_code]=='')
			$_SESSION["schk_".$spam_chk_code]=substr(md5(uniqid(rand(), true)),-5);
		$spam_chk_img='';
		for($i=0;$i<strlen($_SESSION["schk_".$spam_chk_code]);$i++) {
			$spam_chk_img.="<img src='spam_img.php?ord=".$i."&chk_code=".$spam_chk_code."' align='absmiddle'>";
		}
	}

	$bd_name_layer=
		rg_name_layer($mb_id,$bd_name,$mb_icon,$open_profile,$open_memo,$bbs_code,$bd_num,$bd_home,$bd_email);
		
	include_once("../temp/top.php");
	include_once("../temp/nav.php");
	if(file_exists($skin_path."view.php")) include($skin_path."view.php");
	include_once('../temp/footer.php');
?>