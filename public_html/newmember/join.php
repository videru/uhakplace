<?
/* =====================================================

  최종수정일 : 
 ===================================================== */
	include_once("../include/lib.php");
	
//	if($_SESSION['ss_login_ok']) {
//		if($ret_url=='') $ret_url='../main/index.php';
//		rg_href($ret_url);
//	}
	
	$mode="member_join";
	
	// 회원정보 입력폼 설정
	$rs->clear();
	$rs->set_table($_table['setup']);
	$rs->add_field("ss_content");
	$rs->add_where("ss_name='member_form'");
	$rs->fetch('tmp');
	$member_form = unserialize($tmp);
	$member_form['mb_pass']='2'; // 가입시 암호는 필수입력항목

	$required=array();
	foreach($member_form as $k => $v) {
		if($v=='2')
			$required[$k] = 'required';
		else
			$required[$k] = '';
	}

	if($_SERVER['REQUEST_METHOD']=='POST' && $form_mode=='member_join_ok') {
		$mb_id=strtolower($mb_id);
		$mb_email=strtolower($mb_email);
		$mb_jumin = $mb_jumin1.$mb_jumin2;

		$mb_post=$mb_post1.'-'.$mb_post2;
		$mb_tel1=$mb_tel11.'-'.$mb_tel12.'-'.$mb_tel13;
		$mb_tel2=$mb_tel21.'-'.$mb_tel22.'-'.$mb_tel23;
		
		if($mb_post=='-') $mb_post='';
		if($mb_tel1=='--') $mb_tel1='';
		if($mb_tel2=='--') $mb_tel2='';
		
		$mb_address=$mb_post.$mb_address1.$mb_address2;
		$photo1=$_FILES['mb_files']['name']['photo1'];
		$icon1=$_FILES['mb_files']['name']['icon1'];
		
		if($_FILES['mb_files']['name']['photo1']) {
			if(!rg_file_type_chk($_FILES['mb_files']['type']['photo1'],'image')) {
				rg_href('','사진은 이미지로 업로드해주세요.','back');
			}
		}

		if($_FILES['mb_files']['name']['icon1']) {
			if(!rg_file_type_chk($_FILES['mb_files']['type']['icon1'],'image')) {
				rg_href('','아이콘은 이미지로 업로드해주세요.','back');
			}
			// 이미지 크기 체크 
			$tmp = getimagesize($_FILES['mb_files']['tmp_name']['icon1']);
			if($tmp[0] > 16 || $tmp[1] > 16) {
				rg_href('',"아이콘 크기는 가로세로 16이하로 해주세요.",'','back');
			}
		}
		
		if(!$validate->userid($mb_id))
			rg_href('','아이디를 확인해주세요.','back');

		if(!$validate->strlen_chk($mb_pass,4,12) || $mb_pass!=$mb_pass1)
			rg_href('','암호를 확인해주세요.','back');
		
		// 필수입력체크
		foreach($member_form as $k => $v) {
			if($v=='2') {
				if($validate->is_empty($$k))
						rg_href('',$_const['member_forms'][$k].'을(를) 입력해주세요.','back');
			}
		}

		if(!$validate->is_empty($mb_name) && !$validate->han_only($mb_name))
			rg_href('','이름을 확인해주세요.','back');

		if(!$validate->is_empty($mb_nick) && !$validate->nickname($mb_nick))
			rg_href('','닉네임을 확인해주세요.','back');

//		if($validate->is_empty($mb_nick)) $mb_nick=$mb_id; // 닉네임이 없으면 아이디로
	
		if(!$validate->is_empty($mb_jumin) && !$validate->jumin($mb_jumin,'jumin'))
			rg_href('','주민등록 번호를 정확히 입력해주세요.','back');
		
		// 주민등록 번호가 있고 성별입력이 없다면
		if(!$validate->is_empty($mb_jumin) && $mb_sex=='') {
			if(substr($mb_jumin2,0,1)=='1' || substr($mb_jumin2,0,1)=='3')
				$mb_sex='M';
			else
				$mb_sex='F';
		}

		$mb_pass = rg_password_encode($mb_pass);

		$mb_is_mailing	= ($validate->number_only($mb_is_mailing))?$mb_is_mailing:'0';
		$mb_is_opening	= ($validate->number_only($mb_is_opening))?$mb_is_opening:'0';

		$mb_state=$_site_info['join_state'];
		$mb_level=$_site_info['join_level'];
		$mb_point=$_site_info['join_point'];

		$rs->clear();
		$rs->set_table($_table['member']);
		$rs->add_where("mb_id='$mb_id'");
		$rs->select();
		if($rs->num_rows()!=0) // 사용하고 있는 아이디
			rg_href('','이미 사용중인 아이디 입니다.','back');
		
		if(!$validate->is_empty($mb_jumin)) {
			$mb_jumin = rg_password_encode($mb_jumin);
			$rs->clear_where();
			$rs->add_where("mb_jumin='$mb_jumin'");
			$rs->select();
			if($rs->num_rows()!=0) // 사용하고 있는 주민등록번호
				rg_href('','이미사용하고 있는 주민등록번호 입니다.','back');
		}
		
		if(is_array($mb_ext1)) $mb_ext1=serialize($mb_ext1);
		if(is_array($mb_ext2)) $mb_ext2=serialize($mb_ext2);
		if(is_array($mb_ext3)) $mb_ext3=serialize($mb_ext3);
		if(is_array($mb_ext4)) $mb_ext4=serialize($mb_ext4);
		if(is_array($mb_ext5)) $mb_ext5=serialize($mb_ext5);
		if(is_array($mb_open_field)) $mb_open_field=serialize($of);
		
		$rs->clear();
		$rs->set_table($_table['member']);
		$rs->add_field("mb_id","$mb_id");
		$rs->add_field("mb_pass","$mb_pass");
		$rs->add_field("mb_name","$mb_name");
		$rs->add_field("mb_nick","$mb_nick");
		$rs->add_field("mb_level","$mb_level");
		$rs->add_field("mb_state","$mb_state");
		$rs->add_field("mb_jumin","$mb_jumin");
		$rs->add_field("mb_sex","$mb_sex");
		$rs->add_field("mb_post","$mb_post");
		$rs->add_field("mb_address1","$mb_address1");
		$rs->add_field("mb_address2","$mb_address2");
		$rs->add_field("mb_email","$mb_email");
		$rs->add_field("mb_tel1","$mb_tel1");
		$rs->add_field("mb_tel2","$mb_tel2");
		$rs->add_field("mb_is_mailing","$mb_is_mailing");
		$rs->add_field("mb_is_opening","$mb_is_opening");
		$rs->add_field("mb_open_field","$mb_open_field");
		$rs->add_field("mb_signature","$mb_signature");
		$rs->add_field("mb_introduce","$mb_introduce");
		$rs->add_field("mb_admin_memo","$mb_admin_memo");
		$rs->add_field("mb_ext1","$mb_ext1");
		$rs->add_field("mb_ext2","$mb_ext2");
		$rs->add_field("mb_ext3","$mb_ext3");
		$rs->add_field("mb_ext4","$mb_ext4");
		$rs->add_field("mb_ext5","$mb_ext5");
		$rs->add_field("mb_point","0");
		$rs->add_field("login_count","0");
		$rs->add_field("login_date","0");
		$rs->add_field("login_ip","");
		$rs->add_field("join_date",time());
		$rs->add_field("join_ip",$_SERVER['REMOTE_ADDR']);
		$rs->add_field("modify_date","0");
		$rs->add_field("modify_ip","");
		$rs->insert();
		$mb_num=$rs->get_insert_id();
		
		// 파일 업로드
		$mb_files=rg_file_upload($_path['member_data'],"mb_files",$mb_num);
		$mb_files=serialize($mb_files);		

		$rs->clear();
		$rs->set_table($_table['member']);
		$rs->add_field("mb_files","$mb_files");
		$rs->add_where("mb_num=$mb_num");
		$rs->update();
		
		rg_set_point($mb_num,$_po_type_code['etc'],
							$_site_info['join_point'],'회원가입','회원가입포인트','');

		if($_site_info['join_login']=='1') {
			$login_date=time();
			$rs->clear();
			$rs->set_table($_table['member']);
			$rs->add_field("login_count",'1');
			$rs->add_field("login_date",$login_date);
			$rs->add_field("login_ip",$_SERVER['REMOTE_ADDR']);
			$rs->add_where("mb_num=$mb_num");
			$rs->update();
			
			$ss_mb_id = $mb_id;
			$ss_mb_num = $mb_num;
			$ss_login_ok = 'ok';
			$ss_hash = md5($login_date.$mb_id.$mb_num);

			$_SESSION['ss_mb_id']=$ss_mb_id;
			$_SESSION['ss_mb_num']=$ss_mb_num;
			$_SESSION['ss_login_ok']=$ss_login_ok;
			$_SESSION['ss_hash']=$ss_hash;
		}
		
		// 가입완료 파일이 없다면 바로 다음으로 넘기고 
//				if (!file_exists($skin_site_path."mb_join_ok.php")) 
		$rs->commit();
		if($ret_url=='') $ret_url='../main/index.php';
		rg_href($ret_url);
	}

?>
<? include_once('_header.php'); 
?>
<table width="500" align="center" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td>
		<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td height="3" bgcolor="#54A8BA"><img width="1" height="1"></td>
			</tr>
			<tr>
				<td height="28" bgcolor="#F4FAFB">&nbsp;&nbsp;회원가입</td>
			</tr>
			<tr>
				<td height="1" bgcolor="#54A8BA"><img width="1" height="1"></td>
			</tr>
		</table>
		<form name="member_form" method="post" action="?" onsubmit="return validate(this)" enctype='multipart/form-data'>
		<input type="hidden" name="form_mode" value="member_join_ok">
		<input type="hidden" name="ret_url" value="../main/index.php">
		<? include('member_form.php') ?>
		<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td height="1" bgcolor="#54A8BA"><img width="1" height="1"></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td align="center"><input type="submit" value="  확  인  " class="button"></td>
			</tr>
		</table>
		</form>
		</td>
	</tr>
</table>
<script language='Javascript'>
	if(typeof(document.member_form.mb_id) != "undefined")
		document.member_form.mb_id.focus();
</script>
<?// include_once($_path['member'].'_footer.php'); 
?>