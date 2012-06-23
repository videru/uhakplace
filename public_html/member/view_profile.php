<?
/* =====================================================

  최종수정일 : 
	2007-12-10 배열 $data의 XSS 취약성 수정
 ===================================================== */
	include_once("../include/lib.php");
	
	// 회원로그인 여부체크
	if(!$_mb)
		rg_href($_url['member'].'login.php');
	
	$rs->clear();
	$rs->set_table($_table['member']);
	$rs->add_where("mb_id='".$dbcon->escape_string($mb_id)."'");
	$rs->select();
	if($rs->num_rows()!=1) { // 회원정보가 올바르지 않다면
		rg_href('','회원정보를 찾을수 없습니다.','close');
	}
	$data=$rs->fetch();
	
	if(!$data['mb_is_opening'] && !$_auth['admin']) 
		rg_href('','회원정보를 공개하지 않았습니다.','close');
	
	$data['mb_files']=unserialize($data['mb_files']);

	$tmp=unserialize($data[mb_ext1]); if(is_array($tmp)) $data[mb_ext1]=$tmp;
	$tmp=unserialize($data[mb_ext2]); if(is_array($tmp)) $data[mb_ext2]=$tmp;
	$tmp=unserialize($data[mb_ext3]); if(is_array($tmp)) $data[mb_ext3]=$tmp;
	$tmp=unserialize($data[mb_ext4]); if(is_array($tmp)) $data[mb_ext4]=$tmp;
	$tmp=unserialize($data[mb_ext5]); if(is_array($tmp)) $data[mb_ext5]=$tmp;
	unset($tmp);
		
	$tmp=unserialize($data['mb_open_field']); if(is_array($tmp)) $of=$tmp; else $of=array();
	
	if($data['mb_files'][photo1][name]!='') 
		$img_view_url=$_url['member']."mb_data.php?mb_id=$mb_id&key=photo1&mode=view";
	else
		$img_view_url='';

	
	if($_auth['admin']) {
		$of['mb_name']=1;
		$of['mb_email']=1;
		$of['mb_tel1']=1;
		$of['mb_tel2']=1;
		$of['mb_post']=1;
		if($img_view_url!='') $of['photo1']=1;
	}
	
	if($img_view_url!='')
		$of['photo1']=0;

	rg_array_recursive_function($data, 'rg_get_text');
?>
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link href="<?=$_url['css']?>style.css" rel="stylesheet" type="text/css">
</head>
<script src="<?=$_url['js']?>common.js"></script>
<script src="<?=$_url['js']?>lib.validate.js"></script>
<body bottommargin="0" topmargin="0" leftmargin="0" rightmargin="0">
<table width="500" align="center" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td>
		<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td height="3" bgcolor="#54A8BA"><img width="1" height="1"></td>
			</tr>
			<tr>
				<td height="28" bgcolor="#F4FAFB">&nbsp;&nbsp;회원정보</td>
			</tr>
			<tr>
				<td height="1" bgcolor="#54A8BA"><img width="1" height="1"></td>
			</tr>
		</table>
		<table width="100%" align="center" border="0" cellpadding="0" cellspacing="6">
			<col width=100></col><col>
			</col>
			<tr>
				<td align="right"><strong>아이디</strong>&nbsp;</td>
				<td><a href="javascript:note_write('<?=$_url['member']?>','<?=$data['mb_id']?>');"><?=$data['mb_id']?></a></td>
			</tr>
			<tr>
				<td height="1" colspan="2" bgcolor="#ECECEC"><img width="1" height="1"></td>
			</tr>
			<? if($of['mb_name']) { ?>
			<tr>
				<td align="right"><strong>이름</strong></td>
				<td><?=$data['mb_name']?></td>
			</tr>
			<tr>
				<td height="1" colspan="2" bgcolor="#ECECEC"><img width="1" height="1"></td>
			</tr>
			<? } ?>
			<tr>
				<td align="right"><strong>닉네임</strong></td>
				<td><?=$data['mb_nick']?></td>
			</tr>
			<tr>
				<td height="1" colspan="2" bgcolor="#ECECEC"><img width="1" height="1"></td>
			</tr>
			<? if($of['mb_email']) { ?>
			<tr>
				<td align="right"><strong>이메일</strong></td>
				<td><?=$data['mb_email']?></td>
			</tr>
			<tr>
				<td height="1" colspan="2" bgcolor="#ECECEC"><img width="1" height="1"></td>
			</tr>
			<? } ?>
			<? if($of[mb_tel1]) { ?>
			<tr>
				<td align="right"><strong>전화번호</strong></td>
				<td><?=$data[mb_tel1]?></td>
			</tr>
			<tr>
				<td height="1" colspan="2" bgcolor="#ECECEC"><img width="1" height="1"></td>
			</tr>
			<? } ?>
			<? if($of[mb_tel2]) { ?>
			<tr>
				<td align="right"><strong>핸드폰번호</strong></td>
				<td><?=$data[mb_tel2]?></td>
			</tr>
			<tr>
				<td height="1" colspan="2" bgcolor="#ECECEC"><img width="1" height="1"></td>
			</tr>
			<? } ?>
			<? if($of['mb_post']) { ?>
			<tr>
				<td align="right"><strong>우편번호</strong></td>
				<td><?=$data['mb_post']?></td>
			</tr>
			<tr>
				<td height="1" colspan="2" bgcolor="#ECECEC"><img width="1" height="1"></td>
			</tr>
			<tr>
				<td align="right"><strong>주소</strong></td>
				<td><?=$data[mb_address1]?>
					<br><img width="1" height="5" /><br />
					<?=$data[mb_address2]?></td>
			</tr>
			<tr>
				<td height="1" colspan="2" bgcolor="#ECECEC"><img width="1" height="1"></td>
			</tr>
			<? } ?>
			<tr>
				<td align="right"><strong>자기소개</strong></td>
				<td><?=rg_get_text($data['mb_introduce'])?></td>
			</tr>
			<tr>
				<td height="1" colspan="2" bgcolor="#ECECEC"><img width="1" height="1"></td>
			</tr>
			<? if($of[photo1] && $img_view_url) { ?>
			<tr>
				<td align="right"><strong>사진</strong></td>
				<td><img src="<?=$img_view_url?>"></td>
			</tr>
			<tr>
				<td height="1" colspan="2" bgcolor="#ECECEC"><img width="1" height="1"></td>
			</tr>
			<? } ?>
			<tr>
				<td align="right"><strong>레벨</strong></td>
				<td><?=$_level_info[$data['mb_level']]?></td>
			</tr>
			<tr>
				<td height="1" colspan="2" bgcolor="#ECECEC"><img width="1" height="1"></td>
			</tr>
			<tr>
				<td align="right"><strong>가입일</strong></td>
				<td><?=rg_date($data['join_date'])?></td>
			</tr>
			<tr>
				<td height="1" colspan="2" bgcolor="#ECECEC"><img width="1" height="1"></td>
			</tr>
			<tr>
				<td align="right"><strong>최근접속일</strong></td>
				<td><?=rg_date($data['login_date'])?> (<?=$data['login_count']?>)</td>
			</tr>
			<tr>
				<td height="1" colspan="2" bgcolor="#ECECEC"><img width="1" height="1"></td>
			</tr>
      
			<? if($_auth['admin']) { ?>
			<tr>
				<td align="right"><strong>상태</strong></td>
				<td><?=$_const['member_states'][$data['mb_state']]?></td>
			</tr>
			<tr>
				<td height="1" colspan="2" bgcolor="#ECECEC"><img width="1" height="1"></td>
			</tr>
			<tr>
				<td align="right"><strong>최근접속아이피</strong></td>
				<td><?=$data[login_ip]?></td>
			</tr>
			<tr>
				<td height="1" colspan="2" bgcolor="#ECECEC"><img width="1" height="1"></td>
			</tr>
      <? } ?>
		</table>
		<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td height="1" bgcolor="#54A8BA"><img width="1" height="1"></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td align="center"><input type="button" value="  확  인  " class="button" onClick="self.close()"></td>
			</tr>
		</table>
		</td>
	</tr>
</table>
</body>
</html>

