
var img_national = new Array();

	img_national[0] = "";
	img_national[1] = "../n_img/power_such/usa.jpg";
	img_national[2] = "../n_img/power_such/canada.jpg";
	img_national[3] = "../n_img/power_such/australia.jpg";
	img_national[4] = "../n_img/power_such/newzealand.jpg";
	img_national[5] = "../n_img/power_such/england.jpg";
	img_national[6] = "../n_img/power_such/philippine.jpg";


function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}

//change national image
if(a[3] !=null)
 $("#national")[0].src=img_national[a[3]];
 
 //미국의 경우에는 주가 있고 나머지는 업음
 if(a[3] ==1)
 	$("#stateview").attr("disabled",'disabled');
 else $("#stateview").removeAttr("disabled");
}

function MM_loadSchoolInfo()
{
	//주,도시,지역번호,학교번호, 학교이름
}

function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}

