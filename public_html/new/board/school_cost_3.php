<?
	include_once("../include/lib.php");
	
	
//	if(!$_mb)
//		rg_href($_url['member'].'login.php','회원가입이 필요한 서비스입니다.');

?>
<? include("./sub_view_header.php"); ?>

<table width="692" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="228"><iframe src="./school_cost.php" width="228" height="650" border="0" frameborder="no" scrolling="no" marginwidth="0"></td>
     <td >&nbsp;</td>
    <td width="228">		</td>
     <td >&nbsp;</td>
    <td width="228">		</td>
  </tr>
</table>
<? include("./sub_view_footer.php"); ?>
<script type="text/javascript">
 function cost()
 {
  window.open('../phil/school_cost.php?&num=<?=$num?>', 'window' ,'toolbar=no,width=430,height=600,fullscreen=no,directories=no,status=no,scrollbars=yes,resize=no,menubar=no,location=no');
 }   
</script>