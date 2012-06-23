var enablepersist=true
var slidernodes=new Object() 
function ContentSlider(sliderid, autorun){
var slider=document.getElementById(sliderid)
slidernodes[sliderid]=[] 
var alldivs=slider.getElementsByTagName("div")
for (var i=0; i<alldivs.length; i++){
if (alldivs[i].className=="contentdiv"){
slidernodes[sliderid].push(alldivs[i]) //add this DIV reference to array
}
}
ContentSlider.buildpagination(sliderid)
var loadfirstcontent=true
if (enablepersist && getCookie(sliderid)!=""){ 
var cookieval=getCookie(sliderid).split(":") 
if (document.getElementById(cookieval[0])!=null && typeof slidernodes[sliderid][cookieval[1]]!="undefined"){ 
ContentSlider.turnpage(cookieval[0], parseInt(cookieval[1])) 
loadfirstcontent=false
}
}
if (loadfirstcontent==true) 
ContentSlider.turnpage(sliderid, 0) 
if (typeof autorun=="number" && autorun>0) 
window[sliderid+"timer"]=setTimeout(function(){ContentSlider.autoturnpage(sliderid, autorun)}, autorun)
}

ContentSlider.buildpagination=function(sliderid){
var paginatediv=document.getElementById("paginate-"+sliderid) 
var pcontent=""
for (var i=0; i<slidernodes[sliderid].length; i++) 
pcontent+='<a href="#" onClick=\"ContentSlider.turnpage(\''+sliderid+'\', '+i+'); return false\">'+(i+1)+'</a> '
pcontent+='<a href="#" style="font-weight: bold;" onClick=\"ContentSlider.turnpage(\''+sliderid+'\', parseInt(this.getAttribute(\'rel\'))); return false\">Next</a>'
paginatediv.innerHTML=pcontent
paginatediv.onclick=function(){ 
if (typeof window[sliderid+"timer"]!="undefined")
clearTimeout(window[sliderid+"timer"])
}
}

ContentSlider.turnpage=function(sliderid, thepage){
var paginatelinks=document.getElementById("paginate-"+sliderid).getElementsByTagName("a") 
for (var i=0; i<slidernodes[sliderid].length; i++){ 
paginatelinks[i].className="" 
slidernodes[sliderid][i].style.display="none" 
}
paginatelinks[thepage].className="selected"
slidernodes[sliderid][thepage].style.display="block" 
paginatelinks[paginatelinks.length-1].setAttribute("rel", thenextpage=(thepage<paginatelinks.length-2)? thepage+1 : 0)
if (enablepersist)
setCookie(sliderid, sliderid+":"+thepage)
}

ContentSlider.autoturnpage=function(sliderid, autorunperiod){
var paginatelinks=document.getElementById("paginate-"+sliderid).getElementsByTagName("a") 
var nextpagenumber=parseInt(paginatelinks[paginatelinks.length-1].getAttribute("rel")) 
ContentSlider.turnpage(sliderid, nextpagenumber)
window[sliderid+"timer"]=setTimeout(function(){ContentSlider.autoturnpage(sliderid, autorunperiod)}, autorunperiod)
}

function getCookie(Name){ 
var re=new RegExp(Name+"=[^;]+", "i"); 
if (document.cookie.match(re)) 
return document.cookie.match(re)[0].split("=")[1] 
return ""
}

function setCookie(name, value){
document.cookie = name+"="+value
}