<? if (!defined('RGBOARD_VERSION')) exit; ?>
<?
/* =====================================================
  ���α׷��� : �������� V4
  ȭ�ϸ� : 
  �ۼ��� : 
  �ۼ��� : ������ ( http://rgboard.com )
  �ۼ��� E-Mail : master@rgboard.com

  ���������� : 
 ===================================================== */
 	$site_path=$site_url='../../../';
	include_once($site_path."rg4_include/lib.php");
	include_once($_path['inc']."lib_bbs.php");

	if(file_exists($skin_path.'setup.php')) include($skin_path.'setup.php');
	
	if(!$validate->number_only($bd_num)) {
		rg_href("",'�߸��� �����Դϴ�.','close');
		exit;
	}
	
	$rs->clear();
	$rs->set_table($_table['bbs_body']);
	$rs->add_where("bbs_db_num={$_bbs_info['bbs_db_num']}");
	$rs->add_where("bd_num=$bd_num");
	$data=$rs->fetch();	
	if(!$data) {
		rg_href("",'�߸��� �����Դϴ�.','close');
		exit;
	}

	extract($data);

	if($mode == 'vote') {
		// ��ǥ����
		$tmp=explode(',',$_COOKIE["vote_chk_skin"]);
		if(!in_array("{$_bbs_info['bbs_db_num']}:$bd_num",$tmp)){
			$bd_ext2=unserialize($data[bd_ext2]);
			$bd_ext2[$vote_num]++;
			$bd_ext2=serialize($bd_ext2);
			
			$rs->clear();
			$rs->set_table($_table['bbs_body']);
			$rs->add_field('bd_ext2',$bd_ext2);
			$rs->add_where("bbs_db_num={$_bbs_info['bbs_db_num']}");
			$rs->add_where("bd_num=$bd_num");
			$rs->update();
			array_push($tmp, "{$_bbs_info['bbs_db_num']}:$bd_num");
			$vote_chk_skin = implode(',',$tmp);
			setcookie("vote_chk_skin", $vote_chk_skin, time()+3600*24*30); // �Ѵ�
		}
	
		rg_href("?$p_str&bd_num=$bd_num");
	} else {
		extract($data);
	}
	if(!$is_admin) {
		$bd_email = rg_get_text($bd_email);
		$bd_name = rg_get_text($bd_name);
		$bd_subject = rg_get_text($bd_subject);
	}
	$bd_content = rg_conv_text($bd_content,$bd_html);
?>
<html>
<head>
<title>��ǥ���</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link rel="stylesheet" href="<?=$skin_url?>style.css">
</head>
<body bottommargin="0" topmargin="0" leftmargin="0" rightmargin="0">
<br />
<table border="1" cellpadding="3" cellspacing="0" width="97%" bordercolordark="white" bordercolorlight="#E1E1E1" style="table-layout:fixed" align="center">
	<tr>
		<td width="70" align="center" bgcolor="#F0F0F4"><strong>����</strong></td>
		<td><?=$bd_subject?></td>
  </tr>
  <tr>
		<td align="center" bgcolor="#F0F0F4"><strong>����</strong></td>
		<td style='word-break:break-all'><?=$bd_content?></td>
  </tr>

<?
	$bd_ext1=unserialize($bd_ext1);
	$bd_ext2=unserialize($bd_ext2);
	$bd_ext3=unserialize($bd_ext3);
	$bd_ext4=unserialize($bd_ext4);
	$bd_ext5=unserialize($bd_ext5);
?>
<?
	$vote_total=0;
	$vote_ratio=array();
	$vote_max=0;
	for($i=0;$i<5;$i++) {
		if($bd_ext1[$i]!='') {
			$vote_total+=$bd_ext2[$i];
		}
	}

	for($i=0;$i<5;$i++) {
		if($bd_ext1[$i]!='') {
			if($vote_total==0)
				$vote_ratio[$i]='0.00';
			else
				$vote_ratio[$i]=number_format($bd_ext2[$i]/$vote_total*100,1);
		}
	}

?>
  <tr>
		<td align="center" bgcolor="#F0F0F4"><strong>���</strong></td>
		<td align="center">
 �� ��ǥ�ڼ� : <?=$vote_total?> ��<br />
			<table width="97%"  border="0" cellpadding="0" cellspacing="0" class="s_title">
<?
	for($i=0;$i<5;$i++) {
		if($bd_ext1[$i]!='') {
?>
        <tr>
          <td>
            <?=$bd_ext1[$i]?>
          </td>
          <td width="120">
          <table width="<?=round($vote_ratio[$i])?>%" border="0" cellpadding="0" cellspacing="0" bgcolor="5588B7">
            <tr>
              <td height="5"></td>
            </tr>
          </table></td>
          <td width="100">
            <?=$bd_ext2[$i]?>(<?=$vote_ratio[$i]?>%)<br />
          </td>
        </tr>
<?
		}
	}
?>
		</table>
	</td>
  </tr>
  <tr>
    <td height="40" colspan="2" align="center"><input type="button" onClick="self.close()" value="�ݱ�" class="button"></td>
  </tr>
</table>

</body>
</html>