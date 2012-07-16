<? if (!defined('RGBOARD_VERSION')) exit; ?>
<?
/* =====================================================

  최종수정일 : 
 ===================================================== */
	if(isset($_REQUEST['site_path'])) exit;

	// 환경설정 변수
	if(!isset($site_path)) $site_path='../';
	if(!isset($site_url)) $site_url='../';
	
	if(!isset($site_path) || preg_match("/:\/\//",$site_path)) $site_path='../';	
	
	// 게시판 정보읽어오기
	$rs->clear();
	$rs->set_table($_table["bbs_cfg"]);
	$rs->add_where("bbs_code='$bbs_code'");
	$_bbs_info=$rs->fetch();
	if(!$_bbs_info) {
		rg_href('','게시판을 찾을 수 없습니다.\n정확한 게시판 코드를 입력하세요.','back');
	}

	// 스킨 경로 정의
	$_bbs_info['skin_path']=$skin_path=$_path['bbs_skin'].$_bbs_info['bbs_skin'].'/';
	$_bbs_info['skin_url']=$skin_url=$_url['bbs_skin'].$_bbs_info['bbs_skin'].'/';

	// 게시판 전체에서 쓸 변수 정의
	$bbs_db_num = $_bbs_info['bbs_db_num']; // 디비 번호

	// 그룹정보 읽어오기
	$rs->clear();
	$rs->set_table($_table["group"]);
	$rs->add_where("gr_num={$_bbs_info['gr_num']}");
	$_group_info=$rs->fetch();
	if(!$_group_info) {
		rg_href('','게시판 그룹 오류 입니다.\n관리자에게 문의 하세요.','back');
	}
	
	// 그룹레벨
	if($_group_info['gr_level_type']=='1') {
	// 그룹레벨 적용
		$_group_level_info=unserialize($_group_info['gr_level_info']);
		if($_mb) {
			$rs->clear();
			$rs->set_table($_table['gmember']);
			$rs->add_where("gr_num={$_bbs_info['gr_num']}");
			$rs->add_where("gm_state=1");
			$rs->add_where("mb_num={$_mb['mb_num']}");
			$_gmb_info=$rs->fetch(); // 해당 회원이 있다면 읽어온다
			if($_mb['mb_level']>=90) $_gmb_info['gm_level']=$_mb['mb_level'];
		} else {
			$_gmb_info=false;
		}
	} else {
	// 사이트레벨 적용
		$_group_level_info=$_level_info;
//		$_gmb_info=$_mb;
		if($_mb) {
			$_gmb_info['gm_state']=$_mb['mb_state'];
			$_gmb_info['gm_level']=$_mb['mb_level'];
		} else {
			$_gmb_info=false;
		}
	}
	
	if($_mb) {
		$_mb['gr_level']=$_gmb_info['gm_level'];
		$_mb['gm_state']=$_gmb_info['gm_state'];
		$_mb['gr_level_name']=$_group_level_info[$_mb['gr_level']];
	}
	
	// 각종 설정
	$_list_cfg=unserialize($_bbs_info["list_cfg"]);
	$_write_cfg=unserialize($_bbs_info["write_cfg"]);
	$_reply_cfg=unserialize($_bbs_info["reply_cfg"]);
	$_view_cfg=unserialize($_bbs_info["view_cfg"]);
	
	// 권한 설정
	$tmp_level=$_gmb_info['gm_level'];
	if($tmp_level=='') $tmp_level=0;

	$_bbs_auth=array();
	$_bbs_auth['list'] = ($_bbs_info['auth_list'] <= $tmp_level);
	$_bbs_auth['view'] = ($_bbs_info['auth_view'] <= $tmp_level);
	$_bbs_auth['write'] = ($_bbs_info['auth_write'] <= $tmp_level);
	$_bbs_auth['reply'] = ($_bbs_info['auth_reply'] <= $tmp_level);
	$_bbs_auth['modify'] = ($_bbs_info['auth_modify'] <= $tmp_level);
	$_bbs_auth['delete'] = ($_bbs_info['auth_delete'] <= $tmp_level);
	$_bbs_auth['comment'] = ($_bbs_info['auth_comment'] <= $tmp_level);
	$_bbs_auth['secret'] = ($_bbs_info['auth_secret'] <= $tmp_level);
	
	$_auth['group_admin']=(($_const['group_admin_level'] <= $tmp_level) || $_auth['admin']);
	
	$tmp=explode(',',$_bbs_info['admin_mb_id']);
	if($_mb)
		$_auth['bbs_admin']=(in_array($_mb['mb_id'],$tmp) || $_auth['group_admin']);
	else
		$_auth['bbs_admin']=false;
	
	$_bbs_auth['cart'] = $_auth['bbs_admin'];
	$_bbs_auth['admin'] = $_auth['bbs_admin'];

	// 카테고리정보
	$_category_info=array();
	$_category_name_array=array();
	if($_bbs_info['use_category']) {
		$rs->clear();
		$rs->set_table($_table['bbs_category']);
		$rs->add_where("bbs_db_num=$bbs_db_num");
		$rs->add_order("cat_order");
		while($R=$rs->fetch()) {
			$_category_info[$R['cat_num']]=$R;
			$_category_name_array[$R['cat_num']]=$R['cat_name'];
		}
	}

	// 파라메타 처리
	$_get_param=array();
	$_post_param=array();
	
	$p_str='&bbs_code='.urlencode($bbs_code);
	$_get_param[0]=$p_str; // 기본파라메타
	$_post_param[0]='<input type="hidden" name="bbs_code" value="'.$bbs_code."\">\n";

	$_post_param[1]=$_post_param[0];
	if(isset($ss) && is_array($ss)) { // 필터적용
		foreach($ss as $__k => $__v) {
			$p_str.="&ss[$__k]=".urlencode($__v);
			$_post_param[1].='<input type="hidden" name="ss['.$__k.']" value="'.rg_html_entity($__v)."\">\n";
		}
	}
	if(isset($kw)) {
		$p_str.="&kw=".urlencode($kw); // 키워드 적용
		$_post_param[1].='<input type="hidden" name="kw" value="'.rg_html_entity($kw)."\">\n";
	}
	$_get_param[1]=$p_str;
	
	$_post_param[2]=$_post_param[1];
	if(isset($ot) && is_array($ot)) { // 정렬
		foreach($ot as $__k => $__v) {
			$p_str.="&ot[$__k]=".urlencode($__v);
			$_post_param[2].='<input type="hidden" name="ot['.$__k.']" value="'.rg_html_entity($__v)."\">\n";
		}
	} else if(isset($ot)) { 
		$p_str.="&ot=".urlencode($ot);
		$_post_param[2].='<input type="hidden" name="ot" value="'.rg_html_entity($ot)."\">\n";
	}
	$_get_param[2]=$p_str;
	
	$_post_param[3]=$_post_param[2];
	$_get_param[3]=$p_str;
	if(isset($page) && $validate->number_only($page)) {
		$_get_param[3]=$_get_param[3]."&page=$page"; //  페이징까지
		$_post_param[3].='<input type="hidden" name="page" value="'.$page."\">\n";
	}
	
	if(!isset($ss['si']) && !isset($ss['sn']) && !isset($ss['st']) && !isset($ss['sc']) && !isset($ss['kw'])) {
		$ss['si']='';
		$ss['sn']='';
		$ss['st']='1';
		$ss['sc']='1';
	}
	
	$url_list="list_new.php?$_get_param[3]";
	$url_all_list="list_new.php?$_get_param[1]";
	
	$checked_si = ($ss['si'] == '1')?'checked':'';
	$checked_sn = ($ss['sn'] == '1')?'checked':'';
	$checked_st = ($ss['st'] == '1')?'checked':'';
	$checked_sc = ($ss['sc'] == '1')?'checked':'';
	
	// 금지 아이피 체크
	if(rg_chk_deny_ip($_bbs_info['deny_ip'],$_SERVER['REMOTE_ADDR'])) {
		$ip=$_SERVER['REMOTE_ADDR'];
		$_msg_type='deny_ip';
		include("msg.php");
		exit;
	}
?>