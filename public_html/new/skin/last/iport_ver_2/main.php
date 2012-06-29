<?
	if( $col_count % $cols_count == 0)
	{	
		echo "<div class=\"iport_ver_2_content2\">";
	}
	else
	{
		echo "<div class=\"iport_ver_2_content1\">";
	}	
	$col_count++;
?>
<?
	if(is_array($bd_files) && (count($bd_files) > 0)) {
	$img_view_url=$_url[bbs]."down.php?bbs_code=$bbs_code&bd_num=$bd_num&key=0&mode=view_resize";
?>
	<div class="iport_ver_2_div_content">
		<a href="<?=$view_url?>"><img src="<?=$img_view_url?>" width="<?=$_skin_thumb_image_width?>" height="<?=$_skin_thumb_image_height?>" border="0" alt="<?=$bd_subject?>"/></a>
		<div align="center">
		<a href="<?=$view_url?>"><?=$bd_subject?></a> <?=$i_comment_count?>	
	</div>
	</div>

</div>
<?
}
?>	