<?
	include_once("../include/lib.php");
	
	
//	if(!$_mb)
//		rg_href($_url['member'].'login.php','회원가입이 필요한 서비스입니다.');


		$rs->clear();
		$rs->set_table($_table['young']);
		$rs->add_where("num=$num");
		$rs->select();
		$data=$rs->fetch();		

?>
<? include("./sub_view_header.php"); ?>

<table width="692" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
<table width="692" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="a_sub_title2" background="../img/school_view_title_bg.gif" height="36" ><?=$data['s_title']?> (<?=$data['title']?>)</td>
  </tr>
</table>	
	</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
	<table width="692" border="0" cellpadding="1" cellspacing="1" bgcolor="#cccccc">
      <tr>
        <td bgcolor="#f0f0f0" height="45">	
	<table width="670" border="0" cellpadding="0" cellspacing="0" align="center">
      <tr>
        <td width="120"><img src="../img/icon/nate_icon.gif" align="absmiddle" />&nbsp;02-555-5555</td>
        <td>&nbsp;</td>
        <td width="200"><img src="../img/icon/nate_icon.gif" align="absmiddle" />&nbsp;ppapple777@nate.com&nbsp;<img src="../img/icon/msn_icon.gif" align="absmiddle" />&nbsp;uhakplace_jp@hotmail.com</td>
        <td width="30">&nbsp;</td>
        <td align="right" width="76"  >&nbsp;</td>
        <td>&nbsp;</td>
        <td align="right" width="76" ><a href="#" onClick="cost();" align="absmiddle"><img src="../img/btn_or_cost.gif" border="0"/></a></td>
        <td>&nbsp;</td>
        <td align="right" width="76" ><img src="../img/btn_or_online.gif" /></td>
        <td>&nbsp;</td>
        <td align="right" width="76" ><img src="../img/btn_or_list.gif" /></td>
      </tr>
    </table>	
        </td>	
		</tr>
		</table>	
	</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><?=$data['info']?></td>
  </tr>

  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
	<table width="692" border="0" cellpadding="1" cellspacing="1" bgcolor="#cccccc">
      <tr>
        <td bgcolor="#f0f0f0" height="45">	
	<table width="670" border="0" cellpadding="0" cellspacing="0" align="center">
      <tr>
        <td width="120"><img src="../img/icon/nate_icon.gif" align="absmiddle" />&nbsp;02-555-5555</td>
        <td>&nbsp;</td>
        <td width="200"><img src="../img/icon/nate_icon.gif" align="absmiddle" />&nbsp;ppapple777@nate.com&nbsp;<img src="../img/icon/msn_icon.gif" align="absmiddle" />&nbsp;uhakplace_jp@hotmail.com</td>
        <td width="30">&nbsp;</td>
        <td align="right" width="76"  >&nbsp;</td>
        <td>&nbsp;</td>
        <td align="right" width="76" ><img src="../img/btn_or_cost.gif" /></td>
        <td>&nbsp;</td>
        <td align="right" width="76" ><img src="../img/btn_or_online.gif" /></td>
        <td>&nbsp;</td>
        <td align="right" width="76" ><img src="../img/btn_or_list.gif" /></td>
      </tr>
    </table>	
        </td>	
		</tr>
		</table>	
	</td>
  </tr>
</table>
<? include("./sub_view_footer.php"); ?>
<script type="text/javascript">
 function cost()
 {
  window.open('../phil/school_cost.php?&num=<?=$num?>', 'window' ,'toolbar=no,width=430,height=600,fullscreen=no,directories=no,status=no,scrollbars=yes,resize=no,menubar=no,location=no');
 }   
</script>