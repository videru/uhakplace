<?$bd_content=strip_tags($bd_content);

$bd_content = ereg_replace("&nbsp;","",$bd_content);

?>

<tr>
<td width="75"><?
		if(is_array($bd_files) && (count($bd_files) > 0)) {
		$img_view_url=$_url[bbs]."down.php?bbs_code=$bbs_code&bd_num=$bd_num&key=0&mode=view_resize";
	?><a href="<?=$view_url?>"><img src="<?=$img_view_url?>" width="<?=$_skin_thumb_image_width?>" height="<?=$_skin_thumb_image_height?>" border="0" title="<?=$bd_subject?>" ><a>	<? } ?></td>
<td valign="top"><a href="<?=$view_url?>" class="green_dot"><strong><font color="#2d99de"><?=$bd_subject?></font></strong></a> <strong><font color="#ff0000"><?=$i_comment_count?></font></strong><img src="http://uhakplace.co.kr/skin/board/cha_gall_v1/images/new.gif">
				<br><a href="<?=$view_url?>" class="green_dot"><?=rg_cut_string($bd_content,77,"...");?></a></td>
</tr>
<tr><td colspan="2" height="7"></td></tr>
<tr><td colspan="2" height="1" bgcolor="#dddddd"></td></tr>
<tr><td colspan="2" height="7"></td></tr>