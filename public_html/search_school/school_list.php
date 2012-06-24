<?
include_once ("../include/lib.php");

$rs_list = new $rs_class($dbcon);
$rs_list -> clear();
$rs_list -> set_table($_table['school']);

/***********************************************************************/
// 필터 조건에 의한 필터링

if ($ss[1]) { $rs_list -> add_where("national = $ss[1]");
}
if ($area) { $rs_list -> add_where("area = $area");
}
// 검색어로 검색
if ($kw) { $rs_list -> add_where("title LIKE '%$kw%' escape '" . $dbcon -> escape_ch . "'");
}

switch ($ot) {
	case 10 :
		$rs_list -> add_order("num DESC");
		break;
	default :
		$rs_list -> add_order("num DESC");
		break;
}

$page_info = $rs_list -> select_list($page, 20, 10);
foreach ($ss as &$value) {
    echo $value ;
}
foreach ($_const as &$value) {
    foreach ($value as &$dddd) {
    echo $dddd ;
}
}

$MENU_L = 'm5';
?>

<table border="0" cellpadding="0" cellspacing="0" width="800" align=center bgcolor="#FFFFFF">
	<tr>
		<td>
		<table width="770" border="0" cellspacing="0" cellpadding="0" align="center">
			<form name="search_form" method="get" enctype="multipart/form-data">
				<tr>
					<td background="images/search_bg_middle.gif" style="padding:0pt 0pt 0pt 15pt" class="tt4">국가
					<select name="ss[1]" onChange="search_form.submit()" class="select">
						<option value="">=전체=</option>
						<?=rg_html_option($_const['national'],"$ss[1]")
						?>
					</select>&nbsp;&nbsp;&nbsp;지역
					<select name="area" onChange="search_form.submit()" class="select2">
						<option value="">=전체=</option>
						<?
						if ($ss[1] == 1) {
							$_const['area'] = $_const['area1'];
						} elseif ($ss[1] == 2) {
							$_const['area'] = $_const['area2'];
						} elseif ($ss[1] == 3) {
							$_const['area'] = $_const['area3'];
						} elseif ($ss[1] == 4) {
							$_const['area'] = $_const['area4'];
						} elseif ($ss[1] == 5) {
							$_const['area'] = $_const['area5'];
						} elseif ($ss[1] == 6) {
							$_const['area'] = $_const['area6'];
						} elseif ($ss[1] == 7) {
							$_const['area'] = $_const['area7'];
						} elseif ($ss[1] == 8) {
							$_const['area'] = $_const['area8'];
						}
						?>
						<?=rg_html_option($_const['area'],"$area")
						?>
					</select>&nbsp;&nbsp;&nbsp;학교이름
					<input name="kw" type="text" id="kw" value="<?=$kw?>" size="30" class="cc">
					&nbsp;&nbsp;&nbsp;
					<INPUT onfocus=this.blur() type=image src="images/bt_order_search.gif" align="absmiddle">
					&nbsp;&nbsp;&nbsp;<a href="school_edit.php?<?=$p_str?>&page=<?=$page?>&mode=new"><img src=images/school_regi.gif border="0" align="absmiddle"></a></td>
				</tr>
				<tr>
					<td><img src="images/search_bg_bottom.gif" width="770" height="16"></td>
				</tr>
			</form>
		</table>
		<br>
		<table width="770" border="0" cellpadding="0" cellspacing="0" align=center>
			<tr bgcolor="#456285" height="25">
				<td width="30" align="center" class="tt6">NO</td>
				<td width="80" align="center" class="tt6">국가</td>
				<td width="70" align="center" class="tt6">지역</td>
				<td width="250" align="center" class="tt6">학교이름</td>
			<tr>
				<td bgcolor="#BECCDD" height="1" colspan="9"></td>
			</tr>
			<?
if($rs_list->num_rows()<1) {
echo "
<tr height=\"100\"  bgcolor=\"#FFFFFF\" >
<td align=\"center\" colspan=\"9\"><B>등록(검색) 된 자료가 없습니다.</td>
</tr>";
}

$rs_list->set_table($_table['school']);

$no = $page_info['start_no'];
while($R=$rs_list->fetch()) {
$no--;

if($R[national]==1) {
$_const['area'] = $_const['area1'];
}elseif($R[national]==2) {
$_const['area'] = $_const['area2'];
}elseif($R[national]==3) {
$_const['area'] = $_const['area3'];
}elseif($R[national]==4) {
$_const['area'] = $_const['area4'];
}elseif($R[national]==5) {
$_const['area'] = $_const['area5'];
}elseif($R[national]==6) {
$_const['area'] = $_const['area6'];
}elseif($R[national]==7) {
$_const['area'] = $_const['area7'];
}elseif($R[national]==8) {
$_const['area'] = $_const['area8'];
}

			?>
			<tr bgcolor="#FFFFFF" height="25">
				<td align="center" class="tt5"><?=$no
				?></td>
				<td align="center" class="tt5"><?=$_const['area'][$R[area]]
				?></td>
				<td class="tt5">&nbsp;&nbsp;<?=$R[title]
				?></td>
			</tr>
			<tr>
				<td bgcolor="#BECCDD" height="1" colspan="9"></td>
			</tr>
			<?
			}
			?>
		</table></td>
	</tr>
</table>