<!--공지사항 시작-->
<div id="notice" style="width:287px; position:absolute; z-index:1; visibility:visible;">	
<table width="287" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td>
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
         <tr> 			
	      <td width="73" ><a href="/board/list.php?&bbs_code=ju_event"><img src="./img/main_list_t1on.gif" ></a></td>
	      <td width="2" ></td>
          <td width="105" ><img src="./img/main_list_t2.gif" onMouseOver="MM_showHideLayers('notice','','hide','qna','','show','yensu','','hide')"></td>
	      <td width="2" ></td>
          <td width="105" ><img src="./img/main_list_t3.gif" onMouseOver="MM_showHideLayers('notice','','hide','qna','','hide','yensu','','show')"></td>
        </tr>
      </table>
    </td>
  </tr> 
  <tr height="11"> 
    <td> </td>  
  </tr>  
  <tr> 
    <td valign="top" >
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
         <tr> 			
	      <td width="80" ><img src="./img/mino.jpg"></td>
		  <td ><?=rg_lastest('ju_event','new_last',4,26,'..','',$order='bd_next_num desc')?></td>
        </tr>
      </table>
	</td>
  </tr>
</table>
</div>
<!--공지사항끝 -->

<!--q&a 시작-->
<div id="qna" style="width:287px;  position:absolute; z-index:2; visibility:hidden;">	
<table width="287" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td>
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
         <tr> 			
	      <td width="73" ><img src="./img/main_list_t1.gif" onMouseOver="MM_showHideLayers('notice','','show','qna','','hide','yensu','','hide')"></td>
	      <td width="2" ></td>
		  <td width="105" ><a href="/board/list.php?&bbs_code=ju_qna"><img src="./img/main_list_t2on.gif"  border="0"></a></td>
	      <td width="2" ></td>     
		  <td width="105" ><img src="./img/main_list_t3.gif" onMouseOver="MM_showHideLayers('notice','','hide','qna','','hide','yensu','','show')"></td>
        </tr>
      </table>
    </td>
  </tr> 
  <tr height="11"> 
    <td> </td>  
  </tr> 
  <tr > 
    <td valign="top" >
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
         <tr> 			
	      <td width="80" ><img src="./img/mino.jpg"></td>
		  <td ><?=rg_lastest('ju_qna','new_last',4,26,'..','',$order='bd_next_num desc')?></td>
        </tr>
      </table>	
	</td>
  </tr>
</table>
</div>
<!--q&a 끝 -->

<!--연수후기 시작-->
<div id="yensu" style="width:287px; ; position:absolute; z-index:3; visibility:hidden;">	
<table width="287" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td>
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
         <tr> 			
	      <td width="73"><img src="./img/main_list_t1.gif" onMouseOver="MM_showHideLayers('notice','','show','qna','','hide','yensu','','hide')"></td>
	      <td width="2" ></td>    
		  <td width="105"><img src="./img/main_list_t2.gif" onMouseOver="MM_showHideLayers('notice','','hide','qna','','show','yensu','','hide')"></td>
	      <td width="2" ></td>      
		  <td width="105"><a href="/board/list.php?&bbs_code=ju_faq"><img src="./img/main_list_t3on.gif"  border="0"></a></td>
        </tr>
      </table>
    </td>
  </tr> 
  <tr height="11"> 
    <td> </td>  
  </tr> 
  <tr> 
    <td valign="top" >
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
         <tr> 			
	      <td width="80" ><img src="./img/mino.jpg"></td>
		  <td ><?=rg_lastest('ju_faq','new_last',4,26,'..','',$order='bd_next_num desc')?></td>
        </tr>
      </table>	
	</td>
  </tr>
</table>
</div>
<!--연수후기 끝 -->