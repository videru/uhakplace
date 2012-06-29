<? if (!defined('RGBOARD_VERSION')) exit; ?>
<?
	/*
	$rs_note = new $rs_class($dbcon);
	$rs_note->clear();
	$rs_note->set_table($_table['note']);
	$rs_note->add_field("count(*) as cnt");
	$rs_note->add_where("mb_num={$_mb['mb_num']}");
	$rs_note->add_where("recv_mb_num={$_mb['mb_num']}");
	$rs_note->add_where("nt_type=2");
	$rs_note->add_where("nt_save=0");
	$tmp=$rs_note->fetch();
	$note_cnt=$tmp['cnt'];
	*/
	if($mb_level>'9') {
	$level_link = "../admin/";
	$lo_target ="_blank";
	}elseif($mb_level == '6' || $mb_level == '7' || $mb_level == '8'){
	$level_link = "../agency/";
	$lo_target ="_self";
	}elseif($mb_level < '6'){
	$level_link = $modify_url;
	$lo_target ="_self";
	}
?>

<table width="170" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><img src="<?=$skin_url?>images/login_top.gif" width="170" height="34" /></td>
  </tr>
  <tr>
    <td background="<?=$skin_url?>images/login_bg.gif"><table width="145" border="0" align="center" cellpadding="0" cellspacing="0">
 	  <tr>
        <td class="tit11"><?=$_mb[mb_name]?><?if($mb_level < '6'){?>님 환영합니다.<?}?></td>
      </tr>    
	  <tr>
        <td class="tit11">ID:<?=$mb_id?> (<a href="<?=$level_link?>" target="<?=$lo_target?>"><span class="tit11"><?=$mb_level_name?></span></a>)</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td background="<?=$skin_url?>images/login_bg.gif" ><img src="<?=$skin_url?>images/login_line.gif" width="170" height="24" /></td>
  </tr>
  <tr>
    <td background="<?=$skin_url?>images/login_bg.gif"><table width="135" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="62"><img src="<?=$skin_url?>images/btn_out.gif" width="62" height="19"  onClick="location.href='<?=$logout_url?>'"  style="cursor:hand;"/></td>
        <td width="11">&nbsp;</td>
        <td width="62"><img src="<?=$skin_url?>images/btn_modi.gif" width="62" height="19" onClick="location.href='<?=$modify_url?>'" style="cursor:hand;"/></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><img src="<?=$skin_url?>images/login_bottom.gif" width="170" height="15" /></td>
  </tr>
</table>