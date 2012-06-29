<?
	include_once("../include/lib.php");
    
	
    $rs_list = new $rs_class($dbcon);
	$rs_list->clear();
	$rs_list->set_table($_table['real_regi']);
            
?>
<?
	if($rs_list->num_rows()<1) {
		echo "
	<tr height=\"40\">
		<td align=\"center\"><B>등록(검색) 된 자료가 없습니다.</td>
	</tr>";
	}
	
	$rs_mb=new $rs_class($dbcon);
	$rs_mb->set_table($_table['real_regi']);	
	while($R=$rs_list->fetch()) {


?>
<link rel="stylesheet" href="../css/style.css" type="text/css">
								<script language = "javascript">
                                	var html,total_area=0,wait_flag=true;
                                	var bMouseOver = 1;
                                	var scrollspeed =1;
                                	var scrollerheight=75;
                                	var waitingtime = 2000;
                                	var scroll_content = new Array();
                                	
                                	function startscroll(){
                                		for(i in scroll_content)insert_area(total_area++); 
                                		window.setTimeout("scrolling()",waitingtime);
                                	}
                                	function scrolling(){
                                		if( bMouseOver && wait_flag ){ 
                                			for( i=0; i<total_area; i++){
                                				tmp = document.getElementById('scroll_area'+i).style;
                                				tmp.top = parseInt(tmp.top) - scrollspeed;
                                				if(parseInt(tmp.top) <= -scrollerheight){
                                					tmp.top = scrollerheight * (total_area-1);
                                					wait_flag = false;
                                					window.setTimeout("wait_flag=true;",waitingtime);
                                				}
                                			}
                                		}
                                		window.setTimeout("scrolling()",1);
                                		
                                	}
                                	function insert_area(n){
                                		html='<div style="left: 0px; width: 220; position: absolute; top: '+(scrollerheight*n)+'px" id="scroll_area'+n+'">';
                                    		html+=scroll_content[n]+'';
                                    		html+='</div>';
                                    		document.write(html);
                                	}
	
                                	
                                	scroll_content[0] = "<table width=100% cellpadding=0 cellspacing=0><tr><td colspan=2 ><a href=../phil/school_view.php?num=4&national=3 target=_parent><strong>[세부] CIA어학원</strong> <img src=../img/bs_more.gif border=0 align=absmiddle></a></td></tr><tr><td width=75><a href=../phil/school_view.php?num=4&national=3 target=_parent><img src=../img/banner/main_bs_cia.gif border=0></a></td><td><a href=../phil/school_view.php?num=4&national=3 target=_parent><span class=tt4>세부 / 업타운에 위치, SM 몰까지 도보 2분이며 교통편...</a></span></td></tr></table>";
                                	scroll_content[1] = "<table width=100% cellpadding=0 cellspacing=0><tr><td colspan=2><a href=../phil/school_view.php?num=11&national=3 target=_parent><strong>[세부] SME어학원</strong> <img src=../img/bs_more.gif border=0 align=absmiddle></a></td></tr><tr><td width=75><a href=../phil/school_view.php?num=11&national=3 target=_parent><img src=../img/banner/main_bs_sme.gif border=0></a></td><td><a href=../phil/school_view.php?num=4&national=3 target=_parent><span class=tt4>세부 / 클래식 켐퍼스는 시내 업타운에 있으며 스파르타는 탈람반에 위치.</a></span></td></tr></table>";
                                	scroll_content[2] = "<table width=100% cellpadding=0 cellspacing=0><tr><td colspan=2><a href=../phil/school_view.php?num=12&national=3 target=_parent><strong>[세부] CDU어학원</strong> <img src=../img/bs_more.gif border=0 align=absmiddle></a></td></tr><tr><td width=75><a href=../phil/school_view.php?num=12&national=3 target=_parent><img src=../img/banner/main_bs_cdu.gif border=0></a></td><td><a href=../phil/school_view.php?num=4&national=3 target=_parent><span class=tt4>세부 / Park Mall 도보 5분 거리이며 대학가이며 식당, 매점 등 많음.</a></span></td></tr></table>";
                                    scroll_content[3] = "<table width=100% cellpadding=0 cellspacing=0><tr><td colspan=2><a href=../phil/school_view.php?num=9&national=3 target=_parent><strong>[세부] MTM어학원<strong> <img src=../img/bs_more.gif border=0 align=absmiddle></a></td></tr><tr><td width=75><a href=../phil/school_view.php?num=9&national=3 target=_parent><img src=../img/banner/main_bs_mtm.gif border=0></a></td><td><a href=../phil/school_view.php?num=4&national=3 target=_parent><span class=tt4>세부 / 신상업지구에 위치하며 은행, 환전소, 식당, 대형 쇼핑몰도 있어 편리함</a></span></td></tr></table>";
									scroll_content[4] = "<table width=100% cellpadding=0 cellspacing=0><tr><td colspan=2><a href=../phil/school_view.php?num=17&national=3 target=_parent><strong>[마닐라] CNN어학원</strong> <img src=../img/bs_more.gif border=0 align=absmiddle></a></td></tr><tr><td width=75><a href=../phil/school_view.php?num=17&national=3 target=_parent><img src=../img/banner/main_bs_cnn.gif border=0></a></td><td><a href=../phil/school_view.php?num=4&national=3 target=_parent><span class=tt4>마닐라 / 교육도시인 마닐라 퀘존의 Memorial Circle 중심에 위치</a></span></td></tr></table>";
                                	scroll_content[5] = "<table width=100% cellpadding=0 cellspacing=0><tr><td colspan=2><a href=../phil/school_view.php?num=20&national=3 target=_parent><strong>[마닐라] APC어학원</strong> <img src=../img/bs_more.gif border=0 align=absmiddle></a></td></tr><tr><td width=75><a href=../phil/school_view.php?num=20&national=3 target=_parent><img src=../img/banner/main_bs_apc.gif border=0></a></td><td><a href=../phil/school_view.php?num=4&national=3 target=_parent><span class=tt4>마닐라 / 고급 주택지에 위치하고 있음(마닐라 공항까지 차량, 30분)</a></span></td></tr></table>";
                                	scroll_content[6] = "<table width=100% cellpadding=0 cellspacing=0><tr><td colspan=2><a href=../phil/school_view.php?num=19&national=3 target=_parent><strong>[마닐라] C21어학원</strong> <img src=../img/bs_more.gif border=0 align=absmiddle></a></td></tr><tr><td width=75><a href=../phil/school_view.php?num=19&national=3 target=_parent><img src=../img/banner/main_bs_c21.gif border=0></a></td><td><a href=../phil/school_view.php?num=4&national=3 target=_parent><span class=tt4>C21 어학 연수원은 Century21의 약자이며 1999년 개교 이래 많은 학...</a></span></td></tr></table>";
                                    scroll_content[7] = "<table width=100% cellpadding=0 cellspacing=0><tr><td colspan=2><a href=../phil/school_view.php?num=25&national=3 target=_parent><strong>[바콜로드] 제이슨어학원</strong> <img src=../img/bs_more.gif border=0 align=absmiddle></a></td></tr><tr><td width=75><a href=../phil/school_view.php?num=25&national=3 target=_parent><img src=../img/banner/main_bs_jels.gif border=0></a></td><td><a href=../phil/school_view.php?num=4&national=3 target=_parent><span class=tt4>소수 운영인 이 학교는 저렴한 비용과 1대1 수업...</a></span></td></tr></table>";
									scroll_content[8] = "<table width=100% cellpadding=0 cellspacing=0><tr><td colspan=2><a href=../phil/school_view.php?num=21&national=3 target=_parent><strong>[바기오] 헬프어학원</strong> <img src=../img/bs_more.gif border=0 align=absmiddle></a></td></tr><tr><td width=75><a href=../phil/school_view.php?num=21&national=3 target=_parent><img src=../img/banner/main_bs_help.gif border=0></a></td><td><a href=../phil/school_view.php?num=4&national=3 target=_parent><span class=tt4>필리핀에서 최초로 스파르타 시스템 커리큘럼을 도입한 어학원으로...</a></span></td></tr></table>";
                                	scroll_content[9] = "<table width=100% cellpadding=0 cellspacing=0><tr><td colspan=2><a href=../phil/school_view.php?num=23&national=3 target=_parent><strong>[바기오] 모놀어학원</strong> <img src=../img/bs_more.gif border=0 align=absmiddle></a></td></tr><tr><td width=75><a href=../phil/school_view.php?num=23&national=3 target=_parent><img src=../img/banner/main_bs_monol.gif border=0></a></td><td><a href=../phil/school_view.php?num=4&national=3 target=_parent><span class=tt4>4차원 스파르타커리큘럼으로 관리되는 이 어학원은 자체 교재를...</a></span></td></tr></table>";					
								</script>
                                
                                	<span style="width: 220; position: relative; height=100%" id="main2">
                                    <div style="left: 0px; width: 220; clip: rect(0px 220 450px 0px); position: absolute; top: 0px; height: 450px" onMouseover="bMouseOver=0" onMouseout="bMouseOver=1" id="scroll_image">                               
									  
									  
									  <script>
                                        startscroll();
                                      </script>
                                    </div>
                                  </span>
  	<?
	}
	?>
