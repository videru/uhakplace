<? if (!defined('RGBOARD_VERSION')) exit; ?>
<table width="100%" align="center" border="0" cellpadding="0" cellspacing="6">
  <col width=100></col><col>
  </col>
<? if($mode=="member_join") { ?>
  <tr>
    <td align="right"><strong>���̵�</strong>&nbsp;</td>
    <td><input type="text" class="input" name="mb_id" size="20" maxlength="12" hname="���̵�" value="" required option="userid">
      <input name="button" type="button" class="button" onClick="search_mb_id('<?=$_url['member']?>','member_form|mb_id',document.member_form.mb_id.value)" value="�ߺ�Ȯ��">
      <br />
      3~12���� �ѱ�,������,����,&quot;-&quot;,&quot;_&quot; �� �����մϴ�.<br />
      �� &quot;-&quot;�� &quot;_&quot; �� ù���ڷ� ����� �� �����ϴ�.</td>
  </tr>
  <tr>
    <td height="1" colspan="2" bgcolor="#ECECEC"><img width="1" height="1"></td>
  </tr>
<? } else { ?>
  <tr>
    <td align="right"><strong>���̵�</strong>&nbsp;</td>
    <td><?=$data['mb_id']?></td>
  </tr>
  <tr>
    <td height="1" colspan="2" bgcolor="#ECECEC"><img width="1" height="1"></td>
  </tr>
<? } // end if member_join ?>
  <tr>
    <td align="right"><strong>��ȣ</strong></td>
    <td><input name="mb_pass" type="password" class="input" size="20" maxbyte="12" minbyte="4" <?=$required['mb_pass']?> hname="��ȣ" match="mb_pass1">
      &nbsp;<strong>��ȣȮ��</strong>
      <input type="password" class="input" name="mb_pass1" size="20" hname="��ȣȮ��">
      <br />
      4�� �̻� 12���Ϸ� �Է����ּ���. </td>
  </tr>
  <tr>
    <td height="1" colspan="2" bgcolor="#ECECEC"><img width="1" height="1"></td>
  </tr>
<? if($member_form['mb_name']!=0) { ?>
<? if($mode=="member_join") { ?>
  <tr>
    <td align="right"><strong>�̸�</strong></td>
    <td><input type="text" class="input" name="mb_name" size="20" maxlength="20" minbyte="2"  hname="�̸�" value="" option="hanonly" <?=$required['mb_name']?>>
      <input type="checkbox" name="of[mb_name]" value="1" <?=$c_of['mb_name']?> />
    ����<br />
      ������� �ѱ۷θ� �Է����ּ���. </td>
  </tr>
  <tr>
    <td height="1" colspan="2" bgcolor="#ECECEC"><img width="1" height="1"></td>
  </tr>
<? } else { ?>
  <tr>
    <td align="right"><strong>�̸�</strong></td>
    <td><?=$data['mb_name']?>
      <input type="checkbox" name="of[mb_name]" value="1" <?=$c_of['mb_name']?> />
����</td>
  </tr>
  <tr>
    <td height="1" colspan="2" bgcolor="#ECECEC"><img width="1" height="1"></td>
  </tr>
<? } // end if member_join ?>
<? } // end if mb_name ?>
<? if($member_form['mb_nick']!=0) { ?>
  <tr>
    <td align="right"><strong>�г���</strong></td>
    <td><input name="mb_nick" type="text" class="input" id="mb_nick" value="<?=$data['mb_nick']?>" size="20" maxlength="20" minbyte="2" hname="�г���" option="nick" <?=$required['mb_nick']?>>
      <br />
      2~12���� �ѱ�,������,����,"-","_" �� �����մϴ�.</td>
  </tr>
  <tr>
    <td height="1" colspan="2" bgcolor="#ECECEC"><img width="1" height="1"></td>
  </tr>
<? } // end if mb_nick ?>
<? if($member_form['mb_email']!=0) { ?>
  <tr>
    <td align="right"><strong>�̸���</strong></td>
    <td><input type="text" class="input" name="mb_email" size="40" maxlength="100" option="email" hname="�̸���" value="<?=$data['mb_email']?>" <?=$required['mb_email']?>>
    <input type="checkbox" name="of[mb_email]" value="1" <?=$c_of['mb_email']?> />
    ����      </td>
  </tr>
  <tr>
    <td height="1" colspan="2" bgcolor="#ECECEC"><img width="1" height="1"></td>
  </tr>
<? } // end if mb_email ?>
<? if($member_form['mb_jumin']!=0) { ?>
<? if($mode=="member_join") { ?>
  <tr>
    <td align="right"><strong>�ֹε�Ϲ�ȣ</strong></td>
    <td><input type="text" class="input" name="mb_jumin1" size="6" maxlength="6" value="" span="2" glue="-" option="jumin" hname="�ֹε�Ϲ�ȣ" <?=$required['mb_jumin']?>> - <input type="password" class="input" name="mb_jumin2" size="7" maxlength="7" value=""></td>
  </tr>
  <tr>
    <td height="1" colspan="2" bgcolor="#ECECEC"><img width="1" height="1"></td>
  </tr>
<? } // end if member_join ?>
<? } // end if mb_jumin ?>
<? if($member_form['mb_tel1']!=0) { ?>      
  <tr>
    <td align="right"><strong>��ȭ��ȣ</strong></td>
    <td><input type="text" class="input" name="mb_tel11" size="4" maxlength="4" value="<?=$data['mb_tel11']?>" option="phone" span="3" hname="��ȭ��ȣ" <?=$required['mb_tel1']?>> - 
    <input type="text" class="input" name="mb_tel12" size="4" maxlength="4" value="<?=$data['mb_tel12']?>"> - 
    <input type="text" class="input" name="mb_tel13" size="4" maxlength="4" value="<?=$data['mb_tel13']?>">
    <input type="checkbox" name="of[mb_tel1]" value="1" <?=$c_of['mb_tel1']?> />
���� </td>
  </tr>
  <tr>
    <td height="1" colspan="2" bgcolor="#ECECEC"><img width="1" height="1"></td>
  </tr>
<? } // end if mb_tel1 ?>
<? if($member_form['mb_tel2']!=0) { ?>
  <tr>
    <td align="right"><strong>�ڵ�����ȣ</strong></td>
    <td><input type="text" class="input" name="mb_tel21" size="4" maxlength="4" value="<?=$data['mb_tel21']?>"  option="phone" span="3" hname="�ڵ�����ȣ" <?=$required['mb_tel2']?>> -
    <input type="text" class="input" name="mb_tel22" size="4" maxlength="4" value="<?=$data['mb_tel22']?>" /> -
    <input type="text" class="input" name="mb_tel23" size="4" maxlength="4" value="<?=$data['mb_tel23']?>" />
    <input type="checkbox" name="of[mb_tel2]" value="1" <?=$c_of['mb_tel2']?> />
���� </td>
  </tr>
  <tr>
    <td height="1" colspan="2" bgcolor="#ECECEC"><img width="1" height="1"></td>
  </tr>
<? } // end if mb_tel2 ?>
<? if($member_form['mb_address']!=0) { ?>
  <tr>
    <td align="right"><strong>�����ȣ</strong></td>
    <td><input type="text" class="input" name="mb_post1" size="3" maxlength="3" readonly value="<?=$data['mb_post1']?>" span="2" hname="�����ȣ" <?=$required['mb_address']?>> -
    <input type="text" class="input" name="mb_post2" size="3" maxlength="3" readonly value="<?=$data['mb_post2']?>">
      <input name="button3" type="button" class="button" onClick="search_post('<?=$_url['member']?>','member_form|mb_post1|mb_post2|mb_address1|mb_address2')" value='�����ȣ �˻�'> <input type="checkbox" name="of[mb_post]" value="1" <?=$c_of['mb_post']?> />
      �ּҰ��� </td>
  </tr>
  <tr>
    <td height="1" colspan="2" bgcolor="#ECECEC"><img width="1" height="1"></td>
  </tr>
  <tr>
    <td align="right"><strong>�ּ�</strong></td>
    <td><input name="mb_address1" type="text" class="input" id="mb_address1" value="<?=$data['mb_address1']?>" size="50" readonly hname="�ּ�" <?=$required['mb_address']?>>
      <br><img width="1" height="5" /><br />
      <input name="mb_address2" type="text" class="input" id="mb_address2" value="<?=$data['mb_address2']?>" size="35" hname="���ּ�" <?=$required['mb_address']?>>
      (���ּ�)</td>
  </tr>
  <tr>
    <td height="1" colspan="2" bgcolor="#ECECEC"><img width="1" height="1"></td>
  </tr>
<? } // end if mb_address ?>
<? if($member_form['mb_signature']!=0) { ?>
  <tr>
    <td align="right"><strong>����</strong></td>
    <td><textarea name="mb_signature" cols="60" rows="3" class="input" hname="����" <?=$required['mb_signature']?>><?=$data['mb_signature']?></textarea><br />(������ �ۼ��� �� �ϴܿ� ǥ�õ˴ϴ�.)</td>
  </tr>
  <tr>
    <td height="1" colspan="2" bgcolor="#ECECEC"><img width="1" height="1"></td>
  </tr>
<? } // end if mb_signature ?>
<? if($member_form['mb_introduce']!=0) { ?>
  <tr>
    <td align="right"><strong>�ڱ�Ұ�</strong></td>
    <td><textarea name="mb_introduce" cols="60" rows="3" class="input" hname="�ڱ�Ұ�" <?=$required['mb_introduce']?>><?=$data['mb_introduce']?></textarea><br />(���������� ��� �ٸ� ����� ���� �ֽ��ϴ�.)</td>
  </tr>
  <tr>
    <td height="1" colspan="2" bgcolor="#ECECEC"><img width="1" height="1"></td>
  </tr>
<? } // end if mb_introduce ?>
<? if($member_form['icon1']!=0) { ?>
  <tr>
    <td align="right"><strong>ȸ��������</strong></td>
    <td><input type="file" name="mb_files[icon1]" class="input" size="30" hname="ȸ��������" <?=$required['icon1']?>><br />
    <? if($data['mb_files']['icon1']['name']!='') { ?>
    <?=$data['mb_files']['icon1']['name']?>
    <input type="checkbox" name="mb_files_del[icon1]" value="1" />
  ����
  <? } ?></td>
  </tr>
  <tr>
    <td height="1" colspan="2" bgcolor="#ECECEC"><img width="1" height="1"></td>
  </tr>
<? } // end if icon1 ?>
<? if($member_form['photo1']!=0) { ?>
  <tr>
    <td align="right"><strong>����</strong></td>
    <td><input type="file" name="mb_files[photo1]" class="input" size="30" hname="����" <?=$required['photo1']?> />
      <input type="checkbox" name="of[photo1]" value="1" <?=$c_of[photo1]?> />
���� <br />
    <? if($data['mb_files']['photo1']['name']!='') { ?>
    <?=$data['mb_files']['photo1']['name']?>
    <input type="checkbox" name="mb_files_del[photo1]" value="1" />
  ����
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
      <strong>���ϼ���</strong> &nbsp;
      <input name="mb_is_opening" type="checkbox" id="mb_is_opening" value="1" <?=$c_mb_is_opening[1]?>>
      <strong>��������</strong></td>
  </tr>
</table>