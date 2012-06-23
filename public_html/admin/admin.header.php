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
               <td align="right" class="tt12">[접속아이디: <?=$_mb['mb_id']?>] &nbsp;[관리자레벨: <?=$_level_info[$_mb['mb_level']]?>]</td>
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
				  RootTree = gFldr("&nbsp;<b>메뉴선택</b>",  "", "../images/icon_board.gif", "../images/icon_board.gif","root");

				  //관리자정보
				  mFolder = insFldr(RootTree, gFldr("&nbsp;<b>기본페이지</b>", "","../images/admin_log.gif", "../images/admin_log.gif", "Folder"));
				  insDoc(mFolder, gLnk(1, "&nbsp;기본페이지", "../admin/index.php", "../images/submenu.gif", "Node"));
				  
				  //회원관리
				  mFolder = insFldr(RootTree, gFldr("&nbsp;<b>환경설정</b>", "","../images/admin_log.gif", "../images/admin_log.gif", "Folder"));
				  insDoc(mFolder, gLnk(1, "&nbsp;기본정보", "../admin/site_setup.php", "../images/submenu.gif", "Node"));
				  
				  //업무관리
				  mFolder = insFldr(RootTree, gFldr("&nbsp;<b>업무일지</b>", "","../images/icon_board.gif", "../images/icon_board.gif", "Folder"));
				  insDoc(mFolder, gLnk(1, "&nbsp;업무일지", "../admin/working_list.php", "../images/submenu.gif", "Node"));	
				  insDoc(mFolder, gLnk(1, "&nbsp;일정관리", "../admin/person_check_list.php", "../images/submenu.gif", "Node"));	


				  //페이지관리
				  mFolder = insFldr(RootTree, gFldr("&nbsp;<b>페이지관리</b>", "","../images/icon_board.gif", "../images/icon_board.gif", "Folder"));
				  insDoc(mFolder, gLnk(1, "&nbsp;페이지관리", "../admin/hp_site_list.php", "../images/submenu.gif", "Node"));	
				  insDoc(mFolder, gLnk(1, "&nbsp;게시판관리", "../admin/bbs_list.php", "../images/submenu.gif", "Node"));	

				  //학교관리
				  mFolder = insFldr(RootTree, gFldr("&nbsp;<b>학교관리</b>", "","../images/icon_approve.gif", "../images/icon_approve.gif", "Folder"));
				  insDoc(mFolder, gLnk(1, "&nbsp;어학연수", "../admin/school_list.php", "../images/submenu.gif", "Node"));
				  insDoc(mFolder, gLnk(1, "&nbsp;캠프", "../admin/camp_list.php", "../images/submenu.gif", "Node"));		
				  insDoc(mFolder, gLnk(1, "&nbsp;주니어/가족연수", "../admin/ju_school_list.php", "../images/submenu.gif", "Node"));		
				  insDoc(mFolder, gLnk(1, "&nbsp;정규/조기유학", "../admin/young_list.php", "../images/submenu.gif", "Node"));	
				  insDoc(mFolder, gLnk(1, "&nbsp;인턴쉽", "../admin/intern_list.php", "../images/submenu.gif", "Node"));	
				  
				  //제휴/광고문의				  
				  mFolder = insFldr(RootTree, gFldr("&nbsp;<b>제휴/광고문의</b>", "","../images/icon_board.gif", "../images/icon_board.gif", "Folder"));
				  insDoc(mFolder, gLnk(1, "&nbsp;제휴문의", "../admin/consult_list.php", "../images/submenu.gif", "Node"));
				  insDoc(mFolder, gLnk(1, "&nbsp;광고문의", "../admin/ad_list.php", "../images/submenu.gif", "Node"));	
				  
                  //회원관리/상담
				  mFolder = insFldr(RootTree, gFldr("&nbsp;<b>회원/상담관리</b>", "","../images/icon_board.gif", "../images/icon_board.gif", "Folder"));
				  insDoc(mFolder, gLnk(1, "&nbsp;상담관리", "../admin/cafe_member_list.php", "../images/submenu.gif", "Node"));				  
				  insDoc(mFolder, gLnk(1, "&nbsp;홈피온라인신청", "../admin/pre_regi_list.php", "../images/submenu.gif", "Node"));					 
				  insDoc(mFolder, gLnk(1, "&nbsp;SMS상담", "../admin/sms_mtm_list.php", "../images/submenu.gif", "Node"));			
				  insDoc(mFolder, gLnk(1, "&nbsp;1:1맞춤컨설팅", "../admin/consult_list.php", "../images/submenu.gif", "Node"));		 insDoc(mFolder, gLnk(1, "&nbsp;카페온라인신청", "../admin/cafe_online_list.php", "../images/submenu.gif", "Node"));  
				  insDoc(mFolder, gLnk(1, "&nbsp;홈피회원관리", "../admin/member_list.php", "../images/submenu.gif", "Node"));				  
				  
				  ///수속관리
				  mFolder = insFldr(RootTree, gFldr("&nbsp;<b>수속/등록</b>", "","../images/icon_approve.gif", "../images/icon_approve.gif", "Folder"));
				  insDoc(mFolder, gLnk(1, "&nbsp;등록자관리", "../admin/regi_list.php", "../images/submenu.gif", "Node"));	
				  //insDoc(mFolder, gLnk(1, "&nbsp;출국자관리", "../admin/abroad_student_list.php", "../images/submenu.gif", "Node"));	
				  insDoc(mFolder, gLnk(1, "&nbsp;메인수속현황", "../admin/main_regi.php", "../images/submenu.gif", "Node"));
				  insDoc(mFolder, gLnk(1, "&nbsp;메인알림", "../admin/main_alim.php", "../images/submenu.gif", "Node"));
				  //설문조사관리
				  mFolder = insFldr(RootTree, gFldr("&nbsp;<b>회계/통계관리</b>", "","../images/icon_board.gif", "../images/icon_board.gif", "Folder"));
				  insDoc(mFolder, gLnk(1, "&nbsp;입출금 내역", "../admin/bank_note.php", "../images/submenu.gif", "Node"));				 
				  insDoc(mFolder, gLnk(1, "&nbsp;수속관련내역", "../admin/regi_bank_note.php", "../images/submenu.gif", "Node"));	
				  insDoc(mFolder, gLnk(1, "&nbsp;수속통계", "../admin/regi_list2.php", "../images/submenu.gif", "Node"));	
				  insDoc(mFolder, gLnk(1, "&nbsp;학교별통계", "../admin/regi_list3.php", "../images/submenu.gif", "Node"));	
				  //접속통계
				  mFolder = insFldr(RootTree, gFldr("&nbsp;<b>접속통계</b>", "","../images/icon_admin.gif", "../images/icon_admin.gif", "Folder"));
				  insDoc(mFolder, gLnk(1, "&nbsp;접속통계확인", "../admin/counter.php", "../images/submenu.gif", "Node"));
				  
				  initializeDocument();
				  </script>
              </div>
		   </form>
    </td>
    <td>&nbsp;</td>
    <td valign="top" background="images/admin_main_middle_bg.gif">
