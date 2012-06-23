<div class="contentdiv">
<?
	if(is_array($bd_files) && (count($bd_files) > 0)) {
	$img_view_url=$_url[bbs]."down.php?bbs_code=$bbs_code&bd_num=$bd_num&key=0&mode=view_resize";
?><a href="<?=$view_url?>"><img src="<?=$img_view_url?>" width="66" height="44" border="0" alt="<?=$bd_subject?>"/></a>
		<a href="<?=$view_url?>"><b><?=$bd_subject?></b></a><?=$i_comment_count?> <?=$i_new?> | 
	</div>
	<?
}
?>	