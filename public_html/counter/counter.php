<?
	if(realpath($_SERVER['SCRIPT_FILENAME']) == realpath(__FILE__)) exit;
?>
<script>
var res_w = screen.width;
var res_h = screen.height;
	
if( typeof("parent.document") != "unknown" ){
	eval("try{ pre_url = parent.document.URL ;}catch(_e){ pre_url='';}");
}

if( document.referrer == pre_url ){ 
	eval("try{ ref = parent.document.referrer ;}catch(_e){ ref = '';}");
}
else{
	ref = document.referrer ; 
}
ref=escape(ref)

document.write('<img src="<?=$site_path?>counter/check.php?referrer='+ref+'&res_w='+res_w+'&res_h='+res_h+'" width="0" height="0"><br>');
</script>