<?
/* =====================================================

  ���������� : 
 ===================================================== */
if (!defined('ADMIN_CHK_INCLUDED')) {  
    define('ADMIN_CHK_INCLUDED', 1);
// *-- ADMIN_LIB_INC_INCLUDED START --*

	if(!$_mb) {
		rg_href("login.php");
	}
	
	if(!$_auth['admin']) {
		rg_href("login.php");
	}
	
	// �Ķ��Ÿ ó��
	$p_str="";
	$_get_param[0]=$p_str;

	if(is_array($ss)) {
		foreach($ss as $__k => $__v) {
			$p_str.="&ss[$__k]=".$__v;
		}
	}
	if($kw!='') $p_str.="&kw=".$kw;
	$_get_param[1]=$p_str;
	
  if($ot != '') $p_str.="&ot=".$ot;
	$_get_param[2]=$p_str;
	$_get_param[3]=$p_str."&page=$page";

} // *-- ADMIN_LIB_INC_INCLUDED END --*
?>