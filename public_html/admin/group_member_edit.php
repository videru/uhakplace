<?
/* =====================================================

  최종수정일 : 
 ===================================================== */
 
	include_once("../include/lib.php");
	require_once("admin_chk.php");

	if($mode=='delete') {	// 삭제
		$rs->clear();
		$rs->set_table($_table['gmember']);
		if(is_array($_POST['chk_nums'])) {
			$chk_nums=$_POST['chk_nums'];
			$rs->add_where("gm_num IN (". implode(",",$chk_nums) .")");
		} else {
			$rs->add_where("gm_num=$num");
		}
		$rs->delete();
		$rs->commit();
		rg_href("group_member_list.php?$_get_param[3]");
	} else if($mode=='modify') {
		$rs->clear();
		$rs->set_table($_table['gmember']);
		$rs->add_where("gm_num=$num");
		$rs->select();
		if($rs->num_rows()!=1) { // 정보가 올바르지 않다면
			rg_href('','정보를 찾을수 없습니다.','back');
		}
		$data=$rs->fetch();
	} else {
		if($gr_change=='1' && $gr_num!='') {
			$data['gr_num']=$gr_num;
		} else if($ss[1]!='') {
			$data['gr_num']=$ss[1];
		} else {
			$rs->clear();
			$rs->set_table($_table['group']);
			$rs->add_field('gr_num');
			$rs->set_limit('1');
			$rs->fetch('tmp');
			$data['gr_num']=$tmp;
		}
	}

	$rs->clear();
	$rs->set_table($_table['group']);
	$rs->add_where("gr_num={$data['gr_num']}");
	$rs->select();
	if($rs->num_rows()==1) { // 해당 그룹이 있다면
		$group_info=$rs->fetch();
		if($group_info['gr_level_type']==0)
			$auth_level=$_level_info;
		else
			$auth_level=unserialize($group_info['gr_level_info']);
	}
	foreach($auth_level as $k => $v) {
		$auth_level[$k]="($k) $v";
	}
	
	if($_SERVER['REQUEST_METHOD']=='POST' && $gr_change!='1') {
		if($mode=='modify') {
			$rs->clear();
			$rs->set_table($_table['gmember']);
			$rs->add_field("gm_state","$gm_state");
			$rs->add_field("gm_level","$gm_level");
			$rs->add_field("gm_ext1","$gm_ext1");
			$rs->add_where("gm_num=$num");
			$rs->update();
		} else {
			$mb_nums=explode(',',$mb_nums);
			$rs2 = new $rs_class($dbcon);
			$rs2->clear();
			$rs2->set_table($_table['gmember']);
			
			$rs->clear();
			$rs->set_table($_table['gmember']);
			$rs->add_field("gm_reg_date",time());
			$rs->add_field("gr_num","$gr_num");
			$rs->add_field("gm_reg_ip",$_SERVER['REMOTE_ADDR']);
			$rs->add_field("gm_state","$gm_state");
			$rs->add_field("gm_level","$gm_level");
			$rs->add_field("gm_ext1","$gm_ext1");
			foreach($mb_nums as $mb_num) {
				$rs2->clear_where();
				$rs2->add_where("gr_num=$gr_num");
				$rs2->add_where("mb_num=$mb_num");
				$rs2->select();
				if($rs2->num_rows()==0) {
					$rs->add_field("mb_num","$mb_num");
					$rs->insert(1);
				}
			}
		}
		$rs->commit();
		rg_href("group_member_list.php?$_get_param[3]");
	}
	
	if($mode=='modify' && $data['mb_num']!='') {
		$rs->clear();
		$rs->set_table($_table['member']);
		$rs->add_where("mb_num={$data['mb_num']}");
		$mb_data=$rs->fetch();
	} else {
		$data['gm_state']=$group_info['gr_default_state'];
		$data['gm_level']=$group_info['gr_default_level'];
	}
	
	$MENU_L='m3';
?>
<? include("_header.php"); ?>
<? include("admin.header.php"); ?>
<table border="0" cellspacing="0" cellpadding="0" width="100%" class="site_content">
  <tr>
    <td bgcolor="#F7F7F7">그룹회원 등록/수정</td>
  </tr>
</table>
<br>
<form name="gmember_form" method="post" action="?<?=$_get_param[3]?>" onSubmit="return validate(this)" enctype="multipart/form-data">
<input type="hidden" name="mode" value="<?=$mode?>" />
<input type="hidden" name="gr_change" value="" />
<input type="hidden" name="num" value="<?=$num?>" />
<table border="0" cellpadding="0" cellspacing="0" width="100%" class="site_content">
<? if($mode=='') { ?>
	<tr>
		<td width="120" align="center" bgcolor="#F0F0F4"><strong>그룹선택</strong></td>
		<td><select name="gr_num">
<?
	$rs->clear();
	$rs->set_table($_table['group']);
?>
<?=rg_html_option_rs($rs,$data['gr_num'],'gr_num','gr_name')?>
</select>
		  <input type="button" class="button" onClick="gmember_form.gr_change.value='1';gmember_form.submit();" value="변경"> 그룹 변경시 입력된 내용은 취소됩니다.</td>
	</tr>
  <input type="hidden" name='mb_nums'>
  <input type="hidden" name='mb_texts'>
	<tr>
		<td align="center" bgcolor="#F0F0F4"><strong>회원아이디</strong></td>
		<td><table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><select name="gm_mb_list" id="gm_mb_list" size="10" style="width:200px">
        </select></td>
        <td>&nbsp;<input name="button" type=button class="button" onClick="member_list_popup('<?=$_url['admin']?>', '1|gmember_form||mb_nums|mb_texts|[mb_id]([mb_name])')" value='회 원 선 택' style="height:100px"></td>
      </tr>
    </table>
		  </td>
	</tr>
<script>
function chang_mb_id(){
	var f=document.gmember_form;
  var chk = f.mb_texts.value.split(',');
	for(i=0;i<chk.length;i++) {
		if(f.gm_mb_list.length >= chk.length) {
			if(f.gm_mb_list.options[i].text != chk[i])
				f.gm_mb_list.options[i] = new Option(chk[i]);
		} else
			f.gm_mb_list.options[i] = new Option(chk[i]);
	}
	if(f.gm_mb_list.length!=chk.length)
		f.gm_mb_list.length=chk.length;
}
setInterval(chang_mb_id, 500);
</script>
<? } else { ?>
	<tr>
		<td width="120" align="center" bgcolor="#F0F0F4"><strong>그룹</strong></td>
		<td><?=$group_info['gr_name']?></td>
	</tr>
	<tr>
		<td align="center" bgcolor="#F0F0F4"><strong>회원아이디</strong></td>
		<td><?=$mb_data['mb_id']?></td>
	</tr>
	<tr>
		<td align="center" bgcolor="#F0F0F4"><strong>회원이름</strong></td>
		<td><?=$mb_data['mb_name']?></td>
	</tr>
<? } ?>
	<tr>
    <td align="center" bgcolor="#F0F0F4"><strong>상태</strong></td>
	  <td><select name="gm_state" class="input">
<?=rg_html_option($_const['member_states'],$data['gm_state'])?>
		</select></td>
	  </tr>
	<tr>
		<td align="center" bgcolor="#F0F0F4"><strong>레벨</strong></td>
		<td><select name="gm_level" class="input">
      <?=rg_html_option($auth_level,$data['gm_level'])?>
    </select></td>
	</tr>
<? if($mode=='modify') { ?>
	<tr>
		<td align="center" bgcolor="#F0F0F4"><strong>가입일</strong></td>
		<td><?=rg_date($data['gm_reg_date'])?></td>
	</tr>
	<tr>
		<td align="center" bgcolor="#F0F0F4"><strong>가입IP</strong></td>
		<td><?=$data['gm_reg_ip']?></td>
	</tr>
<? } ?>	
</table>
  <br>
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