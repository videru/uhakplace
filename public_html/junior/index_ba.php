<?
	include_once("../include/lib.php");
    include_once('_header.php'); 
?>

<table width="930" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td><script>m_menu("./fla/main2.swf","930","472")</script></td>
  </tr>
  <tr>
    <td>
<table width="930" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><img src="./img/main_list_table_to.gif" width="930" height="11" /></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF"><table width="890" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="253" valign="top"><table width="88%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><a href="../board/list.php?bbs_code=ju_notice"><img src="./img/main_notice_tit.gif" width="253" height="32" border="0"/></a></td>
          </tr>
          <tr>
            <td valign="top" class="tt4"><?=rg_lastest('ju_notice','ju_notice',5,32,'..','',$order='bd_next_num desc')?></td>
          </tr>
        </table></td>
        <td width="40" align="center"><img src="./img/main_list_line.gif" width="13" height="117" /></td>
        <td width="597"><img src="./img/main_list_img.jpg" width="597" height="120" usemap="#main_board"  border="0"/></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><img src="./img/main_list_table_bo.gif" width="930" height="11" /></td>
  </tr>
</table>
	</td>
  </tr>
  <tr>
    <td height="30"></td>
  </tr>
  <tr>
    <td align="center"><img src="./img/copyright.gif"></td>
  </tr>
</table>

<map name="main_board">
<area shape="rect" coords="98,20,191,63" href="../board/list.php?bbs_code=ju_photo" />
<area shape="rect" coords="256,19,358,64" href="../board/list.php?bbs_code=ju_story" />
</map>