<? if (!defined('RGBOARD_VERSION')) exit; ?>
<?
	if(!$_bbs_auth['secret']) $rs_list->add_where("bd_secret = 0");
?>