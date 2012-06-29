<? if (!defined('RGBOARD_VERSION')) exit; ?>
<?
/* =====================================================

  최종수정일 : 
 ===================================================== */
	if(isset($_REQUEST['skin_path'])) exit;

	extract($data_comment);
	$mb_data=NULL;
	$mb_of=NULL;
	$mb_icon='';
	$open_profile='';
	$open_memo='';
//	$bc_name='';
//	$bc_email='';
	
	$bc_write_date=rg_date($bc_write_date,$_view_cfg['c_date_format']);
	$comment_delete_chk=false;
	if($mb_num) { // 회원이 쓴 글
		$rs->clear();
		$rs->set_table($_table['member']);
		$rs->add_where("mb_num=$mb_num");
		$mb_data=$rs->fetch();
		if($mb_data) {
			if($mb_data['mb_is_opening'] && $_mb || $_auth['admin']) {
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
	} else {
		if($bc_pass!='') $comment_delete_chk=true;
	}
	
	$comment_delete_url="view.php?$_get_param[4]&mode=comment_delete&bc_num=$bc_num";
		
	if($_auth['bbs_admin'] || $_mb['mb_num']==$mb_num) {
		$comment_delete_chk=true;
	}
	$bc_name = rg_get_text($bc_name);
	$bc_content = rg_conv_text($bc_content,0);
	if(!$_auth['bbs_admin']) $bc_write_ip = rg_hidden_ip($bc_write_ip);
	
	$bd_name_layer=
		rg_name_layer($mb_id,$bc_name,$mb_icon,$open_profile,$open_memo,$bbs_code,$bd_num,$bc_home,$bc_email);
?>