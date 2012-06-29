<?
/* =====================================================

  최종수정일 : 
 ===================================================== */
	include_once("../include/lib.php");
	require_once("admin_chk.php");
	
	if($mode=='modify' || $mode=='delete') {
		$rs->clear();
		$rs->set_table($_table['group']);
		$rs->add_where("gr_num=$num");
		$rs->select();
		if($rs->num_rows()!=1) { // 정보가 올바르지 않다면
			rg_href('','정보를 찾을수 없습니다.','back');
		}
		$data=$rs->fetch();
		$data['gr_level_info']=unserialize($data['gr_level_info']);
	} else {
		$data['gr_state']=1;
		$data['gr_default_state']=1;
		$data['gr_default_level']=1;
		$data['gr_level_type']=0;
		$data['gr_level_info']=array(0=>'손님',1=>'레벨1',2=>'레벨2',3=>'레벨3',4=>'레벨4',5=>'레벨5',
												 6=>'레벨6',7=>'레벨7',8=>'레벨8',9=>'레벨9',50=>'관리자');
	}
	if($data['gr_level_type']==0) $data['gr_level_info']=$_level_info;

	if($mode=='delete') {	// 삭제
		// 회원삭제하고
		$rs->set_table($_table['gmember']);
		$rs->delete();
		// 그룹설정 삭제
		$rs->set_table($_table['group']);
		$rs->delete();
		// 게시판은 놔둔다

		$rs->commit();
		rg_href("group_list.php?$_get_param[3]");
	}
	
	if($_SERVER['REQUEST_METHOD']=='POST') {
		$gr_id=strtolower(trim($gr_id));
		
		if(is_array($gr_ext_cfg)) $gr_ext_cfg=serialize($gr_ext_cfg);
		
		$rs->clear();
		$rs->set_table($_table['group']);
		$rs->add_where("gr_id='".$dbcon->escape_string($bbs_code)."'");
		if($mode=='modify') $rs->add_where("gr_num<>$num");
		$rs->select();
		if($rs->num_rows()>0) {
			rg_href('','이미 사용중인 아이디 입니다.','back');
		}
		
		unset($tmp);
		if(is_array($gr_level_info['level'])) {
			foreach($gr_level_info['level'] as $k => $v)
				if($v!='')
					$tmp[$v]=$gr_level_info['name'][$k];
			ksort($tmp);
		}
		$gr_level_info=serialize($tmp);
		unset($tmp);
		
		$rs->clear();
		$rs->set_table($_table['group']);
		$rs->add_field("gr_id","$gr_id");
		$rs->add_field("gr_name","$gr_name");
		$rs->add_field("gr_desc","$gr_desc");
		$rs->add_field("gr_header_file","$gr_header_file");
		$rs->add_field("gr_header_tag","$gr_header_tag");
		$rs->add_field("gr_footer_tag","$gr_footer_tag");
		$rs->add_field("gr_footer_file","$gr_footer_file");
		$rs->add_field("gr_state","$gr_state");
		$rs->add_field("gr_default_state","$gr_default_state");
		$rs->add_field("gr_default_level","$gr_default_level");
		$rs->add_field("gr_level_type","$gr_level_type");
		$rs->add_field("gr_level_info","$gr_level_info");
		$rs->add_field("gr_ext_cfg","$gr_ext_cfg");
		$rs->add_field("gr_admin_memo","$gr_admin_memo");
		if($mode=='modify') {
			$rs->add_where("gr_num=$num");
			$rs->update();
		} else {
			$rs->add_field("gr_reg_date",time());
			$rs->add_field("gr_reg_mb",$_mb['mb_num']);
			$rs->insert();
			$num=$rs->get_insert_id();		
		}
		$rs->commit();
		rg_href("group_list.php?$_get_param[3]");
	}
	$MENU_L='m3';
?>
<? include("_header.php"); ?>
<? include("admin.header.php"); ?>
<table border="0" cellspacing="0" cellpadding="0" width="100%" class="site_content">
  <tr>
    <td bgcolor="#F7F7F7">그룹정보 등록/수정</td>
  </tr>
</table>
<br>
<form name="group_form" method="post" action="?<?=$_get_param[3]?>" onSubmit="return validate(this)" enctype="multipart/form-data">
<input type="hidden" name="mode" value="<?=$mode?>" />
<input type="hidden" name="num" value="<?=$num?>" />
<table border="0" cellpadding="0" cellspacing="0" width="100%" class="site_content">
	<tr>
		<td width="120" align="center" bgcolor="#F0F0F4"><strong>그룹아이디</strong></td>
		<td><input name="gr_id" type="text" value="<?=$data['gr_id']?>" class="input">
&nbsp;</td>
	</tr>
	<tr>
		<td align="center" bgcolor="#F0F0F4"><strong>그룹이름</strong></td>
		<td><input name="gr_name" type="text" value="<?=$data['gr_name']?>" class="input"></td>
	</tr>
	<tr>
		<td align="center" bgcolor="#F0F0F4"><strong>그룹설명</strong></td>
		<td><textarea name="gr_desc" cols="60" rows="3"><?=$data['gr_desc']?></textarea>		</td>
	</tr>
	<tr>
    <td align="center" bgcolor="#F0F0F4"><strong>헤더파일</strong></td>
	  <td><input name="gr_header_file" type="text" class="input" value="<?=$data['gr_header_file']?>" size="60"></td>
	  </tr>
	<tr>
		<td align="center" bgcolor="#F0F0F4"><strong>헤더태그</strong></td>
		<td><textarea name="gr_header_tag" cols="60" rows="3"><?=$data['gr_header_tag']?></textarea></td>
	</tr>
	<tr>
		<td align="center" bgcolor="#F0F0F4"><strong>풋터태그</strong></td>
		<td><textarea name="gr_footer_tag" cols="60" rows="3"><?=$data['gr_footer_tag']?></textarea></td>
	</tr>
	<tr>
    <td align="center" bgcolor="#F0F0F4"><strong>풋터파일</strong></td>
	  <td><input name="gr_footer_file" type="text" class="input" value="<?=$data['gr_footer_file']?>" size="60"></td>
	  </tr>
	<tr>
		<td align="center" bgcolor="#F0F0F4"><strong>그룹상태</strong></td>
		<td><select name="gr_state" class="input" id="gr_state">
<?=rg_html_option($_const['group_states'],$data['gr_state'])?>
		</select></td>
	</tr>
	<tr>
		<td align="center" bgcolor="#F0F0F4"><strong>기본상태</strong></td>
		<td><select name="gr_default_state" class="input">
<?=rg_html_option($_const['member_states'],$data['gr_default_state'])?>
		</select></td>
	</tr>
	<tr>
		<td align="center" bgcolor="#F0F0F4"><strong>기본레벨</strong></td>
		<td><select name="gr_default_level" class="input">
<?=rg_html_option($data['gr_level_info'],$data['gr_default_level'])?>
		</select></td>
	</tr>
	<tr>
    <td align="center" bgcolor="#F0F0F4"><strong>레벨기준</strong></td>
	  <td><select name="gr_level_type" class="input">
        <?=rg_html_option($_const['group_level_type'],$data['gr_level_type'])?>
    </select></td>
	  </tr>
	<tr>
    <td align="center" bgcolor="#F0F0F4"><strong>관리자메모</strong></td>
	  <td><textarea name="gr_admin_memo" cols="60" rows="3"><?=$data['mb_admin_memo']?></textarea></td>
	  </tr>
<? if($mode=='modify') { ?>
	<tr>
		<td align="center" bgcolor="#F0F0F4"><strong>등록일</strong></td>
		<td><?=rg_date($data['gr_reg_date'])?></td>
	</tr>
	<tr>
		<td align="center" bgcolor="#F0F0F4"><strong>등록자</strong></td>
		<td><?=$data['gr_reg_mb']?></td>
	</tr>
<? } ?>	
</table>
  <br>
  <table border="0" cellspacing="0" cellpadding="0" width="100%" align="center">
    <tr>
      <td height="30" bgcolor="#E6E6FF">&nbsp;&nbsp;<strong>레벨별 이름설정</strong></td>
    </tr>
  </table>
	<table border="0" cellpadding="0" cellspacing="0" width="100%" class="site_content" id="tb1">
    <tr>
      <td width="120" align="right" bgcolor="#F0F0F4">레벨&nbsp;</td>
      <td bgcolor="#F0F0F4">&nbsp;레벨이름 (0 : 비회원, <?=$_const['group_admin_level']?> : 관리자)</td>
    </tr>
<?
	$i=0;
	if(is_array($data['gr_level_info'])) 
	foreach($data['gr_level_info'] as $k => $v) {
		$i++;
?>
    <tr>
      <td align="right"><input type="text" class="input" name=gr_level_info[level][] value="<?=$k?>" size="3" dir="rtl">&nbsp;</td>
      <td>&nbsp;<input type="text" class="input" name=gr_level_info[name][] value="<?=$v?>" size=50> <input type="button" value="삭제" class="button" onClick="level_delete(event)"></td>
    </tr>
<?
	}
?>
	</table>
  <table border="1" cellpadding="0" cellspacing="0" width="100%" class="site_content">
    <tr>
      <td align="center"><input type="button" value=" 추 가 " class="button" onClick="level_insert()"></td>
    </tr>
  </table>
<script>
var row_count=<?=$i?>;

function level_delete(e)
{
	var obj = find_parent_tag(e,'td');
	if(obj.parentNode)
		var idx = obj.parentNode.rowIndex;
	else
		var idx = obj.parentElement.rowIndex;
	var tRow = tb1.deleteRow(idx);
}

function level_insert() {
	if(row_count<100) {
		row_count++;
		if(document.getElementById){
			var Tbl = document.getElementById('tb1');
		} else {
			var Tbl = document.all['tb1'];
		}
		var tRow = Tbl.insertRow(-1);  	
		var tmp=tRow.insertCell(0);
		tmp.innerHTML ='<input type="text" class="input" name=gr_level_info[level][] value="" size="3" dir="rtl">&nbsp;';
		tmp.align='right';
		tmp=tRow.insertCell(1);
		tmp.innerHTML ='&nbsp;<input type="text" class="input" name=gr_level_info[name][] value="" size=50> <input type="button" value="삭제" class="button" onClick="level_delete(event)">';
	}
}
</script>
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