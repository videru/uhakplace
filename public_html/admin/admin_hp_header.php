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
               <td align="right" class="tt12">[접속아이디: <?=$_mb['mb_id']?>] &nbsp;[관리자레벨: <?=$_level_info[$_mb['mb_level']]?>]</td>
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
				  RootTree = gFldr("&nbsp;<b>메뉴선택</b>",  "", "../images/icon_board.gif", "../images/icon_board.gif","root");

				  //관리자정보
				  mFolder = insFldr(RootTree, gFldr("&nbsp;<b>기본페이지</b>", "","../images/admin_log.gif", "../images/admin_log.gif", "Folder"));
				  insDoc(mFolder, gLnk(1, "&nbsp;기본페이지", "../rg4_admin/index.php", "../../images/submenu.gif", "Node"));
				  
				  //회원관리
				  mFolder = insFldr(RootTree, gFldr("&nbsp;<b>환경설정</b>", "","../images/admin_log.gif", "../images/admin_log.gif", "Folder"));
				  insDoc(mFolder, gLnk(1, "&nbsp;기본정보", "../rg4_admin/site_setup.php", "../../images/submenu.gif", "Node"));
				  
				  //업무관리
				  mFolder = insFldr(RootTree, gFldr("&nbsp;<b>업무일지</b>", "","../images/icon_board.gif", "../images/icon_board.gif", "Folder"));
				  insDoc(mFolder, gLnk(1, "&nbsp;업무일지", "../rg4_admin/working_list.php", "../../images/submenu.gif", "Node"));	
				  insDoc(mFolder, gLnk(1, "&nbsp;일정관리", "../rg4_admin/person_check_list.php", "../../images/submenu.gif", "Node"));	
				  insDoc(mFolder, gLnk(1, "&nbsp;자료업로드", "../rg4_board/list.php?bbs_code=working_data", "../../images/submenu.gif", "Node"));	
				  insDoc(mFolder, gLnk(1, "&nbsp;업무협조", "../rg4_board/list.php?bbs_code=working_support", "../../images/submenu.gif", "Node"));	

				  //학교관리
				  mFolder = insFldr(RootTree, gFldr("&nbsp;<b>학교관리</b>", "","../images/icon_approve.gif", "../images/icon_approve.gif", "Folder"));
				  insDoc(mFolder, gLnk(1, "&nbsp;학교관리", "../rg4_admin/school_list.php", "../../images/submenu.gif", "Node"));
				 
				  //제휴/광고문의				  
				  mFolder = insFldr(RootTree, gFldr("&nbsp;<b>제휴/광고문의</b>", "","../images/icon_board.gif", "../images/icon_board.gif", "Folder"));
				  insDoc(mFolder, gLnk(1, "&nbsp;제휴문의", "../rg4_admin/consult_list.php", "../../images/submenu.gif", "Node"));
				  insDoc(mFolder, gLnk(1, "&nbsp;광고문의", "../rg4_admin/ad_list.php", "../../images/submenu.gif", "Node"));	
				  
                  //회원관리
				  mFolder = insFldr(RootTree, gFldr("&nbsp;<b>회원관리</b>", "","../images/icon_board.gif", "../images/icon_board.gif", "Folder"));
				  insDoc(mFolder, gLnk(1, "&nbsp;회원관리", "../rg4_admin/member_list.php", "../../images/submenu.gif", "Node"));	

				  //상담/수속관리
				  mFolder = insFldr(RootTree, gFldr("&nbsp;<b>상담/등록</b>", "","../images/icon_approve.gif", "../images/icon_approve.gif", "Folder"));
				  insDoc(mFolder, gLnk(1, "&nbsp;상담예약", "../rg4_admin/pre_regi_list.php", "../../images/submenu.gif", "Node"));	
				  insDoc(mFolder, gLnk(1, "&nbsp;상담/수속관리", "../rg4_admin/regi_list.php", "../../images/submenu.gif", "Node"));	
				  insDoc(mFolder, gLnk(1, "&nbsp;출국자관리", "../rg4_admin/abroad_student_list.php", "../../images/submenu.gif", "Node"));	
				  insDoc(mFolder, gLnk(1, "&nbsp;캠프등록현황", "../rg4_admin/camp_regi_list.php", "../../images/submenu.gif", "Node"));	
				  insDoc(mFolder, gLnk(1, "&nbsp;메인수속현황", "../rg4_admin/real_regi_edit.php", "../../images/submenu.gif", "Node"));

				  //설문조사관리
				  mFolder = insFldr(RootTree, gFldr("&nbsp;<b>회계관리</b>", "","../images/icon_board.gif", "../images/icon_board.gif", "Folder"));
				  insDoc(mFolder, gLnk(1, "&nbsp;전체내역", "../rg4_admin/bank_note.php", "../../images/submenu.gif", "Node"));				 
				  insDoc(mFolder, gLnk(1, "&nbsp;수속관련내역", "../rg4_admin/regi_bank_note.php", "../../images/submenu.gif", "Node"));	

				  //접속통계
				  mFolder = insFldr(RootTree, gFldr("&nbsp;<b>접속통계</b>", "","../images/icon_admin.gif", "../../images/icon_admin.gif", "Folder"));
				  insDoc(mFolder, gLnk(1, "&nbsp;접속통계확인", "../rg4_admin/counter.php", "../../images/submenu.gif", "Node"));
				  
				  initializeDocument();
				  </script>
              </div>
		   </form>
    </td>
    <td>&nbsp;</td>
    <td valign="top" background="../rg4_admin/images/admin_main_middle_bg.gif">
	 <table border="0" cellpadding="0" cellspacing="0" width="800" align="center">
  <?if($bbs_code=="working_data"){
	  $bbs_name = "주요자료업데이트";
	}elseif($bbs_code=="working_support"){
      $bbs_name = "업무협조";
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
