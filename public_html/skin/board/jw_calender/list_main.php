<?
if($data[$s]['bd_ext5']==$book)	{//일정이 있다면..
		//글제목과 링크처리
		if($_list_cfg['subject_limit']!='')  $bd_subject=rg_cut_string($data[$s]['bd_subject'],$_list_cfg['subject_limit']);
		else $bd_subject=$bd_subject=$data[$s]['bd_subject'];

		$bd_num=$data[$s]['bd_num'];
		$view_url="view_new.php?$_get_param[3]&bd_num=$bd_num&year=$year&month=$month";
	
		// 카테고리명
		$cat_num=$data[$s]['cat_num'];
		if($cat_num!='') $cat_name=$_category_name_array[$cat_num];	
		if($_bbs_info['use_category'] && $cat_name!='') $bd_subject ="[".$cat_name."]".$bd_subject;

		//비밀글, 삭제글, 응답글, 공지글 처리
		$bd_secret=$data[$s]['bd_secret'];
		$bd_delete=$data[$s]['bd_delete'];
		$bd_depth=$data[$s]['bd_depth'];
		$bd_notice=$data[$s]['bd_notice'];
		if($bd_secret>0 || $bd_delete>0 || $bd_depth>0 || $bd_notice>0) {
		if($bd_secret>0) $bd_subject ="<img src=\"{$skin_url}images/secret.gif\" border=\"0\"> ".$bd_subject;
		if($bd_delete>0) $bd_subject ="삭제된 글입니다.";
		if($bd_depth>0) $bd_subject ="&nbsp;&nbsp;<img src=\"{$skin_url}images/re.gif\" border=\"0\"> ".$bd_subject;
		if($bd_notice>0) $bd_subject ="<img src=\"{$skin_url}images/noti.gif\" border=\"0\"> <b>".$bd_subject."</b>";
		} else $bd_subject ="<img src={$skin_url}images/dot.gif border=0 align=absmiddle>".$bd_subject;

		//코멘트 수
		$bd_comment_count=$data[$s]['bd_comment_count'];
		if($bd_comment_count>0) $bd_subject .=" <span style=\"padding:0px 2px 0px 2px;background:#4ea1bf;color:#FFFFFF;font-family:tahoma;font-size:8px;font-weight:bold;\">".$bd_comment_count."</span> ";

		//new 처리
		$bd_write_date=$data[$s]['bd_write_date'];
		if(time() < ($bd_write_date+60*60*$_list_cfg['new_time']))
		$bd_subject .=" <img src=\"{$skin_url}images/new.gif\" border=\"0\">";
?>
			<tr><td colspan="2">
				<? if($_bbs_auth['cart']) { ?>
				<input type="checkbox" name="chk_nums[]" value="<?=$bd_num?>" class="none">
				<? } ?>
				<a href="<?=$view_url?>" title="<?=strip_tags($data[$s]['bd_content'])?>"><?=$bd_subject?></a>  
			</td></tr>
		<?}
?>