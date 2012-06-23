<? if (!defined('RGBOARD_VERSION')) exit; ?>
<?php /*?><?
	if(is_array($bd_files) && (count($bd_files) > 0)) {
		reset($bd_files);
		$v=current($bd_files);
		if($v['name']=='') continue;
		list($is_image)=explode('/',$v['type']);
		if($is_image!='image') continue;
?>
<img src="<?=$v['view_url']?>"><br><br>
<?
	}
?><?php */?>
<?
	if( $col_count % $cols_count == 0) echo "<tr>";
	$col_count++;
?>
<td align="center">
<?
if(is_array($bd_files) && (count($bd_files) > 0)) {
$img_view_url=$_url[bbs]."down.php?bbs_code=$bbs_code&bd_num=$bd_num&key=0&mode=view_resize";
?>
<a href="<?=$view_url?>"><img src="<?=$img_view_url?>" width="<?=$_skin_thumb_image_width?>" height="<?=$_skin_thumb_image_height?>" border="0"><a><br>
<?
}
?>
<br /><a href="<?=$view_url?>"><?=$bd_subject?></a> <?=$i_comment_count?> <?=$i_new?><br /><br />
</td>