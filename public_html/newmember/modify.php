<?
/* =====================================================

  ���������� : 
 ===================================================== */
	include_once("../include/lib.php");
	
	if(!$_mb)
	{?>
	<script>
	(function(){
	 alert("�α��� �ϼ���");
	 document.location = "http://uhakplace.co.kr/temp/login.html"; 
	})();
	</script>
		
		
	<?
	
	//rg_href('../temp/login.php');//���߿� �����ʿ���
	}
	else
	{
	
	$mode="member_modify";
	
	// ȸ������ �Է��� ����
	$rs->clear();
	$rs->set_table($_table['setup']);
	$rs->add_field("ss_content");
	$rs->add_where("ss_name='member_form'");
	$rs->fetch('tmp');
	$member_form = unserialize($tmp);
	
	$required=array();
	foreach($member_form as $k => $v) {
		if($v=='2')
			$required[$k] = 'required';
		else
			$required[$k] = '';
	}
	
	$rs->clear();
	$rs->set_table($_table['member']);
	$rs->add_where("mb_num={$_mb['mb_num']}");
	$rs->select();
	if($rs->num_rows()!=1) { // ȸ�������� �ùٸ��� �ʴٸ�
		rg_href('','ȸ�������� ã���� �����ϴ�.','back');
	}
	$data=$rs->fetch();
	list($data[mb_post1],$data[mb_post2])=explode('-',$data['mb_post']);
	list($data[mb_tel11],$data[mb_tel12],$data[mb_tel13])=explode('-',$data[mb_tel1]);
	list($data[mb_tel21],$data[mb_tel22],$data[mb_tel23])=explode('-',$data[mb_tel2]);
	$data['mb_files']=unserialize($data['mb_files']);

	if($_SERVER['REQUEST_METHOD']=='POST' && $form_mode=='member_modify_ok') {
		$member_form['mb_name']='0'; // �̸� �����Ұ�
		$member_form['mb_jumin']='0'; // �ֹε�Ϲ�ȣ �����Ұ�

		$mb_email=strtolower($mb_email);

		$mb_post=$mb_post1.'-'.$mb_post2;
		$mb_tel1=$mb_tel11.'-'.$mb_tel12.'-'.$mb_tel13;
		$mb_tel2=$mb_tel21.'-'.$mb_tel22.'-'.$mb_tel23;

		if($mb_post=='-') $mb_post='';
		if($mb_tel1=='--') $mb_tel1='';
		if($mb_tel2=='--') $mb_tel2='';
		
		$mb_address=$mb_post.$mb_address1.$mb_address2;
		
		if($mb_files_del['photo1']=='1' || $data['mb_files']['photo1']['name']=='')
			$photo1=$_FILES['mb_files']['name']['photo1'];
			
		if($mb_files_del['icon1']=='1' || $data['mb_files']['icon1']['name']=='')
			$icon1=$_FILES['mb_files']['name']['icon1'];
			
		if($_FILES['mb_files']['name']['photo1']) {
			if(!rg_file_type_chk($_FILES['mb_files']['type']['photo1'],'image')) {
				rg_href('','������ �̹����� ���ε����ּ���.','back');
			}
		}

		if($_FILES['mb_files']['name']['icon1']) {
			if(!rg_file_type_chk($_FILES['mb_files']['type']['icon1'],'image')) {
				rg_href('','�������� �̹����� ���ε����ּ���.','back');
			}
			// �̹��� ũ�� üũ 
			$tmp = getimagesize($_FILES['mb_files']['tmp_name']['icon1']);
			if($tmp[0] > 16 || $tmp[1] > 16) {
				rg_href('',"������ ũ��� ���μ��� 16���Ϸ� ���ּ���.",'','back');
			}
		}
		if(!$validate->is_empty($mb_pass)) {
			if(!$validate->strlen_chk($mb_pass,4,12) || $mb_pass!=$mb_pass1)
				rg_href('','��ȣ�� Ȯ�����ּ���.','back');
			$mb_pass = rg_password_encode($mb_pass);
		}
		
		// �ʼ��Է�üũ
		foreach($member_form as $k => $v) {
			if($v=='2') {
				if($validate->is_empty($$k))
						rg_href('',$_const['member_forms'][$k].'��(��) �Է����ּ���.','back');
			}
		}
		
		if(!$validate->is_empty($mb_nick) && !$validate->nickname($mb_nick))
			rg_href('','�г����� Ȯ�����ּ���.','back');
		
//		if($validate->is_empty($mb_nick)) $mb_nick=$_mb['mb_id'];
		
		$mb_is_mailing	= ($validate->number_only($mb_is_mailing))?$mb_is_mailing:'0';
		$mb_is_opening	= ($validate->number_only($mb_is_opening))?$mb_is_opening:'0';
		
		if(is_array($mb_ext1)) $mb_ext1=serialize($mb_ext1);
		if(is_array($mb_ext2)) $mb_ext2=serialize($mb_ext2);
		if(is_array($mb_ext3)) $mb_ext3=serialize($mb_ext3);
		if(is_array($mb_ext4)) $mb_ext4=serialize($mb_ext4);
		if(is_array($mb_ext5)) $mb_ext5=serialize($mb_ext5);
		if(is_array($of)) $mb_open_field=serialize($of);

		// ���� ���ε�
		$mb_files=rg_file_upload($_path['member_data'],"mb_files",$data['mb_num'],$data['mb_files'],$mb_files_del);
		$mb_files=serialize($mb_files);		

		$rs->clear();
		$rs->set_table($_table['member']);
		if(!$validate->is_empty($mb_pass)) $rs->add_field("mb_pass","$mb_pass");
		$rs->add_field("mb_nick","$mb_nick");
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
		$rs->add_field("mb_files","$mb_files");
		$rs->add_field("mb_ext1","$mb_ext1");
		$rs->add_field("mb_ext2","$mb_ext2");
		$rs->add_field("mb_ext3","$mb_ext3");
		$rs->add_field("mb_ext4","$mb_ext4");
		$rs->add_field("mb_ext5","$mb_ext5");
//		$rs->add_field("mb_point","$mb_point");
		$rs->add_field("modify_date",time());
		$rs->add_field("modify_ip",$_SERVER['REMOTE_ADDR']);
		$rs->add_where("mb_num={$_mb['mb_num']}");
		$rs->update();
		$rs->commit();
		// ���ԿϷ� ������ ���ٸ� �ٷ� �������� �ѱ�� 
//				if (!file_exists($skin_site_path."mb_join_ok.php")) 
		if($ret_url=='') $ret_url='../main/index.php';
		rg_href($ret_url);
	}

	$tmp=unserialize($data[mb_ext1]); if(is_array($tmp)) $data[mb_ext1]=$tmp;
	$tmp=unserialize($data[mb_ext2]); if(is_array($tmp)) $data[mb_ext2]=$tmp;
	$tmp=unserialize($data[mb_ext3]); if(is_array($tmp)) $data[mb_ext3]=$tmp;
	$tmp=unserialize($data[mb_ext4]); if(is_array($tmp)) $data[mb_ext4]=$tmp;
	$tmp=unserialize($data[mb_ext5]); if(is_array($tmp)) $data[mb_ext5]=$tmp;
	unset($tmp);
		
	$c_mb_is_mailing[$data['mb_is_mailing']]='checked';
	$c_mb_is_opening[$data['mb_is_opening']]='checked';
	$tmp=unserialize($data['mb_open_field']); if(is_array($tmp)) $of=$tmp; else $of=array();

	foreach($of as $__k => $__v) {
		if($__v == '1') $c_of[$__k]='checked';
	}
	}
?>
<? include_once('_header.php'); ?>
<table width="500" align="center" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td>
		<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td height="3" bgcolor="#54A8BA"><img width="1" height="1"></td>
			</tr>
			<tr>
				<td height="28" bgcolor="#F4FAFB">&nbsp;&nbsp;ȸ����������</td>
			</tr>
			<tr>
				<td height="1" bgcolor="#54A8BA"><img width="1" height="1"></td>
			</tr>
		</table>
		<form name="member_form" method="post" action="?" onsubmit="return validate(this)" enctype='multipart/form-data'>
		<input type="hidden" name="form_mode" value="member_modify_ok">
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
				<td align="center"><input type="submit" value="  Ȯ  ��  " class="button"></td>
			</tr>
		</table>
		</form>
		</td>
	</tr>
</table>
