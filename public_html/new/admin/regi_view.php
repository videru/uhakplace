<?

	include_once("../include/lib.php");
	require_once("admin_chk.php");
	

	if($mode=='modify' || $mode=='delete') {
		$rs->clear();
		$rs->set_table(	$_table['regi']);
		$rs->add_where("regi_no=$num");
		$rs->select();
		if($rs->num_rows()!=1) { // ������ �ùٸ��� �ʴٸ�
			rg_href('','������ ã���� �����ϴ�.','back');
		}
		$data=$rs->fetch();		

	$rs_ac = new $rs_class($dbcon);
	$rs_ac->clear();
	$rs_ac->set_table($_table['regi_account']);
	$rs_ac->add_where("stu_no=$num");
	$rs_ac->select();
	
	$data_ac=$rs_ac->fetch();	



		
	} else {
		$data=$rs->fetch();		

	}
	
  
	    $rs_na = new $rs_class($dbcon);
	    $rs_na->clear();
	    $rs_na->set_table($_table['member']);
        $rs_na->add_where("mb_num = $data[consult]");	
        $name=$rs_na->fetch();

	$MENU_L='m5';

?>

<? include("_header.php"); ?>
<? include("admin.header.php"); ?>
<table border="0" cellpadding="0" cellspacing="0" width="800" align="center">
  <tr height="40">
    <td background="images/title_bg.gif" style="padding:9pt 0pt 0pt 10pt" valign="top"><font color=#000000><b>�л�����</b></font></td>
  </tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" width="800" align="center">
   <tr>
     <td class="a_sub_title">�����Ȳ<? if($mode=='modify') { ?>����<?}else{?>���<? } ?></td>
   </tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" width="800" align=center bgcolor="#FFFFFF">
    <tr>  
     <td>
  <table border="0" cellpadding="0" cellspacing="0" width="800" align=center>
	<tr>
		<td bgcolor="#666666" height="2"></td>
	</tr> 
	<tr>
		<td bgcolor="#FFFFFF" height="8"></td>
	</tr> 
  </table>
<table border="0" cellpadding="0" cellspacing="0" width="770" align="center" >
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>		
	<tr>
		<td width="110" bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">�̸�</td>
		<td colspan="2"><?=$data['student_name']?></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">ȸ��ID</td>
		<td colspan="2"><?=$data['mb_id']?></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">��ϰ��</td>
		<td colspan="2"><?=$_const['root'][$data['rgi_type']]?></td>
	</tr>	
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">�̸���</td>
		<td colspan="2"><?=$data['email']?></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">��ȭ��ȣ</td>
		<td colspan="2"><?=$data['tel']?></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">�������</td>
		<td colspan="2"><?=$_regi['chain'][$data['chain']]?></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	
	<tr>
		<td width="110" bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">���Ӵ����</td>
		<td colspan="2"><?=$name[mb_name]?></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">�����</td>
		<td colspan="2"><?=$data['regi_date1']?>-<?=$data['regi_date2']?>-<?=$data['regi_date3']?></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">�����</td>
		<td colspan="2"><?=rg_date($data['abroad_date1'],"%Y-%m-%d")?></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">����</td>
		<td colspan="2"><?=$_const['national'][$data['national']]?>
		</select></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">����б�</td>
		<td colspan="2"><?=$data['school_name']?></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">��ϱⰣ</td>
		<td colspan="2"><?=$data['study_gigan']?>��</td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">�����Ȳ</td>
		<td colspan="2"><?=$_process['process_state'][$data['process_state']]?>
		</select></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><input type="checkbox" name="passport_check" value="1" <? if($data[passport_check] == "1") {echo "checked";} ?>>����/���� Ȯ��</td>
		<td colspan="2"><?=$data['passport']?></td>
	</tr>	
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><input type="checkbox" name="regi_cost_check" value="1" <? if($data[regi_cost_check] == "1") {echo "checked";} ?>>���б� �Ա�</td>
		<td colspan="2"><?=$data['regi_cost']?></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><input type="checkbox" name="school_regi_check" value="1" <? if($data[school_regi_check] == "1") {echo "checked";} ?>>���б� ���</td>
		<td colspan="2"><?=$data['school_regi']?></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><input type="checkbox" name="air_reserve_check" value="1" <? if($data[air_reserve_check] == "1") {echo "checked";} ?>>�װ� ����</td>
		<td colspan="2"><?=$data['air_reserve']?></td>
	</tr>	
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><input type="checkbox" name="air_paid_check" value="1" <? if($data[air_paid_check] == "1") {echo "checked";} ?>>�װ��� �ϳ�</td>
		<td colspan="2"><?=$data['air_paid']?></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><input type="checkbox" name="air_ticket_check" value="1" <? if($data[air_ticket_check] == "1") {echo "checked";} ?>>�װ��� �߱�</td>
		<td colspan="2"><?=$data['air_ticket']?></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><input type="checkbox" name="cost_paid_check" value="1" <? if($data[cost_paid_check] == "1") {echo "checked";} ?>>�к��Ա�</td>
		<td colspan="2"><?=$data['cost_paid']?></td>
	</tr>	
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>		
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><input type="checkbox" name="insu_check" value="1" <? if($data[insu_check] == "1") {echo "checked";} ?>>���谡��</td>
		<td colspan="2"><?=$data['insu']?></td>
	</tr>	
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><input type="checkbox" name="abroad_ot_check" value="1" <? if($data[abroad_ot_check] == "1") {echo "checked";} ?>>�ⱹ O/T</td>
		<td colspan="2"><?=$data['abroad_ot']?></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><input type="checkbox" name="abroad_check" value="1" <? if($data[abroad_check] == "1") {echo "checked";} ?>>�ⱹ</td>
		<td colspan="2"><?=$data['abroad']?></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">������</td>
		<td width="600"><?=$data['etc']?></td>
        <td bgcolor="#FFFFFF"></td>
    </tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	
    <tr>
	    <td height="30" colspan="3"></td>
    </tr>
    <tr>
	    <td bgcolor="#BECCDD" height="2" colspan="3"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">���б�</td>
		<td colspan="2"><?=$data_ac['iphak_date1']?>�� <?=$data_ac['iphak_date2']?>�� <?=$data_ac['iphak_date3']?>�� <?=number_format($data_ac['iphak'])?>�� </td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">�к�</td>
		<td colspan="2">�Ա�: <?=$data_ac['cost_in_date1']?>�� <?=$data_ac['cost_in_date2']?>�� <?=$data_ac['cost_in_date3']?>�� <?=$data_ac['cost_in']?>��  <br>�۱�: <?=$data_ac['cost_out_date1']?>�� <?=$data_ac['cost_out_date2']?>�� <?=$data_ac['cost_out_date3']?>�� <?=number_format($data_ac['cost_out'])?>��</td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">ȯ����</td>
		<td colspan="2"><?=$data_ac['exch_date1']?>�� <?=$data_ac['exch_date2']?>�� <?=$data_ac['exch_date3']?>�� <?=number_format($data_ac['exchange'])?>��</td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">�۱ݼ�����</td>
		<td colspan="2"><?=$data_ac['ba_fee_date1']?>�� <?=$data_ac['ba_fee_date2']?>�� <?=$data_ac['ba_fee_date3']?>�� <?=number_format($data_ac['bank_fee'])?>��</td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">�к���</td>
		<td colspan="2"><?=$data_ac['comm_date1']?>�� <?=$data_ac['comm_date2']?>�� <?=$data_ac['comm_date3']?>�� <?=number_format($data_ac['comm'])?>��</td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">���ξ�</td>
		<td colspan="2"><?=$data_ac['sale_date1']?>�� <?=$data_ac['sale_date2']?>�� <?=$data_ac['sale_date3']?>�� <?=number_format($data_ac['sale'])?></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">�Ľ���</td>
		<td colspan="2"><?=$data_ac['co_sh1_date1']?>�� <?=$data_ac['co_sh1_date2']?>�� <?=$data['co_sh1_date3']?>�� <?=number_format($data_ac['comm_share1'])?>�� <br><?=$data_ac['co_sh2_date1']?>�� <?=$data_ac['co_sh2_date2']?>�� <?=$data_ac['co_sh2_date3']?>�� <?=number_format($data_ac['comm_share2'])?></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">�װ���</td>
		<td colspan="2"><?=$data_ac['air_date1']?>�� <?=$data_ac['air_date2']?>�� <?=$data_ac['air_date3']?>�� <?=number_format($data_ac['air_comm'])?>�� (ex.3500000, ','���� ���ڸ� �����ϼ���) </td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>		
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">������</td>
		<td colspan="2"> <?=$data_ac['insu_date1']?>�� <?=$data_ac['insu_date2']?>�� <?=$data_ac['insu_date3']?>�� <?=number_format($data_ac['insu_comm'])?></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">��Ÿ��</td>
		<td colspan="2"><?=$data_ac['etc_date1']?>�� <?=$data_ac['etc_date2']?>�� <?=$data_ac['etc_date3']?>�� <?=number_format($data_ac['etc_comm'])?>��  </td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="2" colspan="3"></td>
    </tr>	
    <tr>
	    <td height="30" colspan="3"></td>
    </tr>	
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	
<? for ($i=1; $i<=10; $i++){?>
   <tr>
    <td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>����<?=$i?></strong></td>
	<td colspan="2" class="a_s_text_title">      
<?if($data[school_file1_name]){?>
<a href="../data/student_file/<?=$data[school_file.$i._name]?>"><?=$data[school_file.$i._name]?></a><?}?>
	</td>
  </tr>
<?}?>
</table>
  <table border="0" cellpadding="0" cellspacing="0" width="800" align=center>
	<tr>
		<td bgcolor="#FFFFFF" height="8"></td>
	</tr> 	
	<tr>
		<td bgcolor="#666666" height="2"></td>
	</tr> 
  </table>

  </td>
  </tr>
</table>

<? include("admin.footer.php"); ?>
<? include("_footer.php"); ?>