<? if (!defined('RGBOARD_VERSION')) exit; ?>
<?
	include($skin_path.'geshi/geshi.php');
  
	$geshi =& new GeSHi('','');
	$geshi->set_header_type(GESHI_HEADER_DIV);
	$geshi->set_tab_width(2);
	$geshi->enable_classes();
	$geshi->enable_line_numbers(GESHI_FANCY_LINE_NUMBERS, 2);
	$geshi->set_overall_style('width:100%;color: #000066; border: 2px solid #F2ECD0; background-color: #FCFCF7;overflow:auto;', true);
	$geshi->set_line_style('background: #FCFCF7;','background: #F5F5F7;');
	$geshi_style=array();
	function view_code($content,$html) {
		global $geshi,$geshi_style;
		$_result = '';
		$pos=0;
		
		while(true) {
			$code_pos=strpos($content,'[code',$pos);
			if($code_pos!==false) {
				$_result .= rg_conv_text(substr($content,$pos,$code_pos-$pos),$html);
				$code_pos_start=$code_pos+5;
				$code_pos_end=strpos($content,'[/code]',$code_pos_start);
				if($code_pos_end===false) $code_pos_end=strlen($content);
				$code_str=substr($content,$code_pos_start,$code_pos_end-$code_pos_start);

				$type_pos=strpos($code_str,']');
				$type_pos1=strpos($code_str,"\n");
				if($type_pos===false || $type_pos > $type_pos1) {
					$_result .= rg_conv_text($code_str,$html);
					$pos=$code_pos_end+7;
				} else {
					$code_type=trim(substr($code_str,0,$type_pos));
					$code_str=substr($code_str,$type_pos+1);

					if($code_type=='') {
						$code_type='php';
					}
					
					$geshi->set_source(trim($code_str));
					$geshi->set_language($code_type);
					if(!$geshi_style[$code_type]) {
						$_result .= "<style type=\"text/css\">\n".
						"<!--\n".
						$geshi->get_stylesheet()."\n".
						"-->\n".
						"</style>\n";
					}
					$geshi_style[$code_type]=true;
					$pos=$code_pos_end+7;
				}
			} else {
				if($is_admin) {
					$_result .= rg_conv_text(substr($content,$pos),$html);
				} else {
					$_result .= rg_conv_text(rg_script_conv('',substr($content,$pos)),$html);
				}
				break;
			}
			if($pos>strlen($content)) break;
		}
		return $_result;
	}
?>
<table width="100%" border="0">
	<tr>
		<td align="left">
<? if($prev_data) { ?>
		<input type="button" value="이전" onClick="location.href='<?=$url_view_prev?>'" class="button">
<? } ?>
<? if($next_data) { ?>
		<input type="button" value="다음" onClick="location.href='<?=$url_view_next?>'" class="button">
<? } ?>
<? if($vcfg['btn_modify']) { ?>	
		<input type="button" value="수정" onClick="location.href='<?=$url_modify?>'" class="button">
<? } ?>
<? if($vcfg['btn_del']) { ?>	
		<input type="button" value="삭제" onClick="location.href='<?=$url_delete?>'" class="button">
<? } ?>
<? if($vcfg['btn_reply']) { ?>	
		<input type="button" value="답변" onClick="location.href='<?=$url_reply?>'" class="button">
<? } ?>
<? if($vcfg['btn_vote_yes']) { ?>	
		<input type="button" value="추천" onClick="location.href='<?=$url_vote_yes?>'" class="button">
<? } ?>
<? if($vcfg['btn_vote_no']) { ?>	
		<input type="button" value="반대" onClick="location.href='<?=$url_vote_no?>'" class="button">
<? } ?>
		</td>
		<td align="right">
<? if($vcfg['btn_list']) { ?>
		<input type="button" value="목록보기" onClick="location.href='<?=$url_list?>'" class="button">
<? } ?>
		</td>
	</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" width="100%" class="default_bbs_content">
	<tr>
		<th width="120">작성자</th>
		<td><?=$bd_name_layer?></td>
	</tr>
	<tr>
		<th width="120">작성일</th>
		<td><?=rg_date($data['bd_write_date'],$vcfg['date_format'])?></td>
	</tr>
<? if($bd_email) { ?>
	<tr>
		<th>이메일</th>
		<td><?=$bd_email?></td>
	</tr>
<? } ?>
<? if($bd_home) { ?>
	<tr>
    <th>홈페이지</th>
	  <td><?=$bd_home?></td>
  </tr>
<? } ?>
<? if($vcfg['use_category']) { ?>
	<tr>
    <th>분류</th>
	  <td><?=$_category_name_array[$cat_num]?></td>
  </tr>
<? } ?>
<? if($vcfg['btn_vote_yes'] || $vcfg['btn_vote_no']) { ?>
	<tr>
    <th>&nbsp;</th>
	  <td><? if($vcfg['btn_vote_yes']) { ?>추천 : <?=$bd_vote_yes?><? } ?>
				<? if($vcfg['btn_vote_yes'] && $vcfg['btn_vote_no']) { ?> / <? } ?>
				<? if($vcfg['btn_vote_no']) { ?>반대 : <?=$bd_vote_no?><? } ?></td>
  </tr>
<? } ?>
	<tr>
		<th>제목</th>
		<td><?=$bd_subject?></td>
	</tr>
	<tr>
		<th>내용</th>
		<td style='word-break:break-all'>
<?
	if($vcfg['view_image']) {
?>
<img id="view_image_width" height="0" width="100%"><br />
<script language="JavaScript" type="text/JavaScript">
if(onload) var set_img_old_onload=onload;
onload=set_img_width_init;
</script>
<?
		foreach($bd_files as $k => $v) {
			if(!rg_file_type_chk($v['type'],'image')) continue;
?>
<img src="<?=$v['view_url']?>" onclick="view_image_popup(this)" style="cursor:hand;" id="view_image"><br><br>
<? 	}
	}
?>	
		<?=view_code($data['bd_content'],$data['bd_html'])?>
    </td>
	</tr>
<?
	if(is_array($bd_links) && (count($bd_links) > 0)) {
?>
	<tr>
    <th>링크</th>
	  <td>
<?
		foreach($bd_links as $k => $v) {
			if($v['url']=='') continue;
			if($v['name']=='') $v['name']=$v['url'];
?>
<a href="<?=$v['link_url']?>" target="_blank"><?=$v['name']?>&nbsp;&nbsp;(<?=number_format($v['hits'])?>)</a><br>
<? 	} ?>
		</td>
  </tr>
<?
	}
?>
<?
	if($vcfg['use_download']) {
?>
	<tr>
    <th>첨부파일</th>
		<td>
<?
		foreach($bd_files as $k => $v) {
			if($v['name']=='') continue;
?>
<a href="<?=$v['down_url']?>"><?=$v['name']?>&nbsp;&nbsp;Down:<?=number_format($v['hits'])?></a><br>
<? 	} ?>
		</td>
	</tr>
<?
	}
?>
<? if($vcfg['view_signature']) { ?>
	<tr>
    <th>서명</th>
		<td>
<?=$mb_signature?>
		</td>
	</tr>
<? } ?>
</table>
<?
	if($vcfg['view_comment']) // 코멘트 표시여부 
		if(file_exists($skin_path."view_comment.php")) include($skin_path."view_comment.php");
?>
<table width="100%" border="0">
	<tr>
		<td align="left">
<? if($prev_data) { ?>
		<input type="button" value="이전" onClick="location.href='<?=$url_view_prev?>'" class="button">
<? } ?>
<? if($next_data) { ?>
		<input type="button" value="다음" onClick="location.href='<?=$url_view_next?>'" class="button">
<? } ?>
<? if($vcfg['btn_modify']) { ?>	
		<input type="button" value="수정" onClick="location.href='<?=$url_modify?>'" class="button">
<? } ?>
<? if($vcfg['btn_del']) { ?>	
		<input type="button" value="삭제" onClick="location.href='<?=$url_delete?>'" class="button">
<? } ?>
<? if($vcfg['btn_reply']) { ?>	
		<input type="button" value="답변" onClick="location.href='<?=$url_reply?>'" class="button">
<? } ?>
<? if($vcfg['vote_yes']) { ?>	
		<input type="button" value="추천" onClick="location.href='<?=$url_vote_yes?>'" class="button">
<? } ?>
<? if($vcfg['vote_no']) { ?>	
		<input type="button" value="반대" onClick="location.href='<?=$url_vote_no?>'" class="button">
<? } ?>
		</td>
		<td align="right">
<? if($vcfg['btn_list']) { ?>
		<input type="button" value="목록보기" onClick="location.href='<?=$url_list?>'" class="button">
<? } ?>
		</td>
	</tr>
</table>
<? if($vcfg['view_list']) { ?>
<br>
<table width="100%" border="0">
	<tr>
		<td>
<? include('list_main_process.php'); ?>
		</td>
	</tr>
</table>
<? } ?>
