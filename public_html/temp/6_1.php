<?header("Location:../board/list_new.php?bbs_code=jw_notice")?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<body>
<div><? include_once('./top.php'); ?></div>
<div style="height:52px"></div>
<table width="980" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="223" valign="top"><embed src="../n_img/left_06.swf" width="223" height="400"></embed></td>
    <td width="37">&nbsp;</td>
    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><img src="../n_img/6_1.jpg" width="720" height="250" /></td>
      </tr>
      <tr>
        <td><? include_once('../board/list.php?bbs_code=jw_notice'); ?></td>
      </tr>
    </table></td>
  </tr>
</table>
<div><? include_once('./footer.php'); ?></div>
</body>
</html>
