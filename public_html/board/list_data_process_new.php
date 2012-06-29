<? if (!defined('RGBOARD_VERSION')) exit; ?>
<?
/* =====================================================

  최종수정일 : 
 ===================================================== */
	if(isset($_REQUEST['skin_path'])) exit;

	extract($data);
	
	$mb_data=NULL;
	$mb_icon='';
	$open_profile='';
	$open_memo='';
	
	if($mb_num) { // 회원이 쓴 글
		$rs->clear();
		$rs->set_table($_table['member']);
		$rs->add_where("mb_num=$mb_num");
		$mb_data=$rs->fetch();
		if($mb_data) {
			if($mb_data['mb_is_opening'] && $_mb || $_auth['admin']) {
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
			}
		}
	}

	// 글제목 자르기
	if($_list_cfg['subject_limit']!='') {
		$bd_subject=rg_cut_string($bd_subject,$_list_cfg['subject_limit']);
	} else {
		$bd_subject=$bd_subject;
	}
	
	$view_url="view_new.php?$_get_param[3]&bd_num=$bd_num";
	if(!$is_admin) {
		$bd_email = rg_get_text($bd_email);
		$bd_name = rg_get_text($bd_name);
		$bd_subject = rg_get_text($bd_subject);
	}
	if($cat_num)
		$cat_name=$_category_name_array[$cat_num];	// 카테고리명
	else
		$cat_name='';
	
	
	// 응답글 깊이
	if($bd_depth > 0)
		$i_reply = "<img height=1 width=".($bd_depth*$_skin['reply_depth'])." border=0>".$_skin['i_reply'];
	else
		$i_reply = '';
		
	// 코멘트수
	if($bd_comment_count>0)
		$i_comment_count=str_replace('$bd_comment_count',$bd_comment_count,$_skin['i_comment_count']);
	else
		$i_comment_count='';		
	
	// 최근글 아이콘
	if(time() < ($bd_write_date+60*60*$_list_cfg['new_time']))
		$i_new = $_skin['i_new'];
	else
		$i_new = '';
	$bd_write_date=rg_date($bd_write_date,$_list_cfg['date_format']); // 날자형식지정

	// 갤러리 이용시 처음 이미지 경로
	if(is_array($bd_files) && (count($bd_files) > 0))
		$img_view_url=$_url['bbs']."down.php?$_get_param[3]&bd_num=$bd_num&key=0&mode=view";
	else
		$img_view_url='';

	// 비밀글이라면
	if($bd_secret > 0) {
		$i_secret = $_skin['i_secret'];
		if(!($_auth['bbs_admin'] || $_bbs_auth['secret'])) { // 권한 없으면
			if(!$_mb || $mb_num!=$_mb['mb_num']) { // 로그인 안되어 있고 자신의 글 아니라면
				if($bd_pass=='') // 암호가 없다면
					$view_url="javascript:void(0)";
			}
		}
	} else
		$i_secret = '';
	
	// 삭제글이라면
	if($bd_delete > 0) {
		if($_auth['bbs_admin']) { // 관리자는 볼수 있도록
			$bd_subject = str_replace('$bd_subject',$bd_subject,$_skin[i_delete2]);
		} else {
			$bd_subject = str_replace('$bd_subject',$bd_subject,$_skin[i_delete1]);
			$view_url="javascript:void(0)";
		}
	}
	
	// 공지사항
	if($bd_notice > 0) {
		$i_notice=$_skin['i_notice'];
		$i_no=$i_notice;
	} else {
		$i_notice='';
	}
	
	// 현재표시글
	if(isset($o_bd_num) && $o_bd_num==$bd_num) {
		$i_no=$_skin['i_currnet'];
	}
	
	$bd_name_layer=
		rg_name_layer($mb_id,$bd_name,$mb_icon,$open_profile,$open_memo,$bbs_code,$bd_num,$bd_home,$bd_email);
?>