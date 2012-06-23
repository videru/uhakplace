// 색상 선택
GLAY_COLOR		= 100;
RGB_COLOR		= 101;
ETC_COLOR		= 102;

RED				= 1011;
GREEN			= 1012;
BLUE			= 1013;

GLAY = new Array("F", "C", "C", "9", "9", "6", "6", "3", "0");
COLOR = new Array("FF", "CC", "99", "66", "33", "00");

COLNAME = new Array(8);
COLNAME[0] = new Array("white", "FFFFFF");
COLNAME[1] = new Array("black", "000000");
COLNAME[2] = new Array("red", "FF0000");
COLNAME[3] = new Array("yellow", "FFFF00");
COLNAME[4] = new Array("green", "00FF00");
COLNAME[5] = new Array("aqua", "00FFFF");
COLNAME[6] = new Array("blue", "0000FF");
COLNAME[7] = new Array("fuchsia", "FF00FF");

Ex1 	= new Array( 4, 3, 2, 1 );
Fy1 	= new Array( "CCCC", "99CC", "66CC", "33CC", "3399", "9999", "6699", "6666", "3366" );
Ey2a 	= new Array( 1, 5, 2, 5, 4, 4, 4, 4, 3 );
Ey2b 	= new Array( 1, 4, 2, 4, 3, 3, 3, 3, 2 );
Ey2c 	= new Array( 0, 3, 1, 3, 2, 2, 2, 2, 1 );
Ey2d 	= new Array( 0, 2, 1, 2, 1, 1, 1, 1, 0 );
Fy2 	= new Array( "CC99", "CC99", "CC66", "CC66", "CC33", "9933", "9966", "6633", "3333" );

var s1X = 4;
var s1Y = 26;
var s2X = 10;
var s2Y = 126;

function clickS1()
{
	var value = "#" + selectCol();
	RGBtoS2XY(value);
	realView(value);
}

function clickS2()
{
	var	return2X = event.clientX - s2X;
	var	return2Y = event.clientY - s2Y;

	if ( return2X > 0 && return2X < 291 )
		D2.style.posLeft = event.clientX - 9;
	if ( return2Y > 0 && return2Y < 137 )
		D2.style.posTop = event.clientY - 9;

	if ( return2X > 0 && return2X < 290 && return2Y > 0 && return2Y < 118 )
	{
		value = s2rgbColor(return2X,return2Y);
		realView(value)
	}
}

function clickS3()
{
	resultY = event.clientY - 133;

	if ( resultY > 1  && resultY < 120 )
	{
		D3.style.posTop = event.clientY - 6;
		realView(t0.style.backgroundColor);
	}
}

function RGBtoS2XY(value)
{
	var array = new Array();
	var Red = num16to10(showRGB(RED, value));
	var Green = num16to10(showRGB(GREEN, value));
	var Blue = num16to10(showRGB(BLUE, value));

	array = RGBtoHSB(Red,Green,Blue);

	xH = array["H"];
	xS = array["S"];
	xB = array["B"];

	array = HStoXY(xH,xS);

	x = array["X"];
	y = array["Y"];

	D2.style.posLeft = x + s2X - 5;
	D2.style.posTop = y + s2Y - 3;
	D3.style.posTop = 130;
}

function realView(value)
{
	newmakeTable(value);

	setCode = convertRGB(value)

	viewCol.style.backgroundColor = setCode;

	SelectColor.value = setCode;
	redCol.value = num16to10(showRGB(RED, setCode));
	greenCol.value = num16to10(showRGB(GREEN, setCode));
	blueCol.value = num16to10(showRGB(BLUE, setCode));
	
	select_color(setCode);
}

function colorName(value)
{
	var i = 0;
	var TEXT = "   ";

	while ( i < 8 )
	{
		if ( COLNAME[i][1] == value )
			return TEXT + COLNAME[i][0];
		i++;
	}

	return TEXT;
}

function dragCol()
{
	var returnX = Math.floor( (event.clientX-s1X)/8 + 1 ) * 8 + s1X - 9;
	var returnY = Math.floor( (event.clientY-s1Y)/8 + 1 ) * 8 + s1Y - 9;

	if ( 0 < (returnX-s1X+9)/8 && (returnX-s1X+9)/8 < 40 )
		D1.style.posLeft = returnX;

	if ( 0 < (returnY-s1Y+9)/8 && (returnY-s1Y+9)/8 < 10 )
		D1.style.posTop = returnY;
	
	var color = "#" + selectCol(); // + colorName(selectCol());
	RGB.innerText = color;

	return;
}

function selectCol()
{
	var selectX = (D1.style.posLeft-s1X+9)/8;
	var selectY = (D1.style.posTop-s1Y+9)/8;

	if (searchCol(selectX) == GLAY_COLOR)
		return glayColor(selectY);
	if (searchCol(selectX) == RGB_COLOR)
		return rgbColor(selectX,selectY);
	if (searchCol(selectX) == ETC_COLOR)
		return etcColor(selectX,selectY);
}

function glayColor(y)
{
	var i = 0;
	var rtnVal = "";

	while ( i < 6 )
	{
		rtnVal += GLAY[y-1];
		i++;
	}
	return rtnVal;
}

function rgbColor(x,y)
{
	var resultY = y - 5;
	var upnum = 5 - Math.abs(resultY);
	var downnum = resultY;
	var a0 = 0, a1 = 0, a2 = 0;

	rtnNum = findGRB(x).split(",");

	if ( resultY == 0 )
	{
		return COLOR[rtnNum[0]] + COLOR[rtnNum[1]] + COLOR[rtnNum[2]];
	}
	if ( resultY < 0 )
	{
		a0 = numCheck("up",rtnNum[0],upnum);
		a1 = numCheck("up",rtnNum[1],upnum);
		a2 = numCheck("up",rtnNum[2],upnum);

		return COLOR[a0] + COLOR[a1] + COLOR[a2];
	}
	else if ( resultY > 0 )
	{
		a0 = numCheck("down",rtnNum[0],downnum);
		a1 = numCheck("down",rtnNum[1],downnum);
		a2 = numCheck("down",rtnNum[2],downnum);

		return COLOR[a0] + COLOR[a1] + COLOR[a2];
	}
}

function numCheck(state, num, cnum)
{
	var num = num * 1;
	var cnum = cnum * 1;

	if ( state == "up" )
	{
		if ( cnum >= num )
			return num;
		if ( cnum < num )
			return cnum;
	}
	else ( state == "down" )
	{
		if ( cnum <= num )
			return num;
		if ( cnum > num )
			return cnum;
	}

}

function etcColor(x,y)
{
	if ( x > 31 && x < 36 )
	{
		return COLOR[Ex1[x-32]] + Fy1[y-1];
	}
	else if ( x > 35 && x < 40 )
	{
		var rst = x - 36;

		if ( rst == 0)
			return COLOR[Ey2a[y-1]] + Fy2[y-1];
		if ( rst == 1)
			return COLOR[Ey2b[y-1]] + Fy2[y-1];
		if ( rst == 2)
			return COLOR[Ey2c[y-1]] + Fy2[y-1];
		if ( rst == 3)
			return COLOR[Ey2d[y-1]] + Fy2[y-1];
	}
}


function searchCol(x)
{
	if (x < 2)
		return GLAY_COLOR;
	if ( x > 1 && x < 32 )
		return RGB_COLOR;
	if ( x > 31 && x < 40 )
		return ETC_COLOR;
}

function findGRB(x)
{
	var resultX = 0;
	var rtnVal = "";

	if ( x > 1 && x < 12 )
	{
		resultX = x - 6;

		if ( resultX <= 0 )
		{
			resultX += 5;
			rtnVal = "0,5,"+resultX;
		}
		else if ( resultX > 0 )
		{
			resultX = 5 - resultX;
			rtnVal = "0,"+resultX+",5"
		}
	}
	if ( x > 11 && x < 22 )
	{
		resultX = x - 16;

		if ( resultX <= 0 )
		{
			resultX += 5;
			rtnVal = resultX+",0,5";
		}
		else if ( resultX > 0 )
		{
			resultX = 5 - resultX;
			rtnVal = "5,0,"+resultX;
		}
	}
	if ( x > 21 && x < 32 )
	{
		resultX = x - 26;

		if ( resultX <= 0 )
		{
			resultX += 5;
			rtnVal = "5,"+resultX+",0";
		}
		else if ( resultX > 0 )
		{
			resultX = 5 - resultX;
			rtnVal = resultX+",5,0";
		}
	}

	return rtnVal;
}

function showRGB(target, value)
{
	if ( target == RED )
		return value.substring(1,3);
	if ( target == GREEN )
		return value.substring(3,5);
	if ( target == BLUE )
		return value.substring(5,7);
}

function s2rgbColor(x,y)
{
	var array = new Array();

	array = XYtoHS(x,y);

	xH = array["H"];
	xS = array["S"];
	xB = 100;

	array = HSBtoRGB(xH,xS,xB);

	aa = num10to16(array["RE"]);
	bb = num10to16(array["GR"]);
	cc = num10to16(array["BL"]);

	return "#" + aa + bb + cc;

}

function makeColorTable()
{
	var i = 0;

	while ( i < 16 ) {

		var col = num10to16(Math.round((16 - i) * (255/16)));
		var allColor = "#" + col + col + col;

		document.write("<tr><td id=t" + i
		+ " width=8 height=7 style=\"font-size:0; letter-spacing:0; text-indent:0; margin:0px;"
		+ "; padding:0px; border-width:0; border-color:black; background-color:" + allColor  +"; maroon; border-style:none;\"><p>&nbsp;</td></tr>");
		i++;
	}

}

function newmakeTable(value)
{

	var Red = num16to10(showRGB(RED, value));
	var Green = num16to10(showRGB(GREEN, value));
	var Blue = num16to10(showRGB(BLUE, value));

	var i = 0;

	while ( i < 16 ) {

		var col1 = num10to16(Math.round((16 - i) * (Red/16)));
		var col2 = num10to16(Math.round((16 - i) * (Green/16)));
		var col3 = num10to16(Math.round((16 - i) * (Blue/16)));
		var allColor = "#" + col1 + col2 + col3;

		eval("t"+i+".style.backgroundColor = allColor");

		i++;

	}
}

function convertRGB(value)
{
	var array = new Array();

	var Red = num16to10(showRGB(RED, value));
	var Green = num16to10(showRGB(GREEN, value));
	var Blue = num16to10(showRGB(BLUE, value));

	x2 = D3.style.posTop - 130;

	array = RGBtoHSB(Red,Green,Blue);

	xH = array["H"];
	xS = array["S"];
	xB = array["B"];

	xB = Math.floor(  xB - ((xB*x2) / 116) );

	array = HSBtoRGB(xH,xS,xB);

	aa = num10to16(array["RE"]);
	bb = num10to16(array["GR"]);
	cc = num10to16(array["BL"]);

	return "#" + aa + bb + cc;
}

function num16to10(value)
{
	var rtnVal = 0;

	rtnVal = (Char2Num(value.substring(0,1)) * 16) + (Char2Num(value.substring(1,2)) * 1);

	return rtnVal;
}

function Char2Num(str)
{
	if ( str == "A" || str == "a" )
		return 10;
	else if ( str == "B" || str == "b" )
		return 11;
	else if ( str == "C" || str == "c" )
		return 12;
	else if ( str == "D" || str == "d" )
		return 13;
	else if ( str == "E" || str == "e" )
		return 14;
	else if ( str == "F" || str == "f" )
		return 15;
	else
		return str;
}

function num10to16(value)
{
	var rtnVal = 0;

	rtnVal = Num2Char(Math.floor( value / 16 )) + "" + Num2Char(value - Math.floor( value / 16 ) * 16);

	return rtnVal;
}

function Num2Char(num)
{
	if ( num == 10 )
		return "A";
	else if ( num == 11 )
		return "B";
	else if ( num == 12 )
		return "C";
	else if ( num == 13 )
		return "D";
	else if ( num == 14 )
		return "E";
	else if ( num == 15 )
		return "F";
	else if ( num < 10 )
		return num;
}

function HStoXY(H,S)
{
  var array = new Array();

  if (S == 0)
  {
    array["X"] = 0;
    array["Y"] = 120;
  }
  else
  {
    array["X"] = Math.round( 29 * H / 36 );
    array["Y"] = Math.round( 6 * S / 5 );
	array["Y"] = 120 - array["Y"];
  }

  return array;
}

function XYtoHS(X,Y)
{
	var array = new Array();

    Y = 120 - Y;

	if ( X <= 1)
	{
		array["H"] = 0;
	}
	else
	{
		array["H"] = Math.round( 36 * X / 29 );

		if ( array["H"] > 360 )
			array["H"] = 360;

	}

	if ( Y <= 1)
	{
		array["S"] = 100;
	}
	else
	{
		array["S"] = Math.round( 5 * Y / 6 );

		if ( array["S"] > 100 )
			array["S"] = 100;
	}

	return array;
}

function HSBtoRGB(H,S,B)
{
	var array = new Array();
	var x,y,z;
	var h,s,b;
	var re,gr,bl;
	var htmp, i,j;
	if(isNaN(H) == true || isNaN(S) == true || isNaN(B) == true)
		return;
	if(H == 360)
		H = 0;
	h = H;
	s = S/100;
	b = B/100;

	if(s == 0)
	{
		re = b;
		gr = b;
		bl = b;
	}
	else
	{
		if(h == 0)
			htmp = 0;
		else
			htmp = h/60;
		i = Math.floor(htmp);
		j= htmp - i;

		x = b*(1-s);
		y = b*(1-(s*j));
		z = b*(1-(s*(1-j)));

		switch(i)
		{
			case 0:
				re = b;
				gr = z;
				bl = x;
	        break;

			case 1:
				gr = b;
				re = y;
				bl = x;
			break;

			case 2:
				gr = b;
				re = x;
				bl = z;
			break;

			case 3:
				bl = b;
				gr = y;
				re = x;
			break;

			case 4:
				bl = b;
				gr = x;
				re = z;
			break;

			case 5:
				re = b;
				gr = x;
				bl = y;
			break;
		}
	}

	array["RE"] = Math.round(re * 255);
	array["GR"] = Math.round(gr * 255);
	array["BL"] = Math.round(bl * 255);

	return array;
}

function RGBtoHSB(R,G,B)
{
	var array = new Array();
	var re,gr,bl;
	var h,s,b;
	var min, tmp;
	var angcase;

	re = R/255;
	gr = G/255;
	bl = B/255;

	min = Math.min(re,Math.min(gr,bl));
	b = Math.max(re,Math.max(gr,bl));

	tmp = b - min;

	if(tmp == 0)
		s = 0;
	else
		s = tmp/b;

	if(s == 0)
	{
		h = 0;
	}
	else
	{
		if(b == re)
		{
			if((re != gr) && (re != bl))
			h = 60*((gr-bl)/tmp);
		}
		if(b == gr)
		{
			if(gr != bl)
			h = 120 + ((60*(bl-re))/tmp);
		}
		if(b == bl)
		{
			h = 240 + ((60*(re-gr))/tmp);
		}
	}
	if(h < 0)
	{
		h = 360 + h;
	}

	array["H"] = Math.round(h);
	array["S"] = Math.round(s * 100);
	array["B"] = Math.round(b * 100);

	return array;
}
