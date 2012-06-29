<?
$bd_content=strip_tags($bd_content);
$bd_content = ereg_replace("&nbsp;","",$bd_content);

?>
	<div style="margin:2px 0 2px 0; border-bottom:1px solid #DDDDDD;">
		<div class="green_cnt"><span class="tt4">Á¶È¸</span><br><?=($bd_secret)?"?":$bd_view_count;?></div>

		<div style="float:left;margin-left:0;color:#ADADAD;line-height:120%;">
			<div style="padding:4px 2px;">
				<a href="<?=$view_url?>" class="green_dot"><?=$bd_subject?></a> <?=$i_new?>
				<br><?=$bd_name?> <?=$i_comment_count?> (<?=$bd_write_date?>)
			</div>
		</div>

	<?
		if(is_array($bd_files) && (count($bd_files) > 0)) {
		$img_view_url=$_url[bbs]."down.php?bbs_code=$bbs_code&bd_num=$bd_num&key=0&mode=view_resize";
	?>
		<div class="green_img"><a href="<?=$view_url?>"><img src="<?=$img_view_url?>" width="<?=$_skin_thumb_image_width?>" height="<?=$_skin_thumb_image_height?>" border="0" title="<?=$bd_subject?>"><a></div>
	<? } ?>

		<div style="clear:both;"></div>
	</div>