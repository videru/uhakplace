<?
	include_once("../include/lib.php");
	require_once("admin_chk.php");
	

	if($mode=='modify' || $mode=='delete') {
		$rs->clear();
		$rs->set_table(	$_table['cafe_member']);
		$rs->add_where("num=$num");
		$rs->select();
		if($rs->num_rows()!=1) { // ������ �ùٸ��� �ʴٸ�
			rg_href('','������ ã���� �����ϴ�.','back');
		}
		$data=$rs->fetch();		

	} else {
		$data=$rs->fetch();		
	}
	

	if ($data[national]=="1") {
     $ss_list = $_const['area1']; // ��������
    }elseif($data[national]=="2") {
     $ss_list = $_const['area2']; // ��Ÿ����
	}elseif($data[national]=="3") {
     $ss_list = $_const['area3']; //�̱�����
    }elseif($data[national]=="4") {
     $ss_list = $_const['area4']; // ��������
    }elseif($data[national]=="5") {
     $ss_list = $_const['area5']; // �Ϻ�����
	}



   $MENU_L='m5';
?>
<script language="JavaScript" type="text/JavaScript">
<!--		              
function change(fr) {
  if (fr.value == "") {    
  }
  else  {
   if  ("<?=$mode?>" == "modify") {    
	location.href = "?<?=$_get_param[3]?>&mode=modify&num=<?=$num?>&national="+fr.value;
   } else {
	location.href = "?<?=$_get_param[3]?>&mode=new&national="+fr.value;
   }
  }
}

//-->
</script>
<? include("_header.php"); ?>
<? include("admin.header.php"); ?>
<table border="0" cellpadding="0" cellspacing="0" width="800" align="center">
  <tr height="40">
    <td background="images/title_bg.gif" style="padding:9pt 0pt 0pt 10pt" valign="top"><font color=#000000><b>ī��ȸ������</b></font></td>
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
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">�����</td>
		<td colspan="2"><?=rg_date($data[regi_date])?></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	   
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">����</td>
		<td colspan="2"><?=$_const['national'][$data[national]]?></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">����</td>
		<td colspan="2"><?=$ss_list[$data['area']]?></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	
	<tr>
		<td width="110" bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">���Ӵ����</td>
		<td colspan="2">
         <?       
	    $rs_list = new $rs_class($dbcon);
	    $rs_list->clear();
	    $rs_list->set_table($_table['member']);
        $rs_list->add_where("mb_num = $data[consult]");	
        $cmdata=$rs_list->fetch();	
		?>
        <?=$cmdata[mb_name]?></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	
	<tr>
		<td width="110" bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">�̸�</td>
		<td colspan="2"><?=$data['name']?> (�г���: <?=$data['nick']?>)</td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>		
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">���</td>
		<td colspan="2"><?=$_const['root'][$data['root']]?></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">��ȭ��ȣ</td>
		<td colspan="2"><?=$_const['tel'][$data['tel1']]?>-<?=$data['tel2']?>-<?=$data['tel3']?></td>
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
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">�޽���</td>
		<td colspan="2"><?=$data['msn']?></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">�������</td>
		<td colspan="2"><?=$data['addr']?></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">�ⱹ������</td>
		<td colspan="2"><?=$data['abroad_date']?></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">�ñ�����</td>
		<td colspan="2"><?=$data['etc']?></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">�����Ȳ</td>
		<td colspan="2"><?=$_reserv['regi_state'][$data['regi_state']]?>
		</select></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	
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
<br>
 <?if($mode=='modify'){?>
<table width=800 border=1 align="center" cellpadding=0 cellspacing=0 bordercolorlight="#E1E1E1" bordercolordark="white">
  <tr>
     <td colspan="2" bgcolor="#F7F7F7"><div align="center">�л�����</div></td>
   </tr>
 <?
	    $rs_comment = new $rs_class($dbcon);
	    $rs_comment->clear();
	    $rs_comment->set_table($_table['ca_mem_comm']);
        $rs_comment->add_where("cmt_num = '$num'");	
		$rs_comment->add_order("num DESC");
	    while($cdata=$rs_comment->fetch()) {		
		$cmt_reg_date = rg_date($cdata[cmt_reg_date]);		
?> <tr> 
        <td width="19%" bgcolor="#FFFFFF" class=bbs style='padding:3px; padding-left:10px; padding-right:10px;'> 
          [<?=$cmt_reg_date?>]<br>
          <?=$cdata[cmt_name]?>
          </td>
        <td bgcolor="#FFFFFF" class=bbs style='padding:3px; padding-left:10px; padding-right:10px;'>
          <?=$cdata[cmt_comment]?> &nbsp;&nbsp; 
		  <a href="./ca_mem_comm_edit.php?&page_no=<?=$page?>&mode=delete&num=<?=$cdata[num]?>&cmt_num=<?=$num?>"><img src="./images/c_del.gif" alt="����" border="0"></a> <br> <div align="right"></div></td>
      </tr> <? }?>
    </table>
   <table width=800 border=1 align="center" cellpadding=0 cellspacing=0 bordercolorlight="#E1E1E1" bordercolordark="white">
<form name=form_comment method=post action='ca_mem_comm_edit.php' autocomplete=off>
<input type=hidden name=cmt_num value='<?=$num?>'>
<input type=hidden name=cmt_name value='<?=$_mb[mb_name]?>'>
<input type=hidden name=page_no value='<?=$page?>'>
          <tr>             
          <td bgcolor="#FFFFFF" align="center"><textarea rows=2 name=cmt_comment class=textarea style='width:97%' required itemname='�ڸ�Ʈ����' style='border-width:1; border-color:rgb(136,136,136); border-style:solid;'></textarea>
           </td>
            <td width="80" height="100%" bgcolor="#FFFFFF"><input type=submit value='  �� ��  ' style="font-style:normal; font-size:12px; color:white; background-color:#404040; border-width:1px; border-color:rgb(221,221,221); border-style:solid; height:100%;width:100%"></td></tr> 
         </form>
	    </table>  					
    </tr>
    </table>
<?}?>
<? include("admin.footer.php"); ?>
<? include("_footer.php"); ?>