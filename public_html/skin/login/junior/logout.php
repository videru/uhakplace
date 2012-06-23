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

<table width="162" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><img src="<?=$skin_url?>images/login_tit.gif" width="162" height="38" /></td>
  </tr>
  <tr>
    <td background="<?=$skin_url?>images/login_tbg.gif"><table width="130" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="24" valign="top"><?=$_mb[mb_name]?><?if($mb_level < '6'){?>님 환영합니다.<?}?></td>
      </tr>
      <tr>
        <td height="35" valign="top">ID:<a href="<?=$level_link?>" target="<?=$lo_target?>"><?=$mb_id?></span></a></td>
      </tr>
      <tr>
        <td><img src="<?=$skin_url?>images/btn_out.gif" width="58" height="20"  onClick="location.href='<?=$logout_url?>'"  style="cursor:hand;"/> <img src="<?=$skin_url?>images/btn_modi.gif" width="58" height="20" onClick="location.href='<?=$modify_url?>'" style="cursor:hand;"/></td>
      </tr>
      <tr>
        <td height="20" align="center">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  
  <tr>
    <td><img src="<?=$skin_url?>images/login_bot.gif" width="162" height="19" /></td>
  </tr>
</table>