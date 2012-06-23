
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
</style>		
  
						  <table width="221" cellpadding="0" cellspacing="0" >
    				        <tr>
		    	              <td colspan="3"><img src="../img/movie_bg_top.gif" /></td>			  
		    		        </tr>					
		    	            <tr>
		    	              <td width="12"><img src="../img/movie_bg_left.gif" /></td>			  
			                  <td width="197" bgcolor="black"><EMBED  SRC="../movie/<?=$name?>.wmv" autostart="auto" NAME="MTVPlay" width=197 height=94 SHOWCONTROLS=0  windowlessVideo=true ></EMBED></td>	  
				              <td width="12"><img src="../img/movie_bg_right.gif" /></td>					  
				            </tr>			  
				            <tr>
			                  <td colspan="3"><img src="../img/movie_bg_bottom.gif" border="0" usemap="#movieMap" /></td>				  
				            </tr>	
                           </table>
	
<map name="movieMap">
  <area shape="rect" coords="13,16,35,37" href="#" onClick="play();return false;" onfocus="blur()">
  <area shape="rect" coords="42,16,63,38" href="#" onClick="pause();return false;" onfocus="blur()">
  <area shape="rect" coords="71,16,91,38" href="#" onClick="stop();return false;" onfocus="blur()">
</map>

						   <script language="javascript"> 
function vol_up(){
	volume=MTVPlay.volume;
	if (volume==+2500){
		return false;
	}else{
		MTVPlay.volume=volume+250;
		volume=MTVPlay.volume;
	}
}
 
function vol_down(){
	volume=MTVPlay.volume;
	if (volume==-2500){
		return false;
	}else{
		MTVPlay.volume=volume-250;
		volume=MTVPlay.volume;
	}
}
 
function muteoff(){
	MTVPlay.mute=false;
}
 
function mute(){
	MTVPlay.mute=true;
}
function ff(){
	MTVPlay.next();
}
function pre(){
	MTVPlay.previous();
}
function replay(){
	MTVPlay.playcount=0;
}
function replayoff(){
	MTVPlay.playcount=1;
}
 
function play(){
	if ((navigator.userAgent.indexOf('IE') > -1) && (navigator.platform == "Win32")) {
		MTVPlay.Play();
	} else {
		document.MTVPlay.Play();
	}
}
function pause(){
	if ((navigator.userAgent.indexOf('IE') > -1) && (navigator.platform == "Win32")) {
		if (MTVPlay.PlayState == 2){
			MTVPlay.Pause();
		} else {
			if (MTVPlay.PlayState == 1) {
				MTVPlay.Play();
			}
		}
	} else {
		document.MTVPlay.Pause();
	}
}
 
function stop(){
	if ((navigator.userAgent.indexOf('IE') > -1) && (navigator.platform == "Win32")) {
		MTVPlay.Stop();
		MTVPlay.CurrentPosition=0;
	} else {
		document.MTVPlay.Stop();
		document.MTVPlay.CurrentPosition=0;
	}
}
 
function muteClick() {
	if ((navigator.userAgent.indexOf('IE') > -1) && (navigator.platform == "Win32")) {
		bMuteState = MTVPlay.Mute;
	} else {
		bMuteState = MTVPlay.GetMute();
	}
	if (bMuteState == true) {
		MTVPlay.value="Mute";
		if ((navigator.userAgent.indexOf('IE') > -1) && (navigator.platform == "Win32")) {
			MTVPlay.Mute = false;
		} else {
			MTVPlay.SetMute(false);
		}
	} else {
		MTVPlay.value="Un-Mute";
		if ((navigator.userAgent.indexOf('IE') > -1) && (navigator.platform == "Win32")) {
			MTVPlay.Mute = true;
		} else {
			MTVPlay
		}
	}
}
 
</script>
 
<script language="javascript"> 
<!--
function fs(){
	MTVPlay.DisplaySize = 3;
	MTVPlay.Play();
	MTVPlay.focus();
}
//-->
</script>