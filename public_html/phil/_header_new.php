<? if (!defined('RGBOARD_VERSION')) exit; ?>
<script src="<?=$_url['js']?>common.js"></script>
<script src="<?=$_url['js']?>lib.validate.js"></script>
<script src="<?=$_url['js']?>flash.js"></script>
<script src="<?=$_url['js']?>common.js"></script>
<script>
var aaa='';	
function dnum(name) {
	dismenu = eval("dismenu_"+name+".style");
	if(aaa!=dismenu) 	{
		if(aaa!='') {
			aaa.display='none';
			if(aaa!=dismenu_0.style){
			dismenu_0.style.display='none';
		}
		}
		dismenu.display='block';
			if(aaa!=dismenu_0.style){
			dismenu_0.style.display='none';
		}
		aaa=dismenu;
	}
	else {
		dismenu.display='none';
			if(aaa!=dismenu_0.style){
			dismenu_0.style.display='none';
		}
		aaa='';
	}
}
</script>