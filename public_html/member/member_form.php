<? if (!defined('RGBOARD_VERSION')) exit; ?>
<table width="100%" align="center" border="0" cellpadding="0" cellspacing="6">
  <col width=100></col><col>
  </col>
<? if($mode=="member_join") { ?>
  <tr>
    <td align="right"><strong>아이디</strong>&nbsp;</td>
    <td><input type="text" class="input" name="mb_id" size="20" maxlength="12" hname="아이디" value="" required option="userid">
      <input name="button" type="button" class="button" onClick="search_mb_id('<?=$_url['member']?>','member_form|mb_id',document.member_form.mb_id.value)" value="중복확인">
      <br />
      3~12자의 한글,영문자,숫자,&quot;-&quot;,&quot;_&quot; 만 가능합니다.<br />
      단 &quot;-&quot;나 &quot;_&quot; 는 첫문자로 사용할 수 없습니다.</td>
  </tr>
  <tr>
    <td height="1" colspan="2" bgcolor="#ECECEC"><img width="1" height="1"></td>
  </tr>
<? } else { ?>
  <tr>
    <td align="right"><strong>아이디</strong>&nbsp;</td>
    <td><?=$data['mb_id']?></td>
  </tr>
  <tr>
    <td height="1" colspan="2" bgcolor="#ECECEC"><img width="1" height="1"></td>
  </tr>
<? } // end if member_join ?>
  <tr>
    <td align="right"><strong>암호</strong></td>
    <td><input name="mb_pass" type="password" class="input" size="20" maxbyte="12" minbyte="4" <?=$required['mb_pass']?> hname="암호" match="mb_pass1">
      &nbsp;<strong>암호확인</strong>
      <input type="password" class="input" name="mb_pass1" size="20" hname="암호확인">
      <br />
      4자 이상 12이하로 입력해주세요. </td>
  </tr>
  <tr>
    <td height="1" colspan="2" bgcolor="#ECECEC"><img width="1" height="1"></td>
  </tr>
<? if($member_form['mb_name']!=0) { ?>
<? if($mode=="member_join") { ?>
  <tr>
    <td align="right"><strong>이름</strong></td>
    <td><input type="text" class="input" name="mb_name" size="20" maxlength="20" minbyte="2"  hname="이름" value="" option="hanonly" <?=$required['mb_name']?>>
      <input type="checkbox" name="of[mb_name]" value="1" <?=$c_of['mb_name']?> />
    공개<br />
      공백없이 한글로만 입력해주세요. </td>
  </tr>
  <tr>
    <td height="1" colspan="2" bgcolor="#ECECEC"><img width="1" height="1"></td>
  </tr>
<? } else { ?>
  <tr>
    <td align="right"><strong>이름</strong></td>
    <td><?=$data['mb_name']?>
      <input type="checkbox" name="of[mb_name]" value="1" <?=$c_of['mb_name']?> />
공개</td>
  </tr>
  <tr>
    <td height="1" colspan="2" bgcolor="#ECECEC"><img width="1" height="1"></td>
  </tr>
<? } // end if member_join ?>
<? } // end if mb_name ?>
<? if($member_form['mb_nick']!=0) { ?>
  <tr>
    <td align="right"><strong>닉네임</strong></td>
    <td><input name="mb_nick" type="text" class="input" id="mb_nick" value="<?=$data['mb_nick']?>" size="20" maxlength="20" minbyte="2" hname="닉네임" option="nick" <?=$required['mb_nick']?>>
      <br />
      2~12자의 한글,영문자,숫자,"-","_" 만 가능합니다.</td>
  </tr>
  <tr>
    <td height="1" colspan="2" bgcolor="#ECECEC"><img width="1" height="1"></td>
  </tr>
<? } // end if mb_nick ?>
<? if($member_form['mb_email']!=0) { ?>
  <tr>
    <td align="right"><strong>이메일</strong></td>
    <td><input type="text" class="input" name="mb_email" size="40" maxlength="100" option="email" hname="이메일" value="<?=$data['mb_email']?>" <?=$required['mb_email']?>>
    <input type="checkbox" name="of[mb_email]" value="1" <?=$c_of['mb_email']?> />
    공개      </td>
  </tr>
  <tr>
    <td height="1" colspan="2" bgcolor="#ECECEC"><img width="1" height="1"></td>
  </tr>
<? } // end if mb_email ?>
<? if($member_form['mb_jumin']!=0) { ?>
<? if($mode=="member_join") { ?>
  <tr>
    <td align="right"><strong>주민등록번호</strong></td>
    <td><input type="text" class="input" name="mb_jumin1" size="6" maxlength="6" value="" span="2" glue="-" option="jumin" hname="주민등록번호" <?=$required['mb_jumin']?>> - <input type="password" class="input" name="mb_jumin2" size="7" maxlength="7" value=""></td>
  </tr>
  <tr>
    <td height="1" colspan="2" bgcolor="#ECECEC"><img width="1" height="1"></td>
  </tr>
<? } // end if member_join ?>
<? } // end if mb_jumin ?>
<? if($member_form['mb_tel1']!=0) { ?>      
  <tr>
    <td align="right"><strong>전화번호</strong></td>
    <td><input type="text" class="input" name="mb_tel11" size="4" maxlength="4" value="<?=$data['mb_tel11']?>" option="phone" span="3" hname="전화번호" <?=$required['mb_tel1']?>> - 
    <input type="text" class="input" name="mb_tel12" size="4" maxlength="4" value="<?=$data['mb_tel12']?>"> - 
    <input type="text" class="input" name="mb_tel13" size="4" maxlength="4" value="<?=$data['mb_tel13']?>">
    <input type="checkbox" name="of[mb_tel1]" value="1" <?=$c_of['mb_tel1']?> />
공개 </td>
  </tr>
  <tr>
    <td height="1" colspan="2" bgcolor="#ECECEC"><img width="1" height="1"></td>
  </tr>
<? } // end if mb_tel1 ?>
<? if($member_form['mb_tel2']!=0) { ?>
  <tr>
    <td align="right"><strong>핸드폰번호</strong></td>
    <td><input type="text" class="input" name="mb_tel21" size="4" maxlength="4" value="<?=$data['mb_tel21']?>"  option="phone" span="3" hname="핸드폰번호" <?=$required['mb_tel2']?>> -
    <input type="text" class="input" name="mb_tel22" size="4" maxlength="4" value="<?=$data['mb_tel22']?>" /> -
    <input type="text" class="input" name="mb_tel23" size="4" maxlength="4" value="<?=$data['mb_tel23']?>" />
    <input type="checkbox" name="of[mb_tel2]" value="1" <?=$c_of['mb_tel2']?> />
공개 </td>
  </tr>
  <tr>
    <td height="1" colspan="2" bgcolor="#ECECEC"><img width="1" height="1"></td>
  </tr>
<? } // end if mb_tel2 ?>
<? if($member_form['mb_address']!=0) { ?>
  <tr>
    <td align="right"><strong>우편번호</strong></td>
    <td><input type="text" class="input" name="mb_post1" size="3" maxlength="3" readonly value="<?=$data['mb_post1']?>" span="2" hname="우편번호" <?=$required['mb_address']?>> -
    <input type="text" class="input" name="mb_post2" size="3" maxlength="3" readonly value="<?=$data['mb_post2']?>">
      <input name="button3" type="button" class="button" onClick="search_post('<?=$_url['member']?>','member_form|mb_post1|mb_post2|mb_address1|mb_address2')" value='우편번호 검색'> <input type="checkbox" name="of[mb_post]" value="1" <?=$c_of['mb_post']?> />
      주소공개 </td>
  </tr>
  <tr>
    <td height="1" colspan="2" bgcolor="#ECECEC"><img width="1" height="1"></td>
  </tr>
  <tr>
    <td align="right"><strong>주소</strong></td>
    <td><input name="mb_address1" type="text" class="input" id="mb_address1" value="<?=$data['mb_address1']?>" size="50" readonly hname="주소" <?=$required['mb_address']?>>
      <br><img width="1" height="5" /><br />
      <input name="mb_address2" type="text" class="input" id="mb_address2" value="<?=$data['mb_address2']?>" size="35" hname="상세주소" <?=$required['mb_address']?>>
      (상세주소)</td>
  </tr>
  <tr>
    <td height="1" colspan="2" bgcolor="#ECECEC"><img width="1" height="1"></td>
  </tr>
<? } // end if mb_address ?>
<? if($member_form['mb_signature']!=0) { ?>
  <tr>
    <td align="right"><strong>서명</strong></td>
    <td><textarea name="mb_signature" cols="60" rows="3" class="input" hname="서명" <?=$required['mb_signature']?>><?=$data['mb_signature']?></textarea><br />(본인이 작성한 글 하단에 표시됩니다.)</td>
  </tr>
  <tr>
    <td height="1" colspan="2" bgcolor="#ECECEC"><img width="1" height="1"></td>
  </tr>
<? } // end if mb_signature ?>
<? if($member_form['mb_introduce']!=0) { ?>
  <tr>
    <td align="right"><strong>자기소개</strong></td>
    <td><textarea name="mb_introduce" cols="60" rows="3" class="input" hname="자기소개" <?=$required['mb_introduce']?>><?=$data['mb_introduce']?></textarea><br />(정보공개한 경우 다른 사람이 볼수 있습니다.)</td>
  </tr>
  <tr>
    <td height="1" colspan="2" bgcolor="#ECECEC"><img width="1" height="1"></td>
  </tr>
<? } // end if mb_introduce ?>
<? if($member_form['icon1']!=0) { ?>
  <tr>
    <td align="right"><strong>회원아이콘</strong></td>
    <td><input type="file" name="mb_files[icon1]" class="input" size="30" hname="회원아이콘" <?=$required['icon1']?>><br />
    <? if($data['mb_files']['icon1']['name']!='') { ?>
    <?=$data['mb_files']['icon1']['name']?>
    <input type="checkbox" name="mb_files_del[icon1]" value="1" />
  삭제
  <? } ?></td>
  </tr>
  <tr>
    <td height="1" colspan="2" bgcolor="#ECECEC"><img width="1" height="1"></td>
  </tr>
<? } // end if icon1 ?>
<? if($member_form['photo1']!=0) { ?>
  <tr>
    <td align="right"><strong>사진</strong></td>
    <td><input type="file" name="mb_files[photo1]" class="input" size="30" hname="사진" <?=$required['photo1']?> />
      <input type="checkbox" name="of[photo1]" value="1" <?=$c_of[photo1]?> />
공개 <br />
    <? if($data['mb_files']['photo1']['name']!='') { ?>
    <?=$data['mb_files']['photo1']['name']?>
    <input type="checkbox" name="mb_files_del[photo1]" value="1" />
  삭제
  <? } ?>
    </td>
  </tr>
  <tr>
    <td height="1" colspan="2" bgcolor="#ECECEC"><img width="1" height="1"></td>
  </tr>
<? } // end if photo1 ?>
  <tr>
    <td>&nbsp;</td>
    <td><input name="mb_is_mailing" type="checkbox" id="mb_is_mailing" value="1" <?=$c_mb_is_mailing[1]?>>
      <strong>메일수신</strong> &nbsp;
      <input name="mb_is_opening" type="checkbox" id="mb_is_opening" value="1" <?=$c_mb_is_opening[1]?>>
      <strong>정보공개</strong></td>
  </tr>
</table>