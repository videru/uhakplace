<?
/* =====================================================
	
  최종수정일 : 
 ===================================================== */
	include_once("../include/lib.php");
	require_once("admin_chk.php");
	
	// 회원정보 입력폼 설정
	$rs->clear();
	$rs->set_table($_table['setup']);
	$rs->add_field("ss_content");
	$rs->add_where("ss_name='member_form'");
	$rs->fetch('tmp');
	$member_form = unserialize($tmp);
	
	if($mode=='modify' || $mode=='delete') {
		$rs->clear();
		$rs->set_table($_table['member']);
		$rs->add_where("mb_num=$num");
		$rs->select();
		if($rs->num_rows()!=1) { // 회원정보가 올바르지 않다면
			rg_href('','회원정보를 찾을수 없습니다.','back');
		}
		$data=$rs->fetch();
		list($data[mb_post1],$data[mb_post2])=explode('-',$data['mb_post']);
		list($data[mb_tel11],$data[mb_tel12],$data[mb_tel13])=explode('-',$data[mb_tel1]);
		list($data[mb_tel21],$data[mb_tel22],$data[mb_tel23])=explode('-',$data[mb_tel2]);
		
		$data[mb_jumin1]=substr($data['mb_jumin'],0,6);
		$data[mb_jumin2]=substr($data['mb_jumin'],6);
		
		$data['mb_files']=unserialize($data['mb_files']);
	} else {
		$mode='join';
		$data['mb_state']=$_site_info['join_state'];
		$data['mb_level']=$_site_info['join_level'];
	}
	
	if($mode=='delete') {	// 삭제
		rg_upload_file_delete($_path['member_data'],$data['mb_files']); // 파일삭제
		// 회원정보 삭제
		$rs->delete();
		// 포인트 지우고
		$rs->clear();
		$rs->set_table($_table['point']);
		$rs->add_where("mb_num={$data['mb_num']}");
		$rs->delete();
		// 쪽지 지우고			
		$rs->clear();
		$rs->set_table($_table['note']);
		$rs->add_where("mb_num={$data['mb_num']}");
		$rs->delete();
		$rs->commit();
		rg_href("member_list.php?$_get_param[3]");
	}

	if($_SERVER['REQUEST_METHOD']=='POST') {
		$mb_id=strtolower($mb_id);
		$mb_email=strtolower($mb_email);
		$mb_jumin = $mb_jumin1.$mb_jumin2;
		
		if($mb_pass!='') $mb_pass = rg_password_encode($mb_pass);
		if($mb_jumin!='') $mb_jumin = rg_password_encode($mb_jumin);

		$mb_post=$mb_post1.'-'.$mb_post2;
		$mb_tel1=$mb_tel11.'-'.$mb_tel12.'-'.$mb_tel13;
		$mb_tel2=$mb_tel21.'-'.$mb_tel22.'-'.$mb_tel23;
		
		if(is_array($mb_ext1)) $mb_ext1=serialize($mb_ext1);
		if(is_array($mb_ext2)) $mb_ext2=serialize($mb_ext2);
		if(is_array($mb_ext3)) $mb_ext3=serialize($mb_ext3);
		if(is_array($mb_ext4)) $mb_ext4=serialize($mb_ext4);
		if(is_array($mb_ext5)) $mb_ext5=serialize($mb_ext5);
		if(is_array($of)) $mb_open_field=serialize($of);

		$rs->clear();
		$rs->set_table($_table['member']);
		$rs->add_where("mb_id='".$dbcon->escape_string($mb_id)."'");
		if($mode=='modify') $rs->add_where("mb_num<>$num");
		$rs->select();
		if($rs->num_rows()>0) {
			rg_href('','이미 사용중인 아이디 입니다.','back');
		}
		
//		if($validate->is_empty($mb_nick)) $mb_nick=$mb_id;
		if($mode=='join') {
			// 주민등록 번호가 있고 성별입력이 없다면
			if(!$validate->is_empty($mb_jumin) && $mb_sex=='') {
				if(substr($mb_jumin2,0,1)=='1' || substr($mb_jumin2,0,1)=='3')
					$mb_sex='M';
				else
					$mb_sex='F';
			}
		} else $mb_sex=$data['mb_sex'];
				
		$rs->clear();
		$rs->set_table($_table['member']);
		$rs->add_field("mb_id","$mb_id");
		if($mb_pass!='') $rs->add_field("mb_pass","$mb_pass");
		$rs->add_field("mb_name","$mb_name");
		$rs->add_field("mb_nick","$mb_nick");
		$rs->add_field("mb_level","$mb_level");
		$rs->add_field("mb_state","$mb_state");
		if($mb_jumin!='') $rs->add_field("mb_jumin","$mb_jumin");
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
		if($mode=='join') {
			$rs->insert();
			$num=$rs->get_insert_id();		
		} else if($mode=='modify') {
			$rs->add_where("mb_num=$num");
			$rs->update();
		}
		
		// 파일 업로드
		$mb_files=rg_file_upload($_path['member_data'],"mb_files",$num,$data['mb_files'],$mb_files_del);
		$mb_files=serialize($mb_files);		

		$rs->clear();
		$rs->set_table($_table['member']);
		$rs->add_field("mb_files","$mb_files");
		$rs->add_where("mb_num=$num");
		$rs->update();
		$rs->commit();
		rg_href("member_list.php?$_get_param[3]");
	}
	$MENU_L='m2';
	$c_mb_is_mailing[$data['mb_is_mailing']]='checked';
	$c_mb_is_opening[$data['mb_is_opening']]='checked';

	$tmp=unserialize($data['mb_open_field']); if(is_array($tmp)) $of=$tmp; else $of=array();
	
	foreach($of as $__k => $__v) {
		if($__v == '1') $c_of[$__k]='checked';
	}
?>
<? include("_header.php"); ?>
<? include("admin.header.php"); ?>
<table border="0" cellspacing="0" cellpadding="0" width="100%" class="site_content">
  <tr>
    <td bgcolor="#F7F7F7">회원정보 등록/수정</td>
  </tr>
</table>
<br>
<form name="member_form" method="post" action="?<?=$_get_param[3]?>" onSubmit="return validate(this)" enctype="multipart/form-data">
<input type="hidden" name="mode" value="<?=$mode?>" />
<input type="hidden" name="num" value="<?=$num?>" />
<table border="0" cellpadding="0" cellspacing="0" width="100%" class="site_content">
	<tr>
		<td width="120" align="center" bgcolor="#F0F0F4"><strong>아이디</strong></td>
		<td><input name="mb_id" type="text" value="<?=$data['mb_id']?>" class="input">
&nbsp;<input type="button" onClick="search_mb_id('<?=$_url['member']?>','member_form|mb_id',document.member_form.mb_id.value)" value="중복확인" class="button"></td>
	</tr>
	<tr>
		<td align="center" bgcolor="#F0F0F4"><strong>암호</strong></td>
		<td><input name="mb_pass" type="password" value="" class="input" hname="암호" match="mb_pass1">
		암호확인 <input name="mb_pass1" type="password" value="" class="input">
		[변경할 경우 입력하세요.]</td>
	</tr>
<? if($member_form['mb_name']!=0) { ?>
	<tr>
		<td align="center" bgcolor="#F0F0F4"><strong>이름</strong></td>
		<td><input name="mb_name" type="text" value="<?=$data['mb_name']?>" class="input"> <input type="checkbox" name="of[mb_name]" value="1" <?=$c_of['mb_name']?> />
공개</td>
	</tr>
<? } // end if mb_name ?>
<? if($member_form['mb_nick']!=0) { ?>
	<tr>
		<td align="center" bgcolor="#F0F0F4"><strong>닉네임</strong></td>
		<td><input name="mb_nick" type="text" value="<?=$data['mb_nick']?>" class="input"></td>
	</tr>
<? } // end if mb_nick ?>
<? if($member_form['mb_email']!=0) { ?>  
	<tr>
		<td align="center" bgcolor="#F0F0F4"><strong>이메일</strong></td>
		<td><input name="mb_email" type="text" size="40" value="<?=$data['mb_email']?>" class="input"> <input type="checkbox" name="of[mb_email]" value="1" <?=$c_of['mb_email']?> />
공개</td>
	</tr>
<? } // end if mb_email ?>
<? if($member_form['mb_jumin']!=0) { ?>
	<tr>
	  <td align="center" bgcolor="#F0F0F4"><strong>주민등록번호</strong></td>
	  <td><input name="mb_jumin1" type="text" size="6" value="" class="input">
-
  <input name="mb_jumin2" type="text" size="7"value="" class="input"> 
  [
  
  변경할 경우 입력하세요.] </td>
	  </tr>
<? } // end if mb_jumin ?>
<? if($member_form['mb_tel1']!=0) { ?>
	<tr>
		<td align="center" bgcolor="#F0F0F4"><strong>전화번호</strong></td>
		<td><input name="mb_tel11" type="text" size="4" value="<?=$data[mb_tel11]?>" class="input">
-
<input name="mb_tel12" type="text" size="4" value="<?=$data[mb_tel12]?>" class="input">
-
<input name="mb_tel13" type="text" size="4" value="<?=$data[mb_tel13]?>" class="input">
<input type="checkbox" name="of[mb_tel1]" value="1" <?=$c_of[mb_tel1]?> />
공개</td>
	</tr>
<? } // end if mb_tel1 ?>
<? if($member_form['mb_tel2']!=0) { ?>
	<tr>
		<td align="center" bgcolor="#F0F0F4"><strong>핸드폰번호</strong></td>
		<td><input name="mb_tel21" type="text" size="4" value="<?=$data[mb_tel21]?>" class="input">
-
<input name="mb_tel22" type="text" size="4" value="<?=$data[mb_tel22]?>" class="input">
-
<input name="mb_tel23" type="text" size="4" value="<?=$data[mb_tel23]?>" class="input">
<input type="checkbox" name="of[mb_tel2]" value="1" <?=$c_of[mb_tel2]?> />
공개</td>
	</tr>
<? } // end if mb_tel2 ?>
<? if($member_form['mb_address']!=0) { ?>
	<tr>
		<td align="center" bgcolor="#F0F0F4"><strong>우편번호</strong></td>
		<td><input name="mb_post1" type="text" size="3" value="<?=$data[mb_post1]?>" class="input">
-
<input name="mb_post2" type="text" size="3" value="<?=$data[mb_post2]?>" class="input">
<input type="button" onClick="search_post('<?=$_url['member']?>','member_form|mb_post1|mb_post2|mb_address1|mb_address2')" value="우편번호" class="button">
<input type="checkbox" name="of[mb_post]" value="1" <?=$c_of['mb_post']?> />
주소공개</td>
	</tr>
	<tr>
		<td align="center" bgcolor="#F0F0F4"><strong>주소</strong></td>
		<td><input name="mb_address1" type="text" size="60" value="<?=$data[mb_address1]?>" class="input">
				<br>
				<input name="mb_address2" type="text" size="40" value="<?=$data[mb_address2]?>" class="input">
[상세주소] </td>
	</tr>
<? } // end if mb_address ?>
<? if($member_form['mb_signature']!=0) { ?>
	<tr>
		<td align="center" bgcolor="#F0F0F4"><strong>서명</strong></td>
		<td><textarea name="mb_signature" cols="60" rows="3"><?=$data['mb_signature']?></textarea>
		  <br>
		  (본인이 작성한 글 하단에 표시됩니다.) </td>
	</tr>
<? } // end if mb_signature ?>
<? if($member_form['mb_introduce']!=0) { ?>
	<tr>
		<td align="center" bgcolor="#F0F0F4"><strong>자기소개</strong></td>
		<td><textarea name="mb_introduce" cols="60" rows="3"><?=$data['mb_introduce']?></textarea>
		  <br>
		  (정보공개한 경우 다른 사람이 볼수 있습니다.)</td>
	</tr>
<? } // end if mb_introduce ?>
	<tr>
		<td align="center" bgcolor="#F0F0F4"><strong>관리자메모</strong></td>
		<td><textarea name="mb_admin_memo" cols="60" rows="3"><?=$data['mb_admin_memo']?></textarea></td>
	</tr>
<? if($member_form['icon1']!=0) { ?>
	<tr>
    <td align="center" bgcolor="#F0F0F4"><strong>아이콘</strong></td>
	  <td><input type="file" name="mb_files[icon1]" class="input" size="30" /><br />
        <? if($data['mb_files']['icon1']['name']!='') { ?>
        <?=$data['mb_files']['icon1']['name']?>
        <input type="checkbox" name="mb_files_del[icon1]" value="1" />
	    삭제
	    <? } ?>    </td>
	  </tr>
<? } // end if icon1 ?>
<? if($member_form['photo1']!=0) { ?>
	<tr>
    <td align="center" bgcolor="#F0F0F4"><strong>사진</strong></td>
	  <td><input type="file" name="mb_files[photo1]" class="input" size="30" />
        <input type="checkbox" name="of[photo1]" value="1" <?=$c_of[photo1]?> />
공개<br />
        <? if($data['mb_files']['photo1']['name']!='') { ?>
        <?=$data['mb_files']['photo1']['name']?>
        <input type="checkbox" name="mb_files_del[photo1]" value="1" />
	    삭제
	    <? } ?>    </td>
	  </tr>
<? } // end if photo1 ?>
	<tr>
	  <td align="center" bgcolor="#F0F0F4">&nbsp;</td>
	  <td><input name="mb_is_mailing" type="checkbox" id="mb_is_mailing" value="1" <?=$c_mb_is_mailing[1]?>>
      <strong>메일수신</strong> &nbsp;
      <input name="mb_is_opening" type="checkbox" id="mb_is_opening" value="1" <?=$c_mb_is_opening[1]?>>
      <strong>정보공개</strong></td>
	  </tr>
	<tr>
		<td align="center" bgcolor="#F0F0F4"><strong>상태</strong></td>
		<td><select name="mb_state" class="input">
<?=rg_html_option($_const['member_states'],$data['mb_state'])?>
		</select></td>
	</tr>
	<tr>
		<td align="center" bgcolor="#F0F0F4"><strong>레벨</strong></td>
		<td><select name="mb_level" class="input">
<?=rg_html_option($_level_info,$data['mb_level'])?>
		</select></td>
	</tr>
<? if($mode=='modify') { ?>
	<tr>
		<td align="center" bgcolor="#F0F0F4"><strong>가입일</strong></td>
		<td><?=rg_date($data['join_date'])?></td>
	</tr>
	<tr>
		<td align="center" bgcolor="#F0F0F4"><strong>가입IP</strong></td>
		<td><?=$data['join_ip']?></td>
	</tr>
	<tr>
		<td align="center" bgcolor="#F0F0F4"><strong>로그인</strong></td>
		<td><?=rg_date($data['login_date'])?></td>
	</tr>
	<tr>
		<td align="center" bgcolor="#F0F0F4"><strong>로그인IP</strong></td>
		<td><?=$data['login_ip']?><br></td>
	</tr>
	<tr>
		<td align="center" bgcolor="#F0F0F4"><strong>로그인회수</strong></td>
		<td><?=$data['login_count']?><br></td>
	</tr>
	<tr>
		<td align="center" bgcolor="#F0F0F4"><strong>최근정보수정일</strong></td>
		<td><?=rg_date($data['modify_date'])?></td>
	</tr>
	<tr>
		<td align="center" bgcolor="#F0F0F4"><strong>정보수정IP</strong></td>
		<td><?=$data['modify_ip']?><br></td>
	</tr>
<? } ?>	
</table>
<table width="600" border="0" align="center">
	<tr>
		<td align="center">
			<input type="submit" value="등록/수정" class="button">
			<input type="button" value=" 취   소 " onClick="history.back();" class="button">
		</td>
	</tr>
</table>
</form>
<? include("admin.footer.php"); ?>
<? include("_footer.php"); ?>