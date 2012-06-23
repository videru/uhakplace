<?
	$start_time=explode(" ", microtime()); 
	include_once("../include/lib.php");
	include_once('_header.php');

	$body_limit = "5";//보여줄 갯수
	$skey = trim($skey);
	$skey = preg_replace(
						array('/\//','/\[/','/\]/','/\(/','/\)/','(====FIELD_NAME====)'),
						array(' ',' ',' ',' ',' ',' '),$skey);
	$skey = str_replace('  ',' ',$skey);
	$c=($validate->number_only($c))?$c:'';
?>
<style type="text/css">
	A.search:link, A.search:visited, A.search:active {color:#347dc9;font-size:10pt;text-decoration:underline}
	A.search:hover {font-weight:bold;letter-spacing:-1;}
	A.u:link, A.u:visited, A.u:active {color:#333;}
	A.u:hover { text-decoration:underline}
</style>
<table align="center">
  <form name="site_search" method="get" action="?">
  <tr>
    <td align="right">
      <select name="c">
      <option value="">전체 게시판에서</option>
      <option value="">----------------</option>
<?
	$rs->clear();
	$rs->set_table($_table['bbs_cfg']);
	$rs->add_order("bbs_db_num"); 

	while($row_t = $rs->fetch()){
?>
	<option value="<?=$row_t['bbs_num']?>" <? if($c==$row_t['bbs_num']) echo 'selected'; ?>><?=$row_t['bbs_name']?></option>
<?
	}
?>
      </select>
    </td>
    <td width="200">
      <input type="text" name="skey" size="12" value="<?=rg_html_entity($skey)?>" class="button" style="width:200px;ime-mode:active;" autocomplete="off">
    </td>
    <td align="left">
      <input onFocus="this.blur()" type="image" src="../images/btn_schL.gif" onMouseOver="this.src='../images/btn_schH.gif'" onMouseOut="this.src='../images/btn_schL.gif'"  onmousedown="this.src='../images/btn_schD.gif'" align="absmiddle">
    </td>
  </tr>
  </form>
</table>
<br>
<?
	// 검색어체크 검색어는 AND 조건을 기본으로 검색
	$skeys=explode(' ',$skey); // 공백을 단어 하나로 체크
	$skeys=array_unique($skeys);
	$preg_source=array();
	$preg_target=array();
	if($skey!='') {
		$skey_finds=array();
		foreach($skeys as $kw) {
			$preg_source[]='/'.$kw.'/';
			$preg_target[]="<span style='color:#FF001E; background-color:#FFF000;'>".$kw.'</span>';
			$kw=$dbcon->escape_string($kw,DB_LIKE);
			$skey_finds[]="(====FIELD_NAME====) like '%$kw%' escape '".$dbcon->escape_ch."'";
		}
		unset($kw);
		
		$board_fields=array('bd_subject','bd_content','bd_name');
		$comment_fields=array('bc_content','bc_name');
		
		$board_finds=array();
		foreach($board_fields as $field_name) {
			$tmp=array();
			foreach($skey_finds as $skey_find) {
				$tmp[]=str_replace('(====FIELD_NAME====)',$field_name,$skey_find);
			}
			$board_finds[]="(".implode(" AND ",$tmp).")";
			unset($tmp);
		}
		$board_where="(".implode(" OR ",$board_finds).")"; // 최종쿼리문
		unset($board_finds);
		
		$comment_finds=array();
		foreach($comment_fields as $field_name) {
			$tmp=array();
			foreach($skey_finds as $skey_find) {
				$tmp[]=str_replace('(====FIELD_NAME====)',$field_name,$skey_find);
			}
			$comment_finds[]="(".implode(" AND ",$tmp).")";
			unset($tmp);
		}
		$comment_where="(".implode(" OR ",$comment_finds).")"; // 최종쿼리문
		unset($comment_finds);
//		echo $board_where;
//		echo "<br>\n";
//		echo $comment_where;
?>
<table width="100%" cellspacing="0" cellpadding="0" border="0">
<?
		ob_start();
		//게시물 쿼리
		$rsb = new $rs_class($dbcon);
		$rsb->clear();
		$rsb->set_table($_table['bbs_body']);
		
		//코멘트 쿼리
		$rsc = new $rs_class($dbcon);
		$rsc->clear();
		$rsc->set_table($_table['bbs_comment']);
		
		if($validate->number_only($c)) {
			$rs->add_where("bbs_num=".$c);
		}
		
		$rs->select(true);
		while($row_t = $rs->fetch()){
			$rsb->clear();
			$rsb->add_field('count(*)');
			$rsb->add_where("bbs_db_num=$row_t[bbs_db_num]");
			$rsb->add_where($board_where);
			$rsb->fetch('body_num');
			$body_num_t += $body_num;
			
			$rsc->clear();
			$rsc->add_field('count(*)');
			$rsc->add_where("bbs_db_num=$row_t[bbs_db_num]");
			$rsc->add_where($comment_where);
			$rsc->fetch('cmt_num');
			$cmt_num_t += $cmt_num;
		
			//전체 검색건수
			$total = $body_num+$cmt_num;
			$total_t = $body_num_t+$cmt_num_t;
	
			$c_name = $row_t[bbs_name];
?>
<tr>
<td><a href="<?=$_url[bbs]?>list.php?bbs_code=<?=$row_t[bbs_code]?>" class='search'><?=$row_t[bbs_name]?></a>
  [<?=$total?>] <i><b><?=$body_num?></b>post <b> <?=$cmt_num?></b>comment</i>
</td>
</tr>
<tr>
<td height=3>
</td>
</tr>
<?
			if($total>0){
				if($body_num>0) { // 검색된 게시물이 있으면
					$rsb->clear_field();
					$rsb->add_order("bd_num"); 
					$rsb->set_limit($body_limit);
					$rsb->select(true);
					while($row=$rsb->fetch()){
						if($row[bd_secret] == "1") 
							$row[bd_content] = "비밀글로 보호됩니다.";
						else
							$row[bd_content] = rg_get_text(rg_cut_string($row[bd_content],400));
						$row[bd_write_date] = "<span style=color:#69A80F;font-size:7pt;>".date("Y-n-j",$row[bd_write_date])."</span>";
						$bbs_url="{$_url['bbs']}view.php?&bbs_code={$row_t['bbs_code']}&bd_num={$row['bd_num']}";
?>
<tr>
<td style='color:#e4e4e4;padding-left:10px;'><a href="<?=$bbs_url?>" class=u><?=preg_replace($preg_source,$preg_target,$row[bd_subject])?></a> | <?=$row[bd_write_date]?> <a href="<?=$bbs_url?>" target=_blank class='u'><span style='color:#cccccc;'>[새창으로  보기]</span></a></td>
</tr>
<tr>
<td height=2></td>
</tr>
<tr>
<td style='color:#999999;padding-left:20px;'><?=preg_replace($preg_source,$preg_target,$row[bd_content])?></td>
</tr>
<tr>
<td height=5></td>
</tr>
<tr>
<td height=10></td>
</tr>
<?
					}
				} // if end $body_num
					
				if($cmt_num>0) { // 검색된 게시물이 있으면
					$rsc->clear_field();
					$rsc->add_order("bc_num"); 
					$rsc->set_limit($body_limit);
					$rsc->select(true);
					while($row=$rsc->fetch()){
						$row[bc_content] = rg_cut_string(rg_get_text($row[bc_content]),270);
						$row[bc_write_date] = "<span style=color:#69A80F;font-size:7pt;>".date("Y-n-j",$row[bc_write_date])."</span>";
						$bbs_url="{$_url['bbs']}view.php?&bbs_code={$row_t['bbs_code']}&bd_num={$row['bd_num']}";
?>
<tr>
<td style='color:#999999;padding-left:20px;'><img src='../images/comment.png' align='absmiddle'> <a href="<?=$bbs_url?>" class='u' style="color:#999999;"><?=preg_replace($preg_source,$preg_target,$row[bc_content])?></a> | <?=$row[bc_write_date]?> <a href="<?=$bbs_url?>" target=_blank class='u'><span style='color:#cccccc;'>[새창으로  보기]</span></a></td>
</tr>
<tr><td height=5></td>
</tr>
<tr>
<td height=10></td>
</tr>
<?
					}
				} // if end $cmt_num
			} // if end $total
?>
<tr>
<td height=5></td>
</tr>
<tr>
<td align=right style='padding-bottom:5px; border-bottom:1px solid #CCCCCC'><img src='../images/arrow.gif' border='0' align='absmiddle'><a href="<?=$_url[bbs]?>list.php?bbs_code=<?=$row_t[bbs_code]?>&ss%5Bst%5D=1&ss%5Bsc%5D=1&kw=<?=urlencode($_GET[skey])?>" class='u'><u>더 많은 게시물 보기</u></a></td>
</tr>
<tr>
<td height=10></td>
</tr>
<?
		} // while($row_t = $rs->fetch())
		$search_result=ob_get_contents();
		ob_end_clean();
?>
<table width="100%" bgcolor=#EFFAF9 align="center" border="0">
  <tr>
    <td style="padding-left:10px;">
      검색 결과 :
      <?
        if($c != '') {
          echo "<b>".$c_name."</b> 게시판에서 ";
        } else {
          echo "<b>전체 게시판</b>에서 ";
        }
      ?>
      <?=($skey!='')?"<font color='red'><b>'$skey'</b></font>을(를)":"총 게시물, 댓글'</b></font>을"?> <?=($total_t > 0)?"총 <font color='red'><b>$total_t</b></font>개를 찾았습니다.":"찾지 못했습니다."?>
    </td>
  </tr>
</table>
<table width="100%" align="center" border="0">
  <tr>
    <td height=20>
    </td>
  </tr>
  <?=$search_result?>
</table>
<br>
<?
		$end_time = explode(" ", microtime()); 
		$time = ($end_time[1]+$end_time[0])-($start_time[1]+$start_time[0]); 
		$time = substr ("$time", 0, 6); 
		echo "<div style='float:right;'>검색에 <b>".$time."</b>초가 걸렸습니다.</div>" ;
	}
	include_once('_footer.php'); 
?>