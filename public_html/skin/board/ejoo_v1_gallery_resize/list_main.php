<? if (!defined('RGBOARD_VERSION')) exit; ?>
<?
	if($g_no % 4 == 0) {
		echo "<tr>";
	}
	$g_no++;
?>
<td width="25%" valign="top">
  <table style="table-layout:fixed">
    <tr>
      <td align="center" bgcolor="#FFFFFF" background="<?=$img_view_url?>">
<?
if(is_array($bd_files) && (count($bd_files) > 0)) {
$img_view_url=$_url[bbs]."down.php?$_get_param[3]&bd_num=$bd_num&key=0&mode=view_resize";
?>
<br>
<?
}
?>
      </td>
    </tr>
    <tr>
      <td align="center">
<? if($_bbs_auth['cart']) { ?>
<input type=checkbox name="chk_nums[]" value="<?=$bd_num?>" class=none>
<? } ?>
<? if($_bbs_info['use_category']) { ?>[<?=$cat_name?>] <? } ?>Á¶È¸¼ö : <?=number_format($bd_view_count)?><br />
<?=$i_reply?> <?=$i_secret?> <a href="<?=$view_url?>"><?=$bd_subject?></a> <?=$i_comment_count?> <?=$i_new?>
      </td>
    </tr>
  </table>