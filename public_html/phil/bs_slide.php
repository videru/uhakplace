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
		<td align=\"center\"><B>���(�˻�) �� �ڷᰡ �����ϴ�.</td>
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
	
                                	
                                	scroll_content[0] = "<table width=100% cellpadding=0 cellspacing=0><tr><td colspan=2 ><a href=../phil/school_view.php?num=4&national=3 target=_parent><strong>[����] CIA���п�</strong> <img src=../img/bs_more.gif border=0 align=absmiddle></a></td></tr><tr><td width=75><a href=../phil/school_view.php?num=4&national=3 target=_parent><img src=../img/banner/main_bs_cia.gif border=0></a></td><td><a href=../phil/school_view.php?num=4&national=3 target=_parent><span class=tt4>���� / ��Ÿ� ��ġ, SM ������ ���� 2���̸� ������...</a></span></td></tr></table>";
                                	scroll_content[1] = "<table width=100% cellpadding=0 cellspacing=0><tr><td colspan=2><a href=../phil/school_view.php?num=11&national=3 target=_parent><strong>[����] SME���п�</strong> <img src=../img/bs_more.gif border=0 align=absmiddle></a></td></tr><tr><td width=75><a href=../phil/school_view.php?num=11&national=3 target=_parent><img src=../img/banner/main_bs_sme.gif border=0></a></td><td><a href=../phil/school_view.php?num=4&national=3 target=_parent><span class=tt4>���� / Ŭ���� ���۽��� �ó� ��Ÿ� ������ ���ĸ�Ÿ�� Ż���ݿ� ��ġ.</a></span></td></tr></table>";
                                	scroll_content[2] = "<table width=100% cellpadding=0 cellspacing=0><tr><td colspan=2><a href=../phil/school_view.php?num=12&national=3 target=_parent><strong>[����] CDU���п�</strong> <img src=../img/bs_more.gif border=0 align=absmiddle></a></td></tr><tr><td width=75><a href=../phil/school_view.php?num=12&national=3 target=_parent><img src=../img/banner/main_bs_cdu.gif border=0></a></td><td><a href=../phil/school_view.php?num=4&national=3 target=_parent><span class=tt4>���� / Park Mall ���� 5�� �Ÿ��̸� ���а��̸� �Ĵ�, ���� �� ����.</a></span></td></tr></table>";
                                    scroll_content[3] = "<table width=100% cellpadding=0 cellspacing=0><tr><td colspan=2><a href=../phil/school_view.php?num=9&national=3 target=_parent><strong>[����] MTM���п�<strong> <img src=../img/bs_more.gif border=0 align=absmiddle></a></td></tr><tr><td width=75><a href=../phil/school_view.php?num=9&national=3 target=_parent><img src=../img/banner/main_bs_mtm.gif border=0></a></td><td><a href=../phil/school_view.php?num=4&national=3 target=_parent><span class=tt4>���� / �Ż�������� ��ġ�ϸ� ����, ȯ����, �Ĵ�, ���� ���θ��� �־� ����</a></span></td></tr></table>";
									scroll_content[4] = "<table width=100% cellpadding=0 cellspacing=0><tr><td colspan=2><a href=../phil/school_view.php?num=17&national=3 target=_parent><strong>[���Ҷ�] CNN���п�</strong> <img src=../img/bs_more.gif border=0 align=absmiddle></a></td></tr><tr><td width=75><a href=../phil/school_view.php?num=17&national=3 target=_parent><img src=../img/banner/main_bs_cnn.gif border=0></a></td><td><a href=../phil/school_view.php?num=4&national=3 target=_parent><span class=tt4>���Ҷ� / ���������� ���Ҷ� ������ Memorial Circle �߽ɿ� ��ġ</a></span></td></tr></table>";
                                	scroll_content[5] = "<table width=100% cellpadding=0 cellspacing=0><tr><td colspan=2><a href=../phil/school_view.php?num=20&national=3 target=_parent><strong>[���Ҷ�] APC���п�</strong> <img src=../img/bs_more.gif border=0 align=absmiddle></a></td></tr><tr><td width=75><a href=../phil/school_view.php?num=20&national=3 target=_parent><img src=../img/banner/main_bs_apc.gif border=0></a></td><td><a href=../phil/school_view.php?num=4&national=3 target=_parent><span class=tt4>���Ҷ� / ��� �������� ��ġ�ϰ� ����(���Ҷ� ���ױ��� ����, 30��)</a></span></td></tr></table>";
                                	scroll_content[6] = "<table width=100% cellpadding=0 cellspacing=0><tr><td colspan=2><a href=../phil/school_view.php?num=19&national=3 target=_parent><strong>[���Ҷ�] C21���п�</strong> <img src=../img/bs_more.gif border=0 align=absmiddle></a></td></tr><tr><td width=75><a href=../phil/school_view.php?num=19&national=3 target=_parent><img src=../img/banner/main_bs_c21.gif border=0></a></td><td><a href=../phil/school_view.php?num=4&national=3 target=_parent><span class=tt4>C21 ���� �������� Century21�� �����̸� 1999�� ���� �̷� ���� ��...</a></span></td></tr></table>";
                                    scroll_content[7] = "<table width=100% cellpadding=0 cellspacing=0><tr><td colspan=2><a href=../phil/school_view.php?num=25&national=3 target=_parent><strong>[���ݷε�] ���̽����п�</strong> <img src=../img/bs_more.gif border=0 align=absmiddle></a></td></tr><tr><td width=75><a href=../phil/school_view.php?num=25&national=3 target=_parent><img src=../img/banner/main_bs_jels.gif border=0></a></td><td><a href=../phil/school_view.php?num=4&national=3 target=_parent><span class=tt4>�Ҽ� ��� �� �б��� ������ ���� 1��1 ����...</a></span></td></tr></table>";
									scroll_content[8] = "<table width=100% cellpadding=0 cellspacing=0><tr><td colspan=2><a href=../phil/school_view.php?num=21&national=3 target=_parent><strong>[�ٱ��] �������п�</strong> <img src=../img/bs_more.gif border=0 align=absmiddle></a></td></tr><tr><td width=75><a href=../phil/school_view.php?num=21&national=3 target=_parent><img src=../img/banner/main_bs_help.gif border=0></a></td><td><a href=../phil/school_view.php?num=4&national=3 target=_parent><span class=tt4>�ʸ��ɿ��� ���ʷ� ���ĸ�Ÿ �ý��� Ŀ��ŧ���� ������ ���п�����...</a></span></td></tr></table>";
                                	scroll_content[9] = "<table width=100% cellpadding=0 cellspacing=0><tr><td colspan=2><a href=../phil/school_view.php?num=23&national=3 target=_parent><strong>[�ٱ��] �����п�</strong> <img src=../img/bs_more.gif border=0 align=absmiddle></a></td></tr><tr><td width=75><a href=../phil/school_view.php?num=23&national=3 target=_parent><img src=../img/banner/main_bs_monol.gif border=0></a></td><td><a href=../phil/school_view.php?num=4&national=3 target=_parent><span class=tt4>4���� ���ĸ�ŸĿ��ŧ������ �����Ǵ� �� ���п��� ��ü ���縦...</a></span></td></tr></table>";					
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
