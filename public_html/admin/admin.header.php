<table width="995" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td colspan="3">
       <table width="995" border="0" cellspacing="0" cellpadding="0">
         <tr> 
          <td><img src="images/admin_top_top_bg.gif" width="995" height="12"></td>
         </tr>
         <tr> 
	      <td align="center" background="images/admin_top_middle_bg.gif">
            <table width="980" border="0" align="center" cellpadding="0" cellspacing="0">
             <tr>
               <td width="160"><a href="./"><img src="images/top_logo.gif" width="160" height="35" border="0"></a></td>
               <td width="5">&nbsp;</td>
               <td width="112"><a href="../" target="_blank"><img src="images/admin-home.gif" width="112" height="35" border="0"></a></td>
               <td width="242"><a href="../admin/logout.php"><img src="images/admin-logout.gif" width="242" height="35" border="0"></a></td>
               <td align="right" class="tt12">[���Ӿ��̵�: <?=$_mb['mb_id']?>] &nbsp;[�����ڷ���: <?=$_level_info[$_mb['mb_level']]?>]</td>
             </tr>
            </table>
	      </td>
         </tr>
         <tr> 
           <td><img src="images/admin_top_bottom_bg.gif" width="995" height="12"></td>
         </tr>
       </table>
	 </td>
  </tr>
  <tr> 
    <td height="5" colspan="3"></td>
  </tr>
  <tr>
    <td><img src="images/admin_left_top_bg.gif" width="160" height="30"></td>
    <td>&nbsp;</td>
    <td valign="top"><img src="images/admin_main_top_bg.gif" width="830" height="30"></td>
  </tr>
  <tr> 
    <td valign="top" background="images/admin_left_middle_bg.gif" style="padding:0pt 0pt 0pt 4pt">
		   <form name="submenu" method="post" action="" id="submenu" style="margin:0px">	
              <DIV ID="mTree" style='display:;'> 
                <script LANGUAGE="javascript">
				  var curkey = "root";
				  var mspr = "0";
				  RootTree = gFldr("&nbsp;<b>�޴�����</b>",  "", "../images/icon_board.gif", "../images/icon_board.gif","root");

				  //����������
				  mFolder = insFldr(RootTree, gFldr("&nbsp;<b>�⺻������</b>", "","../images/admin_log.gif", "../images/admin_log.gif", "Folder"));
				  insDoc(mFolder, gLnk(1, "&nbsp;�⺻������", "../admin/index.php", "../images/submenu.gif", "Node"));
				  
				  //ȸ������
				  mFolder = insFldr(RootTree, gFldr("&nbsp;<b>ȯ�漳��</b>", "","../images/admin_log.gif", "../images/admin_log.gif", "Folder"));
				  insDoc(mFolder, gLnk(1, "&nbsp;�⺻����", "../admin/site_setup.php", "../images/submenu.gif", "Node"));
				  
				  //��������
				  mFolder = insFldr(RootTree, gFldr("&nbsp;<b>��������</b>", "","../images/icon_board.gif", "../images/icon_board.gif", "Folder"));
				  insDoc(mFolder, gLnk(1, "&nbsp;��������", "../admin/working_list.php", "../images/submenu.gif", "Node"));	
				  insDoc(mFolder, gLnk(1, "&nbsp;��������", "../admin/person_check_list.php", "../images/submenu.gif", "Node"));	


				  //����������
				  mFolder = insFldr(RootTree, gFldr("&nbsp;<b>����������</b>", "","../images/icon_board.gif", "../images/icon_board.gif", "Folder"));
				  insDoc(mFolder, gLnk(1, "&nbsp;����������", "../admin/hp_site_list.php", "../images/submenu.gif", "Node"));	
				  insDoc(mFolder, gLnk(1, "&nbsp;�Խ��ǰ���", "../admin/bbs_list.php", "../images/submenu.gif", "Node"));	

				  //�б�����
				  mFolder = insFldr(RootTree, gFldr("&nbsp;<b>�б�����</b>", "","../images/icon_approve.gif", "../images/icon_approve.gif", "Folder"));
				  insDoc(mFolder, gLnk(1, "&nbsp;���п���", "../admin/school_list.php", "../images/submenu.gif", "Node"));
				  insDoc(mFolder, gLnk(1, "&nbsp;ķ��", "../admin/camp_list.php", "../images/submenu.gif", "Node"));		
				  insDoc(mFolder, gLnk(1, "&nbsp;�ִϾ�/��������", "../admin/ju_school_list.php", "../images/submenu.gif", "Node"));		
				  insDoc(mFolder, gLnk(1, "&nbsp;����/��������", "../admin/young_list.php", "../images/submenu.gif", "Node"));	
				  insDoc(mFolder, gLnk(1, "&nbsp;���Ͻ�", "../admin/intern_list.php", "../images/submenu.gif", "Node"));	
				  
				  //����/������				  
				  mFolder = insFldr(RootTree, gFldr("&nbsp;<b>����/������</b>", "","../images/icon_board.gif", "../images/icon_board.gif", "Folder"));
				  insDoc(mFolder, gLnk(1, "&nbsp;���޹���", "../admin/consult_list.php", "../images/submenu.gif", "Node"));
				  insDoc(mFolder, gLnk(1, "&nbsp;������", "../admin/ad_list.php", "../images/submenu.gif", "Node"));	
				  
                  //ȸ������/���
				  mFolder = insFldr(RootTree, gFldr("&nbsp;<b>ȸ��/������</b>", "","../images/icon_board.gif", "../images/icon_board.gif", "Folder"));
				  insDoc(mFolder, gLnk(1, "&nbsp;������", "../admin/cafe_member_list.php", "../images/submenu.gif", "Node"));				  
				  insDoc(mFolder, gLnk(1, "&nbsp;Ȩ�ǿ¶��ν�û", "../admin/pre_regi_list.php", "../images/submenu.gif", "Node"));					 
				  insDoc(mFolder, gLnk(1, "&nbsp;SMS���", "../admin/sms_mtm_list.php", "../images/submenu.gif", "Node"));			
				  insDoc(mFolder, gLnk(1, "&nbsp;1:1����������", "../admin/consult_list.php", "../images/submenu.gif", "Node"));		 insDoc(mFolder, gLnk(1, "&nbsp;ī��¶��ν�û", "../admin/cafe_online_list.php", "../images/submenu.gif", "Node"));  
				  insDoc(mFolder, gLnk(1, "&nbsp;Ȩ��ȸ������", "../admin/member_list.php", "../images/submenu.gif", "Node"));				  
				  
				  ///���Ӱ���
				  mFolder = insFldr(RootTree, gFldr("&nbsp;<b>����/���</b>", "","../images/icon_approve.gif", "../images/icon_approve.gif", "Folder"));
				  insDoc(mFolder, gLnk(1, "&nbsp;����ڰ���", "../admin/regi_list.php", "../images/submenu.gif", "Node"));	
				  //insDoc(mFolder, gLnk(1, "&nbsp;�ⱹ�ڰ���", "../admin/abroad_student_list.php", "../images/submenu.gif", "Node"));	
				  insDoc(mFolder, gLnk(1, "&nbsp;���μ�����Ȳ", "../admin/main_regi.php", "../images/submenu.gif", "Node"));
				  insDoc(mFolder, gLnk(1, "&nbsp;���ξ˸�", "../admin/main_alim.php", "../images/submenu.gif", "Node"));
				  //�����������
				  mFolder = insFldr(RootTree, gFldr("&nbsp;<b>ȸ��/������</b>", "","../images/icon_board.gif", "../images/icon_board.gif", "Folder"));
				  insDoc(mFolder, gLnk(1, "&nbsp;����� ����", "../admin/bank_note.php", "../images/submenu.gif", "Node"));				 
				  insDoc(mFolder, gLnk(1, "&nbsp;���Ӱ��ó���", "../admin/regi_bank_note.php", "../images/submenu.gif", "Node"));	
				  insDoc(mFolder, gLnk(1, "&nbsp;�������", "../admin/regi_list2.php", "../images/submenu.gif", "Node"));	
				  insDoc(mFolder, gLnk(1, "&nbsp;�б������", "../admin/regi_list3.php", "../images/submenu.gif", "Node"));	
				  //�������
				  mFolder = insFldr(RootTree, gFldr("&nbsp;<b>�������</b>", "","../images/icon_admin.gif", "../images/icon_admin.gif", "Folder"));
				  insDoc(mFolder, gLnk(1, "&nbsp;�������Ȯ��", "../admin/counter.php", "../images/submenu.gif", "Node"));
				  
				  initializeDocument();
				  </script>
              </div>
		   </form>
    </td>
    <td>&nbsp;</td>
    <td valign="top" background="images/admin_main_middle_bg.gif">
