<table width="995" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td colspan="3">
       <table width="995" border="0" cellspacing="0" cellpadding="0">
         <tr> 
          <td><img src="../rg4_admin/images/admin_top_top_bg.gif" width="995" height="12"></td>
         </tr>
         <tr> 
	      <td align="center" background="../rg4_admin/images/admin_top_middle_bg.gif">
            <table width="980" border="0" align="center" cellpadding="0" cellspacing="0">
             <tr>
               <td width="160"><a href="../rg4_admin/"><img src="../rg4_admin/images/top_logo.gif" width="160" height="35" border="0"></a></td>
               <td width="5">&nbsp;</td>
               <td width="112"><a href="../" target="_blank"><img src="../rg4_admin/images/admin-home.gif" width="112" height="35" border="0"></a></td>
               <td width="242"><a href="../rg4_admin/logout.php"><img src="../rg4_admin/images/admin-logout.gif" width="242" height="35" border="0"></a></td>
               <td align="right" class="tt12">[���Ӿ��̵�: <?=$_mb['mb_id']?>] &nbsp;[�����ڷ���: <?=$_level_info[$_mb['mb_level']]?>]</td>
             </tr>
            </table>
	      </td>
         </tr>
         <tr> 
           <td><img src="../rg4_admin/images/admin_top_bottom_bg.gif" width="995" height="12"></td>
         </tr>
       </table>
	 </td>
  </tr>
  <tr> 
    <td height="5" colspan="3"></td>
  </tr>
  <tr>
    <td><img src="../rg4_admin/images/admin_left_top_bg.gif" width="160" height="30"></td>
    <td>&nbsp;</td>
    <td valign="top"><img src="../rg4_admin/images/admin_main_top_bg.gif" width="830" height="30"></td>
  </tr>
  <tr> 
    <td valign="top" background="../rg4_admin/images/admin_left_middle_bg.gif" style="padding:0pt 0pt 0pt 4pt">
		   <form name="submenu" method="post" action="" id="submenu" style="margin:0px">	
              <DIV ID="mTree" style='display:;'> 
                <script LANGUAGE="javascript">
				  var curkey = "root";
				  var mspr = "0";
				  RootTree = gFldr("&nbsp;<b>�޴�����</b>",  "", "../images/icon_board.gif", "../images/icon_board.gif","root");

				  //����������
				  mFolder = insFldr(RootTree, gFldr("&nbsp;<b>�⺻������</b>", "","../images/admin_log.gif", "../images/admin_log.gif", "Folder"));
				  insDoc(mFolder, gLnk(1, "&nbsp;�⺻������", "../rg4_admin/index.php", "../../images/submenu.gif", "Node"));
				  
				  //ȸ������
				  mFolder = insFldr(RootTree, gFldr("&nbsp;<b>ȯ�漳��</b>", "","../images/admin_log.gif", "../images/admin_log.gif", "Folder"));
				  insDoc(mFolder, gLnk(1, "&nbsp;�⺻����", "../rg4_admin/site_setup.php", "../../images/submenu.gif", "Node"));
				  
				  //��������
				  mFolder = insFldr(RootTree, gFldr("&nbsp;<b>��������</b>", "","../images/icon_board.gif", "../images/icon_board.gif", "Folder"));
				  insDoc(mFolder, gLnk(1, "&nbsp;��������", "../rg4_admin/working_list.php", "../../images/submenu.gif", "Node"));	
				  insDoc(mFolder, gLnk(1, "&nbsp;��������", "../rg4_admin/person_check_list.php", "../../images/submenu.gif", "Node"));	
				  insDoc(mFolder, gLnk(1, "&nbsp;�ڷ���ε�", "../rg4_board/list.php?bbs_code=working_data", "../../images/submenu.gif", "Node"));	
				  insDoc(mFolder, gLnk(1, "&nbsp;��������", "../rg4_board/list.php?bbs_code=working_support", "../../images/submenu.gif", "Node"));	

				  //�б�����
				  mFolder = insFldr(RootTree, gFldr("&nbsp;<b>�б�����</b>", "","../images/icon_approve.gif", "../images/icon_approve.gif", "Folder"));
				  insDoc(mFolder, gLnk(1, "&nbsp;�б�����", "../rg4_admin/school_list.php", "../../images/submenu.gif", "Node"));
				 
				  //����/������				  
				  mFolder = insFldr(RootTree, gFldr("&nbsp;<b>����/������</b>", "","../images/icon_board.gif", "../images/icon_board.gif", "Folder"));
				  insDoc(mFolder, gLnk(1, "&nbsp;���޹���", "../rg4_admin/consult_list.php", "../../images/submenu.gif", "Node"));
				  insDoc(mFolder, gLnk(1, "&nbsp;������", "../rg4_admin/ad_list.php", "../../images/submenu.gif", "Node"));	
				  
                  //ȸ������
				  mFolder = insFldr(RootTree, gFldr("&nbsp;<b>ȸ������</b>", "","../images/icon_board.gif", "../images/icon_board.gif", "Folder"));
				  insDoc(mFolder, gLnk(1, "&nbsp;ȸ������", "../rg4_admin/member_list.php", "../../images/submenu.gif", "Node"));	

				  //���/���Ӱ���
				  mFolder = insFldr(RootTree, gFldr("&nbsp;<b>���/���</b>", "","../images/icon_approve.gif", "../images/icon_approve.gif", "Folder"));
				  insDoc(mFolder, gLnk(1, "&nbsp;��㿹��", "../rg4_admin/pre_regi_list.php", "../../images/submenu.gif", "Node"));	
				  insDoc(mFolder, gLnk(1, "&nbsp;���/���Ӱ���", "../rg4_admin/regi_list.php", "../../images/submenu.gif", "Node"));	
				  insDoc(mFolder, gLnk(1, "&nbsp;�ⱹ�ڰ���", "../rg4_admin/abroad_student_list.php", "../../images/submenu.gif", "Node"));	
				  insDoc(mFolder, gLnk(1, "&nbsp;ķ�������Ȳ", "../rg4_admin/camp_regi_list.php", "../../images/submenu.gif", "Node"));	
				  insDoc(mFolder, gLnk(1, "&nbsp;���μ�����Ȳ", "../rg4_admin/real_regi_edit.php", "../../images/submenu.gif", "Node"));

				  //�����������
				  mFolder = insFldr(RootTree, gFldr("&nbsp;<b>ȸ�����</b>", "","../images/icon_board.gif", "../images/icon_board.gif", "Folder"));
				  insDoc(mFolder, gLnk(1, "&nbsp;��ü����", "../rg4_admin/bank_note.php", "../../images/submenu.gif", "Node"));				 
				  insDoc(mFolder, gLnk(1, "&nbsp;���Ӱ��ó���", "../rg4_admin/regi_bank_note.php", "../../images/submenu.gif", "Node"));	

				  //�������
				  mFolder = insFldr(RootTree, gFldr("&nbsp;<b>�������</b>", "","../images/icon_admin.gif", "../../images/icon_admin.gif", "Folder"));
				  insDoc(mFolder, gLnk(1, "&nbsp;�������Ȯ��", "../rg4_admin/counter.php", "../../images/submenu.gif", "Node"));
				  
				  initializeDocument();
				  </script>
              </div>
		   </form>
    </td>
    <td>&nbsp;</td>
    <td valign="top" background="../rg4_admin/images/admin_main_middle_bg.gif">
	 <table border="0" cellpadding="0" cellspacing="0" width="800" align="center">
  <?if($bbs_code=="working_data"){
	  $bbs_name = "�ֿ��ڷ������Ʈ";
	}elseif($bbs_code=="working_support"){
      $bbs_name = "��������";
	}	   
?>	   
	   <tr height="40">
         <td background="../rg4_admin/images/title_bg.gif" style="padding:9pt 0pt 0pt 10pt" valign="top"><font color=#000000><b><?=$bbs_name?></b></font></td>
       </tr>
	 </table>
     <br>
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
