<?
    $PageNum = 1;
    $subPageNum  = 2;	
	$subtitle = "12" ;

	include_once("../include/lib.php");
 
    $rs_list = new $rs_class($dbcon);
	$rs_list->clear();
	$rs_list->set_table($_table['ju_school']);
    $rs_list->add_where("section = 2"); 	
    include_once('../junior/sub_header.php'); 

?>
<table width="668" border="0" align="center" cellpadding="0" cellspacing="0" >
  <tr>
    <td><img src="./img/fa_study.jpg"/></td>
  </tr>
 <tr>
  <td height="15" ></td>
  </tr>
  <tr>
    <td ><img src="./img/list_tab_top11.jpg"/></td>
  </tr>
  <tr>
    <td background="./img/list_tab_bg.gif">
     <table width="630" border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#d1d1d1">
		<tr >
	      <td colspan="6" bgcolor="#FFFFFF"><img src="./img/list_title2.gif"></td>
		</tr>  
       <tr>
         <td height="15" colspan="6" bgcolor="#FFFFFF"></td>
        </tr>
<?

 $rs_list->set_table($_table['ju_school']);
		
	$no = $page_info['start_no'];
	while($R=$rs_list->fetch()) {
		$no--; 


	if ($R[national]=="1") {
     $ss_list = $_const['area1']; // ������������
    }elseif($R[national]=="2") {
     $ss_list = $_const['area2']; // ȣ������
	}elseif($R[national]=="3") {
     $ss_list = $_const['area3']; //�ʸ�������
    }elseif($R[national]=="4") {
     $ss_list = $_const['area4']; // ��������
    }

?>
        <tr bgcolor="#FFFFFF" height="35"> 
	      <td width="50" align="center"><?=$_const['national'][$R[national]]?></td>
	      <td width="66" align="center" ><?=$ss_list[$R['area']]?></td>
	      <td width="370"><?=$R[title]?></td> 
	      <td width="72" align="center"><a href="#" onclick="window_open('../junior/ju_school_view.php?&num=<?=$R[num]?>&section=2','online','scrollbars=yes,width=740,height=750');"><img src="./img/btn_view.gif" border="0"></a></td> 
	      <td width="72" align="center"><a href="#" onclick="window_open('../junior/online.php?&num=<?=$R[num]?>','online','scrollbars=no,width=450,height=500');"><img src="./img/btn_regi.gif" border="0"></a></td> 
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