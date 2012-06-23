<script language='javascript'>
<!--
	function screen_resize(){
		var tmp_w = <?=(int)$_GET[w]?>;
		var tmp_h = <?=(int)$_GET[h]?>;

		w = screen.width;
		h = screen.height;

		tmp_size = (w > tmp_w) ? tmp_w+20 : w;
		tmp_size2 = (h > tmp_h) ? tmp_h+20 : h;

		resizeTo(tmp_size,tmp_size2);
		moveTo(0,0);
	}

	function image_change(Event){
		var newEventX = Event ? Event.pageX : event.x;
		var newEventY = Event ? Event.pageY : event.y;
		eval("document.viewimg.width=" + newEventX);
		eval("document.viewimg.height=" + newEventY);
	}

	if(navigator.appName.charAt(0)=='N'){
		window.document.captureEvents(Event.MOUSEDOWN);
		window.document.onmousedown = image_change;
	}

	function closeWin(){
		window.close();
	}

//-->
</script>

<title>image View</title>

<body bgcolor="white" text="black" link="blue" vlink="purple" alink="red" leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" onload='screen_resize();'>

<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center">
	<tr>
		<td align=center>
			<img src='<?=$_GET['name']?>' name='viewimg' border='0' ondrag="image_change()" style="cursor:move;" onclick="closeWin();" title="Image Resize">
		</td>
	</tr>
</table>