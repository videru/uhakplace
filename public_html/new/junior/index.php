<?
	include_once("../include/lib.php");
    include_once('_header.php'); 
?>
<script type="text/javascript">
<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

//-->
</script>
<script type="text/javascript">
<!--
function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script><body onLoad="MM_preloadImages('img/main_camp_list_1on.gif','img/main_camp_list_2on.gif','img/main_camp_list_3on.gif','img/main_camp_list_4on.gif','img/main_camp_list_5on.gif','img/main_camp_list_6on.gif','img/main_camp_list_7on.gif','img/pcon_in1on.gif','img/pcon_in2on.gif','img/pcon_in3on.gif','img/pcon_in4on.gif','img/pcon_in5on.gif','img/pcon_in6on.gif')">

<table width="895" border="0" align="center" cellpadding="0" cellspacing="0">

  <tr>
    <td valign="top"><table width="895" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="162" height="160"><?=rg_outlogin('junior')?></td>
        <td width="15"></td>
        <td width="510" valign="bottom"><script>m_menu("../junior/fla/main_fla.swf","510","143")</script></td>
        <td width="15"></td>
        <td width="193" valign="bottom"><table width="193" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><a href="../board/list.php?bbs_code=ju_notice"><img src="../img/main_notice_top.gif" width="193" height="44"></a></td>
          </tr>
          <tr>
            <td height="85" background="../img/main_nnotice_bg.gif"><table width="170" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td><?=rg_lastest('ju_notice','ju_notice',5,28,'..','',$order='bd_next_num desc')?></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td><img src="../img/main_notice_bot.gif" width="193" height="9"></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td valign="top"><table width="895" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="154" valign="top"><table width="154" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><img src="img/main_br.gif" width="154" height="101" /></td>
          </tr>
          <tr>
            <td height="13"></td>
          </tr>
          <tr>
            <td><img src="img/main_regi.gif" width="154" height="91" /></td>
          </tr>
          <tr>
            <td height="13"></td>
          </tr>
          <tr>
            <td><a href="http://upcall.co.kr" target="_blank"><img src="img/main_tel.gif" width="154" height="92" /></a></td>
          </tr>
          <tr>
            <td height="13"></td>
          </tr>
          <tr>
            <td><img src="img/main_cost.gif" width="154" height="92" /></td>
          </tr>
          <tr>
            <td height="13"></td>
          </tr>
          <tr>
            <td><img src="../junior//img/main_social.gif" width="154" height="127" border="0" usemap="#social" /></td>
          </tr>
        </table></td>
        <td width="21">&nbsp;</td>
        <td width="720" valign="top"><table width="720" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><img src="img/main_comm_tit.gif" width="328" height="28" /></td>
          </tr>
          <tr>
            <td><table width="720" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><img src="img/main_tab1_top.gif" width="720" height="15" /></td>
                </tr>
              <tr>
                <td valign="top" background="img/main_tab1_bg.gif"><table width="720" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="200" valign="top"><table width="170" border="0" align="center" cellpadding="0" cellspacing="0">
                      <tr>
                        <td colspan="3"><img src="img/main_colum.gif" width="79" height="14" /></td>
                        </tr>
                      <tr>
                        <td height="8" colspan="3"></td>
                      </tr>
                      <tr>
                        <td width="77"><a href="../board/view.php?bbs_code=ju_colum"><img src="img/cha_1.gif" width="77" height="104" /></a></td>
                        <td width="16">&nbsp;</td>
                        <td width="77"><a href="../board/view.php?bbs_code=ju_colum"><img src="img/cha_2.gif" width="77" height="104" /></a></td>
                      </tr>
                    </table></td>
                    <td width="325" valign="top"><table width="295" border="0" align="center" cellpadding="0" cellspacing="0">
                      <tr>
                        <td><table width="295" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="264"><img src="img/main_episode.gif" width="113" height="14" /></td>
                            <td width="31" align="right">&nbsp;</td>
                          </tr>
                        </table></td>
                      </tr>
                      <tr>
                        <td height="8"></td>
                      </tr>
                      <tr>
                        <td valign="top"><?include("ince.php");?></td>
                      </tr>
                    </table></td>
                    <td width="195" valign="top"><table width="165" border="0" align="center" cellpadding="0" cellspacing="0">
                      <tr>
                        <td><img src="img/main_cons.gif" width="81" height="14" /></td>
                      </tr>
                      <tr>
                        <td height="8"></td>
                      </tr>
                      <tr>
                        <td><img src="img/pcon_text.gif" width="142" height="24" /></td>
                      </tr>
                      <tr>
                        <td height="9"></td>
                      </tr>
                      <tr>
                        <td valign="top"><table width="165" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="85" height="25" valign="top"><a href="../board/view.php?bbs_code=ju_qna" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image78','','img/pcon_in1on.gif',1)"><img src="img/pcon_in1.gif" name="Image78" width="80" height="20" border="0"></a></td>
                            <td width="80" align="right" valign="top"><a href="../board/view.php?bbs_code=ju_qna" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image79','','img/pcon_in2on.gif',1)"><img src="img/pcon_in2.gif" name="Image79" width="80" height="20" border="0"></a></td>
                          </tr>
                          <tr>
                            <td height="25" valign="top"><a href="../board/view.php?bbs_code=ju_qna" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image80','','img/pcon_in3on.gif',1)"><img src="img/pcon_in3.gif" name="Image80" width="80" height="20" border="0"></a></td>
                            <td align="right" valign="top"><a href="../board/view.php?bbs_code=ju_qna" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image81','','img/pcon_in4on.gif',1)"><img src="img/pcon_in4.gif" name="Image81" width="80" height="20" border="0"></a></td>
                          </tr>
                          <tr>
                            <td height="25" valign="top"><a href="../board/view.php?bbs_code=ju_qna" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image82','','img/pcon_in5on.gif',1)"><img src="img/pcon_in5.gif" name="Image82" width="80" height="20" border="0"></a></td>
                            <td align="right" valign="top"><a href="../board/view.php?bbs_code=ju_qna" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image83','','img/pcon_in6on.gif',1)"><img src="img/pcon_in6.gif" name="Image83" width="80" height="20" border="0"></a></td>
                          </tr>
                        </table></td>
                      </tr>
                    </table></td>
                  </tr>
                </table></td>
                </tr>
              <tr>
                <td><img src="img/main_tab1_bot.gif" width="720" height="16" /></td>
                </tr>
            </table></td>
          </tr>
          <tr>
            <td height="10"></td>
          </tr>
          <tr>
            <td valign="top"><table width="720" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="54" valign="top"><img src="img/main_hole.gif" width="352" height="43" /></td>
                <td width="30" rowspan="2">&nbsp;</td>
                <td valign="top"><img src="img/best_tit.gif" width="338" height="43" /></td>
              </tr>
              <tr>
                <td width="352" height="292" valign="top"><table width="352" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td><table width="336" border="0" align="center" cellpadding="0" cellspacing="0">
                      <tr>
                        <td width="352"><table width="332" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="301"><img src="img/main_episode.gif" width="113" height="14" /></td>
                              <td width="31" align="right"><a href="../board/view.php?bbs_code=ju_talk"><img src="img/more.gif" width="31" height="5" align="absmiddle" /></a></td>
                            </tr>
                        </table></td>
                      </tr>
                      <tr>
                        <td height="13"></td>
                      </tr>
                      <tr>
                        <td><table width="352" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="68"><img src="img/epi_simg.gif" width="58" height="59" /></td>
                            <td width="268"><?=rg_lastest('ju_talk','new_last',3,32,'..','',$order='bd_next_num desc')?></td>
                          </tr>
                        </table></td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td><img src="img/main_dot_line.gif" width="352" height="30" /></td>
                  </tr>
                  <tr>
                    <td><table width="336" border="0" align="center" cellpadding="0" cellspacing="0">
                      <tr>
                        <td><table width="332" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="301"><img src="img/pride_tit.gif" width="106" height="14" /></td>
                            <td width="31" align="right"><a href="../board/view.php?bbs_code=ju_story"><img src="img/more.gif" width="31" height="5" align="absmiddle" /></a></td>
                          </tr>
                        </table></td>
                      </tr>
                      <tr>
                        <td height="13"></td>
                      </tr>
                      <tr>
                        <td valign="top"><table width="336" border="0" align="center" cellpadding="0" cellspacing="0">
                            <tr>
                              <td width="131" height="29"><img src="img/epi_ttt.gif" width="113" height="25" /></td>
                              <td width="205" rowspan="2"><img src="img/epi_img.gif" width="205" height="49" /></td>
                            </tr>
                            <tr>
                              <td><a href="../board/view.php?bbs_code=ju_story"><img src="img/go.gif" width="34" height="13" /></a></td>
                            </tr>
                        </table></td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td><img src="img/main_dot_line.gif" width="352" height="30" /></td>
                  </tr>
                  <tr>
                    <td><table width="336" border="0" align="center" cellpadding="0" cellspacing="0">
                      <tr>
                        <td height="46" valign="top"><a href="http://cafe.naver.com/hsj" target="_blank"><img src="img/cafe_banner1.gif" width="162" height="34" /></a></td>
                        <td align="right" valign="top"><a href="http://cafe.naver.com/screen21" target="_blank"><img src="img/cafe_banner2.gif" width="162" height="34" /></a></td>
                      </tr>
                      <tr>
                        <td valign="top"><a href="http://cafe.naver.com/gmltkd" target="_blank"><img src="img/cafe_banner3.gif" width="162" height="34" /></a></td>
                        <td align="right" valign="top"><a href="http://cafe.daum.net/99w0n" target="_blank"><img src="img/cafe_banner4.gif" width="162" height="34" /></a></td>
                      </tr>
                    </table></td>
                  </tr>
                </table></td>
                <td width="338" valign="top"><table width="332" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="226" align="center"><table width="325" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td><a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image71','','img/main_camp_list_1on.gif',1)"><img src="img/main_camp_list_1.gif" name="Image71" width="325" height="27" border="0"></a></td>
                      </tr>
                      <tr>
                        <td height="7"></td>
                      </tr>
                      <tr>
                        <td><a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image72','','img/main_camp_list_2on.gif',1)"><img src="img/main_camp_list_2.gif" name="Image72" width="325" height="27" border="0"></a></td>
                      </tr>
                      <tr>
                        <td height="7"></td>
                      </tr>                     
                      <tr>
                        <td><a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image73','','img/main_camp_list_3on.gif',1)"><img src="img/main_camp_list_3.gif" name="Image73" width="325" height="27" border="0"></a></td>
                      </tr>
                      <tr>
                        <td height="7"></td>
                      </tr>                      
                      <tr>
                        <td><a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image74','','img/main_camp_list_4on.gif',1)"><img src="img/main_camp_list_4.gif" name="Image74" width="325" height="27" border="0"></a></td>
                      </tr>
                      <tr>
                        <td height="7"></td>
                      </tr>                      
                      <tr>
                        <td><a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image75','','img/main_camp_list_5on.gif',1)"><img src="img/main_camp_list_5.gif" name="Image75" width="325" height="27" border="0"></a></td>
                      </tr>
                       <tr>
                        <td height="7"></td>
                      </tr>                        
                      <tr>
                        <td><a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image76','','img/main_camp_list_6on.gif',1)"><img src="img/main_camp_list_6.gif" name="Image76" width="325" height="27" border="0"></a></td>
                      </tr>
                      <tr>
                        <td height="7"></td>
                      </tr>                     
                      <tr>
                        <td><a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image77','','img/main_camp_list_7on.gif',1)"><img src="img/main_camp_list_7.gif" name="Image77" width="325" height="27" border="0"></a></td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td><table width="338" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="162"><a href="../junior/young_sch.php"><img src="img/main_young.gif" width="162" height="57" /></a></td>
                        <td width="14">&nbsp;</td>
                        <td width="162"><a href="../board/view.php?bbs_code=ju_photo"><img src="img/main_zone.gif" width="162" height="57" /></a></td>
                      </tr>
                    </table></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
          </tr>

        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="20" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td valign="top"><table width="895" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="891"><img src="img/bot_line.gif" width="895" height="8" /></td>
      </tr>

      
    </table></td>
  </tr>
  <tr>
    <td valign="top"><table width="895" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="175"><img src="../junior/img/bot_m1.gif" width="175" height="24" /></td>
        <td></td>
        <td width="175"><img src="../junior/img/bot_m2.gif" width="175" height="24" /></td>
        <td></td>
        <td width="175"><img src="../junior/img/bot_m3.gif" width="175" height="24" /></td>
        <td></td>
        <td width="175"><img src="../junior/img/bot_m6.gif" width="175" height="24" /></td>
        <td></td>
        <td width="175"><img src="../junior/img/bot_m6.gif" width="175" height="24" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td background="../junior/img/bot_dot.gif"></td>
        <td>&nbsp;</td>
        <td background="../junior/img/bot_dot.gif"></td>
        <td>&nbsp;</td>
        <td background="../junior/img/bot_dot.gif"></td>
        <td>&nbsp;</td>
        <td background="../junior/img/bot_dot.gif"></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><table width="175" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="15" rowspan="4">&nbsp;</td>
              <td width="160" height="18"><img src="../junior/img/icon_dot.gif" width="2" height="2" align="absmiddle" /> <span class="tt4">가족연수</span></td>
            </tr>
            <tr>
              <td height="18"><img src="../junior/img/icon_dot.gif" width="2" height="2" align="absmiddle" /> <span class="tt4">가족캠프</span></td>
            </tr>
            <tr>
              <td height="18">&nbsp;</td>
            </tr>
            <tr>
              <td height="18">&nbsp;</td>
            </tr>
        </table></td>
        <td background="../junior/img/bot_dot.gif"></td>
        <td><table width="175" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="15" rowspan="4">&nbsp;</td>
              <td width="160" height="18"><img src="../junior/img/icon_dot.gif" width="2" height="2" align="absmiddle" /> <span class="tt4">주니어연수</span></td>
            </tr>
            <tr>
              <td height="18"><img src="../junior/img/icon_dot.gif" width="2" height="2" align="absmiddle" /> <span class="tt4">주니어캠프</span></td>
            </tr>
            <tr>
              <td height="18">&nbsp;</td>
            </tr>
            <tr>
              <td height="18">&nbsp;</td>
            </tr>
        </table></td>
        <td background="../junior/img/bot_dot.gif"></td>
        <td><table width="175" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="15" rowspan="4">&nbsp;</td>
              <td width="160" height="18"><img src="../junior/img/icon_dot.gif" width="2" height="2" align="absmiddle" /> <span class="tt4">조기유학</span></td>
            </tr>
            <tr>
              <td height="18"><img src="../junior/img/icon_dot.gif" width="2" height="2" align="absmiddle" /> <span class="tt4">학교리스트</span></td>
            </tr>
            <tr>
              <td height="18">&nbsp;</td>
            </tr>
            <tr>
              <td height="18">&nbsp;</td>
            </tr>
        </table></td>
        <td background="../junior/img/bot_dot.gif"></td>
        <td><table width="175" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="15" rowspan="4">&nbsp;</td>
              <td width="160" height="18"><img src="../junior/img/icon_dot.gif" width="2" height="2" align="absmiddle" /> <span class="tt4">공지사항</span></td>
            </tr>
            <tr>
              <td height="18"><img src="../junior/img/icon_dot.gif" width="2" height="2" align="absmiddle" /> <span class="tt4">질문게시판</span></td>
            </tr>
            <tr>
              <td height="18"><img src="../junior/img/icon_dot.gif" width="2" height="2" align="absmiddle" /> <span class="tt4">자주하는질문</span></td>
            </tr>
            <tr>
              <td height="18"><img src="../junior/img/icon_dot.gif" width="2" height="2" align="absmiddle" /> <span class="tt4">자주하는질문</span></td>
            </tr>
        </table></td>
        <td background="../junior/img/bot_dot.gif"></td>
        <td><table width="175" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="15" rowspan="4">&nbsp;</td>
              <td width="160" height="18"><img src="../junior/img/icon_dot.gif" width="2" height="2" align="absmiddle" /> <span class="tt4">연수후기</span></td>
            </tr>
            <tr>
              <td height="18"><img src="../junior/img/icon_dot.gif" width="2" height="2" align="absmiddle" /> <span class="tt4">이벤트</span></td>
            </tr>
            <tr>
              <td height="18"><img src="../junior/img/icon_dot.gif" width="2" height="2" align="absmiddle" /> <span class="tt4">전문가 칼럼</span></td>
            </tr>
            <tr>
              <td height="18"><img src="../junior/img/icon_dot.gif" width="2" height="2" align="absmiddle" /> <span class="tt4">포토갤러리</span></td>
            </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
<?  include_once('../junior/_footer.php'); ?>
<map name="social"><area shape="rect" coords="9,8,144,29" href="http://cafe.naver.com/tal82" target="_blank">
<area shape="rect" coords="11,36,143,57" href="#"><area shape="rect" coords="13,70,142,94" href="#"><area shape="rect" coords="12,98,142,122" href="#"></map>