<? if (!defined('RGBOARD_VERSION')) exit; ?>
<tr>
<td height="48" ><table width="100%" height="48" cellspacing="2" cellpadding="1" border="0" bgcolor="#d1d1d1">
<tr>
<td width="190" height="48" bgcolor="#FFFFFF"><?
		if(is_array($bd_files) && (count($bd_files) > 0)) {
		$img_view_url=$_url[bbs]."down.php?bbs_code=$bbs_code&bd_num=$bd_num&key=0&mode=view_resize";
	?><a href="<?=$view_url?>"><img src="<?=$img_view_url?>" width="176" height="97" border="0" title="<?=$bd_subject?>"><a><? } ?>
</td>
</tr>
</table></td>
</tr>
<tr><td height="7"></td></tr>
<tr>
<td align="center">
<a href="<?=$view_url?>"><?=$bd_subject?></a> <?=$i_comment_count?> <?=$i_new?><br />
</td></tr>