<?
    $PageNum = 2;
    $subPageNum  = 2;	

	$subtitle = "21" ;
	include_once("../include/lib.php");
 
    $rs_list = new $rs_class($dbcon);
	$rs_list->clear();
	$rs_list->set_table($_table['camp']);
    $rs_list->add_where("section = 2"); 
	
	include_once('../junior/sub_header.php'); 


?>
<table width="660" border="0" align="center" cellpadding="0" cellspacing="0" >
  <tr>
    <td><img src="./img/fa_camp.jpg"/></td>
  </tr>
  <tr>
    <td ><img src="./img/list_tab_top31.jpg"/></td>
  </tr>
  <tr>
    <td background="./img/list_tab_bg.gif">
     <table width="630" border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#d1d1d1">
		<tr >
	      <td colspan="6" bgcolor="#FFFFFF"><img src="./img/list_title1.gif"></td>
		</tr>  
       <tr>
         <td height="15" colspan="6" bgcolor="#FFFFFF"></td>
        </tr>
<?

 $rs_list->set_table($_table['camp']);
		
	$no = $page_info['start_no'];
	while($R=$rs_list->fetch()) {
		$no--; 


	if ($R[national]=="1") {
     $ss_list = $_const['area1']; // 뉴질랜드지역
    }elseif($R[national]=="2") {
     $ss_list = $_const['area2']; // 호주지역
	}elseif($R[national]=="3") {
     $ss_list = $_const['area3']; //필리핀지역
    }elseif($R[national]=="4") {
     $ss_list = $_const['area4']; // 영국지역
    }

?>
        <tr bgcolor="#FFFFFF" height="35"> 
	      <td width="55" align="center"><?=$_const['national'][$R[national]]?></td>
	      <td width="55" align="center" ><?=$ss_list[$R['area']]?></td>
	      <td width="220" >&nbsp;<?=$R['title']?></td>
	      <td width="140"><?=$R['eng_etc']?></td> 
	      <td width="80" align="center"><a href="#" onclick="window_open('../junior/camp_view.php?&num=<?=$R[num]?>&section=1','online','scrollbars=yes,width=740,height=750');"><img src="./img/btn_view.gif" border="0"></a></td> 
	      <td width="80" align="center"><a href="#" onclick="window_open('../junior/online.php?&num=<?=$R[num]?>','online','scrollbars=no,width=450,height=500');"><img src="./img/btn_regi.gif" border="0"></a></td> 
       </tr>
       <tr>
         <td height="2" colspan="6" bgcolor="#d1d1d1"></td>
        </tr>
<?}?>
   </table>	

	</td>
  </tr>
  <tr>
    <td ><img src="./img/list_tab_bot.gif"/></td>
  </tr>
</table>
<?  include_once('../junior/sub_footer.php'); ?>