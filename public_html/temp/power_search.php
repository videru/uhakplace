<?
include_once("../include/lib.php");

if(isset($_REQUEST['site_path']) || isset($_REQUEST['site_url'])) exit;
if(!isset($site_path)) $site_path='../';
if(!isset($site_url)) $site_url='../';
if(!isset($site_path) || preg_match("/:\/\//",$site_path)) $site_path='../';

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title>Untitled Document</title>
<script language="javascript" type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script language="javascript" type="text/javascript" src="../temp/search_school.js?20120716_2"></script>
<style type="text/css">
#stateselect {
	font-size: 12px;
	height: 10px;
	width: 174px;margin-bottom:5px;
}
#cityselect {
	font-size: 12px;
	height: 10px;
	width: 174px;margin-bottom:5px;
}
#schoolselect {
	font-size: 12px;
	height: 10px;
	width: 174px;
	margin-bottom:5px;
}
</style>
</head>

<body onload="MM_preloadImages('../n_img/power_such/btn_6 (2).jpg','../n_img/power_such/btn_2.jpg','../n_img/power_such/btn_4.jpg','../n_img/power_such/btn_7.jpg','../n_img/power_such/btn_9.jpg','../n_img/power_such/btn_11.jpg')"><table width="527" height="338" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="18"><img src="../n_img/power_such/left_bg.jpg" width="18" height="375" /></td>
    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><img src="../n_img/power_such/title_power.jpg" width="491" height="35" /></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><a href="javascript:MM_swapImage('Image7','','../n_img/power_such/btn_7.jpg',1)" onfocus="blur();" ><img src="../n_img/power_such/btn_6.jpg" name="Image7" width="88" height="31" border="0" id="Image7" /></a></td><!--1-->	
            <td><a href="javascript:MM_swapImage('Image6','','../n_img/power_such/btn_6 (2).jpg',2)" onfocus="blur();" ><img src="../n_img/power_such/btn_5.jpg" name="Image6" width="77" height="31" border="0" id="Image6" /></a></td><!--2-->
            <td><a href="javascript:MM_swapImage('Image9','','../n_img/power_such/btn_11.jpg',3)" onfocus="blur();" ><img src="../n_img/power_such/btn_10.jpg" name="Image9" width="88" height="31" border="0" id="Image9" /></a></td><!--3-->	
            <td><a href="javascript:MM_swapImage('Image8','','../n_img/power_such/btn_9.jpg',4)" onfocus="blur();" ><img src="../n_img/power_such/btn_8.jpg" name="Image8" width="77" height="31" border="0" id="Image8" /></a></td><!--4-->	
            <td><a href="javascript:MM_swapImage('Image5','','../n_img/power_such/btn_4.jpg',5)" onfocus="blur();"  ><img src="../n_img/power_such/btn_3.jpg" name="Image5" width="77" height="31" border="0" id="Image5" /></a></td><!--5-->	
            <td><a href="javascript:MM_swapImage('Image4','','../n_img/power_such/btn_2.jpg',6)" onfocus="blur();" ><img src="../n_img/power_such/btn_1.jpg" name="Image4" width="84" height="31" border="0" id="Image4" /></a></td><!--6-->	
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="1" rowspan="3" bgcolor="#a4b79f"></td>
            <td height="232" align="center" bgcolor="#fcfcfc"><img id=national onError="MM_swapImage('Image7','','../n_img/power_such/btn_7.jpg',1)"></img></td>
            <td width="1" rowspan="3" bgcolor="#a4b79f"></td>
          </tr>
          <tr>
            <td><table width="100%" height="76" border="0" cellspacing="0" cellpadding="0">
              <tr bgcolor="#fcfcfc">
                <td width="132" height="73"><img src="../n_img/power_such/text_bg.jpg" width="132" height="73" /></td>
                <td width="173" height="76"><table width="100" border="0" cellspacing="0" cellpadding="0"  height="76">
                  <tr >
                    <td>
                    	
                      <select name="jumpMenu" id="stateselect" "width="20px"  onchange="MM_selectMenu(0)">
                      	<option value="0" selected="selected">-??-</option>
                      	<?=rg_html_option($state_list,$data['jumpMenu'])?>
                      </select>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <select name="jumpMenu2" id="cityselect" onchange="MM_selectMenu(1)">
                      	<option value="0" selected="selected">-????-</option>
                      </select>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <select name="jumpMenu3" id="schoolselect" onchange="MM_selectMenu(2)">
                      	<option value="0" selected="selected">-?��?-</option>
                      </select>
                    </td>
                  </tr>
                </table></td>
                <td align="left"><a href="javascript:searchschool()">&nbsp;&nbsp;<img src="../n_img/power_such/btn_such.jpg" width="80" height="22" border="0" /></a></td>
              </tr>
            </table></td>
            </tr>
          <tr>
            <td height="1" bgcolor="#a4b79f"></td>
            </tr>
                    </table></td>
      </tr>
    </table></td>
    <td width="18"><img src="../n_img/power_such/right _bg.jpg" width="18" height="375" /></td>
  </tr>
</table>

</body>
</html>
