<?
/* =====================================================
  ���α׷��� : �������� V4
  ȭ�ϸ� : 
  �ۼ��� : 
  �ۼ��� : ������ ( http://rgboard.com )
  �ۼ��� E-Mail : master@rgboard.com

  ���������� : 
 ===================================================== */
	include_once("../include/lib.php");
	require_once("admin_chk.php");
	
	if($mode=='modify' || $mode=='delete') {
		$rs->clear();
		$rs->set_table($_table['bbs_cfg']);
		$rs->add_where("bbs_num=$num");
		$rs->select();
		if($rs->num_rows()!=1) { // ������ �ùٸ��� �ʴٸ�
			rg_href('','������ ã���� �����ϴ�.','back');
		}
		// �׷� �������ΰ��
		if($gr_change=='1' && $gr_num!='') {
			$rs->add_field("gr_num","$gr_num");
			$rs->update();
			rg_href("?$_get_param[3]&mode=$mode&num=$num");
		}
		$data=$rs->fetch();
	} else {
		if($gr_change=='1' && $gr_num!='') {
			$data['gr_num']=$gr_num;
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
	if($rs->num_rows()==1) { // �ش� �׷��� �ִٸ�
		$group_info=$rs->fetch();
		if($group_info['gr_level_type']==0)
			$auth_level=$_level_info;
		else
			$auth_level=unserialize($group_info['gr_level_info']);
	}
	if(!$auth_level[0]) $auth_level[0]='��ȸ��';
	if(!$auth_level[100]) $auth_level[100]='������';
	foreach($auth_level as $k => $v) {
		$auth_level[$k]="($k) $v";
	}
	
	if($mode=='delete') {	// ����
		// ����� �Խ����� �ִ��� Ȯ��
		$rs->clear();
		$rs->set_table($_table['bbs_cfg']);
		$rs->add_where("bbs_num<>$num");
		$rs->add_where("bbs_db_num=$num");
		$rs->select();
		if($rs->num_rows()==1)
			rg_href('','���� �Ұ�:\n����� �Խ����� �ֽ��ϴ�.\n����� �Խ��� ���� ����/���� ���ּ���.','back');
		
		// �ڸ�Ʈ ����
		$rs->clear();
		$rs->set_table($_table['bbs_comment']);
		$rs->add_where("bbs_db_num=$num");
		$rs->delete();
		
		// ÷������ ����
		$rs->clear();
		$rs->set_table($_table['bbs_body']);
		$rs->add_where("bbs_db_num=$num");
		while($data=$rs->fetch()) {
			$data['bd_files']=unserialize($data['bd_files']);
			upload_file_delete($_path['bbs_data'],$data['bd_files']);
		}
		
		// �ۻ���
		$rs->delete();
		
		// ī�װ� ����
		$rs->clear();
		$rs->set_table($_table['bbs_category']);
		$rs->add_where("bbs_db_num=$num");
		$rs->delete();
		
		// �Խ��� ��������
		$rs->clear();
		$rs->set_table($_table['bbs_cfg']);
		$rs->add_where("bbs_num=$num");
		$rs->delete();

		$rs->commit();
		rg_href("bbs_list.php?$_get_param[3]");
	}
	
	if($_SERVER['REQUEST_METHOD']=='POST' && $gr_change!='1') {
		$bbs_code=strtolower(trim($bbs_code));
		$bbs_db=strtolower(trim($bbs_db));
		
		if($mode=='modify') {
			$bbs_code=$data['bbs_code'];
		} else {
			if($bbs_code=='')
				rg_href('','�Խ����ڵ带 �Է����ּ���.','back');
		}
		
		$rs->clear();
		$rs->set_table($_table['bbs_cfg']);
		$rs->add_where("bbs_code='".$dbcon->escape_string($bbs_code)."'");
		if($mode=='modify') $rs->add_where("bbs_num<>$num");
		$rs->select();
		if($rs->num_rows()>0) {
			rg_href('','�̹� ������� ���̵� �Դϴ�.','back');
		}
		
		if($bbs_db=='')
			$bbs_db=$bbs_code;
		else if($bbs_db!=$bbs_code) {
			$rs->clear();
			$rs->set_table($_table['bbs_cfg']);
			$rs->add_where("bbs_code='".$dbcon->escape_string($bbs_db)."'");
			if($mode=='modify') $rs->add_where("bbs_num<>$num");
			$rs->select();
			if($rs->num_rows()==0) {
				rg_href('','��������� ã���� �����ϴ�.','back');
			}
		}

		$list_cfg=serialize($list_cfg);
		$write_cfg=serialize($write_cfg);
		$reply_cfg=serialize($reply_cfg);
		$view_cfg=serialize($view_cfg);

		$rs->clear();
		$rs->set_table($_table['bbs_cfg']);
		$rs->add_field("bbs_db","$bbs_db");
		$rs->add_field("bbs_name","$bbs_name");
		$rs->add_field("bbs_skin","$bbs_skin");
		$rs->add_field("use_category","$use_category");
		$rs->add_field("default_content","$default_content");
		$rs->add_field("header_file","$header_file");
		$rs->add_field("header_tag","$header_tag");
		$rs->add_field("footer_tag","$footer_tag");
		$rs->add_field("footer_file","$footer_file");
		$rs->add_field("auth_list","$auth_list");
		$rs->add_field("auth_view","$auth_view");
		$rs->add_field("auth_write","$auth_write");
		$rs->add_field("auth_reply","$auth_reply");
		$rs->add_field("auth_modify","$auth_modify");
		$rs->add_field("auth_delete","$auth_delete");
		$rs->add_field("auth_comment","$auth_comment");
		$rs->add_field("auth_secret","$auth_secret");
		$rs->add_field("list_cfg","$list_cfg");
		$rs->add_field("write_cfg","$write_cfg");
		$rs->add_field("reply_cfg","$reply_cfg");
		$rs->add_field("view_cfg","$view_cfg");
		$rs->add_field("mailing_mb_id","$mailing_mb_id");
		$rs->add_field("admin_mb_id","$admin_mb_id");
		$rs->add_field("point_write","$point_write");
		$rs->add_field("point_reply","$point_reply");
		$rs->add_field("point_comment","$point_comment");
		$rs->add_field("admin_memo","$admin_memo");
		$rs->add_field("bbs_ext1","$bbs_ext1");
		$rs->add_field("bbs_ext2","$bbs_ext2");
		$rs->add_field("bbs_ext3","$bbs_ext3");
		$rs->add_field("bbs_ext4","$bbs_ext4");
		$rs->add_field("bbs_ext5","$bbs_ext5");
		$rs->add_field("deny_word","$deny_word");
		$rs->add_field("deny_html","$deny_html");
		$rs->add_field("deny_ip","$deny_ip");
		
		if($mode=='modify') {
			$rs->add_where("bbs_num=$num");
			$rs->update();
		} else {
			$rs->add_field("bbs_code","$bbs_code");
			$rs->add_field("gr_num","$gr_num");
			$rs->add_field("reg_date",time());
			$rs->insert();
			$num=$rs->get_insert_id();		
		}
		
		$rs->clear();
		$rs->set_table($_table['bbs_cfg']);
		$rs->add_where("bbs_code='".$dbcon->escape_string($bbs_db)."'");
		$rs->fetch("bbs_db_num");
		
		$rs->clear();
		$rs->set_table($_table['bbs_cfg']);
		$rs->add_field("bbs_db_num","$bbs_db_num");
		$rs->add_where("bbs_num=$num");
		$rs->update();
		
		if($mode!='modify') {
			// ����̶�� �⺻ī�װ� �Է�
			if(RG_DBTYPE==RG_DB_CUBRID) {
				include_once($_path['inc']."cubrid_schema.inc.php");
			} else if(RG_DBTYPE==RG_DB_MYSQL) {
				include_once($_path['inc']."mysql_schema.inc.php");
			}
			$rs->clear();
			$rs->set_table($_table['bbs_category']);
			foreach($db_bbs_catrgory_data as $v) {
				$rs->add_field("bbs_db_num","$bbs_db_num");
				$rs->add_field("cat_order","$v[0]");
				$rs->add_field("cat_name","$v[1]");
				$rs->add_field("cat_count","0");
				$rs->insert(true);
			}
		}
		$rs->commit();
		rg_href("bbs_list.php?$_get_param[3]");
	}
	if($mode=='modify') {
		$sub_cfg_toggle='��';
		$sub_cfg_dispay='';
//		$sub_cfg_toggle='��';
//		$sub_cfg_dispay='display:none;';
		$list_cfg=unserialize($data['list_cfg']);
		$write_cfg=unserialize($data['write_cfg']);
		$reply_cfg=unserialize($data['reply_cfg']);
		$view_cfg=unserialize($data['view_cfg']);
	} else {
		$sub_cfg_toggle='��';
		$sub_cfg_dispay='';
		$data['use_category']='0';
		$data['auth_secret']='50';
		$list_cfg['new_time']='24';
		$list_cfg['date_format']='%Y-%m-%d';
		$list_cfg['list_count']='20';
		$list_cfg['page_count']='10';
		$list_cfg['subject_limit']='60';
		
		$write_cfg['use_html']='0';
		$write_cfg['use_home']='0';
		$write_cfg['use_secret']='100';
		$write_cfg['use_notice']='50';
		$write_cfg['use_upload']='100';
		$write_cfg['use_link']='100';
		$write_cfg['upload_count']='2';
		$write_cfg['link_count']='2';
		$write_cfg['write_deny_time']='5';
		$write_cfg['reply_delete']='4';
		$write_cfg['writer_modify']='100';
		
		$reply_cfg['subject_prefix']='[�亯]';
		$reply_cfg['quote_use']='1';
		$reply_cfg['quote_subject']='{NAME} ���� ���Դϴ�.';
		$reply_cfg['quote_mark']='>';
		
		$view_cfg['date_format']='%Y-%m-%d %H:%M:%S';
		$view_cfg['view_image']='0';
		$view_cfg['view_list']='0';
		$view_cfg['view_signature']='1';
		$view_cfg['view_comment']='0';
		$view_cfg['use_download']='0';
		$view_cfg['btn_prev_next']='0';
		$view_cfg['btn_list']='0';
		$view_cfg['btn_modify']='0';
		$view_cfg['btn_del']='0';
		$view_cfg['btn_reply']='0';
		$view_cfg['c_date_format']='%Y-%m-%d %H:%M:%S';
		$view_cfg['vote_yes']='100';
		$view_cfg['vote_no']='100';

		$data['deny_word']='8��,����,������,�һ���,����,����,����,����,�ϱ��,���,����,�ֳ�,�ֳ�,����,����,�ϱ��,��������,���,������,�ٺ�����,�û���,����,����,�ù�,����,���׶�,����,��õ��,��õid,��õ���̵�,��õid,��õ���̵�,��/õ/��,����,���,�ΰ���,��ģ��,��ģ��,���,�׽��ϴ�,�Ծ�,�Ե��,�����';
		$data['deny_html']='script,xml';

		$data['point_write']='0';
		$data['point_reply']='0';
		$data['point_comment']='0';
	}
	$MENU_L='m4';
?>
<? include("_header.php"); ?>
<? include("admin.header.php"); ?>
<table border="1" cellpadding="6" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1">
  <tr>
    <td bgcolor="#F7F7F7">�Խ������� ���/����</td>
  </tr>
</table>
<br>
<form name="bbs_cfg_form" method="post" action="?<?=$_get_param[3]?>" onSubmit="return validate(this)" enctype="multipart/form-data">
<input type="hidden" name="mode" value="<?=$mode?>" />
<input type="hidden" name="gr_change" value="" />
<input type="hidden" name="num" value="<?=$num?>" />
<table border="1" cellspacing="0" cellpadding="0" width="100%" align="center" bordercolordark="#E1E1E1" bordercolorlight="#FFFFFF">
	<tr>
		<td class="a_sub_title">�Խ��Ǳ⺻����</td>
	</tr>
</table>
<table border="1" cellpadding="3" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1">
	<tr>
		<td width="120" align="center" bgcolor="#F0F0F4"><strong>�Խ����ڵ�</strong></td>
		<td><input name="bbs_code" type="text" value="<?=$data['bbs_code']?>" class="input">
&nbsp;</td>
	</tr>
	<tr>
		<td align="center" bgcolor="#F0F0F4"><strong>����</strong></td>
		<td><input name="bbs_db" type="text" value="<?=$data['bbs_db']?>" class="input"> 
		(����� ��� �Խ����ڵ�� ����) </td>
	</tr>
	<tr>
		<td align="center" bgcolor="#F0F0F4"><strong>�׷�</strong></td>
		<td><select name="gr_num">
<?
	$rs->clear();
	$rs->set_table($_table['group']);
?>
<?=rg_sql_html_option($rs->select(),$data['gr_num'],'gr_num','gr_name')?>
</select>
		  <input type="button" class="button" onClick="bbs_cfg_form.gr_change.value='1';bbs_cfg_form.submit();" value="����"> 
		  �׷� ����� ������ ������ ��ҵ˴ϴ�.</td>
	</tr>
	<tr>
		<td align="center" bgcolor="#F0F0F4"><strong>�̸�</strong></td>
		<td><input name="bbs_name" type="text" value="<?=$data['bbs_name']?>" class="input"></td>
	</tr>
	<tr>
		<td align="center" bgcolor="#F0F0F4"><strong>��Ų</strong></td>
		<td><select name="bbs_skin" id="bbs_skin">
<?=rg_html_option(rg_get_filelist($_path['bbs_skin'],'d'),$data['bbs_skin'],'','',true)?>
        </select>		</td>
	</tr>
	<tr>
		<td align="center" bgcolor="#F0F0F4"><strong>ī�װ�</strong></td>
		<td><?=rg_html_radio("use_category",array(0=>"������","�����"),$data['use_category'],NULL,NULL,'','','','&nbsp;&nbsp;')?></td>
	</tr>
	<tr>
    <td align="center" bgcolor="#F0F0F4"><strong>�⺻��</strong></td>
	  <td><textarea name="default_content" cols="60" rows="3"><?=$data['default_content']?></textarea></td>
	  </tr>
	<tr>
    <td align="center" bgcolor="#F0F0F4"><strong>�����ڸ޸�</strong></td>
	  <td><textarea name="admin_memo" cols="60" rows="3"><?=$data['admin_memo']?></textarea></td>
	  </tr>
</table>	
<table border="1" cellspacing="0" cellpadding="0" width="100%" align="center" bordercolordark="#E1E1E1" bordercolorlight="#FFFFFF">
	<tr>
		<td class="a_sub_title" onClick="toggle_display_object(tbl_design,span_design,'��','��')" style="cursor:hand">�����ΰ��� <span id="span_design"><?=$sub_cfg_toggle?></span></td>
	</tr>
</table>
<table border="1" cellpadding="3" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" id='tbl_design' style="table-layout:fixed;<?=$sub_cfg_dispay?>">
	<tr>
    <td width="120" align="center" bgcolor="#F0F0F4"><strong>�������</strong></td>
	  <td><input name="header_file" type="text" class="input" value="<?=$data['header_file']?>" size="60"></td>
	  </tr>
	<tr>
		<td align="center" bgcolor="#F0F0F4"><strong>����±�</strong></td>
		<td><textarea name="header_tag" cols="60" rows="10" style="width:100%"><?=$data['header_tag']?></textarea></td>
	</tr>
	<tr>
		<td align="center" bgcolor="#F0F0F4"><strong>ǲ���±�</strong></td>
		<td><textarea name="footer_tag" cols="60" rows="10" style="width:100%"><?=$data['footer_tag']?></textarea></td>
	</tr>
	<tr>
    <td align="center" bgcolor="#F0F0F4"><strong>ǲ������</strong></td>
	  <td><input name="footer_file" type="text" class="input" value="<?=$data['footer_file']?>" size="60"></td>
	  </tr>
</table>	
<table border="1" cellspacing="0" cellpadding="0" width="100%" align="center" bordercolordark="#E1E1E1" bordercolorlight="#FFFFFF">
	<tr>
		<td class="a_sub_title" onClick="toggle_display_object(tbl_auth,span_auth,'��','��')" style="cursor:hand">���Ѽ��� <span id="span_auth"><?=$sub_cfg_toggle?></span> (�ش緹���̻� �̿밡��)</td>
	</tr>
</table>
<table border="1" cellpadding="3" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" id='tbl_auth' style="table-layout:fixed;<?=$sub_cfg_dispay?>">
	<tr>
	  <td width="120" align="center" bgcolor="#F0F0F4"><strong>�۸�Ϻ���</strong></td>
	  <td><select name="auth_list" class="input" id="auth_list">
      <?=rg_html_option($auth_level,$data['auth_list'])?>
    </select></td>
	  <td width="120" align="center" bgcolor="#F0F0F4"><strong>�۾���</strong></td>
	  <td><select name="auth_write" class="input" id="auth_write">
      <?=rg_html_option($auth_level,$data['auth_write'])?>
    </select></td>
	  </tr>
	<tr>
	  <td align="center" bgcolor="#F0F0F4"><strong>�ۺ���</strong></td>
	  <td><select name="auth_view" class="input" id="auth_view">
      <?=rg_html_option($auth_level,$data['auth_view'])?>
    </select></td>
	  <td align="center" bgcolor="#F0F0F4"><strong>�亯��</strong></td>
	  <td><select name="auth_reply" class="input" id="auth_reply">
      <?=rg_html_option($auth_level,$data['auth_reply'])?>
    </select></td>
	  </tr>
	<tr>
	  <td align="center" bgcolor="#F0F0F4"><strong>��б� ���� </strong></td>
	  <td><select name="auth_secret" class="input" id="auth_secret">
      <?=rg_html_option($auth_level,$data['auth_secret'])?>
    </select></td>
	  <td align="center" bgcolor="#F0F0F4"><strong>�ڸ�Ʈ</strong></td>
	  <td><select name="auth_comment" class="input" id="auth_comment">
      <?=rg_html_option($auth_level,$data['auth_comment'])?>
    </select></td>
	  </tr>
	<tr>
	  <td align="center" bgcolor="#F0F0F4"><strong>�ۼ���</strong></td>
	  <td><select name="auth_modify" class="input" id="auth_modify">
        <?=rg_html_option($auth_level,$data['auth_modify'])?>
    </select><br>
		�ش緹���̸� �����Ұ�
			</td>
	  <td align="center" bgcolor="#F0F0F4"><strong>�ۻ���</strong></td>
	  <td><select name="auth_delete" class="input" id="auth_delete">
        <?=rg_html_option($auth_level,$data['auth_delete'])?>
    </select><br>
		�ش緹���̸� �����Ұ�
			</td>
	</tr>
</table>	
<table border="1" cellspacing="0" cellpadding="0" width="100%" align="center" bordercolordark="#E1E1E1" bordercolorlight="#FFFFFF">
	<tr>
		<td class="a_sub_title" onClick="toggle_display_object(tbl_list_cfg,span_list_cfg,'��','��')" style="cursor:hand">�۸�� <span id="span_list_cfg"><?=$sub_cfg_toggle?></span></td>
	</tr>
</table>
<table border="1" cellpadding="3" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" id="tbl_list_cfg" style="table-layout:fixed;<?=$sub_cfg_dispay?>">
	<tr>
	  <td width="120" align="center" bgcolor="#F0F0F4"><strong>��ϱۼ�</strong></td>
	  <td><input name="list_cfg[list_count]" type="text" class="input" value="<?=$list_cfg['list_count']?>" size="4" dir="rtl"></td>
	  <td width="120" bgcolor="#F0F0F4"><strong>new �����ܽð�</strong></td>
	  <td><input name="list_cfg[new_time]" type="text" class="input" value="<?=$list_cfg['new_time']?>" size="4" dir="rtl">�ð�</td>
	  </tr>
	<tr>
	  <td align="center" bgcolor="#F0F0F4"><strong>������ڼ�</strong></td>
	  <td><input name="list_cfg[subject_limit]" type="text" class="input" value="<?=$list_cfg['subject_limit']?>" size="4" dir="rtl"></td>
	  <td bgcolor="#F0F0F4"><strong>�������̵�</strong></td>
	  <td><input name="list_cfg[page_count]" type="text" class="input" value="<?=$list_cfg['page_count']?>" size="4" dir="rtl"></td>
	  </tr>
	<tr>
	  <td align="center" bgcolor="#F0F0F4"><strong>��¥����</strong></td>
	  <td colspan="3"><input name="list_cfg[date_format]" type="text" class="input" value="<?=$list_cfg['date_format']?>" size="20"></td>
	  </tr>
</table>	
<table border="1" cellspacing="0" cellpadding="0" width="100%" align="center" bordercolordark="#E1E1E1" bordercolorlight="#FFFFFF">
	<tr>
		<td class="a_sub_title" onClick="toggle_display_object(tbl_write_cfg,span_write_cfg,'��','��')" style="cursor:hand">�۾��� <span id="span_write_cfg"><?=$sub_cfg_toggle?></span></td>
	</tr>
</table>
<table border="1" cellpadding="3" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" id="tbl_write_cfg" style="table-layout:fixed;<?=$sub_cfg_dispay?>">
	<tr>
	  <td width="120" align="center" bgcolor="#F0F0F4"><strong>��������</strong></td>
	  <td><select name="write_cfg[use_notice]" class="input" id="use_notice">
        <?=rg_html_option($auth_level,$write_cfg['use_notice'])?>
      </select></td>
	  <td width="120" align="center" bgcolor="#F0F0F4"><strong>html ���</strong></td>
	  <td><select name="write_cfg[use_html]" class="input" id="use_html">
        <?=rg_html_option($auth_level,$write_cfg['use_html'])?>
      </select></td>
	  </tr>
	<tr>
	  <td align="center" bgcolor="#F0F0F4"><strong>��б�</strong></td>
	  <td><select name="write_cfg[use_secret]" class="input" id="use_secret">
        <?=rg_html_option($auth_level,$write_cfg['use_secret'])?>
      </select></td>
	  <td align="center" bgcolor="#F0F0F4"><strong>Ȩ��������ũ</strong></td>
	  <td><select name="write_cfg[use_home]" class="input" id="use_home">
        <?=rg_html_option($auth_level,$write_cfg['use_home'])?>
      </select></td>
	  </tr>
	<tr>
    <td align="center" bgcolor="#F0F0F4"><strong>��ũ</strong></td>
	  <td><select name="write_cfg[use_link]" class="input" id="use_link">
        <?=rg_html_option($auth_level,$write_cfg['use_link'])?>
      </select></td>
	  <td align="center" bgcolor="#F0F0F4"><strong>��ũ����</strong></td>
	  <td><input name="write_cfg[link_count]" type="text" class="input" value="<?=$write_cfg['link_count']?>" size="4" dir="rtl"></td>
	  </tr>
	<tr>
    <td align="center" bgcolor="#F0F0F4"><strong>���ε�</strong></td>
	  <td><select name="write_cfg[use_upload]" class="input" id="use_upload">
        <?=rg_html_option($auth_level,$write_cfg['use_upload'])?>
      </select></td>
	  <td align="center" bgcolor="#F0F0F4"><strong>���ε��</strong></td>
	  <td><input name="write_cfg[upload_count]" type="text" class="input" value="<?=$write_cfg['upload_count']?>" size="4" dir="rtl"></td>
	  </tr>
	<tr>
	  <td align="center" bgcolor="#F0F0F4"><b>�ۼ���ǥ��</b></td>
	  <td><select name="write_cfg[writer_name]" class="input" id="writer_name">
      <?=rg_html_option(array(1=>'�̸�','���̵�','�г���'),$write_cfg['writer_name'])?>
    </select></td>
	  <td align="center" bgcolor="#F0F0F4"><b>�ۼ��ڸ���</b></td>
	  <td><select name="write_cfg[writer_modify]" class="input" id="writer_modify">
      <?=rg_html_option($auth_level,$write_cfg['writer_modify'])?>
    </select>
	    �ش緹���̻� ���氡�� </td>
	  </tr>
	<tr>
	  <td align="center" bgcolor="#F0F0F4"><b>����۹���</b></td>
	  <td><select name="write_cfg[spam_chk]" class="input" id="spam_chk">
      <?=rg_html_option($auth_level,$write_cfg['spam_chk'])?>
    </select></td>
	  <td align="center" bgcolor="#F0F0F4">&nbsp;</td>
	  <td>&nbsp;</td>
	  </tr>
	<tr>
    <td align="center" bgcolor="#F0F0F4"><strong>������ؽð�</strong></td>
	  <td><input name="write_cfg[write_deny_time]" type="text" class="input" value="<?=$write_cfg['write_deny_time']?>" size="4" dir="rtl">
	    �� </td>
	  <td align="center" bgcolor="#F0F0F4"><strong>�亯���ϼ���</strong></td>
	  <td><select name="write_cfg[use_reply_mail]" class="input" id="reply_mail">
        <?=rg_html_option($auth_level,$write_cfg['use_reply_mail'])?>
    </select></td>
	  </tr>
	<tr>
	  <td align="center" bgcolor="#F0F0F4"><strong>���ñ� ������� </strong></td>
	  <td colspan="3"><?=rg_html_radio("write_cfg[reply_delete]",array(0=>'���Ѿ���', '����/�����Ұ�', '�����Ұ�', '�����Ұ�', '����ǥ�ø�'),$write_cfg['reply_delete'],NULL,NULL,'','','','&nbsp;&nbsp;')?></td>
	  </tr>
</table>	
<table border="1" cellspacing="0" cellpadding="0" width="100%" align="center" bordercolordark="#E1E1E1" bordercolorlight="#FFFFFF">
	<tr>
		<td class="a_sub_title" onClick="toggle_display_object(tbl_reply_cfg,span_reply_cfg,'��','��')" style="cursor:hand">�亯�� <span id="span_reply_cfg"><?=$sub_cfg_toggle?></span></td>
	</tr>
</table>
<table border="1" cellpadding="3" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" id="tbl_reply_cfg" style="table-layout:fixed;<?=$sub_cfg_dispay?>">
	<tr>
	  <td width="120" align="center" bgcolor="#F0F0F4"><strong>�������ι���</strong></td>
	  <td><input name="reply_cfg[subject_prefix]" type="text" class="input" value="<?=$reply_cfg['subject_prefix']?>" size="20">
	     ����պκп� �ٴ� ���� </td>
	  </tr>
	<tr>
	  <td align="center" bgcolor="#F0F0F4"><strong>�������ο뿩��</strong></td>
	  <td><?=rg_html_radio("reply_cfg[quote_use]",array(0=>"������","�����"),$reply_cfg['quote_use'],NULL,NULL,'','','','&nbsp;&nbsp;')?></td>
	  </tr>
	<tr>
	  <td align="center" bgcolor="#F0F0F4"><strong>ǥ���ο��</strong></td>
	  <td><input name="reply_cfg[quote_subject]" type="text" class="input" value="<?=$reply_cfg['quote_subject']?>" size="50"></td>
	  </tr>
	<tr>
	  <td align="center" bgcolor="#F0F0F4"><strong>�������ο��ȣ</strong></td>
	  <td><input name="reply_cfg[quote_mark]" type="text" class="input" value="<?=$reply_cfg['quote_mark']?>" size="4"></td>
	  </tr>
</table>	
<table border="1" cellspacing="0" cellpadding="0" width="100%" align="center" bordercolordark="#E1E1E1" bordercolorlight="#FFFFFF">
	<tr>
		<td class="a_sub_title" onClick="toggle_display_object(tbl_view_cfg,span_view_cfg,'��','��')" style="cursor:hand">�ۺ��� <span id="span_view_cfg"><?=$sub_cfg_toggle?></span></td>
	</tr>
</table>
<table border="1" cellpadding="3" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" id="tbl_view_cfg" style="table-layout:fixed;<?=$sub_cfg_dispay?>">
	<tr>
	  <td width="120" align="center" bgcolor="#F0F0F4"><strong>�ڸ�Ʈ����</strong></td>
	  <td><select name="view_cfg[view_comment]" class="input" id="view_comment">
        <?=rg_html_option($auth_level,$view_cfg['view_comment'])?>
      </select></td>
	  <td width="120" align="center" bgcolor="#F0F0F4"><strong>�̹������� ���� </strong></td>
	  <td><select name="view_cfg[view_image]" class="input" id="view_image">
        <?=rg_html_option($auth_level,$view_cfg['view_image'])?>
      </select></td>
	  </tr>
	<tr>
	  <td align="center" bgcolor="#F0F0F4"><strong>�ٿ�ε�</strong></td>
	  <td><select name="view_cfg[use_download]" class="input" id="use_download">
        <?=rg_html_option($auth_level,$view_cfg['use_download'])?>
      </select></td>
	  <td align="center" bgcolor="#F0F0F4"><strong>����ǥ��</strong></td>
	  <td><select name="view_cfg[view_signature]" class="input" id="view_signature">
        <?=rg_html_option($auth_level,$view_cfg['view_signature'])?>
      </select></td>
	  </tr>
	<tr>
	  <td align="center" bgcolor="#F0F0F4"><strong>�۸���Բ�����</strong></td>
	  <td><select name="view_cfg[view_list]" class="input" id="view_list">
        <?=rg_html_option($auth_level,$view_cfg['view_list'])?>
      </select></td>
	  <td align="center" bgcolor="#F0F0F4">&nbsp;</td>
	  <td>&nbsp;</td>
	  </tr>
	<tr>
	  <td align="center" bgcolor="#F0F0F4"><strong>����Ʈ ��ư</strong></td>
	  <td><select name="view_cfg[btn_list]" class="input" id="btn_list">
        <?=rg_html_option($auth_level,$view_cfg['btn_list'])?>
      </select></td>
	  <td align="center" bgcolor="#F0F0F4"><strong>����/������ ��ư</strong></td>
	  <td><select name="view_cfg[btn_prev_next]" class="input" id="btn_prev_next">
        <?=rg_html_option($auth_level,$view_cfg['btn_prev_next'])?>
      </select></td>
	  </tr>
	<tr>
	  <td align="center" bgcolor="#F0F0F4"><strong>�ۼ��� ��ư</strong></td>
	  <td><select name="view_cfg[btn_modify]" class="input" id="btn_modify">
        <?=rg_html_option($auth_level,$view_cfg['btn_modify'])?>
      </select></td>
	  <td align="center" bgcolor="#F0F0F4"><strong>�ۻ��� ��ư</strong></td>
	  <td><select name="view_cfg[btn_del]" class="input" id="btn_del">
        <?=rg_html_option($auth_level,$view_cfg['btn_del'])?>
      </select></td>
	  </tr>
	<tr>
	  <td align="center" bgcolor="#F0F0F4"><strong>����� ��ư</strong></td>
	  <td><select name="view_cfg[btn_reply]" class="input" id="btn_reply">
        <?=rg_html_option($auth_level,$view_cfg['btn_reply'])?>
      </select></td>
	  <td bgcolor="#F0F0F4">&nbsp;</td>
	  <td>&nbsp;</td>
	  </tr>
	<tr>
	  <td align="center" bgcolor="#F0F0F4"><b>��õ���</b></td>
	  <td><select name="view_cfg[vote_yes]" class="input" id="vote_no">
      <?=rg_html_option($auth_level,$view_cfg['vote_yes'])?>
    </select></td>
	  <td align="center" bgcolor="#F0F0F4"><b>�ݴ���</b></td>
	  <td><select name="view_cfg[vote_no]" class="input" id="vote_no">
      <?=rg_html_option($auth_level,$view_cfg['vote_no'])?>
    </select></td>
	  </tr>
	<tr>
    <td align="center" bgcolor="#F0F0F4"><strong>��¥����</strong></td>
	  <td colspan="3"><input name="view_cfg[date_format]" type="text" class="input" value="<?=$view_cfg['date_format']?>" size="40"></td>
	  </tr>
	<tr>
	  <td align="center" bgcolor="#F0F0F4"><strong>�ڸ�Ʈ��¥����</strong></td>
	  <td colspan="3"><input name="view_cfg[c_date_format]" type="text" class="input" value="<?=$view_cfg['c_date_format']?>" size="40">
      <br>
      <font color="#FF0000">%Y : �⵵, %m : ��, %d : ��, %H : �ð�, %M : ��, %S : �� (strftime �Լ�   �����ϼ���)</font></td>
	  </tr>
</table>


<table border="1" cellspacing="0" cellpadding="0" width="100%" align="center" bordercolordark="#E1E1E1" bordercolorlight="#FFFFFF">
	<tr>
		<td class="a_sub_title" onClick="toggle_display_object(tbl_deny,span_deny,'��','��')" style="cursor:hand">���Ѽ��� <span id="span_deny"><?=$sub_cfg_toggle?></span></td>
	</tr>
</table>
<table border="1" cellpadding="3" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" id="tbl_deny" style="table-layout:fixed;<?=$sub_cfg_dispay?>">
    <tr>
      <td width="120" align="center" bgcolor="#F0F0F4">�����Ҵܾ���</td>
      <td><textarea name="deny_word" cols="60" rows="10" class="input"><?=$data['deny_word']?></textarea></td>
    </tr>
    <tr>
      <td align="center" bgcolor="#F0F0F4">������HTML</td>
      <td><textarea name="deny_html" cols="60" rows="10" class="input"><?=$data['deny_html']?></textarea></td>
    </tr>
    <tr>
      <td width="120" align="center" bgcolor="#F0F0F4">�������� IP </td>
      <td><textarea name="deny_ip" cols="60" rows="10" class="input"><?=$data['deny_ip']?></textarea></td>
    </tr>
</table>


<table border="1" cellspacing="0" cellpadding="0" width="100%" align="center" bordercolordark="#E1E1E1" bordercolorlight="#FFFFFF">
	<tr>
		<td class="a_sub_title" onClick="toggle_display_object(tbl_etc_cfg,span_etc_cfg,'��','��')" style="cursor:hand">��Ÿ���� <span id="span_etc_cfg"><?=$sub_cfg_toggle?></span></td>
	</tr>
</table>
<table border="1" cellpadding="3" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" id="tbl_etc_cfg" style="table-layout:fixed;<?=$sub_cfg_dispay?>">
	<tr>
	  <td width="120" align="center" bgcolor="#F0F0F4"><strong>���ϼ���<br>
	    ���̵���</strong></td>
	  <td><textarea name="mailing_mb_id" cols="60" rows="3"><?=$data['mailing_mb_id']?></textarea><br>
���� �ö���� �ش� �ϴ� ���̵�� ���Ϲ߼�</td>
	  </tr>
	<tr>
	  <td align="center" bgcolor="#F0F0F4"><strong>�Խ��ǰ�����<br>
	    ���̵���</strong></td>
	  <td><textarea name="admin_mb_id" cols="60" rows="3"><?=$data['admin_mb_id']?></textarea><br>
�ش� ���̵�� ����,������ �����ο� (�Խ��� ������ ������ �ȵ�)</td>
	  </tr>
	<tr>
	  <td align="center" bgcolor="#F0F0F4">&nbsp;</td>
	  <td>&nbsp;</td>
	  </tr>
	<tr>
	  <td align="center" bgcolor="#F0F0F4"><strong>���ۼ�����Ʈ</strong></td>
	  <td><input name="point_write" type="text" class="input" value="<?=$data['point_write']?>" size="4" dir="rtl"></td>
	  </tr>
	<tr>
	  <td align="center" bgcolor="#F0F0F4"><strong>�亯������Ʈ</strong></td>
	  <td><input name="point_reply" type="text" class="input" value="<?=$data['point_reply']?>" size="4" dir="rtl"></td>
	  </tr>
	<tr>
	  <td align="center" bgcolor="#F0F0F4"><strong>�ڸ�Ʈ����Ʈ</strong></td>
	  <td><input name="point_comment" type="text" class="input" value="<?=$data['point_comment']?>" size="4" dir="rtl"></td>
	  </tr>
</table>

<table border="1" cellspacing="0" cellpadding="0" width="100%" align="center" bordercolordark="#E1E1E1" bordercolorlight="#FFFFFF">
	<tr>
		<td class="a_sub_title" onClick="toggle_display_object(tbl_ext_cfg,span_ext_cfg,'��','��')" style="cursor:hand">�߰����� <span id="span_ext_cfg"><?=$sub_cfg_toggle?></span></td>
	</tr>
</table>
<table border="1" cellpadding="3" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" id="tbl_ext_cfg" style="table-layout:fixed;<?=$sub_cfg_dispay?>">
	<tr>
	  <td width="120" align="center" bgcolor="#F0F0F4"><strong>�߰�����1</strong></td>
	  <td><input name="bbs_ext1" type="text" class="input" value="<?=$data[bbs_ext1]?>"></td>
	  </tr>
	<tr>
	  <td width="120" align="center" bgcolor="#F0F0F4"><strong>�߰�����2</strong></td>
	  <td><input name="bbs_ext2" type="text" class="input" value="<?=$data[bbs_ext2]?>"></td>
	  </tr>
	<tr>
	  <td width="120" align="center" bgcolor="#F0F0F4"><strong>�߰�����3</strong></td>
	  <td><input name="bbs_ext3" type="text" class="input" value="<?=$data[bbs_ext3]?>"></td>
	  </tr>
	<tr>
	  <td width="120" align="center" bgcolor="#F0F0F4"><strong>�߰�����4</strong></td>
	  <td><input name="bbs_ext4" type="text" class="input" value="<?=$data[bbs_ext4]?>"></td>
	  </tr>
	<tr>
	  <td width="120" align="center" bgcolor="#F0F0F4"><strong>�߰�����5</strong></td>
	  <td><input name="bbs_ext5" type="text" class="input" value="<?=$data[bbs_ext5]?>"></td>
	  </tr>
</table>
<? if($mode=='modify') { ?>
<table border="1" cellpadding="3" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1">
	<tr>
		<td width="120" align="center" bgcolor="#F0F0F4"><strong>�����</strong></td>
		<td><?=rg_date($data['reg_date'])?></td>
	</tr>
</table>
<? } ?>	
<br />
<table width="600" border="0" align="center">
	<tr>
		<td align="center">
			<input type="submit" value="���/����" class="button">
			<input type="button" value=" ��   �� " onClick="history.back();" class="button">
		</td>
	</tr>
</table>
</form>
<? include("admin.footer.php"); ?>
<? include("_footer.php"); ?>