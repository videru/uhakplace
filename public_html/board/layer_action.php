<?
/* =====================================================

  최종수정일 : 
 ===================================================== */
	include_once("../include/lib.php");
	switch($mode) {
		case 'email' : 
			rg_href('mailto:'.base64_decode($data),'','close');
		break;
		case 'homepage' : 
			rg_href(base64_decode($data));
		break;
	}
?>