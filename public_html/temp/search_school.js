﻿var img_national = new Array();

img_national[0] = "";
img_national[1] = "../n_img/power_such/newzealand.jpg";//1
img_national[2] = "../n_img/power_such/australia.jpg";//2
img_national[3] = "../n_img/power_such/philippine.jpg";//3
img_national[4] = "../n_img/power_such/england.jpg";//4
img_national[5] = "../n_img/power_such/canada.jpg";//5
img_national[6] = "../n_img/power_such/usa.jpg";//6


var nationalcode;//선택된 국가
var statecode=0;//선택된 주
var citycode=0;//선택된 주

function MM_preloadImages() { //v3.0
	var d=document; if(d.images){
		if(!d.MM_p) d.MM_p=new Array();
		var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
			if (a[i].indexOf("#")!=0){
			d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];
	}
}


	MM_swapImage('Image5','','../n_img/power_such/btn_4.jpg',5);//초기이미지는 뉴질랜드
}
function MM_swapImgRestore() { //v3.0
	var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_findObj(n, d) { //v4.01
	var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
		d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);
	}
	if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
	for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
	if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
	MM_swapImgRestore();
	var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
		if ((x=MM_findObj(a[i]))!=null){
		document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];
	}
	nationalcode = null;
	statecode =null;
	citycode =null;
	$('#stateselect').empty();
	$('#cityselect').empty();
	$('#schoolselect').empty();
	$('#cityselect').append('<option value="'+0+'" selected="selected">-도시-</option>');
	$('#schoolselect').append('<option value="'+0+'" selected="selected">-학교-</option>');
	//change national image
	if(a[3] !=null)
	{
		$("#national")[0].src=img_national[a[3]];
		nationalcode = a[3];

		//팔리핀,영국의 경우에는 주가 없고 나머지는 있음
		if(a[3] ==3 || a[3] ==4)
		{
			$("#stateselect").attr("disabled",'disabled');

			//필리핀은 주가 없음

			$.getJSON("http://uhakplace.co.kr/temp/state.php?nationalcode="+nationalcode,function(msg)
					{

						var cities =msg.cities;
						for( var idx in cities)
						{
							//-- 주 추가
							if(cities[idx])
								$('#cityselect').append('<option value="'+cities[idx].index+'">'+cities[idx].name+'</option>');
						}
	

						 $("#cityselect").hide(0);
						 $("#cityselect").show(0);
					});
			
		}
		else
		{
			$("#stateselect").removeAttr("disabled");

			$('#stateselect').append('<option value="'+0+'" selected="selected">-주-</option>');
			$.get("http://uhakplace.co.kr/temp/state.php?nationalcode="+nationalcode,function(msg)
					{
						reg=msg;
						var jsc = new Array();
						
						jsc =reg.split("--__--");
			
						for( var idx in jsc)
						{
							//-- 주 추가
							if(jsc[idx])
							{
								var temp = idx*1+1;
								$('#stateselect').append('<option value="'+temp+'">'+jsc[idx]+'</option>');
							}
						}
	
						 $("#stateselect").hide(0);
						 $("#stateselect").show(0);
					});
	
				
		}
	
	}
}

function loadcityinfo()
{
}

function loadSchoolInfo()
{
	//주,도시,지역번호,학교번호, 학교이름
}

function MM_selectState(selObj){
	eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
	if (restore) selObj.selectedIndex=0;
}

function MM_jumpMenu(targ,selObj,restore){ //v3.0
	//eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
	//if (restore) selObj.selectedIndex=0;


}

function MM_selectMenu(type)
{
	switch(type)
	{
		case 0://주선택
			citycode=null;
			
			$('#cityselect').empty();
			$('#schoolselect').empty();
			$('#schoolselect').append('<option value="'+0+'" selected="selected">-학교-</option>');
			statecode=$("#stateselect option:selected")[0].value* 1;
			
			$('#cityselect').append('<option value="'+0+'" selected="selected">-도시-</option>');
			$.getJSON("http://uhakplace.co.kr/temp/state.php?nationalcode="+nationalcode+"&state="+statecode
					,function(result)
					{
					
						var cities =result.cities;
						for( var idx in cities)
						{
							//-- 주 추가
							if(cities[idx])
								$('#cityselect').append('<option value="'+cities[idx].index+'">'+cities[idx].name+'</option>');
						}

						 $("#cityselect").hide(0);
						 $("#cityselect").show(0);
					});
				
			

			break;
		case 1://도시선택
			
			$('#schoolselect').empty();
			if(nationalcode == 3 || nationalcode==4)
				citycode=$("#cityselect option:selected")[0].value* 1;
			else citycode=$("#cityselect option:selected")[0].value* 1+1;
			
			$('#schoolselect').append('<option value="'+0+'" selected="selected">-학교-</option>');
			$.getJSON("http://uhakplace.co.kr/temp/state.php?nationalcode="+nationalcode+"&state="+statecode+"&city="+citycode
					,function(result)
					{
					
						var schools =result.schools;
						for( var idx in schools)
						{
							//-- 학교 추가
							if(schools[idx])
								$('#schoolselect').append('<option value="'+schools[idx].num+'">'+schools[idx].title+'</option>');
						}

						 $("#schoolselect").hide(0);
						 $("#schoolselect").show(0);
					});
			
			
			
			 $("#schoolselect").hide(0);
			 $("#schoolselect").show(0);
			break;
		case 2://학교 선택
		    var  schoolcode=$("#schoolselect option:selected")[0].value* 1;
				window.location="http://uhakplace.co.kr/phil/school_view_new.php?num="+ schoolcode +"&national="+nationalcode;
			break;
	}

}

function searchschool()
{

	
	if(nationalcode)
	{
	    if(statecode !=null && statecode !=0 && (citycode ==null || citycode == 0))
	    {
	    	window.location="http://uhakplace.co.kr/phil/school_list_new.php?national="+nationalcode+"&state="+statecode;//국가도시 선택
	    }
	    else if(citycode !=null && citycode !=0)
	    {
	       window.location="http://uhakplace.co.kr/phil/school_list_new.php?national="+nationalcode+"&area="+citycode;//국가도시 선택
	    }
	    else window.location="http://uhakplace.co.kr/phil/school_list_new.php?national="+nationalcode;//국가만 선택
	}
	
	
	
}
