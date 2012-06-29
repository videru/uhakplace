<?
/* =====================================================

  최종수정일 : 
 ===================================================== */
 	set_time_limit(0);
	include_once("../include/lib.php");
	require_once("admin_chk.php");
	if(DB_TYPE=='cubrid') {
		include_once("schema/cubrid_schema.inc.php");
	} else if(DB_TYPE=='mysql') {
		include_once("schema/mysql_schema.inc.php");
	} else if(DB_TYPE=='oracle') {
		include_once("schema/oracle_schema.inc.php");
	}
	$exist_zip_table=$dbcon->list_tables($_table['zip']);
	$MENU_L='m5';

	if($act) {
		$data_a = file($_path['data']."zipcode.csv");
		if(!$data_a) {
			rg_href('',"우편번호데이타를 찾을수 없습니다.\n파일 : {$_path['data']}zipcode.csv",'back');
		}
		$total = count($data_a);
?>
<? include("_header.php"); ?>
<? include("admin.header.php"); ?>
<table border="0" cellspacing="0" cellpadding="0" width="100%" class="site_content">
  <tr> 
    <td height="30" align="center" valign="middle" bgcolor="#f7f7f7">우편번호테이블과 
      데이타를 생성중입니다.</td>
  </tr>
</table>
<table width="70%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr> 
	<td valign="middle">
	총 <?=$total?> 건 입력중입니다.
		<div id="d_progress_bar"></div>
		<div id="d_progress"></div>
	</td>
</tr>
</table>
<br>
<? include("admin.footer.php"); ?>
<? include("_footer.php"); ?>
<script>
var p_obj_bar=document.all["d_progress_bar"];
var p_obj=document.all["d_progress"];
</script>
<?
		if($exist_zip_table) {
			$dbcon->query("DROP TABLE {$_table['zip']}");
		}
		// 테이블 생성
		$dbcon->query("CREATE TABLE {$_table['zip']} {$db_schema['zip']}");
		
		if(RG_DBTYPE==RG_DB_CUBRID) {
			if(is_array($db_schema_index['zip'])) {
				foreach($db_schema_index['zip'] as $v1) {
					$dbcon->query("CREATE INDEX {$v1}_idx on {$_table['zip']} ({$v1})");
				}
			}
		}

		$rs->clear();
		$rs->set_table($_table['zip']);

		foreach($data_a as $data) {
			$data = trim($data);
			if($data) {
				$tmp=explode(",",$data);
				if($tmp[5]=='SEQ') continue;
				$rs->clear_field();
				$rs->add_field("seq","$tmp[5]");
				$rs->add_field("zipcode","$tmp[0]");
				$rs->add_field("sido","$tmp[1]");
				$rs->add_field("gugun","$tmp[2]");
				$rs->add_field("dong","$tmp[3]");
				$rs->add_field("bunji","$tmp[4]");
				$rs->insert();
				$i++;
				if(($i % 1000) == 0) {
					$rs->commit();
					$j=round($i/$total*50);
					$progress_bar=str_repeat('■',$j);
					$progress_bar.=str_repeat('□',50-$j);
?>
<script>p_obj_bar.innerHTML='<?=$progress_bar?>';</script>
<script>p_obj.innerHTML='<?=$i?> 건을 입력하였습니다.';</script>
<?
					flush();
				}
			}
		}
		$progress_bar=str_repeat('■',50);
		$rs->commit();
?>
<script>
bb='우편번호테이블 생성완료<br>';
bb=bb+'<?=$i?> 건 입력 완료 하였습니다.<br>';
bb=bb+'우편번호 테이블과 데이타를 정상적으로 생성하였습니다.	<br>';
p_obj_bar.innerHTML='<?=$progress_bar?>';
p_obj.innerHTML=bb;
</script>
<?
		flush();
?>
<?
	} else {
?>
<? include("_header.php"); ?>
<? include("admin.header.php"); ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td align="center"><form action="" method="post" enctype="multipart/form-data" name="bbs_edit" id="bbs_edit">
<input name="act" type="hidden" value="ok">
        <br>
          <table border="0" cellspacing="0" cellpadding="0" width="70%" class="site_content">
          <tr> 
            <td height="30" align="center" valign="middle" bgcolor="f7f7f7">우편번호테이블과 
              데이타를 생성합니다<br>
<? if($exist_zip_table) { ?>
              (이미 우편번호 테이블이 있습니다. 삭제하고 다시 생성 합니다.)
<? } ?></td>
          </tr>
        </table>
        <br>
        <input name="submit" type="submit" style="font-style:normal; font-size:12px; color:white; line-height:16px; background-color:#404040; border-width:1px; border-color:rgb(221,221,221); border-style:solid;" value=" 확     인 ">
        </p>
</form></td>
  </tr>
</table>
<? include("admin.footer.php"); ?>
<? include("_footer.php"); ?>
<?
	}
?>